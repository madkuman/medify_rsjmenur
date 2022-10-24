<!DOCTYPE html>
<html>
<head>
	<title>Laporan Peserta Meninggal Dunia BPJS</title>
	<style type="text/css">
	table{
		border-collapse: collapse;;
		width: 100vw;
	}
	.title{
		text-align: center;
		vertical-align: middle;
	}
	.bordered{
		border: 1px solid black;
	}
	.center{
		text-align: center;
	}
	.bold{
		font-weight: bold;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="center bold">LAPORAN PESERTA MENINGGAL DUNIA BPJS PADA FASILITAS KESEHATAN {{config('app.name')}}</td>
		</tr>
		<tr>
			<td class="center bold">{{$start->format('d M Y')}} - {{$end->format('d M Y')}}</td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td class="center title bordered" width="4%">No</td>
			<td class="center title bordered" width="14%">No Kartu</td>
			<td class="center title bordered" width="10%">Segmen<br>Peserta</td>
			<td class="center title bordered" width="20%">NIK</td>
			<td class="center title bordered" width="20%">Nama Peserta</td>
			<td class="center title bordered" width="9%">Tanggal Meninggal</td>
			<td class="center title bordered" width="10%">No Surat<br>Ket Meninggal</td>
			<td class="center title bordered" width="13%">Keterangan</td>
		</tr>
		@forelse($data as $kasus)
		<tr>
			<td class="bordered">{{$loop->iteration}}</td>
			<td class="bordered">{{$kasus->pembayaran->no_asuransi ?? "-"}}</td>
			<td class="bordered">{{$kasus->pembayaran->perusahaan->nama ?? "-"}}</td>
			<td class="bordered">{{$kasus->pasien->no_identitas ??  '-'}}</td>
			<td class="bordered">{{$kasus->pasien->name ?? "-"}}</td>
			<td class="bordered">{{$kasus->krs_at->format('Y-m-d') ?? "-"}}</td>
			<td class="bordered"></td>
			<td class="bordered"></td>
		</tr>
		@empty
		@endforelse
	</table>
</body>