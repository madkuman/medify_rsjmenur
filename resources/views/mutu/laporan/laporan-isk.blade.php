<table>
	<tr>
		<td colspan="11">AUDIT ISK BUNDLE CHECKLIST</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td colspan="2">Ruangan : {{$lokasi ?? '-'}}</td>
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
		<td>Pemasangan sesuai indikasi</td>
		<td>APD tepat</td>
		<td>Pemasangan menggunakan alat steril</td>
		<td>Hand Hygiene</td>
		<td>Segera dilepas jika tidak indikasi</td>
		<td>Pengisian balon sesuai ( 30 ml)</td>
		<td>Fiksasi kateter dengan plester</td>
		<td>Urine bag menggantung</td>
	</tr>
	@foreach($isk as $item)
	@php $val = json_decode($item->val) @endphp
	<tr>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->kasus->pasien->name ?? '-'}}</td>
		<td>{{$val->pemasangan}}</td>
		<td>{{$val->apd}}</td>
		<td>{{$val->alat_steril}}</td>
		<td>{{$val->hand_hygiene}}</td>
		<td>{{$val->lepas_indikasi}}</td>
		<td>{{$val->pengisian_balon}}</td>
		<td>{{$val->fiksasi_kateter}}</td>
		<td>{{$val->urine_bag_menggantung}}</td>
	</tr>
	@endforeach
</table>