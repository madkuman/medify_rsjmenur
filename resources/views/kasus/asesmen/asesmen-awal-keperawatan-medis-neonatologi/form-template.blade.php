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
<table style="width:100%">
    <tr>
        <td width="70%" class=" position-relative" colspan="1" rowspan="1">
            <img style="max-width: 100%;object-fit:contain;" src="{{url('')}}/{{ config('app.kop_lg') }}" height="90">
        </td>
        <td width="30%" class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
</table>
<br>
<table style="width:100%;" class="">
   <tr>
      <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
        <h5>ASESMEN AWAL KEPERAWATAN NEONATOLOGI (USIA 0 - 28 HARI)</h5>
      </td>
   </tr>
   <tr>
    <td class=" position-relative text-center border-top border-bottom" colspan="1" rowspan="1">
      <h6 style="font-style:italic;">NURSING INITIAL ASSESMENT</h6>
    </td>
 </tr>
</table>
<br>

<table class="" style="width:100%; border:1px solid black;">
<tr style="border-bottom: 1px solid black;">
    <td colspan="9" style="background-color:green;">Diisi oleh keperawatan</td>
</tr>
<tr>
    <td class="bbtm">Ruangan :</td>
    <td colspan="2" class="bbtm">
        <div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="ruangan" value="{{ $hasil_data->ruangan ?? '' }}">
        
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->ruangan ?? ''}}</span>
    </td>
    <td class="bbtm">Tanggal :</td>
    <td colspan="2" class="bbtm">
        <div class="medify-form-genv4-input-container"><input type="date" class="form-control" name="tanggal" value="{{ $hasil_data->tanggal ?? '' }}">
        
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->tanggal ?? ''}}</span>
    </td>
    <td class="bbtm">Jam :</td>
    <td colspan="2" class="bbtm">
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control timid" name="jam" value="{{ $hasil_data->jam ?? '' }}">
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->jam ?? ''}}</span>
    </td>
</tr>
<tr>
    <td>Nama Ibu :</td>
    <td colspan="2">
    <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control" name="nama_ibu" value="{{ $hasil_data->nama_ibu ?? '' }}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->nama_ibu ?? ''}}</span></td>
    <td>Umur/Pendidikan/Pekerjaan :</td>
    <td colspan="5">
    <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control" name="umur_ibu" value="{{ $hasil_data->umur_ibu ?? '' }}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->umur_ibu ?? ''}}</span></td>
    </div>
</tr>
<tr>
    <td class="bbtm"> Nama Ayah :</td>
    <td colspan="2" class="bbtm">
    <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control" name="nama_ayah" value="{{ $hasil_data->nama_ayah ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->nama_ayah ?? ''}}</span></td>
    <td class="bbtm">Umur/Pendidikan/Pekerjaan :</td>
    <td colspan="5" class="bbtm">
        <div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="umur_ayah" value="{{ $hasil_data->umur_ayah ?? '' }}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->umur_ayah ?? ''}}</span></td>
</tr>
<tr>
    <td class="bbtm">Riwayat Alergi :</td>
    <td colspan="8" class="bbtm"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="alergi_terhadap" value="{{ $hasil_data->alergi_terhadap ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->alergi_terhadap ?? ''}}</span></td>
</tr>
<tr>
    <td colspan="3" class="text-center bbtm bright">ANAMNESIS</td>
    <td colspan="6" class="text-center bbtm">PEMERIKSAAN FISIK</td>
</tr>
<tr>
    <td colspan="3" class="bbtm bright">
        RIWAYAT BAYI
    </td>
    <td >
        Diperiksa tanggal
    </td>
    <td>:</td>
    <td>
        <div class="medify-form-genv4-input-container">
        <input type="date" class="form-control" name="tanggal_pemeriksaan_fisik">
        </div>
        <span class="medify-form-genv4-view-container">
            {{ $hasil_data->tanggal_pemeriksaan_fisik }}
        </span>
    </td>
    <td>Jam</td>
    <td colspan="2">
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control timid" name="jam_bayi" value="{{ $hasil_data->jam_bayi ?? '' }}">
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->jam_bayi ?? ''}}</span>
    </td>
</tr>
<tr>
    <td>Rujukan</td>
    <td>:</td>
    <td class="bright">
    <div class="medify-form-genv4-input-container">
        <input type="checkbox" class="custom-control" name="rujukan_ya" value="Ya" @if(!empty($hasil_data->rujukan_ya)) checked @endif >Ya 
        <input type="checkbox" class="custom-control" name="rujukan_tidak" value="Tidak" @if(!empty($hasil_data->rujukan_tidak)) checked @endif >Tidak 
    </div>
    <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rujukan_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rujukan_ya ?? ''}}@endif</span>
    <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rujukan_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rujukan_tidak ?? ''}}@endif</span>
    </td>
    <td >
        Berat badan
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control" name="bb_pemeriksaan_fisik" value="{{ $hasil_data->bb_pemeriksaan_fisik ?? '' }}"> gram
        </div>
        <span class="medify-form-genv4-view-container">
            {{ $hasil_data->bb_pemeriksaan_fisik ?? '' }} gram
        </span>
    </td>
</tr>
<tr>
    <td>Asal Rujukan</td>
    <td>:</td>
    <td class="bright">
    <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control" name="asal_rujukan" value="{{ $hasil_data->asal_rujukan ?? ''}}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->asal_rujukan ?? ''}}</span>
    </td>
    <td >
        Panjang badan
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control" name="pb_pemeriksaan_fisik" value="{{ $hasil_data->pb_pemeriksaan_fisik ?? '' }}"> cm
        </div>
        <span class="medify-form-genv4-view-container">
            {{ $hasil_data->pb_pemeriksaan_fisik ?? ''}} cm
        </span>
    </td>
</tr>
<tr>
    <td>Dx. Rujukan</td>
    <td>:</td>
    <td class="bright">
    <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control" name="dx_rujukan" value="{{ $hasil_data->dx_rujukan ?? ''}}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->dx_rujukan ?? ''}}</span>
    </td>
    <td class="bbtm">
        Lingkar Kepala
    </td>
    <td class="bbtm">:</td>
    <td colspan="4" class="bbtm">
        <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control" name="lingkar_kepala_fisik" value="{{ $hasil_data->lingkar_kepala_fisik ?? '' }}"> cm
        </div>
        <span class="medify-form-genv4-view-container">
            {{ $hasil_data->lingkar_kepala_fisik ?? ''}} cm
        </span>
    </td>
</tr>
<tr>
    <td>Tanggal/Jam lahir</td>
    <td>:</td>
    <td class="bright">
    <div class="medify-form-genv4-input-container">
        <input type="date" class="form-control" name="tanggal_riwayat_bayi" value="{{ $hasil_data->tanggal_riwayat_bayi ?? ''}}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->tanggal_riwayat_bayi ?? ''}}</span>
    Jam :
    <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control timid" name="jam_lahir" value="{{ $hasil_data->jam_lahir ?? '' }}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->jam_lahir ?? ''}}</span>
    </td>
    <td colspan="6" class="text-center bbtm">
        KULIT
    </td>
