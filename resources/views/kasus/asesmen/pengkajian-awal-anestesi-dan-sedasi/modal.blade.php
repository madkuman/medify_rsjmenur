
<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pengkajian Awal Anestesi dan Sedasi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="" id="id">
                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <div class="row">
                        	
							<div class="form-group col-md-3 col-sm-12">
							    <label>BB</label>
							    <input type="text" class="form-control" name="bb" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>TB</label>
							    <input type="text" class="form-control" name="tb" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>IMT</label>
							    <input type="text" class="form-control" name="imt" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Diagnosis</label>
							    <input type="text" class="form-control" name="diagnosis" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Tindakan Bedah</label>
							    <input type="text" class="form-control" name="tindakan_bedah" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Subyektif</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Anamnesis</label>
							    <input type="text" class="form-control" name="anamnesis" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Riwayat Asma</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="riwayat_asma" value="Ada">
							            <span class="css-control-indicator"></span> Ada
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="riwayat_asma" value="Tidak Ada">
							            <span class="css-control-indicator"></span> Tidak Ada
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Alergi</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="alergi" value="Ada">
							            <span class="css-control-indicator"></span> Ada
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="alergi" value="Tidak Ada">
							            <span class="css-control-indicator"></span> Tidak Ada
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">DM</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="dm" value="Ada">
							            <span class="css-control-indicator"></span> Ada
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="dm" value="Tidak Ada">
							            <span class="css-control-indicator"></span> Tidak Ada
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Hipertensi</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="hipertensi" value="Ada">
							            <span class="css-control-indicator"></span> Ada
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="hipertensi" value="Tidak Ada">
							            <span class="css-control-indicator"></span> Tidak Ada
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Riwayat Operasi</label>
							    <input type="text" class="form-control" name="riwayat_operasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Jenis Anestesi</label>
							    <input type="text" class="form-control" name="jenis_anestesi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Komplikasi</label>
							    <input type="text" class="form-control" name="komplikasi" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Obyektif</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Pemeriksaan Fisik</label>
							    <input type="text" class="form-control" name="pemeriksaan_fisik" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Keadaan Umum</label>
							    <input type="text" class="form-control" name="keadaan_umum" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>TTV</label>
							    <input type="text" class="form-control" name="ttv" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>TTV Tensi</label>
							    <input type="text" class="form-control" name="ttv_tensi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>TTV N</label>
							    <input type="text" class="form-control" name="ttv_n" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>TTV RR</label>
							    <input type="text" class="form-control" name="ttv_rr" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>TTV t</label>
							    <input type="text" class="form-control" name="ttv_t" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>TTV VAS</label>
							    <input type="text" class="form-control" name="ttv_vas" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Kepala Leher</label>
							    <input type="text" class="form-control" name="kepala_leher" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Conjungtiva</label>
							    <input type="text" class="form-control" name="conjungtiva" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>GCS</label>
							    <input type="text" class="form-control" name="gcs" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Malampati</label>
							    <input type="text" class="form-control" name="malampati" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Thorax</label>
							    <input type="text" class="form-control" name="thorax" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Abdomen</label>
							    <input type="text" class="form-control" name="abdomen" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Ekstermitas</label>
							    <input type="text" class="form-control" name="ekstermitas" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Laboratorium</label>
							    <textarea class="form-control" name="laboratorium" > </textarea>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>EKG</label>
							    <input type="text" class="form-control" name="ekg" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>RO Thorax</label>
							    <input type="text" class="form-control" name="ro_thorax" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Pemeriksaan Penunjang Lain</label>
							    <input type="text" class="form-control" name="pemeriksaan_penunjang_lain" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Assesment</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Setuju Anestesi</label>
							    <input type="text" class="form-control" name="setuju_anestesi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Premedikasi</label>
							    <input type="text" class="form-control" name="premedikasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Tidak Setuju Anestesi</label>
							    <input type="text" class="form-control" name="tidak_setuju_anestesi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>ASA PS</label>
							    <input type="text" class="form-control" name="asa_ps" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Puasa</label>
							    <input type="text" class="form-control" name="puasa" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Rencana Tindakan</label>
							    <input type="text" class="form-control" name="rencana_tindakan" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Planning</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Teknik Anestesi dan Sedasi</label>
							    <input type="text" class="form-control" name="teknik_anestesi_dan_sedasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Sedasi</label>
							    <input type="text" class="form-control" name="sedasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>GA</label>
							    <input type="text" class="form-control" name="ga" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Regional</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="regional_spinal">
							            <span class="css-control-indicator"></span> Spinal
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="regional_epidural">
							            <span class="css-control-indicator"></span> Epidural
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="regional_kaudal">
							            <span class="css-control-indicator"></span> Kaudal
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="regional_block_periver">
							            <span class="css-control-indicator"></span> Block Periver
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Persediaan Darah</label>
							    <input type="text" class="form-control" name="persediaan_darah" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Teknik Khusus</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="teknik_khusus_hipotensi">
							            <span class="css-control-indicator"></span> Hipotensi
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="teknik_khusus_ventilasi_satu_paru">
							            <span class="css-control-indicator"></span> Ventilasi Satu Paru
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="teknik_khusus_tci">
							            <span class="css-control-indicator"></span> TCI
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Teknik Khusus Lainnya</label>
							    <input type="text" class="form-control" name="teknik_khusus_lainnya" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Monitoring</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="monitoring_ekg_leed">
							            <span class="css-control-indicator"></span> EKG Leed
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="monitoring_spo2">
							            <span class="css-control-indicator"></span> SpO2
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="monitoring_nibp">
							            <span class="css-control-indicator"></span> NIBP
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="monitoring_temp">
							            <span class="css-control-indicator"></span> Temp
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="monitoring_cvp">
							            <span class="css-control-indicator"></span> CVP
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="monitoring_arteleri_line">
							            <span class="css-control-indicator"></span> Arteleri Line
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="monitoring_etco2">
							            <span class="css-control-indicator"></span> EtCO2
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="monitoring_bis">
							            <span class="css-control-indicator"></span> BIS
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Monitoring Lain lain</label>
							    <input type="text" class="form-control" name="monitoring_lain_lain" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Perawatan Pasca Anestesi</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perawatan_pasca_anestesi_rawat_jalan">
							            <span class="css-control-indicator"></span> Rawat Jalan
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perawatan_pasca_anestesi_rawat_inap">
							            <span class="css-control-indicator"></span> Rawat Inap
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perawatan_pasca_anestesi_icu">
							            <span class="css-control-indicator"></span> ICU
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perawatan_pasca_anestesi_imcu">
							            <span class="css-control-indicator"></span> IMCU
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perawatan_pasca_anestesi_nicu">
							            <span class="css-control-indicator"></span> NICU
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
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
