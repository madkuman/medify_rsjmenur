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
      {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> {{strtoupper(session('farmasi')->name)}}
    </div>
  </div>
  <div class="mt-25">
    <div class="text-center header-title">
      <b>LAPORAN STOK OPNAME <br> FARMASI {{session('farmasi')->name}} {{config('app.name')}} <br> TGL {{indonesian_date($min_date).' - '.indonesian_date($max_date)}}</b>
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
          <th align="center" width="80px">STOK HASIL OPNAME</th>
          <th align="center" width="100px">HARGA TOTAL</th>
          <th align="center" width="70px">ED</th>
        </tr>
      </thead>
      <tbody>
        @php $i=1 @endphp
        <?php $total_1=0; $total_2=0; ?>
        @foreach($items as $item)
          <tr>
            <td align="center">{{ $i++ }}</td>
            <td>{{$item['nama']}}</td>
            <td align="center">{{$item['satuan']}}</td>
            <td align="right">{{number_format($item['harga'])}}</td>
            <td align="right">{{$item['stok'] ?? 0}}</td>
            <?php $total_1+=$item['stok']; ?>
            <td align="right">{{number_format($item['stok'] * $item['harga'])}}</td>
            <?php $total_2+=$item['stok'] * $item['harga']; ?>
            <td align="center">{{ $item ? indonesian_date($item['kadaluarsa']) : ""}}</td>
          </tr>
        @endforeach
        <tr>
          <td align="center" colspan="4" style="font-weight: bold;">T O T A L</td>
          <td align="right">{{number_format($total_1)}}</td>
          <td align="right">{{number_format($total_2)}}</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>