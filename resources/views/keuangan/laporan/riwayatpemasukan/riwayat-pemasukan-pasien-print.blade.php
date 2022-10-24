
<table>
	<tr>
		<th rowspan="2">No</th>
		<th rowspan="2">Tanggal Transaksi</th>
		<th rowspan="2">Nama Pasien</th>
		<th rowspan="2">Jenis Pasien</th>
		<th rowspan="2">No RM</th>
		<th rowspan="2">Pembayar</th>
		@foreach($kategori_1 as $item)
		@if(count($item->child) == 0)
		<th rowspan="2" >{{$item->name}}</th>
		@else
		<th colspan="{{count($item->child)}}">{{$item->name}}</th>
		@endif
		@endforeach
		<th rowspan="2">Tanpa Kategori</th>
		<th rowspan="2">Total</th>
	</tr>
	<tr>
		@foreach($kategori_2 as $item)
		<th>{{$item}}</th>
		@endforeach
	</tr>
	@foreach($pemasukan as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->tanggal_transaksi}}</td>
		<td>{{$item->pasien_nama}}</td>
		<td>{{$item->jenis_pasien}}</td>
		<td class="text-right">{{$item->no_rm}}</td>
		<td class="text-right">{{$item->pembayar}}</td>
		@foreach($item->kategori as $temp_kategori)
			<td>{{$temp_kategori}}</td>
		@endforeach
		<td>{{$item->tanpa_kategori}}</td>
		<td>{{$item->total}}</td>
	</tr>
	@endforeach
</table>