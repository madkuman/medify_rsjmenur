<!DOCTYPE html>
<html>
<style type="text/css">
html{
	padding: 0%;
	height: 100%;
}
body{
	font-size: 14px;
	height: 100%;
	font-family: sans-serif;
}
table{
	border-collapse: collapse;
	width: 100%;
}
td{
	vertical-align: middle;
	padding-top: 2px;
	padding-bottom: 2px;
}
.td-0{
	padding-top: 0px;
	padding-bottom: 0px;
}
.bordered{
	border: 1px solid black;
}
.pl-10{
	padding-left: 10px;
}

.table-title{
	padding-bottom: 5px;
	padding-top: 5px;
}
.bottom-border{
	border-bottom: 1px solid black;
}
.centered{
	text-align: center;
}
.no-bottom{
	border-top: none;
	border-left: 1px solid black;
	border-right: 1px solid black;
	border-bottom: none;
}
.title{
	font-size: 17px;
}
.orange-col{
	background-color: #ffc266;
}
.grey-col{
	background-color: #eaeae1;
}
.blue-col{
	background-color: #b3ffff;
}
.dummy{
	color: white;
	font-size: 2px;
}
.right{
	text-align: right;
}
.bold-bot{
	border-bottom: 2px solid black;	
}
.bot-only{
	border-bottom: 1px solid black
}

</style>
<head>
	<title>Laporan Kesegaran Jasmani TNI AL</title>
