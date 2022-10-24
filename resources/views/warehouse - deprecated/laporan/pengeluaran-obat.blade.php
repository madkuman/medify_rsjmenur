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
      {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> GUDANG FARMASI
    </div>
  </div>
  <div class="mt-25">
    <div class="text-center header-title">
      <b>LAPORAN PENGELUARAN OBAT UPF 2</b>
    </div>
  </div>
  <div class="mt-10">
    <table class="text-small">
      <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>02-10-2018 sampai 02-10-2018</td>
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
        @for($i=1; $i<=40; $i++)
        <tr>
          <td align="center">{{ $i }}</td>
          <td align="center">B000496</td>
          <td>Asam tranexamat 500 mg</td>
          <td align="right">210</td>
          <td align="right">460</td>
          <td align="right">966</td>
          <td align="right">1.045.598,4</td>
          <td align="right">84</td>
          <td align="right">90.921,6</td>
          <td align="right">1.260</td>
          <td align="right">6.708.240</td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>
</body>
</html> 