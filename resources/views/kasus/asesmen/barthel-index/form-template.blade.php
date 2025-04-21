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
            <h5>BARTHEL INDEX</h5>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <h6>KEBUTUHAN AKTIVITAS SEHARI - HARI</h6>
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
        <td style="width:75%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>AKTIVITAS</b></span>
        </td>
        <td style="width:21%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>NILAI</b></span>
        </td>
    </tr>

    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>1</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span><b> Makan </b> </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span class="medify-form-genv4-view-container">
                @php $hasil_data_temp = $hasil_data->{'makan'} ?? '' @endphp
                @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;Tidak Mampu ( 0 )</span>
                @elseif($hasil_data_temp == '5')
                    <span style='font-family:calibri'>&#x2714;Dibantu ( 5 )</span>
                @elseif($hasil_data_temp == '10')
                    <span style='font-family:calibri'>&#x2714;Mandiri ( 10 )</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>0 = tidak mampu</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="makan" id="makan"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'makan'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif>
                <label class="form-check-label" for="makan"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>5 = dibantu (makanan dipotong-potong dulu)</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="makan" id="makan"
                    onchange="calculateTotal()" value="5"
                    @php $hasil_data_temp=$hasil_data->{'makan'} ?? '' @endphp
                    @if ($hasil_data_temp == '5') checked @endif>
                <label class="form-check-label" for="makan"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>10 = mandiri</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="makan" id="makan"
                    onchange="calculateTotal()" value="10"
                    @php $hasil_data_temp=$hasil_data->{'makan'} ?? '' @endphp
                    @if ($hasil_data_temp == '10') checked @endif>
                <label class="form-check-label" for="makan"></label>
            </div>
        </td>
    </tr>

    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>2</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span><b> Mandi </b> </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span class="medify-form-genv4-view-container">
                @php $hasil_data_temp = $hasil_data->{'mandi'} ?? '' @endphp
                @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;Tidak Mampu (0)</span>
                @elseif($hasil_data_temp == '5')
                    <span style='font-family:calibri'>&#x2714;Mandiri (5)</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>0 = tidak mampu</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="mandi" id="mandi"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'mandi'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif>
                <label class="form-check-label" for="mandi"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>5 = mandiri</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="mandi" id="mandi"
                    onchange="calculateTotal()" value="5"
                    @php $hasil_data_temp=$hasil_data->{'mandi'} ?? '' @endphp
                    @if ($hasil_data_temp == '5') checked @endif>
                <label class="form-check-label" for="mandi"></label>
            </div>
        </td>
    </tr>

    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>3</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span><b>Personal hygiene (cuci muka, menyisir rambut, gosok gigi, cukur kumis) </b> </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span class="medify-form-genv4-view-container">
                @php $hasil_data_temp = $hasil_data->{'personal_hygiene'} ?? '' @endphp
                @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;Dibantu( 0 )</span>
                @elseif($hasil_data_temp == '5')
                    <span style='font-family:calibri'>&#x2714;Mandiri( 5 )</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>0 = dibantu</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="personal_hygiene" id="personal_hygiene"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'personal_hygiene'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif>
                <label class="form-check-label" for="personal_hygiene"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>5 = mandiri</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="personal_hygiene" id="personal_hygiene"
                    onchange="calculateTotal()" value="5"
                    @php $hasil_data_temp=$hasil_data->{'personal_hygiene'} ?? '' @endphp
                    @if ($hasil_data_temp == '5') checked @endif>
                <label class="form-check-label" for="personal_hygiene"></label>
            </div>
        </td>
    </tr>


    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>4</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span><b> Berpakaian </b> </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span class="medify-form-genv4-view-container">
                @php $hasil_data_temp = $hasil_data->{'berpakaian'} ?? '' @endphp
                @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;Tidak Mampu ( 0 )</span>
                @elseif($hasil_data_temp == '5')
                    <span style='font-family:calibri'>&#x2714;Dibantu ( 5 )</span>
                @elseif($hasil_data_temp == '10')
                    <span style='font-family:calibri'>&#x2714;Mandiri ( 10 )</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>0 = tidak mampu</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berpakaian" id="berpakaian"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'berpakaian'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif>
                <label class="form-check-label" for="berpakaian"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>5 = dibantu</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berpakaian" id="berpakaian"
                    onchange="calculateTotal()" value="5"
                    @php $hasil_data_temp=$hasil_data->{'berpakaian'} ?? '' @endphp
                    @if ($hasil_data_temp == '5') checked @endif>
                <label class="form-check-label" for="berpakaian"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>10 = mandiri (mengancing baju, ikat tali sepatu dan resleting)</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berpakaian" id="berpakaian"
                    onchange="calculateTotal()" value="10"
                    @php $hasil_data_temp=$hasil_data->{'berpakaian'} ?? '' @endphp
                    @if ($hasil_data_temp == '10') checked @endif>
                <label class="form-check-label" for="berpakaian"></label>
            </div>
        </td>
    </tr>


    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>5</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span><b> Buang Air Besar (BAB) </b> </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span class="medify-form-genv4-view-container">
                @php $hasil_data_temp = $hasil_data->{'bab'} ?? '' @endphp
                @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;Tidak dapat mengontrol ( 0 )</span>
                @elseif($hasil_data_temp == '5')
                    <span style='font-family:calibri'>&#x2714;tidak dapat mengontrol sesekali (1x/mgg) ( 5 )</span>
                @elseif($hasil_data_temp == '10')
                    <span style='font-family:calibri'>&#x2714;Mampu mengontrol BAB( 10 )</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>0 = tidak dapat mengontrol</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="bab" id="bab"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'bab'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif>
                <label class="form-check-label" for="bab"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>5 = tidak dapat mengontrol sesekali (1x/mgg)</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="bab" id="bab"
                    onchange="calculateTotal()" value="5"
                    @php $hasil_data_temp=$hasil_data->{'bab'} ?? '' @endphp
                    @if ($hasil_data_temp == '5') checked @endif>
                <label class="form-check-label" for="bab"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>10 = mampu mengontrol BAB</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="bab" id="bab"
                    onchange="calculateTotal()" value="10"
                    @php $hasil_data_temp=$hasil_data->{'bab'} ?? '' @endphp
                    @if ($hasil_data_temp == '10') checked @endif>
                <label class="form-check-label" for="bab"></label>
            </div>
        </td>
    </tr>

    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>6</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span><b> Buang Air Kecil (BAK) </b> </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span class="medify-form-genv4-view-container">
                @php $hasil_data_temp = $hasil_data->{'bak'} ?? '' @endphp
                @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;Tidak dapat mengontrol, menggunakan kateter ( 0 )</span>
                @elseif($hasil_data_temp == '5')
                    <span style='font-family:calibri'>&#x2714;Tidak dapat mengontrol sesekali (1x/mgg) ( 5 )</span>
                @elseif($hasil_data_temp == '10')
                    <span style='font-family:calibri'>&#x2714;Mampu mengontrol BAK ( 10 )</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>0 = tidak dapat mengontrol, menggunakan kateter</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="bak" id="bak"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'bak'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif>
                <label class="form-check-label" for="bak"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>5 = tidak dapat mengontrol sesekali (1x/mgg)</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="bak" id="bak"
                    onchange="calculateTotal()" value="5"
                    @php $hasil_data_temp=$hasil_data->{'bak'} ?? '' @endphp
                    @if ($hasil_data_temp == '5') checked @endif>
                <label class="form-check-label" for="bak"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>10 = mampu mengontrol BAK</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="bak" id="bak"
                    onchange="calculateTotal()" value="10"
                    @php $hasil_data_temp=$hasil_data->{'bak'} ?? '' @endphp
                    @if ($hasil_data_temp == '10') checked @endif>
                <label class="form-check-label" for="bak"></label>
            </div>
        </td>
    </tr>

    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>7</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span><b>Toileting (ke kamar kecil)</b> </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span class="medify-form-genv4-view-container">
                @php $hasil_data_temp = $hasil_data->{'toilet'} ?? '' @endphp
                @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;Dibantu seluruhnya ( 0 )</span>
                @elseif($hasil_data_temp == '5')
                    <span style='font-family:calibri'>&#x2714;Dibantu sebagian ( 5 )</span>
                @elseif($hasil_data_temp == '10')
                    <span style='font-family:calibri'>&#x2714;Mandiri ( 10 )</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>0 = dibantu seluruhnya</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="toilet" id="toilet"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'toilet'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif>
                <label class="form-check-label" for="toilet"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>5 = dibantu sebagian</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="toilet" id="toilet"
                    onchange="calculateTotal()" value="5"
                    @php $hasil_data_temp=$hasil_data->{'toilet'} ?? '' @endphp
                    @if ($hasil_data_temp == '5') checked @endif>
                <label class="form-check-label" for="toilet"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>10 = mandiri</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="toilet" id="toilet"
                    onchange="calculateTotal()" value="10"
                    @php $hasil_data_temp=$hasil_data->{'toilet'} ?? '' @endphp
                    @if ($hasil_data_temp == '10') checked @endif>
                <label class="form-check-label" for="toilet"></label>
            </div>
        </td>
    </tr>

    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>8</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span><b> Berpindah (dari tempat tidur ke kursi)</b> </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span class="medify-form-genv4-view-container">
                @php $hasil_data_temp = $hasil_data->{'berpindah_tt'} ?? '' @endphp
                @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;Tidak mampu, tidak ada keseimbangan saat duduk ( 0
                        )</span>
                @elseif($hasil_data_temp == '5')
                    <span style='font-family:calibri'>&#x2714;Dibantu satu/dua orang, bisa duduk ( 5 )</span>
                @elseif($hasil_data_temp == '10')
                    <span style='font-family:calibri'>&#x2714;Dibantu (lisan/fisik) ( 10 )</span>
                @elseif($hasil_data_temp == '15')
                    <span style='font-family:calibri'>&#x2714;Mandiri ( 15 )</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>0 = tidak mampu, tidak ada keseimbangan saat duduk</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berpindah_tt" id="berpindah_tt"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'berpindah_tt'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif>
                <label class="form-check-label" for="berpindah_tt"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>5 = dibantu satu/dua orang, bisa duduk</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berpindah_tt" id="berpindah_tt"
                    onchange="calculateTotal()" value="5"
                    @php $hasil_data_temp=$hasil_data->{'berpindah_tt'} ?? '' @endphp
                    @if ($hasil_data_temp == '5') checked @endif>
                <label class="form-check-label" for="berpindah_tt"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>10 = Dibantu (lisan/fisik)</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berpindah_tt" id="berpindah_tt"
                    onchange="calculateTotal()" value="10"
                    @php $hasil_data_temp=$hasil_data->{'berpindah_tt'} ?? '' @endphp
                    @if ($hasil_data_temp == '10') checked @endif>
                <label class="form-check-label" for="berpindah_tt"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>15 = mandiri</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="berpindah_tt" id="berpindah_tt"
                    onchange="calculateTotal()" value="15"
                    @php $hasil_data_temp=$hasil_data->{'berpindah_tt'} ?? '' @endphp
                    @if ($hasil_data_temp == '15') checked @endif>
                <label class="form-check-label" for="berpindah_tt"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>9</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span><b> Mobilisasi (berjalan di permukaan datar) </b> </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span class="medify-form-genv4-view-container">
                @php $hasil_data_temp = $hasil_data->{'mobilisasi'} ?? '' @endphp
                @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;Tidak dapat berjalan ( 0 )</span>
                @elseif($hasil_data_temp == '5')
                    <span style='font-family:calibri'>&#x2714;Menggunakan kursi roda ( 5 )</span>
                @elseif($hasil_data_temp == '10')
                    <span style='font-family:calibri'>&#x2714;Berjalan dengan bantuan satu orang ( 10 )</span>
                @elseif($hasil_data_temp == '15')
                    <span style='font-family:calibri'>&#x2714;Mandiri ( 15 )</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>0 = tidak dapat berjalan</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="mobilisasi" id="mobilisasi"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'mobilisasi'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif>
                <label class="form-check-label" for="mobilisasi"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>5 = menggunakan kursi roda</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="mobilisasi" id="mobilisasi"
                    onchange="calculateTotal()" value="5"
                    @php $hasil_data_temp=$hasil_data->{'mobilisasi'} ?? '' @endphp
                    @if ($hasil_data_temp == '5') checked @endif>
                <label class="form-check-label" for="mobilisasi"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>10 = berjalan dengan bantuan satu orang</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="mobilisasi" id="mobilisasi"
                    onchange="calculateTotal()" value="10"
                    @php $hasil_data_temp=$hasil_data->{'mobilisasi'} ?? '' @endphp
                    @if ($hasil_data_temp == '10') checked @endif>
                <label class="form-check-label" for="mobilisasi"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>15 = mandiri</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="mobilisasi" id="mobilisasi"
                    onchange="calculateTotal()" value="15"
                    @php $hasil_data_temp=$hasil_data->{'mobilisasi'} ?? '' @endphp
                    @if ($hasil_data_temp == '15') checked @endif>
                <label class="form-check-label" for="mobilisasi"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>10</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span><b> Naik dan turun tangga </b> </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span class="medify-form-genv4-view-container">
                @php $hasil_data_temp = $hasil_data->{'turun_tangga'} ?? '' @endphp
                @if ($hasil_data_temp == '0')
                    <span style='font-family:calibri'>&#x2714;Tidak Mampu ( 0 )</span>
                @elseif($hasil_data_temp == '5')
                    <span style='font-family:calibri'>&#x2714;Dibantu ( 5 )</span>
                @elseif($hasil_data_temp == '10')
                    <span style='font-family:calibri'>&#x2714;Mandiri ( 10 )</span>
                @else
                    <span style='font-family:calibri'></span>
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>0 = tidak mampu</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="turun_tangga" id="turun_tangga"
                    onchange="calculateTotal()" value="0"
                    @php $hasil_data_temp=$hasil_data->{'turun_tangga'} ?? '' @endphp
                    @if ($hasil_data_temp == '0') checked @endif>
                <label class="form-check-label" for="turun_tangga"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>5 = dibantu </span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="turun_tangga" id="turun_tangga"
                    onchange="calculateTotal()" value="5"
                    @php $hasil_data_temp=$hasil_data->{'turun_tangga'} ?? '' @endphp
                    @if ($hasil_data_temp == '5') checked @endif>
                <label class="form-check-label" for="turun_tangga"></label>
            </div>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>10 = mandiri</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div class="form-check medify-form-genv4-input-container">
                <input class="form-check-input" type="radio" name="turun_tangga" id="turun_tangga"
                    onchange="calculateTotal()" value="10"
                    @php $hasil_data_temp=$hasil_data->{'turun_tangga'} ?? '' @endphp
                    @if ($hasil_data_temp == '10') checked @endif>
                <label class="form-check-label" for="turun_tangga"></label>
            </div>
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
        <td class=" position-relative text-center" colspan="2" rowspan="1"
            style="word-wrap: break-word; white-space: normal;">
            <input type="text" class="form-control" name="category" id="category"
                value="{{ $hasil_data->category ?? '' }}" readonly>
        </td>
    </tr>
    </tr>
    {{--  <tr>
		<td class=" position-relative text-center" colspan="2" rowspan="1"><b class="h2">KESIMPULAN</b></td>
		<td class=" position-relative text-center" colspan="2" rowspan="1"><b class="h2">
            
    </td>
    
	</tr>  --}}

