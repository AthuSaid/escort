<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_config/config.ini.php";

error_reporting(E_ALL);

class CropAvatar {
	
  private $src;
  private $data;
  private $dst;
  private $httpDst;
  private $type;
  private $extension;
  private $is_source_webcam = false;
  private $msg;

  function __construct($src, $data, $url, $apid, $ativo, $titulo, $descricao, $imgtype, $file) {
  	
  	$hashPhoto = $this->fRandomHashPhoto(12);
  	
  	if (substr($src, 0, 5) == 'data:')
  	{
  		$temp_file = 'temp/tmp_'.$hashPhoto.'.jpeg';
	  	$dataImg = $src;	  	
		list($type, $dataImg) = explode(';', $dataImg);
		list(, $dataImg)      = explode(',', $dataImg);
		$dataImg = base64_decode($dataImg);	
		file_put_contents($temp_file, $dataImg);
		$file['name'] = $temp_file;
		$file['tmp_name'] = $_SERVER["DOCUMENT_ROOT"]."/images/procimg/".$temp_file;
		$file['error'] = UPLOAD_ERR_OK;
		$file['size'] = filesize($temp_file);
		$file['type'] = exif_imagetype($temp_file);
		$this->is_source_webcam = true;
		$src = null;
		$imagePath = $_SERVER["DOCUMENT_ROOT"]."/images/persons/".$url;
		$this -> dst = $imagePath.'/'. $hashPhoto . '.png';
  	}else{
  		$this -> setSrc($url, $src, $hashPhoto, $apid, $ativo, $titulo, $descricao, $imgtype);
  	}
  	
  	$this -> setData($data);
    $this -> setFile($url, $hashPhoto, $apid, $ativo, $titulo, $descricao, $file, $imgtype);
    $this -> crop($this -> src, $this -> dst, $this -> data, $imgtype);   
    
    if ($this->is_source_webcam)
    	unlink($_SERVER["DOCUMENT_ROOT"]."/images/procimg/".$temp_file);
  }
  
  public function fRandomHashPhoto($numsize){
  	$words = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0,1,2,3,4,5,6,7,8,9";
  	$array = explode(",", $words);
  	shuffle($array);
  	$pwd = implode($array, "");
  	return substr(strtolower($pwd), 0, $numsize);
  }

  private function setSrc($url, $src, $hashPhoto, $apid, $ativo, $titulo, $descricao, $imgtype) {
    if (!empty($src)) {
      $type = exif_imagetype($src);

      if ($type) { 
      	$imagePath = $_SERVER["DOCUMENT_ROOT"]."/images/persons/".$url;
        $this -> src = $src;
        $this -> type = $type;
        $this -> extension = image_type_to_extension($type);
        $this -> setDst($url, $hashPhoto, $imagePath, $apid, $ativo, $titulo, $descricao, $imgtype);
      }
    }
  }

  private function setData($data) {
    if (!empty($data)) {
      $this -> data = json_decode(stripslashes($data));
    }
  }

