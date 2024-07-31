<div class="row">
    <div class="col-12">
        <div class="table-responsive" style="max-height: calc(100vh - 100px);">
        <table class="table table-bordered table-vcenter table-sticky-header">
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
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_obat }}</td>
                        <td>{{ $item->dosis }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $resep_detail->tpn_kemasan }}</td>
                        <td>{{ $item->obat_detail->item_detail->satuan }}</td>
                        <td>{{ formatCurrency($item->subtotal) }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-secondary">
                    <th colspan="6" class="text-center">Embalase Jasa Obat Sediaan TPN</th>
                    <th class="header-embalase">{{ formatCurrency($resep_detail_final->embalase ?? 0) }}</th>
                    <th></th>
                </tr>
                <tr class="table-secondary">
                    <th colspan="6" class="text-center">Harga Total</th>
                    <th class="header-total">{{ formatCurrency($resep_detail_final->subtotal ?? 0) }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</div>