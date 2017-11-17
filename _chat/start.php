<?php
/**
* Programa para executar o daemon
*/
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$query = new queries();

$query->fStartChat($_SESSION['sPersonID']);

$retJson = json_encode(array("ret" => true));

echo $retJson;

?>