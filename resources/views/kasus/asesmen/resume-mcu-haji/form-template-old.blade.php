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
        font-size: 12pt;
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
        sheet-size: legal;
        margin-left: 1cm;
        margin-top: .54cm;
        margin-right: 1.4cm;
        margin-bottom: .45cm;
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

    .filled {
        background-color: gray;
    }

    /* baris baru */
    .form-container {
        width: 80%;
        max-width: 600px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 1.5em;
        font-weight: bold;
    }

    .form-section {
        display: flex;
        justify-content: space-between;
    }

    .sticker-box {
        width: 45%;
        height: 200px;
        background-color: #ffffff;
        border: 1px solid #ffffff;
        border-radius: 5px;
        display: flex;
        font-size: 1.2em;
        color: #666;
    }

    .input-section {
        width: 45%;
    }

    .input-section label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .input-section input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
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
            <div class="border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RM 63 K4&nbsp;&nbsp;&nbsp;</div>
            <div class="border-left border-right border-bottom">
                &nbsp;&nbsp;&nbsp;<span>Halaman&nbsp;{PAGENO}/{nb}&nbsp;&nbsp;</span>
            </div>
        </div>
    </htmlpageheader>
@endif
<table style="width:100%">
    <tr>
        <td width="70%" class=" position-relative" colspan="1" rowspan="1">
            <img style="max-width: 100%;object-fit:contain;" src="{{ url('') }}/{{ config('app.kop_lg') }}"
                height="90">
        </td>
        <td width="30%" class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
</table>
<br>
<table style="width:100%;">
    <tr>
        <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
            <h5>BERKAS RESUME MCU HAJI RS JIWA MENUR</h5>
        </td>
    </tr>
