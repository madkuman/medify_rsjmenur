<table>
	<tr>
        <td></td>
		<td colspan="3">Pelaksanaan Pemberian Obat</td>
	</tr>
	<tr>
		<td></td>
	</tr>
    <tr>
        <td></td>
        <td>No RM </td>
        <td>: {{ $kasus->pasien->no_rm }}</td>
    </tr>
    <tr>
        <td></td>
        <td>Nama </td>
        <td>: {{ $kasus->identitas->nama }}</td>
    </tr>
    <tr>
        <td></td>
        <td>Tgl Lahir / Umur </td>
        <td>: {{ date("d/m/Y", strtotime($kasus->identitas->tanggal_lahir)) }} / {{$kasus->identitas->umur}} Tahun</td>
    </tr>
    <tr>
        <td></td>
        <td>Jenis Kelamin </td>
        <td>{!! $kasus->identitas->jenis_kelamin !!}</td>
    </tr>
    <tr>
        <td></td>
        <td>Ruang </td>
        <td>: {{$kasus->lokasi->lokasi->nama}}</td>
    </tr>
	<tr>
		<th rowspan="2">No</th>
		<th rowspan="2" colspan="2">Nama Obat</th>
		@foreach($riwayat_date as $item)
		<th colspan="{{$riwayat_date_count[$item->format('d F Y')]}}">{{$item->format('d F')}}</th>
		@endforeach
	</tr>
	<tr>
		@foreach($riwayat_date as $item)
		@php $count = $riwayat_date_count[$item->format('d F Y')] @endphp
		@for($i = 1; $i <= $count; $i++)
		<th>{{$i}}</th>
		@endfor
		@endforeach
	</tr>
	@foreach($pengobatan as $index => $obat)
	<tr>
		<td rowspan="2">{{++$index}}</td>
		<td>{{$obat->nama_obat ?? "-"}}</td>
		<td>Jam</td>
		@php $index = 0 @endphp
		@php $count_td = 0 @endphp

		@php
            $array_item_printed = [];
            $sisa_obat = [];
        @endphp
		@foreach($riwayat_date as $indek =>  $date_now)
		@php $count = $riwayat_date_count[$date_now->format('d F Y')] @endphp


		@for($i = 1; $i <= $count; $i++)

		@php
		if(count($obat->details) > 0)
		{
			if(!empty($obat->details[$index]))
			{
				$time = $obat->details[$index]->pemberian_at;
				$start = $date_now->copy()->startOfDay();
				$end = $date_now->copy()->endOfDay();

				$bool = Carbon\Carbon::parse($time)->between($start, $end);
			}
			else $bool = false;
		}
		else $bool = false;
        $sisa_obat[$indek]['count'] = $count;
        $sisa_obat[$indek]['bool'][$i] = $bool;
        if(isset($obat_resep[$obat->nama_obat][$obat->aturan_pemakaian]) && isset($obat->details[$index]->jumlah)) $obat_resep[$obat->nama_obat][$obat->aturan_pemakaian] -= $obat->details[$index]->jumlah;
        $sisa_obat[$indek]['sisa_obat'][$i] =  $obat_resep[$obat->nama_obat][$obat->aturan_pemakaian] ?? null;
        @endphp

		@if($bool)
		@php $array_item_printed[$count_td++] = $index @endphp
		<td align="center">{{indonesian_date($obat->details[$index]->pemberian_at,'H:i')}}</td>
		@php $index++ @endphp
		@else
		@php $array_item_printed[$count_td++] = 404 @endphp
		<td></td>
		@endif

		@endfor
		@endforeach
	</tr>
		<tr>
			<td>Rute : {{$obat->rute ?? '-'}}, Aturan : {{$obat->aturan_pemakaian ?? '-'}} </td>
			<td>Sisa Obat</td>
            @foreach($riwayat_date as $indek =>  $date_now)
                @php $count = $sisa_obat[$indek]['count'] ?? 0 @endphp


                @for($i = 1; $i <= $count; $i++)
                    @if($sisa_obat[$indek]['bool'][$i])
                    <td>{{$sisa_obat[$indek]['sisa_obat'][$i]}}</td>
                    @else
                        <td></td>
                        @endif
                @endfor
            @endforeach
		</tr>
	@endforeach
</table>