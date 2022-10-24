<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">LAPORAN KUNJUNGAN TAHUNAN PER DEBITUR RSJ MENUR SURABAYA</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">TAHUN : {{$start_date->format('Y')}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th>No</th>
            <th colspan="2">Debitur</th>
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
            $row = 6; 
            $first_row = 6;
            $nomor = 1;
        @endphp

        @foreach($data as $debitur_name => $data_pelayanan)
            @if(count($data_pelayanan) > 1)
                @php $this_loop = 0; @endphp
                @foreach($data_pelayanan as $kelas_name => $data_total)
                <tr>
                    @php $this_loop++; @endphp
                    <td>{{$nomor++}}</td>
                    @if($this_loop == 1)
                    <td rowspan="{{count($data_pelayanan)}}">{{$debitur_name}}</td>
                    @endif
                    <td>{{$kelas_name}}</td>
                    @foreach($array_bln as $item)
                    <td>{{$data_total[$item] ?? 0}}</td>
                    @endforeach
                    <td>=SUM(C{{$row}}:N{{$row++}})</td>
                </tr>
                @endforeach
            @else
            <tr>
                <td>{{$nomor++}}</td>
                <td colspan="2">{{$debitur_name}}</td>
                @foreach($array_bln as $item)
                <td>{{$data_total[$item] ?? 0}}</td>
                @endforeach
                <td>=SUM(C{{$row}}:N{{$row++}})</td>
            </tr>
            @endif
        @endforeach
        @php
        $idx = 4;
        @endphp
        <tr>
            <td></td>
            <td colspan="2">GRAND TOTAL</td>
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
