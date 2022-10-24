<?php $salah = count($result); ?>
<table>
	<tr>
		<td colspan="7">LAPORAN KETEPATAN PEMERIKSAAN USG LAB RADIOLOGI</td>
	</tr>
	<tr>
		<td colspan="5">Pemeriksaan USG</td>
		<td colspan="2"> {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>Tanggal</b></td>
		<td><b>No RM</b></td>
		<td><b>Nama</b></td>
		<td><b>Lokasi</b></td>
		<td><b>Mulai Pemeriksaan</b></td>
		<td><b>Lama Pemeriksaan</b></td>
	</tr>
	@foreach($result as $i => $r)
		<tr>
			<td>{{$i+1}}</td>
			<td>{{$r->created_at->format('d/M/Y')}}</td>
			<td>{{$r->pasien->no_rm}}</td>
			<td>{{$r->pasien->name ?? '-'}}</td>
			<td>{{$r->lokasi->nama ?? '-'}}</td>
			<td>{{is_null($r->pemeriksaan_start_at) ? '-' : $r->pemeriksaan_start_at->format('d/M/Y H:i')}}</td>
			@if(!is_null($r->verified_at))
				<?php $diffTime = $r->verified_at->diffInHours($r->pemeriksaan_start_at); if($diffTime > 2) $salah--; ?>
			@else
				<?php $diffTime = '-'; ?>
			@endif
			<td>{{$diffTime}}</td>
		</tr>
	@endforeach
	<tr></tr>
	<tr></tr>
	<tr>
		<td colspan="3">Ketepatan: </td>
		@if($salah == 0 && count($result) == 0)
			<td colspan="3">100 %</td>
		@else
			<td colspan="3">{{(($salah/count($result))*100)}} %</td>
		@endif
	</tr>
</table>