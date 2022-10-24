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
		<h4>SEPULUH BESAR DIAGNOSA</h4>
		<h4>PERIODE : {{$start}} - {{$end}}</h4>
	</div>
	@foreach($poliklinik as $poli)
	<p style="margin-bottom: 0px">Poli : {{$poli->name}}</p>
	<table width="100%">
		<tr>
			<th rowspan="2" width="50px">NO</th>
			<th colspan="2">DIAGNOSA</th>
			<th colspan="2">JENIS KELAMIN</th>
			<th rowspan="2">JUMLAH</th>
		</tr>
		<tr>
			<th width="100px">KODE ICD</th>
			<th width="500px">DESKRIPSI</th>
			<th>LK</th>
			<th>PR</th>
		</tr>

		@foreach($poli->diagnosis as $item)
		<tr>
			<td class="text-center">{{$loop->iteration}}</td>
			<td>{{$item->kode_icd}}</td>
			<td class="text-center">{{$item->deskripsi}}</td>
			<td class="text-center">{{$item->total_lk}}</td>
			<td class="text-center">{{$item->total_pr}}</td>
			<td class="text-center">{{$item->total}}</td>
		</tr>
		@endphp 
		@endforeach
	</table>
	@endforeach
</body>
</html>