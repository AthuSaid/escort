<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$functions = new functions();

$_REQUEST = $functions->fSanitizeRequest($_GET);

if (isset($_REQUEST['apelido']))
{
	if ($functions->fGetAka($_REQUEST['apelido']))
		http_response_code(200);
	else
		http_response_code(500);
}

if (isset($_REQUEST['cpf']))
{
	if($functions->fcheckCPF($_REQUEST['cpf']))
		http_response_code(200);
	else	
		http_response_code(500);
}

if (isset($_REQUEST['email']))
{
	if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) !== false)
		http_response_code(200);
	else
		http_response_code(500);
}
