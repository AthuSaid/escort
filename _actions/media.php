<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

session_start2();

$functions = new functions();

$hashVideo = $_POST['hash'];

	if (isset($_FILES["video-blob"])) 
	{		
		$uploadDirectory = $_SERVER["DOCUMENT_ROOT"].'/images/persons/'.$_SESSION['sPersonUrl'].'/video-'.$hashVideo.'.webm';
		
		if (!move_uploaded_file($_FILES["video-blob"]["tmp_name"], $uploadDirectory)) {
			return false;
		}
				
		$arrVideo = array('apid' => $_POST['apid'],
				'tipo' => 2,
				'ativo' => 1,
				'titulo' => null,
				'descricao' => null,
				'imagemurl' => 'video-'.$hashVideo.'.webm',
				'local' => 3,
				'hash' => $hashVideo);
		$functions->fQuerySavePhoto($arrVideo, true);		
		
		return true;	
	}

	if (isset($_POST["thumb"])) 
	{		
		if (!preg_match('/data:([^;]*);base64,(.*)/', $_POST['data'], $matches))
			return false;
	
		$data = $matches[2];
		$data = str_replace(' ','+',$data);
		$data = base64_decode($data);
		
		$urlImgThumb = $_SERVER["DOCUMENT_ROOT"].'/images/persons/'.$_SESSION['sPersonUrl'].'/thumb-'.$hashVideo.'.jpeg';
		
		file_put_contents($urlImgThumb, $data);
	
		$image = new resizeimage($urlImgThumb);	
		$image->resizeTo(372, 280, 'exact');
		$image->saveImage($urlImgThumb, SIS_URL.'assets/images/logos/ltv.png');		 
		
		$arrVideo = array('apid' => $_POST['apid'],
				'tipo' => 1,
				'ativo' => 1,
				'titulo' => null,
				'descricao' => null,
				'imagemurl' => 'thumb-'.$hashVideo.'.jpeg',
				'local' => 3,
				'hash' => $hashVideo);
		$functions->fQuerySavePhoto($arrVideo, true);
		
		return true;
	}
