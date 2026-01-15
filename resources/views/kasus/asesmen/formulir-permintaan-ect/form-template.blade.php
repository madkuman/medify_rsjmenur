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
      margin-top: .55cm; 
      margin-right: 1.4cm; 
      margin-bottom: .45cm;
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
        <div class="border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RM. 22&nbsp;&nbsp;&nbsp;</div>
        <div class="border-left border-right border-bottom">
            &nbsp;&nbsp;&nbsp;<span>Halaman&nbsp;{PAGENO}/{nb}&nbsp;&nbsp;</span>
        </div>
    </div>
</htmlpageheader>
@endif
<table style="width:100%">
    <tr>
        <td width="70%" class=" position-relative" colspan="1" rowspan="1">
            <img style="max-width: 100%;object-fit:contain;" src="{{url('')}}/{{ config('app.kop_lg') }}" width="300">
        </td>
        <td width="15%" class=" position-relative" colspan="1" rowspan="1"></td>
        <td width="15%" class=" position-relative text-right" colspan="1" rowspan="1">
            {{-- <table style="width:100%">
                <tr>
                    <td class=" position-relative border text-center" colspan="1" rowspan="1">
                        <span>RM. 22</span>
                    </td>
                </tr>
                <tr>
                    <td class=" position-relative border text-center" colspan="1" rowspan="1">
                        <span>Halaman 1 / 2</span>
                    </td>
                </tr>
            </table> --}}
        </td>
    </tr>