</table>
<br>
<div class="form-section">
    {{-- <div class="sticker-box">Stiker identitas pasien</div> --}}
    <div class="input-section">
        <table>
            <tr>
                <td>No. RM</td>
                <td>:</td>
                <td> {{ $kasus->pasien->no_rm }}</td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td>:</td>
                <td> {{ $kasus->pasien->name }}</td>
            </tr>
            <tr>
                <td>Usia</td>
                <td>:</td>
                <td> {{ $kasus->identitas->age }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td> {{ $kasus->identitas->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td> {{ $kasus->pasien->text_alamat }}</td>
            </tr>
            <tr>
                <td>No. Handphone</td>
                <td>:</td>
                <td> {{ $kasus->identitas->no_hp }}</td>
            </tr>
        </table>
    </div>
    <div class="input-section">
        <label for="tanggal-pemeriksaan">Tanggal Pemeriksaan</label>
        <input type="text" id="tanggal-pemeriksaan" name="tanggal-pemeriksaan">

        <label for="psikolog">Psikolog</label>
        <input type="text" id="psikolog" name="psikolog">

        <label for="dokter-umum">Dokter Umum</label>
        <input type="text" id="dokter-umum" name="dokter-umum">

        <label for="dokter-sppd">Dokter SpPD</label>
        <input type="text" id="dokter-sppd" name="dokter-sppd">
    </div>
</div>
<br>

<table class="table-primary">
    <tr>
        <td class=" position-relative text-center">
            <h6>ANAMNESIS</h6>
        </td>
    </tr>
    <tr>
        <td>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">1. Keluhan saat ini / Riwayat kesehatan sekarang :</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">2. Riwayat penyakit dahulu, beserta obat yang rutin diminum
                    (DM, HT, Jantung, Asma, Stroke, Alergi, dll) :</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">3. Riwayat penyakit keluarga :</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">4. Apakah ada riwayat serangan jantung sebelumnya?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                        value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Tidak
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                        value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        Ya, terakhir kali serangan
                    </label>
                    <input class="form-control" type="text" placeholder="Default input">
                </div>
            </div>
        </td>
    </tr>
</table>
<br>
<table class="table-success">
    <tr>
        <td style="text-align: center">
            <h6>PEMERIKSAAN FISIK</h6>
        </td>
    </tr>
    <tr>
        <td>Tensi</td>
        <td>:</td>
        <td><input class="form-control" type="text" placeholder="Default input"></td>
        <td>Tensi</td>
        <td>:</td>
        <td><input class="form-control" type="text" placeholder="Default input"></td>
    </tr>
    <tr>
        <td>Tensi</td>
        <td>:</td>
        <td><input class="form-control" type="text" placeholder="Default input"></td>
        <td>Tensi</td>
        <td>:</td>
        <td><input class="form-control" type="text" placeholder="Default input"></td>
    </tr>
    <tr>
        <td>Tensi</td>
        <td>:</td>
        <td><input class="form-control" type="text" placeholder="Default input"></td>
        <td>Tensi</td>
        <td>:</td>
        <td><input class="form-control" type="text" placeholder="Default input"></td>
    </tr>
    <tr>
        <td>Tensi</td>
        <td>:</td>
        <td><input class="form-control" type="text" placeholder="Default input"></td>
        <td>Tensi</td>
        <td>:</td>
        <td><input class="form-control" type="text" placeholder="Default input"></td>
    </tr>
</table>
<br>
<table class="c-table--bordered" style="width:100%">
    <tr>
        <td style="width: 4%;" class=" position-relative text-center" colspan="1" rowspan="8"> <span>1</span>
        </td>
        <td style="width: 20%;" class=" position-relative text-center" colspan="1" rowspan="8">
            <h6>ANAMNESIS</h6>
        </td>
        <td style="width: 5%;" class=" position-relative text-center" colspan="1" rowspan="3"> <span>1</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="3"> <span>Keluhan saat ini / Riwayat kesehatan
                sekarang :</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Belum Menikah = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="3">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_perkawinan">
                    @php $hasil_data_temp = $hasil_data->status_perkawinan ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->status_perkawinan ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Menikah = 2</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Duda / Janda = 3</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="5"> <span>2</span> </td>
        <td class=" position-relative" colspan="2" rowspan="5"> <span>Riwayat penyakit dahulu, beserta obat
                yang
                rutin diminum (DM, HT, Jantung, Asma, Stroke, Alergi, dll) :</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Tamat SD = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="5">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control" name="pendidikan_terakhir">
                    @php $hasil_data_temp = $hasil_data->pendidikan_terakhir ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->pendidikan_terakhir ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Tamat SLTP = 2</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Tamat SLTA = 3</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Tamat Akademi = 4</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Tamat PT = 5</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="14"> <span>2</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="7" style="border-bottom:none;">
            <h6>STATUS MEDIS</h6>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="5"> <span>1</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Riwayat rawat inap yang tidak terkait
                masalah
                narkotika</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="2" rowspan="1"> <span>Jenis Penyakit</span> </td>
        <td class=" position-relative text-center" colspan="2" rowspan="1"> <span>Dirawat tahun</span> </td>
        <td class=" position-relative text-center" colspan="2" rowspan="1"> <span>Lamanya</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="riwayat_ranap_bukan_narkotika_jenis_penyakit_1_a"
                    value="{{ $hasil_data->riwayat_ranap_bukan_narkotika_jenis_penyakit_1_a ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->riwayat_ranap_bukan_narkotika_jenis_penyakit_1_a ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="riwayat_ranap_bukan_narkotika_dirawat_tahun_1_a"
                    value="{{ $hasil_data->riwayat_ranap_bukan_narkotika_dirawat_tahun_1_a ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->riwayat_ranap_bukan_narkotika_dirawat_tahun_1_a ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="riwayat_ranap_bukan_narkotika_lamanya_1_a"
                    value="{{ $hasil_data->riwayat_ranap_bukan_narkotika_lamanya_1_a ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->riwayat_ranap_bukan_narkotika_lamanya_1_a ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="riwayat_ranap_bukan_narkotika_jenis_penyakit_2_a"
                    value="{{ $hasil_data->riwayat_ranap_bukan_narkotika_jenis_penyakit_2_a ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->riwayat_ranap_bukan_narkotika_jenis_penyakit_2_a ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="riwayat_ranap_bukan_narkotika_dirawat_tahun_2_a"
                    value="{{ $hasil_data->riwayat_ranap_bukan_narkotika_dirawat_tahun_2_a ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->riwayat_ranap_bukan_narkotika_dirawat_tahun_2_a ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="riwayat_ranap_bukan_narkotika_lamanya_2_a"
                    value="{{ $hasil_data->riwayat_ranap_bukan_narkotika_lamanya_2_a ?? '' }}">
                <span class="medify-form-genv4-view-container">
                    {{ $hasil_data->riwayat_ranap_bukan_narkotika_lamanya_2_a ?? '' }}</span>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="riwayat_ranap_bukan_narkotika_jenis_penyakit_3_a"
                    value="{{ $hasil_data->riwayat_ranap_bukan_narkotika_jenis_penyakit_3_a ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->riwayat_ranap_bukan_narkotika_jenis_penyakit_3_a ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="riwayat_ranap_bukan_narkotika_dirawat_tahun_3_a"
                    value="{{ $hasil_data->riwayat_ranap_bukan_narkotika_dirawat_tahun_3_a ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->riwayat_ranap_bukan_narkotika_dirawat_tahun_3_a ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="riwayat_ranap_bukan_narkotika_lamanya_3_a"
                    value="{{ $hasil_data->riwayat_ranap_bukan_narkotika_lamanya_3_a ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->riwayat_ranap_bukan_narkotika_lamanya_3_a ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="2"> <span>2</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Riwayat penyakit kronis :</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="riwayat_penyakit_kronis">
                    @php $hasil_data_temp = $hasil_data->riwayat_penyakit_kronis ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->riwayat_penyakit_kronis ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1">
            <span>Jenis Penyakit :</span>
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="jenis_riwayat_penyakit_kronis"
                    value="{{ $hasil_data->jenis_riwayat_penyakit_kronis ?? ('' ?? '') }}">
            </div>
            <span class="form-group medify-form-genv4-view-container">
                {{ $hasil_data->jenis_riwayat_penyakit_kronis ?? ('' ?? '') }}
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="3"
            style="border-top:none;border-bottom:none;"> <span>Skala Penilaian Pasien</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="3"> <span>3</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Saat ini sedang menjalani terapi medis
                ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="sedang_menjalani_terapi_medis">
                    @php $hasil_data_temp = $hasil_data->sedang_menjalani_terapi_medis ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->sedang_menjalani_terapi_medis ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1">
            <span>Jenis terapi medis yang dijalani saat ini :</span>
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="jenis_sedang_menjalani_terapi_medis"
                    value="{{ $hasil_data->jenis_sedang_menjalani_terapi_medis ?? ('' ?? '') }}">
            </div>
            <span class="form-group medify-form-genv4-view-container">
                {{ $hasil_data->jenis_sedang_menjalani_terapi_medis ?? ('' ?? '') }}
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative align-bottom" colspan="6" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <textarea class="form-control" name="jenis_sedang_menjalani_terapi_medis_detail">{{ $hasil_data->jenis_sedang_menjalani_terapi_medis_detail ?? ('' ?? '') }}</textarea>
            </div>
            <span class="form-group medify-form-genv4-view-container">
                {{ $hasil_data->jenis_sedang_menjalani_terapi_medis_detail ?? ('' ?? '') }}
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="4" style="border-top:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input style="line-height: 32px;font-size: 32px;height: 80px;" type="number" min="0"
                    max="9" oninput="validateInputSkalaPenilaian(this)" class="form-control text-center"
                    name="status_medis_skala_penilaian_pasien"
                    value="{{ $hasil_data->status_medis_skala_penilaian_pasien ?? '' }}">
            </div>
            <div class="medify-form-genv4-view-container">
                <h1>{{ $hasil_data->status_medis_skala_penilaian_pasien ?? '' }}</h1>
            </div>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="4"> <span>4</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Status Kesehatan</span> </td>
        <td class=" position-relative text-center" colspan="3" rowspan="1"> <span>Apakah Pernah di Tes</span>
        </td>
    </tr>
    <tr>
        <td style="width: 10%;" class=" position-relative" colspan="1" rowspan="1"> <span>4,1</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>HIV</span> </td>
        <td style="width: 15%;" class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya =
                1</span> </td>
        <td style="width: 10%;" class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak =
                0</span> </td>
        <td style="width: 10%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_test_kesehatan_hiv">
                    @php $hasil_data_temp = $hasil_data->status_test_kesehatan_hiv ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->status_test_kesehatan_hiv ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>4,2</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Hepatitis B</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_test_kesehatan_hepatitis_b">
                    @php $hasil_data_temp = $hasil_data->status_test_kesehatan_hepatitis_b ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_test_kesehatan_hepatitis_b ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>4,3</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Hepatitis C</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_test_kesehatan_hepatitis_c">
                    @php $hasil_data_temp = $hasil_data->status_test_kesehatan_hepatitis_c ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_test_kesehatan_hepatitis_c ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="17"> <span>3</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="4" style="border-bottom:none;">
            <h6>STATUS PEKERJAAN /DUKUNGAN HIDUP</h6>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="4"> <span>1</span> </td>
        <td class=" position-relative" colspan="2" rowspan="4"> <span>Status Pekerjaan</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Tidak = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="4">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_pekerjaan">
                    @php $hasil_data_temp = $hasil_data->status_pekerjaan ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="8" @if ($hasil_data_temp == '8') selected @endif>8</option>
                    <option value="9" @if ($hasil_data_temp == '9') selected @endif>9</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->status_pekerjaan ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Bekerja = 2</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Mahasiswa / pelajar = 8</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Ibu rumah tangga = 9</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="2"
            style="border-top:none;border-bottom:none;"> <span>Tanggal asesmen</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="3"> <span>2</span> </td>
        <td class=" position-relative" colspan="2" rowspan="3"> <span>Bila, pola pekerjaan :</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Purna waktu = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="3">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="pola_pekerjaan">
                    @php $hasil_data_temp = $hasil_data->pola_pekerjaan ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="99" @if ($hasil_data_temp == '99') selected @endif>99</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->pola_pekerjaan ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Paruh waktu = 2</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="4"
            style="border-top:none;border-bottom:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input type="date" class="form-control" name="status_pekerjaan_dukungan_hidup_tanggal_asesmen"
                    value="{{ $hasil_data->status_pekerjaan_dukungan_hidup_tanggal_asesmen ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ (isset($hasil_data->status_pekerjaan_dukungan_hidup_tanggal_asesmen) ? indonesian_date($hasil_data->status_pekerjaan_dukungan_hidup_tanggal_asesmen) : null) ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Tidak tentu = 99</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>3</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Kode Pekerjaan :</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>( lihat petunjuk)</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="kode_pkerjaan"
                    value="{{ $hasil_data->kode_pkerjaan ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->kode_pkerjaan ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="2"> <span>4</span> </td>
        <td class=" position-relative" colspan="2" rowspan="2"> <span>Keterampilan teknis yang dimiliki</span>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="keterampilan_teknis_yang_dimiliki_1"
                    value="{{ $hasil_data->keterampilan_teknis_yang_dimiliki_1 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->keterampilan_teknis_yang_dimiliki_1 ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="4" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="keterampilan_teknis_yang_dimiliki_2"
                    value="{{ $hasil_data->keterampilan_teknis_yang_dimiliki_2 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->keterampilan_teknis_yang_dimiliki_2 ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="3"
            style="border-top:none;border-bottom:none;"> <span>Skala Penilaian Pasien</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>5</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Adakah yang memberi dukungan hidup bagi
                Anda
                ?</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="dukungan_hidup_status">
                    @php $hasil_data_temp = $hasil_data->dukungan_hidup_status ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->dukungan_hidup_status ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>6</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Bila Ya, siapakah ?</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="dukungan_hidup_siapa"
                    value="{{ $hasil_data->dukungan_hidup_siapa ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->dukungan_hidup_siapa ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="5"> <span>7</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Dalam bentuk apakah ?</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="4" style="border-top:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input style="line-height: 32px;font-size: 32px;height: 80px;" type="number" min="0"
                    max="9" oninput="validateInputSkalaPenilaian(this)" class="form-control text-center"
                    name="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien"
                    value="{{ $hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '' }}">
            </div>
            <div class="medify-form-genv4-view-container">
                <h1>{{ $hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '' }}</h1>
            </div>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Finansial</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="dukungan_hidup_dalam_bentuk_finansial">
                    @php $hasil_data_temp = $hasil_data->dukungan_hidup_dalam_bentuk_finansial ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->dukungan_hidup_dalam_bentuk_finansial ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Tempat tinggal</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="dukungan_hidup_dalam_bentuk_tempat_tinggal">
                    @php $hasil_data_temp = $hasil_data->dukungan_hidup_dalam_bentuk_tempat_tinggal ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->dukungan_hidup_dalam_bentuk_tempat_tinggal ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Makan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="dukungan_hidup_dalam_bentuk_makan">
                    @php $hasil_data_temp = $hasil_data->dukungan_hidup_dalam_bentuk_makan ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->dukungan_hidup_dalam_bentuk_makan ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Pengobatan / Perawatan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="dukungan_hidup_dalam_bentuk_pengobatan_perawatan">
                    @php $hasil_data_temp = $hasil_data->dukungan_hidup_dalam_bentuk_pengobatan_perawatan ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->dukungan_hidup_dalam_bentuk_pengobatan_perawatan ?? '' }}</span>
        </td>
    </tr>
</table>

<div style="margin: 20px 0;" class="space"></div>
<pagebreak />

<br><br><br>
<table style="width: 100%;" class="c-table--bordered">
    <tr>
        <td style="width: 4%;" class=" position-relative" colspan="1" rowspan="25"> <span>4</span> </td>
        <td style="width: 20%;" class=" position-relative text-center" colspan="1" rowspan="3"
            style="border-bottom:none;">
            <h6>STATUS PENGGUNAAN NARKOTIKA</h6>
        </td>
        <td style="width: 5%;" class=" position-relative" colspan="1" rowspan="2"
            style="border-right: none;"> </td>
        <td class=" position-relative" colspan="5" rowspan="1" style="border-left: none; border-bottom:none;">
            <span>Jenis Cara Penggunaan</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="5" rowspan="1" style="border-left: none;border-top:none;">
            <span>1. Oral 2. Nasal/sublingual/suppositoria 3. Merokok 4. Injeksi Non 5. IV</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="3" rowspan="1"> <span>JENIS NAPZA</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>30 Hari Terakhir</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Sepanjang Hidup (Thn)</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Cara Pakai</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-top:none;border-bottom:none;">
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.1</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <span>Alkohol</span>
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_alkohol_keterangan"
                    value="{{ $hasil_data->status_penggunaan_narkotika_alkohol_keterangan ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_alkohol_keterangan ?? '' }}</span>
        </td>
        <td style="width: 13%;" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_alkohol_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_alkohol_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_alkohol_30_hari ?? '' }}</span>
        </td>
        <td style="width: 10%;" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_alkohol_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_alkohol_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_alkohol_setahun ?? '' }}</span>
        </td>
        <td style="width: 10%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_alkohol_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_alkohol_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_alkohol_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-top:none;border-bottom:none;">
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.2</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Heroin</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_heroin_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_heroin_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_heroin_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_heroin_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_heroin_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_heroin_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_heroin_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_heroin_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_heroin_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="2"
            style="border-top:none;border-bottom:none;"> <span>Tanggal asesmen</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.3</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Metadon / Buprenorfin</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="status_penggunaan_narkotika_metadon_buprenorfin_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_metadon_buprenorfin_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_metadon_buprenorfin_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="status_penggunaan_narkotika_metadon_buprenorfin_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_metadon_buprenorfin_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_metadon_buprenorfin_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_metadon_buprenorfin_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_metadon_buprenorfin_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_metadon_buprenorfin_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.4</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Opiat</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_opiat_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_opiat_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_opiat_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_opiat_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_opiat_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_opiat_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_opiat_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_opiat_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_opiat_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="2"
            style="border-top:none;border-bottom:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input type="date" class="form-control" name="status_penggunaan_narkotika_tanggal_asesmen"
                    value="{{ $hasil_data->status_penggunaan_narkotika_tanggal_asesmen ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ (isset($hasil_data->status_penggunaan_narkotika_tanggal_asesmen) ? indonesian_date($hasil_data->status_penggunaan_narkotika_tanggal_asesmen) : null) ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.5</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Barbiturat</span> <span>D.6</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_barbiturat_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_barbiturat_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_barbiturat_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_barbiturat_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_barbiturat_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_barbiturat_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_barbiturat_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_barbiturat_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_barbiturat_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.6</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <span>Sedatif / Hipnotik</span>
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control"
                    name="status_penggunaan_narkotika_sedatif_hipnotik_keterangan"
                    value="{{ $hasil_data->status_penggunaan_narkotika_sedatif_hipnotik_keterangan ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_sedatif_hipnotik_keterangan ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="status_penggunaan_narkotika_sedatif_hipnotik_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_sedatif_hipnotik_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_sedatif_hipnotik_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="status_penggunaan_narkotika_sedatif_hipnotik_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_sedatif_hipnotik_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_sedatif_hipnotik_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_sedatif_hipnotik_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_sedatif_hipnotik_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_sedatif_hipnotik_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-top:none;border-bottom:none;">
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.7</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Kokain</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_kokain_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_kokain_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_kokain_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_kokain_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_kokain_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_kokain_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_kokain_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_kokain_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_kokain_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;">
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.8</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <span>Amfetamin</span>
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_amfetamin_keterangan"
                    value="{{ $hasil_data->status_penggunaan_narkotika_amfetamin_keterangan ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_amfetamin_keterangan ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_amfetamin_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_amfetamin_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_amfetamin_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_amfetamin_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_amfetamin_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_amfetamin_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_amfetamin_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_amfetamin_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_amfetamin_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.9</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Kanabis</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_kanabis_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_kanabis_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_kanabis_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_kanabis_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_kanabis_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_kanabis_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_kanabis_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_kanabis_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_kanabis_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="3"
            style="border-top:none;border-bottom:none;"> <span>Skala Penilaian Pasien</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.10</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <span>Halusinogen</span>
            <div class="form-group medify-form-genv4-input-container d-inline-block">
                <input type="text" class="form-control"
                    name="status_penggunaan_narkotika_halusinogen_keterangan"
                    value="{{ $hasil_data->status_penggunaan_narkotika_halusinogen_keterangan ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_halusinogen_keterangan ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_halusinogen_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_halusinogen_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_halusinogen_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_halusinogen_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_halusinogen_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_halusinogen_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_halusinogen_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_halusinogen_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_halusinogen_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.11</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Inhalan</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_inhalan_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_inhalan_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_inhalan_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_inhalan_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_inhalan_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_inhalan_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_inhalan_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_inhalan_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_inhalan_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>D.12</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Lebih dari 1 zat/hari ( termasuk
                alkohol )</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_lebih_1_zat_30_hari"
                    value="{{ $hasil_data->status_penggunaan_narkotika_lebih_1_zat_30_hari ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_lebih_1_zat_30_hari ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="status_penggunaan_narkotika_lebih_1_zat_setahun"
                    value="{{ $hasil_data->status_penggunaan_narkotika_lebih_1_zat_setahun ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_lebih_1_zat_setahun ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="status_penggunaan_narkotika_lebih_1_zat_cara_pakai">
                    @php $hasil_data_temp = $hasil_data->status_penggunaan_narkotika_lebih_1_zat_cara_pakai ?? '' @endphp
                    <option value="" @if ($hasil_data_temp == '') selected @endif></option>
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->status_penggunaan_narkotika_lebih_1_zat_cara_pakai ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="3"
            style="border-top:none;border-bottom:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input style="line-height: 32px;font-size: 32px;height: 80px;" type="number" min="0"
                    max="9" oninput="validateInputSkalaPenilaian(this)" class="form-control text-center"
                    name="status_penggunaan_narkotika_skala_penilaian_pasien"
                    value="{{ $hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '' }}">
            </div>
            <div class="medify-form-genv4-view-container">
                <h1>{{ $hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '' }}</h1>
            </div>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>13.</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Jenis zat utama yang disalahgunakan
                :</span>
        </td>
        <td class=" position-relative" colspan="3" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="jenis_zat_yang_disalahgunakan"
                    value="{{ $hasil_data->jenis_zat_yang_disalahgunakan ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->jenis_zat_yang_disalahgunakan ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>14.</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Pernahkah menjalani terapi
                rehabilitasi ?</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="menjalani_terapi_rehabilitas_status">
                    @php $hasil_data_temp = $hasil_data->menjalani_terapi_rehabilitas_status ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->menjalani_terapi_rehabilitas_status ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="2"> <span>15.</span> </td>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Bila ya, jenis terapi rehabilitasi
                yang dijalani
                ?</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative" colspan="5" rowspan="1"
            style="vertical-align: bottom;height:100px;">
            <span>Keterangan: </span>
            <div class="form-group medify-form-genv4-input-container">
                @php $hasil_data_temp = $hasil_data->keterangan_jenis_terapi_rehabilitas ?? '' @endphp
                <textarea class="form-control " name="keterangan_jenis_terapi_rehabilitas" rows="3">{{ $hasil_data->keterangan_jenis_terapi_rehabilitas ?? '' }}</textarea>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->keterangan_jenis_terapi_rehabilitas ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>16.</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Pernahkah mengalami overdosis ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="pernahkah_mengalami_overdosis_status">
                    @php $hasil_data_temp = $hasil_data->pernahkah_mengalami_overdosis_status ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pernahkah_mengalami_overdosis_status ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>17.</span> </td>
        <td class=" position-relative" colspan="5" rowspan="1">
            <span>Bila ya, kapan dan bagaimana penanggulangannya?</span>
            <div class="form-group medify-form-genv4-input-container">
                @php $hasil_data_temp = $hasil_data->overdosis_kapan_bagaimana_penanggulangan ?? '' @endphp
                <textarea class="form-control " name="overdosis_kapan_bagaimana_penanggulangan" rows="3">{{ $hasil_data->overdosis_kapan_bagaimana_penanggulangan ?? '' }}</textarea>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->overdosis_kapan_bagaimana_penanggulangan ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>18.</span> </td>
        <td class=" position-relative" colspan="5" rowspan="1"
            style="vertical-align: bottom;height:100px;">
            <span>Waktu overdosis :</span>
            <div class="form-group medify-form-genv4-input-container">
                @php $hasil_data_temp = $hasil_data->waktu_overdosis ?? '' @endphp
                <textarea class="form-control " name="waktu_overdosis">{{ $hasil_data->waktu_overdosis ?? '' }}</textarea>
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->waktu_overdosis ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="3"> <span>19.</span> </td>
        <td class=" position-relative" colspan="1" rowspan="3"> <span>Cara penanggulangan</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Perawatan di RS = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="3">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="pernahkah_mengalami_overdosis_cara_penanggulangan">
                    @php $hasil_data_temp = $hasil_data->pernahkah_mengalami_overdosis_cara_penanggulangan ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pernahkah_mengalami_overdosis_cara_penanggulangan ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Perawatan di Puskesmas = 2</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Sendiri = 3</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="19"> <span>5</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="2" style="border-bottom:none;">
            <h6>STATUS LEGAL</h6>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-right:none"> </td>
        <td class=" position-relative" colspan="5" rowspan="1" style="border-left:none;"> <span>Berapa
                kali kah dalam hidup Anda ditangkap dan
                dituntut dengan hal berikut :</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>1.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Mencuri di toko/ vandalisme</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="ditangkap_dan_dituntut_mencuri_ditoko_vandalisme_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_mencuri_ditoko_vandalisme_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_mencuri_ditoko_vandalisme_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>2.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Bebas bersyarat / masa
                percobaan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="ditangkap_dan_dituntut_bebas_bersyarat_masa_percobaan_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_bebas_bersyarat_masa_percobaan_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_bebas_bersyarat_masa_percobaan_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>3.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Masalah narkoba</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="ditangkap_dan_dituntut_masalah_narkoba_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_masalah_narkoba_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_masalah_narkoba_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>4.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Pemalsuan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="ditangkap_dan_dituntut_masalah_pemalsuan_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_masalah_pemalsuan_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_masalah_pemalsuan_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> <span>Tanggal asesmen</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>5.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Penyerangan bersenjata</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="ditangkap_dan_dituntut_penyerangan_bersenjata_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_penyerangan_bersenjata_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_penyerangan_bersenjata_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>6.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Pembobolan dan pencurian</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="ditangkap_dan_dituntut_pembobolan_dan_pencurian_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_pembobolan_dan_pencurian_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_pembobolan_dan_pencurian_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input type="date" class="form-control" name="status_legal_tanggal_asesmen"
                    value="{{ $hasil_data->status_legal_tanggal_asesmen ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ (isset($hasil_data->status_legal_tanggal_asesmen) ? indonesian_date($hasil_data->status_legal_tanggal_asesmen) : null) ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>7.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Perampokan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="ditangkap_dan_dituntut_perampokan_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_perampokan_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_perampokan_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>8.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Penyerangan bersenjata</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="ditangkap_dan_dituntut_penyerangan_bersenjata_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_penyerangan_bersenjata_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_penyerangan_bersenjata_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>9.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Pembakaran rumah</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="ditangkap_dan_dituntut_pembakaran_rumah_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_pembakaran_rumah_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_pembakaran_rumah_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> <span>Skala Penilaian Pasien</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>10.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Perkosaan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="ditangkap_dan_dituntut_perkosaan_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_perkosaan_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_perkosaan_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="4" style="border-top:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input style="line-height: 32px;font-size: 32px;height: 80px;" type="number" min="0"
                    max="9" oninput="validateInputSkalaPenilaian(this)" class="form-control text-center"
                    name="status_legal_skala_penilaian_pasien"
                    value="{{ $hasil_data->status_legal_skala_penilaian_pasien ?? '' }}">
            </div>
            <div class="medify-form-genv4-view-container">
                <h1>{{ $hasil_data->status_legal_skala_penilaian_pasien ?? '' }}</h1>
            </div>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>11.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Pembunuhan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="ditangkap_dan_dituntut_pembunuhan_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_pembunuhan_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_pembunuhan_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>12.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Pelacuran</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="ditangkap_dan_dituntut_pelacuran_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_pelacuran_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_pelacuran_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>13.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Melecehkan pengadilan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="ditangkap_dan_dituntut_melecehkan_pengadilan_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_melecehkan_pengadilan_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_melecehkan_pengadilan_value ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>14.</span> </td>
        <td class=" position-relative" colspan="4" rowspan="1"> <span>Lain - lain :</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="ditangkap_dan_dituntut_lain_lain_value"
                    value="{{ $hasil_data->ditangkap_dan_dituntut_lain_lain_value ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->ditangkap_dan_dituntut_lain_lain_value ?? '' }}</span>
        </td>
    </tr>
