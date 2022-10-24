DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `Username` varchar(20) NOT NULL,
  `Nama` varchar(30) default NULL,
  `Password` varchar(20) default NULL,
  `Hak` varchar(1) default NULL,
  PRIMARY KEY  (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES 
('admin','Administrator','123','1'),
('agustinus','agustinus','1','1'),
('super','Supervisor','123','2'),
('user','user','123','2');