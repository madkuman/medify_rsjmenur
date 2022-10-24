<!DOCTYPE html>
<html>
<head>
	<title>Print DPJP</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
		table{
			width: 100%;
		}
		.centered{
			text-align: center;
		}
		.bordered{
			border: 1px solid black;
		}
		.big{
			font-weight: bold;
			text-align: center;
			vertical-align: middle;
			font-size: 20px;
		}
		.bot-border{
			border-bottom: 1px solid black;
		}
		.right-border{
			border-right: 1px solid black;
		}
		.righted{
			text-align: right;
		}
		.dummy{
			font-size: 20px;
			color: white;
		}
</style>
</head>
<body>
	<table width="100%">
		<tr>
			<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
		</tr>
	</table>
	<br>
	<br>
	<table class="bordered">
		<tr>
			<td class="right-border big" rowspan="4" width="50%">ALIH DPJP</td>
			<td width="16%">No RM</td>
			<td width="34%">: {{$kasus->pasien->no_rm}}</td>
		</tr>
		<tr>
			<td>Nama Pasien</td>
			<td>: {{$kasus->pasien->name}}</td>
		</tr>
		<tr>
			<td>Tgl Lahir/Umur</td>
			<td>: {{$kasus->pasien->age}} Tahun</td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>: {{$kasus->pasien->jenis_kelamin}}</td>
		</tr>
	</table>

	<table class="bot-border">
		<tr>
			<td width="40%">Masuk RS Tgl : {{$tanggal_masuk}}</td>
			<td width="25%">Jam : {{$kasus->jam_masuk}}</td>
			<td width="35%">Ruangan : {{$kasus->lokasi->lokasi->nama}}</td>
		</tr>
	</table>

	<table>
		<tr>
			<td>Kepada Yth. TS :</td>
		</tr>
	</table>
	<br>

	<table>
		<tr>
			<td>Mohon bantuan sejawat, atas pasien ini untuk : Alih Rawat</td>
		</tr>
	</table>
	<br>

	<table>
		<tr>
			<td>Diagnosa Kerja :</td>
		</tr>
		<tr>
			<td style="white-space: pre-line;"></td>
		</tr>
	</table>
	<br><br>
	
	<table>
		<tr>
			<td>Keterangan klinik terpenting adalah :</td>
		</tr>
		<tr>
			<td style="white-space: pre-line;"></td>
		</tr>
	</table>
	<br><br>

	<table>
		<tr>
			<td width="60%"></td>
			<td width="40%" class="centered">{{$tanggal_sekarang}}, {{$jam_sekarang}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">DPJP</td>
		</tr>
		<tr>
			<td class="dummy" colspan="2">dummy</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$kasus->dpjp->user->name}}</td>
		</tr>
	</table>
	<hr><br>

	<table>
		<tr>
			<td class="centered big"><u>JAWABAN</u></td>
		</tr>
	</table>
	<br><br><br>
	<table>
		<tr>
			<td width="63%">Btk, Wass, Dr. : {{$user->name}}</td>
			<td width="37%">.............................. , ................</td>
		</tr>
	</table>
</body>
</html>