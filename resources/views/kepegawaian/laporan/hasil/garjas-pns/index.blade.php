<!DOCTYPE html>
<html>
<style type="text/css">
html{
	padding: 0%;
	height: 100%;
}
body{
	font-size: 16px;
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
	font-size: 19px;
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
.square{
	padding: 10px;
	padding-left: 20px;
	margin:10px 0px;
}
.mid-table{
	margin: 0 auto;
	width: 50%;
	border: 1px solid black;
}

</style>
<head>
	<title>Laporan Kesegaran Jasmani PNS</title>
</head>
<body>
	<table>
		<tr>
			<td width="45%" class="centered">{{config('app.name')}}</td>
			<td width="30%" class="centered"></td>
			<td width="12%">TEST</td>
			<td width="13%">: Rutin</td>
		</tr>
		<tr>
			<td class="bottom-border centered"></td>
			<td></td>
			<td>PERIODE</td>
			<td>: Periode I</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered title"><b>KARTU KESEGARAN JASMANI TNI</b></td>
		</tr>
		<tr>
			<td class="centered title"><b>ANGGOTA PNS TNI ANGKATAN LAUT</b></td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="20%">Kelompok Umur</td>
			<td width="80%">: {{$kategori_umur}}</td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>: {{$pegawai->gender or '-'}}</td>
		</tr>
	</table>
	
	<div class="bordered square">
		<table>
			<tr>
				<td width="23%">Nama</td>
				<td width="77%">: {{$pegawai->name or '-'}}</td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td>: {{$pegawai->birth_place}}</td>
			</tr>
		</table>
	</div>
	
	<table>
		<tr>
			<td width="20%">TANGGAL</td>
			<td width="20%">: {{$tgl_lahir}}</td>
			<td width="15%">BULAN</td>
			<td width="15%">: {{$bln_lahir}}</td>
			<td width="15%">TAHUN</td>
			<td width="15%">: {{$thn_lahir}}</td>
		</tr>
		<tr>
			<td>GOL/KORP/NIP</td>
			<td colspan="5">: {{$pegawai->official_status or '-'}}/{{$pegawai->korp or '-'}}/{{$pegawai->nrp or '-'}}</td>
		</tr>
		<tr>
			<td>SATKER</td>
			<td colspan="5">: {{$satker}}</td>
		</tr>
		<tr>
			<td>JABATAN</td>
			<td colspan="5">: {{$pegawai->jabatan or '-'}}</td>
		</tr>
		<tr>
			<td>TINGGI</td>
			<td>: {{$tinggi}}</td>
			<td>BERAT</td>
			<td colspan="3">: {{$berat}}</td>
		</tr>
		<tr>
			<td>GOL. DARAH</td>
			<td colspan="5">: {{$pegawai->blood_type or '-'}}</td>
		</tr>
	</table>
	<br>
	<table class="mid-table">
		<tr>
			<td colspan="2" class="table-title bold-bot centered">LARI 2.400 METER</td>
		</tr>
		<tr>
			<td class="table-title pl-10 bold-bot">WAKTU</td>
			<td class="table-title bold-bot">: {{$waktu}}</td>
		</tr>
		<tr>
			<td class="table-title pl-10">NILAI</td>
			<td>: {{$nilai}}</td>
		</tr>
		<tr>
			<td class="table-title pl-10">KATEGORI</td>
			<td>: {{$kategori}}</td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td width="50%"></td>
			<td width="50%" class="centered">Dikeluarkan di Surabaya</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">Pada tanggal {{$tanggal}}</td>
		</tr>
		<tr>
			<td></td>
			<td><hr style="width: 70%;"></td>
		</tr>
	</table>
	@include('kepegawaian.laporan.hasil.components.ttd')
</body>
</html>