<?php
/**
* DEFINICOES DE CONEXAO COM BANCO DE DADOS
* @tutorial NOTA: Manter o bloqueio caso este arquivo seja acessado diretamente!
* @author Libidinous Development Team
*/

/* Site em Manutencao */
define("SIS_MANUTENCAO", false);
/* Site Inauguracao */
define("SIS_INAUGURACAO", '2016-11-15 00:00:00');
/* Nome do Proprietario */
define("SIS_TITULO", "Libidinous Club");
/* Descricao Meta Description */
define("SIS_DESCRICAO", (SIS_TITULO." | Anúncios GRÁTIS. Acompanhantes, escort, escorts, ficha rosa, acompanhantes e massagem, massagens, encontros casuais, VIP, massagem nuru, massagem lingam, massagem tailandesa, massagem relaxante, podolatria, massagem tantrica, massagem prostática, sexo oral, sexo anal, sexo vaginal, sexo grupal, swing, streptease, bondage, chuva dourada, dominação, fetiche, e muito mais. "));
/* URL do Proprietario - Configurar de acordo com a URL amigavel utilizada */
define("SIS_URL", "http://localhost/escort/");
/* Cookie secure mode */
define("SIS_SECURE", false);
/* Email de Interacao */
define("SIS_EMAIL", "atendimento@url.com.br");
/* Idioma do Proprietario */
define("SIS_IDIOMA", "portugues");		
/* Servidor de Conexao ao banco */
define("SIS_HOST", "localhost"); //50.62.176.34
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
/* Distancia proxima do usuario (em kilometros) */
define("SIS_KM_CLOSE", 2);
/* Dias gratis do Plano Gratuito */
define ("SIS_DIAS_GRATIS", 30);
/* URL (Pagseguro) */
define("SIS_URL_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
//define("SIS_URL_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
/* Parcelas sem Juros no Cartao (PAGSEGURO) */
define('SIS_PARCELAS_SEM_JUROS', 5);