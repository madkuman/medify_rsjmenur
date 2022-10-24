<table>
	<tr>
		<td colspan="5">KEJADIAN HAP</td>
	</tr>
	<tr>
		<td colspan="5"></td>
	</tr>
	<tr>
		<td>No</td>
		<td>Tgl</td>
		<td>Nama</td>
		<td>Lokasi</td>
		<td>Lama Tirah Baring</td>
		<td>Diagnosa Dokter</td>
	</tr>
	
	@php
		$kejadian_total = 0;
		$total_hari_kejadian = 0;
		$total_hari_tirah_baring = 0;
	@endphp

	@foreach($data as $collection_data)
		@php
			$status_print = 0;
			$do_print = 0; 
		@endphp
		@foreach($collection_data as $item)

			@php $val = json_decode($item->val) @endphp
			@php
				if($val->dx_dokter == 1 && $status_print == 0) $do_print = 1;
				elseif($status_print == 0 && $loop->last) $do_print = 1;
			@endphp

			@if($do_print == 1)
				@php 
					$status_print = 1;
					$do_print = 0; 
				@endphp
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
					<td>
						@php
							if(!empty($item->kasus->identitas->tanggal_tirah_baring_start)){
								$tirah_start = $item->kasus->identitas->tanggal_tirah_baring_start;
								$tirah_start = Carbon\Carbon::parse($tirah_start);
							}
							else
								$tirah_start = Carbon\Carbon::today();

							if(!empty($item->kasus->identitas->tanggal_tirah_baring_end)){
								$tirah_end = $item->kasus->identitas->tanggal_tirah_baring_end;
								$tirah_end = Carbon\Carbon::parse($tirah_end);
							}
							else
								$tirah_end = Carbon\Carbon::today();

							$selisih = $tirah_start->diffInDays($tirah_end);

						@endphp

						{{$selisih}}
					</td>
					<td>{{$val->dx_dokter ?? ''}}</td>
					@if($val->dx_dokter)
						@php
							$kejadian_total++;
							$total_hari_kejadian += $selisih;
						@endphp
					@endif
					@php
						$total_hari_tirah_baring += $selisih;
					@endphp
				</tr>
			@endif
		@endforeach
	@endforeach
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td colspan="3">Total Kejadian</td>
		<td>{{$kejadian_total}}</td>
	</tr>
	<tr>
		<td colspan="3">Total Hari Tirah Baring Yang Terjadi HAP</td>
		<td>{{$total_hari_kejadian}}</td>
	</tr>
	<tr>
		<td colspan="3">Total Hari Tirah Baring</td>
		<td>{{$total_hari_tirah_baring}}</td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td>Persentase</td>
		<td></td>
		<td>Total Hari Kejadian * 1000</td>
		<td>{{$kejadian_total}}</td>
		<td>
			@if($total_hari_tirah_baring != 0)
			{{number_format($kejadian_total/$total_hari_tirah_baring*1000,2)}} Per Mil
			@else
			0
			@endif
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>Total Hari Tirah Baring</td>
		<td>{{$total_hari_tirah_baring}}</td>
	</tr>
</table>