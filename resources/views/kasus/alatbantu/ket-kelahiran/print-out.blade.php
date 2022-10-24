<!DOCTYPE html>
<html>
<head>
	<title>Surat Keterangan Kelahiran</title>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		width: 100%;
		font-size: 17px;
	}
	.title{
		font-weight: bold;
		text-align: center;
	}
	.centered{
		text-align: center;
	}
	.border-bot{
		border-bottom: 1px solid black;
	}
	.righted{
		text-align: right;
	}
	.dummy{
		font-size: 40px;
		color: white;
	}
	.my-50{
		margin-top: 60px;
		margin-bottom: 30px;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td width="50%" class="centered">{{config('app.name')}}</td>
			<td width="50%"></td>
		</tr>
		<tr>
			<td></td>
			<td class="righted">Nomor : {{$ket->no_pastur}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered title">SURAT KETERANGAN KELAHIRAN</td>
		</tr>
	</table>
	<br>
	<table class="gap-col">
		<tr>
			<td width="25%">Nama</td>
			<td width="45%">: {{$nama}}</td>
			<td width="10%">Usia Ibu</td>
			<td width="20%">: {{$usia_ibu}} tahun</td>
		</tr>
		<tr>
			<td>Istri Dari</td>
			<td>: {{$suami}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Pangkat/NRP/NIP</td>
			<td>: {{$ket->pangkat}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Kesatuan</td>
			<td>: {{$ket->kesatuan}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Telah melahirkan anak</td>
			<td>: {{$kelamin}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: {{indonesian_date($ket->tanggal)}}</td>
			<td>Jam</td>
			<td>: {{$ket->jam}}</td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp; {{config('app.name')}}</td>
			<td></td><td></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="40%"></td>
			<td width="20%"></td>
			<td width="40%">Surabaya,{{indonesian_date(time('d m Y'))}}</td>
		</tr>
		<tr>
			<td class="centered">Mengetahui :</td>
			<td></td>
			<td class="centered">Yang Menolong</td>
		</tr>
		<tr>
			<td class="centered">Dokter</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">&nbsp;</td>
		</tr>
		<tr>
			<td class="centered">{{!empty($ket->dokter->name) ? $ket->dokter->name : ''}}</td>
			<td></td>
			<td class="centered">{{!empty($ket->perawat->name) ? $ket->perawat->name : ''}}</td>
		</tr>
	</table>
	<div class="centered my-50">
		- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	</div>


	<table>
		<tr>
			<td width="50%" class="centered">{{config('app.name')}}</td>
			<td width="50%"></td>
		</tr>
		<tr>
			<td></td>
			<td class="righted">Nomor : {{$ket->no_pastur}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered title">SURAT KETERANGAN KELAHIRAN</td>
		</tr>
	</table>
	<br>
	<table class="gap-col">
		<tr>
			<td width="25%">Nama</td>
			<td width="45%">: {{$nama}}</td>
			<td width="10%">Usia Ibu</td>
			<td width="20%">: {{$usia_ibu}} tahun</td>
		</tr>
		<tr>
			<td>Istri Dari</td>
			<td>: {{$suami}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Pangkat/NRP/NIP</td>
			<td>: {{$ket->pangkat}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Kesatuan</td>
			<td>: {{$ket->kesatuan}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Telah melahirkan anak</td>
			<td>: {{$kelamin}}</td>
			<td></td><td></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: {{indonesian_date($ket->tanggal)}}</td>
			<td>Jam</td>
			<td>: {{$ket->jam}}</td>
		</tr>
		<tr>
			<td></td>
			<td>&nbsp; {{config('app.name')}}</td>
			<td></td><td></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="40%"></td>
			<td width="20%"></td>
			<td width="40%">Surabaya,{{indonesian_date(time('d m Y'))}}</td>
		</tr>
		<tr>
			<td class="centered">Mengetahui :</td>
			<td></td>
			<td class="centered">Yang Menolong</td>
		</tr>
		<tr>
			<td class="centered">Dokter</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">&nbsp;</td>
		</tr>
		<tr>
			<td class="centered">{{!empty($ket->dokter->name) ? $ket->dokter->name : ''}}</td>
			<td></td>
			<td class="centered">{{!empty($ket->perawat->name) ? $ket->perawat->name : ''}}</td>
		</tr>
	</table>
</body>
</html>