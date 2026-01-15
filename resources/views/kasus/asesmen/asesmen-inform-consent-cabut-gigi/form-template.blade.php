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
        font-size: 8.5pt;
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
    input.custom-control {
        display: inline-block; vertical-align: middle;
        font-family: DejaVuSansCondensed; /* Use a font that supports Unicode symbols */
        font-size: 14px;
    }
    .border {
        border-color: #000!important;
    }
    .filled {
        background-color: gray;
    }
    .input.custom-control:checked {
        content: "✔";
    }
    .cust-checkbox {
        font-family: 'Arial Unicode MS', sans-serif;
        font-size: 12px;
    }
    .checked-checkbox::before {
        content: '✔'; 
    }
    .unchecked-checkbox::before {
        content: '☐'; 
    }
    .bbtm {
        border-bottom: 1px solid black;
    }
    .btop {
        border-top: 1px solid black;
    }
    .bright {
        border-right: 1px solid black;
    }
    .bleft {
        border-left: 1px solid black;
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
        <div class="border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RM. 05 K&nbsp;&nbsp;&nbsp;</div>
        <div class="border-left border-right border-bottom">
            &nbsp;&nbsp;&nbsp;<span>Halaman&nbsp;{PAGENO}/{nb}&nbsp;&nbsp;</span>
        </div>
    </div>
</htmlpageheader>
@endif
<small class="element-info-id">Table :</small>
<table style="width:100%">
<tr>
	<td class=" position-relative" colspan="2" rowspan="2">
		<img src="{{url('')}}/{{ config('app.kop_sm') }}" width="300" height="100">
	</td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
</tr>
</table>
<small class="element-info-id">Table :</small>
<table style="width:100%">
<tr>
	<td class=" position-relative" colspan="2" rowspan="1">
		<h6>PEMBERIAN INFORMASI PENCABUTAN GIGI</h6>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Dokter Pelaksana Tindakan</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<select name="dokter_pelaksana_tindakan" class="form-control" id="dokter_pelaksana_tindakan">
				@foreach($dokter as $val)
					<option value="{{ $val->name }}" @if(($hasil_data->dokter_pelaksana_tindakan ?? '') == $val->name) selected @endif>{{ $val->name }}</option>
				@endforeach
			</select>
		<div class="form-group medify-form-genv4-view-container">
			 {{$hasil_data->dokter_pelaksana_tindakan  ?? ''}}
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Pemberi Informasi</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<select name="pemberi_informasi" class="form-control">
				@foreach($user as $val)
				<option value="{{ $val->name }}" @if(($hasil_data->pemberi_informasi ?? '') == $val->name) selected @endif>{{ $val->name }}</option>
				@endforeach
			</select>
        </div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->pemberi_informasi ?? '' ?? ''}}</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Penerima Informasi / pemberi persetujuan *)</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="penerima_informasi" value="{{$hasil_data->penerima_informasi ??  ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->penerima_informasi ?? ''}}</div>
	</td>
</tr>
</table>
<small class="element-info-id">Table :</small>
<table style="width:100%">
<tr>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>JENIS INFORMASI</span>
	</td>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>ISI INFORMASI</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>TANDAI (u221a)</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>1</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Diagnosis</span>
	</td>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Absess / periodontitis / Impaksi / persistensi / Pulpitis / resobsi fisiologis / resobsi patologis</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_diagnosis" id="checkbox_diagnosis-input-156607" value="1" @php $hasil_data_temp =$hasil_data->checkbox_diagnosis ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_diagnosis-input-156607"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_diagnosis ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="7">
		<span>2</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="7">
		<span>Dasar Diagnosis</span>
	</td>
	<td class=" position-relative" colspan="1">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_abses" id="checkbox_abses-input-156609" value="1" @php $hasil_data_temp =$hasil_data->checkbox_abses ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_abses-input-156609"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_abses ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Absess : pembengkakan pada jaringan lunak</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="7">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_dsr_diagnosis" id="checkbox_dsr_diagnosis-input-156609" value="1" @php $hasil_data_temp =$hasil_data->checkbox_dsr_diagnosis ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_dsr_diagnosis-input-156609"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_dsr_diagnosis ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" >
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_periodontis" id="checkbox_periodontis-input-156609" value="1" @php $hasil_data_temp =$hasil_data->checkbox_periodontis ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_periodontis-input-156609"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_periodontis ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Periodontitis: peradangan pada jaringan penyangga gigi</span>
	</td>
	
