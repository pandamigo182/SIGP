-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sigp_db
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `accion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (1,21,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 15:11:56'),(2,NULL,'LOGIN_FAILED_CSRF','Intento de login con token CSRF inválido. Email: student1@test.com','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 15:20:58'),(3,21,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 15:52:02'),(4,41,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 15:56:31'),(5,21,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 15:57:11'),(6,61,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 15:59:40'),(7,NULL,'LOGIN_FAILED_USER','Usuario no encontrado: admin@test.com','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 16:00:12'),(8,NULL,'LOGIN_FAILED_USER','Usuario no encontrado: admin@admin.com','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 16:00:29'),(9,22,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 16:04:06'),(10,NULL,'LOGIN_FAILED_USER','Usuario no encontrado: empresa1@test.com','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 16:06:01'),(11,42,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 16:09:56'),(12,61,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 16:11:49'),(13,41,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 16:15:12'),(14,16,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 16:19:07'),(15,83,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 16:49:15'),(16,63,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 22:26:09'),(17,NULL,'LOGIN_FAILED_USER','Usuario no encontrado: rrhh@empresa1.com.sv','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 22:27:35'),(18,83,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-17 22:28:35'),(19,63,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-18 08:16:13'),(20,83,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-18 08:18:42'),(21,64,'LOGIN_SUCCESS','Inicio de sesión exitoso.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-18 08:20:16'),(22,14,'LOGIN_SUCCESS','Inicio de sesión exitoso.','192.168.0.117','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-18 13:22:16'),(23,14,'Actualización','Se actualizó la configuración del sistema.','192.168.0.117','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-18 15:00:33');
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carreras`
--

DROP TABLE IF EXISTS `carreras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carreras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carreras`
--

