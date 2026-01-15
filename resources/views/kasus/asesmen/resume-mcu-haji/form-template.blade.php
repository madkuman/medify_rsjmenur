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

    table th tr td {
        padding: 2px 3px;
        height: 16px;
        border: 1px solid black;
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
                height="150">
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
<div class="container">
    <div class="row">
        <div class="col">
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
                    <td>No. HP</td>
                    <td>:</td>
                    <td> {{ $kasus->identitas->no_hp }}</td>
                </tr>
                <tr>
                    <td>No. Porsi</td>
                    <td>:</td>
                    <td><input type="text" class="form-control form-control-sm" name="nomor_porsi"
                            value="{{ $hasil_data->nomor_porsi ?? '' }}"></td>
                </tr>
            </table>
        </div>
        <div class="col">
            <div class="form-group row">
                <label for="tanggal_pemeriksaan" class="col-sm-2 col-form-label col-form-label-sm">Tanggal
                    Pemeriksaan</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control form-control-sm" id="tanggal_pemeriksaan" placeholder=""
                        name="tanggal_pemeriksaan" value="{{ $hasil_data->tanggal_pemeriksaan ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="selectPsikolog" class="col-sm-2 col-form-label col-form-label-sm">Psikolog</label>
                <div class="col-sm-10">
                    @php $hasil_data_temp = $hasil_data->{'psikolog'} ?? '' @endphp
                    <select class="form-control js-select2" style="width: 100%" id="selectPsikolog"
                        name="selectPsikolog">
                        @if ($hasil_data_temp != '')
                            <option selected>{{ $hasil_data_temp ?? '' }}</option>
                        @endif
                    </select>
                    <input type="hidden" class="form-control" id="psikolog" name="psikolog"
                        value="{{ $hasil_data->{'psikolog'} ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="selectDokterUmum" class="col-sm-2 col-form-label col-form-label-sm">Dokter Umum</label>
                <div class="col-sm-10">
                    @php $hasil_data_temp = $hasil_data->{'dokter_umum'} ?? '' @endphp
                    <select class="form-control js-select2" style="width: 100%" id="selectDokterUmum"
                        name="selectDokterUmum">
                        @if ($hasil_data_temp != '')
                            <option selected>{{ $hasil_data_temp ?? '' }}</option>
                        @endif
                    </select>
                    <input type="hidden" class="form-control" id="dokter_umum" name="dokter_umum"
                        value="{{ $hasil_data->{'dokter_umum'} ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="selectDokterSppd" class="col-sm-2 col-form-label col-form-label-sm">Dokter Sp.PD</label>
                <div class="col-sm-10">
                    @php $hasil_data_temp = $hasil_data->{'dokter_sppd'} ?? '' @endphp
                    <select class="form-control js-select2" style="width: 100%" id="selectDokterSppd"
                        name="selectDokterSppd">
                        @if ($hasil_data_temp != '')
                            <option selected>{{ $hasil_data_temp ?? '' }}</option>
                        @endif
                    </select>
                    <input type="hidden" class="form-control" id="dokter_sppd" name="dokter_sppd"
                        value="{{ $hasil_data->{'dokter_sppd'} ?? '' }}">
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<table class="table-primary" style="width:100%;">
    <tr>
        <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
            <h5>ANAMNESIS</h5>
        </td>
    </tr>
</table>
<div class="form-group">
    <label for="inputEmail4">1. Keluhan saat ini / Riwayat kesehatan sekarang :</label>
    <textarea class="form-control" name="keluhan_saat_ini" id="" cols="30" rows="3">{{ $hasil_data->keluhan_saat_ini ?? '' }}</textarea>
</div>
<div class="form-group">
    <label for="inputEmail4">2. Riwayat penyakit dahulu, beserta obat yang rutin diminum (DM, HT, Jantung, Asma, Stroke,
        Alergi, dll) :</label>
    <br>

    <textarea class="form-control" name="riwayat_penyakit_dahulu" id="" cols="30" rows="3">{{ $hasil_data->riwayat_penyakit_dahulu ?? '' }}</textarea>
</div>
<div class="form-group">
    <label for="inputEmail4">3. Obat yang rutin dikonsumsi :</label>
    <br>

    <textarea class="form-control" name="obat_yang_rutin_dikonsumsi" id="" cols="30" rows="3">{{ $hasil_data->obat_yang_rutin_dikonsumsi ?? '' }}</textarea>
</div>
<div class="form-group">
    <label for="inputEmail4">4. Data alergi obat :</label>
    <br>

    <textarea class="form-control" name="data_alergi_obat" id="" cols="30" rows="3">{{ $hasil_data->data_alergi_obat ?? '' }}</textarea>
</div>
<div class="form-group">
    @php
        $array_penyakit_keluarga = $hasil_data->{'riwayat_penyakit_keluarga'} ?? [];
    @endphp
    <label for="inputEmail4">5. Riwayat penyakit keluarga :</label>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_penyakit_keluarga[]" id="tidak_ada"
            value="tidak ada" {{ in_array('tidak ada', $array_penyakit_keluarga) ? 'checked' : '' }}>
        <label class="form-check-label" for="tidak_ada">Tidak Ada</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_penyakit_keluarga[]" id="hipertensi"
            value="hipertensi" {{ in_array('hipertensi', $array_penyakit_keluarga) ? 'checked' : '' }}>
        <label class="form-check-label" for="hipertensi">Hipertensi</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_penyakit_keluarga[]" id="jiwa"
            value="jiwa" {{ in_array('jiwa', $array_penyakit_keluarga) ? 'checked' : '' }}>
        <label class="form-check-label" for="jiwa">Jiwa</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_penyakit_keluarga[]" id="gagal_ginjal"
            value="gagal ginjal" {{ in_array('gagal_ginjal', $array_penyakit_keluarga) ? 'checked' : '' }}>
        <label class="form-check-label" for="gagal_ginjal">Gagal Ginjal</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_penyakit_keluarga[]" id="diabetes"
            value="diabetes" {{ in_array('diabetes', $array_penyakit_keluarga) ? 'checked' : '' }}>
        <label class="form-check-label" for="diabetes">Diabetes Melitus</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_penyakit_keluarga[]" id="jantung"
            value="jantung" {{ in_array('jantung', $array_penyakit_keluarga) ? 'checked' : '' }}>
        <label class="form-check-label" for="jantung">Penyakit Jantung</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_penyakit_keluarga[]" id="alergi"
            value="alergi" {{ in_array('alergi', $array_penyakit_keluarga) ? 'checked' : '' }}>
        <label class="form-check-label" for="alergi">Alergi</label>
    </div>
    <label class="form-check-label" for="inlineCheckbox2">Lainnya</label>
    <input type="text" class="form-control" name="riwayat_penyakit_keluarga_lainnya"
        value="{{ $hasil_data->riwayat_penyakit_keluarga_lainnya ?? '' }}">
    {{-- <textarea class="form-control" name="riwayat_penyakit_keluarga" id="" cols="30" rows="3">{{ $hasil_data->riwayat_penyakit_keluarga ?? '' }}</textarea> --}}
</div>
<div class="form-group">
    <label for="inputEmail4">6. Apakah ada riwayat serangan jantung sebelumnya?</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" id="tidak" name="is_riwayat_jantung" value="tidak"
            @php $hasil_data_temp=$hasil_data->{'is_riwayat_jantung'} ?? '' @endphp
            @if ($hasil_data_temp == 'tidak') checked @endif>
        <label class="form-check-label" for="tidak">
            Tidak
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" id="ya" name="is_riwayat_jantung" value="ya"
            @php $hasil_data_temp=$hasil_data->{'is_riwayat_jantung'} ?? '' @endphp
            @if ($hasil_data_temp == 'ya') checked @endif>
        <label class="form-check-label" for="ya">
            Ya, terakhir kali serangan
        </label>
        <input class="form-control" type="text" name="terakhir_kali_serangan" placeholder="">
    </div>
</div>
<div class="form-group">
    @php
        $array_riwayat_sosial = $hasil_data->{'riwayat_sosial'} ?? [];
    @endphp
    <label for="inputEmail4">7. Riwayat sosial / kebiasaan :</label>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_sosial[]" id="tidak_ada_riwayat_sosial"
            value="tidak ada" {{ in_array('tidak ada', $array_riwayat_sosial) ? 'checked' : '' }}>
        <label class="form-check-label" for="tidak_ada_riwayat_sosial">Tidak Ada</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_sosial[]" id="merokok" value="merokok"
            {{ in_array('merokok', $array_riwayat_sosial) ? 'checked' : '' }}>
        <label class="form-check-label" for="merokok">Merokok</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_sosial[]" id="minum_alkohol"
            value="minum alkohol" {{ in_array('minum alkohol', $array_riwayat_sosial) ? 'checked' : '' }}>
        <label class="form-check-label" for="minum_alkohol">Minum Alkohol</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_sosial[]" id="minum_kopi" value="minum kopi"
            {{ in_array('minum kopi', $array_riwayat_sosial) ? 'checked' : '' }}>
        <label class="form-check-label" for="minum_kopi">Minum Kopi</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_sosial[]" id="penyalahgunaan_obat"
            value="penyalahgunaan obat" {{ in_array('penyalahgunaan obat', $array_riwayat_sosial) ? 'checked' : '' }}>
        <label class="form-check-label" for="penyalahgunaan_obat">Penyalahgunaan Obat</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_sosial[]" id="terpapar_zat_berbahaya"
            value="terpapar zat berbahaya"
            {{ in_array('terpapar zat berbahaya', $array_riwayat_sosial) ? 'checked' : '' }}>
        <label class="form-check-label" for="terpapar_zat_berbahaya">Terpapar Zat Berbahaya</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="riwayat_sosial[]" id="konsumsi_obat_rutin"
            value="konsumsi obat rutin" {{ in_array('konsumsi obat rutin', $array_riwayat_sosial) ? 'checked' : '' }}>
        <label class="form-check-label" for="konsumsi_obat_rutin">Konsumsi Obat Rutin</label>
    </div>
    <label class="form-check-label" for="inlineCheckbox2">Lainnya</label>
    <input type="text" class="form-control" name="riwayat_sosial_lainnya"
        value="{{ $hasil_data->riwayat_sosial_lainnya ?? '' }}">
</div>
<br><br>
<table class="table-success" style="width:100%;">
    <tr>
        <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
            <h5>PEMERIKSAAN FISIK</h5>
        </td>
    </tr>
</table>
<br>
<table class="table-success" style="width: 100%">
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="sistol">Sistol</label>
            <input type="number" class="form-control" id="sistol" name="sistol"
                value="{{ $vital_sign->sistol ?? '' }}" readonly>
        </div>
        <div class="form-group col-md-2">
            <label for="diastol">Diastol</label>
            <input type="number" class="form-control" id="diastol" name="diastol"
                value="{{ $vital_sign->diastol ?? '' }}" readonly>
        </div>
        <div class="form-group col-md-2">
            <label for="nadi">Nadi</label>
            <input type="number" class="form-control" id="nadi" name="nadi"
                value="{{ $vital_sign->nadi ?? '' }}" readonly>
        </div>
        <div class="form-group col-md-2">
            <label for="suhu">Suhu</label>
            <input type="number" class="form-control" id="suhu" name="suhu"
                value="{{ $vital_sign->temperatur ?? '' }}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label for="rr">RR</label>
            <input type="number" class="form-control" id="rr" name="rr"
                value="{{ $vital_sign->pernapasan ?? '' }}" readonly>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="lingkar_perut">Lingkar Perut</label>
            <input type="number" class="form-control" id="lingkar_perut" name="lingkar_perut"
                value="{{ $hasil_data->lingkar_perut ?? '' }}">
        </div>
        <div class="form-group col-md-4">
            <label for="visus_od">Visus OD</label>
            <input type="text" class="form-control" id="visus_od" name="visus_od"
                value="{{ $hasil_data->visus_od ?? '' }}">
        </div>
        <div class="form-group col-md-4">
            <label for="visus_os">Visus OS</label>
            <input type="text" class="form-control" id="visus_os" name="visus_os"
                value="{{ $hasil_data->visus_os ?? '' }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="bb">BB (Kg)</label>
            <input type="number" class="form-control" id="bb" name="bb"
                value="{{ $hasil_data->bb ?? '' }}">
        </div>
        <div class="form-group col-md-4">
            <label for="tb">TB (cm)</label>
            <input type="number" class="form-control" id="tb" name="tb"
                value="{{ $hasil_data->tb ?? '' }}">
        </div>
        <div class="form-group col-md-1">
            <label for="bmi">BMI</label>
            <input type="text" class="form-control" id="bmi" name="bmi"
                value="{{ $hasil_data->bmi ?? '' }}" readonly>
        </div>
        <div class="form-group col-md-3">
            <label for="kategori_bmi">Kategori BMI</label>
            <input type="text" class="form-control" id="kategori_bmi" name="kategori_bmi"
                value="{{ $hasil_data->kategori_bmi ?? '' }}" readonly>
        </div>
    </div>
    {{-- <div class="form-group">
        <label for="inputAddress">Postur Tubuh</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="" name="postur_tubuh"
            value="{{ $hasil_data->postur_tubuh ?? '' }}">
    </div> --}}
    <div class="form-group">
        <label for="inspeksi_dan_palpasi">Inspeksi dan Palpasi head to toe</label>
        <textarea class="form-control" id="inspeksi_dan_palpasi" cols="30" rows="3" name="inspeksi_dan_palpasi">{{ $hasil_data->inspeksi_dan_palpasi ?? '' }}</textarea>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="kekuatan_otot_ekstremitas_upper">Kekuatan otot ekstremitas (upper)</label>
            <input type="text" class="form-control" id="kekuatan_otot_ekstremitas_upper"
                name="kekuatan_otot_ekstremitas_upper"
                value="{{ $hasil_data->kekuatan_otot_ekstremitas_upper ?? '' }}">
        </div>
        <div class="form-group col-md-6">
            <label for="kekuatan_otot_ekstremitas_lower">Kekuatan otot ekstremitas (lower)</label>
            <input type="text" class="form-control" id="kekuatan_otot_ekstremitas_lower"
                name="kekuatan_otot_ekstremitas_lower"
                value="{{ $hasil_data->kekuatan_otot_ekstremitas_lower ?? '' }}">
        </div>
    </div>
    <div class="form-group">
        <label for="refleks">Refleks</label>
        <input type="text" class="form-control" id="refleks" placeholder="" name="refleks"
            value="{{ $hasil_data->refleks ?? '' }}">
    </div>
    <div class="form-group">
        <label for="pemeriksaan_ekg">Pemeriksaan EKG</label>
        <input type="text" class="form-control" id="pemeriksaan_ekg" placeholder="" name="pemeriksaan_ekg"
            value="{{ $hasil_data->pemeriksaan_ekg ?? '' }}">
    </div>
</table>
<br><br>
<table class="table-warning " style="width:100%;">
    <tr>
        <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
            <h5>PEMERIKSAAN KESEHATAN MENTAL</h5>
        </td>
    </tr>
</table>
<br>
<table class="table table-bordered">
    <tr>
        <th style="width: 3%">No</th>
        <th style="width: 25%">Pemeriksaan</th>
        <th style="width: 20%">Panduan Interpretasi</th>
        <th style="width: 10%">Hasil</th>
        <th style="width: 15%">Interpretasi</th>
    </tr>
    <tr>
        <td>1</td>
        <td><b>Pemeriksaan Kesehatan Jiwa (SRQ-20)</b><br>(dirasakan dalam 30 hari terakhir)<br>Berapa jumlah jawaban
            Ya?</td>
        <td>0-5 : Normal<br>6-20 : Indikasi gx psikiatri</td>
        <td><input type="text" class="form-control" name="srq" id="inputCity"
                value="{{ $hasil_data->srq ?? ($srq->totalScore ?? '') }}" readonly></td>
        <td>{{ $srq->category ?? '' }}</td>
    </tr>
    <tr>
        <td>2</td>
        <td><b>Pemeriksaan Kognitif</b><br>
            a. <b>Minicog 1</b>: mengulang sebutkan kata BOLA, MELATI, KURSI</td>
        <td>Tidak diskoring</td>
        {{-- <td><input type="text" class="form-control" id="inputCity" name="pemeriksaan_kognitif"
                value="{{ $hasil_data->pemeriksaan_kognitif ?? '' }}" readonly></td> --}}
        {{-- <td><input type="text" class="form-control" name="interpretasi_kognitif" id="interpretasi_kognitif"
                readonly></td> --}}
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>b. <b>Clock drawing test</b><br>
            - gambar lingkaran utuh<br>
            - tulis angka 1-12 dalam lingkaran<br>
            - angka berurutan dan tepat letaknya<br>
            - jarum jam menunjukkan jam 11.10</td>
        <td>1 skor untuk tiap langkah yang benar (total skor 4)<br>
            Skor 4 : normal<br>
            Skor < 4 : menurun</td>
        <td>
            <input type="number" class="form-control" id="clockTestInput" name="clockTestInput" min="0"
                max="4" value="{{ $hasil_data->clockTestInput ?? 0 }}">
            {{-- @for ($i = 0; $i <= 4; $i++)
                <label>
                    <input type="radio" class="form-control" name="clockTestInput" value="{{ $i }}" />
                    {{ $i }}
                </label>
            @endfor --}}
        </td>
        <td>
            <input type="text" class="form-control" name="clockTestStatus" id="clockTestStatus"
                value="{{ $hasil_data->clockTestStatus ?? '' }}" readonly>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>c. Sebutkan 3 kata yang tadi disebutkan (BOLA, MELATI, KURSI)</td>
        <td>1 skor untuk tiap kata yang benar, tidak harus berurutan (total skor 3)<br>
            Skor 3 : normal<br>
            Skor < 3 : menurun</td>
        <td>
            <input type="number" class="form-control" id="kataTestInput" name="kataTestInput" min="0"
                max="3" value="{{ $hasil_data->kataTestInput ?? 0 }}">
            {{-- @for ($i = 0; $i <= 3; $i++)
                <label>
                    <input type="radio" class="form-control" name="kataTestInput" value="{{ $i }}" />
                    {{ $i }}
                </label>
            @endfor --}}
        </td>
        <td>
            <input type="text" class="form-control" name="kataTestStatus" id="kataTestStatus"
                value="{{ $hasil_data->kataTestStatus ?? '' }}" readonly>
        </td>
    </tr>
    <tr>
        <td>3</td>
        <td><b>Pemeriksaan Kesehatan Mental</b> dengan <i>The Abbreviated Mental Test (AMT)</i></td>
        <td>Tidak demensia : No 1-4 benar DAN nilai total < 8<br>
                Demensia ringan : No 1-4 benar DAN nilai total 6-8<br>
                Demensia sedang : No 1-4 benar DAN nilai total < 6<br>
                    Demensia berat : No 1-4 ada yang salah</td>
        <td><input type="text" class="form-control" id="inputCity" name="amt"
                value="{{ $amt->totalScore ?? '' }}" readonly>
        </td>
        <td>
            {{ $amt->category ?? '' }}
            <input type="hidden" name="category_amt" value="{{ $amt->category ?? '' }}">
        </td>
    </tr>
    <tr>
        <td>4</td>
        <td><i>Activity Daily Living (ADL)</i> dengan <b>Barthel Index</b></td>
        <td>Mandiri : 100<br>
            Ketergantungan ringan : 91-99<br>
            Ketergantungan sedang : 61-90<br>
            Ketergantungan berat : total skor ADL < 60, ATAU ada nilai 0 pada salah satu ADL : BAB, BAK, Toileting,
                Berpindah, Mobilisasi.</td>
        <td><input type="text" class="form-control" id="inputCity" name="barthel"
                value="{{ $barthel->totalScore ?? '' }}" readonly></td>
        <td>
            {{ $barthel->category ?? '' }}
            <input type="hidden" name="category_barthel" value="{{ $barthel->category ?? '' }}">
        </td>
    </tr>
</table>
<br><br>
<table class="table-danger" style="width:100%;">
    <tr>
        <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
            <h5>PEMERIKSAAN PENUNJANG (terlampir)</h5>
        </td>
    </tr>
</table>
<br>
<p>Pemeriksaan DL, LED, Golongan darah, HbA1c, GDP, 2JPP, Kolesterol total, TG, SGOT, SGPT, BUN, SK, UL</p>
<div class="form-group">
    <label for="hasil_lab_abnormal">Hasil Lab Abnormal :</label>
    <textarea class="form-control" id="hasil_lab_abnormal" cols="30" rows="3" name="hasil_lab_abnormal">{{ $hasil_data->hasil_lab_abnormal ?? '' }}</textarea>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="hasil_plano_test">Hasil Plano Test (khusus wanita usia subur) :</label>
        <input type="text" class="form-control" id="hasil_plano_test" name="hasil_plano_test"
            value="{{ $hasil_data->hasil_plano_test ?? '' }}">
    </div>
    <div class="form-group col-md-12">
        <label for="hasil_cxr">Hasil CXR :</label>
        <input type="text" class="form-control" id="hasil_cxr" name="hasil_cxr"
            value="{{ $hasil_data->hasil_cxr ?? '' }}">
    </div>
</div>
<br><br>
<table class="table-primary" style="width:100%;">
    <tr>
        <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
            <h5>RESUME (hasil yang abnormal)</h5>
        </td>
    </tr>
</table>
<br>
<div class="form-group">
    <label for="resume">Resume :</label>
    <textarea class="form-control" name="resume" id="resume" cols="30" rows="3">{{ $hasil_data->resume ?? '' }}</textarea>
</div>
<br><br>
<table class="table-success" style="width:100%;">
    <tr>
        <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
            <h5>DIAGNOSIS</h5>
        </td>
    </tr>
</table>
<br>
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="icd10_1">ICD10 (1)</label>
        @php $hasil_data_temp = $hasil_data->icd10_1 ?? '' @endphp
        <select class="form-control js-select2 select-diagnosis" style="width: 100%" name="icd10_1" id="icd10_1">
            @if ($hasil_data_temp != '')
                <option selected>{{ $hasil_data_temp ?? '' }}</option>
            @endif
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="icd10_2">ICD10 (2)</label>
        @php $hasil_data_temp = $hasil_data->icd10_2 ?? '' @endphp
        <select class="form-control js-select2 select-diagnosis" style="width: 100%" name="icd10_2" id="icd10_2">
            @if ($hasil_data_temp != '')
                <option selected>{{ $hasil_data_temp ?? '' }}</option>
            @endif
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="icd10_3">ICD10 (3)</label>
        @php $hasil_data_temp = $hasil_data->icd10_3 ?? '' @endphp
        <select class="form-control js-select2 select-diagnosis" style="width: 100%" name="icd10_3" id="icd10_3">
            @if ($hasil_data_temp != '')
                <option selected>{{ $hasil_data_temp ?? '' }}</option>
            @endif
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="icd10_4">ICD10 (4)</label>
        @php $hasil_data_temp = $hasil_data->icd10_4 ?? '' @endphp
        <select class="form-control js-select2 select-diagnosis" style="width: 100%" name="icd10_4" id="icd10_4">
            @if ($hasil_data_temp != '')
                <option selected>{{ $hasil_data_temp ?? '' }}</option>
            @endif
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="icd10_5">ICD10 (5)</label>
        @php $hasil_data_temp = $hasil_data->icd10_5 ?? '' @endphp
        <select class="form-control js-select2 select-diagnosis" style="width: 100%" name="icd10_5" id="icd10_5">
            @if ($hasil_data_temp != '')
                <option selected>{{ $hasil_data_temp ?? '' }}</option>
            @endif
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="icd10_6">ICD10 (6)</label>
        @php $hasil_data_temp = $hasil_data->icd10_6 ?? '' @endphp
        <select class="form-control js-select2 select-diagnosis" style="width: 100%" name="icd10_6" id="icd10_6">
            @if ($hasil_data_temp != '')
                <option selected>{{ $hasil_data_temp ?? '' }}</option>
            @endif
        </select>
    </div>
</div>
<br><br>
<table class="table-warning" style="width:100%;">
    <tr>
        <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
            <h5>APAKAH DIDAPATKAN KECURIGAAN PADA PENYAKIT :</h5>
        </td>
    </tr>
</table>
<br>
<table class="table table-bordered">
    <tr>
        <th style="width: 5%">No</th>
        <th style="width: 30%">Penyakit</th>
        <th style="width: 20%">Ya / Tidak</th>
        <th style="width: 30%">Tindak Lanjut (bila Ya)</th>
    </tr>
    <tr>
        <td>1</td>
        <td>PPOK dan Emfisema</td>
        <td>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="ppok_dan_emfisema" id="ya1"
                    value="Ya" @php $hasil_data_temp=$hasil_data->{'ppok_dan_emfisema'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif>
                <label class="form-check-label" for="ya1">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="ppok_dan_emfisema" id="tidak1"
                    value="Tidak" @php $hasil_data_temp=$hasil_data->{'ppok_dan_emfisema'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Tidak') checked @endif>
                <label class="form-check-label" for="tidak1">Tidak</label>
            </div>
        </td>
        <td>Spirometri atau skala sesak mMRC dengan six
            minute walking test (SMWT)</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Stroke</td>
        <td>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="stroke" id="ya2" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'stroke'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif>
                <label class="form-check-label" for="ya2">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="stroke" id="tidak2" value="Tidak"
                    @php $hasil_data_temp=$hasil_data->{'stroke'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Tidak') checked @endif>
                <label class="form-check-label" for="tidak2">Tidak</label>
            </div>
        </td>
        <td>CT scan kepala</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Tumor (keganasan)</td>
        <td>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tumor" id="ya3" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tumor'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif>
                <label class="form-check-label" for="ya3">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tumor" id="tidak3" value="Tidak"
                    @php $hasil_data_temp=$hasil_data->{'tumor'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Tidak') checked @endif>
                <label class="form-check-label" for="tidak3">Tidak</label>
            </div>
        </td>
        <td>USG/CT scan dan ECOG Score</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Gagal jantung, PJK, Cardiomegali</td>
        <td>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gagal_jantung" id="ya4" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'gagal_jantung'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif>
                <label class="form-check-label" for="ya4">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gagal_jantung" id="tidak4" value="Tidak"
                    @php $hasil_data_temp=$hasil_data->{'gagal_jantung'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Tidak') checked @endif>
                <label class="form-check-label" for="tidak4">Tidak</label>
            </div>
        </td>
        <td>Echo atau skala NYHA dengan six minute
            walking test (SMWT)</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Tuberkulosis</td>
        <td>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tuberkulosis" id="ya5" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'tuberkulosis'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif>
                <label class="form-check-label" for="ya5">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tuberkulosis" id="tidak5" value="Tidak"
                    @php $hasil_data_temp=$hasil_data->{'tuberkulosis'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Tidak') checked @endif>
                <label class="form-check-label" for="tidak5">Tidak</label>
            </div>
        </td>
        <td>TCM atau sputum BTA</td>
    </tr>
    <tr>
        <td>6</td>
        <td>HIV/AIDS</td>
        <td>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="hiv_aids" id="ya6" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'hiv_aids'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif>
                <label class="form-check-label" for="ya6">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="hiv_aids" id="tidak6" value="Tidak"
                    @php $hasil_data_temp=$hasil_data->{'hiv_aids'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Tidak') checked @endif>
                <label class="form-check-label" for="tidak6">Tidak</label>
            </div>
        </td>
        <td>HIVrapid atau HIV Elisa</td>
    </tr>
    <tr>
        <td>7</td>
        <td>Fraktur tungkai</td>
        <td>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fraktur_tungkai" id="ya7" value="Ya"
                    @php $hasil_data_temp=$hasil_data->{'fraktur_tungkai'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Ya') checked @endif>
                <label class="form-check-label" for="ya7">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fraktur_tungkai" id="tidak7" value="Tidak"
                    @php $hasil_data_temp=$hasil_data->{'fraktur_tungkai'} ?? '' @endphp
                    @if ($hasil_data_temp == 'Tidak') checked @endif>
                <label class="form-check-label" for="tidak7">Tidak</label>
            </div>
        </td>
        <td>X-ray</td>
    </tr>
</table>
<div class="form-group">
    <label for="bila_ada_tindak_lanjut">Bila Ada, maka perlu tindak lanjut :</label>
    <input type="text" class="form-control" id="bila_ada_tindak_lanjut" name="tindak_lanjut"
        value="{{ $hasil_data->tindak_lanjut ?? '' }}">
</div>
<p>Hasil tindak lanjut :</p>
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="tgl_hasil_tindak_lanjut">Tgl</label>
        <input type="date" class="form-control" id="tgl_hasil_tindak_lanjut" name="tgl_hasil_tindak_lanjut"
            value="{{ $hasil_data->tgl_hasil_tindak_lanjut ?? '' }}">
    </div>
    <div class="form-group col-md-8">
        <label for="hasil_tindak_lanjut">:</label>
        <input type="text" class="form-control" id="hasil_tindak_lanjut" name="hasil_tindak_lanjut"
            value="{{ $hasil_data->hasil_tindak_lanjut ?? '' }}">
    </div>
</div>
{{-- <br><br> --}}
{{-- <table class="table-primary" style="width:100%;">
    <tr>
        <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
            <h5>STATUS ISTITAAH (pilih salah satu)</h5>
        </td>
    </tr>
</table>
<br>
<div class="form-check">
    <input class="form-check-input" type="radio" name="status_istitaah" value="Memenuhi Syarat Istitaah"
        @php $hasil_data_temp=$hasil_data->{'status_istitaah'} ?? '' @endphp
        @if ($hasil_data_temp == 'Memenuhi Syarat Istitaah') checked @endif>
    <label class="form-check-label" for="exampleRadios1">
        Memenuhi syarat istitaah kesehatan haji
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="status_istitaah"
        value="Memenuhi Syarat Istitaah dengan Pendampingan"
        @php $hasil_data_temp=$hasil_data->{'status_istitaah'} ?? '' @endphp
        @if ($hasil_data_temp == 'Memenuhi Syarat Istitaah dengan Pendampingan') checked @endif>
    <label class="form-check-label" for="exampleRadios1">
        Memenuhi syarat istitaah kesehatan haji dengan pendampingan
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="status_istitaah"
        value="Tidak Memenuhi Syarat Istitaah Sementara"
        @php $hasil_data_temp=$hasil_data->{'status_istitaah'} ?? '' @endphp
        @if ($hasil_data_temp == 'Tidak Memenuhi Syarat Istitaah Sementara') checked @endif>
    <label class="form-check-label" for="exampleRadios1">
        Tidak memenuhi syarat istitaah kesehatan haji sementara, karena
    </label>
    <input type="text" class="form-control" name="alasan_tidak_memenuhi_syarat_istitaah_kesehatan_haji_sementara"
        id="inputCity"
        value="{{ $hasil_data->alasan_tidak_memenuhi_syarat_istitaah_kesehatan_haji_sementara ?? '' }}">
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="status_istitaah" value="Tidak Memenuhi Syarat Istitaah"
        @php $hasil_data_temp=$hasil_data->{'status_istitaah'} ?? '' @endphp
        @if ($hasil_data_temp == 'Tidak Memenuhi Syarat Istitaah') checked @endif>
    <label class="form-check-label" for="exampleRadios1">
        Tidak memenuhi syarat istitaah kesehatan haji, karena
    </label>
    <input type="text" class="form-control" name="alasan_tidak_memenuhi_syarat_istitaah_kesehatan_haji"
        id="inputCity" value="{{ $hasil_data->alasan_tidak_memenuhi_syarat_istitaah_kesehatan_haji ?? '' }}">
</div>
<br><br>
<div class="form-group">
    <label for="inputAddress2">SARAN :</label>
    <textarea class="form-control" name="saran" id="" cols="30" rows="3">{{ $hasil_data->saran ?? '' }}</textarea>
</div> --}}
{{-- <br> --}}
