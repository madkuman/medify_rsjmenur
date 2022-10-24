DROP TABLE IF EXISTS `tbdepart`;
CREATE TABLE `tbdepart` (
  `kd_departemen` varchar(4) default NULL,
  `dep` varchar(40) NOT NULL,
  PRIMARY KEY  (`dep`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "tbdepart"
#

/*!40000 ALTER TABLE `tbdepart` DISABLE KEYS */;
INSERT INTO `tbdepart` VALUES 
('01','Dep Bangdiklat'),
('01','Dep Far'),
('01','Dep Gilut'),
('01','Dep IGD'),
('01','Dep Jangklin'),
('01','Dep Kesla'),
('01','Dep KIA'),
('01','Dep Kitlam'),
('01','Dep Kutema'),
('01','Dep Saware'),
('01','Dep Wat'),
('02','Pokli'),
('05','Sekretariat'),
('04','Simak BMN'),
('03','Wakamed');