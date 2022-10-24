<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>Nomor</th>
            <th>Pasien</th>
            <th>Jenis Permintaan</th>
            <th>Jenis Pasien</th>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>No SEP</th>
            <th>Layanan</th>
            <th>Harga Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $row)
        <tr>
            <td>{{ $row->pasien->no_rm }}</td>
            <td>{{ $row->pasien->name }}</td>
            <td>{{ $row->tarif_tipe->nama ?? '-'}}</td>
            <td>{{ $row->pembayaran['perusahaan']['tipe']['nama'] ?? '-'}}</td>
            <td>{{ explode(" ", $row->result_created_at)[0] ?? '-' }}</td>
            <td>{{ $row->asal->nama ?? '-' }}</td>
            <td>{{ $row->kasus->active_sep->no_sep ?? '' }}</td>
            <td>
                @foreach($row->detail as $d)
                {{$d->tarif->deskripsi ?? '-'}} (Rp {{$d->harga}});
                @endforeach
            </td>
            <td>
                Rp {{$row->harga_total}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>