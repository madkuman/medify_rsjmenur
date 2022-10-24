<table>
	<tr>
		<td colspan="11">LAPORAN KINERJA FARMASI</td>
	</tr>
	<tr>
		<td colspan="11">Tanggal : {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr><td colspan="11"></td></tr>
	<tr>
		<td>No</td>
		<td>Nama Personil</td>
		<td>Tanggal</td>
		<td>Farmasi</td>
		<td>No RM</td>
		<td>Pasien</td>
		<td>Anggota</td>
		<td>Kelas</td>
		<td>DPJP</td>
		<td>Dokter Penulis Resep</td>
		<td>Perusahaan</td>
		<td>Nama Obat</td>
		<td>Harga Dasar</td>
		<td>Jumlah</td>
		<td>Laba</td>
		<td>Subtotal</td>
	</tr>
	@php $rekap_user = []; @endphp
	@php $count = 1 @endphp
	@foreach($data as $item)
	@php $transaksi = $item->resep->transaksi @endphp
	@php $user = $transaksi->paidBy->name ?? '-' @endphp
	@php 
		if(empty($rekap_user[$user]))
			$rekap_user[$user] = 0;
	@endphp

	<tr>
		<td>{{$count++}}</td>
		<td>{{$user ?? '-'}}</td>
		<td>{{indonesian_date($transaksi->paid_at,'d/m/Y')}}</td>
		<td>{{$transaksi->owner_detail->nama ?? '-'}}</td>
		<td>{{$transaksi->pasien_detail->no_rm ?? '-'}}</td>
		<td>{{$transaksi->pasien_detail->name ?? '-'}}</td>
		@php $is_anggota = $transaksi->pasien_detail->is_anggota ?? '-' @endphp
		<td>{{ $is_anggota ? 'Anggota' : 'Non Anggota'}}</td>
		<td>{{$transaksi->kasus->kelas->nama ?? '-'}}</td>
		<td>{{$transaksi->kasus->admin->user->name ?? '-'}}</td>
		<td>{{$transaksi->dokter_nama ?? '-'}}</td>
		<td>{{$transaksi->pembayaran_detail->perusahaan->perusahaan_keuangan->nama ?? '-'}}</td>
		<td>{{$item->nama_obat ?? '-'}}</td>
		@php
			$harga = round($item->harga / (100+$item->laba) * 100,0);
			$laba = ($item->subtotal) - ($harga*$item->jumlah);
		@endphp
		<td>{{$harga }}</td>
		<td>{{$item->jumlah ?? '-'}}</td>
		<td>{{$laba}}</td>
		<td>{{$item->subtotal ?? '-'}}</td>
	</tr>
	@php 
		$rekap_user[$user] = $rekap_user[$user] + $item->subtotal;
	@endphp

	@endforeach

	<tr><td colspan="11">1. Harga dasar adalah harga obat setiap buahnya saat melakukan pembelian pada PBF</td></tr>
	<tr><td colspan="11">2. Laba adalah total laba setiap transaksi bukan setiap buah.</td></tr>
	<tr><td colspan="11">3. Subtotal : Harga Dasar * Jumlah + Laba</td></tr>
	<tr><td colspan="11">4. Dokter penulis resep tidak selalu dokter DPJP. Dokter penulis resep bisa jadi dokter konsulen</td></tr>
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