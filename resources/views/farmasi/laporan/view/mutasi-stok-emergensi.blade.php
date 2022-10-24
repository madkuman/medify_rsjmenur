<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Mutasi Stok Farmasi</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Periode : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Farmasi : {{$farmasi_names}}</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Kategori : {{$kategori_names}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">NAMA BARANG</th>
            <th rowspan="2">SATUAN</th>
            <th rowspan="2">HARGA SATUAN</th>
            <th colspan="2">STOK AWAL</th>
            <th colspan="2">PEMASUKAN</th>
            <th colspan="2">PENGELUARAN / PEMAKAIAN</th>
            <th colspan="2">STOK AKHIR</th>
        </tr>
        <tr>
            @for($i=0;$i<4;$i++)
            <th>JUMLAH</th>
            <th>NILAI (RP)</th>
            @endfor
        </tr>
        @foreach($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->item_template->nama}}</td>
            <td>{{$item->item_template->satuan}}</td>
            <td>{{$item->harga}}</td>
            <td>{{$item->stok_awal}}</td>
            <td>{{$item->harga * $item->stok_awal}}</td>
            <td>{{$item->stok_masuk}}</td>
            <td>{{$item->harga * $item->stok_masuk}}</td>
            <td>{{$item->stok_keluar}}</td>
            <td>{{$item->harga * $item->stok_keluar}}</td>
            <td>{{$item->stok_akhir}}</td>
            <td>{{$item->harga * $item->stok_akhir}}</td>
            <td></td>
        </tr>
        @endforeach
        <tr>
            <th colspan="3">TOTAL</th>
            @for($i=4;$i<=$count_column;$i++)
            @php $current_column = excel_column($i) @endphp
            <th>=SUM({{$current_column}}9:{{$current_column}}{{$last_row-1}})</th>
            @endfor
        </tr>
    </tbody>
</table>
