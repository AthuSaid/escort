<?php

switch ($_REQUEST['mtd'])
{
	case "ntf":
		
		echo json_encode(array("ret" => true, "pc" => 10, "mo" => 50, "pr" => 0, "em" => 84));
		
	break;	
}

	