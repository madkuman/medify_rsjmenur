<div class="modal fade" id="modal-edit-detail" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="" id="form-edit-anggaran-makanan-detail">
                {{ csrf_field() }}
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Ubah Data Anggaran Makanan Detail</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content" id="block-edit-content">
                        <div class="d-none text-center" id="loading-detail">
                            <i class="fa fa-2x fa-spinner fa-spin text-info"></i>
                        </div>
                        <div class="row d-none" id="edit-content-detail">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="text" id="edit_detail_tahun" class="form-control js-datepicker-year" onkeydown="return false" name="tahun" data-date-autoclose="true" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="number" id="edit_detail_jumlah" class="form-control" placeholder="Jumlah" name="jumlah" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125 btn-click-animate btn-edit" id="btn-edit">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>