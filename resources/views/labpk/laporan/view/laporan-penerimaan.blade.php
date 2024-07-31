<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">PENERIMAAN INSTALASI LABORATORIUM RSJ MENUR SURABAYA</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">PERIODE : {{$start_date->format('d/m/Y')}} - {{$end_date->format('d/m/Y')}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th>GOL TARIF</th>
            <th>UNIT</th>
            @foreach($header as $item)
            <th>{{$item}}</th>
            @endforeach
            <th>JML</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $row = 6; 
            $row_total = [];
        @endphp

        @foreach($data as $asuransi_name => $data_pelayanan)
            @foreach($data_pelayanan as $unit => $data_jumlah)
            <tr>
                @if($loop->first) 
                    <td rowspan="{{count($data_pelayanan)}}">{{$asuransi_name}}</td>
                @endif

                <td>{{$unit}}</td>
                @foreach($data_jumlah as $item_jumlah)
                <td>{{$item_jumlah}}</td>
                @endforeach
                <td>=SUM(C{{$row}}:{{excel_column($count_column-1)}}{{$row}})</td>
            </tr>
            @php $row++ @endphp
            @endforeach
            <tr>
                <td></td>
                <td>TOTAL</td>
                @for($i=3;$i<=$count_column;$i++)
                @php
                    $column = excel_column($i);
                    $count_unit = count($data_pelayanan);
                @endphp
                <td>=SUM({{$column}}{{$row-$count_unit}}:{{$column}}{{$row-1}})</td>
                @endfor
            </tr>
            @php $row_total[] = $row @endphp
            @php $row++ @endphp
        @endforeach
        <tr>
            <td colspan="2">TOTAL</td>
            @for($i=3;$i<=$count_column;$i++)
            @php
                $column = excel_column($i);
            @endphp
            <td>   
                =          
                @foreach($row_total as $row_item)
                    {{$column}}{{$row_item}} @if(!$loop->last)+@endif
                @endforeach
            </td>
            @endfor
        </tr>
    </tbody>
</table>
