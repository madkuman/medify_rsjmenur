<table>
	<tr>
		<td colspan="5">LAPORAN KESALAHAN TINDAKAN</td>
	</tr>
	<tr>
		<td colspan="3">Ruang : {{$lokasi}}</td>
		<td colspan="2"> {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td align="center"><b>No</b></td>
		<td align="center"><b>Tanggal</b></td>
		<td align="center"><b>No RM</b></td>
		<td align="center"><b>Nama</b></td>
		<td align="center"><b>Lokasi</b></td>
	</tr>
	@foreach($data as $item)
	<tr>
		<td align="center">{{$loop->iteration}}</td>
		<td align="center">{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td align="center">{{$item->kasus->pasien->no_rm}}</td>
		<td>{{$item->kasus->pasien->name}}</td>
		<td>{{$item->kasus->lokasi->lokasi->nama}}</td>
	</tr>
	@endforeach
	<tr></tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td align="center"><b>Jumlah</b></td>
		<td align="center"><b>{{$jumlah}}</b></td>
	</tr>
</table>
