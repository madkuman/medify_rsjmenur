<div class="row">
    <div class="col-12">
        <div class="table-responsive" style="max-height: calc(100vh - 100px);">
        <input type="hidden" name="kategori_resep_tpn[embalase]" class="input-hidden-header-embalase">
        <table class="table table-bordered table-vcenter table-main table-sticky-header" data-last_index="{{ $resep_detail->racikan->count() - 1 }}">
            <thead>
                <tr>
                    <th style="border-bottom: 1px solid">#</th>
                    <th style="border-bottom: 1px solid">Penyiapan Obat</th>
                    <th style="border-bottom: 1px solid" width="150px">Dosis yang dibutuhkan (mL)</th>
                    <th style="border-bottom: 1px solid" width="150px">Jumlah Satuan</th>
                    <th style="border-bottom: 1px solid" width="100px">Kemasan</th>
                    <th style="border-bottom: 1px solid" width="100px">Satuan</th>
                    <th style="border-bottom: 1px solid" width="200px">Harga</th>
                    <th style="border-bottom: 1px solid"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resep_detail_final->racikan as $item)
                    @include('farmasi.transaksi.components.kategori-resep-tpn-container-row', [
                        'index' => $loop->index,
                        'item' => $item,
                        'kemasan' => $resep_detail_final->tpn_kemasan,
                    ])
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8">
                        <button type="button" class="btn btn-primary btn-create-row"><i class="fas fa-plus"></i> Tambah Obat</button>
                    </th>
                </tr>
                <tr class="table-secondary">
                    <th colspan="6" class="text-center">Embalase Jasa Obat Sediaan TPN</th>
                    <th class="header-embalase"></th>
                    <th></th>
                </tr>
                <tr class="table-secondary">
                    <th colspan="6" class="text-center">Harga Total</th>
                    <th class="header-total"></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</div>
