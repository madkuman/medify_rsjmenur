<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">REKAP PENGGUNAAN BARANG</th>
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
            <th>NO</th>
            <th>NAMA BARANG</th>
            @foreach($farmasi as $item)
            <th>{{$item->nama}}</th>
            @endforeach
            <th>STOK</th>
            <th>HARGA SATUAN</th>
            <th>TOTAL</th>
            <th>TOTAL PER ITEM</th>
        </tr>

        @php $last_item = '' @endphp
        @php $total_data = count($data) @endphp
        @php $row_span = 0 @endphp
        @php $row = 8 @endphp
        @foreach($data as $index => $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item['obat']}}</td>
            @foreach($farmasi as $farmasi_row)
            <th>{{$item['farmasi-'.$farmasi_row->id]}}</th>
            @endforeach
            <td>=SUM(C{{$row}}:{{excel_column($count_column-4)}}{{$row}})</td>
            <td>{{$item['harga']}}</td>
            <td>={{excel_column($count_column-3)}}{{$row}}*{{excel_column($count_column-2)}}{{$row}}</td>
            
            @if($last_item != $item['obat'])
                @php $last_item = $item['obat'] @endphp
                @php $row_span = 1 @endphp
                @for($i=$index+1;$i<$total_data;$i++)
                    @if($data[$i]['obat'] == $last_item)
                        @php $row_span++ @endphp
                    @else
                        @php break; @endphp
                    @endif   
                @endfor
                @php $column = excel_column($count_column-1) @endphp
                <td rowspan="{{$row_span}}">=SUM({{$column}}{{$row}}:{{$column}}{{$row+$row_span - 1}})</td>
            @else
            @endif

        </tr>
        @php $row++ @endphp
        @endforeach
        <tr>
            <th colspan="{{$count_column-4}}">TOTAL</th>
            <th>=SUM({{excel_column($count_column-3)}}8:{{excel_column($count_column-3)}}{{$last_row-1}})</th>
            <th></th>
            <th></th>
            <th>=SUM({{excel_column($count_column)}}8:{{excel_column($count_column)}}{{$last_row-1}})</th>
        </tr>
    </tbody>
</table>
