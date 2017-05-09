<?php
/**
* DEFINICOES DE CONEXAO COM BANCO DE DADOS
* @tutorial NOTA: Manter o bloqueio caso este arquivo seja acessado diretamente!
* @author Daniel Triboni
*/

/* Nome do Proprietario */
define("SIS_TITULO", "Libidinous");
/* Descricao Meta Description */
define("SIS_DESCRICAO", "");
/* URL do Proprietario - Configurar de acordo com a URL amigavel utilizada */
define("SIS_URL", "http://escort.local:9099/");
/* Email de Interacao */
define("SIS_EMAIL", "atendimento@url.com.br");
/* Idioma do Proprietario */
define("SIS_IDIOMA", "portugues");		
/* Servidor de Conexao ao banco */
die;define("SIS_HOST", "localhost");
/* Porta de Conexao ao banco */
define("SIS_PORTA", "3306");
/* Usuario de Conexao ao banco */
define("SIS_USUARIO", "root");
/* Senha de Conexao ao banco */
define("SIS_SENHA", "mysql1981"); 
/* Banco de dados do cliente */   
define("SIS_BANCO", "escort");
/* Tempo de uso de Sessao (em segundos) */
define("SIS_TEMPO", 7200);
/* Registros por Pagina */		
define("SIS_PAGINACAO", 20); 
/* Dias gratis do Plano Gratuito */
define ("SIS_DIAS_GRATIS", 10);

define("SIS_URL_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
//define("SIS_URL_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
/* Parcelas sem Juros no Cartao (PAGSEGURO) */
define('SIS_PARCELAS_SEM_JUROS', 5);