DROP TABLE IF EXISTS `t_kadep`;
CREATE TABLE `t_kadep` (
  `kd_kadep` varchar(2) default NULL,
  `jab` varchar(40) NOT NULL,
  PRIMARY KEY  (`jab`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "t_kadep"
#

/*!40000 ALTER TABLE `t_kadep` DISABLE KEYS */;
INSERT INTO `t_kadep` VALUES ('01','Kadep Bangdiklat'),
('01','Kadep Far'),
('01','Kadep Gilut'),
('01','Kadep IGD'),
('01','Kadep Jangklin'),
('01','Kadep Kesla'),
('01','Kadep KIA'),
('01','Kadep Kitlam'),
('01','Kadep Kutema'),
('01','Kadep Saware'),
('01','Kadep Wat'),
('02','Kapokli'),
('05','Karumkit'),
('04','Wakabin'),
('03','Wakamed');