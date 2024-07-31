<div class="modal" id="addModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<input type="hidden" name="id" class="input-id">
			<div class="modal-content">
            
				<div class="block block-themed block-transparent mb-0">
					
               <div class="block-header ">
						<h3 class="block-title">Form Pasien Pemantauan Terapi Obat</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					
               <div class="block-content">
						<div class="row">
                     <div class="col-md-3">
								<div class="form-group">
									<label>Keluhan Utama</label>
                           <textarea class="form-control" name="medis_keluhan_utama" rows="2">{{ $asesmen2->medis_keluhan_utama ?? '-' }}</textarea>
								</div>
							</div>
                     <div class="col-md-2">
								<div class="form-group">
									<label>Riwayat Penyakit Sekarang</label>
                           <textarea class="form-control" name="medis_riwayat_gangguan_sekarang" rows="2">{{ $asesmen2->medis_riwayat_gangguan_sekarang ?? '-' }}</textarea>
								</div>
							</div>
                     <div class="col-md-2">
								<div class="form-group">
									<label>Riwayat Penyakit Terdahulu</label>
                           <textarea class="form-control" name="medis_riwayat_penyakit_sebelumnya" rows="2">{{ $asesmen2->medis_riwayat_penyakit_sebelumnya ?? '-' }}</textarea>
								</div>
							</div>
                     <div class="col-md-2">
								<div class="form-group">
									<label>Riwayat Keluarga</label>
                           <textarea class="form-control" name="medis_faktor_keturunan" rows="2">{{ $asesmen2->medis_faktor_keturunan ?? '-' }}</textarea>
								</div>
							</div>
                     <div class="col-md-3">
								<div class="form-group">
									<label>Diagnosa</label>
                           @php
                              $icd_10_1 = '';
                              $icd_10_2 = '';
                              $icd_10_3 = '';
                     
                              if (!empty($asesmen2->icd_10_1)) {
                                 $arr = explode(";", $asesmen2->icd_10_1);
                                 $icd_10_1 = implode(",", $arr);
                              }
                              if (!empty($asesmen2->icd_10_2)) {
                                 $arr = explode(";", $asesmen2->icd_10_2);
                                 $icd_10_2 = implode(",", $arr);
                              }
                              if (!empty($asesmen2->icd_10_3)) {
                                 $arr = explode(";", $asesmen2->icd_10_3);
                                 $icd_10_3 = implode(",", $arr);
                              }
                           @endphp
                           <textarea class="form-control" name="diagnosa" id="" rows="2">Aksis 1: {{ $icd_10_1 ?? '' }}; Aksis 2: {{ $icd_10_2 ?? '' }}; Aksis 3: {{ $icd_10_3 ?? '' }};</textarea>
								</div>
							</div>
                  </div>

                  <!-- alergi -->
                  <hr>
                  <div class="row" style="margin-top: 30px">
                     <div class="col-md-12">
                        <h5 class="mb-5">Riwayat Alergi Obat</h5>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group row mb-5">
                            <label class="col-12">Obat yang Menyebabkan Alergi</label>
                            <div class="col-lg-12">
                                <input type="text" class="js-tags-input form-control" data-height="34px"  name="alergi_terhadap_obat" value="{{ $asesmen2->alergi_terhadap_obat }}">
                                <small>Tekan TAB setelah input tiap item</small>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <label class="col-12">Tingkat Keparahan</label>
                            <div class="form-group col-4" style="">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" value="✔" class="css-control-input" name="alergi_obat_ringan" @if(!empty($asesmen2->alergi_obat_ringan)) checked @endif>
                                    <span class="css-control-indicator"></span> Ringan
                                </label>
                            </div>
                            <div class="form-group col-4" style="">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" value="✔" class="css-control-input" name="alergi_obat_sedang" @if(!empty($asesmen2->alergi_obat_sedang)) checked @endif>
                                    <span class="css-control-indicator"></span> Sedang
                                </label>
                            </div>
                            <div class="form-group col-4" style="">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" value="✔" class="css-control-input" name="alergi_obat_berat" @if(!empty($asesmen2->alergi_obat_berat)) checked @endif>
                                    <span class="css-control-indicator"></span> Berat
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row mb-5">
                            <label class="col-12">Reaksi</label>
                            <div class="col-lg-12">
                                <input type="text" class="js-tags-input form-control" data-height="34px"  name="reaksi_alergi_obat" value="{{ $asesmen2->reaksi_alergi_obat }}">
                                <small>Tekan TAB setelah input tiap item</small>
                            </div>
                        </div>  
                    </div>
                  </div>
                  <div class="row">
                     <div class="col-md-2">
                        <label class="css-control css-control-primary css-radio">
                           <input type="radio" value="✔" class="css-control-input" name="check_alergi">
                           <span class="css-control-indicator"></span> Tidak Tahu Ada Alergi
                        </label>
                     </div>
                     <div class="col-md-2">
                        <label class="css-control css-control-primary css-radio">
                           <input type="radio" value="✔" class="css-control-input" name="check_alergi">
                           <span class="css-control-indicator"></span> Tidak Ada Alergi
                        </label>
                     </div>
                  </div>
                  <!-- end alergi -->

                  <!-- riwayat penggunaan obat -->
                  <hr>
                  <div class="row" style="margin-top: 30px">
                     <div class="col-md-12">
                        <h5 class="mb-5">Riwayat Penggunaan Obat Sebelum Admisi</h5>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <label class="css-control css-control-primary css-radio">
                           <input type="radio" value="✔" class="css-control-input" name="check_riwayat_penggunaan_obat">
                           <span class="css-control-indicator"></span> Ya, dengan rincian sebagai berikut
                        </label>
                     </div>
                     <div class="col-md-4">
                        <label class="css-control css-control-primary css-radio">
                           <input type="radio" value="✔" class="css-control-input" name="check_riwayat_penggunaan_obat">
                           <span class="css-control-indicator"></span> Tidak menggunakan obat sebelum admisi
                        </label>
                     </div>
                  </div>
                  <!-- obat yang digunakan sebelum masuk rs -->
                  @php
                     $obat1 = [];
                     $obat2 = [];
                     if (!empty($rekonsiliasi_awal_data->details)) {
                        foreach ($rekonsiliasi_awal_data->details as $i => $detail) {
                           if ($i == 0) {
                              $obat1['tanggal'] = date('Y-m-d', strtotime($detail->tanggal)) ?? '';
                              $obat1['obat_nama'] = $detail->obat_nama ?? '';
                              $obat1['diteruskan_dosis'] = $detail->diteruskan_dosis ?? ''; 
                              $obat1['aturan_pakai'] = $detail->aturan_pakai ?? ''; 
                           } else if ($i == 1) {
                              $obat2['tanggal'] = date('d-m-Y', strtotime($detail->tanggal)) ?? '';
                              $obat2['obat_nama'] = $detail->obat_nama ?? '';
                              $obat2['diteruskan_dosis'] = $detail->diteruskan_dosis ?? ''; 
                              $obat2['aturan_pakai'] = $detail->aturan_pakai ?? '';
                           }
                        }
                     }
                  @endphp
                  <div class="row" style="margin-top: 10px">
                     <div class="col-md-12">
                        <label>DAFTAR OBAT YANG DIGUNAKAN SEBELUM MASUK RUMAH SAKIT</label>
                     </div>
                  </div>
                  <div>
                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Tgl Terakhir Digunakan</label>
                              <input class="form-control" type="date" name="tgl_terakhir_sebelum_masuk_rs_1" value="{{ $obat1['tanggal'] }}">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Nama Obat</label>
                              <input class="form-control" type="text" name="nama_obat_sebelum_masuk_rs_1" value="{{ $obat1['obat_nama'] }}">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label>Dosis</label>
                              <input class="form-control" type="text" name="dosis_sebelum_masuk_rs_1" value="{{ $obat1['diteruskan_dosis'] }}">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label>Frekuensi</label>
                              <input class="form-control" type="text" name="frekuensi_sebelum_masuk_rs_1" value="">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Cara Pemberian</label>
                              <input class="form-control" type="text" name="cara_pemberian_sebelum_masuk_rs_1" value="">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="row">
                              <label class="col-12">Obat Dilanjutkan Saat Rawat Inap</label>
                              <div class="form-group col-6" style="">
                                  <label class="css-control css-control-primary css-checkbox">
                                      <input type="checkbox" value="✔" class="css-control-input" name="obat_dilanjutkan_saat_rawat_inap_ya_sebelum_masuk_rs_1">
                                      <span class="css-control-indicator"></span> Ya
                                  </label>
                              </div>
                              <div class="form-group col-6" style="">
                                  <label class="css-control css-control-primary css-checkbox">
                                      <input type="checkbox" value="✔" class="css-control-input" name="obat_dilanjutkan_saat_rawat_inap_tidak_sebelum_masuk_rs_1">
                                      <span class="css-control-indicator"></span> Tidak
                                  </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Perubahan Aturan Pakai</label>
                              <input class="form-control" type="text" name="aturan_pakai_sebelum_masuk_rs_1" value="{{ $obat1['aturan_pakai'] }}">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <input class="form-control" type="date" name="tgl_terakhir_sebelum_masuk_rs_2" value="{{ $obat2['tanggal'] }}">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input class="form-control" type="text" name="nama_obat_sebelum_masuk_rs_2" value="{{ $obat2['obat_nama'] }}">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <input class="form-control" type="text" name="dosis_sebelum_masuk_rs_2" value="{{ $obat2['diteruskan_dosis'] }}">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <input class="form-control" type="text" name="frekuensi_sebelum_masuk_rs_2">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input class="form-control" type="text" name="cara_pemberian_sebelum_masuk_rs_2">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="row">
                              <div class="form-group col-6" style="">
                                  <label class="css-control css-control-primary css-checkbox">
                                      <input type="checkbox" value="✔" class="css-control-input" name="obat_dilanjutkan_saat_rawat_inap_ya_sebelum_masuk_rs_2">
                                      <span class="css-control-indicator"></span> Ya
                                  </label>
                              </div>
                              <div class="form-group col-6" style="">
                                  <label class="css-control css-control-primary css-checkbox">
                                      <input type="checkbox" value="✔" class="css-control-input" name="obat_dilanjutkan_saat_rawat_inap_tidak_sebelum_masuk_rs_2">
                                      <span class="css-control-indicator"></span> Tidak
                                  </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input class="form-control" type="text" name="aturan_pakai_sebelum_masuk_rs_2" value="{{ $obat2['aturan_pakai'] }}">
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end obat yang digunakan sebelum masuk rs -->
                  <!-- obat rutin yang digunakan -->
                  <div class="row" style="margin-top: 10px">
                     <div class="col-md-12">
                        <label>DAFTAR OBAT RUTIN YANG DIGUNAKAN</label>
                     </div>
                  </div>
                  <div>
                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Tgl Terakhir Digunakan</label>
                              <input class="form-control" type="date" name="tgl_terakhir_obat_rutin_1">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Nama Obat</label>
                              <input class="form-control" type="text" name="nama_obat_obat_rutin_1">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label>Dosis</label>
                              <input class="form-control" type="text" name="dosis_obat_rutin_1">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label>Frekuensi</label>
                              <input class="form-control" type="text" name="frekuensi_obat_rutin_1">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Cara Pemberian</label>
                              <input class="form-control" type="text" name="cara_pemberian_obat_rutin_1">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="row">
                              <label class="col-12">Obat Dilanjutkan Saat Rawat Inap</label>
                              <div class="form-group col-6" style="">
                                  <label class="css-control css-control-primary css-checkbox">
                                      <input type="checkbox" value="✔" class="css-control-input" name="obat_dilanjutkan_saat_rawat_inap_ya_obat_rutin_1">
                                      <span class="css-control-indicator"></span> Ya
                                  </label>
                              </div>
                              <div class="form-group col-6" style="">
                                  <label class="css-control css-control-primary css-checkbox">
                                      <input type="checkbox" value="✔" class="css-control-input" name="obat_dilanjutkan_saat_rawat_inap_tidak_obat_rutin_1">
                                      <span class="css-control-indicator"></span> Tidak
                                  </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Perubahan Aturan Pakai</label>
                              <input class="form-control" type="text" name="aturan_pakai_obat_rutin_1">
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end obat rutin yang digunakan -->
                  <!-- obat yang diresepkan dpjp -->
                   <div class="row" style="margin-top: 10px">
                     <div class="col-md-12">
                        <label>DAFTAR OBAT YANG DIRESEPKAN DPJP SAAT RAWAT INAP</label>
                     </div>
                  </div>
                  <div>
                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Tgl Terakhir Digunakan</label>
                              <input class="form-control" type="date" name="tgl_terakhir_obat_dpjp_1">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Nama Obat</label>
                              <input class="form-control" type="text" name="nama_obat_obat_dpjp_1">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label>Dosis</label>
                              <input class="form-control" type="text" name="dosis_obat_dpjp_1">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label>Frekuensi</label>
                              <input class="form-control" type="text" name="frekuensi_obat_dpjp_1">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Cara Pemberian</label>
                              <input class="form-control" type="text" name="cara_pemberian_obat_dpjp_1">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="row">
                              <label class="col-12">Obat Dilanjutkan Saat Rawat Inap</label>
                              <div class="form-group col-6" style="">
                                  <label class="css-control css-control-primary css-checkbox">
                                      <input type="checkbox" value="✔" class="css-control-input" name="obat_dilanjutkan_saat_rawat_inap_ya_obat_dpjp_1">
                                      <span class="css-control-indicator"></span> Ya
                                  </label>
                              </div>
                              <div class="form-group col-6" style="">
                                  <label class="css-control css-control-primary css-checkbox">
                                      <input type="checkbox" value="✔" class="css-control-input" name="obat_dilanjutkan_saat_rawat_inap_tidak_obat_dpjp_1">
                                      <span class="css-control-indicator"></span> Tidak
                                  </label>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label>Perubahan Aturan Pakai</label>
                              <input class="form-control" type="text" name="aturan_pakai_obat_dpjp_1">
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end obat yang diresepkan dpjp -->
                  <!-- end riwayat penggunaan obat -->


                  <!-- hasil pemeriksaan fisik -->
                  <hr>
                  <div class="row" style="margin-top: 30px">
                     <div class="col-md-12">
                        <h5 class="mb-5">Hasil Pemeriksaan Fisik</h5>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <table width="100%">
                           <thead>
                              <tr>
                                 <td width="10%">Nilai Normal</td>
                                 <td width="20%">Nilai Normal</td>
                                 <td width="10%">Tgl Jam</td>
                                 <td width="10%">Tgl Jam</td>
                                 <td width="10%">Tgl Jam</td>
                                 <td width="10%">Tgl Jam</td>
                                 <td width="10%">Tgl Jam</td>
                                 <td width="10%">Tgl Jam</td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 @php
                                    $td = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $td[$i]= "$item->sistol/$item->diastol";
                                       }
                                    }
                                 @endphp
                                 <td>TD</td>
                                 <td>120/80</td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_td_1" value="{{ $td[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_td_2" value="{{ $td[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_td_3" value="{{ $td[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_td_4" value="{{ $td[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_td_5" value="{{ $td[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_td_6" value="{{ $td[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $nadi = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $nadi[$i]= "$item->nadi";
                                       }
                                    }
                                 @endphp
                                 <td>Nadi</td>
                                 <td>70/80</td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nadi_1" value="{{ $nadi[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nadi_2" value="{{ $nadi[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nadi_3" value="{{ $nadi[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nadi_4" value="{{ $nadi[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nadi_5" value="{{ $nadi[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nadi_6" value="{{ $nadi[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $rr = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $rr[$i]= "$item->pernapasan";
                                       }
                                    }
                                 @endphp
                                 <td>RR</td>
                                 <td>16-20</td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_rr_1" value="{{ $rr[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_rr_2" value="{{ $rr[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_rr_3" value="{{ $rr[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_rr_4" value="{{ $rr[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_rr_5" value="{{ $rr[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_rr_6" value="{{ $rr[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $suhu = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $suhu[$i]= "$item->temperatur";
                                       }
                                    }
                                 @endphp
                                 <td>T (suhu)</td>
                                 <td>36,6-37.2</td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_suhu_1" value="{{ $suhu[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_suhu_2" value="{{ $suhu[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_suhu_3" value="{{ $suhu[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_suhu_4" value="{{ $suhu[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_suhu_5" value="{{ $suhu[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_suhu_6" value="{{ $suhu[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $gcs = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $gcs[$i]= "$item->gcs";
                                       }
                                    }
                                 @endphp
                                 <td>GCS</td>
                                 <td>
                                    &nbsp;
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_gcs_1" value="{{ $gcs[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_gcs_2" value="{{ $gcs[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_gcs_3" value="{{ $gcs[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_gcs_4" value="{{ $gcs[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_gcs_5" value="{{ $gcs[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_gcs_6" value="{{ $gcs[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $bb = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $bb[$i]= "$item->berat_badan";
                                       }
                                    }
                                 @endphp
                                 <td>BB</td>
                                 <td>
                                    &nbsp;
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_bb_1" value="{{ $bb[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_bb_2" value="{{ $bb[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_bb_3" value="{{ $bb[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_bb_4" value="{{ $bb[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_bb_5" value="{{ $bb[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_bb_6" value="{{ $bb[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $map = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $map[$i]= "$item->map_sistol_diastol";
                                       }
                                    }
                                 @endphp
                                 <td>MAP</td>
                                 <td>
                                    &nbsp;
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_map_1" value="{{ $map[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_map_2" value="{{ $map[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_map_3" value="{{ $map[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_map_4" value="{{ $map[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_map_5" value="{{ $map[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_map_6" value="{{ $map[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $spo2 = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $spo2[$i]= "$item->spo2";
                                       }
                                    }
                                 @endphp
                                 <td>Sp02</td>
                                 <td>
                                    &nbsp;
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_sp02_1" value="{{ $spo2[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_sp02_2" value="{{ $spo2[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_sp02_3" value="{{ $spo2[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_sp02_4" value="{{ $spo2[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_sp02_5" value="{{ $spo2[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_sp02_6" value="{{ $spo2[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $o2 = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $o2[$i]= "$item->o2";
                                       }
                                    }
                                 @endphp
                                 <td>O2</td>
                                 <td>
                                    &nbsp;
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_o2_1" value="{{ $o2[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_o2_2" value="{{ $o2[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_o2_3" value="{{ $o2[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_o2_4" value="{{ $o2[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_o2_5" value="{{ $o2[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_o2_6" value="{{ $o2[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $nyeri = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $nyeri[$i]= "$item->skala_nyeri";
                                       }
                                    }
                                 @endphp
                                 <td>Skala Nyeri</td>
                                 <td>
                                    &nbsp;
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nyeri_1" value="{{ $nyeri[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nyeri_2" value="{{ $nyeri[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nyeri_3" value="{{ $nyeri[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nyeri_4" value="{{ $nyeri[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nyeri_5" value="{{ $nyeri[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_nyeri_6" value="{{ $nyeri[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $infus = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $infus[$i]= "$item->cairan_infus";
                                       }
                                    }
                                 @endphp
                                 <td>Cairan Masuk Infus</td>
                                 <td>
                                    &nbsp;
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_infus_1" value="{{ $infus[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_infus_2" value="{{ $infus[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_infus_3" value="{{ $infus[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_infus_4" value="{{ $infus[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_infus_5" value="{{ $infus[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_infus_6" value="{{ $infus[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $os = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $os[$i]= "$item->cairan_per_os";
                                       }
                                    }
                                 @endphp
                                 <td>Cairan Masuk Per OS</td>
                                 <td>
                                    &nbsp;
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_cairan_1" value="{{ $os[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_cairan_2" value="{{ $os[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_cairan_3" value="{{ $os[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_cairan_4" value="{{ $os[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_cairan_5" value="{{ $os[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_cairan_6" value="{{ $os[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $urine = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $urine[$i]= "$item->produksi_urine";
                                       }
                                    }
                                 @endphp
                                 <td>Cairan Keluar Urine</td>
                                 <td>
                                    &nbsp;
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_urine_1" value="{{ $urine[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_urine_2" value="{{ $urine[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_urine_3" value="{{ $urine[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_urine_4" value="{{ $urine[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_urine_5" value="{{ $urine[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_urine_6" value="{{ $urine[5] ?? '' }}">
                                 </td>
                              </tr>
                              <tr>
                                 @php
                                    $lain = [];
                                    if (!empty($vital_sign) && count($vital_sign) > 0) {
                                       foreach ($vital_sign as $i => $item) {
                                          $lain[$i]= "$item->produksi_urine";
                                       }
                                    }
                                 @endphp
                                 <td>Cairan Keluar Lain2</td>
                                 <td>
                                    &nbsp;
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_lain_1" value="{{ $lain[0] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_lain_2" value="{{ $lain[1] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_lain_3" value="{{ $lain[2] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_lain_4" value="{{ $lain[3] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_lain_5" value="{{ $lain[4] ?? '' }}">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="tgl_jam_lain_6" value="{{ $lain[5] ?? '' }}">
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- end hasil pemeriksaan fisik -->


                  <!-- hasil pemeriksaan diagnostik -->
                  <hr>
                  <div class="row" style="margin-top: 30px">
                     <div class="col-md-12">
                        <h5 class="mb-5">Hasil Pemeriksaan Diagnostik</h5>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <table width="100%">
                           <thead>
                              <tr>
                                 <td>Tgl</td>
                                 <td>Pemeriksaan</td>
                                 <td>Hasil</td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>
                                    <input class="form-control" type="date" name="tgl_pemeriksaan_diagnostik_1">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="pemeriksaan_diagnostik_1">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="hasil_pemeriksaan_diagnostik_1">
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input class="form-control" type="date" name="tgl_pemeriksaan_diagnostik_2">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="pemeriksaan_diagnostik_2">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="hasil_pemeriksaan_diagnostik_2">
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- end hasil pemeriksaan diagnostik -->



                  <!-- hasil pemeriksaan mikrobiologi-->
                  <hr>
                  <div class="row" style="margin-top: 30px">
                     <div class="col-md-12">
                        <h5 class="mb-5">Hasil Pemeriksaan Mikrobiologi</h5>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <table width="100%">
                           <thead>
                              <tr>
                                 <td>Tgl</td>
                                 <td>Pemeriksaan</td>
                                 <td>Hasil</td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>
                                    <input class="form-control" type="date" name="tgl_pemeriksaan_mikrobiologi_1">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="pemeriksaan_mikrobiologi_1">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="hasil_pemeriksaan_mikrobiologi_1">
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input class="form-control" type="date" name="tgl_pemeriksaan_mikrobiologi_2">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="pemeriksaan_mikrobiologi_2">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="hasil_pemeriksaan_mikrobiologi_2">
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- end hasil pemeriksaan mikrobiologi -->

                  <!-- hasil pemeriksaan covid-->
                  <hr>
                  <div class="row" style="margin-top: 30px">
                     <div class="col-md-12">
                        <h5 class="mb-5">Pemeriksaan Covid</h5>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <table width="100%">
                           <thead>
                              <tr>
                                 <td>Tgl</td>
                                 <td>Pemeriksaan</td>
                                 <td>Hasil</td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>
                                    <input class="form-control" type="date" name="tgl_pemeriksaan_covid_1">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="pemeriksaan_covid_1">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="hasil_pemeriksaan_covid_1">
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <input class="form-control" type="date" name="tgl_pemeriksaan_covid_2">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="pemeriksaan_covid_2">
                                 </td>
                                 <td>
                                    <input class="form-control" type="text" name="hasil_pemeriksaan_covid_2">
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- end hasil pemeriksaan covid -->

                  <!-- hasil pemeriksaan laboratorium -->
                  <hr>
                  <div class="row" style="margin-top: 30px">
                     <div class="col-md-12">
                        <h5 class="mb-5">Hasil Pemeriksaan Laboratorium</h5>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <table width="100%">
                           <thead>
                              <tr>
                                 <td>Item</td>
                                 <td>Satuan</td>
                                 <td>Nilai Rujukan</td>
                                 <td>Tgl</td>
                                 <td>Tgl</td>
                                 <td>Tgl</td>
                                 <td>Tgl</td>
                                 <td>Tgl</td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td colspan="8" style="background-color: silver">Darah Lengkap</td>
                              </tr>
                              <tr>
                                 <td>WBC (Leukosit)</td>
                                 <td>10^3/uL</td>
                                 <td>3.8-10.8</td>
                                 <td>
                                    <input class="form-control" type="date" name="wbc_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="wbc_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="wbc_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="wbc_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="wbc_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>WBC (Leukosit)</td>
                                 <td>10^6/uL</td>
                                 <td>4.4-5.90</td>
                                 <td>
                                    <input class="form-control" type="date" name="wbc_l_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="wbc_l_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="wbc_l_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="wbc_l_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="wbc_l_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>HGB (Hemogoblin)</td>
                                 <td>g/dl</td>
                                 <td>13.2-17.3</td>
                                 <td>
                                    <input class="form-control" type="date" name="hgb_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hgb_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hgb_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hgb_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hgb_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>HCT (Hematokrit)</td>
                                 <td>%</td>
                                 <td>40-52</td>
                                 <td>
                                    <input class="form-control" type="date" name="hct_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hct_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hct_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hct_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hct_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>MCV</td>
                                 <td>fl</td>
                                 <td>80-100</td>
                                 <td>
                                    <input class="form-control" type="date" name="mcv_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mcv_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mcv_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mcv_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mcv_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>MCH</td>
                                 <td>pg</td>
                                 <td>26-34</td>
                                 <td>
                                    <input class="form-control" type="date" name="mch_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mch_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mch_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mch_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mch_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>MCHC</td>
                                 <td>g/dL</td>
                                 <td>32-36</td>
                                 <td>
                                    <input class="form-control" type="date" name="mchc_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mchc_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mchc_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mchc_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mchc_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>PLT (Trombosit)</td>
                                 <td>10^3/uL</td>
                                 <td>150-440</td>
                                 <td>
                                    <input class="form-control" type="date" name="plt_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="plt_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="plt_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="plt_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="plt_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>RDW-SD</td>
                                 <td>%</td>
                                 <td>37-54</td>
                                 <td>
                                    <input class="form-control" type="date" name="rdw_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="rdw_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="rdw_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="rdw_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="rdw_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>RDW-CV</td>
                                 <td>%</td>
                                 <td>11.5-14.5</td>
                                 <td>
                                    <input class="form-control" type="date" name="rdw_cv_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="rdw_cv_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="rdw_cv_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="rdw_cv_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="rdw_cv_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>PDW</td>
                                 <td>fl</td>
                                 <td>9-17</td>
                                 <td>
                                    <input class="form-control" type="date" name="pdw_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="pdw_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="pdw_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="pdw_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="pdw_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>MPV</td>
                                 <td>fl</td>
                                 <td>9-13</td>
                                 <td>
                                    <input class="form-control" type="date" name="mpv_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mpv_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mpv_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mpv_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mpv_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>P-LCR</td>
                                 <td>%</td>
                                 <td>13-43</td>
                                 <td>
                                    <input class="form-control" type="date" name="p_lcr_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="p_lcr_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="p_lcr_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="p_lcr_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="p_lcr_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>PCR</td>
                                 <td>%</td>
                                 <td>0.17-0.35</td>
                                 <td>
                                    <input class="form-control" type="date" name="pcr_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="pcr_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="pcr_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="pcr_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="pcr_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>LED</td>
                                 <td></td>
                                 <td></td>
                                 <td>
                                    <input class="form-control" type="date" name="led_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="led_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="led_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="led_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="led_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>NEUT#</td>
                                 <td>10^3/uL</td>
                                 <td>2.0-7.7</td>
                                 <td>
                                    <input class="form-control" type="date" name="neut_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="neut_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="neut_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="neut_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="neut_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>LYMPH#</td>
                                 <td>10^3/uL</td>
                                 <td>0.8-4.0</td>
                                 <td>
                                    <input class="form-control" type="date" name="lymph_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="lymph_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="lymph_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="lymph_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="lymph_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>MONO#</td>
                                 <td>10^3/uL</td>
                                 <td>0.1-0.80</td>
                                 <td>
                                    <input class="form-control" type="date" name="mono_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mono_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mono_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mono_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="mono_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>EO#</td>
                                 <td>10^3/uL</td>
                                 <td>0.0-0.50</td>
                                 <td>
                                    <input class="form-control" type="date" name="eo_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="eo_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="eo_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="eo_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="eo_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>BASO#</td>
                                 <td>10^3/uL</td>
                                 <td>0.0-0.15</td>
                                 <td>
                                    <input class="form-control" type="date" name="baso_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="baso_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="baso_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="baso_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="baso_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>IG#</td>
                                 <td>10^3/uL</td>
                                 <td>0.0-0.02</td>
                                 <td>
                                    <input class="form-control" type="date" name="ig_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="ig_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="ig_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="ig_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="ig_tgl_5" id="">
                                 </td>
                              </tr>
                              <!-- elektrolit -->
                              <tr>
                                 <td colspan="8" style="background-color: silver">Elektrolit</td>
                              </tr>
                              <tr>
                                 <td>Natrium</td>
                                 <td>mmol/L</td>
                                 <td>135-148</td>
                                 <td>
                                    <input class="form-control" type="date" name="natrium_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="natrium_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="natrium_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="natrium_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="natrium_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Kalium</td>
                                 <td>mmol/L</td>
                                 <td>3.5-5.1</td>
                                 <td>
                                    <input class="form-control" type="date" name="kalium_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="kalium_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="kalium_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="kalium_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="kalium_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Cholrida</td>
                                 <td>mmol/L</td>
                                 <td>98-107</td>
                                 <td>
                                    <input class="form-control" type="date" name="chlorida_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="chlorida_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="chlorida_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="chlorida_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="chlorida_tgl_5" id="">
                                 </td>
                              </tr>
                              
                              <!-- kimia klinik -->
                              <tr>
                                 <td colspan="8" style="background-color: silver">Kimia Klinik</td>
                              </tr>
                              <tr>
                                 <td>Glukosa Puasa</td>
                                 <td>mg/dL</td>
                                 <td>70-105</td>
                                 <td>
                                    <input class="form-control" type="date" name="glukosa_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="glukosa_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="glukosa_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="glukosa_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="glukosa_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Gula sewaktu</td>
                                 <td>mg/dL</td>
                                 <td>115</td>
                                 <td>
                                    <input class="form-control" type="date" name="gula_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gula_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gula_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gula_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gula_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Gula Darah 2JPP</td>
                                 <td>mg/dL</td>
                                 <td>70-140</td>
                                 <td>
                                    <input class="form-control" type="date" name="gula_darah_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gula_darah_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gula_darah_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gula_darah_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gula_darah_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>HbA1C</td>
                                 <td>%</td>
                                 <td>03-jun</td>
                                 <td>
                                    <input class="form-control" type="date" name="hba1c_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hba1c_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hba1c_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hba1c_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hba1c_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Asam Urat</td>
                                 <td>%</td>
                                 <td>L3.4-7</td>
                                 <td>
                                    <input class="form-control" type="date" name="asam_urat_l_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="asam_urat_l_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="asam_urat_l_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="asam_urat_l_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="asam_urat_l_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Asam Urat</td>
                                 <td>mg/dL</td>
                                 <td>P2.4-5.7</td>
                                 <td>
                                    <input class="form-control" type="date" name="asam_urat_p_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="asam_urat_p_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="asam_urat_p_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="asam_urat_p_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="asam_urat_p_tgl_5" id="">
                                 </td>
                              </tr>
                              <!-- Fugnsi Hati (LFT) -->
                              <tr>
                                 <td colspan="8" style="background-color: silver">Fungsi Hati (LFT)</td>
                              </tr>
                              <tr>
                                 <td>Bilirubin Direk</td>
                                 <td>mg/dL</td>
                                 <td>0-0.6</td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_direk_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_direk_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_direk_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_direk_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_direk_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Bilirubin Indirek</td>
                                 <td>mg/dL</td>
                                 <td>0-0.6</td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_indirek_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_indirek_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_indirek_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_indirek_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_indirek_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Bilirubin Total</td>
                                 <td>mg/dL</td>
                                 <td>0.3-1</td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_total_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_total_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_total_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_total_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bilirubin_total_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>SGOT</td>
                                 <td>U/L</td>
                                 <td>8-33</td>
                                 <td>
                                    <input class="form-control" type="date" name="sgot_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="sgot_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="sgot_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="sgot_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="sgot_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>SGPT</td>
                                 <td>U/L</td>
                                 <td>3-35</td>
                                 <td>
                                    <input class="form-control" type="date" name="sgpt_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="sgpt_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="sgpt_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="sgpt_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="sgpt_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>BUN</td>
                                 <td>mg/dL</td>
                                 <td>17-48</td>
                                 <td>
                                    <input class="form-control" type="date" name="bun_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bun_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bun_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bun_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="bun_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Protein Total</td>
                                 <td>g/dL</td>
                                 <td>6-8</td>
                                 <td>
                                    <input class="form-control" type="date" name="protein_total_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="protein_total_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="protein_total_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="protein_total_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="protein_total_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Albumin</td>
                                 <td>g/dL</td>
                                 <td>3.8-5.1</td>
                                 <td>
                                    <input class="form-control" type="date" name="albumin_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="albumin_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="albumin_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="albumin_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="albumin_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Alkaline Fosfate</td>
                                 <td>U/L</td>
                                 <td>15-69</td>
                                 <td>
                                    <input class="form-control" type="date" name="alkaline_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="alkaline_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="alkaline_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="alkaline_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="alkaline_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>GGT (Gamma GT)</td>
                                 <td>U/L</td>
                                 <td>5-38</td>
                                 <td>
                                    <input class="form-control" type="date" name="gamma_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gamma_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gamma_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gamma_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="gamma_tgl_5" id="">
                                 </td>
                              </tr>
                              <!-- Fugnsi Ginjal -->
                              <tr>
                                 <td colspan="8" style="background-color: silver">Fungsi Ginjal</td>
                              </tr>
                              <tr>
                                 <td>Urea</td>
                                 <td>mg/dL</td>
                                 <td>15-45</td>
                                 <td>
                                    <input class="form-control" type="date" name="urea_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="urea_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="urea_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="urea_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="urea_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Creatinin</td>
                                 <td>mg/dL</td>
                                 <td>L0.9-5.1</td>
                                 <td>
                                    <input class="form-control" type="date" name="creatinin_l_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="creatinin_l_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="creatinin_l_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="creatinin_l_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="creatinin_l_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Creatinin</td>
                                 <td>mg/dL</td>
                                 <td>P0.7-1.4</td>
                                 <td>
                                    <input class="form-control" type="date" name="creatinin_p_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="creatinin_p_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="creatinin_p_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="creatinin_p_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="creatinin_p_tgl_5" id="">
                                 </td>
                              </tr>
                              <!-- Fugnsi Lipid -->
                              <tr>
                                 <td colspan="8" style="background-color: silver">Fungsi Lipid</td>
                              </tr>
                              <tr>
                                 <td>Kolesterol Total</td>
                                 <td>mg/dL</td>
                                 <td>140-200</td>
                                 <td>
                                    <input class="form-control" type="date" name="kolesterol_total_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="kolesterol_total_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="kolesterol_total_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="kolesterol_total_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="kolesterol_total_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>HDL</td>
                                 <td>mg/dL</td>
                                 <td>L => 35</td>
                                 <td>
                                    <input class="form-control" type="date" name="hdl_l_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hdl_l_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hdl_l_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hdl_l_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hdl_l_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>HDL</td>
                                 <td>mg/dL</td>
                                 <td>P => 45</td>
                                 <td>
                                    <input class="form-control" type="date" name="hdl_p_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hdl_p_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hdl_p_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hdl_p_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="hdl_p_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>LDL</td>
                                 <td>mg/dL</td>
                                 <td>&lt;190</td>
                                 <td>
                                    <input class="form-control" type="date" name="ldl_tgl_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="ldl_tgl_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="ldl_tgl_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="ldl_tgl_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="ldl_tgl_5" id="">
                                 </td>
                              </tr>
                              <tr>
                                 <td>Trigliserida</td>
                                 <td>mg/dL</td>
                                 <td>30-150</td>
                                 <td>
                                    <input class="form-control" type="date" name="trigliserida_1" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="trigliserida_2" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="trigliserida_3" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="trigliserida_4" id="">
                                 </td>
                                 <td>
                                    <input class="form-control" type="date" name="trigliserida_5" id="">
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- end hasil pemeriksaan laboratorium -->


                  
                  <!-- hasil pemantauan terapi -->
                  <hr>
                  <div class="row" style="margin-top: 30px">
                     <div class="col-md-12">
                        <h5 class="mb-5">Hasil Pemantauan Terapi</h5>
                     </div>
                  </div>
                  <div class="row">
                     @php
                        $cppt_arr = [];
                        if (!empty($cppt) && count($cppt) > 0) {
                           foreach ($cppt as $i => $item) {
                              $cppt_arr[$i]= $item;
                           }
                        }
                     @endphp
                     <div class="col-md-4">
                        <table width="100%">
                           <tr>
                              <td width="10%">S</td>
                              <td width="90%">
                                 <textarea class="form-control" name="s_1" id="" rows="2">{{ $cppt_arr[0]->subjective ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>O</td>
                              <td>
                                 <textarea class="form-control" name="o_1" id="" rows="2">{{ $cppt_arr[0]->objective ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>A</td>
                              <td>
                                 <textarea class="form-control" name="a_1" id="" rows="2">{{ $cppt_arr[0]->assessment ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>P</td>
                              <td>
                                 <textarea class="form-control" name="p_1" id="" rows="2">{{ $cppt_arr[0]->plan ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>Tanggal</td>
                              <td>
                                 <input class="form-control" type="date" name="tgl_cppt_1" @if(!empty($cppt_arr[0]->created_at)) value="{{ date('Y-m-d', strtotime($cppt_arr[0]->created_at)) }}" @endif>
                              </td>
                              <td></td>
                           </tr>
                        </table>
                     </div>
                     <div class="col-md-4">
                        <table width="100%">
                           <tr>
                              <td width="10%">S</td>
                              <td width="90%">
                                 <textarea class="form-control" name="s_2" id="" rows="2">{{ $cppt_arr[1]->subjective ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>O</td>
                              <td>
                                 <textarea class="form-control" name="o_2" id="" rows="2">{{ $cppt_arr[1]->objective ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>A</td>
                              <td>
                                 <textarea class="form-control" name="a_2" id="" rows="2">{{ $cppt_arr[1]->assessment ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>P</td>
                              <td>
                                 <textarea class="form-control" name="p_2" id="" rows="2">{{ $cppt_arr[1]->plan ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>Tanggal</td>
                              <td>
                                 <input class="form-control" type="date" name="tgl_cppt_2" @if(!empty($cppt_arr[1]->created_at)) value="{{ date('Y-m-d', strtotime($cppt_arr[1]->created_at)) }}" @endif>
                              </td>
                              <td></td>
                           </tr>
                        </table>
                     </div>
                     <div class="col-md-4">
                        <table width="100%">
                           <tr>
                              <td width="10%">S</td>
                              <td width="90%">
                                 <textarea class="form-control" name="s_3" id="" rows="2">{{ $cppt_arr[2]->subjective ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>O</td>
                              <td>
                                 <textarea class="form-control" name="o_3" id="" rows="2">{{ $cppt_arr[2]->objective ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>A</td>
                              <td>
                                 <textarea class="form-control" name="a_3" id="" rows="2">{{ $cppt_arr[2]->assessment ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>P</td>
                              <td>
                                 <textarea class="form-control" name="p_3" id="" rows="2">{{ $cppt_arr[2]->plan ?? '' }}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>Tanggal</td>
                              <td>
                                 <input class="form-control" type="date" name="tgl_cppt_3" @if(!empty($cppt_arr[2]->created_at)) value="{{ date('Y-m-d', strtotime($cppt_arr[2]->created_at)) }}" @endif>
                              </td>
                              <td></td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <!-- hasil pemantauan terapi -->

					</div>
				</div>

            
				<div class="modal-footer">
					<div class="form-group">
						<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
					</div>
				</div>
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>