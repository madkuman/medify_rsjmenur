<table>
	<tr>
		<td colspan="7">KEPATUHAN IDENTIFIKASI PASIEN</td>
	</tr>
	<tr>
		<td colspan="3">Ruangan : {{$lokasi ?? '-'}}</td>
		<td colspan="4">Bulan/Tahun : {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td>No</td>
		<td>Tgl</td>
		<td>Nama Pasien</td>
		<td>Jenis Tindakan</td>
		<td>Memakai Gelang</td>
		<td>Pemakaian Gelang Sesuai</td>
		<td>Identifikasi 2 dari 3</td>
		<td>Pertanyaan Kalimat Terbuka</td>
		<td>Identitas Pasien Berupa Photo Diri *jiwa dan radioterapi</td>
	</tr>
	@foreach($data as $item)
	@php $val = json_decode($item->val) @endphp
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$item->kasus->pasien->name ?? '-'}}</td>
		<td>{{$val->jenis_tindakan ?? ''}}</td>
		<td>{{$val->gelang ?? ''}}</td>
		<td>{{$val->gelang_sesuai ?? ''}}</td>
		<td>{{$val->identifikasi_px ?? ''}}</td>
		<td>{{$val->pertanyaan_terbuka ?? ''}}</td>
		<td>{{$val->photo ?? ''}}</td>
	</tr>
	@endforeach
</table>