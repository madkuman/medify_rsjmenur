<table>
    <tr>
        <td colspan="5">BARANG LOW STOCK</td>
    </tr>
    <tr>
        <td colspan="5">{{strtoupper(session('farmasi')->nama)}}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td>No.</td>
        <td>Nama Barang</td>
        <td>Minimal Stok</td>
        <td>Stok</td>
        <td>Harga</td>
    </tr>
    @foreach ($data as $item)    
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->item_template->nama }}</td>
            <td>{{ $item->min_stok }}</td>
            <td>{{ $item->stok }}</td>
            <td>{{ number_format($item->harga) }}</td>
        </tr>
    @endforeach
</table>