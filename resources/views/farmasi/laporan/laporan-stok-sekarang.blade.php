<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Stok Opname</title>
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
     {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> {{strtoupper(session('farmasi')->sluger)}}
    </div>
  </div>
  <div class="mt-25">
    <div class="text-center header-title">
      <b>LAPORAN STOK <br> FARMASI {{session('farmasi')->sluger}} {{config('app.name')}} <br> TGL {{indonesian_date($date)}}</b>
    </div>
  </div>
  <div class="mt-25">
    <table class="table table-bordered text-small">
      <thead>
        <tr>
          <th align="center" width="40px">NO.</th>
          <th align="center" width="230px">NAMA MATERIAL</th>
          <th align="center" width="40px">SAT</th>
          <th align="center" width="80px">HARGA SATUAN</th>
          <th align="center" width="80px">STOK</th>
          <th align="center" width="100px">HARGA TOTAL</th>
          <th align="center" width="70px">ED</th>
          <th align="center" width="60px">KET</th>
        </tr>
      </thead>
      <tbody>
        @php $i=1 @endphp
        <?php $total_1=0; $total_2=0; ?>
        @foreach($items as $item)
          <tr>
            <td align="center">{{ $i++ }}</td>
            <td>{{$item['item_detail']['nama']}}</td>
            <td align="center">{{$item['item_detail']['satuan']}}</td>
            <td align="right">{{number_format($item['item_detail']['harga'])}}</td>
            <td align="right">{{$item['stok']['aggregate']}}</td>
            <?php $total_1+=$item['stok']['aggregate']; ?>
            <td align="right">{{number_format($item['stok']['aggregate'] * $item['item_detail']['harga'])}}</td>
            <?php $total_2+=$item['stok']['aggregate']*$item['item_detail']['harga']; ?>
            <td align="center">{{ $item['kadal']['kadal'] ? indonesian_date($item['kadal']['kadal']) : ""}}</td>
            <td align="center">{{ $item['stok']['aggregate'] ? "BAIK" : ""}}</td>
          </tr>
          {{-- @forelse($item->items_available as $ava)
            <tr>
              <td align="center">{{ $i++ }}</td>
              <td>{{$item->item_detail->nama}}</td>
              <td align="center">{{$item->item_detail->satuan}}</td>
              <td align="right">{{number_format($item->item_detail->harga)}}</td>
              <td align="right">{{$ava->jumlah_sedia}}</td>
              <td align="right">{{number_format($ava->jumlah_sedia * $item->item_detail->harga)}}</td>
              <td align="center">{{ $ava->kadaluarsa ? date('m/y', strtotime($ava->kadaluarsa)) : ""}}</td>
              <td align="center">BAIK</td>
            </tr>
          @empty
            <tr>
              <td align="center">{{ $i++ }}</td>
              <td>{{$item->item_detail->nama}}</td>
              <td align="center">{{$item->item_detail->satuan}}</td>
              <td align="right">{{number_format($item->item_detail->harga)}}</td>
              <td align="right">{{$item->stok}}</td>
              <td align="right">{{number_format($item->stok * $item->item_detail->harga)}}</td>
              <td align="center">{{ $item->minimal_kadaluarsa ? date('m/y', strtotime($item->minimal_kadaluarsa)) : ""}}</td>
              <td align="center">{{ $item->stok ? "BAIK" : ""}}</td>
            </tr>
          @endforelse --}}
        @endforeach
        <tr>
          <td align="center" colspan="4" style="font-weight: bold;">T O T A L</td>
          <td align="right">{{number_format($total_1)}}</td>
          <td align="right">{{number_format($total_2)}}</td>
          <td></td>
          <td></td>
        </tr>
        <!-- @for($i=1; $i<=48; $i++)
        <tr>
          <td align="center">{{ $i }}</td>
          <td>Alpertin 100 mg (Gabapentin)</td>
          <td align="center">Tab</td>
          <td align="right">30.000</td>
          <td align="right">30.000</td>
          <td align="right">121.151.800</td>
          <td align="center">123/360</td>
          <td align="center">BAIK</td>
        </tr>
        @endfor -->
      </tbody>
    </table>
  </div>
</body>
</html>