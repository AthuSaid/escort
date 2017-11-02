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
				$myArray[$x] = array("id" => $x, "label" => $retAC[$x]['apelido'], "value" => 'person/'.$retAC[$x]['person'].'/'.$retAC[$x]['ad']);
			}
		}
		
		$retJson = json_encode($myArray);							
	}
}else{
	$retJson = json_encode(array( 0 => array("id" => "0", "label" => "Ops... Nenhuma pessoa encontrada!", "value" => "")));
}

echo $retJson;