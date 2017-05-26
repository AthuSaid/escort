<?php 
header("Content-type: text/css");

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$functions = new functions();

$retBanner = $functions->fQueryFeaturedModels($functions->genderPrefer, 1, 1);

if (count($retBanner) > 0)
{
	if ($retBanner[0]['vencimento'] > 0)
	{
		echo '.home{
					background: url('.SIS_URL.'images/persons/'.$retBanner[0]['person'].'/'.$retBanner[0]['cover'].') no-repeat top center; height:649px;
				}';		
	}
}
?>