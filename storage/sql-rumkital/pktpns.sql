DROP TABLE IF EXISTS `t_pkt_pns`;
CREATE TABLE `t_pkt_pns` (
  `kd_pkt` varchar(2) default NULL,
  `pkt` varchar(30) NOT NULL,
  PRIMARY KEY  (`pkt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "t_pkt_pns"
#

/*!40000 ALTER TABLE `t_pkt_pns` DISABLE KEYS */;
INSERT INTO `t_pkt_pns` VALUES 
('24','CPNS I/a'),
('22','CPNS I/b'),
('20','CPNS I/c'),
('17','CPNS II/a'),
('15','CPNS II/b'),
('13','CPNS II/c'),
('10','CPNS III/a'),
('08','CPNS III/b'),
('23','Jurda I/a'),
('21','Jurda Tk.I I/b'),
('19','Juru I/c'),
('18','Juru Tk.I I/d'),
('04','Pembina IV/a'),
('03','Pembina Tk.I IV/b'),
('02','Pembina Utama IV/c'),
('01','Pembina Utama IV/d'),
('06','Penata III/c'),
('05','Penata Tk.I III/d'),
('09','Penda III/a'),
('07','Penda Tk.I III/b'),
('12','Pengatur II/c'),
('11','Pengatur Tk.I II/d'),
('16','Pengda II/a'),
('14','Pengda Tk.I II/b');
/*!40000 ALTER TABLE `t_pkt_pns` ENABLE KEYS */;