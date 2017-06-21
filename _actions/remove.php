<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

if ($functions->fRemovePerson($_SESSION['sPersonID']))
{	
	$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
				Ol&aacute; '.$functions->fReduceName($_SESSION['sPersonAka']).',<br><br>
				Recebemos uma solicita&ccedil;&atilde;o para a remo&ccedil;&atilde;o de sua conta! <br>
				Sua conta ser&aacute; removida do '.SIS_TITULO.' e seu perfil n&atilde;o estar&aacute; mais vis&iacute;vel no site!<br>
				Caso deseje voltar a utilizar o site, basta efetuar login novamente com seus dados de acesso que a conta ser&aacute;<br>
				automaticamente reintegrada, de acordo com o seu &uacute;ltimo plano contratado.<br><br>				
				Atenciosamente,<br>
				Equipe '.SIS_TITULO.'.<br><br>
				<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>
			';
	
	$arrEmail = array('name' => $_SESSION['sPersonAka'],
						'email' => $_SESSION['sPersonEmail'],
						'subject' => SIS_TITULO.' - Sua conta foi removida!',
						'message' => $message);
	
	if ($email->fSendEmailToPerson($arrEmail))
	{
		$retJson = json_encode(array("ret" => true, "msg" => 'Seu perfil foi removido com sucesso!', "url" => null));
	}
	
}else{
	
	$retJson = json_encode(array("ret" => false, "msg" => 'Falha ao remover seu perfil. Tente novamente mais tarde!'));
}

echo $retJson;