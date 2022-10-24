<!DOCTYPE html>
<html>
<head>
	<title>Skrining Pasien COVID 19</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
			font-size: 13px;
		}
		table{
			width: 100%;
			border-collapse: collapse;
		}
		.centered{
			text-align: center;
		}
		.bot{
			border-bottom: 1px solid black;
		}
		.big{
			font-size: 18px;
		}
		.bordered td{
			border: 1px solid black;
			padding-left: 5px;
			padding-right: 5px;
			padding-top: 8px;
			padding-bottom: 8px;
		}
		td{
			vertical-align: top;
		}
		.check {
			padding-left: 1px;
			padding-right: 1px;
			font-family: ZapfDingbats, sans-serif;
		}
		.px-10{
			padding-left: 10px !important;
			padding-right: 10px !important;
		}
		.h3{
			border: 2px dashed black;
			padding-left: 10px !important;
			padding-right: 10px !important;
			padding-top: 30px !important;
			padding-bottom: 30px !important;
			font-size: 20px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	@php
	$item = json_decode($covid->val);
	@endphp
	<table>
		<tr>
			<td width="40%" class="centered bot">{{config('app.name')}}</td>
			<td width="60%"></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td class="centered big"><b>SKRINING PASIEN COVID 19</b></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="15%">Nama</td>
			<td width="54%">: {{$kasus->pasien->name}}</td>
			<td width="11%">No. RM</td>
			<td width="24%">: {{$kasus->pasien->no_rm_formatted}}</td>
		</tr>
		<tr>
			<td>Tgl Lahir</td>
			<td>: {{indonesian_date($kasus->pasien->date_of_birth)}}</td>
			<td>JK/Usia</td>
			<td>: 
				@if($kasus->pasien->gender == '2') Perempuan @else Laki-laki @endif 
				/ {{$kasus->pasien->age}} Tahun 
			</td>
		</tr>
	</table>
	<hr><br>
	<table>
		<tr>
			<td><b>PEMERIKSAAN</b></td>
		</tr>
	</table>
	<br>
	<table class="bordered">
		<tr>
			<td width="80%">Demam/Riwayat Demam ≥ 38 °C &lt; 14 hari</td>
			<td width="20%" class="centered">
				@if($item->demam == '1')
				<span class="check">4</span> 
				@else - @endif
			</td>
		</tr>
		<tr>
			<td>Batuk-Pilek/Nyeri Tenggorokan Atau Sesak Nafas &lt; 14 Hari </td>
			<td class="centered">
				@if($item->bapil == '1')
				<span class="check">4</span> 
				@else - @endif
			</td>
		</tr>
		<tr>
			<td>ISPA Atau Pneumonia Berat &lt; 14 hari</td>
			<td class="centered">
				@if($item->nafas == '1')
				<span class="check">4</span> 
				@else - @endif
			</td>
		</tr>
		<tr>
			<td>Pasien Termasuk Kasus Probable Atau Pernah Kontak Erat Dengan Pasien Covid-19</td>
			<td class="centered">
				@if($item->kontak == '1')
				<span class="check">4</span> 
				@else - @endif
			</td>
		</tr>
		<tr>
			<td>Negara yang Dikunjungi &lt; 14 Hari Sebelum Gejala</td>
			<td class="centered">
				@if(isset($item->negara))
				@foreach($item->negara as $negara)
				- {{$negara}}<br>
				@endforeach
				@endif
			</td>
		</tr>
		<tr>
			<td>Daerah Transmisi Yang Dikunjungi/Ditinggali &lt; 14 Hari Sebelum Gejala</td>
			<td class="centered">
				@if(isset($item->daerah))
				@foreach($item->daerah as $daerah)
				{{$daerah}}<br>
				@endforeach
				@endif
			</td>
		</tr>
		<tr>
			<td>Hasil Swab PCR</td>
			<td class="centered">
				{{(isset($item->swab) && $item->swab == 1 ? ($item->hasil_swab == 1 ? "Positif" : "Negatif") : "Tidak Ada")}}
			</td>
		</tr>
		<tr>
			<td>Terjadi Perubahan (edit) dalam Pemeriksaan ini</td>
			<td class="centered">
				@if($covid->updated_by)
				<span class="check">4</span> 
				@else Tidak Ada @endif
			</td>
		</tr>
		@if($covid->updated_by)
		<tr>
			<td colspan="2">Adanya penyebab lain berdasarkan klinis yang meyakinkan : <br>
				- {{$item->alasan ?? ''}}
			</td>
		</tr>
		@endif
	</table>
	<br><br>
	<table>
		<tr>
			<td width="50%"><b>TINDAK LANJUT</b></td>
			<td width="50%" class="centered"><b>STATUS PEMERIKSAAN</b></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td width="50%">
				@if($covid->presentase == 1)
				<p>
					<ul>
						<li>Rapid Tes</li>
						<li>Ruang Isolasi</li>
						<li>Cek Rontgen</li>
						<li>Cek Lab Darah Lengkap</li>
						<li>Pemantauan Kontak Erat (Keluarga)</li>
					</ul>
				</p>
				@elseif($covid->presentase == 2)
				<p>
					<ul>
						<li>Rapid Test</li>
						<li>Karantina Rumah</li>
						<li>Edukasi</li>
					</ul>
				</p>
				@elseif($covid->presentase == 3)
				<p>
					<ul>
						<li>Rapid Test</li>
						<li>Karantina Rumah Jika &lt;60 Tahun</li>
						<li>Karantina RS Darurat Jika &ge;60 Tahun</li>
					</ul>
				</p>
				@elseif($covid->presentase == 4)
				<p>
					<ul>
						<li>Ruang Isolasi</li>
						<li>Cek Rontgen</li>
						<li>Cek Lab Darah Lengkap</li>
						<li>Pemantauan Kontak Erat (Keluarga)</li>
					</ul>
				</p>
				@else
				@endif
			</td>
			<td width="50%" class="centered">
				@if($covid->presentase == 1)
				<div class="h3">Pasien Dalam Pengawasan</div>
				@elseif($covid->presentase == 2)
				<div class="h3">Kontak Erat Resiko Tinggi<br>(Orang Tanpa Gejala)</div>
				@elseif($covid->presentase == 3)
				<div class="h3">Orang Dalam Pemantauan</div>
				@elseif($covid->presentase == 4)
				<div class="h3">Pasien Positif Covid-19</div>
				@else
				<div class="h3">Pasien Normal</div>
				@endif
			</td>
		</tr>
	</table>
</body>
</html>