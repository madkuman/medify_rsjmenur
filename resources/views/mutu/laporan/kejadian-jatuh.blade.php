<table>
	<tr>
		<td colspan="4">KEJADIAN JATUH</td>
	</tr>
	<tr>
		<td colspan="4"></td>
	</tr>
	<tr>
		<td>No</td>
		<td>Tgl</td>
		<td>Nama Pasien</td>
		<td>Lokasi</td>
		<td>Akibat Jatuh</td>
		<td>Keterangan</td>
	</tr>
	@php
		$total_jatuh=0;
		$total_jatuh_mati=0;
		$total_jatuh_cacat=0;
		$total_jatuh_tidak_cacat=0;

	@endphp
	@foreach($data as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$item->kasus->pasien->name ?? '-'}}</td>
		<td>{{$item->lokasi->nama ?? ''}}</td>
		<td>{{$item->akibat_jatuh ?? ''}}</td>
		<td>{{$item->keterangan ?? ''}}</td>
		@php
			if($item->akibat_jatuh == 'Mati') $total_jatuh_mati++;
			elseif($item->akibat_jatuh == 'Cacat') $total_jatuh_cacat++;
			elseif($item->akibat_jatuh == 'Tidak Cacat') $total_jatuh_tidak_cacat++;

			$total_jatuh++;
		@endphp
	</tr>
	@endforeach
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td></td>
		<td colspan="2">Total Pasien Ranap</td>
		<td></td>
		<td>{{$ranap_transaksi}}</td>
	</tr>
	<tr></tr>
	<tr>
		<td></td>
		<td colspan="2">Kejadian Jatuh</td>
		<td></td>
		<td>{{$total_jatuh}}</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Jatuh Tidak Cacat</td>
		<td></td>
		<td>{{$total_jatuh_tidak_cacat}}</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Jatuh Cacat</td>
		<td></td>
		<td>{{$total_jatuh_cacat}}</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Jatuh Meninggal</td>
		<td></td>
		<td>{{$total_jatuh_mati}}</td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td></td>
		<td colspan="2">Persentase Kejadian</td>
		<td>Pasien Jatuh / Total Pasien Ranap</td>
		<td>
			@if($ranap_transaksi != 0)
			{{number_format($total_jatuh/$ranap_transaksi*100,2)}}%
			@else
			0
			@endif
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Persentase Jatuh Tidak Cacat</td>
		<td>Pasien Jatuh Tidak Cacat/ Total Pasien Ranap</td>
		<td>
			@if($ranap_transaksi != 0)
			{{number_format($total_jatuh_tidak_cacat/$ranap_transaksi*100,2)}}%
			@else
			0
			@endif
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Persentase Jatuh Cacat</td>
		<td>Pasien Jatuh Cacat/ Total Pasien Ranap</td>
		<td>
			@if($ranap_transaksi != 0)
			{{number_format($total_jatuh_cacat/$ranap_transaksi*100,2)}}%
			@else
			0
			@endif
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Persentase Jatuh Mati</td>
		<td>Pasien Jatuh Mati/ Total Pasien Ranap</td>
		<td>
			@if($ranap_transaksi != 0)
			{{number_format($total_jatuh_mati/$ranap_transaksi*100,2)}}%
			@else
			0
			@endif
		</td>
	</tr>
</table>