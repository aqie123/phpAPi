-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: test
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
-- Table structure for table `art`
--

DROP TABLE IF EXISTS `art`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `art` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '文章标题',
  `contents` text COLLATE utf8_unicode_ci NOT NULL COMMENT '文章内容',
  `author` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '作者名称',
  `cate` int(4) NOT NULL COMMENT '文章分类ID',
  `ctime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'create time',
  `mtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'modify time',
  `status` enum('delete','online','offline') COLLATE utf8_unicode_ci DEFAULT 'offline' COMMENT '是否被删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='文章';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `art`
--

LOCK TABLES `art` WRITE;
/*!40000 ALTER TABLE `art` DISABLE KEYS */;
INSERT INTO `art` VALUES (1,'编辑','啦啦啦啦德玛西亚','aqie',1,'2017-09-29 23:43:29','2017-09-30 07:25:53','online'),(2,'1','2','3',1,'2017-09-29 23:44:23','2017-09-29 23:44:23','offline'),(3,'荷塘月色','我是内容','aqie',1,'2017-09-29 23:52:28','2017-09-30 09:51:00','online'),(4,'荷塘月色','我是内容','aqie',1,'2017-09-29 23:53:56','2017-09-29 23:53:56','offline'),(5,'荷塘月色','我是内容','aqie',1,'2017-09-29 23:55:50','2017-09-29 23:55:50','offline'),(6,'我是传奇3','我是内容','aqie',1,'2017-09-29 23:56:00','2017-09-30 09:50:23','online'),(9,'我是传奇','我是内容','aqie',1,'2017-09-30 09:47:35','2017-09-30 09:50:31','online'),(10,'我是传奇2','我是内容','aqie',1,'2017-09-30 09:47:42','2017-09-30 09:50:41','online'),(11,'我是传奇3','我是内容','aqie',1,'2017-09-30 09:47:46','2017-09-30 09:50:45','online'),(12,'我是传奇6','我是内容','aqie',1,'2017-10-05 08:50:28','2017-10-05 08:50:28','offline'),(13,'我是传奇7','我是内容','aqie',1,'2017-10-05 11:04:08','2017-10-05 11:04:08','offline'),(14,'我是传奇7','我是内容','aqie',1,'2017-10-05 11:26:10','2017-10-05 11:26:10','offline'),(15,'我是传奇7','我是内容','aqie',1,'2017-10-05 11:26:13','2017-10-05 11:26:13','offline');
/*!40000 ALTER TABLE `art` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_admin`
--

DROP TABLE IF EXISTS `auth_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `password` char(32) NOT NULL DEFAULT '',
  `avatar` varchar(200) DEFAULT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `create_time` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `salt` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='测试表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_admin`
--

LOCK TABLES `auth_admin` WRITE;
/*!40000 ALTER TABLE `auth_admin` DISABLE KEYS */;
INSERT INTO `auth_admin` VALUES (1,'aqie','',NULL,'2924811900@qq.com','15533833058','1000-01-01 00:00:00','1000-01-01 00:00:00',0,''),(2,'马哥','43cca4b3de2097b9558efefd0ecc3588',NULL,'2819698567@qq.com','18630591130','1000-01-01 00:00:00','1000-01-01 00:00:00',0,''),(3,'aqie12','43cca4b3de2097b9558efefd0ecc3588',NULL,'','','2017-09-28 07:00:34','1000-01-01 00:00:00',0,''),(4,'aqie123','e10adc3949ba59abbe56e057f20f883e',NULL,'','','2017-09-28 09:35:19','1000-01-01 00:00:00',0,''),(5,'啊切','81dc9bdb52d04dc20036dbd8313ed055',NULL,'','','2017-10-03 23:07:24','1000-01-01 00:00:00',0,''),(6,'apitest_164313587','17f282596a2e7870c79fadc7d95b241d',NULL,'','','2017-10-03 23:18:29','1000-01-01 00:00:00',0,''),(7,'apitest_204139501','4851a491c808cd02914167b5f5402925',NULL,'','','2017-10-03 23:20:28','1000-01-01 00:00:00',0,''),(8,'apitest_131069522','f530f48fb0af022f751afaf874e8a4f9',NULL,'','','2017-10-03 23:21:52','1000-01-01 00:00:00',0,''),(9,'apitest_246629885','19cf3433899e10a0d311e33d09f8f05d',NULL,'','','2017-10-03 23:22:43','1000-01-01 00:00:00',0,''),(10,'apitest_1245041021','244a7a422efcdaabc7e5c5b54ca9e162',NULL,'','','2017-10-03 23:24:14','1000-01-01 00:00:00',0,''),(11,'apitest_1247371113','1c201a15a718b88a3f71b0617e1132bd',NULL,'','','2017-10-04 01:07:43','1000-01-01 00:00:00',0,''),(12,'apitest_903851833','1d41a45372038c661a32767500e09985',NULL,'','','2017-10-04 01:23:03','1000-01-01 00:00:00',0,''),(13,'apitest_91125967','7e2b84fdfaa14e88f8fe0fcd6fbf35fe',NULL,'','','2017-10-04 01:25:55','1000-01-01 00:00:00',0,''),(14,'apitest_114119138','2bc3513704ccac088a6207ec846f05e0',NULL,'','','2017-10-04 01:27:03','1000-01-01 00:00:00',0,''),(15,'apitest_359507163','6b68fce155660828fc41adfba9dae1ff',NULL,'','','2017-10-04 01:27:51','1000-01-01 00:00:00',0,''),(16,'啊切222','addcc0fee7d15875fdd19d9e74a775fd',NULL,'','','2017-10-04 06:33:40','1000-01-01 00:00:00',0,''),(17,'user','81dc9bdb52d04dc20036dbd8313ed055',NULL,'','','2017-10-04 10:56:44','1000-01-01 00:00:00',0,''),(18,'apitest_185618417','1378304a375986cd919210c9f9924973',NULL,'','','2017-10-04 23:25:22','1000-01-01 00:00:00',0,''),(19,'user1','81dc9bdb52d04dc20036dbd8313ed055',NULL,'','','2017-10-03 23:07:24','1000-01-01 00:00:00',0,''),(20,'king','5566',NULL,'','','2017-10-03 23:07:24','1000-01-01 00:00:00',0,''),(21,'apitest_1062465638','c7dd886ea0188e42d2360153313d4015',NULL,'','','2017-10-05 00:25:17','1000-01-01 00:00:00',0,''),(22,'user222','81dc9bdb52d04dc20036dbd8313ed055',NULL,'','','2017-10-05 00:25:40','1000-01-01 00:00:00',0,''),(23,'apitest_331498666','0e1286a9a4bf365ac2b714441e3d0482',NULL,'','','2017-10-05 00:25:58','1000-01-01 00:00:00',0,''),(24,'apitest_986294980','c96d63cadae1d419e2e7efe9fbe32a55',NULL,'','','2017-10-05 00:30:53','1000-01-01 00:00:00',0,''),(25,'apitest_1105015483','0a7a8aa64a41c2f759df61b385c0a5b0',NULL,'','','2017-10-05 02:15:43','1000-01-01 00:00:00',0,''),(26,'apitest_659992281','ed132174e0f5d8437203bf3139964e9a',NULL,'','','2017-10-05 02:18:02','1000-01-01 00:00:00',0,''),(27,'bolt','81dc9bdb52d04dc20036dbd8313ed055',NULL,'','','2017-10-05 02:29:06','1000-01-01 00:00:00',0,''),(28,'bolt2','81dc9bdb52d04dc20036dbd8313ed055',NULL,'','','2017-10-05 03:02:39','1000-01-01 00:00:00',0,''),(29,'apitest_976496356','793915265851a07f4642d4734ed4a2b6',NULL,'','','2017-10-05 03:03:19','1000-01-01 00:00:00',0,''),(30,'bolt555','81dc9bdb52d04dc20036dbd8313ed055',NULL,'','','2017-10-05 03:17:40','1000-01-01 00:00:00',0,''),(31,'apitest_397604434','6fce0148dc406438507fe697b2701d13',NULL,'','','2017-10-05 03:27:58','1000-01-01 00:00:00',0,''),(32,'bolt5555','81dc9bdb52d04dc20036dbd8313ed055',NULL,'','','2017-10-05 06:13:34','1000-01-01 00:00:00',0,'');
/*!40000 ALTER TABLE `auth_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '账单id',
  `itemid` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '商品价格，单位为分',
  `status` enum('paid','unpaid','failed','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unpaid' COMMENT '支付状态',
  `transaction` text COLLATE utf8_unicode_ci COMMENT '交易ID',
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `ptime` timestamp NULL DEFAULT NULL COMMENT '支付时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
INSERT INTO `bill` VALUES (1,1,4,100,'unpaid',NULL,'2017-10-03 05:03:37','2017-10-03 05:03:37',NULL),(2,1,4,100,'unpaid',NULL,'2017-10-03 05:04:17','2017-10-03 05:04:17',NULL),(3,1,4,500,'unpaid',NULL,'2017-10-03 05:04:57','2017-10-03 05:04:57',NULL);
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cate`
--

DROP TABLE IF EXISTS `cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cate` (
  `id` int(11) NOT NULL COMMENT '自增ID',
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '类目名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='分类信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cate`
--

LOCK TABLES `cate` WRITE;
/*!40000 ALTER TABLE `cate` DISABLE KEYS */;
INSERT INTO `cate` VALUES (1,'文学'),(2,'散文');
/*!40000 ALTER TABLE `cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `gname` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '商品名',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT '商品描述',
  `price` bigint(20) NOT NULL DEFAULT '0' COMMENT '商品价格，单位为分',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `etime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '过期时间',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'api商品','商品描述',1,0,'2017-10-03 01:40:38','2017-11-03 01:40:38','2017-10-03 08:47:05');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_record`
--

DROP TABLE IF EXISTS `sms_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `contents` text COLLATE utf8_unicode_ci NOT NULL COMMENT '消息内容',
  `template` int(11) NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='短信发送记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_record`
--

LOCK TABLES `sms_record` WRITE;
/*!40000 ALTER TABLE `sms_record` DISABLE KEYS */;
INSERT INTO `sms_record` VALUES (1,1,'{\"code\":5948}',10018,'2017-10-01 23:46:39'),(2,1,'{\"code\":5104}',100006,'2017-10-01 23:47:12');
/*!40000 ALTER TABLE `sms_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'user id',
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user name',
  `pwd` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user password',
  `email` text COLLATE utf8_unicode_ci COMMENT '用户邮箱',
  `mobile` bigint(11) DEFAULT NULL COMMENT '用户手机号',
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'user register time',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'information change time',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户注册信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'aqie','202cb962ac59075b964b07152d234b70',NULL,NULL,'2017-10-10 02:13:43',NULL),(2,'aqie','202cb962ac59075b964b07152d234b70','2924811900@qq.com',NULL,'2017-10-10 02:14:19',NULL);
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

-- Dump completed on 2017-10-15 15:45:17
