<?php

/**
* Classe para execucao de Queries
*
* @author    Daniel Triboni
* @copyright (c) 2017 - Escort - All Rights Reserved
*/
class queries extends mysqlconn {
		
	private $sqlQuery;
	
	private $sqlQueryCompl;
	
	private $sqlQueryInner;
	
	private $sqlQueryGroup;
	
	private $retRecords;
	
	private $retHTML;
	
	
	/**
	* Class Constructor
	*
	* @author    Daniel Triboni
	* @return    resource
	*/
	public function __construct() {	
		parent::__construct();
	}
	
    
	/**
	 * Query Notification Nav Menu 
	 * @return array
	 */
	public function fQueryNotificationNavMenu(){
	
		$this->sqlQuery = "SELECT
								CONCAT('Seu Perfil ', p.apelido) as titulo,
								'dashboard' as url,
								CASE WHEN (p.aprovado = 1) THEN
						    		'foi aprovado com Sucesso!'
						    	WHEN (p.aprovado = 2) THEN
						    		'<strong>foi reprovado!</strong>'						    	
						    	END AS aprovado
							FROM pessoas p
							WHERE p.lido = 0
							AND p.pesid = {$_SESSION['sPersonID']}
							AND p.aprovado > 0	
						UNION 
							SELECT
								CONCAT('Seu An&uacute;ncio ', ap.titulo) as titulo,
								CONCAT('person/', p.url, '/', ap.url) as url,
								CASE WHEN (ap.aprovado = 1) THEN
						    		'foi publicado com Sucesso!'
						    	WHEN (ap.aprovado = 2) THEN
						    		'<strong>foi reprovado!</strong>'						    	
						    	END AS aprovado
							FROM anuncios_pessoas ap
							INNER JOIN pessoas p ON p.pesid = ap.pesid
							WHERE ap.lido = 0
							AND ap.pesid = {$_SESSION['sPersonID']}
							AND ap.aprovado > 0";
		
		$this->fExecuteSql($this->sqlQuery);
		$this->retRecords = $this->fShowRecords();
		return $this->retRecords;
	}
	
	
	/**
	 * Query Plans in Payment Page
	 * @return array
	 */
	public function fQueryPlans($type = 1, $plaid = null){
		$this->sqlQueryCompl = ($plaid != null ? " AND pl.plaid = {$plaid}" : "");
		$this->sqlQuery = "SELECT
								pl.*
							FROM planos pl
							WHERE pl.ativo = 1
							AND pl.tipo = {$type}
							{$this->sqlQueryCompl}
							ORDER BY pl.plaid ASC";
		$this->fExecuteSql($this->sqlQuery);
		$this->retRecords = $this->fShowRecords();
		return $this->retRecords;
	}
	
	
	/**
	 * Query Notification Counters in Home Page
	 * @return array
	 */
	public function fQueryNotificationCounters(){
	
		$this->sqlQuery = "SELECT 
							(SELECT COUNT(1) FROM pessoas p WHERE p.ativo = 1 AND p.aprovado = 1 AND p.removido = 0) AS pc,
							(SELECT COUNT(1) FROM pessoas p WHERE p.logon = 1 AND p.removido = 0) AS mo,
							(SELECT COUNT(1) FROM pessoas_fotos pf WHERE pf.ativo = 1) AS pr,
							(SELECT COUNT(1) FROM anuncios_pessoas ap WHERE ap.ativo = 1 AND ap.aprovado = 1) AS ac";	
		$this->fExecuteSql($this->sqlQuery);
		$this->retRecords = $this->fShowRecords();
		return $this->retRecords;
	}
	
	
	/**
	 * 
	 * @return Resource#ID
	 */
	public function fQueryNotifications2Read() {
		$this->sqlQuery = "UPDATE anuncios_pessoas SET lido = 1 WHERE pesid = ".$_SESSION['sPersonID'];
		$this->fExecuteSql($this->sqlQuery);		
		$this->sqlQuery = "UPDATE pessoas SET lido = 1 WHERE pesid = ".$_SESSION['sPersonID'];
		return $this->fExecuteSql($this->sqlQuery);
	}
	
	
    /**
	* Save New Person Register
	*	
	* @author    Daniel Triboni
	* @param	 object $_REQUEST 
	* @return	 boolean
	*/
	public function fSaveNewPerson($obj, $files){
		
		$this->sqlQuery = "INSERT INTO pessoas (nome, apelido, url, email, senha, 
												 sexo, genero, etnia, 
												 olhos, cabelos, peso, altura, 
												 busto, cintura, quadril, pcm,
												 whatsapp, tel1, tel2,
												 facebook, twitter, googleplus, 
												 rg, cpf, nascimento, naturalidade,
												 documento, comprovacao, dtultimoacesso)
										 VALUES ('".$obj['nome']."', '".$obj['apelido']."', '".$obj['url']."', '".$obj['email']."', '".md5($obj['senha'])."', 
										 	     '".$obj['sexo']."', '".$obj['genero']."', '".$obj['etnia']."', 
										 	     '".$obj['olhos']."', '".$obj['cabelos']."', '".$obj['peso']."', '".$obj['altura']."',  
										 		 '".$obj['busto']."', '".$obj['cintura']."', '".$obj['quadril']."', '".$obj['pcm']."', 
										 		 '".$obj['whatsapp']."', '".$obj['tel1']."', '".$obj['tel2']."',
										 		 '".$obj['facebook']."', '".$obj['twitter']."', '".$obj['googleplus']."',
										 		 '".$obj['rg']."', '".$obj['cpf']."', '".$obj['nascimento']."', '".$obj['naturalidade']."',
										 		 '".$files['documento']."', '".$files['comprovacao']."', now())";
		
