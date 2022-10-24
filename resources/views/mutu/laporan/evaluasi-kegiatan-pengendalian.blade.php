<table>
	<tr>
		<td colspan="6">EVALUASI KEGIATAN PENGENDALIAN</td>
	</tr>
	<tr>
		<td colspan="6"> {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td colspan="6"></td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>URAIAN RESIKO</b></td>
		<td><b>SKALA KEMUNGKINAN</b></td>
		<td><b>SKALA DAMPAK</b></td>
		<td><b>SKALA STATUS RESIKO</b></td>
		<td><b>KRETERIA RESIKO</b></td>
	</tr>
	<tr>
		@for ($i = 1; $i <= 6; $i++)
		<td>{{ $i }}</td>
		@endfor
	</tr>
	@forelse($result as $item)
	<tr>
		<td>{{ $loop->iteration }}</td>
		<td>{{ $item->uraian_resiko ?? '-' }}</td>
		<td>{{ $item->skala_kemungkinan ?? '-' }}</td>
		<td>{{ $item->skala_dampak ?? '-' }}</td>
		<td>{{ $item->skala_status_resiko ?? '-' }}</td>
		<td>{{ $item->kreteria_resiko ?? '-' }}</td>
	</tr>
	@empty
	<tr>
		<td colspan="6"><center>Data belum tersedia</center></td>
	</tr>
	@endforelse
</table>