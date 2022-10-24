<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="8">LAPORAN SISA STOK</th>
        </tr>
        <tr>
            <th colspan="8">Per Tanggal : {{indonesian_date($date,'d F Y')}}</th>
        </tr>
        <tr>
            <th colspan="8">Farmasi : {{$farmasi_names}}</th>
        </tr>
        <tr>
            <th colspan="8">Kategori : {{$kategori_names}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>NO</th>
            <th>NAMA ITEM</th>
            <th>KADALUARSA</th>
            <th>SATUAN</th>
            <th>JUMLAH</th>
            <th>HARGA SATUAN</th>
            <th>HARGA TOTAL</th>
            <th>HARGA TOTAL ITEM</th>
            <th>KETERANGAN</th>
        </tr>
        @php $last_item = '' @endphp
        @php $total_data = count($data) @endphp
        @php $row_span = 0 @endphp
        @php $row = 8 @endphp
        @foreach($data as $index => $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->nama}}</td>
            <td>{{date('d/m/Y',strtotime($item->kadaluarsa))}}</td>
            <td>{{$item->satuan}}</td>
            <td>{{$item->stok_akhir}}</td>
            <td>{{$item->harga}}</td>
            <td>{{$item->harga * $item->stok_akhir}}</td>
            @if($last_item != $item->nama)
                @php $last_item = $item->nama @endphp
                @php $row_span = 1 @endphp
                @for($i=$index+1;$i<$total_data;$i++)
                    @if($data[$i]->nama == $last_item)
                        @php $row_span++ @endphp
                    @else
                        @php break; @endphp
                    @endif   
                @endfor
                <td rowspan="{{$row_span}}">=SUM(G{{$row}}:G{{$row+$row_span - 1}})</td>
            @else
            @endif
            <td></td>
        </tr>
        @php $row++ @endphp
        @endforeach
        <tr>
            <th colspan="5">TOTAL</th>
            <th>=SUM(F8:F{{$last_row-1}})</th>
        </tr>
    </tbody>
</table>
