<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Penerimaan</title>
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
      <b>LAPORAN PENERIMAAN <br> GUDANG FARMASI {{config('app.name')}}</b>
    </div>
  </div>
  <div class="mt-25">
    <table>
      <tr>
        <td>Tanggal Terima</td>
        <td>:</td>
        <td>{{date('d-m-y',strtotime($min_date))}} sampai {{date('d-m-y',strtotime($max_date))}}</td>
      </tr>
    </table>
  </div>
  <div class="mt-10">
    <table class="table table-bordered text-small">
      <thead>
        <tr>
          <th align="center" width="20px">NO.</th>
          <th align="center" width="60px">KODE OBAT</th>
          <th align="center" width="130px">NAMA OBAT</th>
          <th align="center" width="40px">TGL TERIMA</th>
          <th align="center" width="50px">NO. FAKTUR</th>
          <th align="center" width="40px">TGL FAKTUR</th>
          <th align="center" width="100px">PRODUSEN</th>
          <th align="center" width="50px">JUMLAH</th>
          <th align="center" width="50px">HARGA</th>
          <th align="center" width="40px">TGL EXPIRED</th>
        </tr>
      </thead>
      <tbody>
        @php $i=1 @endphp
        @foreach($items as $item)
          <tr>
            <td align="center">{{ $i++ }}</td>
            <td align="center">{{$item->detail_item->detail_item->kode}}</td>
            <td>{{$item->detail_item->detail_item->nama}}</td>
            <td align="center">{{ $item->tanggal ? date('d-m-y', strtotime($item->tanggal)) : ""}}</td>
            <td align="right">{{ $item->detail_pengadaan->nomor_referensi ? $item->detail_pengadaan->nomor_referensi : ""}}</td>
            <td align="center">{{ $item->detail_pengadaan->tanggal_faktur ? date('d-m-y', strtotime($item->detail_pengadaan->tanggal_faktur)) : ""}}</td>
            <td align="center">{{ $item->detail_pengadaan->supplier_detail ? $item->detail_pengadaan->supplier_detail->nama : ""}}</td>
            <td align="center">{{ $item->jumlah }}</td>
            <td align="center">{{ number_format($item->detail_item->detail_item->harga) }}</td>
            <td align="center">{{ $item->detail_item ? date('d-m-y', strtotime($item->detail_item->kadaluarsa)) : ""}}</td>
          </tr>
        @endforeach
        <tr></tr>
      </tbody>
    </table>
  </div>
</body>
</html>