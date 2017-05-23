<?php

/** 
* Classe de Conexao MySQL
* @author Libidinous Development Team
*/  
class mysqlconn {
		
	protected $connection;
	
	private $resultSet;
	
	private $sqlMsgError;
			
	/**
	* Metodo Construtor da Classe
	*
	* @author    Daniel Triboni
	* @return    resource
	*/
	public function __construct($host=SIS_HOST, $user=SIS_USUARIO, $senha=SIS_SENHA, $banco=SIS_BANCO){
		$this->fConnect($host, $user, $senha, $banco);		
	}

	
	/**
	* Conectar ao banco MySQL
	*
	* @author    Daniel Triboni
	* @param	 string HOST
	* @param	 string USER
	* @param	 string PASS
	* @param	 string DATABASE
	* @return    boolean
	*/
	private function fConnect($host, $user, $senha, $banco){
		try {   			
			$this->connection = mysqli_connect($host, $user, $senha);
			if(!mysqli_select_db($this->connection, $banco))
			 	echo $this->fShowError(mysqli_error($this->connection));
			if(!$this->connection){
				echo $this->fShowError(mysqli_error($this->connection));
			}        
		}catch(Exception $erro){
			echo $this->fShowError($erro->getMessage());		    
			exit;
		}
	  return false;
	  die;
	}

	
	/**
	* Desconexao ao banco MySQL
	*
	* @author    Daniel Triboni
	* @return    boolean
	*/	
	private function fDisconnect(){
		return @mysqli_close($this->connection);
	}
	
	
	/**
	* Evitar SQL Injections
	*
	* @author    Daniel Triboni
	* @return    boolean
	*/	
	public function fEscapeString($string){
		return mysqli_real_escape_string($this->connection, $string);
	}	
	
	
	/**
	* Alerta de Erro Generico
	*
	* @author    Daniel Triboni
	* @param     string Descricao        
	* @return    string
	*/
	public function fShowError($error, $file="", $line=""){
		$resError = str_replace("\n", "", $error);
		$resError = str_replace('"', '', $resError);
		$resError = str_replace('^', '', $resError);		
		$arrError = explode("LINE", $resError);		
		$layout_erro = '<script>
							var mensagem = "Problemas ao conectar com o banco de dados do Portal!\\n\\n" +
						    "Erro: \''.strip_tags(trim($arrError[0])).'\' \\n\\n" + ';							
			if ($file != "" && $line != ""){
				$resFile = str_replace("\\", "/", $file);
				$layout_erro .= '"Arquivo: \''.$resFile.'\'\\n" +
								 "Linha:     '.$line.'\\n\\n" + ';
			}
			$layout_erro .= '"Clique no bot\xE3o \'OK\' para tentar recarregar o sistema novamente.\\n" + 
							 "Se o problema persistir, entre em contato com o Suporte T\xE9cnico!";';
			$layout_erro .= 'if (confirm(mensagem))
									window.location.reload();							
							</script>';			
		return ($layout_erro);
	}

	
	/**
	* Exibir Registros da Query
	*
	* @author    Daniel Triboni
	* @return    array
	*/		
	public function fShowRecords(){
		$result = array();
		$kind="assoc";		
		if($this->resultSet){
		    $kind = $kind === 'assoc' ? $kind : 'row';
		    eval('while(@$r = mysqli_fetch_'.$kind.'($this->resultSet)) array_push($result, $r);');
			if(empty($result))			
				return null;
			else
				return $result;
		}
	}
	
	
	/**
	* Exibir numero de linhas da Query
	*
	* @author    Daniel Triboni
	* @return    integer
	*/	
	public function fNumRows(){
		return mysqli_num_rows($this->resultSet);
	}
	
	
	/**
	* Exibir ultimo ID Inserido
	*
	* @author    Daniel Triboni
	* @return    integer
	*/
	public function fGetLastInsertID(){
		return mysqli_insert_id($this->connection);
	}
	
	
	/**
	* Executar Queries no MySQL
	*
	* @author    Daniel Triboni
	* @param     string SQL
	* @return    Resource#ID
	*/	
	function fExecuteSql($sql){
		try{
			if($this->resultSet = mysqli_query($this->connection, $sql)){
				if(preg_match("#^\s?(select)#i", $sql)){
					if(mysqli_num_rows($this->resultSet) > 0){
						if ($this->resultSet)
							$return[] = $this->resultSet;
						else
							$return = "";
					}
				}
				return true;
			}else{
				throw new Exception(mysqli_error($this->connection));
				return false;	
			}
		}catch(Exception $errorHandler){
			$error = $errorHandler->getTrace();
			$this->fSaveQueryErrors($errorHandler->getMessage(), $error);			
			$this->sqlMsgError = $this->fShowError($errorHandler->getMessage(), $error[0]['file'], ($error[0]['line']-1));
			return false;
		}			
	}

	
	/**
	* Salvar Erros de Queries executadas
	*
	* @author    Daniel Triboni
	* @param     string Mensagem Erro
	* @param	 array Erro
	* @return    boolean
	*/
	private function fSaveQueryErrors($msg, $error){
		$sqlError = "INSERT INTO tblerros 
						(err_banco, err_erro) 
					 VALUES 
						('".SIS_BANCO."', '".addslashes($msg)." - Arquivo: ".str_replace("\\", "/", $error[0]['file'])." - Linha: ".($error[0]['line']-1)."')";
		mysqli_query($this->connection, $sqlError);
		return true;
	}
}