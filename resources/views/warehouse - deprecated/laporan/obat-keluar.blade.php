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
			<td class="centered big">Gudang Farmasi {{config('app.name')}}</td>
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
				<th class="centered" width="17%">Nama Obat</th>
				<th class="centered" width="13%">Tujuan</th>
				<th class="centered" width="8%">Jumlah</th>
				<th class="centered" width="16%">Harga Satuan</th>
				<th class="centered" width="18%">Total Harga</th>
				<th class="centered" width="14%">ED.</th>
			</tr>
		</thead>
		<tbody>
			@php($i = 1)
			@php($total = 0)
			@foreach($items as $item)
			<tr>
				<td class="centered">{{$i}}</td>
				<td>{{$item->kode ?? '-'}}</td>
				<td>{{str_replace('@', ' @', $item->nama)}}</td>
				<td>{{$tujuan[$item->farmasi_id] ?? '-'}}</td>
				<td class="centered">{{$item->jumlah}}</td>
				<td class="righted">{{formatCurrency($item->harga)}}</td>
				<td class="righted">{{formatCurrency($item->harga * $item->jumlah) ?? 0}}</td>
				<td>{{indonesian_date($item->kadaluarsa) ?? '-'}}</td>
			</tr>
			@php($total+= $item->harga * $item->jumlah)
			@php($i++)
			@endforeach
			<tr>
				<td colspan="6" class="righted">TOTAL</td>
				<td class="righted">{{formatCurrency($total)}}</td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
	</table>
</body>
</html>