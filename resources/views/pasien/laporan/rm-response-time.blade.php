<!doctype html>
<html>
	<head>
		<style type="text/css">
		table.table, .table td, .table th {    
			border: 1px solid #000;
			text-align: left;
		}

		table.table {
			border-collapse: collapse;
			width: 100%;
		}

		.table th, .table td {
			padding: 15px;
		}
		</style>
	</head>
	<body>
		<table width="100%">
			<tr>
				<td colspan="5" style="text-align: center"><strong>RESPONSE TIME REKAM MEDIS</strong></td>
			</tr>
			<tr>
				<td td colspan="5">Tanggal : {{date('d F Y', strtotime($start))}} -  {{date('d F Y', strtotime($end))}}</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
		</table>
		<table class="table">
			<tr>
				<td>No</td>
				<td>No RM</td>
				<td>Nama Pasien</td>
				<td>Waktu Pendaftaran</td>
				<td>Waktu Pengiriman</td>
				<td>Response Time</td>
			</tr>
			@foreach($transaksi as $item)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$item->pasien->no_rm}}</td>
				<td>{{$item->pasien->name}}</td>
				<td>{{date('d M Y H:i', strtotime($item->created_at))}}</td>
				<td>{{date('d M Y H:i', strtotime($item->sender_confirmed_at))}}</td>
				<td>{{$item->response_time_sending}}</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="5">Total Waktu</td>
				<td>{{$transaksi->sum}}</td>
			</tr>
			<tr>
				<td colspan="5">Rata Rata</td>
				<td>{{$transaksi->average}}</td>
			</tr>
		</table>
	</body>
</html>
