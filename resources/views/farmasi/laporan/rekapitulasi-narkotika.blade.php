<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Rekapitulasi</title>
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
      <b>REKAPITULASI LAPORAN {{$kategori}}</b>
    </div>
  </div>
  <div class="mt-10">
    <div style="position: relative;">
      <div>
        <table class="text-small">
          <tr>
            <td>Nama Unit Layanan</td>
            <td>:</td>
            <td>Farmasi {{session('farmasi')->sluger}}</td>
          </tr>
          <tr>
            <td>Provinsi, Kabupaten/Kota</td>
            <td>:</td>
            <td>Jawa Timur, Kota Surabaya</td>
          </tr>
        </table>
      </div>
      <div style="position: absolute; top: 0; right: 0">
        <table class="text-small">
          <tr>
            <td>Tahun</td>
            <td>:</td>
            <td>{{date('Y')}}</td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{date('d F',strtotime($min_date))}} - {{date('d F',strtotime($max_date))}}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="mt-25">
    <table class="table table-bordered text-small">
      <thead>
        <tr>
          <th align="center" class="bt-white">NO.</th>
          <th align="center" class="bt-white">NAMA</th>
          <th align="center" class="bt-white">SAT</th>
          <th align="center" class="bt-white">STOK AWAL</th>
          <th align="center" colspan="2">PEMASUKAN</th>
          <th align="center" colspan="4">PENGELUARAN</th>
          <th align="center" class="bt-white">STOK AKHIR</th>
        </tr>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th align="center">PBF</th>
          <th align="center">SARANA</th>
          <th align="center">PBF</th>
          <th align="center">RESEP</th>
          <th align="center">SARANA</th>
          <th align="center">PEMUSNAHAN</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @php $i=1 @endphp
        <?php $total_1=0; $total_2=0; $total_3=0; $total_4=0; ?>
        <?php $total_5=0; $total_6=0; $total_7=0; $total_8=0; ?>
        @foreach($items as $item)
        <tr>
          <td align="center">{{ $i++ }}</td>
          <td>{{$item->item_detail->nama}}</td>
          <td align="center">{{$item->item_detail->satuan}}</td>
          <td align="right">{{$item->stok_awal ? $item->stok_awal : 0}}</td>
          <?php if($item->stok_awal) {$total_1+=$item->stok_awal;} ?>
          <td align="right">{{$item->masuk ? $item->masuk : 0}}</td>
          <?php if($item->masuk) {$total_2+=$item->masuk;} ?>
          <td align="right">0</td>
          <?php $total_3+=0 ?>
          <td align="right">{{$item->keluar ? $item->keluar : 0}}</td>
          <?php if($item->keluar) {$total_4+=$item->keluar;} ?>
          <td align="right">{{$item->resep ? $item->resep : 0}}</td>
          <?php if($item->resep) {$total_5+=$item->resep;} ?>
          <td align="right">0</td>
          <?php $total_6+=0 ?>
          <td align="right">{{$item->hapus ? $item->hapus : 0}}</td>
          <?php if($item->hapus) {$total_7+=$item->hapus;} ?>
          <td align="right">{{$item->stok_awal + $item->masuk - $item->keluar - $item->hapus}}</td>
          <?php $total_8+=$item->stok_awal + $item->masuk - $item->keluar - $item->hapus; ?>
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