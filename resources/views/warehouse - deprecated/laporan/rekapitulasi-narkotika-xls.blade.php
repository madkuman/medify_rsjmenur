<table>
    <thead>
        <tr>
            <th colspan="4">{{config('app.name')}}</th>
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
            <th colspan="10">Nama Unit Layanan : Gudang Farmasi {{config('app.name')}}</th>
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
          <th colspan="3">PENGELUARAN</th>
          <th rowspan="2">STOK AKHIR</th>
        </tr>
        <tr>
          <th>PBF</th>
          <th>SARANA</th>
          <th>PBF</th>
          <th>SARANA</th>
          <th>PEMUSNAHAN</th>
        </tr>

        @php $i=1 @endphp
        @foreach($items as $item)
        <tr>
          <td>{{ $i++ }}</td>
          <td>{{$item->nama}}</td>
          <td>{{$item->satuan}}</td>
          <td>{{$item->stok_awal ? $item->stok_awal : 0}}</td>
          <td>{{$item->masuk ? $item->masuk : 0}}</td>
          <td>0</td>
          <td>{{$item->keluar ? $item->keluar : 0}}</td>
          <td>0</td>
          <td>{{$item->hapus ? $item->hapus : 0}}</td>
          <td>{{$item->stok_awal + $item->masuk - $item->keluar - $item->hapus}}</td>
        </tr>
        @endforeach
    </thead>
</table>