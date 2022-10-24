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
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_risiko_jatuh)) : '-'}}</th>
			</tr>
			<tr>
				<th>Jam</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_risiko_jatuh}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_risiko_jatuh}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_risiko_jatuh}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_risiko_jatuh}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_risiko_jatuh}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_risiko_jatuh}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_risiko_jatuh}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_risiko_jatuh}}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2">Usia</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->usia_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->usia_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->usia_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->usia_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->usia_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->usia_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->usia_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->usia_skor}}</td>
			</tr>
			<tr>
				<td colspan="2">Status Mental</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->status_mental_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->status_mental_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->status_mental_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->status_mental_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->status_mental_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->status_mental_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->status_mental_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->status_mental_skor}}</td>
			</tr>
			<tr>
				<td colspan="2">Eliminasi</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->eliminasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->eliminasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->eliminasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->eliminasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->eliminasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->eliminasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->eliminasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->eliminasi_skor}}</td>
			</tr>
			<tr>
				<td colspan="2">Pengobatan</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->pengobatan_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->pengobatan_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->pengobatan_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->pengobatan_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->pengobatan_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->pengobatan_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->pengobatan_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->pengobatan_skor}}</td>
			</tr>
			<tr>
				<td colspan="2">Diagnosa</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->diagnosa_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->diagnosa_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->diagnosa_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->diagnosa_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->diagnosa_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->diagnosa_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->diagnosa_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->diagnosa_skor}}</td>
			</tr>
			<tr>
				<td colspan="2">Ambulasi</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->ambulasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->ambulasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->ambulasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->ambulasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->ambulasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->ambulasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->ambulasi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->ambulasi_skor}}</td>
			</tr>
			<tr>
				<td colspan="2">Nutrisi</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->nutrisi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->nutrisi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->nutrisi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->nutrisi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->nutrisi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->nutrisi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->nutrisi_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->nutrisi_skor}}</td>
			</tr>
			<tr>
				<td colspan="2">Gangguan Pola Tidur</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->gangguan_pola_tidur_skor}}</td>
			</tr>
			<tr>
				<td colspan="2">Riwayat Jatuh</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->riwayat_jatuh_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->riwayat_jatuh_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->riwayat_jatuh_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->riwayat_jatuh_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->riwayat_jatuh_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->riwayat_jatuh_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->riwayat_jatuh_skor}}</td>
				<td align="right">{{$asesmen_risiko_jatuh_psikiatri->riwayat_jatuh_skor}}</td>
			</tr>
			<tr>
				<td colspan="2" class="centered"><b>TOTAL SKOR</b></td>
				<td align="right"><b style="font-size: 15px;">{{$total}}</b></td>
				<td align="right"><b style="font-size: 15px;">{{$total}}</b></td>
				<td align="right"><b style="font-size: 15px;">{{$total}}</b></td>
				<td align="right"><b style="font-size: 15px;">{{$total}}</b></td>
				<td align="right"><b style="font-size: 15px;">{{$total}}</b></td>
				<td align="right"><b style="font-size: 15px;">{{$total}}</b></td>
				<td align="right"><b style="font-size: 15px;">{{$total}}</b></td>
				<td align="right"><b style="font-size: 15px;">{{$total}}</b></td>
			</tr>
			<tr>
				<td colspan="2"><b>Tidak Berisiko Jatuh, Skor &lt; 90</b></td>
				<td class="check" align="center">@if($total < 90) 4 @endif</td>
				<td class="check" align="center">@if($total < 90) 4 @endif</td>
				<td class="check" align="center">@if($total < 90) 4 @endif</td>
				<td class="check" align="center">@if($total < 90) 4 @endif</td>
				<td class="check" align="center">@if($total < 90) 4 @endif</td>
				<td class="check" align="center">@if($total < 90) 4 @endif</td>
				<td class="check" align="center">@if($total < 90) 4 @endif</td>
				<td class="check" align="center">@if($total < 90) 4 @endif</td>
			</tr>
			<tr>
				<td colspan="2"><b>Berisiko Jatuh, Skor &gt;= 90</b></td>
				<td class="check" align="center">@if($total >= 90) 4 @endif</td>
				<td class="check" align="center">@if($total >= 90) 4 @endif</td>
				<td class="check" align="center">@if($total >= 90) 4 @endif</td>
				<td class="check" align="center">@if($total >= 90) 4 @endif</td>
				<td class="check" align="center">@if($total >= 90) 4 @endif</td>
				<td class="check" align="center">@if($total >= 90) 4 @endif</td>
				<td class="check" align="center">@if($total >= 90) 4 @endif</td>
				<td class="check" align="center">@if($total >= 90) 4 @endif</td>
			</tr>
			<tr>
				<td colspan="2"><b>Nama Perawat</b></td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
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
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_pasien ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_pasien)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_pasien ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_pasien)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_pasien ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_pasien)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_pasien ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_pasien)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_pasien ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_pasien)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_pasien ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_pasien)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_pasien ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_pasien)) : '-'}}</th>
				<th width="7%">{{$asesmen_risiko_jatuh_psikiatri->tanggal_pasien ? date("d/m/ Y", strtotime($asesmen_risiko_jatuh_psikiatri->tanggal_pasien)) : '-'}}</th>
			</tr>
			<tr>
				<th>Jam</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_pasien}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_pasien}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_pasien}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_pasien}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_pasien}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_pasien}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_pasien}}</th>
				<th>{{$asesmen_risiko_jatuh_psikiatri->jam_pasien}}</th>
			</tr>
		</thead>
	</table>
	<table class="bordered">
		<tbody>
			<tr>
				<td width="38%">Pasang stiker warna kuning di gelang</td>
				<td width="7%" class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td width="7%" class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td width="7%" class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td width="7%" class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td width="7%" class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td width="7%" class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td width="7%" class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td width="7%" class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pasang_stiker_warna_kuning == '1' ? '4' : ''}}</td>
			</tr>
		</tbody>
			<tr>
				<td>Tempelkan stiker warna kuning di RM pasien</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempelkan_stiker_warna_kuning == '1' ? '4' : ''}}</td>
			</tr>
			<tr>
				<td>Pakaikan baju dengan penanda "fall risk"</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_baju_dengan_penanda == '1' ? '4' : ''}}</td>
			</tr>
			<tr>
				<td>Pakaikan sprei dengan penanda "fall risk"</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_pakaikan_sprei_dengan_penanda == '1' ? '4' : ''}}</td>
			</tr>
			<tr>
				<td>Motivasi keluarga untuk menunggu pasien</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_motivasi_keluarga == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_motivasi_keluarga == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_motivasi_keluarga == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_motivasi_keluarga == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_motivasi_keluarga == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_motivasi_keluarga == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_motivasi_keluarga == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_motivasi_keluarga == '1' ? '4' : ''}}</td>
			</tr>
			<tr>
				<td>Tempatkan pasien dekat nurse station atau tempat yang mudah diawasi</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_tempatkan_pasien_dekat_nurse_station == '1' ? '4' : ''}}</td>
			</tr>
			<tr>
				<td>Lakukan pemasangan fiksasi fisik apabila diperlukan dengan persetujuan keluarga</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_lakukan_pemasangan_fiksasi_fisil == '1' ? '4' : ''}}</td>
			</tr>
			<tr>
				<td>Orientasikan pasien/penunggu tentang lingkungan ruangan</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_orientasikan_pasien == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_orientasikan_pasien == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_orientasikan_pasien == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_orientasikan_pasien == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_orientasikan_pasien == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_orientasikan_pasien == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_orientasikan_pasien == '1' ? '4' : ''}}</td>
				<td class="check">{{$asesmen_risiko_jatuh_psikiatri->pasien_skor_lebih_dari_90_orientasikan_pasien == '1' ? '4' : ''}}</td>
			</tr>
			<tr>
				<td><b>Nama Perawat</b></td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
				<td style="word-wrap: break-word;">{{$asesmen_risiko_jatuh_psikiatri->creator->name}}</td>
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
</body>
</html>