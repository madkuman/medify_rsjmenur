<table>
  <thead>
          <tr>
            <th colspan="4">{{config('app.name')}}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <th colspan="4">DEPARTEMEN FARMASI</th>
          </tr>
          <tr>
            <th colspan="4">{{strtoupper(session('farmasi')->sluger)}}</th>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <th colspan="12">LAPORAN KEGIATAN KESEHATAN</th>
          </tr>
          <tr>
            <th colspan="12">BIDANG MATERIAL KESEHATAN {{config('app.name')}}</th>
          </tr>
          <tr>
            <th colspan="12">TANGGAL {{date('d F Y',strtotime($min_date))}} - {{date('d F Y',strtotime($max_date))}}</th>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <th rowspan="2">NO.</th>
            <th rowspan="2">NAMA MATERIAL KESEHATAN</th>
            <th rowspan="2">SAT</th>
            <th rowspan="2">HARGA SATUAN</th>
            <th colspan="2">PERSEDIAAN AWAL</th>
            <th colspan="2">PENERIMAAN</th>
            <th colspan="2">PEMAKAIAN</th>
            <th colspan="2">PERSEDIAAN AKHIR</th>
          </tr>
          <tr>
            <th>JUMLAH</th>
            <th>Rp</th>
            <th>JUMLAH</th>
            <th>Rp</th>
            <th>JUMLAH</th>
            <th>Rp</th>
            <th>JUMLAH</th>
            <th>Rp</th>
          </tr>

          @php $i=1 @endphp
          <?php $total_1=0; $total_2=0; $total_3=0; $total_4=0; ?>
          <?php $total_5=0; $total_6=0; $total_7=0; $total_8=0; ?>
          @foreach($items as $item)
          <tr>
            <td>{{ $i++ }}</td>
            <td>{{$item->item_detail->nama}}</td>
            <td>{{$item->item_detail->satuan}}</td>
            <td>{{number_format($item->item_detail->harga)}}</td>

            <td>{{$item->stok_awal ? $item->stok_awal : 0}}</td>
            <?php if($item->stok_awal) {$total_1+=$item->stok_awal;} ?>
            <td>{{number_format($item->item_detail->harga * $item->stok_awal)}}</td>
            <?php if($item->stok_awal) {$total_2+=$item->item_detail->harga * $item->stok_awal;} ?>
            <td>{{$item->masuk ? $item->masuk : 0}}</td>
            <?php if($item->masuk) {$total_3+=$item->masuk;} ?>
            <td>{{number_format($item->masuk * $item->item_detail->harga)}}</td>
            <?php if($item->masuk) {$total_4+=$item->masuk * $item->item_detail->harga;} ?>
            <td>{{$item->keluar ? $item->keluar : 0}}</td>
            <?php if($item->keluar) {$total_5+=$item->keluar;} ?>
            <td>{{number_format($item->keluar * $item->item_detail->harga)}}</td>
            <?php if($item->keluar) {$total_6+=$item->keluar * $item->item_detail->harga;} ?>
            <td>{{$item->stok_awal + $item->masuk - $item->keluar}}</td>
            <?php $total_7+=$item->stok_awal + $item->masuk - $item->keluar; ?>
            <td>{{number_format($item->item_detail->harga * ($item->stok_awal + $item->masuk - $item->keluar))}}</td>
            <?php $total_8+=$item->item_detail->harga * ($item->stok_awal + $item->masuk - $item->keluar); ?>

          </tr>
          @endforeach
          <tr>
            <td colspan="4">T O T A L</td>
            <td>{{number_format($total_1)}}</td>
            <td>{{number_format($total_2)}}</td>
            <td>{{number_format($total_3)}}</td>
            <td>{{number_format($total_4)}}</td>          
            <td>{{number_format($total_5)}}</td>
            <td>{{number_format($total_6)}}</td>
            <td>{{number_format($total_7)}}</td>
            <td>{{number_format($total_8)}}</td>
          </tr>
        </thead>
      </table>