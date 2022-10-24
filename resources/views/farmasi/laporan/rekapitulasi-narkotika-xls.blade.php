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
      <th></th>
      <th></th>
    </tr>
    <tr>
      <th colspan="10">REKAPITULASI LAPORAN {{$kategori}}</th>
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
      <th colspan="10">Nama Unit Layanan : Gudang Farmasi Rumah Sakit {{config('app.name')}}</th>
    </tr>
    <tr>
      <th colspan="10">Provinsi, Kabupaten/Kota : Jawa Timur, Kota Surabaya</th>
    </tr>
    <tr>
      <th colspan="10">Tahun : {{date('Y')}}</th>
    </tr>
    <tr>
      <th colspan="10">Tanggal : {{date('d F',strtotime($min_date))}} - {{date('d F',strtotime($max_date))}}</th>
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
      <th rowspan="2">NAMA</th>
      <th rowspan="2">SAT</th>
      <th rowspan="2">STOK AWAL</th>
      <th colspan="2">PEMASUKAN</th>
      <th colspan="4">PENGELUARAN</th>
      <th rowspan="2">STOK AKHIR</th>
    </tr>
    <tr>
      <th>PBF</th>
      <th>SARANA</th>
      <th>PBF</th>
      <th>RESEP</th>
      <th>SARANA</th>
      <th>PEMUSNAHAN</th>
    </tr>

    @php $i=1 @endphp
    <?php $total_1=0; $total_2=0; $total_3=0; $total_4=0; ?>
    <?php $total_5=0; $total_6=0; $total_7=0; $total_8=0; ?>
    @foreach($items as $item)
    <tr>
      <td>{{ $i++ }}</td>
      <td>{{$item->item_detail->nama}}</td>
      <td>{{$item->item_detail->satuan}}</td>
      <td>{{$item->stok_awal ? $item->stok_awal : 0}}</td>
      <?php if($item->stok_awal) {$total_1+=$item->stok_awal;} ?>
      <td>{{$item->masuk ? $item->masuk : 0}}</td>
      <?php if($item->masuk) {$total_2+=$item->masuk;} ?>
      <td>0</td>
      <?php $total_3+=0 ?>
      <td>{{$item->keluar ? $item->keluar : 0}}</td>
      <?php if($item->keluar) {$total_4+=$item->keluar;} ?>
      <td>{{$item->resep ? $item->resep : 0}}</td>
      <?php if($item->resep) {$total_5+=$item->resep;} ?>
      <td>0</td>
      <?php $total_6+=0 ?>
      <td>{{$item->hapus ? $item->hapus : 0}}</td>
      <?php if($item->hapus) {$total_7+=$item->hapus;} ?>
      <td>{{$item->stok_awal + $item->masuk - $item->keluar - $item->hapus}}</td>
      <?php $total_8+=$item->stok_awal + $item->masuk - $item->keluar - $item->hapus; ?>
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