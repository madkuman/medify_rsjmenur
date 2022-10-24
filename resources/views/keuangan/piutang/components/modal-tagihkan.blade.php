<!-- modal tagihkan -->
<div id="modal_tagihkan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed">
                <div class="block-header bg-primary">
                    <h5 class="block-title">Masukkan nomor surat untuk penagihan</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                    {{csrf_field()}}
                    <div class="block-content">
                        <div class="row mb-20">
                            <div class="col-md-5">
                                <h5 style="margin-bottom:0">Judul</h5>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="judul" id="judul" class="form-control" required="">
                            </div>
                        </div>
                        <div class="row mb-20">
                            <div class="col-md-5">
                                <h5 style="margin-bottom:0">Nomor Surat</h5>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="nomor_surat" id="nomor_surat" class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary btn-hero" data-dismiss="modal">Batal</button>
                <button class="btn btn-warning btn-hero" id="btn-tagihkan"><i class="fa fa-check"></i> Tagihkan</button>
            </div>
        </div>
    </div>
</div>