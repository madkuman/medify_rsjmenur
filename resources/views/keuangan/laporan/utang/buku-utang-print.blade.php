<table>
    <thead>
        <tr>
            <th colspan="3">{{config('app.name')}}</th>
        </tr>
        <tr>
            <th colspan="3" style="text-decoration: underline;">BENDAHARA DANA YANMASUM</th>
        </tr>
        <tr>
            <th colspan="9">BUKU HUTANG DANA BPJS {{config('app.name')}}</th>                            
        </tr>
        <tr>
            <th colspan="9">TAHUN ANGGARAN {{$tahun}}</th>                            
        </tr>
        <tr>
            <th colspan="9" style="text-transform: uppercase;">BULAN : {{$bulan}}</th>                            
        </tr>
        <tr>
            <th colspan="9">&nbsp;</th>
        </tr>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Perusahaan</th>
            <th colspan="3">Utang</th>
            <th colspan="3">Pembayaran</th>
            <th rowspan="2">Sisa Utang  </th>
        </tr>
        <tr>
            <th>Utang Bulan Lalu</th>
            <th>Utang Bulan Ini</th>
            <th>Utang Saldo</th>
            <th>Pembayaran Bulan Lalu  </th>
            <th>Pembayaran Bulan Ini  </th>
            <th>Pembayaran Saldo  </th>
        </tr>
    </thead>
    <tbody>
        @foreach($perusahaan as $item)
        <tr>
            <td scope="row">{{$loop->iteration}}</td>
            <td>{{$item->nama}}</td>
            <td>{{$item->utang_bulan_lalu}}</td>
            <td>{{$item->utang_bulan_ini}}</td>
            <td>{{$item->utang_sd_bulan_ini}}</td>
            <td>{{$item->pembayaran_bulan_lalu}}</td>
            <td>{{$item->pembayaran_bulan_ini}}</td>
            <td>{{$item->pembayaran_sd_bulan_ini}}</td>
            <td>{{$item->sisa_utang}}</td>
        </tr>
        @endforeach
    </tbody>
</table>