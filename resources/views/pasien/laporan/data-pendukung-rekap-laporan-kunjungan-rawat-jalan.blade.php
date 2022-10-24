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
		<h4>LAPORAN PENDUKUNG DATA REKAM MEDIK RAWAT JALAN</h4>
		<h4>PERIODE : {{$start}} - {{$end}}</h4>
	</div>
	<table width="100%">
		<tr>
			<th rowspan="2">NO</th>
			<th rowspan="2">POLIKLINIK</th>
			<th colspan="3">BARU</th>
			<th colspan="3">LAMA</th>
			<th colspan="3">TOTAL KUNJUNGAN</th>
		</tr>
		<tr>
			<th width="50px">LK</th>
			<th width="50px">PR</th>
			<th width="50px">TOTAL</th>
			<th width="50px">LK</th>
			<th width="50px">PR</th>
			<th width="50px">TOTAL</th>
			<th width="50px">LK</th>
			<th width="50px">PR</th>
			<th width="50px">TOTAL</th>
		</tr>

		@php
			$total_baru_pria = 0;
			$total_baru_wanita = 0;
			$total_baru = 0;
			$total_lama_pria = 0;
			$total_lama_wanita = 0;
			$total_lama = 0;
			$total_pria = 0;
			$total_wanita = 0;
			$total = 0;
		@endphp 

		@foreach($poliklinik as $poli)
		@php $item = $poli->all @endphp
		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$poli->name}}</td>
			<td class="text-center">{{$item->total_baru_pria}}</td>
			<td class="text-center">{{$item->total_baru_wanita}}</td>
			<td class="text-center">{{$item->total_baru}}</td>
			<td class="text-center">{{$item->total_lama_pria}}</td>
			<td class="text-center">{{$item->total_lama_wanita}}</td>
			<td class="text-center">{{$item->total_lama}}</td>
			<td class="text-center">{{$item->total_pria}}</td>
			<td class="text-center">{{$item->total_wanita}}</td>
			<td class="text-center">{{$item->total}}</td>
		</tr>
		@php
			$total_baru_pria += $item->total_baru_pria;
			$total_baru_wanita += $item->total_baru_wanita;
			$total_baru += $item->total_baru;
			$total_lama_pria += $item->total_lama_pria;
			$total_lama_wanita += $item->total_lama_wanita;
			$total_lama += $item->total_lama;
			$total_pria += $item->total_pria;
			$total_wanita += $item->total_wanita;
			$total += $item->total;
		@endphp 
		@endforeach
		<tr>
			<th></th>
			<th>JUMLAH</th>
			<th>{{$total_baru_pria}}</th>
			<th>{{$total_baru_wanita}}</th>
			<th>{{$total_baru}}</th>
			<th>{{$total_lama_pria}}</th>
			<th>{{$total_lama_wanita}}</th>
			<th>{{$total_lama}}</th>
			<th>{{$total_pria}}</th>
			<th>{{$total_wanita}}</th>
			<th>{{$total}}</th>
		</tr>
	</table>

	<pagebreak/>

	
	<div class="text-center">
		<h4>DATA KONSUL</h4>
		<h4>PERIODE : {{$start}} - {{$end}}</h4>
	</div>
	<table width="100%">
		<tr>
			<th rowspan="2">NO</th>
			<th rowspan="2">POLIKLINIK</th>
			<th colspan="3">BARU</th>
			<th colspan="3">LAMA</th>
			<th colspan="3">TOTAL KUNJUNGAN</th>
		</tr>
		<tr>
			<th width="50px">LK</th>
			<th width="50px">PR</th>
			<th width="50px">TOTAL</th>
			<th width="50px">LK</th>
			<th width="50px">PR</th>
			<th width="50px">TOTAL</th>
			<th width="50px">LK</th>
			<th width="50px">PR</th>
			<th width="50px">TOTAL</th>
		</tr>

		@php
			$total_baru_pria = 0;
			$total_baru_wanita = 0;
			$total_baru = 0;
			$total_lama_pria = 0;
			$total_lama_wanita = 0;
			$total_lama = 0;
			$total_pria = 0;
			$total_wanita = 0;
			$total = 0;
		@endphp 

		@foreach($poliklinik as $poli)
		@php $item = $poli->rujukan @endphp
		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$poli->name}}</td>
			<td class="text-center">{{$item->total_baru_pria}}</td>
			<td class="text-center">{{$item->total_baru_wanita}}</td>
			<td class="text-center">{{$item->total_baru}}</td>
			<td class="text-center">{{$item->total_lama_pria}}</td>
			<td class="text-center">{{$item->total_lama_wanita}}</td>
			<td class="text-center">{{$item->total_lama}}</td>
			<td class="text-center">{{$item->total_pria}}</td>
			<td class="text-center">{{$item->total_wanita}}</td>
			<td class="text-center">{{$item->total}}</td>
		</tr>
		@php
			$total_baru_pria += $item->total_baru_pria;
			$total_baru_wanita += $item->total_baru_wanita;
			$total_baru += $item->total_baru;
			$total_lama_pria += $item->total_lama_pria;
			$total_lama_wanita += $item->total_lama_wanita;
			$total_lama += $item->total_lama;
			$total_pria += $item->total_pria;
			$total_wanita += $item->total_wanita;
			$total += $item->total;
		@endphp 
		@endforeach
		<tr>
			<th></th>
			<th>JUMLAH</th>
			<th>{{$total_baru_pria}}</th>
			<th>{{$total_baru_wanita}}</th>
			<th>{{$total_baru}}</th>
			<th>{{$total_lama_pria}}</th>
			<th>{{$total_lama_wanita}}</th>
			<th>{{$total_lama}}</th>
			<th>{{$total_pria}}</th>
			<th>{{$total_wanita}}</th>
			<th>{{$total}}</th>
		</tr>
	</table>
</body>
</html>