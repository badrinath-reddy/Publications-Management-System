-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: pms
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `affilliated_to`
--

DROP TABLE IF EXISTS `affilliated_to`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `affilliated_to` (
  `people_id` varchar(10) NOT NULL,
  `organisation_id` int(10) NOT NULL,
  PRIMARY KEY (`people_id`,`organisation_id`),
  KEY `affilliated_to_fk2` (`organisation_id`),
  CONSTRAINT `affilliated_to_fk1` FOREIGN KEY (`people_id`) REFERENCES `people` (`people_id`),
  CONSTRAINT `affilliated_to_fk2` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`organisation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `affilliated_to`
--

LOCK TABLES `affilliated_to` WRITE;
/*!40000 ALTER TABLE `affilliated_to` DISABLE KEYS */;
INSERT INTO `affilliated_to` VALUES ('1701CS15',1),('1701CS22',1),('1701CS23',1),('1701CS53',1),('1701CS54',1),('FCS252',1);
/*!40000 ALTER TABLE `affilliated_to` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `belongs_to`
--

DROP TABLE IF EXISTS `belongs_to`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `belongs_to` (
  `people_id` varchar(30) NOT NULL,
  `dept_id` int(10) NOT NULL,
  PRIMARY KEY (`people_id`,`dept_id`),
  KEY `belongs_to_fk1` (`dept_id`),
  CONSTRAINT `belongs_to_fk1` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`),
  CONSTRAINT `belongs_to_fk2` FOREIGN KEY (`people_id`) REFERENCES `people` (`people_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `belongs_to`
--

LOCK TABLES `belongs_to` WRITE;
/*!40000 ALTER TABLE `belongs_to` DISABLE KEYS */;
INSERT INTO `belongs_to` VALUES ('1701CS15',1),('1701CS22',1),('1701CS23',1),('1701CS53',1),('1701CS54',1),('FCS252',1),('1701ME19',3),('1701ME22',3),('FME252',3),('FME282',3);
/*!40000 ALTER TABLE `belongs_to` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conference`
--

DROP TABLE IF EXISTS `conference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conference` (
  `publication_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `place` varchar(30) NOT NULL,
  PRIMARY KEY (`publication_id`),
  CONSTRAINT `conference_fk1` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conference`
--

LOCK TABLES `conference` WRITE;
/*!40000 ALTER TABLE `conference` DISABLE KEYS */;
INSERT INTO `conference` VALUES (5,'confrence5','TPTY'),(6,'confrence6','USA'),(8,'confrence8','Delhi'),(9,'confrence9','Australia'),(10,'confrence10','UK'),(11,'confrnce6','YEh');
/*!40000 ALTER TABLE `conference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consortina_partners`
--

DROP TABLE IF EXISTS `consortina_partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consortina_partners` (
  `project_id` int(10) NOT NULL,
  `organisation_id` int(10) NOT NULL,
  PRIMARY KEY (`project_id`,`organisation_id`),
  KEY `consortina_partners_fk2` (`organisation_id`),
  CONSTRAINT `consortina_partners_fk1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  CONSTRAINT `consortina_partners_fk2` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`organisation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consortina_partners`
--

LOCK TABLES `consortina_partners` WRITE;
/*!40000 ALTER TABLE `consortina_partners` DISABLE KEYS */;
INSERT INTO `consortina_partners` VALUES (1,1),(1,2),(2,2),(8,8);
/*!40000 ALTER TABLE `consortina_partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `dept_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `dept_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`dept_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'CSE','CSE'),(2,'EE','EE'),(3,'ME','ME'),(4,'CE','CE'),(5,'CB','CB'),(6,'HS','HS');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `done_by`
--

DROP TABLE IF EXISTS `done_by`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `done_by` (
  `project_id` int(10) NOT NULL,
  `people_id` varchar(30) NOT NULL,
  `level` int(3) NOT NULL,
  PRIMARY KEY (`project_id`,`people_id`),
  KEY `done_by_fk2` (`people_id`),
  CONSTRAINT `done_by_fk1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  CONSTRAINT `done_by_fk2` FOREIGN KEY (`people_id`) REFERENCES `people` (`people_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `done_by`
--

LOCK TABLES `done_by` WRITE;
/*!40000 ALTER TABLE `done_by` DISABLE KEYS */;
INSERT INTO `done_by` VALUES (1,'FCS252',1),(1,'FME282',1),(2,'1701CS22',2),(2,'FME282',1),(3,'1701CS53',2),(3,'FME282',1),(4,'1701CS54',2),(4,'FME282',1),(5,'1701CS22',2),(5,'FCS252',1),(6,'1701CS22',2),(6,'1701CS53',2),(6,'FCS252',1),(7,'1701CS22',2),(7,'1701CS53',2),(8,'1701CS22',2),(8,'1701CS53',2),(8,'FCS252',1),(9,'1701CS22',1),(10,'1701CS53',1);
/*!40000 ALTER TABLE `done_by` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `has_tags_proj`
--

DROP TABLE IF EXISTS `has_tags_proj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `has_tags_proj` (
  `tag_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  PRIMARY KEY (`tag_id`,`project_id`),
  KEY `has_tags_proj_fk2` (`project_id`),
  CONSTRAINT `has_tags_proj_fk1` FOREIGN KEY (`tag_id`) REFERENCES `hashtags` (`tag_id`),
  CONSTRAINT `has_tags_proj_fk2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `has_tags_proj`
--

LOCK TABLES `has_tags_proj` WRITE;
/*!40000 ALTER TABLE `has_tags_proj` DISABLE KEYS */;
INSERT INTO `has_tags_proj` VALUES (1,1),(5,1),(2,2),(3,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);
/*!40000 ALTER TABLE `has_tags_proj` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `has_tags_pub`
--

DROP TABLE IF EXISTS `has_tags_pub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `has_tags_pub` (
  `tag_id` int(10) NOT NULL,
  `publication_id` int(10) NOT NULL,
  PRIMARY KEY (`tag_id`,`publication_id`),
  KEY `has_tags_pub_fk2` (`publication_id`),
  CONSTRAINT `has_tags_pub_fk1` FOREIGN KEY (`tag_id`) REFERENCES `hashtags` (`tag_id`),
  CONSTRAINT `has_tags_pub_fk2` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `has_tags_pub`
--

LOCK TABLES `has_tags_pub` WRITE;
/*!40000 ALTER TABLE `has_tags_pub` DISABLE KEYS */;
INSERT INTO `has_tags_pub` VALUES (1,1),(5,1),(2,2),(3,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);
/*!40000 ALTER TABLE `has_tags_pub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hashtags`
--

DROP TABLE IF EXISTS `hashtags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hashtags` (
  `tag_id` int(10) NOT NULL AUTO_INCREMENT,
  `tag` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hashtags`
--

LOCK TABLES `hashtags` WRITE;
/*!40000 ALTER TABLE `hashtags` DISABLE KEYS */;
INSERT INTO `hashtags` VALUES (8,'Cloud'),(5,'Computer Networks'),(2,'Deep Learning'),(4,'DMBS'),(7,'Graphics'),(10,'Health Care'),(1,'Machine Learning'),(3,'NLP'),(6,'OS'),(11,'Robotics'),(9,'Vision');
/*!40000 ALTER TABLE `hashtags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journal`
--

DROP TABLE IF EXISTS `journal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journal` (
  `publication_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `volume` int(10) NOT NULL,
  `issue_no` int(10) NOT NULL,
  PRIMARY KEY (`publication_id`),
  CONSTRAINT `journal_fk1` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journal`
--

LOCK TABLES `journal` WRITE;
/*!40000 ALTER TABLE `journal` DISABLE KEYS */;
INSERT INTO `journal` VALUES (1,'journal1',2,3),(2,'journal2',1,13),(3,'journal3',12,4),(4,'journal4',13,6),(7,'journal7',1,61);
/*!40000 ALTER TABLE `journal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisations`
--

DROP TABLE IF EXISTS `organisations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisations` (
  `organisation_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `p_g` int(2) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `has_people` int(2) NOT NULL,
  PRIMARY KEY (`organisation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisations`
--

LOCK TABLES `organisations` WRITE;
/*!40000 ALTER TABLE `organisations` DISABLE KEYS */;
INSERT INTO `organisations` VALUES (1,'Indian Institue of Technology Patna',0,'Bihar',1),(2,'Indian Institue of Technology Bombay',0,'Bihar',1),(3,'Indian Institue of Technology Madras',0,'Bihar',1),(4,'Indian Institue of Technology Hydereabad',0,'Bihar',1),(5,'Indian Institue of Technology Ropar',0,'Bihar',1),(6,'Indian Institue of Technology Delhi',0,'Bihar',1),(7,'Indian Institue of Technology Kanpur',0,'Bihar',1),(8,'Indian Institue of Technology Roorke',0,'Bihar',1),(9,'IBM',0,'Bihar',1),(10,'Samsung',0,'Bihar',0),(11,'Indian Institue of Technology Tirupati',0,'Tirupati',1);
/*!40000 ALTER TABLE `organisations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `people_id` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `is_admin` int(2) NOT NULL,
  `is_faculty` int(2) NOT NULL,
  PRIMARY KEY (`people_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES ('1701CS15','Dhanvanth','1234',0,0),('1701CS22','Badrinath Gopugari','1234',1,0),('1701CS23','Sagar','1234',0,0),('1701CS53','Vrushank Varma','1234',1,0),('1701CS54','Sujeeth','1234',0,0),('1701ME19','Harshith','1234',0,0),('1701ME22','Devi','1234',0,0),('FCS252','Samrat','1234',1,1),('FME252','Ajay','1234',0,1),('FME282','Atul','1234',0,1);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `project_id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `duration` float(3,2) NOT NULL,
  `start_date` date NOT NULL,
  `status` int(2) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `link` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Summarisation',3.20,'2005-08-23',1,124.30,'hwebfjvhqewj'),(2,'NLP survey',3.00,'2006-08-23',2,14.30,'hwebfjvhqewj'),(3,'CV survey',3.00,'2007-08-23',2,12.30,'hwebfjvhqewj'),(4,'Arch',2.00,'2008-08-23',1,1245.30,'hwebfjvhqewj'),(5,'Robot in sewer',5.00,'2009-08-23',1,1.30,'hwebfjvhqewj'),(6,'Emotion',5.00,'2015-08-23',1,2.30,'hwebfjvhqewj'),(7,'Dipression',9.00,'2016-08-23',1,124.50,'hwebfjvhqewj'),(8,'Solid works',3.40,'2017-08-23',1,34.00,'hwebfjvhqewj'),(9,'Cad',2.30,'2019-08-23',1,88.00,'hwebfjvhqewj'),(10,'VLSI',3.30,'2020-08-23',1,56.00,'hwebfjvhqewj');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publications` (
  `publication_id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `p_year` year(4) NOT NULL,
  `p_month` int(2) DEFAULT NULL,
  `page_range` varchar(30) DEFAULT NULL,
  `doi` varchar(50) DEFAULT NULL,
  `link` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`publication_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES (1,'voice recognition based on nlp',2015,4,'10-12','mjfvweawa','mhjvdhfvker'),(2,'Robotic arm',2016,3,'10-12','mjfvweawa','mhjvdhfvker'),(3,'Divide-and-Conquer Based Non-dominated Sorting with Reduced Comparisons ',2017,6,'10-12','mjfvweawa','mhjvdhfvker'),(4,'On overcoming the identified limitations of a usable PIN entry method',2018,1,'10-12','mjfvweawa','mhjvdhfvker'),(5,'On overcoming the identified limitations of a usable PIN entry method',2019,2,'10-12','mjfvweawa','mhjvdhfvker'),(6,'Text based Nlp search engine',2020,8,'10-12','mjfvweawa','mhjvdhfvker'),(7,'Dispersion Ratio Based Decision Tree Model for Classification',2020,8,'10-12','mjfvweawa','mhjvdhfvker'),(8,'ntelligent Scheduling of Thermostatic Devices for Efficient Energy Management in Smart Grid',2020,8,'10-12','mjfvweawa','mhjvdhfvker'),(9,'Sensitivity- An Important Facet of Cluster Validation Process for Entity Matching Technique',2020,8,'10-12','mjfvweawa','mhjvdhfvker'),(10,'Security Analysis of GTRBAC and its Variants using Model Checking',2020,8,'10-12','mjfvweawa','mhjvdhfvker'),(11,'Coordinated Scheduling of Residential Appliances and Heterogeneous Energy Sources in a Smart Microgrid',2020,8,'10-12','jhfa','wqf');
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sponsored_by`
--

DROP TABLE IF EXISTS `sponsored_by`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sponsored_by` (
  `project_id` int(10) NOT NULL,
  `organisation_id` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  PRIMARY KEY (`project_id`,`organisation_id`),
  KEY `sponsored_by_fk2` (`organisation_id`),
  CONSTRAINT `sponsored_by_fk1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  CONSTRAINT `sponsored_by_fk2` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`organisation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sponsored_by`
--

LOCK TABLES `sponsored_by` WRITE;
/*!40000 ALTER TABLE `sponsored_by` DISABLE KEYS */;
INSERT INTO `sponsored_by` VALUES (1,2,100000),(2,1,100000),(2,2,100000),(4,3,100000),(5,1,100000),(6,2,100000),(7,3,100000),(7,4,100000),(8,3,100000),(9,7,100000),(10,6,100000);
/*!40000 ALTER TABLE `sponsored_by` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `written_by`
--

DROP TABLE IF EXISTS `written_by`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `written_by` (
  `publication_id` int(10) NOT NULL,
  `people_id` varchar(30) NOT NULL,
  `level` int(3) NOT NULL,
  PRIMARY KEY (`publication_id`,`people_id`),
  KEY `written_by_fk2` (`people_id`),
  CONSTRAINT `written_by_fk1` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`publication_id`),
  CONSTRAINT `written_by_fk2` FOREIGN KEY (`people_id`) REFERENCES `people` (`people_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `written_by`
--

LOCK TABLES `written_by` WRITE;
/*!40000 ALTER TABLE `written_by` DISABLE KEYS */;
INSERT INTO `written_by` VALUES (1,'FCS252',1),(1,'FME282',1),(2,'1701CS22',2),(2,'FME282',1),(3,'1701CS53',2),(3,'FME282',1),(4,'1701CS54',2),(4,'FME282',1),(5,'1701CS22',2),(5,'FCS252',1),(6,'1701CS22',2),(6,'1701CS53',2),(6,'FCS252',1),(7,'1701CS22',2),(7,'1701CS53',2),(8,'1701CS22',2),(8,'1701CS53',2),(8,'FCS252',1),(9,'1701CS22',1),(10,'1701CS53',1),(11,'FME282',1);
/*!40000 ALTER TABLE `written_by` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-16  6:04:49
