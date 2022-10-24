<table>
	<tr>
		<td colspan="8">LAPORAN AUDIT IGD</td>
	</tr>
	<tr>
		<td colspan="8">{{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td align="center"><b>No</b></td>
		<td align="center"><b>Tanggal</b></td>
		<td align="center"><b>No RM</b></td>
		<td align="center"><b>Nama</b></td>
		<td align="center"><b>Lokasi</b></td>
		<td align="center"><b>Waktu Datang</b></td>
		<td align="center"><b>Waktu Pelayanan</b></td>
		<td align="center"><b>Selisih</b></td>
	</tr>
	@foreach($data as $item)
	<tr>
		<td align="center">{{$loop->iteration}}</td>
		<td align="center">{{indonesian_date($item->datangigd_at,'d/m/Y')}}</td>
		<td align="center">{{$item->pasien->no_rm}}</td>
		<td>{{$item->pasien->name}}</td>
		<td align="center">IGD</td>
		<td align="center">{{date('H:i',strtotime($item->datangigd_at))}}</td>
		<td align="center">{{date('H:i',strtotime($item->layani_igd_at))}}</td>
		<td align="center">@if($item->datangigd_at!=null && $item->layani_igd_at!=null){{(strtotime($item->layani_igd_at) - strtotime($item->datangigd_at))/60}}{{' menit'}}@endif</td>
	</tr>
		@endforeach
</table>
