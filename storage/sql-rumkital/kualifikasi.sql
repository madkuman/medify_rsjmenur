
DROP TABLE IF EXISTS `tbkualifikasi`;
CREATE TABLE `tbkualifikasi` (
  `kd_kualifikasi` varchar(2) default NULL,
  `kualifikasi` varchar(30) NOT NULL,
  PRIMARY KEY  (`kualifikasi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "tbkualifikasi"
#

/*!40000 ALTER TABLE `tbkualifikasi` DISABLE KEYS */;
INSERT INTO `tbkualifikasi` VALUES 
('05','Apoteker'),
('08','Bidan'),
('04','Dokter Gigi'),
('01','Dokter Spesialis'),
('03','Dokter Umum'),
('02','Drg Spesialis'),
('09','Nakes'),
('10','Non Medis'),
('06','Perawat'),
('07','Perawat Gigi');