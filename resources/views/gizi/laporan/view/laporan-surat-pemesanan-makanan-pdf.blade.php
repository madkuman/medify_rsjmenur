<html>
    <head>
        <style>
            body{
                font-family: 'arial';
            }
            table{
                width: 100%;
                  border-collapse: collapse;
            }
            .table-header tr td{
                font-size: 12px;
                font-weight: 700;
            }
            .table-body tr th{
                font-weight: 700;
                font-size: 8px;
                background: #eee;
                border: solid 1px black;
                text-align: center;
            }
            .table-body tr td{
                font-size: 8px;
                border: solid 1px black;
            }
            .text-center{
                text-align: center;
            }
            .text-left{
                text-align: left!important;
            }
        </style>
    </head>
<body>
<table class="table-header">
    <tr>
        <td colspan="{{count($utama_per_gender)}}" class="text-center">PEMERINTAH PROVINSI JAWA TIMUR</td>
    </tr>
    <tr>
        <td colspan="{{count($utama_per_gender)}}" class="text-center">RUMAH SAKIT JIWA MENUR PROVINSI JAWA TIMUR</td>
    </tr>

    <tr>
        <td colspan="{{count($utama_per_gender)}}" class="text-center">INSTALASI GIZI</td>
    </tr>
    <tr>
        <td colspan="{{count($utama_per_gender)}}"></td>
    </tr>
    <tr>
        <td colspan="{{count($utama_per_gender)}}" class="text-center">SURAT PEMESANAN MAKANAN</td>
    </tr>
    <tr>
        <td colspan="{{count($utama_per_gender)}}"></td>
    </tr>
    <tr>
        <td style="text-align: left;width:100px">TANGGAL</td>
        <td style="text-align: left;width:200px">: {{indonesian_date(strtotime($date))}}</td>
    </tr>
    <tr>
        <td style="text-align: left;width:100px">WAKTU MAKAN</td>
        <td style="text-align: left;width:200px">: {{$waktu_makan->nama}}</td>
    </tr>
    <tr>
        <td colspan="{{count($utama_per_gender)}}"></td>
    </tr>
</table>
<table class="table-body">
    <tr>
        <th rowspan="4">NO</th>
        <th rowspan="4">JENIS MAKANAN</th>
        <th colspan="{{$colspan * 2}}">RUANGAN DAN KELAS PERAWATAN</th>
        <th rowspan="3" colspan="2">JML</th>
        <th rowspan="4">TTL</th>
    </tr>
    <tr>
        @foreach($kelas as $index =>$item)
            <th colspan="{{count($item['bangsal_ids']) * 2 }}">{{$index}}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($kelas as $index =>$item)
           @foreach($item['bangsal_nama'] as $value)
                <th colspan="2">{{strtoupper($value)}}</th>
           @endforeach
        @endforeach
    </tr>
    <tr>
        @foreach($kelas as $index =>$item)
            @foreach($item['bangsal_nama'] as $value)
                <th>L</th>
                <th>P</th>
            @endforeach
        @endforeach
        <th>L</th>
        <th>P</th>
    </tr>
    @php
        $no=0;
        $start_row = 14;
        $end_row = $start_row;
    @endphp
    @foreach($data_utama as $index => $item)
        <tr>
            <td class="text-center">{{++$no}}</td>
            <td>{{$index}}</td>
            @foreach($item as $value)
            <td class="text-center">{{$value}}</td>
            @endforeach
        </tr>
        @php $end_row++ @endphp
    @endforeach
    <tr>
        <td></td>
        <td>JUMLAH PER GENDER</td>
        
        @foreach($utama_per_gender as $value)
            <td class="text-center">{{$value}}</td>
        @endforeach
    </tr>
    <tr>
        <td></td>
        <td>TOTAL</td>
        
        @php $total_data = count($utama_total) @endphp
        @foreach($utama_total as $index => $value)
            @if($index <= $total_data)
            <td colspan="2" class="text-center">{{$value}}</td>
            @else
            <td class="text-center">{{$value}}</td>
            @endif
        @endforeach
    </tr>

    <tr>
        <td colspan="{{count($utama_per_gender)+2}}">&nbsp;</td>
    </tr>

    @php
            $end_row+=2;
            $start_row = $end_row;
            $end_row = $start_row;
    @endphp

    @foreach($data_tambahan as $index => $item)
        <tr>
            @if($loop->iteration == 1)
            <td class="text-center">{{++$no}}</td>
            @else
                <td></td>
            @endif
            <td>{{$index}}</td>
            @foreach($item as $value)
                <td class="text-center">{{$value}}</td>
            @endforeach
        </tr>
        @php $end_row++ @endphp
    @endforeach

    
    <tr>
        <td></td>
        <td>JUMLAH PER GENDER</td>
        @foreach($tambahan_per_gender as $value)
            <td class="text-center">{{$value}}</td>
        @endforeach
    </tr>
    <tr>
        <td></td>
        <td>TOTAL</td>
        
        @php $total_data = count($tambahan_total) @endphp
        @foreach($tambahan_total as $index => $value)
            @if($index <= $total_data)
            <td colspan="2" class="text-center">{{$value}}</td>
            @else
            <td class="text-center">{{$value}}</td>
            @endif
        @endforeach
    </tr>

</table>

</html>