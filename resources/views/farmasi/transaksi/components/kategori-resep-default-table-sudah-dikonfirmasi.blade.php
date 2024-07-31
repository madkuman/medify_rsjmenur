<div class="table-responsive" style="max-height: calc(100vh - 100px);">
    <table class="table table-bordered table-vcenter table-main table-sticky-header" style="font-size: 13px !important;"
        data-last_index="{{ $transaksi->ori_detail->resep_detail->count() - 1 }}">
        <thead>
            <tr>
                <th rowspan="3" style="border-bottom: 1px solid">No</th>
                <th colspan="2">Barang</th>
                <th colspan="2">Jumlah</th>
                <th colspan="7">Aturan Pakai</th>
                <th rowspan="3" style="border-bottom: 1px solid; background-color: #CAEDFF">Petunjuk Minum</th>
                <th rowspan="3" style="border-bottom: 1px solid; background-color: #CAEDFF">Catatan</th>
                <th rowspan="3" style="border-bottom: 1px solid">Harga Jual</th>
                <th rowspan="3" style="border-bottom: 1px solid">Subtotal</th>
            </tr>
            <tr>
                <th rowspan="2" style="border-bottom: 1px solid">Resep</th>
                <th rowspan="2" style="border-bottom: 1px solid; background-color: #CAEDFF">Dilayani</th>
                <th rowspan="2" style="border-bottom: 1px solid">Resep</th>
                <th rowspan="2" style="border-bottom: 1px solid; background-color: #CAEDFF">Dilayani</th>
                <th rowspan="2" style="border-bottom: 1px solid">Resep</th>
                <th rowspan="2" style="border-bottom: 1px solid; background-color: #CAEDFF">Dilayani</th>
                <th colspan="5" style="background-color: #CAEDFF">Dilayani</th>
            </tr>
            <tr>
                <th width="75px" style="border-bottom: 1px solid; background-color: #CAEDFF"><b>(07)</b></th>
                <th width="75px" style="border-bottom: 1px solid; background-color: #CAEDFF"><b>(13)</b></th>
                <th width="75px" style="border-bottom: 1px solid; background-color: #CAEDFF"><b>(19)</b></th>
                <th width="75px" style="border-bottom: 1px solid; background-color: #CAEDFF"><b>(24)</b></th>
                <th width="75px" style="border-bottom: 1px solid; background-color: #CAEDFF"><b>(22)</b></th>
            </tr>
        </thead>
        <tbody class="scroll-table">
            @php
                $list_resep_detail = $transaksi->ori_detail->resep_detail;
                # sometimes ori gk punya detail, aneh gaming
                if ($list_resep_detail->count() == 0) {
                    if (isset($transaksi->final_detail)) {
                        $list_resep_detail = $transaksi->final_detail->resep_detail;
                    }
                }
            @endphp
            @foreach ($list_resep_detail as $key => $item)
                @include('farmasi.transaksi.components.kategori-resep-default-table-sudah-dikonfirmasi-row', [
                    'index' => $loop->index,
                    'item' => $item,
                    'item_final' => $transaksi->final_detail->resep_detail[$key] ?? null,
                ])
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-secondary">
                <th colspan="14"></th>
                <th class="text-right">Subtotal</th>
                <th>{{ formatCurrency($transaksi->final_detail->resep_detail->sum('subtotal'), '') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
