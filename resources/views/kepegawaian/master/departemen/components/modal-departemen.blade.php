<div class="modal fade" id="modal-departemen" role="dialog" aria-labelledby="modal-fromtop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromtop modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url()->current()}}" id="form-departemen">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0"><span id="modal-option">Tambah</span> Departemen</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option btn-close" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <input type="hidden" name="departemenid" id="form-departemenid" value="0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Departemen</label>
                                    <input type="text" name="nama" id="form-nama" placeholder="Masukkan nama departemen" class="form-control" 
                                    required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-default btn-hero pull-right btn-close" data-dismiss="modal">
                            Tutup
                        </button>
                        <button class="btn btn-primary btn-hero pull-right btn-click-animate" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>