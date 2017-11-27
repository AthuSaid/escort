<?php 
header("Content-type: text/css");

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$functions = new functions();

$retBanner = $functions->fQueryCoverModels();

if (count($retBanner) > 0)
{
	for ($x = 0; $x < count($retBanner); $x++)
	{	
		$imgCover = ($retBanner[$x]['cover'] == '0' ? SIS_URL.'assets/img/no-cover-'.$retBanner[$x]['sexo'].'.jpg' : SIS_URL.'images/persons/'.$retBanner[$x]['person'].'/'.$retBanner[$x]['cover']);
		echo '.style-'.$retBanner[$x]['person'].$retBanner[$x]['ad'].'{
					background: url('.$imgCover.') no-repeat top center; height:649px;
				} ';				
	}
}
?>