</tr>
<tr>
    <td>Cara persalinan</td>
    <td>:</td>
    <td class="bright">
    <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control" name="cara_persalinan" value="{{ $hasil_data->cara_persalinan ?? ''}}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->cara_persalinan ?? ''}}</span>
    </td>
    <td >
        a. Warna kulit
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="kulit_pink" value="Pink" @if(!empty($hasil_data->kulit_pink)) checked @endif > Pink 
            <input type="checkbox" class="custom-control" name="kulit_pucat" value="Pucat" @if(!empty($hasil_data->kulit_pucat)) checked @endif >Pucat 
            <input type="checkbox" class="custom-control" name="kulit_kuning" value="Kuning" @if(!empty($hasil_data->kulit_kuning)) checked @endif >Kuning 
            <input type="checkbox" class="custom-control" name="kulit_cutis" value="Cuti marmorata" @if(!empty($hasil_data->kulit_cutis)) checked @endif >Cuti marmorata 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_pink))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_pink ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_pucat))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_pucat ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_kuning))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_kuning ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_cutis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_cutis ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td>Apgar Score</td>
    <td>:</td>
    <td class="bright">
    <div class="medify-form-genv4-input-container">
        1' <input type="text" class="form-control" name="apgar1" value="{{ $hasil_data->apgar1 ?? ''}}">
    </div>
     <span class="medify-form-genv4-view-container">1' {{ $hasil_data->apgar1 ?? ''}}</span>
     <div class="medify-form-genv4-input-container">
        5' <input type="text" class="form-control" name="apgar5" value="{{ $hasil_data->apgar5 ?? ''}}">
    </div>
     <span class="medify-form-genv4-view-container">5' {{ $hasil_data->apgar5 ?? ''}}</span>
    </td>
    <td >
        b. Sianosis
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="sianosis_sentral" value="Sentral" @if(!empty($hasil_data->sianosis_sentral)) checked @endif > Sentral 
            <input type="checkbox" class="custom-control" name="sianosis_perifer" value="Perifer" @if(!empty($hasil_data->sianosis_perifer)) checked @endif >Perifer 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sianosis_sentral))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sianosis_sentral ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sianosis_perifer))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sianosis_perifer ?? ''}}@endif</span>
        
    </td>
</tr>
<tr>
    <td>Usia gestasi</td>
    <td>:</td>
    <td class="bright">
    <div class="medify-form-genv4-input-container">
       <input type="text" class="form-control" name="usia_gestasi" value="{{ $hasil_data->usia_gestasi ?? ''}}"> (Ballard)
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->usia_gestasi ?? ''}}</span>
    
    </td>
    <td >
        c. Kemerahan (RASH)
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="kemerahan_ada" value="Ada" @if(!empty($hasil_data->kemerahan_ada)) checked @endif > Ada 
            <input type="checkbox" class="custom-control" name="kemerahan_tidak" value="Tidak" @if(!empty($hasil_data->kemerahan_tidak)) checked @endif >Tidak 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kemerahan_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kemerahan_ada ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kemerahan_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kemerahan_tidak ?? ''}}@endif</span>
        
    </td>
</tr>
<tr>
    <td>Berat badan lahir</td>
    <td>:</td>
    <td class="bright">
    <div class="medify-form-genv4-input-container">
       <input type="text" class="form-control" name="bb_lahir" value="{{ $hasil_data->bb_lahir ?? ''}}"> gram
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->bb_lahir ?? ''}}</span>
    
    </td>
    <td >
        d. Tanda Lahir
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="tnd_lahir_ada" value="Ada" @if(!empty($hasil_data->tnd_lahir_ada)) checked @endif > Ada 
            <input type="text" class="form-control" name="tanda_ketika_ada" value="{{ $hasil_data->tanda_ketika_ada ?? ''}}">
            <input type="checkbox" class="custom-control" name="tnd_lahir_tidak" value="Tidak" @if(!empty($hasil_data->tnd_lahir_tidak)) checked @endif >Tidak 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tnd_lahir_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tnd_lahir_ada ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->tanda_ketika_ada ?? ''}}</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tnd_lahir_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tnd_lahir_tidak ?? ''}}@endif</span>
        
    </td>
</tr>
<tr>
    <td>Panjang badan lahir</td>
    <td>:</td>
    <td class="bright">
    <div class="medify-form-genv4-input-container">
       <input type="text" class="form-control" name="pb_lahir" value="{{ $hasil_data->pb_lahir ?? ''}}"> cm
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->pb_lahir ?? ''}}</span>
    
    </td>
    <td >
        e. Turgor Kulit
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="turgor_elastis" value="Elastis" @if(!empty($hasil_data->turgor_elastis)) checked @endif > Elastis 
            <input type="checkbox" class="custom-control" name="turgor_tidakelastis" value="Tidak elastis" @if(!empty($hasil_data->turgor_tidakelastis)) checked @endif >Tidak elastis 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->turgor_elastis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->turgor_elastis ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->turgor_tidakelastis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->turgor_tidakelastis ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td>Lingkar kepala lahir</td>
    <td>:</td>
    <td class="bright">
    <div class="medify-form-genv4-input-container">
       <input type="text" class="form-control" name="lk_lahir" value="{{ $hasil_data->lk_lahir ?? ''}}"> cm
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->lk_lahir ?? ''}}</span>
    
    </td>
    <td >
        f. Suhu Kulit
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control" name="suhu_kulit" value="{{ $hasil_data->suhu_kulit ?? ''}}"> C
         </div>
         <span class="medify-form-genv4-view-container">{{ $hasil_data->suhu_kulit ?? ''}} C</span>
    </td>
</tr>
<tr>
    <td colspan="3" rowspan="3" class="bright bbtm">Alasan masuk RS (keluhan utama saat masuk RS):
    <div class="medify-form-genv4-input-container">
       <input type="text" class="form-control" name="keluhan_utama_masuk_rs" value="{{ $hasil_data->keluhan_utama_masuk_rs ?? ''}}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->keluhan_utama_masuk_rs ?? ''}}</span>
    </td>
    <td colspan="6" class="text-center btop bbtm">
        KEPALA / LEHER
    </td>
