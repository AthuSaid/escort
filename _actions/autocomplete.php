<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

$_REQUEST = $functions->fSanitizeRequest($_POST);

//$retAC = $functions->fAutocompleteSearch($_REQUEST['term']);
			
$retJson = json_encode(array("id" => "triboni", "label" => "daniel", "value" => "Deuzinha"));

echo $retJson;