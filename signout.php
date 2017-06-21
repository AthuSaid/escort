<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
	
	session_start2();
    
    $auth = new auth();      
    
    $auth->fLogoutPerson();
    		
    header('Location: '.SIS_URL.'home');
    exit;           
?>