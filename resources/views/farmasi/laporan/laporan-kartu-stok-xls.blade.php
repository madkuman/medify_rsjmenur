<table>
    <tr>
        <td rowspan="2" colspan="2">{{strtoupper(config('app.name'))}}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td colspan="6">KARTU STOK</td>
    </tr>
    <tr>
        <td colspan="6">{{strtoupper(session('farmasi')->nama)}}</td>
    </tr>
    <tr>
        <td>Nama Barang</td>
        <td>: {{$item->item_detail->nama}}</td>
    </tr>
    <tr>
        <td>Satuan</td>
        <td>: {{$item->item_detail->satuan}}</td>
    </tr>
    <tr>
        <td colspan="6"></td>
    </tr>
    <tr>
        <td>TANGGAL</td>
        <td>NAMA/RM</td>
        <td>MASUK</td>
        <td>KELUAR</td>
        <td>SISA</td>
        <td>KET.</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{number_format($stok_awal,1)}}</td>
        <td>Stok Awal</td>
    </tr>
    @php $i=1;$masuk=0;$keluar=0;$total=$stok_awal @endphp
    @foreach($riwayat as $row)
        <tr>
            <td>{{ date('d-m-y', strtotime($row->created_at))}}</td>
            <td>@if($row->nomor_rm != 0) {{$row->nama}} / {{$row->nomor_rm}} @endif</td>
            <td>
                {{number_format($row->jumlah_plus,1)}}
            </td>
            <td>
                {{number_format($row->jumlah_min,1)}}
            </td>
            @php $total -= $row->jumlah_min; $keluar += $row->jumlah_min @endphp
            @php $total += $row->jumlah_plus; $masuk += $row->jumlah_plus @endphp
            <td>{{number_format($total,1)}}</td>
            <td>@if($row->nomor_rm == 0) {{$row->nama}} @endif</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2">Total</td>
        <td>{{number_format($masuk,1)}}</td>
        <td>{{number_format($keluar,1)}}</td>
        <td></td>
        <td></td>
    </tr>
</table>