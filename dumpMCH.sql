-- MySQL dump 10.11
--
-- Host: localhost    Database: mch
-- ------------------------------------------------------
-- Server version	5.0.51a-24+lenny3

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
-- Table structure for table `aattributes`
--

DROP TABLE IF EXISTS `aattributes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `aattributes` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `aattributes`
--

LOCK TABLES `aattributes` WRITE;
/*!40000 ALTER TABLE `aattributes` DISABLE KEYS */;
INSERT INTO `aattributes` VALUES (1,'size'),(2,'color');
/*!40000 ALTER TABLE `aattributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aattributes_products`
--

DROP TABLE IF EXISTS `aattributes_products`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `aattributes_products` (
  `id` int(11) NOT NULL auto_increment,
  `product_id` int(11) default '0',
  `aatribute_id` int(11) default NULL,
  `aatribute_value_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `aattributes_products`
--

LOCK TABLES `aattributes_products` WRITE;
/*!40000 ALTER TABLE `aattributes_products` DISABLE KEYS */;
INSERT INTO `aattributes_products` VALUES (1,1,1,4),(2,1,2,1);
/*!40000 ALTER TABLE `aattributes_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aattributes_values`
--

DROP TABLE IF EXISTS `aattributes_values`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `aattributes_values` (
  `id` int(11) NOT NULL auto_increment,
  `value` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `aattributes_values`
--

LOCK TABLES `aattributes_values` WRITE;
/*!40000 ALTER TABLE `aattributes_values` DISABLE KEYS */;
INSERT INTO `aattributes_values` VALUES (1,'red'),(2,'blue'),(3,'big'),(4,'small');
/*!40000 ALTER TABLE `aattributes_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvedStatuses`
--

DROP TABLE IF EXISTS `approvedStatuses`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `approvedStatuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `approvedStatuses`
--

LOCK TABLES `approvedStatuses` WRITE;
/*!40000 ALTER TABLE `approvedStatuses` DISABLE KEYS */;
INSERT INTO `approvedStatuses` VALUES (0,'Not Approved'),(1,'Approved');
/*!40000 ALTER TABLE `approvedStatuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `categories_description_id` int(5) default NULL,
  `lft` int(5) default NULL,
  `rgt` int(5) default NULL,
  `parent_id` int(11) default NULL,
  `lvl` int(11) default NULL,
  `scope` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Chocolate',1,1,30,0,1,1),(2,'Candy',2,4,29,0,1,1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_descriptions`
--

DROP TABLE IF EXISTS `categories_descriptions`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `categories_descriptions` (
  `id` int(11) NOT NULL auto_increment,
  `description` text,
  `short_description` text,
  `meta_title` text,
  `meta_description` text,
  `meta_keywords` text,
  `title_url` varchar(255) default NULL,
  `image` varchar(100) default NULL,
  `image_alt` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `categories_descriptions`
--

LOCK TABLES `categories_descriptions` WRITE;
/*!40000 ALTER TABLE `categories_descriptions` DISABLE KEYS */;
INSERT INTO `categories_descriptions` VALUES (1,'<p>Products to clean, polish, restore, and maintain your marble.</p>','','Marble Cleaning Products | Marble Care | Marble Polishing | Marble Restoration and Refinishing| Polishing Marble Tile, Countertops, Sinks','Our marble cleaning products including our Marble Guard Protector, Marble Cleaner, Marble Polish and Protector, and Marble Refinishing Kit will clean and restore marble surfaces.','','chocolate-care','CaptureSilver.PNG',''),(2,'<p>Products to clean, polish, restore, and maintain your marble.</p>',NULL,'Marble Cleaning Products | Marble Care | Marble Polishing | Marble Restoration and Refinishing| Polishing Marble Tile, Countertops, Sinks','Our marble cleaning products including our Marble Guard Protector, Marble Cleaner, Marble Polish and Protector, and Marble Refinishing Kit will clean and restore marble surfaces.',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `categories_descriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_products`
--

DROP TABLE IF EXISTS `categories_products`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `categories_products` (
  `id` int(5) NOT NULL auto_increment,
  `product_id` int(5) NOT NULL,
  `category_id` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `categories_products`
--

LOCK TABLES `categories_products` WRITE;
/*!40000 ALTER TABLE `categories_products` DISABLE KEYS */;
INSERT INTO `categories_products` VALUES (1,1,1),(2,2,1),(3,3,2),(4,4,2);
/*!40000 ALTER TABLE `categories_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `abbr` varchar(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'United States','US'),(2,'Canada','CA');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `discounts` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `percent` decimal(15,4) default NULL,
  `amount` decimal(15,4) default NULL,
  `effective_from` date default NULL,
  `effective_to` date default NULL,
  `type_id` int(11) NOT NULL,
  `condition` text,
  `description` text,
  `shipping_percent` decimal(11,4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (1,'New Discount','15.0000','20.0000','2012-04-12','2012-04-28',4,'','<p> This is the discount description</p>','5.0000');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts_objects`
--

DROP TABLE IF EXISTS `discounts_objects`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `discounts_objects` (
  `id` int(11) NOT NULL auto_increment,
  `discount_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `discounts_objects`
--

LOCK TABLES `discounts_objects` WRITE;
/*!40000 ALTER TABLE `discounts_objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `discounts_objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts_types`
--

DROP TABLE IF EXISTS `discounts_types`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `discounts_types` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `table` varchar(20) default NULL,
  `name_field` varchar(200) default 'name',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `discounts_types`
--

LOCK TABLES `discounts_types` WRITE;
/*!40000 ALTER TABLE `discounts_types` DISABLE KEYS */;
INSERT INTO `discounts_types` VALUES (1,'product','products','name'),(2,'category','categories','name'),(3,'user','users','CONCAT(firstname, \' \', lastname'),(4,'cart','NULL','name');
/*!40000 ALTER TABLE `discounts_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `events` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `description` text,
  `email_title` text,
  `email_body` text,
  `interval` int(11) default NULL,
  `condition` text,
  `last_executed` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'New Event','This is a new event','test event','<p> This is a new event and I am trying to figure out how this works</p>',NULL,'','2012-05-30 19:31:30'),(2,'order.status.changed','Order Shipped','Your Order has been shipped','<p> Your Order has been changed:</p>\n<p>%description%</p>\n<p>%shipping_info%</p>\n<p>%billing_info%</p>\n<p><span style=\"background-color: rgb(160, 160, 160); color: rgb(255, 255, 255); \">%payment_method%</span></p>\n<p><b style=\"text-align: right; \"><span style=\"font-size: 10.5pt; \">%total%</span></b></p>',NULL,'%statusID%==4','2012-05-30 19:14:27'),(3,'order.status.changed','Your My Chocolate Hearts Order Processed','My Chocolate Hearts Customer Order Processed Confirmation','<p><img src=\"http://mch.beta.polardesign.com/env/images/logo.png\" alt=\"\" /></p>\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"MsoNormalTable\" style=\"width: 632px; background-image: none; background-attachment: scroll; background-color: rgb(160, 160, 160); background-position: 0% 0%; background-repeat: repeat repeat; \">\n    <tbody>\n        <tr>\n            <td style=\"padding: 1.5pt; \">\n            <p class=\"MsoNormal\"><span style=\"color: white; font-size: 9pt; \">Order Information</span></p>\n            </td>\n        </tr>\n    </tbody>\n</table>\n<p class=\"MsoNormal\">Transaction ID: %trans_id%</p>\n<p class=\"MsoNormal\">%description%</p>\n<div align=\"center\" class=\"MsoNormal\" style=\"text-align: center; \"><span style=\"font-family: Arial, sans-serif; font-size: 9pt; \"><hr width=\"100%\" size=\"2\" align=\"center\" />\n</span></div>\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"MsoNormalTable\" style=\"width: 632px; \">\n    <tbody>\n        <tr>\n            <td width=\"250\" valign=\"top\" style=\"padding: 0in; width: 187.5pt; \">\n            <p class=\"MsoNormal\"><b>Billing Information</b><span style=\"font-size: 9pt; \"> <br />\n            %billing_info%</span></p>\n            </td>\n            <td valign=\"top\" style=\"padding: 0in; \">\n            <p class=\"MsoNormal\"><b>Shipping Information</b><span style=\"font-size: 9pt; \"> <br />\n            %shipping_info%</span></p>\n            </td>\n        </tr>\n    </tbody>\n</table>\n<div align=\"center\" class=\"MsoNormal\" style=\"text-align: center; \"><span style=\"font-family: Arial, sans-serif; font-size: 9pt; \"><hr width=\"100%\" size=\"2\" align=\"center\" />\n</span></div>\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"MsoNormalTable\" style=\"width: 632px; \">\n    <tbody>\n        <tr>\n            <td style=\"padding: 0in; \">\n            <div align=\"right\">\n            <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"MsoNormalTable\">\n                <tbody>\n                    <tr>\n                        <td valign=\"top\" style=\"padding: 1.5pt; \">\n                        <p align=\"right\" class=\"MsoNormal\" style=\"text-align: right; \"> </p>\n                        </td>\n                        <td valign=\"top\" style=\"padding: 1.5pt; \"> </td>\n                        <td valign=\"top\" style=\"padding: 1.5pt; \">\n                        <p align=\"right\" class=\"MsoNormal\" style=\"text-align: right; \"><b><span style=\"font-size: 10.5pt; \"> %total%</span></b></p>\n                        </td>\n                    </tr>\n                </tbody>\n            </table>\n            </div>\n            </td>\n        </tr>\n    </tbody>\n</table>\n<p class=\"MsoNormal\"><span style=\"font-family: Arial, sans-serif; font-size: 9pt; \"> </span></p>\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"MsoNormalTable\" style=\"width: 632px; background-image: none; background-attachment: scroll; background-color: rgb(160, 160, 160); background-position: 0% 0%; background-repeat: repeat repeat; \">\n    <tbody>\n        <tr>\n            <td style=\"padding: 1.5pt; \">\n            <p class=\"MsoNormal\"><span style=\"color: white; font-size: 9pt; \">%payment_method%</span></p>\n            </td>\n        </tr>\n    </tbody>\n</table>\n<p class=\"MsoNormal\"><span style=\"font-family: Arial, sans-serif; font-size: 9pt; \"> </span></p>\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"MsoNormalTable\" style=\"width: 632px; \">\n    <tbody>\n        <tr>\n            <td valign=\"bottom\" style=\"padding: 0in; \">\n            <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"MsoNormalTable\">\n                <tbody>\n                    <tr>\n                        <td width=\"130\" valign=\"top\" style=\"padding: 1.5pt; width: 97.5pt; \">\n                        <p class=\"MsoNormal\"><span style=\"font-size: 9pt; \">Date/Time:</span></p>\n                        </td>\n                        <td valign=\"top\" style=\"padding: 1.5pt; \">\n                        <p class=\"MsoNormal\"><span style=\"font-size: 9pt; \">%order_date%</span></p>\n                        </td>\n                    </tr>\n                    <tr>\n                        <td width=\"130\" valign=\"top\" style=\"padding: 1.5pt; width: 97.5pt; \">\n                        <p class=\"MsoNormal\">Requested Date:</p>\n                        </td>\n                        <td valign=\"top\" style=\"padding: 1.5pt; \">\n                        <p class=\"MsoNormal\">%order_delivery_date%</p>\n                        </td>\n                    </tr>\n                </tbody>\n            </table>\n            </td>\n        </tr>\n    </tbody>\n</table>\n<p>Thanks for your business!</p>\n<p>Proof, if applicable will be emailed within the next 2 business days. If this is a rush order, call 1-866-230-7730 to make arrangements.</p>',NULL,'%statusID%==2','2012-06-01 15:07:48');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flavors`
--

DROP TABLE IF EXISTS `flavors`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `flavors` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `flavors`
--

LOCK TABLES `flavors` WRITE;
/*!40000 ALTER TABLE `flavors` DISABLE KEYS */;
INSERT INTO `flavors` VALUES (1,'Milk Chocolate',''),(2,'Dark Chocolate','');
/*!40000 ALTER TABLE `flavors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foil_colors`
--

DROP TABLE IF EXISTS `foil_colors`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `foil_colors` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `hexcode` varchar(6) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `foil_colors`
--

LOCK TABLES `foil_colors` WRITE;
/*!40000 ALTER TABLE `foil_colors` DISABLE KEYS */;
INSERT INTO `foil_colors` VALUES (6,'Black','000000'),(5,'White','FFFFFF'),(7,'Red','CC3300'),(8,'Royal Blue','2B60DE'),(9,'Forest Green','347235'),(10,'Yellow','FAF8CC'),(11,'Pink','F52887'),(12,'Light Blue','ADD8E6'),(13,'Purple','800080'),(14,'Silver','D5DBD7'),(15,'Gold','EAC256'),(16,'Hot pink','B30B63'),(17,'Green','16892A'),(18,'Teal','2BBBBB'),(19,'Royal blue','3D30B4');
/*!40000 ALTER TABLE `foil_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foil_images`
--

DROP TABLE IF EXISTS `foil_images`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `foil_images` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `imageID` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `foil_images`
--

LOCK TABLES `foil_images` WRITE;
/*!40000 ALTER TABLE `foil_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `foil_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(30) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occasion_images`
--

DROP TABLE IF EXISTS `occasion_images`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `occasion_images` (
  `occassionID` int(11) NOT NULL,
  `iamgeID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `occasion_images`
--

LOCK TABLES `occasion_images` WRITE;
/*!40000 ALTER TABLE `occasion_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `occasion_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occasions`
--

DROP TABLE IF EXISTS `occasions`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `occasions` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `headline` varchar(100) default NULL,
  `description` text,
  `occasions_description_id` int(11) NOT NULL default '4',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `occasions`
--

LOCK TABLES `occasions` WRITE;
/*!40000 ALTER TABLE `occasions` DISABLE KEYS */;
INSERT INTO `occasions` VALUES (1,'Wedding','Give the sweet touch to the sweetest moment of your life...','',4),(2,'Baptism / Christening','May the sweet grace of the Lord be with you and yours...','This is the baptism text',5),(3,'Quinceanera','Because you turn 15 just once in your life... make it even sweeter.','',6),(4,'Bar / Bat Mitzvah','You are the start of the party. We just give the sweet note!','',7),(5,'Baby Shower','A sweet new member of the family is coming soon... be prepared with a special treat.','Congratulations on your new money-pit!',8),(6,'Engagement','Your promise of a sweet life together...','',9),(7,'Hannukah','Celebrate with family and friends giving the sweetest gifts of all...','',10),(8,'Halloween','Trick or treat? We know you chose treat... just make it as sweet as possible','',11),(9,'Graduation','You did it. What a sweet reward!','',12),(10,'Birthday','Don\'t let anybody forget that year after year you are getting sweeter.','',13),(11,'Sweet 16','Sweet 16... a whole sweet life is in front of you.','',14),(12,'Communion','A great treat for a great religious moment...','',15),(13,'Anniversary','You made it together... all the way. What a sweet bliss!','',16),(14,'Holidays / Christmas','This is the time of sharing the sweet things in life!','',17),(15,'Corporate','Your corporate image was never in better and sweeter hands!','',18),(16,'Valentine\'s Day','A sweet gift for your sweetheart!','',19);
/*!40000 ALTER TABLE `occasions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occasions_descriptions`
--

DROP TABLE IF EXISTS `occasions_descriptions`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `occasions_descriptions` (
  `id` int(11) NOT NULL auto_increment,
  `description` text,
  `short_description` text,
  `meta_title` text,
  `meta_description` text,
  `meta_keywords` text,
  `title_url` varchar(255) default NULL,
  `image` varchar(100) default NULL,
  `image_alt` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `occasions_descriptions`
--

LOCK TABLES `occasions_descriptions` WRITE;
/*!40000 ALTER TABLE `occasions_descriptions` DISABLE KEYS */;
INSERT INTO `occasions_descriptions` VALUES (4,'','<p>Chocolate wedding hearts to impress your guests. Use your custom message, names, dates, graphic or logos to personalize our custom chocolate hearts for an elegant personalized chocolate favor. Design your own chocolate coins to use as a great and affordable chocolate favor.</p>','Wedding Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for a wedding. Create customized chocolate hearts for your occasion!\n','wedding, occasion, chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors','wedding','1336689024-wedding page2.jpg','Wedding Custom Chocolate Hearts'),(5,'','<p>Chocolate baptism hearts to impress your guests. Use your custom message, names, dates, graphic or logos to personalize our custom chocolate hearts for an elegant personalized chocolate favor. Design your personalized chocolate hearts to use as a great and affordable chocolate favor.</p>','Baptism and Christening Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for a batism or christening. Create customized chocolate hearts for your occasion!\n','','baptisms-christenings','1336600937-baptism page2.jpg','Baptism Custom Chocolate Hearts'),(6,'<p>Celebrate your special day with our personalized chocolate hearts. Use your custom message, names, dates, graphic or logos to personalize our custom chocolate hearts for an elegant personalized chocolate favor. Use our decadent chocolate hearts as a great and affordable custom chocolate favor.</p>','<p>Celebrate your special day with our personalized chocolate hearts. Use your custom message, names, dates, graphic or logos to personalize our custom chocolate hearts for an elegant personalized chocolate favor. Use our decadent chocolate hearts as a great and affordable custom chocolate favor.</p>','Quinceanera Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for a quinceanera Create customized chocolate hearts for your occasion!\n','','quinceanera','1336600889-quinceanera page2.jpg',''),(7,'','<p>Kosher chocolate hearts to impress your guests. You can design your personalized chocolate hearts using your custom message, names, dates, graphic or logos for an elegant chocolate favor. Use our delicious chocolate hearts as a great and affordable chocolate favor.</p>','Bar Mitzvah and Bat Mitzvah Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for a Bar Mitzvah or Bat Mitzvah. Create customized chocolate hearts for your occasion!\n','','bar-bat-mitzvah','1336601074-bar bat mitzvah page2.jpg','Bar Mitzvah Custom Chocolate Hearts'),(8,'','<p>The perfect baby shower favors are our custom chocolate hearts. Our personalized chocolate hearts can be customized with your custom message, names, dates, graphic or logos for an amazing chocolate favor. Use our delicious chocolate hearts as a great and affordable personalized chocolate favor. Size: 1.5” Diameter.</p>','Baby Shower Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for a baby shower. Create customized chocolate hearts for your occasion!\n','','baby-shower','1336600799-baby shower page2.jpg','Baby Shower Custom Chocolate Hearts'),(9,'','<p>Chocolate engagement hearts to impress your guests. Our custom chocolate hearts can be personalized with your custom message, names, dates, graphic or logos for an elegant personalized chocolate favor. Personalize one of our chocolate hearts to use as a great and affordable chocolate favor.</p>','Engagement Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for an engagement Create customized chocolate hearts for your occasion!\n','','engagement','1336601204-engagement page2.jpg','Engagement Custom Chocolate Hearts'),(10,'','<p>Kosher chocolate hearts for Hannukah! Use your custom message, names, dates, graphic or logos to personalize our custom chocolate hearts for an elegant personalized chocolate favor. Design your personalized chocolate hearts to use as a great and affordable chocolate favor this Hannukah!</p>','Hannukah Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for Hannukah. Create customized chocolate hearts for your occasion!\n','','hannukah','1336601375-hannukah page2.jpg','Hannukkah Custom Chocolate Hearts'),(11,'','<p>Spooky custom chocolate hearts for this Halloween. Use your custom message, names, dates, graphic or logos to customize our personalized chocolate hearts for an unforgettable personalized chocolate favor. Use our delicious chocolate hearts as a great and affordable custom chocolate favor.</p>','Halloween Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for Halloween. Create customized chocolate hearts for your occasion!\n','','halloween','1336601525-halloween page2.jpg','Halloween Custom Chocolate Hearts'),(12,'','<p>Personalized chocolate hearts for your graduation. Our custom chocolate hearts can be personalized with your custom message, names, dates, graphic or logos for a delicious custom chocolate favor. Design your own chocolate hearts to use as a great and affordable chocolate favor.</p>','Graduation Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for a graduation. Create customized chocolate hearts for your occasion!\n','','graduation','1336602440-graduation page2.jpg','Graduation Custom Chocolate Hearts'),(13,'','Chocolate birthday hearts to impress your guests. Our custom chocolate hearts can be personalized with your custom message, names, dates, graphic or logos for an amazing chocolate favor. Design your personalized chocolate hearts to use as a great and affordable chocolate favor.','Birthday Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for a birthday. Create customized chocolate hearts for your occasion!\n','','birthday','1336602642-birthday page2.jpg','Birthday Custom Chocolate Hearts'),(14,'','<p>Celebrate your special day with our custom chocolate hearts. You can design your personalized chocolate hearts using your custom message, names, dates, graphic or logos for an impressive chocolate favor. Personalize one of our chocolate hearts to use as a great and affordable chocolate favor.</p>','Sweet 16 Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for a sweet sixteen birthday. Create customized chocolate hearts for your occasion!\n','','sweet-16','1336602774-sweet 16 page2.jpg','Sweet 16 Custom Chocolate Hearts'),(15,'','<p>Spectacular custom chocolate hearts for Communion. You can design your personalized chocolate hearts using your custom message, names, dates, graphic or logos for an elegant chocolate favor. Use our Belgian chocolate hearts as a great and affordable custom chocolate favor.</p>','Communion Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for a communion. Create customized chocolate hearts for your occasion!\n','','communion','1336602949-communion page2.jpg','Communion Custom Chocolate Hearts'),(16,'','<p>Show your love with our personalized chocolate hearts. You can design your custom chocolate hearts using your custom message, names, dates, graphic or logos for an elegant chocolate favor. Personalize one of our chocolate hearts to use as a great and affordable chocolate favor for your anniversary.</p>','Anniversary Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for an anniversary. Create customized chocolate hearts for your occasion!\n','','anniversary','1336603024-anniversary page2.jpg','Anniversary Custom Chocolate Hearts'),(17,'','<p>Share these custom chocolate hearts with your friends and family. Our personalized chocolate hearts can be customized with your custom message, names, dates, graphic or logos for an amazing chocolate favor. Design your own chocolate hearts these holidays to use as a great and affordable custom chocolate favor. Size: 1.5” Diameter.</p>','Christmas and Holiday Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for Christmas and the holiday season. Create customized chocolate hearts for your occasion!\n','','holidays-christmas','1336603300-holidays-christmas page2.jpg','Christmas Holiday Custom Chocolate Hearts'),(18,'','<p>Show your appreciation for clients and employees with our custom chocolate hearts. You can design your personalized chocolate hearts using your custom message, names, dates, graphic or logos for an impressive chocolate favor. Personalize one of our chocolate hearts to use as a great and affordable chocolate favor.</p>','Corporate Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for a business. Create customized chocolate hearts for your corporation.\n','','corporate','1336603392-corporate page2.jpg','Corporate Custom Chocolate Hearts'),(19,'','<p>Share these custom chocolate coins with your friends and family. Our personalized chocolate coins can be customized with your custom message, names, dates, graphic or logos for an amazing chocolate favor. Design your own chocolate coins for Valentines Day to use as a great and affordable custom chocolate favor.</p>','Valentine\'s Day Custom Chocolate Hearts - MyChocolateHearts.com: Create customized chocolate hearts with your own design\n','Custom chocolate hearts for Valentine\'s Day.  Create customized chocolate hearts for your occasion!\n','','valentines-day','1336688803-valentine.png','Valentines Day Custom Chocolate Hearts'),(20,'lorem ipsum',NULL,'lorem ipsum',NULL,'lorem ipsum',NULL,NULL,NULL),(25,'<p> test</p>','<p> test</p>','test','test','test','test',NULL,''),(24,'<p> This is the ong description for said new occasion</p>','<p> This is the short desc</p>','lorem ipsum blah blah blah','lorem ipsum blah blah blahlorem ipsum blah blah blah META DESCRIPTION','lorem ipsum blah blah blah META KEYWORDS','newoccasion',NULL,'');
/*!40000 ALTER TABLE `occasions_descriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_statuses`
--

DROP TABLE IF EXISTS `order_statuses`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `order_statuses` (
  `id` int(11) NOT NULL auto_increment,
  `status_name` varchar(325) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `order_statuses`
--

LOCK TABLES `order_statuses` WRITE;
/*!40000 ALTER TABLE `order_statuses` DISABLE KEYS */;
INSERT INTO `order_statuses` VALUES (1,'Pending'),(2,'Processed'),(3,'Denied'),(4,'Shipped'),(5,'Delivered'),(6,'Canceled'),(7,'Refund'),(8,'Active');
/*!40000 ALTER TABLE `order_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL auto_increment,
  `sessionID` varchar(64) NOT NULL,
  `trans_id` varchar(40) NOT NULL,
  `userID` int(11) NOT NULL,
  `shippingID` int(11) NOT NULL,
  `billingID` int(11) NOT NULL,
  `paymentID` int(11) NOT NULL,
  `statusID` int(11) NOT NULL,
  `shipping_method_id` int(5) NOT NULL,
  `shipping_method` varchar(128) NOT NULL,
  `payment_method` varchar(128) NOT NULL,
  `options` text NOT NULL,
  `discounts` varchar(255) NOT NULL,
  `customer_ip` varchar(15) NOT NULL,
  `order_qty` int(5) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `shipping_total` decimal(10,2) NOT NULL,
  `order_delivery_date` date NOT NULL,
  `order_date` datetime NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL,
  `comment` text NOT NULL,
  `can_share` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (62,'e1f7d0f2dabc9efbee67bec659fbe667','MCH1338504580',11,129,130,7,2,1,'','','','','192.168.1.1',0,'108.85','108.85','24.85','2012-06-22','2012-05-31 18:51:57',1338504580,1338504717,'',1),(58,'35f38d8ac243d69ea3ff493137d4e632','MCH1338419276',15,122,123,0,2,1,'','','','','192.168.1.1',0,'4473.00','0.00','0.00','2012-05-31','0000-00-00 00:00:00',1338419276,1338419343,'',1),(60,'40ab6e1e05f78d0c275a6e9f8b43d215','MCH1338481406',0,0,0,0,1,0,'','','','','192.168.1.1',0,'245.00','245.00','0.00','0000-00-00','0000-00-00 00:00:00',1338481406,1338481406,'',0),(55,'e39e9025b24482c73756236c7dd5304f','EC-6XD34166TL429773U',5,113,114,5,1,1,'','','','','67.208.188.214',0,'277.85','277.85','32.85','2012-06-14','2012-05-30 15:34:04',1338316217,1338406444,'',1),(51,'606c616d6a02acad58232dfb9f305f4a','MCH1337875430',5,104,105,5,2,1,'','','','','192.168.1.1',0,'149.50','0.00','0.00','2012-05-31','0000-00-00 00:00:00',1337875430,1337893603,'',1),(52,'c037f694e39cd337c5a0029e56b83d19','EC-7R791877Y4070112M',11,105,106,5,2,1,'','','','','192.168.1.1',0,'713.00','0.00','0.00','2012-06-30','0000-00-00 00:00:00',1337875677,1337961745,'',1),(59,'f1591fa26b0346356f1c3eb9eeae3968','MCH1338481176',0,0,0,0,1,0,'','','','','192.168.1.1',0,'601.00','0.00','0.00','0000-00-00','0000-00-00 00:00:00',1338481176,1338481176,'',0),(72,'fb7c9f43df00852cf25754344c74bd19','MCH1338697112',14,151,152,17,2,1,'','','','','72.46.219.36',0,'266.85','266.85','32.85','2012-06-29','2012-06-03 00:21:51',1338697112,1338697311,'',1),(54,'35f38d8ac243d69ea3ff493137d4e632','EC-0TR7900097826932S',9,127,128,5,1,1,'','','','','192.168.1.1',0,'84.00','84.00','0.00','2012-06-01','0000-00-00 00:00:00',1338304639,1338497413,'',1),(56,'35f38d8ac243d69ea3ff493137d4e632','MCH1338328292',9,121,122,0,1,1,'','','','','192.168.1.1',0,'84.00','0.00','0.00','2012-05-31','0000-00-00 00:00:00',1338328292,1338410049,'',1),(57,'3d418d39c767e34c58311b659043e193','EC-2MM586658P8595923',5,128,129,6,2,1,'','','','','192.168.1.1',0,'708.35','708.35','79.85','2012-06-14','2012-05-31 16:54:36',1338406651,1338497676,'',1),(63,'4288e5610a1af6d52b6a81243663414e','MCH1338505591',11,141,142,12,2,1,'','','','','192.168.1.1',0,'194.85','194.85','26.85','2012-06-28','2012-05-31 19:26:53',1338505591,1338506813,'',1),(64,'da5f46816dacb878b3b4c343968a8cbc','MCH1338505986',5,137,138,8,2,1,'','','','','192.168.1.1',0,'266.85','266.85','32.85','2012-06-14','2012-05-31 19:13:28',1338505986,1338506008,'',1),(65,'6c0c80fd229b06141631f0bc4bd7b90d','MCH1338506177',5,138,139,0,2,1,'','','','','192.168.1.1',0,'176.35','176.35','26.85','2012-06-14','2012-05-31 19:17:45',1338506177,1338506265,'',1),(66,'1d9164ea4a4dc1ba1463520325d826d1','MCH1338506415',5,139,140,10,2,1,'','','','','192.168.1.1',0,'277.85','277.85','32.85','2012-06-14','2012-05-31 19:20:39',1338506415,1338506439,'',1),(67,'28a0e781bf777af6b99dd4dc65b926dc','MCH1338506635',5,140,141,11,2,1,'','','','','192.168.1.1',0,'538.85','538.85','48.85','2012-06-14','2012-05-31 19:24:20',1338506635,1338506660,'',0),(68,'c488a50515f1d879018dd76a05bf7990','EC-39D76472E53365439',11,145,146,0,1,1,'','','','','192.168.1.1',0,'318.00','318.00','0.00','2012-06-29','0000-00-00 00:00:00',1338506847,1338507275,'',1),(69,'6ed615bad9d78f0427eaad4dfdd8ca0f','EC-57U48204CW820541K',5,146,147,15,2,1,'','','','','192.168.1.1',0,'538.85','538.85','48.85','2012-06-15','2012-06-01 11:03:13',1338560270,1338562993,'',1),(70,'819b8c8797816cebcb2f8488add1b0c9','EC-9HU67415071033521',5,147,148,16,2,1,'','','','','192.168.1.1',0,'277.85','277.85','32.85','2012-06-22','2012-06-01 11:06:04',1338563076,1338563164,'',0),(71,'b6d9748b72c425ee9444e86bf1f70325','MCH1338563609',5,149,150,0,3,1,'','','','','192.168.1.1',0,'479.00','479.00','0.00','2012-06-15','0000-00-00 00:00:00',1338563609,1338565874,'',1),(73,'43186aac504778e38f0729326e754b1e','MCH1338697791',0,0,0,0,1,0,'','','','','72.46.219.36',0,'84.00','84.00','0.00','0000-00-00','0000-00-00 00:00:00',1338697791,1338697791,'',0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_addresses`
--

DROP TABLE IF EXISTS `orders_addresses`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `orders_addresses` (
  `id` int(5) NOT NULL auto_increment,
  `shipping_first_name` varchar(32) default NULL,
  `shipping_last_name` varchar(32) default NULL,
  `shipping_company` varchar(32) default NULL,
  `shipping_address1` varchar(128) default NULL,
  `shipping_address2` varchar(128) default NULL,
  `shipping_city` varchar(128) default NULL,
  `shipping_state` varchar(30) default NULL,
  `shipping_zip` varchar(10) default NULL,
  `shipping_country` varchar(128) default NULL,
  `billing_first_name` varchar(32) default NULL,
  `billing_last_name` varchar(32) default NULL,
  `billing_company` varchar(32) default NULL,
  `billing_address1` varchar(128) default NULL,
  `billing_address2` varchar(128) default NULL,
  `billing_city` varchar(128) default NULL,
  `billing_state` varchar(30) default NULL,
  `billing_zip` varchar(10) default NULL,
  `billing_country` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `orders_addresses`
--

LOCK TABLES `orders_addresses` WRITE;
/*!40000 ALTER TABLE `orders_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_baskets`
--

DROP TABLE IF EXISTS `orders_baskets`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `orders_baskets` (
  `id` int(11) NOT NULL auto_increment,
  `order_id` int(11) default NULL,
  `product_id` int(11) default NULL,
  `flavor_id` int(11) NOT NULL,
  `foil_id` int(11) NOT NULL,
  `msg_text1` varchar(100) default NULL,
  `msg_text2` varchar(100) default NULL,
  `msg_text1font` varchar(50) default NULL,
  `msg_text2font` varchar(50) default NULL,
  `msg_text1size` tinyint(3) default NULL,
  `msg_text2size` tinyint(3) default NULL,
  `msg_text1color` varchar(50) default NULL,
  `msg_text2color` varchar(50) default NULL,
  `style_id` varchar(5) NOT NULL default '1',
  `clippath` varchar(100) default NULL,
  `designpath` varchar(100) default NULL,
  `design_color` varchar(50) default NULL,
  `rate` decimal(10,2) NOT NULL,
  `qty` int(11) default NULL,
  `options` text,
  `subtotal` decimal(15,4) default NULL,
  `img_approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=175 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `orders_baskets`
--

LOCK TABLES `orders_baskets` WRITE;
/*!40000 ALTER TABLE `orders_baskets` DISABLE KEYS */;
INSERT INTO `orders_baskets` VALUES (89,43,2,1,6,'LShana Tova!','NULL','fntArial','fntArial',16,14,'forest green','blue','1','/chocolates/clipArts/Jewish/jew11.png','/env/chocolate_designs/cho1337291451.png',NULL,'2.89',150,NULL,'433.5000',0),(85,42,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/files/Hydrangeas.jpg','/env/chocolate_designs/cho1337181048.png',NULL,'0.39',600,NULL,'234.0000',0),(86,42,2,1,6,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/clipArts/Americana/amr10.png','/env/chocolate_designs/cho1337182084.png',NULL,'2.99',50,NULL,'149.5000',0),(87,41,2,1,6,'ghhhhhg','NULL','fntImpact','fntArial',14,14,'pink','blue','1','/chocolates/files/Truffles - Deluxe.png','/env/chocolate_designs/cho1337205512.png',NULL,'2.99',50,NULL,'149.5000',0),(88,41,3,1,7,'I love you!','NULL','fntArial','fntArial',14,14,'Yellow','blue','1','/chocolates/files/Chocolate Coins - Custom.png','/env/chocolate_designs/cho1337205640.png',NULL,'0.49',500,NULL,'245.0000',0),(20,20,4,1,7,'asdasdasdasd','NULL','fntArial','NULL',27,NULL,'yellow','NULL','1',NULL,'/env/chocolate_designs/cho1334330107.png',NULL,'0.80',300,NULL,'240.0000',0),(22,21,3,1,7,'asdasdasda','NULL','fntArial','NULL',23,NULL,'royal blue','NULL','1',NULL,'/env/chocolate_designs/cho1334608334.png',NULL,'0.80',300,NULL,'240.0000',0),(81,40,2,1,6,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1337023471.png',NULL,'2.99',50,NULL,'149.5000',0),(82,38,4,1,6,'My Holiday Heart!','NULL','fntArial','NULL',14,12,'PMS 109','NULL','1','/chocolates/clipArts/Americana/amr12.png','/env/chocolate_designs/cho1337140933.png',NULL,'0.39',600,NULL,'234.0000',0),(80,41,2,1,6,'dfgdfg','fgfgfd','fntArial','fntAdorable',14,14,'forest green','blue','1','','/env/chocolate_designs/cho1337023466.png',NULL,'2.99',50,NULL,'149.5000',0),(79,39,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1337018409.png',NULL,'0.49',500,NULL,'245.0000',0),(78,39,2,1,6,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1337018295.png',NULL,'2.99',50,NULL,'149.5000',0),(77,39,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1337017957.png',NULL,'0.49',500,NULL,'245.0000',0),(74,39,1,1,8,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','',NULL,'0.50',20,NULL,'10.0000',0),(75,39,1,1,7,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','',NULL,'0.50',20,NULL,'10.0000',0),(76,39,2,2,6,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1337017869.png',NULL,'2.99',50,NULL,'149.5000',0),(83,38,3,1,7,'Happy Birthday!','NULL','fntArial','fntArial',27,14,'Green','blue','1','','/env/chocolate_designs/cho1337141019.png',NULL,'0.49',550,NULL,'269.5000',0),(84,38,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/files/405560_2967103573696_1144869734_3266540_950016614_n.jpg','/env/chocolate_designs/cho1337141089.png',NULL,'0.39',600,NULL,'234.0000',0),(72,38,2,1,6,'Happy Birthday!','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/clipArts/Birthday/bir9.png','/env/chocolate_designs/cho1336946617.png',NULL,'2.99',50,NULL,'149.5000',0),(70,37,1,1,13,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','',NULL,'0.24',900,NULL,'216.0000',0),(71,37,3,1,7,'erererewr','erererer','fntAntasia','fntArial',25,14,'Yellow','Black','1','/chocolates/clipArts/Asian/asi4.png','/env/chocolate_designs/cho1336852196.png',NULL,'0.49',500,NULL,'245.0000',0),(69,36,3,1,7,'Happy Birthday Mom','Youre the best!','fntArial','fntArial',14,14,'blue','Violet','1','/chocolates/clipArts/Birthday/bir13.png','/env/chocolate_designs/cho1336776792.png',NULL,'0.49',500,NULL,'245.0000',0),(68,36,2,1,6,'Happy Holidays!','Love you very much','fntArial','fntArial',25,14,'red','blue','1','/chocolates/clipArts/SunMoon/sms10.png','/env/chocolate_designs/cho1336776694.png',NULL,'2.89',150,NULL,'433.5000',0),(67,35,2,1,7,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','/env/chocolate_designs/cho1334608334.png',NULL,'0.28',305,NULL,'85.4000',0),(90,44,4,1,6,'I love you','NULL','fntArial','NULL',14,12,'PMS 212','NULL','1','/chocolates/clipArts/Sweet16/SWT4.png','/env/chocolate_designs/cho1337292071.png',NULL,'0.39',600,NULL,'234.0000',0),(91,45,1,1,13,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','',NULL,'0.28',300,NULL,'84.0000',0),(92,46,1,1,7,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','',NULL,'0.28',300,NULL,'84.0000',0),(93,46,3,1,7,'1 apple a daykeeps','the dentist away!','fntArial','fntArial',19,19,'Black','Yellow','1','/chocolates/clipArts/Medical/med11.png','/env/chocolate_designs/cho1337350651.png',NULL,'0.49',500,NULL,'245.0000',0),(94,42,1,1,7,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','',NULL,'0.28',300,NULL,'84.0000',0),(95,47,1,1,7,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','',NULL,'0.28',300,NULL,'84.0000',0),(96,46,4,1,6,'Eagle Attack!','NULL','fntArial','NULL',16,12,'PMS 109','NULL','1','/chocolates/clipArts/Americana/amr11.png','/env/chocolate_designs/cho1337373683.png','Metallic Silver','0.39',600,NULL,'234.0000',0),(97,48,3,1,7,'Hello','USA','fntArial','fntArial',14,14,'White','White','1','/chocolates/clipArts/Americana/amr10.png','/env/chocolate_designs/cho1337612006.png','White','0.49',500,NULL,'245.0000',0),(98,48,3,1,7,'text','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/files/Merrimack.png','/env/chocolate_designs/cho1337612314.png','NULL','0.49',500,NULL,'245.0000',0),(101,50,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1337830831.png','NULL','0.49',500,NULL,'245.0000',0),(102,51,2,1,6,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1337875430.png','NULL','2.99',50,NULL,'149.5000',0),(100,49,1,1,13,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','','NULL','0.28',300,NULL,'84.0000',0),(103,52,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/clipArts/Americana/amr12.png','/env/chocolate_designs/cho1337875677.png','NULL','0.39',600,NULL,'234.0000',0),(104,52,3,1,7,'test','this is a test','fntArial','fntArial',14,14,'White','Yellow','1','/chocolates/clipArts/Americana/amr11.png','/env/chocolate_designs/cho1337961519.png','NULL','0.49',500,NULL,'245.0000',0),(105,52,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/files/41Uj7gDl3rL._AA300_.png','/env/chocolate_designs/cho1337986065.png','PMS 109','0.39',600,NULL,'234.0000',0),(106,53,2,1,6,'dffdfd','dfdfdf','fntArial','fntAntasia',14,14,'blue','blue','1','/chocolates/files/cfw 3b.png','/env/chocolate_designs/cho1338002929.png','black','2.99',50,NULL,'149.5000',0),(107,53,4,1,6,'RON & LISA','NULL','fntCaeldera','NULL',14,12,'Navy Blue PMS 281','NULL','1','/chocolates/files/corazon.png','/env/chocolate_designs/cho1338003911.png','NULL','0.39',600,NULL,'234.0000',0),(136,57,2,1,6,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/files/dubuffet11.png','/env/chocolate_designs/cho1338465310.png','NULL','2.99',50,NULL,'149.5000',0),(164,63,1,1,7,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','','NULL','0.28',300,NULL,'84.0000',0),(109,55,3,1,7,'sdasdad','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1338316217.png','NULL','0.49',500,NULL,'245.0000',0),(110,56,1,1,7,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','','NULL','0.28',300,NULL,'84.0000',0),(116,58,3,1,7,'Congrats','Graduate','fntArial','fntArial',14,14,'Yellow','Yellow','1','/chocolates/clipArts/Graduation/grd5.png','/env/chocolate_designs/cho1338419555.png','Yellow','0.49',500,NULL,'245.0000',1),(112,57,3,1,7,'America!','NULL','fntArial','fntArial',32,14,'Blue','blue','1','/chocolates/clipArts/Americana/amr12.png','/env/chocolate_designs/cho1338406651.png','White','0.49',500,NULL,'245.0000',0),(115,58,2,1,6,'Merry','Christmas!','fntArial','fntArial',20,20,'red','red','1','/chocolates/clipArts/Christmas/chr2.png','/env/chocolate_designs/cho1338419484.png','forest green','2.99',50,NULL,'149.5000',0),(117,58,3,1,7,'I Love','You','fntAdorable','fntAdorable',52,52,'White','White','1','','/env/chocolate_designs/cho1338419616.png','NULL','0.49',500,NULL,'245.0000',1),(118,58,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/clipArts/Gaming/gam2.png','/env/chocolate_designs/cho1338419852.png','PMS 215','0.39',600,NULL,'234.0000',1),(119,58,2,1,6,'The','Knights','fntArial','fntArial',14,14,'black','black','1','/chocolates/files/HiRes.png','/env/chocolate_designs/cho1338420004.png','NULL','2.99',50,NULL,'149.5000',1),(120,58,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/clipArts/Engagements/eng3.png','/env/chocolate_designs/cho1338420121.png','White','0.49',500,NULL,'245.0000',1),(121,58,4,1,6,'Polar Design','NULL','fntImpact','NULL',26,12,'Reflex Blue','NULL','1','','/env/chocolate_designs/cho1338420320.png','NULL','0.39',600,NULL,'234.0000',1),(122,58,2,1,6,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/files/OperationSmileHeart.png','/env/chocolate_designs/cho1338420547.png','NULL','2.99',50,NULL,'149.5000',1),(123,58,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/clipArts/Wedding/wed43.png','/env/chocolate_designs/cho1338420794.png','Black','0.39',600,NULL,'234.0000',1),(124,58,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/clipArts/Asian/asi4.png','/env/chocolate_designs/cho1338420863.png','White','0.39',600,NULL,'234.0000',1),(125,58,3,1,7,'4th of','July!','fntArial','fntArial',24,24,'Blue','Blue','1','/chocolates/clipArts/Americana/amr8.png','/env/chocolate_designs/cho1338420955.png','Blue','0.49',500,NULL,'245.0000',1),(126,58,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/clipArts/Birthday/bir36.png','/env/chocolate_designs/cho1338421033.png','PMS 215','0.39',600,NULL,'234.0000',1),(127,58,2,1,6,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/clipArts/Baby/nbb5.png','/env/chocolate_designs/cho1338422150.png','royal blue','2.99',50,NULL,'149.5000',1),(128,58,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/clipArts/Emoticons/emo2.png','/env/chocolate_designs/cho1338422213.png','PMS 109','0.39',600,NULL,'234.0000',1),(129,58,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/clipArts/Business/bus15.png','/env/chocolate_designs/cho1338422264.png','PMS 349','0.39',600,NULL,'234.0000',1),(130,58,3,1,7,'Be Mine!','NULL','fntArial','fntArial',46,14,'Pink','blue','1','/chocolates/clipArts/StValantines/svd18.png','/env/chocolate_designs/cho1338422430.png','Pink','0.49',500,NULL,'245.0000',1),(131,58,2,1,6,'Happy','Mothers Day','fntArial','fntArial',25,18,'blue','royal blue','1','/chocolates/clipArts/Wedding/qui25.png','/env/chocolate_designs/cho1338422650.png','pink','2.99',50,NULL,'149.5000',1),(132,58,4,1,6,'Congrats!!','NULL','fntArial','NULL',23,12,'Black','NULL','1','','/env/chocolate_designs/cho1338422788.png','NULL','0.39',600,NULL,'234.0000',1),(133,58,3,1,7,'Happy Birthday','NULL','fntCentury','fntArial',18,14,'White','blue','1','/chocolates/clipArts/Birthday/bir7.png','/env/chocolate_designs/cho1338422848.png','White','0.49',500,NULL,'245.0000',1),(134,58,2,1,6,'Bachelorette','Party!','fntBrushScript','fntBrushScript',27,31,'pink','pink','1','/chocolates/clipArts/Gaming/gam25.png','/env/chocolate_designs/cho1338423010.png','black','2.99',50,NULL,'149.5000',1),(135,58,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/clipArts/Angels/ang2.png','/env/chocolate_designs/cho1338423051.png','White','0.39',600,NULL,'234.0000',1),(137,59,4,1,6,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/clipArts/Americana/amr11.png','/env/chocolate_designs/cho1338481176.png','PMS 328','0.39',800,NULL,'312.0000',0),(138,60,3,1,7,'text','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1338481406.png','NULL','0.49',500,NULL,'245.0000',0),(139,59,2,1,6,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/clipArts/Americana/amr11.png','/env/chocolate_designs/cho1338481517.png','pink','2.89',100,NULL,'289.0000',0),(163,67,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1338506636.png','NULL','0.49',500,NULL,'245.0000',0),(152,57,4,1,15,'QWERTY','NULL','fntArial','NULL',14,12,'blue','NULL','1','','/env/chocolate_designs/cho1338491763.png','NULL','0.39',600,NULL,'234.0000',0),(155,54,1,1,7,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','','NULL','0.28',300,NULL,'84.0000',0),(156,61,4,1,7,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','','/env/chocolate_designs/cho1338497899.png','NULL','0.39',600,NULL,'234.0000',0),(157,62,1,1,7,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','','NULL','0.28',300,NULL,'84.0000',0),(158,63,1,1,18,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','','NULL','0.28',300,NULL,'84.0000',0),(159,64,4,1,7,'aasd','NULL','fntArial','NULL',14,12,'blue','NULL','1','','/env/chocolate_designs/cho1338505986.png','NULL','0.39',600,NULL,'234.0000',0),(160,65,2,1,6,'asdasd','asdasd','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1338506177.png','NULL','2.99',50,NULL,'149.5000',0),(161,66,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1338506415.png','NULL','0.49',500,NULL,'245.0000',0),(162,67,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','','/env/chocolate_designs/cho1338506635.png','NULL','0.49',500,NULL,'245.0000',0),(165,68,1,1,7,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','','NULL','0.28',300,NULL,'84.0000',0),(166,69,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/files/test2.png','/env/chocolate_designs/cho1338560270.png','NULL','0.49',500,NULL,'245.0000',0),(167,69,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/files/test2.png','/env/chocolate_designs/cho1338562839.png','NULL','0.49',500,NULL,'245.0000',0),(168,70,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/clipArts/Americana/amr11.png','/env/chocolate_designs/cho1338563076.png','NULL','0.49',500,NULL,'245.0000',0),(170,71,3,1,7,'NULL','NULL','fntArial','fntArial',14,14,'blue','blue','1','/chocolates/clipArts/Americana/amr11.png','/env/chocolate_designs/cho1338563609.png','NULL','0.49',500,NULL,'245.0000',0),(171,71,4,1,7,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/clipArts/Americana/amr14.png','/env/chocolate_designs/cho1338563625.png','NULL','0.39',600,NULL,'234.0000',0),(172,68,4,1,15,'black and yellow','NULL','fntArial','NULL',14,12,'blue','NULL','1','','/env/chocolate_designs/cho1338563743.png','NULL','0.39',600,NULL,'234.0000',0),(173,72,4,1,15,'NULL','NULL','fntArial','NULL',14,12,'blue','NULL','1','/chocolates/files/corazon.png','/env/chocolate_designs/cho1338697112.png','Blue','0.39',600,NULL,'234.0000',1),(174,73,1,1,8,'NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL','1','','','NULL','0.28',300,NULL,'84.0000',0);
/*!40000 ALTER TABLE `orders_baskets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `headline` varchar(100) default NULL,
  `url` varchar(255) NOT NULL,
  `parentID` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Home','','http://mch.beta.polardesign.com/',0),(2,'Products','','http://mch.beta.polardesign.com/products',1),(3,'Shopping Cart','','http://mch.beta.polardesign.com/shopping_cart',1),(4,'FAQ','','http://mch.beta.polardesign.com/faq',1),(5,'About Us','','http://mch.beta.polardesign.com/about',1),(6,'Contact Us','','http://mch.beta.polardesign.com/contact',1),(7,'Occasion','','http://mch.beta.polardesign.com/occasion',0),(8,'Testimonials','','http://mch.beta.polardesign.com/testimonials',0),(9,'Shipping and Terms','','http://mch.beta.polardesign.com/terms',0),(10,'Sitemap','','http://mch.beta.polardesign.com/sitemap',0),(11,'Shipping Policies',NULL,'http://mch.beta.poardesign.com/shipping_policies',1);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_status`
--

DROP TABLE IF EXISTS `payment_status`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `payment_status` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `payment_status`
--

LOCK TABLES `payment_status` WRITE;
/*!40000 ALTER TABLE `payment_status` DISABLE KEYS */;
INSERT INTO `payment_status` VALUES (2,'Payment Pending'),(1,'Not Paid'),(3,'Paid');
/*!40000 ALTER TABLE `payment_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL auto_increment,
  `transaction_number` varchar(50) NOT NULL,
  `statusID` int(11) NOT NULL,
  `transaction_date` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (2,'2170921199',3,1334350289),(3,'EC-51398383NU7718818',3,1337293274),(4,'2172333145',3,1338406270),(5,'2172333204',3,1338406444),(6,'EC-2MM586658P8595923',3,1338497676),(7,'2172393886',3,1338504717),(8,'2172394283',3,1338506008),(9,'2172394358',3,1338506265),(10,'2172394433',3,1338506439),(11,'2172394488',3,1338506660),(12,'2172394555',3,1338506813),(13,'EC-57U48204CW820541K',3,1338562924),(14,'EC-57U48204CW820541K',3,1338562952),(15,'EC-57U48204CW820541K',3,1338562993),(16,'EC-9HU67415071033521',3,1338563164),(17,'2172481971',3,1338697311);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_colors`
--

DROP TABLE IF EXISTS `product_colors`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `product_colors` (
  `productID` int(11) NOT NULL,
  `colorID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `product_colors`
--

LOCK TABLES `product_colors` WRITE;
/*!40000 ALTER TABLE `product_colors` DISABLE KEYS */;
INSERT INTO `product_colors` VALUES (1,5),(1,6),(1,7),(2,5),(2,6),(2,7),(3,5),(3,6),(3,7),(4,5),(4,6),(4,7);
/*!40000 ALTER TABLE `product_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_costs`
--

DROP TABLE IF EXISTS `product_costs`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `product_costs` (
  `id` int(11) NOT NULL auto_increment,
  `productID` int(11) NOT NULL,
  `qty_start` int(11) default NULL,
  `qty_end` int(11) default NULL,
  `price` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `product_costs`
--

LOCK TABLES `product_costs` WRITE;
/*!40000 ALTER TABLE `product_costs` DISABLE KEYS */;
INSERT INTO `product_costs` VALUES (2,1,250,399,0.28),(3,1,400,749,0.26),(4,1,750,2499,0.24),(5,1,2500,0,0.22),(6,2,25,99,2.99),(7,2,100,249,2.89),(8,2,250,999,2.69),(9,2,1000,0,2.59),(10,3,500,749,0.49),(11,3,750,999,0.46),(12,3,1000,2499,0.43),(13,3,2500,0,0.37),(14,4,600,1199,0.39),(15,4,1200,2499,0.29),(16,4,2500,4999,0.27),(17,4,5000,0,0.23);
/*!40000 ALTER TABLE `product_costs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_flavors`
--

DROP TABLE IF EXISTS `product_flavors`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `product_flavors` (
  `productID` int(11) NOT NULL,
  `flavorID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `product_flavors`
--

LOCK TABLES `product_flavors` WRITE;
/*!40000 ALTER TABLE `product_flavors` DISABLE KEYS */;
INSERT INTO `product_flavors` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(4,1);
/*!40000 ALTER TABLE `product_flavors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `product_images` (
  `productID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_quantity_limits`
--

DROP TABLE IF EXISTS `product_quantity_limits`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `product_quantity_limits` (
  `productID` int(11) NOT NULL,
  `qty_start` int(11) default NULL,
  `qty_end` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `product_quantity_limits`
--

LOCK TABLES `product_quantity_limits` WRITE;
/*!40000 ALTER TABLE `product_quantity_limits` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_quantity_limits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_styles`
--

DROP TABLE IF EXISTS `product_styles`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `product_styles` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `product_styles`
--

LOCK TABLES `product_styles` WRITE;
/*!40000 ALTER TABLE `product_styles` DISABLE KEYS */;
INSERT INTO `product_styles` VALUES (1,'Heart Favour'),(2,'Lollypop');
/*!40000 ALTER TABLE `product_styles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `production_times`
--

DROP TABLE IF EXISTS `production_times`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `production_times` (
  `id` int(11) NOT NULL auto_increment,
  `days_start` int(5) NOT NULL,
  `days_end` int(5) NOT NULL,
  `readable` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `production_times`
--

LOCK TABLES `production_times` WRITE;
/*!40000 ALTER TABLE `production_times` DISABLE KEYS */;
INSERT INTO `production_times` VALUES (1,2,3,'2 - 3 Business Days'),(2,5,7,'5 - 7 Business Days');
/*!40000 ALTER TABLE `production_times` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `products` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `size` varchar(100) default NULL,
  `production_time` int(11) default NULL,
  `other_info` text,
  `products_description_id` int(5) NOT NULL,
  `products_inventory_id` int(11) NOT NULL,
  `is_shippable` tinyint(1) NOT NULL default '0',
  `status` tinyint(1) NOT NULL,
  `sort_order` int(5) NOT NULL,
  `products_type_id` int(5) NOT NULL,
  `options` text NOT NULL,
  `attributes` text NOT NULL,
  `tax_ids` text NOT NULL,
  `shipping_info` text NOT NULL,
  `price` decimal(15,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Foiled Chocolate Hearts','1.25 x 1.25',1,NULL,1,1,1,1,0,1,'a:0:{}','a:0:{}','a:1:{i:0;s:1:\"1\";}','a:0:{}','0.22'),(2,'Full Color Chocolate Hearts','2.75 x 2.75',1,NULL,2,11,0,0,0,0,'a:0:{}','a:0:{}','a:1:{i:0;s:1:\"0\";}','a:0:{}','2.59'),(3,'Custom Chocolate Heart - Centered','1.25 x 1.25',1,NULL,3,12,0,0,0,0,'a:0:{}','a:0:{}','a:1:{i:0;s:1:\"0\";}','a:0:{}','0.37'),(4,'Custom Chocolate Heart - Step n Repeat','1.25 x 1.25',1,NULL,4,13,0,0,0,0,'a:0:{}','a:0:{}','a:1:{i:0;s:1:\"0\";}','a:0:{}','0.23');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_descriptions`
--

DROP TABLE IF EXISTS `products_descriptions`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `products_descriptions` (
  `id` int(5) NOT NULL auto_increment,
  `description` text,
  `short_description` text,
  `production_times` text,
  `meta_title` text,
  `meta_description` text,
  `meta_keywords` text,
  `title_url` varchar(255) default NULL,
  `image` varchar(255) default NULL,
  `image_alt` varchar(255) default NULL,
  `video` varchar(126) default NULL,
  `date_added` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `products_descriptions`
--

LOCK TABLES `products_descriptions` WRITE;
/*!40000 ALTER TABLE `products_descriptions` DISABLE KEYS */;
INSERT INTO `products_descriptions` VALUES (1,'<p><span style=\"text-align: left; line-height: 18px; font-family: Arial, Helvetica, sans-serif; color: rgb(102,102,102)\">Now you have the power! Create your own foiled chocolate heart by choosing your perfect foil color and chocolate flavor combinations.</span><font color=\"#666666\" face=\"Arial, Helvetica, sans-serif\"><span style=\"line-height: 18px\"><br />\n</span></font>Size: 1.25\" x 1.25\"</p>','<p><span style=\"text-align: left; line-height: 20px; font-family: Arial, Helvetica, sans-serif; color: rgb(51,51,51)\">Now you have the power! Create your own foiled chocolate heart by choosing your perfect foil color and chocolate flavor combinations.</span></p>','<p>Production Time: 3-5 Business days</p>\n<p>Please call 1-866-230-7730 if you need to rush this order</p>','Custom Foiled Chocolate Hearts Product Builder - MyChocolateHearts.com: Choose custom foil and flavor combinations','Product Builder for custom foild chocolate hearts. Flash required','','foiled_chocolate_hearts','1334253638-Chocolate_Hearts_-_Red_Pile.png','Foiled Chocolate Hearts','foiledPreloader.swf','0000-00-00 00:00:00'),(3,'<p><span style=\"text-align: left; line-height: 20px; font-family: Arial, Helvetica, sans-serif; color: rgb(51,51,51)\">Create your very own foiled chocolate heart with a custom message or logo placed in the center of the heart. Available in Red Foil only.</span><font color=\"#333333\" face=\"Arial, Helvetica, sans-serif\"><span style=\"line-height: 20px\"><br />\n</span></font>Size: 1.25\" x 1.25\"</p>','<p><span style=\"text-align: left; line-height: 20px; font-family: Arial, Helvetica, sans-serif; color: rgb(51,51,51)\">Create your very own foiled chocolate heart with a custom message or logo placed in the center of the heart. Available in Red Foil only.</span></p>','<p>Production Time: 7-10 business days</p>\n<p>RUSH ORDERS AVAILABLE<br />\nCall 1-866-230-7730</p>','Custom Foiled Chocolate Hearts with Text and Images Product Builder - MyChocolateHearts.com: Your text or logo printed on a foiled chocolate heart','Product Builder for custom chocolate heart (centered). Create a  colored chocolate with your image and text printed on the foil','','custom_chocolate_heart_centered','1334253674-red_chocolate_heart_custom__centered.png','Custom Chocolate Heart - Centered','customPreloader.swf','2012-04-11 13:25:00'),(4,'<p><span style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 20px; text-align: left; \">Add your personal touch or promote your company by adding your message or logo all over our delicious Foiled Chocolate Hearts. Available in Red, Silver, and Gold.</span><font color=\"#333333\" face=\"Arial, Helvetica, sans-serif\"><span style=\"line-height: 20px;\"><br />\n</span></font></p>','<p><span style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 20px; text-align: left; \">Add your personal touch or promote your company by adding your message or logo all over our delicious Foiled Chocolate Hearts. Available in Red, Silver, Gold and Pink.</span></p>','','Custom Foiled Chocolate Hearts with Text and Images Repeated Product Builder - MyChocolateHearts.com: Your patterned text or logo printed on a foiled chocolate heart','Product Builder for custom chocolate heart (repeated). Create a full colored chocolate with your image or text repeated on the foil.','','custom_chocolate_heart_step_n_repeat','1334253699-Custom_Chocolate_Hearts_-Step__and_Repeat.png','Step and Repeat','stepPreloader.swf',NULL),(2,'<p><span style=\"text-align: left; line-height: 20px; font-family: Arial, Helvetica, sans-serif; color: rgb(51,51,51)\">Eat your photo or logo! These beautiful full-color imprinted Chocolate Hearts let your imagination fly high...very high. We use print directly on the chocolate with 100% edible inks.</span><font color=\"#333333\" face=\"Arial, Helvetica, sans-serif\"><span style=\"line-height: 20px\"><br />\nSize: 2.75\" x 2.75\"</span></font></p>','<p><span style=\"text-align: left; line-height: 20px; font-family: Arial, Helvetica, sans-serif; color: rgb(51,51,51)\">Eat your photo or logo! These beautiful full-color imprinted Chocolate Hearts let your imagination fly high...very high. We use print directly on the chocolate with 100% edible inks.</span> </p>','<p><span style=\"font-family: Arial; font-size: 15px; font-weight: bold\">Production Time: </span>5-10 business days</p>\n<p class=\"detailtext\" style=\"font-family: Arial; font-size: 15px\">RUSH ORDERS AVAILABLE</p>\n<p class=\"detailtext\" style=\"font-family: Arial; font-size: 15px\">Call 1-866-230-7730</p>','Custom Color Chocolate Hearts Product Builder - MyChocolateHearts.com: Eat your photo or logo','Product Builder for full color chocolate hearts. Create a full colored chocolate with your photo and text.','','full_color_chocolate_hearts','1334253655-Full_Color_Custom_Chocolate__Heart.png','Full Color Chocolate Hearts','fullcolorPreloader.swf','2012-04-11 13:22:25');
/*!40000 ALTER TABLE `products_descriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_inventories`
--

DROP TABLE IF EXISTS `products_inventories`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `products_inventories` (
  `id` int(11) NOT NULL auto_increment,
  `on_hand` int(11) NOT NULL,
  `amount_sold` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `products_inventories`
--

LOCK TABLES `products_inventories` WRITE;
/*!40000 ALTER TABLE `products_inventories` DISABLE KEYS */;
INSERT INTO `products_inventories` VALUES (1,500,148),(2,500,8),(3,500,1),(4,500,0),(5,500,1),(6,500,1),(7,500,0),(8,500,0),(9,500,15),(10,500,0),(11,0,0),(12,0,0),(13,0,0);
/*!40000 ALTER TABLE `products_inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_types`
--

DROP TABLE IF EXISTS `products_types`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `products_types` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_shippable` tinyint(1) NOT NULL default '0',
  `products_types_description_id` int(10) default NULL,
  `options` text,
  `attributes` text,
  `tax_ids` text,
  `shipping_info` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `products_types`
--

LOCK TABLES `products_types` WRITE;
/*!40000 ALTER TABLE `products_types` DISABLE KEYS */;
INSERT INTO `products_types` VALUES (1,'Chocolate Hearts',1,0,1,NULL,'a:1:{s:11:\"manufacture\";s:5:\"apple\";}','a:2:{i:0;i:1;i:1;i:2;}','a:7:{s:6:\"length\";s:0:\"\";s:5:\"width\";s:0:\"\";s:6:\"height\";s:0:\"\";s:18:\"productLengthClass\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:18:\"productWeightClass\";s:0:\"\";s:7:\"company\";a:6:{i:0;s:25:\"ups-next-day-air-early-am\";i:1;s:16:\"ups-next-day-air\";i:2;s:22:\"ups-next-day-air-saver\";i:3;s:18:\"ups-second-day-air\";i:4;s:16:\"ups-3-day-select\";i:5;s:10:\"ups-ground\";}}');
/*!40000 ALTER TABLE `products_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_types_descriptions`
--

DROP TABLE IF EXISTS `products_types_descriptions`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `products_types_descriptions` (
  `id` int(11) NOT NULL auto_increment,
  `description` text,
  `short_description` text,
  `meta_title` text,
  `meta_description` text,
  `meta_keywords` text,
  `title_url` varchar(100) default NULL,
  `image` varchar(100) default NULL,
  `image_alt` varchar(100) default NULL,
  `video` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `products_types_descriptions`
--

LOCK TABLES `products_types_descriptions` WRITE;
/*!40000 ALTER TABLE `products_types_descriptions` DISABLE KEYS */;
INSERT INTO `products_types_descriptions` VALUES (1,'','','','','','',NULL,'','');
/*!40000 ALTER TABLE `products_types_descriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_methods`
--

DROP TABLE IF EXISTS `shipping_methods`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `shipping_methods` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `shipping_methods`
--

LOCK TABLES `shipping_methods` WRITE;
/*!40000 ALTER TABLE `shipping_methods` DISABLE KEYS */;
INSERT INTO `shipping_methods` VALUES (1,'Ground (3-6 business days)'),(2,'2 Day Shipping'),(3,'Overnight');
/*!40000 ALTER TABLE `shipping_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_rates`
--

DROP TABLE IF EXISTS `shipping_rates`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `shipping_rates` (
  `id` int(11) NOT NULL auto_increment,
  `shipping_method_id` int(5) NOT NULL,
  `prc_start` double NOT NULL,
  `prc_end` double NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `shipping_rates`
--

LOCK TABLES `shipping_rates` WRITE;
/*!40000 ALTER TABLE `shipping_rates` DISABLE KEYS */;
INSERT INTO `shipping_rates` VALUES (1,1,0.01,99,24.85),(2,1,100,199,26.85),(3,1,200,299,32.85),(4,1,300,499,48.85),(5,1,500,999,79.85),(6,1,1000,1999,123.85),(7,1,2000,0,167.85),(8,2,0.01,99,32.75),(9,2,100,199,39.75),(10,2,200,299,49.75),(11,2,300,499,69.75),(12,2,500,999,98.75),(13,2,1000,1999,197.75),(14,2,2000,0,287.75),(15,3,0.01,99,44.95),(16,3,100,199,54.95),(17,3,200,299,67.95),(18,3,300,499,98.95),(19,3,500,999,189.95),(20,3,1000,1999,296.85),(21,3,2000,0,392.95);
/*!40000 ALTER TABLE `shipping_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `states` (
  `name` varchar(100) NOT NULL,
  `abbr` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES ('ALABAMA','AL'),('ALASKA','AK'),('AMERICAN SAMOA','AS'),('ARIZONA','AZ'),('ARKANSAS','AR'),('CALIFORNIA','CA'),('COLORADO','CO'),('CONNECTICUT','CT'),('DELAWARE','DE'),('DISTRICT OF COLUMBIA','DC'),('FEDERATED STATES OF MICRONESIA','FM'),('FLORIDA','FL'),('GEORGIA','GA'),('GUAM GU','GU'),('HAWAII','HI'),('IDAHO','ID'),('ILLINOIS','IL'),('INDIANA','IN'),('IOWA','IA'),('KANSAS','KS'),('KENTUCKY','KY'),('LOUISIANA','LA'),('MAINE','ME'),('MARSHALL ISLANDS','MH'),('MARYLAND','MD'),('MASSACHUSETTS','MA'),('MICHIGAN','MI'),('MINNESOTA','MN'),('MISSISSIPPI','MS'),('MISSOURI','MO'),('MONTANA','MT'),('NEBRASKA','NE'),('NEVADA','NV'),('NEW HAMPSHIRE','NH'),('NEW JERSEY','NJ'),('NEW MEXICO','NM'),('NEW YORK','NY'),('NORTH CAROLINA','NC'),('NORTH DAKOTA','ND'),('NORTHERN MARIANA ISLANDS','MP'),('OHIO','OH'),('OKLAHOMA','OK'),('OREGON','OR'),('PALAU','PW'),('PENNSYLVANIA','PA'),('PUERTO RICO','PR'),('RHODE ISLAND','RI'),('SOUTH CAROLINA','SC'),('SOUTH DAKOTA','SD'),('TENNESSEE','TN'),('TEXAS','TX'),('UTAH','UT'),('VERMONT','VT'),('VIRGIN ISLANDS','VI'),('VIRGINIA','VA'),('WASHINGTON','WA'),('WEST VIRGINIA','WV'),('WISCONSIN','WI'),('WYOMING','WY'),('Ontario','ON'),('Quebec','QC'),('British Columbia','BC'),('Alberta','AB'),('Manitoba','MB'),('Saskatchewan','SK'),('Nova Scotia','NS'),('New Brunswick','NB'),('Newfoundland and Labrador','NL'),('Prince Edward Island','PE'),('Northwest Territories','NT'),('Yukon','YT'),('Nunavut','NU');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_class_zones`
--

DROP TABLE IF EXISTS `tax_class_zones`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tax_class_zones` (
  `id` int(11) NOT NULL auto_increment,
  `tax_class_id` int(11) NOT NULL,
  `country` varchar(255) default NULL,
  `state` varchar(255) default NULL,
  `rate` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tax_class_zones`
--

LOCK TABLES `tax_class_zones` WRITE;
/*!40000 ALTER TABLE `tax_class_zones` DISABLE KEYS */;
INSERT INTO `tax_class_zones` VALUES (1,1,'US','RI',7);
/*!40000 ALTER TABLE `tax_class_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_classes`
--

DROP TABLE IF EXISTS `tax_classes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tax_classes` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tax_classes`
--

LOCK TABLES `tax_classes` WRITE;
/*!40000 ALTER TABLE `tax_classes` DISABLE KEYS */;
INSERT INTO `tax_classes` VALUES (1,'sales tax'),(2,'chocolate tax'),(3,'sales tax'),(4,'chocolate tax');
/*!40000 ALTER TABLE `tax_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_orders`
--

DROP TABLE IF EXISTS `temp_orders`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `temp_orders` (
  `id` int(11) NOT NULL auto_increment,
  `sessionID` varchar(64) NOT NULL,
  `productID` int(11) NOT NULL,
  `flavorID` varchar(11) NOT NULL,
  `foilID` varchar(11) NOT NULL,
  `order_msg_text1` varchar(40) default NULL,
  `order_msg_text2` varchar(40) default NULL,
  `order_msg_font1` varchar(35) default NULL,
  `order_msg_font2` varchar(35) default NULL,
  `order_msg_size1` tinyint(2) default NULL,
  `order_msg_size2` tinyint(2) default NULL,
  `order_msg_color1` varchar(10) default NULL,
  `order_msg_color2` varchar(10) default NULL,
  `styleID` int(5) NOT NULL default '1',
  `order_clip_path` text,
  `order_design_path` varchar(50) default NULL,
  `order_qty` int(11) NOT NULL,
  `order_rate` double NOT NULL,
  `order_total` double NOT NULL,
  `added` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `temp_orders`
--

LOCK TABLES `temp_orders` WRITE;
/*!40000 ALTER TABLE `temp_orders` DISABLE KEYS */;
INSERT INTO `temp_orders` VALUES (26,'04c0bfd2637d99a3a1cd922081bca029',1,'1','9','NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL',1,'',NULL,300,0.28,84,0),(1,'c61f21f5a11e8834564ddb1f70d45119',2,'1','6','qasdasdasd','weqweqweqwe','fntArial','fntArial',34,14,'blue','forest gre',1,'/env/chocolate_designs/cho1334129732.png',NULL,500,2.69,1345,0),(27,'04c0bfd2637d99a3a1cd922081bca029',1,'1','9','NULL','NULL','NULL','NULL',NULL,NULL,'NULL','NULL',1,'',NULL,300,0.28,84,0);
/*!40000 ALTER TABLE `temp_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) default NULL,
  `headline` varchar(100) default NULL,
  `description` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (11,'Hanna Broward','Madison, WI','','“MyChocolateHearts rocks! Love your products and will keep getting personalized chocolate hearts from you whenever there is a wedding in my family”'),(10,'Barbara Palacios','Miami, FL','','“I appreciate all your help in creating our beautiful custom chocolate hearts, some guests I have talked to after the wedding told me they have never seen such a unique chocolate favor. They loved them.”'),(8,'Patty O’Neal','Albuquerque, NM','','“The chocolates arrived! I have to admit that they exceed our expectations, thanks for making such a great product. We love our personalized chocolate hearts, I am sure our guests will love them too.”'),(9,'Sam Cummings','New York, NY','','“Thanks for making these 25,000 Chocolate Hearts with our logo in such a short time, they were a huge success in our Valentine’s Parade last week. We will order them again next year!'),(12,'Nancy Nguyen','San Francisco, CA','','“OK. I got the chocolates..I did not like them…I LOVED THEM!!!!! Thanks for making these spectacular wedding chocolate favors. Your custom foiled chocolate hearts are far beyond what I thought they were”'),(13,'Ryan Mervin','Orange, TX','','“I am glad I found you guys, I could not get Teal Chocolate Hearts anywhere else in the country. They go great with my event’s decoration…the chocolate is so tasty and the presentation is fantastic!”');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_billing_infos`
--

DROP TABLE IF EXISTS `user_billing_infos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `user_billing_infos` (
  `id` int(11) NOT NULL auto_increment,
  `userID` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) default NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone1` varchar(25) default NULL,
  `phone2` varchar(25) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user_billing_infos`
--

LOCK TABLES `user_billing_infos` WRITE;
/*!40000 ALTER TABLE `user_billing_infos` DISABLE KEYS */;
INSERT INTO `user_billing_infos` VALUES (152,14,'Freddy','Falck','','5239 Red BurrOak Trl','','Katy','TX','77494','US','2816606019',''),(151,14,'Freddy','Falck','','5239 Red BurrOak Trl','','Katy','TX','77494','US','2816606019',''),(141,5,'Alexander','Finger','Polar Design','600 Unicorn Dr','','Woburn','MA','01801','US','6172999294','6172999294'),(142,11,'Philip','Kowalski','','1 Belgravia Place','Apt 2','Boston','MA','02113','US','4145315321','4145315321'),(143,11,'Philip','Kowalski','','1 Belgravia Place','Apt 2','Boston','MA','02113','US','4145315321','4145315321'),(144,11,'Philip','Kowalski','','1 Belgravia Place','Apt 2','Boston','MA','02113','US','4145315321','4145315321'),(145,11,'Philip','Kowalski','','1 Belgravia Place','Apt 2','Boston','MA','02113','US','4145315321','4145315321'),(146,11,'Philip','Kowalski','','1 Belgravia Place','Apt 2','Boston','MA','02113','US','4145315321','4145315321'),(147,5,'Alexander','Finger','Polar Design','600 Unicorn Dr','','Woburn','MA','01801','US','6172999294','6172999294'),(148,5,'Alexander','Finger','Polar Design','600 Unicorn Dr','','Woburn','MA','01801','US','6172999294','6172999294'),(149,5,'Alexander','Finger','Polar Design','600 Unicorn Dr','','Woburn','MA','01801','US','6172999294','6172999294'),(150,5,'Alexander','Finger','Polar Design','600 Unicorn Dr','','Woburn','MA','01801','US','6172999294','6172999294');
/*!40000 ALTER TABLE `user_billing_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_shipping_infos`
--

DROP TABLE IF EXISTS `user_shipping_infos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `user_shipping_infos` (
  `id` int(11) NOT NULL auto_increment,
  `userID` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address1` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(2) default NULL,
  `zip` varchar(10) default NULL,
  `country` varchar(100) default NULL,
  `phone1` varchar(25) default NULL,
  `phone2` varchar(25) default NULL,
  `fax` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user_shipping_infos`
--

LOCK TABLES `user_shipping_infos` WRITE;
/*!40000 ALTER TABLE `user_shipping_infos` DISABLE KEYS */;
INSERT INTO `user_shipping_infos` VALUES (151,14,'Freddy','Falck','','5239 Red BurrOak Trl','','Katy','TX','77494','US',NULL,NULL,NULL),(150,14,'Freddy','Falck','','5239 Red BurrOak Trl','','Katy','TX','77494','US',NULL,NULL,NULL);
/*!40000 ALTER TABLE `user_shipping_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address1` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(2) default NULL,
  `zip` varchar(10) default NULL,
  `country` varchar(100) default NULL,
  `phone1` varchar(25) default NULL,
  `phone2` varchar(25) default NULL,
  `fax` varchar(100) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'Alexander','Finger','alexander.finger@gmail.com','Polar Design','600 Unicorn Dr','','Woburn','MA','01801','US','6172999294','6172999294',NULL),(9,'Philip','Kowalski','philk@polardesign.com','','1 Belgravia Place','Apt 2','Boston','MA','02113','US','4145315321','4145315321',NULL),(10,'aaa','aa','dfad@ttt.com','','a','','a','AZ','34',NULL,'34',NULL,NULL),(11,'Philip','Kowalski','kowalsph@gmail.com','','1 Belgravia Place','Apt 2','Boston','MA','02113','US','4145315321','4145315321',NULL),(12,'Alex','Fingersmith','alex.fingersmith@gmail.com','none','666 Hacker St','','Methuen','MA','01866',NULL,'5555555555',NULL,NULL),(13,'Alex','Finger','alex.finger@polardesign.com','Polar Design','600 Unincorn Park Dr','','Woburn','MA','01801',NULL,'5555555555',NULL,NULL),(14,'Freddy','Falck','freddyfalck@hotmail.com','','5239 Red BurrOak Trl','','Katy','TX','77494','US','2816606019','',NULL),(15,'Homepage','Animation','homepageanimation@polardesign.com','Polar Design','600 Unicorn Park Dr.','','Woburn','MA','01801','US','7814044000','',NULL);
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

-- Dump completed on 2012-06-04 18:21:26
