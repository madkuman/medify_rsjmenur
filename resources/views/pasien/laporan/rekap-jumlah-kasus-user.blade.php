<table>
	<tr>
		<td colspan="3">
			REKAP JUMLAH KASUS TIAP USER
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Periode Waktu {{indonesian_date($date_start)}} - {{indonesian_date($date_end)}}
		</td>
	</tr>
	<tr>
		<td colspan="3">
			RUMAH SAKIT {{config('app.name')}}
		</td>
	</tr>
	<tr><td colspan="3"></td>
	<tr><td colspan="3"></td>
	<tr>
		<td>No</td>
		<td>Nama Anggota</td>
		<td>Total</td>
	</tr>
	@foreach($data as $key => $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->nama}}</td>
		<td>{{$item->total}}</td>
	</tr>
	@endforeach
</table>