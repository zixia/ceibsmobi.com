/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.0.45-community-nt : Database - byart
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`ceibsmobi` /*!40100 DEFAULT CHARACTER SET gbk */;

USE ceibsmobi;
/*Table structure for table `jz_admin` */

DROP TABLE IF EXISTS `jz_admin`;

CREATE TABLE `jz_admin` (
  `Id` int(11) NOT NULL auto_increment,
  `admin_name` varchar(20) default NULL,
  `admin_pass` varchar(32) default NULL,
  `admin_group` tinyint(1) default NULL,
  `admin_remark` varchar(200) default NULL,
  `add_date` date default NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `jz_admin` */

insert  into `jz_admin`(Id,admin_name,admin_pass,admin_group,admin_remark,add_date) values (14,'admin','10ed1697617fe7758b4236d5b791286c',2,'','2007-02-05'),(15,'byqy','53ac0791ab9e7f7078ad383ccbd6f660',2,'','2008-01-31');

/*Table structure for table `jz_article` */

DROP TABLE IF EXISTS `jz_article`;

CREATE TABLE `jz_article` (
  `Id` int(11) NOT NULL auto_increment,
  `art_title` varchar(80) default NULL,
  `art_content` text,
  `art_typeid` int(11) default NULL,
  `art_pritype` int(11) default NULL,
  `art_typename` varchar(20) default NULL,
  `add_user` varchar(20) default NULL,
  `edit_user` varchar(16) default NULL,
  `add_date` date default NULL,
  `look_time` int(11) default '1',
  `art_typeclass` varchar(3) default NULL,
  `art_imgurl` text NOT NULL,
  `art_imgstat` tinyint(1) NOT NULL,
  `art_imgintro` text NOT NULL,
  `row_stat` tinyint(1) default '0',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jz_article` */

/*Table structure for table `jz_contact` */

DROP TABLE IF EXISTS `jz_contact`;

CREATE TABLE `jz_contact` (
  `Id` int(11) NOT NULL auto_increment,
  `contact_name` varchar(50) default NULL,
  `contact_person` varchar(20) default NULL,
  `contact_tel` varchar(20) default NULL,
  `contact_address` varchar(100) default NULL,
  `contact_stat` tinyint(1) default '0',
  `idx` varchar(4) default NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jz_contact` */

/*Table structure for table `jz_down` */

DROP TABLE IF EXISTS `jz_down`;

CREATE TABLE `jz_down` (
  `Id` int(11) NOT NULL auto_increment,
  `down_title` varchar(200) default NULL,
  `down_url` varchar(100) default NULL,
  `down_content` text,
  `add_user` varchar(40) default NULL,
  `add_date` date default NULL,
  `look_time` int(11) default NULL,
  `down_typeid` int(11) default NULL,
  `down_typename` varchar(40) default NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jz_down` */

/*Table structure for table `jz_img` */

DROP TABLE IF EXISTS `jz_img`;

CREATE TABLE `jz_img` (
  `Id` int(11) NOT NULL auto_increment,
  `img_title` varchar(200) default NULL,
  `img_url` varchar(100) default NULL,
  `img_content` text,
  `add_date` date default NULL,
  `add_user` varchar(20) default NULL,
  `look_time` int(11) default '0',
  `img_stat` tinyint(1) default '0',
  `img_typeid` int(11) default NULL,
  `img_typename` varchar(40) default NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jz_img` */

/*Table structure for table `jz_lead` */

DROP TABLE IF EXISTS `jz_lead`;

CREATE TABLE `jz_lead` (
  `Id` int(11) NOT NULL auto_increment,
  `lead_type` tinyint(4) NOT NULL DEFAULT '0',
  `lead_name` varchar(20) default NULL,
  `lead_work` varchar(250) default NULL,
  `lead_class` varchar(250) default NULL,
  `lead_img` varchar(200) default NULL,
  `lead_content` text,
  `add_date` date default NULL,
  `add_user` varchar(20) default NULL,
  `stat` tinyint(1) default '0',
  `look_time` int(11) default '0',
  `row_stat` tinyint(1) default '0',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jz_lead` */

/*Table structure for table `jz_news` */

DROP TABLE IF EXISTS `jz_news`;

CREATE TABLE `jz_news` (
  `Id` int(11) NOT NULL auto_increment,
  `news_title` varchar(80) default NULL,
  `news_content` text,
  `add_user` varchar(11) default NULL,
  `edit_user` varchar(16) default NULL,
  `news_type` varchar(20) default NULL,
  `add_date` date default NULL,
  `look_time` int(11) default '0',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jz_news` */

/*Table structure for table `jz_single` */

DROP TABLE IF EXISTS `jz_single`;

CREATE TABLE `jz_single` (
  `Id` int(11) NOT NULL auto_increment,
  `type_id` int(11) default NULL,
  `single_item` varchar(100) default NULL,
  `single_content` text,
  `single_user` varchar(20) default NULL,
  `single_date` date default NULL,
  `edit_time` int(11) default NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jz_single` */

/*Table structure for table `jz_src` */

DROP TABLE IF EXISTS `jz_src`;

CREATE TABLE `jz_src` (
  `Id` int(11) NOT NULL auto_increment,
  `src_title` varchar(200) default NULL,
  `src_url` varchar(250) default NULL,
  `src_img` varchar(250) default NULL,
  `src_type` tinyint(2) default NULL,
  `add_date` date default NULL,
  `add_user` varchar(20) default NULL,
  `src_stat` tinyint(1) default '0',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jz_src` */

/*Table structure for table `jz_type` */

DROP TABLE IF EXISTS `jz_type`;

CREATE TABLE `jz_type` (
  `Id` int(11) NOT NULL auto_increment,
  `type_name` varchar(20) default NULL,
  `type_stat` tinyint(1) default NULL,
  `type_shu` int(11) default NULL,
  `type_class` tinyint(3) default NULL,
  `type_remark` varchar(200) default NULL,
  `type_list` varchar(4) default NULL,
  `type_check` tinyint(2) default '1',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `jz_type` */

insert  into `jz_type`(Id,type_name,type_stat,type_shu,type_class,type_remark,type_list,type_check) values (1,'新闻中心',1,0,NULL,'',NULL,1),(2,'信息动态',2,1,3,'',NULL,1),(3,'图片新闻',2,1,5,'',NULL,1);

/*Table structure for table `jz_user` */

DROP TABLE IF EXISTS `jz_user`;

CREATE TABLE `jz_user` (
  `Id` int(11) NOT NULL auto_increment,
  `user_name` varchar(20) default NULL,
  `user_pass` varchar(32) default NULL,
  `user_email` varchar(100) default NULL,
  `user_question` varchar(100) default NULL,
  `user_answer` varchar(100) default NULL,
  `user_sex` tinyint(1) default NULL,
  `user_qq` varchar(11) default NULL,
  `user_brith` date default NULL,
  `user_remark` text,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jz_user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
