-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.17-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para pagarumacontinha
CREATE DATABASE IF NOT EXISTS `pagarumacontinha` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pagarumacontinha`;

-- Copiando estrutura para tabela pagarumacontinha.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` varchar(100) DEFAULT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_USUARIO_TBCATEGORIA` (`ID_USUARIO`),
  CONSTRAINT `FK_USUARIO_TBCATEGORIA` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pagarumacontinha.categoria: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`ID`, `DESCRICAO`, `ID_USUARIO`) VALUES
	(1, 'CASA', NULL),
	(2, 'Carro', NULL),
	(16, 'dadadda', NULL),
	(17, 'testee', NULL),
	(18, 'testeste', NULL),
	(19, 'lucas', NULL),
	(20, 'EMPRESTIMO', NULL),
	(21, 'EMPRESTIMO', NULL),
	(22, 'ESTUDOS', NULL),
	(23, 'ESTUDOS', NULL),
	(24, 'CASA', 1),
	(25, 'CARRO', 1),
	(26, 'GOVERNO', 1);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Copiando estrutura para tabela pagarumacontinha.condicao_pagamento
CREATE TABLE IF NOT EXISTS `condicao_pagamento` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` varchar(400) DEFAULT NULL,
  `FORMA` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pagarumacontinha.condicao_pagamento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `condicao_pagamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `condicao_pagamento` ENABLE KEYS */;

-- Copiando estrutura para tabela pagarumacontinha.despesas
CREATE TABLE IF NOT EXISTS `despesas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VALOR_DESPESA` decimal(10,2) DEFAULT NULL,
  `TOTAL_PARCELAS` bigint(20) DEFAULT NULL,
  `DATA_COMPRA` date DEFAULT NULL,
  `ID_FORNECEDOR` int(11) NOT NULL,
  `ID_CATEGORIA` int(11) DEFAULT NULL,
  `ID_CONDICAOPAGAMENTO` int(11) DEFAULT NULL,
  `JUROS_ATRASO` int(11) NOT NULL DEFAULT 0,
  `DESCONTO` int(11) NOT NULL DEFAULT 0,
  `ID_FORMA_PAGAMENTO` int(11) DEFAULT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_TBCATEGORIA` (`ID_CATEGORIA`),
  KEY `FK_TBFORNECEDOR` (`ID_FORNECEDOR`),
  KEY `FK_TBFORMAS_PAGAMENTO` (`ID_FORMA_PAGAMENTO`),
  KEY `FK_despesas_formas_pagamento` (`ID_CONDICAOPAGAMENTO`),
  KEY `FK_TBUSUARIOS` (`ID_USUARIO`) USING BTREE,
  CONSTRAINT `FK_TBCATEGORIA` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categoria` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_TBFORMAS_PAGAMENTO` FOREIGN KEY (`ID_FORMA_PAGAMENTO`) REFERENCES `formas_pagamento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_TBFORNECEDOR` FOREIGN KEY (`ID_FORNECEDOR`) REFERENCES `fornecedor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_TBUSUARIO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_despesas_formas_pagamento` FOREIGN KEY (`ID_CONDICAOPAGAMENTO`) REFERENCES `formas_pagamento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=430 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pagarumacontinha.despesas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `despesas` DISABLE KEYS */;
INSERT INTO `despesas` (`ID`, `VALOR_DESPESA`, `TOTAL_PARCELAS`, `DATA_COMPRA`, `ID_FORNECEDOR`, `ID_CATEGORIA`, `ID_CONDICAOPAGAMENTO`, `JUROS_ATRASO`, `DESCONTO`, `ID_FORMA_PAGAMENTO`, `ID_USUARIO`) VALUES
	(428, 4000.00, 10, '2021-06-07', 31, 26, NULL, 0, 0, 29, 1),
	(429, 1000.00, 4, '2021-06-07', 30, 24, NULL, 18, 10, 31, 1);
/*!40000 ALTER TABLE `despesas` ENABLE KEYS */;

-- Copiando estrutura para view pagarumacontinha.despesasdt
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `despesasdt` (
	`CONTA` VARCHAR(200) NULL COLLATE 'utf8mb4_general_ci',
	`FORNECEDOR` VARCHAR(400) NULL COLLATE 'utf8mb4_general_ci',
	`VALOR PARCELA` DECIMAL(10,2) NULL,
	`Nª PARCELA` INT(11) NULL,
	`TOTAL PARCELA` BIGINT(20) NULL,
	`DT VENCIMENTO` DATE NULL,
	`JUROS` DECIMAL(10,2) NULL,
	`DESCONTO` DECIMAL(10,2) NULL,
	`DT PAGAMENTO` DATE NULL,
	`STATUS` VARCHAR(1) NOT NULL COLLATE 'utf8mb4_general_ci',
	`ID_FORNECEDOR` INT(11) NOT NULL,
	`ID_FORMA_PAGAMENTO` INT(11) NULL,
	`ID` INT(11) NULL,
	`VALOR PARCELA FINAL` DECIMAL(12,2) NULL,
	`ID_DESPESA` INT(11) NOT NULL,
	`ID_CATEGORIA` INT(11) NULL,
	`CATEGORIAS` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`ID_USUARIO` INT(11) NULL
) ENGINE=MyISAM;

-- Copiando estrutura para tabela pagarumacontinha.despesas_detalhes
CREATE TABLE IF NOT EXISTS `despesas_detalhes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VALOR_PARCELA` decimal(10,2) DEFAULT NULL,
  `DATA_VENCIMENTO` date DEFAULT NULL,
  `DATA_PAGAMENTO` date DEFAULT NULL,
  `JUROS` decimal(10,2) NOT NULL DEFAULT 0.00,
  `DESCONTO` decimal(10,2) NOT NULL DEFAULT 0.00,
  `ID_DESPESA` int(11) DEFAULT NULL,
  `NUMERO_PARCELA` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_TBDESPESA` (`ID_DESPESA`),
  CONSTRAINT `FK_TBDESPESA` FOREIGN KEY (`ID_DESPESA`) REFERENCES `despesas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=761 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pagarumacontinha.despesas_detalhes: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `despesas_detalhes` DISABLE KEYS */;
INSERT INTO `despesas_detalhes` (`ID`, `VALOR_PARCELA`, `DATA_VENCIMENTO`, `DATA_PAGAMENTO`, `JUROS`, `DESCONTO`, `ID_DESPESA`, `NUMERO_PARCELA`) VALUES
	(747, 400.00, '2021-07-07', '2021-06-07', 0.00, 0.00, 428, 1),
	(748, 400.00, '2021-08-06', '2021-06-07', 10.00, 0.00, 428, 2),
	(749, 400.00, '2021-09-05', '2021-06-07', 0.00, 0.00, 428, 3),
	(750, 400.00, '2021-10-05', '2021-06-07', 0.00, 0.00, 428, 4),
	(751, 400.00, '2021-11-04', '2021-06-07', 0.00, 0.00, 428, 5),
	(752, 400.00, '2021-12-04', NULL, 0.00, 0.00, 428, 6),
	(753, 400.00, '2022-01-03', NULL, 10.00, 0.00, 428, 7),
	(754, 400.00, '2022-02-02', NULL, 0.00, 0.00, 428, 8),
	(755, 400.00, '2022-03-04', NULL, 0.00, 0.00, 428, 9),
	(756, 400.00, '2022-04-03', NULL, 0.00, 0.00, 428, 10),
	(757, 247.50, '2021-07-07', '2021-06-07', 10.00, 0.00, 429, 1),
	(758, 247.50, '2021-08-06', '2021-06-07', 0.00, 0.00, 429, 2),
	(759, 247.50, '2021-09-05', '2021-06-07', 0.00, 0.00, 429, 3),
	(760, 247.50, '2021-10-05', NULL, 0.00, 0.00, 429, 4);
/*!40000 ALTER TABLE `despesas_detalhes` ENABLE KEYS */;

-- Copiando estrutura para tabela pagarumacontinha.formas_pagamento
CREATE TABLE IF NOT EXISTS `formas_pagamento` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` varchar(200) NOT NULL,
  `SALDO_LIMITE` decimal(10,2) DEFAULT NULL,
  `DATA_COBRANCA` date DEFAULT NULL,
  `DATA_ATUALIZACAO` date DEFAULT NULL,
  `DESCRICAO_ATUALIZACAO` varchar(200) DEFAULT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ID_USUARIO` (`ID_USUARIO`),
  CONSTRAINT `FK_ID_USUARIO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pagarumacontinha.formas_pagamento: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `formas_pagamento` DISABLE KEYS */;
