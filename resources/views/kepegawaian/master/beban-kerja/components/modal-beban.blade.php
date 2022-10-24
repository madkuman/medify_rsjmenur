<div class="modal fade" id="modal-beban-kerja" role="dialog" aria-labelledby="modal-fromtop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromtop modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url()->current()}}" id="form-beban-kerja">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0"><span id="modal-option">Tambah</span> Beban Kerja</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <input type="hidden" name="bebanid" id="form-bebanid" value="0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Nama</label>
                                    <input type="text" name="nama" id="form-nama" placeholder="Masukkan nama" class="form-control" 
                                    required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Index</label>
                                    <input type="number" name="index" id="form-index" placeholder="Masukkan index" class="form-control" 
                                    required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125" id="btn-save">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>