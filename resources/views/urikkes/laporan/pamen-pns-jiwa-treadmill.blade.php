<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Laporan Pemeriksaan Pamen dan PNS Golongan IV Jiwa dan Treadmill</title>
	<style type="text/css">
	body,th,td{
		font-family: sans-serif;
		font-size: 12px;
	}
	table
	{
		width: 100vw; 
		page-break-inside:avoid; 
		border-collapse: collapse;
	}
	.border-bottom
	{
		border-bottom: 1px solid black; 
	}
	hr
	{
		border: none;
		height: 1px;
		/* Set the hr color */
		color: #333; /* old IE */
		background-color: #333; /* Modern Browsers */
	}
	.text-center
	{
		text-align: center;
	}
	.py-10
	{
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.py-30
	{
		padding-top: 30px;
		padding-bottom: 30px;
	}
	table.border th{
		border:solid 1px #000;
	}
	table.border td{
		border-right: solid 1px #000;
		border-left: solid 1px #000;
	}
	table.border th, table.border td{
		padding:1px 5px;
	}
	tr.border-bottom td{ 
		border-bottom: solid 1px #000 
	}
</style>
</head>

<body>
	<table autosize="1">
		<tr>
			<td style="width: 18.5%;" class="text-center">{{config('app.name')}}</td>
			<td style="width: 40.5%; "></td>
			<td style="width: 20%; ">{{$judul}}</td>
		</tr>
		<tr>
			<td class="text-center"></td>
			<td></td>
			<td>Nomor {{$no_surat}}</td>
		</tr>
		<tr>
			<td><hr></td>
			<td></td>
			<td>Tanggal {{$tanggal}}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><hr></td>
		</tr>
	</table>

	<div class="text-center py-30">
		<h3>LAPORAN PAMEN DAN PNS GOL IV YANG MELAKSANAKAN URIKKES JIWA DAN TREADMILL TA {{$tanggal_min->format('Y')}}</h3>
	</div>

	<table class="border">
		<tr class="text-center">
			<th>No</th>
			<th>Nama</th>
			<th>Pangkat/Gol</th>
			<th>NRP/NIP</th>
			<th>Tanggal</th>
			<th>Treadmill</th>
			<th>Stakes Jiwa</th>
			<th>Kesatuan</th>
		</tr>
		<tr class="text-center">
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>6</th>
			<th>7</th>
			<th>8</th>
		</tr>
		@foreach($transaksi as $item)
		<tr @if($loop->last) class="border-bottom" @endif>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$item->pasien_detail->name}}</td>
			<td>{{$item->pasien_detail->tni_pangkat->nama}}</td>
			<td>{{$item->pasien_detail->tni_nrp}}</td>
			<td>{{$item->ordered_at->format('d/m/Y')}}</td>
			<td>{{$item->kasus->fisikUrikkes[0]->treadmill ?? '-'}}</td>
			<td class="text-center">{{$item->kasus->resumeUrikkes[0]->jiwa ?? '-'}}</td>
			<td>{{$item->pasien_detail->tni_kotama->nama ?? '-'}} / {{$item->pasien_detail->tni_satker->nama ?? '-'}} / {{$item->pasien_detail->tni_jabatan ?? '-'}}</td>
		</tr>
		@endforeach
	</table>
	<br><br>
	<table style="width: 100vw; page-break-inside:avoid; border-collapse: collapse;" autosize="1">
		<tr>
			<td style="width: 65%; border: 1px solid white; text-align: center"></td>
			<td style="width: 30%; border: 1px solid white; text-align: center">{{$dokter->sebagai}}</td>
			<td style="width: 5%; border: 1px solid white; text-align: center"></td>
		</tr>
		<tr>
			<td colspan="3" style="border: 1px solid white; color: white; font-size: 40px;">.</td>
		</tr>
		<tr>
			<td style="border: 1px solid white"></td>
			<td style="border: 1px solid white; text-align: center">{{$dokter->nama}}</td>
			<td style="border: 1px solid white"></td>
		</tr>
		<tr>
			<td style="border: 1px solid white"></td>
			<td style="border: 1px solid white; text-align: center">{{$dokter->keterangan}}</td>
			<td style="border: 1px solid white"></td>
		</tr>

	</table>
</body>
</html>



