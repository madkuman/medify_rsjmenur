<!DOCTYPE html>
<html>
<style type="text/css">
html{
	padding: 0%;
	height: 100%;
}
body{
	font-size: 17px;
	height: 100%;
	font-family: sans-serif;
}
table{
	border-collapse: collapse;
	width: 100%;
}
td{
	vertical-align: middle;
}
.bordered{
	border: 1px solid black;
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
	font-size: 21px;
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
	font-size: 8px;
}


</style>
<head>
	<title>Surat Keterangan</title>
</head>
<body>
	<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
	<br>
	<div style="align-content: center; text-align: center;">
		<div style="margin-bottom: 8px">
			<img src="{{asset('assets/img/jalasveva2.png')}}" width="16%">
		</div>
	</div>
	<br>
	<table>
		<tr>
			<td class="centered title">SURAT KETERANGAN</td>
		</tr>
		<tr>
			<td class="centered title">Nomor Sket/{{$nomor_sprin}}/II/2019</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="7%">1.</td>
			<td colspan="2">Yang bertanda tangan  di bawah ini :</td>
		</tr>
		<tr>
			<td></td>
			<td width="18%">Nama</td>
			<td width="75%">:{{$penandatangan->name}}</td>
		</tr>
		<tr>
			<td></td>
			<td>Pangkat/NRP</td>
			<td>:{{$penandatangan->pangkat}}/{{$penandatangan->nrp}}</td>
		</tr>
		<tr>
			<td></td>
			<td>Jabatan</td>
			<td>:{{$penandatangan->jabatan}}</td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">.</td>
		</tr>
		<tr>
			<td colspan="3">Menerangkan bahwa :</td>
		</tr>
		<tr>
			<td></td>
			<td>Nama</td>
			<td>:{{$pegawai->name}}</td>
		</tr>
		<tr>
			<td></td>
			<td>Pangkat/Korp</td>
			<td>:{{$pegawai->pangkat}}/{{$pegawai->korp}}</td>
		</tr>
		<tr>
			<td></td>
			<td>NRP/NIP</td>
			<td>:{{$pegawai->nrp}}</td>
		</tr>
		<tr>
			<td></td>
			<td>Jabatan</td>
			<td>:{{$pegawai->jabatan}}</td>
		</tr>
		<tr>
			<td></td>
			<td>Kesatuan</td>
			<td>:{{$kesatuan->nama}}</td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">.</td>
		</tr>
		<tr>
			<td colspan="3">Yang bersangkutan adalah benar - benar anggota {{config('app.name')}} terhitung mulai tanggal {{$aktif_mulai}} dan masih berdinas aktif sampai dengan sekarang.</td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">.</td>
		</tr>
		<tr>
			<td>2.</td>
			<td colspan="2">Surat keterangan ini sebagai persyaratan administrasi untuk Percobaan.</td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">.</td>
		</tr>
		<tr>
			<td>3.</td>
			<td colspan="2">Demikian surat keterangan ini di buat dan terimakasih atas perhatian.</td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<td width="50%"></td>
			<td width="50%" class="centered">Dikeluarkan di Surabaya</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">pada tanggal {{$tanggal}}</td>
		</tr>
		<tr>
			<td></td>
			<td><hr style="width: 70%;"></td>
		</tr>
	</table>
	@include('kepegawaian.laporan.hasil.components.ttd')
</body>
</html>