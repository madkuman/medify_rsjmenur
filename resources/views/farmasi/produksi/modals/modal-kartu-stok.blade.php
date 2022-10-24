<div class="modal" id="modal-kartu-stok" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/item/'.$item->slug.'/kartu-stok') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-primary" id="btn-simpan">
                        <i class="fa fa-check"></i> Lanjut
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>