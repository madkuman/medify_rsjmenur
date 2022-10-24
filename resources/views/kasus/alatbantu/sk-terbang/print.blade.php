<!DOCTYPE html>
<html>
<head>
	<title>Surat Keterangan Izin Terbang</title>
	<style type="text/css">
	@page{
		margin: 40px 50px;
	}
	body{
		font-family: sans-serif;
		font-size: 16px;
	}
	table{
		border-collapse: collapse;
		width: 100%
	}
	.bot{
		border-bottom: 1px solid black;
	}
	.centered{
		text-align: center;
	}
	.logo{
		height: 125px;
		margin-bottom: 10px;
	}
	.dummy{
		font-size: 50px;
		color: white;
	}
	.ml-25{
		margin-left: 25px;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="centered" width="45%">{{config('app.name')}}</td>
			<td></td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<td class="centered">
				<img class="logo" src="{{url('assets/img')}}/jalasveva2.png">
			</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered">Surat Keterangan</td>
		</tr>
		<tr>
			<td class="centered">Nomor : Sket / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / 2019</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td>Yang bertanda tangan dibawah ini menerangkan :</td>
		</tr>
	</table>
	<br>
	<table class="ml-25">
		<tr>
			<td width="20%">Nama</td>
			<td>: {{$kasus->pasien->name}}</td>
		</tr>
		<tr>
			<td>No. RM</td>
			<td>: {{$kasus->pasien->no_rm_formatted}}</td>
		</tr>
		<tr>
			<td>Umur</td>
			<td>: {{$kasus->pasien->age}} Tahun</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>: {{$kasus->pasien->address}}</td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td>Menerangkan dengan sebenarnya bahwa dengan kondisi pasien tersebut di atas saat ini dinyatakan layak terbang dengan Commercial Flight</td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td>Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.</td>
		</tr>
	</table>
	<br><br><br><br>
	<table>
		<tr>
			<td width="40%" class="centered">Mengetahui,</td>
			<td width="20%"></td>
			<td width="40%" class="centered">Surabaya, {{indonesian_date(date("Y/m/d"))}}</td>
		</tr>
		<tr>
			<td class="centered">a.n Kepala {{config('app.name')}}</td>
			<td class="centered"></td>
			<td class="centered">Dokter yang merawat</td>
		</tr>
		<tr>
			<td class="centered">Waka</td>
			<td class="centered"></td>
			<td class="centered"></td>
		</tr>
		<tr>
			<td class="centered dummy">.</td>
			<td class="centered dummy">.</td>
			<td class="centered dummy">.</td>
		</tr>
	</table>
</body>
</html>