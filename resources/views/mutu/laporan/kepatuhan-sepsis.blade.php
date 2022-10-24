<table>
	<tr>
		<td colspan="5">KEPATUHAN SEPSIS</td>
	</tr>
	<tr>
		<td colspan="5"></td>
	</tr>
	<tr>
		<td>No</td>
		<td>Tgl</td>
		<td>Nama</td>
		<td>Lokasi</td>
		<td>Diagnosa Dokter</td>
		<td>Terjadi Di Luar Rumah Sakit</td>
	</tr>
	@php $kejadian_total = 0 @endphp
	@foreach($data as $item)
	@php $val = json_decode($item->val) @endphp
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$item->kasus->pasien->name ?? '-'}}</td>
		<td>{{
				$item->lokasi->nama ?? 
				$item->sister_kasus[0]->lokasi->nama ?? 
				$item->sister_kasus[1]->lokasi->nama ?? 
				'-'
			}}
		</td>
		<td>{{$val->dx_dokter ?? ''}}</td>
		<td>{{$val->terjadi_di_luar_rs ?? ''}}</td>
		@if(!empty($val->dx_dokter) && !empty($val->terjadi_di_luar_rs))
			@if($val->dx_dokter == 1 && $val->terjadi_di_luar_rs == 1)
				@php $kejadian_total++ @endphp
			@endif
		@endif
	</tr>
	@endforeach


	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td colspan="3">Total Kejadian</td>
		<td>{{$kejadian_total}}</td>
	</tr>
	<tr>
		<td colspan="3">Total Jumlah Pasien Rawat Inap</td>
		<td>{{$ranap_transaksi}}</td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td>Persentase</td>
		<td></td>
		<td>Total Pasien dengan Sepsis</td>
		<td>{{$kejadian_total}}</td>
		<td>
			@if($ranap_transaksi != 0)
			{{number_format($kejadian_total/$ranap_transaksi*100,2)}}%
			@else
			0
			@endif
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>Total Hari Pemasangan</td>
		<td>{{$ranap_transaksi}}</td>
	</tr>
</table>