INSERT INTO `formas_pagamento` (`ID`, `DESCRICAO`, `SALDO_LIMITE`, `DATA_COBRANCA`, `DATA_ATUALIZACAO`, `DESCRICAO_ATUALIZACAO`, `ID_USUARIO`) VALUES
	(1, 'NUBAK', 4000.00, '2021-04-27', NULL, NULL, NULL),
	(11, 'TRIG', 1200.00, '2021-06-02', NULL, NULL, NULL),
	(12, 'C3 BANK', 2000.00, '2021-06-05', NULL, NULL, NULL),
	(13, 'ITAU', 6000.00, '2021-06-05', NULL, NULL, NULL),
	(14, 'SICRED', 5500.00, '2021-06-05', NULL, NULL, NULL),
	(26, 'BRADESCO', 8600.00, '2021-06-06', NULL, NULL, NULL),
	(28, 'teste', 1600.00, '2021-06-07', NULL, NULL, NULL),
	(29, 'NUBANK', 4000.00, '2021-06-07', NULL, NULL, 1),
	(31, 'BRADESCO', 6600.00, '2021-06-07', NULL, NULL, 1),
	(32, 'CARTAO', 2000.00, '2021-06-07', NULL, NULL, NULL);
/*!40000 ALTER TABLE `formas_pagamento` ENABLE KEYS */;

