<table>
	<tr>
		<td colspan="11">LAPORAN KINERJA PERSONIL BERDASARKAN TAGIHAN</td>
	</tr>
	<tr>
		<td colspan="11">Tanggal : {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr><td colspan="11"></td></tr>
	<tr>
		<td>No</td>
		<td>Nama Personil</td>
		<td>Tanggal</td>
		<td>Lokasi</td>
		<td>Departemen</td>
		<td>Pasien</td>
		<td>Nomor SEP</td>
		<td>DPJP</td>
		<td>Perusahaan</td>
		<td>Deskripsi Tindakan</td>
		<td>Harga</td>
		<td>Jumlah</td>
		<td>Subtotal</td>
	</tr>
	@php $rekap_user = []; @endphp
	@foreach($data as $item)
	@php 
		if(empty($rekap_user[$item->creator->name]))
			$rekap_user[$item->creator->name] = 0;
	@endphp
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->creator->name ?? '-'}}</td>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$item->lokasi->nama ?? '-'}}</td>
		<td>{{$item->lokasi->departemen->nama ?? '-'}}</td>
		<td>{{$item->pemasukan->pasien->name ?? '-'}}</td>
		<td>-</td>	
		<td>{{$item->pemasukan->piutang->kasusTagihan->kasus->admin->user->name ?? '-'}}</td>
		<td>{{$item->pemasukan->perusahaan->nama ?? '-'}}</td>
		<td>{{$item->deskripsi ?? '-'}}</td>
		<td>{{$item->harga ?? '-'}}</td>
		<td>{{$item->jumlah ?? '-'}}</td>
		<td>{{$item->subtotal ?? '-'}}</td>
	</tr>
	@php 
		$rekap_user[$item->creator->name] = $rekap_user[$item->creator->name] + $item->subtotal;
	@endphp

	@endforeach

	<tr><td colspan="11"></td></tr>
	<tr><td colspan="11"></td></tr>
	<tr><td colspan="11"></td></tr>
	<tr><td colspan="11"></td></tr>
	<tr><td colspan="11"></td></tr>
	<tr><td colspan="11"></td></tr>
	<tr><td colspan="11"></td></tr>
	<tr><td colspan="11"></td></tr>
	
	@foreach($rekap_user as $nama => $total)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$nama}}</td>
		<td>{{$total}}</td>
	</tr>
	@endforeach
</table>