/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.4.7-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: nerdadas_horas
-- ------------------------------------------------------
-- Server version	11.4.7-MariaDB-0ubuntu0.25.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Current Database: `nerdadas_horas`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `nerdadas_horas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;

USE `nerdadas_horas`;

--
-- Table structure for table `api_tokens`
--

DROP TABLE IF EXISTS `api_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `token` char(64) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_tokens`
--

LOCK TABLES `api_tokens` WRITE;
/*!40000 ALTER TABLE `api_tokens` DISABLE KEYS */;
INSERT INTO `api_tokens` VALUES
(1,'R1Test','5b59457277535624eb3fef15b4ab9e717e61bc6649cc0cda30eecf9335c8b66c',1,'2025-08-18 15:10:03');
/*!40000 ALTER TABLE `api_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados_empresas`
--

DROP TABLE IF EXISTS `empleados_empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados_empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `empleados_empresas_FK` (`empresa_id`) USING BTREE,
  KEY `empleados_empresas_FK_1` (`persona_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados_empresas`
--

LOCK TABLES `empleados_empresas` WRITE;
/*!40000 ALTER TABLE `empleados_empresas` DISABLE KEYS */;
INSERT INTO `empleados_empresas` VALUES
(1,1,2,'2022-08-02 12:34:03','2022-08-02 15:34:03'),
(2,1,1,'2022-08-02 12:34:51','2022-08-02 15:34:51'),
(3,1,1,'2022-08-02 12:36:02','2022-08-02 15:36:02'),
(4,1,1,'2022-08-02 12:36:03','2022-08-02 15:36:03');
/*!40000 ALTER TABLE `empleados_empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados_trabajo`
--

DROP TABLE IF EXISTS `empleados_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados_trabajo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trabajo_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `empleados_empresas_FK` (`trabajo_id`) USING BTREE,
  KEY `empleados_empresas_FK_1` (`persona_id`) USING BTREE,
  CONSTRAINT `empleados_trabajo_FK` FOREIGN KEY (`trabajo_id`) REFERENCES `trabajos` (`id`),
  CONSTRAINT `empleados_trabajo_FK_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados_trabajo`
--

LOCK TABLES `empleados_trabajo` WRITE;
/*!40000 ALTER TABLE `empleados_trabajo` DISABLE KEYS */;
INSERT INTO `empleados_trabajo` VALUES
(8,2,2,'2022-08-02 13:19:14','2022-08-02 16:19:14'),
(9,3,1,'2022-08-02 19:41:00','2022-08-02 22:41:00'),
(10,1,3,'2022-08-02 21:13:51','2022-08-03 00:13:51');
/*!40000 ALTER TABLE `empleados_trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `cuit` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `condicionfiscal` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `empresas_UN` (`cuit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historia`
--

DROP TABLE IF EXISTS `historia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `historia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `extra` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `historia_FK` (`usuario_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia`
--

LOCK TABLES `historia` WRITE;
/*!40000 ALTER TABLE `historia` DISABLE KEYS */;
INSERT INTO `historia` VALUES
(1,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo123 \n','::1','2022-08-02 09:46:34'),
(2,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo123 \n','::1','2022-08-02 09:47:22'),
(3,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: ondra.751 \n','::1','2022-08-02 09:47:31'),
(4,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-02 09:50:32'),
(5,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-02 10:47:40'),
(6,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-02 19:13:28'),
(7,1,'logout','','::1','2022-08-02 20:10:49'),
(8,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: ondra.751 \n','::1','2022-08-02 20:10:55'),
(9,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: ondra.751 \n','::1','2022-08-02 20:11:03'),
(10,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: ondra.759 \n','::1','2022-08-02 20:11:10'),
(11,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-02 20:11:16'),
(12,1,'logout','','::1','2022-08-02 21:11:56'),
(13,2,'login','Email: test@gmail.com','::1','2022-08-02 21:12:04'),
(14,2,'logout','','::1','2022-08-02 21:12:09'),
(15,2,'login','Email: test@gmail.com','::1','2022-08-02 21:12:46'),
(16,2,'logout','','::1','2022-08-02 21:12:54'),
(17,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo123 \n','::1','2022-08-02 21:13:01'),
(18,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-02 21:13:06'),
(19,1,'logout','','::1','2022-08-02 21:14:03'),
(20,2,'login','Email: test@gmail.com','::1','2022-08-02 21:14:08'),
(21,2,'logout','','::1','2022-08-02 21:22:57'),
(22,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo123 \n','::1','2022-08-02 21:23:04'),
(23,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-02 21:23:13'),
(24,1,'logout','','::1','2022-08-02 22:23:47'),
(25,2,'login','Email: test@gmail.com','::1','2022-08-02 22:23:55'),
(26,2,'logout','','::1','2022-08-02 22:25:53'),
(27,0,'fail','Email: test@gmail.com Password: pruega123 \n','::1','2022-08-02 22:26:00'),
(28,2,'login','Email: test@gmail.com','::1','2022-08-02 22:26:07'),
(29,2,'logout','','::1','2022-08-02 22:26:40'),
(30,2,'login','Email: test@gmail.com','::1','2022-08-02 22:26:47'),
(31,2,'logout','','::1','2022-08-02 22:28:10'),
(32,2,'login','Email: test@gmail.com','::1','2022-08-02 22:28:17'),
(33,2,'logout','','::1','2022-08-02 22:28:56'),
(34,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-02 22:29:02'),
(35,1,'logout','','::1','2022-08-02 22:42:30'),
(36,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-03 08:39:43'),
(37,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-03 11:43:37'),
(38,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-03 13:38:59'),
(39,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-03 13:43:58'),
(40,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-03 15:32:10'),
(41,1,'logout','','::1','2022-08-03 15:54:44'),
(42,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-03 15:55:08'),
(43,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-03 21:58:46'),
(44,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-04 11:58:59'),
(45,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-04 14:53:53'),
(46,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-04 16:34:04'),
(47,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-05 11:04:29'),
(48,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-05 11:58:41'),
(49,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2022-08-05 13:14:48'),
(50,3,'login','Email: albertogsalazar@gmail.com','201.253.109.30','2022-08-05 17:00:50'),
(51,3,'login','Email: albertogsalazar@gmail.com','186.141.197.213','2022-08-05 17:10:46'),
(52,3,'login','Email: albertogsalazar@gmail.com','186.141.197.213','2022-08-05 17:12:59'),
(53,2,'login','Email: test@gmail.com','170.231.205.52','2022-08-05 20:02:33'),
(54,2,'login','Email: test@gmail.com','181.105.154.28','2022-08-05 20:06:36'),
(55,2,'logout','','170.231.205.52','2022-08-05 20:08:03'),
(56,3,'login','Email: albertogsalazar@gmail.com','170.231.205.52','2022-08-05 20:08:08'),
(57,2,'login','Email: test@gmail.com','181.105.154.28','2022-08-08 12:03:26'),
(58,1,'login','Email: jeremiaspalazzesi@gmail.com','201.253.109.30','2022-08-11 16:53:02'),
(59,1,'login','Email: jeremiaspalazzesi@gmail.com','201.253.109.30','2022-08-12 09:19:26'),
(60,1,'login','Email: jeremiaspalazzesi@gmail.com','201.253.109.30','2022-08-24 13:52:04'),
(61,1,'login','Email: jeremiaspalazzesi@gmail.com','201.253.109.30','2022-08-24 14:52:48'),
(62,0,'fail','Email: jere Password: qZL!bqdWrtn*j583 \n','201.253.109.28','2025-08-13 13:17:23'),
(63,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo \n','::1','2025-08-18 11:03:39'),
(64,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo \n','::1','2025-08-18 11:03:40'),
(65,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo \n','::1','2025-08-18 11:03:41'),
(66,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2025-08-18 11:03:46'),
(67,1,'logout','','::1','2025-08-18 11:04:17'),
(68,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo \n','::1','2025-08-18 11:04:26'),
(69,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2025-08-18 11:04:30'),
(70,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo \n','::1','2025-08-18 14:26:49'),
(71,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo \n','::1','2025-08-18 14:26:54'),
(72,0,'fail','Email: jeremiaspalazzesi@gmail.com Password: josefo \n','::1','2025-08-18 14:26:56'),
(73,1,'login','Email: jeremiaspalazzesi@gmail.com','::1','2025-08-18 14:27:00');
/*!40000 ALTER TABLE `historia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horas`
--

DROP TABLE IF EXISTS `horas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `horas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `horas` double NOT NULL,
  `liquidado` int(11) NOT NULL DEFAULT 0,
  `liquidacion` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `horas_FK` (`persona_id`),
  CONSTRAINT `horas_FK` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horas`
--

LOCK TABLES `horas` WRITE;
/*!40000 ALTER TABLE `horas` DISABLE KEYS */;
INSERT INTO `horas` VALUES
(3,2,'Proyecto Ferretería',8.5,1,'63a9a4610de69df07963a3e4139055da','2022-08-02 20:46:46','2022-08-02 23:46:46'),
(4,2,'Proyecto Wordpress',10,1,'63a9a4610de69df07963a3e4139055da','2022-08-02 20:47:00','2022-08-02 23:47:00'),
(5,2,'Curso de React',5,1,'63a9a4610de69df07963a3e4139055da','2022-08-02 21:08:56','2022-08-03 00:08:56'),
(6,2,'Estudiar para Programación',3.5,1,'63a9a4610de69df07963a3e4139055da','2022-08-02 21:09:09','2022-08-03 00:09:09'),
(7,3,'Wordpress Tienda Mía',4,0,NULL,'2022-08-02 21:14:25','2022-08-03 00:14:25'),
(8,3,'Proyecto Manhattan',3,1,'5213c78729eb24c98fc656ea65adea56','2022-08-02 21:15:10','2022-08-03 00:15:10'),
(9,3,'Sistema de Compresores',2.5,1,'5213c78729eb24c98fc656ea65adea56','2022-08-02 21:17:01','2022-08-03 00:17:01'),
(10,3,'Proyecto constructora',8,1,'5213c78729eb24c98fc656ea65adea56','2022-08-05 20:07:25','2022-08-05 23:07:25'),
(11,2,'Prueba de liquidación',5,1,'b8fb9714200396c90d7e8a2226c13811','2022-08-24 14:01:35','2022-08-24 18:01:35');
/*!40000 ALTER TABLE `horas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `liquidacion`
--

DROP TABLE IF EXISTS `liquidacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `liquidacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liquidacion` varchar(100) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `trabajo_id` int(11) NOT NULL,
  `horas` double DEFAULT NULL,
  `valor` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `liquidacion_FK_1` (`persona_id`),
  KEY `liquidacion_FK` (`trabajo_id`),
  CONSTRAINT `liquidacion_FK` FOREIGN KEY (`trabajo_id`) REFERENCES `trabajos` (`id`),
  CONSTRAINT `liquidacion_FK_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `liquidacion`
--

LOCK TABLES `liquidacion` WRITE;
/*!40000 ALTER TABLE `liquidacion` DISABLE KEYS */;
INSERT INTO `liquidacion` VALUES
(3,'63a9a4610de69df07963a3e4139055da',2,2,27,70216.2,'2022-08-05 14:44:59','2022-08-05 17:44:59'),
(4,'5213c78729eb24c98fc656ea65adea56',3,1,13.5,20925,'2022-08-05 20:14:34','2022-08-05 23:14:34'),
(5,'b8fb9714200396c90d7e8a2226c13811',2,2,5,13003,'2022-08-24 14:02:02','2022-08-24 18:02:02');
/*!40000 ALTER TABLE `liquidacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos_realizados`
--

DROP TABLE IF EXISTS `pagos_realizados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos_realizados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programacion_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `cuit` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `monto` double NOT NULL,
  `comprobante` varchar(100) NOT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `pagos_realizados_FK` (`empresa_id`) USING BTREE,
  KEY `pagos_realizados_FK_1` (`persona_id`) USING BTREE,
  KEY `pagos_realizados_FK_2` (`programacion_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos_realizados`
--

LOCK TABLES `pagos_realizados` WRITE;
/*!40000 ALTER TABLE `pagos_realizados` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagos_realizados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `personas_UN` (`email`,`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES
(1,'Gustavo','Salazar','26380441','3413509672','albertogsalazar@gmail.com','1977-02-02','2022-08-02 12:33:51','2022-08-02 15:33:51'),
(2,'Jeremías','Palazzesi','29481183','3416443884','jeremiaspalazzesi@gmail.com','1982-07-03','2022-08-02 12:53:40','2022-08-02 15:53:40'),
(3,'Test','Alonso','88888888','3418888888','test@gmail.com','1982-07-01','2022-08-02 21:13:41','2022-08-03 00:13:41');
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programacion`
--

DROP TABLE IF EXISTS `programacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `programacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `monto` double NOT NULL,
  `tipo_pago` varchar(100) NOT NULL,
  `dia_pago` int(11) NOT NULL,
  `mes_pago` int(11) DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `ultimo_pago` date DEFAULT NULL,
  `habilitado` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `programacion_FK` (`empresa_id`) USING BTREE,
  KEY `programacion_FK_1` (`persona_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programacion`
--

LOCK TABLES `programacion` WRITE;
/*!40000 ALTER TABLE `programacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `programacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `proveedores_FK` (`empresa_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabajos`
--

DROP TABLE IF EXISTS `trabajos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trabajos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trabajo` varchar(100) NOT NULL,
  `valor` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajos`
--

LOCK TABLES `trabajos` WRITE;
/*!40000 ALTER TABLE `trabajos` DISABLE KEYS */;
INSERT INTO `trabajos` VALUES
(1,'Programación',1550),
(2,'Tecnicos',2600.6),
(3,'Wordpress',1500);
/*!40000 ALTER TABLE `trabajos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(100) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `pk_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES
(1,'Jeremías','Palazzesi','jeremiaspalazzesi@gmail.com','442c8c0b7b693109a682a13f75f0de1e','admin',NULL,'3416443884','2022-08-02 12:50:20'),
(2,'Test','Alonso','test@gmail.com','fa5a02c9cc183b3ff1bfcd4c2243f85c','user',NULL,'3416888888','2022-08-03 00:11:51'),
(3,'Gustavo','Salazar','albertogsalazar@gmail.com','44cf99f19f3546e3e69039f2d5a66d11','admin',NULL,'3413509672','2022-08-05 19:59:15');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vpn_events`
--

DROP TABLE IF EXISTS `vpn_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `vpn_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `connect_time` timestamp NULL DEFAULT NULL,
  `event_type` enum('up','down') NOT NULL,
  `user` varchar(128) NOT NULL,
  `service` varchar(32) NOT NULL,
  `interface` varchar(64) NOT NULL,
  `caller_id` varchar(128) DEFAULT NULL,
  `remote_addr` varchar(64) DEFAULT NULL,
  `local_addr` varchar(64) DEFAULT NULL,
  `uptime_sec` int(10) unsigned DEFAULT NULL,
  `router_id` varchar(64) NOT NULL,
  `session_key` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_last_down` (`event_time`,`user`,`interface`,`event_type`),
  UNIQUE KEY `uniq_session_key` (`session_key`),
  KEY `idx_user_time` (`user`,`event_time`),
  KEY `idx_router_time` (`router_id`,`event_time`),
  KEY `idx_iface_time` (`interface`,`event_time`),
  KEY `idx_user_connect` (`user`,`connect_time`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vpn_events`
--

LOCK TABLES `vpn_events` WRITE;
/*!40000 ALTER TABLE `vpn_events` DISABLE KEYS */;
INSERT INTO `vpn_events` VALUES
(1,'2025-08-18 16:44:44','2025-08-18 16:44:44','down','jere','','*f00003','192.168.122.1','10.10.10.250','10.10.10.1',NULL,'R1Test',NULL),
(2,'2025-08-18 16:44:45','2025-08-18 16:44:45','up','jere','','*f00003','192.168.122.1','10.10.10.250','10.10.10.1',NULL,'R1Test',NULL);
/*!40000 ALTER TABLE `vpn_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vpn_sessions`
--

DROP TABLE IF EXISTS `vpn_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `vpn_sessions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_key` varchar(128) NOT NULL,
  `user` varchar(128) NOT NULL,
  `service` varchar(32) NOT NULL,
  `interface` varchar(64) NOT NULL,
  `router_id` varchar(64) NOT NULL,
  `caller_id` varchar(128) DEFAULT NULL,
  `remote_addr` varchar(64) DEFAULT NULL,
  `local_addr` varchar(64) DEFAULT NULL,
  `start_time` timestamp NOT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `duration_sec` int(10) unsigned DEFAULT NULL,
  `last_event` enum('up','down') NOT NULL DEFAULT 'up',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_key` (`session_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vpn_sessions`
--

LOCK TABLES `vpn_sessions` WRITE;
/*!40000 ALTER TABLE `vpn_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `vpn_sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-08-18 15:07:30
