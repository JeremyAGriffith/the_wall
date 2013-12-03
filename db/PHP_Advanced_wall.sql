CREATE DATABASE  IF NOT EXISTS `PHP_Advanced_Wall` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `PHP_Advanced_Wall`;
-- MySQL dump 10.13  Distrib 5.5.24, for osx10.5 (i386)
--
-- Host: 127.0.0.1    Database: PHP_Advanced_Wall
-- ------------------------------------------------------
-- Server version	5.5.29

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `messages_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_messages1_idx` (`messages_id`),
  KEY `fk_comments_users1_idx` (`users_id`),
  CONSTRAINT `fk_comments_messages1` FOREIGN KEY (`messages_id`) REFERENCES `messages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'','2013-07-11 18:31:41',NULL,2,1),(2,'xcxc','2013-07-11 18:33:12',NULL,2,1),(3,'dffd','2013-07-11 18:34:09',NULL,1,1),(4,'This is a comment. what.','2013-07-11 19:35:43',NULL,3,2),(5,'This is too!!!','2013-07-11 19:35:58',NULL,3,2),(6,'im one roo','2013-07-11 19:45:58',NULL,4,2),(7,'wiow','2013-07-11 20:33:10',NULL,6,2),(8,'wowfdfkjd hj how ','2013-07-11 20:33:24',NULL,2,2),(9,'','2013-07-12 00:24:02',NULL,7,3),(10,'','2013-07-12 00:24:11',NULL,7,3),(11,'dfgfgdfd','2013-07-12 00:24:14',NULL,7,3),(12,'who','2013-07-12 00:24:30',NULL,10,3),(13,'dfdf dff','2013-07-12 00:25:05',NULL,5,3),(14,'sdsfg','2013-07-12 11:35:19',NULL,14,3);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_users_idx` (`users_id`),
  CONSTRAINT `fk_messages_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'sdsdsdd','2013-07-11 18:16:10',NULL,1),(2,'kjdfjh','2013-07-11 18:31:06',NULL,1),(3,'This is a message.','2013-07-11 19:35:05',NULL,2),(4,'But what about this?','2013-07-11 19:36:13',NULL,2),(5,'Why wont you show','2013-07-11 19:39:35',NULL,2),(6,' The quick brown fox jumps over the lazy dog.','2013-07-11 19:44:43',NULL,2),(7,'','2013-07-12 00:23:16',NULL,3),(8,'dffsd','2013-07-12 00:24:16',NULL,3),(9,'what','2013-07-12 00:24:23',NULL,3),(10,'why','2013-07-12 00:24:27',NULL,3),(11,'its so cool','2013-07-12 01:06:42',NULL,3),(12,'build another','2013-07-12 01:07:19',NULL,3),(13,' kdshf\r\ndsf\r\nfs\r\nff\r\n\r\nfsd\r\nfds\r\nfsd\r\nfsd\r\nfd\r\nf\r\nsf\r\ns','2013-07-12 01:09:58',NULL,3),(14,'jksds','2013-07-12 11:35:15',NULL,3);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL COMMENT '		',
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'vdfdf','ddf','k@kk.com','5ae136d9363e8b0e0b57018f800bd255','2013-07-11 14:21:07',NULL),(2,'j','ba','jj@ja.com','274883dcadb83028c76c3ccfadc7d9f4','2013-07-11 19:34:48',NULL),(3,'alfred','higgsworth','aa@aa.com','3dbe00a167653a1aaee01d93e77e730e','2013-07-12 00:21:56',NULL);
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

-- Dump completed on 2013-07-12 16:50:33
