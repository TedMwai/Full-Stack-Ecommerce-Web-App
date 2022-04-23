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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `telephone` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin@gmail.com','$2y$10$uuK1kg/Hvw1ZD4vfQw/JpOfwlkaN4hzYlntEzBFuNlPdDnOx2A..K','admin','admin','0712345678','2022-03-02 00:00:00'),(2,'teddymwai11@gmail.com','$2y$10$AnXbrsQ1UOZErpypVqFLDeOjqRUg14hcbKPI/0U1jHF193jCJ6vbO','Teddy','Mwai','0726475010','2022-03-02 00:00:00'),(3,'lindalels32@gmail.com','$2y$10$jMnjL.bxRhN7v.7E5kJAs.QqO27W7uPg4ivcgmbeWHjbRyD4BhN6C','Linda','Nyambura','0721288774','2022-03-04 00:00:00'),(4,'davidkilolo@gmail.com','$2y$10$gV9K0NcJULizC6Lfuz.tyutNLC6..57f/IrGqbmOHMKSJyQmZWGJy','David','Kilolo','0717793453','2022-03-04 00:00:00'),(7,'cliffezra@gmail.com','$2y$10$iR1gTRXE38o06WPFiDP1AeKehQfI/Y/ORO4zNeOMX6JpUjhzGGAGi','Cliff','Ezra','0715078401','2022-03-04 00:00:00'),(8,'sydneynzunguli@gmail.com','$2y$10$j3NhZQ8PKt.sLNSY/JAI3e8pjv95w/hh9y3NBGtwwh4VXGNKzHrkW','Sydney','Nzunguli','0797048454','2022-03-09 00:00:00'),(9,'trevortoni@gmail.com','$2y$10$Z0w121x9cQnnGVHXjZ4OfusF4CW3Bmm.ef4x79yzQz2ggEHCNpAZ.','Trevor','Toni','0757385501','2022-03-11 00:00:00'),(10,'johndoe@gmail.com','$2y$10$uuK1kg/Hvw1ZD4vfQw/JpOfwlkaN4hzYlntEzBFuNlPdDnOx2A..K','john','doe','0712345678','2022-03-22 00:00:00'),(11,'austinongwae@gmail.com','$2y$10$aBvIV09UVjZ.IB935SB2k.quAIAxaaKCXBXKNnp1TwShOUlhFcDjO','Austin','Ongwae','0701606299','2022-03-23 00:00:00'),(12,'chrystalnjuguna@gmail.com','$2y$10$B1C8ZGV0vARV/q88W.7GX.ZgyglJR2FtW/n00PEaRl1/GY2/hP9Ca','Chrystal','Njuguna','0792487278','2022-04-06 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
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
