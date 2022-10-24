<div class="modal" id="modal-bpjs" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-full">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Data BPJS Pasien</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="py-10 text-center font-w600 bg-danger text-white mb-20 align-middle" id="dialog_error" style="display: none;">
                                <i class="fa fa-exclamation-circle mr-5"></i>
                                <br>
                                <span></span>
                            </div>
                        </div>
                        <div class="col-6">
                            @include('pasien.pendaftaran.content.bpjs_form')
                        </div>
                        <div class="col-6">
                            @include('pasien.pendaftaran.content.bpjs_info')
                        </div>
                    </div>
                    <button class="btn btn-success btn-hero pull-right my-20" type="button" id="saveBPJS"<i class="fa fa-check"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>