-- MySQL dump 10.13  Distrib 8.4.7, for Win64 (x86_64)
--
-- Host: localhost    Database: traveldb
-- ------------------------------------------------------
-- Server version	8.4.7

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
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `about` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h5` varchar(255) DEFAULT NULL,
  `h2` varchar(255) DEFAULT NULL,
  `para` text,
  `img` varchar(255) DEFAULT NULL,
  `head1` varchar(255) DEFAULT NULL,
  `paragraph` text,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about`
--

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT INTO `about` VALUES (1,'OUR STORY','We provide the best guidance','We started with a simple passion: to make travel accessible, enjoyable, and meaningful. Our team works hard to create itineraries that let you connect with local cultures and nature.','img/team-member1.jpg','John Doe','CEO & Founder','2026-08-03'),(2,'','','','img/team-member2.jpg','Jane Smith','Travel Agent Specialist','2026-08-03'),(3,'','','','img/team-member3.jpg','Mike Johnson','Tour Guide Manager','2026-08-03');
/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h3` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Mobile Number','+1 234 567 890','2026-08-03'),(2,'Email Address','info@travelwithme.com','2026-08-03'),(3,'Office Address','123 Adventure Way, Jakarta, Indonesia','2026-08-03');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `culture`
--

DROP TABLE IF EXISTS `culture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `culture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h5` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `para` text COLLATE utf8mb4_general_ci,
  `btn` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `culture`
--

LOCK TABLES `culture` WRITE;
/*!40000 ALTER TABLE `culture` DISABLE KEYS */;
INSERT INTO `culture` VALUES (1,'INDONESIAN CULTURE','Our culture here is very friendly to people','Indonesian culture is a colorful tapestry of diverse traditions, beliefs, arts, and cuisines. Across thousands of islands, you will find warm hospitality, smiling faces, and rich community celebrations that welcome visitors like family.','Read More','img/pic10.jpg','2026-08-03');
/*!40000 ALTER TABLE `culture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feature`
--

DROP TABLE IF EXISTS `feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feature` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h4` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feature`
--

LOCK TABLES `feature` WRITE;
/*!40000 ALTER TABLE `feature` DISABLE KEYS */;
INSERT INTO `feature` VALUES (1,'img/pic2.jpg','Ski Tours','2026-08-03'),(2,'img/pic3.jpg','Desert Tours','2026-08-03'),(3,'img/pic4.jpg','Beach Tours','2026-08-03'),(4,'img/pic5.jpg','Mountain Tours','2026-08-03'),(5,'img/WhatsApp Image 2026-02-19 at 22.49.11.jpeg','Mangrov','2026-08-03');
/*!40000 ALTER TABLE `feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holiday`
--

DROP TABLE IF EXISTS `holiday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `holiday` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h5` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `para` text COLLATE utf8mb4_general_ci,
  `btn` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holiday`
--

LOCK TABLES `holiday` WRITE;
/*!40000 ALTER TABLE `holiday` DISABLE KEYS */;
INSERT INTO `holiday` VALUES (1,'img/pic6.jpg','EAST NUSA TENGGARA','Have You Enjoyed your Holidays?','Discover breathtaking landscapes, clean beaches, and unique wildlife in East Nusa Tenggara. Experience world-class hospitality, custom tour paths, and guided cultural tours designed for travelers seeking a deep adventure.','Read More','2026-08-03');
/*!40000 ALTER TABLE `holiday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home`
--

DROP TABLE IF EXISTS `home`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `home` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h5` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h1` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `para` text COLLATE utf8mb4_general_ci,
  `btn` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home`
--

LOCK TABLES `home` WRITE;
/*!40000 ALTER TABLE `home` DISABLE KEYS */;
INSERT INTO `home` VALUES (1,'LET\'S GO','Planning Your<br>Own Travel','Explore the world with us. We offer customized tour packages, guided trips, and exceptional services to make your holidays memorable and stress-free.','Book a Trip','2026-08-03');
/*!40000 ALTER TABLE `home` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inquiries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL DEFAULT 'Inquiry',
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `tour_name` varchar(255) DEFAULT NULL,
  `travelers` int DEFAULT '1',
  `travel_date` varchar(50) DEFAULT NULL,
  `message` text,
  `status` varchar(50) NOT NULL DEFAULT 'New',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquiries`
--

LOCK TABLES `inquiries` WRITE;
/*!40000 ALTER TABLE `inquiries` DISABLE KEYS */;
INSERT INTO `inquiries` VALUES (1,'Tour Booking','Automated Tester 1792223266','tester_1792223266@example.com','+1 555 987 6543','Alpine Discovery Tour',2,'2026-12-25','Need luxury cabin','Confirmed','2026-10-17 13:17:46'),(2,'Contact Message','Elena Rostova','elena@travelworld.com','+1 555 777 8899','Corporate / Group Travel',1,'','Looking for a private guided tour in the mountains for our honeymoon.','Confirmed','2026-10-17 15:34:19'),(3,'Tour Booking','Marcus Vance','marcus@vance.org','+15553334444','Mount Bromo',2,'2026-11-20','Window seats and vegetarian breakfast please.','New','2026-10-17 15:50:02');
/*!40000 ALTER TABLE `inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `menu_parent` int DEFAULT '0',
  `menu_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `menu_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `menu_order` int DEFAULT '0',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Home',0,'header','index.php',1,'2026-08-03'),(2,'Services',0,'header','service.php',2,'2026-08-03'),(3,'About Us',0,'header','about.php',3,'2026-08-03'),(4,'Contact Us',0,'header','contact.php',4,'2026-08-03');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_heading` varchar(255) DEFAULT NULL,
  `service_info` text,
  `img` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `service_desc` text,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'What We Offer','Our services are designed to give you the ultimate travel experience from start to finish.','img/service1.jpg','Flight Booking','Compare and book flights to destinations around the world at the best rates.','2026-08-03'),(2,'','','img/service2.jpg','Hotel Booking','Find luxury hotels, resorts, and budget-friendly stays curated for your comfort.','2026-08-03'),(3,'','','img/service3.jpg','Travel Guides','Experience cultures with local certified guides showing you the sights.','2026-08-03');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour`
--

DROP TABLE IF EXISTS `tour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h6` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h4` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `btn` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour`
--

LOCK TABLES `tour` WRITE;
/*!40000 ALTER TABLE `tour` DISABLE KEYS */;
INSERT INTO `tour` VALUES (1,'img/pic7.jpg','East Java','Mount Bromo','Popular Tours','See Tours','2026-08-03'),(2,'img/pic8.jpg','Bali','Ubud Temple','Popular Tours','See Tours','2026-08-03'),(3,'img/pic9.jpg','Komodo Island','Pink Beach','Popular Tours','See Tours','2026-08-03');
/*!40000 ALTER TABLE `tour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin');
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

-- Dump completed on 2026-10-17 16:39:10
