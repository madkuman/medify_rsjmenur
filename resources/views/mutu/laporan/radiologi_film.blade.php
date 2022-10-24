<?php $ditolak=0; $keluar=0; ?>
<table>
	<tr>
		<td colspan="7">LAPORAN FILM LAB RADIOLOGI</td>
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
		<td><b>Pemeriksaan</b></td>		
		<td><b>Film Ditolak</b></td>
		<td><b>Film Keluar</b></td>
	</tr>
	@foreach($result as $i => $r)
		@foreach($r->detail as $d)
			<tr>
				<td>{{$i+1}}</td>
				<td>{{$r->created_at->format('d/M/Y')}}</td>
				<td>{{$r->pasien->no_rm}}</td>
				<td>{{$r->pasien->name ?? '-'}}</td>
				<td>{{$r->lokasi->nama ?? '-'}}</td>
				<td>{{$d->tarif->deskripsi}}</td>
				<td>{{$d->film_ditolak}}</td>
				<td>{{$d->film_dipakai}}</td>
				<?php $ditolak+= $d->film_ditolak; $keluar+= $d->film_dipakai; ?>
			</tr>
		@endforeach
	@endforeach
	<tr></tr>
	<tr></tr>
	<tr>
		<td colspan="3">Ketepatan: </td>
		@if(count($result) == 0 || $ditolak == 0 || $keluar == 0)
			<td colspan="3">100 %</td>
		@else
			<td colspan="3">{{(($ditolak/$keluar)*100)}} %</td>
		@endif
	</tr>
</table>