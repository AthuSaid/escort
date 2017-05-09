<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$auth = new auth();

$_REQUEST = $auth->fSanitizeRequest($_POST);

if ($auth->fAuthenticatePerson($_REQUEST['eml'], $_REQUEST['pwd']))
{
	$url = ($_REQUEST['page'] != '' ? $_REQUEST['page'] : 'dashboard');
	$retJson = json_encode(array("ret" => true, "msg" => null, "url" => $url));
}else{
	
	$retJson = json_encode(array("ret" => false, "field" => "login", "msg" => 'Credenciais de acesso incorretas. Tente novamente!'));
}

echo $retJson;