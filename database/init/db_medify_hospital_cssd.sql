/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_cssd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_cssd` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_cssd` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_cssd`;

/*Table structure for table `alat` */

DROP TABLE IF EXISTS `alat`;

CREATE TABLE `alat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_alat` varchar(20) NOT NULL,
  `jml_alat` int(10) unsigned NOT NULL,
  `jml_dipinjam` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `alat` */

/*Table structure for table `alkes` */

DROP TABLE IF EXISTS `alkes`;

CREATE TABLE `alkes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `prosedur_sterilisasi` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `batas_efektif` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `alkes` */

/*Table structure for table `alkes_satuan` */

DROP TABLE IF EXISTS `alkes_satuan`;

CREATE TABLE `alkes_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alkes_id` int(11) DEFAULT NULL,
  `slug` varchar(12) DEFAULT NULL,
  `ok_transaksi_id` int(11) DEFAULT NULL COMMENT 'ok transaksi mana yang sedang menggunakan',
  `jumlah_pemakaian` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `alkes_satuan` */

/*Table structure for table `alkes_satuan_log` */

DROP TABLE IF EXISTS `alkes_satuan_log`;

CREATE TABLE `alkes_satuan_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) DEFAULT NULL,
  `alkes_satuan_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `alkes_satuan_log` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT 1 COMMENT '1 = permintaan, 2 pengembalian',
  `ok_transaksi_id` int(11) DEFAULT NULL COMMENT 'ok transaksi mana yang sedang menggunakan',
  `status` int(11) DEFAULT 0 COMMENT '-1 tolak 1 terima 0 menunggu',
  `keterangan` text DEFAULT NULL,
  `keterangan_tolak` text DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `sent_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) DEFAULT NULL,
  `alkes_id` int(11) DEFAULT NULL,
  `alkes_satuan_id` int(11) DEFAULT NULL,
  `extra` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_detail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
