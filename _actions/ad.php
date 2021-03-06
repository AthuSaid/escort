<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

$email = new email();

$_REQUEST = $functions->fSanitizeRequest($_POST);

# Check if Person is logged to update signup
if($_SESSION['sPersonLogged'] && isset($_SESSION['sPersonID']) && isset($_REQUEST['apid']))
{
	if ($_REQUEST['method'] == 'delete')
	{
		# Remove Ad if success
		if($functions->fRemoveAd($_REQUEST['apid']))
		{
			$countAds = $functions->fGetCountDashboardAds($_SESSION['sPersonID']);
			
			$showBtNewAd = ($countAds >= $_SESSION['sPersonMaxAds'] && $_SESSION['sPersonPlanPaid'] < 1 ? false : true);
			
			$retJson = json_encode(array("ret" => true, "msg" => null, "shownewad" => $showBtNewAd));
			
		}else
			$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao remover seu anuncio!'));
			
	}else{
		
		# Check if exists at least one cache value setted
		if(empty($_REQUEST['c30']) && empty($_REQUEST['c1']) && empty($_REQUEST['c2']) &&
		empty($_REQUEST['c4']) && empty($_REQUEST['c8']) && empty($_REQUEST['c12']) && empty($_REQUEST['viagem']))
		{
			$retJson = json_encode(array("ret" => false, "field" => "money", "msg" => 'Informe ao menos um Valor de Cach&ecirc;!'));
				
		}else{
		
			# Check if Person Ad Title Already exists
			if ($functions->fGetAdTitle($_REQUEST['titulo'], $_REQUEST['apid']))
			{
				# Update Ad if success
				if($functions->fUpdateAd($_REQUEST))
				{
					$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
										Ol&aacute; '.$functions->fReduceName($_SESSION['sPersonUrl']).',<br><br>
										Seu an&uacute;ncio no '.SIS_TITULO.' foi alterado com sucesso!<br>
										Nossa equipe de moderadores est&aacute; avaliando veemente o conte&uacute;do modificado do seu an&uacute;ncio e <br>
										no m&aacute;ximo de 2 horas, voc&ecirc; ser&aacute; notificado(a) se o mesmo foi aprovado ou reprovado! <br>
										Caso deseje alterar algum dado em seu an&uacute;ncio, clique no link abaixo:<br><br>
										<a href="'.SIS_URL.'ad/'.$_SESSION['sPersonUrl'].'/'.$_REQUEST['url'].'">'.SIS_URL.'ad/'.$_SESSION['sPersonUrl'].'/'.$_REQUEST['url'].'</a><br><br>
										Atenciosamente,<br>
										Equipe '.SIS_TITULO.'.<br><br>
										<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>
									';
					
					$arrEmail = array('aka' => $_SESSION['sPersonUrl'],
									  'email' => $_SESSION['sPersonEmail'],
									  'subject' => SIS_TITULO.' - Anuncio Alterado',
									  'message' => $message);
					
					$email->fSendEmailToPerson($arrEmail);
					
					$retJson = json_encode(array("ret" => true, "msg" => null, "url" => $_SESSION['sPersonUrl'], "title" => $_REQUEST['url']));
				}else
					$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao atualizar seu anuncio!'));
				
			}else{
					
				$retJson = json_encode(array("ret" => false, "field" => "titulo", "msg" => 'Voc&ecirc; j&aacute; possui um an&uacute;ncio com este t&iacute;tulo.'));
			}
		}	
	}	
	
}else{
	
	# Check if exists at least one cache value setted
	if(empty($_REQUEST['c30']) && empty($_REQUEST['c1']) && empty($_REQUEST['c2']) &&
	empty($_REQUEST['c4']) && empty($_REQUEST['c8']) && empty($_REQUEST['c12']) && empty($_REQUEST['viagem']))
	{
		$retJson = json_encode(array("ret" => false, "field" => "money", "msg" => 'Informe ao menos um Valor de Cach&ecirc;!'));
	
	}else{
		
		# Check if Person Ad Title Already exists
		if ($functions->fGetAdTitle($_REQUEST['titulo'], null))
		{		
			# Save new Ad if success
			if($functions->fSaveNewAd($_REQUEST))
			{
				# Save Featured Model ONLY if plan is Basic for New Ad (JUST 1 TIME!!)
				# BASIC PLAN RULES: Just allow one Ad and if it's approved
				if ($_SESSION['sPersonPlanID'] == 1)
				{
					$dateFMP = date('Y-m-d H:i:s');
					
					for ($fmp = 1; $fmp < 6; $fmp++) #Featured Models from 1 to 5
						$functions->fInsertFeaturedModelsByPlans($functions->retAPID, $fmp, $dateFMP, date('Y-m-d H:i:s', strtotime('+'.SIS_DIAS_GRATIS.' day')));
				}
				
				$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
								Ol&aacute; '.$functions->fReduceName($_SESSION['sPersonUrl']).',<br><br>
								Seu an&uacute;ncio no '.SIS_TITULO.' foi inclu&iacute;do com sucesso!<br>
								Nossa equipe de moderadores est&aacute; avaliando o conte&uacute;do do seu novo an&uacute;ncio e <br>
								no m&aacute;ximo de 2 horas, voc&ecirc; ser&aacute; notificado(a) se o mesmo foi aprovado ou reprovado! <br>
								Caso deseje alterar algum dado em seu an&uacute;ncio, clique no link abaixo:<br><br>
								<a href="'.SIS_URL.'ad/'.$_SESSION['sPersonUrl'].'/'.$_REQUEST['url'].'">'.SIS_URL.'ad/'.$_SESSION['sPersonUrl'].'/'.$_REQUEST['url'].'</a><br><br>
								Atenciosamente,<br>
								Equipe '.SIS_TITULO.'.<br><br>
								<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>
							';
					
				$arrEmail = array('aka' => $_SESSION['sPersonUrl'],
								  'email' => $_SESSION['sPersonEmail'],
								  'subject' => SIS_TITULO.' - Novo Anuncio',
								  'message' => $message);
					
				$email->fSendEmailToPerson($arrEmail);
				
				$retJson = json_encode(array("ret" => true, "msg" => null, "url" => $_SESSION['sPersonUrl'], "title" => $_REQUEST['url']));
			}else
				$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao salvar seu anuncio'));											
			
		}else{
			
			$retJson = json_encode(array("ret" => false, "field" => "titulo", "msg" => 'Voc&ecirc; j&aacute; possui um an&uacute;ncio com este t&iacute;tulo.'));
		}	
	}
}

echo $retJson;