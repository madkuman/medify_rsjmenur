<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NRP</th>
            <th>Jabatan</th>
            <th>Pangkat</th>
            <th>Status</th>
            <th>Status Aktif</th>
            <th>Jenis Kelamin</th>
            <th>Usia</th>
            <th>Agama</th>
            <th>Alamat</th>
            <th>Departemen</th>
            <th>Kualifikasi</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pegawai as $key=>$item)
            @php
                $jabatan = $item->masterJabatan;
            @endphp
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->nrp}}</td>
                <td>{{$item->masterJabatan->nama ?? ''}}</td>
                <td>{{$item->pangkatTerbaru->masterPangkat->nama ?? ''}}</td>
                <td>{{$item->masterJenisPegawai->nama ?? ''}}</td>
                <td>{{$item->masterStatusPegawai->status ?? ''}}</td>
                <td>{{$item->genders}}</td>
                <td>{{$item->age_just_year}}</td>
                <td>{{$item->agama->nama ?? ''}}</td>
                <td>{{$item->address}}</td>
                <td>{{$jabatan->departemen->nama ?? ''}}</td>
                <td>{{$item->masterKualifikasi->nama ?? ''}}</td>
                <td>{{$item->tmt_formatted}}</td>
                <td>{{$item->tmt_out_formatted}}</td>
            </tr>
        @endforeach
    </tbody>
</table>