		if($this->fExecuteSql($this->sqlQuery))
		{
			$_SESSION['sPersonLogged'] = true;
			$_SESSION['sPersonID'] = $this->fGetLastInsertID();
			$_SESSION['sPersonUrl'] = $obj['url'];
			$_SESSION['sPersonAka'] = $obj['apelido'];
			$_SESSION['sPersonName'] = $obj['nome'];
			$_SESSION['sPersonEmail'] = $obj['email'];
			$_SESSION['sPersonGender'] = $obj['sexo'];
			$_SESSION['sPersonLastLogon'] = null;
			$_SESSION['sPersonPlanID'] = 0;
			$_SESSION['sPersonMaxAds'] = 0;
			$_SESSION['sPersonMaxPhotos'] = 0;
			$_SESSION['sPersonMaxVideos'] = 0;
			$_SESSION['sPersonSessionTime'] = time();
			return true;
		}
	}
	
	
	/**
	 * Update Person Register
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fUpdateCurrentPerson($obj){
		
		$this->sqlQuery = "UPDATE pessoas SET   
									nome = '".$obj['nome']."', 												  
									senha = '".md5($obj['senha'])."',
									sexo = '".$obj['sexo']."', 
									genero = '".$obj['genero']."', 
									etnia = '".$obj['etnia']."',
									olhos = '".$obj['olhos']."', 
									cabelos = '".$obj['cabelos']."', 
									peso = '".$obj['peso']."', 
									altura = '".$obj['altura']."',
									busto = '".$obj['busto']."', 
									cintura = '".$obj['cintura']."', 
									quadril = '".$obj['quadril']."', 
									pcm = '".$obj['pcm']."',
									whatsapp = '".$obj['whatsapp']."', 
									tel1 = '".$obj['tel1']."', 
									tel2 = '".$obj['tel2']."',
									facebook = '".$obj['facebook']."', 
									twitter = '".$obj['twitter']."', 
									googleplus = '".$obj['googleplus']."',												
									nascimento = '".$obj['nascimento']."', 
									naturalidade = '".$obj['naturalidade']."'
							WHERE pesid = ".$_SESSION['sPersonID'];
		
		return $this->fExecuteSql($this->sqlQuery);									
	}
	
	
	/**
	 * Save New Person Ad
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fSaveNewAd($obj){
	
		$this->sqlQuery = "INSERT INTO anuncios_pessoas (titulo, descricao, ativo, url, 
														 pessoasatendimento, idiomas, 
														 moeda, locaisatendimento, localproprio, pesid)
							VALUES ('".$obj['titulo']."', '".$obj['descricao']."', 1, '".$obj['url']."',
									'".join(", ", $obj['pessoasatendimento'])."', '".join(", ", $obj['idiomas'])."', 
									'".$obj['moeda']."', '".$obj['locaisatendimento']."', '".$obj['localproprio']."', {$_SESSION['sPersonID']})";
	
		if($this->fExecuteSql($this->sqlQuery))
		{
			$obj['apid'] = $this->fGetLastInsertID();
			
			if ($this->fAdLocations($obj))
			{			
				if($this->fAdModalities($obj))
				{
					return $this->fAdCaches($obj);
				}else{
						
					return false;
				}
				
			}else{
				
				return false;
			}
		}else{
				
			return false;
		}
	}
	
	
	/**
	 * Save New Person Ad
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fQuerySavePersonPlan($obj){
	
		$this->sqlQuery = "INSERT INTO planos_pessoas (plaid, pesid)
							VALUES (".$obj['plaid'].", {$_SESSION['sPersonID']})";
	
		if($this->fExecuteSql($this->sqlQuery))
		{
			$obj['ppid'] = $this->fGetLastInsertID();
			
			$_SESSION['sPersonPlanID'] = $obj['plaid'];
			$_SESSION['sPersonPlanPaid'] = $obj['pago'];
			$_SESSION['sPersonPlanName'] = $obj['name'];
			$_SESSION['sPersonPlanExpires'] = $obj['vencimento'];
			$_SESSION['sPersonMaxAds'] = $obj['ads'];
			$_SESSION['sPersonMaxPhotos'] = $obj['photos'];
			$_SESSION['sPersonMaxVideos'] = $obj['videos'];
			
			if($this->fQueryPaymentPlans($obj))
			{
				return true;
			}else{
					
				return false;
			}
			
		}else{
	
			return false;
		}
	}
	
	
	/**
	 * Payment Plans of Person
	 * @param object $obj
	 */
	private function fQueryPaymentPlans($obj){
		
		$this->sqlQuery = "INSERT INTO planos_pagamentos (ppid, psid, vloriginal, pago, vencimento)
							VALUES (".$obj['ppid'].", '".$obj['psid']."', ".$obj['vloriginal'].", ".($obj['pago'] == 1 ? 1 : '0').", '".$obj['vencimento']."')";
		
		if($this->fExecuteSql($this->sqlQuery))
		{
			return true;
			
		}else{
			return false;
		}
	}
	
	
	
	public function getAcquiredPlans($psid) {
		$this->sqlQuery = "SELECT *
							FROM planos_pagamentos pp2
							INNER JOIN planos_pessoas pp ON pp.ppid = pp2.ppid
							INNER JOIN planos pl ON pl.plaid = pp.plaid
							INNER JOIN pessoas p ON p.pesid = pp.pesid
							WHERE pp2.psid = '{$psid}'";
		$this->fExecuteSql($this->sqlQuery);
		$this->retRecords = $this->fShowRecords();
		return $this->retRecords;
	}
	
	
	/**
	 * Update Person Ad
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fUpdateAd($obj){
	
		$this->sqlQuery = "UPDATE anuncios_pessoas SET
									titulo = '".$obj['titulo']."',
									descricao = '".$obj['descricao']."',
									ativo = ".(is_null($obj['ativo']) ? 0 : 1).",
									url = '".$obj['url']."',
									pessoasatendimento = '".join(", ", $obj['pessoasatendimento'])."',
									idiomas = '".join(", ", $obj['idiomas'])."',
									moeda = '".$obj['moeda']."',
									localproprio = '".$obj['localproprio']."',
									locaisatendimento = '".$obj['locaisatendimento']."'
							WHERE apid = ".$obj['apid'];
	
		if($this->fExecuteSql($this->sqlQuery))
		{
			if($this->fAdLocations($obj))
			{
				if($this->fAdModalities($obj))
				{
					return $this->fAdCaches($obj);
				}else{
				
					return false;
				}
				
			}else{
				
				return false;			
			}
		}else{
			
			return false;
		}
	}
	
	
	/**
	 * Remove Person Ad
	 *
	 * @author    Daniel Triboni
	 * @param	 integer $apid
	 * @return	 boolean
	 */
	public function fRemoveAd($apid){
		$this->sqlQuery = "DELETE FROM destaque_pessoas WHERE apid = ".$apid;
		if($this->fExecuteSql($this->sqlQuery))
		{
			$this->sqlQuery = "DELETE FROM pessoas_fotos WHERE apid = ".$apid;
			if($this->fExecuteSql($this->sqlQuery))
			{
				$this->sqlQuery = "DELETE FROM pessoas_cache WHERE apid = ".$apid;
				if($this->fExecuteSql($this->sqlQuery))
				{
					$this->sqlQuery = "DELETE FROM modalidades_pessoas WHERE apid = ".$apid;
					if($this->fExecuteSql($this->sqlQuery))
					{
						$this->sqlQuery = "DELETE FROM locais_pessoas WHERE apid = ".$apid;
						if($this->fExecuteSql($this->sqlQuery))
						{
							$this->sqlQuery = "DELETE FROM anuncios_pessoas WHERE apid = ".$apid;
							return $this->fExecuteSql($this->sqlQuery);
							
						}else{
							
							return false;
						}
							
					}else{
							
						return false;
					}
						
				}else{
			
					return false;
				}
					
			}else{
					
				return false;
			}
			
		}else{
			
			return false;			
		}		
	}
	
	
	/**
	 * Save Ad Locations
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	private function fAdLocations($obj){
	
		$this->sqlQuery = "DELETE FROM locais_pessoas WHERE apid = ".$obj['apid'];
		if($this->fExecuteSql($this->sqlQuery))
		{
			$this->sqlQueryCompl = "INSERT INTO locais_pessoas (apid, local, endereco, latitude, longitude, ativo) VALUES ";
			
			foreach ($obj['localidades'] as $localidades)
			{
				$location = explode("|", $localidades);
				
				$this->sqlQueryCompl .= "({$obj['apid']}, '{$location[0]}', '{$location[1]}', '{$location[2]}', '{$location[3]}', 1), ";
			}	
			
			return $this->fExecuteSql(substr($this->sqlQueryCompl, 0, strlen($this->sqlQueryCompl)-2));
				
		}else{
				
			return false;
		}
	}
	
	
	/**
	 * Save Ad Modalities
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	private function fAdModalities($obj){
	
		$this->sqlQuery = "DELETE FROM modalidades_pessoas WHERE apid = ".$obj['apid'];	
		if($this->fExecuteSql($this->sqlQuery))
		{
				
			$this->sqlQueryCompl = "INSERT INTO modalidades_pessoas (modid, apid, ativo) VALUES ";
			foreach ($obj['modalidades'] as $modid)
			{
				$this->sqlQueryCompl .= "({$modid}, {$obj['apid']}, 1), ";				
			}
			
			return $this->fExecuteSql(substr($this->sqlQueryCompl, 0, strlen($this->sqlQueryCompl)-2));
			
		}else{
			
			return false;
		}
	}
	
	
	/**
	 * Save Ad Caches
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	private function fAdCaches($obj){
	
		$this->sqlQuery = "DELETE FROM pessoas_cache WHERE apid = ".$obj['apid'];
		if($this->fExecuteSql($this->sqlQuery))
		{
			$this->sqlQueryCompl = "INSERT INTO pessoas_cache (apid, c30, c1, c2, 
																c4, c8, c12, viagem)
									VALUES ('{$obj['apid']}', '{$obj['c30']}', '{$obj['c1']}', '{$obj['c2']}', 
											'{$obj['c4']}', '{$obj['c8']}', '{$obj['c12']}', '{$obj['viagem']}') ";
			return $this->fExecuteSql($this->sqlQueryCompl);
				
		}else{
				
			return false;
		}
	}
    
	
    /**
	* Query SQL Errors
	*	
	* @author    Daniel Triboni
	* @return	 array
	*/
    private function fQueryErrorsSaved(){
    	$sql = "SELECT
    				e.id,
    				DATE_FORMAT(e.err_data, '%d/%m/%Y') AS data_erro,
    				DATE_FORMAT(e.err_data, '%H:%i') AS hora_erro,
    				e.err_banco,
    				e.err_erro
    			FROM tblerros e
    			WHERE e.err_enviadoalerta = 'N'
    			ORDER BY e.err_data ASC";
    	$this->fExecuteSql($sql);
    	$ret = $this->fShowRecords();
    	return $ret;
    }
    
    
    /**
	* Update Errors Sent via Email
	*	
	* @author    Daniel Triboni
	* @param	 integer ID
	* @return	 boolean
	*/
    private function fUpdateQueryErrorsSent($id){
    	$sql = "UPDATE tblerros SET err_enviadoalerta = 'S' WHERE id = ".$id;
    	$this->fExecuteSql($sql);
    	return true;	
    }
    
    
    /**
     * Update Person Plan to Paid or Cancel
     * @param unknown $obj
     * @return boolean
     */
    public function fUpdatePersonPlan($obj){
    	$this->sqlQuery = "UPDATE planos_pagamentos SET 
			    					pagamento = '{$obj['pagamento']}',
			    					pago = {$obj['pago']},
			    					vlcorrigido = {$obj['vlcorrigido']},
			    					vencimento = '{$obj['vencimento']}'    					
			    			WHERE psid = '{$obj['psid']}'
			    			AND ppid = {$obj['ppid']}";
    	$this->fExecuteSql($this->sqlQuery);
    	return true;
    }
    
    
    /**
     * Get Featured Models By PSID
     * @param integer $apid
     */
    public function fGetPersonAdsToInsertFeatureds($psid){
    	$this->sqlQuery = "SELECT 
			    					ap.apid
							FROM planos_pagamentos pp2
							INNER JOIN planos_pessoas pp ON pp.ppid = pp2.ppid
							INNER JOIN pessoas p ON p.pesid = pp.pesid
							INNER JOIN anuncios_pessoas ap ON ap.pesid = p.pesid
							WHERE pp2.psid = '{$psid}'";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Delete Featured Models Before Insert
     * @param integer $apid     
     */
    public function fDeleteFeaturedModelsBeforeInsert($apid){
    	$this->sqlQuery = "DELETE FROM destaque_pessoas WHERE apid = {$apid}";
    	$this->fExecuteSql($this->sqlQuery);
    	return true;
    }
    
    
    /**
     * Insert Featured Models By Plans
     * @param integer $apid
     * @param integer $feature
     * @param date $start
     * @param date $end
     */
    public function fInsertFeaturedModelsByPlans($apid, $feature, $start, $end){
    	$this->sqlQuery = "INSERT INTO destaque_pessoas (apid, destaque, inicio, final) VALUES ";
    	$this->sqlQuery.= "({$apid}, {$feature}, '{$start}', '{$end}')";
    	$this->fExecuteSql($this->sqlQuery);
    	return true;
    }
       
    
    /**
     * Query Featured Models in Home Page
     * @param unknown $gender
     * @param unknown $feature
     * @param unknown $limit
     */
    public function fQueryFeaturedModels($gender, $feature, $limit){
    	$this->sqlQueryCompl = (!empty($gender) ? "AND p.sexo = '{$gender}'" : "");
    	$this->sqlQuery = "SELECT		    				
		    				p.apelido,
		    				p.genero,
		    				p.url AS person,
		    				ap.url AS ad,
		    				ap.titulo AS titulo_anuncio,
		    				pf.imagemurl,
		    				pf.descricao AS descricao_foto,
		    				ap.descricao AS descricao_pessoa,
		    				IFNULL((SELECT pfc.imagemurl AS cover 
							     FROM pessoas_fotos pfc 
							     WHERE pfc.apid = ap.apid 
							     AND pfc.ativo = 1 
							     AND pfc.local = 4 
							     AND pfc.tipo = 1 
							     AND pfc.principal = 'S'
							     ORDER BY pfc.fotid DESC LIMIT 1), '../no-cover.jpg') AS cover,
		    				(SELECT 
								DATEDIFF(pp2.vencimento, now()) 
							 FROM planos_pagamentos pp2
							 INNER JOIN planos_pessoas pp ON pp.ppid = pp2.ppid								 
							 WHERE pp2.ppid = pp.ppid
							 AND pp.pesid = p.pesid
							 AND pp2.pago = 1 
							 ORDER BY pp2.pgid DESC LIMIT 1) AS vencimento,
		    				NULL AS localizacao
		    			FROM destaque_pessoas dp
		    			INNER JOIN anuncios_pessoas ap ON ap.apid = dp.apid
		    			INNER JOIN pessoas_fotos pf ON pf.apid = ap.apid
		    			INNER JOIN pessoas p ON p.pesid = ap.pesid
		    			WHERE ap.ativo = 1
		    			AND ap.aprovado = 1 
		    			AND p.aprovado = 1 
		    			AND p.ativo = 1
		    			AND p.removido = 0 
		    			{$this->sqlQueryCompl}
		    			AND pf.ativo = 1 
    					AND pf.principal = 'S'
    					AND pf.local = 1
    					AND pf.tipo = 1
		    			AND dp.destaque = {$feature}    					
		    			AND NOW() BETWEEN dp.inicio AND dp.final
		    			GROUP BY p.url
		    			ORDER BY rand() LIMIT {$limit}";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Query Gallery Models
     * @param unknown $gender
     */
    public function fQueryGalleryModels($gender){
    	$this->sqlQueryCompl = (!empty($gender) ? "AND p.sexo = '{$gender}'" : "");
    	$this->sqlQuery = "SELECT
    							ap.url AS ad,
    							p.url AS person,
						    	p.apelido,
						    	p.genero,						    	
    							ap.pessoasatendimento, 
    							(SELECT 
									DATEDIFF(pp2.vencimento, now()) 
								 FROM planos_pagamentos pp2
								 INNER JOIN planos_pessoas pp ON pp.ppid = pp2.ppid								 
								 WHERE pp2.ppid = pp.ppid
								 AND pp.pesid = p.pesid	
								 AND pp2.pago = 1 
								 ORDER BY pp2.pgid DESC LIMIT 1) AS vencimento,
    						IFNULL((SELECT pf.imagemurl AS thumb 
							     FROM pessoas_fotos pf 
							     WHERE pf.apid = ap.apid 
							     AND pf.ativo = 1 
							     AND pf.local = 1 
							     AND pf.tipo = 1 
							     AND pf.principal = 'S'
							     ORDER BY pf.fotid DESC LIMIT 1), 0) AS thumb
					    	FROM anuncios_pessoas ap
					    	INNER JOIN pessoas p ON p.pesid = ap.pesid					    	
					    	WHERE ap.ativo = 1
					    	AND p.ativo = 1
					    	AND ap.aprovado = 1
					    	AND p.aprovado = 1 
					    	AND p.removido = 0 
					    	AND EXISTS ((SELECT pfc.fotid
										     FROM pessoas_fotos pfc 
										     WHERE pfc.apid = ap.apid 
										     AND pfc.ativo = 1 
										     AND pfc.local = 1 
										     AND pfc.tipo = 2 
										     AND pfc.principal = 'S')) 
    						{$this->sqlQueryCompl}
    						GROUP BY ad, person, apelido, genero    						
					    	ORDER BY rand()";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Get Query All Person Ads
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryAllPersonAds($pesid){    	
    	$this->sqlQuery = "SELECT
    							ap.apid,
						    	ap.titulo,
						    	ap.descricao,
						    	ap.url AS ad,
						    	ap.visitascount,
						    	CASE WHEN (ap.aprovado = 1) THEN
						    		DATE_FORMAT(ap.cadastro, 'Publicado em %d/%m/%Y as %H:%i:%s')
						    	WHEN (ap.aprovado = 2) THEN
						    		'<strong>REPROVADO!</strong>'
						    	ELSE
						    		'<strong>PENDENTE DE APROVA&Ccedil;&Atilde;O!</strong>'
						    	END AS publicacao,
						    	p.url AS person,
						    	IFNULL((SELECT pf.imagemurl AS thumb
						    	FROM pessoas_fotos pf
						    	WHERE pf.apid = ap.apid
						    	AND pf.local = 1
						    	AND pf.tipo = 1
						    	AND pf.principal = 'S'
						    	ORDER BY pf.fotid DESC LIMIT 1), '../no-portrait.jpg') AS thumb    	
					    	FROM anuncios_pessoas ap
					    	INNER JOIN pessoas p ON p.pesid = ap.pesid
					    	WHERE p.pesid = {$pesid} AND p.removido = 0 
    						ORDER BY ap.visitascount DESC, ap.aprovado DESC, ap.cadastro DESC";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Get Query All Person Photos
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryAllPersonPhotos($pesid){
    	$this->sqlQuery = "SELECT
					    		pf.fotid
					    	FROM pessoas_fotos pf
					    	INNER JOIN anuncios_pessoas ap ON ap.apid = pf.apid
					    	INNER JOIN pessoas p ON p.pesid = ap.pesid
					    	WHERE p.pesid = {$pesid}";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Save User to Newsletter
     * @param string $name
     * @param string $email
     * @param string $message
     * @return Resource#ID
     */
    public function fQuerySaveNewsletter($name, $email, $message) {
    	$this->sqlQuery = "INSERT INTO newsletter (nome, email, mensagem) VALUES 
    					   ('{$name}', '{$email}', '{$message}')";
    	return $this->fExecuteSql($this->sqlQuery);
    }
    
    
   /**
	* Get Query Person Ad
	*	
	* @author    Daniel Triboni
	* @return	 array
	*/
	public function fQueryAdPerson($person, $ad){
		$this->sqlQueryCompl = ($_SESSION['sPersonLogged'] == true && $_SESSION['sPersonUrl'] == $person ? "" : " AND p.aprovado = 1 AND ap.aprovado = 1 ");
    	$this->sqlQuery = "SELECT
								ap.*,
								p.*,
								(SELECT 
									DATEDIFF(pp2.vencimento, now()) 
								 FROM planos_pagamentos pp2
								 INNER JOIN planos_pessoas pp ON pp.ppid = pp2.ppid								 
								 WHERE pp2.ppid = pp.ppid
								 AND pp.pesid = p.pesid								 
								 ORDER BY pp2.pgid DESC LIMIT 1) AS vencimento,
								p.url AS person,
								ap.url AS ad,
							IFNULL((SELECT pf.imagemurl AS thumb 
							     FROM pessoas_fotos pf 
							     WHERE pf.apid = ap.apid 
							     AND pf.ativo = 1 
							     AND pf.local = 1 
							     AND pf.tipo = 1 
							     AND pf.principal = 'S'
							     ORDER BY pf.fotid DESC LIMIT 1), '../no-portrait.jpg') AS thumb,			    				
							IFNULL((SELECT pfc.imagemurl AS cover 
							     FROM pessoas_fotos pfc 
							     WHERE pfc.apid = ap.apid 
							     AND pfc.ativo = 1 
							     AND pfc.local = 4 
							     AND pfc.tipo = 1 
							     AND pfc.principal = 'S'
							     ORDER BY pfc.fotid DESC LIMIT 1), '../no-cover.jpg') AS cover
							FROM anuncios_pessoas ap
							INNER JOIN pessoas p ON p.pesid = ap.pesid							
							WHERE ap.ativo = 1
							AND p.ativo = 1  			    						    		
							{$this->sqlQueryCompl}							
							AND ap.url = '{$ad}'
							AND p.url = '{$person}'";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;	
    }
    
    
    /**
     * Get Query Person Register
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryPersonRegister($person){
    	$this->sqlQuery = "SELECT
					    		p.*,
					    		DATE_FORMAT(p.nascimento, '%d/%m/%Y') AS nascimento,					    		
					    		CASE WHEN p.aprovado = 1 THEN
					    			'<i class=\"fa fa-check\"></i> PERFIL APROVADO COM SUCESSO!'
					    		WHEN p.aprovado = 2 THEN
					    			'<i class=\"fa fa-remove\"></i> PERFIL REPROVADO!'
					    		ELSE
					    			'<i class=\"fa fa-warning\"></i> SEU PERFIL EST&Aacute; EM FASE DE APROVA&Ccedil;&Atilde;O!'
					    		END AS status,
					    		CASE WHEN p.aprovado = 2 THEN
					    			p.mensagem
					    		ELSE
					    			''
					    		END AS mensagem					    		
					    	FROM pessoas p    	
					    	WHERE p.url = '{$person}'";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Get Query Ad Title
     *
     * @author    Daniel Triboni
     * @return	 boolean
     */
    public function fQueryPersonAdTitle($title, $apid){
    	$this->sqlQueryCompl = (!is_null($apid) ? " AND ap.apid <> {$apid}" : "");
    	$this->sqlQuery = "SELECT
					    		ap.titulo
					    	FROM anuncios_pessoas ap
					    	WHERE ap.titulo = '{$title}'
					    	{$this->sqlQueryCompl} 
    						AND ap.pesid = ".$_SESSION['sPersonID'];    	
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return (count($this->retRecords) == 0 ? true : false);
    }
    
    
    /**
     * Get Query Person AKA
     *
     * @author    Daniel Triboni
     * @return	 boolean
     */
    public function fQueryPersonAka($aka){
    	$this->sqlQuery = "SELECT
					    		p.apelido
					    	FROM pessoas p
					    	WHERE p.apelido = '{$aka}'";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return (count($this->retRecords) == 0 ? true : false);
    }
    
    
    /**
     * Get Query Person Email
     *
     * @author    Daniel Triboni
     * @return	 boolean
     */
    public function fQueryPersonEmail($email){
    	$this->sqlQuery = "SELECT
					    		p.email
					    	FROM pessoas p
					    	WHERE p.email = '{$email}'";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return (count($this->retRecords) == 0 ? true : false);
    }
    
    
    /**
     * Get Query Person Email
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryRetrievePassword($email){
    	$this->sqlQuery = "SELECT
						    		p.*
						    	FROM pessoas p
						    	WHERE p.email = '{$email}'";    	
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Query to Update Person Credentials
     * @param string $email
     * @param string $password
     */
    public function fQueryUpdatePersonCredentials($email, $password) {
    	$this->sqlQuery = "UPDATE pessoas SET
    							senha = '".md5($password)."'
					    	WHERE email = '{$email}'";
    	$this->fExecuteSql($this->sqlQuery);    	
    	return true;
    }
    
    
    /**
     * Query to Remove Person Logically
     * @param integer $pesid     
     */
    public function fQueryRemovePerson($pesid) {
    	$this->sqlQuery = "UPDATE pessoas SET
    							removido = 1
        							WHERE pesid = {$pesid}";
    	$this->fExecuteSql($this->sqlQuery);
    	return true;
    }
    
    
    /**
     * Get Query Person Ad
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryEditPersonAd($person, $ad){
    	$this->sqlQuery = "SELECT
								ap.*
							FROM anuncios_pessoas ap							
							INNER JOIN pessoas p ON p.pesid = ap.pesid
							WHERE ap.url = '{$ad}' 
							AND p.url = '{$person}'";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Get Query Person Modalities
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryPersonModalities($apid){
    	if (!empty($apid))
    	{
	    	$this->sqlQuery = "SELECT
						    		mp.modid
						    	FROM modalidades_pessoas mp					    	
						    	WHERE mp.apid = {$apid}";
	    	$this->fExecuteSql($this->sqlQuery);
	    	$this->retRecords = $this->fShowRecords();
	    	return $this->retRecords;
    	}
    }
    
    
    /**
     * Get Query Person Cache
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryPersonCache($apid){
    	if (!empty($apid))
    	{
    		$this->sqlQuery = "SELECT
					    			pc.*
					    		FROM pessoas_cache pc
					    		WHERE pc.apid = {$apid}";
    		$this->fExecuteSql($this->sqlQuery);
    		$this->retRecords = $this->fShowRecords();
    		return $this->retRecords;
    	}
    }
    
    
    /**
     * Update Counter Ad Visits
     *
     * @author   Daniel Triboni
     * @return	 boolean
     */
    public function fQueryUpdateVisitCount($apid){    	
	    $this->sqlQuery = "UPDATE anuncios_pessoas SET visitascount = visitascount + 1 WHERE apid = {$apid}";
	    $this->fExecuteSql($this->sqlQuery);    	
    	return true;
    }
    
    
    /**
     * Query Person Locations
     *
     * @author    Daniel Triboni
     * max latutude and min longitude
     * @return	 array
     */
    public function fQueryPersonLocations($apid){
    	$this->sqlQuery = "SELECT
						    	lp.*,
						    	(SELECT 
						    		MAX(lp1.latitude) 
						    	FROM locais_pessoas lp1 
						    	WHERE lp1.apid = ap.apid 
						    	AND lp1.ativo = 1 						    	
						    	HAVING COUNT(lp1.locid) > 1) AS max_latitude,						    	
						    	(SELECT 
						    		MIN(lp2.longitude) 
						    	FROM locais_pessoas lp2 
						    	WHERE lp2.apid = ap.apid 
						    	AND lp2.ativo = 1 						    	
						    	HAVING COUNT(lp2.locid) > 1) AS min_longitude						    							    	
					    	FROM locais_pessoas lp
					    	INNER JOIN anuncios_pessoas ap ON ap.apid = lp.apid					    	
					    	WHERE lp.ativo = 1
					    	AND lp.ativo = 1
					    	AND ap.apid = {$apid}
    						ORDER BY lp.locid ASC";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Show person photos except cover photo
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryCurrentPersonPhotos($apid){
    	$this->sqlQuery = "SELECT
    						pf.hash,
    						IFNULL((SELECT pft.ativo AS ativo
							     FROM pessoas_fotos pft 
							     WHERE pft.hash = pf.hash 							     
							     AND pft.local = 2 
							     AND pft.tipo = 2 
							     AND pft.principal = 'S'), '') AS ativo,
    						IFNULL((SELECT pft.titulo AS titulo
							     FROM pessoas_fotos pft 
							     WHERE pft.hash = pf.hash 
							     AND pft.ativo = 1 
							     AND pft.local = 2 
							     AND pft.tipo = 2 
							     AND pft.principal = 'S'), '') AS titulo,
							IFNULL((SELECT pft.descricao AS descricao
							     FROM pessoas_fotos pft 
							     WHERE pft.hash = pf.hash 
							     AND pft.ativo = 1 
							     AND pft.local = 2 
							     AND pft.tipo = 2 
							     AND pft.principal = 'S'), '') AS descricao,	
							IFNULL((SELECT pft.imagemurl AS thumb 
							     FROM pessoas_fotos pft 
							     WHERE pft.hash = pf.hash 
							     AND pft.ativo = 1 
							     AND pft.local = 2 
							     AND pft.tipo = 1 
							     AND pft.principal = 'S'), 'no-thumb.jpg') AS thumb,
					    	IFNULL((SELECT pfl.imagemurl AS large 
							     FROM pessoas_fotos pfl 
							     WHERE pfl.hash = pf.hash 
							     AND pfl.ativo = 1 
							     AND pfl.local = 2 
							     AND pfl.tipo = 2 
							     AND pfl.principal = 'S'), 'no-large.jpg') AS large
					    	FROM pessoas_fotos pf
					    	WHERE pf.fotid > 1
					    	AND pf.apid = {$apid}
					    	AND pf.local NOT IN (1,4)
					    	GROUP BY pf.hash
    						ORDER BY pf.fotid ASC";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Query Current Person Modalities
     *
     * @param  integer $apid
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryCurrentPersonModalities($apid){
    	$this->sqlQuery = "SELECT
    						m.modid,
    						UPPER(m.modalidade) AS modalidade, m.descricao, m.tipo							    	
				    	FROM modalidades_pessoas mp
				    	INNER JOIN modalidades m ON m.modid = mp.modid				    	
				    	WHERE mp.ativo = 1
				    	AND m.ativo = 1				    					    
				    	AND mp.apid = {$apid}
				    	GROUP BY m.modalidade
				    	ORDER BY 1 ASC";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Query Combo Locations
     * @param array $arrLocations
     * @return string|NULL
     */
    public function fQueryComboLocations($apid){
    	$modalities = array();
    	$this->sqlQuery = "SELECT l.*
    						FROM locais_pessoas l
					    	WHERE l.apid = {$apid}
					    	ORDER BY l.locid DESC";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	$this->retHTML = null;
    	 
    	for ($x = 0; $x < count($this->retRecords); $x++)
    	{
    		$this->retHTML .= '<option value="'.$this->retRecords[$x]['local'].'|'.
    											$this->retRecords[$x]['endereco'].'|'.
    										    $this->retRecords[$x]['latitude'].'|'.
    											$this->retRecords[$x]['longitude'].'" selected>'.$this->retRecords[$x]['local'].'</option>';
    	}
    	 
    	return $this->retHTML;
    }
    
    
    /**
     * Query Combo Modalities
     * @param array $arrModalities
     * @return string|NULL
     */
    public function fQueryComboModalities($arrModalities){
    	$modalities = array();
    	$this->sqlQuery = "SELECT mo.modid,
			    				   mo.modalidade,
    							   mo.descricao,
			    				   mo.ativo
    						FROM modalidades mo
					    	WHERE mo.ativo = 1		    	
					    	ORDER BY mo.modalidade ASC";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	$this->retHTML = null;    	
    	
    	if (is_array($arrModalities))
    	{
    		foreach ($arrModalities as $sanity => $modality)
    			$modalities[] = $modality['modid'];
    	}
    	
    	for ($x = 0; $x < count($this->retRecords); $x++)
    	{
    		$this->retHTML .= '<option value="'.$this->retRecords[$x]['modid'].'" '.(in_array($this->retRecords[$x]['modid'], $modalities) ? 'selected' : '').'>'.$this->retRecords[$x]['modalidade'].'</option>';
    	}    		
    	
    	return $this->retHTML;
    }
    
    
    /**
	* Trazer Usuarios
	*	
	* @author    Daniel Triboni
	* @return	 vetor
	*/
	public function fQueryUsers(){
    	$sql = "SELECT
    				u.usuid,
    				u.nome,
    				u.mail
    			FROM usuarios u
    			WHERE u.ativo = 1 ";
    			if($_SESSION['sUserProfile'] == 5){   
    				$sql.= "AND u.usuid = ".$_SESSION['sUserID'];
    			}  
    	$sql.=" ORDER BY u.nome ASC";
    	$this->fExecuteSql($sql);
    	$ret = $this->fShowRecords();
    	return $ret;	
    }
	    
    
	/**
	* Gravar LOG no Sistema
	*
	* @author    Daniel Triboni
	* @param	 integer ID OPERADOR
	* @param	 integer ID CLIENTE
	* @param	 string Acao
	* @return    boolean
	*/	
	private function fRecordLOG($usu_id, $cli_id, $acao){
		$sqlX = "INSERT INTO tbllog (usu_id, cli_id, log_acao)
			     VALUES (".$usu_id.", ".$cli_id.", '".$acao."')";
		$this->fExecuteSql($sqlX);																		
		return true;
	}
    
   
	/**
	 * Query Save Photo
	 * @param object $_REQUEST
	 */
    public function fQuerySavePhoto($obj){
    	//if ($obj['local'] == 1 || $obj['local'] == 4)
    	//$this->fQueryRemoveCoverAndMainPhotos($obj['apid'], $obj['local']);
    	
    	$sql = "INSERT INTO pessoas_fotos (apid, tipo, imagemurl, local, hash, ativo, titulo, descricao)
       			VALUES ({$obj['apid']}, {$obj['tipo']}, '{$obj['imagemurl']}', {$obj['local']}, '{$obj['hash']}', ".($obj['ativo'] == 1 ? 1 : '0').", '{$obj['titulo']}', '{$obj['descricao']}')";
    	$this->fExecuteSql($sql); 
    	
    	$this->fQuerySetAdToDisabled($obj['apid']);
    	return true;
    }
    
     
    /**
     * Query Set AD To Unapproved
     * @param unknown $apid
     * @return boolean
     */
    private function fQuerySetAdToDisabled($apid){
    	$sql = "UPDATE anuncios_pessoas SET aprovado = 0 WHERE apid = {$apid}";
    	$this->fExecuteSql($sql);
    	return true;
    }
      
    
    /**
     * Query Remove Photos by User Defined Locals
     * @param unknown $apid
     * @param unknown $local
     * @return boolean
     */
    private function fQueryRemoveCoverAndMainPhotos($apid, $local){
    	$sql = "DELETE FROM pessoas_fotos WHERE apid = {$apid} AND local = {$local}";
    	$this->fExecuteSql($sql);
    	return true;
    }
    
    
    /**
     * Insert LOG Actions
     * @param array $obj
     * @return boolean
     */
    public function fInsertLogActions($obj){
    	$this->sqlQuery = "INSERT INTO logs (pesid, plaid, apid, fotid, psid, acao) VALUES ";
    	$this->sqlQuery.= "({$obj['pesid']}, {$obj['plaid']}, {$obj['apid']}, {$obj['fotid']}, '{$obj['psid']}', '{$obj['acao']}')";
    	$this->fExecuteSql($this->sqlQuery);
    	return true;
    }
}