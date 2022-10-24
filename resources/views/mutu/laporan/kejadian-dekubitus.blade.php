<table>
	<tr>
		<td colspan="5">KEJADIAN DEKUBITUS</td>
	</tr>
	<tr>
		<td colspan="5"></td>
	</tr>
	<tr>
		<td>No</td>
		<td>Tgl</td>
		<td>Nama Pasien</td>
		<td>Lokasi</td>
		<td>Derajat</td>
		<td>Hari ke</td>
		<td>Jml Hari Tirah Baring</td>
		<td>Terjadi di RS</td>
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
			if(count($item->kasus->TransaksiRawatInap) != 0)
				$tanggal_mrs = $item->kasus->TransaksiRawatInap[0]->waktu_masuk;
			else
				$tanggal_mrs = $item->kasus->created_at;
			$hari_ke = $item->created_at->diffInDays($tanggal_mrs);
			$is_kejadian = $hari_ke > 3 ? 1 : 0
		@endphp

		@php
			if($is_kejadian == 1 && $status_print == 0) $do_print = 1;
			elseif($status_print == 0 && $loop->last) $do_print = 1;
		@endphp

		@php
			$lama_tirah_baring = $item->kasus->identitas->lama_tirah_baring
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
					<td>{{$val->derajat ?? ''}}</td>
					<td>{{$hari_ke}}</td>
					<td>{{$lama_tirah_baring}}</td>
					<td>{{$is_kejadian}}</td>
					@if($is_kejadian)
						@php
							$kejadian_total++;
							$total_hari_kejadian += $lama_tirah_baring;
						@endphp
					@endif
					@php
						$total_hari_tirah_baring += $lama_tirah_baring;
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
		<td colspan="3">Total Hari Tirah Baring Yang Terjadi Dekubitus</td>
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