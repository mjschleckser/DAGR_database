-- MySQL dump 10.16  Distrib 10.1.19-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.19-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` varchar(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES ('09EB7096-0C73-40BE-9661-BA9D69969156','New Category 2'),('1BAD05B2-2116-401C-B81C-B86E269C648A','New Category'),('48C68086-3ECD-46BD-8FE5-A0B85D7FE6A4','tag_2'),('BE7674F3-F56F-4301-9835-CE4D0E70FF3E','tag_1');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `children`
--

DROP TABLE IF EXISTS `children`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `children` (
  `parent_id` varchar(36) NOT NULL,
  `child_id` varchar(36) NOT NULL,
  KEY `parent_id` (`parent_id`),
  KEY `fk_grade_id` (`child_id`),
  CONSTRAINT `children_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `dagr` (`id`),
  CONSTRAINT `children_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `dagr` (`id`),
  CONSTRAINT `fk_grade_id` FOREIGN KEY (`child_id`) REFERENCES `dagr` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `children`
--

LOCK TABLES `children` WRITE;
/*!40000 ALTER TABLE `children` DISABLE KEYS */;
INSERT INTO `children` VALUES ('3270C5C5-F589-4BA2-820B-6EBD0DD4C85E','EE21CDAF-6845-4135-AD4C-FAF45300AF04'),('FCBB1E3B-07BD-4451-8B25-83C14D7B0707','3270C5C5-F589-4BA2-820B-6EBD0DD4C85E');
/*!40000 ALTER TABLE `children` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dagr`
--

DROP TABLE IF EXISTS `dagr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dagr` (
  `id` varchar(36) NOT NULL,
  `name` varchar(260) NOT NULL,
  `path` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dagr`
--

LOCK TABLES `dagr` WRITE;
/*!40000 ALTER TABLE `dagr` DISABLE KEYS */;
INSERT INTO `dagr` VALUES ('3270C5C5-F589-4BA2-820B-6EBD0DD4C85E','Image File',''),('7532A82F-E3E2-4E1D-9D7F-9B23E1831B06','Google','http://www.google.com'),('E9969B82-E2CB-4012-9675-754E58B5629E','Test Image File',''),('EE21CDAF-6845-4135-AD4C-FAF45300AF04','Child Name',''),('FCBB1E3B-07BD-4451-8B25-83C14D7B0707','Parent Name','');
/*!40000 ALTER TABLE `dagr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dagr_to_categories`
--

DROP TABLE IF EXISTS `dagr_to_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dagr_to_categories` (
  `dagr_id` varchar(36) NOT NULL,
  `category_id` varchar(36) DEFAULT NULL,
  KEY `dagr_id` (`dagr_id`),
  KEY `tag_id` (`category_id`),
  CONSTRAINT `dagr_to_categories_ibfk_1` FOREIGN KEY (`dagr_id`) REFERENCES `dagr` (`id`),
  CONSTRAINT `dagr_to_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dagr_to_categories`
--

LOCK TABLES `dagr_to_categories` WRITE;
/*!40000 ALTER TABLE `dagr_to_categories` DISABLE KEYS */;
INSERT INTO `dagr_to_categories` VALUES ('3270C5C5-F589-4BA2-820B-6EBD0DD4C85E','BE7674F3-F56F-4301-9835-CE4D0E70FF3E'),('EE21CDAF-6845-4135-AD4C-FAF45300AF04','BE7674F3-F56F-4301-9835-CE4D0E70FF3E');
/*!40000 ALTER TABLE `dagr_to_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metadata`
--

DROP TABLE IF EXISTS `metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metadata` (
  `dagr_id` varchar(36) NOT NULL,
  `time_edited` datetime NOT NULL,
  `author` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` int(11) NOT NULL,
  KEY `dagr_id` (`dagr_id`),
  CONSTRAINT `metadata_ibfk_1` FOREIGN KEY (`dagr_id`) REFERENCES `dagr` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metadata`
--

LOCK TABLES `metadata` WRITE;
/*!40000 ALTER TABLE `metadata` DISABLE KEYS */;
INSERT INTO `metadata` VALUES ('3270C5C5-F589-4BA2-820B-6EBD0DD4C85E','1000-01-01 00:00:00','tim','',0),('7532A82F-E3E2-4E1D-9D7F-9B23E1831B06','0000-00-00 00:00:00','Mark','jpg',300);
/*!40000 ALTER TABLE `metadata` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-09 17:52:59
