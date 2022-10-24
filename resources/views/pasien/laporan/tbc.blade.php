<!DOCTYPE html>
<html>
<head>
	<title>Laporan TBC</title>
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
</style>
</head>
<body>
	<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
	<hr style="width: 25%; margin-left: 0px;">
	
	<table>
		<tr>
			<td class="center" colspan="9">DAFTAR PENDERITA TBC TAHUN {{$tahun}}</td>
		</tr>
	</table>
	<br>

	<table>
		<tr>
			<td colspan="2">RUMAH SAKIT</td>
			<td >: {{config('app.name')}}</td>
		</tr>
		<tr>
			<td colspan="2">BULAN</td>
			<td>: {{$date_start}} - {{$date_end}}</td>
		</tr>
	</table>

	<table>
		<thead>
			<tr>
				<th class="bordered title" rowspan="3" style="width: 3%">NO</th>
				<th class="bordered title" rowspan="3" style="width: 7%">NIK</th>
				<th class="bordered title" rowspan="3" style="width: 23%">NAMA</th>
				<th class="bordered title" rowspan="3" style="width: 27%">ALAMAT</th>
				<th class="bordered title" rowspan="3" style="width: 8%">UMUR (Th)</th>
				<th class="bordered title" colspan="4" style="width: 32%; font-size: 14px;">
					CAKUPAN PELAYANAN KESEHATAN PENDERITA TBC SESUAI STANDAR (termasuk HbA1c)
				</th>
			</tr>
			<tr>
				<th class="bordered title" colspan="2">YA</th>
				<th class="bordered title" colspan="2">TIDAK</th>
			</tr>
			<tr>
				<th class="bordered title">L</th>
				<th class="bordered title">P</th>
				<th class="bordered title">L</th>
				<th class="bordered title">P</th>
			</tr>	
		</thead>
		<tbody>
			@php $i = 1; @endphp
			@foreach($tbc as $item)
			<tr>
				<td class="bordered center">{{$i}}</td>
				<td class="bordered center">{{$item->pasien->no_identitas or '-'}}</td>
				<td class="bordered">{{$item->pasien->name}}</td>
				<td class="bordered">{{$item->pasien->address or '-'}}</td>
				<td class="bordered center">{{$item->identitas->age}}</td>
				<td class="bordered center">
					@if($item->pasien->gender == 1 && $item->hba1c == 1)
					X
					@endif
				</td>
				<td class="bordered center">
					@if($item->pasien->gender == 2 && $item->hba1c == 1)
					X
					@endif
				</td>
				<td class="bordered center">
					@if($item->pasien->gender == 1 && $item->hba1c == 0)
					X
					@endif
				</td>
				<td class="bordered center">
					@if($item->pasien->gender == 2 && $item->hba1c == 0)
					X
					@endif
				</td>
			</tr>
			@php $i++; @endphp
			@endforeach
		</tbody>
	</table>
</body>
</html>