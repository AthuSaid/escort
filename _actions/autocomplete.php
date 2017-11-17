<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

$_REQUEST = $functions->fSanitizeRequest($_GET);

if ($retAC = $functions->fQueryGlobalSearch($_REQUEST['term'], -1))
{
	if (count($retAC) > 0)
	{
		$retJson = null; 
		
		$myArray = null;
						
		for ($x = 0; $x < count($retAC); $x++)
		{
			if ($retAC[$x]['vencimento'] > 0)
			{
				$myArray[$x] = array("id" => $x, "label" => $retAC[$x]['apelido'].', '.strtolower($functions->fGetGenderPerson($retAC[$x]['sexo'])).', '.$functions->fGetAge($retAC[$x]['nascimento']).' - '.($retAC[$x]['whatsapp'] != '' ? $retAC[$x]['whatsapp'] : $retAC[$x]['tel1']), "value" => 'person/'.$retAC[$x]['person'].'/'.$retAC[$x]['ad']);
			}
		}
		
		$retJson = json_encode($myArray);							
	
	}
	
}else{
	
	if (strtolower($_REQUEST['term']) == 'perto' || 
		strtolower($_REQUEST['term']) == 'perto de' || 
		strtolower($_REQUEST['term']) == 'perto de mim')
	{
		$retJson = null;
		
		$myArray = null;
		
		$myArray[0] = array("id" => 0, "label" => "Perto de mim", "value" => "persons/close");
		
		$retJson = json_encode($myArray);
		
	}elseif (strtolower($_REQUEST['term']) == 'pessoas' ||
			 strtolower($_REQUEST['term']) == 'pessoas online' ||
			 strtolower($_REQUEST['term']) == 'online')
	{
		$retJson = null;
		
		$myArray = null;
		
		$myArray[0] = array("id" => 0, "label" => "Pessoas Online", "value" => "persons/online");
		
		$retJson = json_encode($myArray);	
		
	}else{
		
		$retJson = json_encode(array( 0 => array("id" => "0", "label" => "Ops... Nenhuma pessoa encontrada!", "value" => "")));
	}
}

echo $retJson;