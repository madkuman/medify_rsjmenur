<table border="1">
    <tr>
        <td colspan="{{ $full_colspan }}">{{strtoupper(config('app.name'))}}</td>
    </tr>
    <tr>
        <td colspan="{{ $full_colspan }}">KARTU BARANG</td>
    </tr>
    <tr>
        <td colspan="{{ $full_colspan }}">{{strtoupper(session('farmasi')->nama)}}</td>
    </tr>
    <tr>
        <td colspan="{{ $full_colspan }}"></td>
    </tr>
    <tr>
        <td>Nama Barang</td>
        <td colspan="{{ $full_colspan - 1}}">: {{$item->item_detail->nama}}</td>
    </tr>
    <tr>
        <td>Satuan</td>
        <td colspan="{{ $full_colspan - 1}}">: {{$item->item_detail->satuan}}</td>
    </tr>
    <tr>
        <td class="{{ $full_colspan }}"></td>
    </tr>
    <tr>
        <td rowspan="2">TANGGAL</td>
        <td rowspan="2">NAMA/RM</td>
        <td rowspan="2">MASUK</td>
        <td colspan="3">PENGELUARAN</td>
        <td rowspan="2">PENGEMBALIAN</td>
        <td rowspan="2">STOK UNIT</td>
        <td rowspan="2">SISA</td>
        @if ($is_format_detail)
            <td rowspan="2">EXPIRED DATE</td>
            <td rowspan="2">NO BATCH</td>
            <td rowspan="2">HARGA UNIT</td>
            <td rowspan="2">TOTAL</td>
            <td rowspan="2">TOTAL HARGA</td>
            <td rowspan="2">KET.</td>
        @endif
    </tr>
    <tr>
        <td>KELUAR</td>
        <td>RETUR</td>
        <td>PEMAKAIAN</td>
    </tr>
    @php
        $excel_first_row = 10;
        $excel_row = $excel_first_row;
        $stok_sisa = 0;
    @endphp
    @foreach ($list_stok_awal->where('stok_awal', '!=', 0) as $item)
        <tr>
            <td></td>
            @if ($loop->first)
                <td rowspan="{{ $loop->count }}">Stok Awal</td>
            @endif
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{round($item->stok_awal,1)}}</td>
            @if ($loop->first)
                @php
                    $stok_sisa += $list_stok_awal->sum('stok_awal');
                @endphp
                <td rowspan="{{ $loop->count }}">{{ $stok_sisa }}</td>
            @endif
            @if ($is_format_detail)
                <td>{{ !empty($item->kadaluarsa) ? date('Y-m-d', strtotime($item->kadaluarsa)) : '' }}</td>
                <td>{{ $item->log_pengadaan->batch }}</td>
                <td>{{ $item->harga }}</td>
                <td>{{ "=H".$excel_row."*L".$excel_row }}</td>
                @if ($loop->first)
                    <td rowspan="{{ $loop->count }}">{{ "=SUM(M".$excel_row.":M".($excel_row + ($loop->count - 1)).")" }}</td>
                @endif
                <td></td>
            @endif
        </tr>
        @php
            $excel_row ++;
        @endphp
    @endforeach
    @php $i=1;$masuk=0;$keluar=0;$total=$stok_awal @endphp
    @foreach($riwayat_group as $riwayat)
        @php
            $riwayat = collect($riwayat);
        @endphp
        @foreach ($riwayat as $row)
            <tr>
                @if ($loop->first)
                <td rowspan="{{ $loop->count }}">{{ date('d-m-y', strtotime($row->created_at))}}</td>
                <td rowspan="{{ $loop->count }}">@if($row->nomor_rm != 0) {{$row->nama}} / {{$row->nomor_rm}} @endif</td>
                @endif
                <td>
                    @if ($row->jumlah_plus > 0 && $row->tabel != 'log_transaksi' && $row->is_distribusi_retur == 0)
                        {{round($row->jumlah_plus,1)}}
                    @else
                        0
                    @endif
                </td>
                <td>
                    @if ($row->jumlah_min > 0 && $row->tabel == 'log_transaksi')
                        {{round($row->jumlah_min,1)}}
                    @else
                        0
                    @endif
                </td>
                <td>
                    @if ($row->jumlah_plus > 0 && $row->tabel == 'log_transaksi')
                        {{round($row->jumlah_plus,1)}}
                    @else
                        0
                    @endif
                </td>
                <td>{{ "=D".$excel_row."-E".$excel_row }}</td>
                <td>
                    @if ($row->jumlah_plus > 0 && $row->tabel != 'log_transaksi' && $row->is_distribusi_retur == 1)
                        {{round($row->jumlah_plus,1)}}
                    @else
                        0
                    @endif
                </td>
                @php
                    $sisa_per_items = $list_stok_awal[$row->item_id]->stok_awal + ($row->jumlah_plus - $row->jumlah_min);
                    $list_stok_awal[$row->item_id]->stok_awal = $sisa_per_items;
                @endphp
                <td>{{round($sisa_per_items,1)}}</td>
                @if ($loop->first)
                    @php
                        $stok_sisa += ($riwayat->sum('jumlah_plus') - $riwayat->sum('jumlah_min'));
                    @endphp
                    <td rowspan="{{ $loop->count }}">{{ $stok_sisa }}</td>
                @endif

                @if ($is_format_detail)
                    <td>{{ !empty($row->items->kadaluarsa) ? date('Y-m-d', strtotime($row->items->kadaluarsa)) : '' }}</td>
                    <td>{{ $row->items->log_pengadaan->batch }}</td>
                    <td>{{ $row->items->harga ?? $row->items->log_pengadaan->harga_saat_itu ?? 0 }}</td>
                    <td>{{ "=H".$excel_row."*L".$excel_row }}</td>
                    @if ($loop->first)
                        <td rowspan="{{ $loop->count }}">{{ "=SUM(M".$excel_row.":M".($excel_row + ($loop->count - 1)).")" }}</td>
                    @endif
                    <td>@if($row->nomor_rm == 0) {{$row->nama}} @endif</td>
                @endif
            </tr>

            @php
                $excel_row ++;
            @endphp
        @endforeach
    @endforeach
    @php
        $excel_last_row = $excel_row - 1;
    @endphp
    <tr>
        <td colspan="2">Total</td>
        <td>{{ "=SUM(C$excel_first_row:C$excel_last_row)"}}</td>
        <td>{{ "=SUM(D$excel_first_row:D$excel_last_row)"}}</td>
        <td>{{ "=SUM(E$excel_first_row:E$excel_last_row)"}}</td>
        <td>{{ "=SUM(F$excel_first_row:F$excel_last_row)"}}</td>
        <td>{{ "=SUM(G$excel_first_row:G$excel_last_row)"}}</td>
        <td></td>
        <td></td>
        @if ($is_format_detail)
            <td></td>
            <td></td>
            <td></td>
            <td>{{ "=SUM(M$excel_first_row:M$excel_last_row)"}}</td>
            <td>{{ "=SUM(N$excel_first_row:N$excel_last_row)"}}</td>
            <td></td>
        @endif
    </tr>
</table>