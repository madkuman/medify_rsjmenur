/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_urikkes
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_urikkes` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_urikkes` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_urikkes`;

/*Table structure for table `dokter_urikkes` */

DROP TABLE IF EXISTS `dokter_urikkes`;

CREATE TABLE `dokter_urikkes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` text DEFAULT NULL,
  `sebagai` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dokter_urikkes` */

/*Table structure for table `labpk_form` */

DROP TABLE IF EXISTS `labpk_form`;

CREATE TABLE `labpk_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarif_id` int(11) DEFAULT NULL,
  `judul` varchar(72) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `is_parent` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `labpk_form` */

insert  into `labpk_form` values 
(1,1100,'Darah lengkap (auto analizer)','Isian data-data pemeriksaan Darah Lengkap untuk keperluan laporan Urikkes',NULL,'2018-10-17 11:39:59','2018-10-18 06:34:49',NULL,NULL),
(4,1210,'Sedimen','Isian data-data pemeriksaan sedimen urine untuk keperluan laporan Urikkes',NULL,'2018-10-18 13:59:00','2018-10-18 06:59:42',NULL,NULL),
(5,1209,'Urine (10 parameter)','Isian data-data pemeriksaan urine 10 parameter untuk keperluan laporan Urikkes',NULL,'2018-10-18 14:05:43','2018-10-18 09:47:08',NULL,NULL),
(6,1144,'Calcium (Ca)',NULL,NULL,'2018-10-18 14:07:36','2018-10-18 14:07:36',NULL,NULL),
(7,1143,'Chlorida (Cl)',NULL,NULL,'2018-10-18 14:09:28','2018-10-18 14:09:28',NULL,NULL),
(8,1142,'Na',NULL,NULL,'2018-10-18 14:10:26','2018-10-18 14:10:26',NULL,NULL),
(9,1141,'K',NULL,NULL,'2018-10-18 14:11:22','2018-10-18 14:11:22',NULL,NULL),
(10,1182,'HBs Ag (RPHA)',NULL,NULL,'2018-10-18 14:13:12','2018-10-18 14:13:12',NULL,NULL),
(11,1195,'Anti HIV 1 & 2 ( Rapin )',NULL,NULL,'2018-10-18 14:18:31','2018-10-18 14:18:31',NULL,NULL),
(12,1179,'VDRL',NULL,NULL,'2018-10-18 14:19:24','2018-10-18 14:19:24',NULL,NULL),
(13,1188,'Anti HCV (Elisa)',NULL,NULL,'2018-10-18 14:20:26','2018-10-18 14:20:26',NULL,NULL),
(14,1150,'Glukosa acak',NULL,NULL,'2018-10-18 14:25:37','2018-10-18 14:25:37',NULL,NULL),
(15,1153,'Glukosa darah 2 jam PP',NULL,NULL,'2018-10-18 14:26:55','2018-10-18 14:26:55',NULL,NULL),
(16,1152,'Glukosa darah puasa',NULL,NULL,'2018-10-18 14:28:09','2018-10-18 14:28:09',NULL,NULL),
(17,1146,'Cholesterol total',NULL,NULL,'2018-10-18 14:30:00','2018-10-18 14:30:00',NULL,NULL),
(18,1148,'HDL Cholesterol',NULL,NULL,'2018-10-18 14:31:05','2018-10-18 14:31:05',NULL,NULL),
(19,1149,'LDL Cholesterol',NULL,NULL,'2018-10-18 14:31:56','2018-10-18 14:31:56',NULL,NULL),
(20,1147,'Trigliserid',NULL,NULL,'2018-10-18 14:33:00','2018-10-18 14:33:00',NULL,NULL),
(21,1133,'BUN / Urea',NULL,NULL,'2018-10-18 14:34:04','2018-10-18 14:34:04',NULL,NULL),
(22,1134,'Creatinin',NULL,NULL,'2018-10-18 14:34:57','2018-10-18 14:34:57',NULL,NULL),
(23,1136,'Uric Acide',NULL,NULL,'2018-10-18 14:36:20','2018-10-18 14:36:20',NULL,NULL),
(24,1129,'SGOT',NULL,NULL,'2018-10-18 14:38:45','2018-10-18 14:38:45',NULL,NULL),
(25,1130,'SGPT',NULL,NULL,'2018-10-18 14:40:46','2018-10-18 14:40:46',NULL,NULL),
(26,1127,'Bilirubin direk/indirek',NULL,NULL,'2018-10-18 14:42:47','2018-10-18 14:42:47',NULL,NULL),
(27,1128,'Bilirubin Total',NULL,NULL,'2018-10-18 14:43:58','2018-10-18 14:43:58',NULL,NULL),
(28,1132,'Alkali Fosfatase',NULL,NULL,'2018-10-18 14:44:51','2018-10-18 14:44:51',NULL,NULL),
(29,1131,'Gamma GT',NULL,NULL,'2018-10-18 14:45:49','2018-10-18 14:45:49',NULL,NULL),
(30,1125,'Toral Protein',NULL,NULL,'2018-10-18 14:47:47','2018-10-18 14:47:47',NULL,NULL),
(31,1126,'Albumin/Globulin',NULL,NULL,'2018-10-18 14:48:48','2018-10-18 14:48:48',NULL,NULL),
(32,1217,'Morphin (Mop)',NULL,NULL,'2018-10-18 14:52:01','2018-10-18 14:52:01',NULL,NULL),
(33,1218,'Amphetamine (Amp)',NULL,NULL,'2018-10-18 14:52:56','2018-10-18 14:52:56',NULL,NULL),
(34,1221,'Benzodiazepin (BZN)',NULL,NULL,'2018-10-18 14:54:06','2018-10-18 14:54:06',NULL,NULL),
(35,1222,'Ganja (THC)',NULL,NULL,'2018-10-18 14:54:50','2018-10-18 14:54:50',NULL,NULL),
(36,NULL,'Tes Narkoba','Isian data-data pemeriksaan tes narkoba untuk keperluan laporan Urikkes',1,'2018-10-18 08:19:32','2018-10-18 09:47:40',NULL,NULL),
(37,NULL,'Fungsi Liver','Isian data-data pemeriksaan fungsi liver untuk keperluan laporan Urikkes',1,'2018-10-18 08:22:48','2018-10-18 09:47:54',NULL,NULL),
(38,NULL,'Fungsi Ginjal','Isian data-data pemeriksaan fungsi ginjal untuk keperluan laporan Urikkes',1,'2018-10-18 08:32:28','2018-10-18 09:48:06',NULL,NULL),
(39,NULL,'Lemak Darah','Isian data-data pemeriksaan lemak darah untuk keperluan laporan Urikkes',1,'2018-10-18 08:33:53','2018-10-18 09:48:15',NULL,NULL),
(40,NULL,'Gula Darah','Isian data-data pemeriksaan gula darah untuk keperluan laporan Urikkes',1,'2018-10-18 08:35:26','2018-10-18 09:48:27',NULL,NULL),
(41,NULL,'Pemeriksaan Elektrolit','Isian data-data pemeriksaan elektrolit untuk keperluan laporan Urikkes',1,'2018-10-18 08:36:22','2018-10-18 09:48:37',NULL,NULL),
(42,NULL,'Immunologi','Isian data-data pemeriksaan imunologi untuk keperluan laporan Urikkes',1,'2018-10-18 08:37:00','2018-10-18 09:48:47',NULL,NULL),
(43,1112,'Waktu Pembekuan',NULL,NULL,'2018-11-02 13:12:32','2018-11-02 13:12:32',NULL,NULL),
(44,1111,'Waktu Pendarahan',NULL,NULL,'2018-11-02 13:13:01','2018-11-02 13:13:01',NULL,NULL),
(45,1114,'PPT / APTT',NULL,NULL,'2018-11-02 13:16:56','2018-11-02 13:16:56',NULL,NULL),
(46,NULL,'Darah Lain','Isiaan data-data hasil pemeriksaan darah lain-lain (waktu pembekuan, pendarahan dan PTT/APTT)',1,'2018-11-02 06:17:48','2018-11-02 06:17:48',NULL,NULL),
(47,1549,NULL,NULL,NULL,'2019-10-21 11:39:06','2019-10-21 11:39:06',NULL,NULL),
(48,1468,NULL,NULL,NULL,'2019-11-05 01:56:04','2019-11-05 01:56:04',NULL,NULL);

