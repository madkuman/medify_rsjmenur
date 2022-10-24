<table>
    <thead>
        <tr>
            <th colspan="4">{{config('app.name')}}/th>
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
        </tr>
        <tr>
            <th colspan="6">LAPORAN PEMAKAIAN OBAT {{$kategori}}</th>
        </tr>
        <tr>
            <th colspan="6">UNIT PELAYANAN FARMASI {{session('farmasi')->sluger}}</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th colspan="6">Tanggal : {{date('d F Y',strtotime($min_date))}} sampai {{date('d F Y',strtotime($max_date))}}</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
          <th>NO.</th>
          <th>KODE OBAT</th>
          <th>NAMA OBAT</th>
          <th>SATUAN</th>
          <th>JUMLAH</th>
          <th>HARGA</th>
      </tr>

      @php $i=1 @endphp
      <?php $total_1=0; $total_2=0; ?>
      @foreach($items as $row)
      <tr>
          <td>{{ $i++ }}</td>
          <td>{{$row->item_detail->kode}}</td>
          <td>{{$row->item_detail->nama}}</td>
          <td>{{$row->item_detail->satuan}}</td>
          <td>{{$row->jumlah}}</td>
          <?php $total_1+=$row->jumlah; ?>
          <td>{{number_format($row->harga)}}</td>
          <?php $total_2+=$row->harga; ?>
      </tr>
      @endforeach
      <tr>
        <td colspan="4">T O T A L</td>
        <td>{{number_format($total_1)}}</td>
        <td>{{number_format($total_2)}}</td>
    </tr>
</thead>
</table>