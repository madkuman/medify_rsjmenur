<!DOCTYPE html>
<html>
<head>
	<title>Laporan TBC</title>
	<style type="text/css">
		table{
			border-collapse: collapse;;
			width: 100%;
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
	</style>
</head>
<body>
	<table width="100%">
		<tr>
			<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td class="center"><h3>PENYISIRAN KASUS TB</h3></td>
		</tr>
	</table>
	<br>


	<table style="width: 100%;page-break-inside: auto">
		<thead>
			<tr>
				<th class="bordered title" style="width: 3%">NO</th>
				<th class="bordered title" style="width: 8%">TANGGAL KUNJUNGAN</th>
				<th class="bordered title" style="width: 7%">KODE ICD X</th>
				<th class="bordered title" style="width: 20%">DIAGNOSA</th>
				<th class="bordered title" style="width: 8%">NO RM</th>
				<th class="bordered title" style="width: 5%">LAMA / BARU</th>
				<th class="bordered title" style="width: 9%">NAMA PASIEN</th>
				<th class="bordered title" style="width: 15%">ALAMAT</th>
				<th class="bordered title" style="width: 3%">L / P</th>
				<th class="bordered title" style="width: 7%">UMUR (Th)</th>
				<th class="bordered title" style="width: 15%;">RUANGAN / KLINIK</th>
			</tr>
		</thead>
		<tbody>
			@php $i = 1; @endphp
			@foreach($kasus as $item)
			<tr>
				<td class="bordered center">{{$i}}</td>
				<td class="bordered center">{{$item->created_at->format('d/m/Y') ?? '-'}}</td>
				<td class="bordered">
					@foreach($item->diagnosis as $item_dx)
					{{$item_dx->icd10->code_icd ?? ''}}
					@if(!$loop->last) , @endif
					@endforeach
				</td>
				<td class="bordered">
					@foreach($item->diagnosis as $item_dx)
					{{$item_dx->icd10->long_desc ?? ''}}
					@if(!$loop->last) , @endif
					@endforeach
				</td>
				<td class="bordered">{{$item->pasien->no_rm or '-'}}</td>
				<td class="bordered center">{{$item->is_baru ? 'Baru' : 'Lama'}}</td>
				<td class="bordered">{{$item->pasien->name or '-'}}</td>
				<td class="bordered">{{$item->pasien->address or '-'}}, {{$item->pasien->alamat_kota->nama ?? '-'}}</td>
				<td class="bordered center">{{$item->pasien->gender == 1 ? 'L' : 'P'}}</td>
				<td class="bordered center">{{$item->identitas->age ?? '-'}}</td>
				<td class="bordered">{{$item->lokasi->lokasi->nama or '-'}}</td>
			</tr>
			@php $i++; @endphp
			@endforeach
		</tbody>
	</table>
</body>
</html>