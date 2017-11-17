<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$query = new queries();

$query->fStopChat($_SESSION['sPersonID']);

$retJson = json_encode(array("ret" => true));

echo $retJson;

?>