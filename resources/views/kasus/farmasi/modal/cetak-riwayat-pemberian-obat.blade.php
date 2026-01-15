<div class="modal" id="modal-cetak-riwayat-pemberian-obat" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ url()->current(). '/cetak-riwayat-pemberian-obat'}}" target="_blank" class="form-unbind">
                {{ csrf_field() }}
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Cetak Riwayat Pemberian Obat</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL</label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal" placeholder="Tanggal" autocomplete="off" data-date-format="dd/mm/yyyy">
                        </div>
                        <div class="form-group">
                            <label class="css-control css-control-lg css-control-primary css-radio">
                                <input type="radio" class="css-control-input" name="format" value="dengan_telaah_obat" checked> <span class="css-control-indicator"></span> dengan telaah obat
                            </label>
                            <label class="css-control css-control-lg css-control-primary css-radio">
                                <input type="radio" class="css-control-input" name="format" value="tanpa_telaah_obat"> <span class="css-control-indicator"></span> tanpa telaah obat
                            </label>
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