<div class="modal fade" id="modal-screen-detail" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Detail Screen TV</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-6">
                                        <p class="font-size-md font-w600">
                                            Nama Screen <br>
                                            <span class="font-w400" id="nama_scr_detail">Nama</span>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p class="font-size-md font-w600">
                                            Kelas Antrian <br>
                                            <span class="font-w400" id="kelas_detail">Kelas</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <p class="font-size-md font-w600">
                                            Ruangan
                                        </p>
                                        <div id="ruangan_detail">Ruangan list</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="temp_level" id="temp_level">
                        <input type="hidden" name="temp_ruangan" id="temp_ruangan">
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-danger min-width-125" id="btn_hapus" data-id="">
                            <i class="fa fa-trash mr-5"></i> Hapus
                        </button>
                        <button type="button" class="btn-alt btn-hero btn-info min-width-125" id="btn_edit" data-id="">
                            <i class="fa fa-pencil mr-5"></i> Edit
                        </button>
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                    </div>
                </div>
        </div>
    </div>
</div>