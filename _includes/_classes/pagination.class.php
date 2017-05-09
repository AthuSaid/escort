<?php

class pagination extends functions {

	function __construct() {
		parent::__construct();
	}
	
    
    /**
     * Classe padrão de paginação
     * @author Leonardo Pricevicius    
    */        
	function fMakePgPagination($sql, $getPagina, $cont, $url, $div, $obj=""){
	   
		$this->fExecuteSql($sql);
		$totalItens = $this->fNumRows();
		$itensPerPage = SIS_PAGINACAO;				//numero de itens por pagina
		$numPaginas = $totalItens / $itensPerPage;	//numero de paginas
		$totalPaginas = ceil($numPaginas);			//arredonda um numero para cima	
        $max_links = 4;                            //maximo de links por paginacao
        $links_laterais = ceil($max_links / 2);                
                
		if (empty($getPagina) || $getPagina == 1){ 
		  $paginaAtual = 1;
		  $primeiro = 1;
		}else{
		  $paginaAtual = $getPagina;
		  $primeiro = $itensPerPage * ($paginaAtual - 1) + 1; 
		}		
		$cont = $primeiro;	
        
        $inicio = $paginaAtual - $links_laterais;
        $limite = $paginaAtual + $links_laterais;
                
        if($inicio <= 0){
        	$limite = $max_links; 
        	$inicio = 0;
        }
        if($limite >= $totalPaginas){
        	$diferenca = $limite - $totalPaginas;
        	$inicio = $inicio - $diferenca;
       	}
                
        if($totalItens>$itensPerPage){            
            $ret.= "<form id='frmPagination' method='post' onsubmit='return false'>";
            	if($obj != ''){
	                $array_name = array_keys($obj);
	                $array_values = array_values($obj);
	                for($i=0;$i<count($array_name);$i++){                    
	                    $ret.= "<input type='hidden' name='".$array_name[$i]."' value='".$array_values[$i]."' />";                                        
	                }
            	}
                $ret.= '<ul class="pagination">';		
            		if ($getPagina > 0){
            		  $anterior = $paginaAtual - 1;
            		  $ret.= '<li class="previous"><a onclick="fDoPage(\''.$url.$anterior.'\',\''.$div.'\')" title="Anterior">&lsaquo;</a></li>';
            		}else{
            		  $ret.= '<li class="previous"><a class="disable">&lsaquo;</a></li>';
            		}
            		for ($i = $inicio; $i <= $limite; $i++){
                        if ($getPagina == $i) {
                            $ret.= '<li><a class="current">'.($i+1).'</a></span>';
                        }else{
                            if ($i >= 0 && $i < $totalPaginas){
                                $ret.= '<li><a onclick="fDoPage(\''.$url.$i.'\',\''.$div.'\')" title="P&aacute;gina '.($i+1).'">'.($i+1).'</a></li>';    
                            }                
                        }
                    }
            		if ($getPagina < ($totalPaginas-1)) {
            		  $proxima = $getPagina + 1;
            		  $ret.= '<li class="next"><a onclick="fDoPage(\''.$url.$proxima.'\',\''.$div.'\')" title="Pr&oacute;xima">&rsaquo;</a></a></li>';
            		}else{
            		  $ret.= '<li class="next"><a class="disable">&rsaquo;</a></li>';
            		}
                $ret.= "</ul>";
            $ret.= "</form>";    
        }
        return $ret;
	}
    
   
    


}