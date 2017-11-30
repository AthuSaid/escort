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
      // die("<div style='font-family: Tahoma; color: #CC0000; font-weight: bold'>ACESSO NEGADO AO RECURSO!</div>");

include_once $_SERVER['DOCUMENT_ROOT']."/escort/_includes/_config/config.ini.php";

$query = new queries();

$func = new functions(false);


function crop($src, $dst, $imgtype, $type) {
    
    if (!empty($src) && !empty($dst)) {
        switch ($type) {
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
        
        $tmp_img_w = $size[0];
        $tmp_img_h = $size[1];
        
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
        
        $src_x = 0;
        $src_y = 0;
        
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
        
        $image = new resizeimage($dst);
        $image->resizeTo($dst_img_w, $dst_img_h, 'exact');
        $image->saveImage($dst, SIS_URL.'assets/img/logo-upload.png');
        
        imagedestroy($src_img);
        imagedestroy($dst_img);
    }
}


$retHtml0 = file_get_contents("http://www.vivalocal.com/acompanhante-erotico/br");
//print_r($retHtml0);die;
$ret = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $retHtml0);
$ret0 = preg_replace('/<svg\b[^>]*>(.*?)<\/svg>/is', "", $ret);
$ret1 = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', "", $ret0);
$ret2 = preg_replace('/<div\b[^>]*>(.*?)<\/div>/is', "", $ret1);
$ret3 = preg_replace('/<meta\b[^>]*>(.*?)/is', "", $ret2);
$ret4 = preg_replace('/<link\b[^>]*>(.*?)/is', "", $ret3);
$ret5 = preg_replace('/<ul\b[^>]*>(.*?)<\/ul>/is', "", $ret4);

$arrRegister = explode('<a class="classified-link"', $ret5);
foreach($arrRegister as $register){
    $arrHref = explode('href="', trim(strip_tags($register)));
    $retHref = str_replace('">', '', substr(trim($arrHref[1]), 0, strlen(trim($arrHref[1]))-2));
    if (substr($retHref, 0, 4) == 'http')
        $href[] = trim($retHref);
}

