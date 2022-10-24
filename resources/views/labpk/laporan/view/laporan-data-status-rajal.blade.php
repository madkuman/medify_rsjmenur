<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">DATA STATUS PASIEN RAWAT JALAN YANG DI PERIKSA DI INST. LABORATORIUM</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Bulan : {{$bulan}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">RUANGAN</th>
            <th colspan="{{count($kelas)+1}}">UMUM</th>
            <th colspan="2">BPJS</th>
            <th colspan="3">JAMKESDA</th>
            <th rowspan="2">SPM</th>
            <th rowspan="2">JML</th>
        </tr>
        <tr>
            <th>SK Direktur</th>
            @foreach($kelas as $item)
            <th>{{$item->nama}}</th>
            @endforeach
            <th>JKN NON PBI</th>
            <th>JKN PBI</th>
            <th>P-100</th>
            <th>P-50</th>
            <th>KOTA SBY</th>
        </tr>
    </thead>
    <tbody>
        @php $row = 7; @endphp
        @php $count_no = 1 @endphp
        @php $row_total_rajal = $row-1 @endphp
        @foreach($data as $index_layanan_data => $data_layanan_item)
            @foreach($data_layanan_item as $data_item)
            <tr>
                <td>{{$count_no++}}</td>
                <td>{{$data_item['lokasi']}}</td>
                @foreach($data_item['asuransi_sk_direktur'] as $data_asuransi)
                <td>{{$data_asuransi}}</td>
                @endforeach

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

                @php $column = excel_column($count_column-1) @endphp

                <td>=SUM(C{{$row}}:{{$column}}{{$row}})</td>
            </tr>
            @php $row++ @endphp
            @endforeach
            @if($index_layanan_data == 'rawat_jalan')
                <tr>
                    <td></td>
                    <td>TOTAL</td>
                    @for($i=3;$i<=$count_column;$i++)
                    @php
                        $column = excel_column($i);
                    @endphp
                    <td>=SUM({{$column}}7:{{$column}}{{$row-1}})</td>
                    @endfor
                </tr>
            @php $row_total_rajal = $row @endphp
            @php $row++ @endphp
            @endif
        @endforeach
        <tr>
            <td></td>
            <td>TOTAL</td>
            @for($i=3;$i<=$count_column;$i++)
            @php
                $column = excel_column($i);
            @endphp
            <td>=SUM({{$column}}{{$row_total_rajal}}:{{$column}}{{$last_row-1}})</td>
            @endfor
        </tr>
    </tbody>
</table>
