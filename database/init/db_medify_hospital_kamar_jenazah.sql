/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_kamar_jenazah
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_kamar_jenazah` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_kamar_jenazah` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_kamar_jenazah`;

/*Table structure for table `diagnosis` */

DROP TABLE IF EXISTS `diagnosis`;

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_diagnosis` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `diagnosis` */

insert  into `diagnosis` values 
(1,'Rekam Medis'),
(2,'Pemeriksaan Luar Jenazah'),
(3,'Autopsi Forensik'),
(4,'Autopsi Medis'),
(5,'Autopsi Verbal'),
(6,'Lainnya');

/*Table structure for table `diagnosis_permintaan` */

DROP TABLE IF EXISTS `diagnosis_permintaan`;

CREATE TABLE `diagnosis_permintaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permintaan_id` int(11) NOT NULL,
  `diagnosis_id` int(11) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `diagnosis_permintaan` */

/*Table structure for table `permintaan` */

DROP TABLE IF EXISTS `permintaan`;

CREATE TABLE `permintaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) NOT NULL,
  `kasus_id` int(11) DEFAULT NULL,
  `waktu_meninggal` varchar(50) DEFAULT NULL,
  `waktu_jemput` varchar(50) DEFAULT NULL,
  `tempat_meninggal` varchar(50) DEFAULT NULL,
  `detail_tempat` varchar(200) DEFAULT NULL,
  `sebab_kematian_id` int(11) NOT NULL,
  `detail_kematian` varchar(200) DEFAULT NULL,
  `nama_pemeriksa` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nik` int(20) DEFAULT NULL,
  `status_kependudukan` varchar(50) DEFAULT NULL,
  `status_jenazah` varchar(50) DEFAULT NULL,
  `hubungan_keluarga` varchar(50) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL COMMENT '1 = menunggu 2 = sudah dijemput dan transaksi',
  `dikubur` varchar(50) DEFAULT NULL,
  `nokk` int(20) DEFAULT NULL,
  `nama_penanggung` varchar(50) DEFAULT NULL,
  `usia_penanggung` int(3) DEFAULT NULL,
  `kelamin_penanggung` varchar(10) DEFAULT NULL,
  `hubungan_penanggung` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekam_medis_index` (`pasien_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `permintaan` */

/*Table structure for table `sebab_kematian` */

DROP TABLE IF EXISTS `sebab_kematian`;

CREATE TABLE `sebab_kematian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sebab` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `sebab_kematian` */

insert  into `sebab_kematian` values 
(1,'Penyakit Khusus'),
(2,'Penyakit Menular'),
(3,'Penyakit Tidak Menular'),
(4,'Gangguan Maternal (Kehamilan / Persalinan / nifas)'),
(5,'Gangguan Perinatal (0-6 hari)'),
(6,'Gejala, tanda, dan kondisi lainnya'),
(7,'Cedera Kecelakaan Lalu Lintar'),
(8,'Cedera Kecelakaan Kerja'),
(9,'Cedera Lainnya');

/*Table structure for table `tarif` */

DROP TABLE IF EXISTS `tarif`;

CREATE TABLE `tarif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(100) DEFAULT NULL,
  `harga_layanan` varchar(50) DEFAULT NULL,
  `kategori` smallint(6) DEFAULT NULL,
  `tarif_keuangan_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tarif` */

/*Table structure for table `tempat_meninggal` */

DROP TABLE IF EXISTS `tempat_meninggal`;

CREATE TABLE `tempat_meninggal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tempat` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tempat_meninggal` */

insert  into `tempat_meninggal` values 
(1,'Rumah Sakit'),
(2,'Puskesmas'),
(3,'Rumah Tempat Tinggal'),
(4,'Lainnya');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permintaan_id` int(11) NOT NULL,
  `total_transaksi` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*Table structure for table `transaksi_tarif` */

DROP TABLE IF EXISTS `transaksi_tarif`;

CREATE TABLE `transaksi_tarif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_tarif` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
