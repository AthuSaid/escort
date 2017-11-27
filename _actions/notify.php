<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

switch ($_GET['mtd'])
{
	case "nav":
	
		$retNav = $functions->fGetNotificationNavMenu();
		if ($retNav['counter'] > 0)
			echo json_encode(array("ret" => true, "counter" => $retNav['counter'], "html" => $retNav['html']));
		else 
			echo json_encode(array("ret" => false, "counter" => null, "html" => null));
	
	break;
	
	case "pay":
		
		$retPay = $functions->fGetPersonPaymentChecked();
		if ($retPay['return'] > 0)
			echo json_encode(array("ret" => true));
		else
			echo json_encode(array("ret" => false));
		
	break;	
	
	case "ntf":
		
		$retCounter = $functions->fGetNotificationCounters();
		echo json_encode(array("ret" => true, "pc" => $retCounter['pc'], "mo" => $retCounter['mo'], "pr" => $retCounter['pr'], "ac" => $retCounter['ac']));
		
	break;	
	
	case "read":
	
		$retCounter = $functions->fUpdateNotifications2Read();
		echo json_encode(array("ret" => true));
	
	break;
}

	