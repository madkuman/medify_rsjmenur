<!DOCTYPE html>
<html>
<head>
	<title>Surat Keterangan Dirawat</title>
	<style type="text/css">
	@page{
		margin: 20px 30px;
	}
	body{
		font-family: sans-serif;
		font-size: 14px;
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
		height: 75px;
		margin-bottom: 10px;
	}
	.dummy{
		font-size: 30px;
		color: white;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="centered" width="55%">{{config('app.name')}}</td>
			<td></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered">
				<img class="logo" src="{{url('assets/img')}}/jalasveva2.png">
			</td>
		</tr>
		<tr>
			<td class="centered">SURAT KETERANGAN DIRAWAT</td>
		</tr>
		<tr>
			<td class="centered"><i>CERTIFICATE OF HOSPITALIZED</i></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered">Nomor : Sket / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / 2019</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td>Yang bertanda tangan dibawah ini menerangkan :</td>
		</tr>
		<tr>
			<td><i>The Undsigned Explained</i></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="40%">Nomor Rekam Medis (<i>MR</i>)</td>
			<td>: {{$kasus->pasien->no_rm_formatted}}</td>
		</tr>
		<tr>
			<td>Ruangan (<i>Room</i>)</td>
			<td>: {{$kasus->lokasi->lokasi->nama}}</td>
		</tr>
		<tr>
			<td>Nama (<i>Name</i>)</td>
			<td>: {{$kasus->pasien->name}}</td>
		</tr>
		<tr>
			<td>Jenis Kelamin (<i>Sex</i>)</td>
			<td>: {{$kasus->pasien->gender == 1 ? 'Laki laki' : 'Perempuan' }}</td>
		</tr>
		<tr>
			<td>Umur (<i>Age</i>)</td>
			<td>: {{$kasus->pasien->age}}</td>
		</tr>
		<tr>
			<td>Pekerjaan (<i>Occupation</i>)</td>
			<td>: {{$kasus->pasien->job}}</td>
		</tr>
		<tr>
			<td>Alamat (<i>Address</i>)</td>
			<td>: {{$kasus->pasien->address}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td>Telah menjalani perawatan dari tanggal {{indonesian_date(date('d-F-Y',strtotime($kasus->created_at)))}} s/d {{indonesian_date(date('d-F-Y',strtotime($kasus->krs_at ?? $today)))}}</td>
		</tr>
		<tr>
			<td><i>Has been hospitalized in {{config('app.name')}} from {{date('d F Y',strtotime($kasus->created_at))}} until {{date('d F Y',strtotime($kasus->krs_at ?? $today))}}</i></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td>Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.</td>
		</tr>
		<tr>
			<td><i>This letter is created to be used as intended.</i></td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<td width="50%"></td>
			<td class="centered">a.n. Kepala {{config('app.name')}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">Kepala Bagian Minmed,</td>
		</tr>
		<tr>
			<td colspan="2" class="dummy">.</td>
		</tr>
	</table>

</body>
</html>