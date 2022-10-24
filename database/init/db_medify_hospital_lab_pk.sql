/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_lab_pk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_lab_pk` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_lab_pk` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_lab_pk`;

/*Table structure for table `dokumen` */

DROP TABLE IF EXISTS `dokumen`;

CREATE TABLE `dokumen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(10) unsigned NOT NULL,
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
  `running_number` varchar(50) DEFAULT NULL,
  `sent_by` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dokumen` */

/*Table structure for table `hasil` */

DROP TABLE IF EXISTS `hasil`;

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) DEFAULT NULL,
  `lis_result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`lis_result`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `hasil` */

/*Table structure for table `hasil_transfusi` */

DROP TABLE IF EXISTS `hasil_transfusi`;

CREATE TABLE `hasil_transfusi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `no_kantong` varchar(25) DEFAULT NULL,
  `no_slang` varchar(25) DEFAULT NULL,
  `jenis_darah` varchar(25) DEFAULT NULL,
  `gol_darah` varchar(5) DEFAULT NULL,
  `rhesus` varchar(5) DEFAULT NULL,
  `hasil_cross` varchar(5) DEFAULT NULL,
  `pemberi` varchar(255) DEFAULT NULL,
  `penerima` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `hasil_transfusi` */

/*Table structure for table `laporan_master` */

DROP TABLE IF EXISTS `laporan_master`;

CREATE TABLE `laporan_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `konten` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`konten`)),
  `slug` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `laporan_master` */

insert  into `laporan_master` values 
(1,'REKAPITULASI','{\"MANUAL\": [{\"id\": [\"1475\", \"1476\", \"1478\", \"1479\", \"1480\", \"1481\", \"1484\"], \"detail\": [{\"id\": \"1475\", \"nama\": \"Golongan Darah A,B,O dan Rhesus\"}, {\"id\": \"1476\", \"nama\": \"Evaluasi Hapusan Darah\"}, {\"id\": \"1478\", \"nama\": \"LED-I\"}, {\"id\": \"1479\", \"nama\": \"LED-II\"}, {\"id\": \"1480\", \"nama\": \"Plebotomi\"}, {\"id\": \"1481\", \"nama\": \"Retikulosit   \"}, {\"id\": \"1484\", \"nama\": \"BMA & Evaluasi Sumsum Tulang\"}], \"header\": \"Hematologi\"}, {\"id\": [\"1552\"], \"detail\": [{\"id\": \"1552\", \"nama\": \"Sedimen\"}], \"header\": \"Urine\"}, {\"id\": [\"1584\", \"1606\"], \"detail\": [{\"id\": \"1584\", \"nama\": \"Feses Lengkap (Eosin)\"}, {\"id\": \"1606\", \"nama\": \"Benzodiazepin (BZN)\"}], \"header\": \"Feses\"}, {\"id\": [\"1609\", \"1610\"], \"detail\": [{\"id\": \"1609\", \"nama\": \"Analisa sperma\"}, {\"id\": \"1610\", \"nama\": \"Jamur (KOH)\"}], \"header\": \"Lain-lain\"}], \"REAGEN_BASAH\": [{\"id\": [\"1469\", \"1470\", \"1471\", \"1472\"], \"detail\": [{\"id\": \"1469\", \"nama\": \"APTT\"}, {\"id\": \"1470\", \"nama\": \"PPT\"}, {\"id\": \"1471\", \"nama\": \"INR\"}, {\"id\": \"1472\", \"nama\": \"Fibrinogen\"}], \"header\": \"Hematologi\"}, {\"id\": [\"1554\"], \"detail\": [{\"id\": \"1554\", \"nama\": \"Urine Esbach\"}], \"header\": \"Urine\"}, {\"id\": [\"1486\", \"1487\", \"1488\", \"1489\", \"1490\", \"1491\", \"1492\", \"1494\", \"1497\", \"1501\", \"1502\", \"1503\", \"1504\", \"1507\", \"1508\", \"1509\", \"1588\"], \"detail\": [{\"id\": \"1486\", \"nama\": \"Albumin\"}, {\"id\": \"1487\", \"nama\": \"Alkali Phosphatase\"}, {\"id\": \"1488\", \"nama\": \"Bilirubin Total\"}, {\"id\": \"1489\", \"nama\": \"Bilirubin Direk\"}, {\"id\": \"1490\", \"nama\": \"Bilirubin Indirek\"}, {\"id\": \"1491\", \"nama\": \"BUN (Blood Urea Nitrogen)\"}, {\"id\": \"1492\", \"nama\": \"Creatinin\"}, {\"id\": \"1494\", \"nama\": \"Cholesterol total\"}, {\"id\": \"1497\", \"nama\": \"Globulin\"}, {\"id\": \"1501\", \"nama\": \"HDL  Cholesterol\"}, {\"id\": \"1502\", \"nama\": \"LDL  Cholesterol\"}, {\"id\": \"1503\", \"nama\": \"SGOT\"}, {\"id\": \"1504\", \"nama\": \"SGPT\"}, {\"id\": \"1507\", \"nama\": \"Total Protein\"}, {\"id\": \"1508\", \"nama\": \"Trigliserid\"}, {\"id\": \"1509\", \"nama\": \"Asam Urat\"}, {\"id\": \"1588\", \"nama\": \"Phosfor\"}], \"header\": \"Kimia Klinik\"}, {\"id\": [\"1512\", \"1513\", \"1514\", \"1515\", \"1516\", \"1517\", \"1518\", \"1523\", \"1525\", \"1526\", \"1530\", \"1532\", \"1535\", \"1536\", \"1537\", \"1538\", \"1539\", \"1541\", \"1542\", \"1543\", \"1551\", \"1558\"], \"detail\": [{\"id\": \"1512\", \"nama\": \"Alfa Feto Protein (AFP)\"}, {\"id\": \"1513\", \"nama\": \"Anti HCV (Rapid)\"}, {\"id\": \"1514\", \"nama\": \"ASTO\"}, {\"id\": \"1515\", \"nama\": \"CD - 4\"}, {\"id\": \"1516\", \"nama\": \"CEA\"}, {\"id\": \"1517\", \"nama\": \"CRP\"}, {\"id\": \"1518\", \"nama\": \"HbA1C\"}, {\"id\": \"1523\", \"nama\": \"ICT TB (Rapid)\"}, {\"id\": \"1525\", \"nama\": \"IgM Toxoplasma\"}, {\"id\": \"1526\", \"nama\": \"IgG Toxoplasma\"}, {\"id\": \"1530\", \"nama\": \"NS 1 \"}, {\"id\": \"1532\", \"nama\": \"PSA (Prostat Specifik Antigen)\"}, {\"id\": \"1535\", \"nama\": \"Rematoid Faktor\"}, {\"id\": \"1536\", \"nama\": \"T3\"}, {\"id\": \"1537\", \"nama\": \"T4\"}, {\"id\": \"1538\", \"nama\": \"TPHA / Syphilis\"}, {\"id\": \"1539\", \"nama\": \"Troponin I (Kualitatif)\"}, {\"id\": \"1541\", \"nama\": \"TSH\"}, {\"id\": \"1542\", \"nama\": \"VDRL\"}, {\"id\": \"1543\", \"nama\": \"Widal\"}, {\"id\": \"1551\", \"nama\": \"Mikro Albumin Urine\"}, {\"id\": \"1558\", \"nama\": \"ICT Malaria\"}], \"header\": \"Serologi\"}, {\"id\": [], \"detail\": [], \"header\": \"Mikrobiologi\"}, {\"id\": [], \"detail\": [], \"header\": \"Lain-lain\"}], \"REAGEN_KERING\": [{\"id\": [], \"detail\": [], \"header\": \"Urine\"}, {\"id\": [], \"detail\": [], \"header\": \"Kimia Klinik\"}, {\"id\": [], \"detail\": [], \"header\": \"Serologi\"}, {\"id\": [], \"detail\": [], \"header\": \"Lain-lain\"}], \"ANALISIS_GAS_DARAH\": {\"id\": [\"1585\"]}}','rekap','2019-09-24 12:43:31','2019-10-08 10:48:57',NULL);

