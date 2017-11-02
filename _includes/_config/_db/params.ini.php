<?php
/**
* DEFINICOES DE CONEXAO COM BANCO DE DADOS
* @tutorial NOTA: Manter o bloqueio caso este arquivo seja acessado diretamente!
* @author Libidinous Development Team
*/

/* Nome do Proprietario */
define("SIS_TITULO", "Libidinous");
/* Descricao Meta Description */
define("SIS_DESCRICAO", utf8_encode(SIS_TITULO." | Anúncios GRÁTIS. Acompanhantes, escort, escorts, ficha rosa, acompanhantes e massagem, massagens, encontros casuais, VIP, massagem nuru, massagem lingam, massagem tailandesa, massagem relaxante, podolatria, massagem tântrica, massagem prostática, sexo oral, sexo anal, sexo vaginal, sexo grupal, swing, streptease, e muito mais. "));
/* URL do Proprietario - Configurar de acordo com a URL amigavel utilizada */
define("SIS_URL", "http://escort.local/");
/* Cookie secure mode */
define("SIS_SECURE", false);
/* Email de Interacao */
define("SIS_EMAIL", "atendimento@url.com.br");
/* Idioma do Proprietario */
define("SIS_IDIOMA", "portugues");		
/* Servidor de Conexao ao banco */
define("SIS_HOST", "localhost");
/* Porta de Conexao ao banco */
define("SIS_PORTA", "3306");
/* Usuario de Conexao ao banco */
define("SIS_USUARIO", "root");
/* Senha de Conexao ao banco */
define("SIS_SENHA", ""); 
/* Banco de dados do cliente */   
define("SIS_BANCO", "escort");
/* Tempo de uso de Sessao (em segundos) */
define("SIS_TEMPO", 7200);
/* Registros por Pagina */		
define("SIS_PAGINACAO", 5); 
/* Dias gratis do Plano Gratuito */
define ("SIS_DIAS_GRATIS", 30);

define("SIS_URL_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
//define("SIS_URL_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
/* Parcelas sem Juros no Cartao (PAGSEGURO) */
define('SIS_PARCELAS_SEM_JUROS', 5);