/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_radiology
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_radiology` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_radiology` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_radiology`;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `laporan_master` */

insert  into `laporan_master` values 
(1,'JUMLAH PEMERIKSAAN FOTO POLOS DAN KONTRAS PASIEN BPJS DI SUBDEP RADIODIAGNOSTIK','{\"FOTO_POLOS\": {\"id\": [1635, 1636, 1637, 1638, 1639, 1640, 1641, 1642, 1643, 1644, 1645, 1646, 1647, 1648, 1649, 1650, 1651, 1670, 1671, 1672, 1673, 1674, 1675, 1676, 1677, 1678, 1679, 1680, 1681, 1682, 1683, 1684, 1685, 1686, 1687, 2171, 2172, 2173, 2204, 2205, 2206, 2207, 2208, 2209, 2210, 2211, 2212, 2213, 2214, 2215, 2224, 2225, 2226, 2227, 2233, 2234, 2235, 2236, 2237, 2238, 2245, 2246, 2247, 2248, 2249, 2250, 2257, 2258, 2259, 2260, 2261, 2262, 2263, 2264, 2286, 2287, 2288, 2289, 2290, 2296, 2297, 2298, 2299, 2300, 2301, 2302, 2303, 2304, 2305, 2306, 2307, 2308, 2309, 2310, 2338, 2339, 2340, 2341, 2342, 2349, 2351, 2352, 2353, 2354, 2355, 2356, 2357, 2365, 2366, 2367, 2368, 2373, 2374, 2375, 2376, 2377, 2378, 2379, 2380, 2381, 2382, 2383, 2384, 2385, 2386, 2401, 2402, 2403, 2404, 2405, 2406, 2407, 2408, 2409, 2410, 2411, 2412, 2413, 2414]}, \"MAMMOGRAFI\": {\"id\": [\"2174\"]}, \"FOTO_KONTRAS\": [{\"id\": [\"2059\"], \"detail\": [{\"id\": \"2059\", \"nama\": \"Mastoid / Schuller\'s (kanan dan kiri)\"}], \"header\": \"Kont Study Urinary Track\"}, {\"id\": [\"2057\", \"2059\"], \"detail\": [{\"id\": \"2057\", \"nama\": \"Water\'s/ Caldwell/ Sella Tursica\"}, {\"id\": \"2059\", \"nama\": \"Mastoid / Schuller\'s (kanan dan kiri)\"}], \"header\": \"Kont Study Vaskuler\"}, {\"id\": [\"2060\", \"2084\", \"2089\"], \"detail\": [{\"id\": \"2060\", \"nama\": \"Basis Cranium\"}, {\"id\": \"2084\", \"nama\": \"Foto polos regio thorax lainnya\"}, {\"id\": \"2089\", \"nama\": \"Babygram\"}], \"header\": \"Kont Study Lain\"}]}','pasien-bpjs-harian','2019-09-24 12:43:31','2019-09-25 12:16:02',NULL),
(2,'JUMLAH PEMERIKSAAN FOTO POLOS DAN KONTRAS PASIEN BPJS BULANAN DI SUBDEP RADIODIAGNOSTIK','{\"FOTO_POLOS\": {\"id\": [\"2171\", \"2172\", \"2173\", \"2204\", \"2205\", \"2206\", \"2207\", \"2208\", \"2209\", \"2210\", \"2211\", \"2212\", \"2213\", \"2214\", \"2215\", \"2224\", \"2225\", \"2226\", \"2227\", \"2233\", \"2234\", \"2235\", \"2236\", \"2237\", \"2238\", \"2245\", \"2246\", \"2247\", \"2248\", \"2249\", \"2250\", \"2257\", \"2258\", \"2259\", \"2260\", \"2261\", \"2262\", \"2263\", \"2264\", \"2286\", \"2287\", \"2288\", \"2289\", \"2290\", \"2296\", \"2297\", \"2298\", \"2299\", \"2300\", \"2301\", \"2302\", \"2303\", \"2304\", \"2305\", \"2306\", \"2307\", \"2308\", \"2309\", \"2310\", \"2338\", \"2339\", \"2340\", \"2341\", \"2342\", \"2349\", \"2351\", \"2352\", \"2353\", \"2354\", \"2355\", \"2356\", \"2357\", \"2365\", \"2366\", \"2367\", \"2368\", \"2373\", \"2374\", \"2375\", \"2376\", \"2377\", \"2378\", \"2379\", \"2380\", \"2381\", \"2382\", \"2383\", \"2384\", \"2385\", \"2386\", \"2401\", \"2402\", \"2403\", \"2404\", \"2405\", \"2406\", \"2407\", \"2408\", \"2409\", \"2410\", \"2411\", \"2412\", \"2413\", \"2414\"]}, \"MAMMOGRAFI\": {\"id\": [\"2174\"]}, \"FOTO_KONTRAS\": [{\"id\": [\"2059\"], \"detail\": [{\"id\": \"2059\", \"nama\": \"Mastoid / Schuller\'s (kanan dan kiri)\"}], \"header\": \"Kont Study Urinary Track\"}, {\"id\": [\"2057\", \"2059\"], \"detail\": [{\"id\": \"2057\", \"nama\": \"Water\'s/ Caldwell/ Sella Tursica\"}, {\"id\": \"2059\", \"nama\": \"Mastoid / Schuller\'s (kanan dan kiri)\"}], \"header\": \"Kont Study Vaskuler\"}, {\"id\": [\"2060\", \"2084\", \"2089\"], \"detail\": [{\"id\": \"2060\", \"nama\": \"Basis Cranium\"}, {\"id\": \"2084\", \"nama\": \"Foto polos regio thorax lainnya\"}, {\"id\": \"2089\", \"nama\": \"Babygram\"}], \"header\": \"Kont Study Lain\"}]}','pasien-bpjs-bulanan','2019-09-25 14:34:21','2019-09-25 21:37:43',NULL);

/*Table structure for table `photo` */

DROP TABLE IF EXISTS `photo`;

CREATE TABLE `photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) unsigned NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `caption` varchar(500) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `thumbnail_path` varchar(200) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 = temp; 1 = fix;',
  `hash` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `penunjang_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `photo` */

/*Table structure for table `template_hasil` */

DROP TABLE IF EXISTS `template_hasil`;

CREATE TABLE `template_hasil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `generic_id` int(11) DEFAULT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `konten` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `template_hasil` */

