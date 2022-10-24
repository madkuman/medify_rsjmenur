<div class="row">
    <div class="col-12">
        <div class="pull-right">
            <a class="btn btn-secondary ml-10" href="javascript:void(0)" data-id="" id="btn-kirim-vclaim">Kirim Vclaim</a>
            <a class="btn btn-secondary ml-10" href="javascript:void(0)" data-sep="" id="btn-check-sep">Check SEP</a>
            <a class="btn btn-secondary ml-10" href="javascript:void(0)" id="btn-edit">
                <i class="fas fa-pencil"></i> Edit
            </a>
            <a class="btn btn-secondary ml-10" href="javascript:void(0)" data-id="" id="btn-delete">
                <i class="fas fa-trash"></i> Hapus
            </a>
        </div>
        <h5>INFORMASI RUJUK BALIK</h5>
        <table>
            @php
                $table_data = [
                    'no_sep' => 'No SEP',
                    'no_kartu' => 'No Kartu',
                    'no_surat_rujuk_balik' => 'No Surat RB',
                    'kode_program_prb' => 'Kode Program PRB',
                    'program_prb' => 'Program PRB',
                    'kode_dpjp' => 'Kode DPJP',
                    'dpjp' => 'DPJP',
                    'alamat_peserta' => 'Alamat',
                    'nama_peserta' => 'Nama',
                    'email_peserta' => 'Email',
                    'keterangan' => 'Keterangan',
                    'saran' => 'Saran',
                    'status_vclaim' => 'Status Vclaim',
                ];
            @endphp
            @foreach ($table_data as $key => $item)
                <tr>
                    <td style="width: 175px">{{ $item }}</td>
                    <td style="width: 1px">:</td>
                    <td id="rb-{{ $key }}"></td>
                </tr>
            @endforeach
        </table>

        <h5 class="mt-3">DAFTAR OBAT</h5>
        <table class="table table-bordered" id="table-detail-obat">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Signa</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
