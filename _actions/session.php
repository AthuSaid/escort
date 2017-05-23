<?php
 
/**
 * Action to generate PAGSEGURO token
 * @author Libidinous Development Team
 */

error_reporting(E_ERROR & ~E_NOTICE);

date_default_timezone_set('America/Sao_Paulo');

include_once $_SERVER['DOCUMENT_ROOT']."/_includes/PagSeguroLibrary/PagSeguroLibrary.php";

try {

	$credentials = PagSeguroConfig::getAccountCredentials();
	
	$sessionId = PagSeguroSessionService::getSession($credentials);
	
	echo json_encode(array("ret" => 1, "msg" => null, "session_id" => $sessionId));

} catch (PagSeguroServiceException $e) {
	
	echo json_encode(array("ret" => 0, "msg" => $e->getMessage(), "session_id" => null));	
}