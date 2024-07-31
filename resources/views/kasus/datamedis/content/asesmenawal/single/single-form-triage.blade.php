@section('css')
<style>
	.margin {
		margin-left : 25px;
	}
</style>
@endsection

@php $hasil_data = json_decode($item->val); @endphp
<div class="row">
	<div class="col-md-12">
		<table style="width:100%" border="1">
			<tr>
				<td width="20%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>ATS 1</span> </td>
				<td width="20%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>ATS 2</span> </td>
				<td width="20%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>ATS 3</span> </td>
				<td width="20%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>ATS 4</span> </td>
				<td width="20%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>ATS 5</span> </td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats1_henti_jantung"
						@php $hasil_data_temp=$hasil_data->ats1_henti_jantung ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Henti jantung
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats2_stridor"
						@php $hasil_data_temp=$hasil_data->ats2_stridor ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Stridor / sesak nafas berat
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_batuk"
						@php $hasil_data_temp=$hasil_data->ats3_batuk ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Batuk berdahak disertai nyeri dada/ demam dan sesak
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats4_aspirasi_benda_asing"
						@php $hasil_data_temp=$hasil_data->ats4_aspirasi_benda_asing ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Aspirasi benda asing tanpa gangguan pernafasan
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin" readonly>
						<input disabled class="form-check-input" type="checkbox" name="ats5_nyeri_ringan"
						@php $hasil_data_temp=$hasil_data->ats5_nyeri_ringan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Nyeri ringan
					</label>
				</td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats1_henti_nafas"
						@php $hasil_data_temp=$hasil_data->ats1_henti_nafas ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Henti nafas
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats2_hr"
						@php $hasil_data_temp=$hasil_data->ats2_hr ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> HR &lt; 50 atau &gt; 150x/min
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_sesak_nafas" id="checkbox-input-223799"
						@php $hasil_data_temp=$hasil_data->ats3_sesak_nafas ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Sesak nafas dengan Riwayat lesi/masa paru
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats4_pendarahan_ringan" id="checkbox-input-223810"
						@php $hasil_data_temp=$hasil_data->ats4_pendarahan_ringan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Perdarahan ringan
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats5_riwayat_penyakit_rendah" id="checkbox-input-223818"
						@php $hasil_data_temp=$hasil_data->ats5_riwayat_penyakit_rendah ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Riwayat penyakit risiko rendah
					</label>
				</td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats1_risiko_sumbatan_jalan_nafas" id="checkbox-input-223785"
						@php $hasil_data_temp=$hasil_data->ats1_risiko_sumbatan_jalan_nafas ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Risiko sumbatan jalan nafas
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats2_pendarahan" id="checkbox-input-223793"
						@php $hasil_data_temp=$hasil_data->ats2_pendarahan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Perdarahan / gangguan hemodinamik berat
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_batuk_darah" id="checkbox-input-223800"
						@php $hasil_data_temp=$hasil_data->ats3_batuk_darah ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Batuk darah
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats4_cedera_kepala_ringan" id="checkbox-input-223811"
						@php $hasil_data_temp=$hasil_data->ats4_cedera_kepala_ringan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Cedera kepala ringan
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats5_control_luka" id="checkbox-input-223819"
						@php $hasil_data_temp=$hasil_data->ats5_control_luka ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Control luka
					</label>
				</td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats1_rr_kurang_10" id="checkbox-input-223786"
						@php $hasil_data_temp=$hasil_data->ats1_rr_kurang_10 ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> RR &lt; 10x / min
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats2_overdosis" id="checkbox-input-223794"
						@php $hasil_data_temp=$hasil_data->ats2_overdosis ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Overdosis obat dengan hipoventilasi
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_hipertensi_urgens" id="checkbox-input-223801"
						@php $hasil_data_temp=$hasil_data->ats3_hipertensi_urgens ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Hipertensi urgens
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats4_iritasi_mata" id="checkbox-input-223812"
						@php $hasil_data_temp=$hasil_data->ats4_iritasi_mata ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Iritasi mata dengan visus normal
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats5_imunisasi" id="checkbox-input-223820"
						@php $hasil_data_temp=$hasil_data->ats5_imunisasi ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Imunisasi
					</label>
				</td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats1_tk_sistolik" id="checkbox-input-223787"
						@php $hasil_data_temp=$hasil_data->ats1_tk_sistolik ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Tk. Sistolik &lt; 80mmHg (dewasa) atau syok pada anak
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats2_pernafasan" id="checkbox-input-223795"
						@php $hasil_data_temp=$hasil_data->ats2_pernafasan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Pernafasan dangkal
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_perdarahan_sedang" id="checkbox-input-223802"
						@php $hasil_data_temp=$hasil_data->ats3_perdarahan_sedang ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Perdarahan sedang
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats4_trauma_ekstremitas" id="checkbox-input-223813"
						@php $hasil_data_temp=$hasil_data->ats4_trauma_ekstremitas ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Trauma ekstremitas dengan TTV normal dan nyeri ringan-sedang
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats5_perilaku_psikiatrik" id="checkbox-input-223821"
						@php $hasil_data_temp=$hasil_data->ats5_perilaku_psikiatrik ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Perilaku psikiatrik: gejala kronis, pasien tenang, afek emosi adekuat
					</label>
				</td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats1_gcs" id="checkbox-input-223788"
						@php $hasil_data_temp=$hasil_data->ats1_gcs ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> GCS &lt; 9
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats2_sao2" id="checkbox-input-223796"
						@php $hasil_data_temp=$hasil_data->ats2_sao2 ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> SaO2 &lt; 90
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_sao2" id="checkbox-input-223803"
						@php $hasil_data_temp=$hasil_data->ats3_sao2 ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> SaO2 90-95%
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats4_mual_diare" id="checkbox-input-223814"
						@php $hasil_data_temp=$hasil_data->ats4_mual_diare ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Mual / diare tanpa dehidrasi
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> </td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats1_kejang" id="checkbox-input-223789"
						@php $hasil_data_temp=$hasil_data->ats1_kejang ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Kejang terus menerus
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats2_gangguan" id="checkbox-input-223797"
						@php $hasil_data_temp=$hasil_data->ats2_gangguan ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Gangguan perilaku berat dengan ancaman terhadap kekerasan yang berbahaya
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_trauma" id="checkbox-input-223804"
						@php $hasil_data_temp=$hasil_data->ats3_trauma ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Trauma ekstremitas
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats4_nyeri_sedang" id="checkbox-input-223815"
						@php $hasil_data_temp=$hasil_data->ats4_nyeri_sedang ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Nyeri sedang
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> </td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats1_gaduh_gelisah" id="checkbox-input-223790"
						@php $hasil_data_temp=$hasil_data->ats1_gaduh_gelisah ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Pasien jiwa yang gaduh gelisah dgn penurunan kesadaran
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> </td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_nyeri_non_kardiak" id="checkbox-input-223805"
						@php $hasil_data_temp=$hasil_data->ats3_nyeri_non_kardiak ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Nyeri non kardiak
					</label>
				</td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats4_masalah_mental" id="checkbox-input-223816"
						@php $hasil_data_temp=$hasil_data->ats4_masalah_mental ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Masalah kesehatan mental yang semi mendesak, tidak ada risiko terhadap diri sendiridan/atau orang lain
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> </td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1"> </td>
				<td class="" colspan="1" rowspan="1"> </td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_cedera_kepala" id="checkbox-input-223806"
						@php $hasil_data_temp=$hasil_data->ats3_cedera_kepala ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Cedera kepala dengan riwayat penurunan kesadaran
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> </td>
				<td class="" colspan="1" rowspan="1"> </td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1"> </td>
				<td class="" colspan="1" rowspan="1"> </td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_kekerasan_pada_anak" id="checkbox-input-223807"
						@php $hasil_data_temp=$hasil_data->ats3_kekerasan_pada_anak ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Kekerasan pada anak
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> </td>
				<td class="" colspan="1" rowspan="1"> </td>
			</tr>
			<tr>
				<td class="" colspan="1" rowspan="1"> </td>
				<td class="" colspan="1" rowspan="1"> </td>
				<td class="" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="ats3_risiko_agresif" id="checkbox-input-223808"
						@php $hasil_data_temp=$hasil_data->ats3_risiko_agresif ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif>
						<span class="css-control-indicator"></span> Risiko agresif, psikotik akut
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> </td>
				<td class="" colspan="1" rowspan="1"> </td>
			</tr>
		</table>
		<br>
		<table style="width:100%" border="1">
			<tr>
				<td width="5%" class="" colspan="1" rowspan="1"> </td>
				<td width="25%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>KATEGORI ATS</span> </td>
				<td width="30%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>MAKSIMUM WAKTU TUNGGU</span> </td>
				<td width="40%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>KETERANGAN</span> </td>
			</tr>
			<tr>
				<td class="text-center" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="kategori_ats_1" 
						@php $hasil_data_temp=$hasil_data->kategori_ats_1 ?? '' @endphp @if($hasil_data_temp == '' ) checked @endif>
						<span class="css-control-indicator">
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> <span>KATEGORI 1</span> </td>
				<td class="" colspan="1" rowspan="1"> <span>Segera</span> </td>
				<td class="" colspan="1" rowspan="1"> <span>Resusitasi</span> </td>
			</tr>
			<tr>
				<td class="text-center" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="kategori_ats_2"
						@php $hasil_data_temp=$hasil_data->kategori_ats_2 ?? '' @endphp @if($hasil_data_temp == '' ) checked @endif>
						<span class="css-control-indicator"></span>
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> <span>KATEGORI 2</span> </td>
				<td class="" colspan="1" rowspan="1"> <span>10 menit</span> </td>
				<td class="" colspan="1" rowspan="1"> <span>Emergency / Gawat Darurat</span> </td>
			</tr>
			<tr>
				<td class="text-center" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="kategori_ats_3"
						@php $hasil_data_temp=$hasil_data->kategori_ats_3 ?? '' @endphp @if($hasil_data_temp == '' ) checked @endif>
						<span class="css-control-indicator"></span>
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> <span>KATEGORI 3</span> </td>
				<td class="" colspan="1" rowspan="1"> <span>30 menit</span> </td>
				<td class="" colspan="1" rowspan="1"> <span>Urgent / Darurat</span> </td>
			</tr>
			<tr>
				<td class="text-center" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="kategori_ats_4"
						@php $hasil_data_temp=$hasil_data->kategori_ats_4 ?? '' @endphp @if($hasil_data_temp == '' ) checked @endif>
						<span class="css-control-indicator"></span>
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> <span>KATEGORI 4</span> </td>
				<td class="" colspan="1" rowspan="1"> <span>60 menit</span> </td>
				<td class="" colspan="1" rowspan="1"> <span>Semi Darurat</span> </td>
			</tr>
			<tr>
				<td class="text-center" colspan="1" rowspan="1">
          <label class="margin">
						<input disabled class="form-check-input" type="checkbox" name="kategori_ats_5"
						@php $hasil_data_temp=$hasil_data->kategori_ats_5 ?? '' @endphp @if($hasil_data_temp == '' ) checked @endif>
						<span class="css-control-indicator"></span>
					</label>
				</td>
				<td class="" colspan="1" rowspan="1"> <span>KATEGORI 5</span> </td>
				<td class="" colspan="1" rowspan="1"> <span>120 menit</span> </td>
				<td class="" colspan="1" rowspan="1"> <span>Tidak Darurat</span> </td>
			</tr>
		</table>
	</div>
</div>
