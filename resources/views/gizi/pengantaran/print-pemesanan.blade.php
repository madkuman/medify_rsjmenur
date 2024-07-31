<!DOCTYPE html>
<html>
<head>
    <title>Print Daftar Permintaan Makanan Pasien</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
            width : 100%;
            font-family : sans-serif;
            font-size: 13px;
        }
        table.bordered {
            border: 1px solid #000;
        }
        table.bordered td {
            border: 1px solid #000;
        }
        .td-bordered {
            border: 1px solid #000 !important;
        }
        table.no-border td {
            border: none;
        }
        .big{
            font-size: 17px;
            text-transform: uppercase;
            text-align: center;
        }
        td{
            vertical-align : top
        }
        .h1, .h2, .h3, .h4{
            font-size : 16px;
            border-top: 1px solid black;
            padding-top: 15px;
        }
        .h5{
            font-size : 14px;
            border-top: 1px solid black;
            padding-top: 15px;
        }
        .h6{
            font-size : 13px;
            border-top: 1px solid black;
            padding-top: 15px;
        }
        table td.va-mid {
            vertical-align: middle;
        }
        table td.va-bottom {
            vertical-align: bottom;
        }
        .cbx::after{
            content: "4";
            line-height: 0.6;
            z-index: 100;
            font-family: ZapfDingbats, sans-serif;
        }
        .cb{
            border: 1px solid black;
            display: inline-block;
            width: 7px;
            height: 7px;
            margin-right: 5px;
        }
        .mt-4 {
            margin-top: 4px;
        }
        .mt-0 {
            margin-top: 0;
        }
        .mb-0 {
            margin-bottom: 0;
        }
        p {
            font-family: "Arial";
            font-size: 16px;
        }
        table td.va-mid {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<table width="100%">
    <tr>
        <td width="25%" align="center">
            <img width="100" src="{{asset('assets/img/logo-rs.jpg')}}">
        </td>
        <td width="75%" align="center" class="va-mid">
            <b>RUMAH SAKIT JIWA MENUR <br> PEMERINTAH PROVINSI JAWA TIMUR</b> <br>
            Jl. Menur 120, Surabaya <br>
            Telp/Fax. 031-5021635 / 031-5021636/7 <br>
            E-Mail: rsjmenur@jatimprov.go.id
        </td>
    </tr>
</table>

    <table class="bordered" style="margin-top: 15px;" cellpadding="3">
        <tr>
            <td align="center" rowspan="2" class="va-mid">No</td>
            <td align="center" rowspan="2" class="va-mid">Nama Pasien</td>
            <td align="center" rowspan="2" class="va-mid">Ruangan</td>
            <td align="center" colspan="8">Waktu</td>
        </tr>
        <tr>
            <td align="center">Pagi</td>
            <td align="center">Catatan</td>
            <td align="center">Snack Pagi</td>
            <td align="center">Siang</td>
            <td align="center">Catatan</td>
            <td align="center">Snack Sore</td>
            <td align="center">Sore</td>
            <td align="center">Catatan</td>
        </tr>
        @php 
            $i=1; 
            $checked = '<div style="font-family: ZapfDingbats, sans-serif; display: inline;">4</div>';
        @endphp
        @foreach($pemesanan as $item)
                <tr>
                    <td align="center">{{$loop->iteration}}</td>
                    <td>{{$item['pasien']['name'] ?? "-"}}</td>
                    <td>{{$item['kasus']['lokasi']['lokasi']['nama'] ?? "-"}}</td>
                    
                    @php
                        $td = [
                            "pagi" => '<td align="center">-</td>',
                            "catatan_pagi" => '<td align="center">-</td>',
                            "snack_pagi" => '<td align="center">-</td>',
                            "siang" => '<td align="center">-</td>',
                            "catatan_siang" => '<td align="center">-</td>',
                            "snack_sore" => '<td align="center">-</td>',
                            "sore" => '<td align="center">-</td>',
                            "catatan_sore" => '<td align="center">-</td>'
                        ];
                    @endphp

                    @foreach($item['pemesanan_detail'] as $detail)
                        @if($detail['waktu_makan_id'] == 1)
                            @php 
                                $td['pagi'] = '<td align="center">'.$checked.'</td>';
                                $td['catatan_pagi'] = "<td>".$detail['diet']['nama']." - ".$detail['catatan']."</td>";
                            @endphp
                        @endif

                        @if($detail['waktu_makan_id'] == 4)
                            @php 
                                $td['snack_pagi'] = '<td align="center">'.$checked.'</td>';
                            @endphp
                        @endif

                        @if($detail['waktu_makan_id'] == 2)
                            @php 
                                $td['siang'] = '<td align="center">'.$checked.'</td>';
                                $td['catatan_siang'] = "<td>".$detail['diet']['nama']." - ".$detail['catatan']."</td>";
                            @endphp
                        @endif

                        @if($detail['waktu_makan_id'] == 5)
                            @php 
                                $td['snack_sore'] = '<td align="center">'.$checked.'</td>';
                            @endphp
                        @endif

                        @if($detail['waktu_makan_id'] == 3)
                            @php 
                                $td['sore'] = '<td align="center">'.$checked.'</td>';
                                $td['catatan_sore'] = "<td>".$detail['diet']['nama']." - ".$detail['catatan']."</td>";
                            @endphp
                        @endif
                    @endforeach

                    @foreach($td as $key => $value)
                        {!! $value !!}
                    @endforeach
                </tr>
            @php 
                $i++; 
            @endphp
        @endforeach
    </table>
</body>
</html>



{{-- 
    <!DOCTYPE html>
    <html>
    <head>
    <style>
    table,td, th {
        border: 1px solid black;
        border-collapse: collapse;
        font-size:10pt;
    }
    th, td {
        padding: 15px;
    }
    </style>
    </head>
    <body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pasien</th>
                <th>Ruangan</th>
                <th>Waktu</th>
                <th>Diet</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($data as $waktu)
                @foreach($waktu as $detail)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$detail['pemesanan']->pasien->name}}</td>
                    <td>{{$detail[0]->lokasi->nama}}</td>
                    <td>
                    @if($detail[0]->waktu_makan_id == 1)
                    Makan Pagi
                    @elseif($detail[0]->waktu_makan_id == 2)
                    Makan Siang
                    @elseif($detail[0]->waktu_makan_id == 3)
                    Makan Sore
                    @elseif($detail[0]->waktu_makan_id == 4)
                    Snack Pagi
                    @elseif($detail[0]->waktu_makan_id == 5)
                    Snack Sore
                    @endif 
                    </td>
                    <td>{{$detail[0]->diet->nama}}</td>
                </tr>
                @php $i++; @endphp      
                @endforeach
            @endforeach                 
        </tbody>
    </table>

    <script type="text/javascript">
    window.print();
    </script>

    </body>
    </html>
--}}
