<table>
	<tr>
		<td colspan="13">AUDIT IAD BUNDLE CHECKLIST</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="3">Ruangan : {{$lokasi ?? '-'}}</td>
		<td colspan="4">Bulan/Tahun : {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr><td colspan="16"></td></tr>
	<tr>
		<td>Tanggal</td>
		<td>No</td>
		<td>Nama Pasien</td>
		<td>Lokasi</td>
		<td>Tanggal Pasang</td>
		<td>Tanggal Lepas</td>
		<td>Lama Pasang</td>
		<td>Kuman pada kultur darah</td>
		<td>Demam 38 C</td>
		<td>Hipotensi</td>
		<td>Menggigil</td>
		<td>Hipothermi 37 C</td>
		<td>Apneu</td>
		<td>Brakikardia</td>
		<td>Kultur CVC</td>
		<td>Kultur CVC Keterangan</td>
		<td>Diagnosis Dokter BSI</td>
	</tr>

			
	@php
		$kejadian_total = 0;
		$total_hari_kejadian = 0;
		$total_hari_pemasangan = 0;
	@endphp

	@foreach($bsi as $item)
	@php $master = json_decode($item->val) @endphp
	@if(!empty($item->children) && count($item->children) > 0)
	@php $children = $item->children @endphp
	<tr>
		<td>{{indonesian_date($item->created_at,'d-m-Y')}}</td>
		<td>{{$loop->iteration}}</td>
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
				<td>{{$item->kuman ?? '0'}}</td>
				<td>{{$item->demam ?? '0'}}</td>
				<td>{{$item->hipotensi ?? '0'}}</td>
				<td>{{$item->menggigil ?? '0'}}</td>
				<td>{{$item->hipothermi ?? '0'}}</td>
				<td>{{$item->apneu ?? '0'}}</td>
				<td>{{$item->brakikardia ?? '0'}}</td>
				<td>{{$item->kultur_cvc ?? '0'}}</td>
				<td>{{$item->kultur_cvc_keterangan ?? '-'}}</td>
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
		<td colspan="3">Total Kejadian</td>
		<td>{{$kejadian_total}}</td>
	</tr>
	<tr>
		<td colspan="3">Total Hari Pemasangan Yang Terjadi IAD</td>
		<td>{{$total_hari_kejadian}}</td>
	</tr>
	<tr>
		<td colspan="3">Total Hari Pemasangan</td>
		<td>{{$total_hari_pemasangan}}</td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td>Persentase</td>
		<td></td>
		<td>Total Hari Pemasangan Yang Terjadi IAD</td>
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