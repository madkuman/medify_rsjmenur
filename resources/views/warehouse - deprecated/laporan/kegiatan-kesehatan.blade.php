<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Kegiatan Kesehatan</title>
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
      font-size: 12px;
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
     {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> GUDANG FARMASI
    </div>
  </div>
  <div class="mt-25">
    <div class="text-center header-title">
      <b>LAPORAN KEGIATAN KESEHATAN <br> BIDANG MATERIAL KESEHATAN {{config('app.name')}} <br> TANGGAL {{indonesian_date($min_date)}} - {{indonesian_date($max_date)}}</b>
    </div>
  </div>
  <div class="mt-25">
    <table class="table table-bordered text-small">
      <thead>
        <tr>
          <th align="center" class="bt-white">NO.</th>
          <th align="center" class="bt-white">NAMA MATERIAL KESEHATAN</th>
          <th align="center" class="bt-white">SAT</th>
          <th align="center" class="bt-white">HARGA SATUAN</th>
          <th align="center" colspan="2">PERSEDIAAN AWAL</th>
          <th align="center" colspan="2">TERIMA</th>
          <th align="center" colspan="2">KELUAR</th>
          <th align="center" colspan="2">KADALUARSA</th>
          <th align="center" class="bt-white">STOK AKHIR</th>
          <th align="center" class="bt-white">HARGA TOTAL</th>
          <th align="center" class="bt-white">ED</th>
        </tr>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th align="center">QUANTITY</th>
          <th align="center">HARGA</th>
          <th align="center">QUANTITY</th>
          <th align="center">HARGA</th>
          <th align="center">QUANTITY</th>
          <th align="center">HARGA</th>
          <th align="center">QUANTITY</th>
          <th align="center">HARGA</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @php $i=1; @endphp
        @foreach($items as $item)
          @if(!array_key_exists($item->id, $sekarang) )
            @continue
          @endif
          @php
          if(array_key_exists($item->id, $sekarang)){
            $keluar = $sekarang[$item->id]->jumlah_min;
            $masuk = $sekarang[$item->id]->jumlah_plus;
          }else{
            $masuk = 0;
            $keluar = 0;
          }
          if(array_key_exists($item->id, $awal))
            $stok_awal = $awal[$item->id];
          else
            $stok_awal = 0;

//          if($stok_awal + $masuk - $keluar -$item->stok_kadaluarsa != $item->stok) 
//          dd($item->stok, $stok_awal + $masuk - $keluar -$item->stok_kadaluarsa, $stok_awal, $masuk, $keluar, $item->stok_kadaluarsa);
          @endphp
        <tr>
          <td align="center">{{ $i++ }}</td>
          <td>{{$item->nama}}</td>
          <td align="center">{{$item->satuan}}</td>
          <td align="right">{{number_format($item->harga)}}</td>
          <td align="right">{{$stok_awal ? $stok_awal : 0}}</td>
          <td align="right">{{number_format($item->harga * $stok_awal)}}</td>
          <td align="right">{{$masuk ? $masuk : 0}}</td>
          <td align="right">{{number_format($masuk * $item->harga)}}</td>
          <td align="right">{{$keluar  ? $keluar  : 0}}</td>
          <td align="right">{{number_format($keluar  * $item->harga)}}</td>
          <td align="right">{{$item->stok_kadaluarsa  ? $item->stok_kadaluarsa  : 0}}</td>
          <td align="right">{{number_format($item->stok_kadaluarsa  * $item->harga)}}</td>
          <td align="right">{{$stok_awal + $masuk - $keluar - $item->stok_kadaluarsa }}</td>
          <td align="right">{{number_format($item->harga * ($stok_awal + $masuk - $keluar - $item->stok_kadaluarsa ))}}</td>
          <td align="center">{{ $item->kadaluarsa ? indonesian_date($item->kadaluarsa) : ""}}</td>
        </tr>
        @endforeach
        <!-- @for($i=1; $i<=48; $i++)
        <tr>
          <td align="center">{{ $i }}</td>
          <td>Chioramphenicol 250 mg (D)</td>
          <td align="center">Cap</td>
          <td align="right">231000</td>
          <td align="right">123.123.123</td>
          <td align="right">117000</td>
          <td align="right">125.647</td>
          <td align="right">13.000.000</td>
          <td align="right">13.900</td>
          <td align="right">100.000</td>
          <td align="right">-20809389</td>
          <td align="right">99800</td>
          <td align="right">100.000.000</td>
          <td align="center">300/200</td>
        </tr>
        @endfor -->
      </tbody>
    </table>
  </div>
</body>
</html>