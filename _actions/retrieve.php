<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$auth = new auth();

$_REQUEST = $auth->fSanitizeRequest($_POST);

if ($auth->fUpdatePersonCredentials($_REQUEST['email'], $_REQUEST['senha']))
{
	if ($auth->fAuthenticatePerson($_REQUEST['email'], $_REQUEST['senha']))
	{		
		$retJson = json_encode(array("ret" => true, "msg" => 'Sua senha foi alterada com sucesso!', "url" => null));
		
	}else{
	
		$retJson = json_encode(array("ret" => false, "msg" => 'Credenciais de acesso incorretas. Tente novamente!'));
	}
	
}else{
	
	$retJson = json_encode(array("ret" => false, "msg" => 'Falha ao alterar sua senha. Tente novamente mais tarde!'));
}

echo $retJson;