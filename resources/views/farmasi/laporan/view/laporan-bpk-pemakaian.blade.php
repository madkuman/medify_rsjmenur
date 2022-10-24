<table>
    <thead>
    <tr>
        <td></td>
    </tr>
    <tr>
        <th colspan="{{$count_column}}">LAPORAN PEMAKAIAN {{$sumber_dana->nama}}</th>
    </tr>
    <tr>
        <th colspan="{{$count_column}}">TAHUN : {{$tahun}}</th>
    </tr>
    <tr>
        <th colspan="{{$count_column}}"></th>
    </tr>
    <tr>
        <th colspan="{{$count_column}}"></th>
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
        <th colspan="12">DANA {{$sumber_dana->nama}}</th>
        <th rowspan="2">TOTAL</th>
        <th rowspan="2">HARGA SATUAN</th>
        <th rowspan="2">TOTAL HARGA</th>
    </tr>
    <tr>
        @foreach($bulan as $bul)
            <td>{{$bul}}</td>
        @endforeach
    </tr>
    @php $start = 9; $row = 9; @endphp
    @foreach($data as $index => $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item['nama']}}</td>
            <td>{{$item['stok_awal']}}</td>
            @foreach($bulan as $bul)
                <td>{{$item[$bul]}}</td>
            @endforeach
            <td>=SUM(D{{$row}}:O{{$row}})</td>
            <td>{{$item['harga']}}</td>
            <td>=P{{$row}}*Q{{$row}}</td>
        </tr>
        @php $row++ @endphp
    @endforeach
    <tr>
        <td colspan="{{$count_column - 1}}">TOTAL HARGA</td>
        <td>=SUM(R{{$start}}:R{{$row - 1}})</td>
    </tr>
    </tbody>
</table>
