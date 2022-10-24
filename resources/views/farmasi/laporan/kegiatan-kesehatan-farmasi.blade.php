<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Kegiatan Kesehatan Farmasi</title>
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
    .table-bordered .br-white {
      border-right: 1px solid #fff !important;
    }
  </style>
</head>
<body>
  <div class="box-title">
    <table width="100%">
      <tr>
        <td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
      </tr>
    </table>
  </div>
  <div class="mt-25">
    <table class="table table-bordered text-small">
      <thead>
        <tr>
          <th align="center" width="30px">NO.</th>
          <th align="center" width="90px">KODE OBAT</th>
          <th align="center" width="170px">NAMA MATERIAL</th>
          <th align="center" width="50px">SAT</th>
          <th align="center" width="90px">HARGA SATUAN</th>
          <th align="center" width="70px">STOK AWAL</th>
          <th align="center" width="80px">BARANG MASUK</th>
          <th align="center" width="80px">BARANG KELUAR</th>
          <th align="center" width="80px">STOK AKHIR</th>
          <th align="center" width="90px">HARGA TOTAL</th>
          <th align="center" width="60px">ED</th>
          <th align="center" width="80px">Ket</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="12">
            <b>ANGIOGRAFI</b>
          </td>
        </tr>
        <tr>
          <td align="center">1</td>
          <td></td>
          <td>Aromasin tab 25 mg @ 30</td>
          <td align="center">Tab</td>
          <td align="right">8.000</td>
          <td align="right"></td>
          <td align="right"></td>
          <td align="right"></td>
          <td align="right"></td>
          <td align="right"></td>
          <td align="center">1/21</td>
          <td align="center"></td>
        </tr>
        <tr>
          <td colspan="8">
            <b>Total Kelompok</b>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="12">
            <b>TABLET</b>
          </td>
        </tr>
        @for($i=1; $i<=14; $i++)
        <tr>
          <td align="center">{{$i}}</td>
          <td>B0000004</td>
          <td>Aromasin tab 25 mg @ 30</td>
          <td align="center">Tab</td>
          <td align="right">153.000</td>
          <td align="right"></td>
          <td align="right"></td>
          <td align="right"></td>
          <td align="right">1,620</td>
          <td align="right">1.000.000</td>
          <td align="center">10/21</td>
          <td align="center">BAIK</td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>
</body>
</html> 