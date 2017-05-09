<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$functions = new functions();

$email = new email();

$_REQUEST = $functions->fSanitizeRequest($_POST);

if (!$functions->fGetEmail($_REQUEST['email']))
{
	$retRetrieve = $functions->fRetrievePassword($_REQUEST['email']);
	
	$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
				Ol&aacute; '.$functions->fReduceName($retRetrieve[0]['apelido']).',<br><br>
				Recebemos uma solicita&ccedil;&atilde;o para a redefini&ccedil;&atilde;o de uma nova senha <br>
				associada a sua conta. Se voc&ecirc; fez essa solicita&ccedil;&atilde;o, por favor, <br>
				confirme clicando no link abaixo:<br><br>	
				<a href="'.SIS_URL.'verify/'.$functions->fEncrypt($_REQUEST['email']).'">'.SIS_URL.'verify/'.$functions->fEncrypt($_REQUEST['email']).'</a><br><br>
				Atenciosamente,<br>		
				Equipe '.SIS_TITULO.'.<br><br>
				<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>		
			';
	
	$arrEmail = array('name' => $retRetrieve[0]['apelido'], 
					  'email' => $retRetrieve[0]['email'], 
					  'subject' => SIS_TITULO.' - Recuperar Senha', 
					  'message' => $message);
	
	if ($email->fSendEmailToPerson($arrEmail))
	{
		$retJson = json_encode(array("ret" => true, "msg" => null, "url" => null));
		
	}else{
		$retJson = json_encode(array("ret" => false, "msg" => 'Falha ao enviar o email. Por favor, tente novamente mais tarde!', "url" => null));
	}
	
}else{
	
	$retJson = json_encode(array("ret" => false, "msg" => 'E-mail inexistente no cadastro. Por favor, informe o email cadastrado e tente novamente!'));
}

echo $retJson;