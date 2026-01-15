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
            <div class="border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RM.05.1&nbsp;&nbsp;&nbsp;</div>
            <div class="border-left border-right border-bottom">
                &nbsp;&nbsp;&nbsp;<span>Halaman&nbsp;{PAGENO}/{nb}&nbsp;&nbsp;</span>
            </div>
        </div>
    </htmlpageheader>
@endif
<br><br>
{{--  <table style="width:100%" class="marks" >
    <tr>
        <td style="width: 85%"></td>
        <td class="c-table--bordered" colspan="1" rowspan="1" >
            RM.05.1
        </td>
    </tr>
</table>  --}}
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
            <h5>THE ABBREVIATED MENTAL TEST (AMT) Score</h5>
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
<br>
<table style="width:100%" class="c-table--bordered">
    <tr>
        <td style="width:4%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>NO</b></span>
        </td>
        <td style="width:80%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>PERTANYAAN</b></span>
        </td>
        <td style="width:8%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>BENAR</b></span>
        </td>
        <td style="width:8%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>SALAH</b></span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>1</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Saat ini kita sedang berada dimana ? </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berada_dimana" id="berada_dimana"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'berada_dimana'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="berada_dimana"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'berada_dimana'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berada_dimana" id="berada_dimana"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'berada_dimana'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="berada_dimana"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sign'}->{'berada_dimana'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Tahun berapa sekarang ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="tahun_berapa" id="tahun_berapa"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'tahun_berapa'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="tahun_berapa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tahun_berapa'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="tahun_berapa" id="tahun_berapa"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'tahun_berapa'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="tahun_berapa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tahun_berapa'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Berapa umur Anda ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="umur_berapa" id="umur_berapa"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'umur_berapa'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="umur_berapa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'umur_berapa'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="umur_berapa" id="umur_berapa"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'umur_berapa'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="umur_berapa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'umur_berapa'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Tahun berapa Anda lahir ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="tahun_lahir" id="tahun_lahir"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'tahun_lahir'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="tahun_lahir"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tahun_lahir'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="tahun_lahir" id="tahun_lahir"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'tahun_lahir'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="tahun_lahir"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tahun_lahir'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Jam berapa sekarang ? (Boleh lihat jam)</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="jam_berapa" id="jam_berapa"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'jam_berapa'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="jam_berapa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'jam_berapa'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="jam_berapa" id="jam_berapa"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'jam_berapa'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="jam_berapa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'jam_berapa'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Dimana alamat rumah Anda ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="alamat_rumah" id="alamat_rumah"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'alamat_rumah'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="alamat_rumah"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'alamat_rumah'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="alamat_rumah" id="alamat_rumah"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'alamat_rumah'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="alamat_rumah"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'alamat_rumah'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Mampukah Anda mengenali dokter dan perawat ? (atau orang di sekitar)</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kenal_nakes" id="kenal_nakes"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'kenal_nakes'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="kenal_nakes"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kenal_nakes'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kenal_nakes" id="kenal_nakes"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'kenal_nakes'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="kenal_nakes"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kenal_nakes'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Tahun berapa Indonesia Merdeka ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="tahun_merdeka" id="tahun_merdeka"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'tahun_merdeka'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="tahun_merdeka"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tahun_merdeka'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="tahun_merdeka" id="tahun_merdeka"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'tahun_merdeka'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="tahun_merdeka"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tahun_merdeka'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Siapa nama Presiden Republik Indonesia sekarang ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="siapa_presiden" id="siapa_presiden"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'siapa_presiden'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="siapa_presiden"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'siapa_presiden'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="siapa_presiden" id="siapa_presiden"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'siapa_presiden'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="siapa_presiden"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'siapa_presiden'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
            <span>Hitung mundur dari 20 sampai 1 ?</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="hitung_mundur" id="hitung_mundur"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'hitung_mundur'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="hitung_mundur"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hitung_mundur'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="hitung_mundur" id="hitung_mundur"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'hitung_mundur'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif> <label class="form-check-label"
                    for="hitung_mundur"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hitung_mundur'} ?? '' @endphp @if ($hasil_data_temp == '0')
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
<table style="width:100%;">
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
</table>
<br>
<br>
<br>
@if ($action != 'view')
    <table style="width:100%;">

        <tr>
            <td style="width: 50%" class=" position-relative text-center" colspan="1" rowspan="1">
                <div>PESERTA</div>
                @if (($hasil_data->{'img_ttd'} ?? '') != '')
                    @if (file_exists($hasil_data->{'img_ttd'} ?? ('' ?? '')))
                        <div>
                            <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;"
                                src="{{ url('') }}/{{ $hasil_data->{'img_ttd'} }}" alt="Tanda tangan">
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
                    <input type="hidden" class="form-control" id="dokter" name="dokter"
                        value="{{ $hasil_data->{'dokter'} ?? '' }}">
                    <input type="hidden" class="form-control" id="ttd_dokter" name="ttd_dokter"
                        value="{{ $hasil_data->{'ttd_dokter'} ?? '' }}">
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
                    @if (file_exists($hasil_data->{'img_ttd'} ?? ('' ?? '')))
                        <div>
                            <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;"
                                src="{{ url('') }}/{{ $hasil_data->{'img_ttd'} }}" alt="Tanda tangan">
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
                    @if (file_exists($hasil_data->{'ttd_dokter'} ?? ('' ?? '')))
                        <div>
                            <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;"
                                src="{{ url('') }}/{{ $hasil_data->{'ttd_dokter'} }}" alt="Tanda tangan">
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
