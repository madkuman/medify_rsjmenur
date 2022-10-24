<div class="row">
    <div class="col-12">
        <div class="pull-right">
            <a class="btn btn-secondary ml-10" href="javascript:void(0)" data-surat_kontrol="" id="btn-print-rencana-kontrol">Print</a>
            @if ($jenis != 1)
                <a class="btn btn-secondary ml-10" href="javascript:void(0)" data-sep="" id="btn-check-sep">Check SEP</a>
            @endif
            <a class="btn btn-secondary ml-10" href="javascript:void(0)" id="btn-edit">
                <i class="fas fa-pencil"></i> Edit
            </a>
                <a class="btn btn-secondary ml-10" href="javascript:void(0)" data-nosk="" id="btn-delete">
                    <i class="fas fa-trash"></i> Hapus
                </a>
        </div>
        <h5>INFORMASI RENCANA KONTROL</h5>
        <table>
            <tr>
                <td style="width: 175px">Nomor Surat Kontrol</td>
                <td style="width: 1px">:</td>
                <td id="rk-nomor-surat-kontrol"></td>
            </tr>
            <tr>
                <td>Tanggal Rencana Kontrol</td>
                <td>:</td>
                <td id="rk-tanggal-rencana-kontrol"></td>
            </tr>
            <tr>
                <td>Nomor SEP</td>
                <td>:</td>
                <td id="rk-nomor-sep"></td>
            </tr>
            <tr>
                <td valign="top">Nama Peserta</td>
                <td valign="top">:</td>
                <td id="rk-nama"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td id="rk-tanggal-lahir"></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td id="rk-jenis-kelamin"></td>
            </tr>
            <tr>
                <td valign="top">Diagnosa Awal</td>
                <td valign="top">:</td>
                <td id="rk-diagnosa-awal"></td>
            </tr>
            <tr>
                <td>Jenis Kontrol</td>
                <td>:</td>
                <td id="rk-jenis-kontrol"></td>
            </tr>
            <tr>
                <td>Poliklinik Tujuan</td>
                <td>:</td>
                <td id="rk-poliklinik"></td>
            </tr>
            <tr>
                <td>Nama Dokter</td>
                <td>:</td>
                <td id="rk-nama-dokter"></td>
            </tr>
        </table>
    </div>
</div>