/*Table structure for table `labpk_form_group` */

DROP TABLE IF EXISTS `labpk_form_group`;

CREATE TABLE `labpk_form_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `child_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted-at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `labpk_form_group` */

insert  into `labpk_form_group` values 
(1,36,32,'2018-10-18 08:23:35','2018-10-18 08:23:35',NULL),
(2,36,33,'2018-10-18 08:23:39','2018-10-18 08:23:39',NULL),
(3,36,34,'2018-10-18 08:23:42','2018-10-18 08:23:42',NULL),
(4,36,35,'2018-10-18 08:23:45','2018-10-18 08:23:45',NULL),
(5,37,24,'2018-10-18 08:24:00','2018-10-18 08:24:00',NULL),
(6,37,25,'2018-10-18 08:29:04','2018-10-18 08:29:04',NULL),
(7,37,26,'2018-10-18 08:29:05','2018-10-18 08:29:05',NULL),
(8,37,27,'2018-10-18 08:29:06','2018-10-18 08:29:06',NULL),
(9,37,28,'2018-10-18 08:29:07','2018-10-18 08:29:07',NULL),
(10,37,29,'2018-10-18 08:29:08','2018-10-18 08:29:08',NULL),
(11,37,30,'2018-10-18 08:29:09','2018-10-18 08:29:09',NULL),
(12,37,31,'2018-10-18 08:29:10','2018-10-18 08:29:10',NULL),
(13,38,21,'2018-10-18 08:33:15','2018-10-18 08:33:15',NULL),
(14,38,22,'2018-10-18 08:33:16','2018-10-18 08:33:16',NULL),
(15,38,23,'2018-10-18 08:33:17','2018-10-18 08:33:17',NULL),
(16,39,17,'2018-10-18 08:34:07','2018-10-18 08:34:07',NULL),
(17,39,18,'2018-10-18 08:34:08','2018-10-18 08:34:08',NULL),
(18,39,19,'2018-10-18 08:34:09','2018-10-18 08:34:09',NULL),
(19,39,20,'2018-10-18 08:34:11','2018-10-18 08:34:11',NULL),
(20,40,14,'2018-10-18 08:35:44','2018-10-18 08:35:44',NULL),
(21,40,15,'2018-10-18 08:35:45','2018-10-18 08:35:45',NULL),
(22,40,16,'2018-10-18 08:35:45','2018-10-18 08:35:45',NULL),
(23,41,6,'2018-10-18 08:36:36','2018-10-18 08:36:36',NULL),
(24,41,7,'2018-10-18 08:36:38','2018-10-18 08:36:38',NULL),
(25,41,8,'2018-10-18 08:36:38','2018-10-18 08:36:38',NULL),
(26,41,9,'2018-10-18 08:36:39','2018-10-18 08:36:39',NULL),
(27,42,10,'2018-10-18 08:37:28','2018-10-18 08:37:28',NULL),
(28,42,11,'2018-10-18 08:37:30','2018-10-18 08:37:30',NULL),
(29,42,12,'2018-10-18 08:37:32','2018-10-18 08:37:32',NULL),
(30,42,13,'2018-10-18 08:37:32','2018-10-18 08:37:32',NULL),
(31,46,43,'2018-11-02 06:18:00','2018-11-02 06:18:00',NULL),
(32,46,44,'2018-11-02 06:18:01','2018-11-02 06:18:01',NULL),
(33,46,45,'2018-11-02 06:18:02','2018-11-02 06:18:02',NULL);

