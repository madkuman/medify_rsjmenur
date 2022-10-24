<table>
	<tr>
		<td colspan="11">AUDIT VAP BUNDLE CHECKLIST</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td colspan="3">Ruangan : {{$lokasi ?? '-'}}</td>
		<td colspan="4">Bulan/Tahun : {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr><td colspan="11"></td></tr>
	<tr>
		<td>Tanggal</td>
		<td>No</td>
		<td>Nama Pasien/No Bed</td>
		<td>HOB > 30-45</td>
		<td>Pengkajian setiap hari terhadap sedasi dan extubasi</td>
		<td>Hand hygiene</td>
		<td>Oral Hygiene 4 – 6 jam</td>
		<td>Penyikatan gigi setiap 12 jam</td>
		<td>Suction / manajemen sekresi</td>
		<td>Profilaksis peptic ulcer</td>
		<td>DVT Profilaksis</td>
	</tr>

	@foreach($vap as $item)
	@php $val = json_decode($item->val) @endphp
	<tr>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->kasus->pasien->name ?? '-'}}</td>
		<td>{{$val->hob}}</td>
		<td>{{$val->pengkajian_tiap_hari}}</td>
		<td>{{$val->hand_hygiene}}</td>
		<td>{{$val->oral_hygiene}}</td>
		<td>{{$val->sikat_gigi_12_jam}}</td>
		<td>{{$val->suction}}</td>
		<td>{{$val->profilaksis}}</td>
		<td>{{$val->profilaksis_dvt}}</td>
	</tr>
	@endforeach
</table>