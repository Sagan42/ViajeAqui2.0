-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: viajeaqui
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.17-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acesso`
--

DROP TABLE IF EXISTS `acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `dataAcesso` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_acesso_id_cliente` (`id_cliente`),
  CONSTRAINT `fk_acesso_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acesso`
--

LOCK TABLES `acesso` WRITE;
/*!40000 ALTER TABLE `acesso` DISABLE KEYS */;
INSERT INTO `acesso` VALUES (1,1,'2021-10-15 13:50:00'),(2,2,'2021-10-15 14:50:00'),(3,1,'2021-12-08 14:50:00'),(4,2,'2021-12-08 02:24:39'),(5,2,'2021-12-08 02:25:01'),(6,1,'2021-12-08 02:52:03');
/*!40000 ALTER TABLE `acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm`
--

DROP TABLE IF EXISTS `adm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `admMaster` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_adm_id_usuario` (`id_usuario`),
  CONSTRAINT `fk_adm_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm`
--

LOCK TABLES `adm` WRITE;
/*!40000 ALTER TABLE `adm` DISABLE KEYS */;
INSERT INTO `adm` VALUES (1,4,1),(2,5,0);
/*!40000 ALTER TABLE `adm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dia_semana` varchar(20) DEFAULT NULL,
  `hora` varchar(10) DEFAULT NULL,
  `id_linha` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_linha` (`id_linha`),
  CONSTRAINT `fk_id_linha` FOREIGN KEY (`id_linha`) REFERENCES `linha` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda`
--

LOCK TABLES `agenda` WRITE;
/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
INSERT INTO `agenda` VALUES (1,'segunda-feira','15:00',1),(2,'quarta-feira','10:00',1),(3,'quinta-feira','07:00',7),(4,'sábado','13:00',1),(5,'domingo','19:00',8),(6,'quinta-feira','05:00',4);
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente_id_usuario` (`id_usuario`),
  CONSTRAINT `fk_cliente_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_funcionario_id_usuario` (`id_usuario`),
  CONSTRAINT `fk_funcionario_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` VALUES (1,3);
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linha`
--

DROP TABLE IF EXISTS `linha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `linha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `preco` float NOT NULL,
  `tipoLinha` varchar(6) NOT NULL,
  `quantidadePassagem` int(11) NOT NULL DEFAULT 29,
  `origem` varchar(30) NOT NULL,
  `destino` varchar(30) NOT NULL,
  `num_linha` int(11) DEFAULT NULL,
  `id_adm` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linha_id_adm` (`id_adm`),
  CONSTRAINT `fk_linha_id_adm` FOREIGN KEY (`id_adm`) REFERENCES `adm` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linha`
--

LOCK TABLES `linha` WRITE;
/*!40000 ALTER TABLE `linha` DISABLE KEYS */;
INSERT INTO `linha` VALUES (1,40,'Direta',28,'Feira de Santana','Salvador',NULL,1),(2,44,'Direta',28,'Feira de Santana','Ilheus',NULL,1),(3,36,'Comum',28,'Salvador','Feira de Santana',1,2),(4,36,'Comum',28,'Feira de Santana','Riachão do Jacuipe',2,2),(5,40,'Comum',28,'Riachão do Jacuipe','Capim Grosso',2,2),(6,35,'Comum',28,'Capim Grosso','Jacobina',2,2),(7,50,'Direta',28,'Feira de Santana','Salvador',NULL,1),(8,65,'Direta',28,'Salvador','Camaçari',NULL,1);
/*!40000 ALTER TABLE `linha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passagem`
--

DROP TABLE IF EXISTS `passagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `passagem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_funcionario` int(11) DEFAULT NULL,
  `id_viajem` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `origem` varchar(30) DEFAULT NULL,
  `destino` varchar(30) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `tipoLinha` varchar(6) DEFAULT NULL,
  `diaVenda` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_passagem_id_funcionario` (`id_funcionario`),
  KEY `fk_passagem_id_viajem` (`id_viajem`),
  KEY `fk_passagem_id_cliente` (`id_cliente`),
  CONSTRAINT `fk_passagem_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `fk_passagem_id_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  CONSTRAINT `fk_passagem_id_viajem` FOREIGN KEY (`id_viajem`) REFERENCES `viajem` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passagem`
--

