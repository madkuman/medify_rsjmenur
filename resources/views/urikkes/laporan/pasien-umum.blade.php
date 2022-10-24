<head>
	<title>Laporan Pasien Umum</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
	</style>
</head>

<body>
	<table style="width: 100vw; page-break-inside:avoid; border-collapse: collapse;" autosize="1">
		<tr>
			<td style="font-size: 12px; width: 24%; border: 1px solid white;  text-align: center">{{config('app.name')}}</td>
			<td style="font-size: 12px; width: 49%; border: 1px solid white;"></td>
			<td style="font-size: 12px; width: 27%; border: 1px solid white;">{{$judul}}</td>
		</tr>
		<tr>
			<td style="font-size: 12px; width: 24%; border: 1px solid white; border-bottom: 1px solid black; text-align: center"></td>
			<td style="font-size: 12px; width: 49%; border: 1px solid white; text-align: center"></td>
			<td style="font-size: 12px; width: 27%; border: 1px solid white;">Nomor {!! $no_surat !!}</td>
		</tr>
		<tr>
			<td style="font-size: 12px; width: 24%; border: 1px solid white;"></td>
			<td style="font-size: 12px; width: 49%; border: 1px solid white;"></td>
			<td style="font-size: 12px; width: 27%; border: 1px solid white; border-bottom: 1px solid black;">Tanggal {!! $tanggal !!}</td>
		</tr>
	</table>

	<br><br>

	<table style="width: 100vw; page-break-inside:avoid; border-collapse: collapse;" autosize="1">
		<tr>
			<td style="font-size: 15px; text-align: center; border: 1px solid white; text-decoration: underline;">HASIL UJI DAN PEMERIKSAAN KESEHATAN</td>
		</tr>
	</table>

	<br>

	<table style="width: 100vw; page-break-inside:avoid; border-collapse: collapse;" autosize="1">
		<tr>
			<td style="width: 23%; border: 1px solid white"></td>
			<td style="width: 25%; border: 1px solid white">PELAKSANA</td>
			<td style="width: 2%; border: 1px solid white">:</td>
			<td style="width: 33%; border: 1px solid white">{{config('app.name')}}</td>
			<td style="width: 17%; border: 1px solid white"></td>
		</tr>
		<tr>
			<td style="width: 23%; border: 1px solid white"></td>
			<td style="width: 25%; border: 1px solid white">TAHUN ANGGARAN</td>
			<td style="width: 2%; border: 1px solid white">:</td>
			<td style="width: 33%; border: 1px solid white">{{$date}}</td>
			<td style="width: 17%; border: 1px solid white"></td>
		</tr>	
	</table>

	<br>

	<table style="width: 100vw; border-collapse: collapse;" autosize="1">
		<tr>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 2%">No</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 13%">Nama Pasien</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 7%">Tgl.Lahir</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 8%">Pangkat/Gol NRP/NIP</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 8%">Kesatuan/ Jabatan</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 7%">Tgl.Urikkes</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">BB (Kg)</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">TB (cm)</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 4%">Gol dar</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 2%">U</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 2%">A</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 2%">B</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 2%">D</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 2%">L</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 2%">G</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 2%">J</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 5%">Stakes</td>
			<td style="text-align: center; font-size: 12px; border: 1px solid black; width: 16%">Keterangan</td>
		</tr>
		<tr>
			<?php for($i=0;$i<18;$i++) { ?>
			<td style="text-align: center; font-size: 12px; border: 1px solid black">{{$i+1}}</td>
			<?php } ?>
		</tr>
		@php($last_satker = "")
		@foreach($transaksi as $item)
		<tr>
			<td style="padding-left: 5px; padding-right: 5px; font-size: 12px; border: 1px solid black; width: 2%">{{$loop->iteration}}</td>
			<td style="padding-left: 5px; padding-right: 5px; font-size: 12px; border: 1px solid black; width: 13%">{{$item->pasien_detail->name}}</td>
			<td style="padding-left: 5px; padding-right: 5px; font-size: 12px; border: 1px solid black; width: 7%">{{date("d-m-Y", strtotime($item->pasien_detail->date_of_birth))}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 8%">-<br>{{$item->pasien_detail->tni_nrp}}</td>
			<td style="padding-left: 5px; padding-right: 5px; font-size: 12px; border: 1px solid black; width: 8%">-</td>
			<td style="padding-left: 5px; padding-right: 5px; font-size: 12px; border: 1px solid black; width: 7%">{{!is_null($item->created_at) ? date("d-m-Y", strtotime($item->created_at->toDateString())) : '-'}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 4%">{{$item->kasus->identitas->berat_badan}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 4%">{{$item->kasus->identitas->tinggi_badan}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 4%">{{$item->kasus->identitas->golongan_darah}}</td>
			@if(count($item->kasus->resumeUrikkes)!=0)
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%">{{$item->kasus->resumeUrikkes->first()->u}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%">{{$item->kasus->resumeUrikkes->first()->a}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%">{{$item->kasus->resumeUrikkes->first()->b}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%">{{$item->kasus->resumeUrikkes->first()->d}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%">{{$item->kasus->resumeUrikkes->first()->l}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%">{{$item->kasus->resumeUrikkes->first()->g}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%">{{$item->kasus->resumeUrikkes->first()->j}}</td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 5%">{{$item->kasus->resumeUrikkes->first()->stakes}}</td>
			<td style="padding-left: 5px; padding-right: 5px; font-size: 12px; border: 1px solid black; width: 16%">{!! nl2br($item->kasus->resumeUrikkes->first()->resume) !!}</td>
			@else
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%"></td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%"></td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%"></td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%"></td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%"></td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%"></td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 2%"></td>
			<td style="padding-left: 5px; padding-right: 5px; text-align: center; font-size: 12px; border: 1px solid black; width: 5%"></td>
			<td style="padding-left: 5px; padding-right: 5px; font-size: 12px; border: 1px solid black; width: 16%"></td>
			@endif
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
			<td colspan="3" style="border: 1px solid white; color: white; font-size: 40px;">&nbsp;</td>
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