</table>
<br>
<table style="width:100%;" class="c-table--bordered">
    <tr>
        <td class=" position-relative text-center" colspan="4" rowspan="1">
            <h5>PEMBERIAN INFORMASI ELECTRO CONVULSIVE THERAPY (ECT)</h5>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1">
            <span>Dokter Pelaksana Tindakan</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            @php $hasil_data_temp = $hasil_data->dokter_pelaksana ?? '' @endphp
            @if ($action != 'view')
            <span>
                <select style="width: 50%" class="js-select2 form-control" id="selectDokterPelaksana" name="selectDokterPelaksana">
                    @if ($hasil_data_temp != '')
                    <option selected>{{ $hasil_data_temp ?? '' }}</option>
                    @endif
                </select>
            </span>
            <span>
                <input type="hidden" class="form-control" id="dokter_pelaksana" name="dokter_pelaksana" value="{{ $hasil_data->dokter_pelaksana ?? '' }}">
            </span>
            @else
            <span>{{ $hasil_data->dokter_pelaksana ?? '' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1">
            <span>Pemberi  Informasi</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            @php $hasil_data_temp = $hasil_data->pemberi_informasi ?? '' @endphp
            @if ($action != 'view')
            <span>
                <select style="width: 50%" class="js-select2 form-control" id="selectPemberiInformasi" name="selectPemberiInformasi">
                    @if ($hasil_data_temp != '')
                    <option selected>{{ $hasil_data_temp ?? '' }}</option>
                    @endif
                </select>
            </span>
            <span>
                <input type="hidden" class="form-control" id="pemberi_informasi" name="pemberi_informasi" value="{{ $hasil_data->pemberi_informasi ?? '' }}">
            </span>
            @else
            <span>{{ $hasil_data->pemberi_informasi ?? '' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="2" rowspan="1">
            <span>Penerima Informasi / pemberi persetujuan *)</span>
        </td>
        <td class=" position-relative" colspan="2" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input style="width: 100%;" type="text" class="form-control" name="penerima_informasi" value="{{$hasil_data->{'penerima_informasi'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'penerima_informasi'} ?? '' ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td style="width: 5%;" class=" position-relative" colspan="1" rowspan="1"></td>
        <th style="width: 20%;" class=" position-relative text-center border" colspan="1" rowspan="1">
            <span>JENIS INFORMASI</span>
        </th>
        <th style="width: 45%;" class=" position-relative text-center border" colspan="1" rowspan="1">
            <span>ISI INFORMASI</span>
        </th>
        <th style="width: 30%;" class=" position-relative text-center border" colspan="1" rowspan="1">
            <span>TANDAI (√)</span>
        </th>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">1</td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Diagnosis WD & DD</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input style="width: 100%;" type="text" class="form-control" name="diagnosis_wd_dd_ket" value="{{$hasil_data->{'diagnosis_wd_dd_ket'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'diagnosis_wd_dd_ket'} ?? '' ?? ''}}</span>
        </td>
        <td class=" position-relative text-center vertical-align-middle" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input custom-checkbox" type="checkbox" name="diagnosis_wd_dd" id="checkbox-input-fasf23" value="Diagnosis WD & DD" @php $hasil_data_temp=$hasil_data->diagnosis_wd_dd ?? '' @endphp @if($hasil_data_temp == 'Diagnosis WD & DD' ) checked @endif > <label class="form-check-label" for="checkbox-input-fasf23"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->diagnosis_wd_dd ?? '' @endphp @if($hasil_data_temp == 'Diagnosis WD & DD' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">2</td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Dasar Diagnosis</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>PPDGJ III</span>
        </td>
        <td class=" position-relative text-center vertical-align-middle" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input custom-checkbox" type="checkbox" name="dasar_diagnosis" id="checkbox-input-asfq3" value="Dasar Diagnosis" @php $hasil_data_temp=$hasil_data->dasar_diagnosis ?? '' @endphp @if($hasil_data_temp == 'Dasar Diagnosis' ) checked @endif > <label class="form-check-label" for="checkbox-input-asfq3"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->dasar_diagnosis ?? '' @endphp @if($hasil_data_temp == 'Dasar Diagnosis' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">3</td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Tindakan kedokteran</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Electro Convulsive Therapy</span>
        </td>
        <td class=" position-relative text-center vertical-align-middle" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input custom-checkbox" type="checkbox" name="tindakan_kedokteran" id="checkbox-input-214de" value="Tindakan kedokteran" @php $hasil_data_temp=$hasil_data->tindakan_kedokteran ?? '' @endphp @if($hasil_data_temp == 'Tindakan kedokteran' ) checked @endif > <label class="form-check-label" for="checkbox-input-214de"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->tindakan_kedokteran ?? '' @endphp @if($hasil_data_temp == 'Tindakan kedokteran' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">4</td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Indikasi tindakan</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <ul class="list-unstyled">
                <li>(....) Gaduh Gelisah</li>
                <li>(....) Depresi Berat</li>
                <li>(....) Katatonik</li>
                <li>(....) Resisten terhadap terapi obat-obatan antipsikotik</li>
            </ul>
        </td>
        <td class=" position-relative text-center vertical-align-middle" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input custom-checkbox" type="checkbox" name="indikasi_tindakan" id="checkbox-input-caqqwd" value="Indikasi tindakan" @php $hasil_data_temp=$hasil_data->indikasi_tindakan ?? '' @endphp @if($hasil_data_temp == 'Indikasi tindakan' ) checked @endif > <label class="form-check-label" for="checkbox-input-caqqwd"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->indikasi_tindakan ?? '' @endphp @if($hasil_data_temp == 'Indikasi tindakan' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">5</td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Tata cara</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Sesuai dengan Standar Operasional Prosedur</span>
        </td>
        <td class=" position-relative text-center vertical-align-middle" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input custom-checkbox" type="checkbox" name="tata_cara" id="checkbox-input-fsf12" value="Tata cara" @php $hasil_data_temp=$hasil_data->tata_cara ?? '' @endphp @if($hasil_data_temp == 'Tata cara' ) checked @endif > <label class="form-check-label" for="checkbox-input-fsf12"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->tata_cara ?? '' @endphp @if($hasil_data_temp == 'Tata cara' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">6</td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Tujuan</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Membantu memberikan terapi non farmakologi untuk pasien</span>
        </td>
        <td class=" position-relative text-center vertical-align-middle" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input custom-checkbox" type="checkbox" name="tujuan" id="checkbox-input-vsfq" value="Tujuan" @php $hasil_data_temp=$hasil_data->tujuan ?? '' @endphp @if($hasil_data_temp == 'Tujuan' ) checked @endif > <label class="form-check-label" for="checkbox-input-vsfq"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->tujuan ?? '' @endphp @if($hasil_data_temp == 'Tujuan' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">7</td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Resiko</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <ol>
                <li>Masa perawatan pasien akan lebih panjang karena obat-obatan yang diberikan tidak efektif</li>
                <li>Resiko terburuk adalah kematian akibat henti jantung</li>
                <li>Resiko lain adalah akibat tidak diperhatikan kontraindikasi:</li>
                <ol type="a">
                    <li>Abortus bila pasien hamil</li>
                    <li>Memperparah hernia</li>
                    <li>Patah Tulang</li>
                    <li>Bagi Pasien yang memakai implan pada tulang atau alat bantu jantung, ECT berpotensi merusak alat tersebut</li>
                </ol>
            </ol>
        </td>
        <td class=" position-relative text-center vertical-align-middle" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input custom-checkbox" type="checkbox" name="resiko" id="checkbox-input-safqw" value="Resiko" @php $hasil_data_temp=$hasil_data->resiko ?? '' @endphp @if($hasil_data_temp == 'Resiko' ) checked @endif > <label class="form-check-label" for="checkbox-input-safqw"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->resiko ?? '' @endphp @if($hasil_data_temp == 'Resiko' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">8</td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Prognosis</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Prognosis pasien yang dilakukan ECT pada umumnya baik</span>
        </td>
        <td class=" position-relative text-center vertical-align-middle" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input custom-checkbox" type="checkbox" name="prognosis" id="checkbox-input-scadawsc" value="Prognosis" @php $hasil_data_temp=$hasil_data->prognosis ?? '' @endphp @if($hasil_data_temp == 'Prognosis' ) checked @endif > <label class="form-check-label" for="checkbox-input-scadawsc"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->prognosis ?? '' @endphp @if($hasil_data_temp == 'Prognosis' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">9</td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Alternatif & Resiko</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Pada indikasi pasien gaduh gelisah, depresi berat, dan katatonik ada alternatif lain dengan obat-obatan. Sedangkan pada pasien yang resisten dengan terapi obat tidak ada alternatif lain.</span>
        </td>
        <td class=" position-relative text-center vertical-align-middle" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input custom-checkbox" type="checkbox" name="alternatif_dan_resiko" id="checkbox-input-casfsa" value="Alternatif & Resiko" @php $hasil_data_temp=$hasil_data->alternatif_dan_resiko ?? '' @endphp @if($hasil_data_temp == 'Alternatif & Resiko' ) checked @endif > <label class="form-check-label" for="checkbox-input-casfsa"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->alternatif_dan_resiko ?? '' @endphp @if($hasil_data_temp == 'Alternatif & Resiko' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative text-center" colspan="1" rowspan="1">10</td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Lain-lain</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <div class="form-group medify-form-genv4-input-container">
                <input style="width: 100%;" type="text" class="form-control" name="lain_lain_ket" value="{{$hasil_data->{'lain_lain_ket'} ?? '' ?? ''}}">
            </div>
            <span class="form-group medify-form-genv4-view-container"> {{$hasil_data->{'lain_lain_ket'} ?? '' ?? ''}}</span>
        </td>
        <td class=" position-relative text-center vertical-align-middle" colspan="1" rowspan="1">
            <div class="form-check form-check-inline medify-form-genv4-input-container d-inline-block">
                <input class="form-check-input custom-checkbox" type="checkbox" name="lain_lain" id="checkbox-input-asdsad" value="Lain-lain" @php $hasil_data_temp=$hasil_data->lain_lain ?? '' @endphp @if($hasil_data_temp == 'Lain-lain' ) checked @endif > <label class="form-check-label" for="checkbox-input-asdsad"> </label>
            </div>
            <span class="medify-form-genv4-view-container"> @php $hasil_data_temp = $hasil_data->lain_lain ?? '' @endphp @if($hasil_data_temp == 'Lain-lain' ) <span style='font-family:calibri'>&#x2714;</span> @else <span style='font-family:calibri'></span> @endif </span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1">
            <span>Dengan ini menyatakan bahwa saya telah menerangkan hal-hal diatas secara benar dan jujur dan memberikan kesempatan untuk bertanya dan/atau berdiskusi.</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <div>Tanda tangan</div>
            @if ((Auth::user()->ttd ?? null) != null)
                @if (file_exists((((Auth::user()->ttd ?? '') ?? ''))))
                <div>
                    <img style="max-width: 100%;width:140px;height:80px;object-fit:contain;" src="{{ url('') }}/{{ Auth::user()->ttd }}" alt="Tanda tangan">
                </div>
                @else
                <br><br><br>
                @endif
                <br>
                <div>( <span>{{ Auth::user()->name ?? '' }}</span> )</div>
            @else
            <br><br><br><br>
            <span>(...............................)</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="3" rowspan="1">
            <span>Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana diatas dan telah memahaminya.</span>
        </td>
        <td class=" position-relative text-center" colspan="1" rowspan="1">
            <span>Tanda tangan</span>
            <br><br><br><br>
            <span>(...............................)</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="4" rowspan="1">
            <i style="font-weight: 500;">* Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat</i>
        </td>
    </tr>
</table>
<div style="margin: 20px 0;" class="space"></div>
<pagebreak />

@includeIf("kasus.asesmen.$slug.form-persetujuan")
@includeIf("kasus.asesmen.$slug.form-penolakan")