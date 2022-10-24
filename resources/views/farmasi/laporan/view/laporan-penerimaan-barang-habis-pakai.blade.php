<table>
    <tr>
        <td colspan="11">BUKU PENERIMAAN BARANG HABIS PAKAI</td>
    </tr>

    <tr>
        <td colspan="11">PERIODE TANGGAL {{strtoupper(indonesian_date(strtotime($date_start)))}} s/d {{strtoupper(indonesian_date(strtotime($date_end)))}}</td>
    </tr>
    <tr>
        <td colspan="11"></td>
    </tr>
    <tr>
        <td rowspan="2">No.</td>
        <td rowspan="2">Tanggal</td>
        <td rowspan="2">Dari / Rekanan</td>
        <td colspan="2">Bukti Penerimaan SP/SPK/Kontrak/Kwitansi</td>
        <td rowspan="2">Uraian Barang</td>
        <td rowspan="2">Satuan</td>
        <td rowspan="2">Jumlah</td>
        <td rowspan="2">Harga Satuan</td>
        <td rowspan="2">Total Harga</td>
        <td rowspan="2">Keterangan</td>
    </tr>
    <tr>
        <td>Nomor</td>
        <td>Tanggal</td>
    </tr>
    @php
        $i=0;
        $total = 0;
    @endphp
    @foreach($data as $pengadaan)
        @php $total += $pengadaan->total_harga @endphp
        @foreach($pengadaan->log as $detail)
            <tr>
                @if($loop->iteration == 1)
                    <td>{{++$i}}</td>
                    <td>{{date('d/m/Y',strtotime($pengadaan->tanggal))}}</td>
                    <td>{{$pengadaan->supplier_detail->nama}}</td>
                    <td>{{$pengadaan->nomor_referensi}}</td>
                    <td>{{date('d/m/Y',strtotime($pengadaan->tanggal_faktur))}}</td>
                @else
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                @endif
                <td>{{$detail->detail_item->item_farmasi->item_template->nama}}</td>
                <td>{{$detail->detail_item->item_farmasi->item_template->satuan}}</td>
                <td>{{$detail->jumlah}}</td>
                <td>{{$detail->harga_saat_itu}}</td>
                <td>{{$detail->subtotal}}</td>
                @if($loop->iteration == 1)
                    <td>{{$pengadaan->keterangan}}</td>
                @else
                    <td></td>
                @endif
            </tr>
            @if($loop->last)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Jumlah</td>
                    <td>{{$pengadaan->total_harga}}</td>
                </tr>
            @endif
        @endforeach
    @endforeach
    <tr>
        <td></td>
    </tr>
    <tr>
        <td colspan="5"></td>
        <td colspan="4">Total</td>
        <td>{{$total}}</td>
    </tr>

</table>