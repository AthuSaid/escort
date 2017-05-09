<?php

/**
* Classe Coletanea de funcoes - extensao da classe de conexao
*
* @author    Daniel Triboni
* @copyright 2017 - Escort - All Rights Reserved
*/
class functions extends queries {
	
	private $hashKeys = '$2a$07$bda7ac69d6c64931a0c53116d';

	private $retHTML;
	
	private $complHTML;
	
	private $javaScript;
	
	private $retRecords;
	
	public $myGender = null;
	
	public $genderPrefer = null;
	
	public $cookieLatitude;
	
	public $cookieLongitude;
	
	public $funcMsg;
	
	
	/**
	* Class Constructor
	*
	* @author    Daniel Triboni
	* @return    resource
	*/
	public function __construct() {	
		
		parent::__construct();
		
		if (isset($_COOKIE['cUserDefinedData']))
		{
			list($this->myGender, $this->genderPrefer) = explode("_", $_COOKIE['cUserDefinedData']);		
		}
		
		if (isset($_COOKIE['cUserDefinedLocation']))
		{
			list($this->cookieLatitude, $this->cookieLongitude) = explode("_", $_COOKIE['cUserDefinedLocation']);
		}				
	}

	
	/**
	 * Encrypt Person Data before Recover Password
	 * @param string $text
	 */
	public function fEncrypt($text) {
		return urlencode(rawurlencode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->hashKeys, $text, "ecb")));
	}
	
	
	/**
	 * Decrypt Person Data after Recover Password
	 * @param string $text
	 */
	public function fDecrypt($text) {		
		return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->hashKeys, rawurldecode(urldecode($text)), "ecb");
	}
	
	
	/**
	* Remove Grades - UTF8 without BOM
	*
	* @author    Daniel Triboni
	* @param	 string Word	
	* @return    string
	*/
	private function fRemoveGrades($string){
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ?®:@#$%&!*()+=ªº"¨{}[]~^´`,:;/|';
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                               ';
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($a), $b);
		$string = str_replace(".","",$string);
		$string = str_replace(" ","",$string);
		return utf8_encode($string);
	}
	
	
	/**
	 * Format to URL Friendly
	 *
	 * @author    Daniel Triboni
	 * @param     string Titulo
	 * @return    string
	 */
	public function fFormatTitle4Url($title){
		$title = str_replace("'", "-", trim($title));
		$title = str_replace(" ", "-", trim($title));
		return strtolower($this->fRemoveGrades($title));
	}
	
	
	/**
	 * Sanitize Request Fields And Format Dates and URL Friendly
	 *
	 * @author    Daniel Triboni
	 * @param     object $_REQUEST
	 * @return    object sanitized
	 */
	public function fSanitizeRequest($request){
		$newRequest = array();	
		foreach ($request as $obj => $value)
		{
			if ($obj == 'apelido' || $obj == 'titulo')
			{
				$newRequest['url'] = $this->fFormatTitle4Url($this->fEscapeString($request[$obj]));
				$newRequest['apelido'] = $this->fEscapeString($request[$obj]);
				$newRequest['titulo'] = $this->fEscapeString($request[$obj]);
			}elseif ($obj == 'nascimento')
				$newRequest['nascimento'] = $this->fInvertDateUSA($this->fEscapeString($request[$obj]));
			elseif ($obj == 'modalidades' || $obj == 'pessoasatendimento' || $obj == 'idiomas' || $obj == 'localidades')
				$newRequest[$obj] = $request[$obj];			
			else 
				$newRequest[$obj] = $this->fEscapeString($request[$obj]);
		}
		return $newRequest;
	}
	
	
	/**
	* Convert Integer Time to String
	*
	* @author    Daniel Triboni
	* @param	 integer Time
	* @return    string
	*/
	public function fTime2Text($time){	
		$time = ($time * 24 * 3600);	
		$response=array();
		$years = floor($time/(86400*365));
		$time=$time%(86400*365);
		$months = floor($time/(86400*30));
		$time=$time%(86400*30);
		$days = floor($time/86400);
		$time=$time%86400;
		$hours = floor($time/(3600));
		$time=$time%3600;
		$minutes = floor($time/60);
		$seconds=$time%60;
		if($years>0)  $response[] = $years.' ano'. ($years>1?'s':'');
		if($months>0) $response[] = $months.' mes'.($months>1?'es':'');
		if($days>0)   $response[] = $days.' dia' .($days>1?'s':'');
		if($hours>0)  $response[] = $hours.' hora'.($hours>1?'s':'');
		if($minutes>0)$response[] = $minutes.' minuto' . ($minutes>1?'s':'');
		if($seconds>0)$response[] = $seconds.' segundo' . ($seconds>1?'s':'');
		return implode(', ',$response);
	}	
    
    
	/**
	* Invert BRASILEIRO > AMERICAN date format
	*
	* @author    Daniel Triboni
	* @param	 string Date DD/MM/YYYY
	* @return    string Date YYYY/MM/DD
	*/
	public function fInvertDateUSA($data){			
		return substr($data, 6, 4).'-'.substr($data, 3, 2).'-'.substr($data, 0, 2);
	}

	
	/**
	* Invert AMERICAN > BRASILEIRO date format
	*
	* @author    Daniel Triboni
	* @param	 string Date YYYY/MM/DD
    * @param	 $mes = N : Convert extensible month
	* @return    string Date DD/MM/YYYY
	*/	
	public function fInvertDateBrazil($data, $retHour,$mes=""){
		if (strlen($data) > 10)
			$hour = " ".substr($data, 11);
		else 
			$hour = "";	
		if($mes=="n"){
		  $return = substr($data, 8, 2).'/'.$this->fGetReduceMonth(substr($data, 5, 2)).'/'.substr($data, 0, 4);  
		}else{
		  $return = substr($data, 8, 2).'/'.substr($data, 5, 2).'/'.substr($data, 0, 4);
		}
        
        if($retHour==true){
            $return.= $hour;
        }
        
        return $return;
	}    

	
	/**
	* Find Latitude and Longitude at Google Maps
	*
	* @author    Leonardo Pricevicius
	* @param	 string Address
	* @param	 string Number
	* @param	 string Neighborhood
	* @param	 string State
	* @param	 string Country
	* @return    string
	*/
    public function fGetLatLngGoogleMaps($end, $num, $bairro, $estado, $pais){
        $_ENDERECO = str_replace(" ","+", $this->fRemoveGrades($end));
        $_BAIRRO = str_replace(" ","+", $this->fRemoveGrades($bairro));
        $_ESTADO = str_replace(" ","+", $this->fRemoveGrades($estado));
        $_PAIS = str_replace(" ","+", $this->fRemoveGrades($pais));
        $_URL = "http://maps.googleapis.com/maps/api/geocode/json?address=".$_ENDERECO.",".$num."+-+".$_BAIRRO.",+,".$_ESTADO."&sensor=true";
        $_FILE = file_get_contents($_URL);
        $_DECODE = json_decode($_FILE, true);
        return $_DECODE["results"];
    }
    
    
    /**
	* Convert Latitude and Longitude in KM or MILE
	*
	* @author    Leonardo Pricevicius
	* @param	 float Latitude 1
	* @param	 float Longitude 1
	* @param	 float Latitude 2
	* @param	 float Longitude 2
	* @return    integer
	*/
    private function fConvertLatLng2Km($_LAT_01, $_LNG_01, $_LAT_02, $_LNG_02) {
        $_LATITUDE = $_LNG_01 - $_LNG_02;
        $_DISTANCIA = sin(deg2rad($_LAT_01)) * sin(deg2rad($_LAT_02)) +  cos(deg2rad($_LAT_01)) * cos(deg2rad($_LAT_02)) * cos(deg2rad($_LATITUDE));
        $_DISTANCIA = acos($_DISTANCIA);
        $_DISTANCIA = rad2deg($_DISTANCIA);
        $_MILHAS = $_DISTANCIA * 60 * 1.1515;
        return round(($_MILHAS * 1.609344));
    }


    /**
     * Check CPF is valid (Brazilian People Social Security)
     * @param integer $cpf
     * @return boolean
     */
	public function fcheckCPF($cpf){
		$cpf = $this->fremoveNumFormat($cpf);
		if(strlen($cpf) > 0){
			$digito =  ($cpf[0] * 10);
			$digito += ($cpf[1] * 9);
			$digito += ($cpf[2] * 8);
			$digito += ($cpf[3] * 7);
			$digito += ($cpf[4] * 6);
			$digito += ($cpf[5] * 5);
			$digito += ($cpf[6] * 4);
			$digito += ($cpf[7] * 3);
			$digito += ($cpf[8] * 2);
			$digito = ($digito*10) % 11;
			if($digito == 10)
				$digito = 0;
			if($digito == $cpf[9]){
				$digito =  ($cpf[0] * 11);
				$digito += ($cpf[1] * 10);
				$digito += ($cpf[2] * 9);
				$digito += ($cpf[3] * 8);
				$digito += ($cpf[4] * 7);
				$digito += ($cpf[5] * 6);
				$digito += ($cpf[6] * 5);
				$digito += ($cpf[7] * 4);
				$digito += ($cpf[8] * 3);
				$digito += ($cpf[9] * 2);
				$digito = ($digito*10) % 11;
				if($digito == 10)
					$digito = 0;
				if($digito == $cpf[10]){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else
			return false;
	}

	
	/**
	 * Calculate age between current year and born date
	 * @param DateTime $born
	 * @return integer
	 */	
	public function fGetAge($born){
		if($born != '')
		{
		    list($y, $m, $d) = explode('/', $born);
		    $now = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		    $born = mktime( 0, 0, 0, $m, $d, $y);
		    $age = floor((((($now - $born) / 60) / 60) / 24) / 365.25);
		    return $age." anos";
		}
 	}
 	
 	
 	/**
 	 * Translate gender person
 	 * @param	 string gender
 	 * @return   string
 	 */
 	public function fGetGenderPerson($gender){
 		if ($gender == 'M') $gender = 'Homem';
 		if ($gender == 'F') $gender = 'Mulher';
 		return $gender;
 	}
	
 	
	/**
	* Convert integer month to string month
	* @param	 integer month
	* @return    string
	*/	
	public function fGetMonth($month){
		$numMonth = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Mar&ccedil;o", 4 => "Abril", 
						   5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 
						   9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
		return $numMonth[(int)$month];					
	}

	
	/**
	* Convert integer month to string reduced month
	* @param	 integer month
	* @return    string
	*/	
	public function fGetReduceMonth($month){
		$numMonth = array (1 => "JAN", 2 => "FEV", 3 => "MAR", 4 => "ABR", 
							5 => "MAI", 6 => "JUN", 7 => "JUL", 8 => "AGO", 
							9 => "SET", 10 => "OUT", 11 => "NOV", 12 => "DEZ");
		return $numMonth[(int)$month];					
	}
	
	
	/**
	* Convert Reduced Month name to representative value
	* @param	 string Month
	* @return    string
	*/	
	public function fGetConvertReduceMonth2Number($month){
		$numMonth = array ("JAN" => "01", "FEV" => "02", "MAR" => "03", "ABR" => "04", 
							"MAI" => "05", "JUN" => "06", "JUL" => "07", "AGO" => "08", 
							"SET" => "09", "OUT" => "10", "NOV" => "11", "DEZ" => "12");
		return $numMonth[$month];					
	}
	
	
    /**
	* Generate random password
	* @param	 integer num size
	* @return    string
	*/
	public function fRandomPassword($numsize){  
	   $words = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0,1,2,3,4,5,6,7,8,9";  
	   $array = explode(",", $words);  
	   shuffle($array);  
	   $pwd = implode($array, "");  
	   return substr(strtolower($pwd), 0, $numsize);  
	}	

	
    /**
	* Anti SQL Injection
	*
	* @author    Daniel Triboni
	* @param	 string SQL
	* @return    string SQL
	*/
    public function fAntiInjection($sql){
        $sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/i","",$sql);
        $sql = trim($sql);
        $sql = strip_tags($sql);
        $sql = addslashes($sql);
        $sql = $this->fEscapeString($sql);        
    	return $sql;
    }
	
    
	/**
	* Show warnings
	* @return    string
	*/    
	public function fWarnings(){
	   $strErro = $_SESSION["sShowWarning"];
		if (count($strErro) > 0){			
		  unset($_SESSION["sShowWarning"]);
		  foreach ($strErro as $strTextoAviso){
			list($mensagem, $tipo) = explode("|", $strTextoAviso);
			if($tipo == "e") $img = "msgerror";
			if($tipo == "s") $img = "msgsuccess";
			if($tipo == "i") $img = "msginfo";
			if($tipo == "a") $img = "msgalert";
			$layout_aviso = '<div class="notification '.$img.'">
					<a class="close"></a>
					<p>'.$mensagem.'</p>
				</div>';
		  }
			echo $layout_aviso;
		}
	}	
	

	/**
	* Limit words in a string
	* @param	 string Text
	* @param	 integer character limit
	* @param	 boolean broke words (Default: true)
	* @return    string
	*/
 	public function fLimitWords($texto, $limite, $quebra = true, $url=null){
       $tamanho = strlen($texto);
       if($tamanho <= $limite){
          $novo_texto = $texto;
       }else{
          if($quebra == true){
             $novo_texto = trim(substr($texto, 0, $limite))."...";
          }else{
             $ultimo_espaco = strrpos(substr($texto, 0, $limite), " ");
             $novo_texto = trim(substr($texto, 0, $ultimo_espaco))." ... <a href='".$url."'>mais detalhes</a>";
          }
       }
       return $novo_texto;
    }
    

	/**
	* Remove number formatting
	* @param	 string Valor	
	* @return    float
	*/
	public function fRemoveNumFormat($valor){
		return preg_replace("/[^0-9]/", '', $valor);
	}

	
	/**
	* Reduce full name by first name
	* @param	 string name	
	* @return    string
	*/
	public function fReduceName($name){
		$strName = explode(" ", $name);
		return $strName[0];
	}
	
	
	/**
	 * Strip HTML Tags in text content
	 * @param string $text
	 * @param string $tags
	 * @param string $invert
	 */
	public function fStripTagsContent($text, $tags = '', $invert = FALSE) {
		$text = preg_replace('|https?://www\.[a-z\.0-9]+|i', '', $text);
		$text = preg_replace('|www\.[a-z\.0-9]+|i', '', $text);		
		$text = str_replace(range(0, 9), null, $text);
		$text = preg_replace('/\d+$/', null, $text);
		
		preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
		$tags = array_unique($tags[1]);
	
		if(is_array($tags) AND count($tags) > 0) {
			if($invert == FALSE) {
				return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
			}
			else {
				return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
			}
		}
		elseif($invert == FALSE) {
			return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
		}
		
		return $text;
	}

	
	/**
	* Welcome message to user
	* @return    string
	*/	
	public function fWelcomeMessage($name, $gender, $title = false){
		$name = $this->fReduceName($name);
		if ($gender == "M")
			$str = "Bem Vindo ".$name;
		else	
			$str = "Bem Vinda ".$name;
				
		//$str .= ($title ? " ao ".SIS_TITULO : "");
			
		return $str."!";	
	}
	
	
	/**
	 * Welcome message to user
	 * @return    string
	 */
	public function fPlanExpires($days){
		if ($days < 6 && $days > 1)
			$str = "ir&aacute; expirar <strong>em ".$days." DIAS</strong>";
		elseif($days == 1)
			$str = "ir&aacute; expirar <strong>AMANH&Atilde;</strong>";
		elseif($days == 0)
			$str = "expira <strong>HOJE</strong>";
		else 
			$str = "expirou";
		return $str;
	}
	
	
	/**
	* Reference to user by gender
	* @return    string
	*/
	public function fReference(){
		if ($_SESSION['sClientGender'] == "M")
			$str = "dele";
		else
			$str = "dela";
		return $str;
	}
	

	/**
	 * Load Notifications in Nav Menu
	 * @param number $type
	 */
	public function fGetNotificationNavMenu()
	{
		$this->retRecords = $this->fQueryNotificationNavMenu();
		
		$this->retHTML = null;
		
		if (count($this->retRecords) > 0)
		{
			for ($x = 0; $x < count($this->retRecords); $x++)
			{
				$this->retHTML .= '<li>                                       
                                       <h6><a href="'.SIS_URL.$this->retRecords[$x]['url'].'">'.$this->retRecords[$x]['titulo'].'</a></h6>
                                       <p class="m-top-10"><span class="price text-lowercase">'.$this->retRecords[$x]['aprovado'].'</span></p>
                                   </li>';
			}
		}
		
		return array('counter' => count($this->retRecords), 'html' => $this->retHTML);
	}
	
	
	/**
	 * Get all site plans
	 * @param unknown $type
	 * @param unknown $link
	 * @param unknown $plaid
	 * @return NULL|string
	 */
	public function fGetPlans($type, $plaid = 0)
	{
		$this->retRecords = $this->fQueryPlans($type);
	
		if (count($this->retRecords) > 0)
		{
			$this->retHTML = null;

			for ($x = 0; $x < count($this->retRecords); $x++)
			{
				
				if ($plaid == 0)
				{
					$upgradeOrSign = 'Assinar <i class="fa fa-cart-plus"></i>';
					$disableBtn = 'href="javascript:void(0);" class="btn btn-primary m-top-10 getplan"';
					
				}elseif ($plaid != $this->retRecords[$x]['plaid'] && $this->retRecords[$x]['plaid'] > 1)
				{
					$upgradeOrSign = 'Atualizar para '.$this->retRecords[$x]['plano'].' <i class="fa fa-cart-plus"></i>';
					$disableBtn = 'href="javascript:void(0);" class="btn btn-primary m-top-10 getplan"';
					
				}elseif ($plaid != $this->retRecords[$x]['plaid'] && $this->retRecords[$x]['plaid'] < 2)
				{
					$upgradeOrSign = 'N&atilde;o Permitido <i class="fa fa-times-circle"></i>';
					$disableBtn = 'href="javascript:void(0);" disabled class="btn btn-primary m-top-10"';
					
				}elseif ($plaid == $this->retRecords[$x]['plaid'] && $this->retRecords[$x]['plaid'] < 2)
				{
					$upgradeOrSign = 'N&atilde;o Permitido <i class="fa fa-times-circle"></i>';
					$disableBtn = 'href="javascript:void(0);" disabled class="btn btn-primary m-top-10"';
					
				}elseif ($plaid == $this->retRecords[$x]['plaid'] && $this->retRecords[$x]['plaid'] > 1)
				{
					$upgradeOrSign = 'Renovar meu Plano Atual <i class="fa fa-star-half-empty"></i>';
					$disableBtn = 'href="javascript:void(0);" class="btn btn-primary m-top-10 getplan"';
				}
				
				
				$this->retHTML .= '<div class="col-sm-4">
                                            <blockquote class="m-top-30 m-l-30">
                                            	<h2>'.$this->retRecords[$x]['plano'].'</h2>		                                            	
                                            	'.$this->retRecords[$x]['descricao'];
								if ($this->retRecords[$x]['valor'] > 0){
		                             $this->retHTML .= '<h3><strong>R$ '.number_format($this->retRecords[$x]['valor'], 2, ",", ".").'</strong> / m&ecirc;s</h3>';
		                             $this->retHTML .= '<p>em at&eacute; '.SIS_PARCELAS_SEM_JUROS.'x sem juros no cart&atilde;o*</p>';
								}else{ 
									$this->retHTML .= '<h3><strong>Gr&aacute;tis por '.SIS_DIAS_GRATIS.' dias *</strong></h3>';
                            		$this->retHTML .= '<p>* Renovar para Premium ou Advanced!</p>';
								}
							
								$this->retHTML .= '<a '.$disableBtn.' data-nomplan="'.$this->retRecords[$x]['plano'].'" data-valplan="'.$this->retRecords[$x]['valor'].'" data-register="'.$this->retRecords[$x]['plaid'].'">'.$upgradeOrSign.'</a>';
                            
                            
              $this->retHTML .= '</blockquote>
							</div>';
				
			}				
	
			return $this->retHTML;
		}
	}
	
	
	/**
	 * Load Notifications in Home Counters
	 * @param number $type
	 */
	public function fGetNotificationCounters()
	{
		$this->retRecords = $this->fQueryNotificationCounters();
			
		return array('pc' => $this->retRecords[0]['pc'], 'mo' => $this->retRecords[0]['mo'], 'pr' => $this->retRecords[0]['pr'], 'ac' => $this->retRecords[0]['ac']);
	}
	
	
	/**
	 * Update Notifications To Read
	 * @param number $type
	 */
	public function fUpdateNotifications2Read()
	{
		$this->retRecords = $this->fQueryNotifications2Read();
			
		return true;
	}
    
	
    /**
    * Create gallery images dinamically
    * @param number $type
    */
    public function fCreateGallery($type = 1)
    {
    	switch ($type)
    	{
    		case 1:

    			$this->retRecords = $this->fQueryFeaturedModels($this->genderPrefer, 5, 6);
    			
    			if (count($this->retRecords) > 0)
    			{
    				$this->retHTML = '<section id="gallery" class="gallery margin-top-120 bg-grey">
				                <div class="container">
				                    <div class="row">
				                        <div class="main-gallery roomy-80">
				                            <div class="col-md-12">
				                                <div class="head_title text-left sm-text-center wow fadeInDown">
				                                    <h2>Pessoas Recentes</h2>
				                                    <h5><em>Some our recent works is here. Discover them now!</em></h5>
				                                    <div class="separator_left"></div>
				                                </div>
				                            </div>
				                            <div class="col-md-12 m-bottom-60">
				                                <div class="filters-button-group text-right sm-text-center">
				                                    <button class="button is-checked" data-filter="*">Ver todos</button>
				                                    <button class="button" data-filter=".mars">Marte</button>
				                                    <button class="button" data-filter=".venus">Venus</button>
				                                    <button class="button" data-filter=".dbm">Duplo Marte</button>
				                                    <button class="button" data-filter=".dbv">Duplo Venus</button>
    												<button class="button" data-filter=".transgender-alt">Mercurio</button>
				                                </div>
				                            </div>
				                            <div style="clear: both;"></div>
				                            <div class="grid text-center">';
    			
    				for ($x = 0; $x < count($this->retRecords); $x++)
    				{
    					if ($this->retRecords[$x]['vencimento'] > 0)
    					{
	    					$this->retHTML .= '<div class="grid-item post-transition mars venus dbm dbv mercury numberGreaterThan50 ium">
					                                    <img alt="'.$this->retRecords[$x]['apelido'].'" src="'.SIS_URL.'images/persons/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['imagemurl'].'">
					                                    <div class="grid_hover_area text-center">
					                                        <div class="grid_hover_text m-top-110">
					                                            <h4 class="text-white">'.$this->retRecords[$x]['apelido'].'</h4>
					                                            <h5 class="text-white"><em>'.$this->retRecords[$x]['localizacao'].'</em></h5>
					                                            <a href="#" class="text-white m-top-40">Ver Perfil <i class="fa fa-venus-double"></i></a>
					                                        </div>
					                                    </div>
					                                </div>';
    					}
    				}
    			
    				$this->retHTML .= '</div>
				                            <div style="clear: both;"></div>
				                        </div>
				                    </div>
				                </div>
				            </section>';
    				
    				return $this->retHTML;
    			}
    			
    		break;
    		
    		case 2:
    			
    			$this->retRecords = $this->fQueryGalleryModels($this->genderPrefer);
    			 
    			if (count($this->retRecords) > 0)
    			{
    				$this->retHTML = '<section id="gallery" class="gallery margin-top-120 bg-white">
							                <!-- Portfolio container-->
							                <div class="container">
							                    <div class="row">
							                        <div class="main-gallery main-model roomy-80">
							                            <div class="col-md-12 m-bottom-60">
							                                <div class="filters-button-group text-right sm-text-center">
							                                    <button class="button is-checked" data-filter="*"><strong>Ver todos</strong></button>
							                                    <button class="button" data-filter=".mars"><i class="fa fa-mars"></i> Marte</button>
							                                    <button class="button" data-filter=".venus"><i class="fa fa-venus"></i> Venus</button>
							                                    <button class="button" data-filter=".dbm"><i class="fa fa-mars-double"></i> Duplo Marte</button>
							                                    <button class="button" data-filter=".dbv"><i class="fa fa-venus-double"></i> Duplo Venus</button>
			    												<button class="button" data-filter=".mercury"><i class="fa fa-mercury"></i> Mercurio</button>
							                                </div>
							                            </div>							
							                            <div style="clear: both;"></div>							
							                            <div class="grid models text-center">';
    				
					    				for ($x = 0; $x < count($this->retRecords); $x++)
					    				{      
					    					if ($this->retRecords[$x]['vencimento'] > 0)
					    					{
												  $this->retHTML .= '<div class="grid-item model-item transition metal '.$this->retRecords[$x]['genero'].'">
												                        <div class="model_img">
												                            <img src="'.SIS_URL.'images/persons/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['thumb'].'" alt="'.$this->retRecords[$x]['apelido'].'" />
												                            <a href="'.SIS_URL.'person/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['ad'].'" class="btn btn-default m-top-20">Ver Perfil<i class="fa fa-long-arrow-right"></i></a>
												                            <div class="model_caption">
												                            	<h5 class="text-white">'.$this->retRecords[$x]['apelido'].'</h5>
												                        	</div>
												                    	</div>
												                	</div>';
					    					}
					    				}	               
														                                							
							          $this->retHTML .= '<div style="clear: both;"></div>							
							                        </div>
							                    </div>
							                </div><!-- Portfolio container end -->
							            </section><!-- End off portfolio section -->';
							          
					return $this->retHTML;
    			}
    			
    		break;	
    	}    	    	
    }
    
    
    /**
     * Create user testimonials in site home
     * @return string
     */
    public function fCreateUserTestimonials()
    {
    	$this->retRecords = $this->fQueryFeaturedModels(5, 6);
    	
    	if (count($this->retRecords) > 0)
    	{
	    	$this->retHTML = '<section id="testimonial" class="testimonial fix roomy-100">
				                <div class="container">
				                    <div class="row">
				                        <div class="main_testimonial text-center">			
				                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				                                <div class="carousel-inner" role="listbox">';
	    	
			    	for ($x = 0; $x < count($this->retRecords); $x++)
			    	{                                  	
    						$this->retHTML .= '<div class="item active testimonial_item">
			                                        <div class="col-sm-10 col-sm-offset-1">
			                                            <div class="test_authour">
			                                                <img class="img-circle" src="'.SIS_URL.'images/users/'.$this->retRecords[$x]['avatar'].'" alt="" />
			                                                <h6 class="m-top-20">'.$this->retRecords[$x]['apelido'].'</h6>
			                                                <h5><em>'.$this->retRecords[$x]['descricao_pessoa'].'</em> </h5>
			                                            </div>
			                                            <p class=" m-top-40">'.$this->retRecords[$x]['comentario'].'</p>
			                                        </div>
			                                    </div>';
		    		}                               
			
		             $this->retHTML .= '</div>			
		                                <!-- Controls -->
		                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		                                    <span class="fa fa-long-arrow-left" aria-hidden="true"></span>
		                                    <span class="sr-only">Previous</span>
		                                </a>
		                                <span class="slash">/</span>
		                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		                                    <span class="fa fa-long-arrow-right" aria-hidden="true"></span>
		                                    <span class="sr-only">Next</span>
		                                </a>			
		                            </div>
		                        </div>
		                    </div><!--End off row-->
		                </div><!--End off container -->
		            </section> <!--End off Testimonial section -->';
		             
		     return $this->retHTML;
    	}    	    	
    }
    
    
    /**
     * Create Featured models in home site
     * @param number $feature
     * @param number $limit
     */
    public function fCreateFeaturedModels($feature = 0, $limit = 1)
    {
    	$this->retRecords = $this->fQueryFeaturedModels($this->genderPrefer, $feature, $limit);
    	
    	if (count($this->retRecords) > 0)
    	{
	    	switch($feature)
	    	{
	    		case 1: # MODELO DESTAQUE POSTER
	    	
	    			if ($this->retRecords[0]['vencimento'] > 0)
	    			{
		    			$this->retHTML = '<section id="hello" class="home bg-mega" style="background: url('.SIS_URL.'images/persons/'.$this->retRecords[0]['person'].'/'.$this->retRecords[0]['imagemurl'].') no-repeat top center;">
								             <div class="overlay"></div>
								                <div class="container">
								                    <div class="row">
								                        <div class="main_home text-center">
								                            <div class="home_text">
								                                <h4 class="text-white text-uppercase">MODELO DA SEMANA</h4>
								                                <h1 class="text-white text-uppercase">'.$this->retRecords[0]['apelido'].'</h1>
								                                <div class="separator"></div>
								                                <h5 class=" text-uppercase text-white">
								                                	<em><a href="'.SIS_URL.'person/'.$this->retRecords[0]['person'].'/'.$this->retRecords[0]['ad'].'" class="text-white">'.$this->retRecords[0]['descricao_foto'].'</a></em>
								                                </h5>
								                            </div>
								                        </div>
								                    </div><!--End off row-->
								                </div><!--End off container -->
								            </section> <!--End off Home Sections-->';
	    			}
	    		break;
	    		
	    		case 2: # MODELO DESTAQUE LIVRETO
	    			
	    			if ($this->retRecords[0]['vencimento'] > 0)
	    			{
		    			$this->retHTML = '<div class="container">
						                    <div class="row">
						                        <div class="main_feature">					
						                            <div class="col-md-6 m-top-120">
						                                <!-- Head Title -->
						                                <div class="head_title">
						                                    <h2>'.$this->retRecords[0]['apelido'].'</h2>
						                                    <h5><em>'.$this->retRecords[0]['descricao_foto'].'</em></h5>
						                                    <div class="separator_left"></div>
						                                </div><!-- End off Head Title -->					
						                                <div class="feature_content wow fadeIn m-top-20">
						                                    <p>'.nl2br($this->retRecords[0]['descricao_pessoa']).'</p>					
						                                    <div class="feature_btns m-top-30">
						                                        <a href="'.SIS_URL.'person/'.$this->retRecords[0]['person'].'/'.$this->retRecords[0]['ad'].'" class="btn btn-default text-uppercase">mais sobre mim <i class="fa fa-long-arrow-right"></i></a>
						                                    </div>
						                                </div>
						                            </div>
						                            <div class="col-md-6">
						                                <div class="feature_photo wow fadeIn sm-m-top-40">
						                                    <div class="photo_border"></div>
						                                    <div class="feature_img">
						                                        <img src="'.SIS_URL.'images/persons/'.$this->retRecords[0]['person'].'/'.$this->retRecords[0]['imagemurl'].'" alt="'.$this->retRecords[0]['apelido'].'" />
						                                    </div>
						                                </div>
						                            </div>
						                        </div>
						                    </div><!--End off row-->
						                </div><!--End off container -->
						                <br /><br /><br /><br /><hr /><br /><br />';
	    			}
	    			
	    		break;	
	    		
	    		case 3: # MODELO DESTAQUE LISTA
	    			
	    			$this->retHTML = '<!--Our Work Section-->
						                <div class="container">
						                    <div class="row">
						                        <div class="main_work">';
	    			
	    				for ($x = 0; $x < count($this->retRecords); $x++)
	    				{
	    					if ($this->retRecords[$x]['vencimento'] > 0)
	    					{
					    			$this->retHTML .= '<div class="col-md-7 col-md-offset-5 col-sm-12 col-xs-12">
						                                <div class="work_item">
						                                    <div class="row">
						                                        <div class="col-md-7 col-sm-12 col-xs-12 text-right pull-right sm-text-center">
						                                            <div class="work_item_img">
						                                                <img src="'.SIS_URL.'images/persons/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['imagemurl'].'" alt="'.$this->retRecords[$x]['apelido'].'" />
						                                            </div>
						                                        </div>
						                                        <div class="col-md-5 col-sm-12 col-xs-12 text-right pull-left sm-text-center">
						                                            <div class="work_item_details m-top-80 sm-m-top-20">
						                                                <h4>'.$this->retRecords[$x]['apelido'].'</h4>
						                                                <div class="work_separator1"></div>
						                                                <p class="m-top-40 sm-m-top-10">'.$this->retRecords[$x]['descricao_foto'].'</p>
						                                            </div>
						                                        </div>
						                                    </div>
						                                </div>
						                            </div><!-- End off work-item -->';
	    					}
	    				}	
	    				
		    			$this->retHTML .= '</div>
					                    </div>
					                </div><br /><br /><br /><hr /><br /><br /><br />';
	    			
	    		break;
	    		
	    		case 4: # LISTA NOVAS PESSOAS
	    			
	    			$this->retHTML = '<section id="models" class="models bg-grey roomy-80">
							                <div class="container">
							                    <div class="row">
							                        <div class="main_models text-center">
							                            <div class="col-md-12">
							                                <div class="head_title text-left sm-text-center wow fadeInDown">
							                                    <h2>Novas Pessoas</h2>
							                                    <h5><em>Elas est&atilde;o te esperando!</em></h5>
							                                    <div class="separator_left"></div>
							                                </div>
							                            </div>';
	    			
	    			for ($x = 0; $x < count($this->retRecords); $x++)
	    			{			
	    				if ($this->retRecords[$x]['vencimento'] > 0)
	    				{
				            $this->retHTML .= '<div class="col-md-3 col-sm-6">
				                                <div class="model_item m-top-30">
				            						<a href="'.SIS_URL.'person/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['ad'].'" class="text-white m-top-40">
					                                    <div class="model_img">
					                                        <img src="'.SIS_URL.'images/persons/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['imagemurl'].'" alt="'.$this->retRecords[$x]['apelido'].'" />
					                                        <div class="model_caption">
					                                            <h5 class="text-white">'.$this->retRecords[$x]['apelido'].'</h5>				                                    
					                                        </div>
					                                    </div>
				                                    </a>
				                                </div>
				                            </div><!-- End off col-md-3 -->';
	    				}
	    			}				                            
				                         
				      $this->retHTML .= '<div class="col-md-3 col-sm-6">
			                                <div class="model_item meet_team m-top-30">				      							
			                                    <a href="'.SIS_URL.'persons"><h4><i class="fa fa-group"></i><br>Ver lista completa</h4></a>
			                                </div>
			                            </div><!-- End off col-md-3 -->	
			                        </div>
			                    </div>
			                </div>
			            </section>';
	    			
	    		break;	
	    	}
	    	
	    	return $this->retHTML;
    	}    	    	
    }
    
    
    # FIXME: Rever
    /**
     * Get Person Locations #################################################################
     * @param unknown $person
     * @return REVER UM MELHOR FUNCIONAMENTO DA APRESENTACAO DO MAPA !!!!!!!!!!!! ###########
     * TODO: Rever
     */
    public function fGetPersonLocations($arrPerson, $type)
    {
    	$this->retRecords = $this->fQueryPersonLocations($this->fEscapeString($arrPerson[0]['apid']));
    	
    	if (count($this->retRecords) > 0)
    	{
	    	switch ($type)
	    	{
	    		case 1:
	    			
	    			$this->retHTML = "<script>
	    						var map = new GMaps({
					                el: '.ourmap',
					                lat: ".$this->retRecords[0]['max_latitude'].",
					                lng: ".$this->retRecords[0]['min_longitude'].",
					                scrollwheel: false,
					                zoom: ".(count($this->retRecords) == 1 ? 15 : 13).",
					                zoomControl: true,
					                panControl: false,
					                streetViewControl: false,
					                mapTypeControl: false,
					                overviewMapControl: false,
					                clickable: false,
					                styles: [{'stylers': [{'hue': 'grey'}, {saturation: -100},
					                            {gamma: 0.80}]}]
					            }); ";
	    			
	    			for ($x = 0; $x < count($this->retRecords); $x++)
	    			{
	    				//if ($this->retRecords[$x]['show'] == 1)
	    				//{
	    					$this->retHTML .= "map.addMarker({
									         		  lat: ".$this->retRecords[$x]['latitude'].",
									         		  lng: ".$this->retRecords[$x]['longitude'].",
									         		  title: \"".$this->retRecords[$x]['local']."\",
									         		  icon: '".SIS_URL."assets/images/markers/marker-{$arrPerson[0]['sexo']}.png',
			    										         		  infoWindow: {
			    										         		  content: '<p><strong>".$this->retRecords[$x]['local']."</strong></p>' +
									         	          		    '<p>".$this->retRecords[$x]['endereco']." ".$this->retRecords[$x]['numero']."<br>' +
									         	          		    '".$this->retRecords[$x]['bairro']." - ".$this->retRecords[$x]['cidade']."/".$this->retRecords[$x]['uf']."<br>' +
									         	          		    'CEP ".$this->retRecords[$x]['cep']."</p>'
									         	        }
								         		}); ";
	    				/*}else{
	    			
	    					$this->retHTML .= "var circ{$x} = map.drawCircle({
	    											 lat: ".$this->retRecords[$x]['latitude'].",
    												  lng: ".$this->retRecords[$x]['longitude'].",
    												  radius: 1500,
    												  fillColor: '".($arrPerson[0]['sexo'] == 'M' ? '#BBD8E9' : '#FF55B0')."',
													  fillOpacity: 0.4,
    												  strokeColor: '".($arrPerson[0]['sexo'] == 'M' ? '#0080c0' : '#FF0080')."',
													  strokeWeight: 1,
													  click: function(e) {
									         	          alert('Alerta');
									         	        }
													}); ";
	    					//break;
	    				}*/
	    			}
	    			
	    			return $this->retHTML.'</script>';
	    			
	    		break;
	    		
	    		case 2:
	    			
	    			for ($x = 0; $x < count($this->retRecords); $x++)
	    			{
		    			$arrKM[] = $this->fConvertLatLng2Km($this->cookieLatitude, $this->cookieLongitude, $this->retRecords[$x]['latitude'], $this->retRecords[$x]['longitude']); 
	    			}
	    			
	    			return $arrKM;
	    			
	    		break;	
	    	}    	
    	}
    }
    
    
    /**
     * Update visit count in Person Page
     * @param unknown $person
     * @return boolean
     */
    public function fUpdateVisitCount($apid)
    {    	
    	if (!empty($apid) && !isset($_SESSION['sSessID']))
    	{
    		$_SESSION['sSessID'] = session_id();
    		return $this->fQueryUpdateVisitCount($this->fEscapeString($apid));
    	}    		
    }
    
    
    /**
     * Get Person Details in Person Page
     * @param unknown $person
     * @return array
     */
    public function fGetAdPersonDetails($person, $ad)
    {
    	return $this->fQueryAdPerson($this->fFormatTitle4Url($this->fEscapeString($person)), $this->fFormatTitle4Url($this->fEscapeString($ad)));
    }
    
    
    /**
     * Get Person Ad Title Result if Exists
     * @param unknown $title
     * @return array
     */
    public function fGetAdTitle($title, $apid)
    {
    	return $this->fQueryPersonAdTitle($this->fEscapeString($title), $this->fEscapeString($apid));
    }
    
    
    /**
     * Get Person AKA Result if Exists
     * @param unknown $aka
     * @return boolean
     */
    public function fGetAka($aka)
    {
    	return $this->fQueryPersonAka($this->fEscapeString($aka));
    }
    
    
    /**
     * Save User Data to Newsletter
     * @param unknown $email
     * @return boolean
     */
    public function fSaveNewsletter($name, $email, $message)
    {
    	return $this->fQuerySaveNewsletter($this->fEscapeString($name), 
    									   $this->fEscapeString($email), 
    									   $this->fEscapeString($message));
    }
    
    
    /**
     * Get Person Email Result if Exists
     * @param unknown $email
     * @return boolean
     */
    public function fGetEmail($email)
    {
    	return $this->fQueryPersonEmail($this->fEscapeString($email));
    }
    
    
    /**
     * Remove Person Logically
     * @param unknown $pesid
     * @return boolean
     */
    public function fRemovePerson($pesid)
    {
    	return $this->fQueryRemovePerson($this->fEscapeString($pesid));
    }
    
    
    /**
     * Get Person Email Retrieve Password
     * @param unknown $email
     * @return boolean
     */
    public function fRetrievePassword($email)
    {
    	return $this->fQueryRetrievePassword($this->fEscapeString($email));
    }
    
    
    /**
     * Update Person Credentials
     * @param string $email
     * @param string $password
     */
    public function fUpdatePersonCredentials($email, $password)
    {
    	return $this->fQueryUpdatePersonCredentials($this->fEscapeString($email), $this->fEscapeString($password));
    }
    
    
    /**
     * Get Person Register in Signup Page
     * @param unknown $person
     * @return array
     */
    public function fGetPersonRegister($person)
    {
    	return $this->fQueryPersonRegister($this->fFormatTitle4Url($this->fEscapeString($person)));
    }
    
    
    /**
     * Edit Person Advertise in Ad Page
     * @param unknown $ad
     * @param unknown $person
     */
    public function fEditPersonAd($person, $ad)
    {
    	return $this->fQueryEditPersonAd($this->fFormatTitle4Url($this->fEscapeString($person)), $this->fFormatTitle4Url($this->fEscapeString($ad)));
    }
    
    
    /**
     * Get Person Photos in Person Page
     * @param number $pesid
     * @return string|NULL
     */
    public function fGetPersonPhotos($apid = 0, $url = null)
    {
    	$this->retRecords = $this->fQueryCurrentPersonPhotos($apid);

    	$this->retHTML = '<div class="grid text-center mygallery">';
    	
    	$personLogged = ($_SESSION['sPersonLogged'] && $_SESSION['sPersonUrl'] == $url ? true : false);
    	
    	if ($personLogged) {
    	
    		$this->retHTML .= '<div class="grid-item transition metal ium" style="background: url(\''.SIS_URL.'assets/img/contrate.jpg\') no-repeat;">
    									<div class="text-center">	                                        
	                                    </div>
                                	</div>';
    	}
    	
    	if (count($this->retRecords) > 0)
    	{
    		
    		for ($x = 0; $x < count($this->retRecords); $x++)
    		{
    			
    			$active = ($personLogged ? '<h4 class="showphoto"><input type="checkbox" value="1"> <i class="fa fa-eye"></i></h4>' : '');
    			$title = ($personLogged ? '<p><input type="text" maxlength="30" placeholder="Informe um titulo para sua foto" id="title" style="width: 300px; text-align: center; color: #ccc; background: transparent; border: 1px solid #ccc;" value="'.$this->retRecords[$x]['titulo'].'"></p>' : '<h4 class="text-white">'.$this->retRecords[$x]['titulo'].'</h4>');
    			$description = ($personLogged ? '<p><input type="text" placeholder="Descreva sua foto" id="description" style="width: 300px; text-align: center; color: #ccc; background: transparent; border: 1px solid #ccc;" value="'.$this->retRecords[$x]['descricao'].'"></p>' : '<h5 class="text-white"><em>'.$this->retRecords[$x]['descricao'].'</em></h5>');
    			$delete = ($personLogged ? '<div class="cropControls cropControlsUpload" onclick="removeImg(\''.$this->retRecords[$x]['hash'].'\')"><i class="cropControlRemoveCroppedImage" title="Remover Foto"></i></div>' : '');    			
    			
    			$this->retHTML .= '<div class="grid-item transition metal ium hash_'.$this->retRecords[$x]['hash'].'" style="background: url(\''.SIS_URL.'images/persons/'.$url.'/'.$this->retRecords[$x]['thumb'].'\') no-repeat;">                                    	
                                    	'.$delete.'
    									<div class="grid_hover_area text-center">
	                                        <div class="grid_hover_text m-top-110">
	                                            '.$active.'
                                    			'.$title.'
	                                            '.$description.'
	                                            <a href="'.SIS_URL.'images/persons/'.$url.'/'.$this->retRecords[$x]['large'].'" class="popup-img text-white m-top-40">Ampliar <i class="fa fa-search-plus"></i></a>
	                                        </div>
	                                    </div>		
                                	</div>';
    		}
    	}
    	
    	if ($personLogged) {    	
    		
	    			$this->retHTML .= '<div class="grid-item metal ium addphoto">
	    									<div id="imgGalleryModel"></div>
	                                    	<div class="grid_hover_area2 text-center">
		                                        <div class="grid_hover_text m-top-110">
		                                            <h4 class="text-white"><i class="fa fa-camera"></i> <i class="fa fa-upload"></i></h4>
	    											<h6 class="text-white">Adicionar nova Foto</h6>
		                                        </div>
		                                    </div>
	                                	</div>';
    	}
    	
    	return $this->retHTML.'</div>';
    	    	    	
    }
    
    
    /**
     * Get Person Modalities And Service Prices in Person Page
     * @param unknown $type
     * @param unknown $pesid
     * @param unknown $gender
     */
    public function fGetPersonModalities($apid, $gender)
    {
    	$this->retRecords = $this->fQueryCurrentPersonModalities($apid);
    
    	if (count($this->retRecords) > 0)
    	{
    		$this->retHTML = null;
    		
    		for ($x = 0; $x < count($this->retRecords); $x++)
    		{
    			$this->retHTML .= '<div class="col-md-'.((count($this->retRecords) > 3 ? 4 : (12 / count($this->retRecords)))).'">';
    				$this->retHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong>'.$this->retRecords[$x]['modalidade'].'</strong></span> 
                                      		<span class="pull-right font-size-pull-right-'.strtolower($gender).'">'.(!empty($this->retRecords[$x]['descricao']) ? '<i class="fa fa-question-circle descr_'.$this->retRecords[$x]['modid'].'"></i>' : '').'</span>
                                      	</h6>                                      	
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    			$this->retHTML .= '</div>';
    		}

    		return $this->retHTML;
    	}
    }
    
    
    /**
     * Get Person Modalities And Service Prices in Person Page for Balloon Tip
     * @param unknown $type
     * @param unknown $pesid
     * @param unknown $gender
     */
    public function fGetPersonModalitiesBalloonTip($apid, $gender)
    {
    	$this->retRecords = $this->fQueryCurrentPersonModalities($apid);
    
    	if (count($this->retRecords) > 0)
    	{
    		$this->javaScript = null;
    
    		for ($x = 0; $x < count($this->retRecords); $x++)
    		{
    			$this->javaScript .= '$(\'.descr_'.$this->retRecords[$x]['modid'].'\').balloon({
												html: true,
												position: \'top left\',
												contents: \'<strong><i class="fa fa-question-circle"></i> '.$this->retRecords[$x]['modalidade'].':</strong><br>'.$this->retRecords[$x]['descricao'].'</i>\'
											});';
    		}
    
    		return $this->javaScript;
    	}
    }
    
    
    /**
     * Get Person Count Ads
     * @param unknown $type
     * @param unknown $pesid
     * @param unknown $gender
     */
    public function fGetCountDashboardAds($pesid)
    {
    	$this->retRecords = $this->fQueryAllPersonAds($pesid);
    
    	return count($this->retRecords);    	
    }
    
    
    /**
     * Get Person Count Photos
     * @param unknown $type
     * @param unknown $pesid
     * @param unknown $gender
     */
    public function fGetCountPersonPhotos($pesid)
    {
    	$this->retRecords = $this->fQueryAllPersonPhotos($pesid);
    
    	return count($this->retRecords);
    }
    
    
    /**
     * Get Person Modalities And Service Prices in Person Page
     * @param unknown $type
     * @param unknown $pesid
     * @param unknown $gender
     */
    public function fGetDashboardAds($pesid)
    {
    	$this->retRecords = $this->fQueryAllPersonAds($pesid);
    
    	if (count($this->retRecords) > 0)
    	{
    		$this->retHTML = null;
    
    		for ($x = 0; $x < count($this->retRecords); $x++)
    		{
    			$adUrl = SIS_URL.'person/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['ad'];
    			
    			$this->retHTML .= '<div class="row item-'.$this->retRecords[$x]['apid'].'">
                                        <div class="comment_item">
                                            <div class="col-sm-1">
                                                <div class="blog_comments_img">
                                                    <img class="img-circle" src="'.SIS_URL.'images/persons/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['thumb'].'" alt="">
                                                </div>
                                            </div>
                                            <div class="col-sm-11">
                                                <div class="comments_top_tex">
                                                    <div class="row">
                                                        <div class="col-sm-6 pull-left">
                                                            <h5 class="text-uppercase">'.$this->retRecords[$x]['titulo'].' ('.$this->retRecords[$x]['visitascount'].' visualiza&ccedil;&otilde;es)</h5>
                                                            <small><em>'.$this->retRecords[$x]['publicacao'].'</em></small>
                                                        </div>
                                                        <div class="col-sm-3 pull-right">                                                        	
                                                            <a href="'.SIS_URL.'ad/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['ad'].'"><i class="fa fa-edit"></i> Editar </a> |
                                                            <a href="'.$adUrl.'"><i class="fa fa-eye"></i> Visualizar </a> |
                                                            <a href="javascript:void(0);" class="remove-ad" data-register="'.$this->retRecords[$x]['apid'].'"><i class="fa fa-trash"></i>Excluir </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <article class="comments_bottom_text margin-top-10">
                                                    <p>'.$this->fLimitWords($this->retRecords[$x]['descricao'], 350, false, $adUrl).'</p>
                                                </article>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="item-'.$this->retRecords[$x]['apid'].'"/>';
    		}
    
    	}else{
    		
    		$this->retHTML = '<div class="row item-'.$this->retRecords[$x]['apid'].'">
                                        <div class="comment_item">
                                            <div class="col-sm-12">
    											Voc&ecirc; ainda n&atilde;o tem nenhum an&uacute;ncio cadastrado!
    										</div>
    									</div>
    							</div>';
    		
    	}
    	
    	return $this->retHTML;
    }
    
    
    /**
     * Get Person Modalities And Service Prices in Person Page
     * @param unknown $type
     * @param unknown $pesid
     * @param unknown $gender
     */
    public function fGetPersonCache($apid, $gender, $currency)
    {
    	$this->retRecords = $this->fQueryPersonCache($apid);
    
    	if (count($this->retRecords) > 0)
    	{
    		$pullUp = 0;
    
    		$this->complHTML = null;
    
    		for ($x = 0; $x < count($this->retRecords); $x++)
    		{
    			
    			if((int) $this->retRecords[$x]['c30'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-clock-o"></i> 30min</span>
                                      		<span class="pull-right font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c30'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if((int) $this->retRecords[$x]['c1'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-clock-o"></i> 1h</span>
                                      		<span class="pull-right font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c1'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if((int) $this->retRecords[$x]['c2'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-clock-o"></i> 2h</span>
                                      		<span class="pull-right font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c2'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if(!empty($this->retRecords[$x]['c4'])) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-clock-o"></i> 4h</span>
                                      		<span class="pull-right font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c4'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if((int) $this->retRecords[$x]['c8'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-clock-o"></i> 8h</span>
                                      		<span class="pull-right font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c8'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if((int) $this->retRecords[$x]['c12'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-moon-o"></i> Pernoite 12h</span>
                                      		<span class="pull-right font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c12'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if((int) $this->retRecords[$x]['viagem'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-plane"></i> Viagens</span>
                                      		<span class="pull-right font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['viagem'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			}
    			
    			$this->retHTML = '<div class="col-md-12">';
    				$this->retHTML .= $this->complHTML;
    			$this->retHTML .= '</div>';    			
    		}
    
    		return $this->retHTML;
    	}
    }
    
    
    /**
     * Get Create Combo Locations
     * @param unknown $person
     * @return array
     */
    public function fCreateComboLocations($apid = 0)
    {
    	return $this->fQueryComboLocations($apid);
    }
    
    
    /**
     * Get Create Combo Modalities
     * @param unknown $person
     * @return array
     */
    public function fCreateComboModalities($arrModalities = null)
    {
    	return $this->fQueryComboModalities($arrModalities);
    }
    
    
    /**
     * Get Get Person Modalities
     * @param unknown $person
     * @return array
     */
    public function fPersonModalities($apid)
    {
    	return $this->fQueryPersonModalities($this->fEscapeString($apid));
    }
    
    
    /**
     * Get Get Person Cache
     * @param unknown $person
     * @return array
     */
    public function fPersonCache($apid)
    {
    	return $this->fQueryPersonCache($this->fEscapeString($apid));
    }
    
    
    /**
     * Convert integer data to TimeStamp
     * @param integer $integer
     * @return string
     */
    private function fConvertIntToTime($integer)
    {
    	$x = explode('.', $integer);    	
    	$min = 60 * ($x[1]/10);    	
    	if(!empty($x[0]) && !empty($min))
    		return $x[0].':'.$min.'h';
    	elseif(!empty($x[0]) && empty($x[1]))
    		return $x[0].'h';
    	else
    		return $min.'min';
    }
    
    
    /**
     * Upload Files Dinamically
     * @param unknown $files
     * @param unknown $imagePath
     * @return boolean|string
     */
    public function fUploadFiles($files, $imagePath)
    {
    	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
    	
    	foreach ($files as $key => $file)
    	{
    		$ext = explode(".", $file["name"]);
    		$extension = end($ext);
    		
    		if (!file_exists($imagePath))
    			mkdir($imagePath, 0777, true);
    		
    		if (in_array($extension, $allowedExts))
    		{
    			if ($file["error"] > 0)
    			{
    				$this->funcMsg = 'Erro: '. $file["error"];    				
    				return false;
    				
    			}else{
    			
    				$hash = $this->fRandomPassword(12);
    				
    				$newFileName = "doc-".$hash.".".strtolower($extension);
    					 
    				move_uploaded_file($file["tmp_name"],  $imagePath.$newFileName);
    					 
    				$FILES[$key] = $newFileName;
    			}
    				
    		}else{
    				
    			$this->funcMsg = "Documento {$file["name"]} com formato incorreto. Utilize apenas imagens nos formatos (gif, jpeg, jpg ou png)!";    			
    			return false;
    		}	    		
    	} 
    	
    	return $FILES;
    }
}		