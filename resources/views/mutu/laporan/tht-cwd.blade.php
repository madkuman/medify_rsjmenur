<?php $overlos = 0; ?>
<table>
	<tr>
		<td colspan="7">LAPORAN KETEPATAN THT Post Operasi CWD</td>
	</tr>
	<tr>
		<td colspan="5">Post Operasi CWD</td>
		<td colspan="2"> {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>Tanggal</b></td>
		<td><b>No RM</b></td>
		<td><b>Nama</b></td>
		<td><b>Lokasi</b></td>
		<td><b>LOS</b></td>
	</tr>
	@foreach($result as $i => $r)
		<tr>
			<td>{{$i+1}}</td>
			<td>{{$r->created_at->format('d/M/Y')}}</td>
			<td>{{$r->pasien->no_rm}}</td>
			<td>{{$r->pasien->name ?? '-'}}</td>
			<td>{{$r->lokasi->nama ?? '-'}}</td>
			<td>{{$r->los}} Hari @if($r->los > 7) $overlos++; @endif</td>
		</tr>
	@endforeach
	<tr></tr>
	<tr></tr>
	<tr>
		<td colspan="3">Ketepatan: </td>
		@if($overlos == 0 && count($result) == 0)
			<td colspan="3">100 %</td>
		@else
			<td colspan="3">{{(($overlos/count($result))*100)}} %</td>
		@endif
	</tr>
</table>