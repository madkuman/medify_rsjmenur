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
            <th colspan="4">GUDANG FARMASI</th>
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
          <th colspan="2">PERSEDIAAN AWAL</th>
          <th colspan="2">TERIMA BULAN</th>
          <th colspan="2">KELUAR BULAN</th>
          <th rowspan="2">STOK AKHIR</th>
          <th rowspan="2">HARGA TOTAL</th>
          <th rowspan="2">ED</th>
        </tr>
        <tr>
          <th>QUANTITY</th>
          <th>HARGA SATUAN</th>
          <th>QUANTITY</th>
          <th>JML HARGA</th>
          <th>QUANTITY</th>
          <th>JML HARGA</th>
        </tr>

        @php $i=1 @endphp
        @foreach($items as $item)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{$item->nama}}</td>
          <td>{{$item->satuan}}</td>
          <td>{{$item->stok_awal ? $item->stok_awal : 0}}</td>
          <td>{{number_format($item->harga)}}</td>
          <td>{{$item->masuk ? $item->masuk : 0}}</td>
          <td>{{number_format($item->masuk * $item->harga)}}</td>
          <td>{{$item->keluar ? $item->keluar : 0}}</td>
          <td>{{number_format($item->keluar * $item->harga)}}</td>
          <td>{{$item->stok_awal + $item->masuk - $item->keluar}}</td>
          <td>{{number_format($item->harga * ($item->stok_awal + $item->masuk - $item->keluar))}}</td>
          <td>{{ $item->kadaluarsa ? date('m/y', strtotime($item->kadaluarsa)) : ""}}</td>
        </tr>
        @endforeach
    </thead>
</table>