<div class="modal fade" id="modal-laporan-napza" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Laporan Napza</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="block-content">
                            <h5>Kop Surat</h5>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Tanggal Surat</label>
                                    <input class="form-control form-control-lg js-datepicker form-control" id="tanggal_surat" name="tanggal_surat" placeholder="Tanggal Surat" data-today-highlight="true" data-date-format="dd-mm-yyyy" autocomplete="off" data-autoclose="true" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                                </div>
                                <div class="form-group col-4">
                                    <label>Nomor Surat</label>
                                    <input class="form-control form-control-lg " id="nomor_surat" name="nomor_surat" placeholder="Nomor Surat">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="block-content">
                            <h5>Yang Bertanda Tangan</h5>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Nama</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" id="nama_ttd" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">No SIPDS</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" id="sipds_ttd" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Jabatan</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" id="jabatan_ttd" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Instansi</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" id="instansi_ttd" placeholder="" value="">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Jabatan</label>
                                <div class="col-12">
                                    <textarea type="text" class="form-control form-control-lg" id="keterangan_ttd" placeholder="" value="" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="block-content">
                            <h5 >Yang Meminta</h5>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Nama</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" id="nama_peminta" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">No SIPDS</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" id="sipds_peminta" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Jabatan</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" id="jabatan_peminta" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Instansi</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" id="instansi_peminta" placeholder="" value="">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Perihal Permintaan</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" id="perihal" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="block-content">
                            <h5 >Tanggal Pemeriksaan</h5>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Fisik Diagnostik</label>
                                <div class="col-12 mb-5">
                                    <input type="text" class="js-datepicker form-control" id="tgl-fisik" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control time" id="jam-fisik" placeholder="hh:mm">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Psikiatrik</label>
                                <div class="col-12 mb-5">
                                    <input type="text" class="js-datepicker form-control" id="tgl-psikiatrik" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control time" id="jam-psikiatrik" placeholder="hh:mm">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Tambahan</label>
                                <div class="col-12 mb-5">
                                    <input type="text" class="js-datepicker form-control" id="tgl-tambahan" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control time" id="jam-tambahan" placeholder="hh:mm">
                                </div>
                            </div>
                            <div class="form-group row mb-10">
                                <label class="col-12" for="">Keperluan</label>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-lg" id="keperluan" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="form-group row mb-10">
                            <div class="col-12 text-center">
                                <button type="button" id="submit_laporan_napza" class="btn btn-hero btn-alt-primary min-width-175">
                                    <i class="fa fa-send mr-5"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>