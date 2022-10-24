<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">DATA STATUS PASIEN RAWAT INAP YANG DI PERIKSA DI INST. LABORATORIUM</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Bulan : {{$bulan}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th rowspan="3">NO</th>
            <th rowspan="3">RUANGAN</th>
            <th colspan="{{count($kelas)}}">UMUM</th>
            <th colspan="{{count($kelas)+1}}">BPJS</th>
            <th colspan="3">JAMKESDA</th>
            <th rowspan="3">SPM</th>
            <th rowspan="3">KARTU SEHATI</th>
            <th rowspan="3">KEMENKES COVID</th>
            <th rowspan="3">JML</th>
        </tr>
        <tr>
            @foreach($kelas as $item)
            <th rowspan="2">{{$item->nama}}</th>
            @endforeach
            <th colspan="{{count($kelas)}}">JKN NON PBI</th>
            <th rowspan="2">JKN PBI</th>
            <th rowspan="2">P-100</th>
            <th rowspan="2">P-50</th>
            <th rowspan="2">KOTA SBY</th>
        </tr>
        <tr>
            @foreach($kelas as $item)
            <th>{{$item->nama}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @php $row = 8; @endphp
        @foreach($data as $data_item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data_item['lokasi']}}</td>
            @foreach($data_item['asuransi_tunai'] as $data_asuransi)
            <td>{{$data_asuransi}}</td>
            @endforeach
            
            @foreach($data_item['asuransi_bpjs_non_pbi'] as $data_asuransi)
            <td>{{$data_asuransi}}</td>
            @endforeach

            @foreach($data_item['asuransi_bpjs_pbi'] as $data_asuransi)
            <td>{{$data_asuransi}}</td>
            @endforeach

            @foreach($data_item['asuransi_jamkesda_p100'] as $data_asuransi)
            <td>{{$data_asuransi}}</td>
            @endforeach

            @foreach($data_item['asuransi_jamkesda_p50'] as $data_asuransi)
            <td>{{$data_asuransi}}</td>
            @endforeach

            @foreach($data_item['asuransi_jamkesda_sby'] as $data_asuransi)
            <td>{{$data_asuransi}}</td>
            @endforeach
            
            @foreach($data_item['asuransi_spm'] as $data_asuransi)
            <td>{{$data_asuransi}}</td>
            @endforeach
            
            @foreach($data_item['asuransi_kartu_sehati'] as $data_asuransi)
            <td>{{$data_asuransi}}</td>
            @endforeach

            @foreach($data_item['asuransi_kemenkes_covid'] as $data_asuransi)
                <td>{{$data_asuransi}}</td>
            @endforeach
            @php $column = excel_column($count_column-1) @endphp

            <td>=SUM(C{{$row}}:{{$column}}{{$row}})</td>
        </tr>
        @php $row++ @endphp
        @endforeach
        <tr>
            <td></td>
            <td>TOTAL</td>
            @for($i=3;$i<=$count_column;$i++)
            @php
                $column = excel_column($i);
            @endphp
            <td>=SUM({{$column}}8:{{$column}}{{$last_row-1}})</td>
            @endfor
        </tr>
    </tbody>
</table>
