<?php

/**
* Classe Coletanea de funcoes - extensao da classe de conexao
* @author Libidinous Development Team
*/
class functions extends queries {
	
	private $hashKeys = '$2a$07$bda7ac69d6c64931a0c53116d';

	private $retHTML;
	
	private $complHTML;
	
	private $javaScript;
	
	private $retRecords;
	
	public $myGender = null;
	
	public $genderPrefer = null;
	
	public $servicePrefer = null;
	
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
			list($this->myGender, $this->genderPrefer, $this->servicePrefer) = explode("_", $_COOKIE['cUserDefinedData']);		
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
 		if ($gender == 'T') $gender = 'Transg&ecirc;nero';
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
             $novo_texto = trim(substr($texto, 0, $ultimo_espaco))." ... <a href='".$url."'><strong>mais detalhes</strong></a>";
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
	public function fWelcomeMessage($name, $gender, $comeback = 0){
		$name = $this->fReduceName($name);
		$comeback = ($comeback == 1 ? 'novamente ' : '');
		if ($gender == "M")
			$str = "Bem Vindo ".$comeback.$name;
		else	
			$str = "Bem Vinda ".$comeback.$name;
				
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
	public function fReference($gender){
		if ($gender == "M")
			$str = "o";
		else
			$str = "a";
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
	 * Libidinous Global Search
	 * @param string $criteria
	 */
	public function fGlobalSearch($criteria)
	{
		$this->retRecords = $this->fQueryGlobalSearch($criteria);
		
		$this->retHTML = null;
		
		if (count($this->retRecords) > 0)
    	{
    				$this->retHTML = '<section id="gallery" class="gallery margin-top-120 bg-white">
							                <!-- Portfolio container-->
							                <div class="container">
							                    <div class="row">
							                        <div class="main-gallery main-model roomy-80">
			    										<div class="col-md-12">
							                                <div class="head_title text-left sm-text-center wow fadeInDown">
							                                    <h3>Busca por \''.$criteria.'\'</h3>
							                                    <h5><em>Pessoas encontradas: '.count($this->retRecords).'</em></h5>				                                    
							                                </div>
							                            </div>
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
																	  		<a href="'.SIS_URL.'person/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['ad'].'">
												                            	<div class="imgPhotoVideoCounterRight"><i class="fa fa-camera"></i> '.$this->retRecords[$x]['count_fotos'].' <i class="fa fa-video-camera"></i> '.$this->retRecords[$x]['count_videos'].'</div>
																	  			<img src="'.SIS_URL.'images/persons/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['thumb'].'" alt="'.$this->retRecords[$x]['apelido'].'" />												                            
													                            <div class="model_caption">
													                            	<h5 class="text-white">'.$this->retRecords[$x]['apelido'].'</h5>
													                        	</div>
												                            </a>
												                    	</div>
												                	</div>';
					    					}
					    				}	               
														                                							
							          $this->retHTML .= '<div style="clear: both;"></div>							
							                        </div>
							                    </div>
							                </div><!-- Portfolio container end -->
							            </section><!-- End off portfolio section -->';
							          			
    	}
    	
    	
    	$_SESSION['sSearchResults'] = $this->retHTML;
		
		return true;
	}
	
	
	/**
	 * Get all site plans
	 * @param integer $type
	 * @param integer $plaid
	 * @return NULL|string
	 */
	public function fGetPlans($type, $plaid = 0)
	{
		$this->retRecords = $this->fQueryPlans(($type == 2 ? 1 : 1));
		
		$link = ($type == 1 ? "javascript:void(0);" : SIS_URL."signin/dashboard");
		$getplan = ($type == 1 ? "getplan" : "");		
	
		if (count($this->retRecords) > 0)
		{
			$this->retHTML = null;
			$showDiscount = false;

			for ($x = 0; $x < count($this->retRecords); $x++)
			{
				
				if ($plaid == 0 || $type == 2)
				{
					$upgradeOrSign = 'Assinar <i class="fa fa-cart-plus"></i>';
					$disableBtn = 'href="'.$link.'" class="btn btn-warning m-top-10 '.$getplan.'"';
					$showDiscount = false;
					
				}elseif ($plaid != $this->retRecords[$x]['plaid'] && $this->retRecords[$x]['plaid'] > 1)
				{
					$upgradeOrSign = 'Alterar para '.$this->retRecords[$x]['plano'].' <i class="fa fa-cart-plus"></i>';
					$disableBtn = 'href="'.$link.'" class="btn btn-primary m-top-10 '.$getplan.'"';
					$showDiscount = false;
					
				}elseif ($plaid != $this->retRecords[$x]['plaid'] && $this->retRecords[$x]['plaid'] < 2)
				{
					$upgradeOrSign = 'Plano j&aacute; utilizado <i class="fa fa-times-circle"></i>';
					$disableBtn = 'href="'.$link.'" disabled class="btn btn-primary m-top-10"';
					$showDiscount = false;
					
				}elseif ($plaid == $this->retRecords[$x]['plaid'] && $this->retRecords[$x]['plaid'] < 2)
				{
					$upgradeOrSign = 'N&atilde;o Permitido <i class="fa fa-times-circle"></i>';
					$disableBtn = 'href="'.$link.'" disabled class="btn btn-primary m-top-10"';
					$showDiscount = false;
					
				}elseif ($plaid == $this->retRecords[$x]['plaid'] && $this->retRecords[$x]['plaid'] > 1)
				{
					$upgradeOrSign = 'Renovar meu Plano Atual <i class="fa fa-star-half-empty"></i>';
					$disableBtn = 'href="'.$link.'" class="btn btn-warning m-top-10 '.$getplan.'"';
					$showDiscount = true;
				}
				
				
				$this->retHTML .= '<div class="col-sm-'.(12 / count($this->retRecords)).'">
                                            <blockquote class="m-top-30 m-l-30">
                                            	<h2>'.$this->retRecords[$x]['plano'].'</h2>		                                            	
                                            	'.$this->retRecords[$x]['descricao'];
								if ($this->retRecords[$x]['valor'] > 0)
								{
									 $cobranca = ($this->retRecords[$x]['cobrancadias'] == 30 ? ' v&aacute;lido por <strong>1</strong> m&ecirc;s' : ($this->retRecords[$x]['cobrancadias'] == 180 ? ' v&aacute;lido por <strong>6</strong> meses' : ' v&aacute;lido por <strong>3</strong> meses'));
		                             if ($showDiscount)
		                             {
		                             	$valorPlano = round($this->retRecords[$x]['valor'] - (($this->retRecords[$x]['valor'] * $this->retRecords[$x]['descontorenovacao']) / 100)) - 0.1;
		                             	$this->retHTML .= '<h4 style="height:25px;"><strike>R$ '.number_format($this->retRecords[$x]['valor'], 2, ",", ".").'</strike></h4>';
		                             	$this->retHTML .= '<h3 style="height:35px;"><strong>R$ '.number_format($valorPlano, 2, ",", ".").'</strong>*</h3>';
		                             	
		                             }else{	
		                             	
		                             	$valorPlano = $this->retRecords[$x]['valor'];
									 	$this->retHTML .= '<h2 style="height:70px;"><strong>R$ '.number_format($valorPlano, 2, ",", ".").'</strong>*</h2>';
		                             }
		                             
									 $this->retHTML .= '<h6>'.$cobranca.'</h6>';
		                             $this->retHTML .= '<p>* at&eacute; '.SIS_PARCELAS_SEM_JUROS.'x sem juros no cart&atilde;o</p>';
		                             
								}else{ 
									
									$this->retHTML .= '<h4 style="height:70px;"><strong>'.SIS_DIAS_GRATIS.' dias gr&aacute;tis*</strong></h4>';
									$this->retHTML .= '<h6>&nbsp;</h6>';
                            		$this->retHTML .= '<p>* upgrade ap&oacute;s expira&ccedil;&atilde;o</p>';
								}
							
								$this->retHTML .= '<a '.$disableBtn.' data-nomplan="'.$this->retRecords[$x]['plano'].'" data-monthplan="'.($this->retRecords[$x]['cobrancadias'] / 30).'" data-valplan="'.$valorPlano.'" data-register="'.$this->retRecords[$x]['plaid'].'">'.$upgradeOrSign.'</a>';
                            
                            
              $this->retHTML .= '</blockquote><hr/>
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

    			$this->retRecords = $this->fQueryFeaturedModels($this->genderPrefer, $this->servicePrefer, 5, 6);
    			
    			if (count($this->retRecords) > 0)
    			{
    				$this->retHTML = '<section id="gallery" class="gallery margin-top-120 bg-white">
							                <!-- Portfolio container-->
							                <div class="container">
							                    <div class="row">
							                        <div class="main-gallery main-model roomy-80">
			    										<div class="col-md-12">
							                                <div class="head_title text-left sm-text-center wow fadeInDown">
							                                    <h3>&Uacute;ltimas Novidades '.SIS_TITULO.'</h3>
							                                    <h5><em>Somente os melhores profissionais voc&ecirc; encontra por aqui. Descubra-os agora!</em></h5>				                                    
							                                </div>
							                            </div>
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
				 												  			<div class="imgPhotoVideoCounterRight"><i class="fa fa-camera"></i> '.$this->retRecords[$x]['count_fotos'].' <i class="fa fa-video-camera"></i> '.$this->retRecords[$x]['count_videos'].'</div>
																	  		<a href="'.SIS_URL.'person/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['ad'].'">
												                            	<img src="'.SIS_URL.'images/persons/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['imagemurl'].'" alt="'.$this->retRecords[$x]['apelido'].'" />												                            
													                            <div class="model_caption">
													                            	<h5 class="text-white">'.$this->retRecords[$x]['apelido'].'</h5>
													                        	</div>
												                            </a>
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
    		
    		case 2:
    			
    			$this->retRecords = $this->fQueryGalleryModels($this->genderPrefer, $this->servicePrefer);
    			 
    			if (count($this->retRecords) > 0)
    			{
    				$this->retHTML = '<section id="gallery" class="gallery margin-top-120 bg-white">
							                <!-- Portfolio container-->
							                <div class="container">
							                    <div class="row">
							                        <div class="main-gallery main-model roomy-80">
			    										<div class="col-md-12">
							                                <div class="head_title text-left sm-text-center wow fadeInDown">
							                                    <h3>Galeria '.SIS_TITULO.'</h3>
							                                    <h5><em>Somente os melhores profissionais voc&ecirc; encontra por aqui. Descubra-os agora!</em></h5>				                                    
							                                </div>
							                            </div>
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
																	  		<a href="'.SIS_URL.'person/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['ad'].'">
												                            	<div class="imgPhotoVideoCounterRight"><i class="fa fa-camera"></i> '.$this->retRecords[$x]['count_fotos'].' <i class="fa fa-video-camera"></i> '.$this->retRecords[$x]['count_videos'].'</div>
																	  			<img src="'.SIS_URL.'images/persons/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['thumb'].'" alt="'.$this->retRecords[$x]['apelido'].'" />												                            
													                            <div class="model_caption">
													                            	<h5 class="text-white">'.$this->retRecords[$x]['apelido'].'</h5>
													                        	</div>
												                            </a>
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
     * @deprecated Soon
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
    	$this->retRecords = $this->fQueryFeaturedModels($this->genderPrefer, $this->servicePrefer, $feature, $limit);
    	
    	if (count($this->retRecords) > 0)
    	{
	    	switch($feature)
	    	{
	    		case 1: # MODELO DESTAQUE POSTER
	    	
	    			if ($this->retRecords[0]['vencimento'] > 0)
	    			{
	    				$this->retHTML = '<section id="hello" class="home style-'.$this->retRecords[0]['person'].$this->retRecords[0]['ad'].' bg-mega">			    					
								                <div class="container">
								                    <div class="row">
								                        <div class="main_home text-center hometext">
								                            <div class="home_text">
								                                <h4 class="text-white text-uppercase shadow-text">DESTAQUE '.SIS_TITULO.'</h4>
								                                <h1 class="text-white text-uppercase shadow-text"><a href="'.SIS_URL.'person/'.$this->retRecords[0]['person'].'/'.$this->retRecords[0]['ad'].'" class="text-white">'.$this->retRecords[0]['apelido'].'</a></h1>
								                                <div class="separator"></div>
								                                <!--h5 class=" text-uppercase text-white shadow-text">
								                                	<em><a href="'.SIS_URL.'person/'.$this->retRecords[0]['person'].'/'.$this->retRecords[0]['ad'].'" class="text-white">'.$this->retRecords[0]['titulo_anuncio'].'</a></em>
								                                </h5-->
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
						                                    <h3>'.$this->retRecords[0]['apelido'].'</h3>
						                                    <h6>'.$this->fGetGenderPerson($this->retRecords[0]['sexo']).' - '.$this->fGetAge($this->retRecords[0]['nascimento']).'</h6>						                                    
						                                </div><!-- End off Head Title -->					
						                                <div class="feature_content wow fadeIn m-top-20">
						                                    <p>'.nl2br($this->retRecords[0]['descricao_pessoa']).'</p>					
						                                </div>
						                                        		
						                                <div class="feature_content wow fadeIn m-top-20"><h6>';  
		    			
							                                if (!empty($this->retRecords[0]['whatsapp'])){ 
						                                		$this->retHTML.= '<span style="padding-right:25px;"><i class="fa fa-whatsapp"></i> <a href="call:'.$this->fRemoveNumFormat($this->retRecords[0]['whatsapp']).'">'.$this->retRecords[0]['whatsapp'].'</a></span>';
						                                	} if (!empty($this->retRecords[0]['tel1'])){ 
						                                		$this->retHTML.= '<span style="padding-right:25px;"><i class="fa fa-phone"></i> <a href="call:'.$this->fRemoveNumFormat($this->retRecords[0]['tel1']).'">'.$this->retRecords[0]['tel1'].'</a></span>';
						                                	} if (!empty($this->retRecords[0]['tel2'])){ 
						                                		$this->retHTML.= '<span style="padding-right:25px;"><i class="fa fa-phone"></i> <a href="call:'.$this->fRemoveNumFormat($this->retRecords[0]['tel2']).'">'.$this->retRecords[0]['tel2'].'</a></span>';
						                                	}	
					                                		
						                                	$this->retHTML.= '</h6><br><h6>';
					                                		
						                                	if (!empty($this->retRecords[0]['facebook'])){ 
						                                		$this->retHTML.= '<span style="padding-right:25px;"><i class="fa fa-facebook"></i> <a href="'.$this->retRecords[0]['facebook'].'" target="_blank">Visite meu Facebook</a></span>';
						                                	} if (!empty($this->retRecords[0]['twitter'])){ 
						                                		$this->retHTML.= '<span style="padding-right:25px;"><i class="fa fa-twitter"></i> <a href="'.$this->retRecords[0]['twitter'].'" target="_blank">@'.$this->retRecords[0]['person'].'</a></span>';
						                                	} if (!empty($this->retRecords[0]['googleplus'])){ 
						                                		$this->retHTML.= '<span style="padding-right:25px;"><i class="fa fa-instagram"></i> <a href="'.$this->retRecords[0]['googleplus'].'" target="_blank">'.ucwords($this->retRecords[0]['apelido']).'</a></span>';
						                                	} 
					                                	
						                                	$this->retHTML.= '</h6>
										                                		<div class="feature_btns m-top-30">
											                                        <a href="'.SIS_URL.'person/'.$this->retRecords[0]['person'].'/'.$this->retRecords[0]['ad'].'" class="btn btn-primary text-uppercase">mais sobre mim  <i class="fa fa-'.$this->retRecords[0]['genero'].'"></i></a>
											                                    </div>
									                   </div>        		
						                                     		
						                            </div>
						                            <div class="col-md-6">
						                                <div class="feature_photo wow fadeIn sm-m-top-40">
						                                    <div class="photo_border"><div class="imgPhotoVideoCounterLeft"><i class="fa fa-camera"></i> '.$this->retRecords[0]['count_fotos'].' <i class="fa fa-video-camera"></i> '.$this->retRecords[0]['count_videos'].'</div></div>
											                											                                        		
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
	    							$direction = ($x % 2 != 0 ? "left" : "right");
	    							$w_s = ($x % 2 != 0 ? 2 : 1);
	    						
					    			$this->retHTML .= '<div class="col-md-7 '.($x == 0 ? 'col-md-offset-5' : '').' col-sm-12 col-xs-12">
						                                <div class="work_item">
						                                    <div class="row">
						                                        <div class="col-md-7 col-sm-12 col-xs-12 text-'.$direction.' pull-'.$direction.' sm-text-center">					    					
						                                            <div class="work_item_img">
												    					<div class="imgPhotoVideoCounterRightPad"><i class="fa fa-camera"></i> '.$this->retRecords[$x]['count_fotos'].' <i class="fa fa-video-camera"></i> '.$this->retRecords[$x]['count_videos'].'</div>
						                                                <img src="'.SIS_URL.'images/persons/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['imagemurl'].'" alt="'.$this->retRecords[$x]['apelido'].'" />
						                                            </div>
						                                        </div>
						                                        <div class="col-md-5 col-sm-12 col-xs-12 text-'.$direction.' pull-'.$direction.' sm-text-center">
						                                            <div class="work_item_details m-top-80 sm-m-top-20">
						                                                <h4>'.$this->retRecords[$x]['apelido'].'</h4>
						                                                <h6>'.$this->fGetGenderPerson($this->retRecords[$x]['sexo']).' - '.$this->fGetAge($this->retRecords[$x]['nascimento']).'</h6>
						                                                <div class="work_separator'.$w_s.'"></div>
						                                                <p class="m-top-40 sm-m-top-10">'.$this->fLimitWords($this->retRecords[$x]['descricao_pessoa'], 250, false, SIS_URL.'person/'.$this->retRecords[0]['person'].'/'.$this->retRecords[0]['ad']).'</p>
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
							                                    <h3>Conhe&ccedil;a Novas Pessoas</h3>
							                                    <h5><em>Somente os melhores perfis selecionados exclusivamente para voc&ecirc;!</em></h5>							                                    
							                                </div>
							                            </div>';
	    			
	    			for ($x = 0; $x < count($this->retRecords); $x++)
	    			{			
	    				if ($this->retRecords[$x]['vencimento'] > 0)
	    				{
				            $this->retHTML .= '<div class="col-md-3 col-sm-6">
				                                <div class="model_item m-top-30 transition metal ">
				            						<a href="'.SIS_URL.'person/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['ad'].'" class="text-white m-top-40">
					                                    <div class="model_img">
				            								<div class="imgPhotoVideoCounterRight"><i class="fa fa-camera"></i> '.$this->retRecords[$x]['count_fotos'].' <i class="fa fa-video-camera"></i> '.$this->retRecords[$x]['count_videos'].'</div>
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
			                                    <a href="'.SIS_URL.'persons"><h4><i class="fa fa-intersex"></i><br>Ver lista completa</h4></a>
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
    
        
    /**
     * Get Person Locations
     * @param array $person
     * @return map Location
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
	    				$km_dist[] = $this->fConvertLatLng2Km($this->cookieLatitude, $this->cookieLongitude, $this->retRecords[$x]['latitude'], $this->retRecords[$x]['longitude']);
	    				
	    				if (min($km_dist) < 10)
	    				{
			    				$this->retHTML .= "map.drawRoute({
								    					origin: [".$this->cookieLatitude.", ".$this->cookieLongitude."],
								    					destination: [".$this->retRecords[$x]['latitude'].", ".$this->retRecords[$x]['longitude']."],
								    					travelMode: 'driving',
								    					strokeColor: '#131540',
								    					strokeOpacity: 0.6,
								    					strokeWeight: 6
								    				});";
	    				}	    				
	    				
	    					$this->retHTML .= "map.addMarker({
									         		  lat: ".$this->retRecords[$x]['latitude'].",
									         		  lng: ".$this->retRecords[$x]['longitude'].",
									         		  title: \"".$this->retRecords[$x]['local']."\",
									         		  icon: '".SIS_URL."assets/images/markers/marker-{$arrPerson[0]['sexo']}.png',
			    										         		  infoWindow: {
			    										         		  content: '<p><strong>".$this->retRecords[$x]['local']."</strong></p>' +
									         	          		    			   '<p>".$this->retRecords[$x]['endereco']."</p>'
									         	        }
								         		}); ";
	    			}
	    			
	    			return $this->retHTML.'</script>';
	    			
	    		break;
	    		
	    		case 2:
	    			
	    			$this->retHTML = '<div class="col-md-12">
                               <hr />
                                <div class="skill_bar m-top-40">    
                                    <div class="row">
                                         <div class="col-md-12 m-bottom-40">
			                                <div class="head_title text-left sm-text-center wow fadeInDown">
			                                    <h3>Onde Atendo?</h3>
			                                    <h5><em>Confira no mapa abaixo os locais onde geralmente realizo os meus atendimentos.';
	    			
	    			
	    			for ($x = 0; $x < count($this->retRecords); $x++)
	    			{
		    			$arrKM[] = $this->fConvertLatLng2Km($this->cookieLatitude, $this->cookieLongitude, $this->retRecords[$x]['latitude'], $this->retRecords[$x]['longitude']); 
	    			}
	    			
	    			if (min($arrKM) < 10) {
	    				$this->retHTML.= '<br><br><h6><strong><i class="fa fa-map-marker"></i> Um dos locais mais pr&oacute;ximos que atendo, fica a '.min($arrKM).' km de voc&ecirc;!</strong></h6>';
	    			}
	    			
	    			$this->retHTML.= '</em></h5>			                            
			                                </div>
			                            </div>			                                                                                             
							            <div id="map" class="map">
							                <div class="ourmap"></div>
							            </div>                                        
                                    </div>
                                </div>
                            </div>';
	    			
	    			return $this->retHTML;
	    			
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
     * Get Person CPF Result if Exists
     * @param unknown $cpf
     * @return boolean
     */
    public function fGetCPF($cpf)
    {
    	return $this->fQueryPersonCPF($this->fEscapeString($cpf));
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
    public function fGetPersonPhotos($apid = 0, $url = null, $numPhotos, $numVideos)
    {
    	$this->retRecords = $this->fQueryCurrentPersonPhotos($apid, $url);

    	$this->retHTML = '<div class="grid text-center mygallery">';
    	
    	$personLogged = ($_SESSION['sPersonLogged'] && $_SESSION['sPersonUrl'] == $url ? true : false);
    	
    	if ($personLogged) {
    	
    		$this->retHTML .= '<div class="grid-item transition metalloid ium" style="background: url(\''.SIS_URL.'assets/img/contrate.jpg\') no-repeat;">
    									<div class="text-center">	                                        
	                                    </div>
                                	</div>';
    	}
    	
    	if (count($this->retRecords) > 0)
    	{
    		
    		for ($x = 0; $x < count($this->retRecords); $x++)
    		{
    			
    			$active = ($personLogged ? '<h4 class="showphoto"><input type="checkbox" value="1" '.($this->retRecords[$x]['ativo'] == '1' ? 'checked' : '').' id="opt'.$this->retRecords[$x]['hash'].'" onclick="enableItem(\''.$this->retRecords[$x]['hash'].'\');"> <i class="fa fa-eye"></i></h4>' : '');
    			$title = ($personLogged ? '<p><input type="text" maxlength="30" placeholder="Informe um t&iacute;tulo para '.($this->retRecords[$x]['local'] == 3 ? 'seu v&iacute;deo' : 'sua foto').'" onblur="setItemValue(this.value, \'\', \''.$this->retRecords[$x]['hash'].'\');" id="title" style="width: 91%; text-align: center; color: #ccc; background: transparent; border: 1px solid #ccc;" value="'.$this->retRecords[$x]['titulo'].'"></p>' : '<h4 class="text-white">'.$this->retRecords[$x]['titulo'].'</h4>');
    			$description = ($personLogged ? '<p><input type="text" placeholder="Descreva '.($this->retRecords[$x]['local'] == 3 ? 'seu v&iacute;deo' : 'sua foto').'" onblur="setItemValue(\'\', this.value, \''.$this->retRecords[$x]['hash'].'\');" id="description" style="width: 91%; text-align: center; color: #ccc; background: transparent; border: 1px solid #ccc;" value="'.$this->retRecords[$x]['descricao'].'"></p>' : '<h5 class="text-white"><em>'.$this->retRecords[$x]['descricao'].'</em></h5>');
    			$delete = ($personLogged ? '<div class="cropControls cropControlsUpload" onclick="removeImg(\''.$this->retRecords[$x]['hash'].'\')"><i class="cropControlRemoveCroppedImage" title="Remover Item"></i></div>' : '');    			
    			
    			$this->retHTML .= '<div class="grid-item transition metalloid ium hash_'.$this->retRecords[$x]['hash'].'" style="background: url(\''.SIS_URL.'images/persons/'.$url.'/'.($this->retRecords[$x]['local'] == 3 ? $this->retRecords[$x]['capture']: $this->retRecords[$x]['thumb']).'\') no-repeat;">                                    	
                                    	'.$delete.'
    									<div class="grid_hover_area text-center">
	                                        <div class="grid_hover_text m-top-90">
	                                            '.$active.'
                                    			'.$title.'
	                                            '.$description.'
	                                            <a href="'.($this->retRecords[$x]['local'] == 3 ? SIS_URL.'images/persons/'.$url.'/'.$this->retRecords[$x]['video'] : SIS_URL.'images/persons/'.$url.'/'.$this->retRecords[$x]['large']).'" class="'.($this->retRecords[$x]['local'] == 3 ? 'video-link' : 'popup-img').' text-white m-top-40">'.($this->retRecords[$x]['local'] == 3 ? 'Reproduzir <i class="fa fa-video-camera"></i>' : 'Ampliar <i class="fa fa-search-plus"></i>').'</a>
	                                        </div>
	                                    </div>		
                                	</div>';
    		}
    	}
    	
    	if ($personLogged) {    	
    		
    		if ($numPhotos <= $_SESSION['sPersonMaxPhotos']) {
    			
    			$diffPhoto = ($_SESSION['sPersonMaxPhotos'] - $numPhotos);
    			$restFotos = '<br>'.($diffPhoto < 2 ? $diffPhoto.' restante' : ($_SESSION['sPersonMaxPhotos'] == 999 ? '' : $diffPhoto.' restantes'));
    			
	    			$this->retHTML .= '
											<div class="container openmodal" data-modal="gallery" id="cropImgGallery">

											    <div class="grid-item metalloid ium addphoto">
											    	<div class="imgGalleryModel">
											      		<div class="grid_hover_area2 text-center">
					                                        <div class="grid_hover_text m-top-110">
					                                            <h4 class="text-white"><i class="fa fa-camera"></i></h4>
				    											<h6 class="text-white">Adicionar Fotos'.$restFotos.'</h6>
					                                        </div>
					                                    </div>
												    </div>
											    </div>

											    <!-- Cropping Gallery modal -->
											    <div class="modal fade" id="galleryModal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
											      <div class="modal-dialog modal-lg">
											        <div class="modal-content">
											          <form role="form" data-toggle="validator" style="text-align:left;" class="avatar-form" action="'.SIS_URL.'images/procimg/crop.php" enctype="multipart/form-data" method="post">
											            <div class="modal-header">
											              <button type="button" class="close" data-dismiss="modal">&times;</button>
											              <h4 class="modal-title">Galeria de Fotos e V&iacute;deos</h4>
											            </div>
											            <div class="modal-body">
											              <div class="avatar-body">
											                <div class="avatar-upload">
											                  <input type="hidden" class="avatar-src" name="avatar_src">
											                  <input type="hidden" class="avatar-data" name="avatar_data">
											                  <input type="hidden" value="'.$apid.'" name="apid">											          		
											                  <input type="hidden" value="'.$_SESSION['sPersonUrl'].'" name="person_url">
															  <input type="hidden" value="gallery" name="imgtype">
											                  
											                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
											                </div>			
											                <div class="row">
											                  <div class="col-md-9">
											                  	<div id="cropper2" class="avatar-wrapper"></div>
								                    			<div id="webcam2" class="divCropperCamera"></div>
											                  </div>
											                  <!--div class="col-md-3">
											                    <div class="avatar-preview preview-lg"></div>			                    
											                  </div-->
											                  <br/>
											                  <div class="col-md-3">
											                    <div class="form-group">
								                                    <input type="checkbox" name="ativo" id="ativo" class="active-img" value="1"> <strong><i class="fa fa-eye"></i> Vis&iacute;vel no site</strong>
								                                 </div>			                    
											                  </div>
											                  <div class="col-md-3">                                                                                          
								                                 <div class="form-group">
								                                 	<label>T&iacute;tulo da Imagem/V&iacute;deo *</label>                                                    
								                                 	<input type="text" id="titulo" name="titulo" data-error="T&iacute;tulo Obrigat&oacute;rio!" required class="form-control" maxlength="60">                                    
											                  		<div class="help-block with-errors"></div>
									                              </div> 
								                              </div>
								                              <div class="col-md-3">
								    							 <div class="form-group">
								                                 	<label>Descri&ccedil;&atilde;o</label>
								                                    <textarea  id="descricao" name="descricao" class="form-control" rows="8"></textarea>
								                                 </div>	                                                
								                              </div>
											                </div>			
											                <div class="row avatar-btns">
											                  <div class="col-md-12">
											                    <div class="btn-group">
											                        <!--button type="button" class="btn btn-primary" data-method="rotate" data-option="-30" title="Girar 30 Graus Antihorario"><i class="fa fa-rotate-left"></i></button>
											                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="30" title="Girar 30 Graus Horario"><i class="fa fa-rotate-right"></i></button-->
											                  		<button type="button" class="btn btn-primary" data-method="zoom" data-option="0.03" title="Mais Zoom"><i class="fa fa-search-plus"></i></button>
   								                      				<button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.03" title="Menos Zoom"><i class="fa fa-search-minus"></i></button>
								                      				<button type="button" id="show-camera2" class="btn btn-primary" title="Usar Webcam"><i class="fa fa-camera"></i></button>
								                      				<button type="button" id="popup-webcam-take-photo2" disabled="disabled" class="btn btn-warning shot" title="Tirar Foto"><i class="fa fa-check-circle"></i></button>
											                    </div>
											                  </div>
															</div>
															<div class="row avatar-btns">
											                  <div class="col-md-3">
											                    <button type="submit" class="btn btn-warning btn-block avatar-save">Salvar</button>
											                  </div>
											                </div>
											              </div>
											            </div>
											          </form>
											        </div>
											      </div>
											    </div>			    
											  </div>
	                                	</div>';
    		}
    		
    		if ($numVideos <= $_SESSION['sPersonMaxVideos']) {
    			
    			$diffVideo = ($_SESSION['sPersonMaxVideos'] - $numVideos);
    			$restVideos = '<br>'.($diffVideo < 2 ? $diffVideo.' restante' : ($_SESSION['sPersonMaxVideos'] == 999 ? '' : $diffVideo.' restantes'));

	    			$this->retHTML .= '<div class="container openmodal" data-modal="gallery" id="cropVideoGallery">
												<div class="grid-item metalloid ium addvideo">
											    	<div class="divVideoModal">
											      		<div class="grid_hover_area2 text-center">
					                                        <div class="grid_hover_text m-top-110">
					                                            <h4 class="text-white"><i class="fa fa-video-camera"></i></h4>
				    											<h6 class="text-white">Gravar V&iacute;deo Pessoal'.$restVideos.'</h6>
					                                        </div>
					                                    </div>
												    </div>
											    </div>

												<!-- Cropping Video modal -->
											    <div class="modal fade" id="videoModal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
											      <div class="modal-dialog modal-lg">
											        <div class="modal-content">
											            <div class="modal-header">
											              <button type="button" class="close" data-dismiss="modal">&times;</button>
											              <h4 class="modal-title">Gravar V&iacute;deo Pessoal</h4>
											            </div>
														<div class="modal-body">
															<div id="containerVideo">
															<div style = "text-align:center;">																
																<video controls autoplay></video><br>
																<div class="btn-group">
																	<button id="rec" class="btn btn-primary" onclick="onBtnRecordClicked()"><i class="fa fa-circle"></i></button>
																	<button id="pauseRes" class="btn btn-primary" onclick="onPauseResumeClicked()" disabled><i class="fa fa-pause"></i></button>
																	<button id="stop" class="btn btn-primary" onclick="onBtnStopClicked()" disabled><i class="fa fa-stop"></i></button>
																	<button id="save" class="btn btn-warning" onclick="saveVideo(\''.$this->fRandomPassword(12).'\', '.$apid.')" disabled><i class="fa fa-check"></i></button>
																</div> 	
															</div>
															<a id="downloadLink" download="mediarecorder.webm" name="mediarecorder.webm" href></a>
															<p id="data"></p>
														</div>
													</div>
								  				  </div>
												</div>
											</div>';
    		}
	    			
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
                                      		<span class="pull-right-mod font-size-pull-right-'.strtolower($gender).'">'.(!empty($this->retRecords[$x]['descricao']) ? '<i class="fa fa-question-circle descr_'.$this->retRecords[$x]['modid'].'"></i>' : '').'</span>
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
     * @param unknown $pesid
     */
    public function fGetCountPersonPhotos($pesid)
    {
    	$this->retRecords = $this->fQueryAllPersonPhotos($pesid);
    
    	return count($this->retRecords);
    }
    
    /**
     * Get Person Count Videos
     * @param unknown $pesid
     */
    public function fGetCountPersonVideos($pesid)
    {
    	$this->retRecords = $this->fQueryAllPersonVideos($pesid);
    
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
                                                        <div class="col-sm-6 pull-left dets">
                                                            <h5 class="text-uppercase">'.$this->retRecords[$x]['titulo'].' ('.$this->retRecords[$x]['visitascount'].' visualiza&ccedil;&otilde;es)</h5>
                                                            <small><em>'.$this->retRecords[$x]['publicacao'].'</em></small>
                                                        </div>
                                                        <div class="col-sm-3 pull-right actions">                                                        	
                                                            <a href="'.SIS_URL.'ad/'.$this->retRecords[$x]['person'].'/'.$this->retRecords[$x]['ad'].'"><i class="fa fa-edit"></i> Editar </a> |
                                                            <a href="'.$adUrl.'"><i class="fa fa-eye"></i> Visualizar </a> |
                                                            <a href="javascript:void(0);" class="remove-ad" data-register="'.$this->retRecords[$x]['apid'].'"><i class="fa fa-trash"></i> Excluir </a>
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
                                      		<span class="pull-right-mod font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c30'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if((int) $this->retRecords[$x]['c1'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-clock-o"></i> 1h</span>
                                      		<span class="pull-right-mod font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c1'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if((int) $this->retRecords[$x]['c2'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-clock-o"></i> 2h</span>
                                      		<span class="pull-right-mod font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c2'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if(!empty($this->retRecords[$x]['c4'])) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-clock-o"></i> 4h</span>
                                      		<span class="pull-right-mod font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c4'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if((int) $this->retRecords[$x]['c8'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-clock-o"></i> 8h</span>
                                      		<span class="pull-right-mod font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c8'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if((int) $this->retRecords[$x]['c12'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-moon-o"></i> Pernoite 12h</span>
                                      		<span class="pull-right-mod font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['c12'].'</span>
                                      	</h6>
                                      	<div class="teamskillbar-bar"></div>
                                   </div><!-- End Skill Bar -->';
    				$pullUp++;
    			} if((int) $this->retRecords[$x]['viagem'] > 0) {
    				$this->complHTML .= '<div class="teamskillbar clearfix m-top-50" data-percent="100%">
                                      	<h6 class="one"><strong><span class="periodo"><i class="fa fa-plane"></i> Viagens</span>
                                      		<span class="pull-right-mod font-size-pull-right-'.strtolower($gender).'">'.$currency.' '.$this->retRecords[$x]['viagem'].'</span>
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