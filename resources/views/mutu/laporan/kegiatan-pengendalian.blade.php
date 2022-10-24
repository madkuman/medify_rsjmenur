<table>
	<tr>
		<td colspan="9">KEGIATAN PENGENDALIAN</td>
	</tr>
	<tr>
		<td colspan="9">BAGIAN : {{strtoupper($bagian)}}</td>
	</tr>
	<tr>
		<td colspan="9"> {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td colspan="9"></td>
	</tr>
	<tr>
		<td rowspan="3"><b>No</b></td>
		<td rowspan="3"><b>URAIAN RESIKO</b></td>
		<td colspan="5"><b>KEGIATAN PENGENDALIAN</b></td>
		<td rowspan="3"><b>PENANGGUNG JAWAB</b></td>
		<td rowspan="3"><b>TARGET WAKTU</b></td>
	</tr>
	<tr>
		<td rowspan="2"><b>STANDAR / YANG HARUS ADA</b></td>
		<td colspan="3"><b>YANG TERPASANG / YANG SUDAH ADA</b></td>
		<td rowspan="2"><b>RENCANA TINDAK LANJUT</b></td>
	</tr>
	<tr>
		<td><b>URAIAN</b></td>
		<td><b>EFEKTIF / TIDAK EFEKTIF</b></td>
		<td><b>CELAH</b></td>
	</tr>
	<tr>
		@for ($i = 1; $i <= 9; $i++)
		<td>{{ $i }}</td>
		@endfor
	</tr>
	@forelse($result as $item)
	<tr>
		<td>{{ $loop->iteration }}</td>
		<td>{{ $item->uraian_resiko ?? '-' }}</td>
		<td>{{ $item->kegiatan_standart ?? '-' }}</td>
		<td>{{ $item->kegiatan_terpasang_uraian ?? '-' }}</td>
		<td>{{ $item->kegiatan_terpasang_efektifitas ?? '-' }}</td>
		<td>{{ $item->kegiatan_terpasang_celah ?? '-' }}</td>
		<td>{{ $item->rencana ?? '-' }}</td>
		<td>{{ $item->penanggung_jawab ?? '-' }}</td>
		<td>{{ $item->target_waktu ?? '-' }}</td>
	</tr>
	@empty
	<tr>
		<td colspan="9"><center>Data belum tersedia</center></td>
	</tr>
	@endforelse
</table>