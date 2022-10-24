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
            <th>Permintaan Oleh</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $row)
        <tr>
            <td>{{ $row->transaction->pasien->no_rm }}</td>
            <td>{{ $row->transaction->pasien->name }}</td>
            <td>{{ $row->transaction->tarif_tipe->nama ?? '-'}}</td>
            <td>{{ $row->transaction->pembayaran['perusahaan']['tipe']['nama'] ?? '-'}}</td>
            <td>{{ explode(" ", $row->transaction->result_created_at)[0] ?? '-' }}</td>
            <td>{{ $row->transaction->asal->nama ?? '-' }}</td>
            <td>{{ $row->transaction->kasus->active_sep->no_sep ?? '' }}</td>
            <td>
                {{$row->tarif->deskripsi ?? '-'}}
            </td>
            <td>
                Rp {{$row->harga}}
            </td>
            <td>
                {{$row->transaction->creator->name ?? '-'}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>