<div class="modal fade" id="modal-form-triage" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
  <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
    <div class="modal-content">
      <form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/form-triage/save">
        <div class="block block-themed block-transparent mb-0">
          <div class="block-header">
            <h3 class="block-title">Form Triage</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                <i class="si si-close"></i>
              </button>
            </div>
          </div>
          <input type="hidden" name="id" value="" class="id-asesmen">
          <input type="hidden" name="jenis" value="Form Triage">
          <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
            {{csrf_field()}}
            <div class="row">
              <div class="col-12">
                <h5 class="mb-5 mt-10">ATS 1</h5>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats1_henti_jantung">
                    <span class="css-control-indicator"></span> Henti jantung
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats1_henti_nafas">
                    <span class="css-control-indicator"></span> Henti nafas
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats1_risiko_sumbatan_jalan_nafas">
                    <span class="css-control-indicator"></span> Risiko sumbatan jalan nafas
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats1_rr_kurang_10">
                    <span class="css-control-indicator"></span> RR &lt;	10x / min
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats1_tk_sistolik">
                    <span class="css-control-indicator"></span> Tk. Sistolik &lt; 80mmHg (dewasa) atau syok pada anak
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats1_gcs">
                    <span class="css-control-indicator"></span> GCS &lt; 9
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats1_kejang">
                    <span class="css-control-indicator"></span> Kejang terus menerus
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats1_gaduh_gelisah">
                    <span class="css-control-indicator"></span> Pasien jiwa yang gaduh gelisah dgn penurunan kesadaran
                  </label>
                </div>
              </div>
              <hr class="col-11">
              <div class="col-12">
                <h5 class="mb-5 mt-10">ATS 2</h5>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats2_stridor">
                    <span class="css-control-indicator"></span> Stridor / sesak nafas berat
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats2_hr">
                    <span class="css-control-indicator"></span> HR &lt; 50 atau &gt; 150x/min
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats2_pendarahan">
                    <span class="css-control-indicator"></span> Perdarahan / gangguan hemodinamik berat
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats2_overdosis">
                    <span class="css-control-indicator"></span> Overdosis obat dengan hipoventilasi
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats2_pernafasan">
                    <span class="css-control-indicator"></span> Pernafasan dangkal
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats2_sao2">
                    <span class="css-control-indicator"></span> SaO2 &lt; 90
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats2_gangguan">
                    <span class="css-control-indicator"></span> Gangguan perilaku berat dengan ancaman terhadap kekerasan yang berbahaya
                  </label>
                </div>
              </div>
              <hr class="col-11">
              <div class="col-12">
                <h5 class="mb-5 mt-10">ATS 3</h5>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_batuk">
                    <span class="css-control-indicator"></span> Batuk berdahak disertai nyeri dada/ demam dan sesak
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_sesak_nafas">
                    <span class="css-control-indicator"></span> Sesak nafas dengan Riwayat lesi/masa paru
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_batuk_darah">
                    <span class="css-control-indicator"></span> Batuk darah
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_hipertensi_urgens">
                    <span class="css-control-indicator"></span> Hipertensi urgens
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_perdarahan_sedang">
                    <span class="css-control-indicator"></span> Perdarahan sedang
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_sao2">
                    <span class="css-control-indicator"></span> SaO2 90-95%
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_trauma">
                    <span class="css-control-indicator"></span> Trauma ekstremitas
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_nyeri_non_kardiak">
                    <span class="css-control-indicator"></span> Nyeri non kardiak
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_cedera_kepala">
                    <span class="css-control-indicator"></span> Cedera kepala dengan riwayat penurunan kesadaran
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_kekerasan_pada_anak">
                    <span class="css-control-indicator"></span> Kekerasan pada anak
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats3_risiko_agresif">
                    <span class="css-control-indicator"></span> Risiko agresif, psikotik akut
                  </label>
                </div>
              </div>
              <hr class="col-11">
              <div class="col-12">
                <h5 class="mb-5 mt-10">ATS 4</h5>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats4_aspirasi_benda_asing">
                    <span class="css-control-indicator"></span> Aspirasi benda asing tanpa gangguan pernafasan
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats4_pendarahan_ringan">
                    <span class="css-control-indicator"></span> Perdarahan ringan
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats4_cedera_kepala_ringan">
                    <span class="css-control-indicator"></span> Cedera kepala ringan
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats4_iritasi_mata">
                    <span class="css-control-indicator"></span> Iritasi mata dengan visus normal
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats4_trauma_ekstremitas">
                    <span class="css-control-indicator"></span> Trauma ekstremitas dengan TTV normal dan nyeri ringan-sedang
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats4_mual_diare">
                    <span class="css-control-indicator"></span> Mual / diare tanpa dehidrasi
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats4_nyeri_sedang">
                    <span class="css-control-indicator"></span> Nyeri sedang
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats4_masalah_mental">
                    <span class="css-control-indicator"></span> Masalah kesehatan mental yang semi mendesak, tidak ada risiko terhadap diri sendiridan/atau orang lain
                  </label>
                </div>
              </div>
              <hr class="col-11">
              <div class="col-12">
                <h5 class="mb-5 mt-10">ATS 5</h5>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats5_nyeri_ringan">
                    <span class="css-control-indicator"></span> Nyeri ringan
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats5_riwayat_penyakit_rendah">
                    <span class="css-control-indicator"></span> Riwayat penyakit risiko rendah
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats5_control_luka">
                    <span class="css-control-indicator"></span> Control luka
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats5_imunisasi">
                    <span class="css-control-indicator"></span> Imunisasi
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-5">
                  <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" value="1" class="css-control-input" name="ats5_perilaku_psikiatrik">
                    <span class="css-control-indicator"></span> Perilaku psikiatrik: gejala kronis, pasien tenang, afek emosi adekuat
                  </label>
                </div>
              </div>
              <hr class="col-11">
              <div class="col-12">
                <table style="width:100%;" border="1">
                  <tr>
                    <td width="5%" class="" colspan="1" rowspan="1"> </td>
                    <td width="25%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>KATEGORI ATS</span> </td>
                    <td width="30%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>MAKSIMUM WAKTU TUNGGU</span> </td>
                    <td width="40%" class="font-weight-bold text-center" colspan="1" rowspan="1"> <span>KETERANGAN</span> </td>
                  </tr>
                  <tr>
                    <td class="text-center" colspan="1" rowspan="1">
                      <label class="css-control css-control-primary css-checkbox">
                        <input type="checkbox" value="1" class="css-control-input" name="kategori_ats_1">
                        <span class="css-control-indicator"></span>
                      </label>
                    </td>
                    <td class="" colspan="1" rowspan="1"> <span>KATEGORI 1</span> </td>
                    <td class="" colspan="1" rowspan="1"> <span>Segera</span> </td>
                    <td class="" colspan="1" rowspan="1"> <span>Resusitasi</span> </td>
                  </tr>
                  <tr>
                    <td class="text-center" colspan="1" rowspan="1">
                      <label class="css-control css-control-primary css-checkbox">
                        <input type="checkbox" value="1" class="css-control-input" name="kategori_ats_2">
                        <span class="css-control-indicator"></span>
                      </label>
                    </td>
                    <td class="" colspan="1" rowspan="1"> <span>KATEGORI 2</span> </td>
                    <td class="" colspan="1" rowspan="1"> <span>10 menit</span> </td>
                    <td class="" colspan="1" rowspan="1"> <span>Emergency / Gawat Darurat</span> </td>
                  </tr>
                  <tr>
                    <td class="text-center" colspan="1" rowspan="1">
                      <label class="css-control css-control-primary css-checkbox">
                        <input type="checkbox" value="1" class="css-control-input" name="kategori_ats_3">
                        <span class="css-control-indicator"></span>
                      </label>
                    </td>
                    <td class="" colspan="1" rowspan="1"> <span>KATEGORI 3</span> </td>
                    <td class="" colspan="1" rowspan="1"> <span>30 menit</span> </td>
                    <td class="" colspan="1" rowspan="1"> <span>Urgent / Darurat</span> </td>
                  </tr>
                  <tr>
                    <td class="text-center" colspan="1" rowspan="1">
                      <label class="css-control css-control-primary css-checkbox">
                        <input type="checkbox" value="1" class="css-control-input" name="kategori_ats_4">
                        <span class="css-control-indicator"></span>
                      </label>
                    </td>
                    <td class="" colspan="1" rowspan="1"> <span>KATEGORI 4</span> </td>
                    <td class="" colspan="1" rowspan="1"> <span>60 menit</span> </td>
                    <td class="" colspan="1" rowspan="1"> <span>Semi Darurat</span> </td>
                  </tr>
                  <tr>
                    <td class="text-center" colspan="1" rowspan="1">
                      <label class="css-control css-control-primary css-checkbox">
                        <input type="checkbox" value="1" class="css-control-input" name="kategori_ats_5">
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
          </div>
        </div>
        <div class="modal-footer">
          <div class="form-group">
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
