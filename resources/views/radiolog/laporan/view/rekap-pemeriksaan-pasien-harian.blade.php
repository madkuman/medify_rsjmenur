
<table>
    <tr>
        <td colspan="7">
            Laporan Rekap Harian
        </td>
    </tr>
    <tr>
        <td colspan="7">
            Periode : {{$tanggal}}
        </td>
    </tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>

    <tr>
        <td>No</td>
        <td>Pemeriksaan</td>
        <td>Rawat Jalan</td>
        <td>IGD</td>
        <td>Rawat Inap</td>
        <td>Medical Checkup</td>
        <td>Total</td>
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
        @for($i=3;$i<=7;$i++)
            @php $column = excel_column($i) @endphp
            @php $total_row = count($data) + 6 @endphp
            <td>=SUM({{$column}}7:{{$column}}{{$total_row}})</td>
        @endfor
    </tr>

</table>