/*Table structure for table `labpk_form_hasil` */

DROP TABLE IF EXISTS `labpk_form_hasil`;

CREATE TABLE `labpk_form_hasil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kasus_id` int(11) DEFAULT NULL,
  `form_id` int(11) DEFAULT NULL,
  `hasil` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `labpk_form_hasil` */

/*Table structure for table `latihan_kesehatan` */

DROP TABLE IF EXISTS `latihan_kesehatan`;

CREATE TABLE `latihan_kesehatan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_kegiatan` timestamp NULL DEFAULT NULL,
  `judul` varchar(72) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `latihan_kesehatan` */

/*Table structure for table `layanan` */

DROP TABLE IF EXISTS `layanan`;

CREATE TABLE `layanan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `kode` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `layanan` */

/*Table structure for table `paket` */

DROP TABLE IF EXISTS `paket`;

CREATE TABLE `paket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `paket` */

/*Table structure for table `paket_tarif` */

DROP TABLE IF EXISTS `paket_tarif`;

CREATE TABLE `paket_tarif` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tarif_id` int(11) DEFAULT NULL,
  `paket_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `paket_tarif` */

/*Table structure for table `photo` */

DROP TABLE IF EXISTS `photo`;

CREATE TABLE `photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `latihan_kesehatan_id` int(11) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `photo` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) DEFAULT NULL,
  `kasus_id` int(11) DEFAULT NULL,
  `transaksi_masuk_detail_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ordered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `lokasi_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `pasien_pembayaran_id` int(11) DEFAULT NULL,
  `waktu_print` timestamp NULL DEFAULT current_timestamp(),
  `waktu_pemeriksaan` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_last` tinyint(1) DEFAULT 0,
  `status_penunjang` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) DEFAULT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `paket_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_detail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