</table>

<div style="margin: 20px 0;" class="space"></div>
<pagebreak />

<br><br><br>
<table style="width: 100%;" class="c-table--bordered">
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-bottom:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-bottom:none;"> </td>
        <td class=" position-relative" colspan="10" rowspan="1">
            <h6>(masukkan jumlah total pengadilan, tidak hanya vonis hukuman. Jangan masukkan kejahatan anak - anak (
                sebelum 18 ) kecuali kalau mereka dituntut sebagai orang dewasa ).</h6>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-top:none;border-bottom:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>15.</span> </td>
        <td class=" position-relative" colspan="8" rowspan="1"> <span>Berapa kali tuntutan di atas berakibat
                vonis hukuman?</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="jumlah_total_pengadilan"
                    value="{{ $hasil_data->jumlah_total_pengadilan ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->jumlah_total_pengadilan ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="27">6</td>
        <td class=" position-relative text-center" colspan="1" rowspan="3" style="border-bottom:none;">
            <h6>RIWAYAT KELUARGA / SOSIAL</h6>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="7"> <span>1.</span> </td>
        <td class=" position-relative" colspan="8" rowspan="1"> <span>Dalam situasi seperti apakah Anda
                tinggal 3
                tahun belakangan ini ?</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="situasi_tinggal_text"
                    value="{{ $hasil_data->situasi_tinggal_text ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->situasi_tinggal_text ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Dengan pasangan & anak = 1</span>
        </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Dengan teman = 6</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="5">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control" name="situasi_tinggal_opsi">
                    @php $hasil_data_temp = $hasil_data->situasi_tinggal_opsi ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="2" @if ($hasil_data_temp == '2') selected @endif>2</option>
                    <option value="3" @if ($hasil_data_temp == '3') selected @endif>3</option>
                    <option value="4" @if ($hasil_data_temp == '4') selected @endif>4</option>
                    <option value="5" @if ($hasil_data_temp == '5') selected @endif>5</option>
                    <option value="6" @if ($hasil_data_temp == '6') selected @endif>6</option>
                    <option value="7" @if ($hasil_data_temp == '7') selected @endif>7</option>
                    <option value="8" @if ($hasil_data_temp == '8') selected @endif>8</option>
                    <option value="9" @if ($hasil_data_temp == '9') selected @endif>9</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->situasi_tinggal_opsi ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Dengan pasangan saja = 2</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Sendiri = 7</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Dengan anak saja = 3</span> </td>
        <td class=" position-relative" colspan="3" rowspan="1"> <span>Lingkungan terkontrol =8</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Dengan orang tua = 4</span> </td>
        <td class=" position-relative" colspan="3" rowspan="2"> <span>Kondisi yang tidak stabil = 9</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="2"
            style="border-top:none;border-bottom:none;"> <span>Tanggal asesmen</span> </td>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Dengan Keluarga = 5</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="9" rowspan="1">
            <h6>(Pilih situasi yang paling menggambarkan 3 tahun terakhir. Jika terdapat situasi yang berganti - ganti
                maka
                pilihlah situasi yang paling terakhir )</h6>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="2"
            style="border-bottom:none;border-top:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input type="date" class="form-control" name="riwayat_keluarga_sosial_tanggal_asesmen"
                    value="{{ $hasil_data->riwayat_keluarga_sosial_tanggal_asesmen ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ (isset($hasil_data->riwayat_keluarga_sosial_tanggal_asesmen) ? indonesian_date($hasil_data->riwayat_keluarga_sosial_tanggal_asesmen) : null) ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>2.</span> </td>
        <td class=" position-relative" colspan="8" rowspan="1"> <span>Apakah Anda hidup dengan seseorang
                yang
                mempunyai masalah penyalahgunaan zat sekarang ini ? Ya = 1 Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control "
                    name="hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_flag">
                    @php $hasil_data_temp = $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_flag ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_flag ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="7"> <span>3.</span> </td>
        <td class=" position-relative" colspan="9" rowspan="1"> <span>Jika ya, siapakah ia / mereka (
                contreng pada
                kolom berikut )</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>1</span> </td>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Saudara kandung / tiri</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control "
                    name="hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_saudara_kandung_tiri">
                    @php $hasil_data_temp = $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_saudara_kandung_tiri ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_saudara_kandung_tiri ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>2</span> </td>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Ayah / ibu</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control "
                    name="hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_ayah_ibu">
                    @php $hasil_data_temp = $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_ayah_ibu ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_ayah_ibu ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>3</span> </td>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Pasangan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control "
                    name="hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_pasangan">
                    @php $hasil_data_temp = $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_pasangan ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_pasangan ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>4</span> </td>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Om / tante</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control "
                    name="hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_om_tante">
                    @php $hasil_data_temp = $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_om_tante ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_om_tante ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> <span>Skala Penilaian Pasien</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>5</span> </td>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Teman</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control "
                    name="hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_teman">
                    @php $hasil_data_temp = $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_teman ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_teman ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>6</span> </td>
        <td class=" position-relative" colspan="5" rowspan="1"> <span>Lainnya :</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control "
                    name="hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_lainnya">
                    @php $hasil_data_temp = $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_lainnya ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->hidup_dengan_seseorang_yang_mempunyai_masalah_penyalahgunaan_zat_lainnya ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="2"
            style="border-bottom:none;border-top:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input style="line-height: 32px;font-size: 32px;height: 80px;" type="number" min="0"
                    max="9" oninput="validateInputSkalaPenilaian(this)" class="form-control text-center"
                    name="riwayat_keluarga_sosial_skala_penilaian_pasien"
                    value="{{ $hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '' }}">
            </div>
            <div class="medify-form-genv4-view-container">
                <h1>{{ $hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '' }}</h1>
            </div>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="11"> <span>4.</span> </td>
        <td class=" position-relative" colspan="9" rowspan="1"> <span>Apakah Anda memiliki konflik serius
                dalam
                berhubungan dengan :</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="7" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>30 hari terakhir</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Sepanjang hidup</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>1</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Ibu</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox" name="konflik_serius_dalam_hubungan_ibu_30_hari"
                    id="checkbox-input-fsa21sa" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_ibu_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-fsa21sa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_ibu_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_ibu_sepanjang_hidup" id="checkbox-input-sawq2e"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_ibu_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-sawq2e"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_ibu_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>2</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Ayah</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox" name="konflik_serius_dalam_hubungan_ayah_30_hari"
                    id="checkbox-input-sadfasa" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_ayah_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sadfasa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_ayah_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_ayah_sepanjang_hidup" id="checkbox-input-dsadas"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_ayah_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-dsadas"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_ayah_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>3</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Adik / Kakak</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_adik_kakak_30_hari" id="checkbox-input-sadadsdas"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_adik_kakak_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sadadsdas"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_adik_kakak_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_adik_kakak_sepanjang_hidup" id="checkbox-input-sadsdsaxas21"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_adik_kakak_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-sadsdsaxas21"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_adik_kakak_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>4</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Pasangan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_pasangan_30_hari" id="checkbox-input-sadsaxsa123"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_pasangan_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sadsaxsa123"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_pasangan_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_pasangan_sepanjang_hidup" id="checkbox-input-da21sa"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_pasangan_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-da21sa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_pasangan_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>5</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Anak-anak</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_anak_anak_30_hari" id="checkbox-input-das4sa"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_anak_anak_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-das4sa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_anak_anak_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_anak_anak_sepanjang_hidup" id="checkbox-input-asca325gdv"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_anak_anak_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-asca325gdv"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_anak_anak_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>6</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Keluarga lain yang berarti (
                jelaskan..)</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_keluarga_lain_30_hari" id="checkbox-input-aca23"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_keluarga_lain_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-aca23"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_keluarga_lain_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_keluarga_lain_sepanjang_hidup" id="checkbox-input-fas124sad"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_keluarga_lain_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-fas124sad"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_keluarga_lain_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>7</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Teman akrab</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_teman_akrab_30_hari" id="checkbox-input-casca213"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_teman_akrab_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-casca213"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_teman_akrab_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_teman_akrab_sepanjang_hidup" id="checkbox-input-sadsqew"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_teman_akrab_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-sadsqew"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_teman_akrab_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>8</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Tetangga</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_tetangga_30_hari" id="checkbox-input-vsaf12e"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_tetangga_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-vsaf12e"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_tetangga_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_tetangga_sepanjang_hidup" id="checkbox-input-sadsa54fd"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_tetangga_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-sadsa54fd"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_tetangga_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> <span>9</span> </td>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Teman sekerja</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_teman_sekerja_30_hari" id="checkbox-input-cas675fgdfs"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_teman_sekerja_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-cas675fgdfs"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_teman_sekerja_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="konflik_serius_dalam_hubungan_teman_sekerja_sepanjang_hidup" id="checkbox-input-sadsa54fd"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'konflik_serius_dalam_hubungan_teman_sekerja_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-sadsa54fd"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'konflik_serius_dalam_hubungan_teman_sekerja_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-top:none;"> </td>
        <td class=" position-relative" colspan="1" rowspan="1"> </td>
        <td class=" position-relative text-right" colspan="9" rowspan="1">
            <h6>( Ya = 1 Tidak = 0 )</h6>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="9">7</td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;">
            <h6>STATUS PSIKIATRIS</h6>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"> </td>
        <td class=" position-relative" colspan="7" rowspan="1"> <span>Apakah anda pernah mengalami hal-hal
                berikut
                ini ( yang bukan akibat langsung dari penggunaan Napza )</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>30 hari terakhir</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Sepanjang hidup</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> <span>Tanggal asesmen</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>1.</span> </td>
        <td class=" position-relative" colspan="7" rowspan="1"> <span>Mengalami depresi serius ( kesedihan,
                putus
                asa, kehilangan minar, susah konsentrasi )</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_depresi_serius_30_hari" id="checkbox-input-cas4asd"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_depresi_serius_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-cas4asd"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_depresi_serius_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_depresi_serius_sepanjang_hidup" id="checkbox-input-casc213sda"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_depresi_serius_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-casc213sda"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_depresi_serius_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input type="date" class="form-control" name="status_psikiatris_tanggal_asesmen"
                    value="{{ $hasil_data->status_psikiatris_tanggal_asesmen ?? '' }}">
            </div>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ (isset($hasil_data->status_psikiatris_tanggal_asesmen) ? indonesian_date($hasil_data->status_psikiatris_tanggal_asesmen) : null) ?? '' }}</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>2.</span> </td>
        <td class=" position-relative" colspan="7" rowspan="1"> <span>Mengalami rasa cemas serius /
                ketegangan,
                gelisah, merasa khawatir berlebihan ?</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_rasa_cemas_serius_30_hari" id="checkbox-input-sacas2ds"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_rasa_cemas_serius_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sacas2ds"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_rasa_cemas_serius_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_rasa_cemas_serius_sepanjang_hidup"
                    id="checkbox-input-csa23dssad" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_rasa_cemas_serius_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-csa23dssad"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_rasa_cemas_serius_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> <span>Skala Penilaian Pasien</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>3.</span> </td>
        <td class=" position-relative" colspan="7" rowspan="1"> <span>Mengalami halusainasi ( melihat /
                mendengar
                sesuatu yang tidak ada obyeknya )</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_halusinasi_30_hari" id="checkbox-input-csa359ds"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_halusinasi_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-csa359ds"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_halusinasi_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_halusinasi_sepanjang_hidup" id="checkbox-input-dsa123sd"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_halusinasi_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-dsa123sd"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_halusinasi_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>4.</span> </td>
        <td class=" position-relative" colspan="7" rowspan="1"> <span>Mengalami kesulitan mengingat atau
                fokus pada
                sesuatu</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_kesulitan_mengingat_fokus_30_hari" id="checkbox-input-acs32fs"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_kesulitan_mengingat_fokus_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-acs32fs"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_kesulitan_mengingat_fokus_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_kesulitan_mengingat_fokus_sepanjang_hidup"
                    id="checkbox-input-sadsa234sa" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_kesulitan_mengingat_fokus_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-sadsa234sa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_kesulitan_mengingat_fokus_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input style="line-height: 32px;font-size: 32px;height: 80px;" type="number" min="0"
                    max="9" oninput="validateInputSkalaPenilaian(this)" class="form-control text-center"
                    name="status_psikiatris_skala_penilaian_pasien"
                    value="{{ $hasil_data->status_psikiatris_skala_penilaian_pasien ?? '' }}">
            </div>
            <div class="medify-form-genv4-view-container">
                <h1>{{ $hasil_data->status_psikiatris_skala_penilaian_pasien ?? '' }}</h1>
            </div>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>5.</span> </td>
        <td class=" position-relative" colspan="7" rowspan="1"> <span>Mengalami kesukaran mengontrol
                perilaku kasar
                termasuk kemarahan atau kekerasan</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_kesukaran_kontrol_perilaku_kasar_30_hari"
                    id="checkbox-input-casc24saca" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_kesukaran_kontrol_perilaku_kasar_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-casc24saca"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_kesukaran_kontrol_perilaku_kasar_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_kesukaran_kontrol_perilaku_kasar_sepanjang_hidup"
                    id="checkbox-input-asdsa2fd" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_kesukaran_kontrol_perilaku_kasar_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-asdsa2fd"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_kesukaran_kontrol_perilaku_kasar_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>6.</span> </td>
        <td class=" position-relative" colspan="7" rowspan="1"> <span>Mengalami pikiran serius untuk bunuh
                diri
                ?</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_pikiran_serius_bunuh_diri_30_hari" id="checkbox-input-sda34"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_pikiran_serius_bunuh_diri_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sda34"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_pikiran_serius_bunuh_diri_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_pikiran_serius_bunuh_diri_sepanjang_hidup"
                    id="checkbox-input-asda214dsa" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_pikiran_serius_bunuh_diri_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-asda214dsa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_pikiran_serius_bunuh_diri_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-bottom:none;border-top:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>7.</span> </td>
        <td class=" position-relative" colspan="7" rowspan="1"> <span>Berusaha untuk bunuh diri ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_berusaha_untuk_bunuh_diri_30_hari" id="checkbox-input-sadd21sda"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_berusaha_untuk_bunuh_diri_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sadd21sda"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_berusaha_untuk_bunuh_diri_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_berusaha_untuk_bunuh_diri_sepanjang_hidup"
                    id="checkbox-input-casfas32qdfa" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_berusaha_untuk_bunuh_diri_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-casfas32qdfa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_berusaha_untuk_bunuh_diri_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-top:none;"> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>8.</span> </td>
        <td class=" position-relative" colspan="7" rowspan="1"> <span>Menerima pengobatan dari psikiater
                ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_pengobatan_dari_psikiater_30_hari" id="checkbox-input-dsa987dg"
                    value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_pengobatan_dari_psikiater_30_hari'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-dsa987dg"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_pengobatan_dari_psikiater_30_hari'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox"
                    name="hal_yang_bukan_dari_napza_pengobatan_dari_psikiater_sepanjang_hidup"
                    id="checkbox-input-sad13sad" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hal_yang_bukan_dari_napza_pengobatan_dari_psikiater_sepanjang_hidup'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="radio-input-sad13sad"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hal_yang_bukan_dari_napza_pengobatan_dari_psikiater_sepanjang_hidup'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td style="width: 4%" class=" position-relative" colspan="1" rowspan="18"> </td>
        <td style="width: 20%; border-bottom:none;" class=" position-relative text-center" colspan="1"
            rowspan="1">
            <h6>PEMERIKSAAN FISIK</h6>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>1.</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1" style="border-right:none"> <span>Tekanan
                darah</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-left:none;border-right:none;"> <span>:</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"
            style="border-left:none;border-right:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_tekanan_darah"
                    value="{{ $hasil_data->pemeriksaan_fisik_tekanan_darah ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_tekanan_darah ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1" style="border-left:none;">
            <span>mmHg</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="17" style="border-top:none;"> </td>
        <td style="width: 4%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>2.</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1" style="border-right:none">
            <span>Nadi</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-left:none;border-right:none;"> <span>:</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"
            style="border-left:none;border-right:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_nadi"
                    value="{{ $hasil_data->pemeriksaan_fisik_nadi ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container"> {{ $hasil_data->pemeriksaan_fisik_nadi ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1" style="border-left:none;">
            <span>x/menit</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>3.</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1" style="border-right:none"> <span>Pernapasan
                ( RR )</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-left:none;border-right:none;"> <span>:</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"
            style="border-left:none;border-right:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_pernapasan"
                    value="{{ $hasil_data->pemeriksaan_fisik_pernapasan ?? '' }}">
                <span class="medify-form-genv4-view-container">
                    {{ $hasil_data->pemeriksaan_fisik_pernapasan ?? '' }}</span>
            </div>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1" style="border-left:none;">
            <span>x/menit</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>4.</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1" style="border-right:none"> <span>Suhu (
                celcius )</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1"
            style="border-left:none;border-right:none;"> <span>:</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1"
            style="border-left:none;border-right:none;">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_suhu"
                    value="{{ $hasil_data->pemeriksaan_fisik_suhu ?? '' }}">
                <span class="medify-form-genv4-view-container">
                    {{ $hasil_data->pemeriksaan_fisik_suhu ?? '' }}</span>
            </div>
        </td>
        <td class=" position-relative" colspan="4" rowspan="1" style="border-left:none;"> <span>°C</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="5"> <span>5.</span> </td>
        <td class=" position-relative" colspan="9" rowspan="1">
            <h6>Pemeriksaan Sistemik :</h6>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Sistem Pencernaan</span>
        </td>
        <td class=" position-relative text-center" colspan="4" rowspan="1"> <span>Sistem Jantung dan
                Pembuluh Darah</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Sistem Pernapasan</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Sistem Saraf Pusat</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>THT dan Kulit</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Keterangan</span> </td>
    </tr>
    <tr>
        <td style="width: 9%" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_sistem_pencernaan_1"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pencernaan_1 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pencernaan_1 ?? '' }}</span>
        </td>
        <td style="width: 8%" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_a"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_a ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_a ?? '' }}</span>
        </td>
        <td style="width: 4%" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_b"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_b ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_b ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_c"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_c ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_c ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_d"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_d ?? '' }}">
                <span class="medify-form-genv4-view-container">
                    {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_1_d ?? '' }}</span>
            </div>
        </td>
        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_sistem_pernapasan_1"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pernapasan_1 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pernapasan_1 ?? '' }}</span>
        </td>
        <td style="width: 13%" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_saraf_pusat_1"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_saraf_pusat_1 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_saraf_pusat_1 ?? '' }}</span>
        </td>
        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_tht_dan_kulit_1"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_tht_dan_kulit_1 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_tht_dan_kulit_1 ?? '' }}</span>
        </td>
        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_keterangan_1"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_keterangan_1 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_keterangan_1 ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_sistem_pencernaan_2"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pencernaan_2 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pencernaan_2 ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2_a"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2 ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2_b"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2_b ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2_b ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2_c"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2_c ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2_c ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2_d"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2_d ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_2_d ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_sistem_pernapasan_2"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pernapasan_2 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pernapasan_2 ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_saraf_pusat_2"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_saraf_pusat_2 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_saraf_pusat_2 ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_tht_dan_kulit_2"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_tht_dan_kulit_2 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_tht_dan_kulit_2 ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_keterangan_2"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_keterangan_2 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_keterangan_2 ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_sistem_pencernaan_3"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pencernaan_3 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pencernaan_3 ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_a"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_a ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_a ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_b"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_b ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_b ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_c"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_c ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_c ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_d"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_d ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_jantung_dan_pembuluh_darah_3_d ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_sistem_pernapasan_3"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pernapasan_3 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_pernapasan_3 ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control"
                    name="pemeriksaan_fisik_sistematik_sistem_saraf_pusat_3"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_saraf_pusat_3 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_sistem_saraf_pusat_3 ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_tht_dan_kulit_3"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_tht_dan_kulit_3 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_tht_dan_kulit_3 ?? '' }}</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input type="text" class="form-control" name="pemeriksaan_fisik_sistematik_keterangan_3"
                    value="{{ $hasil_data->pemeriksaan_fisik_sistematik_keterangan_3 ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_keterangan_3 ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="9"> <span>6.</span> </td>
        <td class=" position-relative" colspan="9" rowspan="1">
            <h6>Hasil Urinalisis :</h6>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="9" rowspan="1"> <span>Jenis Zat</span> </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Benzodiazepin</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="pemeriksaan_fisik_sistematik_urinalis_benzodiazepin">
                    @php $hasil_data_temp = $hasil_data->pemeriksaan_fisik_sistematik_urinalis_benzodiazepin  ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_urinalis_benzodiazepin ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Kanabis</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="pemeriksaan_fisik_sistematik_urinalis_kanabis">
                    @php $hasil_data_temp = $hasil_data->pemeriksaan_fisik_sistematik_urinalis_kanabis  ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_urinalis_kanabis ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Opiat</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="pemeriksaan_fisik_sistematik_urinalis_opiat">
                    @php $hasil_data_temp = $hasil_data->pemeriksaan_fisik_sistematik_urinalis_opiat  ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_urinalis_opiat ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Amfetamin</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="pemeriksaan_fisik_sistematik_urinalis_anfetamin">
                    @php $hasil_data_temp = $hasil_data->pemeriksaan_fisik_sistematik_urinalis_anfetamin  ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_urinalis_anfetamin ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Kokain</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="pemeriksaan_fisik_sistematik_urinalis_kokain">
                    @php $hasil_data_temp = $hasil_data->pemeriksaan_fisik_sistematik_urinalis_kokain  ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_urinalis_kokain ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Barbiturat</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="pemeriksaan_fisik_sistematik_urinalis_barbiturat">
                    @php $hasil_data_temp = $hasil_data->pemeriksaan_fisik_sistematik_urinalis_barbiturat  ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_urinalis_barbiturat ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="6" rowspan="1"> <span>Alkohol</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Ya = 1</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>Tidak = 0</span> </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <select class="form-control " name="pemeriksaan_fisik_sistematik_urinalis_alkohol">
                    @php $hasil_data_temp = $hasil_data->pemeriksaan_fisik_sistematik_urinalis_alkohol  ?? '' @endphp
                    <option value="1" @if ($hasil_data_temp == '1') selected @endif>1</option>
                    <option value="0" @if ($hasil_data_temp == '0') selected @endif>0</option>
                </select>
            </div>
            <span class="medify-form-genv4-view-container">
                {{ $hasil_data->pemeriksaan_fisik_sistematik_urinalis_alkohol ?? '' }}</span>
        </td>
    </tr>
