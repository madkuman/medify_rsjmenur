<table>
	<tr>
		<td colspan="2">WAKTU TUNGGU RAWAT JALAN</td>
	</tr>
	<tr>
		<td colspan="2">dalam satuan menit</td>
	</tr>
	<tr>
		@php $start_column = 'B' @endphp
		@php $column = 'B' @endphp
		<td>Nama Poli</td>
		@foreach($dates as $item)
		<td>{{$item->format_kategori}}</td>
		
		@if(!$loop->last) @php $column++ @endphp @endif

		@endforeach
		@php $column-- @endphp
		<td>Rata Rata</td>
	</tr>
	@php $start_row = 4 @endphp
	@foreach($poliklinik as $item_poli)
	@php $count = 0 @endphp
	<tr>
		<td>{{$item_poli->name}}</td>
		@foreach($data as $item_data)
			@if(!empty($item_data[$item_poli->id]))
			<td>{{round($item_data[$item_poli->id]['average'])}}</td>
			@php $count++  @endphp
			@else
			<td></td>
			@endif
		@endforeach
		
		@if($count > 0)
			<td>=AVERAGE({{$start_column}}{{$start_row}}:{{$column}}{{$start_row}})</td>
		@else
			<td>0</td>
		@endif
	</tr>
	@php $start_row++ @endphp
	@endforeach
	@php $column++ @endphp
	<tr>
		<td>Total</td>
		@foreach($data as $item_data)
			<td></td>
		@endforeach
		<td>=AVERAGE({{$column}}4:{{$column}}{{$start_row-1}})</td>
	</tr>

</table>