<table>
    <thead>
        <tr>
            <th colspan="4">DEPARTEMEN FARMASI</th>
        </tr>
        <tr>
            <th colspan="4">{{strtoupper(session('farmasi')->nama)}}</th>
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
            <th></th>
        </tr>
        <tr>
            <th colspan="8">LAPORAN STOK OPNAME</th>
        </tr>
        <tr>
            <th colspan="8">{{strtoupper(session('farmasi')->nama)}} {{strtoupper(config('app.name'))}}</th>
        </tr>
        <tr>
            <th colspan="8">TANGGAL {{date('d F Y',strtotime($min_date))}}</th>
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
        </tr>
        <tr>
          <th>NO.</th>
          <th>NAMA MATERIAL</th>
          <th>SAT</th>
          <th>HARGA SATUAN</th>
          <th>STOK AKHIR</th>
          <th>HARGA TOTAL</th>
          <th>ED</th>
          <th></th>
        </tr>

        @php $i=1 @endphp
        <?php $total_1=0; $total_2=0; ?>
        @foreach($items as $item)
          <tr>
              <td align="center">{{ $i++ }}</td>
              <td>{{$item['nama']}}</td>
              <td align="center">{{$item['satuan']}}</td>
              <td align="right">{{number_format($item['harga'])}}</td>
              <td align="right">{{$item['stok'] ?? 0}}</td>
              <?php $total_1+=$item['stok']; ?>
              <td align="right">{{number_format($item['stok'] * $item['harga'])}}</td>
              <?php $total_2+=$item['stok'] * $item['harga']; ?>
              <td align="center">{{ $item ? indonesian_date($item['kadaluarsa']) : ""}}</td>
              <td></td>
          </tr>
        @endforeach
        <tr>
          <td colspan="4">T O T A L</td>
          <td>{{number_format($total_1)}}</td>
          <td>{{number_format($total_2)}}</td>
          <td></td>
          <td></td>
        </tr>
    </thead>
</table>