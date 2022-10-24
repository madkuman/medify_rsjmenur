<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Pengeluaran Obat</title>
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
  .table-bordered .bt-white {
    border-bottom: 1px solid #fff !important;
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
      <b>LAPORAN PENGELUARAN OBAT {{session('farmasi')->sluger}}</b>
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
          <th align="center" class="bt-white">NO.</th>
          <th align="center" class="bt-white">KODE OBAT</th>
          <th align="center" class="bt-white">NAMA OBAT</th>
          <th align="center" colspan="2">JUMLAH</th>
          <th align="center" colspan="2">INACBG</th>
          <th align="center" colspan="2">23 HARI</th>
          <th align="center" colspan="2">DUK RS</th>
        </tr>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th align="center">JML</th>
          <th align="center">HARGA</th>
          <th align="center">JML</th>
          <th align="center">HARGA</th>
          <th align="center">JML</th>
          <th align="center">HARGA</th>
          <th align="center">JML</th>
          <th align="center">HARGA</th>
        </tr>
      </thead>
      <tbody>
        @php $i=1 @endphp
        <?php $total_1=0; $total_2=0; $total_3=0; $total_4=0; ?>
        <?php $total_5=0; $total_6=0; $total_7=0; $total_8=0; ?>
        @foreach($items as $row)
        <tr>
          <td align="center">{{ $i++ }}</td>
          <td align="center">{{$row->item_detail->kode}}</td>
          <td>{{$row->item_detail->nama}}</td>
          <td align="right">{{$row->jumlah ? $row->jumlah : 0}}</td>
          <?php if($row->jumlah) {$total_1+=$row->jumlah;} ?>
          <td align="right">{{number_format($row->jumlah * $row->item_detail->harga)}}</td>
          <?php if($row->jumlah) {$total_2+=$row->jumlah * $row->item_detail->harga;} ?>
          <td align="right">{{$row->hari7 ? $row->hari7 : 0}}</td>
          <?php if($row->hari7) {$total_3+=$row->hari7;} ?>
          <td align="right">{{number_format($row->hari7 * $row->item_detail->harga)}}</td>
          <?php if($row->hari7) {$total_4+=$row->hari7 * $row->item_detail->harga;} ?>
          <td align="right">{{$row->hari23 ? $row->hari23 : 0}}</td>
          <?php if($row->hari23) {$total_5+=$row->hari23;} ?>
          <td align="right">{{number_format($row->hari23 * $row->item_detail->harga)}}</td>
          <?php if($row->hari23) {$total_6+=$row->hari23 * $row->item_detail->harga;} ?>
          <td align="right">{{$row->dukunganrs ? $row->dukunganrs : 0}}</td>
          <?php if($row->dukunganrs) {$total_7+=$row->dukunganrs;} ?>
          <td align="right">{{number_format($row->dukunganrs * $row->item_detail->harga)}}</td>
          <?php if($row->dukunganrs) {$total_8+=$row->dukunganrs * $row->item_detail->harga;} ?>
        </tr>
        @endforeach
        <tr>
          <td align="center" colspan="3" style="font-weight: bold;">T O T A L</td>
          <td align="right">{{number_format($total_1)}}</td>
          <td align="right">{{number_format($total_2)}}</td>
          <td align="right">{{number_format($total_3)}}</td>
          <td align="right">{{number_format($total_4)}}</td>          
          <td align="right">{{number_format($total_5)}}</td>
          <td align="right">{{number_format($total_6)}}</td>
          <td align="right">{{number_format($total_7)}}</td>
          <td align="right">{{number_format($total_8)}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html> 