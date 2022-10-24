/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_rawat_inap
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_rawat_inap` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_rawat_inap` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_rawat_inap`;

/*Table structure for table `bangsal` */

DROP TABLE IF EXISTS `bangsal`;

CREATE TABLE `bangsal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(256) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `kategori_keuangan_id` int(11) DEFAULT NULL,
  `intensif` int(11) DEFAULT NULL,
  `bayi` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tarif_master_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bangsal` */

/*Table structure for table `bor` */

DROP TABLE IF EXISTS `bor`;

CREATE TABLE `bor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah_hari_periode` int(11) DEFAULT NULL,
  `jumlah_hari_perawatan` int(11) DEFAULT NULL,
  `jumlah_tempat_tidur` int(11) DEFAULT NULL,
  `bor` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bor` */

/*Table structure for table `bto` */

DROP TABLE IF EXISTS `bto`;

CREATE TABLE `bto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah_tempat_tidur` int(11) DEFAULT NULL,
  `jumlah_pasien_keluar` int(11) DEFAULT NULL,
  `bto` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bto` */

/*Table structure for table `foto` */

DROP TABLE IF EXISTS `foto`;

CREATE TABLE `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` int(11) DEFAULT NULL COMMENT '1=bangsal, 2=ruangan',
  `tipe_item_id` int(11) DEFAULT NULL COMMENT 'id bangsal/ruangan',
  `foto_ori` varchar(256) DEFAULT NULL,
  `foto_thumb` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `foto` */

/*Table structure for table `laporan_transaksi` */

DROP TABLE IF EXISTS `laporan_transaksi`;

CREATE TABLE `laporan_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kasus_id` int(11) DEFAULT NULL,
  `tempat_tidur_id` int(11) DEFAULT NULL,
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
  `kedatangan_at` timestamp NULL DEFAULT NULL,
  `waktu_masuk` timestamp NULL DEFAULT NULL,
  `waktu_keluar` timestamp NULL DEFAULT NULL,
  `krs_at` timestamp NULL DEFAULT NULL,
  `krs_alasan` varchar(64) DEFAULT NULL,
  `krs_status` varchar(64) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `laporan_transaksi_diagnosis` */

/*Table structure for table `ruangan` */

DROP TABLE IF EXISTS `ruangan`;

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(24) DEFAULT NULL,
  `kelas` varchar(8) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `bangsal_id` int(11) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `intensif` int(11) DEFAULT NULL,
  `bayi` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `kelas_applicare` varchar(15) DEFAULT NULL,
  `kode_ruang` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lokasi_unique` (`lokasi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ruangan` */

/*Table structure for table `ruangan_tarif` */

DROP TABLE IF EXISTS `ruangan_tarif`;

CREATE TABLE `ruangan_tarif` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ruangan_id` int(11) DEFAULT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ruangan_tarif` */

/*Table structure for table `ruangan_visite` */

DROP TABLE IF EXISTS `ruangan_visite`;

CREATE TABLE `ruangan_visite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruangan_id` int(11) DEFAULT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `jenis_dokter` int(1) DEFAULT NULL COMMENT '1= umum, 2=spesialis, 3=subspesialis',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ruangan_visite` */

/*Table structure for table `statistik_hari_perawatan` */

DROP TABLE IF EXISTS `statistik_hari_perawatan`;

CREATE TABLE `statistik_hari_perawatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `bed_id` int(11) DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'Jika terisi maka transaksi ini double, artinya sudah ada transaksi sebelumnya yang terjadi di bed tersebut. Agar tidak mengganggu perhitungan statistik maka didelete di controller',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `statistik_hari_perawatan` */

/*Table structure for table `tempat_tidur` */

DROP TABLE IF EXISTS `tempat_tidur`;

CREATE TABLE `tempat_tidur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(24) DEFAULT NULL,
  `ruangan_id` int(11) DEFAULT NULL,
  `desc` varchar(24) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tempat_tidur` */

/*Table structure for table `toi` */

DROP TABLE IF EXISTS `toi`;

CREATE TABLE `toi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah_hari_periode` int(11) DEFAULT NULL,
  `jumlah_hari_perawatan` int(11) DEFAULT NULL,
  `jumlah_tempat_tidur` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `toi` float DEFAULT NULL,
  `jumlah_pasien_keluar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `toi` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tempat_tidur_id` int(11) DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `transaksi_masuk_detail_id` int(11) DEFAULT NULL,
  `tempat_tidur_bayi` int(11) DEFAULT NULL COMMENT '1 = iya',
  `kasus_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `waktu_masuk` timestamp NULL DEFAULT current_timestamp(),
  `waktu_keluar` timestamp NULL DEFAULT NULL,
  `status` int(2) DEFAULT NULL COMMENT '-1=tolak,0=antri baru, 1 = sudah di kamar, 2 = antri kamar(booking), 3 = keluar',
  `tolak_keterangan` varchar(200) DEFAULT NULL,
  `kepala_keluarga` varchar(255) DEFAULT NULL,
  `diagnosis` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `usia_masuk` int(11) DEFAULT NULL,
  `is_intensif` tinyint(4) DEFAULT 0 COMMENT '1 = ya 0 tidak',
  `is_bayi` tinyint(4) DEFAULT NULL,
  `is_pindah` binary(1) DEFAULT '0',
  `is_bayar_changed` binary(1) DEFAULT '0',
  `kedatangan_at` timestamp NULL DEFAULT NULL,
  `los` int(11) DEFAULT 1,
  `lokasi_departemen_id` int(11) DEFAULT NULL,
  `rm_transaksi_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
