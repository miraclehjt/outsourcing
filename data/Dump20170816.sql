-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: yii2advance
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES (1,'spring','OlIVEt2rqtoBh4joRnwWEPllYGXFbbgw','$2y$13$t1UOMV5miVv2Qk9EXfKyhuYFv5ozjL9ezEgLKitjViu8iX700Nm0a',NULL,'anyeshe@126.com',10,10,1469088711,1469088711),(2,'anyeshe','--cMGHU-7azXkZdP9NXWK7A2nmgW9P_v','$2y$13$6utvZVXX6049BSmp73s7tOapJ0LBYYKWYsDpLJkP70k5DbuxcuCYW',NULL,'anyeshe@sina.com',10,10,1469168816,1469168816);
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('管理员','1',1469154547),('默认角色','2',1502186380);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('/*',2,NULL,NULL,NULL,1469153516,1469153516),('/admin/*',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/assignment/*',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/assignment/assign',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/assignment/index',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/assignment/revoke',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/assignment/view',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/default/*',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/default/index',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/menu/*',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/menu/create',2,NULL,NULL,NULL,1469153499,1469153499),('/admin/menu/delete',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/menu/index',2,NULL,NULL,NULL,1469153494,1469153494),('/admin/menu/update',2,NULL,NULL,NULL,1469153502,1469153502),('/admin/menu/view',2,NULL,NULL,NULL,1469153497,1469153497),('/admin/permission/*',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/permission/assign',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/permission/create',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/permission/delete',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/permission/index',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/permission/remove',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/permission/update',2,NULL,NULL,NULL,1469153507,1469153507),('/admin/permission/view',2,NULL,NULL,NULL,1469153506,1469153506),('/admin/role/*',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/role/assign',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/role/create',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/role/delete',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/role/index',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/role/remove',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/role/update',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/role/view',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/route/*',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/route/assign',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/route/create',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/route/index',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/route/refresh',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/route/remove',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/rule/*',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/rule/create',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/rule/delete',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/rule/index',2,NULL,NULL,NULL,1469153513,1469153513),('/admin/rule/update',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/rule/view',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/*',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/activate',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/change-password',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/delete',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/index',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/login',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/logout',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/reset-password',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/signup',2,NULL,NULL,NULL,1469153514,1469153514),('/admin/user/view',2,NULL,NULL,NULL,1469153514,1469153514),('/debug/*',2,NULL,NULL,NULL,1469153515,1469153515),('/debug/default/*',2,NULL,NULL,NULL,1469153515,1469153515),('/debug/default/db-explain',2,NULL,NULL,NULL,1469153514,1469153514),('/debug/default/download-mail',2,NULL,NULL,NULL,1469153515,1469153515),('/debug/default/index',2,NULL,NULL,NULL,1469153514,1469153514),('/debug/default/toolbar',2,NULL,NULL,NULL,1469153515,1469153515),('/debug/default/view',2,NULL,NULL,NULL,1469153515,1469153515),('/gii/*',2,NULL,NULL,NULL,1469153515,1469153515),('/gii/default/*',2,NULL,NULL,NULL,1469153515,1469153515),('/gii/default/action',2,NULL,NULL,NULL,1469153515,1469153515),('/gii/default/diff',2,NULL,NULL,NULL,1469153515,1469153515),('/gii/default/index',2,NULL,NULL,NULL,1469153515,1469153515),('/gii/default/preview',2,NULL,NULL,NULL,1469153515,1469153515),('/gii/default/view',2,NULL,NULL,NULL,1469153515,1469153515),('/site/*',2,NULL,NULL,NULL,1469153516,1469153516),('/site/error',2,NULL,NULL,NULL,1469153515,1469153515),('/site/index',2,NULL,NULL,NULL,1469153516,1469153516),('/site/login',2,NULL,NULL,NULL,1469153516,1469153516),('/site/logout',2,NULL,NULL,NULL,1469153516,1469153516),('/site/say',2,NULL,NULL,NULL,1471852331,1471852331),('/user/*',2,NULL,NULL,NULL,1469154325,1469154325),('/user/create',2,NULL,NULL,NULL,1469154325,1469154325),('/user/delete',2,NULL,NULL,NULL,1469154325,1469154325),('/user/index',2,NULL,NULL,NULL,1469154325,1469154325),('/user/update',2,NULL,NULL,NULL,1469154325,1469154325),('/user/view',2,NULL,NULL,NULL,1469154325,1469154325),('分配权限',2,'分配权限',NULL,NULL,1502185022,1502185053),('权限管理',2,'权限管理',NULL,NULL,1469156576,1469156576),('用户管理',2,'用户管理',NULL,NULL,1469154405,1469167365),('管理员',1,'管理员',NULL,NULL,1469154477,1469168578),('菜单管理',2,'菜单管理',NULL,NULL,1469156024,1469156024),('角色管理',2,'角色管理',NULL,NULL,1469158099,1469158099),('路由管理',2,'路由管理',NULL,NULL,1469156818,1469156818),('默认权限',2,'默认权限',NULL,NULL,1469168515,1469168515),('默认角色',1,'默认角色',NULL,NULL,1469168484,1502184145);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('分配权限','/admin/assignment/*'),('分配权限','/admin/assignment/assign'),('分配权限','/admin/assignment/index'),('分配权限','/admin/assignment/revoke'),('分配权限','/admin/assignment/view'),('菜单管理','/admin/menu/*'),('菜单管理','/admin/menu/create'),('菜单管理','/admin/menu/delete'),('菜单管理','/admin/menu/index'),('菜单管理','/admin/menu/update'),('菜单管理','/admin/menu/view'),('权限管理','/admin/permission/*'),('权限管理','/admin/permission/assign'),('权限管理','/admin/permission/create'),('权限管理','/admin/permission/delete'),('权限管理','/admin/permission/index'),('权限管理','/admin/permission/remove'),('权限管理','/admin/permission/update'),('权限管理','/admin/permission/view'),('角色管理','/admin/role/*'),('角色管理','/admin/role/assign'),('角色管理','/admin/role/create'),('角色管理','/admin/role/delete'),('角色管理','/admin/role/index'),('角色管理','/admin/role/remove'),('角色管理','/admin/role/update'),('角色管理','/admin/role/view'),('路由管理','/admin/route/*'),('路由管理','/admin/route/assign'),('路由管理','/admin/route/create'),('路由管理','/admin/route/index'),('路由管理','/admin/route/refresh'),('路由管理','/admin/route/remove'),('用户管理','/admin/user/*'),('用户管理','/admin/user/activate'),('用户管理','/admin/user/change-password'),('用户管理','/admin/user/delete'),('用户管理','/admin/user/index'),('用户管理','/admin/user/login'),('用户管理','/admin/user/logout'),('用户管理','/admin/user/request-password-reset'),('用户管理','/admin/user/reset-password'),('用户管理','/admin/user/signup'),('用户管理','/admin/user/view'),('默认权限','/site/*'),('默认权限','/site/error'),('默认权限','/site/index'),('默认权限','/site/login'),('默认权限','/site/logout'),('默认权限','/site/say'),('管理员','分配权限'),('管理员','权限管理'),('管理员','用户管理'),('管理员','菜单管理'),('管理员','角色管理'),('管理员','路由管理'),('管理员','默认权限'),('默认角色','默认权限'),('管理员','默认角色');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `code` char(2) NOT NULL,
  `name` char(52) NOT NULL,
  `population` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES ('AU','Australia',18886000),('BR','Brazil',170115000),('CA','Canada',1147000),('CN','China',1277558000),('DE','Germany',82164700),('FR','France',59225700),('GB','United Kingdom',59623400),('IN','India',1013662000),('RU','Russia',146934000),('US','United States',278357000);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (3,'权限管理',9,'/admin/permission/index',2,'{\"icon\": \"fa fa-lock\", \"visible\": true}'),(4,'菜单管理',9,'/admin/menu/index',5,'{\"icon\": \"fa fa-map-o\", \"visible\": true}'),(5,'路由管理',9,'/admin/route/index',1,'{\"icon\": \" fa fa-code-fork\", \"visible\": true}'),(6,'管理员',9,'/admin/user/index',4,'{\"icon\": \"fa fa-user\", \"visible\": true}'),(7,'角色管理',9,'/admin/role/index',3,'{\"icon\": \"fa fa-group\", \"visible\": true}'),(9,'权限配置模块',NULL,NULL,NULL,NULL),(10,'分配权限',9,'/admin/assignment/index',5,NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1465794076),('m130524_201442_init',1465794095),('m140501_075311_add_oauth2_server',1502780683),('m170721_020240_create_table_test',1500602624),('m170721_020357_create_table_test1',1502780037);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`access_token`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `oauth_access_tokens_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `oauth_clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('80620663b25e4ec0ebc46473c3219b9b1c24cd59','testclient',1,'2017-08-23 06:41:55',NULL);
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_authorization_codes`
--

DROP TABLE IF EXISTS `oauth_authorization_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `redirect_uri` varchar(1000) NOT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`authorization_code`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `oauth_authorization_codes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `oauth_clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_authorization_codes`
--

LOCK TABLES `oauth_authorization_codes` WRITE;
/*!40000 ALTER TABLE `oauth_authorization_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_authorization_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `client_id` varchar(32) NOT NULL,
  `client_secret` varchar(32) DEFAULT NULL,
  `redirect_uri` varchar(1000) NOT NULL,
  `grant_types` varchar(100) NOT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES ('testclient','testpass','http://fake/','client_credentials authorization_code password implicit',NULL,NULL);
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_jwt`
--

DROP TABLE IF EXISTS `oauth_jwt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_jwt` (
  `client_id` varchar(32) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_jwt`
--

LOCK TABLES `oauth_jwt` WRITE;
/*!40000 ALTER TABLE `oauth_jwt` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_jwt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_public_keys`
--

DROP TABLE IF EXISTS `oauth_public_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_public_keys` (
  `client_id` varchar(255) NOT NULL,
  `public_key` varchar(2000) DEFAULT NULL,
  `private_key` varchar(2000) DEFAULT NULL,
  `encryption_algorithm` varchar(100) DEFAULT 'RS256'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_public_keys`
--

LOCK TABLES `oauth_public_keys` WRITE;
/*!40000 ALTER TABLE `oauth_public_keys` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_public_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`refresh_token`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `oauth_refresh_tokens_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `oauth_clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
INSERT INTO `oauth_refresh_tokens` VALUES ('205d63bf472d1275fdf3ed54938e5ddee0ee6ae0','testclient',1,'2017-08-30 06:41:55',NULL),('9523d37d75e747bbe9f02e23ccc0b9b8ea1dba10','testclient',1,'2017-08-29 08:23:34',NULL),('a0cc808886abd5366f99ef75d101b28b97cd94b8','testclient',1,'2017-08-29 12:35:02',NULL);
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_scopes`
--

DROP TABLE IF EXISTS `oauth_scopes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_scopes` (
  `scope` varchar(2000) NOT NULL,
  `is_default` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_scopes`
--

LOCK TABLES `oauth_scopes` WRITE;
/*!40000 ALTER TABLE `oauth_scopes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_scopes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_users`
--

DROP TABLE IF EXISTS `oauth_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(2000) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_users`
--

LOCK TABLES `oauth_users` WRITE;
/*!40000 ALTER TABLE `oauth_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `mobile` varchar(16) NOT NULL COMMENT '手机号',
  `email` varchar(32) NOT NULL DEFAULT '' COMMENT '邮箱',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT '密码',
  `access_token` varchar(40) NOT NULL DEFAULT '' COMMENT '用户访问令牌',
  `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(128) NOT NULL DEFAULT '' COMMENT '用户头像路径',
  `gender` enum('2','1','0') NOT NULL DEFAULT '0' COMMENT '性别 0-未选择 1-男 2-女',
  `birthday` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '出生日期',
  `region` varchar(256) NOT NULL DEFAULT '' COMMENT '所在地域',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户状态 0-正常 1-关闭',
  `create_time` datetime NOT NULL COMMENT '注册时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `mobile` (`mobile`) COMMENT '手机号唯一索引',
  UNIQUE KEY `access_token` (`access_token`) COMMENT 'access_token'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'13522936162','anyeshe@126.com','$2y$13$izG/X6SeuIYPylXD3UALsu/Z6VoM8FtInXFtvV6xaC8IhFHMdu8WK','','anyeshe','','0','0000-00-00 00:00:00','',0,'2017-08-15 12:20:22','2017-08-15 20:32:08');
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

-- Dump completed on 2017-08-16 18:28:34
