@php
    $kolom_sigma = excel_column(4 + count($data));
    $kolom_total = excel_column(3 + count($data));
@endphp
<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="17">Laporan Kunjungan Pasien di Instalasi Laboratorium Berdasarkan Gender dan Usia</th>
        </tr>
        <tr>
            <th colspan="17">{{ $periode_string }}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Keterangan</th>
            <th></th>
            @foreach($data as $index => $item)
            <th>{{ $item['header'] }}</th>
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
            <td>=SUM(D6:{{ $kolom_total }}6)</td>
            <td>={{ $kolom_sigma }}6/{{ $kolom_sigma }}8</td>
        </tr>
        <tr> 
            <td>Perempuan</td>
            @foreach($data as $index => $item)
            <th>{{$item['gender_pr']}}</th>
            @endforeach
            <td>=SUM(D7:{{ $kolom_total }}7)</td>
            <td>={{ $kolom_sigma }}7/{{ $kolom_sigma }}8</td>
        </tr>
        <tr> 
            <td colspan="3">TOTAL</td>
            @foreach($data as $index => $item)
            @php
                $column = excel_column($loop->iteration + 3)
            @endphp
            <td>=SUM({{$column}}6:{{$column}}7)</td>
            @endforeach
            <td>=SUM(D8:{{ $kolom_total }}8)</td>
            <td>={{ $kolom_sigma }}8/{{ $kolom_sigma }}8</td>
        </tr>
        <tr> 
            <td rowspan="2">2</td>
            <td rowspan="2">Usia</td>
            <td>&#x2264; 18</td>
            @foreach($data as $index => $item)
            <th>{{$item['usia_18']}}</th>
            @endforeach
            <td>=SUM(D9:{{ $kolom_total }}9)</td>
            <td>={{ $kolom_sigma }}9/{{ $kolom_sigma }}11</td>
        </tr>
        <tr> 
            <td>&#x3E; 18</td>
            @foreach($data as $index => $item)
            <th>{{$item['usia_19']}}</th>
            @endforeach
            <td>=SUM(D10:{{ $kolom_total }}10)</td>
            <td>={{ $kolom_sigma }}10/{{ $kolom_sigma }}11</td>
        </tr>
        <tr> 
            <td colspan="3">TOTAL</td>
            @foreach($data as $index => $item)
            @php
                $column = excel_column($loop->iteration + 3)
            @endphp
            <td>=SUM({{$column}}9:{{$column}}10)</td>
            @endforeach
            <td>=SUM(D11:{{ $kolom_total }}11)</td>
            <td>={{ $kolom_sigma }}11/{{ $kolom_sigma }}11</td>
        </tr>
    </tbody>
</table>
