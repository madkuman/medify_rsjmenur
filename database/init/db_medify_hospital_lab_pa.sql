/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_lab_pa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_lab_pa` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_lab_pa` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_lab_pa`;

/*Table structure for table `laporan_master` */

DROP TABLE IF EXISTS `laporan_master`;

CREATE TABLE `laporan_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `konten` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`konten`)),
  `slug` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `laporan_master` */

insert  into `laporan_master` values 
(1,'Rekap Pasien Bulanan','{\"SITOLOGI\": [{\"id\": [\"1453\"], \"detail\": [{\"id\": \"1453\", \"nama\": \"Sitologi Aspirasi (Fnab) Tanpa Tindakan\"}], \"header\": \"FNAB\"}, {\"id\": [\"1449\"], \"detail\": [{\"id\": \"1449\", \"nama\": \"Sitologi Pap Smear\"}], \"header\": \"PAPSMEAR\"}, {\"id\": [\"1451\"], \"detail\": [{\"id\": \"1451\", \"nama\": \"Sitologi Cairan (Pleura, Acites, Cucian/Sikatan Bronchus) Sputum Serial\"}], \"header\": \"SPUTUM\"}], \"HISTOPATOLOGI\": [{\"id\": [\"1444\", \"1445\", \"1446\"], \"detail\": [{\"id\": \"1444\", \"nama\": \"Pemeriksaan Histologi (Blok Parafin) - Jaringan Kecil\"}, {\"id\": \"1445\", \"nama\": \"Pemeriksaan Histologi (Blok Parafin) - Jaringan Sedang\"}, {\"id\": \"1446\", \"nama\": \"Pemeriksaan Histologi (Blok Parafin) - Jaringan Besar\"}], \"header\": \"HE\"}, {\"id\": [\"1447\", \"1448\", \"1451\"], \"detail\": [{\"id\": \"1447\", \"nama\": \"Pemeriksaan Potong Beku (VC)\"}, {\"id\": \"1448\", \"nama\": \"Pemeriksaan Potong Beku (VC) Permintaan Khusus\"}, {\"id\": \"1451\", \"nama\": \"Sitologi Cairan (Pleura, Acites, Cucian/Sikatan Bronchus) Sputum Serial\"}], \"header\": \"VRIESCOUPE\"}, {\"id\": [\"1445\", \"1465\"], \"detail\": [{\"id\": \"1445\", \"nama\": \"Pemeriksaan Histologi (Blok Parafin) - Jaringan Sedang\"}, {\"id\": \"1465\", \"nama\": \"ISH Perpobe\"}], \"header\": \"baru\"}]}','rekap-pasien','2019-08-28 06:25:00','2019-11-27 22:27:23',NULL),
(2,'Mutu Ketepatan','{\"ketepatan\": [{\"id\": [\"1453\"], \"detail\": [{\"id\": \"1453\", \"nama\": \"Sitologi Aspirasi (Fnab) Tanpa Tindakan\"}], \"header\": \"fnab\"}, {\"id\": [\"1449\", \"1451\"], \"detail\": [{\"id\": \"1449\", \"nama\": \"Sitologi Pap Smear\"}, {\"id\": \"1451\", \"nama\": \"Sitologi Cairan (Pleura, Acites, Cucian/Sikatan Bronchus) Sputum Serial\"}], \"header\": \"sitologi\"}, {\"id\": [\"1451\"], \"detail\": [{\"id\": \"1451\", \"nama\": \"Sitologi Cairan (Pleura, Acites, Cucian/Sikatan Bronchus) Sputum Serial\"}], \"header\": \"histologi\"}]}','mutu-ketepatan','2019-10-16 09:49:36','2019-10-17 01:05:15',NULL);

/*Table structure for table `photo` */

DROP TABLE IF EXISTS `photo`;

CREATE TABLE `photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) unsigned NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `caption` varchar(500) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `thumbnail_path` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 = temp; 1 = fix',
  `hash` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `penunjang_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `photo` */

/*Table structure for table `result` */

DROP TABLE IF EXISTS `result`;

CREATE TABLE `result` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) unsigned NOT NULL,
  `makroskopis` text DEFAULT NULL,
  `mikroskopis` text DEFAULT NULL,
  `kesimpulan` text DEFAULT NULL,
  `sitologi_class` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sitologi_class`)),
  `sitologi_infection` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sitologi_infection`)),
  `sitologi_specimen` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sitologi_specimen`)),
  `sitologi_reactive` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sitologi_reactive`)),
  `sitologi_general` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sitologi_general`)),
  `hispatologi_makroskopis` text DEFAULT NULL,
  `hispatologi_mikroskopis` text DEFAULT NULL,
  `hispatologi_kesimpulan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `result` */

/*Table structure for table `transaction` */

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `tarif_tipe_id` int(11) DEFAULT NULL,
  `class` int(11) DEFAULT 2,
  `no_bpjs` varchar(20) DEFAULT NULL,
  `no_sep` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `keterangan` text DEFAULT NULL COMMENT 'Keterangan saat permintaan',
  `keterangan_permintaan` text DEFAULT NULL,
  `result` text DEFAULT NULL,
  `slug` varchar(80) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `result_created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `inspected_at` date DEFAULT NULL,
  `inspected_at_by` int(11) DEFAULT NULL,
  `result_created_by` int(11) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `kasus_id` int(11) DEFAULT NULL,
  `alasan_batal` varchar(500) DEFAULT NULL,
  `slide` int(11) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `kode_pasien` varchar(30) DEFAULT NULL,
  `pasien_pembayaran_id` int(11) DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `kirim_kasir` tinyint(4) DEFAULT 0,
  `is_checkout` tinyint(4) DEFAULT 0,
  `inspected_at_created_at` timestamp NULL DEFAULT NULL,
  `register` varchar(255) DEFAULT NULL,
  `nama_rs` varchar(100) DEFAULT NULL,
  `nama_dokter` varchar(100) DEFAULT NULL,
  `pemeriksaan_start` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction` */

/*Table structure for table `transaction_detail` */

DROP TABLE IF EXISTS `transaction_detail`;

CREATE TABLE `transaction_detail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) NOT NULL,
  `tarif_id` int(10) NOT NULL,
  `status` varchar(10) DEFAULT 'ask' COMMENT 'ask / done / new',
  `qty` int(11) DEFAULT 1,
  `tagihan_detail_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`result`)),
  `slide` varchar(100) DEFAULT NULL,
  `kode_sediaan` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `piutang_id` int(11) DEFAULT NULL COMMENT 'pengganti tagihan_detail_id kalo kirim ke kasir',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction_detail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
