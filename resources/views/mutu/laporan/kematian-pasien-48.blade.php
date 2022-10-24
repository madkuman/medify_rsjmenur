<table>
	<tr>
		<td colspan="8">LAPORAN KEMATIAN PASIEN KURANG DARI 48 JAM</td>
	</tr>
	<tr>
		<td colspan="8">{{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	@php
		$i=0;
        $kurang=0;
        $lebih=0;
        $kurang_per_ruang=0;
        $lebih_per_ruang=0;
        $lokasi = -1;
        $lokasi_nama = '';
	@endphp
	@foreach($data as $item)
		@if($lokasi != (!empty($item->lokasi->lokasi) ? $item->lokasi->lokasi->id : 0))
			@if($lokasi != -1)
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan="3"><b>Laporan Kematian Pasien Kurang Dari 48 Jam {{$lokasi_nama}}</b></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan="3">Jumlah Kematian Pasien Kurang Dari 48 Jam</td>
					<td>{{$kurang_per_ruang}}</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan="3">Jumlah Kematian Pasien</td>
					<td>{{$kurang_per_ruang+$lebih_per_ruang}}</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan="3">Persentase Kematian Pasien Kurang Dari 48 Jam</td>
					<td>{{($kurang_per_ruang != 0 || $lebih_per_ruang != 0) ? round(($kurang_per_ruang/($kurang_per_ruang+$lebih_per_ruang))*100, 2) : 0}} %</td>
				</tr>
				@php
					$kurang_per_ruang = 0;
                    $lebih_per_ruang = 0;
                    $i = 0;
				@endphp
			@endif
			<tr>
				<td colspan="8"></td>
			</tr>
			<tr>
				<td colspan="8">{{!empty($item->lokasi->lokasi) ? $item->lokasi->lokasi->nama : '-'}}</td>
			</tr>

			<tr>
				<td rowspan="2">No</td>
				<td rowspan="2">Nama</td>
				<td rowspan="2">Tgl MRS</td>
				<td rowspan="2">Tgl Kematian</td>
				<td rowspan="2">Lokasi</td>
				<td colspan="2">Diagnosis</td>
				<td rowspan="2">Kurang 48 jam</td>
			</tr>
			<tr>
				<td>Kode</td>
				<td>Judul</td>
			</tr>
			@php
				$lokasi = !empty($item->lokasi->lokasi) ? $item->lokasi->lokasi->id : 0;
                $lokasi_nama = !empty($item->lokasi->lokasi) ? $item->lokasi->lokasi->nama : '-';
			@endphp
		@endif

		@php
			$rowspan=count($item->diagnosis);
            if($rowspan == 0){
                $rowspan = 1;
            }
            if($item->kurang_dari_48==1){
                $kurang++;
                $kurang_per_ruang++;
            }else{
                $lebih++;
                $lebih_per_ruang++;
            }
		@endphp
		<tr>
			<td rowspan="{{$rowspan}}">{{++$i}}</td>
			<td rowspan="{{$rowspan}}">{{$item->pasien->name ?? '-'}}</td>
			<td rowspan="{{$rowspan}}">{{indonesian_date($item->waktu_mrs,'d F Y H:i')}}</td>
			<td rowspan="{{$rowspan}}">@if(!empty($item->pasien->death_at)) {{indonesian_date($item->pasien->death_at,'d F Y H:i')}}
				@else {{ indonesian_date($item->krs_at,'d F Y H:i') }}
				@endif
			</td>
			<td rowspan="{{$rowspan}}">
				{{$item->lokasi->lokasi->nama ?? ''}}
			</td>

		@if(count($item->diagnosis) > 0)
			@foreach($item->diagnosis as $dx)
				@if(!$loop->first)
					<tr>
						@endif
						<td>{{$dx->icd10->code_icd ?? '-'}}</td>
						<td>{{$dx->icd10->long_desc ?? '-'}}</td>
						@if(!$loop->last)
							@if(!$loop->first)
					</tr>
				@else
					<td rowspan="{{$rowspan}}">@if($item->kurang_dari_48==1)&#10004;@endif</td>
				@endif
				@endif
			@endforeach
		@else
			<td>-</td>
			<td>-</td>
			<td rowspan="{{$rowspan}}">@if($item->kurang_dari_48==1)&#10004;@endif</td>
			@endif
			</tr>
			@endforeach
			@if($lebih_per_ruang > 0 || $kurang_per_ruang > 0)
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="3"><b>Laporan Kematian Pasien Kurang Dari 48 Jam {{$lokasi_nama}}</b></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="3">Jumlah Kematian Pasien Kurang Dari 48 Jam</td>
				<td>{{$kurang_per_ruang}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="3">Jumlah Kematian Pasien</td>
				<td>{{$kurang_per_ruang+$lebih_per_ruang}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="3">Persentase Kematian Pasien Kurang Dari 48 Jam</td>
				<td>{{($kurang_per_ruang != 0 || $lebih_per_ruang != 0) ? round(($kurang_per_ruang/($kurang_per_ruang+$lebih_per_ruang))*100, 2) : 0}} %</td>
			</tr>
			<tr>
				<td colspan="8"></td>
			</tr>
				@endif
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="3"><b>Kesimpulan Laporan Kematian Pasien Kurang Dari 48 Jam</b></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="3">Jumlah Kematian Pasien Kurang Dari 48 Jam</td>
				<td>{{$kurang}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="3">Jumlah Kematian Pasien</td>
				<td>{{$kurang+$lebih}}</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="3">Persentase Kematian Pasien Kurang Dari 48 Jam</td>
				<td>{{($kurang != 0 || $lebih != 0) ? round(($kurang/($kurang+$lebih))*100, 2) : 0}} %</td>
			</tr>
</table>