</tr>
<tr>
    <td >
        a. Fontanela anterior
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="fontanela_lunak" value="Lunak" @if(!empty($hasil_data->fontanela_lunak)) checked @endif > Lunak 
            <input type="checkbox" class="custom-control" name="fontanela_tegas" value="Tegas" @if(!empty($hasil_data->fontanela_tegas)) checked @endif >Tegas 
            <input type="checkbox" class="custom-control" name="fontanela_datar" value="Datar" @if(!empty($hasil_data->fontanela_datar)) checked @endif >Datar 
            <input type="checkbox" class="custom-control" name="fontanela_menonjol" value="Menonjol" @if(!empty($hasil_data->fontanela_menonjol)) checked @endif >Menonjol
            <input type="checkbox" class="custom-control" name="fontanela_cekung" value="Cekung" @if(!empty($hasil_data->fontanela_cekung)) checked @endif >Cekung
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->fontanela_lunak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->fontanela_lunak ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->fontanela_tegas))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->fontanela_tegas ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->fontanela_datar))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->fontanela_datar ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->fontanela_menonjol))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->fontanela_menonjol ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->fontanela_cekung))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->fontanela_cekung ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td >
        b. Sutura sagitalis
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="sutura_tepat" value="Tepat" @if(!empty($hasil_data->sutura_tepat)) checked @endif > Tepat 
            <input type="checkbox" class="custom-control" name="sutura_terpisah" value="Terpisah" @if(!empty($hasil_data->sutura_terpisah)) checked @endif >Terpisah 
            <input type="checkbox" class="custom-control" name="sutura_menjauh" value="Menjauh" @if(!empty($hasil_data->sutura_menjauh)) checked @endif >Menjauh 
            <input type="checkbox" class="custom-control" name="sutura_tumpang_tindih" value="Tumpang tindih" @if(!empty($hasil_data->sutura_tumpang_tindih)) checked @endif >Tumpang tindih
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sutura_tepat))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sutura_tepat ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sutura_terpisah))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sutura_terpisah ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sutura_menjauh))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sutura_menjauh ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sutura_tumpang_tindih))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sutura_tumpang_tindih ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="3" class="text-center btop bbtm bright">
       RIWAYAT ANTENATAL
    </td>
    <td >
        c. Gambaran wajah
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="gambaran_wjh_simetris" value="Simetris" @if(!empty($hasil_data->gambaran_wjh_simetris)) checked @endif > Simetris 
            <input type="checkbox" class="custom-control" name="gambaran_wjh_asimetris" value="Asimetris" @if(!empty($hasil_data->gambaran_wjh_asimetris)) checked @endif >Asimetris 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->gambaran_wjh_simetris))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->gambaran_wjh_simetris ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->gambaran_wjh_asimetris))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->gambaran_wjh_asimetris ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="" >
       Kehamilan ke
    </td>
    <td>:</td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control" name="kehamilan_ke" value="{{ $hasil_data->kehamilan_ke ?? ''}}"> 
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->kehamilan_ke ?? ''}}</span>
    </td>
    <td >
        d. Caput siccedanum
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="caput_ada" value="Ada" @if(!empty($hasil_data->caput_ada)) checked @endif > Ada 
            <input type="checkbox" class="custom-control" name="caput_tidak" value="Tidak" @if(!empty($hasil_data->caput_tidak)) checked @endif >Tidak 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->caput_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->caput_ada ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->caput_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->caput_tidak ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="" >
       Tempat ANC
    </td>
    <td>:</td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control" name="tempat_anc" value="{{ $hasil_data->tempat_anc ?? ''}}"> 
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->tempat_anc ?? ''}}</span>
    </td>
    <td >
        e. Cephal hematom
    </td>
    <td>:</td>
    <td colspan="4" >
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="cephal_ada" value="Ada" @if(!empty($hasil_data->cephal_ada)) checked @endif > Ada 
            <input type="checkbox" class="custom-control" name="cephal_tidak" value="Tidak" @if(!empty($hasil_data->cephal_tidak)) checked @endif >Tidak 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->cephal_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->cephal_ada ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->cephal_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->cephal_tidak ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="" >
       ANC Teratur
    </td>
    <td>:</td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="anc_teratur_ya" value="Ya" @if(!empty($hasil_data->anc_teratur_ya)) checked @endif > Ya 
            <input type="checkbox" class="custom-control" name="anc_teratur_tidak" value="Tidak" @if(!empty($hasil_data->anc_teratur_tidak)) checked @endif >Tidak 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->anc_teratur_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->anc_teratur_ya ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->anc_teratur_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->anc_teratur_tidak ?? ''}}@endif</span>
    </td>
    <td >
        f. Telinga
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="telinga_normal" value="Normal" @if(!empty($hasil_data->telinga_normal)) checked @endif > Normal 
            <input type="checkbox" class="custom-control" name="telinga_abnormal" value="Abnormal" @if(!empty($hasil_data->telinga_abnormal)) checked @endif >Abnormal 
            :
            <input type="text" class="form-control" name="telinga_deskripsi" value="{{ $hasil_data->telinga_deskripsi ?? ''}}">
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->telinga_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->telinga_normal ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->telinga_abnormal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->telinga_abnormal ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">{{ $hasil_data->telinga_deskripsi ?? ''}}</span>
    </td>
</tr>
<tr>
    <td colspan="" >
       Keputihan
    </td>
    <td>:</td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="keputihan_ya" value="Ya" @if(!empty($hasil_data->keputihan_ya)) checked @endif > Ya 
            <input type="checkbox" class="custom-control" name="keputihan_tidak" value="Tidak" @if(!empty($hasil_data->keputihan_tidak)) checked @endif >Tidak 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->keputihan_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->keputihan_ya ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->keputihan_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->keputihan_tidak ?? ''}}@endif</span>
    </td>
    <td >
        g. Hidung
    </td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="hidung_simetris" value="Simetris" @if(!empty($hasil_data->hidung_simetris)) checked @endif > Simetris 
            <input type="checkbox" class="custom-control" name="hidung_asimetris" value="Asimetris" @if(!empty($hasil_data->hidung_asimetris)) checked @endif >Asimetris 
            <input type="checkbox" class="custom-control" name="hidung_napas_cuping_hidung" value="Napas cuping hidung" @if(!empty($hasil_data->hidung_napas_cuping_hidung)) checked @endif >Napas cuping hidung 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hidung_simetris))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hidung_simetris ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hidung_asimetris))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hidung_asimetris ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hidung_napas_cuping_hidung))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hidung_napas_cuping_hidung ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="3" class="text-center btop bbtm bright">
       RIWAYAT INTRANATAL
    </td>
    <td >
    </td>
    <td></td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="hidung_frekuensi" value="Frekuensi" @if(!empty($hasil_data->hidung_frekuensi)) checked @endif > Frekuensi 
            <input type="text" class="form-control" name="hidung_frekuensi_deskripsi" value="{{ $hasil_data->hidung_frekuensi_deskripsi ?? ''}}">x/menit
            <input type="checkbox" class="custom-control" name="hidung_sekret" value="Sekret" @if(!empty($hasil_data->hidung_sekret)) checked @endif >Sekret 
        :
            <input type="text" class="form-control" name="sekret_deskripsi" value="{{ $hasil_data->sekret_deskripsi ?? ''}}">
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hidung_frekuensi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hidung_frekuensi ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->hidung_frekuensi_deskripsi ?? ''}}x/menit</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hidung_sekret))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hidung_sekret ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">{{ $hasil_data->sekret_deskripsi ?? ''}}</span>
    </td>
</tr>
<tr>
    <td colspan="" >
       Kehamilan
    </td>
    <td>
        :
    </td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="kehamilan_tunggal" value="Tunggal" @if(!empty($hasil_data->kehamilan_tunggal)) checked @endif > Tunggal 
            <input type="checkbox" class="custom-control" name="kehamilan_kembar" value="Kembar" @if(!empty($hasil_data->kehamilan_kembar)) checked @endif >Kembar 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kehamilan_tunggal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kehamilan_tunggal ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kehamilan_kembar))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kehamilan_kembar ?? ''}}@endif</span>
    </td>
    <td >
        h. Mata
    </td>
    <td>:</td>
    <td colspan="4">
        Sekret mata :
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="sekret_mata_ada" value="Ada" @if(!empty($hasil_data->sekret_mata_ada)) checked @endif > Ada 
            <input type="checkbox" class="custom-control" name="sekret_mata_tidak" value="Tidak" @if(!empty($hasil_data->sekret_mata_tidak)) checked @endif >Tidak 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sekret_mata_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sekret_mata_ada ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sekret_mata_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sekret_mata_tidak ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="" >
       Ketuban pecah sebelum lahir
    </td>
    <td>
        :
    </td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control" name="ketuban_pecah_sblm_lahir" value="{{ $hasil_data->ketuban_pecah_sblm_lahir ?? ''}}" >jam 
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->ketuban_pecah_sblm_lahir ?? ''}} jam</span>
    </td>
    <td >
        
    </td>
    <td></td>
    <td colspan="4">
        Sclera mata :
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="sclera_mata_ikterus" value="Ikterus" @if(!empty($hasil_data->sclera_mata_ikterus)) checked @endif > Ikterus 
            <input type="checkbox" class="custom-control" name="sclera_mata_pendarahan" value="Pendarahan" @if(!empty($hasil_data->sclera_mata_pendarahan)) checked @endif >Pendarahan 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sclera_mata_ikterus))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sclera_mata_ikterus ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sclera_mata_pendarahan))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sclera_mata_pendarahan ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="" >
       Warna ketuban
    </td>
    <td>
        :
    </td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control" name="warna_ketuban" value="{{ $hasil_data->warna_ketuban ?? ''}}" > 
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->warna_ketuban ?? ''}}</span>
    </td>
    <td >
        i. Mulut
    </td>
    <td>:</td>
    <td colspan="4">
        Kelainan :
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="mulut_ada" value="Ada" @if(!empty($hasil_data->mulut_ada)) checked @endif > Ada 
            <input type="text" class="form-control" name="mulut_ada_deskripsi" value="{{ $hasil_data->mulut_ada_deskripsi ?? ''}}" > 
            <input type="checkbox" class="custom-control" name="mulut_tidakada" value="Tidak ada" @if(!empty($hasil_data->mulut_tidakada)) checked @endif >Tidak ada 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_ada ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->mulut_ada_deskripsi ?? ''}}</span>
        
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_tidakada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_tidakada ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="" >
       Pendarahan
    </td>
    <td>
        :
    </td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control" name="pendarahan" value="{{ $hasil_data->pendarahan ?? ''}}" > 
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->pendarahan ?? ''}}</span>
    </td>
    <td colspan="6" class="text-center btop bbtm">
        DADA DAN PARU-PARU
    </td>
    
