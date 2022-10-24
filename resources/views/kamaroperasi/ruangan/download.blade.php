<!DOCTYPE html>
<html>
<head>
	<title>Tabel Jadwal Permintaan Operasi</title>
	<style type="text/css">
	table{
		border-collapse: collapse;
		width: 100vw;
		font-size: 13px;
	}
	.title{
		text-align: center;
		vertical-align: middle;
		font-size: 20px;
		font-weight: bold;
	}
	.bordered{
		border: 1px solid black;
		padding-left: 5px;
		padding-right: 5px;
	}
	.center{
		text-align: center;
	}
	.subtitle{
		font-size: 16px;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="title">JADWAL PERMINTAAN OPERASI</td>
		</tr>
	</table>
	<br>
	<b><u>Filter Berdasarkan</u></b>
	<table style="margin-top: 15px;">
		<tr>
			<td class="subtitle" style="width: 15%">Dokter </td>
			<td class="subtitle" style="width: 85%">: @if($dokter == "all") Semua Dokter @else {{$dokter_obj->name ?? '-'}} @endif</td>	
		</tr>
		<tr>
			<td class="subtitle" style="width: 15%">Spesialis </td>
			<td class="subtitle" style="width: 85%">: @if($jenis_spesialis == "all") Semua Spesialis @else {{$jenis_spesialis_obj->nama ?? '-'}} @endif</td>	
		</tr>
		<tr>
			<td class="subtitle" style="width: 15%">Kamar Operasi </td>
			<td class="subtitle" style="width: 85%">: @if($kamar_operasi == "all") Semua Kamar Operasi @else {{$kamar_operasi}} @endif</td>	
		</tr>
		<tr>
			<td class="subtitle" style="width: 15%">Rentang Tanggal </td>
			<td class="subtitle" style="width: 85%">: {{$tanggal_min}} - {{$tanggal_max}}</td>	
		</tr>
	</table>
	<br>
	<table class="bordered">
		<thead>
			<tr>
				<th class="bordered center" style="width: 4%">No</th>
				<th class="bordered" style="width: 13%;">Identitas Pasien</th>
				<th class="bordered" style="width: 3%;">JK</th>
				<th class="bordered" style="width: 5%;">Usia</th>
				<th class="bordered" style="width: 11%">Asal Pelayanan</th>
				<th class="bordered" style="width: 10%">Jenis Pasien</th>
				<th class="bordered" style="width: 7%">Kamar OK</th>
				<th class="bordered" style="width: 5%">Ronde</th>
				<th class="bordered" style="width: 12%">Dokter</th>
				<th class="bordered" style="width: 12%">Diagnosis</th>
				<th class="bordered" style="width: 8%">Status</th>
				<th class="bordered" style="width: 10%">Dijadwalkan Oleh</th>
			</tr>
		</thead>
		<tbody>
			@if(count($jadwal) > 0)
			@php $i = 1; @endphp
			@foreach($jadwal as $j)
			<tr>
				<td class="bordered center" style="widtd: 5%">{{$i}}</td>
				<td class="bordered" style="width: 10%">{{$j->pasien_detail->name}}</td>
				<td class="bordered" style="width: 2%">{{$j->pasien_detail->jenis_kelamin_lp}}</td>
				<td class="bordered" style="width: 3%">{{$j->pasien_detail->detailed_age_short}}</td>
				<td class="bordered" style="width: 7%">{{$j->kasus->lokasi->lokasi->nama}}</td>
				<td class="bordered" style="width: 8%">{{$j->kasus->pembayaran->perusahaan->tipe->nama}} - {{$j->kasus->pembayaran->perusahaan->nama}}</td>
				<td class="bordered" style="width: 7%">{{$j->ruangan->name}}</td>
				<td class="bordered" style="width: 5%">{{$j->nomor_ronde}}</td>
				<td class="bordered" style="width: 15%">{{$j->dokter->name}}</td>
				<td class="bordered" style="width: 15%">{{$j->diagnosis}}</td>
				<td class="bordered" style="width: 8%">@if($j->status == 1) Selesai @else Perencanaan @endif</td>
				<td class="bordered" style="width: 15%">@if(!empty($j->dijadwalkan_oleh)) {{$j->pembuat_jadwal->name}} @else - @endif</td>
			</tr>
			@php $i++; @endphp
			@endforeach
			@else
			Tidak ada data
			@endif
		</tbody>
	</table>
</body>
</html>