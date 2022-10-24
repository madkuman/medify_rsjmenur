<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Resep Obat</title>
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
    <div class="rs-title text-center">
      {{config('app.name')}} <br> DEPARTEMEN FARMASI <br> {{strtoupper(session('farmasi')->sluger)}}
    </div>
  </div>
  <div class="mt-25">
    <div class="text-center header-title">
      <b>LAPORAN PEMBERIAN RESEP <br> TANGGAL {{date('d F Y',strtotime($min_date))}} - {{date('d F Y',strtotime($max_date))}}</b>
    </div>
  </div>
  <div class="mt-10">
    <table class="text-small">
      <tr>
        <td>No. RM</td>
        <td>:</td>
        <td>{{$pasien ? $pasien->no_rm : "-"}}</td>
      </tr>
      <tr>
        <td>Nama Pasien</td>
        <td>:</td>
        <td>{{$pasien ? $pasien->name : "-"}}</td>
      </tr>
    </table>
  </div>
  <div class="mt-10">
    <table class="table table-bordered text-small">
      <thead>
        <tr>
          <th align="center">NO.</th>
          <th align="center">KODE OBAT</th>
          <th align="center">NAMA OBAT</th>
          <th align="center">JUMLAH</th>
          <th align="center">ATURAN PAKAI</th>
        </tr>
      </thead>
      <tbody>
        @php $i=1 @endphp
        <?php $total_all=0 ?>
        @foreach($items as $row)
          <tr>
            <td colspan="2" class="br-white">
              <b>Tanggal : {{date('d-M-Y',strtotime($row->paid_at))}}</b>
            </td>
            <td colspan="1" class="br-white">
              <b>No. Resep : {{$row->final_detail->nomor_resep ? $row->final_detail->nomor_resep : "-"}}</b>
            </td>
            <td colspan="1" class="br-white">
              <b>Dari : {{$row->final_detail->owner_detail ? $row->final_detail->owner_detail->nama : "-"}}</b>
            </td>
            <td colspan="1">
              <b>Dokter : {{$row->created_by_detail->name}}</b>
            </td>
          </tr>
          @foreach($row->final_detail->resep_detail as $res)
            <tr>
              <td align="center">{{$i++}}</td>
              <td align="center">{{$res->obat_detail ? $res->obat_detail->item_detail->kode : ""}}</td>
              <td>{{$res->nama_obat}}</td>
              @php $total=0 @endphp
              @if($res->tipe) @php $total=$res->jumlah @endphp
              @else
                @foreach($res->log as $log)
                  @php $total += $log->jumlah; $total -= $log->jumlah_retur @endphp
                @endforeach
              @endif
              <td align="center">{{$total}}</td>
              <?php $total_all+= $total ?>
              <td align="center">{{$res->aturan}}</td>
            </tr>
          @endforeach
        @endforeach
        <tr>
          <td align="center" colspan="3" style="font-weight: bold;">T O T A L</td>
          <td align="center">{{number_format($total_all)}}</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html> 