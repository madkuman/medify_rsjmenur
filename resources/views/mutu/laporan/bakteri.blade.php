<table>
	<tr>
		<td colspan="7">LAPORAN INFEKSI BAKTERI LAB PK</td>
	</tr>
	<tr>
		<td colspan="5">Pemeriksaan : {{strtoupper($bakteri)}}</td>
		<td colspan="2"> {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>Tanggal</b></td>
		<td><b>No RM</b></td>
		<td><b>Nama</b></td>
		<td><b>Lokasi</b></td>
		<td><b>Infeksi Bakteri</b></td>
	</tr>
	@foreach($result as $i => $r)
		<tr>
			<td>{{$i+1}}</td>
			<td>{{$r->created_at->format('d/M/Y')}}</td>
			<td>{{$r->pasien->no_rm}}</td>
			<td>{{$r->pasien->name ?? '-'}}</td>
			<td>{{$r->lokasi->nama ?? '-'}}</td>
			<td>{{$r->infeksi_mdr ? 'Bakteri MDR' : ''}}; {{$r->infeksi_aureus ? 'Staphylococcus Aureus' : ''}}; 
				{{($r->infeksi_karbapenemase != 'Tidak Terjadi Infeksi') ? $r->infeksi_karbapenemase : ''}}; {{($r->infeksi_esbl != 'Tidak Terjadi Infeksi') ? $r->infeksi_esbl : ''}}</td>
		</tr>
	@endforeach
	<tr></tr>
	<tr></tr>
</table>