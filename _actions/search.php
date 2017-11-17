<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

$_REQUEST = $functions->fSanitizeRequest($_POST);

$_SESSION['sSearchCriteria'] = $_REQUEST['criteria'];

$_SESSION['sSearchResults'] = '';

if ($functions->fGlobalSearch($_SESSION['sSearchCriteria']))
{			
	$retJson = json_encode(array("ret" => true));

}else{
	
	$retJson = json_encode(array("ret" => false, "msg" => 'Nenhum resultado encontrado. Tente realizar nova busca!'));
}

echo $retJson;