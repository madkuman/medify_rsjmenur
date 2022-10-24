<h4>Informasi Bangsal</h4>

<table>
	<tr>
		<td>Nama Bangsal</td>
		<td>{{$bangsal->nama}}</td>
	</tr>
	<tr>
		<td>Total Ruangan</td>
		<td>{{$bangsal->ruangan->count()}}</td>
	</tr>
	<tr>
		<td>Total Bed</td>
		<td>{{$bangsal->count_tempat_tidur_total}}</td>
	</tr>
</table>
<br>
<br>

<table>
@foreach($ruangan as $item)
<tr>
	<td>
		{{$item->nama}}
	</td>
	<td>
		{{$item->kelas_ruang->nama}}
	</td>
	<td>
		{{$item->bed->count()}}
	</td>
</td>
@endforeach
</table>