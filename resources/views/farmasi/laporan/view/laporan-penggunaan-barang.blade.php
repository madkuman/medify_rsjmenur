<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Laporan Nilai Penggunaan Barang</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Tahun : {{$tahun}}</th>
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
            <th rowspan="2">ITEM</th>
            <th colspan="12">BULAN</th>
            <th rowspan="2">TOTAL</th>
        </tr>
        <tr>
            <th>JAN</th>
            <th>FEB</th>
            <th>MAR</th>
            <th>APR</th>
            <th>MEI</th>
            <th>JUNI</th>
            <th>JULI</th>
            <th>AGUS</th>
            <th>SEPT</th>
            <th>OKT</th>
            <th>NOV</th>
            <th>DES</th>
        </tr>
        @php $row = 9 @endphp
        @foreach($data as $nama => $single_data)
            <tr>
                <td>{{$loop->iteration}}</td>
                @foreach($single_data as $item)
                <td>{{$item}}</td>
                @endforeach
                <td>=SUM(C{{$row}}:N{{$row}})</td>
            </tr>
        @php $row++ @endphp
        @endforeach
        <tr>
            <td colspan="2">TOTAL</td>
            @for($i=3;$i<=15;$i++)
            @php $column = excel_column($i) @endphp
            <td>=SUM({{$column}}9:{{$column}}{{$last_row-1}})</td>
            @php $row++ @endphp
            @endfor
        </tr>
    </tbody>
</table>
