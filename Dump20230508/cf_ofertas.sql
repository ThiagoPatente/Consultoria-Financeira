-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: cf
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ofertas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` bigint unsigned NOT NULL,
  `instituicaoFinanceira` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modalidadeCredito` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valorAPagar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valorSolicitado` int NOT NULL,
  `taxaJuros` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qntParcelas` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ofertas_cliente_id_foreign` (`cliente_id`),
  CONSTRAINT `ofertas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ofertas`
--

LOCK TABLES `ofertas` WRITE;
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
INSERT INTO `ofertas` VALUES (1,2,'Financeira Assert','crédito pessoal','R$:4.612,68',3000,'3.65%',12,'2023-05-08 18:12:33','2023-05-08 18:12:33'),(2,2,'Banco PingApp','crédito consignado','R$:13.251,72',10000,'1.18%',24,'2023-05-08 18:12:33','2023-05-08 18:12:33'),(3,2,'Banco PingApp','crédito pessoal','R$:8.928,11',5000,'4.95%',12,'2023-05-08 18:12:33','2023-05-08 18:12:33'),(4,3,'Financeira Assert','Saque FGTS','R$:1.028,80',500,'4.09%',18,'2023-05-08 19:58:01','2023-05-08 19:58:01'),(5,3,'Banco ATR SA','crédito pessoal','R$:8.181,95',5140,'3.95%',12,'2023-05-08 19:58:01','2023-05-08 19:58:01'),(6,3,'Financeira Assert','crédito pessoal','R$:19.285,99',8000,'5.01%',18,'2023-05-08 19:58:01','2023-05-08 19:58:01'),(7,6,'Banco ATR SA','crédito consignado','R$:13.869,96',12236,'1.05%',12,'2023-05-08 20:48:44','2023-05-08 20:48:44'),(8,6,'Banco PingApp','crédito pessoal','R$:14.821,27',12000,'1.18%',18,'2023-05-08 20:48:44','2023-05-08 20:48:44'),(9,6,'Banco PingApp','Saque FGTS','R$:23.603,11',15000,'3.85%',12,'2023-05-08 20:48:44','2023-05-08 20:48:44');
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-08 16:02:02