</tr>
<tr>
    <td colspan="3" class="text-center bbtm bbtop bright">
       RIWAYAT PENYAKIT IBU
    </td>
    <td colspan="" >
       a. Bentuk
    </td>
    <td>
        :
    </td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="dada_paru_bentuk_simetris" value="Simetris" @if(!empty($hasil_data->dada_paru_bentuk_simetris)) checked @endif > Simetris 
            <input type="checkbox" class="custom-control" name="dada_paru_bentuk_asimetris" value="Asimetris" @if(!empty($hasil_data->dada_paru_bentuk_asimetris)) checked @endif >Asimetris 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_bentuk_simetris))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_bentuk_simetris ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_bentuk_asimetris))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_bentuk_asimetris ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="3" class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="rwyt_ibu_dm" value="DM" @if(!empty($hasil_data->rwyt_ibu_dm)) checked @endif > DM 
            <input type="checkbox" class="custom-control" name="rwyt_ibu_imunodefisiensi" value="Imunodefisiensi" @if(!empty($hasil_data->rwyt_ibu_imunodefisiensi)) checked @endif > Imunodefisiensi 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_ibu_dm))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_ibu_dm ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_ibu_imunodefisiensi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_ibu_imunodefisiensi ?? ''}}@endif</span>
    </td>
    <td colspan="" >
       b. Down score
    </td>
    <td>
        :
    </td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="dada_paru_score4" value="Score < 4" @if(!empty($hasil_data->dada_paru_score4)) checked @endif > Score < 4 

            <input type="checkbox" class="custom-control" name="dada_paru_score45" value="Score 4-5" @if(!empty($hasil_data->dada_paru_score45)) checked @endif >Score 4-5 
            <input type="checkbox" class="custom-control" name="dada_paru_score5" value="Score > 5" @if(!empty($hasil_data->dada_paru_score5)) checked @endif >Score > 5 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_score4))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_score4 ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_score45))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_score45 ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_score5))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_score5 ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="3" class=" bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="rwyt_ibu_hepatitis" value="Hepatitis B" @if(!empty($hasil_data->rwyt_ibu_hepatitis)) checked @endif > Hepatitis B 
            <input type="checkbox" class="custom-control" name="rwyt_ibu_jantung" value="Jantung" @if(!empty($hasil_data->rwyt_ibu_jantung)) checked @endif > Jantung 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_ibu_hepatitis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_ibu_hepatitis ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_ibu_jantung))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_ibu_jantung ?? ''}}@endif</span>
    </td>
    <td colspan="" >
       c. Suara napas
    </td>
    <td>
        :
    </td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="dada_paru_kanan_kiri_sama" value="Kanan Kiri Sama" @if(!empty($hasil_data->dada_paru_kanan_kiri_sama)) checked @endif > Kanan Kiri Sama 
            <input type="checkbox" class="custom-control" name="dada_paru_tidak_sama" value="Tidak sama" @if(!empty($hasil_data->dada_paru_tidak_sama)) checked @endif >Tidak sama 
            <input type="checkbox" class="custom-control" name="dada_paru_bersih" value="Bersih" @if(!empty($hasil_data->dada_paru_bersih)) checked @endif >Bersih 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_kanan_kiri_sama))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_kanan_kiri_sama ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_tidak_sama))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_tidak_sama ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_bersih))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_bersih ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="3" class=" bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="rwyt_ibu_tb" value="TB" @if(!empty($hasil_data->rwyt_ibu_tb)) checked @endif > TB 

            <input type="checkbox" class="custom-control" name="rwyt_ibu_asma" value="Asma" @if(!empty($hasil_data->rwyt_ibu_asma)) checked @endif > Asma 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_ibu_tb))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_ibu_tb ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_ibu_asma))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_ibu_asma ?? ''}}@endif</span>
    </td>
    <td colspan="" >
       
    </td>
    <td>
       
    </td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="dada_paru_ronchi" value="Ronchi" @if(!empty($hasil_data->dada_paru_ronchi)) checked @endif > Ronchi 
            <input type="checkbox" class="custom-control" name="dada_paru_wheezing" value="Wheezing" @if(!empty($hasil_data->dada_paru_wheezing)) checked @endif > Wheezing 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_ronchi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_ronchi ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_wheezing))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_wheezing ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="3" class=" bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="rwyt_ibu_hipertensi" value="Hipertensi" @if(!empty($hasil_data->rwyt_ibu_hipertensi)) checked @endif > Hipertensi 

            <input type="checkbox" class="custom-control" name="rwyt_ibu_isk" value="ISK" @if(!empty($hasil_data->rwyt_ibu_isk)) checked @endif > ISK 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_ibu_hipertensi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_ibu_hipertensi ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_ibu_isk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_ibu_isk ?? ''}}@endif</span>
    </td>
    <td colspan="" >
       d. Respirasi
    </td>
    <td>
        :
    </td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="dada_paru_spontatanpa" value="Spontan tanpa alat bantu" @if(!empty($hasil_data->dada_paru_spontatanpa)) checked @endif > Spontan tanpa alat bantu 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_spontatanpa))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_spontatanpa ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="3" class=" bright">
        <div class="medify-form-genv4-input-container">
            Diagnosis ibu <input type="text" class="form-control" name="diagnosis_ibu_rwyt" value="{{ $hasil_data->diagnosis_ibu_rwyt ?? ''}}"> 

            <input type="checkbox" class="custom-control" name="rwyt_ibu_korio" value="Korio amnionitis" @if(!empty($hasil_data->rwyt_ibu_korio)) checked @endif > Korio amnionitis
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->diagnosis_ibu_rwyt ?? ''}}</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_ibu_korio))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_ibu_korio ?? ''}}@endif</span>
    </td>
    <td colspan="" >
    </td>
    <td>
    </td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="dada_paru_non_spontan" value="Spontan dengan alat bantu" @if(!empty($hasil_data->dada_paru_non_spontan)) checked @endif > Spontan dengan alat bantu
            <input type="text" class="form-control" name="deskripsi_tanpa_alat_bantu" value="{{ $hasil_data->deskripsi_tanpa_alat_bantu ?? ''}}"> 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dada_paru_non_spontan))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dada_paru_non_spontan ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">{{ $hasil_data->deskripsi_tanpa_alat_bantu ?? ''}}</span>
    </td>
