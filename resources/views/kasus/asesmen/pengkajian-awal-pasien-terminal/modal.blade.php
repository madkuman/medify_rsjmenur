
<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pengkajian Awal Pasien Terminal</h3>
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
                        	
							<div class="col-12">
								<h3 class="pt-15">Pengkajian Fisik</h3>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>K/U</label>
							    <input type="text" class="form-control" name="ku" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Observerasi TTV</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>TD</label>
							    <input type="text" class="form-control" name="td" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>S/N</label>
							    <input type="text" class="form-control" name="sn" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>RR</label>
							    <input type="text" class="form-control" name="rr" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>GCS</label>
							    <input type="text" class="form-control" name="gcs" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Penilaian Nyeri</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Skala Nyeri</label>
							    <input type="text" class="form-control" name="skala_nyeri" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Karakteristik</label>
							    <input type="text" class="form-control" name="karakteristik" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Lokasi</label>
							    <input type="text" class="form-control" name="lokasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Durasi</label>
							    <input type="text" class="form-control" name="durasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Frekuensi</label>
							    <input type="text" class="form-control" name="frekuensi" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Alat Bantu Yang Dipakai</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="alat_bantu_yang_dipakai_ventilator">
							            <span class="css-control-indicator"></span> Ventilator
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="alat_bantu_yang_dipakai_oksigen">
							            <span class="css-control-indicator"></span> Oksigen
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="alat_bantu_yang_dipakai_monitor">
							            <span class="css-control-indicator"></span> Monitor
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>

							<div class="form-group col-md-3 col-sm-12">
							    <label>Alat Bantu Lainnya</label>
							    <input type="text" class="form-control" name="alat_bantu_lainnya" >
							</div>
							<div class="col-12">
								<h3 class="pt-15">Pengkajian Psikologis</h3>
							</div>
							<div class="col-12">
								<h5 class="pt-15">Kondisi Psikologis</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_psikologis_denial">
							            <span class="css-control-indicator"></span> Denial
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_psikologis_sedih">
							            <span class="css-control-indicator"></span> Sedih
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_psikologis_depresi">
							            <span class="css-control-indicator"></span> Depresi
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_psikologis_marah">
							            <span class="css-control-indicator"></span> Marah
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_psikologis_rasa_ketergantungan">
							            <span class="css-control-indicator"></span> Rasa Ketergantungan
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_psikologis_kehilangan_harapan">
							            <span class="css-control-indicator"></span> Kehilangan Harapan
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_psikologis_menerima">
							            <span class="css-control-indicator"></span> Menerima
							        </label>
							    </div>
							</div>

							<div class="col-12">
								&nbsp;
							</div>

							<div class="form-group col-md-3 col-sm-12">
							    <label>Kondisi Psikologis Lainnya</label>
							    <input type="text" class="form-control" name="kondisi_psikologis_lainnya" >
							</div>
							<div class="col-12">
								<h3 class="pt-15">Pengkajian Sosial</h3>
							</div>
							<div class="col-12">
								<h5 class="pt-15">Dukungan</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="dukungan_apakah_ada_teman_dekat">
							            <span class="css-control-indicator"></span> Apakah Ada Teman Dekat
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="dukungan_apakah_ada_keluarga_yang_mendukung">
							            <span class="css-control-indicator"></span> Apakah Ada Keluarga Yang Mendukung
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="dukungan_tidak_ada_yang_mendukung">
							            <span class="css-control-indicator"></span> Tidak Ada Yang Mendukung
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Dukungan Lainnya</label>
							    <input type="text" class="form-control" name="dukungan_lainnya" >
							</div>
							<div class="col-12">
								<h3 class="pt-15">Pengkajian Spiritual</h3>
							</div>
							<div class="col-12">
								<h5 class="pt-15">Kondisi Spiritual</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_spiritual_taat_beribadah">
							            <span class="css-control-indicator"></span> Taat beribadah
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_spiritual_kurang_taat_beribadah">
							            <span class="css-control-indicator"></span> Kurang taat beribadah
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_spiritual_membutuhkan_pelayanan__rohaniawan">
							            <span class="css-control-indicator"></span> Membutuhkan Pelayanan  Rohaniawan
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kondisi_spiritual_menolak_pelayanan_rohaniawan">
							            <span class="css-control-indicator"></span> Menolak Pelayanan rohaniawan
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Kondisi Spiritual Lainnya</label>
							    <input type="text" class="form-control" name="kondisi_spiritual_lainnya" >
							</div>
							<div class="col-12">
								<h3 class="pt-15">Informasi dan Edukasi</h3>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Informasi dan Edukasi</label>
							    <textarea class="form-control" name="informasi_dan_edukasi" > </textarea>
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
