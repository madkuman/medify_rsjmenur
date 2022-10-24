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
            <th colspan="10">LAPORAN PENERIMAAN</th>
        </tr>
        <tr>
            <th colspan="10">GUDANG FARMASI {{config('app.name')}}</th>
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
            <th colspan="10">Tanggal Terima: {{date('d-m-y',strtotime($min_date))}} sampai {{date('d-m-y',strtotime($max_date))}}</th>
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
          <th>NO.</th>
          <th>KODE OBAT</th>
          <th>NAMA OBAT</th>
          <th>TANGGAL TERIMA</th>
          <th>NO. FAKTUR</th>
          <th>TANGGAL FAKTUR</th>
          <th>PRODUSEN</th>
          <th>JUMLAH</th>
          <th>HARGA</th>
          <th>TANGGAL EXPIRED</th>
        </tr>

        @php $i=1 @endphp
        @foreach($items as $item)
          <tr>
            <td align="center">{{ $i++ }}</td>
            <td align="center">{{$item->detail_item->detail_item->kode}}</td>
            <td>{{$item->detail_item->detail_item->nama}}</td>
            <td align="center">{{ $item->tanggal ? date('d-m-y', strtotime($item->tanggal)) : ""}}</td>
            <td align="right">{{ $item->detail_pengadaan->nomor_referensi ? $item->detail_pengadaan->nomor_referensi : ""}}</td>
            <td align="center">{{ $item->detail_pengadaan->tanggal_faktur ? date('d-m-y', strtotime($item->detail_pengadaan->tanggal_faktur)) : ""}}</td>
            <td align="center">{{ $item->detail_pengadaan->supplier_detail ? $item->detail_pengadaan->supplier_detail->nama : ""}}</td>
            <td align="center">{{ $item->jumlah }}</td>
            <td align="center">{{ number_format($item->detail_item->detail_item->harga) }}</td>
            <td align="center">{{ $item->detail_item ? date('d-m-y', strtotime($item->detail_item->kadaluarsa)) : ""}}</td>
          </tr>
        @endforeach
    </thead>
</table>