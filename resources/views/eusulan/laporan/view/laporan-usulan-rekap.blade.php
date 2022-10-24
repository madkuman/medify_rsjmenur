<table>
    <tr>
        <td colspan="9">USULAN MURNI TAHUN {{$tahun}}</td>
    </tr>

    <tr>
        <td colspan="9">REKAP SEMUA UNIT</td>
    </tr>
    <tr>
        <td colspan="9"></td>
    </tr>
    <tr>
        <td colspan="9"></td>
    </tr>
    <tr>
        <td>No</td>
        <td>Jenis Barang/Kegiatan</td>
        <td>Unit</td>
        <td>Link Produk</td>
        <td>Satuan</td>
        <td>Jumlah</td>
        <td>Harga Satuan</td>
        <td>Total</td>
    </tr>
    @php
        $i=0;
        $total_all = 0;
    @endphp
    @foreach($akun_rekening as $item)
        @php
            $item = $item[0];
            $total_all+=$item->total;
        @endphp
        <tr>
            <td>{{$item->akun_rekening->kode}}</td>
            <td>{{$item->akun_rekening->nama}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$item->total}}</td>
        </tr>
        @foreach($log_usulan[$item->akun_rekening_id] ?? [] as $barangs)
            <tr>
                <td rowspan="{{count($barangs) + 1}}">{{++$i}}</td>
                <td rowspan="{{count($barangs) + 1}}">{{$barangs[0]->barang->nama ?? ''}}</td>
            @php
            $subtotal_jumlah = 0;
            $subtotal=0;
            @endphp
            @foreach($barangs ?? [] as $row)
                @php
                    $subtotal_jumlah += $row->jumlah;
                    $subtotal += ($row->jumlah * $row->harga)
                @endphp
                @if($loop->iteration > 1)
                    <tr>
                        @endif
                        <td>{{$row->usulan->unit->nama ?? ''}}</td>
                        <td>{{$row->link}}</td>
                        <td>{{$row->satuan}}</td>
                        <td>{{$row->jumlah}}</td>
                        <td>{{$row->harga}}</td>
                        <td>{{$row->jumlah * $row->harga}}</td>
                        @if($loop->last)
                        <tr>
                            <td>TOTAL</td>
                            <td></td>
                            <td></td>
                            <td>{{$subtotal_jumlah}}</td>
                            <td></td>
                            <td>{{$subtotal}}</td>
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                    @endforeach
                    @if($total_all > 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>TOTAL</td>
                            <td>{{$total_all}}</td>
                        </tr>
                    @endif
</table>