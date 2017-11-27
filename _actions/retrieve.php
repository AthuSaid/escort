<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$auth = new auth();

$_REQUEST = $auth->fSanitizeRequest($_POST);

switch ($_REQUEST['type'])
{
	case 1:
		
		if ($auth->fUpdatePersonCredentials($_REQUEST['email'], $_REQUEST['senha']))
		{
			if ($auth->fAuthenticatePerson($_REQUEST['email'], $_REQUEST['senha']))
			{
				$retJson = json_encode(array("ret" => true, "msg" => 'Sua senha foi alterada com sucesso!', "url" => 1));
		
			}else{
		
				$retJson = json_encode(array("ret" => false, "msg" => 'Credenciais de acesso incorretas. Tente novamente!'));
			}
		
		}else{
		
			$retJson = json_encode(array("ret" => false, "msg" => 'Falha ao alterar sua senha. Tente novamente mais tarde!'));
		}
		
	break;
	
	case 2:
		
		if ($auth->fUpdateUserCredentials($_REQUEST['email'], $_REQUEST['senha']))
		{
			if ($auth->fAuthenticateUser($_REQUEST['email'], $_REQUEST['senha']))
			{
				$retJson = json_encode(array("ret" => true, "msg" => 'Sua senha foi alterada com sucesso!', "url" => 2));
		
			}else{
		
				$retJson = json_encode(array("ret" => false, "msg" => 'Credenciais de acesso incorretas. Tente novamente!'));
			}
		
		}else{
		
			$retJson = json_encode(array("ret" => false, "msg" => 'Falha ao alterar sua senha. Tente novamente mais tarde!'));
		}
		
	break;	
}

echo $retJson;