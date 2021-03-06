<?php

/**
* Classe para execucao de Queries
* @author Libidinous Development Team
*/
class queries extends mysqlconn {
		
	private $sqlQuery;
	
	private $sqlQueryCompl;
	
	private $sqlQueryInner;
	
	private $sqlQueryGroup;
	
	private $retRecords;
	
	private $retHTML;
	
	public $retAPID;
	
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
	 * Query Persons Logged after 24H
	 * @return array
	 */
	public function fGetPersonsLoggedAfter24H(){
	
		$this->sqlQuery = "SELECT p.pesid 
							FROM pessoas p 
						  WHERE DATEDIFF(now(), p.dtultimoacesso) > 1";	
		$this->fExecuteSql($this->sqlQuery);
		$this->retRecords = $this->fShowRecords();
		return $this->retRecords;
	}
	
	
	/**
	 * Update Person to Logoff
	 * @param integer $pesid
	 * @return boolean
	 */
	public function fUpdatePerson2Logoff($pesid){
	
		$this->sqlQuery = "UPDATE pessoas 
							SET logon = 0, ppv_online = 0 
						  WHERE pesid = ".$pesid;
		$this->fExecuteSql($this->sqlQuery);		
		return true;
	}
	
	
	/**
	 * Switch Chat Person to ON
	 * @param integer $pesid
	 * @return boolean
	 */
	public function fStartChat($pesid){
	
		$this->sqlQuery = "UPDATE pessoas
							SET ppv_online = 1
						  WHERE pesid = ".$pesid;
		$this->fExecuteSql($this->sqlQuery);
		return true;
	}
	
	
	/**
	 * Switch Chat Person to OFF
	 * @param integer $pesid
	 * @return boolean
	 */
	public function fStopChat($pesid){
	
		$this->sqlQuery = "UPDATE pessoas
							SET ppv_online = 0
						  WHERE pesid = ".$pesid;
		$this->fExecuteSql($this->sqlQuery);
		return true;
	}
	
	
	/**
	 * Query Person Payment Checked
	 * @return integer
	 */
	public function fQueryPersonPaymentChecked(){
		
		$this->sqlQuery = "	SELECT 
								pp.plaid,
								pl.plano,
								pl.cobrancadias,
								pp2.vencimento,
								pl.anuncios,
								pl.fotos,
								pl.videos
							FROM planos_pagamentos pp2
							INNER JOIN planos_pessoas pp ON pp.ppid = pp2.ppid
							INNER JOIN planos pl ON pl.plaid = pp.plaid
							INNER JOIN pessoas p ON p.pesid = pp.pesid
							WHERE pp.pesid = {$_SESSION['sPersonID']}
							AND pp2.pago = 1
							AND pp.lido = 0
							ORDER BY pp2.pgid DESC LIMIT 1";
		$this->fExecuteSql($this->sqlQuery);
		$this->retRecords = $this->fShowRecords();
		
		if (count($this->retRecords) > 0)
		{
			$_SESSION['sPersonPlanID'] = $this->retRecords[0]['plaid'];
			$_SESSION['sPersonPlanPaid'] = 1;
			$_SESSION['sPersonPlanName'] = $this->retRecords[0]['plano'];
			$_SESSION['sPersonPlanExpires'] = $this->retRecords[0]['cobrancadias'];
			$_SESSION['sPersonPlanExpiresDate'] = $this->retRecords[0]['vencimento'];
			$_SESSION['sPersonMaxAds'] = $this->retRecords[0]['anuncios'];
			$_SESSION['sPersonMaxPhotos'] = $this->retRecords[0]['fotos'];
			$_SESSION['sPersonMaxVideos'] = $this->retRecords[0]['videos'];
			
			$this->sqlQuery = "UPDATE planos_pessoas SET lido = 1 WHERE pesid = ".$_SESSION['sPersonID'];
			$this->fExecuteSql($this->sqlQuery);
			
			return 1;
		}
		
		return 0;
	}
    
	
	/**
	 * Query Notification Nav Menu 
	 * @return array
	 */
	public function fQueryNotificationNavMenu(){
	
		$this->sqlQuery = "SELECT
								CONCAT('Seu perfil ', p.apelido) as titulo,
								'dashboard' as url,
								CASE WHEN (p.aprovado = 1) THEN
						    		'foi aprovado com sucesso!'
						    	WHEN (p.aprovado = 2) THEN
						    		'<strong>foi reprovado!</strong>'						    	
						    	END AS aprovado
							FROM pessoas p
							WHERE p.lido = 0
							AND p.pesid = {$_SESSION['sPersonID']}
							AND p.aprovado = 1
							AND p.removido = 0
						UNION
							SELECT 
								CONCAT('O pagamento do seu plano ', pl.plano) as titulo,
								'dashboard' as url,
								CASE WHEN (1=1) THEN
						    		'foi confirmado com sucesso!'						    	
						    	END AS aprovado
							FROM planos_pagamentos pp2
							INNER JOIN planos_pessoas pp ON pp.ppid = pp2.ppid
							INNER JOIN planos pl ON pl.plaid = pp.plaid
							INNER JOIN pessoas p ON p.pesid = pp.pesid
							WHERE pp.pesid = {$_SESSION['sPersonID']}
							AND pp2.pago = 1
							AND pp.lido = 0							
						UNION
							SELECT
								CONCAT('Seu perfil ', p.apelido) as titulo,
								'dashboard' as url,
								CASE WHEN (t.aprovado = 0) THEN
						    		'recebeu um novo depoimento!'						    	
						    	END AS aprovado
							FROM pessoas p
							INNER JOIN testemunhos t ON t.pesid = p.pesid
							WHERE t.aprovado = 0
							AND t.pesid = {$_SESSION['sPersonID']}							
						UNION 
							SELECT
								CONCAT('Seu an&uacute;ncio ', ap.titulo) as titulo,
								CONCAT('person/', p.url, '/', ap.url) as url,
								CASE WHEN (ap.aprovado = 1) THEN
						    		'foi publicado com sucesso!'
						    	WHEN (ap.aprovado = 2) THEN
						    		'<strong>foi reprovado!</strong>'						    	
						    	END AS aprovado
							FROM anuncios_pessoas ap
							INNER JOIN pessoas p ON p.pesid = ap.pesid
							WHERE ap.lido = 0
							AND ap.pesid = {$_SESSION['sPersonID']}
							AND ap.aprovado = 1
							AND ap.removido = 0
						";
		
		$this->fExecuteSql($this->sqlQuery);
		$this->retRecords = $this->fShowRecords();
		return $this->retRecords;
	}
	
	
	/**
	 * Query to global search
	 * @param string $criteria
	 * @param integer $paging
	 */
	public function fQueryGlobalSearch($criteria, $paging = 0) {
		$this->sqlQuery = "SELECT
								p.apelido,
			    				p.sexo,
			    				p.genero,
			    				p.whatsapp,
			    				p.tel1,
			    				p.tel2,		    				
			    				p.facebook,
			    				p.twitter,
			    				p.googleplus,
			    				p.nascimento,
			    				p.url AS person,
			    				p.ppv_online,
			    				ap.url AS ad,
			    				ap.titulo AS titulo_anuncio,
			    				IFNULL((SELECT pfc.imagemurl AS imagemurl 
								     FROM pessoas_fotos pfc 
								     WHERE pfc.apid = ap.apid 
								     AND pfc.ativo = 1 
								     AND pfc.local = 1 
								     AND pfc.tipo = 1 
								     AND pfc.principal = 'S'
								     ORDER BY pfc.fotid DESC LIMIT 1), '../no-cover.jpg') AS thumb,		    				
			    				ap.descricao AS descricao_pessoa,
			    				(SELECT COUNT(1) 
				    				 FROM pessoas_fotos pfc
				    				 WHERE pfc.apid = ap.apid
				    				 AND pfc.ativo = 1
				    				 AND pfc.tipo = 1) AS count_fotos,
				    			(SELECT COUNT(1) 
				    				 FROM pessoas_fotos pfc
				    				 WHERE pfc.apid = ap.apid
				    				 AND pfc.ativo = 1
				    				 AND pfc.tipo = 2 AND pfc.local = 3) AS count_videos,	 
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
							FROM pessoas p
							INNER JOIN anuncios_pessoas ap ON ap.pesid = p.pesid 							
							INNER JOIN modalidades_pessoas mp ON mp.apid = ap.apid
							INNER JOIN modalidades m ON m.modid = mp.modid
							INNER JOIN locais_pessoas lp ON lp.apid = ap.apid 
							WHERE 
								ap.ativo = 1
						    	AND p.ativo = 1
						    	AND ap.aprovado = 1
						    	AND p.aprovado = 1 
						    	AND p.removido = 0 
						    	AND ap.removido = 0 

								AND 
								(
									MATCH(p.nome,p.apelido) AGAINST('{$criteria}') OR
									MATCH(m.modalidade) AGAINST('{$criteria}') OR
									(p.naturalidade) LIKE '%{$criteria}%' OR
									(lp.local) LIKE '%{$criteria}%' OR
									(lp.endereco) LIKE '%{$criteria}%' OR
									(SELECT GROUP_CONCAT(pf.titulo) AS items 
									 FROM pessoas_fotos pf 
									 WHERE pf.apid = ap.apid
									 AND pf.titulo <> ''
									 GROUP BY pf.apid) LIKE '{$criteria}%' OR
									(SELECT GROUP_CONCAT(pf.descricao) AS descr 
									 FROM pessoas_fotos pf 
									 WHERE pf.apid = ap.apid
									 AND pf.descricao <> ''
									 GROUP BY pf.apid) LIKE '{$criteria}%' 
								)

							GROUP BY p.nome
							ORDER BY ap.visitascount DESC, p.nome ASC ";
							if ($paging != -1)
								$this->sqlQuery .= "LIMIT {$paging}, ".SIS_PAGINACAO;
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
	 * Save Chat Conversations
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fSaveChat($msg, $room){
	
		$this->sqlQuery = "INSERT INTO chats (pesid, jsonmessage) VALUES ({$room}, '".$msg."')";
	
		$this->fExecuteSql($this->sqlQuery);
	
		return true;
	}
	
	
	/**
	 * Query Notification Counters in Home Page
	 * @return array
	 */
	public function fQueryNotificationCounters(){
	
		$this->sqlQuery = "SELECT 
							(SELECT COUNT(1) FROM pessoas p WHERE p.ativo = 1 AND p.aprovado = 1 AND p.removido = 0) AS pc,
							(SELECT COUNT(1) FROM pessoas p WHERE p.logon = 1 AND p.removido = 0) AS mo,
							(SELECT COUNT(1) FROM pessoas_fotos pf WHERE pf.ativo = 1 AND pf.tipo = 1) AS pr,
							(SELECT COUNT(1) FROM anuncios_pessoas ap WHERE ap.ativo = 1 AND ap.aprovado = 1 AND ap.removido = 0) AS ac";	
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
		$this->sqlQuery = "UPDATE planos_pessoas SET lido = 1 WHERE pesid = ".$_SESSION['sPersonID'];
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
												 busto, cintura, quadril, pcm, especialidade,
												 whatsapp, tel1, tel2,
												 facebook, twitter, googleplus, 
												 rg, cpf, nascimento, naturalidade,
												 documento, comprovacao, dtultimoacesso)
										 VALUES ('".$obj['nome']."', '".$obj['apelido']."', '".$obj['url']."', '".$obj['email']."', '".md5($obj['senha'])."', 
										 	     '".$obj['sexo']."', '".$obj['genero']."', '".$obj['etnia']."', 
										 	     '".$obj['olhos']."', '".$obj['cabelos']."', '".$obj['peso']."', '".$obj['altura']."',  
										 		 '".$obj['busto']."', '".$obj['cintura']."', '".$obj['quadril']."', '".$obj['pcm']."', '".$obj['especialidade']."', 
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
	 * Save New Person Register via Miner
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fSaveNewPersonViaMiner($obj){
	    
	    $this->sqlQuery = "INSERT INTO pessoas (nome, apelido, url, email, senha,
												 sexo, genero, etnia,
												 olhos, cabelos, peso, altura,
												 busto, cintura, quadril, pcm, especialidade,
												 whatsapp, tel1, tel2,
												 facebook, twitter, googleplus,
												 rg, cpf, nascimento, naturalidade,
												 documento, comprovacao, dtultimoacesso, aprovado)
										 VALUES ('".$obj['title']."', '".$obj['title']."', '".$obj['url']."', '".$obj['url']."@libidinous.club', '".md5('libidinous')."',
										 	     '".$obj['gender']."', '".($obj['gender'] == 'M' ? 'mars' : 'venus')."', '',
										 	     '', '', '', '',
										 		 '', '', '', '', 'A',
										 		 '".$obj['phone']."', '', '',
										 		 '', '', '',
										 		 '0', '0', '0', '',
										 		 '0', '0', now(), 1)";
	    
	    if($this->fExecuteSql($this->sqlQuery))
	    {
	        return $this->fGetLastInsertID();
	    }
	}
	
	
	/**
	 * Save New User Register
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fSaveNewUser($obj, $files){
	
		$this->sqlQuery = "INSERT INTO usuarios (nome, apelido, email, senha,
												 sexo, 
												 nascimento, avatar, dtultimoacesso)
										 VALUES ('".$obj['nome']."', '".$obj['apelido']."', '".$obj['email']."', '".md5($obj['senha'])."',
										 	     '".$obj['sexo']."',
										 	     '".$obj['nascimento']."', '".$files['avatar']."', now())";
	
		if($this->fExecuteSql($this->sqlQuery))
		{
			$_SESSION['sUserLogged'] = true;
			$_SESSION['sUserID'] = $this->fGetLastInsertID();						
			$_SESSION['sUserGender'] = $obj['sexo'];
			$_SESSION['sUserLastLogon'] = null;
			$_SESSION['sUserSessionTime'] = time();
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
	public function fUpdateCurrentPerson($obj, $files){
		
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
									especialidade = '".$obj['especialidade']."',
									whatsapp = '".$obj['whatsapp']."', 
									tel1 = '".$obj['tel1']."', 
									tel2 = '".$obj['tel2']."',
									facebook = '".$obj['facebook']."', 
									twitter = '".$obj['twitter']."', 
									googleplus = '".$obj['googleplus']."',												
									nascimento = '".$obj['nascimento']."', 
									naturalidade = '".$obj['naturalidade']."'";
		
		if ($files['documento'] != '' && $files['comprovacao'] != '')
		{
			$this->sqlQuery .= ", documento = '".$files['documento']."',
								  comprovacao = '".$files['comprovacao']."', 
								  aprovado = 0, 
								  lido = 0,
								  mensagem = '' ";
		}		
		
		$this->sqlQuery	.= "WHERE pesid = ".$_SESSION['sPersonID'];
		
		return $this->fExecuteSql($this->sqlQuery);									
	}
	
	
	/**
	 * Update User Register
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fUpdateCurrentUser($obj, $files){
	
		$this->sqlQuery = "UPDATE usuarios SET
									nome = '".$obj['nome']."',
									senha = '".md5($obj['senha'])."',
									sexo = '".$obj['sexo']."',
									nascimento = '".$obj['nascimento']."' ";
	
		if ($files['avatar'] != '')
		{
			$this->sqlQuery .= ", avatar = '".$files['avatar']."' ";
		}
	
		$this->sqlQuery .= "WHERE usuid = ".$_SESSION['sUserID'];
	
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
														 diahoraatendimentoutil,
														 diahoraatendimentofds,
														 atendimento24H, 
														 pessoasatendimento, idiomas, 
														 moeda, localproprio, pesid)
							VALUES ('".$obj['titulo']."', '".$obj['descricao']."', 1, '".$obj['url']."',
									'".$obj['diautil1']."-".$obj['diautil2']."-".$obj['horautil1']."-".$obj['horautil2']."',
									'".$obj['diafds1']."-".$obj['diafds2']."-".$obj['horafds1']."-".$obj['horafds2']."',
									'".$obj['atendimento24H']."',
									'".join(", ", $obj['pessoasatendimento'])."', '".join(", ", $obj['idiomas'])."', 
									'".$obj['moeda']."', '".$obj['localproprio']."', {$_SESSION['sPersonID']})";
	
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
	 * Save New Person Ad via Miner
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @param    integer $pesid
	 * @return	 boolean
	 */
	public function fSaveNewAdViaMiner($obj, $pesid){
	    
	    $this->sqlQuery = "INSERT INTO anuncios_pessoas (titulo, descricao, ativo, url,
														 diahoraatendimentoutil,
														 diahoraatendimentofds,
														 atendimento24H,
														 pessoasatendimento, idiomas,
														 moeda, localproprio, pesid, aprovado)
							VALUES ('".$obj['title']."', '".$obj['description']."', 1, '".$obj['url']."',
									'0-0-99-99',
									'0-0-99-99',
									'0',
									'Homens, Mulheres, Casais', 'Portugues',
									'R$', '1', {$pesid}, 1)";
	    
	    if($this->fExecuteSql($this->sqlQuery))
	    {
	        $obj['apid'] = $this->fGetLastInsertID();
	        
	        if ($this->fAdLocations($obj))
	        {
	            if($this->fAdModalities($obj))
	            {
	                if($this->fAdCaches($obj))
	                {
	                    return $obj['apid'];
	                    
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
	 * Save New Person Ad
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fQuerySavePersonPlan($obj){
	
		$this->sqlQuery = "INSERT INTO planos_pessoas (plaid, pesid, lido)
							VALUES (".$obj['plaid'].", {$_SESSION['sPersonID']}, ".($obj['lido'] == 1 ? 1 : '0').")";
	
		if($this->fExecuteSql($this->sqlQuery))
		{
			$obj['ppid'] = $this->fGetLastInsertID();
			
			$_SESSION['sPersonPlanID'] = $obj['plaid'];
			$_SESSION['sPersonPlanPaid'] = $obj['pago'];
			$_SESSION['sPersonPlanName'] = $obj['name'];
			$_SESSION['sPersonPlanExpires'] = $obj['planexpires'];
			$_SESSION['sPersonPlanExpiresDate'] = $obj['vencimento'];
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
	 * Save New Person Ad via Miner
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fQuerySavePersonPlanViaMiner($obj){
	    
	    $this->sqlQuery = "INSERT INTO planos_pessoas (plaid, pesid, lido)
							VALUES (".$obj['plaid'].", {$obj['pesid']}, ".($obj['lido'] == 1 ? 1 : '0').")";
	    
	    if($this->fExecuteSql($this->sqlQuery))
	    {
	        $obj['ppid'] = $this->fGetLastInsertID();
	        	       
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
	 * Update Person Testimonial
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fQueryAddTestimonial($obj){
	
		$this->sqlQuery = "INSERT INTO testemunhos 
								(titulo, 
								 usuid,
								 descricao, 
								 score,
								 pesid)
							VALUES 
								('".$obj['titulo']."',".
								 $_SESSION['sUserID'].",		
								 '".$obj['descricao']."',".
								    $obj['score'].",".
									$obj['pesid'].")";
	
		if($this->fExecuteSql($this->sqlQuery))
		{
			return true;
				
		}else{
	
			return false;
		}
	}
	
	
	/**
	 * Update Person Testimonial
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	public function fQueryUpdateTestimonial($obj){
	
		 $this->sqlQuery = "UPDATE testemunhos SET 
									replica = '".$obj['replica']."',
									aprovado = 1,
								    avaliacao = ".$obj['star']." 
							WHERE tesid = ".$obj['tesid'];
	
		if($this->fExecuteSql($this->sqlQuery))
		{
			return true;
			
		}else{
				
			return false;
		}
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
									diahoraatendimentoutil = '".$obj['diautil1']."-".$obj['diautil2']."-".$obj['horautil1']."-".$obj['horautil2']."',
									diahoraatendimentofds = '".$obj['diafds1']."-".$obj['diafds2']."-".$obj['horafds1']."-".$obj['horafds2']."',
									atendimento24H = '".$obj['atendimento24H']."',
									idiomas = '".join(", ", $obj['idiomas'])."',
									moeda = '".$obj['moeda']."',
									localproprio = '".$obj['localproprio']."'
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
		
		//$this->sqlQuery = "DELETE FROM anuncios_pessoas WHERE apid = ".$apid;
		//return $this->fExecuteSql($this->sqlQuery);	
		$this->sqlQuery = "UPDATE anuncios_pessoas SET removido = 1 WHERE apid = ".$apid;
		return $this->fExecuteSql($this->sqlQuery);
	}
	
	
	/**
	 * Save Optional Ad Locations
	 *
	 * @author    Daniel Triboni
	 * @param	 object $_REQUEST
	 * @return	 boolean
	 */
	private function fAdLocations($obj){
	
		$this->sqlQuery = "DELETE FROM locais_pessoas WHERE apid = ".$obj['apid'];
		if($this->fExecuteSql($this->sqlQuery))
		{
			if (count($obj['localidades']) > 0)
			{
				$this->sqlQueryCompl = "INSERT INTO locais_pessoas (apid, local, endereco, latitude, longitude, ativo) VALUES ";
				
				foreach ($obj['localidades'] as $localidades)
				{
					$location = explode("|", $localidades);
					
					$this->sqlQueryCompl .= "({$obj['apid']}, '{$location[0]}', '{$location[1]}, {$obj['autocomplete']}', '{$location[2]}', '{$location[3]}', 1), ";
				}	
				
				return $this->fExecuteSql(substr($this->sqlQueryCompl, 0, strlen($this->sqlQueryCompl)-2));
				
			}else{
				
				return true;
			}
			
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
			
			$this->fExecuteSql(substr($this->sqlQueryCompl, 0, strlen($this->sqlQueryCompl)-2));
			
			$this->sqlQueryCompl = "INSERT INTO modalidades_pessoas (modid, adic, apid, ativo) VALUES ";
			
			$add = 0;
			foreach ($obj['modalidades-adic'] as $adic)
			{
				$this->sqlQueryCompl .= "({$adic}, {$adic}, {$obj['apid']}, 1), ";
				$add++;
			}
			
			if($add > 0)
			    $this->fExecuteSql(substr($this->sqlQueryCompl, 0, strlen($this->sqlQueryCompl)-2));
			
			return true;
				
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
																c4, c8, c12, taxadd, viagem)
									VALUES ('{$obj['apid']}', '{$obj['c30']}', '{$obj['c1']}', '{$obj['c2']}', 
											'{$obj['c4']}', '{$obj['c8']}', '{$obj['c12']}', '{$obj['taxadd']}', '{$obj['viagem']}') ";
			if($this->fExecuteSql($this->sqlQueryCompl))
			{
				$this->retAPID = $obj['apid'];
				return true;
			}
				
		}else{
				
			return false;
		}
	}
    
	
	/**
	 * Remove Photo
	 *
	 * @author    Daniel Triboni
	 * @param	 string $hash
	 * @return	 boolean
	 */
	public function fRemovePhoto($hash){
		$this->sqlQuery = "DELETE FROM pessoas_fotos WHERE hash = '{$hash}'";
		return $this->fExecuteSql($this->sqlQuery);
	}
	
	
	/**
	 * Update Photo
	 *
	 * @author   Daniel Triboni
	 * @param	 array $obj
	 * @return	 boolean
	 */
	public function fUpdatePhoto($obj){
		$this->sqlQueryCompl = null;
		$this->sqlQueryCompl.= ($obj['active'] != "" ? "ativo = {$obj['active']}," : "");
		$this->sqlQueryCompl.= ($obj['title'] != "" ? "titulo = '{$obj['title']}'," : "");
		$this->sqlQueryCompl.= ($obj['descr'] != "" ? "descricao = '{$obj['descr']}' " : "");
		$this->sqlQuery = "UPDATE pessoas_fotos SET ";
		$this->sqlQuery .= substr($this->sqlQueryCompl, 0, strlen($this->sqlQueryCompl)-1);
		$this->sqlQuery .= " WHERE hash = '{$obj['hash']}'";
		return $this->fExecuteSql($this->sqlQuery);
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
     * Query User Testimonials
     * @param integer $pesid
     */
    public function fQueryUsersTestimonials($pesid = null){
    	$this->sqlQuery = "SELECT u.*, 
    							  p.sexo AS sexopes,
    							  u.sexo AS sexouser,
    							  t.*, 
    							  p.url,
    							  DATE_FORMAT(t.cadastro, 'Publicado em %d/%m/%Y &agrave;s %H:%i') AS dtcad,
    							  p.apelido AS apelidopessoa
    					    FROM testemunhos t
    						INNER JOIN usuarios u ON u.usuid = t.usuid
    						LEFT JOIN pessoas p ON p.pesid = t.pesid
    						WHERE t.aprovado = 1";
    	if ($pesid != null){
    		$this->sqlQuery .= " AND t.pesid = ".$pesid;
    	}
    	$this->sqlQuery .= " ORDER BY t.cadastro DESC LIMIT 15";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Query User Testimonials
     * @param integer $pesid
     */
    public function fQueryUsersTestimonialsToApprove($pesid = null){
    	$this->sqlQuery = "SELECT u.*, t.*,
    							  DATE_FORMAT(t.cadastro, 'Publicado em %d/%m/%Y &agrave;s %H:%i') AS dtcad,
    							  p.apelido AS apelidopessoa
    					    FROM testemunhos t
    						INNER JOIN usuarios u ON u.usuid = t.usuid
    						INNER JOIN pessoas p ON p.pesid = t.pesid
    						WHERE t.aprovado = 0
    						AND t.removido = 0";
    	if ($pesid != null){
    		$this->sqlQuery .= " AND t.pesid = ".$pesid;
    	}
    	$this->sqlQuery .= " ORDER BY t.cadastro ASC LIMIT 15";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Query Featured Models in Home Page
     * @param string $gender
     * @param integer $feature
     * @param integer $limit
     * @param integer $type
     */
    public function fQueryFeaturedModels($gender, $service, $feature, $limit){
    	$this->sqlQueryCompl = null;
    	$this->sqlQueryCompl .= (!empty($gender) ? "AND p.sexo = '{$gender}'" : "");
    	$this->sqlQueryCompl .= (!empty($service) && $service != "T" ? "AND p.especialidade = '{$service}'" : "");    	
    	$this->sqlQuery = "SELECT		    				
		    				p.apelido,
		    				p.sexo,
		    				p.genero,
		    				p.whatsapp,
		    				p.ppv_online,
		    				p.tel1,
		    				p.tel2,		    				
		    				p.facebook,
		    				p.twitter,
		    				p.googleplus,
		    				p.nascimento,
		    				p.naturalidade,
		    				p.url AS person,
		    				ap.url AS ad,
		    				ap.titulo AS titulo_anuncio,
		    				IFNULL((SELECT pfc.imagemurl AS imagemurl 
							     FROM pessoas_fotos pfc 
							     WHERE pfc.apid = ap.apid 
							     AND pfc.ativo = 1 
							     AND pfc.local = 1 
							     AND pfc.tipo = 1 
							     AND pfc.principal = 'S'
							     ORDER BY pfc.fotid DESC LIMIT 1), '../no-cover.jpg') AS imagemurl,		    				
		    				ap.descricao AS descricao_pessoa,
		    				(SELECT COUNT(1) 
			    				 FROM pessoas_fotos pfc
			    				 WHERE pfc.apid = ap.apid
			    				 AND pfc.ativo = 1
			    				 AND pfc.tipo = 1) AS count_fotos,
			    			(SELECT COUNT(1) 
				    				 FROM pessoas_fotos pfc
				    				 WHERE pfc.apid = ap.apid
				    				 AND pfc.ativo = 1
				    				 AND pfc.tipo = 2 AND pfc.local = 3) AS count_videos,	 
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
		    				(SELECT 
								GROUP_CONCAT(lp.endereco) AS endereco 
							 FROM locais_pessoas lp							 								 
							 WHERE lp.apid = ap.apid
							 AND lp.ativo = 1 
							 ORDER BY endereco DESC LIMIT 1) AS localizacao
		    			FROM destaque_pessoas dp
		    			INNER JOIN anuncios_pessoas ap ON ap.apid = dp.apid		    			
		    			INNER JOIN pessoas p ON p.pesid = ap.pesid
		    			WHERE ap.ativo = 1
		    			AND ap.aprovado = 1 
		    			AND p.aprovado = 1 
		    			AND p.ativo = 1
		    			AND p.removido = 0
		    			AND ap.removido = 0 
		    			{$this->sqlQueryCompl}		    			
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
     * @param string $gender
     * @param string $service
     * @param number $paging
     * @param string $limit
     * @param string $type
     */
    public function fQueryGalleryModels($gender, $service, $paging = 0, $limit = true, $type = null){
    	$this->sqlQueryCompl = null;
    	$this->sqlQueryCompl .= (!empty($gender) ? "AND p.sexo = '{$gender}'" : "");
    	$this->sqlQueryCompl .= (!empty($service) && $service != "T" ? "AND p.especialidade = '{$service}'" : "");
    	$this->sqlQueryCompl .= ($type == "online" ? "AND p.ppv_online = 1" : "");    	
    	$this->sqlQuery = "SELECT
    							ap.url AS ad,
    							(SELECT 
						    		MAX(lp1.latitude) 
						    	FROM locais_pessoas lp1 
						    	WHERE lp1.apid = ap.apid 
						    	AND lp1.ativo = 1) AS latitude,						    	
						    	(SELECT 
						    		MIN(lp2.longitude) 
						    	FROM locais_pessoas lp2 
						    	WHERE lp2.apid = ap.apid 
						    	AND lp2.ativo = 1) AS longitude,
    							p.url AS person,
						    	p.apelido,
						    	p.genero,						    	
    							ap.pessoasatendimento, 
    							p.ppv_online,
    						(SELECT COUNT(1) 
			    				 FROM pessoas_fotos pfc
			    				 WHERE pfc.apid = ap.apid
			    				 AND pfc.ativo = 1
			    				 AND pfc.tipo = 1) AS count_fotos,
			    			 (SELECT COUNT(1) 
			    				 FROM pessoas_fotos pfc
			    				 WHERE pfc.apid = ap.apid
			    				 AND pfc.ativo = 1
			    				 AND pfc.tipo = 2 AND pfc.local = 3) AS count_videos,
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
							     ORDER BY pf.fotid DESC LIMIT 1), 0) AS thumb,
							IFNULL((SELECT pf.imagemurl AS thumb 
							     FROM pessoas_fotos pf 
							     WHERE pf.apid = ap.apid 
							     AND pf.ativo = 1 
							     AND pf.local = 4 
							     AND pf.tipo = 1 
							     AND pf.principal = 'S'
							     ORDER BY pf.fotid DESC LIMIT 1), 0) AS cover     
					    	FROM anuncios_pessoas ap
					    	INNER JOIN pessoas p ON p.pesid = ap.pesid					    	
					    	WHERE ap.ativo = 1
					    	AND p.ativo = 1
					    	AND ap.aprovado = 1
					    	AND p.aprovado = 1 
					    	AND p.removido = 0 
					    	AND ap.removido = 0 
					    	AND EXISTS ((SELECT pfc.fotid
										     FROM pessoas_fotos pfc 
										     WHERE pfc.apid = ap.apid 
										     AND pfc.ativo = 1 
										     AND pfc.local = 1 
										     AND pfc.tipo = 2 
										     AND pfc.principal = 'S')) 
    						{$this->sqlQueryCompl}
    						GROUP BY ad, person, apelido, genero    						
					    	ORDER BY ap.visitascount DESC, person ASC ";
    						if ($limit)
								$this->sqlQuery.= "LIMIT {$paging}, ".SIS_PAGINACAO;
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Query Cover Models
     * @param unknown $gender
     */
    public function fQueryCoverModels(){
    	$this->sqlQueryCompl = null;
    	$this->sqlQuery = "SELECT
					    	ap.url AS ad,
					    	p.url AS person,
					    	p.sexo,
					    	IFNULL((SELECT pf.imagemurl AS thumb
						    	FROM pessoas_fotos pf
						    	WHERE pf.apid = ap.apid
						    	AND pf.ativo = 1
						    	AND pf.local = 4
						    	AND pf.tipo = 1
						    	AND pf.principal = 'S'
					    	ORDER BY pf.fotid DESC LIMIT 1), 0) AS cover
					    	FROM anuncios_pessoas ap
					    	INNER JOIN pessoas p ON p.pesid = ap.pesid
					    	WHERE ap.ativo = 1
					    	AND p.ativo = 1
					    	AND p.aprovado = 1
					    	AND p.removido = 0					    	
					    	{$this->sqlQueryCompl}
					    	GROUP BY ad, person, sexo
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
					    	WHERE p.pesid = {$pesid} AND p.removido = 0 AND ap.removido = 0 
    						ORDER BY ap.visitascount DESC, ap.aprovado DESC, ap.cadastro DESC";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Get Query All User Testimonials
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryAllUserTestimonials($usuid){
    	$this->sqlQuery = "SELECT
    							t.tesid,
						    	ap.apid,
						    	t.aprovado,
						    	t.titulo,
						    	t.score,
						    	t.descricao,
						    	t.replica,
						    	t.avaliacao,
						    	u.apelido,
						    	u.sexo,
						    	p.sexo AS sexopes,
						    	u.avatar,
								p.apelido AS apelidopessoa,
						    	ap.url AS ad,
						    	ap.visitascount,
						    	CASE WHEN (t.aprovado = 1) THEN
						    	DATE_FORMAT(t.cadastro, 'Publicado em %d/%m/%Y as %H:%i:%s')
						    	WHEN (ap.aprovado = 2) THEN
						    	'<b style=\'color:red\'>REPROVADO!</b>'
						    	ELSE
						    	'<b style=\'color:red\'>PENDENTE DE APROVA&Ccedil;&Atilde;O!</b>'
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
					    	LEFT JOIN pessoas p ON p.pesid = ap.pesid
					    	INNER JOIN testemunhos t ON t.pesid = p.pesid
					    	INNER JOIN usuarios u ON u.usuid = t.usuid 
					    	WHERE u.usuid = {$usuid} AND p.removido = 0 AND ap.removido = 0 AND t.removido = 0 
					    	ORDER BY t.cadastro DESC";
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
					    	WHERE p.pesid = {$pesid} 
					    	AND pf.local NOT IN (1,4)
					    	AND pf.tipo = 1";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Get Query All Person Videos
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryAllPersonVideos($pesid){
    	$this->sqlQuery = "SELECT
					    		pf.fotid
					    	FROM pessoas_fotos pf
					    	INNER JOIN anuncios_pessoas ap ON ap.apid = pf.apid
					    	INNER JOIN pessoas p ON p.pesid = ap.pesid
					    	WHERE p.pesid = {$pesid}
					    	AND pf.local = 3
					    	AND pf.tipo = 2";
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
									CASE WHEN t.score IS NULL THEN 0 ELSE SUM(t.score) END
								FROM testemunhos t
								WHERE t.pesid = p.pesid) AS sumscore,
								(SELECT 
									CASE WHEN t.score IS NULL THEN 1 ELSE COUNT(1) END
								FROM testemunhos t
								WHERE t.pesid = p.pesid) AS average,
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
							     ORDER BY pf.fotid DESC LIMIT 1), '../../../assets/img/no-portrait-".$_SESSION['sPersonGender'].".jpg') AS thumb,			    				
							IFNULL((SELECT pfc.imagemurl AS cover 
							     FROM pessoas_fotos pfc 
							     WHERE pfc.apid = ap.apid 
							     AND pfc.ativo = 1 
							     AND pfc.local = 4 
							     AND pfc.tipo = 1 
							     AND pfc.principal = 'S'
							     ORDER BY pfc.fotid DESC LIMIT 1), '../../../assets/img/no-cover-".$_SESSION['sPersonGender'].".jpg') AS cover
							FROM anuncios_pessoas ap
							INNER JOIN pessoas p ON p.pesid = ap.pesid							
							WHERE ap.ativo = 1
							AND p.ativo = 1  
							AND ap.removido = 0 
							AND p.removido = 0 
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
					    		(SELECT
						    		COUNT(1)
						    	 FROM testemunhos t
						    	 WHERE t.pesid = p.pesid
						    	 AND t.aprovado = 0 AND t.removido = 0) AS testimonials,
					    		DATE_FORMAT(p.nascimento, '%d/%m/%Y') AS nascimento,					    		
					    		CASE WHEN p.aprovado = 1 THEN
					    			'<i class=\"fa fa-check\"></i> PERFIL APROVADO COM SUCESSO!'
					    		WHEN p.aprovado = 2 THEN
					    			'<i class=\"fa fa-remove\"></i> PERFIL REPROVADO!'
					    		ELSE
					    			'<i class=\"fa fa-warning\"></i> SEU PERFIL EST&Aacute; EM APROVA&Ccedil;&Atilde;O!'
					    		END AS status,
					    		CASE WHEN p.aprovado = 2 THEN
					    				CONCAT('<p style=\"color:red\">', p.mensagem, '</p>') 
									WHEN p.aprovado = 1 THEN
					    				'<p style=\"color:green\">A partir de agora voc&ecirc; j&aacute; pode incluir seus an&uacute;ncios.</p>'
									WHEN p.aprovado = 0 THEN
					    				'<p style=\"color:#c88300\">Voc&ecirc poder&aacute; incluir seus an&uacute;ncios ap&oacute;s o perfil for aprovado.</p>'					    		
					    		END AS mensagem					    		
					    	FROM pessoas p    	
					    	WHERE p.url = '{$person}'";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return $this->retRecords;
    }
    
    
    /**
     * Get Query User Register
     *
     * @author    Daniel Triboni
     * @return	 array
     */
    public function fQueryUserRegister($user){
    	$this->sqlQuery = "SELECT
					    		u.*,
					    		DATE_FORMAT(u.nascimento, '%d/%m/%Y') AS nascimento
					    	FROM usuarios u
					    	WHERE u.usuid = {$user}";
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
     * Get Query User AKA
     *
     * @author    Daniel Triboni
     * @return	 boolean
     */
    public function fQueryUserAka($aka){
    	$this->sqlQuery = "SELECT
					    		u.apelido
					    	FROM usuarios u
					    	WHERE u.apelido = '{$aka}'";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return (count($this->retRecords) == 0 ? true : false);
    }
    
    
    /**
     * Get Query Person CPF
     *
     * @author    Daniel Triboni
     * @return	 boolean
     */
    public function fQueryPersonCPF($cpf){
    	$this->sqlQueryCompl = (isset($_SESSION['sPersonID']) ? " AND p.pesid <> {$_SESSION['sPersonID']}" : "");
    	$this->sqlQuery = "SELECT
					    		p.cpf
					    	FROM pessoas p
					    	WHERE p.cpf = '{$cpf}' {$this->sqlQueryCompl}";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return (count($this->retRecords) == 0 ? true : false);
    }
    
    
    /**
     * Get Query Person/User Email
     *
     * @author    Daniel Triboni
     * @return	 boolean
     */
    public function fQueryPersonEmail($email, $table){
    	$this->sqlQuery = "SELECT
					    		p.email
					    	FROM {$table} p
					    	WHERE p.email = '{$email}'";
    	$this->fExecuteSql($this->sqlQuery);
    	$this->retRecords = $this->fShowRecords();
    	return (count($this->retRecords) == 0 ? true : false);
    }
    
    
    /**
     * Get Query User Email
     *
     * @author    Daniel Triboni
     * @return	 boolean
     */
    public function fQueryUserEmail($email){
    	$this->sqlQuery = "SELECT
					    		u.email
					    	FROM usuarios u
					    	WHERE u.email = '{$email}'";
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
    public function fQueryRetrievePassword($email, $table){
    	$this->sqlQuery = "SELECT
						    		p.*
						    	FROM {$table} p
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
     * Query to Update User Credentials
     * @param string $email
     * @param string $password
     */
    public function fQueryUpdateUserCredentials($email, $password) {
    	$this->sqlQuery = "UPDATE usuarios SET
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
     * Query to Remove Testimonial Logically
     * @param integer $tesid
     */
    public function fQueryRemoveTestimonial($tesid) {
    	$this->sqlQuery = "UPDATE testemunhos SET
					    		removido = 1
					    	WHERE tesid = {$tesid}";
    	$this->fExecuteSql($this->sqlQuery);
    	return true;
    }
    
    
    /**
     * Query to Remove User Logically
     * @param integer $pesid
     */
    public function fQueryRemoveUser($usuid) {
    	$this->sqlQuery = "UPDATE usuarios SET
					    		removido = 1
					    	WHERE usuid = {$usuid}";
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
    public function fQueryPersonModalities($apid, $adic = false){
    	if (!empty($apid))
    	{
	    	$this->sqlQuery = "SELECT ";
			$this->sqlQuery .= ($adic == true ? "mp.adic AS modid" : "mp.modid");
			$this->sqlQuery .= " FROM modalidades_pessoas mp					    	
						    	WHERE mp.apid = {$apid} ";
			$this->sqlQuery .= ($adic == true ? "" : "AND mp.adic = 0");
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
						    	AND lp1.ativo = 1) AS max_latitude,						    	
						    	(SELECT 
						    		MIN(lp2.longitude) 
						    	FROM locais_pessoas lp2 
						    	WHERE lp2.apid = ap.apid 
						    	AND lp2.ativo = 1) AS min_longitude						    							    	
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
     * Show person photos except cover photo and poster
     * @param integer $apid
     * @param string $url
     * @return array
     */
    public function fQueryCurrentPersonPhotos($apid, $url = null){
    	$this->sqlQueryCompl = ($_SESSION['sPersonLogged'] == true && $_SESSION['sPersonUrl'] == $url ? "" : "AND pf.ativo = 1");
    	$this->sqlQuery = "SELECT
    						pf.hash,
    						pf.local,
    						IFNULL((SELECT pft.ativo AS ativo
							     FROM pessoas_fotos pft 
							     WHERE pft.hash = pf.hash 							     
							     AND pft.local IN (2,3) 
							     AND pft.tipo = 2 
							     AND pft.principal = 'S'), '') AS ativo,
    						IFNULL((SELECT pft.titulo AS titulo
							     FROM pessoas_fotos pft 
							     WHERE pft.hash = pf.hash 
							     AND pft.local IN (2,3) 
							     AND pft.tipo = 2 
							     AND pft.principal = 'S'), '') AS titulo,
							IFNULL((SELECT pft.descricao AS descricao
							     FROM pessoas_fotos pft 
							     WHERE pft.hash = pf.hash 
							     AND pft.local IN (2,3) 
							     AND pft.tipo = 2 
							     AND pft.principal = 'S'), '') AS descricao,	
							IFNULL((SELECT pft.imagemurl AS thumb 
							     FROM pessoas_fotos pft 
							     WHERE pft.hash = pf.hash 
							     AND pft.local = 2 
							     AND pft.tipo = 1 
							     AND pft.principal = 'S'), 'no-thumb.jpg') AS thumb,
					    	IFNULL((SELECT pfl.imagemurl AS large 
							     FROM pessoas_fotos pfl 
							     WHERE pfl.hash = pf.hash 
							     AND pfl.local = 2 
							     AND pfl.tipo = 2 
							     AND pfl.principal = 'S'), 'no-large.jpg') AS large,
							IFNULL((SELECT pfl.imagemurl AS video 
							     FROM pessoas_fotos pfl 
							     WHERE pfl.hash = pf.hash 
							     AND pfl.local = 3 
							     AND pfl.tipo = 1 
							     AND pfl.principal = 'S'), 'no-large.jpg') AS capture, 
							IFNULL((SELECT pfl.imagemurl AS video 
							     FROM pessoas_fotos pfl 
							     WHERE pfl.hash = pf.hash 
							     AND pfl.local = 3 
							     AND pfl.tipo = 2 
							     AND pfl.principal = 'S'), 'no-large.jpg') AS video     
					    	FROM pessoas_fotos pf
					    	WHERE pf.fotid > 1
					    	AND pf.apid = {$apid}
							{$this->sqlQueryCompl}
					    	AND pf.local NOT IN (1,4)
					    	GROUP BY pf.hash, pf.local
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
    public function fQueryCurrentPersonModalities($apid, $adic = false){
    	$this->sqlQuery = "SELECT
    						m.modid,
    						m.modalidade AS modalidade_adic,
    						UPPER(m.modalidade) AS modalidade, 
    						m.descricao, 
    						m.tipo							    	
				    	FROM modalidades_pessoas mp
				    	INNER JOIN modalidades m ON m.modid = mp.modid				    	
				    	WHERE mp.ativo = 1
				    	AND m.ativo = 1		
				    	AND mp.adic ".($adic == false ? "= 0" : " <> 0")." 
				    	AND mp.apid = {$apid}
				    	GROUP BY m.modalidade
				    	ORDER BY m.ordem ASC";
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
    public function fQuerySavePhoto($obj, $remove = false){
    	
    	if ($remove && ($obj['local'] == 1 || $obj['local'] == 4))
    		$this->fQueryRemoveCoverAndMainPhotos($obj['apid'], $obj['local']);
    	
    	$sql = "INSERT INTO pessoas_fotos (apid, tipo, imagemurl, local, hash, ativo, titulo, descricao)
       			VALUES ({$obj['apid']}, {$obj['tipo']}, '{$obj['imagemurl']}', {$obj['local']}, '{$obj['hash']}', ".($obj['ativo'] == 1 ? 1 : '0').", '{$obj['titulo']}', '{$obj['descricao']}')";
    	$this->fExecuteSql($sql); 
    	//COMENTADO POIS NAO PRECISA REAPROVAR ANUNCIO A CADA FOTO/VIDEO CRIADA
    	//$this->fQuerySetAdToDisabled($obj['apid']);
    	return true;
    }
    
     
    /**
     * Query Set AD To Unapproved
     * @param unknown $apid
     * @return boolean
     */
    private function fQuerySetAdToDisabled($apid){
    	$sql = "UPDATE anuncios_pessoas SET aprovado = 0, lido = 0 WHERE apid = {$apid}";
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