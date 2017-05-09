<?php
 /****************************************************************
 * ESCORT (R) - Atendimento Online entre clientes e corretores	 
 * @copyright Daniel Triboni - 2017 - Todos os Direitos Reservados *  * Arquivo de configuracoes gerais
 *****************************************************************/
	/**
	* EXIBICAO DE ERROS
	* @author Daniel Triboni
	*/
    error_reporting(E_ALL & ~E_NOTICE);        date_default_timezone_set('America/Sao_Paulo');

	/**	* BUSCAR PARAMETROS DE CONEXAO AO BANCO DE DADOS		* @tutorial NOTA: Qualquer modificacao pode resultar em erros no sistema!!!	* @author Daniel Triboni	*/    		try {		 				if (!@include_once("_db/params.ini.php"))		  throw new Exception("Erro ao inicializar o sistema!");		else{		  require_once "_db/params.ini.php";		  if (!@include_once("_lng/".SIS_IDIOMA.".ini.php"))		  	require_once "_lng/portugues.ini.php";		}  	}catch(Exception $e){            die($e->getMessage());	}    	/**	* ARRAY APROVACAO PRODUTO	* @author Daniel Triboni	*/	$arrayStatusProduct  = array (0 => "AGUARDANDO APROVA&Ccedil;&Atilde;O",                                  1 => "APROVADO",      							  2 => "REPROVADO");    							  	/**	* ARRAY STATUS AGENDA	* @author Daniel Triboni	*/	$arrayScheduleStatus = array (0 => "EM ABERTO",                                  1 => "ATENDIDO",      							  2 => "CANCELADO");    							      							      							  	                                     
    /**
	* ARRAY AVALIACAO ATENDIMENTO
	* @author Daniel Triboni
	*/
	$arrayRatingComment  = array (0 => "SEM AVALIA&Ccedil;&Atilde;O",
                                  1 => "RUIM",  
    							  2 => "REGULAR",
                                  3 => "BOM",
                                  4 => "&Oacute;TIMO",
                                  5 => "EXCELENTE");
                                      
    /**
	* ARRAY PERFIL DE ACESSO
	* @author Daniel Triboni
	*/    
	$arrayTypeUserAdmin = array (1 => "PESSOA",
                              	 2 => "USUARIO",
                              	 3 => "ADMINISTRADOR");
	/**	* AUTOLOAD DAS CLASSES	*	* @author    Daniel Triboni	* @param	 string Nome da Classe	* @return	 include File	*/    //function __autoload($class_name) {    	    	//require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_classes/".$class_name.".class.php";    	spl_autoload_register(function ($class_name) {    		require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_classes/".$class_name.".class.php";    	});    //}