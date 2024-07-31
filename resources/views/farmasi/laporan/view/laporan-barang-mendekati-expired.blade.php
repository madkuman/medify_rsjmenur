<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">LAPORAN BARANG MENDEKATI EXPIRED</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Tanggal Expired : {{Carbon\Carbon::now()->format('d F Y')}} - {{$max_date->format('d F Y')}}</th>
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
                <td>{{$item->item_farmasi->item_template->nama}}</td>
                <td>{{$item->log_pengadaan->batch}}</td>
                <td>{{$item->log_pengadaan->produsen->nama}}</td>
                <td>
                	@php $kadaluarsa = $item->kadaluarsa ?? '' @endphp
                    @if(!empty($kadaluarsa))
                    {{indonesian_date($kadaluarsa,'d-m-Y')}}
                    @endif
               	</td>
                <td>
                    @php $tgl_faktur = $item->log_pengadaan->pengadaan->tanggal_faktur ?? '' @endphp
                    @if(!empty($tgl_faktur))
                    {{indonesian_date($tgl_faktur,'d-m-Y')}}
                    @endif
                </td>
                <td>`{{$item->log_pengadaan->pengadaan->nomor_referensi}}</td>
                <td>{{$item->log_pengadaan->pengadaan->supplier_detail->nama}}</td>
                <td>{{$item->item_farmasi->item_template->satuan}}</td>
                <td>{{$item->jumlah}}</td>
                <td>{{$item->item_farmasi->harga}}</td>
                <td>=K{{$row}}*J{{$row}}</td>
            </tr>
        @php $row++ @endphp
        @endforeach
    </tbody>
</table>