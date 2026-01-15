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
      vertical-align: top!important;
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
    h1, h2, h3, h4, h5, h6 {
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
            display: block!important;
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
    input.custom-checkbox + label {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
    input.custom-checkbox + label::before {
        content: "☐";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 12px;
        height: 12px;
    }
    input.custom-checkbox:checked + label::before {
        content: "✔";
    }
    .border {
        border-color: #000!important;
    }
</style>

@if ($action != 'view')
    <style>
        .medify-form-genv4-view-container {
            display: none!important;
        }
    </style>
@else
    <style>
        .medify-form-genv4-input-container {
            display: none!important;
        }
    </style>
@endif
@if (($print ?? '') ?? '')
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
            <img style="max-width: 100%;object-fit:contain;" src="{{url('')}}/{{ config('app.kop_lg') }}" width="300" height="90">
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
        <span>{{date('d F Y', strtotime($kasus->identitas->tanggal_lahir))}}</span>
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
          @if($kasus->identitas->gender == 1) Laki-laki
          @else Perempuan
          @endif
        </span>
      </td>
   </tr>
</table>
<br>
<table style="width:100%;">
   <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <h5>SELF REPORTING QUESTIONNAIRE - 20</h5>
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
<table style="width:100%;">
  <tr>
         <td text-align="justify" style="width: 20%" class=" position-relative" colspan="1" rowspan="1">
            <span text-align="justify"><b>PETUNJUK</b> Bacalah petunjuk ini seluruhnya sebelum mulai mengisi. Pertanyaan berikut
berhubungan dengan masalah yang mungkin mengganggu Anda <b> selama 30 hari terakhir.</b>
Apabila Anda menganggap pertanyaan itu Anda alami dalam 30 hari terakhir, berilah tanda
silang (X) pada kolom <b>Y (berarti Ya).</b> Sebaliknya, Apabila Anda menganggap pertanyaan itu
tidak Anda alami dalam 30 hari terakhir, berilah tanda silang (X) pada kolom<b> T (Tidak).</b> Jika
Anda tidak yakin tentang jawabannya, berilah jawaban yang paling sesuai di antara Y dan T.
Kami tegaskan bahwa jawaban Anda bersifat rahasia dan akan digunakan hanya untuk
membantu pemecahan masalah Anda.</span>
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
            <span><b>YA</b></span>
        </td>
        <td style="width:8%;" class=" position-relative text-center" colspan="1" rowspan="1">
            <span><b>TIDAK</b></span>
        </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>1</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda sering merasa sakit kepala ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="sakit_kepala" id="sakit_kepala" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'sakit_kepala'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="sakit_kepala">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sakit_kepala'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="sakit_kepala" id="sakit_kepala" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'sakit_kepala'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="sakit_kepala">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sakit_kepala'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>2</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda kehilangan nafsu makan ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="nafsu_makan" id="nafsu_makan" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'nafsu_makan'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="nafsu_makan">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'nafsu_makan'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="nafsu_makan" id="nafsu_makan" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'nafsu_makan'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="nafsu_makan">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'nafsu_makan'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>3</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>TApakah tidur Anda tidak nyenyak ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="tidur_nyenyak" id="tidur_nyenyak" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'tidur_nyenyak'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="tidur_nyenyak">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tidur_nyenyak'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="tidur_nyenyak" id="tidur_nyenyak" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'tidur_nyenyak'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="tidur_nyenyak">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tidur_nyenyak'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>4</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda mudah merasa takut ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="takut" id="takut" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'takut'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="takut">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'takut'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="takut" id="takut" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'takut'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="takut">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'takut'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>5</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda merasa cemas, tegang, atau khawatir ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="cemas_takut_khawatir" id="cemas_takut_khawatir" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'cemas_takut_khawatir'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="cemas_takut_khawatir">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'cemas_takut_khawatir'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="cemas_takut_khawatir" id="cemas_takut_khawatir" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'cemas_takut_khawatir'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="cemas_takut_khawatir">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'cemas_takut_khawatir'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>6</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah tangan Anda gemetar ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="nama_orang_mengerjakan" id="nama_orang_mengerjakan" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'nama_orang_mengerjakan'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="nama_orang_mengerjakan">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'nama_orang_mengerjakan'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="nama_orang_mengerjakan" id="nama_orang_mengerjakan" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'nama_orang_mengerjakan'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="nama_orang_mengerjakan">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'nama_orang_mengerjakan'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>7</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda mengalami gangguan pencernaan ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="gangguan_pencernaan" id="gangguan_pencernaan" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'gangguan_pencernaan'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="gangguan_pencernaan">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'gangguan_pencernaan'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="gangguan_pencernaan" id="gangguan_pencernaan" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'gangguan_pencernaan'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="gangguan_pencernaan">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'gangguan_pencernaan'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>8</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda merasa sulit berpikir jernih ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="berpikir_jernih" id="berpikir_jernih" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'berpikir_jernih'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="berpikir_jernih">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'berpikir_jernih'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="berpikir_jernih" id="berpikir_jernih" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'berpikir_jernih'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="berpikir_jernih">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'berpikir_jernih'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>9</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda merasa tidak bahagia ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="tidak_bahagia" id="tidak_bahagia" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'tidak_bahagia'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="tidak_bahagia">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tidak_bahagia'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="tidak_bahagia" id="tidak_bahagia" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'tidak_bahagia'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="tidak_bahagia">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tidak_bahagia'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>10</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda lebih sering menangis ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="sering_menangis" id="sering_menangis" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'sering_menangis'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="sering_menangis">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sering_menangis'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="sering_menangis" id="sering_menangis" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'sering_menangis'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="sering_menangis">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'sering_menangis'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>11</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda merasa sulit untuk menikmati aktivitas sehari-hari ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="menikmati_aktivitas" id="menikmati_aktivitas" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'menikmati_aktivitas'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="menikmati_aktivitas">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'menikmati_aktivitas'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="menikmati_aktivitas" id="menikmati_aktivitas" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'menikmati_aktivitas'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="menikmati_aktivitas">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'menikmati_aktivitas'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
    <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>12</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda mengalami kesulitan untuk mengambil keputusan ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="mengambil_keputusan" id="mengambil_keputusan" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'mengambil_keputusan'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="mengambil_keputusan">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'mengambil_keputusan'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="mengambil_keputusan" id="mengambil_keputusan" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'mengambil_keputusan'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="mengambil_keputusan">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'mengambil_keputusan'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
       <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>13</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah aktivitas/tugas sehari-hari Anda terbengkalai ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="aktivitas_terbengkalai" id="aktivitas_terbengkalai" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'aktivitas_terbengkalai'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="aktivitas_terbengkalai">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'aktivitas_terbengkalai'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="aktivitas_terbengkalai" id="aktivitas_terbengkalai" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'aktivitas_terbengkalai'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="aktivitas_terbengkalai">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'aktivitas_terbengkalai'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
       <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>14</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda merasa tidak mampu berperan dalam kehidupan ini ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="tidak_mampu_berperan" id="tidak_mampu_berperan" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'tidak_mampu_berperan'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="tidak_mampu_berperan">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tidak_mampu_berperan'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="tidak_mampu_berperan" id="tidak_mampu_berperan" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'tidak_mampu_berperan'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="tidak_mampu_berperan">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tidak_mampu_berperan'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
       <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>15</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda kehilangan minat terhadap banyak hal ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="kehilangan_minat" id="kehilangan_minat" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'kehilangan_minat'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="kehilangan_minat">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kehilangan_minat'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="kehilangan_minat" id="kehilangan_minat" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'kehilangan_minat'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="kehilangan_minat">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'kehilangan_minat'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
       <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>16</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda merasa tidak berharga ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="tidak_berharga" id="tidak_berharga" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'tidak_berharga'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="tidak_berharga">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tidak_berharga'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="tidak_berharga" id="tidak_berharga" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'tidak_berharga'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="tidak_berharga">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tidak_berharga'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
       <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>17</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda mempunyai pikiran untuk mengakhiri hidup Anda ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="mengakhiri_hidup" id="mengakhiri_hidup" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'mengakhiri_hidup'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="mengakhiri_hidup">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'mengakhiri_hidup'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="mengakhiri_hidup" id="mengakhiri_hidup" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'mengakhiri_hidup'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="mengakhiri_hidup">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'mengakhiri_hidup'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
       <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>18</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda merasa lelah sepanjang waktu ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="merasa_lelah" id="merasa_lelah" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'merasa_lelah'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="merasa_lelah">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'merasa_lelah'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="merasa_lelah" id="merasa_lelah" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'merasa_lelah'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="merasa_lelah">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'merasa_lelah'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
       <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>19</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda merasa tidak enak di perut ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="tidak_enak_perut" id="tidak_enak_perut" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'tidak_enak_perut'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="tidak_enak_perut">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tidak_enak_perut'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="tidak_enak_perut" id="tidak_enak_perut" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'tidak_enak_perut'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="tidak_enak_perut">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'tidak_enak_perut'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
    </tr>
       <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <span>20</span>
      </td>
      <td class=" position-relative" colspan="1" rowspan="1">
        <span>Apakah Anda mudah lelah ?</span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="mudah_lelah" id="mudah_lelah" onchange="calculateTotal()" value="1" @php $hasil_data_temp=$hasil_data->{'mudah_lelah'} ?? '' @endphp @if($hasil_data_temp == '1' ) checked @endif > <label class="form-check-label" for="mudah_lelah">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'mudah_lelah'} ?? '' @endphp @if($hasil_data_temp == '1' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
      </td>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <div class="form-check form-check-inline medify-form-genv4-input-container">
            <input class="form-check-input" type="radio" name="mudah_lelah" id="mudah_lelah" onchange="calculateTotal()" value="0" @php $hasil_data_temp=$hasil_data->{'mudah_lelah'} ?? '' @endphp @if($hasil_data_temp == '0' ) checked @endif > <label class="form-check-label" for="mudah_lelah">  </label>
        </div>
        <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->{'mudah_lelah'} ?? '' @endphp @if($hasil_data_temp == '0' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif  </span>
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
