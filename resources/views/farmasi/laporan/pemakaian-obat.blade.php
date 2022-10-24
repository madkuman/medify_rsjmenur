<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Pemakaian Obat</title>
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
  </style>
</head>
<body>
  <div class="box-title">
    <div class="rs-title text-center">
      {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> {{strtoupper(session('farmasi')->sluger)}}
    </div>
  </div>
  <div class="mt-25">
    <div class="text-center header-title">
      <b>LAPORAN PEMAKAIAN OBAT {{$kategori}} <br> UNIT PELAYANAN FARMASI {{session('farmasi')->sluger}}</b>
    </div>
  </div>
  <div class="mt-10">
    <table class="text-small">
      <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>{{date('d F Y',strtotime($min_date))}} sampai {{date('d F Y',strtotime($max_date))}}</td>
      </tr>
    </table>
  </div>
  <div class="mt-10">
    <table class="table table-bordered text-small">
      <thead>
        <tr>
          <th align="center" width="50px">NO.</th>
          <th align="center" width="100px">KODE OBAT</th>
          <th align="center">NAMA OBAT</th>
          <th align="center" width="80px">SATUAN</th>
          <th align="center" width="80px">JUMLAH</th>
          <th align="center" width="100px">HARGA</th>
        </tr>
      </thead>
      <tbody>
        @php $i=1 @endphp
        <?php $total_1=0; $total_2=0; ?>
        @foreach($items as $row)
        <tr>
          <td align="center">{{ $i++ }}</td>
          <td align="center">{{$row->kode ?? '-'}}</td>
          <td>{{$row->nama}}</td>
          <td align="center" style="text-transform: capitalize;">{{$row->satuan}}</td>
          <td align="right">{{$jumlah[$row->id]}}</td>
          <?php $total_1+=$jumlah[$row->id] ?>
          <td align="right">Rp {{number_format($jumlah[$row->id] * $row->harga) ?? '0'}}</td>
          <?php $total_2+=$jumlah[$row->id] * $row->harga ?>
        </tr>
        @endforeach
        <tr>
          <td align="center" colspan="4" style="font-weight: bold;">T O T A L</td>
          <td align="right">{{number_format($total_1)}}</td>
          <td align="right">Rp {{number_format($total_2)}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html> 