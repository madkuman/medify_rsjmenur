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
            <th></th>
        </tr>
        <tr>
            <th colspan="8">LAPORAN STOK OPNAME</th>
        </tr>
        <tr>
            <th colspan="8">GUDANG FARMASI {{config('app.name')}}</th>
        </tr>
        <tr>
            <th colspan="8">TANGGAL {{date('d F Y',strtotime($date))}}</th>
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
          <th>KET</th>
        </tr>

        @php $i=1 @endphp
        @foreach($items as $item)
          <tr>
            <td>{{ $i++ }}</td>
            <td>{{$item->nama}}</td>
            <td>{{$item->satuan}}</td>
            <td>{{number_format($item->harga)}}</td>
            <td>{{$item->stok_awal}}</td>
            <td>{{number_format($item->stok_awal * $item->harga)}}</td>
            <td>{{ $item->kadal ? date('m/y', strtotime($item->kadal)) : ""}}</td>
            <td>{{ $item->stok_awal ? "BAIK" : ""}}</td>
          </tr>
        @endforeach
    </thead>
</table>