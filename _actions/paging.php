<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$functions = new functions();

echo $functions->fProcessPaging($_SESSION['sSearchPagingType']);