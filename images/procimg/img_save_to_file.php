<?php
session_start();

	require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";
    
    $functions = new functions();  
    
	$personAlias = $_POST['personAlias'];
	$apid 		 = $_POST['apid'];
	$imageType 	 = $_POST['imageType'];
	$imageW 	 = $_POST['thumbWidth'];
	$imageH 	 = $_POST['thumbHeight'];
	$next 	 	 = $_POST['next'];
	
	$hashPhoto = $functions->fRandomPassword(12);

    $imagePath = "../persons/".$personAlias."/";

	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["img"]["name"]);
	$extension = end($temp);
	
	if (!file_exists($imagePath)) {
		mkdir($imagePath, 0777, true);
	}
	
	if(!is_writable($imagePath)){
		$response = array("status" => 'error', "message" => 'Falha ao salvar sua imagem. Tente novamente!');
		print json_encode($response);
		return;
	}
	
	if (in_array($extension, $allowedExts))
	{
		if ($_FILES["img"]["error"] > 0)
		{
			 $response = array("status" => 'error', "message" => 'ERROR Return Code: '. $_FILES["img"]["error"]);
			 
		}else{
			
		      $filename = $_FILES["img"]["tmp_name"];
		      
			  list($width, $height) = getimagesize($filename);
			  
			  if ($imageType == 1 && ($width > 600 || $width < $imageW || $height > 900 || $height < $imageH))
			  {
			  	$response = array("status" => 'error', "message" => "Medidas da Foto Principal devem serem no maximo 600x900 pixels e no minimo {$imageW}x{$imageH} pixels!");
			  	print json_encode($response);
			  	return;
			  }
			  if ($imageType == 2 && ($width > 1024 || $width < $imageW || $height > 768 || $height < $imageH))
			  {
			  	$response = array("status" => 'error', "message" => "Medidas da Galeria de Fotos devem serem no maximo 800 x 600 pixels e no minimo {$imageW}x{$imageH} pixels!");
			  	print json_encode($response);
			  	return;
			  }
			  if ($imageType == 4 && ($width > 1920))
			  {
			  	$response = array("status" => 'error', "message" => "Medidas da Galeria de Fotos devem serem no minimo {$imageW}x{$imageH} pixels!");
			  	print json_encode($response);
			  	return;
			  }
			  
			  $largeFileName = "large-".$hashPhoto.".".$extension;
			  $thumbFileName = "thumb-".$hashPhoto.".".$extension;
		
			  move_uploaded_file($filename,  $imagePath . $largeFileName);
		
			  $arrPhoto = array('apid' => $apid, 'tipo' => 1, 'imagemurl' => $largeFileName, 'local' => $imageType, 'hash' => $hashPhoto);
			  
			  $functions->fQuerySavePhoto($arrPhoto);
			  
		  	  $image = new resizeimage($imagePath . $largeFileName);
		  	  $image->resizeTo($imageW, $imageH, 'exact');
		  	  $image->saveImage($imagePath . $thumbFileName, SIS_URL.'assets/img/logo-upload.png');		  
			  
		  	  $arrPhoto = array('apid' => $apid, 'tipo' => 2, 'imagemurl' => $thumbFileName, 'local' => $imageType, 'hash' => $hashPhoto);
		  	  
		  	  $functions->fQuerySavePhoto($arrPhoto);
		  	  
			  $response = array(
				"status" => 'success',
				"urlThumb" =>  SIS_URL."images/persons/".$personAlias."/".$thumbFileName,
			  	"urlLarge" =>  SIS_URL."images/persons/".$personAlias."/".$largeFileName,
				"width" => $image->resizeWidth,
				"height" => $image->resizeHeight,
			  	"personAlias" => $personAlias,
			  	"apid" => $apid,
			  	"hash" => $hashPhoto,
			  	"next" => $next
			  );		  
		}
		
	  }else{
	  	
	   $response = array("status" => 'error', "message" => "Imagem  {$file["name"]} com formato incorreto. Utilize apenas imagens nos formatos (gif, jpeg, jpg ou png)!");
	  }
	  
	  print json_encode($response);

?>
