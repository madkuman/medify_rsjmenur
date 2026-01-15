DROP TABLE IF EXISTS `t_ttd`;
CREATE TABLE `t_ttd` (
  `NM1` varchar(50) default NULL,
  `PKT1` varchar(50) default NULL,
  `KORP1` varchar(10) default NULL,
  `NRP1` varchar(15) default NULL,
  `JAB1` varchar(50) default NULL,
  `JAB2` varchar(50) default NULL,
  `TTD1` text,
  `TTD2` text,
  `No_URUT` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "t_ttd"
#

/*!40000 ALTER TABLE `t_ttd` DISABLE KEYS */;
INSERT INTO `t_ttd` VALUES 
('dr. Agus Guntoro, Sp.BS','Kolonel Laut','(K)','009130/P','Wakabin,','Wakabin','a.n. Kepala Rumkital Dr. Ramelan','a.n. Kepala Rumkital Dr. Ramelan','1'),
('Mujiburrahman S.Ag','Letkol Laut','Mar','013548/P','Dansatma,','Dansatma','a.n. Kepala Rumkital Dr. Ramelan','a.n. Kepala Rumkital Dr. Ramelan','2'),
('Nurtarina Heratanti, Amd','Mayor Laut','(K/W)','14186/P','Kabagminpers,','Kabagminpers','a.n. Kepala Rumkital Dr. Ramelan\r\nDansatma\r\nU.b.','a.n. Kepala Rumkital Dr. Ramelan\r\nDansatma\r\nU.b.','3'),
('dr. IDG. Nalendra, D.I., Sp.B, Sp.BTKV (K)','Laksma TNI','(K)','009137/P','Kepala Rumkital Dr. Ramelan','Kepala Rumkital Dr. Ramelan','Kepala Rumkital Dr. Ramelan','Kepala Rumkital Dr. Ramelan','4');