<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Laporan Lansia</title>
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
	td,th{
		padding:3px;
		font-size: 12px;
	}
	* {
      font-family: "DejaVu Sans Mono", monospace;
    }
</style>
</head>
<body>
	<table>
		<tr>
			<td class="center bold">DAFTAR LANSIA YANG TELAH MENDAPATKAN PELAYANAN KESEHATAN MINIMAL</td>
		</tr>
	</table>
	<br>

	<table>
		<thead>
			<tr>
				<th class="bordered title" rowspan="2" style="width: 5%">NO</th>
				<th class="bordered title" rowspan="2" style="width: 15%">NAMA</th>
				<th class="bordered title" colspan="2" " style="width: 25%">JENIS KELAMIN</th>
				<th class="bordered title" rowspan="2" style="width: 10%">USIA</th>
				<th class="bordered title" rowspan="2" style="width: 15%">NIK</th>
				<th class="bordered title" rowspan="2" style="width: 30%">ALAMAT</th>
			</tr>
			<tr>
				<th class="bordered title">LAKI-LAKI</th>
				<th class="bordered title">PEREMPUAN</th>
			</tr>	
		</thead>
		<tbody>
			@foreach($data as $transaksi)
			<tr>
				<td class="bordered center">{{$loop->iteration}}</td>
				<td class="bordered">{{$transaksi->pasien->name}}</td>
				<td class="bordered center">@if($transaksi->pasien->gender == 1) ✓ @endif</td>
				<td class="bordered center">@if($transaksi->pasien->gender == 2) ✓ @endif</td>
				<td class="bordered center">{{floor($transaksi->usia_masuk/365)}}</td>
				<td class="bordered center">{{$transaksi->pasien->no_identitas}}</td>
				<td class="bordered">{{$transaksi->pasien->address}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>