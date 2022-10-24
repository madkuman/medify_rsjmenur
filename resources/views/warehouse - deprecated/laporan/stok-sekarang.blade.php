<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Stok Sekarang</title>
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
      {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> GUDANG FARMASI
    </div>
  </div>
  <div class="mt-25">
    <div class="text-center header-title">
      <b>LAPORAN STOK OBAT <br> GUDANG FARMASI</b>
    </div>
  </div>
  <div class="mt-10">
    <table class="text-small">
      <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>{{indonesian_date($date)}}</td>
      </tr>
    </table>
  </div>
  <div class="mt-10">
    <table class="table table-bordered text-small">
      <thead>
        <tr>
          <th align="center" width="5%">NO.</th>
          <th align="center" width="10%">KODE OBAT</th>
          <th align="center" width="30%">NAMA OBAT</th>
          <th align="center" width="10%">SATUAN</th>
          <th align="center" width="15%">HARGA</th>
          <th align="center" width="15%">JUMLAH</th>
          <th align="center" width="15%">SUBTOTAL</th>
        </tr>
      </thead>
      <tbody>
        @php($total=0)
        @php($total1=0)
        @foreach($items as $item)
        <tr>
          <td align="center">{{ $loop->iteration }}</td>
          <td align="center">{{$item->kode ?? '-'}}</td>
          <td>{{$item->nama ?? '-'}}</td>
          <td align="center">{{$item->satuan ?? '-'}}</td>
          <td align="right">{{$item->harga ?? 0}}</td>
          <td align="right">{{$item->stok ?? 0}}</td>
          @php($total+=($item->stok ?? 0))
          <td align="right">{{($item->stok ?? 0)*$item->harga}}</td>
          @php($total1+=($item->stok ?? 0) * $item->harga)
        </tr>
        @endforeach
        <tr>
          <td align="center" colspan="5">T O T A L</td>
          <td align="right">{{$total}}</td>
          <td align="right">{{$total1}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html> 