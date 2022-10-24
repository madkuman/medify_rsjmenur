<div class="modal" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header ">
                    <h3 class="block-title">Ceklis Pasien Covid-19</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content row">
                    <div class="col-md-12">
                        <form action="{{url()->current()}}/save2" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="is_format_baru" id="is_format_baru" value="1">
                            <input type="hidden" name="id_covid" value="0" id="idCovid2">
                            <table class="mews table table-vcenter">
                                <tr>
                                    <th width="48%">Paremeters</th>
                                    <th width="26%">Ya</th>
                                    <th width="26%">Tidak</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-left">1. Gejala Mayor</th>
                                </tr>
                                <tr>
                                    <th class="text-left">a. Demam/Riwayat Demam 14 Hari</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="demam_mayor" value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="demam_mayor"  value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">b. Batuk</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="batuk_mayor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="batuk_mayor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">c. Nyeri Tenggorokan</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="nyeri_tenggorokan_mayor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="nyeri_tenggorokan_mayor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">d. Sesak</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="sesak_mayor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="sesak_mayor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">e. Anosmia</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="anosmia_mayor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="anosmia_mayor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">f. Ageusia</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="ageusia_mayor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="ageusia_mayor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-left">2. Gejala Minor</th>
                                </tr>
                                <tr>
                                    <th class="text-left">a. Nyeri Otot</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="nyeri_otot_minor" value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="nyeri_otot_minor"  value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">b. Nyeri Kepala</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="nyeri_kepala_minor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="nyeri_kepala_minor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">c. Diare</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="diare_minor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="diare_minor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">d. Mual/Muntah</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="mual_minor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="mual_minor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">e. Pilek, hidung tersumbat</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="pilek_minor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="pilek_minor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">f. Panas-dingin Kaku sendi</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="panas_dingin_minor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="panas_dingin_minor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">g. Kelelahan</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="kelelahan_minor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="kelelahan_minor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">h. Bingung</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="bingung_minor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="bingung_minor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">i. Nyeri Dada / dada terasa tertekan</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="nyeri_dada_minor"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="nyeri_dada_minor" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-left">3. Data Epidemiologis</th>
                                </tr>
                                <tr>
                                    <th class="text-left">a. Riwayat kontak erat dengan kasus suspek / positif covid 19</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="kontak_erat_epidemiologis" value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="kontak_erat_epidemiologis"  value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">b. Tinggal di daerah dengan kasus endemik tinggi</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="kasus_endemik_epidemiologis"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="kasus_endemik_epidemiologis" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">c. Riwayat bepergian ke/dari daerah episentrum Covid 19</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="daerah_episentrum_epidemiologis"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="daerah_episentrum_epidemiologis" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-left">4. Data Hasil Laboratorium</th>
                                </tr>
                                <tr>
                                    <th class="text-left">a. Hasil Swab Antigen Positif</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="hasil_lab_antigen_positif" value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="hasil_lab_antigen_positif"  value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">b. Hasil PCR Positif</th>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="hasil_lab_pcr_positif"  value="1" />
                                            <div>Ya</div>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mews-item">
                                            <input type="radio" name="hasil_lab_pcr_positif" value="0" checked />
                                            <div>Tidak</div>
                                        </label>
                                    </td>
                                </tr>
                            </table>
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
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>