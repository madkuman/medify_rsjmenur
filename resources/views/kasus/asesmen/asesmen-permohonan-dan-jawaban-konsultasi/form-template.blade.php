<style>
    p,h1,h2,h3,h4,h5,h6 {
        margin: 0;
    }
    .mb-0 {
        margin-bottom: 0;
    }
    .bordered {
        border: 1px solid #000;
    }
    .text-center {
        text-align: center;
    }
    .text-left {
        text-align: left;
    }
    .text-right {
        text-align: right;
    }
    table {
        border-collapse: collapse;
    }
    table tr td, table tr td {
        padding: 2px 3px;
        height: 25px;
        vertical-align: top;
    }
    .v-align-top {
        vertical-align: top;
    }
    table.bordered td,table.bordered th {
        border: 1px solid #000;
    }
    td.no-border,th.no-border {
        border: none;
    }
    table .form-group {
        margin-bottom: 0;
    }
    table .form-control {
        border: 1px solid #0080ff;
    }
    .dots-wrap {
        width: 100%;
        display: inline-block;
        vertical-align: middle;
    }
    .dots-text {
        width: auto;
        display: inline-block;
    }
    .dots {
        border-bottom: 1.8px dotted #000;
        word-break: break-word;
        display: inline-block;
    }
    .kop-img {
        object-fit: contain;
    }
    .vertical-align-middle {
        vertical-align: middle;
    }
    .medify-form-genv4-input-container {
        width: 100%;
    }
    label {
        width: 100%;
        font-weight: 400;
    }
    .d-inline-block {
        display: inline-block!important;
    }
	.medify-form-container {
        background: white;
        line-height: 1;
        margin-bottom: 10px;
    }
    .medify-form-container .border-solid-1-black {
        border: solid 1px #000;
    }
    .medify-form-container .table-border-solid-1-black-td td {
        border: solid 1px #000;
    }
    .medify-form-container.view {
        color: #000;
        background: white;
        padding: 0px;
        margin-top: 0px;
        border: none;
    }
    .medify-form-container.view .input-text {
        border: none;
    }
    @media print {
        .medify-form-container.view .footer-print {
            position: fixed;
            bottom: 0;
        }
    }
    .medify-form-container.view .title {
        display: none;
    }
    .medify-form-container.view .hide-view {
        display: none;
    }
    .medify-form-container.view input[disabled] {
    color: black;
    background: transparent;
    }
    .medify-form-container.view textarea[disabled] {
    color: black;
    background: transparent;
    }
    .medify-form-container label {
        margin: 0px;
    }
    .medify-form-container .checkbox-basic:checked + label:before {
        content: '\2713';
    }
    .medify-form-container .checkbox-basic {
        display: none;
    }
    .medify-form-container .checkbox-basic + label {
        position: relative;
        overflow: hidden;
        cursor: pointer;
        margin-bottom: -3px;
    }
    .medify-form-container .checkbox-basic + label::before {
        content: "";
        display: inline-block;
        vertical-align: -3px;
        height: 13px;
        width: 13px;
        background-color: white;
        border: solid 1px #000;
        border-radius: 0px;
        margin-right: 5px;
        font-weight: 600;
        font-size: 13px;
    }
    .medify-form-container .checkbox-basic:disabled + label {
        cursor: default;
    }
    .medify-form-container input,
    .medify-form-container textarea {
        width: 100%;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }
	.c-list li {
        margin-bottom: 4px;
    }
    .c-list li:last-child {
        margin-bottom: 0;
    }
    .c-list-horizontal li {
        display: inline-block;
        padding: 1px 2px;
        font-size: 12px;
    }
</style>
<table style="width:100%" class="marks">
    <tr>
        <td style="width: 85%"></td>
        <td class="bordered text-center" class=" position-relative" colspan="1" rowspan="1">
            RM 10.k2
        </td>
    </tr>
    <tr>
        <td></td>
        <td class="bordered text-center" class=" position-relative" colspan="1" rowspan="1">
            Halaman 
        </td>
    </tr>
