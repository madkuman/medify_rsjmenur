<table>
  <thead>
    <tr>
      <th colspan="4">{{config('app.name')}}</th>
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
    </tr>
    <tr>
      <th colspan="11">LAPORAN PENGELUARAN OBAT {{session('farmasi')->sluger}}</th>
    </tr>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <th colspan="11">Tanggal : {{date('d F Y',strtotime($min_date))}} sampai {{date('d F Y',strtotime($max_date))}}</th>
    </tr>
    <tr>
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
      <th rowspan="2">KODE OBAT</th>
      <th rowspan="2">NAMA OBAT</th>
      <th colspan="2">JUMLAH</th>
      <th colspan="2">INACBG</th>
      <th colspan="2">23 HARI</th>
      <th colspan="2">DUK RS</th>
    </tr>
    <tr>
      <th>JML</th>
      <th>HARGA</th>
      <th>JML</th>
      <th>HARGA</th>
      <th>JML</th>
      <th>HARGA</th>
      <th>JML</th>
      <th>HARGA</th>
    </tr>

    @php $i=1 @endphp
    <?php $total_1=0; $total_2=0; $total_3=0; $total_4=0; ?>
    <?php $total_5=0; $total_6=0; $total_7=0; $total_8=0; ?>
    @foreach($items as $row)
    <tr>
      <td>{{ $i++ }}</td>
      <td>{{$row->item_detail->kode}}</td>
      <td>{{$row->item_detail->nama}}</td>
      <td>{{$row->jumlah ? $row->jumlah : 0}}</td>
      <?php if($row->jumlah) {$total_1+=$row->jumlah;} ?>
      <td>{{number_format($row->jumlah * $row->item_detail->harga)}}</td>
      <?php if($row->jumlah) {$total_2+=$row->jumlah * $row->item_detail->harga;} ?>
      <td>{{$row->hari7 ? $row->hari7 : 0}}</td>
      <?php if($row->hari7) {$total_3+=$row->hari7;} ?>
      <td>{{number_format($row->hari7 * $row->item_detail->harga)}}</td>
      <?php if($row->hari7) {$total_4+=$row->hari7 * $row->item_detail->harga;} ?>
      <td>{{$row->hari23 ? $row->hari23 : 0}}</td>
      <?php if($row->hari23) {$total_5+=$row->hari23;} ?>
      <td>{{number_format($row->hari23 * $row->item_detail->harga)}}</td>
      <?php if($row->hari23) {$total_6+=$row->hari23 * $row->item_detail->harga;} ?>
      <td>{{$row->dukunganrs ? $row->dukunganrs : 0}}</td>
      <?php if($row->dukunganrs) {$total_7+=$row->dukunganrs;} ?>
      <td>{{number_format($row->dukunganrs * $row->item_detail->harga)}}</td>
      <?php if($row->dukunganrs) {$total_8+=$row->dukunganrs * $row->item_detail->harga;} ?>
    </tr>
    @endforeach
    <tr>
      <td colspan="3">T O T A L</td>
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