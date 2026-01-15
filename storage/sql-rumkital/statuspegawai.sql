DROP TABLE IF EXISTS `t_statuspegawai`;
CREATE TABLE `t_statuspegawai` (
  `kd_peg` varchar(2) default NULL,
  `s_peg` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`s_peg`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "t_statuspegawai"
#

/*!40000 ALTER TABLE `t_statuspegawai` DISABLE KEYS */;
INSERT INTO `t_statuspegawai` VALUES 
('01','MILITER'),
('03','PHL'),
('02','PNS');