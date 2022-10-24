<!DOCTYPE html>
<html>
<head>
	<title>Laporan Kematian - Dinkes</title>
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
	<table width="100%">
	<tr>
		<td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
	</tr>
</table>
	<hr style="width: 27%; margin-left: 0px;">
	
	<table>
		<tr>
			<td class="center bold">Laporan Kematian Rumah Sakit</td>
		</tr>
	</table>
	<br>

	<table>
		<tr>
			<td style="width: 10%">Bulan</td>
			<td style="width: 90%">: {{$bulan}}</td>
		</tr>
	</table>
	<br>
	<table>
		<thead>
			<tr>
				<th class="bordered title" style="width: 3%">No.</th>
				<th class="bordered title" style="width: 12%">Tgl MRS</th>
				<th class="bordered title" style="width: 5%">Umur (Th)</th>
				<th class="bordered title" style="width: 5%">Sex</th>
				<th class="bordered title" style="width: 15%">Kode Penyakit</th>
				<th class="bordered title" style="width: 25%">Diagnosa Masuk</th>
				<th class="bordered title" style="width: 25%">Diagnosa Meninggal</th>
				<th class="bordered title" style="width: 10%">Tanggal Meninggal</th>
			</tr>	
		</thead>
		<tbody>
			@php $j = 1; @endphp
			@foreach($data as $item)
			<tr>
				<td class="bordered center">{{$j}}</td>
				<td class="bordered center">{{$item['mrs']}}</td>
				<td class="bordered center">{{$item['usia']}}</td>
				<td class="bordered center">{{$item['gender']}}</td>
				<td class="bordered center">{{$item['keterangan']}}</td>
				<td class="bordered center">{{$item['diagnosa_masuk']}}</td>
				<td class="bordered center">{{$item['diagnosa_meninggal']}}</td>
				<td class="bordered center">{{$item['krs']}}</td>
			</tr>
			@php $j++; @endphp
			@endforeach
		</tbody>
	</table>
</body>
</html>