/*Table structure for table `laporan_rekap` */

DROP TABLE IF EXISTS `laporan_rekap`;

CREATE TABLE `laporan_rekap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) DEFAULT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `pasien_pembayaran_perusahaan` int(11) DEFAULT NULL,
  `lokasi_departemen` int(11) DEFAULT NULL,
  `result_created_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `laporan_rekap` */

/*Table structure for table `pemeriksaan_form` */

DROP TABLE IF EXISTS `pemeriksaan_form`;

CREATE TABLE `pemeriksaan_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarif_id` int(11) DEFAULT NULL,
  `type` varchar(72) DEFAULT NULL,
  `label` varchar(256) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `placeholder` varchar(256) DEFAULT NULL,
  `satuan` varchar(256) DEFAULT NULL,
  `referensi` varchar(256) DEFAULT NULL,
  `flag` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pemeriksaan_form` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0 = Waiting, -1 = cancel, 1 = done',
  `jam_sampling` timestamp NULL DEFAULT NULL,
  `jam_terima_bahan` timestamp NULL DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `keterangan_permintaan` text DEFAULT NULL,
  `tarif_tipe_id` int(11) DEFAULT NULL,
  `class` int(11) DEFAULT 2,
  `no_bpjs` varchar(20) DEFAULT NULL,
  `no_sep` varchar(20) DEFAULT NULL,
  `slug` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `inspected_at` date DEFAULT NULL,
  `inspected_at_by` int(11) DEFAULT NULL,
  `result_created_at` timestamp NULL DEFAULT NULL,
  `result_created_by` int(11) DEFAULT NULL,
  `kasus_id` int(11) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `alasan_batal` varchar(500) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pasien_pembayaran_id` int(11) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `no_lab` varchar(50) DEFAULT NULL,
  `kirim_kasir` tinyint(4) DEFAULT 0,
  `is_checkout` tinyint(4) DEFAULT 0,
  `inspected_at_created_at` timestamp NULL DEFAULT NULL,
  `barcode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`barcode`)),
  `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`result`)),
  `nama_rs` varchar(100) DEFAULT NULL,
  `nama_dokter` varchar(100) DEFAULT NULL,
  `gol_darah` varchar(255) DEFAULT NULL,
  `infeksi_mdr` tinyint(4) DEFAULT NULL,
  `infeksi_aureus` tinyint(4) DEFAULT NULL,
  `infeksi_karbapenemase` varchar(100) DEFAULT NULL,
  `infeksi_esbl` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) DEFAULT NULL,
  `done` smallint(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'ask',
  `tagihan_detail_id` int(11) DEFAULT NULL,
  `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`result`)),
  `slug` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT 1,
  `barcode` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_detail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
