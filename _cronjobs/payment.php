<?php

/**
 * CronJob - Update Payment Statuses
 * @author Daniel Triboni - Escort
 * @access Execute Hour by Hour
 * @tutorial TODO
*/
ob_start();

set_time_limit(0);

error_reporting(E_ALL);

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SERVER['argc']))
   die("<div style='font-family: Tahoma; color: #33ACCC; font-weight: bold'>ACESSO NEGADO AO RECURSO!</div>");    

include_once $_SERVER['DOCUMENT_ROOT']."/_includes/_config/config.ini.php";

$query = new queries();

$email = new Email;

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
	
	if (is_object($response) || is_object($response->transactions))
	{	 	
	 	foreach ($response->transactions as $transactions)
	 	{
	 		
	 		print '<pre>';
	 		print_r($transactions);
	 		die;
	 		
	 		$retPlan = $query->getAcquiredPlans($transactions->code);
	 	
	 		if ($retPlan[0]['psid'] == $transactions->code)
	 		{	 			
	 			switch ($transactions->status->value)
	 			{
	 				case 1: # Aguardando Pagamento
	 						
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
	 							
	 						if($query->setPlanPaid($arrPlan))
	 						{
	 							/*$arrEmail = array('EmpresaNomeFantasia' => $retPlan[0]['EmpresaNomeFantasia'],
	 									'EmpresaResponsavelNome' => $retPlan[0]['EmpresaResponsavelNome'],
	 									'EmpresaResponsavelEmail' => $retPlan[0]['EmpresaResponsavelEmail'],
	 									'PSID' => $retPlan[0]['PSID'],
	 									'NumBots' => $retPlan[0]['PlanoBots'],
	 									'CobrancaVencimento' => date('Y-m-d H:i:s', strtotime('+30 day')),
	 									'CobrancaValorPago' => $transactions->grossAmount);
	 								
	 							$email->sendEmailPayment($arrEmail);*/
	 							
	 							ob_flush();	 							
	 						}
	 					}
	 						
	 				break;
	 						
	 				case 7: # Cancelado
	 						
	 				break;
	 			}
	 		}	 	
	 	}
	 	
	 }else{
	 	
	 	die("<div style='font-family: Tahoma; color: #33ACCC; font-weight: bold'>NENHUMA TRANSA&Ccedil;&Atilde;O ENCONTRADA!</div>");
	 }	 	
	
 } catch (PagSeguroServiceException $e) {
 
 	die("<div style='font-family: Tahoma; color: #33ACCC; font-weight: bold'>{$e->getMessage()}</div>"); 	
 }