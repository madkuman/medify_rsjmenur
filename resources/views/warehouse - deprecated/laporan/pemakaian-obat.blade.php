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
      {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> GUDANG FARMASI
    </div>
  </div>
  <div class="mt-25">
    <div class="text-center header-title">
      <b>LAPORAN PEMAKAIAN OBAT <br> UNIT PELAYANAN FARMASI UPF 2</b>
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
          <th align="center" width="50px">NO.</th>
          <th align="center" width="100px">KODE OBAT</th>
          <th align="center">NAMA OBAT</th>
          <th align="center" width="80px">SATUAN</th>
          <th align="center" width="80px">JUMLAH</th>
          <th align="center" width="100px">HARGA</th>
        </tr>
      </thead>
      <tbody>
        @for($i=1; $i<=44; $i++)
        <tr>
          <td align="center">{{ $i }}</td>
          <td align="center">r000eg2</td>
          <td>Aromasin tab 25 mg @ 30</td>
          <td align="center">Tab</td>
          <td align="right">1260</td>
          <td align="right">6.708.240</td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>
</body>
</html> 