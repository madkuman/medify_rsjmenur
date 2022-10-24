/*
SQLyog Job Agent v12.5.1 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


MySQL - 10.4.6-MariaDB : Database - medify_hospital_kepegawaian
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Database structure for database `medify_hospital_kepegawaian` */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`medify_hospital_kepegawaian` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `medify_hospital_kepegawaian`;

/*Table structure for table `agama` */

DROP TABLE IF EXISTS `agama`;

CREATE TABLE `agama` (
  `id_agama` int(11) NOT NULL AUTO_INCREMENT,
  `agama` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_agama`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `agama` */

insert  into `agama` values 
(1,'Islam','2018-04-17 10:09:44','2018-04-17 02:51:34',NULL),
(2,'Kristen','2018-04-17 10:09:45','2018-04-17 02:51:35',NULL),
(3,'Hindu','2018-04-17 10:09:45','2018-04-17 02:51:35',NULL),
(4,'Buddha','2018-04-17 10:09:46','2018-04-17 02:51:36',NULL),
(5,'Atheis','2018-04-17 10:09:47','2018-04-17 02:51:37',NULL);

/*Table structure for table `appretiations` */

DROP TABLE IF EXISTS `appretiations`;

CREATE TABLE `appretiations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tmt` datetime DEFAULT NULL,
  `st_number` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `verificator` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `certificate` int(11) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `verification_data` text DEFAULT NULL,
  `is_employee` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_appretiations_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `appretiations` */

/*Table structure for table `departemen` */

DROP TABLE IF EXISTS `departemen`;

CREATE TABLE `departemen` (
  `id_departemen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_departemen` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_departemen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `departemen` */

/*Table structure for table `departments` */

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `st_number` varchar(50) DEFAULT NULL,
  `tmt` datetime DEFAULT NULL,
  `mdepartment_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_departments_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `departments` */

/*Table structure for table `dsp` */

DROP TABLE IF EXISTS `dsp`;

CREATE TABLE `dsp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_bagian` varchar(255) DEFAULT NULL,
  `bagian` varchar(255) DEFAULT NULL,
  `kd_jabatan` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `pkt1` varchar(255) DEFAULT NULL,
  `korp1` varchar(255) DEFAULT NULL,
  `kejuruan` varchar(255) DEFAULT NULL,
  `keahlian` varchar(255) DEFAULT NULL,
  `prof_jab` varchar(255) DEFAULT NULL,
  `dik` varchar(255) DEFAULT NULL,
  `klas_jab` double DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dsp` */

/*Table structure for table `educations` */

DROP TABLE IF EXISTS `educations`;

CREATE TABLE `educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `tmt` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `certificate` int(11) DEFAULT NULL,
  `verification_file` int(11) DEFAULT NULL,
  `verificator` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `is_employee` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_education_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `educations` */

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `religion_id` int(11) DEFAULT NULL,
  `agama` varchar(25) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `birth_place` varchar(50) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `nrp` varchar(50) DEFAULT NULL,
  `identity_card` varchar(30) DEFAULT NULL,
  `family_registers` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `bank` varchar(30) DEFAULT NULL,
  `bank_account` varchar(30) DEFAULT NULL,
  `driver_license` varchar(5) DEFAULT NULL,
  `driver_license_number` varchar(30) DEFAULT NULL,
  `license_plate` varchar(10) DEFAULT NULL,
  `living_type` varchar(30) DEFAULT NULL,
  `headgear` int(11) DEFAULT NULL,
  `size_chart` varchar(5) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `shoe_size` int(11) DEFAULT NULL,
  `bpjs` varchar(30) DEFAULT NULL,
  `faskes` varchar(30) DEFAULT NULL,
  `class` varchar(30) DEFAULT NULL,
  `official_status` varchar(30) DEFAULT NULL,
  `tmt` datetime DEFAULT NULL,
  `tmt_pa_pns` datetime DEFAULT NULL,
  `tmt_fiktif` datetime DEFAULT NULL,
  `tmt_kesatuan` datetime DEFAULT NULL,
  `phl_status` varchar(30) DEFAULT NULL,
  `status_aktif` varchar(30) DEFAULT NULL,
  `tmt_out` datetime DEFAULT NULL,
  `sprin_out_number` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `rt_rw` varchar(20) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `sip` varchar(64) DEFAULT NULL,
  `sip_expired_at` timestamp NULL DEFAULT NULL,
  `sip_file` text DEFAULT NULL,
  `str` varchar(64) DEFAULT NULL,
  `str_expired_at` timestamp NULL DEFAULT NULL,
  `str_file` text DEFAULT NULL,
  `skip` varchar(64) DEFAULT NULL,
  `skip_expired_at` timestamp NULL DEFAULT NULL,
  `ppa_1` varchar(256) DEFAULT NULL,
  `ppa_1_file` text DEFAULT NULL,
  `ppa_2` varchar(256) DEFAULT NULL,
  `ppa_2_file` text DEFAULT NULL,
  `ppa_3` varchar(256) DEFAULT NULL,
  `ppa_3_file` text DEFAULT NULL,
  `kualifikasi` varchar(255) DEFAULT NULL,
  `subkualifikasi` varchar(255) DEFAULT NULL,
  `departemen` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `st_kasal_no_st` varchar(255) DEFAULT NULL,
  `st_kasal_no_sp` varchar(255) DEFAULT NULL,
  `st_kasal_tgl_sp` timestamp NULL DEFAULT NULL,
  `pns_jabatan_fungsional` varchar(255) DEFAULT NULL,
  `intern_dep` varchar(255) DEFAULT NULL,
  `intern_jabatan` varchar(255) DEFAULT NULL,
  `intern_no_sp` varchar(255) DEFAULT NULL,
  `intern_tgl_sp` timestamp NULL DEFAULT NULL,
  `pangkat` varchar(255) DEFAULT NULL,
  `korps` varchar(255) DEFAULT NULL,
  `print_order` varchar(255) DEFAULT '99',
  `text_pendidikan_umum` text DEFAULT NULL,
  `text_pendidikan_umum_akhir` text DEFAULT NULL,
  `text_pendidikan_militer` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `blood_type` varchar(3) DEFAULT NULL,
  `photo` int(11) DEFAULT NULL,
  `signed` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_employees_religions` (`religion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `employees` */

/*Table structure for table `families` */

DROP TABLE IF EXISTS `families`;

CREATE TABLE `families` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `family_registers` varchar(50) NOT NULL,
  `relationship` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birth_place` varchar(100) NOT NULL,
  `birth_date` datetime NOT NULL,
  `sex` varchar(20) NOT NULL,
  `citizen_number` varchar(30) NOT NULL,
  `bpjs` varchar(30) DEFAULT NULL,
  `faskes` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_families_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `families` */

/*Table structure for table `intern_positions` */

DROP TABLE IF EXISTS `intern_positions`;

CREATE TABLE `intern_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `sp_number` varchar(50) DEFAULT NULL,
  `sp_date` datetime DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_intern_positions_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `intern_positions` */

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(50) DEFAULT NULL,
  `gaji` varchar(50) DEFAULT NULL,
  `departemen_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jabatan` */

/*Table structure for table `kpositions` */

DROP TABLE IF EXISTS `kpositions`;

CREATE TABLE `kpositions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kpositions` */

/*Table structure for table `kuisioner` */

DROP TABLE IF EXISTS `kuisioner`;

CREATE TABLE `kuisioner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status_aktif` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `kuisioner` */

/*Table structure for table `kuisioner_jawaban` */

DROP TABLE IF EXISTS `kuisioner_jawaban`;

CREATE TABLE `kuisioner_jawaban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kuisioner_id` int(11) NOT NULL DEFAULT 0,
  `jawaban` text DEFAULT NULL,
  `edited` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `kuisioner_jawaban` */

/*Table structure for table `kuisioner_pertanyaan` */

DROP TABLE IF EXISTS `kuisioner_pertanyaan`;

CREATE TABLE `kuisioner_pertanyaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` mediumtext NOT NULL,
  `pernyataan` varchar(50) NOT NULL,
  `kuisioner_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `kuisioner_pertanyaan` */

/*Table structure for table `laporan_pencapaian` */

DROP TABLE IF EXISTS `laporan_pencapaian`;

CREATE TABLE `laporan_pencapaian` (
  `id_laporan_pencapaian` int(11) NOT NULL AUTO_INCREMENT,
  `pencapaian_id` int(11) DEFAULT NULL,
  `file` varchar(256) DEFAULT NULL,
  `keterangan` varchar(1024) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_laporan_pencapaian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `laporan_pencapaian` */

/*Table structure for table `mappretiations` */

DROP TABLE IF EXISTS `mappretiations`;

CREATE TABLE `mappretiations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mappretiations` */

/*Table structure for table `marriages` */

DROP TABLE IF EXISTS `marriages`;

CREATE TABLE `marriages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `total_child` int(11) DEFAULT NULL,
  `marriage_certificate_number` varchar(50) DEFAULT NULL,
  `marriage_date` datetime DEFAULT NULL,
  `marriage_place` varchar(50) DEFAULT NULL,
  `couple_job` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_marrieds_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `marriages` */

/*Table structure for table `master_garjas_militer` */

DROP TABLE IF EXISTS `master_garjas_militer`;

CREATE TABLE `master_garjas_militer` (
  `id` int(11) DEFAULT NULL,
  `1N` varchar(3) DEFAULT NULL,
  `2N` varchar(3) DEFAULT NULL,
  `3N` varchar(3) DEFAULT NULL,
  `4N` varchar(3) DEFAULT NULL,
  `5N` varchar(3) DEFAULT NULL,
  `6N` varchar(3) DEFAULT NULL,
  `7N` varchar(3) DEFAULT NULL,
  `8N` varchar(3) DEFAULT NULL,
  `9N` varchar(3) DEFAULT NULL,
  `10N` varchar(3) DEFAULT NULL,
  `LLari` varchar(4) DEFAULT NULL,
  `LPullUp` varchar(2) DEFAULT NULL,
  `LSitUp` varchar(2) DEFAULT NULL,
  `LPushUp` varchar(2) DEFAULT NULL,
  `LShuttle` float DEFAULT NULL,
  `PLari` varchar(4) DEFAULT NULL,
  `PPullUp` varchar(2) DEFAULT NULL,
  `PSitUp` varchar(2) DEFAULT NULL,
  `PPushUp` varchar(2) DEFAULT NULL,
  `PShuttle` float DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `master_garjas_militer` */

insert  into `master_garjas_militer` values 
(1,'100','100','100','100','100','100','100','100','100','100','3507','18','41','43',15.9,'2630','63','42','28',17.2,NULL),
(2,'99','100','100','100','100','100','100','100','100','100','3488','','','',16,'2619','','','',17.3,NULL),
(3,'98','100','100','100','100','100','100','100','100','100','3469','','','',16.1,'2606','62','','',17.4,NULL),
(4,'97','100','100','100','100','100','100','100','100','100','3450','','','',16.2,'2597','61','','',17.5,NULL),
(5,'96','100','100','100','100','100','100','100','100','100','3431','','','',16.3,'2586','','','',17.6,NULL),
(6,'95','100','100','100','100','100','100','100','100','100','3412','17','40','42',16.4,'2575','60','41','27',17.7,NULL),
(7,'94','99','100','100','100','100','100','100','100','100','3393','','','',16.5,'2564','','','',17.8,NULL),
(8,'93','98','100','100','100','100','100','100','100','100','3374','','','',16.6,'2553','59','','',17.9,NULL),
(9,'92','97','100','100','100','100','100','100','100','100','3355','','','',16.7,'2542','58','','',18,NULL),
(10,'91','96','100','100','100','100','100','100','100','100','3336','','','',16.8,'2531','','','',18.1,NULL),
(11,'90','95','100','100','100','100','100','100','100','100','3317','16','39','41',16.9,'2520','57','40','26',18.2,NULL),
(12,'89','94','99','100','100','100','100','100','100','100','3298','','','',17,'2509','','','',18.3,NULL),
(13,'88','93','98','100','100','100','100','100','100','100','3279','','','',17.1,'2498','56','','',18.4,NULL),
(14,'87','92','97','100','100','100','100','100','100','100','3260','','','',17.2,'2487','55','','',18.5,NULL),
(15,'86','91','96','100','100','100','100','100','100','100','3241','','','',17.3,'2476','','','',18.6,NULL),
(16,'85','90','95','100','100','100','100','100','100','100','3222','15','38','40',17.4,'2465','54','39','25',18.7,NULL),
(17,'84','89','94','99','100','100','100','100','100','100','3203','','','',17.5,'2454','','','',18.8,NULL),
(18,'83','88','93','98','100','100','100','100','100','100','3184','','','',17.6,'2443','53','','',18.9,NULL),
(19,'82','87','92','97','100','100','100','100','100','100','3165','','','',17.7,'2432','52','','',19,NULL),
(20,'81','86','91','96','100','100','100','100','100','100','3146','','','',17.8,'2421','','','',19.1,NULL),
(21,'80','85','90','95','100','100','100','100','100','100','3127','14','37','39',17.9,'2410','51','38','24',19.2,NULL),
(22,'79','84','89','94','99','100','100','100','100','100','3108','','','',18,'2399','','','',19.3,NULL),
(23,'78','83','88','93','98','100','100','100','100','100','3089','','','',18.1,'2388','50','','',19.4,NULL),
(24,'77','82','87','92','97','100','100','100','100','100','3070','','','',18.2,'2377','49','','',19.5,NULL),
(25,'76','81','86','91','96','100','100','100','100','100','3051','','','',18.3,'2366','','','',19.6,NULL),
(26,'75','80','85','90','95','100','100','100','100','100','3032','13','36','38',18.4,'2355','48','37','23',19.7,NULL),
(27,'74','79','84','89','94','99','100','100','100','100','3013','','','',18.5,'2344','','','',19.8,NULL),
(28,'73','78','83','88','93','98','100','100','100','100','2994','','','',18.6,'2333','47','','',19.9,NULL),
(29,'72','77','82','87','92','97','100','100','100','100','2975','','','',18.7,'2322','46','','',20,NULL),
(30,'71','76','81','86','91','96','100','100','100','100','2956','','','',18.8,'2311','','','',20.1,NULL),
(31,'70','75','80','85','90','95','100','100','100','100','2937','12','35','37',18.9,'2300','45','36','22',20.2,NULL),
(32,'69','74','79','84','89','94','99','100','100','100','2918','','','',19,'2289','','','',20.3,NULL),
(33,'68','73','78','83','88','93','98','100','100','100','2899','','','',19.1,'2278','44','','',20.4,NULL),
(34,'67','72','77','82','87','92','97','100','100','100','2880','','','',19.2,'2267','43','','',20.5,NULL),
(35,'66','71','76','81','86','91','96','100','100','100','2861','','','',19.3,'2256','','','',20.6,NULL),
(36,'65','70','75','80','85','90','95','100','100','100','2842','11','34','36',19.4,'2245','42','35','21',20.7,NULL),
(37,'64','69','74','79','84','89','94','99','100','100','2823','','','',19.5,'2234','','','',20.8,NULL),
(38,'63','68','73','78','83','88','93','98','100','100','2804','','','',19.6,'2223','41','','',20.9,NULL),
(39,'62','67','72','77','82','87','92','97','100','100','2785','','','',19.7,'2212','40','','',21,NULL),
(40,'61','66','71','76','81','86','91','96','100','100','2766','','','',19.8,'2201','','','',21.1,NULL),
(41,'60','65','70','75','80','85','90','95','100','100','2747','10','33','35',19.9,'2190','39','34','20',21.2,NULL),
(42,'59','64','69','74','79','84','89','94','99','100','2728','','','',20,'2179','','','',21.3,NULL),
(43,'58','63','68','73','78','83','88','93','98','100','2709','','','',20.1,'2168','38','','',21.4,NULL),
(44,'57','62','67','72','77','82','87','92','97','100','2690','','','',20.2,'2157','37','','',21.5,NULL),
(45,'56','61','66','71','76','81','86','91','96','100','2671','','','',20.3,'2146','','','',21.6,NULL),
(46,'55','60','65','70','75','80','85','90','95','100','2652','9','32','34',20.4,'2135','36','33','19',21.7,NULL),
(47,'54','59','64','69','74','79','84','89','94','99','2633','','','',20.5,'2124','','','',21.8,NULL),
(48,'53','58','63','68','73','78','83','88','93','98','2614','','','',20.6,'2113','35','32','',21.9,NULL),
(49,'52','57','62','67','72','77','82','87','92','97','2595','','31','33',20.7,'2102','','','',22,NULL),
(50,'51','56','61','66','71','76','81','86','91','96','2576','','','',20.8,'2088','34','','18',22.1,NULL),
(51,'50','55','60','65','70','75','80','85','90','95','2557','8','','',20.9,'2074','','31','',22.2,NULL),
(52,'49','54','59','64','69','74','79','84','89','94','2538','','30','32',21,'2060','33','','',22.3,NULL),
(53,'48','53','58','63','68','73','78','83','88','93','2519','','','',21.1,'2046','','','',22.4,NULL),
(54,'47','52','57','62','67','72','77','82','87','92','2500','','','',21.2,'2033','','','17',22.5,NULL),
(55,'46','51','56','61','66','71','76','81','86','91','2481','','29','31',21.3,'2019','32','30','',22.6,NULL),
(56,'45','50','55','60','65','70','75','80','85','90','2462','7','','',21.4,'2005','','','',22.7,NULL),
(57,'44','49','54','59','64','69','74','79','84','89','2443','','','',21.5,'1992','','29','',22.8,NULL),
(58,'43','48','53','58','63','68','73','78','83','88','2424','','28','30',21.6,'1979','31','','',22.9,NULL),
(59,'42','47','52','57','62','67','72','77','82','87','2405','','','',21.7,'1966','','28','16',23,NULL),
(60,'41','46','51','56','61','66','71','76','81','86','2386','','','',21.8,'1953','','','',23.1,NULL),
(61,'40','45','50','55','60','65','70','75','80','85','2367','6','27','29',21.9,'1940','','','',23.2,NULL),
(62,'39','44','49','54','59','64','69','74','79','84','2348','','','',22,'1927','30','','',23.3,NULL),
(63,'38','43','48','53','58','63','68','73','78','83','2329','','','',22.1,'1914','','','',23.4,NULL),
(64,'37','42','47','52','57','62','67','72','77','82','2310','','','',22.2,'1901','29','27','15',23.5,NULL),
(65,'36','41','46','51','56','61','66','71','76','81','2291','','','',22.3,'1888','','','',23.6,NULL),
(66,'35','40','45','50','55','60','65','70','75','80','2272','5','','',22.4,'1875','28','','',23.7,NULL),
(67,'34','39','44','49','54','59','64','69','74','79','2253','','25','27',22.5,'1862','','26','',23.8,NULL),
(68,'33','38','43','48','53','58','63','68','73','78','2234','','','',22.6,'1849','27','','',23.9,NULL),
(69,'32','37','42','47','52','57','62','67','72','77','2215','','','',22.7,'1836','','25','14',24,NULL),
(70,'31','36','41','46','51','56','61','66','71','76','2196','','24','26',22.8,'1823','26','','',24.1,NULL),
(71,'30','35','40','45','50','55','60','65','70','75','2177','4','','',22.9,'1810','','24','',24.2,NULL),
(72,'29','34','39','44','49','54','59','64','69','74','2158','','','',23,'1797','25','','',24.3,NULL),
(73,'28','33','38','43','48','53','58','63','68','73','2139','','23','25',23.1,'1783','','','13',24.4,NULL),
(74,'27','32','37','42','47','52','57','62','67','72','2120','','','',23.2,'1769','','23','',24.5,NULL),
(75,'26','31','36','41','46','51','56','61','66','71','2101','','','',23.3,'1775','24','','',24.6,NULL),
(76,'25','30','35','40','45','50','55','60','65','70','2082','3','22','24',23.4,'1741','','','',24.7,NULL),
(77,'24','29','34','39','44','49','54','59','64','69','2063','','','',23.5,'1727','23','22','',24.8,NULL),
(78,'23','28','33','38','43','48','53','58','63','68','2044','','','',23.6,'1714','','','12',24.9,NULL),
(79,'22','27','32','37','42','47','52','57','62','67','2025','','21','23',23.7,'1701','22','21','',25,NULL),
(80,'21','26','31','36','41','46','51','56','61','66','2006','','','',23.8,'1672','','','',25.1,NULL),
(81,'20','25','30','35','40','45','50','55','60','65','1987','2','','',23.9,'1667','21','20','',25.2,NULL),
(82,'19','24','29','34','39','44','49','54','59','64','1968','','20','22',24,'1642','','','',25.3,NULL),
(83,'18','23','28','33','38','43','48','53','58','63','1949','','','',24.1,'1627','20','19','11',25.4,NULL),
(84,'17','22','27','32','37','42','47','52','57','62','1930','','','',24.2,'1612','','','',25.5,NULL),
(85,'16','21','26','31','36','41','46','51','56','61','1911','','19','21',24.3,'1597','19','','',25.6,NULL),
(86,'15','20','25','30','35','40','45','50','55','60','1892','1','','',24.4,'1582','','18','',25.7,NULL),
(87,'14','19','24','29','34','39','44','49','54','59','1873','','','',24.5,'1567','18','','',25.8,NULL),
(88,'13','18','23','28','33','38','43','48','53','58','1854','','18','20',24.6,'1552','','','10',25.9,NULL),
(89,'12','17','22','27','32','37','42','47','52','57','1835','','','',24.7,'1537','17','17','',26,NULL),
(90,'11','16','21','26','31','36','41','46','51','56','1816','','','',24.8,'1522','','','',26.1,NULL),
(91,'10','15','20','25','30','35','40','45','50','55','1797','','17','19',24.9,'1507','16','16','',26.2,NULL),
(92,'9','14','19','24','29','34','39','44','49','54','1778','','','',25,'1492','','','',26.3,NULL),
(93,'8','13','18','23','28','33','38','43','48','53','1759','','','',25.1,'1477','15','15','9',26.4,NULL),
(94,'7','12','17','22','27','32','37','42','47','52','1740','','16','18',25.2,'1447','','','',26.5,NULL),
(95,'6','11','16','21','26','31','36','41','46','51','1721','','','',25.3,'1432','14','14','',26.6,NULL),
(96,'5','10','15','20','25','30','35','40','45','50','1702','','','',25.4,'1417','','','',26.7,NULL),
(97,'4','9','14','19','24','29','34','39','44','49','1683','','15','17',25.5,'1402','13','13','',26.8,NULL),
(98,'3','8','13','18','23','28','33','38','43','48','1664','','','',25.6,'1387','','','8',26.9,NULL),
(99,'2','7','12','17','22','27','32','37','42','47','1645','','','',25.7,'1372','12','12','',27,NULL),
(100,'1','6','11','16','21','26','31','36','41','46','1626','','14','16',25.8,'1357','','','',27.1,NULL),
(101,'1','5','10','15','20','25','30','35','40','45','1607','','','',25.9,'1342','11','','',27.2,NULL),
(102,'1','4','9','14','19','24','29','34','39','44','1588','','','',26,'1327','','11','',27.3,NULL),
(103,'1','3','8','13','18','23','28','33','38','43','1569','','13','15',26.1,'1312','10','','7',27.4,NULL),
(104,'1','2','7','12','17','22','27','32','37','42','1550','','','',26.2,'1297','','10','',27.5,NULL),
(105,'1','1','6','11','16','21','26','31','36','41','1531','','','',26.3,'1282','9','','',27.6,NULL),
(106,'1','1','5','10','15','20','25','30','35','40','1512','','12','14',26.4,'1267','','9','',27.7,NULL),
(107,'1','1','4','9','14','19','24','29','34','39','1493','','','',26.5,'1252','8','','',27.8,NULL),
(108,'1','1','3','8','13','18','23','28','33','38','1474','','11','13',26.6,'1237','','8','6',27.9,NULL),
(109,'1','1','2','7','12','17','22','27','32','37','1455','','','',26.7,'1222','7','','',28,NULL),
(110,'1','1','1','6','11','16','21','26','31','36','1436','','10','12',26.8,'1207','','7','',28.1,NULL),
(111,'1','1','1','5','10','15','20','25','30','35','1417','','','',26.9,'1192','6','','',28.2,NULL),
(112,'1','1','1','4','9','14','19','24','29','34','1398','','9','11',27,'1177','','6','',28.3,NULL),
(113,'1','1','1','3','8','13','18','23','28','33','1379','','','',27.1,'1162','5','','5',28.4,NULL),
(114,'1','1','1','2','7','12','17','22','27','32','1360','','8','10',27.2,'1147','','5','',28.5,NULL),
(115,'1','1','1','1','6','11','16','21','26','31','1341','','','',27.3,'1132','4','','',28.6,NULL),
(116,'1','1','1','1','5','10','15','20','25','30','1322','','7','9',27.4,'1117','','4','',28.7,NULL),
(117,'1','1','1','1','4','9','14','19','24','29','1303','','','',27.5,'1102','3','','',28.8,NULL),
(118,'1','1','1','1','3','8','13','18','23','28','1284','','6','8',27.6,'1087','','3','4',28.9,NULL),
(119,'1','1','1','1','2','7','12','17','22','27','1265','','','',27.7,'1072','2','','',29,NULL),
(120,'1','1','1','1','1','6','11','16','21','26','1246','','5','7',27.8,'1057','','2','',29.1,NULL),
(121,'1','1','1','1','1','5','10','15','20','25','1227','','','',27.9,'1042','1','','',29.2,NULL),
(122,'1','1','1','1','1','4','9','14','19','24','1208','','4','6',28,'1027','','1','',29.3,NULL),
(123,'1','1','1','1','1','3','8','13','18','23','1189','','','',28.1,'1012','','','3',29.4,NULL),
(124,'1','1','1','1','1','2','7','12','17','22','1170','','3','5',28.2,'997','','','',29.5,NULL),
(125,'1','1','1','1','1','1','6','11','16','21','1151','','','',28.3,'982','','','',29.6,NULL),
(126,'1','1','1','1','1','1','5','10','15','20','1132','','2','4',28.4,'967','','','',29.7,NULL),
(127,'1','1','1','1','1','1','4','9','14','19','1113','','','',28.5,'952','','','',29.8,NULL),
(128,'1','1','1','1','1','1','3','8','13','18','1094','','1','3',28.6,'937','','','2',29.9,NULL),
(129,'1','1','1','1','1','1','2','7','12','17','1075','','','',28.7,'922','','','',30,NULL),
(130,'1','1','1','1','1','1','1','6','11','16','1056','','','2',28.8,'907','','','',30.1,NULL),
(131,'1','1','1','1','1','1','1','5','10','15','1037','','','',28.9,'892','','','',30.2,NULL),
(132,'1','1','1','1','1','1','1','4','9','14','1018','','','1',29,'877','','','',30.3,NULL),
(133,'1','1','1','1','1','1','1','3','8','13','999','','','',29.1,'862','','','1',30.4,NULL),
(134,'1','1','1','1','1','1','1','2','7','12','980','','','',29.2,'847','','','',30.5,NULL),
(135,'1','1','1','1','1','1','1','1','6','11','961','','','',29.3,'832','','','',30.6,NULL),
(136,'1','1','1','1','1','1','1','1','5','10','642','','','',29.4,'817','','','',30.7,NULL),
(137,'1','1','1','1','1','1','1','1','4','9','923','','','',29.5,'802','','','',30.8,NULL),
(138,'1','1','1','1','1','1','1','1','3','8','904','','','',29.6,'787','','','',30.9,NULL),
(139,'1','1','1','1','1','1','1','1','2','7','885','','','',29.7,'772','','','',31,NULL),
(140,'1','1','1','1','1','1','1','1','1','6','866','','','',29.8,'757','','','',31.1,NULL),
(141,'1','1','1','1','1','1','1','1','1','5','847','','','',29.9,'742','','','',31.2,NULL),
(142,'1','1','1','1','1','1','1','1','1','4','828','','','',30,'727','','','',31.3,NULL),
(143,'1','1','1','1','1','1','1','1','1','3','809','','','',30.1,'712','','','',31.4,NULL),
(144,'1','1','1','1','1','1','1','1','1','2','790','','','',30.2,'697','','','',31.5,NULL),
(145,'1','1','1','1','1','1','1','1','1','1','771','','','',30.3,'682','','','',31.6,NULL);

/*Table structure for table `master_garjas_pns` */

DROP TABLE IF EXISTS `master_garjas_pns`;

CREATE TABLE `master_garjas_pns` (
  `id` int(11) NOT NULL,
  `2W` float DEFAULT NULL,
  `3W` float DEFAULT NULL,
  `4W` float DEFAULT NULL,
  `5W` float DEFAULT NULL,
  `NILAI` varchar(3) DEFAULT NULL,
  `KATAGORI` varchar(13) DEFAULT NULL,
  `2P` float DEFAULT NULL,
  `3P` float DEFAULT NULL,
  `4P` float DEFAULT NULL,
  `5P` float DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `master_garjas_pns` */

insert  into `master_garjas_pns` values 
(1,12.3,13,13.45,14.3,'100','Baik Sekali',9.45,10,10.3,11,NULL),
(2,12.33,13.04,13.51,14.36,'99','Baik Sekali',9.48,10.04,10.33,11.06,NULL),
(3,12.36,13.08,13.57,14.42,'98','Baik Sekali',9.51,10.07,10.36,11.12,NULL),
(4,12.39,13.12,14.03,14.48,'97','Baik Sekali',9.54,10.1,10.39,11.18,NULL),
(5,12.42,13.16,14.09,14.54,'96','Baik Sekali',9.57,10.13,10.49,11.24,NULL),
(6,12.45,13.2,14.15,15,'95','Baik Sekali',10.01,10.16,10.45,11.3,NULL),
(7,12.48,13.24,14.21,15.06,'94','Baik Sekali',10.04,10.19,10.48,11.36,NULL),
(8,12.51,13.28,14.27,15.12,'93','Baik Sekali',10.07,10.22,10.51,11.42,NULL),
(9,12.54,13.32,14.33,15.18,'92','Baik Sekali',10.1,10.25,10.54,11.48,NULL),
(10,12.57,13.36,14.39,15.24,'91','Baik Sekali',10.13,10.28,10.57,11.54,NULL),
(11,13,13.41,14.46,15.3,'90','Baik Sekali',10.16,10.31,11,12,NULL),
(12,13.03,13.46,14.53,15.36,'89','Baik Sekali',10.19,10.34,11.03,12.06,NULL),
(13,13.06,13.51,15,15.42,'88','Baik Sekali',10.22,10.38,11.06,12.12,NULL),
(14,13.09,13.56,15.07,15.48,'87','Baik Sekali',10.25,10.42,11.09,12.18,NULL),
(15,13.12,14.01,15.14,15.54,'86','Baik Sekali',10.28,10.46,11.12,12.24,NULL),
(16,13.15,14.06,15.21,16,'85','Baik Sekali',10.31,10.5,11.15,12.3,NULL),
(17,13.18,14.11,15.28,16.06,'84','Baik Sekali',10.34,10.54,11.18,12.36,NULL),
(18,13.21,14.16,15.35,16.12,'83','Baik Sekali',10.38,10.58,11.22,12.42,NULL),
(19,13.24,14.21,15.42,16.18,'82','Baik Sekali',10.42,11.02,11.26,12.48,NULL),
(20,13.27,14.26,15.49,16.24,'81','Baik Sekali',10.46,11.06,11.3,12.54,NULL),
(21,13.31,14.31,15.56,16.31,'80','Baik',10.5,11.1,11.34,12.57,NULL),
(22,13.38,14.37,16.01,16.38,'79','Baik',10.54,11.14,11.38,13,NULL),
(23,13.45,14.43,16.05,16.45,'78','Baik',10.58,11.18,11.42,13.03,NULL),
(24,13.52,14.49,16.09,16.52,'77','Baik',11.02,11.22,11.46,13.06,NULL),
(25,13.59,14.55,16.13,16.59,'76','Baik',11.06,11.26,11.5,13.09,NULL),
(26,14.06,15.01,16.17,17.08,'75','Baik',11.1,11.3,11.54,13.12,NULL),
(27,14.13,15.07,16.21,17.13,'74','Baik',11.14,11.34,11.58,13.15,NULL),
(28,14.2,15.13,16.26,17.2,'73','Baik',11.18,11.38,12.02,13.2,NULL),
(29,14.27,15.19,16.31,17.27,'72','Baik',11.22,11.42,12.06,13.26,NULL),
(30,14.34,15.25,16.36,17.34,'71','Baik',11.26,11.46,12.1,13.32,NULL),
(31,14.41,15.31,16.41,17.41,'70','Baik',11.3,11.5,12.15,13.38,NULL),
(32,14.48,15.37,16.46,17.49,'69','Baik',11.34,11.54,12.2,13.44,NULL),
(33,14.55,15.43,16.51,17.57,'68','Baik',11.38,11.58,12.25,13.5,NULL),
(34,15.02,15.49,16.56,18.05,'67','Baik',11.42,12.02,12.3,13.56,NULL),
(35,15.09,15.55,17.01,18.13,'66','Baik',11.46,12.06,12.35,14.02,NULL),
(36,15.16,16.01,17.06,18.21,'65','Baik',11.5,12.1,12.4,14.08,NULL),
(37,15.23,16.07,17.11,18.29,'64','Baik',11.54,12.14,12.45,14.14,NULL),
(38,15.31,16.13,17.16,18.37,'63','Baik',11.58,12.18,12.5,14.2,NULL),
(39,15.39,16.19,17.21,18.45,'62','Baik',12.02,12.22,12.55,14.26,NULL),
(40,15.47,16.25,17.26,18.53,'61','Baik',12.06,12.26,13,14.31,NULL),
(41,15.55,16.31,17.31,19.01,'60','Cukup',12.1,12.31,13.07,14.38,NULL),
(42,16.02,16.38,17.37,19.04,'59','Cukup',12.14,12.37,13.14,14.45,NULL),
(43,16.09,16.45,17.43,19.07,'58','Cukup',12.18,12.44,13.21,14.52,NULL),
(44,16.16,16.52,17.49,19.1,'57','Cukup',12.22,12.51,13.28,14.59,NULL),
(45,16.24,16.59,17.55,19.13,'56','Cukup',12.26,12.58,13.35,15.06,NULL),
(46,16.32,17.05,18.01,19.16,'55','Cukup',12.3,13.04,13.42,15.13,NULL),
(47,16.4,17.13,18.07,19.19,'54','Cukup',12.34,13.11,13.5,15.2,NULL),
(48,16.48,17.21,18.13,19.22,'53','Cukup',12.38,13.18,13.58,15.27,NULL),
(49,16.56,17.29,18.19,19.25,'52','Cukup',12.42,13.25,14.06,15.34,NULL),
(50,17.04,17.37,18.25,19.28,'51','Cukup',12.46,13.32,14.14,15.41,NULL),
(51,17.12,17.45,18.31,19.31,'50','Cukup',12.5,13.39,14.22,15.49,NULL),
(52,17.2,17.53,18.37,19.34,'49','Cukup',12.54,13.46,14.3,15.57,NULL),
(53,17.28,18.01,18.43,19.37,'48','Cukup',12.59,13.53,14.38,16.05,NULL),
(54,17.36,18.07,18.49,19.4,'47','Cukup',13.05,14,14.46,16.13,NULL),
(55,17.44,18.31,18.55,19.43,'46','Cukup',13.11,14.07,14.54,16.21,NULL),
(56,17.52,18.37,19.01,19.46,'45','Cukup',13.21,14.14,13.02,16.29,NULL),
(57,18,18.43,19.07,19.49,'44','Cukup',13.31,14.21,15.1,16.37,NULL),
(58,18.08,18.49,19.13,19.52,'43','Cukup',13.41,14.31,15.18,16.45,NULL),
(59,18.16,18.55,19.19,19.55,'42','Cukup',13.51,14.38,15.26,16.53,NULL),
(60,18.24,19.01,19.25,19.58,'41','Cukup',14.01,14.45,15.34,17.01,NULL),
(61,18.31,19.07,19.31,20.01,'40','Kurang',14.07,14.5,15.42,17.07,NULL),
(62,18.32,19.13,19.32,20.02,'39','Kurang',14.13,14.55,15.5,17.13,NULL),
(63,18.33,19.19,19.33,20.03,'38','Kurang',14.19,15,15.58,17.19,NULL),
(64,18.34,19.2,19.34,20.04,'37','Kurang',14.25,15.05,16.06,17.25,NULL),
(65,18.35,19.25,19.35,20.05,'36','Kurang',14.31,15.1,16.06,17.31,NULL),
(66,18.36,19.31,19.36,20.06,'35','Kurang',14.37,15.15,16.22,17.37,NULL),
(67,18.37,19.32,19.37,20.07,'34','Kurang',14.43,15.2,16.3,17.43,NULL),
(68,18.38,19.33,19.38,20.08,'33','Kurang',14.49,15.25,16.38,17.49,NULL),
(69,18.39,19.34,19.39,20.09,'32','Kurang',14.55,15.3,16.46,17.55,NULL),
(70,18.4,19.35,19.4,20.1,'31','Kurang',15.01,15.35,16.54,18.01,NULL),
(71,18.41,19.36,19.41,20.11,'30','Kurang',15.07,15.4,17.02,18.07,NULL),
(72,18.43,19.37,19.43,20.23,'29','Kurang',15.13,15.45,17.1,18.13,NULL),
(73,18.45,19.38,19.45,20.25,'28','Kurang',15.19,15.5,17.18,18.19,NULL),
(74,18.47,19.39,19.47,20.27,'27','Kurang',15.25,15.55,17.28,18.25,NULL),
(75,18.49,19.4,19.49,20.29,'26','Kurang',15.31,16,17.34,18.31,NULL),
(76,18.51,19.41,19.51,20.31,'25','Kurang',15.37,16.06,17.42,18.37,NULL),
(77,18.53,19.42,19.53,20.33,'24','Kurang',15.43,16.12,17.5,18.43,NULL),
(78,18.55,19.43,19.55,20.35,'23','Kurang',15.49,16.18,17.58,18.49,NULL),
(79,18.57,19.44,19.57,20.37,'22','Kurang',15.55,16.24,18.06,18.55,NULL),
(80,18.59,19.45,19.59,20.39,'21','Kurang',16,16.3,18.14,19.01,NULL),
(81,19.01,19.47,20.01,20.41,'20','Kurang Sekali',16.06,16.36,18.2,19.07,NULL),
(82,19.07,19.49,20.07,20.43,'19','Kurang Sekali',16.12,16.42,18.26,19.13,NULL),
(83,19.13,19.51,20.13,20.45,'18','Kurang Sekali',16.18,16.48,18.32,19.19,NULL),
(84,19.19,19.53,20.19,20.49,'17','Kurang Sekali',16.24,16.54,18.38,19.25,NULL),
(85,19.25,19.55,20.25,20.55,'16','Kurang Sekali',16.3,17,18.42,19.31,NULL),
(86,19.31,20.01,20.31,21.01,'15','Kurang Sekali',16.36,17.06,18.48,19.37,NULL),
(87,19.37,20.07,20.37,21.07,'14','Kurang Sekali',16.42,17.12,18.54,19.43,NULL),
(88,19.43,20.13,20.43,21.13,'13','Kurang Sekali',16.48,17.18,19,19.49,NULL),
(89,19.49,20.19,20.49,21.19,'12','Kurang Sekali',16.54,17.24,19.06,19.55,NULL),
(90,19.55,20.25,20.55,21.25,'11','Kurang Sekali',17,17.3,19.12,20.01,NULL),
(91,20.01,20.31,21.01,21.31,'10','Kurang Sekali',17.06,17.36,19.18,20.07,NULL),
(92,20.07,20.37,21.07,21.37,'9','Kurang Sekali',17.12,17.42,19.24,20.13,NULL),
(93,20.13,20.43,21.13,21.43,'8','Kurang Sekali',17.18,17.48,19.3,20.19,NULL),
(94,20.19,20.49,21.19,21.49,'7','Kurang Sekali',17.24,17.54,19.36,20.25,NULL),
(95,20.26,20.55,21.26,21.56,'6','Kurang Sekali',17.3,18,19.42,20.31,NULL),
(96,20.33,21.01,21.33,22.03,'5','Kurang Sekali',17.36,18.06,19.46,30.37,NULL),
(97,20.4,21.07,21.4,22.1,'4','Kurang Sekali',17.42,18.12,19.54,20.43,NULL),
(98,20.47,21.13,21.47,22.17,'3','Kurang Sekali',17.48,18.18,20,20.49,NULL),
(99,20.54,21.19,21.54,22.24,'2','Kurang Sekali',17.54,18.24,20.07,20.55,NULL),
(100,21.01,21.26,22.01,22.31,'1','Kurang Sekali',18,18.3,20.14,21.01,NULL);

/*Table structure for table `master_garjas_renang` */

DROP TABLE IF EXISTS `master_garjas_renang`;

CREATE TABLE `master_garjas_renang` (
  `No` varchar(3) NOT NULL DEFAULT '',
  `DADA_Laki` varchar(9) DEFAULT NULL,
  `BEBAS_Laki` varchar(10) DEFAULT NULL,
  `NILAI` varchar(5) DEFAULT NULL,
  `DADA_Perempuan` varchar(14) DEFAULT NULL,
  `BEBAS_Perempuan` varchar(15) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `master_garjas_renang` */

insert  into `master_garjas_renang` values 
('001','0.40','0.25','100','0.49','0.30',NULL),
('002','0.41','0.26','99','0.50','0.31',NULL),
('003','0.42','0.27','98','0.51','0.32',NULL),
('004','0.43','0.28','97','0.52','0.33',NULL),
('005','0.44','0.29','96','0.53','0.34',NULL),
('006','0.45','0.30','95','0.54','0.35',NULL),
('007','0.46','0.31','94','0.55','0.36',NULL),
('008','0.47','0.32','93','0.56','0.37',NULL),
('009','0.48','0.33','92','0.57','0.38',NULL),
('010','0.49','0.34','91','0.58','0.39',NULL),
('011','0.50','0.35','90','0.59','0.40',NULL),
('012','0.51','0.36','89','1.00','0.41',NULL),
('013','0.52','0.37','88','1.01','0.42',NULL),
('014','0.53','0.38','87','1.02','0.43',NULL),
('015','0.54','0.39','86','1.03','0.44',NULL),
('016','0.55','0.40','85','1.04','0.45',NULL),
('017','0.56','0.41','84','1.05','0.46',NULL),
('018','0.57','0.42','83','1.06','0.47',NULL),
('019','0.58','0.43','82','1.07','0.48',NULL),
('020','0.59','0.44','81','1.08','0.49',NULL),
('021','1.00','0.45','80','1.09','0.50',NULL),
('022','1.01','0.46','79','1.10','0.51',NULL),
('023','1.02','0.47','78','1.11','0.52',NULL),
('024','1.03','0.48','77','1.12','0.53',NULL),
('025','1.04','0.49','76','1.13','0.54',NULL),
('026','1.05','0.50','75','1.14','0.55',NULL),
('027','1.06','0.51','74','1.15','0.56',NULL),
('028','1.07','0.52','73','1.16','0.57',NULL),
('029','1.08','0.53','72','1.17','0.58',NULL),
('030','1.09','0.54','71','1.18','0.59',NULL),
('031','1.10','0.55','70','1.19','1.00',NULL),
('032','1.11','0.56','69','1.20','1.01',NULL),
('033','1.12','0.57','68','1.21','1.02',NULL),
('034','1.13','0.58','67','1.22','1.03',NULL),
('035','1.14','0.59','66','1.23','1.04',NULL),
('036','1.15','1.00','65','1.24','1.05',NULL),
('037','1.16','1.01','64','1.25','1.06',NULL),
('038','1.17','1.02','63','1.26','1.07',NULL),
('039','1.18','1.03','62','1.27','1.08',NULL),
('040','1.19','1.04','61','1.28','1.09',NULL),
('041','1.20','1.05','60','1.29','1.10',NULL),
('042','1.21','1.06','59','1.30','1.11',NULL),
('043','1.22','1.07','58','1.31','1.12',NULL),
('044','1.23','1.08','57','1.32','1.13',NULL),
('045','1.24','1.09','56','1.33','1.14',NULL),
('046','1.25','1.10','55','1.34','1.15',NULL),
('047','1.26','1.11','54','1.35','1.16',NULL),
('048','1.27','1.12','53','1.36','1.17',NULL),
('049','1.28','1.13','52','1.37','1.18',NULL),
('050','1.29','1.14','51','1.38','1.19',NULL),
('051','1.30','1.15','50','1.39','1.20',NULL),
('052','1.31','1.16','49','1.40','1.21',NULL),
('053','1.32','1.17','48','1.41','1.22',NULL),
('054','1.33','1.18','47','1.42','1.23',NULL),
('055','1.34','1.19','46','1.43','1.24',NULL),
('056','1.35','1.20','45','1.44','1.25',NULL),
('057','1.36','1.21','44','1.45','1.26',NULL),
('058','1.37','1.22','43','1.46','1.27',NULL),
('059','1.38','1.23','42','1.47','1.28',NULL),
('060','1.39','1.24','41','1.48','1.29',NULL),
('061','1.40','1.25','40','1.49','1.30',NULL),
('062','1.41','1.26','39','1.50','1.31',NULL),
('063','1.42','1.27','38','1.51','1.32',NULL),
('064','1.43','1.28','37','1.52','1.33',NULL),
('065','1.44','1.29','36','1.53','1.34',NULL),
('066','1.45','1.30','35','1.54','1.35',NULL),
('067','1.46','1.31','34','1.55','1.36',NULL),
('068','1.47','1.32','33','1.56','1.37',NULL),
('069','1.48','1.33','32','1.57','1.38',NULL),
('070','1.49','1.34','31','1.58','1.39',NULL),
('071','1.50','1.35','30','1.59','1.40',NULL),
('072','1.51','1.36','29','2.00','1.41',NULL),
('073','1.52','1.37','28','2.01','1.42',NULL),
('074','1.53','1.38','27','2.02','1.43',NULL),
('075','1.54','1.39','26','2.03','1.44',NULL),
('076','1.55','1.40','25','2.04','1.45',NULL),
('077','1.56','1.41','24','2.05','1.46',NULL),
('078','1.57','1.42','23','2.06','1.47',NULL),
('079','1.58','1.43','22','2.07','1.48',NULL),
('080','1.59','1.44','21','2.08','1.49',NULL),
('081','2.00','1.45','20','2.09','1.50',NULL),
('082','2.01','1.46','19','2.10','1.51',NULL),
('083','2.02','1.47','18','2.11','1.52',NULL),
('084','2.03','1.48','17','2.12','1.53',NULL),
('085','2.04','1.49','16','2.13','1.54',NULL),
('086','2.05','1.50','15','2.14','1.55',NULL),
('087','2.06','1.51','14','2.15','1.56',NULL),
('088','2.07','1.52','13','2.16','1.57',NULL),
('089','2.08','1.53','12','2.17','1.58',NULL),
('090','2.09','1.54','11','2.18','1.59',NULL),
('091','2.10','1.55','10','2.19','2.00',NULL),
('092','2.11','1.56','9','2.20','2.01',NULL),
('093','2.12','1.57','8','2.21','2.02',NULL),
('094','2.13','1.58','7','2.22','2.03',NULL),
('095','2.14','1.59','6','2.23','2.04',NULL),
('096','2.15','2.00','5','2.24','2.05',NULL),
('097','2.16','2.01','4','2.25','2.06',NULL),
('098','2.17','2.02','3','2.26','2.07',NULL),
('099','2.18','2.03','2','2.27','2.08',NULL),
('100','2.19','2.04','1','2.28','2.09',NULL);

/*Table structure for table `master_jabatan_intern` */

DROP TABLE IF EXISTS `master_jabatan_intern`;

CREATE TABLE `master_jabatan_intern` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_jabatan_intern` */

/*Table structure for table `master_jabatan_kasal` */

DROP TABLE IF EXISTS `master_jabatan_kasal`;

CREATE TABLE `master_jabatan_kasal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_jabatan_kasal` */

/*Table structure for table `master_keperluan_garjas` */

DROP TABLE IF EXISTS `master_keperluan_garjas`;

CREATE TABLE `master_keperluan_garjas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `nilai_postur` int(11) DEFAULT NULL,
  `nilai_garjas` int(11) DEFAULT NULL,
  `nilai_renang` int(11) DEFAULT NULL,
  `nilai_akhir` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `master_keperluan_garjas` */

insert  into `master_keperluan_garjas` values 
(1,'Diktukpa',41,41,41,47,NULL,NULL,NULL),
(2,'Diktukba',41,41,41,47,NULL,NULL,NULL),
(3,'Diktukbakat',41,41,41,41,NULL,NULL,NULL),
(4,'Diklapa',41,41,41,46,NULL,NULL,NULL),
(5,'Dik Seskoal',41,41,41,43,NULL,NULL,NULL),
(6,'Dik Sesko TNI',41,41,41,42,NULL,NULL,NULL),
(7,'Diklapa (+)',41,41,41,43,NULL,NULL,NULL),
(8,'Dikspespa',41,41,41,46,NULL,NULL,NULL),
(9,'Sus PWO',41,41,41,46,NULL,NULL,NULL),
(10,'Dik Brevet, PTAL',41,41,41,61,NULL,NULL,NULL),
(11,'Diklaba dan Diklata',41,41,41,46,NULL,NULL,NULL),
(12,'D-3 STTAL',41,41,41,46,NULL,NULL,NULL),
(13,'S-1 STTAL',41,41,41,46,NULL,NULL,NULL),
(14,'S-2 STTAL',41,41,41,46,NULL,NULL,NULL),
(15,'ADC Presiden/Wakil Presiden',41,41,41,61,NULL,NULL,NULL),
(16,'Athan/Angkatan',41,41,41,61,NULL,NULL,NULL),
(17,'Pamen',41,41,41,61,NULL,NULL,NULL),
(18,'Pama',41,41,41,61,NULL,NULL,NULL),
(19,'Bintara',41,41,41,61,NULL,NULL,NULL),
(20,'Tamtama',41,41,41,61,NULL,NULL,NULL),
(21,'Rutin',0,0,0,0,NULL,NULL,NULL);

/*Table structure for table `master_kualifikasi` */

DROP TABLE IF EXISTS `master_kualifikasi`;

CREATE TABLE `master_kualifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `profesi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_kualifikasi` */

/*Table structure for table `master_pangkat` */

DROP TABLE IF EXISTS `master_pangkat`;

CREATE TABLE `master_pangkat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `nama_pendek_1` varchar(255) DEFAULT NULL,
  `nama_pendek_2` varchar(255) DEFAULT NULL,
  `usia_pensiun` int(11) DEFAULT NULL,
  `strata` varchar(255) DEFAULT NULL,
  `strata_order` int(11) DEFAULT NULL,
  `kenkatba` varchar(255) DEFAULT NULL COMMENT '?? gapaham',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_pangkat` */

/*Table structure for table `master_postur` */

DROP TABLE IF EXISTS `master_postur`;

CREATE TABLE `master_postur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tinggi_badan` int(11) DEFAULT NULL,
  `LLB` float DEFAULT NULL,
  `LB` float DEFAULT NULL,
  `NB` float DEFAULT NULL,
  `HB` float DEFAULT NULL,
  `I` float DEFAULT NULL,
  `HA` float DEFAULT NULL,
  `NA` float DEFAULT NULL,
  `LA` float DEFAULT NULL,
  `LLA` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `master_postur` */

insert  into `master_postur` values 
(1,150,40,40,42,43.5,45,45.1,50.1,55.1,60,NULL,NULL,NULL),
(2,151,40.8,40.8,42.8,44.4,45.9,46,51.1,56.2,61.2,NULL,NULL,NULL),
(3,152,41.6,41.6,43.7,45.2,46.8,46.9,52.1,57.3,62.4,NULL,NULL,NULL),
(4,153,42.4,42.4,44.5,46.1,47.7,47.8,53.1,58.4,63.6,NULL,NULL,NULL),
(5,154,43.2,43.2,45.4,47,48.6,48.7,54.1,59.5,64.8,NULL,NULL,NULL),
(6,155,44,44,46.2,47.9,49.5,49.6,55.1,60.6,66,NULL,NULL,NULL),
(7,156,44.8,44.8,47,48.7,50.4,50.5,56.1,61.7,67.2,NULL,NULL,NULL),
(8,157,45.6,45.6,47.9,49.6,51.3,51.4,57.1,62.8,68.4,NULL,NULL,NULL),
(9,158,46.4,46.4,48.7,50.5,52.2,52.3,58.1,63.9,69.6,NULL,NULL,NULL),
(10,159,47.2,47.2,49.6,51.3,53.1,53.2,59.1,65,70.8,NULL,NULL,NULL),
(11,160,48,48,50.4,52.2,54,54.1,60.1,66.1,72,NULL,NULL,NULL),
(12,161,48.8,48.8,51.2,53.1,54.9,55,61.1,67.2,73.2,NULL,NULL,NULL),
(13,162,49.6,49.6,52.1,53.9,55.8,55.9,62.1,68.3,74.4,NULL,NULL,NULL),
(14,163,50.4,50.4,52.9,54.8,56.7,56.8,63.1,69.4,75.6,NULL,NULL,NULL),
(15,164,51.2,51.2,53.8,55.7,57.6,57.7,64.1,70.5,76.8,NULL,NULL,NULL),
(16,165,52,52,54.6,56.6,58.5,58.6,65.1,71.6,78,NULL,NULL,NULL),
(17,166,52.8,52.8,55.4,57.4,59.4,59.5,66.1,72.7,79.2,NULL,NULL,NULL),
(18,167,53.6,53.6,56.3,58.3,60.3,60.4,67.1,73.8,80.4,NULL,NULL,NULL),
(19,168,54.4,54.4,57.1,59.2,61.2,61.3,68.1,74.9,81.6,NULL,NULL,NULL),
(20,169,55.2,55.2,58,60,62.1,62.2,69.1,76,82.8,NULL,NULL,NULL),
(21,170,56,56,58.8,60.9,63,63.1,70.1,77.1,84,NULL,NULL,NULL),
(22,171,56.8,56.8,59.6,61.8,63.9,64,71.1,78.2,85.2,NULL,NULL,NULL),
(23,172,57.6,57.6,60.5,62.6,64.8,64.9,72.1,79.3,86.4,NULL,NULL,NULL),
(24,173,58.4,58.4,61.3,63.5,65.7,65.8,73.1,80.4,87.6,NULL,NULL,NULL),
(25,174,59.2,59.2,62.2,64.4,66.6,66.7,74.1,81.5,88.8,NULL,NULL,NULL),
(26,175,60,60,63,65.3,67.5,67.6,75.1,82.6,90,NULL,NULL,NULL),
(27,176,60.8,60.8,63.8,66.1,68.4,68.5,76.1,83.7,91.2,NULL,NULL,NULL),
(28,177,61.6,61.6,64.7,67,69.3,69.4,77.1,84.8,92.4,NULL,NULL,NULL),
(29,178,62.4,62.4,65.5,67.9,70.2,70.3,78.1,85.9,93.6,NULL,NULL,NULL),
(30,179,63.2,63.2,66.4,68.7,71.1,71.2,79.1,87,94.8,NULL,NULL,NULL),
(31,180,64,64,67.2,69.6,72,72.1,80.1,88.1,96,NULL,NULL,NULL),
(32,181,64.8,64.8,68,70.5,72.9,73,81.1,89.2,97.2,NULL,NULL,NULL),
(33,182,65.6,65.6,68.9,71.3,73.8,73.9,82.1,90.3,98.4,NULL,NULL,NULL),
(34,183,66.4,66.4,69.7,72.2,74.7,74.8,83.1,91.4,99.6,NULL,NULL,NULL),
(35,184,67.2,67.2,70.6,73.1,75.6,75.7,84.1,92.5,100.8,NULL,NULL,NULL),
(36,185,68,68,71.4,74,76.5,76.6,85.1,93.6,102,NULL,NULL,NULL),
(37,186,68.8,68.8,72.2,74.8,77.4,77.5,86.1,94.7,103.2,NULL,NULL,NULL),
(38,187,69.6,69.6,73.1,75.7,78.3,78.4,87.1,95.8,104.4,NULL,NULL,NULL),
(39,188,70.4,70.4,73.9,76.6,79.2,79.3,88.1,96.9,105.6,NULL,NULL,NULL),
(40,189,71.2,71.2,74.8,77.4,80.1,80.2,89.1,98,106.8,NULL,NULL,NULL),
(41,190,72,72,75.6,78.3,81,81.1,90.1,99.1,108,NULL,NULL,NULL),
(42,191,72.8,72.8,76.4,79.2,81.9,82,91.1,100.2,109.2,NULL,NULL,NULL),
(43,192,73.6,73.6,77.3,80,82.8,82.9,92.1,101.3,110.4,NULL,NULL,NULL),
(44,193,74.4,74.4,78.1,80.9,83.7,83.8,93.1,102.4,111.6,NULL,NULL,NULL),
(45,194,75.2,75.2,79,81.8,84.6,84.7,94.1,103.5,112.8,NULL,NULL,NULL),
(46,195,76,76,79.8,82.7,85.5,85.6,95.1,104.6,114,NULL,NULL,NULL),
(47,196,76.8,76.8,80.6,83.5,86.4,86.5,96.1,105.7,115.2,NULL,NULL,NULL),
(48,197,77.6,77.6,81.5,84.4,87.3,87.4,97.1,106.8,116.4,NULL,NULL,NULL),
(49,198,78.4,78.4,82.3,85.3,88.2,88.3,98.1,107.9,117.6,NULL,NULL,NULL),
(50,199,79.2,79.2,83.2,86.1,89.1,89.2,99.1,109,118.8,NULL,NULL,NULL),
(51,200,80,80,84,87,90,90.1,100.1,110.1,120,NULL,NULL,NULL);

/*Table structure for table `master_subkualifikasi` */

DROP TABLE IF EXISTS `master_subkualifikasi`;

CREATE TABLE `master_subkualifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_subkualifikasi` */

/*Table structure for table `mdepartments` */

DROP TABLE IF EXISTS `mdepartments`;

CREATE TABLE `mdepartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mdepartments` */

/*Table structure for table `meducations` */

DROP TABLE IF EXISTS `meducations`;

CREATE TABLE `meducations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `meducations` */

insert  into `meducations` values 
(1,'SD',NULL,NULL,NULL),
(2,'SMP',NULL,NULL,NULL),
(3,'SMA/SMK',NULL,NULL,NULL),
(4,'D1',NULL,NULL,NULL),
(5,'D2',NULL,NULL,NULL),
(6,'D3',NULL,NULL,NULL),
(7,'D4',NULL,NULL,NULL),
(8,'S1',NULL,NULL,NULL),
(9,'S2',NULL,NULL,NULL),
(10,'S3',NULL,NULL,NULL),
(11,'Profesi',NULL,NULL,NULL),
(12,'Spesialis 1',NULL,NULL,NULL),
(13,'Spesialis 2',NULL,NULL,NULL);

/*Table structure for table `military_educations` */

DROP TABLE IF EXISTS `military_educations`;

CREATE TABLE `military_educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `tmt` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `certificate` int(11) DEFAULT NULL,
  `verification_file` int(11) DEFAULT NULL,
  `verificator` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `is_employee` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_military_education_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `military_educations` */

/*Table structure for table `mpositions` */

DROP TABLE IF EXISTS `mpositions`;

CREATE TABLE `mpositions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `gol_pns` varchar(25) DEFAULT NULL,
  `pensiun` int(11) DEFAULT NULL,
  `strata` varchar(25) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mpositions` */

/*Table structure for table `mtrainings` */

DROP TABLE IF EXISTS `mtrainings`;

CREATE TABLE `mtrainings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mtrainings` */

/*Table structure for table `pangkat` */

DROP TABLE IF EXISTS `pangkat`;

CREATE TABLE `pangkat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `korps` varchar(64) DEFAULT NULL,
  `tmt` datetime DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `supervisor` varchar(100) DEFAULT NULL,
  `letter_number` varchar(30) DEFAULT NULL,
  `letter_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_positions_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pangkat` */

/*Table structure for table `photos` */

DROP TABLE IF EXISTS `photos`;

CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) DEFAULT NULL,
  `mime` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `photos` */

/*Table structure for table `pns` */

DROP TABLE IF EXISTS `pns`;

CREATE TABLE `pns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `functional_position` varchar(50) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pns_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pns` */

/*Table structure for table `positions` */

DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `mposition_id` int(11) DEFAULT NULL,
  `tmt` datetime DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `supervisor` varchar(100) DEFAULT NULL,
  `letter_number` varchar(30) DEFAULT NULL,
  `letter_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_positions_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `positions` */

/*Table structure for table `religions` */

DROP TABLE IF EXISTS `religions`;

CREATE TABLE `religions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `religions` */

/*Table structure for table `riwayat_jabatan` */

DROP TABLE IF EXISTS `riwayat_jabatan`;

CREATE TABLE `riwayat_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tmt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `st_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `riwayat_jabatan` */

/*Table structure for table `sections` */

DROP TABLE IF EXISTS `sections`;

CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sections` */

/*Table structure for table `st_kasal_positions` */

DROP TABLE IF EXISTS `st_kasal_positions`;

CREATE TABLE `st_kasal_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `st_number` varchar(50) DEFAULT NULL,
  `sp_number` varchar(50) DEFAULT NULL,
  `sp_date` datetime DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_st_kasal_positions_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `st_kasal_positions` */

/*Table structure for table `tanda_tangan` */

DROP TABLE IF EXISTS `tanda_tangan`;

CREATE TABLE `tanda_tangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) DEFAULT NULL,
  `bagian_atas` text DEFAULT NULL,
  `bagian_bawah` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tanda_tangan` */

/*Table structure for table `trainings` */

DROP TABLE IF EXISTS `trainings`;

CREATE TABLE `trainings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `period` char(4) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `certificate` int(11) DEFAULT NULL,
  `verificator` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `is_employee` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_training_employees` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trainings` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
