-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.27-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela escort.anuncios_pessoas
DROP TABLE IF EXISTS `anuncios_pessoas`;
CREATE TABLE IF NOT EXISTS `anuncios_pessoas` (
  `apid` int(11) NOT NULL AUTO_INCREMENT,
  `pesid` int(11) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '0',
  `aprovado` int(1) NOT NULL DEFAULT '0',
  `mensagem` text,
  `lido` int(1) DEFAULT '0',
  `titulo` varchar(60) NOT NULL,
  `url` varchar(160) NOT NULL,
  `descricao` text NOT NULL,
  `pessoasatendimento` varchar(50) NOT NULL,
  `locaisatendimento` varchar(50) NOT NULL,
  `localproprio` char(1) DEFAULT '0',
  `idiomas` varchar(50) NOT NULL,
  `moeda` varchar(4) NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visitascount` int(11) DEFAULT '0',
  PRIMARY KEY (`apid`),
  KEY `FK12_Pessoas` (`pesid`),
  CONSTRAINT `FK12_Pessoas` FOREIGN KEY (`pesid`) REFERENCES `pessoas` (`pesid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.anuncios_pessoas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `anuncios_pessoas` DISABLE KEYS */;
INSERT INTO `anuncios_pessoas` (`apid`, `pesid`, `ativo`, `aprovado`, `mensagem`, `lido`, `titulo`, `url`, `descricao`, `pessoasatendimento`, `locaisatendimento`, `localproprio`, `idiomas`, `moeda`, `cadastro`, `visitascount`) VALUES
	(1, 2, 1, 1, NULL, 1, 'Anúncio teste', 'anuncio-teste', 'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.', 'Homens, Mulheres, Casais', '', '1', 'Português, Inglês', 'R$', '2017-05-11 08:42:22', 2);
/*!40000 ALTER TABLE `anuncios_pessoas` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.chats
DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `chatid` int(11) NOT NULL AUTO_INCREMENT,
  `ppvid` int(11) NOT NULL,
  `lido` int(1) NOT NULL DEFAULT '0',
  `de` int(11) NOT NULL,
  `para` int(11) DEFAULT NULL,
  `mensagem` text NOT NULL,
  `dtenvio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`chatid`),
  KEY `FK3_PPV` (`ppvid`),
  CONSTRAINT `FK3_PPV` FOREIGN KEY (`ppvid`) REFERENCES `ppv` (`ppvid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.chats: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.destaque_pessoas
DROP TABLE IF EXISTS `destaque_pessoas`;
CREATE TABLE IF NOT EXISTS `destaque_pessoas` (
  `desid` int(11) NOT NULL AUTO_INCREMENT,
  `apid` int(11) NOT NULL,
  `destaque` int(1) NOT NULL DEFAULT '1',
  `inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `final` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`desid`),
  KEY `FK10_Pessoas` (`apid`),
  CONSTRAINT `FK4_AnuncioPessoas` FOREIGN KEY (`apid`) REFERENCES `anuncios_pessoas` (`apid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.destaque_pessoas: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `destaque_pessoas` DISABLE KEYS */;
INSERT INTO `destaque_pessoas` (`desid`, `apid`, `destaque`, `inicio`, `final`) VALUES
	(1, 1, 1, '2017-05-11 14:51:34', '2017-05-11 17:00:00'),
	(2, 1, 2, '2017-05-11 14:56:22', '2017-05-12 17:00:00'),
	(3, 1, 3, '2017-05-11 14:56:31', '2017-05-13 17:00:00'),
	(4, 1, 4, '2017-05-11 14:56:38', '2017-05-14 17:00:00'),
	(5, 1, 5, '2017-05-11 14:56:45', '2017-05-15 17:00:00');
/*!40000 ALTER TABLE `destaque_pessoas` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.etnias
DROP TABLE IF EXISTS `etnias`;
CREATE TABLE IF NOT EXISTS `etnias` (
  `etid` int(3) NOT NULL AUTO_INCREMENT,
  `sexo` char(1) NOT NULL DEFAULT 'M',
  `etnia` varchar(50) NOT NULL,
  PRIMARY KEY (`etid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.etnias: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `etnias` DISABLE KEYS */;
INSERT INTO `etnias` (`etid`, `sexo`, `etnia`) VALUES
	(1, 'M', 'Claro'),
	(2, 'F', 'Clara'),
	(3, 'M', 'Negro'),
	(4, 'F', 'Negra'),
	(5, 'M', 'Moreno'),
	(6, 'F', 'Morena'),
	(7, 'M', 'Mulato'),
	(8, 'F', 'Mulata'),
	(9, 'M', 'Loiro'),
	(10, 'F', 'Loira'),
	(11, 'M', 'Ruivo'),
	(12, 'F', 'Ruiva'),
	(13, 'M', 'Oriental'),
	(14, 'F', 'Oriental'),
	(15, 'M', 'Índio'),
	(16, 'F', 'Índia');
/*!40000 ALTER TABLE `etnias` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.fotos_interacao
DROP TABLE IF EXISTS `fotos_interacao`;
CREATE TABLE IF NOT EXISTS `fotos_interacao` (
  `intid` int(11) NOT NULL AUTO_INCREMENT,
  `fotid` int(11) NOT NULL,
  `usuid` int(11) NOT NULL,
  `gostou` int(1) NOT NULL DEFAULT '0',
  `comentario` text,
  PRIMARY KEY (`intid`),
  KEY `FK2_Fotos` (`fotid`),
  KEY `FK2_Usuarios` (`usuid`),
  CONSTRAINT `FK2_Fotos` FOREIGN KEY (`fotid`) REFERENCES `pessoas_fotos` (`fotid`),
  CONSTRAINT `FK2_Usuarios` FOREIGN KEY (`usuid`) REFERENCES `usuarios` (`usuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.fotos_interacao: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `fotos_interacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `fotos_interacao` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.locais_pessoas
DROP TABLE IF EXISTS `locais_pessoas`;
CREATE TABLE IF NOT EXISTS `locais_pessoas` (
  `locid` int(11) NOT NULL AUTO_INCREMENT,
  `apid` int(11) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '0',
  `local` varchar(50) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  PRIMARY KEY (`locid`),
  KEY `FK11__pessoas` (`apid`),
  CONSTRAINT `FK1_AnuncioPessoas` FOREIGN KEY (`apid`) REFERENCES `anuncios_pessoas` (`apid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.locais_pessoas: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `locais_pessoas` DISABLE KEYS */;
INSERT INTO `locais_pessoas` (`locid`, `apid`, `ativo`, `local`, `endereco`, `latitude`, `longitude`) VALUES
	(1, 1, 1, 'Bristol International Airport Hotel', 'Rua Soldado José de Andrade, 63 - Jardim Santa Francisca, Guarulhos', '-23.47397179999999', '-46.529392599999994'),
	(2, 1, 1, 'Hotel Matiz Guarulhos', 'Rua Pedro de Toledo, 1000 - Jardim Santa Lidia, Guarulhos', '-23.4379974', '-46.496350800000016'),
	(3, 1, 1, 'Sao Paulo Airport Marriott Hotel', 'Av. Min. Evandro Lins e Silva 10/100 - Parque Cecap, Guarulhos', '-23.456907', '-46.49244699999997'),
	(4, 1, 1, 'Sables Hotel', 'Avenida Salgado Filho, 1176 - Jardim Maia, Guarulhos', '-23.4552311', '-46.53368979999999');
/*!40000 ALTER TABLE `locais_pessoas` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.logs
DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pesid` int(11) DEFAULT '0',
  `plaid` int(11) DEFAULT '0',
  `apid` int(11) DEFAULT '0',
  `fotid` int(11) DEFAULT '0',
  `psid` varchar(50) DEFAULT '0',
  `acao` varchar(250) DEFAULT '0',
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.logs: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`logid`, `data`, `pesid`, `plaid`, `apid`, `fotid`, `psid`, `acao`) VALUES
	(2, '2017-05-11 13:21:05', 2, 0, 0, 0, 'A10F074A-8BD6-4050-A2E8-36B6E248E282', 'Pagamento do Plano via PagSeguro aguardando confirmacao'),
	(3, '2017-05-11 13:23:55', 2, 3, 0, 0, 'A10F074A-8BD6-4050-A2E8-36B6E248E282', 'Pagamento do Plano via PagSeguro aguardando confirmacao');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.modalidades
DROP TABLE IF EXISTS `modalidades`;
CREATE TABLE IF NOT EXISTS `modalidades` (
  `modid` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` int(1) NOT NULL DEFAULT '1',
  `modalidade` varchar(50) NOT NULL,
  `descricao` text,
  `tipo` int(1) NOT NULL DEFAULT '1' COMMENT 'Tipo da Modalidade: 1 = Serviços Pessoais, 2 = Serviços PPV',
  PRIMARY KEY (`modid`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.modalidades: ~31 rows (aproximadamente)
/*!40000 ALTER TABLE `modalidades` DISABLE KEYS */;
INSERT INTO `modalidades` (`modid`, `ativo`, `modalidade`, `descricao`, `tipo`) VALUES
	(1, 1, 'Massagem Tântrica', 'Trata-se de um sistema completo de tratamento para expansão<br> da sensibilidade e desenvolvimento do orgasmo, <br>possibilitando uma cura no corpo, na mente e nas emoções.', 1),
	(2, 1, 'Massagem Nuru', 'Muito comum no Japão e nos Estados Unidos, a Massagem Nuru<br> consiste numa técnica que envolve confiança e segurança<br>entre massagista e cliente, onde seus corpos serão<br>submetidos a toques diretos num colchão próprio,<br> nele é utilizado um gel especial que é<br>espalhado em seu corpo de forma diferenciada.', 1),
	(3, 1, 'Acompanhante', NULL, 1),
	(4, 1, 'Sexo Oral', NULL, 1),
	(5, 1, 'Sexo Anal', NULL, 1),
	(6, 1, 'Sexo Vaginal', NULL, 1),
	(7, 1, 'Beijo na Boca', NULL, 1),
	(8, 1, 'Streaptease', NULL, 1),
	(9, 1, 'Fetiche', 'Desejo de teor sexual que se tem por alguma parte do <br>corpo masculino como pés, boca, peitoral, braços fortes, <br>barba, ou pela utilização de fantasias ou acessórios sexuais.', 1),
	(10, 1, 'Dominação', NULL, 1),
	(11, 1, 'Sexo Grupal', NULL, 1),
	(12, 1, 'Beijo Grego', 'Prática do sexo oral-anal.', 1),
	(13, 1, 'Masturbação', NULL, 1),
	(15, 1, 'Chuva Dourada', 'Modalidade sexual em que o homem urina na mulher <br>ou a mulher urina no homem durante o sexo.', 1),
	(16, 1, 'Ativa', NULL, 1),
	(17, 1, 'Passiva', NULL, 1),
	(18, 1, 'Bondage', 'Fetiche geralmente relacionado com sadomasoquismo,<br> onde a principal fonte de prazer consiste em amarrar<br> e imobilizar seu parceiro ou pessoa envolvida.<br> Pode ou não envolver a prática de sexo com penetração.', 1),
	(19, 1, 'Massagem Lingam', 'A Lingam massagem embora seja uma massagem peniana ela<br> não é aplicada apenas no eixo do próprio pênis, a massagem<br> deve ser executada também no períneo, bem como os testículos.<br> Contrariamente à crença comum, a experiência<br> nem sempre é algo que um homem quando iniciados<br> estejam confortáveis, isso é comum, pois geralmente os homens são <br>focados em performance, uma vez que uma massagem tantra lingam <br>não é sobre o desempenho sexual masculino, mas sobre<br> se entregar ao prazer aplicado externamente.', 1),
	(20, 1, 'Massagem Tailandesa', 'Terapia curativa tailandesa que utiliza a massagem como forma de<br> equilíbrio corporal, onde o terapeuta usa seus pés, <br>joelhos, polegares, palmas e cotovelos,<br> além de pressão, compressão e alongamento, no corpo do paciente.', 1),
	(21, 1, 'Massagem Prostática', 'Prática sexual que consiste na introdução de um ou mais dedos,<br> ou algum outro estimulador, no orifício anal durante o ato sexual.<br> Esta prática é tida como um tabu para alguns homens.<br> No entanto, pode ser bastante estimulante, devido à proximidade da<br> próstata e às inúmeras terminações nervosas. <br>A próstata é considerada por muitos como o correspondente do ponto G masculino.', 1),
	(22, 1, 'Massagem Relaxante', NULL, 1),
	(23, 1, 'Bukkake ', 'Modalidade de sexo grupal que consiste em uma pessoa<br> “recebendo” a ejaculação de diversos homens.', 1),
	(24, 1, 'Coprofagia', 'Fetiche pela ingestão de fezes. <br><br>Já a coprofilia é o fetiche pela manipulação de fezes,<br> próprias ou do parceiro', 1),
	(25, 1, 'Banho romano', 'Ato de vomitar para provocar excitação.', 1),
	(26, 1, 'Fisting', 'Prazer com a inserção da mão ou antebraço na vagina ou ânus', 1),
	(27, 1, 'Podolatria', 'Desejo sexual que se concentra nos pés do parceiro.', 1),
	(28, 1, 'Chuva de Prata', 'Ato que acontece na relação sexual de ejacular na face<br> do parceiro após o sexo oral, durante o orgasmo.', 1),
	(29, 1, 'Submissão', NULL, 1),
	(30, 1, 'Ficha Rosa', 'É uma modelo feminina que aceita a proposta para esticar<br> o horário de trabalho e sair com os clientes ou <br>frequentadores de uma feira ou evento.', 1),
	(31, 1, 'Swing', 'Relacionamento sexual entre dois casais estáveis que praticam <br>sexo grupal como uma atividade recreativa ou social.', 1),
	(32, 1, 'Ficha Azul', 'É uma modelo masculino que aceita a proposta para esticar<br> o horário de trabalho e sair com as clientes ou <br>frequentadoras de uma feira ou evento.', 1),
	(33, 1, 'Voyeurismo', 'Prática sexual que consiste na observação de uma pessoa<br> no ato de se despir, nua ou realizando atos sexuais <br>e que não se sabe que está sendo observada.<br> Forma de curiosidade mórbida com relação<br> ao que é privativo, privado ou íntimo.', 1),
	(34, 1, 'Eventos & Festas', NULL, 1),
	(35, 1, 'Inversão de Papel', NULL, 1);
/*!40000 ALTER TABLE `modalidades` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.modalidades_pessoas
DROP TABLE IF EXISTS `modalidades_pessoas`;
CREATE TABLE IF NOT EXISTS `modalidades_pessoas` (
  `mpid` int(11) NOT NULL AUTO_INCREMENT,
  `modid` int(11) NOT NULL,
  `apid` int(11) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mpid`),
  KEY `FK1_Modalidades` (`modid`),
  KEY `FK2_Pessoas` (`apid`),
  CONSTRAINT `FK1_Modalidades` FOREIGN KEY (`modid`) REFERENCES `modalidades` (`modid`),
  CONSTRAINT `FK2_Anuncios` FOREIGN KEY (`apid`) REFERENCES `anuncios_pessoas` (`apid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.modalidades_pessoas: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `modalidades_pessoas` DISABLE KEYS */;
INSERT INTO `modalidades_pessoas` (`mpid`, `modid`, `apid`, `ativo`) VALUES
	(1, 3, 1, 1),
	(2, 7, 1, 1),
	(3, 15, 1, 1),
	(4, 10, 1, 1),
	(5, 2, 1, 1),
	(6, 5, 1, 1),
	(7, 4, 1, 1),
	(8, 6, 1, 1);
/*!40000 ALTER TABLE `modalidades_pessoas` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.newsletter
DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `nlid` int(11) NOT NULL AUTO_INCREMENT,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mensagem` text NOT NULL,
  PRIMARY KEY (`nlid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.newsletter: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
INSERT INTO `newsletter` (`nlid`, `cadastro`, `nome`, `email`, `mensagem`) VALUES
	(1, '2017-05-05 09:13:19', 'André Martos', 'andremartos@gmail.com', 'Teste de Mensságem!!!!'),
	(2, '2017-05-05 09:14:49', 'Daniel Augusto', 'danieltriboni@gmail.com', 'Teste\\r\\nde\\r\\nMensagem\\r\\ncom quebra de linha!!!!'),
	(3, '2017-05-05 09:15:38', 'Daniel Augusto', 'danieltriboni@gmail.com', 'teste\\r\\nde\\r\\nmesmgem'),
	(4, '2017-05-05 09:20:24', 'Daniel Augusto', 'danieltriboni@gmail.com', 'Teste \r\nda\r\nMensságemQ!!!'),
	(5, '2017-05-05 09:21:37', 'Daniel Augusto', 'danieltriboni@gmail.com', 'teste\r\nda\r\n,emsságem!!!');
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.pessoas
DROP TABLE IF EXISTS `pessoas`;
CREATE TABLE IF NOT EXISTS `pessoas` (
  `pesid` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` int(1) NOT NULL DEFAULT '1',
  `nome` varchar(50) NOT NULL,
  `apelido` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL DEFAULT 'F',
  `genero` varchar(10) NOT NULL DEFAULT 'venus',
  `etnia` varchar(15) NOT NULL,
  `olhos` varchar(15) NOT NULL,
  `cabelos` varchar(15) NOT NULL,
  `whatsapp` varchar(15) DEFAULT NULL,
  `tel1` varchar(15) NOT NULL,
  `tel2` varchar(15) NOT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `googleplus` varchar(50) DEFAULT NULL,
  `nascimento` datetime NOT NULL,
  `naturalidade` varchar(50) NOT NULL,
  `rg` char(12) NOT NULL,
  `cpf` char(14) NOT NULL,
  `peso` varchar(3) NOT NULL,
  `altura` varchar(4) NOT NULL,
  `busto` varchar(3) DEFAULT NULL,
  `cintura` varchar(3) DEFAULT NULL,
  `quadril` varchar(3) DEFAULT NULL,
  `pcm` varchar(2) DEFAULT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aprovado` int(1) NOT NULL DEFAULT '0',
  `mensagem` text,
  `lido` int(1) DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `documento` varchar(30) NOT NULL,
  `comprovacao` varchar(30) NOT NULL,
  `ppv` int(1) NOT NULL DEFAULT '0',
  `ppv_online` int(1) NOT NULL DEFAULT '0',
  `logon` int(1) NOT NULL DEFAULT '0',
  `dtultimoacesso` timestamp NULL DEFAULT NULL,
  `removido` int(1) DEFAULT '0',
  `visitascount` int(9) DEFAULT '0',
  PRIMARY KEY (`pesid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.pessoas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` (`pesid`, `ativo`, `nome`, `apelido`, `url`, `sexo`, `genero`, `etnia`, `olhos`, `cabelos`, `whatsapp`, `tel1`, `tel2`, `twitter`, `facebook`, `googleplus`, `nascimento`, `naturalidade`, `rg`, `cpf`, `peso`, `altura`, `busto`, `cintura`, `quadril`, `pcm`, `cadastro`, `aprovado`, `mensagem`, `lido`, `email`, `senha`, `documento`, `comprovacao`, `ppv`, `ppv_online`, `logon`, `dtultimoacesso`, `removido`, `visitascount`) VALUES
	(2, 1, 'Samanta Maynardi Oliveira', 'Sammy Maynardi', 'sammy-maynardi', 'F', 'venus', 'Branca', 'Castanhos', 'Castanhos', '(11) 94848-4856', '(11) 9632-6545', '', 'http://www.facebook.com/sammy', 'http://www.facebook.com/sammy', 'http://www.facebook.com/sammy', '1988-01-14 00:00:00', 'Caxangá - PE, Brasil', '123654789', '338.286.978-01', '55', '1,60', '60', '50', '90', '', '2017-04-14 15:18:29', 1, NULL, 1, 'c18635315671048116126@sandbox.pagseguro.com.br', '202cb962ac59075b964b07152d234b70', 'doc-rz4vj9tn3xwc.jpg', 'doc-x9hcp8i5snyl.jpg', 0, 0, 1, '2017-05-11 16:18:31', 0, 0),
	(4, 1, 'Daniel Triboni', 'Daniel', 'daniel', 'M', 'mars', 'Branca', 'Verdes', 'Castanhos', '(11) 98196-6796', '', '', '', '', '', '1981-01-14 00:00:00', 'Mogi das Cruzes - SP, Brasil', '123456789', '288.711.918-46', '78', '1,75', '', '', '', '', '2017-05-03 09:08:11', 0, NULL, 0, 'danieltriboni@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'doc-mvxsgdfplwyr.jpg', 'doc-gusdey127p9j.jpg', 0, 0, 0, '2017-05-10 11:20:02', 0, 0);
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.pessoas_cache
DROP TABLE IF EXISTS `pessoas_cache`;
CREATE TABLE IF NOT EXISTS `pessoas_cache` (
  `cacheid` int(11) NOT NULL AUTO_INCREMENT,
  `apid` int(11) NOT NULL DEFAULT '0',
  `c30` varchar(5) DEFAULT NULL,
  `c1` varchar(5) DEFAULT NULL,
  `c2` varchar(5) DEFAULT NULL,
  `c4` varchar(5) DEFAULT NULL,
  `c8` varchar(5) DEFAULT NULL,
  `c12` varchar(5) DEFAULT NULL,
  `viagem` varchar(5) DEFAULT NULL,
  `custoprata` int(3) DEFAULT NULL,
  `custoouro` int(3) DEFAULT NULL,
  `custodiamante` int(3) DEFAULT NULL,
  PRIMARY KEY (`cacheid`),
  KEY `FK4_ModalidadesPessoas` (`apid`),
  CONSTRAINT `FK1_AnunciosPessoas` FOREIGN KEY (`apid`) REFERENCES `anuncios_pessoas` (`apid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.pessoas_cache: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoas_cache` DISABLE KEYS */;
INSERT INTO `pessoas_cache` (`cacheid`, `apid`, `c30`, `c1`, `c2`, `c4`, `c8`, `c12`, `viagem`, `custoprata`, `custoouro`, `custodiamante`) VALUES
	(1, 1, '', '150', '300', '', '', '', '5.000', NULL, NULL, NULL);
/*!40000 ALTER TABLE `pessoas_cache` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.pessoas_fotos
DROP TABLE IF EXISTS `pessoas_fotos`;
CREATE TABLE IF NOT EXISTS `pessoas_fotos` (
  `fotid` int(11) NOT NULL AUTO_INCREMENT,
  `apid` int(11) NOT NULL,
  `ativo` int(1) DEFAULT '1',
  `imagemurl` varchar(100) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `tipo` int(1) NOT NULL COMMENT 'Tipo: 1 = thumb, 2 = large',
  `local` int(1) NOT NULL DEFAULT '1' COMMENT 'Local da Foto: 1 = Galeria Foto Pessoas, 2 = Galeria Pessoal, 3 = Foto Capa',
  `principal` char(1) NOT NULL DEFAULT 'S',
  `titulo` varchar(30) DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`fotid`),
  KEY `FK5_Pessoas` (`apid`),
  CONSTRAINT `FK1_Anuncios` FOREIGN KEY (`apid`) REFERENCES `anuncios_pessoas` (`apid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.pessoas_fotos: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoas_fotos` DISABLE KEYS */;
INSERT INTO `pessoas_fotos` (`fotid`, `apid`, `ativo`, `imagemurl`, `hash`, `tipo`, `local`, `principal`, `titulo`, `descricao`) VALUES
	(1, 1, 1, '4ryabilg3f5d.png', '4ryabilg3f5d', 1, 2, 'S', 'Crisântemo', 'descrição crisântemo'),
	(2, 1, 1, '4ryabilg3f5d.original.jpeg', '4ryabilg3f5d', 2, 2, 'S', 'Crisântemo', 'descrição crisântemo'),
	(3, 1, 1, '3eqckrl1m80d.png', '3eqckrl1m80d', 1, 2, 'S', 'Coala', 'coala teste'),
	(4, 1, 1, '3eqckrl1m80d.original.jpeg', '3eqckrl1m80d', 2, 2, 'S', 'Coala', 'coala teste'),
	(5, 1, 1, 'h30xoebvgkq9.png', 'h30xoebvgkq9', 1, 2, 'S', 'Eu', 'eu'),
	(6, 1, 1, 'h30xoebvgkq9.original.jpeg', 'h30xoebvgkq9', 2, 2, 'S', 'Eu', 'eu'),
	(7, 1, 1, 'hoykt2wgslxn.png', 'hoykt2wgslxn', 1, 1, 'S', '', ''),
	(8, 1, 1, 'hoykt2wgslxn.original.jpeg', 'hoykt2wgslxn', 2, 1, 'S', '', ''),
	(9, 1, 1, 'h2bd5zuestiw.png', 'h2bd5zuestiw', 1, 4, 'S', '', ''),
	(10, 1, 1, 'h2bd5zuestiw.original.jpeg', 'h2bd5zuestiw', 2, 4, 'S', '', '');
/*!40000 ALTER TABLE `pessoas_fotos` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.planos
DROP TABLE IF EXISTS `planos`;
CREATE TABLE IF NOT EXISTS `planos` (
  `plaid` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` int(1) NOT NULL DEFAULT '1',
  `plano` varchar(50) NOT NULL,
  `tipo` int(1) NOT NULL DEFAULT '1' COMMENT 'Tipo do Plano: 1 = Pessoas, 2 = Usuarios',
  `valor` decimal(10,2) NOT NULL,
  `cobrancadias` int(3) DEFAULT NULL COMMENT 'Dias de cobrança: 30 (mensal), 90 (trimestral) ou 365 dias (anual)',
  `descricao` text NOT NULL,
  `destaqueposter` int(1) DEFAULT '0',
  `destaquelivreto` int(1) DEFAULT '0',
  `destaquelistaquatro` int(1) DEFAULT '0',
  `destaquenovaspessoas` int(1) DEFAULT '0',
  `destaquegaleriahome` int(1) DEFAULT '0',
  `periododestaque` int(2) DEFAULT '7' COMMENT '1 = Diario, 7 = Semanal, 30 = Mensal, 365 = Anual',
  `anuncios` int(4) NOT NULL,
  `fotos` int(6) NOT NULL,
  `videos` int(6) DEFAULT NULL,
  PRIMARY KEY (`plaid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.planos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `planos` DISABLE KEYS */;
INSERT INTO `planos` (`plaid`, `ativo`, `plano`, `tipo`, `valor`, `cobrancadias`, `descricao`, `destaqueposter`, `destaquelivreto`, `destaquelistaquatro`, `destaquenovaspessoas`, `destaquegaleriahome`, `periododestaque`, `anuncios`, `fotos`, `videos`) VALUES
	(1, 1, 'Basic', 1, 0.00, 0, '<h5><i class="fa fa-id-card-o"></i> <em>Apenas 1 an&uacute;ncio</em></h5>\r\n<h5><i class="fa fa-file-photo-o"></i> <em>At&eacute; 12 Fotos</em></h5>\r\n<h5><i class="fa fa-file-video-o"></i> <em>At&eacute; 3 V&iacute;deos</em></h5>		                                          <h5><i class="fa fa-heart"></i> <em>Resultados nos mecanismos de busca</em></h5>\r\n<h5><i class="fa fa-heart-o"></i> <em>Destaque no Livreto e Poster na Home</em></h5>', 1, 1, 1, 1, 1, 10, 1, 12, 3),
	(2, 1, 'Premium', 1, 199.90, 30, '<h5><i class="fa fa-id-card-o"></i> <em>At&eacute; 5 an&uacute;ncios</em></h5>\r\n<h5><i class="fa fa-file-photo-o"></i> <em>Fotos Ilimitadas</em></h5>\r\n<h5><i class="fa fa-file-video-o"></i> <em>V&iacute;deos Ilimitados</em></h5>		                                          <h5><i class="fa fa-heart"></i> <em>Resultados nos mecanismos de busca</em></h5>\r\n<h5><i class="fa fa-heart-o"></i> <em>Destaque no Livreto e Poster na Home</em></h5>', 0, 0, 0, 0, 0, 7, 5, 999, 999),
	(3, 1, 'Advanced', 1, 599.90, 90, '<h5><i class="fa fa-id-card-o"></i> <em>An&uacute;ncios Ilimitados</em></h5>\r\n<h5><i class="fa fa-file-photo-o"></i> <em>Fotos Ilimitadas</em></h5>\r\n<h5><i class="fa fa-file-video-o"></i> <em>V&iacute;deos Ilimitados</em></h5>		                                          <h5><i class="fa fa-heart"></i> <em>Resultados nos mecanismos de busca</em></h5>\r\n<h5><i class="fa fa-heart-o"></i> <em>Destaque no Livreto e Poster na Home</em></h5>', 0, 0, 0, 0, 0, 30, 999, 999, 999),
	(4, 1, 'Ultra', 1, 1499.90, 180, '<h5><i class="fa fa-id-card-o"></i> <em>An&uacute;ncios Ilimitados</em></h5>\r\n<h5><i class="fa fa-file-photo-o"></i> <em>Fotos Ilimitadas</em></h5>\r\n<h5><i class="fa fa-file-video-o"></i> <em>V&iacute;deos Ilimitados</em></h5>		                                          <h5><i class="fa fa-heart"></i> <em>Resultados nos mecanismos de busca</em></h5>\r\n<h5><i class="fa fa-heart-o"></i> <em>Destaque no Livreto e Poster na Home</em></h5>', 0, 0, 0, 0, 0, 365, 999, 999, 999);
/*!40000 ALTER TABLE `planos` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.planos_pagamentos
DROP TABLE IF EXISTS `planos_pagamentos`;
CREATE TABLE IF NOT EXISTS `planos_pagamentos` (
  `pgid` int(11) NOT NULL AUTO_INCREMENT,
  `ppid` int(11) NOT NULL,
  `psid` varchar(100) DEFAULT NULL,
  `vloriginal` decimal(10,2) NOT NULL,
  `vencimento` datetime NOT NULL,
  `pagamento` datetime DEFAULT NULL,
  `vlcorrigido` decimal(10,2) DEFAULT NULL,
  `pago` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pgid`),
  KEY `FK1_Planos` (`ppid`),
  CONSTRAINT `FK1_PlanosPessoas` FOREIGN KEY (`ppid`) REFERENCES `planos_pessoas` (`ppid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela escort.planos_pagamentos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `planos_pagamentos` DISABLE KEYS */;
INSERT INTO `planos_pagamentos` (`pgid`, `ppid`, `psid`, `vloriginal`, `vencimento`, `pagamento`, `vlcorrigido`, `pago`) VALUES
	(2, 4, NULL, 0.00, '2017-05-04 09:38:45', NULL, NULL, 0),
	(10, 12, '', 0.00, '2017-05-08 10:46:52', NULL, NULL, 0),
	(11, 13, 'A10F074A-8BD6-4050-A2E8-36B6E248E282', 399.90, '2017-06-03 13:26:50', NULL, NULL, 1);
/*!40000 ALTER TABLE `planos_pagamentos` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.planos_pessoas
DROP TABLE IF EXISTS `planos_pessoas`;
CREATE TABLE IF NOT EXISTS `planos_pessoas` (
  `ppid` int(11) NOT NULL AUTO_INCREMENT,
  `plaid` int(11) NOT NULL,
  `pesid` int(11) NOT NULL,
  `cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ppid`),
  KEY `FK1_Planos` (`plaid`),
  KEY `FK3_Pessoas` (`pesid`),
  CONSTRAINT `FK1_Planos` FOREIGN KEY (`plaid`) REFERENCES `planos` (`plaid`),
  CONSTRAINT `FK3_Pessoas` FOREIGN KEY (`pesid`) REFERENCES `pessoas` (`pesid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.planos_pessoas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `planos_pessoas` DISABLE KEYS */;
INSERT INTO `planos_pessoas` (`ppid`, `plaid`, `pesid`, `cadastro`) VALUES
	(4, 2, 4, '2017-05-03 09:31:35'),
	(12, 1, 2, '2017-05-04 10:46:52'),
	(13, 3, 2, '2017-05-04 13:26:50');
/*!40000 ALTER TABLE `planos_pessoas` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.planos_usuarios
DROP TABLE IF EXISTS `planos_usuarios`;
CREATE TABLE IF NOT EXISTS `planos_usuarios` (
  `ppid` int(11) NOT NULL AUTO_INCREMENT,
  `plaid` int(11) NOT NULL,
  `usuid` int(11) NOT NULL,
  `vloriginal` decimal(10,2) NOT NULL,
  `vencimento` datetime NOT NULL,
  `pagamento` datetime NOT NULL,
  `vlcorrigido` decimal(10,2) NOT NULL,
  `pago` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ppid`),
  KEY `FK1_Planos` (`plaid`),
  KEY `FK3_Pessoas` (`usuid`),
  CONSTRAINT `FK1_Usuarios` FOREIGN KEY (`usuid`) REFERENCES `usuarios` (`usuid`),
  CONSTRAINT `FK2_Planos` FOREIGN KEY (`plaid`) REFERENCES `planos` (`plaid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela escort.planos_usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `planos_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `planos_usuarios` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.ppv
DROP TABLE IF EXISTS `ppv`;
CREATE TABLE IF NOT EXISTS `ppv` (
  `ppvid` int(11) NOT NULL AUTO_INCREMENT,
  `pesid` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fim` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ppvid`),
  KEY `FK6_Pessoas` (`pesid`),
  CONSTRAINT `FK6_Pessoas` FOREIGN KEY (`pesid`) REFERENCES `pessoas` (`pesid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.ppv: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ppv` DISABLE KEYS */;
/*!40000 ALTER TABLE `ppv` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.ppv_interacao
DROP TABLE IF EXISTS `ppv_interacao`;
CREATE TABLE IF NOT EXISTS `ppv_interacao` (
  `intid` int(11) NOT NULL AUTO_INCREMENT,
  `ppvid` int(11) NOT NULL,
  `usuid` int(11) NOT NULL,
  `mpid` int(11) NOT NULL,
  `custoprata` int(3) DEFAULT NULL,
  `custoouro` int(3) DEFAULT NULL,
  `custodiamante` int(3) DEFAULT NULL,
  PRIMARY KEY (`intid`),
  KEY `FK1_PPV` (`ppvid`),
  KEY `FK3_Usuarios` (`usuid`),
  KEY `FK4_ModalidadesPessoas` (`mpid`),
  CONSTRAINT `FK1_PPV` FOREIGN KEY (`ppvid`) REFERENCES `ppv` (`ppvid`),
  CONSTRAINT `FK3_Usuarios` FOREIGN KEY (`usuid`) REFERENCES `usuarios` (`usuid`),
  CONSTRAINT `FK5_ModalidadesPessoas` FOREIGN KEY (`mpid`) REFERENCES `modalidades_pessoas` (`mpid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.ppv_interacao: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ppv_interacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `ppv_interacao` ENABLE KEYS */;


-- Copiando estrutura para tabela escort.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuid` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` int(1) NOT NULL DEFAULT '1',
  `nome` varchar(50) NOT NULL,
  `apelido` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL DEFAULT 'M',
  `avatar` varchar(50) DEFAULT NULL,
  `nascimento` datetime NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `logon` int(1) NOT NULL DEFAULT '0',
  `onlinechat` int(1) NOT NULL DEFAULT '0',
  `dtultimoacesso` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`usuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela escort.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
