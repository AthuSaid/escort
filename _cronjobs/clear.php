<?php

/**
 * CronJob - Clear unused person data After 24H
 * @author Libidinous Development Team
 * @access Execute all days at midnight
 * @tutorial TODO
*/
ob_start();

set_time_limit(0);

error_reporting(E_ALL);

date_default_timezone_set('America/Sao_Paulo');

//if (!isset($_SERVER['argc']))
//   die("<div style='font-family: Tahoma; color: #CC0000; font-weight: bold'>ACESSO NEGADO AO RECURSO!</div>");    

include_once $_SERVER['DOCUMENT_ROOT']."/_includes/_config/config.ini.php";

$query = new queries();

$retPerson = $query->fGetPersonsLoggedAfter24H();
 							
if (count($retPerson) > 0)
{
	for ($x = 0; $x < count($retPerson); $x++)
	{
		$query->fUpdatePerson2Logoff($retPerson[$x]['pesid']);
	}
}