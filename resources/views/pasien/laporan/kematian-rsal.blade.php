<!DOCTYPE html>
<html>
<head>
	<title>Laporan Kematian</title>
	<style type="text/css">
	table{
		border-collapse: collapse;;
		width: 100vw;
		font-size: 11px;
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
		font-size: 13px;
		font-weight: bold;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="center bold">LAPORAN KEMATIAN RUMAH SAKIT</td>
		</tr>
	</table>
	<br>

	<table>
		<tr>
			<td style="width: 10%">RUMAH SAKIT</td>
			<td style="width: 90%">: {{config('app.name')}}</td>
		</tr>
		<tr>
			<td>TANGGAL</td>
			<td>: {{$start}} - {{$end}}</td>
		</tr>
	</table>
	<br>
	<table>
		<thead>
			<tr>
				<th class="bordered title" rowspan="2" style="width: 3%">NO</th>
				<th class="bordered title" rowspan="2" style="width: 5%">RM</th>
				<th class="bordered title" rowspan="2" style="width: 15%">NAMA</th>
				<th class="bordered title" rowspan="2" style="width: 5%">UMUR (Th)</th>
				<th class="bordered title" rowspan="2" style="width: 3%">SEX</th>
				<th class="bordered title" rowspan="2" style="width: 21%">ALAMAT</th>
				<th class="bordered title" colspan="2" style="width: 14%">TANGGAL</th>
				<th class="bordered title" rowspan="2" style="width: 8%">DIAGNOSA MASUK</th>
				<th class="bordered title" rowspan="2" style="width: 8%">DIAGNOSA MENINGGAL</th>
				<th class="bordered title" rowspan="2" style="width: 8%">DPJP</th>
				<th class="bordered title" rowspan="2" style="width: 12%">KETERANGAN</th>
			</tr>
			<tr>
				<th class="bordered title">MRS</th>
				<th class="bordered title">KRS</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $item)
			<tr>
				<td class="bordered center">{{$loop->iteration}}</td>
				<td class="bordered center">{{$item['no_rm']}}</td>
				<td class="bordered">{{$item['nama']}}</td>
				<td class="bordered center">{{$item['usia']}}</td>
				<td class="bordered center">{{$item['gender']}}</td>
				<td class="bordered">{{$item['alamat']}}</td>
				<td class="bordered center">{{$item['mrs']}}</td>
				<td class="bordered center">{{$item['krs']}}</td>
				<td class="bordered">{{$item['diagnosa_masuk']}}</td>
				<td class="bordered">{{$item['diagnosa_meninggal']}}</td>
				<td class="bordered">{{$item['dpjp']}}</td>
				<td class="bordered center">{{$item['keterangan']}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>