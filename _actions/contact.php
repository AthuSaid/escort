<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$functions = new functions();

$email = new email();

$msg = $_REQUEST['message'];

$_REQUEST = $functions->fSanitizeRequest($_POST);

if ($functions->fSaveNewsletter($_REQUEST['name'], $_REQUEST['email'], $msg))
{
	$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
				Ol&aacute; Administrador,<br><br>
				O usu&aacute;rio '.$_REQUEST['name'].' ('.$_REQUEST['email'].') entrou em contato em '.date('d/m/Y H:i:s').'!<br><br>
				<i>"'.nl2br($msg).'"</i><br><br>
				Responda-o o quanto antes!!!:<br><br>					
				Atenciosamente,<br>		
				Equipe '.SIS_TITULO.'.<br><br>
				<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>		
			';
	
	$arrEmail = array('name' => $_REQUEST['name'], 
					  'email' => 'danieltriboni@gmail.com', 
					  'subject' => SIS_TITULO.' - Contato', 
					  'message' => $message);
	
	if ($email->fSendEmailToPerson($arrEmail))
	{
		$retJson = json_encode(array("ret" => true, "msg" => 'Seu email foi enviado com sucesso!', "url" => null));
		
	}else{
		$retJson = json_encode(array("ret" => false, "msg" => 'Falha ao enviar o email. Por favor, tente novamente mais tarde!', "url" => null));
	}
	
}else{
	
	$retJson = json_encode(array("ret" => false, "msg" => 'Falha ao enviar o email. Por favor, tente novamente mais tarde!'));
}

echo $retJson;