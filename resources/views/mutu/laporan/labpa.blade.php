<?php $salah = count($result); ?>
<table>
	<tr>
		<td colspan="7">LAPORAN KETEPATAN PELAYANAN LAB PA</td>
	</tr>
	<tr>
		<td colspan="5">Pemeriksaan : {{$target}}</td>
		<td colspan="2"> {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>Tanggal</b></td>
		<td><b>No RM</b></td>
		<td><b>Nama</b></td>
		<td><b>Lokasi</b></td>
		<td><b>Ketepatan Pelayanan</b></td>
		<td><b>Durasi Pelayanan &lt; 6 Jam</b></td>
	</tr>
	@foreach($result as $i => $r)
		<tr>
			<td>{{$i+1}}</td>
			<td>{{$r->created_at->format('d/M/Y')}}</td>
			<td>{{$r->pasien->no_rm ?? '-'}}</td>
			<td>{{$r->pasien->name ?? '-'}}</td>
			<td>{{$r->lokasi->nama ?? '-'}}</td>
			<td>{{$r->ketepatan_pelayanan ?? '-'}} Jam</td>
			<td>{{$r->ketepatan_pelayanan < 6 ? 'Ya' : ''}}</td>
			<?php if($r->ketepatan_pelayanan > 6)	$salah--; ?>
		</tr>
	@endforeach
	<tr></tr>
	<tr></tr>
	<tr>
		<td colspan="3">Ketepatan: </td>
		<td colspan="3">{{(($salah/count($result))*100)}} %</td>
	</tr>
</table>
