
DROP TABLE IF EXISTS `tbagama`;
CREATE TABLE `tbagama` (
  `kode` int(2) NOT NULL auto_increment,
  `agama` varchar(15) NOT NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "tbagama"
#

/*!40000 ALTER TABLE `tbagama` DISABLE KEYS */;
INSERT INTO `tbagama` VALUES 
(1,'ISLAM'),
(2,'KATHOLIK'),
(3,'PROTESTAN'),
(4,'HINDU'),
(5,'BUDHA'),
(6,'KONGHUCU');