<table>
	<tr>
		<td colspan="3" align="center">JAM BUKA PELAYANAN</td>
	</tr>
	<tr>
		<td colspan="3"></td>
	</tr><tr>
		@php $start_column = 'B' @endphp
		@php $column = 'B' @endphp
		<td>Nama Poli</td>
		@foreach($dates as $item)
		<td>{{$item->format_kategori}}</td>
		
		@if(!$loop->last) @php $column++ @endphp @endif

		@endforeach
		@php $column-- @endphp
	</tr>
	@php $start_row = 4 @endphp
	@foreach($poliklinik as $item_poli)
	@php $count = 0 @endphp
	<tr>
		<td>{{$item_poli->name}}</td>
		@foreach($data as $item_data)
			@if(!empty($item_data[$item_poli->id]))
			<td>{{$item_data[$item_poli->id]['waktu_buka']->format('H:i')}}</td>
			@php $count++  @endphp
			@else
			<td></td>
			@endif
		@endforeach
	</tr>
	@php $start_row++ @endphp
	@endforeach
	@php $column++ @endphp
</table>