</table>
<table style="width:100%" >
   <tr>
      <td width = "60%" class=" position-relative kop" colspan="1" rowspan="5">
        <img src="{{url("")}}/{{config("app.kop_lg")}}" style="height: 103px;">
      </td>
   </tr>
   <tr>
      <td width = "14%" class=" position-relative" colspan="1" rowspan="1">
        <span>No. RM</span>
      </td>
      <td width = "1%" class=" position-relative" colspan="1" rowspan="1">
        <span>:</span>
      </td>
      <td width = "25%" class=" position-relative" colspan="1" rowspan="1">
        <span>{{ $kasus->pasien->no_rm ?? '' }}</span>
      </td>
   </tr>
   <tr>
      <td width = "14%" class=" position-relative" colspan="1" rowspan="1">
        <span>Nama</span>
      </td>
      <td width = "1%" class=" position-relative" colspan="1" rowspan="1">
        <span>:</span>
      </td>
      <td width = "15%" class=" position-relative" colspan="1" rowspan="1">
        <span>{{ $kasus->pasien->name ?? '' }}</span>
      </td>
   </tr>
   <tr>
      <td width = "14%" class=" position-relative" colspan="1" rowspan="1">
        <span>Tgl Lahir/Umur</span>
      </td>
      <td width = "1%" class=" position-relative" colspan="1" rowspan="1">
        <span>:</span>
      </td>
      <td width = "15%" class=" position-relative" colspan="1" rowspan="1">
        <span>{{date('d F Y', strtotime($kasus->identitas->tanggal_lahir))}}</span>
        <span>/</span>
        <span>{{ $kasus->identitas->age ?? '' }}</span>
      </td>
   </tr>
   <tr>
      <td width = "14%" class=" position-relative" colspan="1" rowspan="1">
        <span>Jenis Kelamin</span>
      </td>
      <td width = "1%" class=" position-relative" colspan="1" rowspan="1">
        <span>:</span>
      </td>
      <td width = "15%" class=" position-relative" colspan="1" rowspan="1">
        <span>
          @if($kasus->identitas->gender == 1) Laki-laki
          @else Perempuan
          @endif
        </span>
      </td>
   </tr>
</table>


<table style="width:100%;margin:20px 0;">
    <tr>
      <td style="border-top: 1px solid #000; border-bottom:1px solid #000;" class=" position-relative text-center" colspan="1" rowspan="1">
        <h5 style="font-weight: 700">PERMOHONAN KONSULTASI</h5>
      </td>
   </tr>
</table>
@php
    $space = '&nbsp;&nbsp;';
@endphp
<table style="width:100%">
   <tr>
        <td style="width: 70%" class=" position-relative" colspan="1" rowspan="1"></td>
        <td style="width: 30%;vertical-align:top;" class=" position-relative" colspan="1" rowspan="5">
            <span>Surabaya, </span>
            @php $hasil_data_temp = $hasil_data->permohonan['tanggal_permohonan'] ?? '' @endphp
            @if ($action !=  null)
            <div class="d-inline-block">
                <input value="{{ $hasil_data_temp ?? '' }}" type="text" class="form-control js-datepicker" name="permohonan[tanggal_permohonan]" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd-mm-yyyy">
            </div>
            @else
            @if ($hasil_data_temp != '' || $hasil_data_temp != null)
            <span>{{ date('d F Y', strtotime($hasil_data_temp)) }}</span>
            @endif
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Kepada Yth :</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            @php $hasil_data_temp = $hasil_data->permohonan['kepada'] ?? '' @endphp
            @if ($action !=  null)
            <div class="d-inline-block">
                <input value="{{ $hasil_data_temp ?? '' }}" type="text" class="form-control" name="permohonan[kepada]">
            </div>
            @else
            <span>{{$space}}{{ $hasil_data_temp }}</span>
            @endif
        </td>
   </tr>
   <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Di Rumah Sakit Jiwa Menur</span>
        </td>
   </tr>
   <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Provinsi Jawa Timur</span>
        </td>
   </tr>
