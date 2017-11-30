<?php

/**
 * CronJob - Update Payment Statuses
 * @author Libidinous Development Team
 * @access Execute Hour by Hour
 * @tutorial TODO
*/
ob_start();

set_time_limit(0);

error_reporting(E_ALL);

date_default_timezone_set('America/Sao_Paulo');

//if (!isset($_SERVER['argc']))
//   die("<div style='font-family: Tahoma; color: #CC0000; font-weight: bold'>ACESSO NEGADO AO RECURSO!</div>");    

include_once $_SERVER['DOCUMENT_ROOT']."/_includes/_config/config.ini.php";

$query = new queries();

$func = new functions(false);

$email = new email();

$autoloadFuncs = spl_autoload_functions();

foreach($autoloadFuncs as $unregisterFunc)
{
	spl_autoload_unregister($unregisterFunc);
}

include $_SERVER['DOCUMENT_ROOT']."/_includes/PagSeguroLibrary/PagSeguroLibrary.php";

spl_autoload_register(function ($class_name) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/PagSeguroLibrary/".$class_name.".php";
});

 try {

 	 # Buscar por transacoes ate 10 dias atras
 	 $dateIni = date('Y-m-d', strtotime('-10 day'));
 	
	 $dateEnd = date("Y-m-d");
	 
	 $timeEnd = date("H:i");
	 	
	 $credentials = PagSeguroConfig::getAccountCredentials(); 
	 
	 $response = PagSeguroTransactionSearchService::searchByDate($credentials, 1, 1000, $dateIni."T00:00", $dateEnd."T".$timeEnd);
	 
	 if (is_object($response))
	 {	 	
	 	foreach ($response->transactions as $transactions)
	 	{	 		
	 		$retPlan = $query->getAcquiredPlans($transactions->code);
	 	
	 		if ($retPlan[0]['psid'] == $transactions->code)
	 		{	 			
	 			switch ($transactions->status->value)
	 			{
	 				case 1: # Aguardando Pagamento
	 						
	 					$arrLog = array('pesid' => $retPlan[0]['pesid'],
	 									'plaid' => $retPlan[0]['plaid'],
			 							'apid'  => '0',
			 							'fotid' => '0',
			 							'psid'  => $retPlan[0]['psid'],
			 							'acao'  => 'Pagamento do Plano via PagSeguro aguardando confirmacao');
	 					
	 					$query->fInsertLogActions($arrLog);
	 						
	 					echo 'Pagamento do Plano aguardando confirmacao via PagSeguro - PSID: '.$retPlan[0]['psid'].' - PESID: '.$retPlan[0]['pesid'];
	 						
	 					ob_flush();
	 					
	 				break;
	 	
	 				case 3: # Pago
	 						
	 					if ($retPlan[0]['pago'] == '0')
	 					{	 						
	 						$arrPlan = array('psid' => $retPlan[0]['psid'],
	 										 'pago' => 1,
	 										 'vencimento' => date('Y-m-d H:i:s', strtotime('+'.$retPlan[0]['cobrancadias'].' day')),
	 										 'pagamento' => date('Y-m-d H:i:s'),
	 										 'vlcorrigido' => $transactions->grossAmount,
	 										 'ppid' => $retPlan[0]['ppid']);
	 							
	 						if($query->fUpdatePersonPlan($arrPlan))
	 						{
	 							$retFeatured = $query->fGetPersonAdsToInsertFeatureds($retPlan[0]['psid']);
	 							
	 							if (count($retFeatured) > 0)
	 							{
	 								for ($x = 0; $x < count($retFeatured); $x++)
	 								{
	 									if($query->fDeleteFeaturedModelsBeforeInsert($retFeatured[$x]['apid']))
	 									{
	 										if ($retPlan[0]['destaqueposter'] > 0)
	 											$query->fInsertFeaturedModelsByPlans($retFeatured[$x]['apid'], 1, date('Y-m-d H:i:s'),date('Y-m-d H:i:s', strtotime('+'.$retPlan[0]['periododestaque'].' day')));
 											if ($retPlan[0]['destaquelivreto'] > 0)
 												$query->fInsertFeaturedModelsByPlans($retFeatured[$x]['apid'], 2, date('Y-m-d H:i:s'),date('Y-m-d H:i:s', strtotime('+'.$retPlan[0]['periododestaque'].' day')));
											if ($retPlan[0]['destaquelistaquatro'] > 0)
												$query->fInsertFeaturedModelsByPlans($retFeatured[$x]['apid'], 3, date('Y-m-d H:i:s'),date('Y-m-d H:i:s', strtotime('+'.$retPlan[0]['periododestaque'].' day')));
											if ($retPlan[0]['destaquenovaspessoas'] > 0)
												$query->fInsertFeaturedModelsByPlans($retFeatured[$x]['apid'], 4, date('Y-m-d H:i:s'),date('Y-m-d H:i:s', strtotime('+'.$retPlan[0]['periododestaque'].' day')));
											if ($retPlan[0]['destaquegaleriahome'] > 0)
												$query->fInsertFeaturedModelsByPlans($retFeatured[$x]['apid'], 5, date('Y-m-d H:i:s'),date('Y-m-d H:i:s', strtotime('+'.$retPlan[0]['periododestaque'].' day')));
	 									}
	 								}
	 							}
	 							
	 							$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
									Ol&aacute; '.$func->fReduceName($retPlan[0]['apelido']).',<br><br>
									O pagamento do seu Plano '.$retPlan[0]['plano'].' no '.SIS_TITULO.' foi confirmado com sucesso!<br>
										<strong>Plano '.$retPlan[0]['plano'].'</strong> no valor de
										<strong>R$ '.number_format($transactions->grossAmount, 2, ",", ".").'</strong> com vencimento em
										<strong>'.date('d/m/Y', strtotime("+".$retPlan[0]['cobrancadias']." day")).'</strong><br>
									Com este plano voc&ecirc; poder&aacute; incluir '.($retPlan[0]['anuncios'] == 999 ? 'quantos an&uacute;ncios quiser' : 'at&eacute; '.$retPlan[0]['anuncios'].' an&uacute;ncios').' no site, <br>
									bem como '.($retPlan[0]['fotos'] == 999 ? 'fotos ilimitadas' : 'at&eacute; '.$retPlan[0]['fotos'].' fotos').' e
											 '.($retPlan[0]['videos'] == 999 ? 'v&iacute;deos ilimitados' : 'at&eacute; '.$retPlan[0]['videos'].' v&iacute;deos').'! <br>
									Seus an&uacute;ncios estar&atilde;o dispon&iacute;veis na home do site ap&oacute;s aprovados<br>
									e pelo tempo determinado de acordo com o seu plano contratado!<br>		 		
									Caso deseje acessar sua conta, clique no link abaixo:<br><br>
									<a href="'.SIS_URL.'signin/dashboard">'.SIS_URL.'signin/dashboard</a><br><br>
									Atenciosamente,<br>
									Equipe '.SIS_TITULO.'.<br><br>
									<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>
								';
	 								
	 							$arrEmail = array('aka' => $retPlan[0]['apelido'],
				 									'email' => $retPlan[0]['email'],
				 									'subject' => SIS_TITULO.' - Pagamento do Plano '.$retPlan[0]['plano'].' foi confirmado!',
				 									'message' => $message);
	 								
	 							$email->fSendEmailToPerson($arrEmail);
	 							
	 							$arrLog = array('pesid' => $retPlan[0]['pesid'], 
	 											'plaid' => $retPlan[0]['plaid'],
	 											'apid'  => '0', 
	 											'fotid' => '0', 
	 											'psid'  => $retPlan[0]['psid'], 
	 											'acao'  => 'Confirmado Pagamento do Plano via PagSeguro');
	 							
	 							$query->fInsertLogActions($arrLog);

	 							echo 'Confirmado Pagamento do Plano via PagSeguro - PSID: '.$retPlan[0]['psid'].' - PESID: '.$retPlan[0]['pesid'];
	 							
	 							ob_flush();	 								
	 						}
	 					}
	 						
	 				break;
	 						
	 				case 7: # Cancelado
	 					
	 					$arrLog = array('pesid' => $retPlan[0]['pesid'],
					 					'plaid' => $retPlan[0]['plaid'],
			 							'apid'  => '0',
			 							'fotid' => '0',
			 							'psid'  => $retPlan[0]['psid'],
			 							'acao'  => 'Confirmado Cancelamento do Pagamento do Plano via PagSeguro');
	 						
	 					$query->fInsertLogActions($arrLog);
	 					
	 					echo 'Confirmado Cancelamento do Pagamento do Plano via PagSeguro - PSID: '.$retPlan[0]['psid'].' - PESID: '.$retPlan[0]['pesid'];
	 					
	 					ob_flush();
	 						
	 				break;
	 			}
	 		}	 	
	 	}
	 	
	 }else{
	 	
	 	die("<div style='font-family: Tahoma; color: #CC0000; font-weight: bold'>NENHUMA TRANSA&Ccedil;&Atilde;O ENCONTRADA!</div>");
	 }	 	
	
 } catch (PagSeguroServiceException $e) {
 
 	die("<div style='font-family: Tahoma; color: #CC0000; font-weight: bold'>{$e->getMessage()}</div>"); 	
 }