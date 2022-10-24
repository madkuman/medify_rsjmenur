<div class="modal fade" id="modal_delete_transfusi" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Hapus Transfusi</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <h4>Apakah anda yakin ingin menghapus transfusi ini?</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                <button type="button" id="deleteBtn" class="btn btn-alt-danger" onclick="deleteTransfusi()">
                    <i class="fa fa-check"></i> Ya
                </button>
            </div>
        </div>
    </div>
</div>