<div class="modal fade" id="modalCancelConfirmation" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Simpan Perubahan</h3>
                    <form action="{{url($link.'/transaksi/cancel')}}/{{$transaksi->slug}}" id="cancelForm" method="POST">
                            {{csrf_field()}}
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <h4>Mohon masukkan alasan pembatalan Transaksi</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="alasan_batal" placeholder="Mohon masukkan alasan disini" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check"></i> Simpan
                </button>
                </form>
            </div>
        </div>
    </div>
</div>