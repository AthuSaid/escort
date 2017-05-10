<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$auth = new auth();

$email = new email();

$_REQUEST = $auth->fSanitizeRequest($_POST);

if ($auth->fAuthenticatePerson($_REQUEST['eml'], $_REQUEST['pwd']))
{
	$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
				Ol&aacute; '.$auth->fReduceName($_SESSION['sPersonAka']).',<br><br>
				Ficamos muito felizes com o seu retorno ao '.SIS_TITULO.'! <br>
				Seus dados foram presenvados em nossa base, e caso possua algum plano vigente, voc&ecirc;<br>
				poder&aacute; utiliz&aacute;-lo a qualquer momento, at&eacute; a data de vencimento!<br><br>
				Atenciosamente,<br>
				Equipe '.SIS_TITULO.'.<br><br>
				<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>
			';
	
	$arrEmail = array('name' => $_SESSION['sPersonAka'],
					  'email' => $_SESSION['sPersonEmail'],
					  'subject' => SIS_TITULO.' - Bem vind'.$auth->fReference($_SESSION['sPersonGender']).' de volta',
					  'message' => $message);
	
	if($_SESSION['sPersonComeBack'] == 1)
		$email->fSendEmailToPerson($arrEmail);
	
	$url = ($_REQUEST['page'] != '' ? $_REQUEST['page'] : 'dashboard');
	
	$retJson = json_encode(array("ret" => true, "msg" => null, "url" => $url));
	
}else{
	
	$retJson = json_encode(array("ret" => false, "field" => "login", "msg" => 'Credenciais de acesso incorretas. Tente novamente!'));
}

echo $retJson;