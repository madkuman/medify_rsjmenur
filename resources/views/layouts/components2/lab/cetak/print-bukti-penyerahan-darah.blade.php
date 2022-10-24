<!DOCTYPE html>
<html>
<head>
	<title>Bukti Penyerahan Darah</title>
	<style type="text/css">
	table{
		border-collapse: collapse;
		width: 100%;
		font-family: sans-serif;
		font-size: 12px;
	}
	.centered{
		text-align: center;
	}
	.bordered td{
		border: 1px solid black;
		padding-left: 5px;
		padding-right: 5px;
	}
	.bot{
		border-bottom: 1px solid black;
	}
	.big{
		text-align: center;
		font-size: 15px;
	}
	.dummy{
		color: white;
		font-size: 20px;
	}

</style>
</head>
<body>
	<table>
		<tr>
			<td class="big"><u><b>BUKTI PENYERAHAN DARAH</b></u></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="20%">Nomor Permintaan</td>
			<td width="40%">: {{$transaksi->id}}</td>
			<td width="20%">Ruangan</td>
			<td width="20%">: {{$transaksi->asal->nama}}</td>
		</tr>
		<tr>
			<td>Tanggal Permintaan</td>
			<td>: {{indonesian_date($transaksi->created_at)}}</td>
			<td>Status Pasien</td>
			<td>: </td>
		</tr>
		<tr>
			<td>Nama Pasien</td>
			<td>: {{$transaksi->pasien->name}}</td>
			<td>Umur</td>
			<td>: {{$transaksi->pasien->age}}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Rekam Medik</td>
			<td>: {{$transaksi->pasien->no_rm}}</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td>NO</td>
			<td>TGL/JAM</td>
			<td>NO KANTONG</td>
			<td>NO SLANG</td>
			<td>JENIS DARAH</td>
			<td>GOL DARAH</td>
			<td>RHESUS</td>
			<td>HASIL CROSS</td>
			<td>PEMBERI</td>
			<td>PENERIMA</td>
		</tr>
		@foreach($transaksi->hasil_transfusi as $id => $hasil)
		<tr>
			<td>{{$id+1}}</td>
			<td>{{indonesian_date($hasil->tanggal)}} / {{date('H:i', strtotime($hasil->jam))}}</td>
			<td>{{$hasil->no_kantong}}</td>
			<td>{{$hasil->no_slang}}</td>
			<td>{{$hasil->jenis_darah}}</td>
			<td>{{$hasil->gol_darah}}</td>
			<td>{{$hasil->rhesus}}</td>
			<td>{{$hasil->hasil_cross}}</td>
			<td>{{$hasil->pemberi}}</td>
			<td>{{$hasil->penerima}}</td>
		</tr>
		@endforeach
	</table>
	<br>
	<table>
		<tr>
			<td width="40%" class="centered">YANG MENGERJAKAN</td>
			<td width="20%" class="centered"></td>
			<td width="40%" class="centered" style="color: red"><u><b>PENTING</b></u></td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">.</td>
		</tr>
		<tr>
			<td class="centered" valign="bottom">(PMI)</td>
			<td></td>
			<td class="centered">NB : BUKTI PENYERAHAN DARAH HARUS DIBAWA PADA SAAT PENAMBILAN DARAH</td>
		</tr>
	</table>
</body>
</html>