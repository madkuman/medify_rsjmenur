<div class="modal" id="modal-laporan-usulan-final" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('e-usulan/laporan/laporan-usulan-final') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Usulan Final</h3>
                    </div>
                    <div class="block-content">
                        @include('eusulan.laporan.components.form.tahun')
                        @include('eusulan.laporan.components.form.unit-multiple')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-usulan-rekap" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('e-usulan/laporan/laporan-usulan-rekap') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Usulan Akun Rekening</h3>
                    </div>
                    <div class="block-content">
                        @include('eusulan.laporan.components.form.tahun')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>