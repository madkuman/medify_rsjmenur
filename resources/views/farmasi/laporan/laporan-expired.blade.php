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
            <b style="text-transform: capitalize;">LAPORAN ITEM EXPIRED {{session('farmasi')->sluger}}</b>
        </div>
    </div>
    <div class="mt-10">
        <table class="text-small">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{indonesian_date($min_date)}} - {{indonesian_date($max_date)}}</td>
            </tr>
        </table>
    </div>
    <div class="mt-10">
        <table class="table table-bordered text-small">
            <thead>
                <tr>
                    <th align="center" width="7%">NO.</th>
                    <th align="center" width="50%">NAMA BARANG</th>
                    <th align="center" width="23%">ED</th>
                    <th align="center" width="20%">JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($items as $item)
                @php if(empty($item['jumlah']) || $item['jumlah'] == 0) continue; @endphp
                <tr>
                    <td align="center">{{$i}}</td>
                    <td align="left">{{$item['detail_item']['item_detail']['nama'] ?? '-' }}</td>
                    <td align="left">{{indonesian_date(date('d-m-Y', strtotime($item['kadaluarsa'])))}}</td>
                    <td align="left">{{$item['jumlah'] ?? '0'}}</td>
                </tr>
                @php $i++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html> 