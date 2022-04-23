-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: jumpman
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `payment_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `size` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_id_idx` (`payment_id`),
  KEY `prod_id_idx` (`product_id`),
  CONSTRAINT `pay_id` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prod_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (1,5,7,1,41),(2,5,11,1,39),(3,5,16,1,45),(4,6,12,2,43),(5,7,3,1,41),(6,7,11,1,45),(7,7,14,1,45),(8,8,6,2,40),(9,8,1,1,45),(10,9,1,1,45),(11,10,4,1,45),(12,10,6,1,45),(13,10,11,1,45),(14,11,5,2,45),(15,11,10,1,39),(16,11,2,3,39),(17,12,1,7,45),(18,13,9,3,38),(19,13,13,2,38),(20,13,12,2,38),(21,13,15,2,38),(22,14,13,2,45),(23,10,16,1,45),(24,15,10,10,44),(25,16,20,1,45),(26,16,22,1,45),(27,16,25,1,45),(28,16,24,1,45),(29,16,27,1,45),(30,16,29,1,45),(31,16,28,1,45),(32,16,35,1,45),(33,16,32,1,45),(34,17,33,2,45),(35,17,31,2,45),(36,17,25,3,45),(37,17,24,2,45),(38,18,23,2,45),(39,18,30,1,45),(40,18,24,2,45),(41,18,33,1,45),(42,18,25,2,45),(43,19,34,2,45),(44,20,29,1,43),(45,20,26,2,43),(46,20,23,2,43),(47,20,27,2,43),(48,20,34,1,43),(49,20,31,2,43),(50,21,23,1,37),(51,21,22,1,39),(52,21,27,2,39),(53,21,31,1,39),(54,21,34,1,39),(55,21,35,1,39),(56,21,25,2,39),(57,21,20,1,39),(58,22,26,1,45),(59,22,20,1,45),(60,22,27,1,45),(61,22,8,1,45),(62,22,3,1,45),(63,22,32,1,45),(64,23,30,1,45),(65,24,21,1,43),(66,24,25,2,43),(67,24,20,1,43),(68,24,22,1,43),(69,24,32,1,43),(70,24,33,1,43),(71,24,27,2,43),(72,24,31,1,43),(73,25,11,1,45),(74,25,6,1,45),(75,25,22,1,45),(76,25,34,1,45),(77,26,21,1,45),(78,26,28,1,45),(79,26,20,2,45),(80,26,5,1,45),(81,26,35,1,45),(82,26,6,1,45),(83,26,25,1,45),(84,26,22,1,45),(85,26,31,1,45),(86,27,27,1,39),(87,27,6,1,39),(88,28,26,2,45);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-16 22:19:14
