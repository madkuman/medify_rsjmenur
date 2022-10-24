/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_keuangan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_keuangan` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_keuangan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_keuangan`;

/*Table structure for table `akun` */

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `no_rekening` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `akun` */

/*Table structure for table `akun_pjk` */

DROP TABLE IF EXISTS `akun_pjk`;

CREATE TABLE `akun_pjk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `akun_pjk` */

insert  into `akun_pjk` values 
(1,'UKPBJ','2019-01-15 17:05:50','2019-01-15 17:05:52',NULL),
(2,'PRIMKOPAL','2019-01-15 17:05:55','2019-01-15 17:05:54',NULL),
(3,'STAF1','2019-01-15 17:05:57','2019-01-15 17:05:58',NULL),
(4,'STAF2','2019-01-15 17:06:01','2019-01-15 17:05:59',NULL),
(5,'STAF3','2019-01-15 17:06:02','2019-01-15 17:06:03',NULL),
(6,'UPF','2019-01-15 17:06:06','2019-01-15 17:06:05',NULL),
(7,'DIKLAT','2019-01-15 17:06:07','2019-01-15 17:06:08',NULL);

/*Table structure for table `buku_kas` */

DROP TABLE IF EXISTS `buku_kas`;

CREATE TABLE `buku_kas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_bk` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `buku_kas` */

/*Table structure for table `deposit` */

DROP TABLE IF EXISTS `deposit`;

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah` int(11) DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `tagihan_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_paid` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `deposit` */

/*Table structure for table `deposit_log` */

DROP TABLE IF EXISTS `deposit_log`;

CREATE TABLE `deposit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah` int(11) DEFAULT NULL,
  `deposit_id` int(11) DEFAULT NULL,
  `pemasukan_id` int(11) DEFAULT NULL,
  `kasir_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `deposit_log` */

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `type` int(1) DEFAULT NULL COMMENT '1 = pemasukan, 2 = pengeluaran',
  `layer` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `kode_anggaran` varchar(11) DEFAULT NULL,
  `total_anggaran` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori` values 
(1,'IGD',1,1,0,NULL,NULL,'2019-12-04 21:53:27','2019-12-04 21:53:27',NULL,2,NULL),
(2,'Rawat Jalan',1,1,0,NULL,NULL,'2019-12-04 21:53:34','2019-12-04 21:53:34',NULL,2,NULL),
(3,'Rawat Inap',1,1,0,NULL,NULL,'2019-12-04 21:53:48','2019-12-04 21:53:48',NULL,2,NULL),
(4,'Medical Checkup',1,1,0,NULL,NULL,'2019-12-04 21:53:59','2019-12-04 21:53:59',NULL,2,NULL),
(5,'Kamar Operasi',1,1,0,NULL,NULL,'2019-12-04 21:54:05','2019-12-04 21:54:05',NULL,2,NULL),
(6,'Lab Patologi Klinis',1,1,0,NULL,NULL,'2019-12-04 21:54:53','2019-12-04 21:54:53',NULL,2,NULL),
(7,'Lab Patologi Anatomi',1,1,0,NULL,NULL,'2019-12-04 21:54:59','2019-12-04 21:54:59',NULL,2,NULL),
(8,'Radiologi',1,1,0,NULL,NULL,'2019-12-04 21:55:04','2019-12-04 21:55:04',NULL,2,NULL),
(9,'Radioterapi',1,1,0,NULL,NULL,'2019-12-04 21:55:10','2019-12-04 21:55:10',NULL,2,NULL),
(10,'Farmasi',1,1,0,NULL,NULL,'2019-12-04 21:55:30','2019-12-04 21:55:30',NULL,2,NULL),
(11,'Keuangan',1,1,0,NULL,NULL,'2019-12-04 21:55:51','2019-12-04 21:55:51',NULL,2,NULL),
(12,'Gizi',1,1,0,NULL,NULL,'2019-12-04 21:55:57','2019-12-04 21:55:57',NULL,2,NULL),
(13,'Kamar Jenazah',1,1,0,NULL,NULL,'2019-12-04 21:56:02','2019-12-04 21:56:02',NULL,2,NULL),
(14,'Administrasi',1,1,0,NULL,NULL,'2019-12-04 21:56:07','2019-12-04 21:56:07',NULL,2,NULL);

/*Table structure for table `paket_pemasukan` */

DROP TABLE IF EXISTS `paket_pemasukan`;