</table>

<div style="margin: 20px 0;" class="space"></div>
<pagebreak />

<br><br><br>
<table style="width:100%">
    <tr style="border-top: 2px solid #000;">
        <td style="text-align:center;" class=" position-relative" colspan="1" rowspan="1">
            <h5 class="mb-0">HASIL ASESMEN WAJIB LAPOR & REHABILITASI MEDIS</h5>
        </td>
    </tr>
</table>
<br>
<table class="c-table--bordered" style="width:100%">
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1" style="border-right:none;"> <span>Tanggal
                Kedatangan</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-left:none;"> <span>:</span>
        </td>
        <td class=" position-relative" colspan="10" rowspan="1">
            @if ($kasus->tipe_rj == 1 && $kasus->tipe_igd == 0 && $kasus->tipe_ri == 0)
                <span>{{ ($kasus->mrs_at_rajal ? indonesian_date($kasus->mrs_at_rajal) : null) ?? ($kasus->rawat_jalan_transaksi_first ? indonesian_date($kasus->rawat_jalan_transaksi_first->ordered_at) : '') }}</span>
            @elseif ($kasus->tipe_rj == 0 && $kasus->tipe_igd == 0 && $kasus->tipe_ri == 1)
                <span>{{ ($kasus->mrs_at ? indonesian_date($kasus->mrs_at) : null) ?? ($kasus->created_at ? indonesian_date($kasus->created_at) : null) }}</span>
            @elseif ($kasus->tipe_rj == 0 && $kasus->tipe_igd == 1 && $kasus->tipe_ri == 0)
                <span>{{ ($kasus->mrs_at ? indonesian_date($kasus->mrs_at) : null) ?? ($kasus->created_at ? indonesian_date($kasus->created_at) : null) }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1" style="border-right:none;"> <span>Nomor
                Rekam Medik</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-left:none"> <span>:</span>
        </td>
        <td class=" position-relative" colspan="10" rowspan="1">
            {{ $kasus->pasien->no_rm ?? '' }}
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1" style="border-right:none;">
            <span>Nama</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-left:none"> <span>:</span>
        </td>
        <td class=" position-relative" colspan="10" rowspan="1">
            {{ $kasus->pasien->name }}
        </td>
    </tr>
    <tr>
        <td style="width: 18%" class=" position-relative text-center" colspan="1" rowspan="8">
            <h5>KESIMPULAN</h5>
        </td>
        <td class=" position-relative" colspan="2" rowspan="2"> </td>
        <td class=" position-relative text-center" colspan="10" rowspan="1"> <span>MASALAH YANG
                DIHADAPI</span> </td>
    </tr>
    <tr>
        <td style="width: 5.8%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>0</span>
        </td>
        <td style="width: 5.8%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>1</span>
        </td>
        <td style="width: 5.8%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>2</span>
        </td>
        <td style="width: 5.8%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>3</span>
        </td>
        <td style="width: 5.8%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>4</span>
        </td>
        <td style="width: 5.8%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>5</span>
        </td>
        <td style="width: 5.8%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>6</span>
        </td>
        <td style="width: 5.8%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>7</span>
        </td>
        <td style="width: 5.8%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>8</span>
        </td>
        <td style="width: 5.8%" class=" position-relative text-center" colspan="1" rowspan="1">
            <span>9</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Medis</span> </td>
        <td id="status_medis_skala_penilaian_pasien_kesimpulan_0"
            class=" position-relative @if (($hasil_data->status_medis_skala_penilaian_pasien ?? '') == 0) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_medis_skala_penilaian_pasien_kesimpulan_1"
            class=" position-relative @if (($hasil_data->status_medis_skala_penilaian_pasien ?? '') == 1) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_medis_skala_penilaian_pasien_kesimpulan_2"
            class=" position-relative @if (($hasil_data->status_medis_skala_penilaian_pasien ?? '') == 2) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_medis_skala_penilaian_pasien_kesimpulan_3"
            class=" position-relative @if (($hasil_data->status_medis_skala_penilaian_pasien ?? '') == 3) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_medis_skala_penilaian_pasien_kesimpulan_4"
            class=" position-relative @if (($hasil_data->status_medis_skala_penilaian_pasien ?? '') == 4) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_medis_skala_penilaian_pasien_kesimpulan_5"
            class=" position-relative @if (($hasil_data->status_medis_skala_penilaian_pasien ?? '') == 5) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_medis_skala_penilaian_pasien_kesimpulan_6"
            class=" position-relative @if (($hasil_data->status_medis_skala_penilaian_pasien ?? '') == 6) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_medis_skala_penilaian_pasien_kesimpulan_7"
            class=" position-relative @if (($hasil_data->status_medis_skala_penilaian_pasien ?? '') == 7) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_medis_skala_penilaian_pasien_kesimpulan_8"
            class=" position-relative @if (($hasil_data->status_medis_skala_penilaian_pasien ?? '') == 8) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_medis_skala_penilaian_pasien_kesimpulan_9"
            class=" position-relative @if (($hasil_data->status_medis_skala_penilaian_pasien ?? '') == 9) filled @endif" colspan="1"
            rowspan="1">
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Pekerjaan/Dukungan</span> </td>
        <td id="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_0"
            class=" position-relative @if (($hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '') == 0) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_1"
            class=" position-relative @if (($hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '') == 1) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_2"
            class=" position-relative @if (($hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '') == 2) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_3"
            class=" position-relative @if (($hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '') == 3) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_4"
            class=" position-relative @if (($hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '') == 4) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_5"
            class=" position-relative @if (($hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '') == 5) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_6"
            class=" position-relative @if (($hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '') == 6) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_7"
            class=" position-relative @if (($hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '') == 7) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_8"
            class=" position-relative @if (($hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '') == 8) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_9"
            class=" position-relative @if (($hasil_data->status_pekerjaan_dukungan_hidup_skala_penilaian_pasien ?? '') == 9) filled @endif" colspan="1"
            rowspan="1">
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Napza</span> </td>
        <td id="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_0"
            class=" position-relative @if (($hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '') == 0) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_1"
            class=" position-relative @if (($hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '') == 1) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_2"
            class=" position-relative @if (($hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '') == 2) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_3"
            class=" position-relative @if (($hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '') == 3) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_4"
            class=" position-relative @if (($hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '') == 4) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_5"
            class=" position-relative @if (($hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '') == 5) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_6"
            class=" position-relative @if (($hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '') == 6) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_7"
            class=" position-relative @if (($hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '') == 7) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_8"
            class=" position-relative @if (($hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '') == 8) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_9"
            class=" position-relative @if (($hasil_data->status_penggunaan_narkotika_skala_penilaian_pasien ?? '') == 9) filled @endif" colspan="1"
            rowspan="1">
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Legal</span> </td>
        <td id="status_legal_skala_penilaian_pasien_kesimpulan_0"
            class=" position-relative @if (($hasil_data->status_legal_skala_penilaian_pasien ?? '') == 0) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_legal_skala_penilaian_pasien_kesimpulan_1"
            class=" position-relative @if (($hasil_data->status_legal_skala_penilaian_pasien ?? '') == 1) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_legal_skala_penilaian_pasien_kesimpulan_2"
            class=" position-relative @if (($hasil_data->status_legal_skala_penilaian_pasien ?? '') == 2) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_legal_skala_penilaian_pasien_kesimpulan_3"
            class=" position-relative @if (($hasil_data->status_legal_skala_penilaian_pasien ?? '') == 3) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_legal_skala_penilaian_pasien_kesimpulan_4"
            class=" position-relative @if (($hasil_data->status_legal_skala_penilaian_pasien ?? '') == 4) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_legal_skala_penilaian_pasien_kesimpulan_5"
            class=" position-relative @if (($hasil_data->status_legal_skala_penilaian_pasien ?? '') == 5) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_legal_skala_penilaian_pasien_kesimpulan_6"
            class=" position-relative @if (($hasil_data->status_legal_skala_penilaian_pasien ?? '') == 6) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_legal_skala_penilaian_pasien_kesimpulan_7"
            class=" position-relative @if (($hasil_data->status_legal_skala_penilaian_pasien ?? '') == 7) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_legal_skala_penilaian_pasien_kesimpulan_8"
            class=" position-relative @if (($hasil_data->status_legal_skala_penilaian_pasien ?? '') == 8) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_legal_skala_penilaian_pasien_kesimpulan_9"
            class=" position-relative @if (($hasil_data->status_legal_skala_penilaian_pasien ?? '') == 9) filled @endif" colspan="1"
            rowspan="1">
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Keluarga/sosial</span> </td>
        <td id="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_0"
            class=" position-relative @if (($hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '') == 0) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_1"
            class=" position-relative @if (($hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '') == 1) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_2"
            class=" position-relative @if (($hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '') == 2) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_3"
            class=" position-relative @if (($hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '') == 3) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_4"
            class=" position-relative @if (($hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '') == 4) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_5"
            class=" position-relative @if (($hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '') == 5) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_6"
            class=" position-relative @if (($hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '') == 6) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_7"
            class=" position-relative @if (($hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '') == 7) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_8"
            class=" position-relative @if (($hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '') == 8) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_9"
            class=" position-relative @if (($hasil_data->riwayat_keluarga_sosial_skala_penilaian_pasien ?? '') == 9) filled @endif" colspan="1"
            rowspan="1">
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1"> <span>Psikiatris</span> </td>
        <td id="status_psikiatris_skala_penilaian_pasien_kesimpulan_0"
            class=" position-relative @if (($hasil_data->status_psikiatris_skala_penilaian_pasien ?? '') == 0) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_psikiatris_skala_penilaian_pasien_kesimpulan_1"
            class=" position-relative @if (($hasil_data->status_psikiatris_skala_penilaian_pasien ?? '') == 1) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_psikiatris_skala_penilaian_pasien_kesimpulan_2"
            class=" position-relative @if (($hasil_data->status_psikiatris_skala_penilaian_pasien ?? '') == 2) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_psikiatris_skala_penilaian_pasien_kesimpulan_3"
            class=" position-relative @if (($hasil_data->status_psikiatris_skala_penilaian_pasien ?? '') == 3) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_psikiatris_skala_penilaian_pasien_kesimpulan_4"
            class=" position-relative @if (($hasil_data->status_psikiatris_skala_penilaian_pasien ?? '') == 4) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_psikiatris_skala_penilaian_pasien_kesimpulan_5"
            class=" position-relative @if (($hasil_data->status_psikiatris_skala_penilaian_pasien ?? '') == 5) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_psikiatris_skala_penilaian_pasien_kesimpulan_6"
            class=" position-relative @if (($hasil_data->status_psikiatris_skala_penilaian_pasien ?? '') == 6) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_psikiatris_skala_penilaian_pasien_kesimpulan_7"
            class=" position-relative @if (($hasil_data->status_psikiatris_skala_penilaian_pasien ?? '') == 7) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_psikiatris_skala_penilaian_pasien_kesimpulan_8"
            class=" position-relative @if (($hasil_data->status_psikiatris_skala_penilaian_pasien ?? '') == 8) filled @endif" colspan="1"
            rowspan="1">
        </td>
        <td id="status_psikiatris_skala_penilaian_pasien_kesimpulan_9"
            class=" position-relative @if (($hasil_data->status_psikiatris_skala_penilaian_pasien ?? '') == 9) filled @endif" colspan="1"
            rowspan="1">
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="2"> <span>DIAGNOSA KERJA</span>
        </td>
        <td class=" position-relative" colspan="10" rowspan="1"> <span>Klien memenuhi kriteria diagnosis
                Napza</span> </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            {{ $kasus->diagnosisUtama ? $kasus->diagnosisUtama->icd10->code_icd : '' }}
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-right:none;"> <span>Diagnosis
                lainnya</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-left:none;"> <span>:</span>
        </td>
        <td class=" position-relative" colspan="10" rowspan="1">
            <textarea name="kesimpulan_diagnosis_lainnya" class="form-control">{{ $hasil_data->kesimpulan_diagnosis_lainnya ?? '' }}</textarea>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="10"> <span>RENCANA TERAPI DAN
                REHABILITASI</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-right:none;"> <span>Resume
                Masalah</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-left:none;"> <span>:</span>
        </td>
        <td class=" position-relative" colspan="10" rowspan="1">
            <textarea name="kesimpulan_resume_masalah" class="form-control">{{ $hasil_data->kesimpulan_resume_masalah ?? '' }}</textarea>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="9" style="border-right:none;"> <span>Rencana
                Tindak Lanjut</span> </td>
        <td class=" position-relative" colspan="1" rowspan="9" style="border-left:none;"> <span>:</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="checkbox" name="tindak_lanjut_asesmen_lanjutan"
                    id="checkbox-input-dasdqe" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tindak_lanjut_asesmen_lanjutan'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-dasdqe"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tindak_lanjut_asesmen_lanjutan'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
            <span>1</span>
        </td>
        <td class=" position-relative" colspan="9" rowspan="1"> <span>Asesmen lanjutan / mendalam</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="checkbox" name="tindak_lanjut_evaluasi_psikologis"
                    id="checkbox-input-sda213wadsa" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tindak_lanjut_evaluasi_psikologis'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sda213wadsa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tindak_lanjut_evaluasi_psikologis'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
            <span>2</span>
        </td>
        <td class=" position-relative" colspan="9" rowspan="1"> <span>Evaluasi Psikologis</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="checkbox" name="tindak_lanjut_program_detoksifikasi"
                    id="checkbox-input-sda23ds" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tindak_lanjut_program_detoksifikasi'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sda23ds"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tindak_lanjut_program_detoksifikasi'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
            <span>3</span>
        </td>
        <td class=" position-relative" colspan="9" rowspan="1"> <span>Program Detoksifikasi</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="checkbox" name="tindak_lanjut_wawancara_motivasional"
                    id="checkbox-input-sda23dasdas12" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tindak_lanjut_wawancara_motivasional'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sda23dasdas12"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tindak_lanjut_wawancara_motivasional'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
            <span>4</span>
        </td>
        <td class=" position-relative" colspan="9" rowspan="1"> <span>Wawancara Motivasional</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="checkbox" name="tindak_lanjut_intervensi_singkat"
                    id="checkbox-input-asdas21" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tindak_lanjut_intervensi_singkat'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-asdas21"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tindak_lanjut_intervensi_singkat'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
            <span>5</span>
        </td>
        <td class=" position-relative" colspan="9" rowspan="1"> <span>Intervensi Singkat</span> </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="checkbox" name="tindak_lanjut_terapi_rumatanu"
                    id="checkbox-input-dsad" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tindak_lanjut_terapi_rumatanu'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-dsad"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tindak_lanjut_terapi_rumatanu'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
            <span>6</span>
        </td>
        <td class=" position-relative" colspan="9" rowspan="1"> <span>Terapi Rumatanu</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="checkbox" name="tindak_lanjut_rehabilitasi_rawat_inap"
                    id="checkbox-input-sad23sdasad" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tindak_lanjut_rehabilitasi_rawat_inap'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sad23sdasad"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tindak_lanjut_rehabilitasi_rawat_inap'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
            <span>7</span>
        </td>
        <td class=" position-relative" colspan="9" rowspan="1"> <span>Rehabilitasi Rawat Inap</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="checkbox" name="tindak_lanjut_konselingu"
                    id="checkbox-input-sda06ds" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tindak_lanjut_konselingu'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sda06ds"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tindak_lanjut_konselingu'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
            <span>8</span>
        </td>
        <td class=" position-relative" colspan="9" rowspan="1">
            <span>Konselingu</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input" type="checkbox" name="tindak_lain_lain"
                    id="checkbox-input-sadsa132sada12" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tindak_lain_lain'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif> <label class="form-check-label"
                    for="checkbox-input-sadsa132sada12"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tindak_lain_lain'} ?? '' @endphp @if ($hasil_data_temp == 'Ya')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
            <span>9</span>
        </td>
        <td class=" position-relative" colspan="9" rowspan="1">
            <span>Lain-lain</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>PETUGAS ASESMEN</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-right:none;"> <span>Tanda
                tangan/ Nama jelas</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-left:none;"> <span>:</span>
        </td>
        <td class=" position-relative text-center" colspan="10" rowspan="1">
            @if (($hasil_data->{'petugas_asesmen'} ?? '') != '')
                @if (file_exists($hasil_data->{'ttd_petugas_asesmen'} ?? ('' ?? '')))
                    <div>
                        <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;"
                            src="{{ url('') }}/{{ $hasil_data->{'ttd_petugas_asesmen'} }}"
                            alt="Tanda tangan">
                    </div>
                @else
                    <br><br><br><br>
                @endif
                <div>( <span>{{ $hasil_data->{'petugas_asesmen'} ?? '' }}</span> )</div>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>MENGETAHUI DOKTER</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-right:none;"> <span>Tanda
                tangan/ Nama jelas</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-left:none;"> <span>:</span>
        </td>
        <td class=" position-relative text-center" colspan="10" rowspan="1">
            @if ($action != 'view')
                @php $hasil_data_temp = $hasil_data->{'mengetahui_dokter'} ?? ($kasus->dpjp ? $kasus->dpjp->user->name : null) ?? '' @endphp
                <span>
                    <select class="js-select2 form-control" id="selectTtdMengetahuiDokter"
                        name="selectTtdMengetahuiDokter">
                        @if ($hasil_data_temp != '')
                            <option selected>{{ $hasil_data_temp ?? '' }}</option>
                        @endif
                    </select>
                </span>
                <span>
                    <input type="hidden" class="form-control" id="mengetahui_dokter" name="mengetahui_dokter"
                        value="{{ $hasil_data->{'mengetahui_dokter'} ?? (($kasus->dpjp ? $kasus->dpjp->user->name : null) ?? '') }}">
                    <input type="hidden" class="form-control" id="ttd_mengetahui_dokter"
                        name="ttd_mengetahui_dokter"
                        value="{{ $hasil_data->{'ttd_mengetahui_dokter'} ?? (($kasus->dpjp ? $kasus->dpjp->user->ttd : null) ?? '') }}">
                </span>
            @else
                @if (($hasil_data->{'mengetahui_dokter'} ?? '') != '')
                    @if (file_exists($hasil_data->{'ttd_mengetahui_dokter'} ?? ('' ?? '')))
                        <div>
                            <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;"
                                src="{{ url('') }}/{{ $hasil_data->{'ttd_mengetahui_dokter'} }}"
                                alt="Tanda tangan">
                        </div>
                    @else
                        <br><br><br><br>
                    @endif
                    <div>( <span>{{ $hasil_data->{'mengetahui_dokter'} ?? '' }}</span> )</div>
                @else
                    <br><br><br><br>
                    <div>( .................................... )</div>
                @endif
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"> <span>MENYETUJUI PASIEN</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-right:none;"> <span>Tanda
                tangan/ Nama jelas</span> </td>
        <td class=" position-relative" colspan="1" rowspan="1" style="border-left:none;"> <span>:</span>
        </td>
        <td class=" position-relative text-center" colspan="10" rowspan="1">
            @if (($hasil_data->{'persetujuan_pasien'} ?? '') != '')
                @if (file_exists($hasil_data->{'ttd_persetujuan_pasien'} ?? ('' ?? '')))
                    <div>
                        <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;"
                            src="{{ url('') }}/{{ $hasil_data->{'ttd_persetujuan_pasien'} }}"
                            alt="Tanda tangan">
                    </div>
                @else
                    <br><br><br><br>
                @endif
                <div>( <span>{{ $hasil_data->{'persetujuan_pasien'} ?? '' }}</span> )</div>
            @else
                <br><br><br><br>
                <div>( .................................... )</div>
            @endif
        </td>
    </tr>
</table>
