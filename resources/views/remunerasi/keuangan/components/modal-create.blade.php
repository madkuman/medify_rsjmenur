<div class="modal fade" id="modal-create-pelayanan" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-pelayanan" enctype="multipart/form-data">
				<div class="block block-themed block-transparent mb-0">
				    <div class="block-header">
				        <h3 class="block-title" id="title-modal"></h3>
				        <div class="block-options">
				            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
				                <i class="si si-close"></i>
				            </button>
				        </div>
				    </div>
                    
					<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
						<input type="hidden" name="id" id="id" value="">
                        <div class="row for-create d-none">
                                <div class="col-4">
                                    <label for="example-datepicker1">Tanggal</label>
                                    <div class="form-inline">
                                    <input type="text" id="date-modal" data-format="DD-MM-YYYY" data-template="MMMM YYYY" name="bulan_tahun" class="combodate" value="{{date('d-m-Y')}}">
                                    <small class="text-danger hide" id="error_main_tanggal">Tidak Boleh Kosong</small>
                                    </div>
                                </div>
                                <div class="col-4" id="input-judul-container">
                                    <label>Nama Pegawai</label>
                                    <select class="js-select2 form-control" id="pegawai" name="pegawai" onchange="getJPDasar()" style="width: 100%;" required>
                                    </select>
                                    <small class="text-danger hide" id="error_judul_kosong">Tidak Boleh Kosong</small>
                                </div>
                        </div>
                        <div class="row for-edit d-none">
                            <div class="col-6" id="input-judul-container">
                                <label for="example-datepicker1">Nama </label> : <h7><span id="nama"></span></h7><br>
                                <label for="example-datepicker1">NRP  </label> : <h7><span id="nrp"></span></h7>
                            </div>
                            <div class="col-4" id="input-judul-container">
                                <label for="example-datepicker1">Bulan </label> : <h5><span id="bulan"></span></h5>
                            </div>
                           
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-3" id="input-pihak3-container">
                                <label>JP Dasar</label>
                                <input type="text" class="form-control" id="jp-dasar" name="jp_dasar" placeholder="Masukkan Jumlah">
                            </div>
                            <div class="col-3" id="input-pasien-container">
                                <label>Visite Tetap</label>
                                <input type="text" class="form-control" id="visite-tetap" name="visite_tetap" placeholder="Masukkan Jumlah">
                            </div>
                            <div class="col-3" id="input-pasien-pembayaran-container">
                                <label>Visite Anggrek</label>
                                <input type="text" class="form-control" id="visite-anggrek" name="visite_anggrek" placeholder="Masukkan Jumlah">
                            </div>
                            <div class="col-3">
                                <label>Jasa Pendidikan</label>
                                <input type="text" class="form-control" id="jasa-pendidikan" name="jasa_pendidikan" placeholder="Masukkan Jumlah">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-3" id="input-judul-container">
                                <label>Tindakan Dokter</label>
                                <input type="text" class="form-control" id="tindakan-dokter" name="tindakan_dokter" placeholder="Masukkan Jumlah">
                            </div>
                            <div class="col-3" id="input-pasien-pembayaran-container">
                                <label>Konsul Dokter</label>
                                <input type="text" class="form-control" id="konsul-dokter" name="konsul_dokter" placeholder="Masukkan Jumlah">
                            </div>
                            <div class="col-3">
                                <label>Poli Tumbang</label>
                                <input type="text" class="form-control" id="poli-tumbang" name="poli_tumbang" placeholder="Masukkan Jumlah">
                            </div>
                            <div class="col-3" id="input-pihak3-container">
                                <label>APS/ECT</label>
                                <input type="text" class="form-control" id="aps-ect" name="aps_ect" placeholder="Masukkan Jumlah">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-3" id="input-judul-container">
                                <label>Patologi Klinik</label>
                                <input type="text" class="form-control" id="patologi-klinik" name="patologi_klinik" placeholder="Masukkan Jumlah">
                            </div>
                            <div class="col-3" id="input-pasien-pembayaran-container">
                                <label>IPWL</label>
                                <input type="text" class="form-control" id="ipwl" name="ipwl" placeholder="Masukkan Jumlah">
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                    </div>
				</div><br>
				<div class="modal-footer">
				    <div class="form-group">
				        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-submit-absensi" type="submit" id="btnSubmit"><i class="fa fa-plus"></i> Simpan</button>
                            <button class="btn btn-alt-primary btn-simple" style="display: none" type="button"  id="btnLoading">
                                <i class="fa fa-asterisk fa-spin"></i> Loading
                            </button>
				    </div>
				</div>
            </form>
        </div>
    </div>
</div>