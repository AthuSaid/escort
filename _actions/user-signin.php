<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$auth = new auth();

$email = new email();

$_REQUEST = $auth->fSanitizeRequest($_POST);

if ($auth->fAuthenticateUser($_REQUEST['eml'], $_REQUEST['pwd']))
{
	/*$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
				Ol&aacute; '.$auth->fReduceName($_SESSION['sPersonAka']).',<br><br>
				Ficamos muito felizes com o seu retorno ao '.SIS_TITULO.'! <br>
				Seus dados foram presenvados em nossa base, continue usufruindo do site;<br>
				o tempo que quiser!<br><br>
				Atenciosamente,<br>
				Equipe '.SIS_TITULO.'.<br><br>
				<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>
			';
	
	$arrEmail = array('name' => $_SESSION['sPersonAka'],
					  'email' => $_SESSION['sPersonEmail'],
					  'subject' => SIS_TITULO.' - Bem vind'.$auth->fReference($_SESSION['sPersonGender']).' de volta',
					  'message' => $message);
	
	if($_SESSION['sPersonComeBack'] == 1)
		$email->fSendEmailToUser($arrEmail);*/
	
	$url = ($_REQUEST['page'] != '' ? $_REQUEST['page'] : 'profile');
	
	$retJson = json_encode(array("ret" => true, "msg" => null, "url" => $url));
	
}else{
	
	$retJson = json_encode(array("ret" => false, "field" => "login", "msg" => 'Credenciais de acesso incorretas. Tente novamente!'));
}

echo $retJson;