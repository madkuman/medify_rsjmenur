<table>
    <tr>
        <td colspan="12">PEMERINTAH PROVINSI JAWA TIMUR</td>
    </tr>
    <tr>
        <td colspan="12">RUMAH SAKIT JIWA MENUR PROVINSI JAWA TIMUR</td>
    </tr>

    <tr>
        <td colspan="12">INSTALASI GIZI</td>
    </tr>
    <tr>
        <td colspan="12"></td>
    </tr>
    <tr>
        <td colspan="12">REKAP DATA PELAYANAN MAKANAN PASIEN</td>
    </tr>
    <tr>
        <td colspan="12"></td>
    </tr>
    <tr>
        <td colspan="3">Jenis</td>
        <td colspan="3">: Makanan Tambahan</td>
    </tr>
    <tr>
        <td colspan="3">Periode</td>
        <td colspan="3">: {{date('F Y',strtotime($date))}}</td>
    </tr>

    <tr>
        <td colspan="12"></td>
    </tr>
    <tr>
        <td rowspan="2">NO</td>
        @foreach($makanan_tambahan as $item)
            <td colspan="2">{{$item->nama}}</td>
        @endforeach
    </tr>
    <tr>
        @foreach($makanan_tambahan as $item)
            <td>L</td>
            <td>P</td>
        @endforeach
    </tr>
    @php $row = 12; $start = 12;@endphp
    @foreach($data as $index => $item)
        <tr>
            <td>{{$index}}</td>
            @foreach($item as $value)
                <td>{{$value}}</td>
            @endforeach
        </tr>
        @if($loop->last)
            @php $column = 'B'; @endphp
        <tr>
            <td>JML</td>
            @foreach($item as $value)
                <td>=SUM({{$column}}{{$start}}:{{$column}}{{$row}})</td>
                @php $column++ @endphp
            @endforeach
        </tr>
        @endif
        @php $row++ @endphp
    @endforeach
</table>