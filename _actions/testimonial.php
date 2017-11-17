<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

$email = new email();

$_REQUEST = $functions->fSanitizeRequest($_POST);

# Check if Person is logged to update testimonial
if($_SESSION['sPersonLogged'] && isset($_SESSION['sPersonID']))
{
	if ($_REQUEST['method'] == 'delete')
	{
		# Remove Ad if success
		if($functions->fRemoveTestimonial($_REQUEST['tesid']))		
			$retJson = json_encode(array("ret" => true, "msg" => null));			
		else
			$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao remover seu depoimento!'));
			
	}elseif ($_REQUEST['method'] == 'update'){
		
		if($functions->fUpdateTestimonial($_REQUEST))									
			$retJson = json_encode(array("ret" => true, "msg" => null));
		else
			$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao atualizar seu depoimento!'));			
	}	
	
}elseif($_SESSION['sUserLogged']){
	
	if ($_REQUEST['method'] == 'delete')
	{
		# Remove Ad if success
		if($functions->fRemoveTestimonial($_REQUEST['tesid']))
			$retJson = json_encode(array("ret" => true, "msg" => null));
		else
			$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao remover seu depoimento!'));
					
	}else{
	
		if($functions->fAddTestimonial($_REQUEST))
			$retJson = json_encode(array("ret" => true, "msg" => null));
		else
			$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao salvar seu depoimento!'));
	}
}

echo $retJson;