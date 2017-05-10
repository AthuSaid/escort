<?php

/** ***************************************************************
* Classe de Autenticacoes - extendida da classe functions
*
* @author    Daniel Triboni
* @copyright (c) 2013 - TradeChat - Todos os Direitos Reservados
******************************************************************/
class auth extends functions {

	
	/**
	* Metodo Construtor da Classe
	*
	* @author    Daniel Triboni
	* 
	* @return    resource
	*/
	public function __construct() {
		parent::__construct();
	}
	
	
	/**
	* Authenticate Users in Website
	*
	* @author    Daniel Triboni
	* 
	* @param     string Usuario
	* 
	* @param     string Senha
	* 
	* @return    boolean
	*/
	public function fAuthenticateUser($strEmail, $strPass){
		if(!(empty($strEmail)) && (!empty($strPass))){
			$sql = "SELECT 
						u.*
					FROM 
						usuarios u
					WHERE 
						u.ativo = 1						
					AND	u.email = '".$this->fEscapeString($strEmail)."' 
					AND u.senha = '".base64_encode(md5($strPass))."'";            
			$this->fExecuteSql($sql);	
			if ($this->fNumRows() > 0){
				$ret = $this->fShowRecords();  
				$sql = "UPDATE usuarios SET
							logon = 1,
							onlinechat = 0,
							dtultimoacesso = now()							 
						WHERE usuid = ".$ret[0]['id'];            
				$this->fExecuteSql($sql);  
				$_SESSION['sUserLogged'] = true;
				$_SESSION['sUserID'] = $ret[0]['usuid'];						
                $_SESSION['sUserName'] = $ret[0]['nome'];                
                $_SESSION['sUserEmail'] = $ret[0]['email'];
                $_SESSION['sUserProfile'] = $ret[0]['perfil'];
                $_SESSION['sUserLastLogon'] = $ret[0]['dtultimoacesso'];
                $_SESSION['sUserSessionTime'] = time();
                return 2;
			}else{
                return 1;
            }	
		}else{
		   return 0;
		} 
	}
	
	
	/**
	 * Authenticate Persons in Website
	 *
	 * @author    Daniel Triboni
	 * 
	 * @param     string Usuario
	 * 
	 * @param     string Senha
	 * 
	 * @return    boolean
	 */
	public function fAuthenticatePerson($strEmail, $strPass){
		if(!(empty($strEmail)) && (!empty($strPass))){
			$sql = "SELECT
						p.*,
						(SELECT 
							DATEDIFF(pp2.vencimento, now()) 
						 FROM planos_pagamentos pp2
						 WHERE pp2.ppid = pp.ppid
						 ORDER BY pp2.pgid DESC LIMIT 1) AS diasvencimento,
						(SELECT 
							pp2.vencimento 
						 FROM planos_pagamentos pp2
						 WHERE pp2.ppid = pp.ppid
						 ORDER BY pp2.pgid DESC LIMIT 1) AS vencimento,
						CASE WHEN p.dtultimoacesso IS NOT NULL THEN
			    			DATE_FORMAT(p.dtultimoacesso, '&Uacute;ltimo acesso feito em %d/%m/%Y &agrave;s %H:%i') 
			    		ELSE
			    			'Este &eacute; o seu primeiro acesso!'
			    		END AS ultimoacesso,
						pl.plaid,
						pl.plano,
						pl.anuncios AS numanuncios,
						pl.fotos AS numfotos,
						pl.videos AS numvideos
					FROM
						pessoas p
					LEFT JOIN planos_pessoas pp ON pp.pesid = p.pesid
					LEFT JOIN planos pl ON pl.plaid = pp.plaid AND pl.tipo = 1 AND pl.ativo = 1
					WHERE
						p.ativo = 1
					AND	p.email = '".$strEmail."'
					AND p.senha = '".md5($strPass)."'
					ORDER BY pp.cadastro DESC LIMIT 1";
			$this->fExecuteSql($sql);
			if ($this->fNumRows() > 0){
				
				$ret = $this->fShowRecords();	
				$sql = "UPDATE pessoas SET
							logon = 1,
							ppv_online = 0,
							removido = 0, 
							dtultimoacesso = now()							
						WHERE pesid = ".$ret[0]['pesid'];
				$this->fExecuteSql($sql);
				$_SESSION['sPersonLogged'] = true;
				$_SESSION['sPersonID'] = $ret[0]['pesid'];
				$_SESSION['sPersonUrl'] = $ret[0]['url'];
				$_SESSION['sPersonAka'] = $ret[0]['apelido'];
				$_SESSION['sPersonName'] = $ret[0]['nome'];
				$_SESSION['sPersonEmail'] = $ret[0]['email'];
				$_SESSION['sPersonGender'] = $ret[0]['sexo'];
				$_SESSION['sPersonLastLogon'] = $ret[0]['ultimoacesso'];
				$_SESSION['sPersonComeBack'] = $ret[0]['removido'];
				$_SESSION['sPersonPlanID'] = $ret[0]['plaid'];
				$_SESSION['sPersonPlanName'] = $ret[0]['plano'];
				$_SESSION['sPersonPlanExpires'] = $ret[0]['diasvencimento'];
				$_SESSION['sPersonPlanExpiresDate'] = $ret[0]['vencimento'];
				$_SESSION['sPersonMaxAds'] = $ret[0]['numanuncios'];
				$_SESSION['sPersonMaxPhotos'] = $ret[0]['numfotos'];
				$_SESSION['sPersonMaxVideos'] = $ret[0]['numvideos'];
				$_SESSION['sPersonSessionTime'] = time();
				return true;
				
			}else{
				
				return false;
			}
			
		}else{
			
			return false;
		}
	}

    
	/**
	* Logoff User
	*
	* @author    Daniel Triboni
	* 
	* @return    true
	*/	
	public function fLogoutUser(){
		$sql = "UPDATE usuarios SET
					logon = 0,											
					onlinechat = 0 
				WHERE usuid = ".$_SESSION['sUserID'];            
		$this->fExecuteSql($sql);  
		unset($_SESSION);		
		unset($_REQUEST);
        session_destroy();       
	}
	
	
	/**
	 * Logoff Person
	 *
	 * @author    Daniel Triboni
	 * 
	 * @return    true
	 */
	public function fLogoutPerson(){
		$sql = "UPDATE pessoas SET
					logon = 0,
					ppv_online = 0
				WHERE pesid = ".$_SESSION['sPersonID'];
		$this->fExecuteSql($sql);
		unset($_SESSION);
		unset($_REQUEST);
		session_destroy();
	}
	
    
	
	
	
