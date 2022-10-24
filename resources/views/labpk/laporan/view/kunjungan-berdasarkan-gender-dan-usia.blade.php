<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="17">Laporan Kunjungan Pasien di Instalasi Laboratorium Berdasarkan Gender dan Usia</th>
        </tr>
        <tr>
            <th colspan="17">Bulan : {{$bulan}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Keterangan</th>
            <th></th>
            @foreach($data as $index => $item)
            @php $date = Carbon\Carbon::createFromFormat('Ym', $index) @endphp
            <th>{{indonesian_date($date,'M')}}</th>
            @endforeach
            <th>Total</th>
            <th>&#x2211;</th>
        </tr>
    </thead>
    <tbody>
        <tr> 
            <td rowspan="2">1</td>
            <td rowspan="2">Jenis Kelamin</td>
            <td>Laki - laki</td>
            @foreach($data as $index => $item)
            <th>{{$item['gender_lk']}}</th>
            @endforeach
            <td>=SUM(D6:O6)</td>
            <td>=P6/P8</td>
        </tr>
        <tr> 
            <td>Perempuan</td>
            @foreach($data as $index => $item)
            <th>{{$item['gender_pr']}}</th>
            @endforeach
            <td>=SUM(D7:O7)</td>
            <td>=P7/P8</td>
        </tr>
        <tr> 
            <td colspan="3">TOTAL</td>
            @foreach($data as $index => $item)
            @php
                $column = excel_column($loop->iteration + 3)
            @endphp
            <td>=SUM({{$column}}6:{{$column}}7)</td>
            @endforeach
            <td>=SUM(D8:O8)</td>
            <td>=P8/P8</td>
        </tr>
        <tr> 
            <td rowspan="2">2</td>
            <td rowspan="2">Usia</td>
            <td>&#x2264; 18</td>
            @foreach($data as $index => $item)
            <th>{{$item['usia_18']}}</th>
            @endforeach
            <td>=SUM(D9:O9)</td>
            <td>=P9/P11</td>
        </tr>
        <tr> 
            <td>&#x3E; 18</td>
            @foreach($data as $index => $item)
            <th>{{$item['usia_19']}}</th>
            @endforeach
            <td>=SUM(D10:O10)</td>
            <td>=P10/P11</td>
        </tr>
        <tr> 
            <td colspan="3">TOTAL</td>
            @foreach($data as $index => $item)
            @php
                $column = excel_column($loop->iteration + 3)
            @endphp
            <td>=SUM({{$column}}9:{{$column}}10)</td>
            @endforeach
            <td>=SUM(D11:O11)</td>
            <td>=P11/P11</td>
        </tr>
    </tbody>
</table>
