CREATE DATABASE  IF NOT EXISTS `wings` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `wings`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: wings
-- ------------------------------------------------------
-- Server version	5.5.44

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
-- Table structure for table `access_page`
--

DROP TABLE IF EXISTS `access_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_page` (
  `delete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group` int(3) unsigned DEFAULT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `insert` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `page` int(11) unsigned NOT NULL,
  `select` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `update` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acc_P_Un` (`type`,`group`,`user`,`page`),
  KEY `acc_P_Gr_idx` (`group`),
  KEY `acc_P_P_idx` (`page`),
  KEY `acc_P_Us_idx` (`user`),
  CONSTRAINT `acc_P_Gr` FOREIGN KEY (`group`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `acc_P_P` FOREIGN KEY (`page`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `acc_P_Us` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_page`
--

LOCK TABLES `access_page` WRITE;
/*!40000 ALTER TABLE `access_page` DISABLE KEYS */;
INSERT INTO `access_page` VALUES (1,1,1,1,1,1,0,1,NULL),(1,1,2,1,2,1,0,1,NULL),(1,1,3,1,3,1,0,1,NULL),(1,1,4,1,4,1,0,1,NULL),(1,1,5,1,5,1,0,1,NULL),(1,1,6,1,6,1,0,1,NULL),(1,1,7,1,7,1,0,1,NULL),(1,1,8,1,8,1,0,1,NULL),(1,1,9,1,9,1,0,1,NULL),(1,1,10,1,10,1,0,1,NULL),(1,1,11,1,11,1,0,1,NULL),(1,1,12,1,12,1,0,1,NULL),(1,1,13,1,13,1,0,1,NULL),(1,1,14,1,14,1,0,1,NULL),(1,1,15,1,15,1,0,1,NULL);
/*!40000 ALTER TABLE `access_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `access_pagetype`
--

DROP TABLE IF EXISTS `access_pagetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_pagetype` (
  `delete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group` int(3) unsigned DEFAULT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `insert` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pageType` int(11) unsigned NOT NULL,
  `select` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `update` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acc_PT_Un` (`type`,`group`,`user`,`pageType`),
  KEY `acc_PT_Gr_idx` (`group`),
  KEY `acc_PT_PT_idx` (`pageType`),
  KEY `acc_PT_Us_idx` (`user`),
  CONSTRAINT `acc_PT_Gr` FOREIGN KEY (`group`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `acc_PT_PT` FOREIGN KEY (`pageType`) REFERENCES `pagetype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `acc_PT_Us` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_pagetype`
--

LOCK TABLES `access_pagetype` WRITE;
/*!40000 ALTER TABLE `access_pagetype` DISABLE KEYS */;
INSERT INTO `access_pagetype` VALUES (1,1,1,1,1,1,0,1,NULL),(1,1,2,1,2,1,0,1,NULL),(1,1,3,1,3,1,0,1,NULL),(1,1,4,1,4,1,0,1,NULL),(1,1,5,1,5,1,0,1,NULL),(1,1,6,1,6,1,0,1,NULL),(1,1,7,1,7,1,0,1,NULL),(1,1,8,1,8,1,0,1,NULL),(1,1,9,1,9,1,0,1,NULL);
/*!40000 ALTER TABLE `access_pagetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field`
--

DROP TABLE IF EXISTS `field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field` varchar(63) NOT NULL,
  `table` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `F_T_idx` (`table`),
  CONSTRAINT `F_T` FOREIGN KEY (`table`) REFERENCES `table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field`
--

LOCK TABLES `field` WRITE;
/*!40000 ALTER TABLE `field` DISABLE KEYS */;
INSERT INTO `field` VALUES (1,'id',1),(2,'name',1),(3,'id',2),(4,'charset',3),(5,'defaultLang',3),(6,'id',3),(7,'isMultilang',3),(8,'name',3),(9,'needHTTPS',3),(10,'needWWW',3),(11,'code',4),(12,'id',4),(13,'name',4),(14,'nameEn',4),(15,'alias',5),(16,'creater',5),(17,'changer',5),(18,'host',5),(19,'id',5),(20,'isActive',5),(21,'isDeleted',5),(22,'isVisible',5),(23,'pagetype',5),(24,'url',5),(25,'workspace',5),(26,'id',6),(27,'method',6),(28,'mvc',6),(29,'id',7),(30,'name',7),(31,'created',8),(32,'id',8),(33,'isActive',8),(34,'isDeleted',8),(35,'lastVisit',8),(36,'login',8),(37,'mail',8),(38,'password',8),(39,'group',8),(40,'id',9),(41,'name',9),(42,'name',2),(43,'id',10),(44,'datetime',10),(45,'ip',10),(46,'session',10),(47,'field',10),(48,'table',10),(49,'user',10),(50,'changes',10),(51,'row',10),(52,'add',7),(53,'change',7),(54,'item',7),(55,'list',7),(56,'table',1),(57,'table',7),(58,'field',1);
/*!40000 ALTER TABLE `field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1),(2),(3),(4);
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `datetime` datetime NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `row` int(11) NOT NULL,
  `session` varchar(31) NOT NULL,
  `table` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `H_Us_idx` (`user`),
  CONSTRAINT `H_Us` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES ('2017-12-14 12:02:37',1,'10.191.1.21',0,'oauv12q7hmnsqjh0pja2c2u9un',1,1),('2017-12-14 12:02:57',2,'10.191.1.21',59,'oauv12q7hmnsqjh0pja2c2u9un',1,1),('2017-12-14 12:03:11',3,'10.191.1.21',59,'oauv12q7hmnsqjh0pja2c2u9un',1,1);
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `host`
--

DROP TABLE IF EXISTS `host`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `host` (
  `charset` varchar(63) NOT NULL,
  `defaultLang` int(3) unsigned DEFAULT NULL,
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `isMultilang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `needHTTPS` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `needWWW` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `H_L_idx` (`defaultLang`),
  CONSTRAINT `H_L` FOREIGN KEY (`defaultLang`) REFERENCES `language` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `host`
--

LOCK TABLES `host` WRITE;
/*!40000 ALTER TABLE `host` DISABLE KEYS */;
INSERT INTO `host` VALUES ('utf-8',1,1,1,'wings',0,0);
/*!40000 ALTER TABLE `host` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lang_field`
--

DROP TABLE IF EXISTS `lang_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lang_field` (
  `field` int(10) unsigned NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `l_F_Un` (`field`,`lang`),
  KEY `l_F_F_idx` (`field`),
  KEY `l_F_L_idx` (`lang`),
  CONSTRAINT `l_F_F` FOREIGN KEY (`field`) REFERENCES `field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `l_F_L` FOREIGN KEY (`lang`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lang_field`
--

LOCK TABLES `lang_field` WRITE;
/*!40000 ALTER TABLE `lang_field` DISABLE KEYS */;
INSERT INTO `lang_field` VALUES (1,1,1,'ID'),(1,2,2,'ID'),(2,3,1,'Наименование'),(2,4,2,'Name'),(3,5,1,'ID'),(3,6,2,'ID'),(4,7,1,'Кодировка'),(4,8,2,'Charset'),(5,9,1,'Язык по умолчанию'),(5,10,2,'Default language'),(6,11,1,'ID'),(6,12,2,'ID'),(7,13,1,'Многоязычный'),(7,14,2,'Multilanguage'),(8,15,1,'Наименование'),(8,16,2,'Name'),(9,17,1,'HTTPS'),(9,18,2,'HTTPS'),(10,19,1,'WWW'),(10,20,2,'WWW'),(11,21,1,'Код'),(11,22,2,'Code'),(12,23,1,'ID'),(12,24,2,'ID'),(13,25,1,'Наименование'),(13,26,2,'Name'),(14,27,1,'Наименование (международное)'),(14,28,2,'Name (international)'),(15,29,1,'Алиас'),(15,30,2,'Alias'),(16,31,1,'Создал'),(16,32,2,'Creater'),(17,33,1,'Изменил'),(17,34,2,'Changer'),(18,35,1,'Хост'),(18,36,2,'Host'),(19,37,1,'ID'),(19,38,2,'ID'),(20,39,1,'Активен'),(20,40,2,'Active'),(21,41,1,'Удалён'),(21,42,2,'Delete'),(22,43,1,'Видимый'),(22,44,2,'Visible'),(23,45,1,'Тип страницы'),(23,46,2,'Page type'),(24,47,1,'URL'),(24,48,2,'URL'),(25,49,1,'Рабочая область'),(25,50,2,'Workspace'),(26,51,1,'ID'),(26,52,2,'ID'),(27,53,1,'Метод'),(27,54,2,'Method'),(28,55,1,'MVC'),(28,56,2,'MVC'),(29,57,1,'ID'),(29,58,2,'ID'),(30,59,1,'Наименование'),(30,60,2,'Name'),(31,61,1,'Создан'),(31,62,2,'Created'),(32,63,1,'ID'),(32,64,2,'ID'),(33,65,1,'Активен'),(33,66,2,'Active'),(34,67,1,'Удалён'),(34,68,2,'Delete'),(35,69,1,'Последняя активность'),(35,70,2,'Last active'),(36,71,1,'Логин'),(36,72,2,'Login'),(37,73,1,'Почта'),(37,74,2,'Mail'),(38,75,1,'Пароль'),(38,76,2,'Password'),(39,77,1,'Группа'),(39,78,2,'Group'),(40,79,1,'ID'),(40,80,2,'ID'),(41,81,1,'Наименование'),(41,82,2,'Name'),(42,83,1,'Наименование'),(42,84,2,'Name'),(43,85,1,'ID'),(43,86,2,'ID'),(44,87,1,'Дата и время'),(44,88,2,'Date and time'),(45,89,1,'IP'),(45,90,2,'IP'),(46,91,1,'Сессия'),(46,92,2,'Session'),(47,93,1,'Поле'),(47,94,2,'Field'),(48,95,1,'Таблица'),(48,96,2,'Table'),(49,97,1,'Пользователь'),(49,98,2,'User'),(50,99,1,'Изменения'),(50,100,2,'Changes'),(51,101,1,'Строка'),(51,102,2,'Row'),(52,103,1,'Добавление'),(52,104,2,'Adding'),(53,105,1,'Изменение'),(53,106,2,'Changing'),(54,107,1,'Элемент'),(54,108,2,'Item'),(55,109,1,'Список'),(55,110,2,'List'),(56,111,1,'Таблица'),(56,112,2,'Table'),(57,113,1,'Таблица'),(57,114,2,'Table'),(58,115,1,'Поле'),(58,116,2,'Field');
/*!40000 ALTER TABLE `lang_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lang_group`
--

DROP TABLE IF EXISTS `lang_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lang_group` (
  `group` int(3) unsigned NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang` int(2) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `l_Gr_Un` (`lang`,`group`),
  KEY `l_Gr_Gr_idx` (`group`),
  CONSTRAINT `l_Gr_Gr` FOREIGN KEY (`group`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `l_Gr_L` FOREIGN KEY (`lang`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lang_group`
--

LOCK TABLES `lang_group` WRITE;
/*!40000 ALTER TABLE `lang_group` DISABLE KEYS */;
INSERT INTO `lang_group` VALUES (1,1,1,'Администратор'),(1,2,2,'Administrator'),(2,3,1,'Контент-менеджер'),(2,4,2,'Content manager'),(3,5,1,'Пользователь'),(3,6,2,'User'),(4,7,1,'Гость'),(4,8,2,'Guest');
/*!40000 ALTER TABLE `lang_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lang_page`
--

DROP TABLE IF EXISTS `lang_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lang_page` (
  `description` varchar(255) DEFAULT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `keywords` varchar(255) DEFAULT NULL,
  `lang` int(3) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `page` int(11) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `l_P_Un` (`lang`,`page`),
  KEY `l_P_P_idx` (`page`),
  CONSTRAINT `l_P_L` FOREIGN KEY (`lang`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `l_P_P` FOREIGN KEY (`page`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lang_page`
--

LOCK TABLES `lang_page` WRITE;
/*!40000 ALTER TABLE `lang_page` DISABLE KEYS */;
INSERT INTO `lang_page` VALUES (NULL,1,NULL,1,'Главная',1,'Главная'),(NULL,2,NULL,1,'Контент',2,'Контент'),(NULL,3,NULL,1,'Страницы',3,'Страницы'),(NULL,4,NULL,1,'Файлы',4,'Файлы'),(NULL,5,NULL,1,'Статистика',5,'Статистика'),(NULL,6,NULL,1,'Боты',6,'Боты'),(NULL,7,NULL,1,'Переходы',7,'Переходы'),(NULL,8,NULL,1,'Посещения',8,'Посещения'),(NULL,9,NULL,1,'Настройки',9,'Настройки'),(NULL,10,NULL,1,'Группы',10,'Группы'),(NULL,11,NULL,1,'Пользователи',11,'Пользователи'),(NULL,12,NULL,1,'Языки',12,'Языки'),(NULL,13,NULL,2,'Main',1,'Main'),(NULL,14,NULL,2,'Content',2,'Content'),(NULL,15,NULL,2,'Pages',3,'Pages'),(NULL,16,NULL,2,'Files',4,'Files'),(NULL,17,NULL,2,'Statistics',5,'Statistics'),(NULL,18,NULL,2,'Bots',6,'Bots'),(NULL,19,NULL,2,'Transitions',7,'Transitions'),(NULL,20,NULL,2,'Visits',8,'Visits'),(NULL,21,NULL,2,'Administration',9,'Administration'),(NULL,22,NULL,2,'Groups',10,'Groups'),(NULL,23,NULL,2,'Users',11,'Users'),(NULL,24,NULL,2,'Languages',12,'Languages'),(NULL,25,NULL,1,'Таблицы',13,'Таблицы'),(NULL,26,NULL,2,'Tables',13,'Tables'),(NULL,27,NULL,1,'Поля',14,'Поля'),(NULL,28,NULL,2,'Fields',14,'Fields'),(NULL,29,NULL,1,'История',15,'История'),(NULL,30,NULL,2,'History',15,'History');
/*!40000 ALTER TABLE `lang_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lang_pagetype`
--

DROP TABLE IF EXISTS `lang_pagetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lang_pagetype` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang` int(11) unsigned NOT NULL,
  `pageType` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `l_PT_Un` (`lang`,`pageType`),
  KEY `l_PT_PT_idx` (`pageType`),
  CONSTRAINT `l_PT_L` FOREIGN KEY (`lang`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `l_PT_PT` FOREIGN KEY (`pageType`) REFERENCES `pagetype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lang_pagetype`
--

LOCK TABLES `lang_pagetype` WRITE;
/*!40000 ALTER TABLE `lang_pagetype` DISABLE KEYS */;
INSERT INTO `lang_pagetype` VALUES (1,1,1,'Индексная страница'),(2,1,2,'Группы'),(3,1,3,'Пользователи'),(4,1,4,'Языки'),(5,1,5,'Страницы'),(6,1,6,'Файлы'),(7,2,1,'Index page'),(8,2,2,'Groups'),(9,2,3,'Users'),(10,2,4,'Languages'),(11,2,5,'Pages'),(12,2,6,'Files'),(13,1,7,'История'),(14,2,7,'History'),(15,1,8,'Таблицы'),(16,2,8,'Tables'),(17,1,9,'Поля'),(18,2,9,'Fields');
/*!40000 ALTER TABLE `lang_pagetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lang_table`
--

DROP TABLE IF EXISTS `lang_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lang_table` (
  `add` varchar(255) NOT NULL,
  `change` varchar(255) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(255) NOT NULL,
  `lang` int(10) unsigned NOT NULL,
  `list` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `table` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `l_T_Un` (`lang`,`table`),
  KEY `l_T_L_idx` (`lang`),
  KEY `l_T_T_idx` (`table`),
  CONSTRAINT `l_T_L` FOREIGN KEY (`lang`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `l_T_T` FOREIGN KEY (`table`) REFERENCES `table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lang_table`
--

LOCK TABLES `lang_table` WRITE;
/*!40000 ALTER TABLE `lang_table` DISABLE KEYS */;
INSERT INTO `lang_table` VALUES ('Добавить поле','Изменить поле',1,'Поле',1,'Поля','Поля',1),('Добавить группу','Изменить группу',2,'Группа',1,'Группы','Группы',2),('Добавить хост','Изменить хост',3,'Хост',1,'Хосты','Хосты',3),('Добавить язык','Изменить язык',4,'Язык',1,'Языки','Языки',4),('Добавить страницу','Изменить страницу',5,'Страница',1,'Страницы','Страницы',5),('Добавить тип страницы','Изменить тип страницы',6,'Тип страницы',1,'Тип страниц','Тип страниц',6),('Добавить таблицу','Изменить таблицу',7,'Таблица',1,'Таблицы','Таблицы',7),('Добавить пользователя','Изменить пользователя',8,'Пользователь',1,'Пользователи','Пользователи',8),('Добавить пространство имён','Изменить пространство имён',9,'Пространство имён',1,'Пространства имён','Пространства имён',9),('Add field','Change field',10,'Field',2,'Fields','Fields',1),('Add group','Change group',11,'Group',2,'Groups','Groups',2),('Add host','Change host',12,'Host',2,'Hosts','Hosts',3),('Add language','Change language',13,'Language',2,'Languages','Languages',4),('Add page','Change page',14,'Page',2,'Pages','Pages',5),('Add page type','Change page type',15,'Page type',2,'Page types','Page types',6),('Add table','Change table',16,'Table',2,'Tables','Tables',7),('Add user','Change user',17,'User',2,'Users','Users',8),('Add workspace','Change workspace',18,'Workspace',2,'Workspaces','Workspaces',9),('Добавить запись','Изменить запись',19,'Запись',1,'История','История',10),('Add note','Change note',20,'Note',2,'History','History',10);
/*!40000 ALTER TABLE `lang_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language` (
  `code` varchar(5) NOT NULL,
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(63) NOT NULL,
  `nameEn` varchar(63) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  UNIQUE KEY `nameEn_UNIQUE` (`nameEn`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES ('ru-ru',1,'Русский','Russian'),('en-us',2,'English','English');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_historyfield`
--

DROP TABLE IF EXISTS `link_historyfield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link_historyfield` (
  `dataOld` text NOT NULL,
  `dataNew` text NOT NULL,
  `field` int(10) unsigned NOT NULL,
  `history` int(10) unsigned NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `l_HF_F_idx` (`field`),
  KEY `l_HF_H_idx` (`history`),
  CONSTRAINT `l_HF_F` FOREIGN KEY (`field`) REFERENCES `field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `l_HF_H` FOREIGN KEY (`history`) REFERENCES `history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_historyfield`
--

LOCK TABLES `link_historyfield` WRITE;
/*!40000 ALTER TABLE `link_historyfield` DISABLE KEYS */;
INSERT INTO `link_historyfield` VALUES ('','test',58,1,1),('','8',56,1,2),('','[1]Тест',2,1,3),('','[2]Test',2,1,4),('test','test1',58,2,5),('','8',56,2,6),('','[1]Тест2',2,2,7),('','[2]Test3',2,2,8),('59','',1,3,9),('test1','',58,3,10),('','',56,3,11),('Тест2','',2,3,12);
/*!40000 ALTER TABLE `link_historyfield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_hostlanguage`
--

DROP TABLE IF EXISTS `link_hostlanguage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link_hostlanguage` (
  `host` int(11) unsigned NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `l_HL_H_idx` (`host`),
  KEY `l_HL_L_idx` (`language`),
  CONSTRAINT `l_HL_H` FOREIGN KEY (`host`) REFERENCES `host` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `l_HL_L` FOREIGN KEY (`language`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_hostlanguage`
--

LOCK TABLES `link_hostlanguage` WRITE;
/*!40000 ALTER TABLE `link_hostlanguage` DISABLE KEYS */;
INSERT INTO `link_hostlanguage` VALUES (1,1,1),(1,2,2);
/*!40000 ALTER TABLE `link_hostlanguage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_usergroup`
--

DROP TABLE IF EXISTS `link_usergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link_usergroup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group` int(3) unsigned NOT NULL,
  `user` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `l_GU` (`group`,`user`),
  KEY `l_GU_Us_idx` (`user`),
  CONSTRAINT `l_GU_Gr` FOREIGN KEY (`group`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `l_GU_Us` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_usergroup`
--

LOCK TABLES `link_usergroup` WRITE;
/*!40000 ALTER TABLE `link_usergroup` DISABLE KEYS */;
INSERT INTO `link_usergroup` VALUES (1,1,1);
/*!40000 ALTER TABLE `link_usergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `alias` varchar(63) NOT NULL,
  `creater` int(11) unsigned NOT NULL,
  `changer` int(11) unsigned DEFAULT NULL,
  `host` int(3) unsigned NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `isActive` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `isVisible` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `isDeleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `keyLeft` int(11) unsigned NOT NULL,
  `keyRight` int(11) unsigned NOT NULL,
  `level` int(2) unsigned NOT NULL,
  `pagetype` int(3) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `workspace` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyLeft_UNIQUE` (`keyLeft`),
  UNIQUE KEY `url_UNIQUE` (`host`,`workspace`,`url`),
  UNIQUE KEY `keyRight_UNIQUE` (`keyRight`),
  KEY `P_Us_cr_idx` (`creater`),
  KEY `P_Us_ch_idx` (`changer`),
  KEY `P_PT_idx` (`pagetype`),
  KEY `P_W_idx` (`workspace`),
  CONSTRAINT `P_H` FOREIGN KEY (`host`) REFERENCES `host` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `P_PT` FOREIGN KEY (`pagetype`) REFERENCES `pagetype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `P_Us_ch` FOREIGN KEY (`changer`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `P_Us_cr` FOREIGN KEY (`creater`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `P_W` FOREIGN KEY (`workspace`) REFERENCES `workspace` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES ('',1,NULL,1,1,1,1,0,1,30,1,1,'',1),('content',1,NULL,1,2,1,1,0,2,7,2,1,'content',1),('pages',1,NULL,1,3,1,1,0,3,4,3,1,'content/pages',1),('files',1,NULL,1,4,1,1,0,5,6,3,1,'content/files',1),('statistic',1,NULL,1,5,1,1,0,8,15,2,1,'statistic',1),('bots',1,NULL,1,6,1,1,0,9,10,3,1,'statistics/bots',1),('transfers',1,NULL,1,7,1,1,0,11,12,3,1,'statistics/transfers',1),('visits',1,NULL,1,8,1,1,0,13,14,3,1,'statistics/visits',1),('settings',1,NULL,1,9,1,1,0,14,29,2,1,'settings',1),('groups',1,NULL,1,10,1,1,0,17,18,3,2,'administration/groups',1),('users',1,NULL,1,11,1,1,0,19,20,3,3,'administration/users',1),('languages',1,NULL,1,12,1,1,0,21,22,3,4,'administration/languages',1),('table',1,NULL,1,13,1,1,0,23,24,3,8,'administration/table',1),('field',1,NULL,1,14,1,1,0,25,26,3,9,'administration/filed',1),('history',1,NULL,1,15,1,1,0,27,28,3,7,'administration/history',1);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagetype`
--

DROP TABLE IF EXISTS `pagetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagetype` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `method` varchar(63) DEFAULT NULL,
  `mvc` varchar(63) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagetype`
--

LOCK TABLES `pagetype` WRITE;
/*!40000 ALTER TABLE `pagetype` DISABLE KEYS */;
INSERT INTO `pagetype` VALUES (1,NULL,'Index'),(2,NULL,'Group'),(3,NULL,'User'),(4,NULL,'Language'),(5,NULL,'Page'),(6,NULL,'File'),(7,NULL,'History'),(8,NULL,'Table'),(9,NULL,'Field');
/*!40000 ALTER TABLE `pagetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table`
--

DROP TABLE IF EXISTS `table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table` varchar(63) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`table`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table`
--

LOCK TABLES `table` WRITE;
/*!40000 ALTER TABLE `table` DISABLE KEYS */;
INSERT INTO `table` VALUES (1,'Field'),(2,'Group'),(10,'History'),(3,'Host'),(4,'Language'),(5,'Page'),(6,'PageType'),(7,'Table'),(8,'User'),(9,'Workspace');
/*!40000 ALTER TABLE `table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `created` datetime NOT NULL,
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `lastVisit` datetime DEFAULT NULL,
  `login` varchar(31) NOT NULL,
  `mail` varchar(127) NOT NULL,
  `password` varchar(127) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail_UNIQUE` (`mail`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `password_UNIQUE` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('2015-01-20 00:00:00',1,1,0,'2019-11-29 09:26:59','Arhangel31337','arhangel31337@gmail.com','$6$rounds=10000$MTIyYzM1Yjc0NTk1$dOtST8vcHR4vVYp9lSeO.Nkjxt.6dgFKe3R5CU21u/WTDBxmTOxgTNbIYPKpJzF1atRaJMSsYkIPN2D9Bqejg/');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspace`
--

DROP TABLE IF EXISTS `workspace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workspace` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(63) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspace`
--

LOCK TABLES `workspace` WRITE;
/*!40000 ALTER TABLE `workspace` DISABLE KEYS */;
INSERT INTO `workspace` VALUES (1,'BackEnd'),(2,'FrontEnd');
/*!40000 ALTER TABLE `workspace` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-29  9:30:50
