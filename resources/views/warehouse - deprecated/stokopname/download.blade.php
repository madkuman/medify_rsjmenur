<table>
    <tbody>
        <tr>
            <td colspan="8">Laporan Stok Opname #{{$stokopname->slug}}</td>
        </tr>
        <tr>
            <td colspan="8">Dibuat Oleh {{$stokopname->created_by_detail->name}}</td>
        </tr>
        <tr>
            <td>No</td>
            <td>Nama Material</td>
            <td>Satuan</td>
            <td>Harga Satuan</td>
            <td>Jumlah</td>
            <td>ED</td>
            <td>Ket</td>
            <td>Harga Total</td>
        </tr>
        @php $i=1; $total = 0;@endphp
        @forelse($barang as $row)
        @if($row['sebenarnya'] == 0)
        @continue
        @endif
        <tr>
            <td>{{$i}}</td>
            <td>{{$row['nama']}}</td>
            <td>{{$row['satuan']}}</td>
            <td>Rp {{number_format($row['harga'])}}</td>
            <td>{{$row['sebenarnya']}}</td>
            <td>{{date('d F Y', strtotime($row['kadaluarsa']))}}</td>
            <td>{{$row['keterangan']}}</td>
            <td>Rp {{number_format($row['sebenarnya'] * $row['harga'])}}</td>
            @php $i++; $total+= ($row['sebenarnya'] * $row['harga'])@endphp
        </tr>
        @empty
        <tr>
            <td colspan="8">Belum Ada Barang</td>
        </tr>
        @endforelse
        <tr>
            <th colspan="7">Total</th>
            <th>Rp {{number_format($total)}}</th>
        </tr>
        <tr>
            <td colspan="8"></td>
        </tr>
        <tr>
            <td colspan="8"></td>
        </tr>
        <tr>
            <td colspan="3">Mengetahui</td>
            <td colspan="2"></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="3">a.n Kepala {{config('app.name')}}</td>
            <td colspan="2"></td>
            <td colspan="3">Surabaya, {{date("d F Y")}}</td>
        </tr>
        <tr>
            <td colspan="3">Wakabin</td>
            <td colspan="2"></td>
            <td colspan="3">Kepala Departmen Farmasi</td>
        </tr>
        <tr>
            <td colspan="8"></td>
        </tr>
        <tr>
            <td colspan="8"></td>
        </tr>
        <tr>
            <td colspan="8"></td>
        </tr>
    </tbody>
</table>