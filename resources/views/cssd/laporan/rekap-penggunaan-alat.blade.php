<table>
	<tr>
		<th rowspan="2">No</th>
		<th rowspan="2">Alkes</th>
		<th colspan="{{count($tanggal)}}">Tanggal</th>
		<th rowspan="2">Total</th>
	</tr>
	<tr>
		@foreach($tanggal as $item)
		<td>{{$item}}</td>
		@endforeach
	</tr>
	@php $count_tanggal =count($tanggal) @endphp
	@php $global_total = 0 @endphp
	@foreach($alkes as $item)
		<tr>
			<td>{{$loop->iteration}}</td>
			<td>{{$item->nama}}</td>

			@php $total = 0 @endphp
			@for($i=0;$i<$count_tanggal;$i++)
			<td>{{$alkes_jumlah[$item->id][$i]}}</td>
			@php $total += $alkes_jumlah[$item->id][$i] @endphp
			@endfor
			
			<td>{{$total}}</td>
			@php $global_total += $total @endphp
		</tr>
	@endforeach
	<tr>
		<td colspan="{{$count_tanggal+2}}">Total</td>
		<td>{{$global_total}}</td>
	</tr>
</table>