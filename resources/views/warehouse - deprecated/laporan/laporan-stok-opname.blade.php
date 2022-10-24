<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Stok Opname</title>
  <style>
    body { 
      font-family: Calibri; 
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
  </style>
</head>
<body>
  <div class="box-title">
    <div class="rs-title text-center">
      {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> GUDANG FARMASI
    </div>
  </div>
  <div class="mt-25">
    <div class="text-center header-title">
      <b>LAPORAN STOK OPNAME <br> GUDANG FARMASI {{config('app.name')}} <br> TGL {{date('d F Y',strtotime($date))}}</b>
    </div>
  </div>
  <div class="mt-25">
    <table class="table table-bordered text-small">
      <thead>
        <tr>
          <th align="center" width="40px">NO.</th>
          <th align="center" width="230px">NAMA MATERIAL</th>
          <th align="center" width="40px">SAT</th>
          <th align="center" width="80px">HARGA SATUAN</th>
          <th align="center" width="80px">STOK AKHIR</th>
          <th align="center" width="100px">HARGA TOTAL</th>
          <th align="center" width="70px">ED</th>
          <th align="center" width="60px">KET</th>
        </tr>
      </thead>
      <tbody>
        @php $i=1 @endphp
        @foreach($items as $item)
          <tr>
            <td align="center">{{ $i++ }}</td>
            <td>{{$item->nama}}</td>
            <td align="center">{{$item->satuan}}</td>
            <td align="right">{{number_format($item->harga)}}</td>
            <td align="right">{{$item->stok_awal}}</td>
            <td align="right">{{number_format($item->stok_awal * $item->harga)}}</td>
            <td align="center">{{ $item->kadal ? date('m/y', strtotime($item->kadal)) : ""}}</td>
            <td align="center">{{ $item->stok_awal ? "BAIK" : ""}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>