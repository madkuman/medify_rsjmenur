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
				<td colspan="{{count($perusahaan_id) + 3}}">LAPORAN TRANSAKSI KAMAR OPERASI</td>
			</tr>
			<tr>
				<td colspan="{{count($perusahaan_id) + 3}}">{{config('app.name')}}</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td rowspan="2">Kamar Operasi</td>
				<td rowspan="2">Jenis Operasi</td>
				<td colspan="3">AL</td>
				<td colspan="3">AD</td>
				<td colspan="3">AU</td>
				<td colspan="3">PC</td>
				<td colspan="4">BPJS</td>
				<td rowspan="2">Jumlah</td>
			</tr>
			<tr>
				<td>Militer</td>
				<td>Sipil</td>
				<td>Keluarga</td>
				<td>Militer</td>
				<td>Sipil</td>
				<td>Keluarga</td>
				<td>Militer</td>
				<td>Sipil</td>
				<td>Keluarga</td>
				<td>Tunai</td>
				<td>Asuransi</td>
				<td>Perusahaan</td>
				<td>Mandiri</td>
				<td>Purna</td>
				<td>Non Hankam</td>
				<td>PBI</td>
			</tr>

			@php $transaksi_perusahaan = [] @endphp
			@php $count_perusahaan = count($perusahaan_id) @endphp
			@foreach($ruangan as $ruang)
				@foreach($jenis as $jenis_item)
				<tr>
					@php $total = 0 @endphp

					@if($loop->first)
						<td rowspan="{{count($jenis)}}">{{$ruang->name}}</td>
					@endif
					
					<td>{{$jenis_title[$loop->index]}}</td>
					
					@for($i = 0; $i<$count_perusahaan; $i++)

						@php $total += $transaksi[$ruang->id][$jenis_item][$i] @endphp
						@if($jenis_item == 1 && $ruang->id == 1)
							@php $transaksi_perusahaan[$i] = 0 @endphp
						@endif
						@php $transaksi_perusahaan[$i] += $transaksi[$ruang->id][$jenis_item][$i] @endphp
						

						<td>{{$transaksi[$ruang->id][$jenis_item][$i]}}</td>

					@endfor

					<td>{{$total}}</td>
				</tr>
				@endforeach
			@endforeach

			@php $total_final = 0 @endphp
			<tr>
				<td colspan="2">Total</td>

				@php $total = 0 @endphp
				@foreach($transaksi_perusahaan as $item)
					<td>{{$item}}</td>
					@php $total_final += $item @endphp
				@endforeach

				<td>{{$total_final}}</td>
			</tr>

		</table>
	</body>
</html>