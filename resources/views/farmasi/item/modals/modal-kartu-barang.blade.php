<div class="modal" id="modal-kartu-barang" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ url('farmasi/'.session('farmasi')->slug.'/item/'.$item->slug.'/kartu-barang') }}" target="_blank">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Kartu Barang</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="">Format</label>
                            <select name="format" class="form-control js-select2" style="width: 100%">
                                <option value="mutasi">Format Mutasi</option>
                                <option value="mutasi_lengkap">Format Mutasi Lengkap</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel">
                        <i class="fa fa-file-excel-o"></i> Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>