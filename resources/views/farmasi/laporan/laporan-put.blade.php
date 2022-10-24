<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pemakaian Obat Dukungan</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
		table{
			width: 100%;
			border-collapse: collapse;
		}
		table td, table th{
			padding-left: 5px;
			padding-right: 5px;
		}
		.bordered td, .bordered th{
			border: 1px solid black
		}
		.centered{
			text-align: center;
		}
		.righted{
			text-align: right;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td><b>{{config('app.name')}}</b></td>
		</tr>
		<tr>
			<td style="text-transform: uppercase;"><b>{{session('farmasi')->nama}}</b></td>
		</tr>
		<tr>
			<td class="centered"><b>Laporan PUT {{$bulan ?? $triwulan}} {{$tahun}}</b></td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Obat</th>
				<th>Satuan</th>
				<th>Harga</th>
				<th>{{$periode[0]}}</th>
				<th>{{$periode[1]}}</th>
				<th>{{$periode[2]}}</th>
				@if(isset($bulan))
				<th>{{$periode[3]}}</th>
				@endif
				<th>Jumlah</th>
				<th>Harga Total</th>
			</tr>
		</thead>
		@php
			$total_1 = 0; $total_2 = 0; $total_3 = 0; $total_4 = 0; $total_jumlah = 0; $total = 0; $i=1
		@endphp
		<tbody>
			@foreach($items as $key => $item)
			@if((!isset($hasil[0][$key])) && (!isset($hasil[1][$key])) && (!isset($hasil[2][$key])) && (!isset($hasil[3][$key])))
			@continue
			@endif
			<tr>
				<td>{{$i++}}</td>
				<td>{{$item->nama}}</td>
				<td>{{$item->satuan}}</td>
				<td>Rp {{number_format($item->harga)}}</td>
				<td>{{$hasil[0][$key] ?? 0}}</td>
				<td>{{$hasil[1][$key] ?? 0}}</td>
				<td>{{$hasil[2][$key] ?? 0}}</td>
				@php($jumlah = ($hasil[0][$key] ?? 0) + 
						($hasil[1][$key] ?? 0) + 
						($hasil[2][$key] ?? 0))
				@if(isset($bulan))
				@php($total_4+=($hasil[3][$key] ?? 0))
				@php($jumlah+=($hasil[3][$key] ?? 0))
				<td>{{$hasil[3][$key] ?? 0}}</td>
				@endif
				<td>{{$jumlah}}</td>
				@php($subtotal=$jumlah*$item->harga)
				<td>Rp {{number_format($subtotal)}}</td>

				@php($total_1+=($hasil[0][$key] ?? 0))
				@php($total_2+=($hasil[1][$key] ?? 0))
				@php($total_3+=($hasil[2][$key] ?? 0))
				@php($total_jumlah+=($jumlah))
				@php($total+=$subtotal)
			</tr>
			@endforeach
			<tr>
				<td colspan="4" class="righted">TOTAL</td>
				<td>{{$total_1}}</td>
				<td>{{$total_2}}</td>
				<td>{{$total_3}}</td>
				@if(isset($bulan))
				<td>{{$total_4}}</td>
				@endif
				<td>{{$total_jumlah}}</td>
				<td class="righted">{{number_format($total)}}</td>
			</tr>
		</tbody>
	</table>
</body>
</html>