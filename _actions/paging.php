<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

echo $functions->fProcessPaging($_SESSION['sSearchPagingType']);