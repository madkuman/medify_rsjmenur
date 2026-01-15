DROP TABLE IF EXISTS `pat`;
CREATE TABLE `pat` (
  `direktori` varchar(100) default NULL,
  `BLN` varchar(4) default NULL,
  `KOP1` text,
  `KOP2` text,
  `Sarmin` text,
  `Periode` varchar(20) default NULL,
  `NM` varchar(50) default NULL,
  `pkt` varchar(30) default NULL,
  `korp` varchar(10) default NULL,
  `nrp` varchar(20) default NULL,
  `JudulSurat` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "pat"
#

/*!40000 ALTER TABLE `pat` DISABLE KEYS */;
INSERT INTO `pat` VALUES 
('D:\\Program BLU','VIII','DINAS KESEHATAN ANGKATAN LAUT','RUMKITAL Dr. RAMELAN','sdsd','01010','Benedictus Mintoro','Peltu','Jas','073943',NULL),
('D:\\Program BLU','VIII','DINAS KESEHATAN ANGKATAN LAUT','RUMKITAL Dr. RAMELAN','sdsd','01010','Benedictus Mintoro','Peltu','Jas','073943',NULL);