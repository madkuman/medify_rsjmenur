<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Detail Surat Kontrol</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="text-center" id="loaderDetail">
                        <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader" style=""></span>
                    </div>
                    <div id="modal-detail-content">
                        @include('bpjs.rujuk-balik.components.result')
                    </div>
                    <div id="modal-detail-message">
                        <div class="alert alert-danger"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>