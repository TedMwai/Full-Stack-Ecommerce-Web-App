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
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_image` (
  `product_image_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `product_slug` varchar(60) NOT NULL,
  `image` varchar(45) NOT NULL,
  PRIMARY KEY (`product_image_id`),
  KEY `product-id_idx` (`product_id`),
  CONSTRAINT `product-id` FOREIGN KEY (`product_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_image`
--

LOCK TABLES `product_image` WRITE;
/*!40000 ALTER TABLE `product_image` DISABLE KEYS */;
INSERT INTO `product_image` VALUES (1,1,'jordan-1-mid-se','jordan 1 mid se-1.jfif'),(2,1,'jordan-1-mid-se','jordan 1 mid se-2.jfif'),(3,1,'jordan-1-mid-se','jordan 1 mid se-3.jfif'),(4,1,'jordan-1-mid-se','jordan 1 mid se-4.jfif'),(5,2,'jordan-1-summer','jordan pink-1.jfif'),(6,2,'jordan-1-summer','jordan pink-2.jfif'),(7,2,'jordan-1-summer','jordan pink-3.jfif'),(8,2,'jordan-1-summer','jordan pink-4.jfif'),(9,3,'jordan-series-es','jordan series es-1.jfif'),(10,3,'jordan-series-es','jordan series es-2.jfif'),(11,3,'jordan-series-es','jordan series es-3.jfif'),(12,3,'jordan-series-es','jordan series es-4.jfif'),(13,4,'jordan-zoom-separate','jordan zoom separate-1.jfif'),(14,4,'jordan-zoom-separate','jordan zoom separate-2.jfif'),(15,4,'jordan-zoom-separate','jordan zoom separate-3.jfif'),(16,4,'jordan-zoom-separate','jordan zoom separate-4.jfif'),(17,5,'nike-air-lv8','nike-air-lv8-1.jfif'),(18,5,'nike-air-lv8','nike-air-lv8-2.png'),(19,5,'nike-air-lv8','nike-air-lv8-3.png'),(20,5,'nike-air-lv8','nike-air-lv8-4.png'),(21,6,'air-zoom-pegasus','air-zoom-pegasus.jfif'),(22,6,'air-zoom-pegasus','air-zoom-pegasus-2.png'),(23,6,'air-zoom-pegasus','air-zoom-pegasus-3.png'),(24,6,'air-zoom-pegasus','air-zoom-pegasus-4.png'),(25,7,'air-zoom-gt-1','air-zoom-gt-1.jfif'),(26,7,'air-zoom-gt-1','air-zoom-gt-2.png'),(27,7,'air-zoom-gt-1','air-zoom-gt-3.png'),(28,7,'air-zoom-gt-1','air-zoom-gt-4.png'),(29,8,'nike-air-mid-7','air-mid7-1.jfif'),(30,8,'nike-air-mid-7','air-mid7-2.png'),(31,8,'nike-air-mid-7','air-mid7-3.png'),(32,8,'nike-air-mid-7','air-mid7-4.png'),(33,9,'adidas-ultraboost','adidas-ultraboost-1.jpg'),(34,9,'adidas-ultraboost','adidas-ultraboost-2.jpg'),(35,9,'adidas-ultraboost','adidas-ultraboost-3.jpg'),(36,9,'adidas-ultraboost','adidas-ultraboost-4.jpg'),(37,10,'adidas-nmd','nmd-1.jpg'),(38,10,'adidas-nmd','nmd-2.jpg'),(39,10,'adidas-nmd','nmd-3.jpg'),(40,10,'adidas-nmd','nmd-4.jpg'),(41,11,'adidas-kaptir','kaptir-1.jpg'),(42,11,'adidas-kaptir','kaptir-2.jpg'),(43,11,'adidas-kaptir','kaptir-3.jpg'),(44,11,'adidas-kaptir','kaptir-4.jpg'),(45,12,'adidas-stansmith','stan-smith-1.jpg'),(46,12,'adidas-stansmith','stan-smith-2.jpg'),(47,12,'adidas-stansmith','stan-smith-3.jpg'),(48,12,'adidas-stansmith','stan-smith-4.jpg'),(49,13,'puma-amg','puma-amg-1.png'),(50,13,'puma-amg','puma-amg-2.png'),(51,13,'puma-amg','puma-amg-3.png'),(52,13,'puma-amg','puma-amg-4.png'),(53,14,'puma-future','puma-future-1.png'),(54,14,'puma-future','puma-future-2.png'),(55,14,'puma-future','puma-future-3.png'),(56,14,'puma-future','puma-future-4.png'),(57,15,'puma-x-neymar','puma-neymar-1.png'),(58,15,'puma-x-neymar','puma-neymar-2.png'),(59,15,'puma-x-neymar','puma-neymar-3.png'),(60,15,'puma-x-neymar','puma-neymar-4.png'),(61,16,'puma-nitro','puma-nitro-1.png'),(62,16,'puma-nitro','puma-nitro-2.png'),(63,16,'puma-nitro','puma-nitro-3.png'),(64,16,'puma-nitro','puma-nitro-4.png'),(65,20,'air-jordan-3-retro-se','jordan-3-muslin-1.jpg'),(66,20,'air-jordan-3-retro-se','jordan-3-muslin-2.jpg'),(67,20,'air-jordan-3-retro-se','jordan-3-muslin-3.jpg'),(68,20,'air-jordan-3-retro-se','jordan-3-muslin-4.jpg'),(69,21,'air-jordan-1-high-85-college-navy','jordan-1-high-college-navy-1.jpg'),(70,21,'air-jordan-1-high-85-college-navy','jordan-1-high-college-navy-2.jpg'),(71,21,'air-jordan-1-high-85-college-navy','jordan-1-high-college-navy-3.jpg'),(72,21,'air-jordan-1-high-85-college-navy','jordan-1-high-college-navy-4.jpg'),(73,22,'air-jordan-1-mid-se','jordan-1-mid-se-og-1.jpg'),(74,22,'air-jordan-1-mid-se','jordan-1-mid-se-og-2.jpg'),(75,22,'air-jordan-1-mid-se','jordan-1-mid-se-og-3.jpg'),(76,22,'air-jordan-1-mid-se','jordan-1-mid-se-og-4.jpg'),(77,23,'air-jordan-xxxvi','air-jordan-xxxvi-1.jpg'),(78,23,'air-jordan-xxxvi','air-jordan-xxxvi-2.jpg'),(79,23,'air-jordan-xxxvi','air-jordan-xxxvi-3.jpg'),(80,23,'air-jordan-xxxvi','air-jordan-xxxvi-4.jpg'),(81,24,'nike-air-trainer-sc-high','nike-air-trainer-sc-high-1.jpg'),(82,24,'nike-air-trainer-sc-high','nike-air-trainer-sc-high-2.jpg'),(83,24,'nike-air-trainer-sc-high','nike-air-trainer-sc-high-3.jpg'),(84,24,'nike-air-trainer-sc-high','nike-air-trainer-sc-high-4.jpg'),(85,25,'air-force-1-off-noir','air-force-off-noir-1.jpg'),(86,25,'air-force-1-off-noir','air-force-off-noir-2.jpg'),(87,25,'air-force-1-off-noir','air-force-off-noir-3.jpg'),(88,25,'air-force-1-off-noir','air-force-off-noir-4.jpg'),(89,26,'nike-air-max-270','nike-air-max-270-1.jpg'),(90,26,'nike-air-max-270','nike-air-max-270-2.jpg'),(91,26,'nike-air-max-270','nike-air-max-270-3.jpg'),(92,26,'nike-air-max-270','nike-air-max-270-4.jpg'),(93,27,'nike-react-phantom-run-flyknit-2','nike-react-phantom-1.jpg'),(94,27,'nike-react-phantom-run-flyknit-2','nike-react-phantom-2.jpg'),(95,27,'nike-react-phantom-run-flyknit-2','nike-react-phantom-3.jpg'),(96,27,'nike-react-phantom-run-flyknit-2','nike-react-phantom-4.jpg'),(97,28,'racer-tr21-shoes','racer-tr21-1.jpg'),(98,28,'racer-tr21-shoes','racer-tr21-2.jpg'),(99,28,'racer-tr21-shoes','racer-tr21-3.jpg'),(100,28,'racer-tr21-shoes','racer-tr21-4.jpg'),(101,29,'duramo-sl-2.0-shoes','duramo-sl-1.jpg'),(102,29,'duramo-sl-2.0-shoes','duramo-sl-2.jpg'),(103,29,'duramo-sl-2.0-shoes','duramo-sl-3.jpg'),(104,29,'duramo-sl-2.0-shoes','duramo-sl-4.jpg'),(105,30,'nmd-r1-shoes','nmd-r1-1.jpg'),(106,30,'nmd-r1-shoes','nmd-r1-2.jpg'),(107,30,'nmd-r1-shoes','nmd-r1-3.jpg'),(108,30,'nmd-r1-shoes','nmd-r1-4.jpg'),(109,31,'trae-young-1-shoes','trae-young-1.jpg'),(110,31,'trae-young-1-shoes','trae-young-2.jpg'),(111,31,'trae-young-1-shoes','trae-young-3.jpg'),(112,31,'trae-young-1-shoes','trae-young-4.jpg'),(145,32,'puma-slipstream-mutation','puma-slipstream-mutation-1.jpg'),(146,32,'puma-slipstream-mutation','puma-slipstream-mutation-2.jpg'),(147,32,'puma-slipstream-mutation','puma-slipstream-mutation-3.jpg'),(148,32,'puma-slipstream-mutation','puma-slipstream-mutation-4.jpg'),(149,33,'puma-mirage-mox-sneakers','puma-mirage-mox-1.jpg'),(150,33,'puma-mirage-mox-sneakers','puma-mirage-mox-2.jpg'),(151,33,'puma-mirage-mox-sneakers','puma-mirage-mox-3.jpg'),(152,33,'puma-mirage-mox-sneakers','puma-mirage-mox-4.jpg'),(153,34,'puma-rs-x-toys-sneakers','puma-rs-x-toys-1.jpg'),(154,34,'puma-rs-x-toys-sneakers','puma-rs-x-toys-2.jpg'),(155,34,'puma-rs-x-toys-sneakers','puma-rs-x-toys-3.jpg'),(156,34,'puma-rs-x-toys-sneakers','puma-rs-x-toys-4.jpg'),(157,35,'puma-ca-pro-classic-sneakers','puma-ca-pro-classic-1.jpg'),(158,35,'puma-ca-pro-classic-sneakers','puma-ca-pro-classic-2.jpg'),(159,35,'puma-ca-pro-classic-sneakers','puma-ca-pro-classic-3.jpg'),(160,35,'puma-ca-pro-classic-sneakers','puma-ca-pro-classic-4.jpg');
/*!40000 ALTER TABLE `product_image` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-16 22:19:15
