-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ssegui
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actividadusuario`
--

DROP TABLE IF EXISTS `actividadusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividadusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(32) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `idrol` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `fregistro` date DEFAULT NULL,
  `idusuarios` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_anti_rol` (`idrol`),
  KEY `fk_actividad_usuarios` (`idusuarios`),
  CONSTRAINT `fk_actividad_usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_anti_rol` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividadusuario`
--

LOCK TABLES `actividadusuario` WRITE;
/*!40000 ALTER TABLE `actividadusuario` DISABLE KEYS */;
INSERT INTO `actividadusuario` VALUES (1,'hilaquita@hotmail.com','8cb2237d0679ca88db6464eac60da96345513964',NULL,1,'2015-03-11',1),(2,'maya@hotmail.com','8cb2237d0679ca88db6464eac60da96345513964',NULL,1,'2015-03-12',2),(3,'paul@hotmail.com','8cb2237d0679ca88db6464eac60da96345513964',NULL,1,'2015-04-18',3);
/*!40000 ALTER TABLE `actividadusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `antiguedad`
--

DROP TABLE IF EXISTS `antiguedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `antiguedad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechainicial` date DEFAULT NULL,
  `fechafinal` date DEFAULT NULL,
  `idcargo` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `fregistro` date DEFAULT NULL,
  `idactividadusuario` int(11) DEFAULT NULL,
  `idestructura` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cargo` (`idcargo`),
  KEY `fk_ant_estructura` (`idestructura`),
  KEY `fk_ant_usuario` (`idactividadusuario`),
  CONSTRAINT `fk_ant_estructura` FOREIGN KEY (`idestructura`) REFERENCES `estructura` (`id`),
  CONSTRAINT `fk_ant_usuario` FOREIGN KEY (`idactividadusuario`) REFERENCES `actividadusuario` (`id`),
  CONSTRAINT `fk_cargo` FOREIGN KEY (`idcargo`) REFERENCES `cargos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `antiguedad`
--

LOCK TABLES `antiguedad` WRITE;
/*!40000 ALTER TABLE `antiguedad` DISABLE KEYS */;
INSERT INTO `antiguedad` VALUES (1,'2014-08-11',NULL,1,1,'2015-03-11',1,2),(2,'2015-03-12',NULL,2,1,'2015-03-12',2,4);
/*!40000 ALTER TABLE `antiguedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(60) DEFAULT NULL,
  `descripcion` text,
  `fregistro` date DEFAULT NULL,
  `tipocargo` varchar(30) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Director Ejecutivo',NULL,'2015-03-15','Ejecutivo',1),(2,'Técnico Consultor',NULL,'2015-03-15','Técnico',1),(3,'Secretaria',NULL,'2015-03-15','Operativo',1),(4,'wilmersssss','','0000-00-00','sadfasd',1),(5,'asdfsadfsdg','rrr','0000-00-00','rrrrr',1),(6,'asdfasdfas','asdfasdf','2015-03-16','asdfasdf',1),(7,'alfa','rrrrr','0000-00-00','rrrrrrr',1),(8,'adafsdf','adsfads','2015-04-11','asdfasdf',1);
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cite`
--

DROP TABLE IF EXISTS `cite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idestructura` int(11) DEFAULT NULL,
  `acronimo` varchar(60) DEFAULT NULL,
  `contador` int(7) DEFAULT NULL,
  `tipocreacion` varchar(30) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acron_estruc` (`idestructura`),
  CONSTRAINT `fk_acron_estruc` FOREIGN KEY (`idestructura`) REFERENCES `estructura` (`idforaneo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cite`
--

LOCK TABLES `cite` WRITE;
/*!40000 ALTER TABLE `cite` DISABLE KEYS */;
INSERT INTO `cite` VALUES (1,1,'INIAF-DGE',0,'Orden Estructura',1),(2,4,'INIAF-DGE-UP',0,'Orden Estructura',1),(3,17,'ALGO',2015,'custom',1),(4,7,'OTRA',0,'estructura',1),(5,2,'INIAF-DGE-UPS',9,'estructura',1);
/*!40000 ALTER TABLE `cite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `concopia`
--

DROP TABLE IF EXISTS `concopia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `concopia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddocumento` int(11) DEFAULT NULL,
  `idactividadusuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cc_doc` (`iddocumento`),
  KEY `fk_cc_usua` (`idactividadusuario`),
  CONSTRAINT `fk_cc_doc` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`id`),
  CONSTRAINT `fk_cc_usua` FOREIGN KEY (`idactividadusuario`) REFERENCES `actividadusuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concopia`
--

LOCK TABLES `concopia` WRITE;
/*!40000 ALTER TABLE `concopia` DISABLE KEYS */;
INSERT INTO `concopia` VALUES (9,1,1),(10,22,3),(11,25,3),(12,26,3),(13,27,3),(15,28,3),(17,29,3),(18,31,3),(19,32,3);
/*!40000 ALTER TABLE `concopia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datospersonales`
--

DROP TABLE IF EXISTS `datospersonales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datospersonales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `detalle` text,
  `estado` int(1) DEFAULT NULL,
  `fregistro` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario` (`idusuario`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datospersonales`
--

LOCK TABLES `datospersonales` WRITE;
/*!40000 ALTER TABLE `datospersonales` DISABLE KEYS */;
/*!40000 ALTER TABLE `datospersonales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destinatario`
--

DROP TABLE IF EXISTS `destinatario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destinatario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddocumento` int(11) DEFAULT NULL,
  `idactividadusuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dest_usua` (`idactividadusuario`),
  KEY `fk_dest_doc` (`iddocumento`),
  CONSTRAINT `fk_dest_doc` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`id`),
  CONSTRAINT `fk_dest_usua` FOREIGN KEY (`idactividadusuario`) REFERENCES `actividadusuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destinatario`
--

LOCK TABLES `destinatario` WRITE;
/*!40000 ALTER TABLE `destinatario` DISABLE KEYS */;
INSERT INTO `destinatario` VALUES (4,13,1),(5,13,2),(6,14,2),(7,15,2),(10,17,2),(11,17,1),(12,18,2),(24,1,3),(25,22,2),(26,25,2),(27,26,2),(28,27,2),(30,28,2),(33,29,2),(34,29,3),(35,33,1),(37,34,3);
/*!40000 ALTER TABLE `destinatario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtipodocumento` int(11) DEFAULT NULL,
  `idformato` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `host` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechahora` datetime DEFAULT NULL,
  `lugar` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecharegistro` datetime DEFAULT NULL,
  `cite` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referencia` longtext COLLATE utf8_unicode_ci,
  `tenor` longtext COLLATE utf8_unicode_ci,
  `nroanexos` int(11) DEFAULT NULL,
  `anexos` longtext COLLATE utf8_unicode_ci,
  `nrofolios` int(11) DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_doc_tipodoc` (`idtipodocumento`),
  KEY `fk_doc_format` (`idformato`),
  KEY `fk_doc_user` (`idusuario`),
  CONSTRAINT `fk_doc_format` FOREIGN KEY (`idformato`) REFERENCES `formato` (`id`),
  CONSTRAINT `fk_doc_tipodoc` FOREIGN KEY (`idtipodocumento`) REFERENCES `tipodocumento` (`id`),
  CONSTRAINT `fk_doc_user` FOREIGN KEY (`idusuario`) REFERENCES `actividadusuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` VALUES (1,1,1,1,'local','2015-08-04 00:00:00','SC','2015-04-14 08:10:21','INIAF-20','Favor responder a la nota enviada','<p><strong>EStimados selres</strong></p>\r\n<p>&nbsp;</p>\r\n<p>afasdfasdfasdf</p>',1,'muchos anexos',1,'1'),(5,1,1,1,'localhost','2015-01-04 00:00:00','LP','2015-04-16 14:04:21','adfasd','asdfasdf','<p>asdf sda fasdf</p>',1,'anexos',0,'1'),(6,1,1,1,'localhost','2015-01-04 00:00:00','LP','2015-04-16 14:04:13','asdf','asdf','<p>asdf as fasd</p>',2,'anexos',0,'1'),(9,1,1,1,'localhost','2015-01-04 00:00:00','LP','2015-04-16 14:04:49','asdf','asdf','<p>asdf as fasd</p>',2,'anexos',0,'1'),(12,1,1,1,'localhost','2015-01-04 00:00:00','LP','2015-04-16 14:04:25','asdfas','sdfasdf','<p>asdfasd</p>',2,'anexos',0,'1'),(13,1,1,1,'localhost','2015-01-04 00:00:00','LP','2015-04-16 14:04:51','adfa sdfasd fasdf','asdfasd fasd fasdf','<p>sdfasd fasdfa sdfasdf asdfasd</p>',2,'anexos',0,'1'),(14,1,1,1,'localhost','2015-06-04 00:00:00','LP','2015-04-16 14:04:27','asd fasdfasdf','asdf asdfasdf','<p>asdf asdfasd fasdf asdfasd</p>',3,'anexos',0,'1'),(15,1,1,1,'localhost','2015-06-04 00:00:00','LP','2015-04-16 14:04:07','weqrw qweq r','asdfa asfasdfa sd fasdf','<p>asdf asdf asdf asdfa sf</p>',2,'asdf asdasdf',1,'1'),(16,1,1,1,'localhost','0000-00-00 00:00:00','LP','2015-04-16 20:04:09','wilmer','la paz','<p>Wilmer</p>',10,'cd libro y otros',1,'1'),(17,1,1,1,'localhost','2015-06-04 00:00:00','LP','2015-04-17 00:04:11','asfasdf','asdf sdaf asdf asdf asd fasdf asdf asdfasdf asdfasdfasdf asdfasd fasdfasdfasdf asdfa sdfasd fasdfa sdfasd fasdf','<p>asdf asd fasd fasdfa sdf</p>',3,'asdf asd fasdf',1,'1'),(18,1,1,1,'localhost','2015-07-04 00:00:00','LP','2015-04-17 00:04:55','asdfasd','asdfasdf ','<p>asdfas asd</p>',2,'asdf asd fasd',1,'1'),(22,1,1,1,'localhost','2015-02-04 00:00:00','SC','2015-04-20 12:04:10','<sd<s','adfasd','<p>asdfasd</p>',2,'asdfasdf',1,'1'),(25,1,1,1,'localhost','2015-02-04 00:00:00','SC','2015-04-21 15:04:13','INIAF-DGE-UPS-1','asdf asafsda f','<p>asdfa dfasd fasdf</p>',2,'asdf sdfasd f',1,'1'),(26,1,1,1,'localhost','2015-01-04 00:00:00','SC','2015-04-23 22:04:33','INIAF-DGE-UPS-1','asdfasdf','<p>asdfasdf</p>',1,'asdf adf',1,'1'),(27,1,1,1,'localhost','2015-01-04 00:00:00','OR','2015-04-23 22:04:57','INIAF-DGE-UPS-1','asdasdfsdf','<p>asdf asdf asdf asdf asdf</p>',1,'asdfa df',1,'1'),(28,2,2,1,'localhost','2015-01-04 00:00:00','LP','2015-04-23 23:04:39','INIAF-DGE-UPS-2','wilmer','<p>Wilmer Wilmer Wilmer Wilmer Wilmer Wilmer </p>',2,'Wilmer',1,'1'),(29,2,2,1,'localhost','2015-03-04 00:00:00','CH','2015-04-23 23:04:09','INIAF-DGE-UPS-3','Informes en avance','<p>Licenciado:</p>\r\n<p>Mediante la presente quiero depositar en su constancia respecto a los fondos en avance a la fecha.</p>\r\n<p>Comunicarle que en todos los tramos vencidos, se lleg&oacute; a controlar todo movimiento establecido en diferentes secciones y eventos realizados seg&uacute;n el programa de gobierno.</p>\r\n<p>Si m&aacute;s que decirle me despido</p>',1,'Fotocopia de Listas, ',1,'1'),(30,4,3,1,'localhost','2015-03-04 00:00:00','','2015-04-23 23:04:09','INIAF-DGE-UPS-4','Comunicado a todo el personal','<p>Se comunica a todo el personal que el d&iacute;a 21 de Febreo el horario de trabajo es continu, favor tomar de su consideraci&oacute;n</p>\r\n<p style=\"text-align: right;\"><em>asdfasdf</em></p>\r\n<p style=\"text-align: right;\"><em>asd</em></p>\r\n<p>f a</p>\r\n<p><strong>sd</strong></p>',0,'',0,'1'),(31,2,2,1,'localhost','2015-04-23 00:00:00','','2015-04-24 10:04:14','INIAF-DGE-UPS-5','Inclusión de un nuevo Reglamento y su aplicación a partir del 02 de Mayo','<p>A todo el personal:</p>\r\n<p>Mediante el decreso ministeria nro MDRYT-DESP-003, se instruye a todas la unidades concentradas y desconcentradas modificar el reglamento y aplicaci&oacute;n</p>',0,'',0,'1'),(32,4,4,1,'localhost','2015-04-11 00:00:00','','2015-04-24 10:04:21','INIAF-DGE-UPS-6','Segunda prueba','<p>asdfasdf asd adf asd fadf adfa sdfasdf asd fad</p>',0,'',0,'1'),(33,1,1,1,'localhost','2015-04-03 00:00:00','TA','2015-04-24 10:04:57','INIAF-DGE-UPS-7','s asdfas df','<p>asdfa sdfas fasfasdf</p>',0,'',0,'1'),(34,5,5,1,'localhost','2015-04-08 00:00:00','PO','2015-04-24 10:04:23','INIAF-DGE-UPS-8','Proceso Administrativo','<p>asdfa sdaf</p>',0,'',0,'1'),(35,3,3,1,'localhost','2015-04-16 00:00:00','','2015-04-24 18:04:17','INIAF-DGE-UPS-9','COMUNICADO URGENTE AL PERSONAL','<p>SE COMUNICA TODO EL PERSON QUE LAS ACTIVIDADES DEL D&Iacute;A DE HOY SE SUSPENDEN POR LAS MARCHAS REALIZADAS POR LOS MIGRANTES EN NUESTRA INSTITUCI&Oacute;N.</p>\r\n<p>ATENTAMENTE.</p>',0,'',0,'1');
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estructura`
--

DROP TABLE IF EXISTS `estructura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estructura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idforaneo` int(11) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `idestructura` int(11) DEFAULT NULL,
  `descripcion` text,
  `acronimo` varchar(25) DEFAULT NULL,
  `fregistro` date DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_est_dependiente` (`idestructura`),
  KEY `idforaneo` (`idforaneo`),
  CONSTRAINT `fk_est_dependiente` FOREIGN KEY (`idestructura`) REFERENCES `estructura` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estructura`
--

LOCK TABLES `estructura` WRITE;
/*!40000 ALTER TABLE `estructura` DISABLE KEYS */;
INSERT INTO `estructura` VALUES (1,1,'Direccion General Ejecutivo',NULL,NULL,'DGE','2015-03-14',1),(2,2,'Unidad de Planificación y Sistemas',1,NULL,'UPS','2015-03-14',1),(3,3,'Auditoría Interna',1,NULL,'AI','2015-03-14',1),(4,4,'Unidad de comunicación',1,NULL,'UC','2015-03-14',1),(5,5,'Asesoría Legal',1,NULL,'AL','2015-03-14',1),(6,6,'Unidad de Relacionamiento Institucional',1,NULL,'URI','2015-03-14',1),(7,7,'Dirección Nacional de innovación e Investigación',1,NULL,'DNII','2015-03-14',1),(8,8,'Unidad de Recursos Genéticos',7,NULL,'URG','2015-03-14',1),(9,9,'Unidad de Investigación',7,NULL,'UI','2015-03-14',1),(10,10,'Dirección de Asistencia Técnica e Información',1,NULL,'DATI','2015-03-14',1),(11,11,'Unidad de Asistencia Tecnica',10,NULL,'UAT','2015-03-14',1),(12,12,'Unidad de Capacitación y Formación',10,NULL,'UCF','2015-03-14',1),(13,13,'Unidad de Información y Sistematización',10,NULL,'UIS','2015-03-14',1),(14,14,'Administración Departamental',1,NULL,'AD','2015-03-14',1),(15,15,'Administración Regional',14,NULL,'AR','2015-03-14',1),(16,16,'Dirección Nacional de Semillas',1,NULL,'DNS','2015-03-14',1),(17,17,'Unidad de Certificación y Control',16,NULL,'UCC','2015-03-14',1),(18,18,'Unidad de Fiscalización y Registros',16,NULL,'UFR','2015-03-14',1),(19,19,'Dirección Administrativa Financiera',1,NULL,'DAF','2015-03-14',1),(20,20,'Unidad Administrativa',19,NULL,'UA','2015-03-14',1),(21,21,'Unidad Financiera',19,NULL,'UF','2015-03-14',1);
/*!40000 ALTER TABLE `estructura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formato`
--

DROP TABLE IF EXISTS `formato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtipodocumento` int(11) DEFAULT NULL,
  `fondo` varchar(200) DEFAULT NULL,
  `cabecera` varchar(200) DEFAULT NULL,
  `piepagina` varchar(200) DEFAULT NULL,
  `papeltamano` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_formato_tipodoc` (`idtipodocumento`),
  CONSTRAINT `fk_formato_tipodoc` FOREIGN KEY (`idtipodocumento`) REFERENCES `tipodocumento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formato`
--

LOCK TABLES `formato` WRITE;
/*!40000 ALTER TABLE `formato` DISABLE KEYS */;
INSERT INTO `formato` VALUES (1,1,NULL,NULL,NULL,NULL),(2,2,NULL,NULL,NULL,NULL),(3,3,NULL,NULL,NULL,NULL),(4,4,NULL,NULL,NULL,NULL),(5,5,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `formato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instruccion`
--

DROP TABLE IF EXISTS `instruccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instruccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instruccion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instruccion`
--

LOCK TABLES `instruccion` WRITE;
/*!40000 ALTER TABLE `instruccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `instruccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lugar`
--

DROP TABLE IF EXISTS `lugar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lugar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lugar` varchar(200) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lugar`
--

LOCK TABLES `lugar` WRITE;
/*!40000 ALTER TABLE `lugar` DISABLE KEYS */;
INSERT INTO `lugar` VALUES (1,'La Paz',1);
/*!40000 ALTER TABLE `lugar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parametros`
--

DROP TABLE IF EXISTS `parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `gestion` int(4) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `idestructura` int(11) DEFAULT NULL,
  `acronimo` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_par_estruc` (`idestructura`),
  CONSTRAINT `fk_par_estruc` FOREIGN KEY (`idestructura`) REFERENCES `estructura` (`idforaneo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametros`
--

LOCK TABLES `parametros` WRITE;
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
INSERT INTO `parametros` VALUES (1,'INSTITUTO NACIONAL DE INNOVACIÓN AGROPECUARIA Y FORESTAL',NULL,2015,1,NULL,'INIAF');
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idrol` int(11) DEFAULT NULL,
  `idrecurso` int(11) DEFAULT NULL,
  `fregistro` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rol` (`idrol`),
  KEY `fk_recurso` (`idrecurso`),
  CONSTRAINT `fk_recurso` FOREIGN KEY (`idrecurso`) REFERENCES `recurso` (`id`),
  CONSTRAINT `fk_rol` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prueba`
--

DROP TABLE IF EXISTS `prueba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prueba` (
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prueba`
--

LOCK TABLES `prueba` WRITE;
/*!40000 ALTER TABLE `prueba` DISABLE KEYS */;
INSERT INTO `prueba` VALUES ('2015-01-01 15:44:44'),('2015-01-01 00:00:00');
/*!40000 ALTER TABLE `prueba` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurso`
--

DROP TABLE IF EXISTS `recurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controlador` varchar(25) DEFAULT NULL,
  `accion` varchar(25) DEFAULT NULL,
  `etiqueta` varchar(60) DEFAULT NULL,
  `idrecurso` int(11) DEFAULT NULL,
  `orden` int(2) DEFAULT '0',
  `fregistro` date DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurso`
--

LOCK TABLES `recurso` WRITE;
/*!40000 ALTER TABLE `recurso` DISABLE KEYS */;
INSERT INTO `recurso` VALUES (1,'index',NULL,'Wilmer',0,0,'2015-03-15','index.php'),(2,'admin',NULL,'Administración',0,0,'2015-03-15','·#'),(3,'cargos','index','Cargos',2,0,'2015-03-15',NULL),(4,'usuarios','index','Usuarios',2,0,'2015-03-15',NULL),(5,'documentos','index','Documentos',0,0,NULL,NULL),(6,'logout','index','Salir',0,20,'2015-04-09',''),(7,'bandejas','index','Bandejas',5,0,'2015-04-13',NULL),(8,'cite','index','Cites',2,0,'2015-04-18',NULL),(9,'lugar','index','Lugar',2,0,NULL,NULL);
/*!40000 ALTER TABLE `recurso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remitente`
--

DROP TABLE IF EXISTS `remitente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remitente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddocumento` int(11) DEFAULT NULL,
  `idactividadusuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_remit_usua` (`idactividadusuario`),
  KEY `fk_remit_doc` (`iddocumento`),
  CONSTRAINT `fk_remit_doc` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`id`),
  CONSTRAINT `fk_remit_usua` FOREIGN KEY (`idactividadusuario`) REFERENCES `actividadusuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remitente`
--

LOCK TABLES `remitente` WRITE;
/*!40000 ALTER TABLE `remitente` DISABLE KEYS */;
INSERT INTO `remitente` VALUES (2,12,1),(3,12,2),(4,13,1),(5,14,1),(6,15,1),(19,1,1),(20,22,1),(21,25,1),(22,26,1),(23,27,1),(25,28,1),(27,29,1),(31,30,3),(32,31,1),(34,32,1),(35,33,2),(37,34,2),(38,35,2);
/*!40000 ALTER TABLE `remitente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(32) DEFAULT NULL,
  `descripcion` text,
  `fregistro` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguimiento`
--

DROP TABLE IF EXISTS `seguimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddestino` int(11) DEFAULT NULL,
  `iddocumento` int(11) DEFAULT NULL,
  `idinstruccion` int(11) DEFAULT NULL,
  `idremitenteext` int(11) DEFAULT NULL,
  `idremitenteint` int(11) DEFAULT NULL,
  `fechaingreso` datetime DEFAULT NULL,
  `fecharecibida` datetime DEFAULT NULL,
  `fechaderiva` datetime DEFAULT NULL,
  `plazo` datetime DEFAULT NULL,
  `estadoseguim` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` longtext COLLATE utf8_unicode_ci,
  `prioridad` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estadoregistro` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_seg_destino` (`iddestino`),
  KEY `fk_seg_doc` (`iddocumento`),
  KEY `fk_seg_remitint` (`idremitenteint`),
  KEY `fk_seg_user` (`idusuario`),
  KEY `fk_seg_instruccion` (`idinstruccion`),
  CONSTRAINT `fk_seg_destino` FOREIGN KEY (`iddestino`) REFERENCES `destinatario` (`id`),
  CONSTRAINT `fk_seg_doc` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`id`),
  CONSTRAINT `fk_seg_instruccion` FOREIGN KEY (`idinstruccion`) REFERENCES `instruccion` (`id`),
  CONSTRAINT `fk_seg_remitint` FOREIGN KEY (`idremitenteint`) REFERENCES `remitente` (`id`),
  CONSTRAINT `fk_seg_user` FOREIGN KEY (`idusuario`) REFERENCES `actividadusuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguimiento`
--

LOCK TABLES `seguimiento` WRITE;
/*!40000 ALTER TABLE `seguimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `seguimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipodocumento`
--

DROP TABLE IF EXISTS `tipodocumento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipodocumento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipodocumento`
--

LOCK TABLES `tipodocumento` WRITE;
/*!40000 ALTER TABLE `tipodocumento` DISABLE KEYS */;
INSERT INTO `tipodocumento` VALUES (1,'Carta'),(2,'Informe'),(3,'Comunicado'),(4,'Circular'),(5,'Memorandum');
/*!40000 ALTER TABLE `tipodocumento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria',
  `nombres` varchar(32) DEFAULT NULL COMMENT 'Nombre completo del usuario',
  `apellidos` varchar(32) DEFAULT NULL COMMENT 'Apellido Paterno del Usuario',
  `fnacimiento` date DEFAULT NULL,
  `ci` varchar(10) DEFAULT NULL,
  `extension` varchar(3) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `fregistro` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'wilmer','Hilaquita Soto','2015-02-02','4986005','LP',1,'2015-03-11'),(2,'Maya','Apaza','2014-12-12','234234','SC',1,'2015-03-12'),(3,'Paul Underwood',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-24 19:10:57
