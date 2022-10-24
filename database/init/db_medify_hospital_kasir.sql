/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_kasir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_kasir` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_kasir` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_kasir`;

/*Table structure for table `kasir` */

DROP TABLE IF EXISTS `kasir`;

CREATE TABLE `kasir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `slug` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kasir` */

insert  into `kasir` values 
(1,'Rawat Jalan','kasir-rawat-jalankasir-igd','2019-10-31 17:49:46','2019-10-31 17:50:18','2019-10-31 17:50:18'),
(2,'Utama','kasir-rawat-inap,kasir-lab-pa,kasir-lab-pk,kasir-radiologi,kasir-farmasi','2019-10-31 17:50:35','2019-10-31 18:04:40',NULL),
(3,'IGD','kasir-igd','2019-10-31 18:03:16','2019-10-31 18:03:16',NULL),
(4,'Rawat Jalan','kasir-rawat-jalan','2019-10-31 18:03:25','2019-10-31 18:03:25',NULL),
(5,'Medical Checkup','kasir-medical-checkup','2019-10-31 18:03:35','2019-10-31 18:03:35',NULL);

/*Table structure for table `master_kasir_slug` */

DROP TABLE IF EXISTS `master_kasir_slug`;

CREATE TABLE `master_kasir_slug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `master_kasir_slug` */

insert  into `master_kasir_slug` values 
(1,'Rawat Jalan','kasir-rawat-jalan','2019-10-31 10:41:29','2019-10-31 10:41:29',NULL),
(2,'IGD','kasir-igd','2019-10-31 10:41:32','2019-10-31 10:41:32',NULL),
(3,'Medical Checkup','kasir-medical-checkup','2019-10-31 10:41:36','2019-10-31 10:41:36',NULL),
(4,'Rawat Inap','kasir-rawat-inap','2019-10-31 10:41:38','2019-10-31 10:41:38',NULL),
(5,'Lab PA','kasir-lab-pa','2019-10-31 10:41:41','2019-10-31 10:41:41',NULL),
(6,'Lab PK','kasir-lab-pk','2019-10-31 10:41:43','2019-10-31 10:41:43',NULL),
(7,'Radiologi','kasir-radiologi','2019-10-31 10:41:45','2019-10-31 10:41:45',NULL),
(8,'Farmasi','kasir-farmasi','2019-10-31 10:41:46','2019-10-31 10:41:46',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
