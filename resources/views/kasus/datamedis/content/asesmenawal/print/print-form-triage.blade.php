<!DOCTYPE html>
<html>
<head>
	<title>FORM TRIAGE</title>
	<style type="text/css">
		table{
			font-family: sans-serif;
			width: 100%;
			font-size: 11px;
			border-collapse: collapse;
		}
		td{
		}
		table.paddingtd td {
			padding: 2px 5px;
		}
		.text-center {
			text-align: center;
		}
		.font-weight-bold {
			font-weight: bold;
		}
		.yellow {
			background-color: yellow;
		}
		.text {
			margin-top: -25px;
			margin-left: 20px;
		}
	</style>
</head>

<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border:1px solid; text-align:center;">
				RM 04.1
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="50%">
				<div style="margin:10px 0 0 0;">
					<table>
						<tr>
							<td width="20%" style="text-align:center;">
								<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
							</td>
							<td width="60%" style="text-align:center; font-size:10px;">
								<b>
									PEMERINTAH PROVINSI JAWA TIMUR<br>
									RUMAH SAKIT JIWA MENUR<br>
									Jln. Menur No.120, Telp (031) 5021635, 5021637<br>
									SURABAYA
								</b>
							</td>
							<td width="20%" style="text-align:center;">
								<img src="{{url('')}}/assets/img/menur.png" height="55">
							</td>
						</tr>
					</table>
				</div>
			</td>
			<td width="50%">
				<div style="margin:10px 0 0 10px;">
					<table style="border:1px solid;" class="paddingtd">
						<tr>
							<td width="40%">No. Rekam Medis</td>
							<td width="5%">:</td>
							<td width="55%">{{{$kasus->pasien->no_rm_formatted}}}</td>
						</tr>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td>{{{$kasus->pasien->name}}}</td>
						</tr>
						<tr>
							<td>Tanggal Lahir / Umur</td>
							<td>:</td>
							<td>{{indonesian_date(date("j F Y", strtotime($kasus->pasien->date_of_birth)))}} / {{{$kasus->pasien->age}}} Tahun</td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>:</td>
							<td>@if($kasus->pasien->gender == 1) Laki-Laki @else Perempuan @endif</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<br>
	<table style="width:100%; font-size:10px;" border="1">
		<tr>
			<td width="20%" class="font-weight-bold text-center yellow" colspan="1" rowspan="1"> <span>ATS 1</span> </td>
			<td width="20%" class="font-weight-bold text-center yellow" colspan="1" rowspan="1"> <span>ATS 2</span> </td>
			<td width="20%" class="font-weight-bold text-center yellow" colspan="1" rowspan="1"> <span>ATS 3</span> </td>
			<td width="20%" class="font-weight-bold text-center yellow" colspan="1" rowspan="1"> <span>ATS 4</span> </td>
			<td width="20%" class="font-weight-bold text-center yellow" colspan="1" rowspan="1"> <span>ATS 5</span> </td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats1_henti_jantung"
					@php $hasil_data_temp=$hasil_data->ats1_henti_jantung ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Henti jantung </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats2_stridor"
					@php $hasil_data_temp=$hasil_data->ats2_stridor ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Stridor / sesak nafas berat </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_batuk"
					@php $hasil_data_temp=$hasil_data->ats3_batuk ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Batuk berdahak disertai nyeri dada/ demam dan sesak </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats4_aspirasi_benda_asing"
					@php $hasil_data_temp=$hasil_data->ats4_aspirasi_benda_asing ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Aspirasi benda asing tanpa gangguan pernafasan </p>
			</td>
			<td class="" colspan="1" rowspan="1">
				<label class="margin" readonly>
					<input disabled class="form-check-input" type="checkbox" name="ats5_nyeri_ringan"
					@php $hasil_data_temp=$hasil_data->ats5_nyeri_ringan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Nyeri ringan </p>
			</td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats1_henti_nafas"
					@php $hasil_data_temp=$hasil_data->ats1_henti_nafas ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Henti nafas </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats2_hr"
					@php $hasil_data_temp=$hasil_data->ats2_hr ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> HR &lt; 50 atau &gt; 150x/min </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_sesak_nafas" id="checkbox-input-223799"
					@php $hasil_data_temp=$hasil_data->ats3_sesak_nafas ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Sesak nafas dengan Riwayat lesi/masa paru </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats4_pendarahan_ringan" id="checkbox-input-223810"
					@php $hasil_data_temp=$hasil_data->ats4_pendarahan_ringan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Perdarahan ringan </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats5_riwayat_penyakit_rendah" id="checkbox-input-223818"
					@php $hasil_data_temp=$hasil_data->ats5_riwayat_penyakit_rendah ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Riwayat penyakit risiko rendah </p>
			</td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats1_risiko_sumbatan_jalan_nafas" id="checkbox-input-223785"
					@php $hasil_data_temp=$hasil_data->ats1_risiko_sumbatan_jalan_nafas ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Risiko sumbatan jalan nafas </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats2_pendarahan" id="checkbox-input-223793"
					@php $hasil_data_temp=$hasil_data->ats2_pendarahan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Perdarahan / gangguan hemodinamik berat </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_batuk_darah" id="checkbox-input-223800"
					@php $hasil_data_temp=$hasil_data->ats3_batuk_darah ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Batuk darah </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats4_cedera_kepala_ringan" id="checkbox-input-223811"
					@php $hasil_data_temp=$hasil_data->ats4_cedera_kepala_ringan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Cedera kepala ringan </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats5_control_luka" id="checkbox-input-223819"
					@php $hasil_data_temp=$hasil_data->ats5_control_luka ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Control luka </p>
			</td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats1_rr_kurang_10" id="checkbox-input-223786"
					@php $hasil_data_temp=$hasil_data->ats1_rr_kurang_10 ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> RR &lt; 10x / min </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats2_overdosis" id="checkbox-input-223794"
					@php $hasil_data_temp=$hasil_data->ats2_overdosis ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Overdosis obat dengan hipoventilasi </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_hipertensi_urgens" id="checkbox-input-223801"
					@php $hasil_data_temp=$hasil_data->ats3_hipertensi_urgens ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Hipertensi urgens </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats4_iritasi_mata" id="checkbox-input-223812"
					@php $hasil_data_temp=$hasil_data->ats4_iritasi_mata ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Iritasi mata dengan visus normal </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats5_imunisasi" id="checkbox-input-223820"
					@php $hasil_data_temp=$hasil_data->ats5_imunisasi ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Imunisasi </p>
			</td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats1_tk_sistolik" id="checkbox-input-223787"
					@php $hasil_data_temp=$hasil_data->ats1_tk_sistolik ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Tk. Sistolik &lt; 80mmHg (dewasa) atau syok pada anak </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats2_pernafasan" id="checkbox-input-223795"
					@php $hasil_data_temp=$hasil_data->ats2_pernafasan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Pernafasan dangkal </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_perdarahan_sedang" id="checkbox-input-223802"
					@php $hasil_data_temp=$hasil_data->ats3_perdarahan_sedang ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Perdarahan sedang </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats4_trauma_ekstremitas" id="checkbox-input-223813"
					@php $hasil_data_temp=$hasil_data->ats4_trauma_ekstremitas ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Trauma ekstremitas dengan TTV normal dan nyeri ringan-sedang </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats5_perilaku_psikiatrik" id="checkbox-input-223821"
					@php $hasil_data_temp=$hasil_data->ats5_perilaku_psikiatrik ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Perilaku psikiatrik: gejala kronis, pasien tenang, afek emosi adekuat </p>
			</td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats1_gcs" id="checkbox-input-223788"
					@php $hasil_data_temp=$hasil_data->ats1_gcs ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> GCS &lt; 9 </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats2_sao2" id="checkbox-input-223796"
					@php $hasil_data_temp=$hasil_data->ats2_sao2 ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> SaO2 &lt; 90 </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_sao2" id="checkbox-input-223803"
					@php $hasil_data_temp=$hasil_data->ats3_sao2 ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> SaO2 90-95% </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats4_mual_diare" id="checkbox-input-223814"
					@php $hasil_data_temp=$hasil_data->ats4_mual_diare ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Mual / diare tanpa dehidrasi </p>
			</td>
			<td class="" colspan="1" rowspan="1"> </td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats1_kejang" id="checkbox-input-223789"
					@php $hasil_data_temp=$hasil_data->ats1_kejang ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Kejang terus menerus </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats2_gangguan" id="checkbox-input-223797"
					@php $hasil_data_temp=$hasil_data->ats2_gangguan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Gangguan perilaku berat dengan ancaman terhadap kekerasan yang berbahaya </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_trauma" id="checkbox-input-223804"
					@php $hasil_data_temp=$hasil_data->ats3_trauma ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Trauma ekstremitas </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats4_nyeri_sedang" id="checkbox-input-223815"
					@php $hasil_data_temp=$hasil_data->ats4_nyeri_sedang ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Nyeri sedang </p>
			</td>
			<td class="" colspan="1" rowspan="1"> </td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats1_gaduh_gelisah" id="checkbox-input-223790"
					@php $hasil_data_temp=$hasil_data->ats1_gaduh_gelisah ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Pasien jiwa yang gaduh gelisah dgn penurunan kesadaran </p>
			</td>
			<td class="" colspan="1" rowspan="1"> </td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_nyeri_non_kardiak" id="checkbox-input-223805"
					@php $hasil_data_temp=$hasil_data->ats3_nyeri_non_kardiak ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Nyeri non kardiak </p>
			</td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats4_masalah_mental" id="checkbox-input-223816"
					@php $hasil_data_temp=$hasil_data->ats4_masalah_mental ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Masalah kesehatan mental yang semi mendesak, tidak ada risiko terhadap diri sendiridan/atau orang lain </p>
			</td>
			<td class="" colspan="1" rowspan="1"> </td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1"> </td>
			<td class="" colspan="1" rowspan="1"> </td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_cedera_kepala" id="checkbox-input-223806"
					@php $hasil_data_temp=$hasil_data->ats3_cedera_kepala ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Cedera kepala dengan riwayat penurunan kesadaran </p>
			</td>
			<td class="" colspan="1" rowspan="1"> </td>
			<td class="" colspan="1" rowspan="1"> </td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1"> </td>
			<td class="" colspan="1" rowspan="1"> </td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_kekerasan_pada_anak" id="checkbox-input-223807"
					@php $hasil_data_temp=$hasil_data->ats3_kekerasan_pada_anak ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Kekerasan pada anak </p>
			</td>
			<td class="" colspan="1" rowspan="1"> </td>
			<td class="" colspan="1" rowspan="1"> </td>
		</tr>
		<tr>
			<td class="" colspan="1" rowspan="1"> </td>
			<td class="" colspan="1" rowspan="1"> </td>
			<td class="" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="ats3_risiko_agresif" id="checkbox-input-223808"
					@php $hasil_data_temp=$hasil_data->ats3_risiko_agresif ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
					<p class="text"> Risiko agresif, psikotik akut </p>
			</td>
			<td class="" colspan="1" rowspan="1"> </td>
			<td class="" colspan="1" rowspan="1"> </td>
		</tr>
	</table>
	<br>
	<table style="width:100%; font-size:10px;" border="1">
		<tr>
			<td width="5%" class="" colspan="1" rowspan="1"> </td>
			<td width="25%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>KATEGORI ATS</span> </td>
			<td width="30%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>MAKSIMUM WAKTU TUNGGU</span> </td>
			<td width="40%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>KETERANGAN</span> </td>
		</tr>
		<tr>
			<td class="text-center" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="kategori_ats_1" 
					@php $hasil_data_temp=$hasil_data->kategori_ats_1 ?? '' @endphp @if($hasil_data_temp == '' ) checked @endif>
					<span class="css-control-indicator"> </p>
			</td>
			<td class="" colspan="1" rowspan="1"> <span>KATEGORI 1</span> </td>
			<td class="" colspan="1" rowspan="1"> <span>Segera</span> </td>
			<td class="" colspan="1" rowspan="1"> <span>Resusitasi</span> </td>
		</tr>
		<tr>
			<td class="text-center" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="kategori_ats_2"
					@php $hasil_data_temp=$hasil_data->kategori_ats_2 ?? '' @endphp @if($hasil_data_temp == '' ) checked @endif>
					<p class="text"> </p>
			</td>
			<td class="" colspan="1" rowspan="1"> <span>KATEGORI 2</span> </td>
			<td class="" colspan="1" rowspan="1"> <span>10 menit</span> </td>
			<td class="" colspan="1" rowspan="1"> <span>Emergency / Gawat Darurat</span> </td>
		</tr>
		<tr>
			<td class="text-center" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="kategori_ats_3"
					@php $hasil_data_temp=$hasil_data->kategori_ats_3 ?? '' @endphp @if($hasil_data_temp == '' ) checked @endif>
					<p class="text"> </p>
			</td>
			<td class="" colspan="1" rowspan="1"> <span>KATEGORI 3</span> </td>
			<td class="" colspan="1" rowspan="1"> <span>30 menit</span> </td>
			<td class="" colspan="1" rowspan="1"> <span>Urgent / Darurat</span> </td>
		</tr>
		<tr>
			<td class="text-center" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="kategori_ats_4"
					@php $hasil_data_temp=$hasil_data->kategori_ats_4 ?? '' @endphp @if($hasil_data_temp == '' ) checked @endif>
					<p class="text"> </p>
			</td>
			<td class="" colspan="1" rowspan="1"> <span>KATEGORI 4</span> </td>
			<td class="" colspan="1" rowspan="1"> <span>60 menit</span> </td>
			<td class="" colspan="1" rowspan="1"> <span>Semi Darurat</span> </td>
		</tr>
		<tr>
			<td class="text-center" colspan="1" rowspan="1">
					<input disabled class="form-check-input" type="checkbox" name="kategori_ats_5"
					@php $hasil_data_temp=$hasil_data->kategori_ats_5 ?? '' @endphp @if($hasil_data_temp == '' ) checked @endif>
					<p class="text"> </p>
			</td>
			<td class="" colspan="1" rowspan="1"> <span>KATEGORI 5</span> </td>
			<td class="" colspan="1" rowspan="1"> <span>120 menit</span> </td>
			<td class="" colspan="1" rowspan="1"> <span>Tidak Darurat</span> </td>
		</tr>
	</table>
</body>
</html>


