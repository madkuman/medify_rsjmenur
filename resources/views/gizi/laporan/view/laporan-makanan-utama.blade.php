<table>
    <tr>
        <td colspan="34">PEMERINTAH PROVINSI JAWA TIMUR</td>
    </tr>
    <tr>
        <td colspan="34">RUMAH SAKIT JIWA MENUR PROVINSI JAWA TIMUR</td>
    </tr>

    <tr>
        <td colspan="34">INSTALASI GIZI</td>
    </tr>
    <tr>
        <td colspan="34"></td>
    </tr>
    <tr>
        <td colspan="34">REKAP DATA PELAYANAN MAKANAN PASIEN</td>
    </tr>
    <tr>
        <td colspan="34"></td>
    </tr>
    <tr>
        <td colspan="3">Jenis</td>
        <td colspan="3">: Makanan Utama</td>
    </tr>
    <tr>
        <td colspan="3">Periode</td>
        <td colspan="3">: {{date('F Y',strtotime($date))}}</td>
    </tr>

    <tr>
        <td colspan="34"></td>
    </tr>
    <tr>
        <td rowspan="3">NO</td>
        @foreach($kelas as $index => $item)
        <td colspan="4">{{$index}}</td>
        @endforeach
        <td colspan="8">JUMLAH</td>
        <td rowspan="3">TOTAL</td>
    </tr>
    <tr>
        @foreach($kelas as $index => $item)
        <td colspan="2">DIET</td>
        <td colspan="2">NON DIET</td>
        @endforeach
            <td colspan="2">DIET</td>
            <td colspan="2">NON DIET</td>
            <td rowspan="2">D</td>
            <td rowspan="2">ND</td>
            <td rowspan="2">L</td>
            <td rowspan="2">P</td>
    </tr>
    <tr>
        @foreach($kelas as $index => $item)
        <td>L</td>
        <td>P</td>
        @endforeach
            @foreach($kelas as $index => $item)
                <td>L</td>
                <td>P</td>
            @endforeach
            <td>L</td>
            <td>P</td>
            <td>L</td>
            <td>P</td>
    </tr>
    @php $row = 13; $start = 13;@endphp
    @foreach($data as $index => $item)
        <tr>
            <td>{{$index}}</td>
            @foreach($item as $value)
                <td>{{$value}}</td>
            @endforeach
            <td>=B{{$row}}+F{{$row}}+J{{$row}}+N{{$row}}+R{{$row}}+V{{$row}}</td>
            <td>=C{{$row}}+G{{$row}}+K{{$row}}+O{{$row}}+S{{$row}}+W{{$row}}</td>
            <td>=D{{$row}}+H{{$row}}+L{{$row}}+P{{$row}}+T{{$row}}+X{{$row}}</td>
            <td>=E{{$row}}+I{{$row}}+M{{$row}}+Q{{$row}}+U{{$row}}+Y{{$row}}</td>
            <td>=Z{{$row}}+AA{{$row}}</td>
            <td>=AB{{$row}}+AC{{$row}}</td>
            <td>=Z{{$row}}+AB{{$row}}</td>
            <td>=AA{{$row}}+AC{{$row}}</td>
            <td>=AF{{$row}}+AG{{$row}}</td>
        </tr>
        @if($loop->last)
            <tr>
                <td>JML</td>
                @php $column = 'B' @endphp
                @foreach($item as $value)
                    <td>=SUM({{$column}}{{$start}}:{{$column}}{{$row}})</td>
                    @php $column++ @endphp
                @endforeach
                @for($i=0;$i<9;$i++)
                    @if($i == 8)
                        <td rowspan="4">=SUM({{$column}}{{$start}}:{{$column}}{{$row}})</td>
                    @else
                    <td>=SUM({{$column}}{{$start}}:{{$column}}{{$row}})</td>
                    @endif
                    @php $column++ @endphp
                @endfor
            </tr>
            <tr>
                <td>D/N</td>
                @php $column1 = 'B'; $column2 ='C'@endphp
                @for($i=0;$i<count($item)/2;$i++)
                    <td colspan="2">={{$column1}}{{$row+1}}+{{$column2}}{{$row+1}}</td>
                    @php $column1++; $column2++; $column1++; $column2++;@endphp
                @endfor
                        <td colspan="2">=AD{{$row+1}}</td>
                        <td colspan="2">=AE{{$row+1}}</td>
                <td rowspan="3" colspan="2">=AD{{$row+1}}+AE{{$row+1}}</td>
                <td rowspan="3" colspan="2">=AD{{$row+1}}+AE{{$row+1}}</td>
            </tr>
            <tr>
                <td>L/P</td>
                @php $column1 = 'B'; $column2 ='D';$column3 = 'C'; $column4 ='E'; @endphp
                @for($i=0;$i<count($item)/4;$i++)
                    <td colspan="2">={{$column1}}{{$row+1}}+{{$column2}}{{$row+1}}</td>
                    <td colspan="2">={{$column3}}{{$row+1}}+{{$column4}}{{$row+1}}</td>
                    @php $column1++; $column2++; $column3++; $column4++;@endphp
                    @php $column1++; $column2++; $column3++; $column4++;@endphp
                    @php $column1++; $column2++; $column3++; $column4++;@endphp
                    @php $column1++; $column2++; $column3++; $column4++;@endphp
                @endfor
                <td colspan="2">=AF{{$row+1}}</td>
                <td colspan="2">=AG{{$row+1}}</td>
            </tr>
            <tr>
                <td>TTL</td>
                @php $column1 = 'B'; $column2 = 'C'; $column3 = 'D'; $column4 = 'E'; @endphp
                @for($i=0;$i<count($item)/4;$i++)
                    <td colspan="4">={{$column1}}{{$row+1}}+{{$column2}}{{$row+1}}+{{$column3}}{{$row+1}}+{{$column4}}{{$row+1}}</td>
                    @php $column1++; $column2++; $column3++; $column4++;@endphp
                    @php $column1++; $column2++; $column3++; $column4++;@endphp
                    @php $column1++; $column2++; $column3++; $column4++;@endphp
                    @php $column1++; $column2++; $column3++; $column4++;@endphp
                @endfor
                <td colspan="4">=AD{{$row+1}}+AE{{$row+1}}</td>
            </tr>
        @endif
        @php $row++@endphp
    @endforeach
</table>