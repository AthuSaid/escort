<?php
/**
* Programa para executar o daemon
*/
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$chat = new chat();

$chat->fOpenProccess();

?>