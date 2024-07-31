<table>
    <thead>
    <tr>
        <td></td>
    </tr>
    <tr>
        <th colspan="{{$count_column}}">LAPORAN BPK SUMBER DANA</th>
    </tr>
    <tr>
        <th colspan="{{$count_column}}">TAHUN : {{$tahun}}</th>
    </tr>
    <tr>
        <th colspan="{{$count_column}}">SUMBER DANA : {{$sumber_dana_nama}}</th>
    </tr>
    <tr>
        <th colspan="{{$count_column}}">KATEGORI : {{$kategori_names}}</th>
    </tr>
    <tr>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th rowspan="2">NO</th>
        <th rowspan="2">NAMA BARANG</th>
        <th rowspan="2">STOK AWAL</th>
        <th colspan="5">DANA {{$sumber_dana_nama}}</th>
        <th rowspan="2">SISA STOK</th>
        <th rowspan="2">HARGA</th>
        <th rowspan="2">TOTAL HARGA</th>
        <th rowspan="2">KETERANGAN</th>
    </tr>
    <tr>
        <td>MASUK</td>
        <td>KELUAR</td>
        <td>RETUR</td>
        <td>PEMAKAIAN</td>
        <td>PENYESUAIAN</td>
    </tr>
    @php $start = 9; $row = 9; @endphp
    @foreach($data as $index => $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item['nama']}}</td>
            <td>{{$item['stok_awal']}}</td>
            <td>{{$item['masuk']}}</td>
            <td>{{$item['keluar']}}</td>
            <td>{{$item['retur']}}</td>
            <td>{{$item['pemakaian']}}</td>
            <td>{{$item['penyesuaian']}}</td>
            <td>{{$item['sisa']}}</td>
            <td>{{$item['harga']}}</td>
            <td>=I{{$row}}*J{{$row}}</td>
        </tr>
        @php $row++ @endphp
    @endforeach
    <tr>
        <td colspan="{{$count_column - 2}}">TOTAL HARGA</td>
        <td>=SUM(K{{$start}}:K{{$row - 1}})</td>
    </tr>
    </tbody>
</table>
