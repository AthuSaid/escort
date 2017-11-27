<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

$email = new email();

$_REQUEST = $functions->fSanitizeRequest($_POST);

# Check if Person is logged to update signup
if($_SESSION['sPersonLogged'] && isset($_SESSION['sPersonID']))
{
	# Check if exists at least one phone number setted
	if(empty($_REQUEST['whatsapp']) && empty($_REQUEST['tel1']) && empty($_REQUEST['tel2']))
	{
		$retJson = json_encode(array("ret" => false, "field" => "tel", "msg" => 'Informe ao menos um Telefone de Contato!'));
			
	}else{
		
		# Update person documentation file if true
		if ($_FILES)
		{
			if ($FILES = $functions->fUploadFiles($_FILES, "../images/persons/".$_REQUEST['url']."/"))
			{
				# Update Person if upload success
				if($functions->fUpdateCurrentPerson($_REQUEST, $FILES))		
					$retJson = json_encode(array("ret" => true, "msg" => null, "url" => "dashboard"));
				else	
					$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao atualizar seu cadastro!'));	
			}else{
				
				$retJson = json_encode(array("ret" => false, "msg" => $functions->funcMsg));
			}
			
		}else{
			
			# Update Person if success
			if($functions->fUpdateCurrentPerson($_REQUEST, $FILES))
				$retJson = json_encode(array("ret" => true, "msg" => null, "url" => "dashboard"));
			else
				$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao atualizar seu cadastro!'));	
		}
	}
	
}else{
	
	# not pre-signup
	if ($_GET['mtd'] != 'pre')
	{
		# Check if Person AKA Already exists
		if ($functions->fGetAka($_REQUEST['apelido']) && filter_var($_REQUEST['apelido'], FILTER_VALIDATE_EMAIL) === false)
		{
			# Check if is a valid Email
			if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) !== false)
			{
				# Check if Person Email Already exists
				if($functions->fGetEmail($_REQUEST['email']))
				{		
					# Check if exists at least one phone number setted
					if(empty($_REQUEST['whatsapp']) && empty($_REQUEST['tel1']) && empty($_REQUEST['tel2']))
					{
						$retJson = json_encode(array("ret" => false, "field" => "tel", "msg" => 'Informe ao menos um Telefone de Contato!'));
						
					}else{
						
						# Update person documentation file if success 
						if ($FILES = $functions->fUploadFiles($_FILES, "../images/persons/".$_REQUEST['url']."/"))
						{
							# Save new Person if success
							if($functions->fSaveNewPerson($_REQUEST, $FILES))
							{
								$message = '<html><img src="'.SIS_URL.'assets/images/logos/libidinous-transp-black.png"><br><br>
												Ol&aacute; '.$functions->fReduceName($_REQUEST['apelido']).',<br><br>
												Seu cadastro no '.SIS_TITULO.' foi criado com sucesso!<br>
												Nossa equipe de moderadores est&aacute; avaliando a autenticidade de seu perfil e <br>
												no m&aacute;ximo de 2 horas, voc&ecirc; poder&aacute; cadastrar seus an&uacute;ncios! <br>
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
								
								$email->fSendEmailToPerson($arrEmail);
								
								$retJson = json_encode(array("ret" => true, "msg" => null, "url" => "payment"));
								
							}else
								$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao salvar seu cadastro'));
							
						}else{
								
							$retJson = json_encode(array("ret" => false, "msg" => $functions->funcMsg));
						}					
					}
					
				}else{
					
					$retJson = json_encode(array("ret" => false, "field" => "email", "msg" => 'E-mail ja existente'));
				}
				
			}else{
				
				$retJson = json_encode(array("ret" => false, "field" => "email", "msg" => 'Email incorreto'));
			}
			
		}else{
			
			$retJson = json_encode(array("ret" => false, "field" => "apelido", "msg" => 'Nome Ficticio ja existente'));
		}
		
	}else{
		
		if ($functions->fGetAka($_REQUEST['apelido']) && filter_var($_REQUEST['apelido'], FILTER_VALIDATE_EMAIL) === false)
		{
			# Check if is a valid Email
			if (filter_var($_REQUEST['n-eml'], FILTER_VALIDATE_EMAIL) !== false)
			{
				# Check if Person Email Already exists
				if($functions->fGetEmail($_REQUEST['n-eml']))
				{
					$_SESSION['sPersonPreAka'] = $_REQUEST['apelido'];
					$_SESSION['sPersonPreEml'] = $_REQUEST['n-eml'];
					$retJson = json_encode(array("ret" => true, "msg" => null));
					
				}else{
					
					$retJson = json_encode(array("ret" => false, "field" => "n-eml", "msg" => 'E-mail ja existente'));					
				}
				
			} else{
				
				$retJson = json_encode(array("ret" => false, "field" => "n-eml", "msg" => 'E-mail incorreto'));				
			}
			
		}else{
			
			$retJson = json_encode(array("ret" => false, "field" => "apelido", "msg" => 'Nome Ficticio ja existente'));
		}
		
	}
}

echo $retJson;