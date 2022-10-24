<div class="modal fade" id="modal-top" tabindex="-1" role="dialog" aria-labelledby="modal-top" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Konfirmasi Ulang</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <h3>Apakah Anda Yakin ?</h3>
                    <div class="ditagih" style="display: none;">
                        <h5>Layanan berikut akan ditambahkan dalam tagihan :</h5>
                        <table class="table table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 50%">Nama</th>
                                    <th style="width: 20%">Harga</th>
                                    <th style="width: 5%">Qty</th>
                                    <th style="width: 25%" class="text-center">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="list-harga" style="font-size: 16px">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-alt-success" onclick="proceed()">
                    <i class="fa fa-check"></i> Ya
                </button>
            </div>
        </div>
    </div>
</div>