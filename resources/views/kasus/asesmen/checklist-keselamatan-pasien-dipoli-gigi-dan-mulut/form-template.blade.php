<style type="text/css">
    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .d-inline-block {
        display: inline-block;
    }

    .border {
        border: 1px solid #000;
    }

    .border-left {
        border-left: 1px solid #000;
    }

    .border-right {
        border-right: 1px solid #000;
    }

    .border-top {
        border-top: 1px solid #000;
    }

    .border-bottom {
        border-bottom: 1px solid #000;
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .p-0 {
        padding: 0;
    }

    .mw-100 {
        max-width: 100%;
    }

    .fs-md {
        font-size: 14px;
    }

    .align-top {
        vertical-align: top !important;
    }

    .align-middle {
        vertical-align: middle;
    }

    .float-left {
        float: left;
    }

    .float-right {
        float: right;
    }

    table {
        border-collapse: collapse;
    }

    table tr td {
        padding: 2px 3px;
        height: 16px;
    }

    table.c-table-padding-sm tr td {
        padding: 1px 2px;
    }

    body {
        font-size: 10pt;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-bottom: 0;
    }

    h1 {
        font-size: 2.5rem;
    }

    h2 {
        font-size: 2rem;
    }

    h3 {
        font-size: 1.75rem;
    }

    h4 {
        font-size: 1.5rem;
    }

    h5 {
        font-size: 1.25rem;
    }

    h6 {
        font-size: 1rem;
    }

    /* .c-table-fs-sm tr td > * {
        font-size: 8pt;
    } */
    .fs-sm {
        font-size: 8pt;
    }

    @page {
        sheet-size: a4;
        margin-left: 1.5cm;
        margin-top: .85cm;
        margin-right: 1.4cm;
        margin-bottom: .85cm;
        header: page-header;
    }

    @media print {
        .space {
            display: none;
        }

        .hide-printed {
            display: block !important;
        }
    }

    .page-header-content {
        position: fixed;
        right: 0;
        top: 0;
    }

    .c-table--bordered tr td {
        border: 1px solid #000;
    }

    input.custom-checkbox {
        display: none;
    }

    label {
        font-weight: 400;
    }

    input.custom-checkbox+label {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    input.custom-checkbox+label::before {
        content: "☐";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 12px;
        height: 12px;
    }

    input.custom-checkbox:checked+label::before {
        content: "✔";
    }

    .border {
        border-color: #000 !important;
    }
</style>

@if ($action != 'view')
    <style>
        .medify-form-genv4-view-container {
            display: none !important;
        }
    </style>
@else
    <style>
        .medify-form-genv4-input-container {
            display: none !important;
        }
    </style>
@endif
@if ($print ?? ('' ?? ''))
    <htmlpageheader name="page-header">
        <div class="page-header-content">
            <div class="border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RM. 12.5&nbsp;&nbsp;&nbsp;</div>
            <div class="border-left border-right border-bottom">
                &nbsp;&nbsp;&nbsp;<span>Halaman&nbsp;{PAGENO}/{nb}&nbsp;&nbsp;</span>
            </div>
        </div>
    </htmlpageheader>
@endif
<br><br>
<table style="width:100%">
    <tr>
        <td width="55%" class=" position-relative" colspan="1" rowspan="5">
            <img style="max-width: 100%;object-fit:contain;" src="{{ url('') }}/{{ config('app.kop_lg') }}"
                width="300" height="90">
        </td>
    </tr>
    <tr>
        <td style="width: 14%;" class=" position-relative" colspan="1" rowspan="1">
            <span>No. RM</span>
        </td>
        <td style="width: 1%;" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="width: 30%;" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $kasus->pasien->no_rm ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Nama</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $kasus->pasien->name ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Tgl Lahir/Usia</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ date('d F Y', strtotime($kasus->identitas->tanggal_lahir)) }}</span>
            <span>/</span>
            <span>{{ $kasus->identitas->age ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Jenis Kelamin</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>
                @if ($kasus->identitas->gender == 1)
                    Laki-laki
                @else
                    Perempuan
                @endif
            </span>
        </td>
    </tr>
</table>
<br>
<table style="width:100%;">
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <h5>CHEKLIST KESELAMATAN PASIEN DIPOLI GIGI DAN MULUT</h5>
        </td>
    </tr>
</table>
<br>
<table style="width:100%;">
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <h6>SIGN IN</h6>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>(Dilakukan sebelum tindakan, oleh perawat dan operator)</span>
        </td>
    </tr>
</table>
<br>
<table style="width:100%" class="c-table--bordered">
    <tr>
        <td style="width:4%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>NO</span>
        </td>
        <td style="width:56%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>KEGIATAN</span>
        </td>
        <td style="width:20%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>YA</span>
        </td>
        <td style="width:20%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>TIDAK</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>1</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pasien telah dikonfirmasikan:</span>
            <ul>
                <li>Identitas pasien (Nama lengkap, Tanggal Lahir dan atau nama Ibu Kandung)</li>
                <li>Lokasi tindakan operasi/ tindakan</li>
                <li>Prosedur</li>
            </ul>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[konfirmasi]" id="radio-input-cafqw"
                    value="1" @php $hasil_data_temp=$hasil_data->{'sign'}->{'konfirmasi'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="radio-input-cafqw"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'konfirmasi'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[konfirmasi]" id="radio-input-sadsa"
                    value="0" @php $hasil_data_temp=$hasil_data->{'sign'}->{'konfirmasi'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="radio-input-sadsa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'konfirmasi'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>2</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Lokasi gigi sudah diidentifikasi</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[lokasi_gigi]" id="radio-input-cafqw"
                    value="1" @php $hasil_data_temp=$hasil_data->{'sign'}->{'lokasi_gigi'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="radio-input-cafqw"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'lokasi_gigi'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[lokasi_gigi]" id="radio-input-fsadaw"
                    value="0" @php $hasil_data_temp=$hasil_data->{'sign'}->{'lokasi_gigi'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="radio-input-fsadaw"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'lokasi_gigi'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>3</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Alat dan obat-obatan sudah di cek lengkap</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[alat_dan_obat_obatan]"
                    id="radio-input-fsawr" value="1"
                    @php $hasil_data_temp=$hasil_data->{'sign'}->{'alat_dan_obat_obatan'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="radio-input-fsawr"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'alat_dan_obat_obatan'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[alat_dan_obat_obatan]"
                    id="radio-input-sadsad" value="0"
                    @php $hasil_data_temp=$hasil_data->{'sign'}->{'alat_dan_obat_obatan'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="radio-input-sadsad"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'alat_dan_obat_obatan'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>4</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Apakah pasien punya riwayat alergi</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[riwayat_alergi]" id="radio-input-sdsa2"
                    value="1" @php $hasil_data_temp=$hasil_data->{'sign'}->{'riwayat_alergi'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="radio-input-sdsa2"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'riwayat_alergi'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[riwayat_alergi]" id="radio-input-sdad"
                    value="0" @php $hasil_data_temp=$hasil_data->{'sign'}->{'riwayat_alergi'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="radio-input-sdad"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'riwayat_alergi'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>5</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Kesulitan bernafas</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[kesulitan_bernafas]"
                    id="radio-input-sadsadsda" value="1"
                    @php $hasil_data_temp=$hasil_data->{'sign'}->{'kesulitan_bernafas'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="radio-input-sadsadsda"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'kesulitan_bernafas'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[kesulitan_bernafas]"
                    id="radio-input-sda3das" value="0"
                    @php $hasil_data_temp=$hasil_data->{'sign'}->{'kesulitan_bernafas'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="radio-input-sda3das"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'kesulitan_bernafas'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>6</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Apakah foto rontgen sudah ditayangkan</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[foto_rontgen_sudah_ditayangkan]"
                    id="radio-input-asasd" value="1"
                    @php $hasil_data_temp=$hasil_data->{'sign'}->{'foto_rontgen_sudah_ditayangkan'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="radio-input-asasd"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'foto_rontgen_sudah_ditayangkan'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sign[foto_rontgen_sudah_ditayangkan]"
                    id="radio-input-sdaasdsax" value="0"
                    @php $hasil_data_temp=$hasil_data->{'sign'}->{'foto_rontgen_sudah_ditayangkan'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="radio-input-sdaasdsax"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'foto_rontgen_sudah_ditayangkan'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
</table>
<br>
<table style="width:100%">
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <h6>TIME OUT</h6>
        </td>
    </tr>
</table>
<br>
<table style="width:100%" class="c-table--bordered">
    <tr>
        <td style="width:4%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>NO</span>
        </td>
        <td style="width:56%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>KEGIATAN</span>
        </td>
        <td style="width:20%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>YA</span>
        </td>
        <td style="width:20%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>TIDAK</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>1</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Konfirmasi seluruh anggota tim telah mengenal nama dan perannya</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="timeout[tim_telah_mengenal_nama_dan_peran]"
                    id="radio-input-dsa12d" value="1"
                    @php $hasil_data_temp=$hasil_data->{'timeout'}->{'tim_telah_mengenal_nama_dan_peran'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="radio-input-dsa12d"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'timeout'}->{'tim_telah_mengenal_nama_dan_peran'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="timeout[tim_telah_mengenal_nama_dan_peran]"
                    id="radio-input-fsa21sa" value="0"
                    @php $hasil_data_temp=$hasil_data->{'timeout'}->{'tim_telah_mengenal_nama_dan_peran'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="radio-input-fsa21sa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'timeout'}->{'tim_telah_mengenal_nama_dan_peran'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>2</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Dokter gigi dan perawat melakukan konfirmasi secara verbal:</span>
            <ul>
                <li>Nama pasien, tanggal lahir dan atau nama ibu kandung</li>
                <li>Prosedur</li>
                <li>Lokasi tindakan</li>
            </ul>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="timeout[dokter_perawat_konfirmasi]"
                    id="radio-input-dsadq" value="1"
                    @php $hasil_data_temp=$hasil_data->{'timeout'}->{'dokter_perawat_konfirmasi'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="radio-input-dsadq"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'timeout'}->{'dokter_perawat_konfirmasi'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="timeout[dokter_perawat_konfirmasi]"
                    id="radio-input-sdasd21ds" value="0"
                    @php $hasil_data_temp=$hasil_data->{'timeout'}->{'dokter_perawat_konfirmasi'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="radio-input-sdasd21ds"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'timeout'}->{'dokter_perawat_konfirmasi'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
</table>
<br>
<table style="width:100%;">
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <h6>SIGN OUT</h6>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>(Dilakukan sebelum meninggalkan poli gigi diisi oleh perawat dan operator)</span>
        </td>
    </tr>
</table>
<br>
<table style="width:100%" class="c-table--bordered">
    <tr>
        <td style="width:4%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>NO</span>
        </td>
        <td style="width:56%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>KEGIATAN</span>
        </td>
        <td style="width:20%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>YA</span>
        </td>
        <td style="width:20%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>TIDAK</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>1</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Perawat melakukan konfirmasi verbal dengan tim:</span>
            <ul>
                <li>Nama prosedur tindakan sudah dicatat</li>
                <li>Specimen telah diberi label (nama pasien dan lokasi asal jaringan)</li>
                <li>Adakah masalah selama operasi atau tindakan</li>
            </ul>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="signout[perawat_konfirmasi_dengan_tim]"
                    id="radio-input-dsa241" value="1"
                    @php $hasil_data_temp=$hasil_data->{'signout'}->{'perawat_konfirmasi_dengan_tim'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="radio-input-dsa241"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'signout'}->{'perawat_konfirmasi_dengan_tim'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="signout[perawat_konfirmasi_dengan_tim]"
                    id="radio-input-das12ds" value="0"
                    @php $hasil_data_temp=$hasil_data->{'signout'}->{'perawat_konfirmasi_dengan_tim'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="radio-input-das12ds"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'signout'}->{'perawat_konfirmasi_dengan_tim'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>2</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Dokter gigi dan perawat melakukan review masalah utama yang harus diperhatikan untuk penyembuhan dan
                manajemen pasien selanjutnya</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="signout[review_masalah_utama_untuk_penyembuhan]"
                    id="radio-input-sda21sa" value="1"
                    @php $hasil_data_temp=$hasil_data->{'signout'}->{'review_masalah_utama_untuk_penyembuhan'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="radio-input-sda21sa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'signout'}->{'review_masalah_utama_untuk_penyembuhan'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="signout[review_masalah_utama_untuk_penyembuhan]"
                    id="radio-input-sdas234sa" value="0"
                    @php $hasil_data_temp=$hasil_data->{'signout'}->{'review_masalah_utama_untuk_penyembuhan'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="radio-input-sdas234sa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'signout'}->{'review_masalah_utama_untuk_penyembuhan'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
</table>
<br>
@if ($action != 'view')
    <table style="width:100%;">
        <tr>
            <td style="width: 50%" class=" position-relative text-center" colspan="1" rowspan="1">
                <div>Terapis Gigi dan Mulut I</div>
                @php $hasil_data_temp = $hasil_data->{'terapis_gigi_dan_mulut_1'} ?? '' @endphp
                <span>
                    <select class="js-select2 form-control" id="selectTtdTerapisGigiDanMulut1"
                        name="selectTtdTerapisGigiDanMulut1">
                        @if ($hasil_data_temp != '')
                            <option selected>{{ $hasil_data_temp ?? '' }}</option>
                        @endif
                    </select>
                </span>
                <span>
                    <input type="hidden" class="form-control" id="terapis_gigi_dan_mulut_1"
                        name="terapis_gigi_dan_mulut_1" value="{{ $hasil_data->{'terapis_gigi_dan_mulut_1'} ?? '' }}">
                    <input type="hidden" class="form-control" id="ttd_terapis_gigi_dan_mulut_1"
                        name="ttd_terapis_gigi_dan_mulut_1"
                        value="{{ $hasil_data->{'ttd_terapis_gigi_dan_mulut_1'} ?? '' }}">
                </span>
            </td>
            <td style="width: 50%" class=" position-relative text-center" colspan="1" rowspan="1">
                <div>Terapis Gigi dan Mulut II</div>
                @php $hasil_data_temp = $hasil_data->{'terapis_gigi_dan_mulut_2'} ?? '' @endphp
                <span>
                    <select class="js-select2 form-control" id="selectTtdTerapisGigiDanMulut2"
                        name="selectTtdTerapisGigiDanMulut2">
                        @if ($hasil_data_temp != '')
                            <option selected>{{ $hasil_data_temp ?? '' }}</option>
                        @endif
                    </select>
                </span>
                <span>
                    <input type="hidden" class="form-control" id="terapis_gigi_dan_mulut_2"
                        name="terapis_gigi_dan_mulut_2"
                        value="{{ $hasil_data->{'terapis_gigi_dan_mulut_2'} ?? '' }}">
                    <input type="hidden" class="form-control" id="ttd_terapis_gigi_dan_mulut_2"
                        name="ttd_terapis_gigi_dan_mulut_2"
                        value="{{ $hasil_data->{'ttd_terapis_gigi_dan_mulut_2'} ?? '' }}">
                </span>
            </td>
        </tr>
    </table>
@else
    <table style="width:100%;">
        <tr>
            <td style="width: 33%;" class=" position-relative text-center" colspan="1" rowspan="1">
                <div>Dokter Gigi</div>
                @if (($kasus->dpjp ?? null) != null)
                    @if (file_exists($kasus->dpjp->user->ttd ?? ('' ?? '')))
                        <div>
                            <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;"
                                src="{{ url('') }}/{{ $kasus->dpjp->user->ttd }}" alt="Tanda tangan">
                        </div>
                    @else
                        <br><br><br><br>
                    @endif
                    <br>
                    <div>( <span>{{ $kasus->dpjp->user->name ?? '' }}</span> )</div>
                @else
                    <br><br><br><br>
                    <div>( .................................... )</div>
                @endif
            </td>
            <td style="width: 33%" class=" position-relative text-center" colspan="1" rowspan="1">
                <div>Terapis Gigi dan Mulut I</div>
                @if (($hasil_data->{'terapis_gigi_dan_mulut_1'} ?? '') != '')
                    @if (file_exists($hasil_data->{'ttd_terapis_gigi_dan_mulut_1'} ?? ('' ?? '')))
                        <div>
                            <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;"
                                src="{{ url('') }}/{{ $hasil_data->{'ttd_terapis_gigi_dan_mulut_1'} }}"
                                alt="Tanda tangan">
                        </div>
                    @else
                        <br><br><br><br>
                    @endif
                    <br>
                    <div>( <span>{{ $hasil_data->{'terapis_gigi_dan_mulut_1'} ?? '' }}</span> )</div>
                @else
                    <br><br><br><br>
                    <div>( .................................... )</div>
                @endif
            </td>
            <td class=" position-relative text-center" colspan="1" rowspan="1">
                <div>Terapis Gigi dan Mulut II</div>
                @if (($hasil_data->{'terapis_gigi_dan_mulut_2'} ?? '') != '')
                    @if (file_exists($hasil_data->{'ttd_terapis_gigi_dan_mulut_2'} ?? ('' ?? '')))
                        <div>
                            <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;"
                                src="{{ url('') }}/{{ $hasil_data->{'ttd_terapis_gigi_dan_mulut_2'} }}"
                                alt="Tanda tangan">
                        </div>
                    @else
                        <br><br><br><br>
                    @endif
                    <br>
                    <div>( <span>{{ $hasil_data->{'terapis_gigi_dan_mulut_2'} ?? '' }}</span> )</div>
                @else
                    <br><br><br><br>
                    <div>( .................................... )</div>
                @endif
            </td>
        </tr>
    </table>
@endif
