
<table>
    <tr>
        <td colspan="{{$total_tanggal+3}}">
            Laporan Rekap Bulanan
        </td>
    </tr>
    <tr>
        <td colspan="{{$total_tanggal+3}}">
            Periode : {{$bulan}}
        </td>
    </tr>
    <tr>
        <td colspan="{{$total_tanggal+3}}">
            Layanan : {{$layanan}}
        </td>
    </tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>

    <tr>
        <td rowspan="2">No</td>
        <td rowspan="2">Pelayanan</td>
        <td colspan="{{$total_tanggal}}">Tanggal</td>
        <td rowspan="2">Jumlah</td>
    </tr>
    <tr>
        @for($i=1;$i<=$total_tanggal;$i++)
        <td>
            {{$i}}
        </td>
        @endfor
    </tr>
    @foreach($data as $tarif_kategori)
    <tr>
        <td>{{$loop->iteration}}</td>
        @foreach($tarif_kategori as $item)
        <td>{{$item}}</td>
        @endforeach
    </tr>
    @endforeach

    <tr>
        <td colspan="2">Total</td>
        @for($i=3;$i<=$total_tanggal+3;$i++)
            @php $column = excel_column($i) @endphp
            @php $total_row = count($data) + 8 @endphp
            <td>=SUM({{$column}}9:{{$column}}{{$total_row}})</td>
        @endfor
    </tr>

</table>