<!DOCTYPE html>
<html>
<head>
    <style>
        table td{
            border: solid 1px black;
        }
        </style>
</head>
<body>
    <table>
        <tr>
            <td  colspan="{{count($json[0])}}">Laporan Pendapatan Farmasi</td>
        </tr>
        <tr>
            <td  colspan="{{count($json[0])}}">Periode : {{$tanggal_awal}} - {{$tanggal_akhir}}</td>
        </tr>
        <tr>
            <td  colspan="{{count($json[0])}}">Farmasi : {{$farmasi}}</td>
        </tr>
        <tr>
            <td  colspan="{{count($json[0])}}">Jenis Resep : {{$resep_jenis}}</td>
        </tr>
        
        <tr>
            <td></td>
        </tr>
        @foreach($json as $row)
        <tr>
            @foreach($row as $col)
            <td>{{$col}}</td>
            @endforeach
        </tr>
        @endforeach
    </table>

</body>
</html>