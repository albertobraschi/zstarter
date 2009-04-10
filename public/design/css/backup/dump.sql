-- MySQL dump 10.11
--
-- Host: localhost    Database: taryk
-- ------------------------------------------------------
-- Server version	5.0.76-log

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
-- Table structure for table `admin_cols_regexp`
--

DROP TABLE IF EXISTS `admin_cols_regexp`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_cols_regexp` (
  `ID` int(15) unsigned NOT NULL auto_increment,
  `ColsType_id` int(15) unsigned NOT NULL,
  `RegExp` varchar(255) NOT NULL,
  `Enabled` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_cols_regexp`
--

LOCK TABLES `admin_cols_regexp` WRITE;
/*!40000 ALTER TABLE `admin_cols_regexp` DISABLE KEYS */;
INSERT INTO `admin_cols_regexp` VALUES (1,1,'^text|subject|name|location|music|mood$',1),(2,2,'^Hidden$',0),(3,3,'^ID$',1),(4,4,'(textarea|description)$',1),(5,5,'^.+_?id$',1),(6,6,'$',0),(7,7,'^(display)?[\\ \\_]?date[\\ \\_]?(display)?$',1),(8,8,'^(date)?[\\ \\_]?creation[\\ \\_]?(date)?$',1),(9,9,'$',0),(10,10,'^(date)?[\\ \\_]?(current|modification)[\\ \\_]?(date)?$',1),(11,11,'^File|Filename$',1),(12,12,'^imagea|logo$',1),(13,13,'^hidden|enabled|allow|deny|tags|comments$',1);
/*!40000 ALTER TABLE `admin_cols_regexp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_cols_types`
--

DROP TABLE IF EXISTS `admin_cols_types`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_cols_types` (
  `ID` int(15) unsigned NOT NULL auto_increment,
  `TypeName` varchar(50) NOT NULL,
  `Enabled` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_cols_types`
--

LOCK TABLES `admin_cols_types` WRITE;
/*!40000 ALTER TABLE `admin_cols_types` DISABLE KEYS */;
INSERT INTO `admin_cols_types` VALUES (1,'Text',1),(2,'Hidden',1),(3,'Primary',1),(4,'Textarea',1),(5,'Select from database',1),(6,'List from database',1),(7,'Date_',1),(8,'Creation Date',1),(9,'Select An Option',1),(10,'Current Date',1),(11,'File_',1),(12,'Image',1),(13,'Checkbox',1);
/*!40000 ALTER TABLE `admin_cols_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_menu`
--

DROP TABLE IF EXISTS `admin_menu`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_menu` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Alias` varchar(255) NOT NULL,
  `Date_creation` int(15) unsigned NOT NULL,
  `Date_modification` int(15) unsigned NOT NULL,
  `Content_id` int(10) unsigned default '0',
  `Template` varchar(255) NOT NULL,
  `Module` varchar(255) NOT NULL,
  `Controller` varchar(255) NOT NULL,
  `Regen` tinyint(1) NOT NULL default '1',
  `Hidden` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=343 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,'Home','Home','home',294967243,294967222,0,'index','default','home',0,0),(2,'Admin Structure','Admin Menu Structure Configuration','adminstruct',1231684385,1231684385,0,'index','adminstruct','index',0,0),(3,'Admin Modules','Admin Modules Modules Modules Modules','modules',200104,199404,0,'index','adminstruct','modules',0,0),(7,'Generate Step1','Generate Step1','step1',198310,198310,0,'index','adminstruct','step1',0,0),(8,'Generate Step2','Step2','step2',0,0,0,'index','adminstruct','step2',0,0),(9,'Admin Edit','Admin Edit item','edit',198311,198310,0,'index','adminstruct','edit',0,0),(34,'Exit','Exit','exit',4294967295,4294967295,0,'index','auth','exit',0,0),(10,'Admin Delete','Delete','delete',198309,198107,0,'index','adminstruct','delete',0,0),(11,'Module Regen','Module Regen','regen',3254354366,3254354366,0,'index','adminstruct','regen',0,0),(33,'Login','Login','login',4294967295,4294967295,0,'index','auth','index',0,0),(341,'PgPhotos Delete','PgPhotos Delete Item','delete',1238719055,1238719055,0,'index','PgPhotos','delete',1,0),(340,'PgPhotos Edit','PgPhotos Edit Item','edit',1238719055,1238719055,0,'index','PgPhotos','edit',1,0),(339,'PgPhotos Add','PgPhotos Add Item','add',1238719055,1238719055,0,'index','PgPhotos','add',1,0),(338,'PgPhotos','PgPhotos','pgphotos',1238719055,1238719055,0,'index','PgPhotos','index',1,0),(40,'Backup','Backup System','backup',3265476571,3245467753,0,'index','backup','index',0,0),(41,'Extract Site','Extract Site','extract',3245465776,4294967295,0,'index','backup','extract',0,0);
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_menu_tree_mp`
--

DROP TABLE IF EXISTS `admin_menu_tree_mp`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_menu_tree_mp` (
  `ID` bigint(20) unsigned NOT NULL,
  `Path` varchar(255) NOT NULL default '1',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_menu_tree_mp`
--

LOCK TABLES `admin_menu_tree_mp` WRITE;
/*!40000 ALTER TABLE `admin_menu_tree_mp` DISABLE KEYS */;
INSERT INTO `admin_menu_tree_mp` VALUES (1,'1'),(11,'2.5'),(9,'2.3'),(3,'3'),(41,'10.1'),(40,'10'),(341,'9'),(10,'2.4'),(33,'5'),(340,'8'),(8,'2.2'),(7,'2.1'),(2,'2'),(339,'7'),(338,'6');
/*!40000 ALTER TABLE `admin_menu_tree_mp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_urls`
--

DROP TABLE IF EXISTS `admin_urls`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_urls` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Controller` varchar(50) NOT NULL default 'index',
  `Action` varchar(255) NOT NULL default 'index',
  `Menu_id` int(10) unsigned NOT NULL,
  `URL_regexp` varchar(255) NOT NULL,
  `URL_vars` varchar(255) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=185 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_urls`
--

LOCK TABLES `admin_urls` WRITE;
/*!40000 ALTER TABLE `admin_urls` DISABLE KEYS */;
INSERT INTO `admin_urls` VALUES (7,'adminstruct_step2','step2','index',8,'([0-9a-z_]+)\\/?','table,1'),(6,'adminstruct_delete','delete','index',10,'([0-9]+)\\/?','id,1'),(5,'adminstruct_edit','edit','index',9,'([0-9]+)\\/?','id,1'),(8,'adminstruct_regen','regen','index',11,'([0-9]+)\\/?','id,1'),(184,'pgphotos_delete','delete','index',341,'([0-9]+)\\/?','id,1'),(183,'pgphotos_edit','edit','index',340,'([0-9]+)\\/?','id,1');
/*!40000 ALTER TABLE `admin_urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_users` (
  `ID` int(15) unsigned NOT NULL auto_increment,
  `TypeID` int(10) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Session` varchar(255) default NULL,
  `Last_access` int(15) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Username` (`Username`,`Session`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,3,'admin','123',NULL,NULL),(2,2,'admin2','222',NULL,NULL),(3,2,'admin3','333',NULL,NULL);
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_users_acl`
--

DROP TABLE IF EXISTS `admin_users_acl`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_users_acl` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Allow` tinyint(1) unsigned NOT NULL default '1',
  `TypeID` int(10) default NULL,
  `Module` varchar(20) default NULL,
  `Controller` varchar(20) default NULL,
  `Action` varchar(20) default NULL,
  `Enabled` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_users_acl`
--

LOCK TABLES `admin_users_acl` WRITE;
/*!40000 ALTER TABLE `admin_users_acl` DISABLE KEYS */;
INSERT INTO `admin_users_acl` VALUES (1,0,NULL,NULL,NULL,NULL,1),(2,1,3,'adminstruct',NULL,NULL,1),(3,1,1,'auth',NULL,NULL,1),(4,1,2,NULL,NULL,NULL,1),(5,0,2,'adminstruct',NULL,NULL,1),(6,0,2,'auth',NULL,NULL,1),(7,1,2,'auth','exit',NULL,1),(8,1,NULL,'default',NULL,NULL,1),(9,0,1,'auth','exit',NULL,1),(10,0,1,'default','home',NULL,1),(101,1,3,'backup',NULL,NULL,1),(100,1,2,'PgPhotos',NULL,NULL,1);
/*!40000 ALTER TABLE `admin_users_acl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_users_types`
--

DROP TABLE IF EXISTS `admin_users_types`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_users_types` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `User_type` varchar(20) NOT NULL,
  `Parent` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_users_types`
--

LOCK TABLES `admin_users_types` WRITE;
/*!40000 ALTER TABLE `admin_users_types` DISABLE KEYS */;
INSERT INTO `admin_users_types` VALUES (1,'guest',0),(2,'admin',0),(3,'god',2);
/*!40000 ALTER TABLE `admin_users_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_validators`
--

DROP TABLE IF EXISTS `admin_validators`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `admin_validators` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `ValidatorName` varchar(50) NOT NULL,
  `RegExp` varchar(255) default NULL,
  `Enabled` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ValidatorName` (`ValidatorName`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `admin_validators`
--

LOCK TABLES `admin_validators` WRITE;
/*!40000 ALTER TABLE `admin_validators` DISABLE KEYS */;
INSERT INTO `admin_validators` VALUES (1,'String','/[a-z]+/i',1),(2,'Digits','/[0-9]+/',1),(3,'Username','/[a-z0-9_]{3,14}/i',1),(4,'Password','/[a-z0-9_]{3,14}/i',1),(5,'Email','/^[a-z0-9_\\.]+\\@[a-z0-9_\\.]+\\.[a-z]{2,4}$/i',1),(6,'Url','/^http\\:\\/\\//i',1),(7,'List','/^[^0]/',1);
/*!40000 ALTER TABLE `admin_validators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL auto_increment,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,1,'Все в твоих руках','    Давным-давно в старинном городе жил Мастер, окружённый учениками. Самый способный из них однажды задумался: «А есть ли вопрос, на который наш Мастер не смог бы дать ответа?» Он пошёл на цветущий луг, поймал самую красивую бабочку и спрятал её между ладонями. Бабочка цеплялась лапками за его руки, и ученику было щекотно. Улыбаясь, он подошёл к Мастеру и спросил:\r\n\r\n    — Скажите, какая бабочка у меня в руках: живая или мёртвая?\r\n\r\n    Он крепко держал бабочку в сомкнутых ладонях и был готов в любое мгновение сжать их ради своей истины.\r\n\r\n    Не глядя на руки ученика, Мастер ответил:\r\n\r\n    — Всё в твоих руках.\r\n'),(2,2,'Будьте довольны','    Попал человек в рай. Смотрит, а там все люди ходят радостные, счастливые, открытые, доброжелательные. А вокруг всё как в обычной жизни. Походил он, погулял, понравилось. И говорит архангелу:\r\n\r\n    — А можно посмотреть, что такое ад? Хоть одним глазком!\r\n\r\n    — Хорошо, пойдём, покажу.\r\n\r\n    Приходят они в ад. Человек смотрит, а там вроде бы на первый взгляд всё так же как в раю: та же обычная жизнь, только люди все злые, обиженные, видно, что плохо им тут. Он спрашивает у архангела:\r\n\r\n    — Тут же всё вроде так же, как и в раю! Почему они все такие недовольные?\r\n\r\n    — А потому что они думают, что в раю лучше.\r\n');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `blog_posts` (
  `ID` int(15) unsigned NOT NULL auto_increment,
  `Subject` varchar(255) default NULL,
  `Text` text NOT NULL,
  `Date_creation` int(15) unsigned NOT NULL,
  `Date_modification` int(15) unsigned NOT NULL,
  `Date_display` int(15) unsigned NOT NULL,
  `Location` varchar(255) default NULL,
  `Music` varchar(255) default NULL,
  `Mood` varchar(255) default NULL,
  `Hidden` tinyint(1) unsigned NOT NULL default '0',
  `Comments` tinyint(1) unsigned NOT NULL default '1',
  `Tags` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,'Post1','Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1 Some text 1',1227481798,1227481456,1227484798,'Файне місто Тернопіль','Ambient','Good',0,1,1),(2,'Post 2','Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2 Some text 2',1227481546,1227481324,1227482798,'Київ','Neoclassical','Good',0,0,0);
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Услуги','Автоматизм, как бы это ни казалось парадоксальным, иллюстрирует когнитивный гендер, в частности, \"тюремные психозы\", индуцируемые при различных психопатологических типологиях. Связь, например, возможна. Апперцепция понимает интеллект, хотя Уотсон это отрицал. Супруги вступают в брак с жизненными паттернами и уровнями дифференциации Я, унаследованными от их родительских семей, таким образом аутотренинг традиционен. Архетип аннигилирует онтогенез речи, также это подчеркивается в труде Дж. Морено \"Театр Спонтанности\".'),(2,'Контакты','Эгоцентризм концептуально аннигилирует архетип в силу которого смешивает субъективное и объективное, переносит свои внутренние побуждения на реальные связи вещей. Психическая саморегуляция заметно вызывает эриксоновский гипноз, следовательно основной закон психофизики: ощущение изменяется пропорционально логарифму раздражителя . Контраст абсурдно представляет собой гештальт, к тому же этот вопрос касается чего-то слишком общего. Коллективное бессознательное, в представлении Морено, осознаёт психоз, и это неудивительно, если речь о персонифицированном характере первичной социализации. Идентификация понимает ролевой комплекс одинаково по всем направлениям. Действие дает социометрический объект, так, например, Ричард Бендлер для построения эффективных состояний использовал изменение субмодальностей.');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pg_galleries`
--

DROP TABLE IF EXISTS `pg_galleries`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pg_galleries` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Alias` varchar(255) NOT NULL,
  `Date_creation` int(15) unsigned NOT NULL,
  `Date_modification` int(15) unsigned NOT NULL,
  `Description` varchar(255) default NULL,
  `DefaultPhotoID` int(15) NOT NULL default '0',
  `Raiting` float unsigned default NULL,
  `Hidden` tinyint(1) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Name` (`Name`),
  UNIQUE KEY `Alias` (`Alias`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pg_galleries`
--

LOCK TABLES `pg_galleries` WRITE;
/*!40000 ALTER TABLE `pg_galleries` DISABLE KEYS */;
INSERT INTO `pg_galleries` VALUES (1,'Gall1','gall1',1231152718,1231152718,'Gall1 Gall1 Gall1 Gall1 Gall1 Gall1 Gall1 Gall1 Gall1 Gall1 Gall1 Gall1 Gall1 Gall1 Gall1',1,9,0),(2,'Gall2','gall2',1231152718,1231152718,'Gall2 Gall2 Gall2 Gall2 Gall2 Gall2 Gall2 Gall2 Gall2 Gall2 Gall2 Gall2 Gall2 Gall2 Gall2',6,9,0);
/*!40000 ALTER TABLE `pg_galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pg_photos`
--

DROP TABLE IF EXISTS `pg_photos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pg_photos` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Filename` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Date_creation` int(15) unsigned NOT NULL,
  `Date_modification` int(15) unsigned NOT NULL,
  `Raiting` float unsigned default NULL,
  `Gallery_id` int(10) unsigned default NULL,
  `Hidden` tinyint(1) unsigned default NULL,
  `Comments` tinyint(1) NOT NULL default '1',
  `Tags` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Filename` (`Filename`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pg_photos`
--

LOCK TABLES `pg_photos` WRITE;
/*!40000 ALTER TABLE `pg_photos` DISABLE KEYS */;
INSERT INTO `pg_photos` VALUES (2,'image2.jpg','File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2 File2',1231153066,1231153066,5,2,0,1,1),(3,'image3.jpg','File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3 File3',1231153066,1231153066,5,1,0,1,1),(4,'image4.jpg','File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4 File4',1231153066,1231153066,5,2,0,1,1),(5,'image5.jpg','File5 File5 File5 File5 File5 File5 File5 File5 File5 File5',1231153066,1231153066,5,1,0,1,1),(1,'image1.jpg','File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1 File1',1231153066,1231153066,5,1,0,1,1),(6,'image6.jpg','File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6 File6',1231153066,1231153066,5,2,0,1,1),(7,'image7.jpg','File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7 File7',1231153066,1231153066,5,2,0,1,1),(8,'image8.jpg','NEW NEW File8 File8 File8 File8 File8 File8 File8 File8 File8 File8 File8 File8 File8 File8 File8',787658756,887654654,5,2,0,1,1);
/*!40000 ALTER TABLE `pg_photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_categories`
--

DROP TABLE IF EXISTS `portfolio_categories`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `portfolio_categories` (
  `ID` int(11) NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Description` text,
  `Alias` varchar(255) NOT NULL,
  `Hidden` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `portfolio_categories`
--

LOCK TABLES `portfolio_categories` WRITE;
/*!40000 ALTER TABLE `portfolio_categories` DISABLE KEYS */;
INSERT INTO `portfolio_categories` VALUES (1,'Commercial','Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects Commercial projects','commercial',0),(2,'Non commercial','Non commercial projects Non commercial projects Non commercial projects Non commercial projects Non commercial projects Non commercial projects Non commercial projects Non commercial projects Non commercial projects Non commercial projects Non commercial projects Non commercial projects Non commercial projects Non commercial projects','noncommercial',0);
/*!40000 ALTER TABLE `portfolio_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_projects`
--

DROP TABLE IF EXISTS `portfolio_projects`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `portfolio_projects` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Date_added` int(15) NOT NULL,
  `Date_released` int(15) NOT NULL,
  `Date_modification` int(15) NOT NULL,
  `Category_id` int(10) NOT NULL,
  `Hidden` tinyint(1) NOT NULL default '0',
  `Comments` tinyint(1) NOT NULL default '1',
  `Technologies` tinyint(1) NOT NULL default '1',
  `Tags` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `portfolio_projects`
--

LOCK TABLES `portfolio_projects` WRITE;
/*!40000 ALTER TABLE `portfolio_projects` DISABLE KEYS */;
INSERT INTO `portfolio_projects` VALUES (1,'Project 1','Project 1 Project 1 Project 1 Project 1 Project 1',1230321263,1230321263,1230321263,1,0,1,1,1),(2,'Project 2','Project 2 Project 2 Project 2 Project 2 Project 2',1230321263,1230321263,1230321263,1,0,1,1,1),(3,'Project 3','Project 3  Project 3  Project 3  Project 3  Project 3 ',1230321346,1230321346,1230321346,2,0,1,1,1),(4,'Project 4','Project 4 Project 4 Project 4 Project 4 Project 4 Project 4',1230321346,1230321346,1230321346,2,0,1,1,1);
/*!40000 ALTER TABLE `portfolio_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_screenshots`
--

DROP TABLE IF EXISTS `portfolio_screenshots`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `portfolio_screenshots` (
  `ID` int(10) NOT NULL auto_increment,
  `Filename` varchar(255) NOT NULL,
  `Description` varchar(255) default NULL,
  `Project_id` int(10) NOT NULL,
  `Date_creation` int(15) NOT NULL,
  `Date_modification` int(15) NOT NULL,
  `Logo` tinyint(1) NOT NULL,
  `Hidden` tinyint(1) NOT NULL default '0',
  `Comments` tinyint(1) NOT NULL default '1',
  `Tags` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Filename` (`Filename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `portfolio_screenshots`
--

LOCK TABLES `portfolio_screenshots` WRITE;
/*!40000 ALTER TABLE `portfolio_screenshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `portfolio_screenshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_comments`
--

DROP TABLE IF EXISTS `site_comments`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `site_comments` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Connection_id` int(10) unsigned NOT NULL,
  `Parent_id` int(10) unsigned NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Text` text NOT NULL,
  `Date_creation` int(15) unsigned NOT NULL,
  `Date_modification` int(15) unsigned NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `site_comments`
--

LOCK TABLES `site_comments` WRITE;
/*!40000 ALTER TABLE `site_comments` DISABLE KEYS */;
INSERT INTO `site_comments` VALUES (1,1,1,'anonymous','','fuck you!',1237586492,1237586492);
/*!40000 ALTER TABLE `site_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_comments_tree_mp`
--

DROP TABLE IF EXISTS `site_comments_tree_mp`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `site_comments_tree_mp` (
  `ID` bigint(20) unsigned NOT NULL,
  `Path` varchar(255) NOT NULL default '1',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `site_comments_tree_mp`
--

LOCK TABLES `site_comments_tree_mp` WRITE;
/*!40000 ALTER TABLE `site_comments_tree_mp` DISABLE KEYS */;
INSERT INTO `site_comments_tree_mp` VALUES (1,'01');
/*!40000 ALTER TABLE `site_comments_tree_mp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_connections`
--

DROP TABLE IF EXISTS `site_connections`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `site_connections` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Table_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Table_name` (`Table_name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `site_connections`
--

LOCK TABLES `site_connections` WRITE;
/*!40000 ALTER TABLE `site_connections` DISABLE KEYS */;
INSERT INTO `site_connections` VALUES (1,'blog_posts'),(2,'pg_photos');
/*!40000 ALTER TABLE `site_connections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_content`
--

DROP TABLE IF EXISTS `site_content`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `site_content` (
  `ID` int(10) NOT NULL auto_increment,
  `Content` text NOT NULL,
  `Alias` varchar(255) NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Alias` (`Alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `site_content`
--

LOCK TABLES `site_content` WRITE;
/*!40000 ALTER TABLE `site_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `site_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_menu`
--

DROP TABLE IF EXISTS `site_menu`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `site_menu` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Alias` varchar(255) NOT NULL,
  `Date_creation` int(15) unsigned NOT NULL,
  `Date_modification` int(15) unsigned NOT NULL,
  `Content_id` int(10) unsigned default '0',
  `Template` varchar(255) NOT NULL,
  `Module` varchar(255) NOT NULL,
  `Controller` varchar(255) NOT NULL,
  `Hidden` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `site_menu`
--

LOCK TABLES `site_menu` WRITE;
/*!40000 ALTER TABLE `site_menu` DISABLE KEYS */;
INSERT INTO `site_menu` VALUES (1,'Admin Modules','Admin Modules Modules Modules Modules','modules',200104,199404,0,'index','home','modules',0),(7,'Admin Modules','Admin Modules Modules Modules Modules','modules',200104,199404,0,'index','blog','modules',0),(3,'Admin Modules','Admin Modules Modules Modules Modules','modules',200104,199404,0,'index','photos','modules',0),(4,'Admin Modules','Admin Modules Modules Modules Modules','modules',200104,199404,0,'index','portfolio','modules',0),(5,'Admin Modules','Admin Modules Modules Modules Modules','modules',200104,199404,0,'index','resume','modules',0),(6,'Admin Modules','Admin Modules Modules Modules Modules','modules',200104,199404,0,'index','aboutme','modules',0),(2,'Admin Modules','Admin Modules Modules Modules Modules','modules',200104,199404,0,'index','blog','modules',0),(8,'Admin Modules','Admin Modules Modules Modules Modules','modules',200104,199404,0,'index','photos','modules',0);
/*!40000 ALTER TABLE `site_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_menu_tree_mp`
--

DROP TABLE IF EXISTS `site_menu_tree_mp`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `site_menu_tree_mp` (
  `ID` bigint(20) NOT NULL,
  `Path` varchar(255) NOT NULL default '1',
  UNIQUE KEY `ID` (`ID`,`Path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `site_menu_tree_mp`
--

LOCK TABLES `site_menu_tree_mp` WRITE;
/*!40000 ALTER TABLE `site_menu_tree_mp` DISABLE KEYS */;
INSERT INTO `site_menu_tree_mp` VALUES (1,'1'),(2,'2'),(3,'3'),(4,'4'),(5,'5'),(6,'6'),(7,'2.1'),(8,'3.1');
/*!40000 ALTER TABLE `site_menu_tree_mp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_tags`
--

DROP TABLE IF EXISTS `site_tags`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `site_tags` (
  `ID` int(10) NOT NULL auto_increment,
  `Connection_id` int(10) NOT NULL,
  `Parent_id` int(10) NOT NULL,
  `Text` text NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `site_tags`
--

LOCK TABLES `site_tags` WRITE;
/*!40000 ALTER TABLE `site_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `site_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_technologies`
--

DROP TABLE IF EXISTS `site_technologies`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `site_technologies` (
  `ID` int(10) NOT NULL auto_increment,
  `Connection_id` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Parent_id` int(10) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `site_technologies`
--

LOCK TABLES `site_technologies` WRITE;
/*!40000 ALTER TABLE `site_technologies` DISABLE KEYS */;
/*!40000 ALTER TABLE `site_technologies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_urls`
--

DROP TABLE IF EXISTS `site_urls`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `site_urls` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Controller` varchar(255) NOT NULL,
  `Action` varchar(255) NOT NULL default 'index',
  `Menu_id` int(10) unsigned NOT NULL,
  `URL_regexp` varchar(255) NOT NULL,
  `URL_vars` varchar(255) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `site_urls`
--

LOCK TABLES `site_urls` WRITE;
/*!40000 ALTER TABLE `site_urls` DISABLE KEYS */;
INSERT INTO `site_urls` VALUES (1,'portfolio1','category','index',4,'(\\w+)\\/?','var1,1'),(2,'blog2','post','index',2,'(\\d+).html(\\&(\\w+)\\=(\\w+))?(\\&(\\w+)\\=(\\d+))?','postId,1,var1,3,val1,4,var2,5,val2,7'),(4,'photos1','gallery','index',8,'(\\w+)\\/?','var1,1'),(3,'portfolio2','project','index',4,'(\\w+)\\/(\\d+)','var1,1,var2,2');
/*!40000 ALTER TABLE `site_urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills_categories`
--

DROP TABLE IF EXISTS `skills_categories`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `skills_categories` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Date_creation` int(15) unsigned NOT NULL,
  `Date_modification` int(15) unsigned NOT NULL,
  `Position` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `skills_categories`
--

LOCK TABLES `skills_categories` WRITE;
/*!40000 ALTER TABLE `skills_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `skills_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills_experience`
--

DROP TABLE IF EXISTS `skills_experience`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `skills_experience` (
  `ID` int(10) NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Position` int(10) NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `skills_experience`
--

LOCK TABLES `skills_experience` WRITE;
/*!40000 ALTER TABLE `skills_experience` DISABLE KEYS */;
/*!40000 ALTER TABLE `skills_experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills_items`
--

DROP TABLE IF EXISTS `skills_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `skills_items` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `Category_id` int(10) unsigned NOT NULL,
  `Period` varchar(255) NOT NULL,
  `Expirence_id` int(10) unsigned NOT NULL,
  `Commercial` tinyint(1) unsigned NOT NULL,
  `Hidden` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `skills_items`
--

LOCK TABLES `skills_items` WRITE;
/*!40000 ALTER TABLE `skills_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `skills_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'San'),(2,'Petr');
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

-- Dump completed on 2009-04-06 20:26:36
