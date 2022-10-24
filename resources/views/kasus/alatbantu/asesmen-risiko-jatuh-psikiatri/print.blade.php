<!DOCTYPE html>
<html>
<head>
	<title>Asesmen Risiko Jatuh Psikiatri (Skala Edmonson)</title>
	<style type="text/css">
		table{
			font-family: sans-serif;
			width: 100%;
			font-size: 12px;
			border-collapse: collapse;
		}
		.bordered td, .bordered th{
			border: 1px solid black;
			padding-left: 5px;
			padding-right: 5px;
		}
		td{
			vertical-align: top;
		}
		.big{
			font-size: 16px;
		}
		.centered td, .centered{
			text-align: center;
		}
		.check{
			font-family: ZapfDingbats, sans-serif;
			text-align: center;
			vertical-align: middle;
		}
	</style>
</head>
<body>
	@foreach($allItem as $item)
	@if($loop->iteration > 1)
	<div style="page-break-after: always;"></div>
	@endif
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM 27
			</td>
		</tr>
	</table>
	<table style="margin-top: 5px; border: 1px solid black">
		<tr>
			<td width="55%">
				<table>
					<tr>
						<td width="20%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
						</td>
						<td width="60%" style="text-align: center; font-size: 10px;">
							<b>
								PEMERINTAH PROVINSI JAWA TIMUR<br>
								RUMAH SAKIT JIWA MENUR<br>
								Jln Menur No.120, Telp(031)5021635,5021637<br>
								Surabaya
							</b>
						</td>
						<td width="20%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/menur.png" height="55">
						</td>
					</tr>
				</table>
			</td>
			<td width="5%"></td>
			<td width="40%">
				<table style="font-size: 11px;">
					<tr>
						<td>No Rekam Medis</td>
						<td>: {{$kasus->pasien->no_rm}}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>: {{$kasus->pasien->name}}</td>
					</tr>
					<tr>
						<td>Tgl Lahir/Umur</td>
						<td>: {{date('d-m-Y', strtotime($kasus->pasien->date_of_birth))}}/{{$kasus->pasien->age}} Tahun</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: {{$kasus->pasien->gender == '1' ? 'Laki-laki' : 'Perempuan'}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table class="bordered">
		<tr>
			<td class="centered">
				<b class="big">ASESMEN RISIKO JATUH PSIKIATRI (SKALA EDMONSON)</b>
			</td>
		</tr>
		<tr>
			<td><b>Diisi oleh Perawat</b></td>
		</tr>
		<tr>
			<td>
				Lakukan pengkajian risiko jatuh saat pasien masuk (1x24 jam). Di Ruang akut (R. WK) dilakukan penilaian setiap hari, di ruang tenang satu minggu sekali. Penilaian ulang juga dilakukan ketika  terdapat perubahan kondisi pasien/ terapi, pasien dipindahkan ke ruangan lain, pasien berisiko dinilai setiap hari sampai skor risiko &lt; 90 dan setelah pasien jatuh <br>
				Skor :<br>
				• &lt; 90 Tidak ada risiko jatuh<br>
				• &gt;= 90 Risiko Jatuh
			</td>
		</tr>
	</table>
	<table class="bordered">
		<thead>
			<tr>
				<th width="23%" rowspan="2"><u>ITEM PENILAIAN</u></th>
				<th width="15%">Tanggal</th>

				@for($j=0; $j<8; $j++)
				<th width="7%">{{$item[$j]['tanggal_risiko_jatuh'] ? date("d/m/ Y", strtotime($item[$j]['tanggal_risiko_jatuh'])) : ""}}</th>
				@endfor
			</tr>
			<tr>
				<th>Jam</th>
				@for($j=0; $j<8; $j++)
				<th>{{$item[$j]['jam_risiko_jatuh'] ?? ""}}</th>
				@endfor
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2">Usia</td>
				@for($j=0; $j<8; $j++)
				<td align="right">{{$item[$j]['usia_skor'] ?? ""}}</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2">Status Mental</td>
				@for($j=0; $j<8; $j++)
				<td align="right">{{$item[$j]['status_mental_skor'] ?? ""}}</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2">Eliminasi</td>
				@for($j=0; $j<8; $j++)
				<td align="right">{{$item[$j]['eliminasi_skor'] ?? ""}}</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2">Pengobatan</td>
				@for($j=0; $j<8; $j++)
				<td align="right">{{$item[$j]['pengobatan_skor'] ?? ""}}</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2">Diagnosa</td>
				@for($j=0; $j<8; $j++)
				<td align="right">{{$item[$j]['diagnosa_skor'] ?? ""}}</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2">Ambulasi</td>
				@for($j=0; $j<8; $j++)
				<td align="right">{{$item[$j]['ambulasi_skor'] ?? ""}}</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2">Nutrisi</td>
				@for($j=0; $j<8; $j++)
				<td align="right">{{$item[$j]['nutrisi_skor'] ?? ""}}</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2">Gangguan Pola Tidur</td>
				@for($j=0; $j<8; $j++)
				<td align="right">{{$item[$j]['gangguan_pola_tidur_skor'] ?? ""}}</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2">Riwayat Jatuh</td>
				@for($j=0; $j<8; $j++)
				<td align="right">{{$item[$j]['riwayat_jatuh_skor'] ?? ""}}</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2" class="centered"><b>TOTAL SKOR</b></td>
				@for($j=0; $j<8; $j++)
				<td align="right"><b style="font-size: 15px;">{{$item[$j]['total']}}</b></td>
				@endfor
			</tr>
			<tr>
				<td colspan="2"><b>Tidak Berisiko Jatuh, Skor &lt; 90</b></td>
				@for($j=0; $j<8; $j++)
				<td class="check" align="center">@if(isset($item[$j]['total'])) @if($item[$j]['total'] < 90) 4 @endif @endif</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2"><b>Berisiko Jatuh, Skor &gt;= 90</b></td>
				@for($j=0; $j<8; $j++)
				<td class="check" align="center">@if(isset($item[$j]['total'])) @if($item[$j]['total'] >= 90) 4 @endif @endif</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2"><b>Nama Perawat</b></td>
				@for($j=0; $j<8; $j++)
				<td style="word-wrap: break-word;">@if(isset($item[$j]['creator'])) {{$item[$j]['creator']->name}} @endif</td>
				@endfor
			</tr>
			<tr>
				<td colspan="2"><b>Paraf Perawat</b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<table class="bordered" style="margin-top: 10px;">
		<thead>
			<tr>
				<th rowspan="2" width="23%">Pemeriksaan Pasien Risiko Jatuh Skor &gt;= 90</th>
				<th width="15%">Tanggal</th>
				@for($j=0; $j<8; $j++)
				<th width="7%">{{$item[$j]['tanggal_pasien'] ? date("d/m/ Y", strtotime($item[$j]['tanggal_pasien'])) : ""}}</th>
				@endfor
			</tr>
			<tr>
				<th>Jam</th>
				@for($j=0; $j<8; $j++)
				<th>{{$item[$j]['jam_pasien'] ?? ""}}</th>
				@endfor
			</tr>
		</thead>
	</table>
	<table class="bordered">
		<tbody>
			<tr>
				<td width="38%">Pasang stiker warna kuning di gelang</td>
				@for($j=0; $j<8; $j++)
				<td width="7%" class="check">@if(isset($item[$j]['pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning'])) 4 @endif</td>
				@endfor
			</tr>
			<tr>
				<td>Tempelkan stiker warna kuning di RM pasien</td>
				@for($j=0; $j<8; $j++)
				<td class="check">@if(isset($item[$j]['pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning'])) 4 @endif</td>
				@endfor
			</tr>
			<tr>
				<td>Pakaikan baju dengan penanda "fall risk"</td>
				@for($j=0; $j<8; $j++)
				<td class="check">@if(isset($item[$j]['pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda'])) 4 @endif</td>
				@endfor
			</tr>
			<tr>
				<td>Pakaikan sprei dengan penanda "fall risk"</td>
				@for($j=0; $j<8; $j++)
				<td class="check">@if(isset($item[$j]['pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda'])) 4 @endif</td>
				@endfor
			</tr>
			<tr>
				<td>Motivasi keluarga untuk menunggu pasien</td>
				@for($j=0; $j<8; $j++)
				<td class="check">@if(isset($item[$j]['pasien_skor_lebih_dari_90_motivasi_keluarga'])) 4 @endif</td>
				@endfor
			</tr>
			<tr>
				<td>Tempatkan pasien dekat nurse station atau tempat yang mudah diawasi</td>
				@for($j=0; $j<8; $j++)
				<td class="check">@if(isset($item[$j]['pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station'])) 4 @endif</td>
				@endfor
			</tr>
			<tr>
				<td>Lakukan pemasangan fiksasi fisik apabila diperlukan dengan persetujuan keluarga</td>
				@for($j=0; $j<8; $j++)
				<td class="check">@if(isset($item[$j]['pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil'])) 4 @endif</td>
				@endfor
			</tr>
			<tr>
				<td>Orientasikan pasien/penunggu tentang lingkungan ruangan</td>
				@for($j=0; $j<8; $j++)
				<td class="check">@if(isset($item[$j]['pasien_skor_lebih_dari_90_orientasikan_pasien'])) 4 @endif</td>
				@endfor
			</tr>
			<tr>
				<td><b>Nama Perawat</b></td>
				@for($j=0; $j<8; $j++)
				<td style="word-wrap: break-word;">@if(isset($item[$j]['creator'])) {{$item[$j]['creator']->name}} @endif</td>
				@endfor
			</tr>
			<tr>
				<td><b>Paraf Perawat</b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	@endforeach
</body>
</html>