</tr>
<tr>
    <td colspan="3" class=" bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="rwyt_ibu_lainnya" value="Lainnya" @if(!empty($hasil_data->rwyt_ibu_lainnya)) checked @endif > Lainnya
            <input type="text" class="form-control" name="rwyt_lainnya" value="{{ $hasil_data->rwyt_lainnya ?? ''}}"> 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_ibu_lainnya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_ibu_lainnya ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">{{ $hasil_data->rwyt_lainnya ?? ''}}</span>
    </td>
    <td colspan="6" class="text-center bbtm btop">
        JANTUNG
    </td>
</tr>
<tr>
    <td colspan="3" class="text-center bright">
        
    </td>
    <td colspan="" >
        a. CRT
    </td>
    <td>
        :
    </td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="jantung_kurang_3" value="< 3 detik" @if(!empty($hasil_data->jantung_kurang_3)) checked @endif > < 3 detik
        <input type="checkbox" class="custom-control" name="jantung_lebih_3" value="> 3 detik" @if(!empty($hasil_data->jantung_lebih_3)) checked @endif > > 3 detik
    </div>
    <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->jantung_kurang_3))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->jantung_kurang_3 ?? ''}}@endif</span>

    <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->jantung_lebih_3))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->jantung_lebih_3 ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="3" class="text-center btop bbtm bright">
        RIWAYAT POST NATAL
    </td>
    <td colspan="" >
        &nbsp; Denyut jantung
    </td>
    <td>
        :
    </td>
    <td colspan="4">
        Frekuensi 
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control" name="frekuensi_jantung" value="{{ $hasil_data->frekuensi_jantung ?? ''}}" > x/menit
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->frekuensi_jantung ?? ''}} x/menit</span>
    
    </td>
</tr>
<tr>
    <td colspan="">
    IMD        
    </td>
    <td>:</td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="rwyt_post_natal_ya" value="Ya" @if(!empty($hasil_data->rwyt_post_natal_ya)) checked @endif >Ya
            <input type="checkbox" class="custom-control" name="rwyt_post_natal_tidak" value="Tidak" @if(!empty($hasil_data->rwyt_post_natal_tidak)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_post_natal_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_post_natal_ya ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_post_natal_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_post_natal_tidak ?? ''}}@endif</span>
    </td>
    <td colspan=""></td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control" name="lingkar_abdomen_cm" value="{{ $hasil_data->lingkar_abdomen_cm ?? ''}}" > cm
            <input type="checkbox" class="custom-control" name="jantung_kuat" value="Kuat" @if(!empty($hasil_data->jantung_kuat)) checked @endif >Kuat
            <input type="checkbox" class="custom-control" name="jantung_lemah" value="Lemah" @if(!empty($hasil_data->jantung_lemah)) checked @endif >Lemah
            <input type="checkbox" class="custom-control" name="jantung_teratur" value="Teratur" @if(!empty($hasil_data->jantung_teratur)) checked @endif >Teratur
            <input type="checkbox" class="custom-control" name="jantung_tidak" value="Tidak teratur" @if(!empty($hasil_data->jantung_tidak)) checked @endif >Tidak teratur
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->lingkar_abdomen_cm ?? ''}} cm</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->jantung_kuat))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->jantung_kuat ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->jantung_lemah))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->jantung_lemah ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->jantung_teratur))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->jantung_teratur ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->jantung_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->jantung_tidak ?? ''}}@endif</span>
        
    </td>
</tr>
<tr>
    <td colspan="">
    ASI        
    </td>
    <td>:</td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="rwyt_post_ntl_asi_ya" value="Ya" @if(!empty($hasil_data->rwyt_post_ntl_asi_ya)) checked @endif >Ya
            <input type="checkbox" class="custom-control" name="rwyt_post_ntl_asi_tidak" value="Tidak" @if(!empty($hasil_data->rwyt_post_ntl_asi_tidak)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_post_ntl_asi_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_post_ntl_asi_ya ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_post_ntl_asi_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_post_ntl_asi_tidak ?? ''}}@endif</span>
    </td>
    <td colspan="6" class="text-center"> ABDOMEN</td>
</tr>
<tr>
    <td colspan="">
    Riwayat resutasi        
    </td>
    <td>:</td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="rwyt_post_ntlresutasi_ya" value="Ya" @if(!empty($hasil_data->rwyt_post_ntlresutasi_ya)) checked @endif >Ya
            <input type="checkbox" class="custom-control" name="rwyt_post_ntlresutasi_tidak" value="Tidak" @if(!empty($hasil_data->rwyt_post_ntlresutasi_tidak)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_post_ntlresutasi_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_post_ntlresutasi_ya ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_post_ntlresutasi_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_post_ntlresutasi_tidak ?? ''}}@endif</span>
    </td>
    <td>a. Lingkar abdomen</td>
    <td>:</td>
    <td colspan="4">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="abdomen_supel" value="Supel" @if(!empty($hasil_data->abdomen_supel)) checked @endif >Supel
            <input type="checkbox" class="custom-control" name="abdomen_distended" value="Distended" @if(!empty($hasil_data->abdomen_distended)) checked @endif >Distended
            <input type="checkbox" class="custom-control" name="abdomen_kembung" value="Kembung" @if(!empty($hasil_data->abdomen_kembung)) checked @endif >Kembung 
        </div>
        
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_supel))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_supel ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_distended))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_distended ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_kembung))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_kembung ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="">
    Kelainan bawaan        
    </td>
    <td>:</td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="rwyt_post_ntlkelainan_ya" value="Ya" @if(!empty($hasil_data->rwyt_post_ntlkelainan_ya)) checked @endif >Ya
            <input type="checkbox" class="custom-control" name="rwyt_post_ntlkelainan_tidak" value="Tidak" @if(!empty($hasil_data->rwyt_post_ntlkelainan_tidak)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_post_ntlkelainan_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_post_ntlkelainan_ya ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rwyt_post_ntlkelainan_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rwyt_post_ntlkelainan_tidak ?? ''}}@endif</span>
    </td>
    <td>b. Bising usus</td>
    <td>:</td>
    <td colspan="4"> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="abdomen_bising" value="Ada" @if(!empty($hasil_data->abdomen_bising)) checked @endif >Ada
            <input type="checkbox" class="custom-control" name="abdomen_bising_tdk" value="Tidak ada" @if(!empty($hasil_data->abdomen_bising_tdk)) checked @endif >Tidak ada
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_bising))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_bising ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_bising_tdk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_bising_tdk ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="">
    Jika ya, sebutkan   
    </td>
    <td>:</td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control" name="rwyt_post_ntlsebut_ya" value="{{ $hasil_data->rwyt_post_ntlsebut_ya ?? ''}}"  >
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->rwyt_post_ntlsebut_ya ?? ''}}</span>
    </td>
    <td>c. Peristaltik usus</td>
    <td>:</td>
    <td colspan="4"> 
        <div class="medify-form-genv4-input-container">
            <input type="text" class="form-control" name="abdomen_peristaltik" value="{{ $hasil_data->abdomen_peristaltik ?? ''}}"  >x/menit
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->abdomen_peristaltik ?? ''}}x/menit</span>
    </td>
