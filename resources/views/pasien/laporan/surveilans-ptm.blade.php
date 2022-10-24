<!DOCTYPE html>
<html>
<head>
	<title>Laporan Surveilans</title>
	<style type="text/css">
	@page { 
		margin: 15px;
		margin-top: 30px; 
	}
	body { 
		margin: 0px; 
	}
	table{
		border-collapse: collapse;;
		width: 100%;
		font-size: 8px;
	}
	.big-title{
		text-align: center;
		font-weight: bold;
		font-size: 12px;
	}
	.title{
		text-align: center;
		font-weight: bold;
		vertical-align: middle;
		background-color: #ccff99
	}
	.bordered{
		border: 1px solid black;
	}
	.center{
		text-align: center;
	}
	.total{
		background-color: #9999ff;
		font-weight: bold;
		text-align: center; 
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="big-title" colspan="10">SURVEILANS KASUS PTM DARI KAB/KOTA</td>
		</tr>
		<tr>
			<td class="big-title" colspan="10">RUMAH SAKIT {{config('app.name')}} ({{$surveilans_type}})</td>
		</tr>
	</table>
	<table>
		<tr>
			<td style="width: 3%; font-weight: bold;" colspan="2">Provinsi</td>
			<td style="width: 10%; font-weight: bold">: </td>
		</tr>
		<tr>
			<td style="width: 3%; font-weight: bold;" colspan="2">Kab/Kota</td>
			<td style="width: 10%; font-weight: bold">: </td>
		</tr>
		<tr>
			<td style="width: 3%; font-weight: bold;" colspan="2">Tanggal</td>
			<td style="width: 20%; font-weight: bold">: {{$start}} - {{$end}}</td>
		</tr>
	</table>
	<table>
		<tr>
			<td class="bordered title" rowspan="4">NO</td>
			<td class="bordered title" rowspan="4" style="width: 10%">NAMA PENYAKIT</td>
			<td class="bordered title" rowspan="4" style="width: 5%">ICD-X</td>
			<td class="bordered title" colspan="48">JUMLAH PENDERITA MENURUT GOLONGAN UMUR</td>
			<td class="bordered title" rowspan="2" colspan="6">ICD-X</td>
			<td class="bordered title" rowspan="4">TOTAL</td>
		</tr>
		<tr>
			<td class="bordered title" colspan="4">0-7 hari</td>
			<td class="bordered title" colspan="4">8-28 hari</td>
			<td class="bordered title" colspan="4">>29-1 tahun</td>
			<td class="bordered title" colspan="4">1-4 tahun</td>
			<td class="bordered title" colspan="4">5-9 tahun</td>
			<td class="bordered title" colspan="4">10-14 tahun</td>
			<td class="bordered title" colspan="4">15-19 tahun</td>
			<td class="bordered title" colspan="4">20-44 tahun</td>
			<td class="bordered title" colspan="4">45-54 tahun</td>
			<td class="bordered title" colspan="4">55-59 tahun</td>
			<td class="bordered title" colspan="4">60-69 tahun</td>
			<td class="bordered title" colspan="4">70+ tahun</td>
		</tr>
		<tr>
			<?php for($i=0;$i<13;$i++) { ?>
			<td class="bordered title" colspan="2">L</td>
			<td class="bordered title" colspan="2">P</td>
			<?php } ?>
			<td class="bordered title" rowspan="2">L</td>
			<td class="bordered title" rowspan="2">P</td>
		</tr>
		<tr>
			<?php for($i=0;$i<26;$i++) { ?>
			<td class="bordered title">Ba ru</td>
			<td class="bordered title">La ma</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">1</td>
			<td class="bordered">Hipertensi</td>
			<td class="bordered center">I10</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[0][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">2</td>
			<td class="bordered">Penyakit jantung koroner</td>
			<td class="bordered center">I24.0</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[1][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">3</td>
			<td class="bordered">Gagal Jantung</td>
			<td class="bordered center">I50</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[2][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">4</td>
			<td class="bordered">PPOK</td>
			<td class="bordered center">J44</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[3][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">5</td>
			<td class="bordered">Stroke</td>
			<td class="bordered center">I64</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[4][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">6</td>
			<td class="bordered">Diabetes Melitus Tipe 1</td>
			<td class="bordered center">E10 (E10.0-9)</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[5][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">7</td>
			<td class="bordered">Diabetes Melitus Tipe 2</td>
			<td class="bordered center">E11 (E11.0-9)</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[6][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">8</td>
			<td class="bordered">Diabetes Melitus Gestasional</td>
			<td class="bordered center">O24 (O24.1-9)</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[7][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">9</td>
			<td class="bordered">DM-TB</td>
			<td class="bordered center"></td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[8][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">10</td>
			<td class="bordered">Obesitas</td>
			<td class="bordered center">E66</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[9][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">11</td>
			<td class="bordered">Penyakit Tiroid</td>
			<td class="bordered center">E00</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[10][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">12</td>
			<td class="bordered">Hipotiroid</td>
			<td class="bordered center">E03(E03.0-9)</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[11][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">13</td>
			<td class="bordered">Hipertiroid</td>
			<td class="bordered center">E05(E05.0-9)</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[12][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">14</td>
			<td class="bordered">Hipertropi Prostat</td>
			<td class="bordered center"></td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[13][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">15</td>
			<td class="bordered">Asma Bronkiale</td>
			<td class="bordered center">J45(J45+J45.9)</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[14][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">16</td>
			<td class="bordered">SLE / Lupus</td>
			<td class="bordered center">M32</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[15][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">17</td>
			<td class="bordered">Thalasemia</td>
			<td class="bordered center">D56</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[16][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">18</td>
			<td class="bordered">Osteoporosis</td>
			<td class="bordered center">M81</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[17][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">19</td>
			<td class="bordered">Ginjal Kronik</td>
			<td class="bordered center">N00-N19</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[18][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">20</td>
			<td class="bordered">Rematoid Artritis</td>
			<td class="bordered center">M05.9</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[19][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">21</td>
			<td class="bordered">Leukimia</td>
			<td class="bordered center">C91-C95</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[20][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">22</td>
			<td class="bordered">Kanker Cerviks</td>
			<td class="bordered center">C53</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[21][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">23</td>
			<td class="bordered">Kanker Payudara</td>
			<td class="bordered center">C50</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[22][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">24</td>
			<td class="bordered">Tumor Payudara</td>
			<td class="bordered center">C50</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[23][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">25</td>
			<td class="bordered">Kanker Kolorektal</td>
			<td class="bordered center">D12</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[24][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">26</td>
			<td class="bordered">Cidera Akibat Terbakar</td>
			<td class="bordered center">X00-X19</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[25][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">27</td>
			<td class="bordered">Cidera Akibat Tenggelam</td>
			<td class="bordered center">W65-W74</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[26][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">28</td>
			<td class="bordered">Cidera Akibat Keracunan</td>
			<td class="bordered center">X-40-X49</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[27][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">29</td>
			<td class="bordered">Cidera Akibat Digigit Ular</td>
			<td class="bordered center">X20-X29</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[28][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">30</td>
			<td class="bordered">Cidera Akibat KLL</td>
			<td class="bordered center">V01-V99</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[29][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">31</td>
			<td class="bordered">Cidera Akibat Kekerasan</td>
			<td class="bordered center">X60-Y09</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[30][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">32</td>
			<td class="bordered">Cidera Akibat Jatuh</td>
			<td class="bordered center">W00-X59</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[31][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">33</td>
			<td class="bordered">Psoriasis Vulgaris</td>
			<td class="bordered center">L40.0</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[32][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">34</td>
			<td class="bordered">Retinoblastoma</td>
			<td class="bordered center">C69</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[33][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">35</td>
			<td class="bordered">Glaukoma</td>
			<td class="bordered center">H40-H42</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[34][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">36</td>
			<td class="bordered">OMSK</td>
			<td class="bordered center">H66(H66.0-9)</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[35][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">37</td>
			<td class="bordered">Gangguan Refraksi</td>
			<td class="bordered center">H52(H52.0-9)</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[36][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">38</td>
			<td class="bordered">Serumen Prop</td>
			<td class="bordered center">H.61.2</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[37][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">39</td>
			<td class="bordered">Katarak</td>
			<td class="bordered center">H25.2(H25.0-9)</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[38][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">40</td>
			<td class="bordered">NIHL</td>
			<td class="bordered center">H25.2</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[39][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">41</td>
			<td class="bordered">Presbicusis</td>
			<td class="bordered center">H.91.1</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[40][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">42</td>
			<td class="bordered">Tuli Kongential</td>
			<td class="bordered center">H.93</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[41][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">43</td>
			<td class="bordered">Penyakit Rongga Mulut</td>
			<td class="bordered center">K09,K10,K13,K14</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[42][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">44</td>
			<td class="bordered">Caries Gigi</td>
			<td class="bordered center">K02</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[43][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">45</td>
			<td class="bordered">Penyakit Pulpa dan Jaringan Periapikal</td>
			<td class="bordered center">K04</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[44][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="bordered center">46</td>
			<td class="bordered">Penyakit Gusi dan Jaringan Periapikal</td>
			<td class="bordered center">K05,K06</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="bordered center">{{$data[45][$i]}}</td>
			<?php } ?>
		</tr>
		<tr>
			<td class="total bordered" colspan="3">JUMLAH</td>
			<?php for($i=0;$i<55;$i++) { ?>
			<td class="total bordered">{{$data[46][$i]}}</td>
			<?php } ?>
		</tr>
	</table>
</body>
</html>