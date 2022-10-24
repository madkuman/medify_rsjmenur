<table>
    <tr>
        <td colspan="17">PEMERINTAH PROVINSI JAWA TIMUR</td>
    </tr>
    <tr>
        <td colspan="17">RUMAH SAKIT JIWA MENUR PROVINSI JAWA TIMUR</td>
    </tr>

    <tr>
        <td colspan="17">INSTALASI GIZI</td>
    </tr>
    <tr>
        <td colspan="17"></td>
    </tr>
    <tr>
        <td colspan="17">LAPORAN BULANAN DIET PASIEN PERIODE {{strtoupper(date('F Y',strtotime($date)))}}</td>
    </tr>
    <tr>
        <td colspan="17"></td>
    </tr>
    <tr>
        <td rowspan="2">NO</td>
        <td rowspan="2">DIET</td>
        @foreach($kelas as $index =>$item)
            <td colspan="2">{{$index}}</td>
        @endforeach
        <td colspan="2">JUMLAH</td>
        <td rowspan="2">TOTAL</td>
    </tr>
    <tr>
        @foreach($kelas as $index =>$item)
            <td>L</td>
            <td>P</td>
        @endforeach
            <td>L</td>
            <td>P</td>
    </tr>
    @php
        $no = 0;
        $row_start = 8;
        $jumlah_total = 0;
    @endphp
    @foreach($data as $index => $item)
        <tr>
            <td>{{++$no}}</td>
            <td>{{$index}}</td>
            @php
            $jumlah_l = 0;
            $jumlah_p = 0;
            @endphp
            @foreach($item as $index => $detail)
                @php
                if($index%2 == 0){
                $jumlah_l += $detail;
                }else{
                $jumlah_p += $detail;
                }
                $jumlah_total +=$detail;
                @endphp
                <td>{{$detail}}</td>
            @endforeach
            <td>{{$jumlah_l}}</td>
            <td>{{$jumlah_p}}</td>
            <td>{{$jumlah_l + $jumlah_p}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="16">JUMLAH PASIEN</td>
        <td>{{$jumlah_total}}</td>
    </tr>
</table>