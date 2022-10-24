
USE `medify_hospital_kasus`;
CREATE TABLE `resep_racikan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resep_detail_id` int(11) DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `nama_obat` varchar(256) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;



USE `medify_hospital`;
CREATE TABLE `paket_obat_racikan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resep_detail_id` int(11) DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `nama_obat` varchar(256) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;