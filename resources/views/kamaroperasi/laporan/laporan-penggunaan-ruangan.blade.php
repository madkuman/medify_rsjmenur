<html>
	<head>
		<style type="text/css">
			th, td {
				padding: 15px;
			}
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>
		<table>
			<tr>
				<td colspan="{{count($tanggal) + 2}}">LAPORAN PENGGUNAAN KAMAR OPERASI</td>
			</tr>
			<tr>
				<td colspan="{{count($tanggal) + 2}}">{{config('app.name')}}</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td rowspan="2">Kamar Operasi</td>
				<td colspan="{{count($tanggal)}}">TANGGAL</td>
				<td rowspan="2">Jumlah</td>
			</tr>
			<tr>
				@foreach($tanggal as $item)
				<td>{{date('d/m', strtotime($item))}}</td>
				@endforeach
			</tr>
			@php $tanggal_penggunaan = [] @endphp

			@foreach($ruangan as $ruang)
			<tr>
				<td>{{$ruang->name}}</td>

				@for($i=0;$i<$count_date;$i++)
					<td>{{$transaksi_persen[$i][$ruang->id]}} %</td>
				@endfor
				
				<td>{{$persen_per_ruang[$ruang->id]}} %</td>
			</tr>
			@endforeach
			<tr>
				<td>Total</td>
				@foreach($persen_per_tgl as $item)
				<td>{{$item}} %</td>
				@endforeach
				<td>{{$global_persen}} %</td>
			</tr>
		</table>
	</body>
</html>