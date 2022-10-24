<table>
    <tr>
        <td colspan="18">PEMERINTAH PROVINSI JAWA TIMUR</td>
    </tr>
    <tr>
        <td colspan="18">RUMAH SAKIT JIWA MENUR PROVINSI JAWA TIMUR</td>
    </tr>

    <tr>
        <td colspan="18">INSTALASI GIZI</td>
    </tr>
    <tr>
        <td colspan="18"></td>
    </tr>
    <tr>
        <td colspan="18">PENYERAPAN PORSI MAKANAN PASIEN TAHUN {{$tahun}} DPA {{$tahun}}</td>
    </tr>
    <tr>
        <td colspan="18"></td>
    </tr>
    <tr>
        <td>NO</td>
        <td>RINCIAN</td>
        <td>SATUAN</td>
        <td>DPA {{$tahun}}</td>
        <td>JAN</td>
        <td>FEB</td>
        <td>MAR</td>
        <td>APR</td>
        <td>MEI</td>
        <td>JUN</td>
        <td>JUL</td>
        <td>AGT</td>
        <td>SEP</td>
        <td>OKT</td>
        <td>NOV</td>
        <td>DES</td>
        <td>TOTAL</td>
        <td>SISA</td>
    </tr>
    @php
        $no = 0;
        $row = 8;
    @endphp
    @foreach($data as $index => $item)
        <tr>
            <td>{{++$no}}</td>
            <td>{{$item->nama}}</td>
            <td>{{$item->satuan}}</td>
            <td>{{$item->anggaran}}</td>
            @foreach($item->bulan as $bulan)
                <td>{{$bulan}}</td>
            @endforeach
            <td>=SUM(E{{$row}}:P{{$row}})</td>
            <td>=D{{$row}}-Q{{$row}}</td>
            @php $row++ @endphp
        </tr>
    @endforeach
    <tr>
        <td>
    </tr>
    <tr>
        <td>NO</td>
        <td>RINCIAN</td>
        <td>SATUAN</td>
        <td>DPA {{$tahun}}</td>
        <td>JAN</td>
        <td>FEB</td>
        <td>MAR</td>
        <td>APR</td>
        <td>MEI</td>
        <td>JUN</td>
        <td>JUL</td>
        <td>AGT</td>
        <td>SEP</td>
        <td>OKT</td>
        <td>NOV</td>
        <td>DES</td>
        <td>TOTAL</td>
        <td>SISA</td>
    </tr>
    @php
        $no = 0;
        $row+=2;
    @endphp
    @foreach($data as $index => $item)
        <tr>
            <td>{{++$no}}</td>
            <td>{{$item->nama}}</td>
            <td>{{$item->satuan}}</td>
            <td>{{$item->anggaran == 0 ? '0' : '1'}}</td>
            @foreach($item->bulan as $bulan)
                @if($item->anggaran == 0)
                    <td>0</td>
                @else
                    <td>{{number_format($bulan / $item->anggaran,2 )}}</td>
                @endif
            @endforeach
            <td>=SUM(E{{$row}}:P{{$row}})</td>
            <td>=D{{$row}}-Q{{$row}}</td>
            @php $row++ @endphp
        </tr>
    @endforeach
</table>