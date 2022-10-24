/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_kamar_operasi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_kamar_operasi` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_kamar_operasi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_kamar_operasi`;

/*Table structure for table `foto_operasi` */

DROP TABLE IF EXISTS `foto_operasi`;

CREATE TABLE `foto_operasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `id_for_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `foto_operasi` */

/*Table structure for table `implan` */

DROP TABLE IF EXISTS `implan`;

CREATE TABLE `implan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `satuan` varchar(45) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `implan` */

/*Table structure for table `jenis_operasi` */

DROP TABLE IF EXISTS `jenis_operasi`;

CREATE TABLE `jenis_operasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_operasi` */

insert  into `jenis_operasi` values 
(1,'Kecil','2018-10-19 03:45:28','2018-10-19 04:14:03',NULL),
(2,'Sedang','2018-10-19 04:10:32','2018-10-19 04:10:32',NULL),
(3,'Besar','2018-10-19 04:10:54','2018-10-19 04:10:54',NULL),
(4,'Canggih','2018-10-19 04:11:00','2018-10-19 04:11:00',NULL),
(5,'Khusus','2018-10-19 04:11:22','2018-10-19 04:11:22',NULL);

/*Table structure for table `jenis_spesialis_operasi` */

DROP TABLE IF EXISTS `jenis_spesialis_operasi`;

CREATE TABLE `jenis_spesialis_operasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_spesialis_operasi` */

insert  into `jenis_spesialis_operasi` values 
(1,'Orthopaedi','2019-06-02 21:37:44','2019-06-11 09:22:40',NULL),
(2,'Orthopaedi Spine','2019-06-02 21:37:48','2019-06-11 09:22:37',NULL),
(3,'Urologi','2019-06-02 21:37:51','2019-06-02 21:37:51',NULL),
(4,'Digestif','2019-06-02 21:37:52','2019-06-02 21:37:56',NULL),
(5,'Bedah Anak','2019-06-02 21:37:59','2019-06-02 21:37:59',NULL),
(6,'Minor','2019-06-02 21:38:01','2019-06-02 21:38:01',NULL),
(7,'Neuro Surgery','2019-06-02 21:38:05','2019-06-02 21:38:05',NULL),
(8,'TKV','2019-06-02 21:38:06','2019-06-02 21:38:06',NULL),
(9,'Onkologi','2019-06-02 21:38:09','2019-06-02 21:38:09',NULL),
(10,'Bedah Plastik','2019-06-02 21:38:12','2019-06-02 21:38:12',NULL),
(11,'Obsgyn','2019-06-02 21:38:17','2019-06-02 21:38:17',NULL),
(12,'Bedah Umum','2019-06-02 21:38:20','2019-06-02 21:38:20',NULL),
(13,'THT','2019-06-11 09:22:46','2019-06-11 09:22:46',NULL),
(14,'Mata','2019-06-11 09:22:47','2019-06-11 09:22:47',NULL),
(15,'Bedah Mulut','2019-06-18 02:48:59','2019-06-18 02:48:59',NULL);

/*Table structure for table `matkes` */

DROP TABLE IF EXISTS `matkes`;

CREATE TABLE `matkes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `satuan` varchar(45) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matkes` */

/*Table structure for table `paket` */

DROP TABLE IF EXISTS `paket`;

CREATE TABLE `paket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `tipe` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `paket` */

/*Table structure for table `paket_item` */

DROP TABLE IF EXISTS `paket_item`;

CREATE TABLE `paket_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paket_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tipe` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `paket_item` */

/*Table structure for table `pasca` */

DROP TABLE IF EXISTS `pasca`;