LOCK TABLES `passagem` WRITE;
/*!40000 ALTER TABLE `passagem` DISABLE KEYS */;
INSERT INTO `passagem` VALUES (1,1,1,1,'Salvador','Camaçari',65,'Direta','2021-12-04'),(2,1,2,1,'Feira de Santana','Salvador',40,'Direta','2021-12-04'),(3,1,1,2,'Salvador','Camaçari',65,'Direta','2021-12-04'),(4,1,2,2,'Feira de Santana','Salvador',40,'Direta','2021-12-04'),(5,1,5,2,'Feira de Santana','Salvador',40,'Direta','2021-12-08');
/*!40000 ALTER TABLE `passagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relatorio`
--

DROP TABLE IF EXISTS `relatorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relatorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatorio`
--

LOCK TABLES `relatorio` WRITE;
/*!40000 ALTER TABLE `relatorio` DISABLE KEYS */;
/*!40000 ALTER TABLE `relatorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relatorioadm`
--

DROP TABLE IF EXISTS `relatorioadm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relatorioadm` (
  `id_relatorio` int(11) NOT NULL,
  `id_adm` int(11) NOT NULL,
  KEY `fk_relatorioAdm_id_relatorio` (`id_relatorio`),
  KEY `fk_relatorioAdm_id_adm` (`id_adm`),
  CONSTRAINT `fk_relatorioAdm_id_adm` FOREIGN KEY (`id_adm`) REFERENCES `adm` (`id`),
  CONSTRAINT `fk_relatorioAdm_id_relatorio` FOREIGN KEY (`id_relatorio`) REFERENCES `relatorio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatorioadm`
--

LOCK TABLES `relatorioadm` WRITE;
/*!40000 ALTER TABLE `relatorioadm` DISABLE KEYS */;
/*!40000 ALTER TABLE `relatorioadm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relatoriofuncionario`
--

DROP TABLE IF EXISTS `relatoriofuncionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relatoriofuncionario` (
  `id_relatorio` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  KEY `fk_relatorioFuncionario_id_relatorio` (`id_relatorio`),
  KEY `fk_relatorioFuncionario_id_funcionario` (`id_funcionario`),
  CONSTRAINT `fk_relatorioFuncionario_id_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  CONSTRAINT `fk_relatorioFuncionario_id_relatorio` FOREIGN KEY (`id_relatorio`) REFERENCES `relatorio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatoriofuncionario`
--

LOCK TABLES `relatoriofuncionario` WRITE;
/*!40000 ALTER TABLE `relatoriofuncionario` DISABLE KEYS */;
/*!40000 ALTER TABLE `relatoriofuncionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `tipoUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'joaosvbg@gmail.com','Joao Samuel da  Silva','$2y$10$eJp8pTFMKIwczyd0/ZGWYOzqEXVuR5el1VVF5hP5ggDIdA0QS5wHq','991951780','40274881560',0),(2,'maria@gmail.com','Maria da Silva','$2y$10$XLsX/x8H1j.wL/atBbPGY.DF6mfD5KwEYPSac..5H353V4UCFKDQm','75999344780','40648611590',0),(3,'jose@gmail.com','Jose da Silva','$2y$10$Qd480zS.qAHvN3zDtDY0J.ebkDMHeZsazzKR38Rg9QDZrLG0PsVLS','99346660','36558438526',1),(4,'marcos@gmail.com','Marcos','$2a$12$zDiaHVGJsuZl4BR/MTCpOebn6p34heqJxnzbvcgK.RR/BykP7fz7W','99756660','80759477540',2),(5,'isa@gmail.com','Isabela','$2a$12$zDiaHVGJsuZl4BR/MTCpOebn6p34heqJxnzbvcgK.RR/BykP7fz7W','93426660','69938577580',2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viajem`
--

DROP TABLE IF EXISTS `viajem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `viajem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantidadePassagem` int(11) DEFAULT NULL,
  `dataViajem` varchar(10) NOT NULL,
  `horaViajem` varchar(10) DEFAULT NULL,
  `id_linha` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_linhaVendendo` (`id_linha`),
  CONSTRAINT `fk_id_linhaVendendo` FOREIGN KEY (`id_linha`) REFERENCES `linha` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viajem`
--

LOCK TABLES `viajem` WRITE;
/*!40000 ALTER TABLE `viajem` DISABLE KEYS */;
INSERT INTO `viajem` VALUES (1,28,'2021-12-04','19:00',8),(2,28,'2021-12-06','15:00',1),(3,28,'2021-12-08','10:00',2),(4,28,'2021-12-09','07:00',7),(5,27,'2021-12-08','10:00',1);
/*!40000 ALTER TABLE `viajem` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-08 11:11:49
