<?php
    session_start();

    require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    $auth = new auth();      
    
    $auth->fLogoutPerson();
    		
    header('Location: '.SIS_URL.'home');
    exit;           
?>