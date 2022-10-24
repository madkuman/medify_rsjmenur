/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_rekam_medis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_rekam_medis` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_rekam_medis` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_rekam_medis`;

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '-2 = tolak penerimaan, -1 = tolak kirim, 0 = waiting, 1 = konfirmasi pengiriman, 2 = konfirmasi penerimaan',
  `status_print` tinyint(4) DEFAULT 0 COMMENT '0 = belum, 1 = sudah',
  `holder_type` int(11) DEFAULT NULL COMMENT '1 = user, 2 = group',
  `holder_user_id` int(11) DEFAULT NULL,
  `holder_group_id` int(11) DEFAULT NULL,
  `holder_confirmed_at` timestamp NULL DEFAULT NULL,
  `holder_confirmed_by` int(11) DEFAULT NULL,
  `holder_keterangan` text DEFAULT NULL,
  `lokasi` varchar(128) DEFAULT NULL,
  `tujuan_id` int(11) DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL COMMENT '1 = Permintaan, 2 = transfer, 3 = ambil',
  `sender_confirmed_at` timestamp NULL DEFAULT NULL,
  `sender_confirmed_by` int(11) DEFAULT NULL,
  `sender_confirmed_group_id` int(11) DEFAULT NULL,
  `sender_keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*Table structure for table `transaksi_tujuan` */

DROP TABLE IF EXISTS `transaksi_tujuan`;

CREATE TABLE `transaksi_tujuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_tujuan` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
