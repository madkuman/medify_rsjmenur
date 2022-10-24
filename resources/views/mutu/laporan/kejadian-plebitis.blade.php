<table>
	<tr>
		<td colspan="5">KEJADIAN PLEBITIS</td>
	</tr>
	<tr>
		<td colspan="5"></td>
	</tr>
	<tr>
		<td>No</td>
		<td>Tgl</td>
		<td>Nama</td>
		<td>Lokasi</td>
		<td>Tanggal Pasang</td>
		<td>Tanggal Lepas</td>
		<td>Lama Pasang</td>
		<td>Diagnosa Dokter</td>
	</tr>


	@php
		$kejadian_total = 0;
		$total_hari_kejadian = 0;
		$total_hari_pemasangan = 0;
	@endphp
	
	@foreach($data as $item)
	@php $master = json_decode($item->val) @endphp
	@if(!empty($item->children) && count($item->children) > 0)
	@php $children = $item->children @endphp
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{indonesian_date($item->created_at,'d/m/Y')}}</td>
		<td>{{$item->kasus->pasien->name ?? '-'}}</td>
		<td>{{$item->lokasi->nama ?? '-'}}</td>

		@if(!empty($master))
		<td>{{$master->tanggal_pasang ?? ''}}</td>
		<td>{{$master->tanggal_lepas ?? ''}}</td>
		<td>
			@if(!empty($master->tanggal_pasang))
			@php $tanggal_pasang = Carbon\Carbon::createFromFormat('d-m-Y', $master->tanggal_pasang)@endphp
			@else
			@php $tanggal_pasang = Carbon\Carbon::today(); @endphp
			@endif

			@if(!empty($master->tanggal_lepas))
			@php $tanggal_lepas = Carbon\Carbon::createFromFormat('d-m-Y', $master->tanggal_lepas);@endphp
			@else
			@php $tanggal_lepas = Carbon\Carbon::today(); @endphp
			@endif

			@php $selisih = $tanggal_pasang->diffInDays($tanggal_lepas) @endphp

			{{$selisih ?? '0'}}
		</td>
		@else
		<td></td>
		<td></td>
		<td></td>
		@endif

		@php 
			$status_print = 0;
			$do_print = 0; 
		@endphp
		
		@foreach($children as $children_item)
			@php
				$item = json_decode($children_item->val);
				if($item->dx_dokter == 1 && $status_print == 0) $do_print = 1;
				elseif($status_print == 0 && $loop->last) $do_print = 1;
			@endphp


			@if($do_print == 1)
				@php 
					$status_print = 1;
					$do_print = 0; 
				@endphp

				<td>{{$item->dx_dokter ?? '0'}}</td>

				@if($item->dx_dokter)
					@php
						$kejadian_total++;
						$total_hari_kejadian += $selisih;
					@endphp
				@endif
				@php
					$total_hari_pemasangan += $selisih;
				@endphp
			@endif
		@endforeach
	</tr>
	@endif {{-- close if children is 0 --}}
	@endforeach
	

	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td>Persentase</td>
		<td></td>
		<td>Total Hari Pemasangan Yang Terjadi Plebitis</td>
		<td>{{$total_hari_kejadian}}</td>
		<td>
			@if($total_hari_pemasangan != 0)
			{{number_format($total_hari_kejadian/$total_hari_pemasangan*100,2)}}%
			@else
			0
			@endif
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>Total Hari Pemasangan</td>
		<td>{{$total_hari_pemasangan}}</td>
	</tr>
</table>