<!DOCTYPE html>
<html>

<body>
    <table>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="8">LAMPIRAN BERITA ACARA PEMERIKSAAN BARANG DI GUDANG</td>
        </tr>
        <tr>
            <td colspan="8">NOMOR : {{$no_berita_acara}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td>Tanggal Pemeriksaan</td>
            <td></td>
            <td>: {{indonesian_date($tanggal,'d F Y')}}</td>
        </tr>
        <tr>
            <td>Lokasi Gudang</td>
            <td></td>
            <td>: {{$farmasi_names}}</td>
        </tr>
        <tr>
            <td>Perincian barang di gudang menurut hasil pemeriksaan adalah sebagai berikut</td>
        </tr>
        <tr></tr>
        <tr>
            <td>No</td>
            <td>Kode Bidang</td>
            <td>Kode Rekening</td>
            <td>Uraian</td>
            <td>Satuan</td>
            <td>Jumlah</td>
            <td>Total Harga</td>
            <td>Keterangan</td>
        </tr>
        <tr>
            <td>1</td>
            <td>2</td>
            <td></td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
        </tr>
        @php $grand_jumlah = 0 @endphp
        @php $grand_total_harga = 0 @endphp
        @php $row = 0@endphp
        @foreach($data as $kode_rekening)
        @if(empty($kode_rekening->item_template_list)) @php continue @endphp @endif
        @php $row++ @endphp
        <tr>
            <td>{{$row}}</td>
            <td>{{$kode_rekening->kode}}</td>
            <td></td>
            <td>{{$kode_rekening->nama}}</td>
        </tr>
        @php $subtotal_total_harga = 0 @endphp
        @php $subtotal_jumlah = 0 @endphp
        @foreach($kode_rekening->item_template_list as $item_template)
        
        @php $total_harga = $item_template->harga * $item_template->jumlah @endphp
        @php $subtotal_total_harga += $total_harga @endphp
        @php $subtotal_jumlah += $item_template->jumlah @endphp

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>    {{$item_template->nama}}</td>
            <td>{{$item_template->satuan}}</td>
            <td>{{$item_template->jumlah}}</td>
            <td>{{$total_harga}}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Sub Total {{$kode_rekening->nama}}</td>
            <td></td>
            <td>{{$subtotal_jumlah}}</td>
            <td>{{$subtotal_total_harga}}</td>
        </tr>

        
        @php $grand_jumlah += $subtotal_jumlah @endphp
        @php $grand_total_harga += $subtotal_total_harga @endphp
        <tr></tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>TOTAL</td>
            <td></td>
            <td>{{$subtotal_jumlah}}</td>
            <td>{{$subtotal_total_harga}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Surabaya, {{indonesian_date($tanggal,'d F Y')}}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Pejabat Penatausahaan Barang</td>
            <td></td>
            <td></td>
            <td>Pengurus Barang Persediaan</td>
            <td></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td>SHODIKIN, S.Kep, Ns</td>
            <td></td>
            <td></td>
            <td>FADHILATUS SOLICHA SB, S.Farm, Apt</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>NIP. 19690321 199101 1 001</td>
            <td></td>
            <td></td>
            <td>NIP. 19950919 201903 2 014</td>
            <td></td>
        </tr>
    </table>
</body>

</html>