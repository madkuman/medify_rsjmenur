<style type="text/css">
    .text-right {
        text-align: right;
    }
    .bordered {
        border: 1px solid #000;
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
 <table style="width:100%" class="marks">
    <tr>
        <td style="width: 85%"></td>
        <td class=" position-relative bordered text-center" colspan="1" rowspan="1">
            RM. 69
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
            <h5><b>CARS</b><i> (Childhood Autism Rating Scale)</i></h5>
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
            <span><b>KETERANGAN</b></span>
        </td>
        <td style="width:16%;" class=" position-relative text-center" colspan="4" rowspan="1">
            <span><b>SCORE</b></span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>1</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>HUBUNGAN DENGAN ORANG LAIN </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="hubungan_oranglain" id="hubungan_oranglain"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'hubungan_oranglain'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="hubungan_oranglain">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hubungan_oranglain'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="hubungan_oranglain" id="hubungan_oranglain"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'hubungan_oranglain'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="hubungan_oranglain">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hubungan_oranglain'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="hubungan_oranglain" id="hubungan_oranglain"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'hubungan_oranglain'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="hubungan_oranglain">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hubungan_oranglain'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="hubungan_oranglain" id="hubungan_oranglain"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'hubungan_oranglain'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="hubungan_oranglain">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'hubungan_oranglain'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>IMITASI atau MENIRU</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="meniru" id="meniru"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'meniru'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="meniru">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'meniru'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="meniru" id="meniru"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'meniru'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="meniru">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'meniru'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="meniru" id="meniru"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'meniru'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="meniru">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'meniru'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="meniru" id="meniru"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'meniru'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="meniru">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'meniru'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>RESPON EMOSI</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_emosi" id="respon_emosi"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'respon_emosi'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="respon_emosi">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_emosi'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_emosi" id="respon_emosi"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'respon_emosi'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="respon_emosi">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_emosi'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_emosi" id="respon_emosi"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'respon_emosi'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="respon_emosi">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_emosi'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_emosi" id="respon_emosi"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'respon_emosi'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="respon_emosi">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_emosi'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>PENGGUNAAN BADAN</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penggunaan_badan" id="penggunaan_badan"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'penggunaan_badan'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="penggunaan_badan">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penggunaan_badan'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penggunaan_badan" id="penggunaan_badan"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'penggunaan_badan'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="penggunaan_badan">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penggunaan_badan'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penggunaan_badan" id="penggunaan_badan"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'penggunaan_badan'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="penggunaan_badan">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penggunaan_badan'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penggunaan_badan" id="penggunaan_badan"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'penggunaan_badan'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="penggunaan_badan">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penggunaan_badan'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>PENGGUNAAN OBJEK</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penggunaan_objek" id="penggunaan_objek"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'penggunaan_objek'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="penggunaan_objek">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penggunaan_objek'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penggunaan_objek" id="penggunaan_objek"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'penggunaan_objek'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="penggunaan_objek">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penggunaan_objek'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penggunaan_objek" id="penggunaan_objek"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'penggunaan_objek'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="penggunaan_objek">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penggunaan_objek'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="penggunaan_objek" id="penggunaan_objek"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'penggunaan_objek'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="penggunaan_objek">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'penggunaan_objek'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>ADAPTASI TERHADAP PERUBAHAN </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="adaptasi_perubahan" id="adaptasi_perubahan"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'adaptasi_perubahan'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="adaptasi_perubahan">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'adaptasi_perubahan'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="adaptasi_perubahan" id="adaptasi_perubahan"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'adaptasi_perubahan'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="adaptasi_perubahan">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'adaptasi_perubahan'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="adaptasi_perubahan" id="adaptasi_perubahan"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'adaptasi_perubahan'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="adaptasi_perubahan">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'adaptasi_perubahan'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="adaptasi_perubahan" id="adaptasi_perubahan"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'adaptasi_perubahan'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="adaptasi_perubahan">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'adaptasi_perubahan'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>RESPON VISUAL</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_visual" id="respon_visual"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'respon_visual'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="respon_visual">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_visual'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_visual" id="respon_visual"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'respon_visual'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="respon_visual">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_visual'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_visual" id="respon_visual"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'respon_visual'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="respon_visual">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_visual'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_visual" id="respon_visual"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'respon_visual'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="respon_visual">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_visual'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>RESPON MENDENGAR</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_mendengar" id="respon_mendengar"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'respon_mendengar'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="respon_mendengar">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_mendengar'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_mendengar" id="respon_mendengar"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'respon_mendengar'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="respon_mendengar">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_mendengar'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_mendengar" id="respon_mendengar"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'respon_mendengar'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="respon_mendengar">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_mendengar'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
         <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_mendengar" id="respon_mendengar"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'respon_mendengar'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="respon_mendengar">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_mendengar'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>RESPON DAN PENGGUNAAN RASA, BAU DAN RABA</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_perasa" id="respon_perasa"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'respon_perasa'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="respon_perasa">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_perasa'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_perasa" id="respon_perasa"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'respon_perasa'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="respon_perasa">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_perasa'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_perasa" id="respon_perasa"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'respon_perasa'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="respon_perasa">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_perasa'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_perasa" id="respon_perasa"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'respon_perasa'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="respon_perasa">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_perasa'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>TAKUT ATAU NERVOUS</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="nervous" id="nervous"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'nervous'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="nervous">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'nervous'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="nervous" id="nervous"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'nervous'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="nervous">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'nervous'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="nervous" id="nervous"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'nervous'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="nervous">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'nervous'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="nervous" id="nervous"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'nervous'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="nervous">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'nervous'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>KOMUNIKASI VERBAL</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="komunikasi_verbal" id="komunikasi_verbal"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'komunikasi_verbal'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="komunikasi_verbal">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'komunikasi_verbal'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="komunikasi_verbal" id="komunikasi_verbal"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'komunikasi_verbal'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="komunikasi_verbal">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'komunikasi_verbal'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="komunikasi_verbal" id="komunikasi_verbal"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'komunikasi_verbal'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="komunikasi_verbal">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'komunikasi_verbal'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="komunikasi_verbal" id="komunikasi_verbal"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'komunikasi_verbal'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="komunikasi_verbal">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'komunikasi_verbal'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>KOMUNIKASI NON VERBAL</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="komunikasi_nonverbal" id="komunikasi_nonverbal"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'komunikasi_nonverbal'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="komunikasi_nonverbal">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'komunikasi_nonverbal'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="komunikasi_nonverbal" id="komunikasi_nonverbal"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'komunikasi_nonverbal'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="komunikasi_nonverbal">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'komunikasi_nonverbal'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="komunikasi_nonverbal" id="komunikasi_nonverbal"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'komunikasi_nonverbal'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="komunikasi_nonverbal">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'komunikasi_nonverbal'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="komunikasi_nonverbal" id="komunikasi_nonverbal"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'komunikasi_nonverbal'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="komunikasi_nonverbal">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'komunikasi_nonverbal'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>LEVEL AKTIVITAS</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="level_aktivitas" id="level_aktivitas"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'level_aktivitas'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="level_aktivitas">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'level_aktivitas'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="level_aktivitas" id="level_aktivitas"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'level_aktivitas'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="level_aktivitas">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'level_aktivitas'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="level_aktivitas" id="level_aktivitas"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'level_aktivitas'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="level_aktivitas">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'level_aktivitas'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="level_aktivitas" id="level_aktivitas"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'level_aktivitas'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="level_aktivitas">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'level_aktivitas'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>LEVEL dan KONSISTENSI DARI RESPON INTELEKTUAL</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_intelektual" id="respon_intelektual"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'respon_intelektual'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="respon_intelektual">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_intelektual'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_intelektual" id="respon_intelektual"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'respon_intelektual'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="respon_intelektual">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_intelektual'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_intelektual" id="respon_intelektual"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'respon_intelektual'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="respon_intelektual">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_intelektual'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="respon_intelektual" id="respon_intelektual"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'respon_intelektual'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="respon_intelektual">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'respon_intelektual'} ?? '' @endphp @if ($hasil_data_temp == '4')
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
            <span>KESAN UMUM(AUTISM)</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kesan_umum" id="kesan_umum"
                    onchange="calculateTotal()" value="1"
                    @php $hasil_data_temp=$hasil_data->{'kesan_umum'} ?? '' @endphp
                    @if ($hasil_data_temp == '1') checked @endif> <label class="form-check-label"
                    for="kesan_umum">1</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kesan_umum'} ?? '' @endphp @if ($hasil_data_temp == '1')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kesan_umum" id="kesan_umum"
                    onchange="calculateTotal()" value="2"
                    @php $hasil_data_temp=$hasil_data->{'kesan_umum'} ?? '' @endphp
                    @if ($hasil_data_temp == '2') checked @endif> <label class="form-check-label"
                    for="kesan_umum">2</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kesan_umum'} ?? '' @endphp @if ($hasil_data_temp == '2')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kesan_umum" id="kesan_umum"
                    onchange="calculateTotal()" value="3"
                    @php $hasil_data_temp=$hasil_data->{'kesan_umum'} ?? '' @endphp
                    @if ($hasil_data_temp == '3') checked @endif> <label class="form-check-label"
                    for="kesan_umum">3</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kesan_umum'} ?? '' @endphp @if ($hasil_data_temp == '3')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="kesan_umum" id="kesan_umum"
                    onchange="calculateTotal()" value="4"
                    @php $hasil_data_temp=$hasil_data->{'kesan_umum'} ?? '' @endphp
                    @if ($hasil_data_temp == '4') checked @endif> <label class="form-check-label"
                    for="kesan_umum">4</label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kesan_umum'} ?? '' @endphp @if ($hasil_data_temp == '4')
                    <span style='font-family:calibri'>&#x2714;</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="2" rowspan="1">Skor</td>
        <td class=" position-relative text-center" colspan="4" rowspan="1">
            <input type="number" class="form-control text-center" name="totalScore" id="totalScore"
                value="{{ $hasil_data->totalScore ?? '' }}" readonly>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="2" rowspan="1">Kategori</td>
        <td class=" position-relative text-center" colspan="4" rowspan="1">
            <input type="text" class="form-control text-center" name="category" id="category"
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
         <td style="width: 50%" class=" position-relative text-center" teccolspan="1" rowspan="1">
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
