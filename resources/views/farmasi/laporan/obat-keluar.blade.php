<!DOCTYPE html>
<html>
<head>
	<title>Laporan Distribusi Obat Keluar</title>
	<style type="text/css">
	body{
		font-family: sans-serif;
		font-size: 14px;
	}
	table{
		border-collapse: collapse;
		width: 100%;
	}
	.centered{
		text-align: center;
	}
	.righted{
		text-align: right;
	}
	.big{
		font-size: 17px;
		font-weight: bold;
	}
	.bordered table, .bordered th, .bordered td{
		border: 1px solid black;
	}
	.bordered td{
		padding-left: 4px;
		padding-right: 4px;
	}
	th{
		vertical-align: middle;
	}
	td{
		vertical-align: top;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="centered big">Laporan Distribusi Obat Keluar</td>
		</tr>
		<tr>
			<td class="centered big">{{session('farmasi')->sluger}}</td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td> Tgl : {{indonesian_date($min_date)}} s/d {{indonesian_date($max_date)}}</td>
		</tr>
	</table>
	<table class="bordered">
		<thead>
			<tr>
				<th class="centered" width="4%">No</th>
				<th class="centered" width="10%">Kode Obat</th>
				<th class="centered" width="18%">Nama Obat</th>
				<th class="centered" width="14%">Tujuan</th>
				<th class="centered" width="10%">Jumlah</th>
				<th class="centered" width="15%">Harga Satuan</th>
				<th class="centered" width="15%">Total Harga</th>
				<th class="centered" width="14%">ED.</th>
			</tr>
		</thead>
		<tbody>
			@php($i = 1)
			@foreach($items as $item)
			<tr>
				<td class="centered">{{$i}}</td>
				<td>{{$item->template_kode}}</td>
				<td>{{str_replace('@', ' @', $item->template_nama)}}</td>
				@if($item->jenis_type == "LogTransaksi")
				<td>Pelayanan</td>
				@elseif($item->jenis_type == "LogDistribusi")
				<td>{{$asal[$item->jenis_id] ?? 'Gudang'}}</td>
				@else
				<td>Penghapusan</td>
				@endif
				<td class="centered">{{$item->jumlah}}</td>
				<td class="righted">{{$item->template_harga}}</td>
				<td class="righted">{{$item->subtotal_harga ?? 0}}</td>
				<td>{{indonesian_date($item->farmasi_items_kadaluarsa)}}</td>
			</tr>
			@php($i++)
			@endforeach
		</tbody>
	</table>
</body>
</html>