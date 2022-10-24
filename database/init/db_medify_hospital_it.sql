/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_it
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_it` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_it` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_it`;

/*Table structure for table `jenis_komplain` */

DROP TABLE IF EXISTS `jenis_komplain`;

CREATE TABLE `jenis_komplain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_komplain` */

insert  into `jenis_komplain` values 
(1,'Hardware & Jaringan'),
(2,'Software & Aplikasi');

/*Table structure for table `komplain` */

DROP TABLE IF EXISTS `komplain`;

CREATE TABLE `komplain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_komplain_id` int(11) DEFAULT NULL,
  `tgl_komplain` date NOT NULL,
  `jam_komplain` time NOT NULL,
  `jam_respon` time DEFAULT NULL,
  `lokasi` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `catatan` text DEFAULT NULL,
  `respon` text DEFAULT NULL,
  `teknisi` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) unsigned DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `komplain_teknisi` (`teknisi`),
  KEY `komplain_created_by` (`created_by`),
  KEY `komplain_updated_by` (`updated_by`),
  KEY `komplain_jenis_komplain_id` (`jenis_komplain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `komplain` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