</tr>
<tr>
	<td class=" position-relative" colspan="1" >
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_impaksi" id="checkbox_impaksi-input-156609" value="1" @php $hasil_data_temp =$hasil_data->checkbox_impaksi ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_impaksi-input-156609"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_impaksi ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Impaksi : gigi yang mengalami kesukaran erupsi yg disebabkan oleh jaringan lunak / keras</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" >
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_persistensi" id="checkbox_persistensi-input-156609" value="1" @php $hasil_data_temp =$hasil_data->checkbox_persistensi ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_persistensi-input-156609"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_persistensi ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>persistensi : kondisi dimana Gigi sulung belum tanggal akan tetapi gigi permanen sudah tumbuh</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" >
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_pulpitis" id="checkbox_pulpitis-input-156609" value="1" @php $hasil_data_temp =$hasil_data->checkbox_pulpitis ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_pulpitis-input-156609"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_pulpitis ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Pulpitis : peradangan pada pulpa</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" >
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_resobsi_fisiologis" id="checkbox_resobsi_fisiologis-input-156609" value="1" @php $hasil_data_temp =$hasil_data->checkbox_resobsi_fisiologis ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_resobsi_fisiologis-input-156609"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_resobsi_fisiologis ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>resobsi fisiologis : kegoyangan pada gigi sulung akibat gigi permanen tumbuh</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" >
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_resobsi_patologis" id="checkbox_resobsi_patologis-input-156609" value="1" @php $hasil_data_temp =$hasil_data->checkbox_resobsi_patologis ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_resobsi_patologis-input-156609"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_resobsi_patologis ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>resobsi patologis : kegoyangan pada gigi permanen akibat kerusakan pada jaringan periodontal</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>3</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Tindakan kedokteran</span>
	</td>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Ekstraksi</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_tindakan_kedokteran" id="checkbox_tindakan_kedokteran-input-156617" value="1" @php $hasil_data_temp =$hasil_data->checkbox_tindakan_kedokteran ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_tindakan_kedokteran-input-156617"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_tindakan_kedokteran ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>4</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Indikasi tindakan</span>
	</td>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Kondisi kronis, tidak ada tanda keradangan</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_indikasi_tindakan" id="checkbox_indikasi_tindakan-input-156619" value="1" @php $hasil_data_temp =$hasil_data->checkbox_indikasi_tindakan ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_indikasi_tindakan-input-156619"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_indikasi_tindakan ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="7">
		<span>5</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="7">
		<span>Tata cara</span>
	</td>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Antiseptik intra oral</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="7">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_tatacara" id="checkbox_tatacara-input-156621" value="1" @php $hasil_data_temp =$hasil_data->checkbox_tatacara ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_tatacara-input-156621"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_tatacara ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Anastesi infiltrasi & blok / topical</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Pengeluaran gigi</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Pembersihan & penutupan luka</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Pemberian obat (antibiotik, analgesik, & anti inflamasi jika diperlukan)</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Instruksi pasca pencabutan</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Kontrol jika diperlukan</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>6</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Tujuan</span>
	</td>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Menghilangkan fokal Infeksi & rasa sakit</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_tujuan" id="checkbox_tujuan-input-156622" value="1" @php $hasil_data_temp =$hasil_data->checkbox_tujuan ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_tujuan-input-156622"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_tujuan ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="5">
		<span>7</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="5">
		<span>Resiko</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>1.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Pembengkakan pada jaringan rongga mulut.</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="5">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_resiko" id="checkbox_resiko-input-156625" value="1" @php $hasil_data_temp =$hasil_data->checkbox_resiko ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_resiko-input-156625"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_resiko ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>2.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Sakit pada gusi.</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>3.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Sakit/sulit menelan makanan</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>4.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Bau mulut</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>5.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Infeksi pada gigi menjadi meluas dan menjadi sarana masuknya kuman penyakit yang dapat menyebabkan infeksi pada paru-paru, jantung, otak dan dapat menyebabkan kematian</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="11">
		<span>8</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="11">
		<span>Komplikasi</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>1.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Rasa tebal pada lidah akibat terlukanya :</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="11">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_komplikasi" id="checkbox_komplikasi-input-156627" value="1" @php $hasil_data_temp =$hasil_data->checkbox_komplikasi ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_komplikasi-input-156627"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_komplikasi ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>a.</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Saraf lidah : rasa tebal lidah, menurunnya rasa kecap pada lidah dan menurunnya produksi air liur sehingga mulut menjadi kering.</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>b.</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Saraf pada rahang bawah: rasa tebal pada bibir, dagu dan turunnya sensitifitas gigi-gigi bawah.</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>2.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Pembengkakan.</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>3.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Rasa sakit</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>4.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Perdarahan</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>5.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Kematian pada gigi sebelahnya/tambalan gigi sebelahnya pecah/lepas</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>6.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Terpaksa ditinggalkan sebagian kecil sisa akar pada rahang karena untuk mengambilnya memerlukan tindakan bedah mulut yang lebih besar atau akan menimbulkan komplikasi yang lebih serius.</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>7.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Terjadinya luka atau memar atau luka pada kulit sudut mulut oleh karena tarikan alat atau abrasi bur pada saat tindakan berlangsung.</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>8.</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<span>Alergi lokal anestesi/antibiotik</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Frekuensi dari kejadian komplikasi di atas adalah berbeda-beda kejadiannya, tetapi sangat jarang.</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>9</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Prognosis</span>
	</td>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Baik</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_prognosis" id="checkbox_prognosis-input-156628" value="1" @php $hasil_data_temp =$hasil_data->checkbox_prognosis ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_prognosis-input-156628"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_prognosis ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>10</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Alternatif & Resiko</span>
	</td>
	<td class=" position-relative" colspan="3" rowspan="1">
		<span>Protesa gigi, perawatan gigi, kekambuhan ulang</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_alternatif" id="checkbox_alternatif-input-156630" value="1" @php $hasil_data_temp =$hasil_data->checkbox_alternatif ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_alternatif-input-156630"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_alternatif ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>11</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Lain-lain</span>
	</td>
	<td class=" position-relative" colspan="3" rowspan="1">
		<div class="form-check medify-form-genv4-input-container">
        <input type="text" class="form-control" value="{{ $hasil_data->lain_lain_teks ?? '' }}" name="lain_lain_teks">
        </div>
        <div class="medify-form-genv4-view-container">
            {{ $hasil_data->lain_lain_teks ?? ''}}
        </div>
    </td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-check medify-form-genv4-input-container">
			<input class="form-check-input" type="checkbox" name="checkbox_lainlain27" id="checkbox_lainlain27-input-156632" value="1" @php $hasil_data_temp =$hasil_data->checkbox_lainlain27 ?? '' @endphp @if(!empty($hasil_data_temp)) checked @endif > <label class="form-check-label" for="checkbox_lainlain27-input-156632"></label>
		</div>
		<div class="medify-form-genv4-view-container">
			 @php $hasil_data_temp = $hasil_data->checkbox_lainlain27 ?? '' @endphp @if(!empty($hasil_data_temp)) <span style='font-family:calibri'>&#x2611;</span> @else <span style='font-family:calibri'>&#x2B1C;</span> @endif
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
</tr>
</table>
<small class="element-info-id">Table :</small>
<table style="width:100%">
<tr>
	<td class=" position-relative" colspan="1" rowspan="3">
		<span>Dengan ini menyatakan bahwa saya telah menerangkan hal-hal diatas secara benar dan jujur dan memberikan kesempatan untuk bertanya dan/atau berdiskusi.</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Tanda tangan</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<select name="ttd_nama_pemberi_informasi" class="form-control">
				@foreach($user as $val)
				<option value="{{ $val->name }}" @if(($hasil_data->ttd_nama_pemberi_informasi ?? '') == $val->name) selected @endif>{{ $val->name }}</option>
				@endforeach
			</select>
        </div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->ttd_nama_pemberi_informasi ?? '' ?? ''}}</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="3">
		<span>Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana diatas dan telah memahaminya.</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Tanda tangan</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="ttd_nama_penerima_informasi" value ="{{$hasil_data->ttd_nama_penerima_informasi ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">
			 {{$hasil_data->ttd_nama_penerima_informasi ?? '' ?? ''}}
		</div>
	</td>
