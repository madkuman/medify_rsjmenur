<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">LAPORAN KUNJUNGAN TAHUNAN PER TARIF RSJ MENUR SURABAYA</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">TAHUN : {{$start_date->format('Y')}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th>No</th>
            <th>Tarif</th>
            @php $array_bln = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            @endphp
            @foreach($array_bln as $item)
            <th>{{$item}}</th>
            @endforeach
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $row = 6; 
            $first_row = 6;
            $nomor = 1;
        @endphp

        @foreach($data as $tarif_name => $data_pelayanan)
            <tr>
                <td>{{$nomor++}}</td>
                <td>{{$tarif_name}}</td>
                @foreach($array_bln as $item)
                <td>{{$data_pelayanan[$item] ?? 0}}</td>
                @endforeach
                <td>=SUM(C{{$row}}:N{{$row++}})</td>
            </tr>
        @endforeach
        @php
        $idx = 3;
        @endphp
        <tr>
            <td></td>
            <td>GRAND TOTAL</td>
            @foreach($array_bln as $item)
            @php 
                $column = excel_column($idx); 
                $idx++;
            @endphp
            <td>=SUM({{$column}}{{$first_row}}:{{$column}}{{$row - 1}})</td>
           
            @endforeach
            @php 
                $column = excel_column($idx); 
                $idx++;
            @endphp
            <td>=SUM({{$column}}{{$first_row}}:{{$column}}{{$row - 1}})</td>
        </tr>
    </tbody>
</table>