LOCK TABLES `carreras` WRITE;
/*!40000 ALTER TABLE `carreras` DISABLE KEYS */;
INSERT INTO `carreras` VALUES (1,'Ingeniería en Sistemas','SIS-001','Desarrollo de Software y Redes','2025-12-09 15:21:49'),(2,'Licenciatura en Administración','ADM-002','Gestión de Empresas','2025-12-09 15:21:49'),(3,'Diseño Gráfico','DIS-003','Comunicación Visual','2025-12-09 15:21:49'),(4,'Ingeniería Industrial','IND-004','Procesos de Manufactura','2025-12-09 15:21:49');
/*!40000 ALTER TABLE `carreras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificados`
--

DROP TABLE IF EXISTS `certificados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certificados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `archivo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `certificados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificados`
--

LOCK TABLES `certificados` WRITE;
/*!40000 ALTER TABLE `certificados` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificados_plantillas`
--

DROP TABLE IF EXISTS `certificados_plantillas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certificados_plantillas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `archivo_fondo` varchar(255) NOT NULL,
  `tipo` varchar(50) DEFAULT 'general',
  `activo` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificados_plantillas`
--

LOCK TABLES `certificados_plantillas` WRITE;
/*!40000 ALTER TABLE `certificados_plantillas` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificados_plantillas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_sistema` varchar(255) NOT NULL DEFAULT 'SIGP',
  `nombre_empresa` varchar(255) NOT NULL DEFAULT 'SIGP Corp',
  `direccion` text,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT 'logo_default.png',
  `favicon_path` varchar(255) DEFAULT 'favicon_default.ico',
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email_alertas` varchar(255) DEFAULT '',
  `email_smtp_host` varchar(255) DEFAULT '',
  `email_smtp_user` varchar(255) DEFAULT '',
  `email_smtp_pass` varchar(255) DEFAULT '',
  `email_smtp_port` int DEFAULT '587',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'SIGP - Sistema Integral de Gestión de Pasantías','SIGP Solutions','San Salvador, El Salvador','contacto@sigp.sv','+503 2222-0000','50370000000','logo_1766091333.svg','favicon_default.ico','','','','','2025-12-18 20:55:33','','','','',587);
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `id_departamento` int NOT NULL,
  `codigo_departamento` varchar(10) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `estado` int DEFAULT '1',
  PRIMARY KEY (`id_departamento`),
  KEY `codigo_departamento` (`codigo_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'01','AHUACHAPAN',1),(2,'02','SANTA ANA',1),(3,'03','SONSONATE',1),(4,'04','CHALATENANGO',1),(5,'05','LA LIBERTAD',1),(6,'06','SAN SALVADOR',1),(7,'07','CUSCATLAN',1),(8,'08','LA PAZ',1),(9,'09','CABANAS',1),(10,'10','SAN VICENTE',1),(11,'11','USULUTAN',1),(12,'12','SAN MIGUEL',1),(13,'13','MORAZAN',1),(14,'14','LA UNION',1);
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distritos`
--

DROP TABLE IF EXISTS `distritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distritos` (
  `id_distrito` int NOT NULL,
  `codigo_municipio` varchar(10) DEFAULT NULL,
  `codigo_distrito` varchar(10) DEFAULT NULL,
  `distrito` varchar(100) DEFAULT NULL,
  `estado` int DEFAULT '1',
  PRIMARY KEY (`id_distrito`),
  KEY `codigo_municipio` (`codigo_municipio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distritos`
--

LOCK TABLES `distritos` WRITE;
/*!40000 ALTER TABLE `distritos` DISABLE KEYS */;
INSERT INTO `distritos` VALUES (1,'1301','001','ATIQUIZAYA',1),(2,'1301','002','EL REFUGIO',1),(3,'1301','003','SAN LORENZO',1),(4,'1301','004','TURÍN',1),(5,'1401','005','AHUACHAPÁN',1),(6,'1401','006','APANECA',1),(7,'1401','007','CONCEPCIÓN DE ATACO',1),(8,'1401','008','TACUBA',1),(9,'1501','009','GUAYMANGO',1),(10,'1501','010','JUJUTLA',1),(11,'1501','011','SAN FRANCISCO MENÉNDEZ',1),(12,'1501','012','SAN PEDRO PUXTLA',1),(13,'2006','013','AGUILARES',1),(14,'2006','014','EL PAISNAL',1),(15,'2006','015','GUAZAPA',1),(16,'2106','016','APOPA',1),(17,'2106','017','NEJAPA',1),(18,'2206','018','ILOPANGO',1),(19,'2206','019','SAN MARTÍN',1),(20,'2206','020','SOYAPANGO',1),(21,'2206','021','TONACATEPEQUE',1),(22,'2306','022','AYUTUXTEPEQUE',1),(23,'2306','023','MEJICANOS',1),(24,'2306','024','SAN SALVADOR',1),(25,'2306','025','CUSCATANCINGO',1),(26,'2306','026','CIUDAD DELGADO',1),(27,'2406','027','PANCHIMALCO',1),(28,'2406','028','ROSARIO DE MORA',1),(29,'2406','029','SAN MARCOS',1),(30,'2406','030','SANTO TOMÁS',1),(31,'2406','031','SANTIAGO TEXACUANGOS',1),(32,'2305','032','QUEZALTEPEQUE',1),(33,'2305','033','SAN MATÍAS',1),(34,'2305','034','SAN PABLO TACACHICO',1),(35,'2405','035','SAN JUAN OPICO',1),(36,'2405','036','CIUDAD ARCE',1),(37,'2505','037','COLÓN',1),(38,'2505','038','JAYAQUE',1),(39,'2505','039','SACACOYO',1),(40,'2505','040','TEPECOYO',1),(41,'2505','041','TALNIQUE',1),(42,'2605','042','ANTIGUO CUSCATLÁN',1),(43,'2605','043','HUIZÚCAR',1),(44,'2605','044','NUEVO CUSCATLÁN',1),(45,'2605','045','SAN JOSÉ VILLANUEVA',1),(46,'2605','046','ZARAGOZA',1),(47,'2705','047','CHILTIUPÁN',1),(48,'2705','048','JICALAPA',1),(49,'2705','049','LA LIBERTAD',1),(50,'2705','050','TAMANIQUE',1),(51,'2705','051','TEOTEPEQUE',1),(52,'2805','052','COMASAGUA',1),(53,'2805','053','SANTA TECLA',1),(54,'3404','054','LA PALMA',1),(55,'3404','055','CITALÁ',1),(56,'3404','056','SAN IGNACIO',1),(57,'3504','057','NUEVA CONCEPCIÓN',1),(58,'3504','058','TEJUTLA',1),(59,'3504','059','LA REINA',1),(60,'3504','060','AGUA CALIENTE',1),(61,'3504','061','DULCE NOMBRE DE MARÍA',1),(62,'3504','062','EL PARAÍSO',1),(63,'3504','063','SAN FERNANDO',1),(64,'3504','064','SAN FRANCISCO MORAZÁN',1),(65,'3504','065','SAN RAFAEL',1),(66,'3504','066','SANTA RITA',1),(67,'3604','067','CHALATENANGO',1),(68,'3604','068','ARCATAO',1),(69,'3604','069','AZACUALPA',1),(70,'3604','070','COMALAPA',1),(71,'3604','071','CONCEPCIÓN QUEZALTEPEQUE',1),(72,'3604','072','EL CARRIZAL',1),(73,'3604','073','LA LAGUNA',1),(74,'3604','074','LAS VUELTAS',1),(75,'3604','075','NOMBRE DE JESÚS',1),(76,'3604','076','NUEVA TRINIDAD',1),(77,'3604','077','OJOS DE AGUA',1),(78,'3604','078','POTONICO',1),(79,'3604','079','SAN ANTONIO DE LA CRUZ',1),(80,'3604','080','SAN ANTONIO LOS RANCHOS',1),(81,'3604','081','SAN FRANCISCO LEMPA',1),(82,'3604','082','SAN ISIDRO LABRADOR',1),(83,'3604','083','SAN JOSÉ CANCASQUE',1),(84,'3604','084','SAN MIGUEL DE MERCEDES',1),(85,'3604','085','SAN JOSÉ LAS FLORES',1),(86,'3604','086','SAN LUIS DEL CARMEN',1),(87,'1707','087','SUCHITOTO',1),(88,'1707','088','SAN JOSÉ GUAYABAL',1),(89,'1707','089','ORATORIO DE CONCEPCIÓN',1),(90,'1707','090','SAN BARTOLOMÉ PERULAPÍA',1),(91,'1707','091','SAN PEDRO PERULAPÁN',1),(92,'1807','092','COJUTEPEQUE',1),(93,'1807','093','SAN RAFAEL CEDROS',1),(94,'1807','094','CANDELARIA',1),(95,'1807','095','MONTE SAN JUAN',1),(96,'1807','096','EL CARMEN',1),(97,'1807','097','SAN CRISTOBAL',1),(98,'1807','098','SANTA CRUZ MICHAPA',1),(99,'1807','099','SAN RAMÓN',1),(100,'1807','100','EL ROSARIO',1),(101,'1807','101','SANTA CRUZ ANALQUITO',1),(102,'1807','102','TENANCINGO',1),(103,'1109','103','SENSUNTEPEQUE',1),(104,'1109','104','VICTORIA',1),(105,'1109','105','DOLORES',1),(106,'1109','106','GUACOTECTI',1),(107,'1109','107','SAN ISIDRO',1),(108,'1009','108','ILOBASCO',1),(109,'1009','109','TEJUTEPEQUE',1),(110,'1009','110','JUTIAPA',1),(111,'1009','111','CINQUERA',1),(112,'2308','112','CUYULTITAN',1),(113,'2308','113','OLOCUILTA',1),(114,'2308','114','SAN JUAN TALPA',1),(115,'2308','115','SAN LUIS TALPA',1),(116,'2308','116','SAN PEDRO MASAHUAT',1),(117,'2308','117','TAPALHUACA',1),(118,'2308','118','SAN FRANCISCO CHINAMECA',1),(119,'2408','119','EL ROSARIO',1),(120,'2408','120','JERUSALÉN',1),(121,'2408','121','MERCEDES LA CEIBA',1),(122,'2408','122','PARAÍSO DE OSORIO',1),(123,'2408','123','SAN ANTONIO MASAHUAT',1),(124,'2408','124','SAN EMIGDIO',1),(125,'2408','125','SAN JUAN TEPEZONTES',1),(126,'2408','126','SAN LUÍS LA HERRADURA',1),(127,'2408','127','SAN MIGUEL TEPEZONTES',1),(128,'2408','128','SAN PEDRO NONUALCO',1),(129,'2408','129','SANTA MARÍA OSTUMA',1),(130,'2408','130','SANTIAGO NONUALCO',1),(131,'2508','131','SAN JUAN NONUALCO',1),(132,'2508','132','SAN RAFAEL OBRAJUELO',1),(133,'2508','133','ZACATECOLUCA',1),(134,'1914','134','ANAMORÓS',1),(135,'1914','135','BOLIVAR',1),(136,'1914','136','CONCEPCIÓN DE ORIENTE',1),(137,'1914','137','EL SAUCE',1),(138,'1914','138','LISLIQUE',1),(139,'1914','139','NUEVA ESPARTA',1),(140,'1914','140','PASAQUINA',1),(141,'1914','141','POLORÓS',1),(142,'1914','142','SAN JOSÉ LA FUENTE',1),(143,'1914','143','SANTA ROSA DE LIMA',1),(144,'2014','144','CONCHAGUA',1),(145,'2014','145','EL CARMEN',1),(146,'2014','146','INTIPUCÁ',1),(147,'2014','147','LA UNIÓN',1),(148,'2014','148','MEANGUERA DEL GOLFO',1),(149,'2014','149','SAN ALEJO',1),(150,'2014','150','YAYANTIQUE',1),(151,'2014','151','YUCUAIQUÍN',1),(152,'2411','152','SANTIAGO DE MARÍA',1),(153,'2411','153','ALEGRÍA',1),(154,'2411','154','BERLÍN',1),(155,'2411','155','MERCEDES UMAÑA',1),(156,'2411','156','JUCUAPA',1),(157,'2411','157','EL TRIUNFO',1),(158,'2411','158','ESTANZUELAS',1),(159,'2411','159','SAN BUENAVENTURA',1),(160,'2411','160','NUEVA GRANADA',1),(161,'2511','161','USULUTÁN',1),(162,'2511','162','JUCUARÁN',1),(163,'2511','163','SAN DIONISIO',1),(164,'2511','164','CONCEPCIÓN BATRES',1),(165,'2511','165','SANTA MARÍA',1),(166,'2511','166','OZATLÁN',1),(167,'2511','167','TECAPÁN',1),(168,'2511','168','SANTA ELENA',1),(169,'2511','169','CALIFORNIA',1),(170,'2511','170','EREGUAYQUÍN',1),(171,'2611','171','JIQUILISCO',1),(172,'2611','172','PUERTO EL TRIUNFO',1),(173,'2611','173','SAN AGUSTÍN',1),(174,'2611','174','SAN FRANCISCO JAVIER',1),(175,'1703','175','JUAYUA',1),(176,'1703','176','NAHUIZALCO',1),(177,'1703','177','SALCOATITÁN',1),(178,'1703','178','SANTA CATARINA MASAHUAT',1),(179,'1803','179','SONSONATE',1),(180,'1803','180','SONZACATE',1),(181,'1803','181','NAHULINGO',1),(182,'1803','182','SAN ANTONIO DEL MONTE',1),(183,'1803','183','SANTO DOMINGO DE GUZMÁN',1),(184,'1903','184','IZALCO',1),(185,'1903','185','ARMENIA',1),(186,'1903','186','CALUCO',1),(187,'1903','187','SAN JULIÁN',1),(188,'1903','188','CUISNAHUAT',1),(189,'1903','189','SANTA ISABEL ISHUATÁN',1),(190,'2003','190','ACAJUTLA',1),(191,'1402','191','MASAHUAT',1),(192,'1402','192','METAPÁN',1),(193,'1402','193','SANTA ROSA GUACHIPILÍN',1),(194,'1402','194','TEXISTEPEQUE',1),(195,'1502','195','SANTA ANA',1),(196,'1602','196','COATEPEQUE',1),(197,'1602','197','EL CONGO',1),(198,'1702','198','CANDELARIA DE LA FRONTERA',1),(199,'1702','199','CHALCHUAPA',1),(200,'1702','200','EL PORVENIR',1),(201,'1702','201','SAN ANTONIO PAJONAL',1),(202,'1702','202','SAN SEBASTIÁN SALITRILLO',1),(203,'1702','203','SANTIAGO DE LA FRONTERA',1),(204,'1410','204','APASTEPEQUE',1),(205,'1410','205','SANTA CLARA',1),(206,'1410','206','SAN ILDEFONSO',1),(207,'1410','207','SAN ESTEBAN CATARINA',1),(208,'1410','208','SAN SEBASTIÁN',1),(209,'1410','209','SAN LORENZO',1),(210,'1410','210','SANTO DOMINGO',1),(211,'1510','211','SAN VICENTE',1),(212,'1510','212','GUADALUPE',1),(213,'1510','213','VERAPAZ',1),(214,'1510','214','TEPETITÁN',1),(215,'1510','215','TECOLUCA',1),(216,'1510','216','SAN CAYETANO ISTEPEQUE',1),(217,'2112','217','CIUDAD BARRIOS',1),(218,'2112','218','SESORI',1),(219,'2112','219','NUEVO EDÉN DE SAN JUAN',1),(220,'2112','220','SAN GERARDO',1),(221,'2112','221','SAN LUIS DE LA REINA',1),(222,'2112','222','CAROLINA',1),(223,'2112','223','SAN ANTONIO DEL MOSCO',1),(224,'2112','224','CHAPELTIQUE',1),(225,'2212','225','SAN MIGUEL',1),(226,'2212','226','COMACARÁN',1),(227,'2212','227','ULUAZAPA',1),(228,'2212','228','MONCAGUA',1),(229,'2212','229','QUELEPA',1),(230,'2212','230','CHIRILAGUA',1),(231,'2312','231','CHINAMECA',1),(232,'2312','232','NUEVA GUADALUPE',1),(233,'2312','233','LOLOTIQUE',1),(234,'2312','234','SAN JORGE',1),(235,'2312','235','SAN RAFAEL ORIENTE',1),(236,'2312','236','EL TRÁNSITO',1),(237,'2713','237','ARAMBALA',1),(238,'2713','238','CACAOPERA',1),(239,'2713','239','CORINTO',1),(240,'2713','240','EL ROSARIO',1),(241,'2713','241','JOATECA',1),(242,'2713','242','JOCOAITIQUE',1),(243,'2713','243','MEANGUERA',1),(244,'2713','244','PERQUÍN',1),(245,'2713','245','SAN FERNANDO',1),(246,'2713','246','SAN ISIDRO',1),(247,'2713','247','TOROLA',1),(248,'2813','248','CHILANGA',1),(249,'2813','249','DELICIAS DE CONCEPCIÓN',1),(250,'2813','250','EL DIVISADERO',1),(251,'2813','251','GUALOCOCTI',1),(252,'2813','252','GUATAJIAGUA',1),(253,'2813','253','JOCORO',1),(254,'2813','254','LOLOTIQUILLO',1),(255,'2813','255','OSICALA',1),(256,'2813','256','SAN CARLOS',1),(257,'2813','257','SAN FRANCISCO GOTERA',1),(258,'2813','258','SAN SIMÓN',1),(259,'2813','259','SENSEMBRA',1),(260,'2813','260','SOCIEDAD',1),(261,'2813','261','YAMABAL',1),(262,'2813','262','YOLOAIQUÍN',1);
/*!40000 ALTER TABLE `distritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nit` varchar(20) DEFAULT NULL,
  `email_contacto` varchar(100) DEFAULT NULL,
  `representante_legal` varchar(150) DEFAULT NULL,
  `rubro` varchar(100) DEFAULT NULL,
  `departamento_id` int DEFAULT NULL,
  `municipio_id` int DEFAULT NULL,
  `distrito_id` int DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'Empresa 1 Solutions','Líderes en Educación','Direccion 1','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:30:59',NULL,'contact1@test.com',NULL,'Educación',1,1,1,NULL),(2,'Empresa 2 Solutions','Líderes en Construcción','Direccion 2','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:30:59',NULL,'contact2@test.com',NULL,'Educación',1,1,1,NULL),(3,'Empresa 3 Solutions','Líderes en Tecnología','Direccion 3','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact3@test.com',NULL,'Educación',1,1,1,NULL),(4,'Empresa 4 Solutions','Líderes en Salud','Direccion 4','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact4@test.com',NULL,'Finanzas',1,1,1,NULL),(5,'Empresa 5 Solutions','Líderes en Finanzas','Direccion 5','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact5@test.com',NULL,'Educación',1,1,1,NULL),(6,'Empresa 6 Solutions','Líderes en Construcción','Direccion 6','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact6@test.com',NULL,'Tecnología',1,1,1,NULL),(7,'Empresa 7 Solutions','Líderes en Salud','Direccion 7','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact7@test.com',NULL,'Salud',1,1,1,NULL),(8,'Empresa 8 Solutions','Líderes en Salud','Direccion 8','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact8@test.com',NULL,'Tecnología',1,1,1,NULL),(9,'Empresa 9 Solutions','Líderes en Salud','Direccion 9','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact9@test.com',NULL,'Educación',1,1,1,NULL),(10,'Empresa 10 Solutions','Líderes en Finanzas','Direccion 10','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact10@test.com',NULL,'Salud',1,1,1,NULL),(11,'Empresa 11 Solutions','Líderes en Educación','Direccion 11','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact11@test.com',NULL,'Salud',1,1,1,NULL),(12,'Empresa 12 Solutions','Líderes en Finanzas','Direccion 12','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact12@test.com',NULL,'Educación',1,1,1,NULL),(13,'Empresa 13 Solutions','Líderes en Tecnología','Direccion 13','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact13@test.com',NULL,'Construcción',1,1,1,NULL),(14,'Empresa 14 Solutions','Líderes en Finanzas','Direccion 14','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:00',NULL,'contact14@test.com',NULL,'Finanzas',1,1,1,NULL),(15,'Empresa 15 Solutions','Líderes en Finanzas','Direccion 15','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:01',NULL,'contact15@test.com',NULL,'Tecnología',1,1,1,NULL),(16,'Empresa 16 Solutions','Líderes en Finanzas','Direccion 16','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:01',NULL,'contact16@test.com',NULL,'Educación',1,1,1,NULL),(17,'Empresa 17 Solutions','Líderes en Finanzas','Direccion 17','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:01',NULL,'contact17@test.com',NULL,'Finanzas',1,1,1,NULL),(18,'Empresa 18 Solutions','Líderes en Salud','Direccion 18','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:01',NULL,'contact18@test.com',NULL,'Tecnología',1,1,1,NULL),(19,'Empresa 19 Solutions','Líderes en Finanzas','Direccion 19','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:01',NULL,'contact19@test.com',NULL,'Finanzas',1,1,1,NULL),(20,'Empresa 20 Solutions','Líderes en Construcción','Direccion 20','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:01',NULL,'contact20@test.com',NULL,'Salud',1,1,1,NULL),(21,'Empresa 1 Solutions','Líderes en Salud','Direccion 1','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact1@test.com',NULL,'Construcción',1,1,1,NULL),(22,'Empresa 2 Solutions','Líderes en Educación','Direccion 2','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact2@test.com',NULL,'Salud',1,1,1,NULL),(23,'Empresa 3 Solutions','Líderes en Tecnología','Direccion 3','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact3@test.com',NULL,'Tecnología',1,1,1,NULL),(24,'Empresa 4 Solutions','Líderes en Tecnología','Direccion 4','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact4@test.com',NULL,'Educación',1,1,1,NULL),(25,'Empresa 5 Solutions','Líderes en Tecnología','Direccion 5','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact5@test.com',NULL,'Educación',1,1,1,NULL),(26,'Empresa 6 Solutions','Líderes en Tecnología','Direccion 6','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact6@test.com',NULL,'Salud',1,1,1,NULL),(27,'Empresa 7 Solutions','Líderes en Tecnología','Direccion 7','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact7@test.com',NULL,'Salud',1,1,1,NULL),(28,'Empresa 8 Solutions','Líderes en Finanzas','Direccion 8','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact8@test.com',NULL,'Construcción',1,1,1,NULL),(29,'Empresa 9 Solutions','Líderes en Salud','Direccion 9','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact9@test.com',NULL,'Educación',1,1,1,NULL),(30,'Empresa 10 Solutions','Líderes en Tecnología','Direccion 10','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact10@test.com',NULL,'Finanzas',1,1,1,NULL),(31,'Empresa 11 Solutions','Líderes en Educación','Direccion 11','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact11@test.com',NULL,'Tecnología',1,1,1,NULL),(32,'Empresa 12 Solutions','Líderes en Construcción','Direccion 12','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact12@test.com',NULL,'Educación',1,1,1,NULL),(33,'Empresa 13 Solutions','Líderes en Finanzas','Direccion 13','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:42',NULL,'contact13@test.com',NULL,'Salud',1,1,1,NULL),(34,'Empresa 14 Solutions','Líderes en Construcción','Direccion 14','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:43',NULL,'contact14@test.com',NULL,'Salud',1,1,1,NULL),(35,'Empresa 15 Solutions','Líderes en Salud','Direccion 15','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:43',NULL,'contact15@test.com',NULL,'Tecnología',1,1,1,NULL),(36,'Empresa 16 Solutions','Líderes en Salud','Direccion 16','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:43',NULL,'contact16@test.com',NULL,'Salud',1,1,1,NULL),(37,'Empresa 17 Solutions','Líderes en Finanzas','Direccion 17','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:43',NULL,'contact17@test.com',NULL,'Finanzas',1,1,1,NULL),(38,'Empresa 18 Solutions','Líderes en Salud','Direccion 18','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:43',NULL,'contact18@test.com',NULL,'Tecnología',1,1,1,NULL),(39,'Empresa 19 Solutions','Líderes en Construcción','Direccion 19','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:43',NULL,'contact19@test.com',NULL,'Educación',1,1,1,NULL),(40,'Empresa 20 Solutions','Líderes en Educación','Direccion 20','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:31:43',NULL,'contact20@test.com',NULL,'Educación',1,1,1,NULL),(41,'Empresa 1 Solutions','Líderes en Tecnología','Direccion 1','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:02',NULL,'contact1@test.com',NULL,'Construcción',1,1,1,NULL),(42,'Empresa 2 Solutions','Líderes en Construcción','Direccion 2','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:02',NULL,'contact2@test.com',NULL,'Construcción',1,1,1,NULL),(43,'Empresa 3 Solutions','Líderes en Construcción','Direccion 3','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:02',NULL,'contact3@test.com',NULL,'Educación',1,1,1,NULL),(44,'Empresa 4 Solutions','Líderes en Tecnología','Direccion 4','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:02',NULL,'contact4@test.com',NULL,'Tecnología',1,1,1,NULL),(45,'Empresa 5 Solutions','Líderes en Educación','Direccion 5','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:02',NULL,'contact5@test.com',NULL,'Educación',1,1,1,NULL),(46,'Empresa 6 Solutions','Líderes en Finanzas','Direccion 6','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:02',NULL,'contact6@test.com',NULL,'Educación',1,1,1,NULL),(47,'Empresa 7 Solutions','Líderes en Educación','Direccion 7','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:02',NULL,'contact7@test.com',NULL,'Tecnología',1,1,1,NULL),(48,'Empresa 8 Solutions','Líderes en Salud','Direccion 8','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact8@test.com',NULL,'Salud',1,1,1,NULL),(49,'Empresa 9 Solutions','Líderes en Educación','Direccion 9','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact9@test.com',NULL,'Construcción',1,1,1,NULL),(50,'Empresa 10 Solutions','Líderes en Tecnología','Direccion 10','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact10@test.com',NULL,'Salud',1,1,1,NULL),(51,'Empresa 11 Solutions','Líderes en Salud','Direccion 11','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact11@test.com',NULL,'Tecnología',1,1,1,NULL),(52,'Empresa 12 Solutions','Líderes en Construcción','Direccion 12','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact12@test.com',NULL,'Finanzas',1,1,1,NULL),(53,'Empresa 13 Solutions','Líderes en Salud','Direccion 13','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact13@test.com',NULL,'Educación',1,1,1,NULL),(54,'Empresa 14 Solutions','Líderes en Educación','Direccion 14','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact14@test.com',NULL,'Finanzas',1,1,1,NULL),(55,'Empresa 15 Solutions','Líderes en Educación','Direccion 15','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact15@test.com',NULL,'Salud',1,1,1,NULL),(56,'Empresa 16 Solutions','Líderes en Construcción','Direccion 16','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact16@test.com',NULL,'Finanzas',1,1,1,NULL),(57,'Empresa 17 Solutions','Líderes en Educación','Direccion 17','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact17@test.com',NULL,'Construcción',1,1,1,NULL),(58,'Empresa 18 Solutions','Líderes en Educación','Direccion 18','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:03',NULL,'contact18@test.com',NULL,'Educación',1,1,1,NULL),(59,'Empresa 19 Solutions','Líderes en Construcción','Direccion 19','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:04',NULL,'contact19@test.com',NULL,'Educación',1,1,1,NULL),(60,'Empresa 20 Solutions','Líderes en Finanzas','Direccion 20','12345678',NULL,NULL,NULL,NULL,'2025-12-17 20:32:04',NULL,'contact20@test.com',NULL,'Construcción',1,1,1,NULL),(61,'Banco Agrícola','Empresa líder en el sector de Banca','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:58',NULL,'rrhh@bancoagricola.com.sv',NULL,'Banca',1,1,1,NULL),(62,'Tigo El Salvador','Empresa líder en el sector de Telecomunicaciones','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:58',NULL,'talent@tigo.com.sv',NULL,'Telecomunicaciones',2,1,1,NULL),(63,'Aeroman','Empresa líder en el sector de Industria','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:58',NULL,'info@aeroman.com.sv',NULL,'Industria',1,1,1,NULL),(64,'Siman','Empresa líder en el sector de Comercio','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:58',NULL,'reclutamiento@siman.com',NULL,'Comercio',2,1,1,NULL),(65,'ASIT S.A. de C.V.','Empresa líder en el sector de Tecnología','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:58',NULL,'info@asit.com.sv',NULL,'Tecnología',1,1,1,NULL),(66,'Universidad Don Bosco','Empresa líder en el sector de Educación','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:58',NULL,'rrhh@udb.edu.sv',NULL,'Educación',2,1,1,NULL),(67,'Hospital de Diagnóstico','Empresa líder en el sector de Salud','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:58',NULL,'rrhh@hdiagnostico.com.sv',NULL,'Salud',1,1,1,NULL),(68,'Holcim El Salvador','Empresa líder en el sector de Industria','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'info@holcim.com.sv',NULL,'Industria',2,1,1,NULL),(69,'Banco Cuscatlán','Empresa líder en el sector de Banca','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'talento@bancocuscatlan.com',NULL,'Banca',1,1,1,NULL),(70,'Claro El Salvador','Empresa líder en el sector de Telecomunicaciones','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'jobs@claro.com.sv',NULL,'Telecomunicaciones',2,1,1,NULL),(71,'Super Selectos','Empresa líder en el sector de Comercio','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'seleccion@superselectos.com.sv',NULL,'Comercio',1,1,1,NULL),(72,'Applaudo Studios','Empresa líder en el sector de Tecnología','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'careers@applaudo.com',NULL,'Tecnología',2,1,1,NULL),(73,'Telus International','Empresa líder en el sector de Tecnología','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'join@telus.com',NULL,'Tecnología',1,1,1,NULL),(74,'Industrias La Constancia','Empresa líder en el sector de Industria','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'info@laconstancia.com',NULL,'Industria',2,1,1,NULL),(75,'AES El Salvador','Empresa líder en el sector de Industria','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'info@aes.com.sv',NULL,'Industria',1,1,1,NULL),(76,'Grupo Q','Empresa líder en el sector de Comercio','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'rrhh@grupoq.com',NULL,'Comercio',2,1,1,NULL),(77,'Davivienda','Empresa líder en el sector de Banca','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'talento@davivienda.com.sv',NULL,'Banca',1,1,1,NULL),(78,'Unicomer','Empresa líder en el sector de Comercio','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:44:59',NULL,'jobs@unicomer.com',NULL,'Comercio',2,1,1,NULL),(79,'Avianca','Empresa líder en el sector de Industria','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:45:00',NULL,'people@avianca.com',NULL,'Industria',1,1,1,NULL),(80,'Teleperformance','Empresa líder en el sector de Tecnología','San Salvador, El Salvador','2222-2222',NULL,NULL,NULL,NULL,'2025-12-17 22:45:00',NULL,'careers@teleperformance.com',NULL,'Tecnología',2,1,1,NULL);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluaciones`
--

DROP TABLE IF EXISTS `evaluaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `estudiante_id` int NOT NULL,
  `pasantia_id` int DEFAULT NULL,
  `calificacion_general` decimal(4,2) NOT NULL,
  `responsabilidad` int DEFAULT NULL,
  `conocimientos` int DEFAULT NULL,
  `trabajo_equipo` int DEFAULT NULL,
  `comentarios` text,
  `fecha_evaluacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  KEY `estudiante_id` (`estudiante_id`),
  CONSTRAINT `fk_eval_emp` FOREIGN KEY (`empresa_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_eval_est` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluaciones`
--

LOCK TABLES `evaluaciones` WRITE;
/*!40000 ALTER TABLE `evaluaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluaciones_empresa`
--

DROP TABLE IF EXISTS `evaluaciones_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluaciones_empresa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pasantia_id` int NOT NULL,
  `empresa_id` int NOT NULL,
  `rating` int NOT NULL COMMENT '1-5 Stars',
  `comentarios` text,
  `competencias_evaluadas` json DEFAULT NULL COMMENT 'Store criteria scores',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pasantia_id` (`pasantia_id`),
  CONSTRAINT `evaluaciones_empresa_ibfk_1` FOREIGN KEY (`pasantia_id`) REFERENCES `pasantias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluaciones_empresa`
--

LOCK TABLES `evaluaciones_empresa` WRITE;
/*!40000 ALTER TABLE `evaluaciones_empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluaciones_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluaciones_estudiante`
--

DROP TABLE IF EXISTS `evaluaciones_estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluaciones_estudiante` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pasantia_id` int NOT NULL,
  `estudiante_id` int NOT NULL,
  `empresa_id` int NOT NULL,
  `rating` int NOT NULL,
  `comentarios` text,
  `anonimo` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pasantia_id` (`pasantia_id`),
  CONSTRAINT `evaluaciones_estudiante_ibfk_1` FOREIGN KEY (`pasantia_id`) REFERENCES `pasantias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluaciones_estudiante`
--

LOCK TABLES `evaluaciones_estudiante` WRITE;
/*!40000 ALTER TABLE `evaluaciones_estudiante` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluaciones_estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiencia_laboral`
--

DROP TABLE IF EXISTS `experiencia_laboral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiencia_laboral` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `experiencia_laboral_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiencia_laboral`
--

LOCK TABLES `experiencia_laboral` WRITE;
/*!40000 ALTER TABLE `experiencia_laboral` DISABLE KEYS */;
/*!40000 ALTER TABLE `experiencia_laboral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favoritos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `plaza_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_fav` (`user_id`,`plaza_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritos`
--

LOCK TABLES `favoritos` WRITE;
/*!40000 ALTER TABLE `favoritos` DISABLE KEYS */;
/*!40000 ALTER TABLE `favoritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habilidades`
--

DROP TABLE IF EXISTS `habilidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `habilidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habilidades`
--

LOCK TABLES `habilidades` WRITE;
/*!40000 ALTER TABLE `habilidades` DISABLE KEYS */;
INSERT INTO `habilidades` VALUES (1,'Liderazgo','Psicosocial'),(2,'Trabajo en Equipo','Psicosocial'),(3,'Comunicación Efectiva','Psicosocial'),(4,'Resolución de Problemas','Psicosocial'),(5,'Adaptabilidad','Psicosocial'),(6,'PHP','Tecnica'),(7,'JavaScript','Tecnica'),(8,'HTML/CSS','Tecnica'),(9,'SQL','Tecnica'),(10,'Python','Tecnica'),(11,'Java','Tecnica'),(12,'Gestión de Proyectos','Tecnica'),(13,'Marketing Digital','Tecnica'),(14,'Diseño Gráfico','Tecnica');
/*!40000 ALTER TABLE `habilidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instituciones`
--

DROP TABLE IF EXISTS `instituciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instituciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instituciones`
--

LOCK TABLES `instituciones` WRITE;
/*!40000 ALTER TABLE `instituciones` DISABLE KEYS */;
INSERT INTO `instituciones` VALUES (1,'Universidad Don Bosco',NULL,NULL,NULL,'2025-12-15 20:37:47');
/*!40000 ALTER TABLE `instituciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipios`
--

DROP TABLE IF EXISTS `municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipios` (
  `id_municipio` int NOT NULL,
  `codigo_mh_municipio` varchar(10) DEFAULT NULL,
  `codigo_municipio` varchar(10) DEFAULT NULL,
  `codigo_departamento` varchar(10) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `estado` int DEFAULT '1',
  PRIMARY KEY (`id_municipio`),
  KEY `codigo_departamento` (`codigo_departamento`),
  KEY `codigo_municipio` (`codigo_municipio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipios`
--

LOCK TABLES `municipios` WRITE;
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
INSERT INTO `municipios` VALUES (1,'00','0000','00','Otro (Para extranjeros)',0),(2,'13','1301','01','AHUACHAPÁN NORTE',1),(3,'14','1401','01','AHUACHAPÁN CENTRO',1),(4,'15','1501','01','AHUACHAPÁN SUR',1),(5,'14','1402','02','SANTA ANA NORTE',1),(6,'15','1502','02','SANTA ANA CENTRO',1),(7,'16','1602','02','SANTA ANA ESTE',1),(8,'17','1702','02','SANTA ANA OESTE',1),(9,'17','1703','03','SONSONATE NORTE',1),(10,'18','1803','03','SONSONATE CENTRO',1),(11,'19','1903','03','SONSONATE ESTE',1),(12,'20','2003','03','SONSONATE OESTE',1),(13,'34','3404','04','CHALATENANGO NORTE',1),(14,'35','3504','04','CHALATENANGO CENTRO',1),(15,'36','3604','04','CHALATENANGO SUR',1),(16,'23','2305','05','LA LIBERTAD NORTE',1),(17,'24','2405','05','LA LIBERTAD CENTRO',1),(18,'25','2505','05','LA LIBERTAD OESTE',1),(19,'26','2605','05','LA LIBERTAD ESTE',1),(20,'27','2705','05','LA LIBERTAD COSTA',1),(21,'28','2805','05','LA LIBERTAD SUR',1),(22,'20','2006','06','SAN SALVADOR NORTE',1),(23,'21','2106','06','SAN SALVADOR OESTE',1),(24,'22','2206','06','SAN SALVADOR ESTE',1),(25,'23','2306','06','SAN SALVADOR CENTRO',1),(26,'24','2406','06','SAN SALVADOR SUR',1),(27,'17','1707','07','CUSCATLAN NORTE',1),(28,'18','1807','07','CUSCATLAN SUR',1),(29,'23','2308','08','LA PAZ OESTE',1),(30,'24','2408','08','LA PAZ CENTRO',1),(31,'25','2508','08','LA PAZ ESTE',1),(32,'10','1009','09','CABAÑAS OESTE',1),(33,'11','1109','09','CABAÑAS ESTE',1),(34,'14','1410','10','SAN VICENTE NORTE',1),(35,'15','1510','10','SAN VICENTE SUR',1),(36,'24','2411','11','USULUTAN NORTE',1),(37,'25','2511','11','USULUTAN ESTE',1),(38,'26','2611','11','USULUTAN OESTE',1),(39,'21','2112','12','SAN MIGUEL NORTE',1),(40,'22','2212','12','SAN MIGUEL CENTRO',1),(41,'23','2312','12','SAN MIGUEL OESTE',1),(42,'27','2713','13','MORAZAN NORTE',1),(43,'28','2813','13','MORAZAN SUR',1),(44,'19','1914','14','LA UNION NORTE',1),(45,'20','2014','14','LA UNION SUR',1);
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `mensaje` text NOT NULL,
  `tipo` varchar(50) DEFAULT 'info',
  `leido` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasantias`
--

DROP TABLE IF EXISTS `pasantias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pasantias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estudiante_id` int NOT NULL,
  `empresa_id` int NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'activa',
  `tutor_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `institucion_id` int DEFAULT NULL,
  `proyecto_asociado` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estudiante_id` (`estudiante_id`),
  KEY `empresa_id` (`empresa_id`),
  KEY `fk_pasantias_institucion` (`institucion_id`),
  CONSTRAINT `fk_pasantias_institucion` FOREIGN KEY (`institucion_id`) REFERENCES `instituciones` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pasantias_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pasantias_ibfk_2` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasantias`
--

LOCK TABLES `pasantias` WRITE;
/*!40000 ALTER TABLE `pasantias` DISABLE KEYS */;
INSERT INTO `pasantias` VALUES (1,41,52,'2025-11-17','2026-05-17','activa',20,'2025-12-17 20:33:40',NULL,'Proyecto Seeder'),(2,44,48,'2025-11-17','2026-05-17','activa',16,'2025-12-17 20:34:28',NULL,'Proyecto Seeder'),(3,44,56,'2025-11-17','2026-05-17','activa',16,'2025-12-17 20:34:55',NULL,'Proyecto Seeder'),(4,47,58,'2025-11-17','2026-05-17','activa',19,'2025-12-17 20:34:55',NULL,'Proyecto Seeder'),(5,56,47,'2025-11-17','2026-05-17','activa',16,'2025-12-17 20:34:55',NULL,'Proyecto Seeder'),(6,59,47,'2025-11-17','2026-05-17','activa',19,'2025-12-17 20:34:55',NULL,'Proyecto Seeder');
/*!40000 ALTER TABLE `pasantias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_empresas`
--

DROP TABLE IF EXISTS `perfil_empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_empresas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `nombre_comercial` varchar(100) NOT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `sector_industrial` varchar(100) DEFAULT NULL,
  `direccion` text,
  `telefono` varchar(20) DEFAULT NULL,
  `validada` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `fk_emp_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_empresas`
--

LOCK TABLES `perfil_empresas` WRITE;
/*!40000 ALTER TABLE `perfil_empresas` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfil_empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_estudiantes`
--

DROP TABLE IF EXISTS `perfil_estudiantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_estudiantes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `carrera_id` int NOT NULL,
  `matricula` varchar(20) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `tutor_id` int DEFAULT NULL,
  `dui` varchar(20) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `direccion` text,
  `institucion` varchar(100) DEFAULT NULL,
  `nivel_academico` varchar(50) DEFAULT NULL,
  `estado_ocupacional` varchar(50) DEFAULT NULL,
  `cv_path` varchar(255) DEFAULT NULL,
  `departamento_id` int DEFAULT NULL,
  `municipio_id` int DEFAULT NULL,
  `distrito_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id` (`usuario_id`),
  KEY `carrera_id` (`carrera_id`),
  KEY `tutor_id` (`tutor_id`),
  CONSTRAINT `fk_est_carrera` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`),
  CONSTRAINT `fk_est_tutor` FOREIGN KEY (`tutor_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_est_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_estudiantes`
--

LOCK TABLES `perfil_estudiantes` WRITE;
/*!40000 ALTER TABLE `perfil_estudiantes` DISABLE KEYS */;
INSERT INTO `perfil_estudiantes` VALUES (1,41,1,'MAT1','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,42,1,'MAT2','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,43,1,'MAT3','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,44,1,'MAT4','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,45,1,'MAT5','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,46,1,'MAT6','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,47,1,'MAT7','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,48,1,'MAT8','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,49,1,'MAT9','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,50,1,'MAT10','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,51,1,'MAT11','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,52,1,'MAT12','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,53,1,'MAT13','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,54,1,'MAT14','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,55,1,'MAT15','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,56,1,'MAT16','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,57,1,'MAT17','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,58,1,'MAT18','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,59,1,'MAT19','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,60,1,'MAT20','77777777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,83,1,'AC202001','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,84,1,'AC202002','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,85,1,'AC202003','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,86,1,'AC202004','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,87,1,'AC202005','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,88,1,'AC202006','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,89,1,'AC202007','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,90,1,'AC202008','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,91,1,'AC202009','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,92,1,'AC202010','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,93,1,'AC202011','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,94,1,'AC202012','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,95,1,'AC202013','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,96,1,'AC202014','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,97,1,'AC202015','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,98,1,'AC202016','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,99,1,'AC202017','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,100,1,'AC202018','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,101,1,'AC202019','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,102,1,'AC202020','7777-7777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `perfil_estudiantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plazas`
--

DROP TABLE IF EXISTS `plazas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plazas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empresa_id` int NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `modalidad` enum('Presencial','Híbrida','Remota') NOT NULL DEFAULT 'Presencial',
  `cantidad_vacantes` int DEFAULT '1',
  `requisitos` text,
  `competencias_requeridas` text,
  `fecha_limite` date DEFAULT NULL,
  `duracion` varchar(50) DEFAULT '6 meses',
  `estado` enum('abierta','cerrada') DEFAULT 'abierta',
  `es_remunerada` tinyint(1) DEFAULT '0',
  `beneficios` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `fk_plazas_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plazas`
--

LOCK TABLES `plazas` WRITE;
/*!40000 ALTER TABLE `plazas` DISABLE KEYS */;
INSERT INTO `plazas` VALUES (4,12,'Desarrollador Web Junior','Buscamos estudiante apasionado por el desarrollo web para apoyo en proyectos de frontend con React y Backend con PHP.','Presencial',1,'- Conocimientos en HTML, CSS, JS\n- Nociones de PHP y MySQL\n- Ganas de aprender',NULL,'2025-12-31','6 meses','abierta',0,NULL,'2025-12-09 15:26:33'),(5,12,'Asistente de Redes','Apoyo en la gestión y configuración de redes locales y mantenimiento de equipos.','Presencial',1,'- Conocimientos de redes LAN/WAN\n- Mantenimiento de hardware',NULL,'2025-11-30','6 meses','abierta',0,NULL,'2025-12-07 15:26:33'),(6,12,'Diseñador UI/UX Trainee','Colaboración en el diseño de interfaces para aplicaciones móviles.','Presencial',1,'- Figma\n- Adobe XD\n- Portafolio básico',NULL,'2026-01-15','6 meses','abierta',0,NULL,'2025-12-04 15:26:33'),(7,41,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(8,41,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(9,42,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(10,42,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(11,43,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(12,43,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(13,44,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(14,44,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(15,45,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(16,45,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(17,46,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(18,46,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(19,47,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(20,47,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(21,48,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(22,48,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(23,49,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(24,49,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(25,50,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(26,50,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(27,51,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(28,51,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(29,52,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(30,52,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(31,53,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(32,53,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(33,54,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(34,54,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(35,55,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(36,55,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(37,56,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(38,56,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(39,57,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(40,57,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(41,58,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(42,58,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(43,59,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(44,59,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(45,60,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(46,60,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:08'),(47,41,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(48,41,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(49,42,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(50,42,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(51,43,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(52,43,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(53,44,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(54,44,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(55,45,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(56,45,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(57,46,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(58,46,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(59,47,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(60,47,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(61,48,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(62,48,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(63,49,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(64,49,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(65,50,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(66,50,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(67,51,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(68,51,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(69,52,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(70,52,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(71,53,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(72,53,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(73,54,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(74,54,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(75,55,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(76,55,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(77,56,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(78,56,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(79,57,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(80,57,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(81,58,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(82,58,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(83,59,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(84,59,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:39'),(85,60,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:40'),(86,60,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:33:40'),(87,41,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(88,41,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(89,42,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(90,42,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(91,43,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(92,43,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(93,44,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(94,44,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(95,45,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(96,45,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(97,46,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(98,46,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(99,47,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(100,47,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(101,48,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(102,48,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(103,49,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(104,49,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(105,50,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(106,50,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(107,51,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(108,51,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(109,52,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(110,52,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(111,53,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(112,53,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(113,54,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(114,54,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(115,55,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(116,55,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(117,56,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(118,56,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(119,57,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(120,57,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(121,58,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(122,58,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(123,59,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(124,59,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(125,60,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(126,60,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:28'),(127,41,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(128,41,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(129,42,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(130,42,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(131,43,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(132,43,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(133,44,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(134,44,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(135,45,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(136,45,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(137,46,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(138,46,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(139,47,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(140,47,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(141,48,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(142,48,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(143,49,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(144,49,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(145,50,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(146,50,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(147,51,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(148,51,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(149,52,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(150,52,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(151,53,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(152,53,'Diseñador Gráfico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(153,54,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(154,54,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(155,55,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(156,55,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(157,56,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(158,56,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(159,57,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(160,57,'Soporte Técnico','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(161,58,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(162,58,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(163,59,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(164,59,'Pasante Contable','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(165,60,'Asistente RRHH','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(166,60,'Desarrollador Jr','Descripcion de pasantía...','Híbrida',3,'Requisitos genericos',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 20:34:55'),(168,12,'Ingeniero de Redes Junior','Buscamos un Ingeniero de Redes Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(169,12,'Soporte Técnico Nivel 1','Buscamos un Soporte Técnico Nivel 1 proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(170,21,'Ingeniero de Redes Junior','Buscamos un Ingeniero de Redes Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(171,21,'Asistente Administrativo','Buscamos un Asistente Administrativo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(172,22,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(173,22,'Desarrollador Java Junior','Buscamos un Desarrollador Java Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(174,23,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(175,23,'Soporte Técnico Nivel 1','Buscamos un Soporte Técnico Nivel 1 proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(176,24,'Analista de Datos','Buscamos un Analista de Datos proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(177,24,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(178,25,'Soporte Técnico Nivel 1','Buscamos un Soporte Técnico Nivel 1 proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(179,25,'Desarrollador Frontend React','Buscamos un Desarrollador Frontend React proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(180,26,'Pasante de Recursos Humanos','Buscamos un Pasante de Recursos Humanos proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(181,26,'Asistente Administrativo','Buscamos un Asistente Administrativo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(182,27,'Desarrollador Frontend React','Buscamos un Desarrollador Frontend React proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(183,27,'Desarrollador Frontend React','Buscamos un Desarrollador Frontend React proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(184,28,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(185,28,'Desarrollador Frontend React','Buscamos un Desarrollador Frontend React proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(186,29,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(187,29,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(188,30,'Ingeniero de Redes Junior','Buscamos un Ingeniero de Redes Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(189,30,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(190,31,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(191,31,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(192,32,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(193,32,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(194,33,'Pasante de Recursos Humanos','Buscamos un Pasante de Recursos Humanos proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(195,33,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(196,34,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(197,34,'Analista de Datos','Buscamos un Analista de Datos proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(198,35,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(199,35,'Ingeniero de Redes Junior','Buscamos un Ingeniero de Redes Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(200,36,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(201,36,'Pasante de Recursos Humanos','Buscamos un Pasante de Recursos Humanos proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(202,37,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(203,37,'Ingeniero de Redes Junior','Buscamos un Ingeniero de Redes Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(204,38,'Asistente Administrativo','Buscamos un Asistente Administrativo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(205,38,'Asistente Administrativo','Buscamos un Asistente Administrativo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(206,39,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(207,39,'Pasante de Recursos Humanos','Buscamos un Pasante de Recursos Humanos proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(208,40,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(209,40,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(210,63,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(211,63,'Soporte Técnico Nivel 1','Buscamos un Soporte Técnico Nivel 1 proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(212,64,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(213,64,'Analista de Datos','Buscamos un Analista de Datos proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(214,65,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(215,65,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(216,66,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(217,66,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(218,67,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(219,67,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(220,68,'Asistente Administrativo','Buscamos un Asistente Administrativo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(221,68,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(222,69,'Desarrollador Java Junior','Buscamos un Desarrollador Java Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(223,69,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(224,70,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(225,70,'Asistente Administrativo','Buscamos un Asistente Administrativo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(226,71,'Ingeniero de Redes Junior','Buscamos un Ingeniero de Redes Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(227,71,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(228,72,'Ingeniero de Redes Junior','Buscamos un Ingeniero de Redes Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(229,72,'Desarrollador Frontend React','Buscamos un Desarrollador Frontend React proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(230,73,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(231,73,'Desarrollador Java Junior','Buscamos un Desarrollador Java Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(232,74,'Desarrollador Java Junior','Buscamos un Desarrollador Java Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(233,74,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(234,75,'Analista de Datos','Buscamos un Analista de Datos proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(235,75,'Asistente Administrativo','Buscamos un Asistente Administrativo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(236,76,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(237,76,'Desarrollador Frontend React','Buscamos un Desarrollador Frontend React proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(238,77,'Desarrollador Java Junior','Buscamos un Desarrollador Java Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(239,77,'Desarrollador Frontend React','Buscamos un Desarrollador Frontend React proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(240,78,'Analista de Datos','Buscamos un Analista de Datos proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(241,78,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(242,79,'Asistente Administrativo','Buscamos un Asistente Administrativo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(243,79,'Auxiliar de Mercadeo','Buscamos un Auxiliar de Mercadeo proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(244,80,'Pasante de Contabilidad','Buscamos un Pasante de Contabilidad proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(245,80,'Desarrollador Frontend React','Buscamos un Desarrollador Frontend React proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(246,81,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(247,81,'Diseñador UI/UX Junior','Buscamos un Diseñador UI/UX Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(248,82,'Ingeniero de Redes Junior','Buscamos un Ingeniero de Redes Junior proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33'),(249,82,'Soporte Técnico Nivel 1','Buscamos un Soporte Técnico Nivel 1 proactivo y con ganas de aprender.','Híbrida',2,'Estudiante de 4to año en adelante.',NULL,'2026-01-16','6 meses','abierta',0,NULL,'2025-12-17 22:45:33');
/*!40000 ALTER TABLE `plazas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postulaciones`
--

DROP TABLE IF EXISTS `postulaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postulaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plaza_id` int NOT NULL,
  `estudiante_id` int NOT NULL,
  `fecha_postulacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('pendiente','aceptada','rechazada') DEFAULT 'pendiente',
  `comentarios_empresa` text,
  PRIMARY KEY (`id`),
  KEY `plaza_id` (`plaza_id`),
  KEY `estudiante_id` (`estudiante_id`),
  CONSTRAINT `fk_post_estudiante` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_post_plaza` FOREIGN KEY (`plaza_id`) REFERENCES `plazas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postulaciones`
--

LOCK TABLES `postulaciones` WRITE;
/*!40000 ALTER TABLE `postulaciones` DISABLE KEYS */;
INSERT INTO `postulaciones` VALUES (1,18,42,'2025-12-17 20:33:08','pendiente',NULL),(2,14,43,'2025-12-17 20:33:08','pendiente',NULL),(3,46,48,'2025-12-17 20:33:08','pendiente',NULL),(4,69,41,'2025-12-17 20:33:40','aceptada',NULL),(5,111,43,'2025-12-17 20:34:28','pendiente',NULL),(6,102,44,'2025-12-17 20:34:28','aceptada',NULL),(7,157,44,'2025-12-17 20:34:55','aceptada',NULL),(8,128,46,'2025-12-17 20:34:55','pendiente',NULL),(9,162,47,'2025-12-17 20:34:55','aceptada',NULL),(10,131,48,'2025-12-17 20:34:55','pendiente',NULL),(11,135,49,'2025-12-17 20:34:55','pendiente',NULL),(12,160,55,'2025-12-17 20:34:55','pendiente',NULL),(13,139,56,'2025-12-17 20:34:55','aceptada',NULL),(14,138,57,'2025-12-17 20:34:55','pendiente',NULL),(15,149,58,'2025-12-17 20:34:55','pendiente',NULL),(16,140,59,'2025-12-17 20:34:55','aceptada',NULL),(17,139,60,'2025-12-17 20:34:55','pendiente',NULL),(18,170,83,'2025-12-18 04:19:36','pendiente',NULL),(19,172,83,'2025-12-18 14:14:31','pendiente',NULL);
/*!40000 ALTER TABLE `postulaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preguntas_plaza`
--

DROP TABLE IF EXISTS `preguntas_plaza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preguntas_plaza` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plaza_id` int NOT NULL,
  `pregunta` text NOT NULL,
  `tipo` varchar(50) DEFAULT 'texto',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preguntas_plaza`
--

LOCK TABLES `preguntas_plaza` WRITE;
/*!40000 ALTER TABLE `preguntas_plaza` DISABLE KEYS */;
/*!40000 ALTER TABLE `preguntas_plaza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportes`
--

DROP TABLE IF EXISTS `reportes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estudiante_id` int NOT NULL,
  `pasantia_id` int DEFAULT NULL,
  `tutor_id` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `semana` int DEFAULT NULL,
  `archivo_adjunto` varchar(255) DEFAULT NULL,
  `fecha_envio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `retroalimentacion` text,
  `fecha_revision` timestamp NULL DEFAULT NULL,
  `estado` enum('pendiente','revisado') DEFAULT 'pendiente',
  PRIMARY KEY (`id`),
  KEY `estudiante_id` (`estudiante_id`),
  KEY `tutor_id` (`tutor_id`),
  CONSTRAINT `fk_rep_est` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_rep_tut` FOREIGN KEY (`tutor_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportes`
--

LOCK TABLES `reportes` WRITE;
/*!40000 ALTER TABLE `reportes` DISABLE KEYS */;
INSERT INTO `reportes` VALUES (1,44,3,16,'Reporte Semana 1','Actividades realizadas durante la semana...',1,NULL,'2025-12-17 20:34:55',NULL,NULL,'pendiente'),(2,44,3,16,'Reporte Semana 2','Actividades realizadas durante la semana...',2,NULL,'2025-12-17 20:34:55',NULL,NULL,'pendiente'),(3,47,4,19,'Reporte Semana 1','Actividades realizadas durante la semana...',1,NULL,'2025-12-17 20:34:55',NULL,NULL,'pendiente'),(4,47,4,19,'Reporte Semana 2','Actividades realizadas durante la semana...',2,NULL,'2025-12-17 20:34:55',NULL,NULL,'pendiente'),(5,56,5,16,'Reporte Semana 1','Actividades realizadas durante la semana...',1,NULL,'2025-12-17 20:34:55',NULL,NULL,'pendiente'),(6,56,5,16,'Reporte Semana 2','Actividades realizadas durante la semana...',2,NULL,'2025-12-17 20:34:55',NULL,NULL,'pendiente'),(7,59,6,19,'Reporte Semana 1','Actividades realizadas durante la semana...',1,NULL,'2025-12-17 20:34:55',NULL,NULL,'pendiente'),(8,59,6,19,'Reporte Semana 2','Actividades realizadas durante la semana...',2,NULL,'2025-12-17 20:34:55',NULL,NULL,'pendiente');
/*!40000 ALTER TABLE `reportes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Coordinador'),(3,'Tutor'),(4,'Empresa'),(5,'Estudiante');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_settings`
--

DROP TABLE IF EXISTS `system_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(255) DEFAULT NULL,
  `direccion` text,
  `telefono` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_settings`
--

LOCK TABLES `system_settings` WRITE;
/*!40000 ALTER TABLE `system_settings` DISABLE KEYS */;
INSERT INTO `system_settings` VALUES (1,'SIGP - Sistema Integral','San Salvador, El Salvador','+503 2222-0000','50370000000','contacto@sigp.sv','2025-12-18 18:04:49');
/*!40000 ALTER TABLE `system_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_habilidades`
--

DROP TABLE IF EXISTS `usuario_habilidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_habilidades` (
  `usuario_id` int NOT NULL,
  `habilidad_id` int NOT NULL,
  PRIMARY KEY (`usuario_id`,`habilidad_id`),
  KEY `habilidad_id` (`habilidad_id`),
  CONSTRAINT `usuario_habilidades_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `usuario_habilidades_ibfk_2` FOREIGN KEY (`habilidad_id`) REFERENCES `habilidades` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_habilidades`
--

LOCK TABLES `usuario_habilidades` WRITE;
/*!40000 ALTER TABLE `usuario_habilidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_habilidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_perfil` varchar(255) DEFAULT 'default.png',
  `empresa_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (12,4,'Tech Solutions Ltd','contacto@techsolutions.local','$2y$10$abcde12345','activo','2025-12-09 15:26:33','default.png',NULL),(14,1,'Admin','admin@sigp.com','$2y$10$4OKM109B7cmyOeYMG7aeBOzvx3FQhp2m/iggoIlpqASUGoeswwPMG','activo','2025-12-09 22:36:01','693a060304f19_avatar.jpg',NULL),(15,2,'Coordinador','coordinador@sigp.com','$2y$10$iDQOztF0OBzPZd0Bt0i2JOEjGBzoc6nPYH7M76RTDbTO5FJznsaEC','activo','2025-12-09 22:37:03','default.png',NULL),(16,3,'Tutor 1','tutor1@test.com','$2y$10$2BVs2PVxnUNlGc2uA0p8ZelJFOmMrFBe4ATkzIwbekgtWcNlVR0Qu','activo','2025-12-17 20:15:13','default.png',NULL),(17,3,'Tutor 2','tutor2@test.com','$2y$10$oYFySPQEqGQ0Gh/fCYDbc.mh/jvaOjSunO/8vDhMRRjtbA5BsIE3m','activo','2025-12-17 20:15:13','default.png',NULL),(18,3,'Tutor 3','tutor3@test.com','$2y$10$DkVHgRpF1TbWXdDGb6MyTe.q309/yBsOFK3zps5lYfR4NZdeLKlbS','activo','2025-12-17 20:15:13','default.png',NULL),(19,3,'Tutor 4','tutor4@test.com','$2y$10$IMm9kLCnELDq9UqFVH3CDOXJiwTyBX337bJ1qIsKYFLk9hZtbb9ha','activo','2025-12-17 20:15:13','default.png',NULL),(20,3,'Tutor 5','tutor5@test.com','$2y$10$j/rrgL3ryVEMZIwiEj5m/OZD6pUFhhYkonnnKQRGegb5tATH/IpQi','activo','2025-12-17 20:15:13','default.png',NULL),(21,4,'Empresa 1 Solutions','company1@test.com','$2y$10$NzLifCxRdr3PGBmXi0SxoeaajD9J8Ns.zWgASA2IXrisvO8UnpTke','activo','2025-12-17 20:15:13','default.png',41),(22,4,'Empresa 2 Solutions','company2@test.com','$2y$10$zY1wyeNpcmvdsSYZJ9JkLuACkrCKOvVtNTeWC1oRGHHlPP2l96VJG','activo','2025-12-17 20:30:59','default.png',42),(23,4,'Empresa 3 Solutions','company3@test.com','$2y$10$/TNbdsTxTTRvortWxXQxqeMZO8cWy0cpGxg24HbHEpdeHPtKXevvG','activo','2025-12-17 20:31:00','default.png',43),(24,4,'Empresa 4 Solutions','company4@test.com','$2y$10$JNDQKL8nsMrbWDd8/Dcs1umKp6Ss5s0W.GmF6RvCLdM58KpnaN8LW','activo','2025-12-17 20:31:00','default.png',44),(25,4,'Empresa 5 Solutions','company5@test.com','$2y$10$vmmgnANMfzXH/Oyih2NJXOTbaPacQ1VtO/xXXjnXdGVSZe6abH7Zm','activo','2025-12-17 20:31:00','default.png',45),(26,4,'Empresa 6 Solutions','company6@test.com','$2y$10$rQ/Rk4wOKpS4rRpLqzNyTeCBqxj9OjmUYc.sdbQau/D.5u1/Bsz.W','activo','2025-12-17 20:31:00','default.png',46),(27,4,'Empresa 7 Solutions','company7@test.com','$2y$10$iZX/OUndo5mf5U7MdhPKNeVoMUBwqwxSZ3dqka85Rn0bT0m0OBr9a','activo','2025-12-17 20:31:00','default.png',47),(28,4,'Empresa 8 Solutions','company8@test.com','$2y$10$W2uml5Ghh/S0Esnpk/RGAehE8ex3MAG1nbl.zn0FY.OazTD5m2UMq','activo','2025-12-17 20:31:00','default.png',48),(29,4,'Empresa 9 Solutions','company9@test.com','$2y$10$Jb0gVZtc2Fwwzxsv0i8i9ePHU/ZruP0NZgQtrg0xkAeee68lSmjoi','activo','2025-12-17 20:31:00','default.png',49),(30,4,'Empresa 10 Solutions','company10@test.com','$2y$10$QrBFyegAVqr.YtQtkNiG1ODNg/HCRIp0lkSAFNuDmzLdSzox/0g8a','activo','2025-12-17 20:31:00','default.png',50),(31,4,'Empresa 11 Solutions','company11@test.com','$2y$10$HwITlIJqX5D0X3cTDrdGv.dPPEuPhMdkuETPzlpJflMWru7G22zr.','activo','2025-12-17 20:31:00','default.png',51),(32,4,'Empresa 12 Solutions','company12@test.com','$2y$10$7UVP1VEUDIl2W80su18Z0.KT7lVAjcAGKA34UWH/RHqtH2cjWMOYe','activo','2025-12-17 20:31:00','default.png',52),(33,4,'Empresa 13 Solutions','company13@test.com','$2y$10$1g8D00brfkfylr70sdFbkeGVgFzZP.Lqh8eoMERDUy8Nx.onCsNBy','activo','2025-12-17 20:31:00','default.png',53),(34,4,'Empresa 14 Solutions','company14@test.com','$2y$10$fvtggoRdX8rqsPdrUEaLy.wfrUuvD.LPwWgMLG/GT1Qs6MrLH2wvS','activo','2025-12-17 20:31:00','default.png',54),(35,4,'Empresa 15 Solutions','company15@test.com','$2y$10$4Us04YHlLK8vixiATsdL7eJ24bliS0LzoOSOetevSdrFIEjEWCW.y','activo','2025-12-17 20:31:01','default.png',55),(36,4,'Empresa 16 Solutions','company16@test.com','$2y$10$AFDUXkzJfaK1b8da.gRCm.dBbaDeXfNIq27l9Kop/m880IhbqyoSe','activo','2025-12-17 20:31:01','default.png',56),(37,4,'Empresa 17 Solutions','company17@test.com','$2y$10$d0XGxIzW1cgWltFyuQDLpOIoGIgjhCGME6.82RWeyb/bOAG4pAPYy','activo','2025-12-17 20:31:01','default.png',57),(38,4,'Empresa 18 Solutions','company18@test.com','$2y$10$ToufDdSRzwUEbQ9ITGYSl.EwVxZjtH1sP0GGq3Q8qVVRnN1n4xuXu','activo','2025-12-17 20:31:01','default.png',58),(39,4,'Empresa 19 Solutions','company19@test.com','$2y$10$3qL9vHTByW1FCRDYRQYy0O5ps0jpH1nS.YTVgfjyR.w2oMLFzAkTi','activo','2025-12-17 20:31:01','default.png',59),(40,4,'Empresa 20 Solutions','company20@test.com','$2y$10$ophQcsUI9DpZABgzd7Tx6OAwDrP04Y7Bw05AxWCsb2wqsVm3nZ11O','activo','2025-12-17 20:31:01','default.png',60),(41,5,'Estudiante 1','student1@test.com','$2y$10$4CsmZq1vBRZumDsR8UHw6O6W.k/UwHfnCjv6m5qakYWuN4d1.3pTu','activo','2025-12-17 20:31:01','default.png',NULL),(42,5,'Estudiante 2','student2@test.com','$2y$10$0bBqX0Gs2Hcp4R7DDjvuNu8c9U480IBNsf6ITL1gE87eF7pU1QKuW','activo','2025-12-17 20:31:43','default.png',NULL),(43,5,'Estudiante 3','student3@test.com','$2y$10$DRUDpmaRBay6gUG8WLxTxu2212Uq7RdBxFao3nuhh.eck24xZ4wiC','activo','2025-12-17 20:31:43','default.png',NULL),(44,5,'Estudiante 4','student4@test.com','$2y$10$fxuGkE.mOw6Xu5l1FYG6h.JEBib7uqVcPf3PRSDTl5F6hUoKi392.','activo','2025-12-17 20:31:44','default.png',NULL),(45,5,'Estudiante 5','student5@test.com','$2y$10$lCBwQbbRGPgdW2nDTewGYeF.bIB4cYwFaBmgR86WVyzZQH4mMztUC','activo','2025-12-17 20:31:44','default.png',NULL),(46,5,'Estudiante 6','student6@test.com','$2y$10$fhBoPg8WCR3F.jettiRo4OSjuVKZlq4ZZZ8zriaV1UwgRAB8i810.','activo','2025-12-17 20:31:44','default.png',NULL),(47,5,'Estudiante 7','student7@test.com','$2y$10$AmSAY7zAjyQmxOq8jKDCmeePBtbLFPvsBe3i6iHEMxnEJTbEdYU/G','activo','2025-12-17 20:31:44','default.png',NULL),(48,5,'Estudiante 8','student8@test.com','$2y$10$dOdRyPLbrUYfKGCV3oMoc.eGIDdLvPHLCxebSTMVxoxw7StT/mb2a','activo','2025-12-17 20:31:44','default.png',NULL),(49,5,'Estudiante 9','student9@test.com','$2y$10$0FhzCpdWIlzyz.VXL/PtVe6kQEFj27/ztz61upf6txsHH8f/7Z0Ji','activo','2025-12-17 20:31:44','default.png',NULL),(50,5,'Estudiante 10','student10@test.com','$2y$10$x4mDovqLs/DbdfVkBmmMmOOjYV1luva7sFcVudiFsUMhRC5oSwZqm','activo','2025-12-17 20:31:44','default.png',NULL),(51,5,'Estudiante 11','student11@test.com','$2y$10$annlIvOy2SVqSWYFIPZ1mOj7eF2uOKtu1LbL626s7f9A.Kxw7q8yu','activo','2025-12-17 20:31:44','default.png',NULL),(52,5,'Estudiante 12','student12@test.com','$2y$10$3qWYBkvTe5gwu0B1UpxbNuqHAgTxTrNCQN3ZayLOaAwjmg.hzsRMq','activo','2025-12-17 20:31:44','default.png',NULL),(53,5,'Estudiante 13','student13@test.com','$2y$10$plh7yIsvzLjNzGr4Q3Bz7OlZAW5HxlG96ID7cQcBllnJO0mTAjEPK','activo','2025-12-17 20:31:44','default.png',NULL),(54,5,'Estudiante 14','student14@test.com','$2y$10$pxb/Cv0Xh.XN5nky25wa4OKmWJPLCHly5ONz/bC7wPhg026cePh6S','activo','2025-12-17 20:31:44','default.png',NULL),(55,5,'Estudiante 15','student15@test.com','$2y$10$RwP/Ebb7XORGna8uSYycNO2q3jOYidFkKThYewxk.J0XhKGJiWS36','activo','2025-12-17 20:31:44','default.png',NULL),(56,5,'Estudiante 16','student16@test.com','$2y$10$mCqesXm1NPg2MBI5MwYuU.ArAG3x08eHd6jbSqfv/T66sTgd5aJw.','activo','2025-12-17 20:31:44','default.png',NULL),(57,5,'Estudiante 17','student17@test.com','$2y$10$yvzBeyVo/c8cmtcxmyiJ6um9HFXXsd5KJpXJI9U.56YqwpiFcr1oK','activo','2025-12-17 20:31:45','default.png',NULL),(58,5,'Estudiante 18','student18@test.com','$2y$10$a0XnP1qCRO5l9h9LtdCUj.gD1ZBJ4zoVyK.ANfwLHwUftNLUru04C','activo','2025-12-17 20:31:45','default.png',NULL),(59,5,'Estudiante 19','student19@test.com','$2y$10$IiVd.8iIFWt.RN/Ijd.JEOd.vSVUjDupnomjylYyjRXfAEPZ1z5FS','activo','2025-12-17 20:31:45','default.png',NULL),(60,5,'Estudiante 20','student20@test.com','$2y$10$ASfdcjppNcc/dHDcaH9GBufH7/CRVOb3m8SJz.BY6LvDqBxBsOsHq','activo','2025-12-17 20:31:45','default.png',NULL),(61,2,'Coordinador General','coordinator@test.com','$2y$10$8f8vkrtfUr9Lsg/eZid6UOcZgobco7qplz8SBUu2PKn4ckIJ7vRca','activo','2025-12-17 20:39:43','default.png',NULL),(63,4,'Banco Agrícola','rrhh@bancoagricola.com.sv','$2y$10$mdmCrxRf0wAXyuuPUCvoluMcYs3RnuZl9Uce9HShQx.tGxrtBKwuG','activo','2025-12-17 22:44:58','default.png',61),(64,4,'Tigo El Salvador','talent@tigo.com.sv','$2y$10$e.pPNNMNa7.LXtNeI6bneeZk0PMVbg0HAoKmwa3EX5U/Eb0UWKTEm','activo','2025-12-17 22:44:58','default.png',62),(65,4,'Aeroman','info@aeroman.com.sv','$2y$10$Izn7qaI8wygDAZCzSSLNIOBeuswpIOISklkzRc4gdlQvEfZluu.6y','activo','2025-12-17 22:44:58','default.png',63),(66,4,'Siman','reclutamiento@siman.com','$2y$10$P5isMumVbLBFmCRD25jt/eAva2eWBhepC/TYu6ChF/J91Msn/7OuK','activo','2025-12-17 22:44:58','default.png',64),(67,4,'ASIT S.A. de C.V.','info@asit.com.sv','$2y$10$q7iR.LSFUtuHYVDPGGzMZuimahkXnJKYILXv6uGHcVefB.UTws1jq','activo','2025-12-17 22:44:58','default.png',65),(68,4,'Universidad Don Bosco','rrhh@udb.edu.sv','$2y$10$WlPaZ.Jp0H02TNXEUQGipe3O.F9ItBHY0QN3SIUxp5y/vndNfmlNW','activo','2025-12-17 22:44:58','default.png',66),(69,4,'Hospital de Diagnóstico','rrhh@hdiagnostico.com.sv','$2y$10$puiQdSy8VPtcSUW0NaVtmu/jQO57iRcPLFrEmLMJI7egRjACcLe3W','activo','2025-12-17 22:44:58','default.png',67),(70,4,'Holcim El Salvador','info@holcim.com.sv','$2y$10$b7nx3Xgxds1kDcA.J4MlOOW4rc7VcBHGQoY1ioctlNgXGoqhqw6bS','activo','2025-12-17 22:44:58','default.png',68),(71,4,'Banco Cuscatlán','talento@bancocuscatlan.com','$2y$10$gcMXwq/ZnK9caN.XZRGvF.YpM3.mzT5T9xvSIwEMd1Q1EPygM8m/q','activo','2025-12-17 22:44:59','default.png',69),(72,4,'Claro El Salvador','jobs@claro.com.sv','$2y$10$PXhwoJsHvRwauZuUUDDWJupiA9ytvIEpxVa/UIIHIbiDfIxENtC1O','activo','2025-12-17 22:44:59','default.png',70),(73,4,'Super Selectos','seleccion@superselectos.com.sv','$2y$10$tNr/TGf2VuVY9S4lXziHDOdng4O3FKfkTg.UWHaPlulPPLX7NZd1K','activo','2025-12-17 22:44:59','default.png',71),(74,4,'Applaudo Studios','careers@applaudo.com','$2y$10$W0Fmkdwor3.b2jKdY/ADm.XzkcmFH7mM2sN31fDPe2ojrkDfuWjRm','activo','2025-12-17 22:44:59','default.png',72),(75,4,'Telus International','join@telus.com','$2y$10$sW1UcgCtFL5QOrpWxqGQVOYp7Sc6UVLH..iNXZoSIOzTxOPKgyZOC','activo','2025-12-17 22:44:59','default.png',73),(76,4,'Industrias La Constancia','info@laconstancia.com','$2y$10$eWZ4Qhp.oNLFL3qw2l2UbOTlaWM.3pqCq.coN7CVGEv4g5obNpOCa','activo','2025-12-17 22:44:59','default.png',74),(77,4,'AES El Salvador','info@aes.com.sv','$2y$10$qF..aaT21Thx6vhROlpyXe6hTnA657nxWZeNLyyFadEVgB1hDTU2i','activo','2025-12-17 22:44:59','default.png',75),(78,4,'Grupo Q','rrhh@grupoq.com','$2y$10$MLrqLWJ1.Ann.SYDZNjx3uUzPh8teNazb6oI76pbWsf2PzIOcDKBS','activo','2025-12-17 22:44:59','default.png',76),(79,4,'Davivienda','talento@davivienda.com.sv','$2y$10$je7DdLDUNhraPoLCBj7nIOnuXgvhIIp5oGs6YidhFLn8V9lW2.LpG','activo','2025-12-17 22:44:59','default.png',77),(80,4,'Unicomer','jobs@unicomer.com','$2y$10$WH1eMRvKG0vwPQrY9I2iDO9Bvk7I1dvYPxtNmpGoTY4lBoZV0rJpK','activo','2025-12-17 22:44:59','default.png',78),(81,4,'Avianca','people@avianca.com','$2y$10$9EbVfsq9jsVKooc77MUswO3k1iGz.KSM1JtvUNhzQ2iGAqJ4lUusG','activo','2025-12-17 22:45:00','default.png',79),(82,4,'Teleperformance','careers@teleperformance.com','$2y$10$HdBLt56dqxaX5f.Gh7d6reK0BO4X0sA1oNwfUohuBx9sEOXdXsNyy','activo','2025-12-17 22:45:00','default.png',80),(83,5,'Estudiante 1','estudiante1@udb.edu.sv','$2y$10$d9mM1Aqts9aM5a7zN0fwtuSsy1tQptzU9UghoRCcAj.5sRtVPSs0y','activo','2025-12-17 22:45:00','default.png',NULL),(84,5,'Estudiante 2','estudiante2@udb.edu.sv','$2y$10$AMHo.4Ac5x4.KQrHmuV.I.x9hntzuhTigFytybJ8YMpDXQMo6POm.','activo','2025-12-17 22:45:00','default.png',NULL),(85,5,'Estudiante 3','estudiante3@udb.edu.sv','$2y$10$EOQwSOEC60iSZYCSsFnWQOtK4vw0ULej3/QjbwYqtJQcuStUVO9GO','activo','2025-12-17 22:45:00','default.png',NULL),(86,5,'Estudiante 4','estudiante4@udb.edu.sv','$2y$10$OE1VgTGqx53PuFGY6GhEIOvxaIOWGfBLEMuKxxwrXO7rFJVDJttnS','activo','2025-12-17 22:45:00','default.png',NULL),(87,5,'Estudiante 5','estudiante5@udb.edu.sv','$2y$10$5pODhE5H35wXuvq8/XUDxeo/VgXGCV9YclC.ixuJljmhhzUX39C1G','activo','2025-12-17 22:45:00','default.png',NULL),(88,5,'Estudiante 6','estudiante6@udb.edu.sv','$2y$10$n6xpRW0Cj1aFU/F0BGh/H.Qy9sg4wGhJkX.wXKBjZ.mgCXM6X6qn6','activo','2025-12-17 22:45:00','default.png',NULL),(89,5,'Estudiante 7','estudiante7@udb.edu.sv','$2y$10$dLM7tXNRPRsTp2m9d8ZBuulI8UyLCXKDXRkgybJL1Hd8LAE1JlQaW','activo','2025-12-17 22:45:00','default.png',NULL),(90,5,'Estudiante 8','estudiante8@udb.edu.sv','$2y$10$i4dbcEx9L.LcCEhlqq2uPuJyEvpQa/wbLOfHPcCiXX2erUhXVk9JC','activo','2025-12-17 22:45:00','default.png',NULL),(91,5,'Estudiante 9','estudiante9@udb.edu.sv','$2y$10$DspzzdCWvY/mEeqaMWNineUUaLzZGSyunZ/EXgIYBQsOAixz/EANy','activo','2025-12-17 22:45:01','default.png',NULL),(92,5,'Estudiante 10','estudiante10@udb.edu.sv','$2y$10$zk/fgfNWGcyzxJGDnxzHWOgSLf.rLotBJpiPLkcNSfLlAPY6nFUKi','activo','2025-12-17 22:45:01','default.png',NULL),(93,5,'Estudiante 11','estudiante11@udb.edu.sv','$2y$10$M.rLJBuX5ft54on7XFC9luB1Ysm3xYN6kCgZzYVThRkUB0PZ/Ssle','activo','2025-12-17 22:45:01','default.png',NULL),(94,5,'Estudiante 12','estudiante12@udb.edu.sv','$2y$10$6nj2bZv4FJBvDmD4bc/ymOeQQHe4wJgPV0F8u8WKVrxcdH.5Xgooy','activo','2025-12-17 22:45:01','default.png',NULL),(95,5,'Estudiante 13','estudiante13@udb.edu.sv','$2y$10$2LK1kgzGVqbyfCUHrjp3bOObHLUIv.IKaqiXpeSBDIeat0/Kk8X2i','activo','2025-12-17 22:45:01','default.png',NULL),(96,5,'Estudiante 14','estudiante14@udb.edu.sv','$2y$10$PUi..ccb91zKHhvsa.pBLejHtTXFpXp6nLDAbZjqM1L4cNOukmgIa','activo','2025-12-17 22:45:01','default.png',NULL),(97,5,'Estudiante 15','estudiante15@udb.edu.sv','$2y$10$zBgGyfyCiMOuyUBNcxMZK.4dvuF.8g8CkK1MD/PytDlNJOC/qSCbS','activo','2025-12-17 22:45:01','default.png',NULL),(98,5,'Estudiante 16','estudiante16@udb.edu.sv','$2y$10$YbsRSpl4XRirAbjHjZGLpObCkV0NkweY5nROCkWByZr.1Owjx4KIq','activo','2025-12-17 22:45:01','default.png',NULL),(99,5,'Estudiante 17','estudiante17@udb.edu.sv','$2y$10$NlJfRQpRK83yRY/g44Bi5eLshGNjTm.QA3boZ8nZyRaUI4M/xb8y.','activo','2025-12-17 22:45:01','default.png',NULL),(100,5,'Estudiante 18','estudiante18@udb.edu.sv','$2y$10$7uZzpInk7u2gFNJXtpXpLeieCnqrgcg1I64KJ1qySObFZ8cFmD56W','activo','2025-12-17 22:45:01','default.png',NULL),(101,5,'Estudiante 19','estudiante19@udb.edu.sv','$2y$10$CQHwZ1dXSeOOqJ3I9MNJUeOea0v1Bb5YGn2/MmluVr5cnz9cRd9/C','activo','2025-12-17 22:45:01','default.png',NULL),(102,5,'Estudiante 20','estudiante20@udb.edu.sv','$2y$10$i/4onooWxQdGTyRAtl9tpOg/SduBSDc05yrkgMhJcRi74iJBo8FQm','activo','2025-12-17 22:45:01','default.png',NULL);
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

-- Dump completed on 2025-12-18 15:47:18