</table>

<table style="width:100%;">
    <tr>
        <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1"></td>
        <td style="width: 80%;"class=" position-relative text-bold" colspan="1" rowspan="1">
            <span><b>Keterangan :</b></span>
        </td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1"></td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">
            <span>⬜</span>
        </td>
        <td style="width: 80%;"class=" position-relative text-bold" colspan="1" rowspan="1">
            <span>Mandiri</span>
        </td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1">:</td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1">100</td>
    </tr>
    <tr>
        <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">
            <span>⬜</span>
        </td>
        <td style="width: 80%;"class=" position-relative text-bold" colspan="1" rowspan="1">
            <span>Ketergantungan Ringan</span>
        </td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1">:</td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1">91-99</td>
    </tr>
    <tr>
        <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">
            <span>⬜</span>
        </td>
        <td style="width: 80%;"class=" position-relative text-bold" colspan="1" rowspan="1">
            <span>Ketergantungan Sedang</span>
        </td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1">:</td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1">90-61</td>
    </tr>
    <tr>
        <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">
            <span>⬜</span>
        </td>
        <td style="width: 80%;"class=" position-relative text-bold" colspan="1" rowspan="1">
            <span>Ketergantungan Berat (- ada nilai 0 pada salah satu ADL : BAB, BAK, Toileting, Berpindah,
                Mobilisasi)</span>
        </td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1">:</td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1"><span>
                <=60< /span>
        </td>
    </tr>
    <tr>
        <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">
            <span></span>
        </td>
        <td style="width: 80%;"class=" position-relative text-bold" colspan="1" rowspan="1">
            <span> - total skor ADL < 60, ATAU</span>
        </td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1"></td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td style="width: 4%;" class=" position-relative text-bold" colspan="1" rowspan="1">
            <span></span>
        </td>
        <td style="width: 80%;"class=" position-relative text-bold" colspan="1" rowspan="1">
            <span>- ada nilai 0 pada salah satu ADL : BAB, BAK, Toileting, Berpindah, Mobilisasi</span>
        </td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1"></td>
        <td style="width: 8%;" class=" position-relative text-bold" colspan="1" rowspan="1"></td>
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