-- Copiando estrutura para tabela pagarumacontinha.fornecedor
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `RAZAO_SOCIAL` varchar(400) DEFAULT NULL,
  `DOCUMENTO` varchar(100) DEFAULT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ID_USUARIO_TBFORNECEDOR` (`ID_USUARIO`),
  CONSTRAINT `FK_ID_USUARIO_TBFORNECEDOR` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pagarumacontinha.fornecedor: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `fornecedor` DISABLE KEYS */;
INSERT INTO `fornecedor` (`ID`, `RAZAO_SOCIAL`, `DOCUMENTO`, `ID_USUARIO`) VALUES
	(1, 'HAVAN', '0000000000', NULL),
	(17, 'KADESH EQUIPAMENTOS PROFISSIONAIS LTDA', '06293564000146', NULL),
	(18, 'KADESH EQUIPAMENTOS PROFISSIONAIS LTDA', '06293564000146', NULL),
	(19, 'KADESH EQUIPAMENTOS PROFISSIONAIS LTDA', '06293564000146', NULL),
	(20, '0001A LITORAL LOCADORA LTDA', '02828446000134', NULL),
	(21, '0001 ASSESSORIA E SERVICOS LTDA', '72610132000146', NULL),
	(22, '', '', NULL),
	(23, '', '', NULL),
	(24, '', '', NULL),
	(25, '', '', NULL),
	(26, '', '', NULL),
	(27, 'B3 S.A. - BRASIL, BOLSA, BALCAO', '09346601000125', NULL),
	(28, 'KADESH EQUIPAMENTOS PROFISSIONAIS LTDA', '09.346.601/0001-25', NULL),
	(29, '', '', NULL),
	(30, 'BANCO BMG SA', '61.186.680/0001-74', 1),
	(31, 'ADVOCACIA GERAL DA UNIAO', ' 26.994.558/0001-23', 1);
/*!40000 ALTER TABLE `fornecedor` ENABLE KEYS */;

-- Copiando estrutura para tabela pagarumacontinha.limite_cartao
CREATE TABLE IF NOT EXISTS `limite_cartao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cartao` int(11) NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  `data_limite` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cartao` (`id_cartao`),
  CONSTRAINT `limite_cartao_ibfk_1` FOREIGN KEY (`id_cartao`) REFERENCES `formas_pagamento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pagarumacontinha.limite_cartao: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `limite_cartao` DISABLE KEYS */;
INSERT INTO `limite_cartao` (`id`, `id_cartao`, `saldo`, `data_limite`) VALUES
	(1, 1, 4000.00, '2021-04-27'),
	(2, 11, 1200.00, '2021-06-02'),
	(3, 12, 2000.00, '2021-06-05'),
	(4, 13, 6000.00, '2021-06-05'),
	(5, 14, 5500.00, '2021-06-05'),
	(7, 26, 8600.00, '2021-06-06'),
	(9, 28, 1600.00, '2021-06-07'),
	(10, 29, 4000.00, '2021-06-07'),
	(12, 31, 6600.00, '2021-06-07'),
	(13, 32, 2000.00, '2021-06-07');
/*!40000 ALTER TABLE `limite_cartao` ENABLE KEYS */;

-- Copiando estrutura para tabela pagarumacontinha.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela pagarumacontinha.usuario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `username`, `user_password`) VALUES
	(1, 'admin', 'admin');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Copiando estrutura para view pagarumacontinha.despesasdt
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `despesasdt`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `despesasdt` AS SELECT (SELECT formas_pagamento.DESCRICAO FROM formas_pagamento WHERE formas_pagamento.ID = A.ID_FORMA_PAGAMENTO) AS `CONTA`, 
(SELECT fornecedor.RAZAO_SOCIAL FROM fornecedor WHERE fornecedor.ID = A.ID_FORNECEDOR) AS `FORNECEDOR`, 
DT.VALOR_PARCELA AS `VALOR PARCELA`, DT.NUMERO_PARCELA AS `Nª PARCELA`, A.TOTAL_PARCELAS AS `TOTAL PARCELA`,
DT.DATA_VENCIMENTO AS `DT VENCIMENTO`, DT.JUROS, DT.DESCONTO, DT.DATA_PAGAMENTO AS `DT PAGAMENTO`,
IF(ISNULL(DT.DATA_PAGAMENTO),"1","0") AS `STATUS`, A.ID_FORNECEDOR, A.ID_FORMA_PAGAMENTO, DT.ID,
((DT.VALOR_PARCELA - DT.DESCONTO + DT.JUROS)) AS `VALOR PARCELA FINAL`, A.ID AS `ID_DESPESA`, A.ID_CATEGORIA,
(SELECT DESCRICAO FROM categoria WHERE categoria.ID IN(A.ID_CATEGORIA)) AS `CATEGORIAS`, A.ID_USUARIO
FROM despesas AS A
LEFT OUTER JOIN despesas_detalhes AS DT ON DT.ID_DESPESA = A.ID ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