/*Table structure for table `transaction` */

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `tarif_tipe_id` int(11) DEFAULT NULL,
  `no_bpjs` varchar(20) DEFAULT NULL,
  `no_sep` varchar(20) DEFAULT NULL,
  `class` int(11) DEFAULT 2 COMMENT 'Kelas Hospital',
  `status` int(1) DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `keterangan_permintaan` text DEFAULT NULL,
  `result` text DEFAULT NULL,
  `slug` varchar(80) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `result_created_at` timestamp NULL DEFAULT NULL,
  `kasus_id` int(11) DEFAULT NULL COMMENT 'JANGAN DIHAPUS',
  `created_by` int(11) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `inspected_at` date DEFAULT NULL,
  `inspected_at_by` int(11) DEFAULT NULL,
  `result_created_by` int(11) DEFAULT NULL,
  `alasan_batal` varchar(500) DEFAULT NULL,
  `pasien_pembayaran_id` int(11) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `kirim_kasir` tinyint(4) DEFAULT 0,
  `is_checkout` tinyint(4) DEFAULT 0,
  `inspected_at_created_at` timestamp NULL DEFAULT NULL,
  `nama_rs` varchar(100) DEFAULT NULL,
  `nama_dokter` varchar(100) DEFAULT NULL,
  `pemeriksaan_start_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_index` (`slug`,`deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction` */

/*Table structure for table `transaction_detail` */

DROP TABLE IF EXISTS `transaction_detail`;

CREATE TABLE `transaction_detail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) NOT NULL,
  `tarif_id` int(10) NOT NULL,
  `status` varchar(10) DEFAULT 'ask' COMMENT 'ask / done / new',
  `qty` int(11) DEFAULT NULL,
  `tagihan_detail_id` int(11) DEFAULT NULL,
  `film_dipakai` varchar(100) DEFAULT '0',
  `film_ditolak` varchar(100) DEFAULT '0',
  `hasil_baca` text DEFAULT NULL,
  `ukuran_film` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `piutang_id` int(11) DEFAULT NULL COMMENT 'pengganti tagihan_detail_id kalo kirim ke kasir',
  `foto_ulang` int(11) DEFAULT NULL,
  `kontras_dipakai` int(11) DEFAULT NULL,
  `kontras_dikembalikan` int(11) DEFAULT NULL,
  `alasan_foto_ulang` varchar(100) DEFAULT NULL,
  `alasan_film_direject` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction_detail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
