/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_rawat_jalan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_rawat_jalan` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_rawat_jalan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_rawat_jalan`;

/*Table structure for table `antrian_call` */

DROP TABLE IF EXISTS `antrian_call`;

CREATE TABLE `antrian_call` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poli_id` int(11) DEFAULT NULL,
  `poli_nama` varchar(200) DEFAULT NULL,
  `no_antrian` int(11) DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `is_bpjs` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `antrian_call` */

/*Table structure for table `dokter` */

DROP TABLE IF EXISTS `dokter`;

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bpjs_kode_dpjp` varchar(255) DEFAULT NULL,
  `bpjs_kode_dpjp_text` varchar(255) DEFAULT NULL,
  `bpjs_poli` varchar(255) DEFAULT NULL,
  `bpjs_poli_text` varchar(255) DEFAULT NULL,
  `bpjs_spesialis` varchar(255) DEFAULT NULL,
  `bpjs_spesialis_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dokter` */

/*Table structure for table `dokter_jadwal` */

DROP TABLE IF EXISTS `dokter_jadwal`;

CREATE TABLE `dokter_jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'id milik dokter',
  `dokter_id` int(11) DEFAULT NULL,
  `poliklinik_id` int(11) DEFAULT NULL,
  `hari` varchar(24) DEFAULT NULL,
  `hari_order` int(11) DEFAULT NULL,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `nama_dokter` varchar(255) DEFAULT NULL,
  `nama_poli` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dokter_jadwal` */

/*Table structure for table `laporan_rekap_harian` */

DROP TABLE IF EXISTS `laporan_rekap_harian`;

CREATE TABLE `laporan_rekap_harian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poliklinik_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `tanggal_rekap` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `laporan_rekap_harian` */

/*Table structure for table `laporan_transaksi` */

DROP TABLE IF EXISTS `laporan_transaksi`;

CREATE TABLE `laporan_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) DEFAULT NULL,
  `kasus_id` int(11) DEFAULT NULL,
  `poliklinik_id` int(11) DEFAULT NULL,
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
  `status` int(11) DEFAULT NULL,
  `ordered_at` timestamp NULL DEFAULT NULL,
  `waktu_pemeriksaan` timestamp NULL DEFAULT NULL,
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

/*Table structure for table `permintaan_rujuk` */

DROP TABLE IF EXISTS `permintaan_rujuk`;

CREATE TABLE `permintaan_rujuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kasus_id` int(11) DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `buat_kasus_baru` binary(1) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `poli_asal_id` int(11) DEFAULT NULL,
  `poli_tujuan_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0 = waiting, 1 done, -1 rejected',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `no_rujukan` varchar(25) DEFAULT NULL,
  `sep_id` int(11) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `permintaan_rujuk` */

/*Table structure for table `poliklinik` */

DROP TABLE IF EXISTS `poliklinik`;

CREATE TABLE `poliklinik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bpjs_id` varchar(255) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `image_thumb` varchar(256) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `plafon_sep` int(12) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `tarif_dokter_spesialis_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `poliklinik` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poliklinik_id` int(11) DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `nomor_antrian` int(11) DEFAULT NULL,
  `kasus_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `transaksi_masuk_detail_id` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 0 COMMENT '0 = waiting, 1 = sedang periksa, -1 = canceled, 2 = pulang, 3 = perlu dikonfirmasi',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `rujuk` int(1) DEFAULT 0,
  `permintaan_rujuk_id` int(11) DEFAULT NULL,
  `nomor_sep` varchar(255) DEFAULT NULL,
  `is_karcis_pengunjung` int(1) DEFAULT 0,
  `is_kartu_baru` int(1) DEFAULT 0,
  `is_karcis_poli` int(1) DEFAULT 0,
  `is_file_tni` int(1) DEFAULT 0,
  `is_sep_online_created` int(11) DEFAULT 1,
  `total_retribusi` int(11) DEFAULT 0,
  `asal_rujukan` int(11) DEFAULT 0,
  `pasien_pembayaran_id` int(11) DEFAULT NULL,
  `ordered_at` timestamp NULL DEFAULT NULL,
  `waktu_masuk` timestamp NULL DEFAULT NULL,
  `waktu_keluar` timestamp NULL DEFAULT NULL,
  `waktu_pemeriksaan` timestamp NULL DEFAULT NULL,
  `is_pasien_baru` int(1) DEFAULT NULL,
  `usia_masuk` int(11) DEFAULT NULL,
  `rm_transaksi_id` int(11) DEFAULT NULL,
  `rm_transaksi_pengembalian_id` int(11) DEFAULT NULL,
  `cancel_at` timestamp NULL DEFAULT NULL,
  `cancel_by` int(11) DEFAULT NULL,
  `cancel_keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
