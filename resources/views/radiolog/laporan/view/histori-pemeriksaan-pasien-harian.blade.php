
<table>
    <tr>
        <td colspan="10">
            Histori Pemeriksaan Harian
        </td>
    </tr>
    <tr>
        <td colspan="10">
            Periode : {{$tanggal}}
        </td>
    </tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>

    <tr>
        <th><b>No</b></th>
        <th><b>Tgl</b></th>
        <th><b>Nama</b></th>
        <th><b>No.RM</b></th>
        <th><b>No.SEP</b></th>
        <th><b>Status</b></th>
        <th><b>Layanan</b></th>
        <th><b>Ruangan/Poli</b></th>
        <th><b>Dokter Pengirim</b></th>
        <th><b>Jenis Foto</b></th>
    </tr>
    @foreach($transaksi as $item)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{date('d-m-Y', strtotime($item->transaction->result_created_at))}}</td>
        <td>{{$item->transaction->pasien->name}}</td>
        <td>{{$item->transaction->pasien->no_rm}}</td>
        <td>{{$item->transaction->kasus->active_sep->no_sep ?? ''}}</td>
        <td>{{$item->transaction->pembayaran->perusahaan->nama ?? ''}}</td>
        <td>
            @php
                $layanan = '-';
                foreach($lokasi_id as $index => $lokasi_item)
                {
                    if(in_array($item->transaction->lokasi_id,$lokasi_item)){
                        $layanan = config('const.name-'.$index);
                        break;
                    }
                }
            @endphp
            {{$layanan}}
        </td>
        <td>{{$item->transaction->asal->nama}}</td>
        <td>{{$item->transaction->creator->name}}</td>
        <td>{{$item->tarif->deskripsi}}</td>
    </tr>
    @endforeach

</table>