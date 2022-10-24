<table>
    @php $total_all =0; @endphp
    @foreach($usulans as $row)
        @php
            $usulan = $row['usulan'];
            $akun_rekening = $row['akun_rekening'];
            $kegiatan = $row['kegiatan'];
            $barang = $row['barang'];
        @endphp
        <tr>
            <td colspan="9">USULAN MURNI TAHUN {{$usulan->tahun}}</td>
        </tr>

        <tr>
            <td colspan="9">{{$usulan->nama}}</td>
        </tr>
        <tr>
            <td colspan="9">{{$usulan->deskripsi}}</td>
        </tr>
        <tr>
            <td colspan="9"></td>
        </tr>
        <tr>
            <td>No</td>
            <td>Jenis Barang/Kegiatan</td>
            <td>Satuan</td>
            <td>Jumlah</td>
            <td>Harga Satuan</td>
            <td>Total</td>
            <td>Link Produk</td>
            <td>Justifikasi</td>
            <td>Spesifikasi</td>
        </tr>
        @php
            $i=0;
            $total_all = 0;
            $last_rekening = '';
        @endphp
        @foreach($kegiatan as $item)
            @php
                $total_all+=$item->total;
            @endphp
            @if($last_rekening != $item->akun_rekening->nama)
                <tr>
                    <td>{{$item->akun_rekening->kode}}</td>
                    <td>{{$item->akun_rekening->nama ?? '-'}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$akun_rekening[$item->akun_rekening_id][0]->total ?? 0}}</td>
                </tr>
            @endif
            <tr>
                <td></td>
                <td>{{$item->kegiatan ?? '-'}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$item->total}}</td>
            </tr>
            @php $last_rekening = $item->akun_rekening->nama; @endphp
            @foreach($barang->where('akun_rekening_id',$item->akun_rekening_id)->where('kegiatan',$item->kegiatan) ?? [] as $row)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$row->barang->nama ?? '-'}}</td>
                    <td>{{$row->satuan}}</td>
                    <td>{{$row->jumlah}}</td>
                    <td>{{$row->harga}}</td>
                    <td>{{$row->harga * $row->jumlah}}</td>
                    <td>{{$row->link}}</td>
                    <td>{{$row->justifikasi}}</td>
                    <td>{{$row->spesifikasi}}</td>
                </tr>
            @endforeach
        @endforeach
        @if(!$loop->last)
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
        @endif
    @endforeach
    @if($total_all > 0)
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>TOTAl</td>
        <td>{{$total_all}}</td>
    </tr>
    @endif
</table>