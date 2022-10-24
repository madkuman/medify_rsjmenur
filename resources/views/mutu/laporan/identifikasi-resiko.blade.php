<table>
	<tr>
		<td colspan="10">IDENTIFIKASI RESIKO UNIT</td>
	</tr>
	<tr>
		<td colspan="10">BAGIAN : {{strtoupper($bagian)}}</td>
	</tr>
	<tr>
		<td colspan="10"> {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<td rowspan="2"><b>No</b></td>
		<td rowspan="2"><b>INDIKATOR MUTU</b></td>
		<td rowspan="2"><b>KEGIATAN / FUNGSI / PROSES BISNIS</b></td>
		<td colspan="2"><b>URAIAN RESIKO</b></td>
		<td colspan="2"><b>PENYEBAB</b></td>
		<td rowspan="2"><b>DAPAT / TIDAK DAPAT DITERIMA</b></td>
		<td rowspan="2"><b>DAMPAK</b></td>
		<td rowspan="2"><b>PENANGGUNG JAWAB</b></td>
	</tr>
	<tr>
		<td><b>SASARAN</b></td>
		<td><b>URAIAN</b></td>
		<td><b>URAIAN</b></td>
		<td><b>INTERNAL / EKSTERNAL</b></td>
	</tr>
	<tr>
		@for ($i = 1; $i <= 10; $i++)
		<td>{{ $i }}</td>
		@endfor
	</tr>
	@forelse($result as $indikator_id => $item_indikator)
	@php
	$rowspan = $item_indikator->count();
	$item_first = $item_indikator->first();
	@endphp
	<tr>
		<td rowspan="{{ $rowspan }}">{{ $loop->iteration }}</td>
		<td rowspan="{{ $rowspan }}">{{ $item_first->indikator->judul ?? '-' }}</td>
		<td rowspan="{{ $rowspan }}">{{ $item_first->indikator->kegiatan ?? '-' }}</td>
		<td>{{ $item_first->resiko_sasaran ?? '-' }}</td>
		<td>{{ $item_first->resiko_uraian ?? '-' }}</td>
		<td>{{ $item_first->penyebab_uraian ?? '-' }}</td>
		<td>{{ $item_first->penyebab_intern_ekstern ?? '-' }}</td>
		<td>{{ $item_first->penerimaan ?? '-' }}</td>
		<td>{{ $item_first->dampak ?? '-' }}</td>
		<td>{{ $item_first->penanggung_jawab ?? '-' }}</td>
	</tr>
	@foreach ($item_indikator as $item)
		@if ($loop->first)
			@continue
		@endif
		<tr>
			<td>{{ $item->resiko_sasaran ?? '-' }}</td>
			<td>{{ $item->resiko_uraian ?? '-' }}</td>
			<td>{{ $item->penyebab_uraian ?? '-' }}</td>
			<td>{{ $item->penyebab_intern_ekstern ?? '-' }}</td>
			<td>{{ $item->penerimaan ?? '-' }}</td>
			<td>{{ $item->dampak ?? '-' }}</td>
			<td>{{ $item->penanggung_jawab ?? '-' }}</td>
		</tr>
	@endforeach
	@empty
	<tr>
		<td colspan="10"><center>Data belum tersedia</center></td>
	</tr>
	@endforelse
</table>