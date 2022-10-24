<table>
	<tr>
		<td colspan="25">INDIKATOR KINERJA PELAYANAN DI RUMAH SAKIT</td>
	</tr>
	<tr>
		<td colspan="25">DI {{config('app.name')}}</td>
	</tr>
	<tr>
		<td colspan="25">TAHUN {{$tahun}}</td>
	</tr>
	<tr>
		<td colspan="25"></td>
	</tr>
	<tr>
		<td rowspan="4">NO</td>
		<td rowspan="4">BULAN</td>
		<td rowspan="4">JENIS RS</td>
		<td rowspan="4">JUMLAH TEMPAT TIDUR</td>
		<td colspan="9">JUMLAH PASIEN</td>
		<td rowspan="4">JUMLAH HARI PERAWATAN</td>
		<td rowspan="4">LAMA DIRAWAT</td>
		<td rowspan="4">BOR (%)</td>
		<td rowspan="4">BTO (kali)</td>
		<td rowspan="4">LOS (hari)</td>
		<td rowspan="4">TOI (hari)</td>
		<td rowspan="3" colspan="3">GDR</td>
		<td rowspan="3" colspan="3">NDR</td>
	</tr>
	<tr>
		<td colspan="3" rowspan="2">PASIEN KELUAR (HIDUP + MATI)</td>
		<td colspan="3" rowspan="2">PASIEN KELUAR MATI</td>	
		<td colspan="3" rowspan="2">PASIEN KELUAR MATI  ≥ 48 JAM DIRAWAT</td>
	</tr>
	<tr>
		<td></td>
	</tr>
	<tr>
		<td>L</td>
		<td>P</td>
		<td>L+P</td>
		<td>L</td>
		<td>P</td>
		<td>L+P</td>
		<td>L</td>
		<td>P</td>
		<td>L+P</td>
		<td>L</td>
		<td>P</td>
		<td>L+P</td>
		<td>L</td>
		<td>P</td>
		<td>L+P</td>
	</tr>
	@php
	$bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','November','Desember']
	@endphp
	@foreach($bulan as $index => $bln)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td>{{$bln}}</td>
		<td></td>
		<td>{{$jumlah_tt[$index]}}</td>
		
		<td>{{$pasien_krs_l[$index]}}</td>
		<td>{{$pasien_krs_p[$index]}}</td>
		<td>{{$pasien_krs[$index]}}</td>

		<td>{{$pasien_krs_mati_l[$index]}}</td>
		<td>{{$pasien_krs_mati_p[$index]}}</td>
		<td>{{$pasien_krs_mati[$index]}}</td>
		
		<td>{{$pasien_krs_mati_lebih_48_l[$index]}}</td>
		<td>{{$pasien_krs_mati_lebih_48_p[$index]}}</td>
		<td>{{$pasien_krs_mati_lebih_48[$index]}}</td>
		
		<td>{{$hari_perawatan[$index]}}</td>
		<td>{{$lama_dirawat[$index]}}</td>
		<td>{{$bor[$index]}}</td>
		<td>{{$bto[$index]}}</td>
		<td>{{$los[$index]}}</td>
		<td>{{$toi[$index]}}</td>

		<td>
			@php 
				$numerator = $pasien_krs_mati_l[$index];
				$denumerator = $pasien_krs[$index];

				if($denumerator == 0) $value = 0;
				else $value = $numerator/$denumerator*1000;
			@endphp
			{{$value}}
		</td>
		<td>
			@php 
				$numerator = $pasien_krs_mati_p[$index];
				$denumerator = $pasien_krs[$index];

				if($denumerator == 0) $value = 0;
				else $value = $numerator/$denumerator*1000;
			@endphp
			{{$value}}
		</td>
		<td>
			@php 
				$numerator = $pasien_krs_mati[$index];
				$denumerator = $pasien_krs[$index];

				if($denumerator == 0) $value = 0;
				else $value = $numerator/$denumerator*1000;
			@endphp
			{{$value}}
		</td>

		<td>
			@php 
				$numerator = $pasien_krs_mati_lebih_48_l[$index];
				$denumerator = $pasien_krs_mati[$index];

				if($denumerator == 0) $value = 0;
				else $value = $numerator/$denumerator*1000;
			@endphp
			{{$value}}
		</td>
		<td>
			@php 
				$numerator = $pasien_krs_mati_lebih_48_p[$index];
				$denumerator = $pasien_krs_mati[$index];

				if($denumerator == 0) $value = 0;
				else $value = $numerator/$denumerator*1000;
			@endphp
			{{$value}}
		</td>
		<td>
			@php 
				$numerator = $pasien_krs_mati_lebih_48[$index];
				$denumerator = $pasien_krs_mati[$index];

				if($denumerator == 0) $value = 0;
				else $value = $numerator/$denumerator*1000;
			@endphp
			{{$value}}
		</td>
	</tr>
	@endforeach
	<tr>
		<td colspan="3">Total</td>
		@php $column = 'D' @endphp
		@for($i=0;$i<22;$i++)
		<td>=AVERAGE({{$column}}9:{{$column}}19)</td>

		@php $column++ @endphp
		@endfor
	</tr>
	<tr>
		<td colspan="25"></td>
	</tr>
	<tr>
		<td colspan="13"></td>
		<td colspan="4">Surabaya, 26 Februari 2019</td>
		<td colspan="5"></td>
		<td colspan="3">NILAI IDEAL :</td>
	</tr>
	<tr>
		<td colspan="13"></td>
		<td colspan="4">Mengetahui</td>
		<td colspan="5"></td>
		<td colspan="3">BOR : 60 % - 85 %</td>
	</tr>
	<tr>
		<td colspan="10">1. Diemail setiap bulan ke: yanruj.dkk@gmail.com</td>
		<td colspan="3"></td>
		<td colspan="4"></td>
		<td colspan="5"></td>
		<td colspan="3">BTO : 40 - 50 kali</td>
	</tr>
	<tr>
		<td colspan="10">2. Segera dilengkapi kekurangan/yang kosong dan dikirim via email</td>
		<td colspan="3"></td>
		<td colspan="4"></td>
		<td colspan="5"></td>
		<td colspan="3">ALOS : 6 - 9 Hari</td>
	</tr>
	<tr>
		<td colspan="10">3. Dilarang merubah / menambah / mengurangi format yang ada</td>
		<td colspan="3"></td>
		<td colspan="4">( …………………………………………)</td>
		<td colspan="5"></td>
		<td colspan="3">TOI : 1 - 3 Hari</td>
	</tr>
	<tr>
		<td colspan="10">4. Untuk pengisian bulan berikutnya tinggal isi kebawah tidak perlu bikin sheet lagi</td>
		<td colspan="3"></td>
		<td colspan="4"></td>
		<td colspan="5"></td>
		<td colspan="3"></td>
	</tr>
</table>