<!DOCTYPE html>
<html>
<head>
    <style>
    table,td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
    }
    th{
        border:1px solid white;
        border-collapse: collapse;
    }
</style>
</head>
<body>
    <table style="width: 100vw">
        <thead>
            <tr>
                <th style="width: 60%"></th>
                <th style="width: 40%; text-align: center;">Kepada</th>
            </tr>
            <tr>
                <th style="width: 60%"></th>
                <th style="width: 40%; text-align: center;">Yth Kabagbek {{config('app.name')}}</th>
            </tr>
            <tr>
                <th style="width: 60%"></th>
                <th style="width: 40%; text-align: center;">Di Tempat</th>
            </tr>
            <tr>
                <th colspan="2" style="text-align:center;">DAFTAR PESANAN BAHAN MAKANAN
                    @if($flag == 1) Dinas
                    @elseif($flag == 2) Hankam
                    @elseif($flag == 3) Non Hankam
                    @elseif($flag == 4) Jamkesmas
                    @elseif($flag == 5) PC 
                @endif</th>
            </tr>
            <tr>
                <th colspan="2" style="text-align:center;">{{$mulai}} Hingga {{$akhir}}</th>
            </tr>
        </thead>
    </table>
    <br>
    <table style="width: 100vw">
        <thead>
            <tr>
                <th style="border:1px solid black" rowspan="2">No</th>
                <th style="border:1px solid black" rowspan="2">Nama Bahan</th>
                <th style="border:1px solid black" rowspan="2">Satuan</th>
                <th style="border:1px solid black" colspan="
                @if($flag == 0) 6 
                @else 2
                @endif " style="text-align:center;">Banyaknya</th>
                <th style="border:1px solid black" rowspan="2">Harga</th>
                <th style="border:1px solid black" rowspan="2" style="@if($flag > 0) width:200px; @endif">Jumlah</th>
            </tr>
            <tr>
                @if($flag == 1 || $flag == 0)
                <th style="border:1px solid black">Dinas</th>
                @endif
                @if($flag == 2 || $flag == 0)
                <th style="border:1px solid black">Hankam</th>
                @endif
                @if($flag == 3 || $flag == 0)
                <th style="border:1px solid black">Nonhankam</th>
                @endif
                @if($flag == 4 || $flag == 0)
                <th style="border:1px solid black">Jamkesmas</th>
                @endif
                @if($flag == 5 || $flag == 0)
                <th style="border:1px solid black">PC</th>
                @endif
                <th style="border:1px solid black">Total</th>
            </tr>    
        </thead>

        @php $count = 0; @endphp
        @foreach($data['all'] as $key => $all_item)
        @php
        if($key == 'lain') $jenis = 'Lain-Lain';
        else if($key == 'bahan_kering') $jenis = 'Bahan Kering';
        else if($key == 'sayur_mayur') $jenis = 'Sayur Mayur';
        else if($key == 'bumbu') $jenis = 'Bumbu';
        else if($key == 'buah') $jenis = 'Buah';
        else if($key == 'lauk_pauk') $jenis = 'Lauk Pauk';
        @endphp
        <tr>
            <td></td>
            <td style="font-size: 18px;"><b>{{$jenis}}</b></td>
            <td colspan="@if($flag == 0) 12
            @else 6 @endif "></td>
        </tr>
        @foreach($all_item as $bahan)
        <tr>
            <td>{{++$count}}</td>
            <td>{{$bahan['nama']}}</td>
            <td>{{$bahan['satuan']}}</td>
            @if(!empty($data['dinas'][$key][$bahan['id']]['total_bk_final']))
            <td> 
                {{$data['dinas'][$key][$bahan['id']]['total_bk_final']}}
            </td>
            @elseif($flag == 1 || $flag == 0)
            <td>0</td>
            @endif
            @if(!empty($data['hankam'][$key][$bahan['id']]['total_bk_final']))
            <td> 
                {{$data['hankam'][$key][$bahan['id']]['total_bk_final']}}
            </td>
            @elseif($flag == 2 || $flag == 0)
            <td>0</td>
            @endif
            @if(!empty($data['nonhankam'][$key][$bahan['id']]['total_bk_final']))
            <td> 
                {{$data['nonhankam'][$key][$bahan['id']]['total_bk_final']}}
            </td>
            @elseif($flag == 3 || $flag == 0)
            <td>0</td>
            @endif
            @if(!empty($data['jamkesmas'][$key][$bahan['id']]['total_bk_final']))
            <td> 
                {{$data['jamkesmas'][$key][$bahan['id']]['total_bk_final']}}
            </td>
            @elseif($flag == 4 || $flag == 0)
            <td>0</td>
            @endif
            @if(!empty($data['pc'][$key][$bahan['id']]['total_bk_final']))
            <td> 
                {{$data['pc'][$key][$bahan['id']]['total_bk_final']}}
            </td>
            @elseif($flag == 5 || $flag == 0)
            <td>0</td>
            @endif
                <!-- <td> 
                @if(!empty($data['lain'][$key][$bahan['id']]['total_bk_final']))
                    {{$data['lain'][$key][$bahan['id']]['total_bk_final']}}
                @endif
            </td> -->
            @if(!empty($data['all'][$key][$bahan['id']]['total_bk_final']))
            <td> 
                {{$data['all'][$key][$bahan['id']]['total_bk_final']}}
            </td>
            @endif
            @php $number = number_format($bahan['harga'], 0, '.' , ','); @endphp
            <td>Rp{{$number}}</td>
            @php $number = number_format($bahan['harga'] * $bahan['total_bk_final'], 0, '.' , ','); @endphp
            <td>Rp{{$number}}</td>
        </tr>
        @endforeach
        @endforeach
    </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>
</html>
