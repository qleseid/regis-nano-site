-- MySQL dump 10.13  Distrib 8.0.18, for Linux (x86_64)
--
-- Host: localhost    Database: nanousers
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `boxes`
--

DROP TABLE IF EXISTS `boxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `boxes` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `owner_id` int(16) NOT NULL,
  `title` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filePath` varchar(4096) DEFAULT NULL,
  `description` varchar(8192) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `local_id` (`owner_id`),
  CONSTRAINT `boxes_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boxes`
--

LOCK TABLES `boxes` WRITE;
/*!40000 ALTER TABLE `boxes` DISABLE KEYS */;
INSERT INTO `boxes` VALUES (5,4,'Bacon is Greater!','/home/gangsta/Pictures/uploads/2019-12-15T12:13:35-07:00bin3.jpeg','Lots of great bacon!!                     '),(6,4,'Now Chocolate','/home/gangsta/Pictures/uploads/2019-12-15T12:14:19-07:00bin4.jpeg','I love the dark brown stuff!                     '),(7,4,'Bin #3','/home/gangsta/Pictures/uploads/2019-12-15T18:05:46-07:00bin2.jpeg','School books covering computer languages and design theory.                     ');
/*!40000 ALTER TABLE `boxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `owner_id` int(16) NOT NULL,
  `title` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filePath` varchar(4096) DEFAULT NULL,
  `description` varchar(8192) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `boxes_id` (`owner_id`),
  CONSTRAINT `items_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `boxes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,6,'Brown Hat','/home/gangsta/Pictures/uploads/2019-12-15T12:16:25-07:00hat.jpg','The hat is from Tona\'s, the sushi joint.                     '),(2,6,'Post-its','/home/gangsta/Pictures/uploads/2019-12-15T18:06:28-07:00postit.jpg','Multi-colored note packets                     ');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `owner_id` int(16) NOT NULL,
  `title` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filePath` varchar(4096) DEFAULT NULL,
  `description` varchar(8192) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`owner_id`),
  CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (4,10,'dfgdfgb','/home/gangsta/Pictures/uploads/2019-12-15T11:40:29-07:00location5.jpeg',' vfbxcfv'),(5,10,'dfgdfgb','/home/gangsta/Pictures/uploads/2019-12-15T11:48:16-07:00location5.jpeg','                     vfbxcfv'),(6,10,'Bacon is my friend.','/home/gangsta/Pictures/uploads/2019-12-15T11:50:55-07:00location4.jpeg','I love lots of bacon! Give me that bacon.                     '),(7,10,'Some Bins','/home/gangsta/Pictures/uploads/2019-12-15T18:04:18-07:00location3.jpeg','This is a bin which holds a bunch of bolts and stuff.                     '),(8,10,'The trailer','/home/gangsta/Pictures/uploads/2019-12-15T18:36:26-07:00location.jpeg','The blue semi trailer                     '),(9,10,'Garage','/home/gangsta/Pictures/uploads/2019-12-16T00:36:42-07:008cd99b09be500d848c088179d9a9fd52.jpg',' The garage is the best place to be to store stuff.                    '),(10,10,'Backyard','/home/gangsta/Pictures/uploads/2019-12-16T00:38:31-07:00c4bc2d70e3380b592f94ea6875372776.jpg','The backyard of the Las Tunnis house.                      '),(11,10,'GIF','/home/gangsta/Pictures/uploads/2019-12-16T00:43:14-07:00download.jpeg','Test a gif                     ');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'dog','thatsright@gmail.com','$2y$10$xjg2i4WlqvHUxetwyPtuLeeVgvtKbQfbsLw9/RO4f0kFHonKhfdSC'),(11,'CAT','catdog@gmail.com','$2y$10$06LEGgs8yAPfINVteSm7b.E5N6LW9HJXX2rhQdEmqF0cohujoX/QS'),(12,'student','getforfree@gmail.com','$2y$10$kmwlOH4jaDEz0OnT7Y.UOu3hY6wWjGWIg61Xr2lMndotKuBDjidHu');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-16  1:51:14
