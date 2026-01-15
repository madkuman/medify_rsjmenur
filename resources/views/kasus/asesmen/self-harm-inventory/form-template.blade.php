<style type="text/css">
    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }
    .text-justify {
        text-align: justify;
    }
    .bordered {
        border: 1px solid #000;
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
        height: 32px;
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
            <div class="border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RM.05.1&nbsp;&nbsp;&nbsp;</div>
            <div class="border-left border-right border-bottom">
                &nbsp;&nbsp;&nbsp;<span>Halaman&nbsp;{PAGENO}/{nb}&nbsp;&nbsp;</span>
            </div>
        </div>
    </htmlpageheader>
@endif
<br><br>
 <table style="width:100%" class="marks">
    <tr>
        <td style="width: 85%"></td>
        <td class=" position-relative bordered text-center" colspan="1" rowspan="1">
            RM. 72
        </td>
    </tr>
    {{--  <tr>
        <td></td>
        <td class=" position-relative bordered text-center" colspan="1" rowspan="1">
            Halaman 
        </td>
    </tr>  --}}
</table>
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
                {{--  {{ $kasus->identitas->gender ?? '' }}  --}}
            </span>
        </td>
    </tr>
</table>
<br>
<table style="width:100%;">
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <h5><b>SHI</b><i> (Self Harm Inventory)</i></h5>
        </td>
    </tr>
</table>
<br>
<table style="width:100%;">
    <tr>
        <td style="width: 20%" class=" position-relative" colspan="1" rowspan="1">
            <span>NAMA PESERTA</span>
        </td>
        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="width: 78%" class=" position-relative" colspan="1" rowspan="1">
            <span type="hidden">{{ $hasil_data->penerima ?? '' }}</span>
            <div class="form-group medify-form-genv4-input-container">

                @if ($action != null)
                    <input type="text" class="form-control" name="penerima" value="{{ $kasus->pasien->name ?? '' }}">
                @else
                    <span class="medify-form-genv4-view-container"> {{ $hasil_data->penerima ?? '' }}</span>
                @endif
            </div>
        </td>
    </tr>
</table>
<table style="width:100%;">
    <tr>
        <td class=" position-relative text-justify" colspan="1" rowspan="1">
            <span>Jawablah pertanyaan-pertanyaan di bawah ini dengan memberi tanda centang pada pilihan jawaban “Ya” atau “Tidak”. Pilihlah jawaban “Ya” hanya untuk Tindakan-tindakan yang sengaja Anda lakukan untuk melukai/merugikan diri sendiri</span>
        </td>
    </tr>
</table>
<br>
<table style="width:100%" class="c-table--bordered">
    <tr>
        <td style="width:4%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>NO</b></span>
        </td>
        <td style="width:70%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>PERTANYAAN</b></span>
        </td>
        <td style="width:13%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>YA</b></span>
        </td>
        <td style="width:13%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>TIDAK</b></span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>1</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja mengalami overdosis ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="overdosis" id="overdosis"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'overdosis'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="overdosis"></label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'overdosis'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="overdosis" id="overdosis"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'overdosis'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="overdosis"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'overdosis'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Pernahkah Anda dengan sengaja melukai diri Anda dengan sengaja ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="melukai_diri" id="melukai_diri"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'melukai_diri'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="melukai_diri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'melukai_diri'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="melukai_diri" id="melukai_diri"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'melukai_diri'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="melukai_diri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'melukai_diri'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Pernahkah Anda dengan sengaja  membakar diri Anda dengan sengaja ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="membakar_diri" id="membakar_diri"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'membakar_diri'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="membakar_diri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'membakar_diri'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="membakar_diri" id="membakar_diri"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'membakar_diri'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="membakar_diri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'membakar_diri'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Pernahkah Anda dengan sengaja memukul diri sendiri ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="memukul_diri" id="memukul_diri"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'memukul_diri'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="memukul_diri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'memukul_diri'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="memukul_diri" id="memukul_diri"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'memukul_diri'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="memukul_diri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'memukul_diri'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Pernahkah Anda dengan sengaja membenturkan kepala Anda dengan sengaja?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="membentur_kepala" id="membentur_kepala"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'membentur_kepala'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="membentur_kepala"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'membentur_kepala'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="membentur_kepala" id="membentur_kepala"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'membentur_kepala'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="membentur_kepala"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'membentur_kepala'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Pernahkah Anda dengan sengaja melakukan penyalahgunaan alkohol ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penyalahgunaan_alkohol" id="penyalahgunaan_alkohol"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'penyalahgunaan_alkohol'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="penyalahgunaan_alkohol"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penyalahgunaan_alkohol'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penyalahgunaan_alkohol" id="penyalahgunaan_alkohol"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'penyalahgunaan_alkohol'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="penyalahgunaan_alkohol"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penyalahgunaan_alkohol'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>7</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja berkendara secara ugal-ugalan dengan sengaja ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berkendara_ugal" id="berkendara_ugal"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'berkendara_ugal'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="berkendara_ugal"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'berkendara_ugal'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berkendara_ugal" id="berkendara_ugal"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'berkendara_ugal'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="berkendara_ugal"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'berkendara_ugal'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>8</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja menggores diri sendiri dengan sengaja ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="menggores_diri" id="menggores_diri"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'menggores_diri'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="menggores_diri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'menggores_diri'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="menggores_diri" id="menggores_diri"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'menggores_diri'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="menggores_diri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'menggores_diri'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>9</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja mencegah diri untuk menyembuhkan luka ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="mencegah_sembuhluka" id="mencegah_sembuhluka"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'mencegah_sembuhluka'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="mencegah_sembuhluka"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'mencegah_sembuhluka'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="mencegah_sembuhluka" id="mencegah_sembuhluka"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'mencegah_sembuhluka'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="mencegah_sembuhluka"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'mencegah_sembuhluka'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>10</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah  Anda  dengan  sengaja  membuat  situasi  medis  atau  kesehatan  diri  menjadi  lebih  buruk  dengan sengaja ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sengaja_jadiburuk" id="sengaja_jadiburuk"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'sengaja_jadiburuk'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="sengaja_jadiburuk"></label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sengaja_jadiburuk'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sengaja_jadiburuk" id="sengaja_jadiburuk"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'sengaja_jadiburuk'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="sengaja_jadiburuk"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sengaja_jadiburuk'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>11</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja memiliki banyak pasangan seksual yang berbeda-beda ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sengaja_banyakpasangan" id="sengaja_banyakpasangan"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'sengaja_banyakpasangan'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="sengaja_banyakpasangan"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sengaja_banyakpasangan'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sengaja_banyakpasangan" id="sengaja_banyakpasangan"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'sengaja_banyakpasangan'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="sengaja_banyakpasangan"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sengaja_banyakpasangan'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>12</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja memilih untuk ditolak dalam suatu hubungan ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="menolak_hubungan" id="menolak_hubungan"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'menolak_hubungan'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="menolak_hubungan"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'menolak_hubungan'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="menolak_hubungan" id="menolak_hubungan"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'menolak_hubungan'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="menolak_hubungan"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'menolak_hubungan'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>13</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja melakukan penyalahgunaan resep obat ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penyalahgunaan_resep" id="penyalahgunaan_resep"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'penyalahgunaan_resep'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="penyalahgunaan_resep"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penyalahgunaan_resep'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penyalahgunaan_resep" id="penyalahgunaan_resep"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'penyalahgunaan_resep'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="penyalahgunaan_resep"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penyalahgunaan_resep'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>14</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja menjauhkan diri dari Tuhan sebagai bentuk hukuman ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="menjauh_tuhan" id="menjauh_tuhan"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'menjauh_tuhan'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="menjauh_tuhan"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'menjauh_tuhan'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="menjauh_tuhan" id="menjauh_tuhan"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'menjauh_tuhan'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="menjauh_tuhan"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'menjauh_tuhan'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>15</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda terlibat secara emosional terhadap kekerasan dalam hubungan ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kekerasan_hubungan" id="kekerasan_hubungan"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'kekerasan_hubungan'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="kekerasan_hubungan"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kekerasan_hubungan'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kekerasan_hubungan" id="kekerasan_hubungan"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'kekerasan_hubungan'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="kekerasan_hubungan"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kekerasan_hubungan'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>16</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda terlibat secara seksual terhadap kekerasan dalam hubungan ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kekerasan_seks" id="kekerasan_seks"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'kekerasan_seks'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="kekerasan_seks"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kekerasan_seks'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kekerasan_seks" id="kekerasan_seks"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'kekerasan_seks'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="kekerasan_seks"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kekerasan_seks'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>17</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja kehilangan pekerjaan secara sengaja ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kehilangan_pekerjaan" id="kehilangan_pekerjaan"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'kehilangan_pekerjaan'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="kehilangan_pekerjaan"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kehilangan_pekerjaan'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kehilangan_pekerjaan" id="kehilangan_pekerjaan"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'kehilangan_pekerjaan'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="kehilangan_pekerjaan"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kehilangan_pekerjaan'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>18</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja mencoba bunuh diri ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="coba_bundir" id="coba_bundir"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'coba_bundir'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="coba_bundir"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'coba_bundir'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="coba_bundir" id="coba_bundir"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'coba_bundir'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="coba_bundir"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'coba_bundir'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>19</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja membuat cedera diri sendiri secara sengaja ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sengaja_cederadiri" id="sengaja_cederadiri"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'sengaja_cederadiri'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="sengaja_cederadiri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sengaja_cederadiri'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="sengaja_cederadiri" id="sengaja_cederadiri"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'sengaja_cederadiri'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="sengaja_cederadiri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sengaja_cederadiri'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>20</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja menyiksa diri dengan pikiran yang menghancurkan diri sendiri ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="hancur_diri" id="hancur_diri"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'hancur_diri'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="hancur_diri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hancur_diri'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="hancur_diri" id="hancur_diri"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'hancur_diri'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="hancur_diri"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hancur_diri'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>21</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja menahan lapar untuk menyakiti diri sendiri ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="menahan_lapar" id="menahan_lapar"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'menahan_lapar'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="menahan_lapar"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'menahan_lapar'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="menahan_lapar" id="menahan_lapar"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'menahan_lapar'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="menahan_lapar"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'menahan_lapar'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>22</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pernahkah Anda dengan sengaja meminum obat pecahar yang digunakan untuk menyakiti diri sendiri ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="minum_obatpencahar" id="minum_obatpencahar"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'minum_obatpencahar'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="minum_obatpencahar"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'minum_obatpencahar'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="minum_obatpencahar" id="minum_obatpencahar"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'minum_obatpencahar'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="minum_obatpencahar"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'minum_obatpencahar'} ?? '' @endphp @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="2" rowspan="1">Skor</td>
        <td class=" position-relative text-center" colspan="2" rowspan="1">
            <input type="number" class="form-control" name="totalScore" id="totalScore"
                value="{{ $hasil_data->totalScore ?? '' }}" readonly>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="2" rowspan="1">Kategori</td>
        <td class=" position-relative text-center" colspan="2" rowspan="1">
            <input type="text" class="form-control" name="category" id="category"
                value="{{ $hasil_data->category ?? '' }}" readonly>
        </td>
    </tr>

</table>
{{--  <table style="width:100%;">
    <tr>
        <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1"></td>
        <td class=" position-relative text-bold" colspan="1" rowspan="1">
            <span><b>Keterangan :</b></span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <ol class="custom-ol step-a">
                <li>Jawaban Salah : Nilai 0</li>
                <li>Jawaban Benar : Nilai 1</li>
            </ol>
        </td>
    </tr>

    <br>
    <br>

    <tr>
        <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1"></td>
        <td class=" position-relative text-bold" colspan="1" rowspan="1">
            <span><b>Keterangan :</b></span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <ol class="custom-ol" style="margin-bottom: 0;">
                <li>Jika pertanyaan nomor 1 s.d. 4 terdapat 1 atau lebih jawaban yang salah, maka termasuk kategori
                    Demensia Berat.</li>
                <li>Jika pertanyaan nomor 1 s.d. 4 benar, dan nilai keseluruhan <6, maka termasuk kategori Demensia
                        Sedang.</li>
                <li>Jika pertanyaan nomor 1 s.d. 4 benar, dan nilai keseluruhan 6-8, maka termasuk kategori Demensia
                    Ringan.</li>
                <li>Jika pertanyaan nomor 1 s.d. 4 benar, dan nilai keseluruhan >8, maka termasuk kategori Tidak
                    Demensia.</li>
            </ol>
        </td>
    </tr>
</table>  --}}
<br>
<br>
<br>
@if ($action != 'view')
<table style="width:100%;">

    <tr>
        <td style="width: 50%" class=" position-relative text-center" colspan="1" rowspan="1">
            <div>PESERTA</div>
            @if (($hasil_data->{'img_ttd'} ?? '') != '')
                @if (file_exists(((($hasil_data->{'img_ttd'} ?? '') ?? ''))))
                <div>
                    <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;" src="{{ url('') }}/{{ $hasil_data->{'img_ttd'} }}" alt="Tanda tangan">
                </div>
                @else
                <br><br><br><br>
                @endif
                <br>
                <div>( <span>{{ $hasil_data->penerima ?? '' }}</span> )</div>
            @else
            <br><br><br><br>
            <div>( .................................... )</div>
            @endif
        </td> 
         <td style="width: 50%" class=" position-relative text-center" colspan="1" rowspan="1">
            <div>Dokter/Tenaga Medis</div>
            <br><br><br><br>
            @php $hasil_data_temp = $hasil_data->{'dokter'} ?? '' @endphp
            <span>
                <select class="js-select2 form-control" id="selectTtdDokter" name="selectTtdDokter">
                    @if ($hasil_data_temp != '')
                    <option selected>{{ $hasil_data_temp ?? '' }}</option>
                    @endif
                </select>
            </span>
            <span>
                <input type="hidden" class="form-control" id="dokter" name="dokter" value="{{ $hasil_data->{'dokter'} ?? '' }}">
                <input type="hidden" class="form-control" id="ttd_dokter" name="ttd_dokter" value="{{ $hasil_data->{'ttd_dokter'} ?? '' }}">
            </span>
        </td>
    </tr>
</table>
@else
<table style="width:100%;">
    <tr>
        
       <td style="width: 50%" class=" position-relative text-center" colspan="1" rowspan="1">
            <div>PESERTA</div>
            @if (($hasil_data->{'img_ttd'} ?? '') != '')
                @if (file_exists(((($hasil_data->{'img_ttd'} ?? '') ?? ''))))
                <div>
                    <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;" src="{{ url('') }}/{{ $hasil_data->{'img_ttd'} }}" alt="Tanda tangan">
                </div>
                @else
                <br><br><br><br>
                @endif
                <br>
                <div>( <span>{{ $hasil_data->penerima ?? '' }}</span> )</div>
            @else
            <br><br><br><br>
            <div>( .................................... )</div>
            @endif
        </td> 
        <td tyle="width: 50%" class=" position-relative text-center" colspan="1" rowspan="1">
            <div>Dokter/Tenaga Medis</div>
             @if (($hasil_data->{'dokter'} ?? '') != '')
                @if (file_exists(((($hasil_data->{'ttd_dokter'} ?? '') ?? ''))))
                <div>
                    <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;" src="{{ url('') }}/{{ $hasil_data->{'ttd_dokter'} }}" alt="Tanda tangan">
                </div>
                @else
                <br><br><br><br>
                @endif
                <br>
                <div>( <span>{{ $hasil_data->{'dokter'} ?? '' }}</span> )</div>
            @else
            <br><br><br><br>
            <div>( .................................... )</div>
            @endif
        </td>
    </tr>
</table>
@endif
