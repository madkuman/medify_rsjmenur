<table>
	@foreach($tarif as $item)
	<tr>
		<td>{{$item->id ?? ''}}</td>
		<td>{{$item->master->deskripsi ?? ''}}</td>
		<td>{{$item->master->kategori->id ?? ''}}</td>
		@if($item->kelas_id == 0)
		<td>Semua Kelas</td>
		@else
		<td>{{$item->kelas->nama ?? ''}}</td>
		@endif
		<td>{{$item->tipe->nama ?? ''}}</td>
		<td>{{$item->harga ?? ''}}</td>
	</tr>
	@endforeach
</table>