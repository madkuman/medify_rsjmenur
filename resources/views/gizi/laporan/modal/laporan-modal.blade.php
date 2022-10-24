<div class="modal" id="modal-laporan-permintaan-makanan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('gizi/laporan/laporan-permintaan-makanan') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Permintaan Makanan Pasien</h3>
                    </div>
                    <div class="block-content">
                        @include('gizi.laporan.modal.components.form-date-single')
                        @include('gizi.laporan.modal.components.form-select-bangsal')
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel">
                        <i class="fa fa-file-excel-o"></i> Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-surat-pemesanan-makanan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('gizi/laporan/laporan-surat-pemesanan-makanan') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Surat Pemesanan Makanan</h3>
                    </div>
                    <div class="block-content">
                        @include('gizi.laporan.modal.components.form-date-single')
                        @include('gizi.laporan.modal.components.form-select-waktu-makan')
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel">
                        <i class="fa fa-file-excel-o"></i> Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-diet-pasien-bulanan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('gizi/laporan/laporan-diet-pasien-bulanan') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Diet Pasien Bulanan</h3>
                    </div>
                    <div class="block-content">
                        @include('gizi.laporan.modal.components.form-bulan')
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel">
                        <i class="fa fa-file-excel-o"></i> Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-penyerapan-porsi-makanan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('gizi/laporan/laporan-penyerapan-porsi-makanan') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Penyerapan Porsi Makanan Pasien</h3>
                    </div>
                    <div class="block-content">
                        @include('gizi.laporan.modal.components.form-tahun')
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel">
                        <i class="fa fa-file-excel-o"></i> Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-rekap-diet-pelayanan-makanan-pasien" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('gizi/laporan/laporan-rekap-diet-pelayanan-makanan-pasien') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Rekap Diet Pelayanan Makanan Pasien</h3>
                    </div>
                    <div class="block-content">
                        @include('gizi.laporan.modal.components.form-bulan')
                        <div class="form-group">
                            <label for="penyedia">Jenis</label>
                            <select class="form-control js-select2" name="utama" placeholder="Pilih Jenis" style="width: 100%;" required>
                                    <option value="1">Makanan Utama</option>
                                    <option value="0">Makanan Tambahan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel">
                        <i class="fa fa-file-excel-o"></i> Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>