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
		<td>Nomor Kartu BPJS</td>
		<td>Nomor SEP</td>
		<td>Anggota</td>
		<td>Kelas</td>
		<td>DPJP</td>
		<td>Perusahaan</td>
		<td>Deskripsi Tindakan</td>
		<td>Harga</td>
		<td>Jumlah</td>
		<td>Subtotal</td>
	</tr>
	@php $rekap_user = []; @endphp
	@php $count = 1 @endphp
	@foreach($data as $item)
	@php if(in_array($item->tarif_id,$tarif_id_exclusions)) continue; @endphp
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
		<td>{{$item->tagihan->kasus->pasien->no_rm ?? '-'}}</td>
		<td>{{$item->tagihan->kasus->pasien->name ?? '-'}}</td>
		@if(isset($item->tagihan->kasus->pembayaran->perusahaan->tipe->slug) && $item->tagihan->kasus->pembayaran->perusahaan->tipe->slug  == 'bpjs')
		<td>{{$item->tagihan->kasus->pembayaran->no_asuransi ?? '-'}}</td>
		@else
		<td></td>
		@endif
		<td>{{$item->tagihan->kasus->sep->no_sep ?? '-'}}</td>

		@php $is_anggota = $item->tagihan->kasus->pasien->is_anggota ?? '-' @endphp
		<td>{{ $is_anggota ? 'Anggota' : 'Non Anggota'}}</td>
		<td>Kelas {{$item->tagihan->kasus->kelas->nama ?? '3'}}</td>
		<td>{{$item->tagihan->kasus->admin->user->name ?? '-'}}</td>
		<td>{{$item->tagihan->kasus->pembayaran->perusahaan->perusahaan_keuangan->nama ?? '-'}}</td>
		<td>{{$item->desc ?? '-'}}</td>
		<td>{{$item->unit_price ?? '-'}}</td>
		<td>{{$item->qty ?? '-'}}</td>
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
	<tr><td></td><td>Rekapitulasi</td></tr>
	
	@foreach($rekap_user as $nama => $total)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$nama}}</td>
		<td>{{$total}}</td>
	</tr>
	@endforeach
</table>