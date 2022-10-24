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
		<td>No RM</td>
		<td>Pasien</td>
		<td>Nomor Kartu</td>
		<td>Anggota</td>
		<td>Kelas</td>
		<td>Perusahaan</td>
		<td>Deskripsi Tindakan</td>
		<td>Harga</td>
		<td>Jumlah</td>
		<td>Subtotal</td>
	</tr>
	@php $rekap_user = []; @endphp
	@php $count = 1 @endphp
	@foreach($data as $item)
	@php 
		if(empty($rekap_user[$item->creator->name]))
			$rekap_user[$item->creator->name] = 0;
	@endphp
	<tr>
		<td>{{$count++}}</td>
		<td>{{$item->creator->name ?? '-'}}</td>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$item->lokasi->nama ?? '-'}}</td>
		<td>{{$item->lokasi->departemen->nama ?? '-'}}</td>
		<td>{{$item->pemasukan->pasien->no_rm ?? '-'}}</td>
		<td>{{$item->pemasukan->pasien->name ?? '-'}}</td>
		<td>{{$item->pemasukan->pasienPembayaran->no_asuransi ?? '-'}}</td>
		@php $is_anggota = $item->pemasukan->pasien->is_anggota ?? '-' @endphp
		<td>{{ $is_anggota ? 'Anggota' : 'Non Anggota'}}</td>
		<td>{{$item->pemasukan->pasienPembayaran->kelas->nama ?? '-'}}</td>
		<td>{{$item->pemasukan->pasienPembayaran->perusahaan->perusahaan_keuangan->nama ?? '-'}}</td>
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