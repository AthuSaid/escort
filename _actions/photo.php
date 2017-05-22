<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

$functions = new functions();

$email = new email();

$_REQUEST = $functions->fSanitizeRequest($_GET);

# Check if Person is logged to remove photos or videos
if($_SESSION['sPersonLogged'] && isset($_SESSION['sPersonID']) && isset($_REQUEST['hash']))
{
	if ($_REQUEST['mtd'] == 'delete')
	{
		# Remove Ad if success
		if($functions->fRemovePhoto($_REQUEST['hash']))
		{
			$retJson = json_encode(array("ret" => true, "msg" => null));
			
		}else
			$retJson = json_encode(array("ret" => false, "msg" => 'Erro ao remover a midia!'));

	}else{
		
		if (isset($_FILES["video-blob"])) {
			$fileName = $_POST["video-filename"];
			
			$uploadDirectory = SIS_URL.'images/persons/'.$_SESSION['sPersonUrl'].'/'.$fileName;
			
			if (!move_uploaded_file($_FILES["video-blob"]["tmp_name"], $uploadDirectory)) {
				echo(" problem moving uploaded file");
			}
			
			return true;
		}
		
		//file_put_contents($_SERVER["DOCUMENT_ROOT"]."/images/persons/".$_SESSION['sPersonUrl']."/video_".$_REQUEST['hash'].".webm", $file);		
		//return true;
	}	
	
}

echo $retJson;