</tr>
<tr>
    <td colspan="">
    
    </td>
    <td></td>
    <td class="bright">
       
    </td>
    <td>d. Tali pusat</td>
    <td>:</td>
    <td colspan="4"> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="abdomen_tali_basah" value="Basah" @if(!empty($hasil_data->abdomen_tali_basah)) checked @endif >Basah
            <input type="checkbox" class="custom-control" name="abdomen_tali_kering" value="Kering" @if(!empty($hasil_data->abdomen_tali_kering)) checked @endif >Kering
            <input type="checkbox" class="custom-control" name="abdomen_tali_Layu" value="Layu" @if(!empty($hasil_data->abdomen_tali_Layu)) checked @endif >Layu
            <input type="checkbox" class="custom-control" name="abdomen_tali_segar" value="Segar" @if(!empty($hasil_data->abdomen_tali_segar)) checked @endif >Segar
            <input type="checkbox" class="custom-control" name="abdomen_tali_bau" value="Bau" @if(!empty($hasil_data->abdomen_tali_bau)) checked @endif >Bau
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_tali_basah))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_tali_basah ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_tali_kering))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_tali_kering ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_tali_Layu))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_tali_Layu ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_tali_segar))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_tali_segar ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_tali_bau))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_tali_bau ?? ''}}@endif</span>

    </td>
</tr>
</table>
<br>

<div style="margin: 20px 0;" class="space">
</div>
<pagebreak />
<br><br><br>

