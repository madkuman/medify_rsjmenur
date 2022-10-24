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
      {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> {{strtoupper(session('farmasi')->sluger)}}
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
          <th align="center" colspan="2">STOK AWAL</th>
          <th align="center" colspan="2">PENERIMAAN</th>
          <th align="center" colspan="2">PEMAKAIAN</th>
          <th align="center" colspan="2">KADALUARSA</th>
          <th align="center" colspan="2">STOK AKHIR</th>
        </tr>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th align="center">JUMLAH</th>
          <th align="center">Rp</th>
          <th align="center">JUMLAH</th>
          <!-- <th align="center">HARGA SATUAN</th> -->
          <th align="center">Rp</th>
          <th align="center">JUMLAH</th>
          <!-- <th align="center">HARGA SATUAN</th> -->
          <th align="center">Rp</th>
          <th align="center">JUMLAH</th>
          <th align="center">Rp</th>
          <th align="center">JUMLAH</th>
          <th align="center">Rp</th>
        </tr>
      </thead>
      <tbody>
        @php $i=1 @endphp
        <?php $total_1=0; $total_2=0; $total_3=0; $total_4=0; ?>
        <?php $total_5=0; $total_6=0; $total_7=0; $total_8=0; ?>
        <?php $total_9=0; $total_10=0;?>
        @foreach($dilaporkan as $key => $lapor)
        <tr>
          <td align="center">{{ $i++ }}</td>
          <td>{{$items[$key]->item_detail->nama ?? dd($lapor, $key)}}</td>
          <td align="center">{{$items[$key]->item_detail->satuan ?? '-'}}</td>
          <td align="right">{{number_format($items[$key]->item_detail->harga ?? 0)}}</td>
          <td align="right">
            @php($awal = number_format((($items[$key]->stok ?? 0) + ($items[$key]->stok_kadaluarsa ?? 0) - ($lapor->jumlah) - ($luar_laporan[$key]->jumlah ?? 0)), 2, '.', ''))
            {{$awal}}
          </td>
          <?php if(isset($awal)) $total_1+=$awal ?>
          <td align="right">{{isset($awal) ? number_format(($items[$key]->item_detail->harga ?? 0) * $awal) : 0}}</td>
          <?php if(isset($awal)) {$total_2+=$items[$key]->item_detail->harga * $awal;} ?>
          <td align="right">{{$lapor->jumlah_plus ?? 0}}</td>
          <?php if(isset($lapor->jumlah_plus)) $total_3+=$lapor->jumlah_plus ?>
          <td align="right">{{number_format(($lapor->jumlah_plus ?? 0) * $items[$key]->item_detail->harga)}}</td>
          <?php if(isset($lapor->jumlah_plus)) {$total_4+=$lapor->jumlah_plus * $items[$key]->item_detail->harga;} ?>
          <td align="right">{{$lapor->jumlah_min ?? 0}}</td>
          <?php if(isset($lapor->jumlah_min)) {$total_5+= ($lapor->jumlah_min ?? 0);} ?>
          <td align="right">{{number_format(($lapor->jumlah_min ?? 0) * $items[$key]->item_detail->harga)}}</td>
          <?php if(isset($lapor->jumlah_min)) {$total_6+=$lapor->jumlah_min * $items[$key]->item_detail->harga;} ?>

          @php($kadaluarsa = ($items[$key]->stok_kadaluarsa ?? 0))
          <td align="right">{{ $kadaluarsa}}</td>
          <?php $total_7+= $kadaluarsa; ?>
          <td align="right">{{number_format($items[$key]->item_detail->harga * ($kadaluarsa))}}</td>
          <?php $total_8+=$items[$key]->item_detail->harga * ($kadaluarsa); ?>

          @php($akhir = ($items[$key]->stok ?? 0) - ($luar_laporan[$key]->jumlah ?? 0))
          <td align="right">{{ $akhir}}</td>
          <?php $total_9+= $akhir; ?>
          <td align="right">{{number_format($items[$key]->item_detail->harga * ($akhir))}}</td>
          <?php $total_10+=$items[$key]->item_detail->harga * ($akhir); ?>
        </tr>
        @endforeach
        <tr>
          <td align="center" colspan="4" style="font-weight: bold;">T O T A L</td>
          <td align="right">{{number_format($total_1)}}</td>
          <td align="right">{{number_format($total_2)}}</td>
          <td align="right">{{number_format($total_3)}}</td>
          <td align="right">{{number_format($total_4)}}</td>          
          <td align="right">{{number_format($total_5)}}</td>
          <td align="right">{{number_format($total_6)}}</td>
          <td align="right">{{number_format($total_7)}}</td>
          <td align="right">{{number_format($total_8)}}</td>
          <td align="right">{{number_format($total_9)}}</td>
          <td align="right">{{number_format($total_10)}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>