CREATE TABLE `paket_pemasukan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `slug` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `cashier_by` int(11) DEFAULT NULL,
  `akun_id` int(11) DEFAULT NULL,
  `tanggal_transaksi` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `paket_pemasukan` */

/*Table structure for table `paket_penagihan` */

DROP TABLE IF EXISTS `paket_penagihan`;

CREATE TABLE `paket_penagihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kasir_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `total_paid` bigint(20) DEFAULT 0,
  `pihak_ketiga` varchar(256) DEFAULT NULL,
  `slug` varchar(256) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `cashier_by` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `akun_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `paket_penagihan` */

/*Table structure for table `pemasukan` */

DROP TABLE IF EXISTS `pemasukan`;

CREATE TABLE `pemasukan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bk_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `diskon` bigint(20) DEFAULT NULL,
  `beban_lain` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `akun_id` bigint(20) DEFAULT NULL,
  `pihak_ketiga` varchar(256) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `pasien_pembayaran_id` int(11) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `tanggal_transaksi` timestamp NULL DEFAULT current_timestamp(),
  `piutang_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `total_pembayaran` bigint(20) DEFAULT NULL,
  `total_diskon` bigint(20) DEFAULT NULL,
  `total_deposit` bigint(20) DEFAULT NULL,
  `total_kembalian` bigint(20) DEFAULT NULL,
  `paket_pemasukan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pemasukan` */

/*Table structure for table `pemasukan_detail` */

DROP TABLE IF EXISTS `pemasukan_detail`;

CREATE TABLE `pemasukan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pemasukan_id` int(11) DEFAULT NULL,
  `deskripsi` varchar(256) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `tarif_kelas_id` varchar(50) DEFAULT NULL,
  `tarif_tipe_id` int(11) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL COMMENT 'nilainya langsung',
  `beban_lain` int(11) DEFAULT NULL COMMENT 'beban yang ditagihkan ke pada split lainnya. intinya untuk split',
  `subtotal` bigint(20) DEFAULT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pemasukan_detail` */

/*Table structure for table `pengeluaran` */

DROP TABLE IF EXISTS `pengeluaran`;

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bk_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `utang_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `akun_id` int(11) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `pengadaan_barang` bigint(20) DEFAULT NULL,
  `bebas_ppn` bigint(20) DEFAULT NULL,
  `kena_ppn` bigint(20) DEFAULT NULL,
  `jasa` bigint(20) DEFAULT NULL,
  `pph23nonppn` bigint(20) DEFAULT NULL,
  `dibayarkan` bigint(20) DEFAULT NULL,
  `ppn` float DEFAULT NULL,
  `pph_21_5` float DEFAULT NULL,
  `pph_21_15` float DEFAULT NULL,
  `pph_22` float DEFAULT NULL,
  `pph_23` float DEFAULT NULL,
  `pph_23_ac` float DEFAULT NULL,
  `pph_23_bb` float DEFAULT NULL,
  `pph_4` float DEFAULT NULL,
  `tanggal_transaksi` timestamp NULL DEFAULT current_timestamp(),
  `tanggal_bk` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengeluaran` */

/*Table structure for table `pengeluaran_detail` */

DROP TABLE IF EXISTS `pengeluaran_detail`;

CREATE TABLE `pengeluaran_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengeluaran_id` int(11) DEFAULT NULL,
  `utang_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `layanan_id` int(11) DEFAULT NULL,
  `layanan_string` varchar(256) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `subtotal` varchar(50) DEFAULT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengeluaran_detail` */

/*Table structure for table `perusahaan` */

