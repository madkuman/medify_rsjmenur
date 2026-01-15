DROP TABLE IF EXISTS `t_daftarpersonil`;
CREATE TABLE `t_daftarpersonil` (
  `NM` varchar(50) NOT NULL,
  `Pkt_Korp` varchar(50) NOT NULL,
  `Nrp` varchar(20) NOT NULL,
  `Keterangan` varchar(30) NOT NULL,
  `Pkt` varchar(30) default NULL,
  `korp` varchar(10) default NULL,
  `S_Peg` varchar(10) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "t_daftarpersonil"
#

/*!40000 ALTER TABLE `t_daftarpersonil` DISABLE KEYS */;
INSERT INTO `t_daftarpersonil` VALUES 
('Yasir Handoyo, Amd','Pengatur Tk.I II/d','198501072006041001','','Pengatur Tk.I II/d','Tek','PNS'),
('Eka Yunita Sari','PHL','042007003','','','','PHL'),
('Anggoro Prasetyo, Amd','Serka Ttu','100723','','Serka','Ttu','MILITER'),
('Mukhamad Saiful Bahri','Pengatur Tk.I II/d','197307261998031003','','Pengatur Tk.I II/d','Min','PNS'),
('Fahrudin Priyo Admojo','Kopda Ttu','101884','','Kopda','Ttu','MILITER'),
('Subiyanto','Sertu Jas','078972','','Sertu','Jas','MILITER');