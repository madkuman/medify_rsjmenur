<table>
	<tr>
		<td>id</td>
		<td>Dokter</td>
		<td>Poliklinik</td>
		<td>Hari</td>
		<td>Jam Buka</td>
		<td>Jam Tutup</td>
		<td>Kode BPJS</td>
	</tr>
	@foreach($jadwal as $item)
	<tr>
		<td>{{$item->id ?? ''}}</td>
		<td>{{$item->dokter->name ?? ''}}</td>
		<td>{{$item->poli->name ?? ''}}</td>
		<td>{{$item->hari ?? ''}}</td>
		<td>{{$item->jam_buka ?? ''}}</td>
		<td>{{$item->jam_tutup ?? ''}}</td>
		<td>{{$item->poli->bpjs_id ?? ''}}</td>
	</tr>
	@endforeach
</table>