<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">LAPORAN PENGHAPUSAN BARANG</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Per Tanggal : {{indonesian_date($date_start)}} - {{indonesian_date($date_end)}}</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Farmasi : {{$farmasi_names}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>NO</th>
            <th>NAMA BARANG</th>
            <th>NO BATCH</th>
            <th>PRODUSEN</th>
            <th>EXPIRED DATE</th>
            <th>TGL FAKTUR</th>
            <th>NO FAKTUR</th>
            <th>DISTRIBUTOR</th>
            <th>SATUAN</th>
            <th>JUMLAH</th>
            <th>HARGA SATUAN</th>
            <th>TOTAL</th>
        </tr>
        @php $row = 7 @endphp
        @foreach($data as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->detail_item->item_farmasi->item_template->nama}}</td>
                <td>{{$item->detail_item->log_pengadaan->batch}}</td>
                <td>{{$item->detail_item->log_pengadaan->produsen->nama}}</td>
                <td>
                	@php $kadaluarsa = $item->detail_item->kadaluarsa ?? '' @endphp
                    @if(!empty($kadaluarsa))
                    {{indonesian_date($kadaluarsa,'d-m-Y')}}
                    @endif
               	</td>
                <td>
                    @php $tgl_faktur = $item->detail_item->log_pengadaan->pengadaan->tanggal_faktur ?? '' @endphp
                    @if(!empty($tgl_faktur))
                    {{indonesian_date($tgl_faktur,'d-m-Y')}}
                    @endif
                </td>
                <td>`{{$item->detail_item->log_pengadaan->pengadaan->nomor_referensi}}</td>
                <td>{{$item->detail_item->log_pengadaan->pengadaan->supplier_detail->nama}}</td>
                <td>{{$item->detail_item->item_farmasi->item_template->satuan}}</td>
                <td>{{$item->jumlah}}</td>
                <td>{{$item->detail_item->item_farmasi->harga}}</td>
                <td>=K{{$row}}*J{{$row}}</td>
            </tr>
        @php $row++ @endphp
        @endforeach
    </tbody>
</table>