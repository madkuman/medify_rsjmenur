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
        <div class="border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>RM.24.K4</b>&nbsp;&nbsp;&nbsp;</div>
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
<br>
<br>
<table style="width:100%;">
   <tr>
      <td class=" position-relative text-center" colspan="1" rowspan="1">
        <h5>FORMULIR PERMINTAAN PELAYANAN ROHANI</h5>
      </td>
   </tr>
</table>
<br>
<table style="width:100%;">
    
     <tr>
         <td style="width: 20%" class=" position-relative" colspan="1" rowspan="1">
            <span>Nama</span>
         </td>
         <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
         </td>
         <td style="width: 78%" class=" position-relative" colspan="1" rowspan="1">
          <span type="hidden">{{ $hasil_data->penerima ?? '' }}</span>  
          <div class="form-group medify-form-genv4-input-container">
                @if ($action != null)
                <input type="text" class="form-control" name="penerima" value="{{ $hasil_data->penerima ?? '' }}">
                @else
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->penerima ?? '' }}</span>
                @endif
            </div>
         </td>
    </tr>
    <tr>
         <td style="width: 20%" class=" position-relative" colspan="1" rowspan="1">
            <span>Alamat</span>
         </td>
         <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
         </td>
         <td style="width: 78%" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                @if ($action != null)
                <input type="text" class="form-control" name="alamat" value="{{ $hasil_data->alamat ?? '' }}">
                @else
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->alamat ?? '' }}</span>
                @endif
            </div>
            <span type="hidden">{{ $hasil_data->alamat ?? '' }}</span>
         </td>
    </tr>
    <tr>
         <td style="width: 20%" class=" position-relative" colspan="1" rowspan="1">
            <span>No. Telepon</span>
         </td>
         <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
         </td>
         <td style="width: 78%" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                @if ($action != null)
                <input type="text" class="form-control" name="telepon" value="{{ $hasil_data->telepon ?? '' }}">
                @else
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->telepon ?? '' }}</span>
                @endif
            </div>
            <span type="hidden">{{ $hasil_data->telepon ?? '' }}</span>
         </td>
    </tr>
     <tr>
         <td style="width: 20%" class=" position-relative" colspan="1" rowspan="1">
            <span>Hub. Pasien</span>
         </td>
         <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
         </td>
         <td style="width: 78%" class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                @if ($action != null)
                <input type="text" class="form-control" name="hubungan" value="{{ $hasil_data->hubungan ?? '' }}">
                @else
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->hubungan ?? '' }}</span>
                @endif
            </div>
            <span type="hidden">{{ $hasil_data->hubungan ?? '' }}</span>
         </td>
    </tr>
</table>
<br>
<table style="width:100%;">
<tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
         <span>Dengan ini menyatakan bahwa saya/keluarga/penanggung jawab *) membutuhkan pelayanan</span>   
         <span>rohani untuk agama 
            <div class="form-group medify-form-genv4-input-container">
                @if ($action != null)
                <input type="text" class="form-control" name="agama" value="{{ $hasil_data->agama ?? '' }}">
                @else
                <span class="medify-form-genv4-view-container"> {{ $hasil_data->agama ?? '' }}</span>
                @endif 
                 </div>
                </span>
        <span type="hidden">{{ $hasil_data->agama ?? '' }}</span> 
        <span>Oleh sebab itu, kami mohon untuk disediakan rohaniawan untuk agama tersebut, dengan / tanpa buku doa *)</span>
        </td>
    </tr>
</table>
<br>
<br>
<br>
@if ($action != 'view')
<table style="width:100%;">

    <tr>
        <td style="width: 33%" class=" position-relative text-center" colspan="1" rowspan="1">
            <div>Keluarga/Penanggung Jawab Pasien</div>
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
        
        <td style="width: 33%" class=" position-relative text-center" colspan="1" rowspan="1">
            <div>Dokter Penanggung Jawab Pasien (DPJP)</div>
            <br><br><br><br>
            @php $hasil_data_temp = $hasil_data->{'terapis_gigi_dan_mulut_1'} ?? '' @endphp
            <span>
                <select class="js-select2 form-control" id="selectTtdTerapisGigiDanMulut1" name="selectTtdTerapisGigiDanMulut1">
                    @if ($hasil_data_temp != '')
                    <option selected>{{ $hasil_data_temp ?? '' }}</option>
                    @endif
                </select>
            </span>
            <span>
                <input type="hidden" class="form-control" id="terapis_gigi_dan_mulut_1" name="terapis_gigi_dan_mulut_1" value="{{ $hasil_data->{'terapis_gigi_dan_mulut_1'} ?? '' }}">
                <input type="hidden" class="form-control" id="ttd_terapis_gigi_dan_mulut_1" name="ttd_terapis_gigi_dan_mulut_1" value="{{ $hasil_data->{'ttd_terapis_gigi_dan_mulut_1'} ?? '' }}">
            </span>
        </td>
        <td style="width: 33%" class=" position-relative text-center" colspan="1" rowspan="1">
            <div>Dokter Umum / Tenaga Medis</div>
            <br><br><br><br>
            @php $hasil_data_temp = $hasil_data->{'terapis_gigi_dan_mulut_2'} ?? '' @endphp
            <span>
                <select class="js-select2 form-control" id="selectTtdTerapisGigiDanMulut2" name="selectTtdTerapisGigiDanMulut2">
                    @if ($hasil_data_temp != '')
                    <option selected>{{ $hasil_data_temp ?? '' }}</option>
                    @endif
                </select>
            </span>
            <span>
                <input type="hidden" class="form-control" id="terapis_gigi_dan_mulut_2" name="terapis_gigi_dan_mulut_2" value="{{ $hasil_data->{'terapis_gigi_dan_mulut_2'} ?? '' }}">
                <input type="hidden" class="form-control" id="ttd_terapis_gigi_dan_mulut_2" name="ttd_terapis_gigi_dan_mulut_2" value="{{ $hasil_data->{'ttd_terapis_gigi_dan_mulut_2'} ?? '' }}">
            </span>
        </td>
    </tr>
</table>
@else
<table style="width:100%;">
    <tr>
        
       <td style="width: 33%" class=" position-relative text-center" colspan="1" rowspan="1">
            <div>Keluarga/Penanggung Jawab Pasien</div>
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
        <td style="width: 33%" class=" position-relative text-center" colspan="1" rowspan="1">
            <div>Dokter Penanggung Jawab Pasien</div>
            @if (($hasil_data->{'terapis_gigi_dan_mulut_1'} ?? '') != '')
                @if (file_exists(((($hasil_data->{'ttd_terapis_gigi_dan_mulut_1'} ?? '') ?? ''))))
                <div>
                    <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;" src="{{ url('') }}/{{ $hasil_data->{'ttd_terapis_gigi_dan_mulut_1'} }}" alt="Tanda tangan">
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
        <td tyle="width: 33%" class=" position-relative text-center" colspan="1" rowspan="1">
            <div>Dokter Yang Memberikan Informasi</div>
             @if (($hasil_data->{'terapis_gigi_dan_mulut_2'} ?? '') != '')
                @if (file_exists(((($hasil_data->{'ttd_terapis_gigi_dan_mulut_2'} ?? '') ?? ''))))
                <div>
                    <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;" src="{{ url('') }}/{{ $hasil_data->{'ttd_terapis_gigi_dan_mulut_2'} }}" alt="Tanda tangan">
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