	/**
	 * Check if Person is Logged
	 *
	 * @author    Daniel Triboni
	 * 
	 * @return    string
	 */
	public function fCheckIsPersonLogged(){
		if ($_SESSION['sPersonSessionTime'] < (time() - SIS_TEMPO)) {
			$_SESSION['sPersonLogged'] = false;
		}else{
			$_SESSION['sSessionTime'] = time();
		}
		if($_SESSION['sPersonLogged'] == false){
			$this->fLogoutPerson();
			return 2;
		}
	}

		
	/**
	* Check if user email already exists
	*
	* @author    Daniel Triboni
	* 
	* @param     string Email
	*/
	private function fCheckIfUserEmailExists($strEmail){
		if(!(empty($strEmail))){
			$sql = "SELECT 
						u.email
					FROM 
						usuarios u 
					WHERE 
						u.email = '".$this->fEscapeString($strEmail)."'";			
			$this->fExecuteSql($sql);	
			if ($this->fNumRows() > 0){
				return true;			
			}else 
				return false;
		}	
	}
    
	
	/**
	* Check if user nickname already exists
	*
	* @author    Daniel Triboni
	* 
	* @param     string Apelido
	*/
	private function fCheckIfUserNickExists($strNick){
		if(!(empty($strNick))){
			$sql = "SELECT 
						u.apelido
					FROM 
						usuarios u 
					WHERE 
						u.apelido = '".$this->fEscapeString($strNick)."'";			
			$this->fExecuteSql($sql);	
			if ($this->fNumRows() > 0){
				return true;			
			}else 
				return false;
		}	
	}
	
	
	/**
	 * Check if person email already exists
	 *
	 * @author    Daniel Triboni
	 * 
	 * @param     string Email
	 */
	private function fCheckIfPersonEmailExists($strEmail){
		if(!(empty($strEmail))){
			$sql = "SELECT
						p.email
					FROM
						pessoas p
					WHERE
						p.email = '".$this->fEscapeString($strEmail)."'";
			$this->fExecuteSql($sql);
			if ($this->fNumRows() > 0){
				return true;
			}else
				return false;
		}
	}
	
	
	/**
	 * Check if person nickname already exists
	 *
	 * @author    Daniel Triboni
	 * 
	 * @param     string Apelido
	 */
	private function fCheckIfPersonNickExists($strNick){
		if(!(empty($strNick))){
			$sql = "SELECT
						p.apelido
					FROM
						pessoas p
					WHERE
						p.apelido = '".$this->fEscapeString($strNick)."'";
			$this->fExecuteSql($sql);
			if ($this->fNumRows() > 0){
				return true;
			}else
				return false;
		}
	}
}