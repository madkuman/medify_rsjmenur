<!DOCTYPE html>
<html>
<head>
	<title>Laporan Diabetes</title>
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
		<td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
	</tr>
</table>
	<hr style="width: 25%; margin-left: 0px;">
	
	<table>
		<tr>
			<td class="center">DAFTAR PENDERITA DIABETES MELITUS</td>
		</tr>
	</table>
	<br>

	<table>
		<tr>
			<td style="width: 10%">RUMAH SAKIT</td>
			<td style="width: 90%">: {{config('app.name')}}</td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: {{$start->format('d-m-Y')}} s/d {{$end->format('d-m-Y')}}</td>
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
				<th class="bordered title" colspan="4" style="width: 32%">
					CAKUPAN PELAYANAN KESEHATAN PENDERITA DM SESUAI STANDAR (termasuk HbA1c)
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
			@foreach($diabetes as $item)
			<tr>
				<td class="bordered center">{{$i}}</td>
				<td class="bordered center">{{$item->kasus->pasien->no_identitas or '-'}}</td>
				<td class="bordered">{{$item->kasus->pasien->name}}</td>
				<td class="bordered">{{$item->kasus->pasien->address or '-'}}</td>
				<td class="bordered center">{{$item->kasus->pasien->age}}</td>
				<td class="bordered center"></td>
				<td class="bordered center"></td>
				<td class="bordered center"></td>
				<td class="bordered center"></td>
			</tr>
			@php $i++; @endphp
			@endforeach
		</tbody>
	</table>
</body>
</html>