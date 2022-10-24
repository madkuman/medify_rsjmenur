/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital`;

/*Table structure for table `group` */

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `official` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `icons` varchar(48) DEFAULT NULL,
  `icons_img` varchar(128) DEFAULT NULL,
  `photo_ori` varchar(255) DEFAULT 'assets/icons/32/075-networking.png',
  `photo_thumb` varchar(255) DEFAULT 'assets/icons/32/075-networking.png',
  `banner` varchar(255) DEFAULT NULL,
  `lokasi` int(11) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_group_rm` tinyint(1) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

/*Data for the table `group` */

insert  into `group` values 
(1,'Administrasi',1,'pasien','pasien',NULL,'fal fa-user','007-patient.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,'2018-12-09 23:52:02',0,NULL),
(2,'Rawat Jalan',1,'rawatjalan','rawat-jalan',NULL,'far fa-wheelchair','008-accessibility.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(3,'Rawat Inap',1,'rawatinap','rawat-inap',NULL,'far fa-bed','009-hospital-bed.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(4,'Gizi',1,'gizi','gizi',NULL,'fal fa-utensils','010-cutlery.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(5,'Farmasi',1,'farmasi','farmasi',NULL,'fal fa-prescription-bottle-alt','011-medicine.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(6,'Reserved',1,'reserved','reserved',NULL,'fal fa-warehouse-alt','015-warehouse.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(7,'IGD',1,'igd','igd',NULL,'fal fa-ambulance','001-ambulance.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(8,'Kamar Operasi',1,'kamaroperasi','kamar-operasi',NULL,'fal fa-utensil-knife','018-surgery.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,'2018-12-31 00:27:42',0,NULL),
(9,'Lab PK',1,'labpk','lab-pk',NULL,'fal fa-flask','002-chemistry.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(10,'Clinical Pathway',1,'clinical-pathways','clinical-pathway',NULL,'fal fa-check-double','004-shield.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(11,'CSSD',1,'cssd','cssd',NULL,'fal fa-fragile','017-scalpel-1.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(12,'Kamar Jenazah',1,'kamarjenazah','kamar-jenazah',NULL,'fal fa-dizzy','019-gravestone.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(13,'Kepegawaian',1,'kepegawaian','kepegawaian',NULL,'fal fa-user-md','021-progress.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(14,'Keuangan',1,'keuangan','keuangan',NULL,'fal fa-balance-scale','023-money.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(15,'Manajemen',1,'highlevelreport','manajemen',NULL,'far fa-chart-bar','024-manager.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(16,'Humas',1,'humas','humas',NULL,'fal fa-volume-up','025-promotion.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(17,'Aset',1,'aset','aset',NULL,'fal fa-cube','026-3d.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(18,'Lab PA',1,'labpa','lab-pa',NULL,'fal fa-microscope','003-microscope.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(19,'Laundry',1,'laundry','laundry',NULL,'fal fa-tshirt','027-laundry.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(20,'Rekam Medis',1,'rekammedis','rekam-medis',NULL,'fal fa-notes-medical','005-medical-history.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,'2018-09-24 11:07:57',1,NULL),
(21,'Kasir',1,'kasir','kasir',NULL,'fal fa-money','023-money.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(22,'Admin',1,'admin','admin',NULL,'fa fa-users','009-hospital-bed.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,'1',NULL,NULL,0,NULL),
(23,'BPJS',1,'bpjs','bpjs',NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(24,'IPCN',1,'mutu','ipcn',NULL,'fa fa-users','009-hospital-bed.png','assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,'10','2019-08-27 10:16:47','2019-08-27 10:16:47',0,NULL),
(25,'K3',1,'k3/laporkan-k3','k3-laporkan-k3',NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(26,'Medical Checkup',1,'urikkes/pemeriksaan-harian','medical-checkup',NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,1,NULL,NULL,NULL,0,NULL),
(27,'Mutu',1,'mutu','mutu',NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,NULL),
(28,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(29,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(30,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(31,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(32,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(33,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(34,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(35,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(36,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(37,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(38,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(39,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(40,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(41,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(42,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(43,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(44,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(45,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(46,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(47,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(48,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(49,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(50,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(51,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(52,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(53,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(54,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(55,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(56,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(57,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(58,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(59,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(60,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(61,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(62,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(63,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(64,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(65,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(66,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(67,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(68,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(69,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(70,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(71,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(72,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(73,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(74,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(75,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(76,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(77,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(78,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(79,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(80,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(81,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(82,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(83,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(84,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(85,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(86,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(87,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(88,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(89,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(90,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(91,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(92,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(93,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(94,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(95,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(96,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(97,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(98,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(99,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29'),
(100,'Reserved',NULL,NULL,NULL,NULL,NULL,NULL,'assets/icons/32/075-networking.png','assets/icons/32/075-networking.png',NULL,NULL,NULL,NULL,NULL,0,'2019-10-31 12:25:29');

/*Table structure for table `group_member` */

DROP TABLE IF EXISTS `group_member`;

CREATE TABLE `group_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL DEFAULT 0,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `invitation` int(11) DEFAULT NULL COMMENT '1 kalau join, 0 kalo pending',
  `admin` int(11) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL COMMENT 'user yang mengirim invitation',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `group_member` */

insert  into `group_member` values 
(1,2,1,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(2,2,2,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(3,2,3,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(4,2,8,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(5,2,9,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(6,2,7,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(7,2,5,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(8,2,4,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(9,2,10,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(10,2,11,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(11,2,12,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(12,2,13,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(13,2,17,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(14,2,16,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(15,2,15,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(16,2,14,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(17,2,18,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(18,2,19,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(19,2,21,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(20,2,20,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(21,2,25,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(22,2,24,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(23,2,23,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(24,2,22,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(25,2,26,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(26,2,27,'2019-12-04 21:09:35','2019-12-04 21:12:19',1,1,NULL),
(27,5,1,'2019-12-04 21:10:15','2019-12-04 21:10:15',1,0,NULL),
(28,5,2,'2019-12-04 21:10:15','2019-12-04 21:10:15',1,0,NULL),
(29,5,3,'2019-12-04 21:10:15','2019-12-04 21:10:15',1,0,NULL),
(30,5,8,'2019-12-04 21:10:15','2019-12-04 21:10:15',1,0,NULL),
(31,5,7,'2019-12-04 21:10:15','2019-12-04 21:10:15',1,0,NULL),
(32,7,4,'2019-12-04 21:10:46','2019-12-04 21:10:46',1,0,NULL),
(33,7,2,'2019-12-04 21:10:46','2019-12-04 21:10:46',1,0,NULL),
(34,7,3,'2019-12-04 21:10:46','2019-12-04 21:10:46',1,0,NULL),
(35,7,7,'2019-12-04 21:10:46','2019-12-04 21:10:46',1,0,NULL),
(36,7,1,'2019-12-04 21:10:46','2019-12-04 21:10:46',1,0,NULL),
(37,8,5,'2019-12-04 21:11:54','2019-12-04 21:11:54',1,0,NULL),
(38,8,2,'2019-12-04 21:11:54','2019-12-04 21:11:54',1,0,NULL),
(39,8,3,'2019-12-04 21:11:54','2019-12-04 21:11:54',1,0,NULL),
(40,8,7,'2019-12-04 21:11:54','2019-12-04 21:11:54',1,0,NULL);

/*Table structure for table `group_post` */

DROP TABLE IF EXISTS `group_post`;

CREATE TABLE `group_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `post` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `group_post` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(256) DEFAULT NULL,
  `rawat_inap` tinyint(1) DEFAULT 0,
  `rawat_jalan` tinyint(1) DEFAULT 0,
  `igd` tinyint(1) DEFAULT 0,
  `medical_checkup` tinyint(4) DEFAULT 0,
  `slug` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas` values 
(1,'1',1,0,0,0,NULL,'2019-10-31 13:39:51','2019-10-31 14:02:45',2),
(2,'2',1,0,0,0,NULL,'2019-10-31 13:40:02','2019-10-31 14:02:47',2),
(3,'3',1,1,1,1,NULL,'2019-10-31 13:40:12','2019-10-31 14:02:48',2),
(4,'VIP',1,0,0,0,NULL,'2019-10-31 13:40:24','2019-10-31 13:40:24',2),
(5,'VVIP',1,0,0,0,NULL,'2019-11-03 22:18:24','2019-11-03 22:18:24',2);

/*Table structure for table `lokasi` */

DROP TABLE IF EXISTS `lokasi`;

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `zona_ppi_id` int(11) DEFAULT NULL,
  `lokasi_departemen_id` int(11) DEFAULT NULL,
  `kategori_keuangan_id` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lokasi_departemen` (`lokasi_departemen_id`),
  KEY `kategori_ruangan` (`kategori_keuangan_id`),
  KEY `deleted_at_lokasi_departemen` (`lokasi_departemen_id`,`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `lokasi` */

insert  into `lokasi` values 
(1,'Radiologi',NULL,8,8,'radiologi','2018-09-26 12:53:59','2019-12-03 19:05:50',NULL,NULL),
(2,'Lab PK',NULL,6,6,'lab-pk','2018-09-26 12:53:59','2019-12-03 19:05:55',NULL,NULL),
(3,'Lab PA',NULL,7,7,'lab-pa','2018-09-26 12:53:59','2019-12-03 19:06:00',NULL,NULL),
(4,'Kamar Jenazah',NULL,13,13,'kamar-jenazah','2018-09-26 12:53:59','2019-12-03 19:06:07',NULL,NULL),
(5,'Gudang Farmasi',NULL,10,10,'gudang-farmasi','2018-09-26 12:53:59','2019-12-03 19:06:12',NULL,NULL),
(6,'Medical Checkup',NULL,4,4,'medical-checkup','2018-09-26 12:53:59','2019-12-03 19:06:17',NULL,NULL),
(7,'Administrasi',NULL,14,14,'administrasi','2018-10-20 23:53:49','2019-12-03 19:06:21',NULL,NULL),
(8,'Keuangan',NULL,11,11,'keuangan','2019-07-30 16:47:29','2019-12-03 19:06:25',NULL,NULL),
(9,'Gizi',NULL,12,12,'gizi','2019-10-30 12:31:51','2019-12-03 19:06:29',NULL,NULL),
(10,'Radioterapi',NULL,9,9,'radioterapi','2019-10-30 12:31:59','2019-12-03 19:07:12',NULL,NULL);

/*Table structure for table `lokasi_departemen` */

DROP TABLE IF EXISTS `lokasi_departemen`;

CREATE TABLE `lokasi_departemen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `lokasi_departemen` */

insert  into `lokasi_departemen` values 
(1,'IGD','igd','2018-09-26 12:39:12','2018-09-26 12:39:12',NULL,NULL),
(2,'Rawat Jalan','rawat-jalan','2018-09-26 12:39:16','2018-09-26 12:39:16',NULL,NULL),
(3,'Rawat Inap','rawat-inap','2018-09-26 12:39:18','2018-09-26 12:39:18',NULL,NULL),
(4,'Medical Checkup','medical-checkup','2018-09-26 12:39:22','2018-09-26 12:39:22',NULL,NULL),
(5,'Kamar Operasi','kamar-operasi','2018-09-26 12:39:24','2018-09-26 12:39:24',NULL,NULL),
(6,'Lab Patologi Klinis','lab-pk','2018-09-26 12:39:30','2018-09-26 12:39:30',NULL,NULL),
(7,'Lab Patologi Anatomi','lab-pa','2018-09-26 12:39:35','2018-09-26 12:39:35',NULL,NULL),
(8,'Radiologi','radiologi','2018-09-26 12:39:38','2018-09-26 12:39:38',NULL,NULL),
(9,'Radioterapi','radioterapi','2018-09-26 12:39:44','2018-09-26 12:39:44',NULL,NULL),
(10,'Farmasi','farmasi','2018-09-26 12:39:47','2018-09-26 12:39:47',NULL,NULL),
(11,'Keuangan','keuangan','2018-09-26 12:39:51','2018-09-26 12:39:51',NULL,NULL),
(12,'Gizi','gizi','2018-09-26 12:39:57','2018-09-26 12:39:57',NULL,NULL),
(13,'Kamar Jenazah','kamar-jenazah','2018-09-26 12:40:00','2018-09-26 12:40:00',NULL,NULL),
(14,'Administrasi','administrasi','2018-09-26 12:40:01','2018-09-26 12:40:01',NULL,NULL);

/*Table structure for table `lokasi_zona_ppi` */

DROP TABLE IF EXISTS `lokasi_zona_ppi`;

CREATE TABLE `lokasi_zona_ppi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zona` varchar(24) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `lokasi_zona_ppi` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations` values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2016_01_01_000000_add_voyager_user_fields',1),
(4,'2016_01_01_000000_create_data_types_table',1),
(5,'2016_05_19_173453_create_menu_table',1),
(6,'2016_10_21_190000_create_roles_table',1),
(7,'2016_10_21_190000_create_settings_table',1);

/*Table structure for table `notification` */

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `mark_as_read` int(11) NOT NULL COMMENT '1 kalau read, 0 kalau pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `displayed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `notification` */

/*Table structure for table `paket_obat` */

DROP TABLE IF EXISTS `paket_obat`;

CREATE TABLE `paket_obat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(256) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `paket_obat` */

/*Table structure for table `paket_obat_detail` */

DROP TABLE IF EXISTS `paket_obat_detail`;

CREATE TABLE `paket_obat_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paket_obat_id` int(11) DEFAULT NULL,
  `kategori` varchar(24) DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `racikan` text DEFAULT NULL,
  `type` varchar(8) DEFAULT NULL,
  `jumlah` varchar(5) DEFAULT NULL,
  `aturan` varchar(256) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `paket_obat_detail` */

/*Table structure for table `paket_obat_subscribe` */

DROP TABLE IF EXISTS `paket_obat_subscribe`;

CREATE TABLE `paket_obat_subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paket_obat_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `paket_obat_subscribe` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `profesi` */

DROP TABLE IF EXISTS `profesi`;

CREATE TABLE `profesi` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `profesi` */

insert  into `profesi` values 
(1,'Dokter','dokter'),
(2,'Perawat','perawat'),
(3,'Farmasi','farmasi'),
(4,'Psikolog','psikolog'),
(5,'Administrasi','administrasi'),
(6,'Laborat','laborat'),
(7,'Paramedis','paramedis'),
(8,'Terapis','terapis'),
(9,'Radiologi','radiologi'),
(10,'Ahli Gizi','ahligizi'),
(11,'Rekam Medis','rekammedis'),
(12,'CSSD','cssd'),
(13,'Kamar Operasi','kamaroperasi'),
(14,'Kepegawaian','kepegawaian'),
(15,'Keuangan','keuangan'),
(16,'Laundry','laundry'),
(17,'Manajemen','manajemen'),
(18,'Humas','humas'),
(19,'Kamar Jenazah','kamarjenazah'),
(20,'IT','it'),
(21,'Pasien','pasien'),
(22,'Teknisi','teknisi'),
(23,'Mahasiswa','mahasiswa');

/*Table structure for table `profession_specialty` */

DROP TABLE IF EXISTS `profession_specialty`;

CREATE TABLE `profession_specialty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `profession` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

/*Data for the table `profession_specialty` */

insert  into `profession_specialty` values 
(1,'Umum',1,NULL),
(2,'Gigi Umum',1,NULL),
(3,'Spesialis Anak',1,NULL),
(4,'Spesialis Anestesiologi dan Terapi Intensif',1,NULL),
(5,'Spesialis Andrologi',1,NULL),
(6,'Spesialis Akupunktur Klinik',1,NULL),
(7,'Spesialis Bedah',1,NULL),
(8,'Spesialis Bedah Anak',1,NULL),
(9,'Spesialis Bedah Mulut dan Maksilofasial (Semua Bedah termasuk, sumbing, kanker, dan pencabutan gigi ',1,NULL),
(10,'Spesialis Bedah Plastik Rekonstruksi dan Estetik',1,NULL),
(11,'Spesialis Bedah Saraf',1,NULL),
(12,'Spesialis Bedah Toraks dan Kardiovaskular',1,NULL),
(13,'Spesialis Kedokteran Forensik & Medikolegal',1,NULL),
(14,'Spesialis Farmakologi Klinik',1,NULL),
(15,'Spesialis Gizi Klinik',1,NULL),
(16,'Spesialis Jantung dan Pembuluh Darah',1,NULL),
(17,'Spesialis Kedokteran Fisik dan Rehabilitasi',1,NULL),
(18,'Spesialis Konservasi Gigi (Endodontik, pengawetan gigi, sedapat mungkin mempertahankan gigi yang ada',1,NULL),
(19,'Spesialis Kedokteran Gigi Anak (Pedodontik) (Dokter Gigi)',1,NULL),
(20,'Spesialis Kedokteran Jiwa atau Psikiatri',1,NULL),
(21,'Spesialis Kedokteran Penerbangan',1,NULL),
(22,'Spesialis Penyakit Kulit dan Kelamin',1,NULL),
(23,'Spesialis Emergency Medic (Kedaruratan Medik)',1,NULL),
(24,'Spesialis Kedokteran Nuklir',1,NULL),
(25,'Spesialis Kedokteran Olahraga',1,NULL),
(26,'Spesialis Layanan Primer',1,NULL),
(27,'Spesialis Mata',1,NULL),
(28,'Spesialis Mikrobiologi Klinik',1,NULL),
(29,'Spesialis Obstetri & Ginekologi (Kebidanan dan Kandungan)',1,NULL),
(30,'Spesialis Kedokteran Okupasi (Kerja)',1,NULL),
(31,'Spesialis Onkologi Radiasi',1,NULL),
(32,'Spesialis Ortodonsia (Perawatan Maloklusi, Merapikan gigi dengan kawat gigi termasuk pencabutan gigi',1,NULL),
(33,'Spesialis Bedah Orthopaedi dan Traumatologi',1,NULL),
(34,'Spesialis Pulmonologi dan Kedokteran Respirasi (Paru)',1,NULL),
(35,'Spesialis Parasitologi Klinik',1,NULL),
(36,'Spesialis Periodonsia (Jaringan Gusi dan Penyangga Gigi termasuk karang gigi) (Dokter Gigi)',1,NULL),
(37,'Spesialis Patologi Anatomi',1,NULL),
(38,'Spesialis Penyakit Dalam',1,NULL),
(39,'Spesialis Patologi Klinik',1,NULL),
(40,'Spesialis Penyakit Mulut (Dokter Gigi)',1,NULL),
(41,'Spesialis Prostodonsia (Restorasi Rongga Mulut, Gigi tiruan) (Dokter Gigi)',1,NULL),
(42,'Spesialis Radiologi',1,NULL),
(43,'Spesialis Radiologi Kedokteran Gigi (Dokter Gigi)',1,NULL),
(44,'Spesialis Saraf',1,NULL),
(45,'Spesialis Telinga Hidung Tenggorok-Bedah Kepala Leher',1,NULL),
(46,'Spesialis Urologi',1,NULL),
(47,'Spesialis Geriatri (sedang dikaji)',1,NULL),
(48,'Perawat NERS',2,'perawat-ners'),
(49,'Perawat Gigi',2,NULL),
(50,'Perawat Anastesi',2,NULL),
(51,'Bidan',2,NULL),
(52,'Apoteker',3,NULL),
(53,'Asisten Apoteker',3,NULL),
(54,'Admisi Farmasi',3,NULL),
(55,'Analis Farmasi',3,NULL),
(56,'Admisi Lab',6,NULL),
(57,'Staf Lab',6,NULL),
(58,'Operator Lab',6,NULL),
(59,'EMT - B',7,NULL),
(60,'EMT - A',7,NULL),
(61,'EMT - P',7,NULL),
(62,'Fisioterapis',8,NULL),
(63,'Okupasi Terapis',8,NULL),
(64,'Terapis Wicara',8,NULL),
(65,'Terapis Akunpuntur',8,NULL),
(66,'Radiografer',9,NULL),
(67,'Admisi Radiologi',9,NULL),
(68,'Ahli Gizi',10,NULL),
(69,'Staf Gizi',10,NULL),
(70,'Perekam Medis',11,NULL),
(71,'Analis Rekam Medis',11,NULL),
(72,'Staf CSSD',12,NULL),
(73,'Staf Kamar Operasi',13,NULL),
(74,'Bendahara',15,NULL),
(75,'Staf Keuangan',15,NULL),
(76,'Kasir',15,NULL),
(77,'Staf Laundry',16,NULL),
(78,'Teknisi Gigi',22,NULL),
(79,'Teknisi Elektromedis',22,NULL),
(80,'Refraksionis Optisien',22,NULL),
(81,'Dokter Muda',23,NULL),
(82,'PPDS',23,NULL),
(83,'Apoteker',23,NULL),
(84,'Gizi',23,NULL),
(85,'Perawat',23,NULL),
(86,'Spesialis Bedah Onkologi',1,NULL),
(87,'Spesialis Onkologi Radiasi',1,NULL),
(88,'Orthotik Prosthetik',8,NULL),
(89,'Perawat Vokasi',2,'perawat-vokasi');

/*Table structure for table `profession_subspecialty` */

DROP TABLE IF EXISTS `profession_subspecialty`;

CREATE TABLE `profession_subspecialty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `specialty_id` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

/*Data for the table `profession_subspecialty` */

insert  into `profession_subspecialty` values 
(1,'Alergi Immunologi Klinik',38,NULL),
(2,'Ginjal Hipertensi',38,NULL),
(3,'Gastroenterologi Hepatologi',38,NULL),
(4,'Geriatri',38,NULL),
(5,'Hepatologi',38,NULL),
(6,'Psikosomatik',38,NULL),
(7,'Hematologi Onkologi Medik',38,NULL),
(8,'Kardiovaskular',38,NULL),
(9,'Endokrin Metabolik Diabetes',38,NULL),
(10,'Pulmonologi',38,NULL),
(11,'Reumatologi',38,NULL),
(12,'Penyakit Tropik-Infeksi',38,NULL),
(13,'Alergi Imunologi',3,NULL),
(14,'Endokrinologi',3,NULL),
(15,'Gastro-Hepatologi',3,NULL),
(16,'Hematologi Onkologi',3,NULL),
(17,'Kardiologi',3,NULL),
(18,'Nefrologi',3,NULL),
(19,'Infeksi dan Pediatri Tropis',3,NULL),
(20,'Neurologi',3,NULL),
(21,'Nutrisi dan Penyakit Metabolik',3,NULL),
(22,'Pediatri Gawat Darurat',3,NULL),
(23,'Perinatologi',3,NULL),
(24,'Pencitraan',3,NULL),
(25,'Respirologi',3,NULL),
(26,'Tumbuh Kembang Ped. Sosial',3,NULL),
(27,'Kesehatan Remaja',3,NULL),
(28,'FACC',7,NULL),
(29,'FICS',7,NULL),
(30,'FACP',7,NULL),
(31,'FESC',7,NULL),
(32,'FACS',7,NULL),
(33,'FIHA',7,NULL),
(34,'Intensive Care/ICU',4,NULL),
(35,'Anestesi Regional dan Intervensi',4,NULL),
(36,'Anestesi Kardiovaskular',4,NULL),
(37,'Manajemen Nyeri',4,NULL),
(38,'Anestesi Pediatri',4,NULL),
(39,'Neuroanastesi',4,NULL),
(40,'Anastesi Obstetri',4,NULL),
(41,'Bedah Onkologi',7,NULL),
(42,'Bedah Toraks Kardiovaskular',7,NULL),
(43,'Bedah Digestif',7,NULL),
(44,'Bedah Kepala Leher',7,NULL),
(45,'Bedah Anak',7,NULL),
(46,'Bedah Plastik Rekonstruksi dan Estetik',7,NULL),
(47,'Bedah Vaskuler dan Endovaskuler',7,NULL),
(48,'Bedah Saraf',7,NULL),
(49,'Urologi',7,NULL),
(50,'Orthopaedi dan Traumatologi',7,NULL),
(51,'Konsultan Luka Bakar',10,NULL),
(52,'Konsultan Micro Surgery',10,NULL),
(53,'Konsultan Kraniofasial',10,NULL),
(54,'Konsultan Bedah Tangan',10,NULL),
(55,'Konsultan Genitalia Eksterna',10,NULL),
(56,'Konsultan Estetik',10,NULL),
(57,'Infeksi Menular Seksual, Herpes, Dermatosis, Bedah Kulit',22,NULL),
(58,'Infeksi Paru',34,NULL),
(59,'Onkologi Toraks',34,NULL),
(60,'Asma dan PPOK',34,NULL),
(61,'Pulmonologi Intervensi dan Gawat Darurat Napas',34,NULL),
(62,'Faal Paru Klinik',34,NULL),
(63,'Paru Kerja dan Lingkungan',34,NULL),
(64,'Imunologik Klinik',34,NULL),
(65,'Otologi',45,NULL),
(66,'Neurotologi',45,NULL),
(67,'Rinologi',45,NULL),
(68,'Laringo-Faringologi',45,NULL),
(69,'Onkologi Kepala Leher',45,NULL),
(70,'Plastik Rekonstruksi',45,NULL),
(71,'Bronkoesofagologi',45,NULL),
(72,'THT Komunitas',45,NULL),
(73,'Konsultan Spine',33,NULL);

/*Table structure for table `recommended_group` */

DROP TABLE IF EXISTS `recommended_group`;

CREATE TABLE `recommended_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profesi_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `recommended_group` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings` */

/*Table structure for table `spatie_model_has_permissions` */

DROP TABLE IF EXISTS `spatie_model_has_permissions`;

CREATE TABLE `spatie_model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `spatie_model_has_permissions` */

/*Table structure for table `spatie_model_has_roles` */

DROP TABLE IF EXISTS `spatie_model_has_roles`;

CREATE TABLE `spatie_model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `spatie_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `spatie_model_has_roles` */

insert  into `spatie_model_has_roles` values 
(1,'App\\User',2),
(1,'App\\User',10),
(1,'App\\User',77),
(1,'App\\User',106),
(2,'App\\User',9),
(2,'App\\User',50),
(2,'App\\User',72),
(2,'App\\User',97),
(2,'App\\User',98),
(2,'App\\User',103),
(2,'App\\User',107),
(2,'App\\User',108),
(2,'App\\User',117),
(2,'App\\User',118),
(2,'App\\User',120),
(2,'App\\User',130),
(2,'App\\User',134),
(2,'App\\User',137),
(2,'App\\User',140),
(2,'App\\User',145),
(2,'App\\User',148),
(2,'App\\User',152),
(2,'App\\User',159),
(2,'App\\User',160),
(2,'App\\User',162),
(2,'App\\User',163),
(2,'App\\User',168),
(2,'App\\User',169),
(2,'App\\User',170),
(2,'App\\User',172),
(2,'App\\User',829),
(2,'App\\User',1016),
(2,'App\\User',1018),
(2,'App\\User',1019),
(2,'App\\User',2276),
(2,'App\\User',2291),
(2,'App\\User',2304),
(2,'App\\User',2308),
(2,'App\\User',2326),
(3,'App\\User',45),
(3,'App\\User',76),
(3,'App\\User',79),
(3,'App\\User',87),
(3,'App\\User',92),
(3,'App\\User',126),
(3,'App\\User',138),
(3,'App\\User',173),
(3,'App\\User',674),
(3,'App\\User',2299),
(3,'App\\User',2314),
(3,'App\\User',2319);

/*Table structure for table `spatie_permissions` */

DROP TABLE IF EXISTS `spatie_permissions`;

CREATE TABLE `spatie_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `spatie_permissions` */

insert  into `spatie_permissions` values 
(1,'read member','web','2018-09-19 07:27:37','2018-09-19 07:27:37'),
(2,'edit member','web','2018-09-19 07:27:38','2018-09-19 07:27:38'),
(3,'delete member','web','2018-09-19 07:27:38','2018-09-19 07:27:38'),
(4,'guest role','web','2018-09-24 10:40:25','2018-09-24 10:40:25');

/*Table structure for table `spatie_role_has_permissions` */

DROP TABLE IF EXISTS `spatie_role_has_permissions`;

CREATE TABLE `spatie_role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `spatie_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `spatie_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `spatie_role_has_permissions` */

insert  into `spatie_role_has_permissions` values 
(1,1),
(1,2),
(2,1),
(3,1),
(4,3);

/*Table structure for table `spatie_roles` */

DROP TABLE IF EXISTS `spatie_roles`;

CREATE TABLE `spatie_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `spatie_roles` */

insert  into `spatie_roles` values 
(1,'group-admin','web','2018-09-19 07:27:37','2018-09-19 07:27:37'),
(2,'group-member','web','2018-09-19 07:29:42','2018-09-19 07:29:42'),
(3,'group-guest','web','2018-09-24 10:40:24','2018-09-24 10:40:24');

/*Table structure for table `user_karya` */

DROP TABLE IF EXISTS `user_karya`;

CREATE TABLE `user_karya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `jenis_karya` varchar(50) DEFAULT NULL,
  `publikasi` varchar(100) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_karya` */

/*Table structure for table `user_pelatihan` */

DROP TABLE IF EXISTS `user_pelatihan`;

CREATE TABLE `user_pelatihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_pelatihan` */

/*Table structure for table `user_pendidikan` */

DROP TABLE IF EXISTS `user_pendidikan`;

CREATE TABLE `user_pendidikan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `institusi` varchar(255) DEFAULT NULL,
  `departemen` varchar(255) DEFAULT NULL,
  `tahun_masuk` int(11) DEFAULT NULL,
  `tahun_tamat` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_pendidikan` */

/*Table structure for table `user_profile_public` */

DROP TABLE IF EXISTS `user_profile_public`;

CREATE TABLE `user_profile_public` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL DEFAULT 0,
  `allow_publish` int(11) NOT NULL DEFAULT 0 COMMENT '1 kalo allow, 0 kalo decline',
  `allow_pendidikan` int(11) NOT NULL DEFAULT 0,
  `allow_pelatihan` int(11) NOT NULL DEFAULT 0,
  `allow_karya` int(11) NOT NULL DEFAULT 0,
  `allow_skill` int(11) NOT NULL DEFAULT 0,
  `allow_kasus` int(11) NOT NULL DEFAULT 0,
  `allow_jadwal` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_profile_public` */

/*Table structure for table `user_skill` */

DROP TABLE IF EXISTS `user_skill`;

CREATE TABLE `user_skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `skill` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_skill` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `abalabal` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_ori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/img/placeholder.jpg',
  `avatar_big` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/img/placeholder.jpg',
  `avatar_thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/img/placeholder.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profesi` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subspecialty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `str` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` int(11) DEFAULT 1,
  `kode_dpjp` int(11) DEFAULT NULL,
  `dokter_id` int(11) DEFAULT NULL,
  `ttd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `user_allow_override` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users` values 
(1,NULL,'System',NULL,'system','system@medify.id','$2y$10$tvh3nHmjbUU3J0R7OjH2b.UgHJXGyne681PaXuCWjMRc9Nz0VV4ZK',NULL,'uploads/users/MedifyUser-02052019110715-4SxJWYV9yk.png','/assets/users/avatar/1/song_jong_ki.jpg','uploads/users/300x300/MedifyUser-02052019110715-4SxJWYV9yk_300x300.png','zrHAH7l3AEBdQrVoT9HXY089tBVq6H29CBIZwtc1I4sqOxmPKLc6gPpBcpqk','2017-09-25 09:20:27','2019-09-27 10:58:53','20',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1,NULL),
(2,NULL,'admin@kars.or.id','23456y7','admin-kars-or-id','admin@kars.or.id','$2y$10$/pKR8NOqIgqnUfeWXd7boODrKAwBiaxDL52EvY9/Vxp8drtEJ.v2y','tesadmin','uploads/users/MedifyUser-27112019081613-X04iQ99bCK.jpeg','assets/img/placeholder.jpg','uploads/users/300x300/MedifyUser-27112019081613-X04iQ99bCK_300x300.jpeg','tK781jdKwbuVHACmjUYTUhyw3yfd78ebh0Mk45ILRQerz9heLpT4BOvvOrQ5','2019-11-01 23:56:47','2019-11-29 15:36:05','1','1',NULL,NULL,'Admin',NULL,NULL,1,NULL,NULL,NULL,1,NULL),
(3,NULL,'SuperAdmin',NULL,'kevin','admin@medify.id','$2y$10$GAB4PlwMweH8UVNjKXrlV.qPJ6SupwWyn5HrD77VmIjwjQTZJfPRG','kevinfachreza','assets/img/placeholder.jpg','2018-09-18 19:07:01','assets/img/placeholder.jpg','nnd3ixTYxxFqaqevSZZzxwqXGMHEixCgQjSuuycZaxVWpy2zPitDWwQub1Qo','2018-03-20 11:34:57','2019-12-03 19:07:59','1','1',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,1,NULL),
(4,NULL,'Perawat NERS','64362352523','perawat','perawat@medify.id','$2y$10$eWZNuD4mZavlw8daiBJze.EktydcHzfIEs4ttt5XI7Fl6BjgwfDyO','perawatt','uploads/users/MedifyUser-02112019073617-DrAuGIn8pj.jpeg','assets/img/placeholder.jpg','uploads/users/300x300/MedifyUser-02112019073617-DrAuGIn8pj_300x300.jpeg','oI9fgguiPD2Jt0s8ON6896vRissqLjsqk0ahrEauvtacVxZfZE36hKPV7B8b','2019-11-02 07:32:15','2019-12-03 19:05:12','2','49',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,NULL),
(5,NULL,'Perawat NERS KARS','22222','perawat-kars','perawat@kars.or.id','$2y$10$cWkJMQPXH7G3ZrVClxJc9.rXszyXT7r4hDsjeEpfuvXszuErdDdpy','kars','uploads/users/MedifyUser-02112019080902-ThD5R0woni.jpeg','assets/img/placeholder.jpg','uploads/users/300x300/MedifyUser-02112019080902-ThD5R0woni_300x300.jpeg','2xkcXspWfz3RKW0DRwZcJ7Zcl2nIqGpZFEjFsphfPnJRYZHCCSksqkQipDU3','2019-11-02 08:08:11','2019-11-07 19:37:27','2','48',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,NULL),
(6,NULL,'Dokter KARS',NULL,'dokter-kars','dokter@kars.or.id','$2y$10$RUkRnwMWhWusuJBWtZtloeUToCSS2FTUVyfaNUJy37TdgtlmIJvnO',NULL,'assets/img/placeholder.jpg','assets/img/placeholder.jpg','assets/img/placeholder.jpg','EMiPx7eeZbXPFKtA0212B6cDXSD04GSUqluo5cXp6XUGrBdYUP3PKZD6NDmq','2019-11-07 19:35:44','2019-11-07 19:36:19','1','5','6',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,NULL),
(7,NULL,'Gizi KARS',NULL,'gizi-kars','gizi@kars.or.id','$2y$10$EilQ7Zy52VVC894SC19f6.tnH/GmjXWgpn0qApT66eylMhSkO7TKm',NULL,'assets/img/placeholder.jpg','assets/img/placeholder.jpg','assets/img/placeholder.jpg','77Z5ybRqdBjeZ0rFBR9scn9MLdzdEnOAb4CDayUB1bQPs1WDExTtBJektWEg','2019-12-02 10:34:50','2019-12-02 10:34:54','10','68',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,NULL),
(8,NULL,'Farmasi KARS','123','farmasi-kars','farmasi@kars.or.id','$2y$10$ige4UKXaj8JGWqsugbhah.e4ejUCjbhqZtIkEzGw3xvAflJk0G14O','aa','assets/img/placeholder.jpg','assets/img/placeholder.jpg','assets/img/placeholder.jpg',NULL,'2019-12-02 10:41:42','2019-12-04 21:17:58','3','52',NULL,NULL,NULL,'123',NULL,1,NULL,NULL,NULL,0,NULL),
(9,NULL,'Perawat Vokasi',NULL,'perawat-vokasi','perawatvokasi@kars.or.id','$2y$10$Gw57bHDR1jo/d2uMdT.Xv.x2jNTlAw3jIF.yKpeAbvGJ97DiSYkfy',NULL,'assets/img/placeholder.jpg','assets/img/placeholder.jpg','assets/img/placeholder.jpg','iFYSEp3QYOX0uNpsV0Vp0ZVg0akTOBcenYyfr8cCIYFMPBhOGzWbEIc84OKU','2019-12-03 10:07:15','2019-12-03 10:07:23','2','89',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
