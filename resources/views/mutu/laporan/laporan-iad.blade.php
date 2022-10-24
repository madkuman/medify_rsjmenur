<table>
	<tr>
		<td colspan="13">AUDIT IAD BUNDLE CHECKLIST</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="3">Ruangan : {{$lokasi ?? '-'}}</td>
		<td colspan="4">Bulan/Tahun : {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr><td colspan="13"></td></tr>
	<tr>
		<td>Tanggal</td>
		<td>No</td>
		<td>Nama Pasien/No Bed</td>
		<td>Hand Hygiene</td>
		<td>Menggunakan APD</td>
		<td>Pembersihan kulit  dengan chlorhexidine</td>
		<td>Lokasi pemasangan sesuai</td>
		<td>Slang infuse diganti Sesuai standar</td>
		<td>Swab alcohol Setiap injeksi</td>
		<td>Spuit yang digunakan disposable</td>
		<td>Penutup insersi dengan transparan dressing</td>
		<td>Perawatan lokasi insersi setiap 4 hari dan jika kotor</td>
		<td>Menggunakan stopper needles</td>
	</tr>
	@foreach($bsi as $item)
	@php $val = json_decode($item->val) @endphp
	<tr>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->kasus->pasien->name ?? '-'}}</td>
		<td>{{$val->hand_hygiene}}</td>
		<td>{{$val->apd}}</td>
		<td>{{$val->pembersihan_chlorhexidine}}</td>
		<td>{{$val->lokasi_sesuai}}</td>
		<td>{{$val->selang_standard}}</td>
		<td>{{$val->swab_alkohol_injeksi}}</td>
		<td>{{$val->spuit_disposable}}</td>
		<td>{{$val->penutup_insersi}}</td>
		<td>{{$val->perawatan_lokasi_insersi}}</td>
		<td>{{$val->stopper_needles}}</td>
	</tr>
	@endforeach
</table>