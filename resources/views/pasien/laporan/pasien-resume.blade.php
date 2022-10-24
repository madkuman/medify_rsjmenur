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
		<h4>LAPORAN PASIEN KRS BANGSAL - RESUME</h4>
		<h4>PERIODE : {{$start->format('d M Y')}} - {{$end->format('d M Y')}}</h4>
	</div>
	<table width="100%">
		<tr>
			<th width="7%">No</th>
			<th width="36%">Bangsal</th>
			<th width="19%">Dengan Resume</th>
			<th width="19%">Tanpa Resume</th>
			<th width="19%">Total</th>
		</tr>
		@php
		$totalResume = 0;
		$totalNoResume = 0;
		$total= 0;
		@endphp
		@foreach($transaksi as $item)
		<tr>
			<td style="text-align: center;">{{$loop->iteration}}</td>
			<td>Bangsal {{$item->nama}}</td>
			<td style="text-align: center;">{{$item->resume}}</td>
			<td style="text-align: center;">{{$item->count - $item->resume}}</td>
			<td style="text-align: center;">{{$item->count}}</td>
		</tr>

		@php
		$totalResume += $item->resume;
		$total+= $item->count;
		@endphp
		@endforeach
		<tr>
			<td colspan="2" style="text-align: right;">JUMLAH</td>
			<td style="text-align: center;">{{$totalResume}}</td>
			<td style="text-align: center;">{{$total - $totalResume}}</td>
			<td style="text-align: center;">{{$total}}</td>
		</tr>

	</table>
</body>