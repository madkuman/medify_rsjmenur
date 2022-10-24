<table>
	<tr>
		<td colspan="8">LAPORAN INSIDEN</td>
	</tr>
	<tr>
		<td colspan="8">{{indonesian_date($start,'d F Y')}} - {{indonesian_date($end,'d F Y')}}</td>
	</tr>
	<tr>
		<td colspan="8"></td>
	</tr>
	<tr>
		<td>No</td>
		<td>Tanggal</td>
		<td>Nama Pegawai</td>
		<td>Lokasi</td>
		<td>Kronologi Kejadian</td>
		<td>Letak Cedera</td>
		<td>Fatality</td>
		<td>Dibuat Oleh</td>
	</tr>
	
	@foreach($data as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{indonesian_date($item->tanggal_kejadian,'d/m/Y')}}</td>
		<td>{{$item->nama_pegawai ?? ($item->employees->name ?? '-')}}</td>
		<td>{{$item->lokasi ?? '-'}}</td>
		<td>{{$item->kronologi}}</td>
		<td>{{$item->letak_cedera ?? '-'}}</td>
		<td>{{$item->fatality}}</td>
		<td>{{$item->users->name}}</td>
	</tr>
	@endforeach
</table>