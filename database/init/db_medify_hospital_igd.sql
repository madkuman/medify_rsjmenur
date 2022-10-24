/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_igd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_igd` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_igd` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_igd`;

/*Table structure for table `ambulans` */

DROP TABLE IF EXISTS `ambulans`;

CREATE TABLE `ambulans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telepon` datetime NOT NULL,
  `berangkat` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ambulans` */

/*Table structure for table `antrian` */

DROP TABLE IF EXISTS `antrian`;

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_antrian` varchar(24) DEFAULT NULL,
  `antrian_level_id` int(11) DEFAULT NULL,
  `loket_id` int(11) DEFAULT NULL,
  `called_button_at` timestamp NULL DEFAULT NULL,
  `called_screen_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `antrian` */

/*Table structure for table `antrian_level` */

DROP TABLE IF EXISTS `antrian_level`;

CREATE TABLE `antrian_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `nama` varchar(24) DEFAULT NULL,
  `class` varchar(24) DEFAULT NULL,
  `kode` varchar(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `antrian_level` */

insert  into `antrian_level` values 
(1,1,'High','btn-danger','A','2019-05-08 06:40:17','2019-05-08 06:40:17',NULL,0),
(2,2,'Medium','btn-warning','B','2019-05-08 06:40:20','2019-05-08 06:40:20',NULL,0),
(3,3,'Low','btn-success','C','2019-05-08 06:40:23','2019-05-08 06:40:23',NULL,0);

/*Table structure for table `antrian_loket` */

DROP TABLE IF EXISTS `antrian_loket`;

CREATE TABLE `antrian_loket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(24) DEFAULT NULL,
  `file_name` varchar(36) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `antrian_loket` */

insert  into `antrian_loket` values 
(1,'Loket 1','loket1.mp3','2019-05-08 06:40:17','2019-05-08 06:40:17',NULL,0),
(2,'Loket 2','loket2.mp3','2019-05-08 06:40:20','2019-05-08 06:40:20',NULL,0),
(3,'Loket 3','loket3.mp3','2019-05-08 06:40:23','2019-05-08 06:40:23',NULL,0);

/*Table structure for table `laporan_transaksi` */

DROP TABLE IF EXISTS `laporan_transaksi`;

CREATE TABLE `laporan_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) DEFAULT NULL,
  `kasus_id` int(11) DEFAULT NULL,
  `ruangan_id` int(11) DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `usia_masuk_hr` int(11) DEFAULT NULL,
  `usia_masuk_th` int(11) DEFAULT NULL,
  `is_pasien_baru` int(11) DEFAULT 0,
  `pasien_pembayaran_id` int(11) DEFAULT NULL,
  `no_asuransi` varchar(64) DEFAULT NULL,
  `perusahaan_pembayaran_id` int(11) DEFAULT NULL,
  `perusahaan_pembayaran_tipe_id` int(11) DEFAULT NULL,
  `no_sep` varchar(64) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `waktu_masuk` timestamp NULL DEFAULT NULL,
  `icd_10_id` varchar(64) DEFAULT NULL,
  `dtd_id` varchar(64) DEFAULT NULL,
  `icd_10_utama_id` int(11) DEFAULT NULL,
  `dtd_utama_id` int(11) DEFAULT NULL,
  `total_tagihan` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `DTD` (`dtd_id`),
  KEY `ICD` (`icd_10_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `laporan_transaksi` */

/*Table structure for table `laporan_transaksi_diagnosis` */

DROP TABLE IF EXISTS `laporan_transaksi_diagnosis`;

CREATE TABLE `laporan_transaksi_diagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kasus_id` int(11) DEFAULT NULL,
  `icd10_id` int(11) DEFAULT NULL,
  `dtd_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `laporan_transaksi_diagnosis` */

/*Table structure for table `ruangan` */

DROP TABLE IF EXISTS `ruangan`;

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ruangan` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) DEFAULT NULL,
  `ruangan_id` int(11) DEFAULT NULL,
  `waktu_masuk` timestamp NULL DEFAULT NULL,
  `waktu_keluar` timestamp NULL DEFAULT NULL,
  `kasus_id` int(11) DEFAULT NULL,
  `dokter_id` int(11) DEFAULT NULL,
  `transaksi_masuk_detail_id` int(11) DEFAULT NULL,
  `waktu_datang` datetime DEFAULT NULL,
  `waktu_layani` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_karcis_pengunjung` int(1) DEFAULT 0,
  `is_kartu_baru` int(1) DEFAULT 0,
  `is_karcis_igd` int(1) DEFAULT 0,
  `is_file_tni` int(1) DEFAULT 0,
  `total_retribusi` int(11) DEFAULT 0,
  `asal_rujukan` int(11) DEFAULT NULL,
  `nomor_sep` varchar(72) DEFAULT NULL,
  `pasien_pembayaran_id` int(11) DEFAULT NULL,
  `is_pasien_baru` int(1) DEFAULT NULL,
  `usia_masuk` int(11) DEFAULT NULL,
  `rm_transaksi_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*Table structure for table `triage` */

DROP TABLE IF EXISTS `triage`;

CREATE TABLE `triage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobility` int(2) DEFAULT 0,
  `resp` int(2) DEFAULT 0,
  `heartrate` int(2) DEFAULT 0,
  `systol` int(2) DEFAULT 0,
  `temp` int(2) DEFAULT 0,
  `conscious` int(2) DEFAULT 0,
  `trauma` int(2) DEFAULT 0,
  `score` int(2) DEFAULT NULL,
  `datangigd_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `kasus_id` int(11) DEFAULT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `kasus_lain` varchar(255) DEFAULT NULL,
  `p1_diskriminan` varchar(255) DEFAULT NULL,
  `p2_diskriminan` varchar(255) DEFAULT NULL,
  `p3_diskriminan` varchar(255) DEFAULT NULL,
  `ponek_diskriminan` varchar(255) DEFAULT NULL,
  `pertimbangan_khusus_p1` text DEFAULT NULL,
  `pertimbangan_khusus_p2` text DEFAULT NULL,
  `cara_datang` varchar(255) DEFAULT NULL,
  `transport_igd` varchar(255) DEFAULT NULL,
  `komunikasi` varchar(255) DEFAULT NULL,
  `ganti_anamnesa` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `triage` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