  private function setFile($url, $hashPhoto, $apid, $ativo, $titulo, $descricao, $file, $imgtype) {
    $errorCode = $file['error'];

    if ($errorCode === UPLOAD_ERR_OK) {
      $type = exif_imagetype($file['tmp_name']);

      $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
      
      
      if ($type) {
        $extension = image_type_to_extension($type);
        
        $imagePath = $_SERVER["DOCUMENT_ROOT"]."/images/persons/".$url;
        
        if (!file_exists($imagePath)) {
        	mkdir($imagePath, 0777, true);
        }
        
        
        
        $src = $imagePath.'/'. $hashPhoto . '.original' . $extension;

        if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_JPEG || $type == IMAGETYPE_PNG) {

          if (file_exists($src)) {
            unlink($src);
          }

          if (!$this->is_source_webcam)
          	$result = move_uploaded_file($file['tmp_name'], $src);
          else
	          $result = copy($file['tmp_name'], $src);

          if ($result) {
          	
          	$this -> src = $src;
            $this -> type = $type;
            $this -> extension = $extension;
            $this -> setDst($url, $hashPhoto, $imagePath, $apid, $ativo, $titulo, $descricao, $imgtype);
          } else {
             $this -> msg = 'Failed to save file';
          }
        } else {
          $this -> msg = 'Please upload image with the following types: JPG, PNG, GIF';
        }
      } else {
        $this -> msg = 'Please upload image file';
      }
    } else {
      $this -> msg = $this -> codeToMessage($errorCode);
    }
  }

  private function setDst($url, $hashPhoto, $imagePath, $apid, $ativo, $titulo, $descricao, $imgtype) {
    
  	$query = new queries();
  	
  	$this -> dst = $imagePath.'/'. $hashPhoto . '.png';
    $this -> httpDst = SIS_URL.'images/persons/'.$url.'/'. $hashPhoto . '.png';
    
    $local = ($imgtype == 'portrait' ? 1 : ($imgtype == 'landscape' ? 4 : 2));
    $ativ = ($imgtype == 'portrait' || $imgtype == 'landscape' ? 1 : $ativo);
    
    $arrPhoto = array('apid' => $apid, 
    				  'tipo' => 1, 
    				  'ativo' => $ativ,
      		          'titulo' => $titulo,
    		          'descricao' => $descricao,
    				  'imagemurl' => $hashPhoto . '.png', 
    		          'local' => $local, 
    		          'hash' => $hashPhoto);    
    $query->fQuerySavePhoto($arrPhoto, true);
    
    $arrPhoto = array('apid' => $apid, 
    				  'tipo' => 2, 
      		          'ativo' => $ativ,
    		          'titulo' => $titulo,
    		          'descricao' => $descricao,
    				  'imagemurl' => $hashPhoto . '.original'.$this->extension, 
    				  'local' => $local, 
    		          'hash' => $hashPhoto);
    $query->fQuerySavePhoto($arrPhoto);
  }

  private function crop($src, $dst, $data, $imgtype) {
  	
  	if (!empty($src) && !empty($dst) && !empty($data)) {
      switch ($this -> type) {
        case IMAGETYPE_GIF:
          $src_img = imagecreatefromgif($src);
          break;

        case IMAGETYPE_JPEG:
          $src_img = imagecreatefromjpeg($src);
          break;

        case IMAGETYPE_PNG:
          $src_img = imagecreatefrompng($src);
          break;
      }

      if (!$src_img) {
        $this -> msg = "Failed to read the image file";
        return;
      }

      $size = getimagesize($src);
      $size_w = $size[0]; // natural width
      $size_h = $size[1]; // natural height

      $src_img_w = $size_w;
      $src_img_h = $size_h;

      $degrees = $data -> rotate;

      // Rotate the source image
      if (is_numeric($degrees) && $degrees != 0) {
        // PHP's degrees is opposite to CSS's degrees
        $new_img = imagerotate( $src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127) );

        imagedestroy($src_img);
        $src_img = $new_img;

        $deg = abs($degrees) % 180;
        $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

        $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
        $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

        // Fix rotated image miss 1px issue when degrees < 0
        $src_img_w -= 1;
        $src_img_h -= 1;
      }

      $tmp_img_w = $data -> width;
      $tmp_img_h = $data -> height;
      
      if ($imgtype == 'portrait'){
	      $dst_img_w = 555;
	      $dst_img_h = 833;
      }elseif ($imgtype == 'landscape'){
	      $dst_img_w = 1920;
	      $dst_img_h = 649;
      }else{
      	  $dst_img_w = 370;
      	  $dst_img_h = 278;
      }

      $src_x = $data -> x;
      $src_y = $data -> y;

      if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
        $src_x = $src_w = $dst_x = $dst_w = 0;
      } else if ($src_x <= 0) {
        $dst_x = -$src_x;
        $src_x = 0;
        $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
      } else if ($src_x <= $src_img_w) {
        $dst_x = 0;
        $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
      }

      if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
        $src_y = $src_h = $dst_y = $dst_h = 0;
      } else if ($src_y <= 0) {
        $dst_y = -$src_y;
        $src_y = 0;
        $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
      } else if ($src_y <= $src_img_h) {
        $dst_y = 0;
        $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
      }

      // Scale to destination position and size
      $ratio = $tmp_img_w / $dst_img_w;
      $dst_x /= $ratio;
      $dst_y /= $ratio;
      $dst_w /= $ratio;
      $dst_h /= $ratio;

      $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

      // Add transparent background to destination image
      imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
      imagesavealpha($dst_img, true);

      $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

      if ($result) {
        if (!imagepng($dst_img, $dst)) {
          $this -> msg = "Failed to save the cropped image file";
        }
      } else {
        $this -> msg = "Failed to crop the image file";
      }

      $image = new resizeimage($this->dst);
      $image->resizeTo($dst_img_w, $dst_img_h, 'exact');
      $image->saveImage($this->dst, SIS_URL.'assets/img/logo-upload.png');
      
      imagedestroy($src_img);
      imagedestroy($dst_img);
    }
  }

  private function codeToMessage($code) {
    $errors = array(
      UPLOAD_ERR_INI_SIZE =>'The uploaded file exceeds the upload_max_filesize directive in php.ini',
      UPLOAD_ERR_FORM_SIZE =>'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
      UPLOAD_ERR_PARTIAL =>'The uploaded file was only partially uploaded',
      UPLOAD_ERR_NO_FILE =>'No file was uploaded',
      UPLOAD_ERR_NO_TMP_DIR =>'Missing a temporary folder',
      UPLOAD_ERR_CANT_WRITE =>'Failed to write file to disk',
      UPLOAD_ERR_EXTENSION =>'File upload stopped by extension',
    );

    if (array_key_exists($code, $errors)) {
      return $errors[$code];
    }

    return 'Unknown upload error';
  }

  public function getResult() {
    return !empty($this -> data) ? $this -> httpDst : $this -> src;
  }

  public function getMsg() {
    return $this -> msg;
  }
}

$crop = new CropAvatar(
  isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null,
  isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null,
  isset($_POST['person_url']) ? $_POST['person_url'] : null,  
  isset($_POST['apid']) ? $_POST['apid'] : null,
  isset($_POST['ativo']) ? $_POST['ativo'] : null,
  isset($_POST['titulo']) ? $_POST['titulo'] : null,
  isset($_POST['descricao']) ? $_POST['descricao'] : null,
  isset($_POST['imgtype']) ? $_POST['imgtype'] : null,
  isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null

);

$response = array(
  'state'  => 200,
  'message' => $crop -> getMsg(),
  'result' => $crop -> getResult()
);

echo json_encode($response);
