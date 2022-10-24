<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Stok</title>
  <style>
  @page{
    margin-top: 10px;
    margin-left: 10px;
    margin-right: 10px;
  }
  body { 
    font-family: Calibri; 
    color: black; 
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
    font-size: 10px !important;
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
  .lawas{
    display: none
  }
  .dummy{
    font-size: 10px;
    color: white;
  }
</style>
</head>
<body>
  <img src="{{url('assets/img/kop_menur.png')}}" width="100%">
  <table style="border-top: 1px solid black; margin-top: 5px;" width="100%"><tr><td class="dummy">.</td></tr></table>
  <table width="100%">
    <tr>
      <td style="text-align: center; font-size: 16px; text-decoration: underline; font-weight: bold">{{strtoupper(session('farmasi')->nama)}}</td>
    </tr>
  </table>
  <div class="baru">
    <div class="mt-10">
      <table class="table text-small">
        <tr>
          <td width="25%">Nama Barang</td>
          <td width="45%">: {{$item->item_detail->nama}}</td>
          <td width="15%">Satuan</td>
          <td width="15%">: {{$item->item_detail->satuan}}</td>
        </tr>
      </table>
    </div>
    <hr width="100%" style="margin-bottom: 5px;">
    <div style="margin-top: 0px">
      <table class="table table-bordered text-small">
        <thead>
          <tr>
            <td align="center" width="14%">TANGGAL</td>
            <td align="center" width="27%">NAMA/RM</td>
            <td align="center" width="14%">MSK</td>
            <td align="center" width="14%">KLR</td>
            <td align="center" width="15%">SISA</td>
            <td align="center" width="16%">KET.</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td align="right">{{number_format($stok_awal,1)}}</td>
            <td>Stok Awal</td>
          </tr>
          @php $i=1;$masuk=0;$keluar=0;$total=$stok_awal @endphp
          @foreach($riwayat as $row)
          <tr>
            <td align="center">{{ date('d-m-y', strtotime($row->created_at))}}</td>
            <td align="center">@if($row->nomor_rm != 0) {{ucwords(strtolower($row->nama))}} / {{$row->nomor_rm}} @endif</td>
            <td align="right">
              {{number_format($row->jumlah_plus,1)}}
            </td>
            <td align="right">
              {{number_format($row->jumlah_min,1)}}
            </td>
            @php $total -= $row->jumlah_min; $keluar += $row->jumlah_min @endphp
            @php $total += $row->jumlah_plus; $masuk += $row->jumlah_plus @endphp
            <td align="right">{{number_format($total,1)}}</td>
            <td>@if($row->nomor_rm == 0) {{$row->nama}} @endif</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td align="center" colspan="2">Total</td>
            <td align="right">{{number_format($masuk,1)}}</td>
            <td align="right">{{number_format($keluar,1)}}</td>
            <td align="right"></td>
            <td align="right"></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</body>
</html>