<table class="" style="width:100%; border:1px solid black;">
    <tr>
        <td colspan="3" class="text-center bbtm">RIWAYAT PSIKOSOSIAL ORANG TUA</td>
        <td colspan="6" class="text-center bbtm">GENITALIA</td>
    </tr>
    <tr>
        <td colspan="1" >a.</td>
        <td colspan="2" class="bright">Perkembangan Interpersonal</td>
        <td colspan="1" >a. LAKI-LAKI</td>
        <td colspan="5" ></td>
    </tr>
    <tr>
        <td colspan="1" ></td>
        <td colspan="2" class="bright">Pengasuh :</td>
        <td>Testis</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
            :
            <input type="checkbox" class="custom-control" name="genitalia_testis_turun" value="Sudah turun" @if(!empty($hasil_data->genitalia_testis_turun)) checked @endif >Sudah turun
            <input type="checkbox" class="custom-control" name="genitalia_testis_belum" value="Belum turun" @if(!empty($hasil_data->genitalia_testis_belum)) checked @endif >Belum turun
        </div>
        <span class="medify-form-genv4-view-container">:</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->genitalia_testis_turun))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->genitalia_testis_turun ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->genitalia_testis_belum))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->genitalia_testis_belum ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
        <td colspan="1" ></td>
        <td colspan="2" class="bright"><div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="pengasuh_ayah" value="Ayah" @if(!empty($hasil_data->pengasuh_ayah)) checked @endif >Ayah
            <input type="checkbox" class="custom-control" name="pengasuh_ibu" value="Ibu" @if(!empty($hasil_data->pengasuh_ibu)) checked @endif >Ibu
            <input type="checkbox" class="custom-control" name="pengasuh_nenek" value="Nenek" @if(!empty($hasil_data->pengasuh_nenek)) checked @endif >Nenek
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->pengasuh_ayah))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->pengasuh_ayah ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->pengasuh_ibu))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->pengasuh_ibu ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->pengasuh_nenek))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->pengasuh_nenek ?? ''}}@endif</span>
        
        <td>Scrotum</td>
        <td colspan="5">
            <div class="medify-form-genv4-input-container">
                :
            <input type="checkbox" class="custom-control" name="genitalia_scrotum_jelas" value="Rugae Jelas" @if(!empty($hasil_data->genitalia_scrotum_jelas)) checked @endif >Rugae Jelas
            <input type="checkbox" class="custom-control" name="genitalia_scrotum_tdk_jelas" value="Rugae tidak jelas" @if(!empty($hasil_data->genitalia_scrotum_tdk_jelas)) checked @endif >Rugae tidak jelas
        </div>
        <span class="medify-form-genv4-view-container">:</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->genitalia_scrotum_jelas))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->genitalia_scrotum_jelas ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->genitalia_scrotum_tdk_jelas))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->genitalia_scrotum_tdk_jelas ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
        <td colspan="1" ></td>
        <td colspan="2" class="bright"><div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="pengasuh_oranglain" value="Orang lain" @if(!empty($hasil_data->pengasuh_oranglain)) checked @endif >Orang lain
            <input type="checkbox" class="custom-control" name="pengasuh_negara" value="Negara/pemerintahan" @if(!empty($hasil_data->pengasuh_negara)) checked @endif >Negara/pemerintahan
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->pengasuh_oranglain))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->pengasuh_oranglain ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->pengasuh_negara))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->pengasuh_negara ?? ''}}@endif</span>
        <td>Kelainan</td>
        <td colspan="5">
            <div class="medify-form-genv4-input-container">
                :
            <input type="checkbox" class="custom-control" name="genitalia_kelainan_ada" value="Ada" @if(!empty($hasil_data->genitalia_kelainan_ada)) checked @endif >Ada
            <input type="text" class="form-control" name="deskripsi_kelainan" value="{{ $hasil_data->deskripsi_kelainan ?? ''}}">
        </div>
        <span class="medify-form-genv4-view-container">:</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->genitalia_kelainan_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->genitalia_kelainan_ada ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->deskripsi_kelainan ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="1" ></td>
        <td colspan="2" class="bright">Dukungan keluarga lain:</td>
        <td colspan="6" >b. PEREMPUAN</td>
    </tr>
    <tr>
        <td colspan="1" ></td>
        <td colspan="2" class="bright"><div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="dukungan_ada" value="Ada" @if(!empty($hasil_data->dukungan_ada)) checked @endif >Ada
            <input type="checkbox" class="custom-control" name="dukungan_tdk_ada" value="Tidak" @if(!empty($hasil_data->dukungan_tdk_ada)) checked @endif >Tidak
        </div>
        </td>
        <td colspan="6" >
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dukungan_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dukungan_ada ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->dukungan_tdk_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->dukungan_tdk_ada ?? ''}}@endif</span>
        
            <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="labia_mayor_tutup" value="Labia mayor menutup labia minor" @if(!empty($hasil_data->labia_mayor_tutup)) checked @endif >Labia mayor menutup labia minor
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->labia_mayor_tutup))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->labia_mayor_tutup ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
        <td colspan="1" ></td>
        <td colspan="2" class="bright">Keterlibatan orang tua:</td>
        <td colspan="6" >
            <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="labia_mayor_belum" value="Labia mayor belum menutup labia minor" @if(!empty($hasil_data->labia_mayor_belum)) checked @endif >Labia mayor belum menutup labia minor
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->labia_mayor_belum))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->labia_mayor_belum ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
        <td colspan="1" >Berkunjung</td>
        <td>:</td>
        <td colspan="1" class="bright"><div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="keterlibatan_berkunjung_ada" value="Ada" @if(!empty($hasil_data->keterlibatan_berkunjung_ada)) checked @endif >Ada
            <input type="checkbox" class="custom-control" name="keterlibatan_berkunjung_tidak" value="Tidak" @if(!empty($hasil_data->keterlibatan_berkunjung_tidak)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->keterlibatan_berkunjung_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->keterlibatan_berkunjung_ada ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->keterlibatan_berkunjung_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->keterlibatan_berkunjung_tidak ?? ''}}@endif</span>
        <td colspan="6" >
            c. SEX AMBIGU
        </td>
    </tr>
    <tr>
         <td colspan="1" >Kontak Mata</td>
        <td>:</td>
        <td colspan="1" class="bright"><div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="kontak_mata_ya" value="Ya" @if(!empty($hasil_data->kontak_mata_ya)) checked @endif >Ya
            <input type="checkbox" class="custom-control" name="kontak_mata_tdk" value="Tidak" @if(!empty($hasil_data->kontak_mata_tdk)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kontak_mata_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kontak_mata_ya ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kontak_mata_tdk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kontak_mata_tdk ?? ''}}@endif</span>
        <td colspan="6" >
            <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="sex_ya" value="Ya" @if(!empty($hasil_data->sex_ya)) checked @endif >Ya
            <input type="checkbox" class="custom-control" name="sex_tdk" value="Tidak" @if(!empty($hasil_data->sex_tdk)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sex_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sex_ya ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sex_tdk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sex_tdk ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
         <td colspan="1" >Menyentuh</td>
        <td>:</td>
        <td colspan="1" class="bright"><div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="menyentuh_ya" value="Ya" @if(!empty($hasil_data->menyentuh_ya)) checked @endif >Ya
            <input type="checkbox" class="custom-control" name="menyentuh_tdk" value="Tidak" @if(!empty($hasil_data->menyentuh_tdk)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->menyentuh_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->menyentuh_ya ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->menyentuh_tdk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->menyentuh_tdk ?? ''}}@endif</span>
        <td colspan="6" class="text-center bbtm btop">
            EKSTREMITAS
        </td>
    </tr>
    <tr>
         <td colspan="1" >Berkunjung</td>
        <td>:</td>
        <td colspan="1" class="bright"><div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="pmk_ya" value="Ya" @if(!empty($hasil_data->pmk_ya)) checked @endif >Ya
            <input type="checkbox" class="custom-control" name="pmk_tdk" value="Tidak" @if(!empty($hasil_data->pmk_tdk)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->pmk_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->pmk_ya ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->pmk_tdk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->pmk_tdk ?? ''}}@endif</span>
        <td colspan="1" >a. Gerakan</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="gerakan_bebas" value="Bebas" @if(!empty($hasil_data->gerakan_bebas)) checked @endif >Bebas
            <input type="checkbox" class="custom-control" name="gerakan_terbatas" value="Terbatas" @if(!empty($hasil_data->gerakan_terbatas)) checked @endif >Terbatas
            <input type="checkbox" class="custom-control" name="gerakan_unknown" value="Unknown" @if(!empty($hasil_data->gerakan_unknown)) checked @endif >Unknown
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->gerakan_bebas))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->gerakan_bebas ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->gerakan_terbatas))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->gerakan_terbatas ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->gerakan_unknown))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->gerakan_unknown ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
         <td colspan="1" >Berbicara</td>
        <td>:</td>
        <td colspan="1" class="bright"><div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="berbicara_ya" value="Ya" @if(!empty($hasil_data->berbicara_ya)) checked @endif >Ya
            <input type="checkbox" class="custom-control" name="berbicara_tdk" value="Tidak" @if(!empty($hasil_data->berbicara_tdk)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->berbicara_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->berbicara_ya ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->berbicara_tdk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->berbicara_tdk ?? ''}}@endif</span>
        </td>
        <td colspan="1" >b. Ekstremitas atas</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="ekstremitas_atas_normal" value="Normal" @if(!empty($hasil_data->ekstremitas_atas_normal)) checked @endif >Normal
            <input type="checkbox" class="custom-control" name="ekstremitas_atas_abnormal" value="Abnormal" @if(!empty($hasil_data->ekstremitas_atas_abnormal)) checked @endif >Abnormal
            <input type="text" class="form-control" name="deskripsi_ektremitas_atas" value="{{ $hasil_data->deskripsi_ektremitas_atas ?? ''}}">
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_atas_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_atas_normal ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_atas_abnormal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_atas_abnormal ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->deskripsi_ektremitas_atas ?? ''}}</span>
        </td>
    </tr>
    <tr>
         <td colspan="1" >Menggendong</td>
        <td>:</td>
        <td colspan="1" class="bright"><div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="menggendong_ya" value="Ya" @if(!empty($hasil_data->menggendong_ya)) checked @endif >Ya
            <input type="checkbox" class="custom-control" name="menggendong_tdk" value="Tidak" @if(!empty($hasil_data->menggendong_tdk)) checked @endif >Tidak
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->menggendong_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->menggendong_ya ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->menggendong_tdk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->menggendong_tdk ?? ''}}@endif</span>
        
        </td>
        <td colspan="1" >c. Ekstremitas bawah</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="ekstremitas_bwh_normal" value="Normal" @if(!empty($hasil_data->ekstremitas_bwh_normal)) checked @endif >Normal
            <input type="checkbox" class="custom-control" name="ekstremitas_bwh_abnormal" value="Abnormal" @if(!empty($hasil_data->ekstremitas_bwh_abnormal)) checked @endif >Abnormal
            <input type="text" class="form-control" name="deskripsi_ekstremitas_bwh" value="{{ $hasil_data->deskripsi_ekstremitas_bwh ?? ''}}">
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_bwh_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_bwh_normal ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_bwh_abnormal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_bwh_abnormal ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->deskripsi_ekstremitas_bwh ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="1" >b. </td>
        <td colspan="2" class="bright">Adat / budaya yang dianut</td>
        <td colspan="1" >d. Kelainan tulang</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="kelainan_tdk" value="Tidak ada" @if(!empty($hasil_data->kelainan_tdk)) checked @endif >Tidak ada
            <input type="checkbox" class="custom-control" name="kelainan_ada" value="Ada" @if(!empty($hasil_data->kelainan_ada)) checked @endif >Ada
            <input type="text" class="form-control" name="dekripsikelainan_tulang" value="{{ $hasil_data->dekripsikelainan_tulang ?? ''}}">
        </div>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kelainan_tdk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kelainan_tdk ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kelainan_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kelainan_ada ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->dekripsikelainan_tulang ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="1" ></td>
        <td colspan="2" class="bright"><div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="adat_ya" value="Ada" @if(!empty($hasil_data->adat_ya)) checked @endif >Ada
            <input type="text" class="form-control" name="deskripsi_adat" value="{{ $hasil_data->deskripsi_adat ?? ''}}">

        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->adat_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->adat_ya ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->deskripsi_adat ?? ''}}</span>
        </td>
        
        <td colspan="1" >e. Spinal/tulang belakang</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="spinal_normal" value="Normal" @if(!empty($hasil_data->spinal_normal)) checked @endif >Normal
            <input type="checkbox" class="custom-control" name="spinal_abnormal" value="Abnormal" @if(!empty($hasil_data->spinal_abnormal)) checked @endif >Abnormal
            <input type="text" class="form-control" name="deskripsi_spinal" value="{{ $hasil_data->deskripsi_spinal ?? ''}}">
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->spinal_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->spinal_normal ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->spinal_abnormal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->spinal_abnormal ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->deskripsi_spinal ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="1" ></td>
        <td colspan="2" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="adat_tdk" value="Tidak" @if(!empty($hasil_data->adat_tdk)) checked @endif >Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->adat_tdk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->adat_tdk ?? ''}}@endif</span>
        </td>
        <td colspan="6" class="text-center bbtm btop">
            REFLEK
        </td>
    </tr>
    <tr>
        <td colspan="3" class="bright"></td>
        <td colspan="6" >
            <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="reflek_moro" value="Moro" @if(!empty($hasil_data->reflek_moro)) checked @endif >Moro
            <input type="checkbox" class="custom-control" name="reflek_babinski" value="Babinski" @if(!empty($hasil_data->reflek_babinski)) checked @endif >Babinski
            <input type="checkbox" class="custom-control" name="reflek_tonic_neck" value="Tonic Neck" @if(!empty($hasil_data->reflek_tonic_neck)) checked @endif >Tonic Neck
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->reflek_moro))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->reflek_moro ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->reflek_babinski))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->reflek_babinski ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->reflek_tonic_neck))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->reflek_tonic_neck ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="bright"></td>
        <td>a. Rooting</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
                :
            <input type="checkbox" class="custom-control" name="reflek_rooting_kuat" value="Kuat" @if(!empty($hasil_data->reflek_rooting_kuat)) checked @endif >Kuat
            <input type="checkbox" class="custom-control" name="reflek_rooting_lemah" value="Lemah" @if(!empty($hasil_data->reflek_rooting_lemah)) checked @endif >Lemah
        </div>
        <span class="medify-form-genv4-view-container">:</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->reflek_rooting_kuat))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->reflek_rooting_kuat ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->reflek_rooting_lemah))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->reflek_rooting_lemah ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="bright"></td>
        <td>b. Menggenggam</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
                :
            <input type="checkbox" class="custom-control" name="reflek_menggenggam_kuat" value="Kuat" @if(!empty($hasil_data->reflek_menggenggam_kuat)) checked @endif >Kuat
            <input type="checkbox" class="custom-control" name="reflek_menggenggam_lemah" value="Lemah" @if(!empty($hasil_data->reflek_menggenggam_lemah)) checked @endif >Lemah
        </div>
        <span class="medify-form-genv4-view-container">:</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->reflek_menggenggam_kuat))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->reflek_menggenggam_kuat ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->reflek_menggenggam_lemah))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->reflek_menggenggam_lemah ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="bright"></td>
        <td>c. Menghisap</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
                :
            <input type="checkbox" class="custom-control" name="reflek_menghisap_kuat" value="Kuat" @if(!empty($hasil_data->reflek_menghisap_kuat)) checked @endif >Kuat
            <input type="checkbox" class="custom-control" name="reflek_menghisap_lemah" value="Lemah" @if(!empty($hasil_data->reflek_menghisap_lemah)) checked @endif >Lemah
        </div>
        <span class="medify-form-genv4-view-container">:</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->reflek_menghisap_kuat))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->reflek_menghisap_kuat ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->reflek_menghisap_lemah))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->reflek_menghisap_lemah ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
        <td colspan="3" ></td>
        <td colspan="6" class="text-center bbtm btop bleft">
            TONUS / AKTIVITAS
        </td>
    </tr>
    <tr>
        <td colspan="3" class="bright"></td>
        <td>a. Aktivitas</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
            :
            <input type="checkbox" class="custom-control" name="tonus_aktif" value="Aktif" @if(!empty($hasil_data->tonus_aktif)) checked @endif >Aktif
            <input type="checkbox" class="custom-control" name="tonus_tenang" value="Tenang" @if(!empty($hasil_data->tonus_tenang)) checked @endif >Tenang
            <input type="checkbox" class="custom-control" name="tonus_letargi" value="Letargi" @if(!empty($hasil_data->tonus_letargi)) checked @endif >Letargi
            <input type="checkbox" class="custom-control" name="tonus_kejang" value="Kejang" @if(!empty($hasil_data->tonus_kejang)) checked @endif >Kejang
        </div>
        <span class="medify-form-genv4-view-container">:</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonus_aktif))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonus_aktif ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonus_tenang))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonus_tenang ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonus_letargi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonus_letargi ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonus_kejang))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonus_kejang ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="bright"></td>
        <td>b. Menangis</td>
        <td colspan="5" >
            <div class="medify-form-genv4-input-container">
            :
            <input type="checkbox" class="custom-control" name="tonus_keras" value="Keras" @if(!empty($hasil_data->tonus_keras)) checked @endif >Keras
            <input type="checkbox" class="custom-control" name="tonus_lemah" value="Lemah" @if(!empty($hasil_data->tonus_lemah)) checked @endif >Lemah
            <input type="checkbox" class="custom-control" name="tonus_melengking" value="Melengking" @if(!empty($hasil_data->tonus_melengking)) checked @endif >Melengking
            <input type="checkbox" class="custom-control" name="tonus_sulit" value="Sulit" @if(!empty($hasil_data->tonus_sulit)) checked @endif >Sulit
        </div>
        <span class="medify-form-genv4-view-container">:</span>

        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonus_keras))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonus_keras ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonus_lemah))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonus_lemah ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonus_melengking))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonus_melengking ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonus_sulit))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonus_sulit ?? ''}}@endif</span>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="bright"></td>
        <td colspan="6" class="text-center bbtm btop">
            SKRINING NYERI
        </td>
    </tr>
    <tr>
        <td colspan="3" class="bright"></td>
        <td colspan="6" >
            <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="skrining_tdk" value="Tidak" @if(!empty($hasil_data->skrining_tdk)) checked @endif >Tidak
            <input type="checkbox" class="custom-control" name="skrining_ya" value="Ya" @if(!empty($hasil_data->skrining_ya)) checked @endif >Ya
            (isi asesmen nyero neonatus / NIPS ) skala nyeri
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->skrining_tdk))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->skrining_tdk ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->skrining_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->skrining_ya ?? ''}}@endif</span>
        (isi asesmen nyero neonatus / NIPS ) skala nyeri
    </td>
    </tr>
    <tr>
        <td colspan="3" class="bright"></td>
        <td colspan="6" class="text-center bbtm btop">
            MASALAH KEPERAWATAN
        </td>
    </tr>
    <tr>
        <td colspan="3" class="bbtm" ></td>
        <td colspan="6" class="bbtm bleft">
            <div class="medify-form-genv4-input-container">
            <textarea class="form-control" rows="4" name="masalah_keperawatan">{{ $hasil_data->masalah_keperawatan ?? ''}}</textarea>
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->masalah_keperawatan ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3" ></td>
        <td colspan="3" ></td>
        <td colspan="3" >
            <div class="medify-form-genv4-input-container">
            Tanggal <input type="date" name="tanggal_perawat_pengkajian" class="form-control" value="{{ $hasil_data->tanggal_perawat_pengkajian }}">
            Jam <input type="text" name="time_perawat_pengkajian" class="form-control" value="{{ $hasil_data->time_perawat_pengkajian }}">
        </div>
         <span class="medify-form-genv4-view-container"> {{ $hasil_data->tanggal_perawat_pengkajian ?? ''}}</span>
         <span class="medify-form-genv4-view-container">, {{ $hasil_data->time_perawat_pengkajian ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3" ></td>
        <td colspan="3" ></td>
        <td colspan="3" class="text-center">
            Nama dan tanda Tangan
        </td>
    </tr>
    <tr>
        <td colspan="3" ></td>
        <td colspan="3" ></td>
        <td colspan="3" class="text-center">
            Perawat yang melakukan pengkajian
        </td>
    </tr>
    <tr>
        <td colspan="3" ></td>
        <td colspan="3" ></td>
        <td colspan="3" class="text-center">
            
        </td>
    </tr>
    <tr>
        <td colspan="3" ></td>
        <td colspan="3" ></td>
        <td colspan="3" class="text-center">
            ..............................................
        </td>
    </tr>

    </table>