foreach ($href as $url){
    
    $retHtml = file_get_contents($url);
    
    $ret = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $retHtml);
    $ret0 = preg_replace('/<svg\b[^>]*>(.*?)<\/svg>/is', "", $ret);
    $ret1 = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', "", $ret0);
    $ret2 = preg_replace('/<meta\b[^>]*>(.*?)/is', "", $ret1);
    $ret3 = preg_replace('/<link\b[^>]*>(.*?)/is', "", $ret2);
    
    $ret4 = preg_replace('/<ul\b[^>]*>(.*?)<\/ul>/is', "", $ret3);
  
    $arrTitle = explode('<h1 class="kiwii-font-xlarge kiwii-margin-none">', $ret4);
    $escortTitle = explode('</h1>', $arrTitle[1]);
    
    $arrDescription = explode('shortdescription">', $ret4);
    $escortDescription = explode('</div>', $arrDescription[1]);
    
    $arrAge0 = explode('Idade', $ret4);
    $arrAge1 = explode('</div>', $arrAge0[1]);
    $arrAge2 = explode('kiwii-padding-top-xxxsmall">', $arrAge1[0]);
    list($ageEscort, $clearAge) = explode(" ", trim(strip_tags($arrAge2[1])));
    $escortAge = $ageEscort;
    
    $arrAge0 = explode('Área', $ret4);
    $arrAge1 = explode('</div>', $arrAge0[1]);
    $arrAge2 = explode('kiwii-padding-top-xxxsmall">', $arrAge1[0]);
    $escortArea = explode("<br/>", (($arrAge2[1])));
    
    $arrAge0 = explode('Eu sou', $ret4);
    $arrAge1 = explode('</div>', $arrAge0[1]);
    $arrAge2 = explode('kiwii-padding-top-xxxsmall">', $arrAge1[0]);
    list($ageEscort, $clearAge) = explode(" ", trim(strip_tags($arrAge2[1])));
    $escortGender = $ageEscort == 'Mulher' ? 'F' : ($ageEscort == 'Travesti' ? 'T' : 'M');
    
    $arrPhone0 = explode('data-phone-number="', $ret4);
    $arrPhone1 = explode('"', $arrPhone0[1]);
    $escortPhone = str_replace("-", "", $arrPhone1[0]);
    
    $arrayCache = null;
    $arrayCacheValue = null;
    $arrCache0 = explode('Cachê', $ret4);
    $arrCache1 = explode('</div>', $arrCache0[1]);
    foreach($arrCache1 as $sanity => $cache){
        list($timeCache, $clearCache) = explode(" ", trim(strip_tags($cache)));
        if (is_numeric($timeCache))
            $arrayCache[] = trim($timeCache);
         if (substr($timeCache, 0, 2) == 'R$')
            $arrayCacheValue[] = trim(substr($timeCache, 2));
    } 
    
    $finalCache = null;
    for ($c = 0; $c < count($arrayCache); $c++){
        if (count($arrayCache) != count($arrayCacheValue)){
            if ($c == 0){
                $finalCache['c30'] = "";
            }else{
                $finalCache['c'.$arrayCache[$c]] = $arrayCacheValue[$c-1];
            }
        }else{
            $finalCache['c'.$arrayCache[$c]] = $arrayCacheValue[$c];
        }
    }
    
    $arrayImages = null;
    $arrImages = explode('<div id="vs_photo_viewer_container" class="kiwii-carousel"', $ret4);
    $arrImages0 = explode('</div>', $arrImages[1]);
    foreach($arrImages0 as $sanity => $image){
        $arrImages1 = explode('<span src="', $image);
        $escortImages = explode('"', $arrImages1[1]);
        if (trim($escortImages[0]) != '')
            $arrayImages[] = strip_tags($escortImages[0]);
    }
    
    $arrEscort = array( "title" => strip_tags($escortTitle[0]),
        "url" => $func->fFormatTitle4Url(strip_tags($escortTitle[0])),
        "gender" => $escortGender,
        "phone" => "(".substr($escortPhone,0,2).") ".substr($escortPhone, 2, 5)."-".substr($escortPhone, 7),
        "area" => strip_tags($escortArea[1]),
        "age" => (int)(date("Y") - $escortAge).'-01-01',
        "modalidades" => array(3), //3 = acompanhante
        "modalidades-adic" => array(), 
        "localidades" => array(),
        "description" => strip_tags($escortDescription[0]));
    
    $arrEscort = array_merge($finalCache, $arrEscort);
    
    if (trim(strip_tags($escortTitle[0])) != ""){
    
        $pesid = $query->fSaveNewPersonViaMiner($arrEscort);
        
        echo 'PESSOA '.$pesid.' INCLUIDA COM SUCESSO\n';
        
        $apid = $query->fSaveNewAdViaMiner($arrEscort, $pesid);
        
        echo 'ANUNCIO '.$apid.' DA PESSOA '.$pesid.' INCLUIDO COM SUCESSO\n';
        
        $arrPlano = array(  "plaid" 		 => 1,
                            "pesid"       => $pesid,
                            "name" 		 => "Libidinous",                           
                            "vloriginal"  => 0,
                            "pago" 		 => 1,
                            "lido"        => 0,
                            "planexpires" => SIS_DIAS_GRATIS,
                            "vencimento"  => date('Y-m-d H:i:s', strtotime("+".SIS_DIAS_GRATIS." day")));
        
        $query->fQuerySavePersonPlanViaMiner($arrPlano);
        
        echo 'PLANO LIBIDINOUS BASICO INCLUIDO PARA ANUNCIO '.$apid.' DA PESSOA '.$pesid.' COM SUCESSO\n';
        
        $query->fInsertFeaturedModelsByPlans($apid, 1, date('Y-m-d H:i:s'),date('Y-m-d H:i:s', strtotime('+'.SIS_DIAS_GRATIS.' day')));
        $query->fInsertFeaturedModelsByPlans($apid, 2, date('Y-m-d H:i:s'),date('Y-m-d H:i:s', strtotime('+'.SIS_DIAS_GRATIS.' day')));
        $query->fInsertFeaturedModelsByPlans($apid, 3, date('Y-m-d H:i:s'),date('Y-m-d H:i:s', strtotime('+'.SIS_DIAS_GRATIS.' day')));
        $query->fInsertFeaturedModelsByPlans($apid, 4, date('Y-m-d H:i:s'),date('Y-m-d H:i:s', strtotime('+'.SIS_DIAS_GRATIS.' day')));
        $query->fInsertFeaturedModelsByPlans($apid, 5, date('Y-m-d H:i:s'),date('Y-m-d H:i:s', strtotime('+'.SIS_DIAS_GRATIS.' day')));
        
        echo 'INCLUSAO DOS DESTAQUES HOME 1,2,3,4,5 PARA ANUNCIO '.$apid.' DA PESSOA '.$pesid.' EFETUADOS COM SUCESSO\n';        
        
        $img = 0;
        
        foreach ($arrayImages as $image)
        {      
            $hashPhoto = $func->fRandomPassword(12);
            
            $path = $image;
            
            $type = pathinfo($path, PATHINFO_EXTENSION);
            
            $data = file_get_contents($path);
            
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $temp_file = 'temp/tmp_'.$hashPhoto.'.jpeg';
            
            $dataImg = $base64;
            
            list($type, $dataImg) = explode(';', $dataImg);
            
            list(, $dataImg)      = explode(',', $dataImg);
            
            $dataImg = base64_decode($dataImg);
            
            file_put_contents($temp_file, $dataImg);
            
            $file['name'] = $temp_file;
            
            $file['tmp_name'] = $_SERVER["DOCUMENT_ROOT"]."/escort/_cronjobs/".$temp_file;
            
            $file['error'] = UPLOAD_ERR_OK;
            
            $file['size'] = filesize($temp_file);
            
            $file['type'] = exif_imagetype($temp_file);               
            
            $imagePath = $_SERVER["DOCUMENT_ROOT"]."/escort/images/persons/".$arrEscort['url'];
            
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }
            
            $type = exif_imagetype($file['tmp_name']);            
            
            $extension = image_type_to_extension($type);
            
            $src = $imagePath.'/'. $hashPhoto . '.original' . $extension;
            
            $result = copy($file['tmp_name'], $src);
            
            if ($result) {
                
                if ($img == 0)
                    $imgtype = 'landscape';
                elseif($img == 1)
                    $imgtype = 'portrait';
                else
                    $imgtype = 'whatever';                               
                
                $dst = $imagePath.'/'. $hashPhoto . '.png';
                              
                crop($src, $dst, $imgtype, $type);
                
                $local = ($imgtype == 'portrait' ? 1 : ($imgtype == 'landscape' ? 4 : 2));
                
                $arrPhoto = array('apid' => $apid,
                    'tipo' => 1,
                    'ativo' => 1,
                    'titulo' => '',
                    'descricao' => '',
                    'imagemurl' => $hashPhoto . '.png',
                    'local' => $local,
                    'hash' => $hashPhoto);
                $query->fQuerySavePhoto($arrPhoto, true);
                
                $arrPhoto = array('apid' => $apid,
                    'tipo' => 2,
                    'ativo' => 1,
                    'titulo' => '',
                    'descricao' => '',
                    'imagemurl' => $hashPhoto . '.original'.$extension,
                    'local' => $local,
                    'hash' => $hashPhoto);
                $query->fQuerySavePhoto($arrPhoto);
                
                echo 'FOTO '.$hashPhoto . '.original'.$extension.' DA PESSOA '.$pesid.' INCLUIDO COM SUCESSO\n';
                
                $img++;
                
            } else {
                
                echo 'FALHA NO UPLOAD E SALVAMENTO DA FOTO '.$hashPhoto . '.original'.$extension.' DA PESSOA '.$pesid.'\n';
            } 
        }              
        
        //print '<pre>';
        //print_r( $arrEscort);
    }    
}

?>