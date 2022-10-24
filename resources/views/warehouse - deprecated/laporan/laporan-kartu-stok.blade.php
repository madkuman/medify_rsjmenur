<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Stok</title>
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
      <b>LAPORAN STOK <br> GUDANG FARMASI {{config('app.name')}}</b>
    </div>
  </div>
  <div class="mt-10">
    <table class="text-small">
      <tr>
        <td>Kode Obat</td>
        <td>:</td>
        <td>{{$item->kode ? $item->kode : "-"}}</td>
      </tr>
      <tr>
        <td>Nama Obat</td>
        <td>:</td>
        <td>{{$item->nama}}</td>
      </tr>
      <tr>
        <td>Satuan</td>
        <td>:</td>
        <td>{{$item->satuan}}</td>
      </tr>
    </table>
  </div>
  <div class="mt-10">
    <table class="table table-bordered text-small">
      <thead>
        <tr>
          <th align="center" width="50px">NO.</th>
          <th align="center" width="100px">TANGGAL</th>
          <th align="center">JENIS TRANSAKSI</th>
          <th align="center" width="80px">MASUK</th>
          <th align="center" width="80px">KELUAR</th>
          <th align="center" width="80px">STOK</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td>Stok Awal</td>
          <td></td>
          <td></td>
          <td align="right">{{$items->stok_awal}}</td>
        </tr>
        @php $i=1;$masuk=0;$keluar=0;$total=$items->stok_awal @endphp
        @foreach($items as $row)
        <tr>
          <td align="center">{{ $i++ }}</td>
          <td align="center">{{ $row->tanggal ? date('d-m-y', strtotime($row->tanggal)) : date('d-m-y', strtotime($row->created_at))}}</td>
          <td>
            @if($row->pengadaan_id) 
              Penerimaan Obat dari {{$row->detail_pengadaan->supplier_detail ? $row->detail_pengadaan->supplier_detail->nama : "-"}}
            @elseif($row->penghapusan_id) Penghapusan Obat
            @else
              @if($row->detail_distribusi->kategori=="Kiriman") 
                @if($row->detail_distribusi->deskripsi == 'Stok Opname')
                Stok Opname
                @else
                {{$row->detail_distribusi->kategori}} ke {{$row->detail_distribusi->farmasi_detail->nama ?? '-'}}
                @endif
              @else 
                {{$row->detail_distribusi->kategori ?? ''}} dari {{$row->detail_distribusi->farmasi_detail->nama}}
              @endif
            @endif
          </td>
          <td align="right">
            @if($row->pengadaan_id) 
              {{$row->jumlah}}
              @php $total += $row->jumlah; $masuk += $row->jumlah @endphp
            @elseif($row->distribusi_id)
              @if($row->detail_distribusi->tipe==1)
                {{$row->jumlah}}
                @php $total += $row->jumlah; $masuk += $row->jumlah @endphp
              @endif
            @endif
          </td>
          <td align="right">
            @if($row->penghapusan_id) 
              {{$row->jumlah}}
              @php $total -= $row->jumlah; $keluar += $row->jumlah @endphp
            @elseif($row->distribusi_id)  
              @if($row->detail_distribusi->tipe==-1) 
                {{$row->jumlah}}
                @php $total -= $row->jumlah; $keluar += $row->jumlah @endphp
              @endif
            @endif
          </td>
          <td align="right">{{$total}}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td align="center" colspan="3">Total</td>
          <td align="right">{{$masuk}}</td>
          <td align="right">{{$keluar}}</td>
          <td align="right"></td>
        </tr>
      </tfoot>
    </table>
  </div>
</body>
</html>