</table>
<br><br>
<table style="width:100%">
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Mohon konsultasi pasien :</span>
        </td>
    </tr>
    <tr>
        <td style="width: 25%" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}No. RM.</span>
        </td>
        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="width: 33%" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $kasus->pasien->no_rm }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Nama</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $kasus->pasien->name }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Jenis Kelamin</span>
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
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Umur</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $kasus->identitas->age ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Ruang / Poliklinik</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $kasus->lokasi->lokasi->nama ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Diagnosa Utama</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            @php $hasil_data_temp = $hasil_data->permohonan['diagnosisUtama'] ?? '' @endphp
            @if ($action !=  null)
                @if ($diagnosisUtama != null && $diagnosisUtama->long_desc)
                    <span>{{ $diagnosisUtama->long_desc ?? '' }}</span>
                @else
                <span>
                    <input value="{{ $hasil_data_temp ?? '' }}" type="text" class="form-control" name="permohonan[diagnosisUtama]">
                </span>
                @endif
            @else
                <span>{{ $hasil_data_temp ?? '' }}</span>
            @endif
        </td>
        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">
            <span>ICD 10</span>
        </td>
        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
            @php $hasil_data_temp = $hasil_data->permohonan['diagnosisUtama_icd10'] ?? '' @endphp
            @if ($action != null)
            <span>
                <select class="js-select2 form-control" id="selectPermohonanDiagnosisUtamaICD10" name="selectPermohonanDiagnosisUtamaICD10">
                    @if ($hasil_data_temp != '')
                    <option selected>{{ $hasil_data_temp ?? '' }}</option>
                    @endif
                </select>
            </span>
            <span>
                <input type="hidden" class="form-control" id="permohonan_diagnosisUtama_icd10" name="permohonan[diagnosisUtama_icd10]" value="{{ $hasil_data_temp ?? '' }}">
            </span>
            @else
            <span>{{ $hasil_data_temp ?? '' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Diagnosa tambahan / sekunder</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td  class=" position-relative" colspan="4" rowspan="1">
            @php $hasil_data_temp = $hasil_data->permohonan['diagnosa_sekunder'] ?? '' @endphp
            <ul style="margin: 0;" class="list-unstyled c-list c-list-horizontal mb-0">
                <li>
                    <input class="form-check-input checkbox-basic" type="radio" name="permohonan[diagnosa_sekunder]" id="permohonan_diagnosa_sekunder_0" value="0" @if ($hasil_data_temp == '0') checked @endif @if($action == null) disabled @endif>
                    <label for="permohonan_diagnosa_sekunder_0">Tidak Ada</label>
                </li>
                <li>
                    <input class="form-check-input checkbox-basic" type="radio" name="permohonan[diagnosa_sekunder]" id="permohonan_diagnosa_sekunder_1" value="1" @if ($hasil_data_temp == '1') checked @endif @if($action == null) disabled @endif>
                    <label for="permohonan_diagnosa_sekunder_1">Ada</label>
                </li>
            </ul>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>ICD 10</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            @php $hasil_data_temp = $hasil_data->permohonan['diagnosisSekunder_icd10'] ?? '' @endphp
            @if ($action != null)
            <span>
                <select class="js-select2 form-control" id="selectPermohonanDiagnosisSekunderICD10" name="selectPermohonanDiagnosisSekunderICD10">
                    @if ($hasil_data_temp != '')
                    <option selected>{{ $hasil_data_temp ?? '' }}</option>
                    @endif
                </select>
            </span>
            <span>
                <input type="hidden" class="form-control" id="permohonan_diagnosisSekunder_icd10" name="permohonan[diagnosisSekunder_icd10]" value="{{ $hasil_data_temp ?? '' }}">
            </span>
            @else
            <span>{{ $hasil_data_temp ?? '' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Tujuan Konsultasi :</span>
        </td>
    </tr>
    <tr>
        <td style="height:70px;" class=" position-relative" colspan="6" rowspan="1">
            @php $hasil_data_temp = $hasil_data->permohonan['tujuan_konsultasi'] ?? '' @endphp
            @if ($action != null)
            <textarea class="form-control" name="permohonan[tujuan_konsultasi]" rows="3">{{ $hasil_data_temp }}</textarea>
            @else
            <span>{{ $hasil_data_temp }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">Yang Mengirim,</td>
    </tr>
    <tr>
        <td style="height: 50px;" class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            @php $hasil_data_temp = $hasil_data->permohonan['pengirim'] ?? '' @endphp
            @if ($action !=  null)
            <input value="{{ $hasil_data_temp ?? '' }}" type="text" class="form-control" name="permohonan[pengirim]">
            @else
            <span>{{ $hasil_data_temp }}</span>
            @endif
        </td>
    </tr>
</table>
<table style="width:100%;margin:10px 0;">
    <tr>
      <td style="border-top:2px solid #000;" class=" position-relative text-center" colspan="1" rowspan="1">
        <h5 style="font-weight: 700">JAWABAN KONSULTASI</h5>
      </td>
   </tr>
</table>
<table style="width:100%">
    <tr>
        <td class=" position-relative" colspan="5" rowspan="1">
            <span>Bersama ini kami sampaikan hasil pemeriksaan pasien diatas :</span>
        </td>
    </tr>
    <tr>
        <td style="width:25%;" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Pada pemeriksaan ditemukan</span>
        </td>
        <td style="width:2%;" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="width: 33%" class=" position-relative" colspan="1" rowspan="1">
            @php $hasil_data_temp = $hasil_data->jawaban['pemeriksaan_ditemukan'] ?? '' @endphp
            @if ($action !=  null)
            <div class="d-inline-block">
                <input value="{{ $hasil_data_temp ?? '' }}" type="text" class="form-control" name="jawaban[pemeriksaan_ditemukan]">
            </div>
            @else
            <span>{{ $hasil_data_temp }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Diagnosa Utama</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            @php $hasil_data_temp = $hasil_data->jawaban['diagnosisUtama'] ?? '' @endphp
            @if ($action !=  null)
                @if ($diagnosisUtama != null && $diagnosisUtama->long_desc)
                    <span>{{ $diagnosisUtama->long_desc ?? '' }}</span>
                @else
                <span>
                    <input value="{{ $hasil_data_temp ?? '' }}" type="text" class="form-control" name="jawaban[diagnosisUtama]">
                </span>
                @endif
            @else
                <span>{{ $hasil_data_temp ?? '' }}</span>
            @endif
        </td>
        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">
            <span>ICD 10</span>
        </td>
        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
            @php $hasil_data_temp = $hasil_data->jawaban['diagnosisUtama_icd10'] ?? '' @endphp
            @if ($action != null)
            <span>
                <select class="js-select2 form-control" id="selectJawabanDiagnosisUtamaICD10" name="selectJawabanDiagnosisUtamaICD10">
                    @if ($hasil_data_temp != '')
                    <option selected>{{ $hasil_data_temp ?? '' }}</option>
                    @endif
                </select>
            </span>
            <span>
                <input type="hidden" class="form-control" id="jawaban_diagnosisUtama_icd10" name="jawaban[diagnosisUtama_icd10]" value="{{ $hasil_data_temp ?? '' }}">
            </span>
            @else
            <span>{{ $hasil_data_temp ?? '' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Diagnosa tambahan / sekunder</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td  class=" position-relative" colspan="4" rowspan="1">
            @php $hasil_data_temp = $hasil_data->jawaban['diagnosa_sekunder'] ?? '' @endphp
            <ul style="margin: 0;" class="list-unstyled c-list c-list-horizontal mb-0">
                <li>
                    <input class="form-check-input checkbox-basic" type="radio" name="jawaban[diagnosa_sekunder]" id="jawaban_diagnosa_sekunder_0" value="0" @if ($hasil_data_temp == '0') checked @endif @if($action == null) disabled @endif>
                    <label for="jawaban_diagnosa_sekunder_0">Tidak Ada</label>
                </li>
                <li>
                    <input class="form-check-input checkbox-basic" type="radio" name="jawaban[diagnosa_sekunder]" id="jawaban_diagnosa_sekunder_1" value="1" @if ($hasil_data_temp == '1') checked @endif @if($action == null) disabled @endif>
                    <label for="jawaban_diagnosa_sekunder_1">Ada</label>
                </li>
            </ul>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>ICD 10</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            @php $hasil_data_temp = $hasil_data->jawaban['diagnosisSekunder_icd10'] ?? '' @endphp
            @if ($action != null)
            <span>
                <select class="js-select2 form-control" id="selectJawabanDiagnosisSekunderICD10" name="selectJawabanDiagnosisSekunderICD10">
                    @if ($hasil_data_temp != '')
                    <option selected>{{ $hasil_data_temp ?? '' }}</option>
                    @endif
                </select>
            </span>
            <span>
                <input type="hidden" class="form-control" id="jawaban_diagnosisSekunder_icd10" name="jawaban[diagnosisSekunder_icd10]" value="{{ $hasil_data_temp ?? '' }}">
            </span>
            @else
            <span>{{ $hasil_data_temp ?? '' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td style="height: 70px;" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Pengobatan yang diberikan</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="6" rowspan="1">
            @php $hasil_data_temp = $hasil_data->jawaban['pengobatan_yang_diberikan'] ?? '' @endphp
            @if ($action != null)
            <textarea class="form-control" name="jawaban[pengobatan_yang_diberikan]" rows="3">{{ $hasil_data_temp }}</textarea>
            @else
            <span>{{ $hasil_data_temp }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Saran :</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td  class=" position-relative" colspan="4" rowspan="1">
            @php $hasil_data_temp = $hasil_data->jawaban['saran'] ?? '' @endphp
            <ul style="margin: 0;" class="list-unstyled c-list c-list-horizontal mb-0">
                <li>
                    <input class="form-check-input checkbox-basic" type="radio" name="jawaban[saran]" id="jawaban_saran_1" value="1" @if ($hasil_data_temp == '1') checked @endif @if($action == null) disabled @endif>
                    <label for="jawaban_saran_1">Rawat bersama</label>
                </li>
                <li>
                    <input class="form-check-input checkbox-basic" type="radio" name="jawaban[saran]" id="jawaban_saran_2" value="2" @if ($hasil_data_temp == '2') checked @endif @if($action == null) disabled @endif>
                    <label for="jawaban_saran_2">Tindakan</label>
                </li>
                <li>
                    <input class="form-check-input checkbox-basic" type="radio" name="jawaban[saran]" id="jawaban_saran_3" value="3" @if ($hasil_data_temp == '3') checked @endif @if($action == null) disabled @endif>
                    <label for="jawaban_saran_3">Alih Rawat</label>
                </li>
                <li style="display: inline-block;">
                    <input class="form-check-input checkbox-basic" type="radio" name="jawaban[saran]" id="jawaban_saran_4" value="4" @if ($hasil_data_temp == '4') checked @endif @if($action == null) disabled @endif>
                    <label style="width: auto;" for="jawaban_saran_4">Lain-lain</label>
                    @php $hasil_data_temp = $hasil_data->jawaban['saran_lain_lain'] ?? '' @endphp
                    @if ($action != null)
                    <div class="d-inline-block">
                        <input style="height: 24px;" value="{{ $hasil_data_temp ?? '' }}" type="text" class="form-control" name="jawaban[saran_lain_lain]">
                    </div>
                    @else
                    <div class="d-inline-block">
                        <span>( {{ $hasil_data_temp ?? '' }} )</span>
                    </div>
                    @endif
                </li>
            </ul>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Surabaya, </span>
            @php $hasil_data_temp = $hasil_data->jawaban['tanggal_jawaban'] ?? '' @endphp
            @if ($action !=  null)
            <div class="d-inline-block">
                <input value="{{ $hasil_data_temp ?? '' }}" type="text" class="form-control js-datepicker" name="jawaban[tanggal_jawaban]" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd-mm-yyyy">
            </div>
            @else
            @if ($hasil_data_temp != '' || $hasil_data_temp != null)
            <span>{{ date('d F Y', strtotime($hasil_data_temp)) }}</span>
            @endif
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">Yang Menjawab,</td>
    </tr>
    <tr>
        <td style="height: 50px;" class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            @php $hasil_data_temp = $hasil_data->jawaban['menjawab'] ?? '' @endphp
            @if ($action !=  null)
            <input value="{{ $hasil_data_temp ?? '' }}" type="text" class="form-control" name="jawaban[menjawab]">
            @else
            <span>{{ $hasil_data_temp }}</span>
            @endif
        </td>
    </tr>
</table>
<br><br><br>
<footer style="width: 25%;">
    <strong>RSJM / Revisi 01 / 02. 2019</strong>
</footer>
@section('js')
<script type="text/javascript">
// permohonan
$('#selectPermohonanDiagnosisSekunderICD10').select2({
    ajax: {
        url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/searchICD10',
        data: function(params){
            return {
                long_desc: params.term, 
            };
        },
        delay: 250,
        processResults: function (data, params) {
            var  res = JSON.parse(data);
            var results = [];
            if(res.code == 200){
                results = res.data.data;
            }
            return {
                results: $.map(results, function(obj) {
                    return { id: obj.id, text: obj.long_desc };
                })
            };
        },
        cache: true
    }
}).on('change', function() {
    var selectedOption = $(this).select2('data')[0];
    $('#permohonan_diagnosisSekunder_icd10').val(selectedOption.text)
});
$('#selectPermohonanDiagnosisUtamaICD10').select2({
    ajax: {
        url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/searchICD10',
        data: function(params){
            return {
                long_desc: params.term, 
            };
        },
        delay: 250,
        processResults: function (data, params) {
            var  res = JSON.parse(data);
            var results = [];
            if(res.code == 200){
                results = res.data.data;
            }
            return {
                results: $.map(results, function(obj) {
                    return { id: obj.id, text: obj.long_desc };
                })
            };
        },
        cache: true
    }
}).on('change', function() {
    var selectedOption = $(this).select2('data')[0];
    $('#permohonan_diagnosisUtama_icd10').val(selectedOption.text)
});
// jawaban
$('#selectJawabanDiagnosisSekunderICD10').select2({
    ajax: {
        url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/searchICD10',
        data: function(params){
            return {
                long_desc: params.term, 
            };
        },
        delay: 250,
        processResults: function (data, params) {
            var  res = JSON.parse(data);
            var results = [];
            if(res.code == 200){
                results = res.data.data;
            }
            return {
                results: $.map(results, function(obj) {
                    return { id: obj.id, text: obj.long_desc };
                })
            };
        },
        cache: true
    }
}).on('change', function() {
    var selectedOption = $(this).select2('data')[0];
    $('#jawaban_diagnosisSekunder_icd10').val(selectedOption.text)
});
$('#selectJawabanDiagnosisUtamaICD10').select2({
    ajax: {
        url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/searchICD10',
        data: function(params){
            return {
                long_desc: params.term, 
            };
        },
        delay: 250,
        processResults: function (data, params) {
            var  res = JSON.parse(data);
            var results = [];
            if(res.code == 200){
                results = res.data.data;
            }
            return {
                results: $.map(results, function(obj) {
                    return { id: obj.id, text: obj.long_desc };
                })
            };
        },
        cache: true
    }
}).on('change', function() {
    var selectedOption = $(this).select2('data')[0];
    $('#jawaban_diagnosisUtama_icd10').val(selectedOption.text)
});
</script>
@endsection