</tr>
</table>
<small class="element-info-id">Table :</small>
<table style="width:100%">
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>* Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>PERSETUJUAN TINDAKAN KEDOKTERAN</span>
	</td>
</tr>
</table>
<small class="element-info-id">Table :</small>
<table style="width:100%">
<tr>
	<td class=" position-relative" colspan="6" rowspan="1">
		<span>Yang bertanda tangan dibawah ini :</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Nama</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>:</span>
	</td>
	<td class=" position-relative" colspan="4" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="pemberi_persetujuan_nama" value ="{{$hasil_data->pemberi_persetujuan_nama ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">
			 {{$hasil_data->pemberi_persetujuan_nama ?? '' ?? ''}}
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Alamat</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>:</span>
	</td>
	<td class=" position-relative" colspan="4" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="pemberi_persetujuan_alamat" value ="{{$hasil_data->pemberi_persetujuan_alamat ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">
			 {{$hasil_data->pemberi_persetujuan_alamat ?? ''}}
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>No. Telepon</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>:</span>
	</td>
	<td class=" position-relative" colspan="4" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="pemberi_persetujuan_telp" value="{{$hasil_data->pemberi_persetujuan_telp ?? ''}}" >
        </div>
		<div class="form-group medify-form-genv4-view-container">
			 {{$hasil_data->pemberi_persetujuan_telp ?? '' ?? ''}}
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Hubungan dengan Pasien</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>:</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<select class="form-control " name="pemberi_persetujuan_hubungan">
				 @php $hasil_data_temp = $hasil_data->pemberi_persetujuan_hubungan ?? '' @endphp
				<option value="Diri Sendiri" @if($hasil_data_temp == 'diri sendiri' ) selected @endif>Diri Sendiri</option>
				<option value="Suami" @if($hasil_data_temp == 'suami' ) selected @endif>Suami</option>
				<option value="Istri" @if($hasil_data_temp == 'istri' ) selected @endif>Istri</option>
				<option value="Ayah" @if($hasil_data_temp == 'ayah' ) selected @endif>Ayah</option>
				<option value="Ibu" @if($hasil_data_temp == 'ibu' ) selected @endif>Ibu</option>
				<option value="Anak" @if($hasil_data_temp == 'anak' ) selected @endif>Anak</option>
				<option value="Lain" @if($hasil_data_temp == 'lain' ) selected @endif>Lain</option>
			</select>
		</div>
		<span class="medify-form-genv4-view-container">{{$hasil_data->pemberi_persetujuan_hubungan ?? ''}}</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="pemberi_persetujuan_hubungan" value ="{{$hasil_data->pemberi_persetujuan_hubungan ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">
			 {{$hasil_data->pemberi_persetujuan_hubungan ?? ''}}
		</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="6" rowspan="1">
		<span>Dengan ini menyatakan persetujuan untuk dilakukannya tindakan terhadap :</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>No. RM</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>:</span>
	</td>
	<td class=" position-relative" colspan="4" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="pasien_no_rm" value ="{{$hasil_data->pasien_no_rm  ?? $kasus->pasien->no_rm  ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->pasien_no_rm ?? $kasus->pasien->no_rm ??''}}</div>
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
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="pasien_nama" value ="{{$hasil_data->pasien_nama ?? $kasus->pasien->name ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->pasien_nama ?? $pasien->name ?? ''}}</div>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Jenis Kelamin</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>:</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<select class="form-control " name="pasien_jenis_kelamin" style="width:100%">
				 @php 
				 	$jk = $kasus->pasien->gender;
					$hasil_data_temp = $hasil_data->pasien_jenis_kelamin ?? $jk ?? '';
				@endphp
				<option value="Laki laki" @if($hasil_data_temp == 'laki laki' ) selected @endif>Laki laki</option>
				<option value="Perempuan" @if($hasil_data_temp == 'perempuan' ) selected @endif>Perempuan</option>
			</select>
		</div>
		<span class="medify-form-genv4-view-container">{{$hasil_data->pasien_jenis_kelamin ?? ''}}</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Tgl Lahir/Umur</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>:</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="date" class="form-control" name="pasien_tanggal_lahir" value ="{{$hasil_data->pasien_tanggal_lahir ?? $kasus->pasien->date_of_birth ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->pasien_tanggal_lahir ?? $kasus->pasien->date_of_birth ?? ''}}</div>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>/</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="pasien_umur" value ="{{$hasil_data->pasien_umur ?? $kasus->pasien->age ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->pasien_umur ?? $kasus->pasien->age ?? ''}}</div>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Tahun</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Ruangan</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>:</span>
	</td>
	<td class=" position-relative" colspan="4" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<select name="pasien_ruangan" class="form-control">
				@foreach($lokasi as $val)
				<option value="{{ $val->nama }}"  @if(($hasil_data->pasien_ruangan ?? '') == $val->nama) selected @endif>{{ $val->nama }}</option>
				@endforeach
			</select>
			</div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->pasien_ruangan ?? '' ?? ''}}</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="6" rowspan="1">
		<span>Saya memahami perlunya dan manfaat tindakan tersebut sebagaimana telah dijelaskan seperti diatas kepada saya, termasuk resiko dan komplikasi yang mungkin timbul apabila tindakan tersebut tidak dilakukan.</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="6" rowspan="1">
		<span>Saya bertanggung jawab secara penuh atas segala akibat yang mungkin timbul sebagai akibat tidak dilakukannya tindakan kedokteran tersebut.</span>
	</td>
