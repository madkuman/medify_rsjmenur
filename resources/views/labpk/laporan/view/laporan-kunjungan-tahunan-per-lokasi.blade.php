<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">LAPORAN KUNJUNGAN TAHUNAN PER LOKASI RSJ MENUR SURABAYA</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">TAHUN : {{$start_date->format('Y')}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Ruangan</th>
            @php $array_bln = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Okt','Nov','Des'];
            @endphp
            @foreach($array_bln as $item)
            <th>{{$item}}</th>
            @endforeach
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $row = 7; 
            $first_row = [];
            $last_row = [];
            $nomor = 1;
        @endphp

        @foreach($data as $dept_name => $data_pelayanan)
            <tr>
                <td colspan ="15">{{$dept_name}}</td>
            </tr>
            @php 
                if(count($data_pelayanan) > 0){
                    $first_row[$dept_name] = $row;
                }
            @endphp
            @foreach($data_pelayanan as $unit => $data_jumlah)
            <tr>
                <td>{{$nomor++}}</td>
                <td>{{$unit}}</td>
                @foreach($array_bln as $item)
                <td>{{$data_jumlah[$item] ?? 0}}</td>
                @endforeach
                <td>=SUM(C{{$row}}:N{{$row++}})</td>
            </tr>
            @endforeach
            @php
                if(count($data_pelayanan) > 0){
                    $last_row[$dept_name] =$row;
                }
            @endphp
        @endforeach
        @foreach($data as $dept_name => $data_pelayanan)
        @php
        $idx = 3
        @endphp
        <tr>
            <td></td>
            <td>Total {{$dept_name}}</td>
            @foreach($array_bln as $item)
            @php 
                $column = excel_column($idx); 
                $idx++;
            @endphp
            @if(count($data_pelayanan) > 0)
            <td>=SUM({{$column}}{{$first_row[$dept_name]}}:{{$column}}{{$last_row[$dept_name]}})</td>
            @else
            <td>0</td>
            @endif
            
            @endforeach
            @php 
                $column = excel_column($idx); 
                $idx++;
            @endphp
            @if(count($data_pelayanan) > 0)
            <td>=SUM({{$column}}{{$first_row[$dept_name]}}:{{$column}}{{$last_row[$dept_name]}})</td>
            @else
            <td>0</td>
            @endif
        </tr>
        @endforeach
        @php
        $idx = 3;
        @endphp
        <tr>
            <td></td>
            <td>GRAND Total</td>
            @foreach($array_bln as $item)
            @php 
                $column = excel_column($idx); 
                $idx++;
            @endphp
            <td>=SUM({{$column}}{{$row + 1}}:{{$column}}{{$row + 3}})</td>
           
            @endforeach
            @php 
                $column = excel_column($idx); 
                $idx++;
            @endphp
            <td>=SUM({{$column}}{{$row + 1}}:{{$column}}{{$row + 3}})</td>
        </tr>
    </tbody>
</table>
