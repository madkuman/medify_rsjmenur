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
		<td>Nama Pasien</td>
		<td>Lokasi</td>
		<td>Post Ops hari ke -</td>
		<td>Aff Drain</td>
		<td>Infeksi</td>
		<td>Jenis Lokasi Infeksi</td>
		<td>Lokasi spesifik untuk infeksi organ / rongga</td>
		<td>Diagnosa Dokter</td>
	</tr>

	@foreach($ido as $item)
	@php $val = json_decode($item->val) @endphp
	<tr>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->kasus->pasien->name ?? '-'}}</td>
		<td>{{$item->lokasi->nama ?? '-'}}</td>
		<td>{{$val->hari_ke ?? ''}}</td>
		<td>{{$val->aff_drain ?? ''}}</td>
		<td>{{$val->infeksi ?? ''}}</td>
		<td>{{$val->jenis_lokasi_infeksi ?? ''}}</td>
		<td>{{$val->lokasi_spesifik_infeksi ?? ''}}</td>
		<td>{{$val->dx_dokter ?? ''}}</td>
	</tr>
	@endforeach
</table>