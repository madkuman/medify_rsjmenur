<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Penjualan Bebas</title>
    <style>
    body { 
        font-family: sans-serif; 
        color: black 
    }
    .content {
        margin-left: 30px;
    }
    .rs-title { 
        font-size: 13px;
        border-bottom: 1px solid black;       
    }
    .text-center {
        text-align: center !important;
    }
    .text-small {
        font-size: 13px;
    }
    .box-title {
        width: 250px;
        /*background-color: red;*/
    }
    .box-header-title {
        /*background-color: red;*/
    }
    .mt-25 {
        margin-top:25px;
    }
    .mt-10 {
        margin-top:10px;
    }
    .header-title {
        font-size: 15px;
    }
    .table {
        width: 100%;
        max-width: 100%;
        border-collapse: collapse;
    }
    .table-bordered, .table-bordered td, .table-bordered th {
        border: 1px solid #000;
    }
    .table-bordered td {
        padding: 2px 3px 2px 3px;
        font-weight: normal;
    }
    .table-bordered .bt-white {
        border-bottom: 1px solid #fff !important;
    }
</style>
</head>
<body>
    <div class="box-title">
        <div class="rs-title text-center">
            {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> {{session('farmasi')->sluger}}
        </div>
    </div>
    <div class="mt-25">
        <div class="text-center header-title">
            <b>LAPORAN PENJUALAN BEBAS {{session('farmasi')->sluger}}</b>
        </div>
    </div>
    <div class="mt-10">
        <table class="text-small">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{$min_date}} s.d. {{$max_date}}</td>
            </tr>
        </table>
    </div>
    <div class="mt-10">
        <table class="table table-bordered text-small">
            <thead>
                <tr>
                    <th align="center" width="7%">NO.</th>
                    <th align="center" width="15%">NO KWITANSI</th>
                    <th align="center" width="38%">HARGA OBAT</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($transaksi as $item)
                <tr>
                    <td align="center">{{$i}}</td>
                    <td align="center">{{$item['slug']}}</td>
                    <td align="right">Rp {{number_format($item['total_biaya_obat'])}}</td>
                </tr>
                @php $i++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html> 