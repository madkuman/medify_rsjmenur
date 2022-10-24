<?php $benar = 0; ?>
<table>
	<tr>
		<td colspan="7">LAPORAN KETEPATAN THT Sinusitis Paranasalis</td>
	</tr>
	<tr>
		<td colspan="5">Penanganan kasus Sinusitis Paranasalis</td>
		<td colspan="2"> {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>Tanggal</b></td>
		<td><b>No RM</b></td>
		<td><b>Nama</b></td>
		<td><b>Lokasi</b></td>
		<td><b>Operasi FESS</b></td>
	</tr>
	@foreach($result as $i => $r)
		<tr>
			<td>{{$i+1}}</td>
			<td>{{$r->created_at->format('d/M/Y')}}</td>
			<td>{{$r->pasien->no_rm}}</td>
			<td>{{$r->pasien->name ?? '-'}}</td>
			<td>{{$r->lokasi->nama ?? '-'}}</td>
			<td><?php if(in_array($r->id, $kasus_benar)) $benar++; ?>
			{{in_array($r->id, $kasus_benar) ? 'Ya' : 'Tidak'}}</td>
		</tr>
	@endforeach
	<tr></tr>
	<tr></tr>
	<tr>
		<td colspan="3">Ketepatan: </td>
		@if($benar == 0 && count($result) == 0)
			<td colspan="3">100 %</td>
		@else
			<td colspan="3">{{(($benar/count($result))*100)}} %</td>
		@endif
	</tr>
</table>