</tr>
</table>
<small class="element-info-id">Table :</small>
<table style="width:100%">
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Surabaya,</span>
	</td>
	<td class=" position-relative" colspan="2" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="date" class="form-control" name="ttd_tanggal" value ="{{$hasil_data->ttd_tanggal ?? '' ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->ttd_tanggal ?? ''}}</div>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Yang menyatakan persetujuan</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Dokter</span>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<span>Saksi keluarga/petugas</span>
	</td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
	<td class=" position-relative" colspan="1" rowspan="1"></td>
</tr>
<tr>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="ttd_nama_persetujuan" value ="{{$hasil_data->ttd_nama_persetujuan ?? '' ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->ttd_nama_persetujuan ?? '' ?? ''}}</div>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<select name="ttd_nama_dokter" class="form-control" id="ttd_nama_dokter">
				@foreach($dokter as $val)
					<option value="{{ $val->name }}" @if(($hasil_data->ttd_nama_dokter ?? '') == $val->name) selected @endif>{{ $val->name }}</option>
				@endforeach
			</select>
			</div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->ttd_nama_dokter ?? '' ?? ''}}</div>
	</td>
	<td class=" position-relative" colspan="1" rowspan="1">
		<div class="form-group medify-form-genv4-input-container">
			<input type="text" class="form-control" name="ttd_nama_saksi" value ="{{$hasil_data->ttd_nama_saksi ?? '' ?? ''}}" ></div>
		<div class="form-group medify-form-genv4-view-container">{{$hasil_data->ttd_nama_saksi ?? '' ?? ''}}</div>
	</td>
</tr>
</table>