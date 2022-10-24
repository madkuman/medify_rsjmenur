<table>
	<tr>
		<td colspan="9">AUDIT IDO BUNDLE CHECKLIST</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3">Ruangan : {{$lokasi ?? '-'}}</td>
		<td colspan="4">Bulan/Tahun : {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
		<td></td>
		<td></td>
	</tr>
	<tr><td colspan="9"></td></tr>
	<tr>
		<td>Tanggal</td>
		<td>No</td>
		<td>Nama Pasien/No Bed</td>
		<td>Cukur Dengan e. clipper</td>
		<td>Waktu cukur ( ± 2 jam) sebelum operasi</td>
		<td>Mandi cholrhexidine</td>
		<td>Antibiotic 1 jam sebelum insisi</td>
		<td>Pasien tidak sedang infeksi</td>
		<td>Gula darah Terkontrol</td>
	</tr>

	@foreach($ido as $item)
	@php $val = json_decode($item->val) @endphp
	<tr>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->kasus->pasien->name ?? '-'}}</td>
		<td>{{$val->cukur}}</td>
		<td>{{$val->waktu_cukur}}</td>
		<td>{{$val->mandi_cholrhexidine}}</td>
		<td>{{$val->antibiotik}}</td>
		<td>{{$val->infeksi}}</td>
		<td>{{$val->gula_darah}}</td>
	</tr>
	@endforeach
</table>