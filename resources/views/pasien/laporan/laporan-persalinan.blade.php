<table>
	<tr>
		<td colspan="18">
			LAPORAN BULANAN PERSALINAN
		</td>
	</tr>
	<tr>
		<td colspan="18">Periode : {{$start->format('d-m-Y')}} s/d {{$end->format('d-m-Y')}}</td>
	</tr>
	<tr></tr>
	<tr>
		<td rowspan="3">NO.</td>
		<td rowspan="3">NAMA PASIEN</td>
		<td rowspan="3">NIK IBU BERSALIN</td>
		<td rowspan="3">NAMA SUAMI</td>
		<td rowspan="3">ALAMAT</td>
		<td rowspan="3">UMUR</td>
		<td rowspan="3">USIA KEHAMILAN</td>
		<td rowspan="3">TANGGAL PERSALINAN</td>
		<td colspan="3">JENIS PERSALINAN</td>
		<td colspan="2">JENIS KELAMIN</td>
		<td colspan="2">BAYI</td>
		<td rowspan="3">BERAT BADAN BAYI SAAT LAHIR</td>
		<td colspan="2">MATERNAL</td>
	</tr>
	<tr>
		<td rowspan="2">TUNGGAL</td>
		<td colspan="2">GEMELLI/KEMBAR</td>
		<td rowspan="2">BAYI LK</td>
		<td rowspan="2">BAYI PR</td>
		<td rowspan="2">HIDUP</td>
		<td rowspan="2">MATI</td>
		<td rowspan="2">HIDUP</td>
		<td rowspan="2">MATI</td>
	</tr>
	<tr>
		<td>2</td>
		<td>>= 3</td>
	</tr>
	@foreach($data as $item)
	@php $bayi_json = [] @endphp
	@php $item_json = json_decode($item->val) @endphp
	@foreach($item->children as $index => $bayi)
		@php $bayi_json[$index] = json_decode($bayi->val) @endphp
	@endforeach
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$item->kasus->pasien->name}}</td>
		<td>{{$item->kasus->pasien->no_identitas}}</td>
		<td>{{$item_json->nama_suami}}</td>
		<td>{{$item->kasus->pasien->address}}, {{$item->kasus->pasien->alamat_kecamatan->nama ?? ''}}, {{$item->kasus->pasien->alamat_kota->nama ?? ''}}</td>
		<td>{{$item->kasus->identitas->age_year}}</td>
		<td>{{$item_json->usia_kehamilan}}</td>
		<td>{{\Carbon\Carbon::parse($item_json->lahir_kk_pecah)->format('d-m-Y')}}</td>
		<td>@if($item_json->jenis_persalinan == 1) X @endif</td>
		<td>@if($item_json->jenis_persalinan == 2) X @endif</td>
		<td>@if($item_json->jenis_persalinan > 3) X @endif</td>

		<td>
			@php $total = 0; @endphp
			@foreach($bayi_json as $bayi_json_item)
			@php
				if($bayi_json_item->jenis_kelamin == 'L') $total++;
			@endphp
			@endforeach
			{{$total}}
		</td>
		<td>
			@php $total = 0; @endphp
			@foreach($bayi_json as $bayi_json_item)
			@php
				if($bayi_json_item->jenis_kelamin == 'P') $total++;
			@endphp
			@endforeach
			{{$total}}
		</td>
		<td>
			@php $total = 0; @endphp
			@foreach($bayi_json as $bayi_json_item)
			@php
				if($bayi_json_item->lahir_hidup_mati == 'Hidup') $total++;
			@endphp
			@endforeach
			{{$total}}
		</td>
		<td>
			@php $total = 0; @endphp
			@foreach($bayi_json as $bayi_json_item)
			@php
				if($bayi_json_item->lahir_hidup_mati == 'Mati') $total++;
			@endphp
			@endforeach
			{{$total}}
		</td>
		<td>
			@php $total = 0; @endphp
			@foreach($bayi_json as $bayi_json_item)
			{{$bayi_json_item->berat_badan}}
			@if(!$loop->last),@endif
			@endforeach
		</td>
		<td>@if($item_json->maternal != 'Mati') X @endif</td>
		<td>@if($item_json->maternal == 'Mati') X @endif</td>
	</tr>
	@endforeach
</table>
