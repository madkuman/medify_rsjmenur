<!doctype html>
<html>
<head>
	<style type="text/css">
	table.table, .table td, .table th 
	{    
		border: 1px solid #000;
		text-align: left;
	}

	table.table 
	{
		border-collapse: collapse;
		width: 100%;
	}

	.table th, .table td 
	{
		padding: 15px;
	}
	th, .text-center
	{
		text-align: center;
	}
	table {
		border-collapse: collapse;
	}

	table, th, td {
		border: 1px solid black;
		padding: 5px;
	}
	body {
		font-family: sans-serif;
	}
</style>
</head>
<body>
	<div class="text-center">
		<h4>LAPORAN DATA REKAM MEDIK</h4>
		<h4>PERIODE : {{$start}} - {{$end}}</h4>
	</div>
	<table width="100%">
		<tr>
			<th>NO</th>
			<th>KEGIATAN</th>
			<th>BARU</th>
			<th>LAMA</th>
			<th>TOTAL</th>
		</tr>
		@php
			$total_baru = 0;
			$total_lama = 0;
			$total = 0;
		@endphp 

		@foreach($poliklinik as $item)
		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$item->name}}</td>
			<td class="text-center">{{$item->total_baru}}</td>
			<td class="text-center">{{$item->total_lama}}</td>
			<td class="text-center">{{$item->total}}</td>
		</tr>

		@php
			$total_baru += $item->total_baru;
			$total_lama += $item->total_lama;
			$total += $item->total;
		@endphp 


		@endforeach
		<tr>
			<th></th>
			<th>TOTAL</th>
			<th>{{$total_baru}}</th>
			<th>{{$total_lama}}</th>
			<th>{{$total}}</th>
		</tr>
	</table>
</body>
</html>