CREATE TABLE `pasca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kasus_id` int(11) DEFAULT NULL,
  `diagnosis_awal` varchar(256) DEFAULT NULL,
  `diagnosis_akhir` varchar(256) DEFAULT NULL,
  `persiapan` varchar(256) DEFAULT NULL,
  `posisi` varchar(256) DEFAULT NULL,
  `disinfektan` varchar(256) DEFAULT NULL,
  `incisi` varchar(256) DEFAULT NULL,
  `temuan_operasi` varchar(256) DEFAULT NULL,
  `tindakan` varchar(256) DEFAULT NULL,
  `pendarahan` varchar(256) DEFAULT NULL,
  `advice_post` varchar(256) DEFAULT NULL,
  `pemeriksaan_pa` varchar(256) DEFAULT NULL,
  `jenis_operasi` varchar(256) DEFAULT NULL,
  `tanggal_operasi` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `lama_anastesi` time DEFAULT NULL,
  `macam_anestesi` varchar(45) DEFAULT NULL,
  `status_pasien` varchar(50) DEFAULT 'HIDUP',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pasca` */

/*Table structure for table `pemakaian` */

DROP TABLE IF EXISTS `pemakaian`;

CREATE TABLE `pemakaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operasi_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pemakaian` */

/*Table structure for table `pengembalian` */

DROP TABLE IF EXISTS `pengembalian`;

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operasi_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengembalian` */

/*Table structure for table `peran_tim` */

DROP TABLE IF EXISTS `peran_tim`;

CREATE TABLE `peran_tim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `peran_tim` */

insert  into `peran_tim` values 
(1,'Dokter Operator','2018-10-19 03:47:28','2019-10-30 14:00:51',NULL),
(2,'Dokter Anestesi','2018-10-19 03:48:02','2019-10-30 14:00:52',NULL),
(3,'Asisten Operasi','2018-10-19 03:48:10','2019-10-30 14:00:53',NULL),
(4,'Perawat Instrumen','2018-10-19 03:48:15','2019-10-30 14:00:54',NULL),
(5,'Penata Anestesi','2018-10-19 03:48:21','2019-10-30 14:00:55',NULL),
(6,'Perawat Sirkuler','2018-10-19 03:48:28','2019-10-30 14:00:55',NULL),
(7,'SpA pendamping SC','2018-10-19 03:48:35','2019-10-30 14:00:56',NULL),
(8,'Perawat Asisten Operasi','2019-05-21 00:41:37','2019-10-30 14:00:58',NULL),
(9,'Dokter SpA pendamping SC','2019-05-21 00:41:56','2019-10-30 14:00:59',NULL);

/*Table structure for table `pergantian_jadwal` */

DROP TABLE IF EXISTS `pergantian_jadwal`;

CREATE TABLE `pergantian_jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operasi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` varchar(45) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pergantian_jadwal` */

/*Table structure for table `rencana` */

DROP TABLE IF EXISTS `rencana`;

CREATE TABLE `rencana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operasi_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `rencana` */

/*Table structure for table `ruangan` */

DROP TABLE IF EXISTS `ruangan`;

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(72) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `ronde` int(11) DEFAULT 8,
  `farmasi_id` int(11) DEFAULT NULL,
  `image_thumb` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ruangan` */

/*Table structure for table `tim` */

DROP TABLE IF EXISTS `tim`;

CREATE TABLE `tim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operasi_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tim` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) DEFAULT NULL,
  `ruangan_id` int(11) DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `hasil_id` int(11) DEFAULT NULL,
  `diagnosis_id` int(11) DEFAULT NULL,
  `diagnosis` varchar(1024) DEFAULT NULL,
  `judul` varchar(1024) DEFAULT NULL,
  `jadwal_operasi` date DEFAULT NULL,
  `dijadwalkan_oleh` int(11) DEFAULT NULL,
  `nomor_ronde` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=belum,1=sudah operasi',
  `deskripsi_rencana` text DEFAULT NULL,
  `kasus_id` int(11) DEFAULT NULL,
  `transaksi_obat_id` int(11) DEFAULT NULL,
  `jenis_spesialis_id` int(11) DEFAULT NULL,
  `distribusi_rencana_id` int(11) DEFAULT NULL,
  `transaksi_global_id` int(11) DEFAULT NULL,
  `masa_tunggu` date DEFAULT NULL,
  `permintaan_alat_id` int(11) DEFAULT NULL,
  `pengembalian_alat_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `alasan_batal` text DEFAULT NULL,
  `icd9_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
