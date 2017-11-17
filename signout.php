<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
	
	session_start2();
    
    $auth = new auth();      
    
    if (isset($_SESSION['sPersonID'])) 
    	$auth->fLogoutPerson();
    else
    	$auth->fLogoutUser();
    
    header('Location: '.SIS_URL.'home');
    exit;           
?>