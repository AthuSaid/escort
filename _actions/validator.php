<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$functions = new functions();

if (isset($_GET['apelido']))
{
	if ($functions->fGetAka($_GET['apelido']))
		http_response_code(200);
	else
		http_response_code(500);
}

if (isset($_GET['cpf']))
{
	if($functions->fcheckCPF($_GET['cpf']))
		http_response_code(200);
	else	
		http_response_code(500);
}

if (isset($_GET['email']))
{
	if (filter_var($_GET['email'], FILTER_VALIDATE_EMAIL) !== false)
		http_response_code(200);
	else
		http_response_code(500);
}
