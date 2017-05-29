<?php 
header("Content-type: text/css");

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$functions = new functions();

$retBanner = $functions->fQueryGalleryModels($functions->genderPrefer, $functions->servicePrefer);

if (count($retBanner) > 0)
{
	for ($x = 0; $x < count($retBanner); $x++)
	{
		if ($retBanner[$x]['vencimento'] > 0)
		{
			echo '.style-'.$retBanner[$x]['person'].$retBanner[$x]['ad'].'{
						background: url('.SIS_URL.'images/persons/'.$retBanner[$x]['person'].'/'.$retBanner[$x]['cover'].') no-repeat top center; height:649px;
					}';		
		}
	}
}
?>