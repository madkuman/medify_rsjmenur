<!DOCTYPE html>
<html>
<head>
	<title>Tabel Daftar Pasien Rawat Inap</title>
	<style type="text/css">
	table{
		border-collapse: collapse;
		width: 100%;
		font-size: 11px;
		font-family: sans-serif;
		line-height: 250%;
	}
	.title{
		text-align: center;
		vertical-align: middle;
		font-size: 12px;
		font-weight: bold;
	}
	td
	{
		word-wrap: break-word;
	}
	.bordered{
		border: 1px solid black;
		padding-left: 3px;
		padding-right: 3px;
	}
	.center{
		text-align: center;
	}
	.subtitle{
		font-size: 12px;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="title">DAFTAR PASIEN RAWAT INAP</td>
		</tr>
	</table>
	<br>
	<b><u style="font-family: sans-serif;">Filter Berdasarkan</u></b>
	<table style="margin-top: 15px;">
		<tr>
			<td class="subtitle" style="width: 15%">Tipe Pembayaran </td>
			<td class="subtitle" style="width: 85%">: @if($tipe_pembayaran == "all") Semua Pembayaran @else {{$tipe_pembayaran}} @endif</td>	
		</tr>
		<tr>
			<td class="subtitle" style="width: 15%">Satker </td>
			<td class="subtitle" style="width: 85%">: @if($tni_satker == "all") Semua Satker @else {{$tni_satker}} @endif</td>	
		</tr>
	</table>
	<br>
	<table class="bordered">
		<thead>
			<tr>
				<th class="bordered center" style="width: 4%">NO</th>
				<th class="bordered" style="width:6%">NO RM</th>
				<th class="bordered" style="width:15%">NAMA</th>
				<th class="bordered" style="width:13%">PANGKAT/NRP/NIP</th>
				<th class="bordered" style="width:12%">KOTAMA/SATKER</th>
				<th class="bordered" style="width:7%">TANGGAL MRS</th>
				<th class="bordered" style="width:15%">DIAGNOSA</th>
				<th class="bordered" style="width:13%">RUANG RAWAT INAP</th>
				<th class="bordered" style="width:15%">DPJP</th>
			</tr>
		</thead>
		<tbody>
			@if(count($pasien) > 0)
			@php $i = 1; @endphp
			@foreach($pasien as $row)
			<tr>
				<td class="bordered center">{{$i}}</td>
				<td class="bordered">{{$row->pasien['no_rm']}}</td>
				<td class="bordered">{{$row->pasien['name']}}</td>
				<td class="bordered">
					@if($row->pasien->is_anggota)
					{{$row->pasien->tni_pangkat->nama ?? '-'}} / {{$row->pasien->tni_nrp ?? '-'}}
					@elseif($row->pasien->wali->is_anggota)
					{{$row->pasien->wali->tni_pangkat->nama ?? '-'}} / {{$row->pasien->wali->tni_nrp ?? '-'}}
					@endif
				</td>
				<td class="bordered">{{$row->pasien->tni_kotama->nama ?? '-'}}/{{$row->pasien->tni_satker->nama ?? '-'}}</td>
				<td class="bordered">{{$row->waktu_masuk->format('d/m/Y')}}</td>
				<td class="bordered">@if(!empty($row->kasus->diagnosisUtama->icd10->long_desc)) {{$row->kasus->diagnosisUtama->icd10->code_icd}} - {{$row->kasus->diagnosisUtama->icd10->long_desc}} @endif</td>
				<td class="bordered">{{$row->tempat_tidur->ruangan->bangsal['nama']}} - {{$row->tempat_tidur->ruangan['nama']}}</td>
				<td class="bordered">@if(!empty($row->kasus->admin->user->name)) {{$row->kasus->admin->user->name}} @endif</td>
			</tr>
			@php $i++; @endphp
			@endforeach
			@else
			<tr>
				<td class="bordered center" colspan="5">Tidak Ada Data</td>
			</tr>
			@endif
		</tbody>
	</table>
</body>
</html>