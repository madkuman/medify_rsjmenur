<table>
	<tr>
		<th rowspan="2">No</th>
		<th rowspan="2">Kode</th>
		<th rowspan="2">Diagnosis</th>
		<th colspan="{{count($tanggal)}}">Tanggal</th>
		<th rowspan="2">Total</th>
	</tr>
	<tr>
		@foreach($tanggal as $item)
		<th>{{$item}}</th>
		@endforeach
	</tr>
	@foreach($diagnosis as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->icd}}</td>
		<td>{{$item->diagnosis}}</td>
		@foreach($item->tanggal as $key => $item_tgl)
		<td>{{$item_tgl}}</td>
		@endforeach
	@endforeach
</table>