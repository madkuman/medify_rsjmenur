<table>
	<tr>
		<td colspan="13">LAPORAN KEPATUHAN CUCI TANGAN</td>
	</tr>
	<tr>
		<td colspan="13">{{$user->name}}</td>
	</tr>
	<tr>
		<td colspan="13">{{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td colspan="13"></td>
	</tr>
	<tr>
		<td rowspan="2">#</td>
		<td rowspan="2">Tgl</td>
		<td rowspan="2">Mulai</td>
		<td rowspan="2">Selesai</td>
		<td colspan="5">Indikasi</td>
		<td colspan="4">Tindakan HH</td>
		<td rowspan="2">Skor</td>
	</tr>
	<tr>
		<td>Sebelum Kontak</td>
		<td>Sebelum Aseptic</td>
		<td>Setelah Darah C. Tubuh</td>
		<td>Setelah Kontak</td>
		<td>Setelah Lingkungan Px</td>
		<td>HR</td>
		<td>HW</td>
		<td>Tidak HH</td>
		<td>Glove</td>
	</tr>
	@php $total_skor = 0 @endphp
	@foreach($hh as $item)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{indonesian_date($item->tanggal,'d/m/Y')}}</td>
		<td>{{$item->jam_mulai ?? '-'}}</td>
		<td>{{$item->jam_selesai ?? '-'}}</td>
		<td>{{$item->sebelum_kontak == 1 ? 'Ya' : 'Tidak'}}</td>
		<td>{{$item->sebelum_aseptik == 1 ? 'Ya' : 'Tidak'}}</td>
		<td>{{$item->setelah_darah == 1 ? 'Ya' : 'Tidak'}}</td>
		<td>{{$item->setelah_kontak == 1 ? 'Ya' : 'Tidak'}}</td>
		<td>{{$item->setelah_lingkungan_px == 1 ? 'Ya' : 'Tidak'}}</td>
		<td>{{$item->tindakan_hr == 1 ? 'Ya' : 'Tidak'}}</td>
		<td>{{$item->tindakan_hw == 1 ? 'Ya' : 'Tidak'}}</td>
		<td>{{$item->tindakan_tidak_hh == 1 ? 'Ya' : 'Tidak'}}</td>
		<td>{{$item->tindakan_glove == 1 ? 'Ya' : 'Tidak'}}</td>
		@php 
			$skor = 0;
			if($item->sebelum_kontak == 1 || $item->sebelum_aseptik == 1 || $item->setelah_darah == 1 || $item->setelah_kontak == 1 || $item->setelah_lingkungan_px == 1)
			{
				if($item->tindakan_hr == 1 || $item->tindakan_hw == 1 || $item->tindakan_tidak_hh != 1 || $item->tindakan_glove == 1)
				$skor = 1;
			}
		@endphp
		<td>{{$skor}}</td>
		@php $total_skor += $skor @endphp
	</tr>
	@endforeach
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td></td>
		<td>Total Skor</td>
		<td></td>
		<td>{{$total_skor}}</td>
	</tr>
	<tr>
		<td></td>
		<td>Total Kesempatan</td>
		<td></td>
		<td>{{count($hh)}}</td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td></td>
		<td>Persentase</td>
		<td>Skor / Kesempatan</td>
		<td>
			@if(count($hh) > 0)
			{{number_format(($total_skor/count($hh)*100),2)}}%
			@else
			0
			@endif

		</td>
	</tr>
</table>