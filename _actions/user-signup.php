<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

$email = new email();

$_REQUEST = $functions->fSanitizeRequest($_POST);

# Check if User is logged to update signup
if($_SESSION['sUserLogged'] && isset($_SESSION['sUserID']))
{	
	# Update user avatar file if true
	if ($_FILES)
	{
		if ($FILES = $functions->fUploadFiles($_FILES, "../images/users/".$_REQUEST['url']."/"))
		{
			# Update User if success
			if($functions->fUpdateCurrentUser($_REQUEST, $FILES))
				$retJson = json_encode(array("ret" => true, "msg" => null, "url" => "profile"));
			else
				$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao atualizar seu cadastro!'));	
		}else{
		
			$retJson = json_encode(array("ret" => false, "msg" => $functions->funcMsg));
		}
			
	}else{
		
		# Update User if success
		if($functions->fUpdateCurrentUser($_REQUEST, $FILES))
			$retJson = json_encode(array("ret" => true, "msg" => null, "url" => "profile"));
		else
			$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao atualizar seu cadastro!'));
	}
	
}else{
	
	# not pre-signup
	if ($_GET['mtd'] != 'pre')
	{
		# Check if Person AKA Already exists
		if ($functions->fGetUserAka($_REQUEST['apelido']))
		{
			# Check if is a valid Email
			if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) !== false)
			{
				# Check if User Email Already exists
				if($functions->fGetUserEmail($_REQUEST['email']))
				{							
					# Update user avatar file if success 
						if ($FILES = $functions->fUploadFiles($_FILES, "../images/users/".$_REQUEST['url']."/"))
						{
							# Save new User if success
							if($functions->fSaveNewUser($_REQUEST, $FILES))
							{
								$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
												Ol&aacute; '.$functions->fReduceName($_REQUEST['apelido']).',<br><br>
												Seu cadastro no '.SIS_TITULO.' foi criado com sucesso!<br>
												Caso deseje alterar algum dado em seu perfil, clique no link abaixo:<br><br>
												<a href="'.SIS_URL.'profile">'.SIS_URL.'profile</a><br><br>
												Atenciosamente,<br>
												Equipe '.SIS_TITULO.'.<br><br>
												<strong>Este email foi enviado automaticamente, favor n&atilde;o responder!</strong></html>
											';
																
								$arrEmail = array('aka' => $_REQUEST['apelido'],
												  'email' => $_REQUEST['email'],
												  'subject' => SIS_TITULO.' - Novo Cadastro',
												  'message' => $message);
								
								//$email->fSendEmailToUser($arrEmail);
								
								$retJson = json_encode(array("ret" => true, "msg" => null, "url" => "payment"));
								
							}else
								$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao salvar seu cadastro'));
							
						}else{
							
							$retJson = json_encode(array("ret" => false, "msg" => $functions->funcMsg));							
						}
										
					
					
				}else{
					
					$retJson = json_encode(array("ret" => false, "field" => "email", "msg" => 'E-mail j&aacute; existente'));
				}
				
			}else{
				
				$retJson = json_encode(array("ret" => false, "field" => "email", "msg" => 'Email incorreto'));
			}
			
		}else{
			
			$retJson = json_encode(array("ret" => false, "field" => "apelido", "msg" => $_REQUEST['apelido'].' apelido j&aacute; existente'));
		}
		
	}else{
		
		if ($functions->fGetUserAka($_REQUEST['apelido']))
		{
			# Check if is a valid Email
			if (filter_var($_REQUEST['n-eml'], FILTER_VALIDATE_EMAIL) !== false)
			{
				# Check if User Email Already exists
				if($functions->fGetUserEmail($_REQUEST['n-eml']))
				{
					$_SESSION['sUserPreAka'] = $_REQUEST['apelido'];
					$_SESSION['sUserPreEml'] = $_REQUEST['n-eml'];
					$retJson = json_encode(array("ret" => true, "msg" => null));
					
				}else{
					
					$retJson = json_encode(array("ret" => false, "field" => "n-eml", "msg" => 'E-mail j&aacute; existente'));					
				}
				
			} else{
				
				$retJson = json_encode(array("ret" => false, "field" => "n-eml", "msg" => 'E-mail incorreto'));				
			}
			
		}else{
			
			$retJson = json_encode(array("ret" => false, "field" => "apelido", "msg" => $_REQUEST['apelido'].' apelido j&aacute; existente'));
		}
		
	}
}

echo $retJson;