</head>
<body>
	<table>
		<tr>
			<td width="45%" class="centered">{{config('app.name')}}</td>
			<td width="55%" class="centered"></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered"><b>FORMULIR HASIL RIK UJI KESAMAPTAAN JASMANI</b></td>
		</tr>
		<tr>
			<td class="centered"><b>PRAJURIT TNI AL TAHUN 2018</b></td>
		</tr>
	</table>
	<br>
	<b>I. IDENTITAS</b>
	<div class="dummy">.</div>
	<table>
		<tr>
			<td width="4%" class="right">a.</td>
			<td width="17%">Nama</td>
			<td width="79%">: {{$pegawai->name}}</td>
		</tr>
		<tr>
			<td class="right">b.</td>
			<td>Pangkat Korps</td>
			<td>: {{$pegawai->pangkat}}/{{$pegawai->korps}}</td>
		</tr>
		<tr>
			<td class="right">c.</td>
			<td>Satker</td>
			<td>: {{$satker->nama}}</td>
		</tr>
		<tr>
			<td class="right">d.</td>
			<td>Jabatan</td>
			<td>: {{$pegawai->jabatan}}</td>
		</tr>
		<tr>
			<td class="right">e.</td>
			<td>Tempat/Tgl Lahir</td>
			<td>: {{$pegawai->birth_place}}/{{$tl}}</td>
		</tr>
		<tr>
			<td class="right">f.</td>
			<td>Umur</td>
			<td>: {{$pegawai->agejustyear}}</td>
		</tr>
		<tr>
			<td class="right">g.</td>
			<td>Keperluan</td>
			<td>: {{$keperluan}}</td>
		</tr>
	</table>
	<br>
	<b>II. PEMERIKSAAN</b>
	<div class="dummy">.</div>
	<table>
		<tr>
			<td width="4%" class="right">a.</td>
			<td width="26%">Tinggi dan Berat Badan</td>
			<td width="70%">: {{$tinggi}}/{{$berat}}</td>
		</tr>
		<tr>
			<td class="right">b.</td>
			<td>Klasifikasi Berat Badan</td>
			<td>: {{$klasifikasi_bb}}</td>
		</tr>
	</table>
	<br>
	<b>III. UJI DAN KESEGARAN JASMANI</b>
	<div class="dummy">.</div>
	<table>
		<tr>
			<td width="4%" class="right">a.</td>
			<td width="26%"> Kesegaran Jasmani "A"</td>
			<td width="50%">:  Lari 12 Menit Jarak Tempuh = {{$lari}}</td>
			<td width="10%" class="centered" rowspan="2"><b>Nilai</b></td>
			<td width="10%" class="bordered centered" rowspan="2"><b class="title">{{$nilai_lari}}</b></td>
		</tr>
		<tr>
			<td class="right">b.</td>
			<td> Kesegaran Jasmani "B"</td>
			<td>: {{$klasifikasi_garjasAB}} = {{$nilai_garjasAB}}</td>
		</tr>
	</table>
	<br>
	<table class="bordered pl-10" style="width: 600px;">
		<tr>
			<td class="bordered centered bold-bot" colspan="2" width="40%"><b>KEGIATAN</b></td>
			<td class="bordered centered bold-bot" width="20%"><b>JUMLAH</b></td>
			<td class="bordered centered bold-bot" width="15%"><b>T.SCORE</b></td>
		</tr>
		<tr>
			<td class="bordered pl-10" width="27%">1. (B1) Md Pull Up</td>
			<td class="bordered centered">1 Menit</td>
			<td class="bordered centered">{{$pullup}} Kali</td>
			<td class="bordered centered">{{$nilai_pullup}}</td>
		</tr>
		<tr>
			<td class="bordered pl-10" width="27%">2. (B2) Md Sit Up </td>
			<td class="bordered centered">1 Menit</td>
			<td class="bordered centered">{{$situp}} Kali</td>
			<td class="bordered centered">{{$nilai_situp}}</td>
		</tr>
		<tr>
			<td class="bordered pl-10" width="27%">3. (B3) Md Push Up</td>
			<td class="bordered centered">1 Menit</td>
			<td class="bordered centered">{{$pushup}} Kali</td>
			<td class="bordered centered">{{$nilai_pushup}}</td>
		</tr>
		<tr>
			<td class="bordered pl-10" width="27%">4. (B4) Shuttle Run</td>
			<td class="bordered centered">6 X 10 Meter</td>
			<td class="bordered centered">{{$shuttle}} Detik</td>
			<td class="bordered centered">{{$nilai_shuttle}}</td>
		</tr>
		<tr>	@php $total = $nilai_pushup + $nilai_situp + $nilai_shuttle + $nilai_pullup; @endphp
			<td class="bordered right" colspan="3">Jumlah T. Score = &nbsp;&nbsp;&nbsp;</td>
			<td class="bordered centered">{{$total}}</td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="70%" rowspan="2" class="right td-0">Rata-rata T.Score = &nbsp;&nbsp;&nbsp;</td>
			<td class="centered td-0 bot-only" width="15%">{{$total}}</td>
			<td width="15%" rowspan="2" class="centered td-0 pl-10"> = {{$total/4}}</td>
		</tr>
		<tr>
			<td class="centered td-0">4</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="4%" class="right">c.</td>
			<td width="96%"> Kesegaran Jasmani :</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="10%" rowspan="2" class="centered td-0">Nilai =</td>
			<td width="35%" class="centered bot-only td-0">T.Score "A" + T.Score rata rata "B"</td>
			<td width="5%" rowspan="2" class="centered td-0">=</td>
			<td width="15%" class="centered bot-only td-0">{{$nilai_lari}} + {{$total/4}}</td>
			<td width="5%" rowspan="2" class="centered td-0">=</td> @php $final = $nilai_lari + ($total/4); @endphp
			<td width="15%" class="centered bot-only td-0">{{$final}}</td>
			<td width="5%" rowspan="2" class="centered td-0">=</td>
			<td width="10%" class="bordered centered td-0" rowspan="2"><b class="title">{{$final/2}}</b></td>
		</tr>
		<tr>
			<td class="centered td-0">2</td>
			<td class="centered td-0">2</td>
			<td class="centered td-0">2</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="70%" class="dummy">.</td>
			<td width="20%" class="centered"><b>Kategori</b></td>
			<td width="10%" class="bordered centered" rowspan="2"><b class="title">{{$klasifikasi_garjasAB}}</b></td>
		</tr>
		<tr><td class="dummy">.</td></tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="50%"></td>
			<td width="50%" class="centered">Dikeluarkan di Surabaya</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">Pada tanggal 20 Februari 2018</td>
		</tr>
		<tr>
			<td></td>
			<td><hr style="width: 70%;"></td>
		</tr>
	</table>
	<table class="ttd-table" style="width: 100%">
	<tr>
		<td style="width: 50%"></td>
		<td style="white-space: pre; width: 50%;text-align: center;">{{$ttd->bagian_atas}}</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td></td>
		<td style="white-space: pre;text-align: center;">{{$ttd->bagian_bawah}}</td>
	</tr>
</table>
</body>
</html>