DROP TABLE IF EXISTS `perusahaan`;

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(256) DEFAULT NULL,
  `type` int(1) DEFAULT NULL COMMENT '1 = pemasukan, 2 = pengeluaran',
  `npwp` varchar(256) DEFAULT NULL,
  `jabatan` varchar(256) DEFAULT NULL,
  `direktur` varchar(256) DEFAULT NULL,
  `alamat` varchar(256) DEFAULT NULL,
  `tunai` binary(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `perusahaan` */

insert  into `perusahaan` values 
(1,'BPJS Kesehatan',NULL,'-','-','-','-',NULL,'2019-10-31 16:01:44','2019-10-31 23:01:44',NULL),
(2,'Tunai',NULL,'-','-','-','-','1','2019-11-27 18:13:42','2019-10-31 22:25:20',NULL),
(3,'BPJS Ketenagakerjaan',NULL,'-','-','-','-',NULL,'2019-10-31 23:01:23','2019-10-31 23:01:23',NULL),
(4,'AXA Mandiri',NULL,'-','-','-','-',NULL,'2019-12-04 22:39:02','2019-12-04 22:39:02',NULL);

/*Table structure for table `piutang` */

DROP TABLE IF EXISTS `piutang`;

CREATE TABLE `piutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kasir_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `diskon` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `total_paid` bigint(20) DEFAULT 0,
  `pihak_ketiga` varchar(256) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `pasien_pembayaran_id` int(11) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `tanggal_transaksi` timestamp NULL DEFAULT current_timestamp(),
  `kasus_tagihan_id` int(11) DEFAULT NULL,
  `piutang_parent_id` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `cashier_by` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `paket_penagihan_id` int(11) DEFAULT NULL,
  `pernah_ditolak` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `piutang` */

/*Table structure for table `piutang_detail` */

DROP TABLE IF EXISTS `piutang_detail`;

CREATE TABLE `piutang_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `piutang_id` int(11) DEFAULT NULL,
  `deskripsi` varchar(256) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `tarif_kelas_id` int(11) DEFAULT NULL,
  `tarif_tipe_id` int(1) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL COMMENT 'nilainya langsung',
  `subtotal` bigint(20) DEFAULT NULL,
  `keterangan` varchar(256) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `piutang_detail` */

/*Table structure for table `po` */

DROP TABLE IF EXISTS `po`;

CREATE TABLE `po` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `jenis_po` varchar(255) DEFAULT NULL,
  `no_po` varchar(50) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `tanggal_po` timestamp NULL DEFAULT NULL,
  `pjk_processed` double DEFAULT NULL,
  `termin` int(11) DEFAULT NULL,
  `termin_processed` int(11) DEFAULT NULL,
  `adendum` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `no_spkktr` varchar(255) DEFAULT NULL,
  `tanggal_spkktr` timestamp NULL DEFAULT NULL,
  `file_pendukung` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `po` */

/*Table structure for table `po_detail` */

DROP TABLE IF EXISTS `po_detail`;

CREATE TABLE `po_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) DEFAULT NULL,
  `item_gudang_id` int(11) DEFAULT NULL,
  `item_aset_id` int(11) DEFAULT NULL,
  `deskripsi` varchar(250) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `jumlah_processed` double DEFAULT NULL,
  `subtotal_processed` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `po_detail` */

/*Table structure for table `tarif` */

DROP TABLE IF EXISTS `tarif`;

CREATE TABLE `tarif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarif_master_id` int(11) DEFAULT NULL,
  `deskripsi_temp` varchar(255) DEFAULT NULL,
  `tipe_id` int(11) DEFAULT NULL COMMENT 'tarif_tipe',
  `kelas_id` int(11) DEFAULT NULL COMMENT 'tarif_kelas',
  `harga` int(11) DEFAULT NULL,
  `persen` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `kelas_temp` varchar(255) DEFAULT NULL,
  `tipe_temp` varchar(255) DEFAULT NULL,
  `desk_kat` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tarif` */

/*Table structure for table `tarif_kategori` */

DROP TABLE IF EXISTS `tarif_kategori`;

CREATE TABLE `tarif_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `departemen_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tarif_kategori` */

/*Table structure for table `tarif_kategori_slug` */

DROP TABLE IF EXISTS `tarif_kategori_slug`;

CREATE TABLE `tarif_kategori_slug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tarif_kategori_slug` */

insert  into `tarif_kategori_slug` values 
(1,'Administrasi Rawat Inap','administrasi-rawat-inap','2019-09-20 21:00:13','2019-09-20 21:04:06',NULL),
(2,'Administrasi Poli','administrasi-poli','2019-09-20 21:00:17','2019-09-20 21:04:09',NULL),
(3,'Administrasi IGD','administrasi-igd','2019-09-20 21:00:19','2019-09-20 21:04:11',NULL),
(4,'Administrasi Lainnya','administrasi-lainnya','2019-09-20 21:00:25','2019-10-30 07:46:25',NULL),
(5,'Rawat Inap - Visite','rawat-inap-visite','2019-09-21 04:03:57','2019-09-20 21:04:20',NULL),
(6,'Rawat Inap - Ruangan','rawat-inap-ruangan','2019-09-20 21:00:56','2019-09-20 21:04:23',NULL),
(7,'Administrasi Medical Checkup','administrasi-medical-checkup','2019-10-30 10:09:35','2019-10-30 10:12:48',NULL),
(8,'Radiologi','radiologi','2019-10-31 09:57:10','2019-10-31 09:57:10',NULL),
(9,'Lab PA','lab-pa','2019-10-31 09:57:14','2019-10-31 09:57:14',NULL),
(10,'Lab PK','lab-pk','2019-10-31 09:57:18','2019-10-31 09:57:18',NULL),
(11,'Farmasi','farmasi','2019-10-31 09:57:20','2019-10-31 09:57:20',NULL),
(12,'Rawat Jalan - Konsultasi Dokter','rawat-jalan-konsultasi-dokter','2019-11-24 19:23:39','2019-11-24 19:25:25',NULL);

/*Table structure for table `tarif_master` */

DROP TABLE IF EXISTS `tarif_master`;

CREATE TABLE `tarif_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` text DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `deskripsi_ori` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `lis_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `kategori_temp` varchar(255) DEFAULT NULL,
  `hasil_urikkes` text DEFAULT NULL COMMENT '<nama_tabel>|<nama_kolom>;<nama_tabel>|<nama_kolom>;',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tarif_master` */

/*Table structure for table `tarif_tipe` */

DROP TABLE IF EXISTS `tarif_tipe`;

CREATE TABLE `tarif_tipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tarif_tipe` */

insert  into `tarif_tipe` values 
(1,'Biasa','2019-04-25 02:58:38','2019-04-27 01:41:07',NULL,'default'),
(2,'Cito','2019-04-25 02:59:40','2019-12-04 20:57:54',NULL,'cito');

/*Table structure for table `transaksi_file_lokasi` */

DROP TABLE IF EXISTS `transaksi_file_lokasi`;

CREATE TABLE `transaksi_file_lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_file_lokasi` */

insert  into `transaksi_file_lokasi` values 
(1,'UKPBJ'),
(2,'Proga'),
(3,'PPK & Spri'),
(4,'Penyedia'),
(5,'UJI'),
(6,'BP');

/*Table structure for table `transaksi_file_utang` */

DROP TABLE IF EXISTS `transaksi_file_utang`;

CREATE TABLE `transaksi_file_utang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utang_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `transaksi_asal_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0 = menunggu konfirmasi, 1 = sudah dikonfirmasi',
  `transfer_status` tinyint(4) DEFAULT 0 COMMENT '0 = belum transfer, 1 = sudah transfer, 2 = transfer selesai',
  `holder_type` int(11) DEFAULT NULL COMMENT '1 = user, 2 = group',
  `holder_user_id` int(11) DEFAULT NULL,
  `holder_confirmed_at` timestamp NULL DEFAULT NULL,
  `holder_confirmed_by` int(11) DEFAULT NULL,
  `cancel_confirmed_by` int(11) DEFAULT NULL,
  `holder_keterangan` text DEFAULT NULL,
  `lokasi_tujuan` varchar(128) DEFAULT NULL,
  `lokasi_last` varchar(128) DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL COMMENT '1 = Permintaan, 2 = transfer, 3 = ambil',
  `sender_sent_at` timestamp NULL DEFAULT NULL,
  `sender_sent_by` int(11) DEFAULT NULL,
  `cancel_sent_by` int(11) DEFAULT NULL,
  `sender_keterangan` text DEFAULT NULL,
  `checklist` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `transaksi_file_utang` */

/*Table structure for table `ttd` */

DROP TABLE IF EXISTS `ttd`;

CREATE TABLE `ttd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `sipa` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ttd` */

/*Table structure for table `utang` */

DROP TABLE IF EXISTS `utang`;

CREATE TABLE `utang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomorpjk` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pemberi` varchar(255) DEFAULT NULL,
  `perusahaan_id` int(11) DEFAULT NULL,
  `penerima` varchar(255) DEFAULT NULL,
  `no_pjk` int(11) DEFAULT NULL,
  `no_spkktr` varchar(255) DEFAULT NULL,
  `no_sprin` varchar(255) DEFAULT NULL,
  `no_faktur` varchar(255) DEFAULT NULL,
  `tahun_anggaran` varchar(255) DEFAULT NULL,
  `photo_faktur` varchar(255) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `total_paid` double DEFAULT 0,
  `kategori_id` int(11) DEFAULT NULL,
  `akun_pjk_id` int(11) DEFAULT NULL,
  `tanggal_transaksi` timestamp NULL DEFAULT NULL,
  `tanggal_spp` timestamp NULL DEFAULT NULL,
  `tanggal_spkktr` timestamp NULL DEFAULT NULL,
  `tanggal_sprin` timestamp NULL DEFAULT NULL,
  `tanggal_penerimaan` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `no_spp` int(11) DEFAULT NULL,
  `no_po` varchar(255) DEFAULT NULL,
  `no_se` varchar(255) DEFAULT NULL,
  `tanggal_po` timestamp NULL DEFAULT NULL,
  `tanggal_faktur` timestamp NULL DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `utang` */

/*Table structure for table `utang_detail` */

DROP TABLE IF EXISTS `utang_detail`;

CREATE TABLE `utang_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utang_id` int(11) DEFAULT NULL,
  `deskripsi` varchar(250) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `po_detail_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `utang_detail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
