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
    .bright {
        border-right: 1px solid black;
    }
    .bleft {
        border-left: 1px solid black;
    }
    .btop {
        border-top: 1px solid black;
    }
    .bbtm {
        border-bottom: 1px solid black;
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
        <div class="border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RM. 11.K3&nbsp;&nbsp;&nbsp;</div>
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
        <h5>ASESMEN AWAL MEDIS NEONATOLOGI (USIA 0 - 2)</h5>
      </td>
   </tr>
</table>
<br>

<table class="" style="width:100%; border:1px solid black;">
<tr>
    <td colspan="9" class="bbtm">Diisi oleh dokter</td>
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
            <div class="medify-form-genv4-input-container"><input type="text" class="form-control timid" name="jam" value="{{ $hasil_data->jam ?? '' }}">
            </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->jam ?? ''}}</span></td>
</tr>
<tr>
    <td>Nama Ibu :</td>
    <td colspan="2"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="nama_ibu" value="{{ $hasil_data->nama_ibu ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->nama_ibu ?? ''}}</span></td>
    <td>Umur :</td>
    <td colspan="2"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="umur_ibu" value="{{ $hasil_data->umur_ibu ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->umur_ibu ?? ''}}</span></td>
    <td>Golongan Darah :</td>
    <td colspan="2"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="golongan_darah_ibu" value="{{ $hasil_data->golongan_darah_ibu ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->golongan_darah_ibu ?? ''}}</span></td>
</tr>
<tr>
    <td class="bbtm">Nama Ayah :</td>
    <td colspan="2" class="bbtm"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="nama_ayah" value="{{ $hasil_data->nama_ayah ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->nama_ayah ?? ''}}</span></td>
    <td class="bbtm">Umur :</td>
    <td colspan="2" class="bbtm"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="umur_ayah" value="{{ $hasil_data->umur_ayah ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->umur_ayah ?? ''}}</span></td>
    <td class="bbtm">Golongan Darah :</td>
    <td colspan="2" class="bbtm"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="golongan_darah_ayah" value="{{ $hasil_data->golongan_darah_ayah ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->golongan_darah_ayah ?? ''}}</span></td>
</tr>
<tr>
    <td class="bbtm">Alergi Terhadap :</td>
    <td colspan="8" class="bbtm"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="alergi_terhadap" value="{{ $hasil_data->alergi_terhadap ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->alergi_terhadap ?? ''}}</span></td>
</tr>
<tr>
    <td colspan="3" class="text-center bbtm bright">ANAMNESIS</td>
    <td colspan="3" class="text-center bbtm bright">PEMERIKSAAN FISIS</td>
    <td colspan="3" class="text-center">INTRUKSI TERAPI / TINDAKAN</td>
</tr>
<tr>
    <td colspan="3" class="bright">
        RIWAYAT KELAHIRAN YANG LALU
    </td>
    <td colspan="3" class="bright">
        ST. PRESENT
    </td>
    <td colspan="3" class="text-center">
        Byi lahir
    </td>
</tr>
<tr>
    <td rowspan="4" colspan="3" class="bright">
        <table style="width:100%; border:1px solid black;">
            <tr>
                <td>Persalinan ke</td>
                <td>I</td>
                <td>II</td>
                <td>III</td>
                <td>IV</td>
                <td class="bright">> IV</td>
            </tr>
            <tr>
                <td>Cara persalinan</td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="cara_persalinan_1" value="{{ $hasil_data->cara_persalinan_1 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->cara_persalinan_1 ?? ''}}</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="cara_persalinan_2" value="{{ $hasil_data->cara_persalinan_2 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->cara_persalinan_2 ?? ''}}</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="cara_persalinan_3" value="{{ $hasil_data->cara_persalinan_3 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->cara_persalinan_3 ?? ''}}</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="cara_persalinan_4" value="{{ $hasil_data->cara_persalinan_4 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->cara_persalinan_4 ?? ''}}</span></td>
                <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="cara_persalinan_5" value="{{ $hasil_data->cara_persalinan_5 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->cara_persalinan_5 ?? ''}}</span></td>
            </tr>
            <tr>
                <td>Hidup / Mati</td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="hidup_mati_1" value="{{ $hasil_data->hidup_mati_1 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->hidup_mati_1 ?? ''}}</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="hidup_mati_2" value="{{ $hasil_data->hidup_mati_2 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->hidup_mati_2 ?? ''}}</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="hidup_mati_3" value="{{ $hasil_data->hidup_mati_3 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->hidup_mati_3 ?? ''}}</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="hidup_mati_4" value="{{ $hasil_data->hidup_mati_4 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->hidup_mati_4 ?? ''}}</span></td>
                <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="hidup_mati_5" value="{{ $hasil_data->hidup_mati_5 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->hidup_mati_5 ?? ''}}</span></td>
            </tr>
            <tr>
                <td>Usia Saat ini</td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="usia_saat_ini_1" value="{{ $hasil_data->usia_saat_ini_1 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->usia_saat_ini_1 ?? ''}}</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="usia_saat_ini_2" value="{{ $hasil_data->usia_saat_ini_2 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->usia_saat_ini_2 ?? ''}}</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="usia_saat_ini_3" value="{{ $hasil_data->usia_saat_ini_3 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->usia_saat_ini_3 ?? ''}}</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="usia_saat_ini_4" value="{{ $hasil_data->usia_saat_ini_4 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->usia_saat_ini_4 ?? ''}}</span></td>
                <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="usia_saat_ini_5" value="{{ $hasil_data->usia_saat_ini_5 ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->usia_saat_ini_5 ?? ''}}</span></td>
            </tr>
        </table>
    </td>
    <td>Denyut Jantung</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="denyut_jantung" value="{{ $hasil_data->denyut_jantung ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->denyut_jantung ?? ''}}</span></td>
    <td colspan="3" rowspan="2" class="text-center"><img src="{{ url('')}}/assets/img/evaluasi.png" alt="evaluasi" class="text-center">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->ruangan ?? ''}}</span></td>

</tr>
<tr>
    <td>Respirasi</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="respirasi" value="{{ $hasil_data->respirasi ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->respirasi ?? ''}}</span></td>

</tr>
<tr>
    <td>Temperatur Axilla</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="temperatur_axilla" value="{{ $hasil_data->temperatur_axilla ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->temperatur_axilla ?? ''}}</span></td>
    <td>Bernafas/menangis:</td>
    <td colspan="2">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="nafas_nangis_ya" value="Ya" @if(!empty($hasil_data->nafas_nangis_ya)) checked @endif >Ya 
            <input type="checkbox" class="custom-control" name="nafas_nangis_tidak" value="Tidak" @if(!empty($hasil_data->nafas_nangis_tidak)) checked @endif >Tidak 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nafas_nangis_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nafas_nangis_ya ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nafas_nangis_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nafas_nangis_tidak ?? ''}}@endif</span>
    </td>
</tr>
<tr>
    <td>SpO2</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="spo2" value="{{ $hasil_data->spo2 ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->ruangan ?? ''}}</span></td>
    <td>Tonus otot baik:</td>
    <td colspan="2" class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="tonus_ya" value="Ya" @if(!empty($hasil_data->tonus_ya)) checked @endif>Ya 
            <input type="checkbox" class="custom-control" name="tonus_tidak" value="Tidak" @if(!empty($hasil_data->tonus_tidak)) checked @endif>Tidak</td>
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonus_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonus_ya ?? ''}}</span>@endif
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonus_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonus_tidak ?? ''}}@endif</span>
</tr>
<tr>
    <td colspan="3" class="bright">DATA BAYI</td>
    
    <td>Kesadaran</td>
    <td>:</td>
    <td class="bright">
        <div class="medify-form-genv4-input-container">
        <input type="text" class="form-control" name="present_kesadaran" value="{{ $hasil_data->present_kesadaran ?? '' }}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->present_kesadaran ?? ''}}</span></td>
    <td colspan="3"></td>
</tr>
<tr>
    <td>Rujukan dari</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="rujukan_dari" value="{{ $hasil_data->rujukan_dari ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->rujukan_dari ?? ''}}</span></td>
    <td>Skor Nyeri (NIPS)</td>
    <td>:</td>
    <td class="bright">

        <div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="skor_nyeri_nips" value="{{ $hasil_data->skor_nyeri_nips ?? '' }}">
        </div>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->skor_nyeri_nips ?? ''}}</span>
    </td>
    <td colspan="3" rowspan="9" class="text-center"><img src="{{ url('')}}/assets/img/yatidak.png" alt="ya tidak"  class="text-center"></td>
</tr>
<tr>
    <td>Dx rujukan</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="dx_rujukan" value="{{ $hasil_data->dx_rujukan ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->dx_rujukan ?? ''}}</span></td>
    <td>Down Score</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="down_score" value="{{ $hasil_data->down_score ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->down_score ?? ''}}</span></td>
</tr>
<tr>
    <td>Tgl & Jam Lahir</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="date" class="form-control" name="tanggal_data_bayi" value="{{ $hasil_data->tanggal_data_bayi ?? '' }}">
    </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->tanggal_data_bayi ?? ''}}</span>
        <div class="medify-form-genv4-input-container"><input type="text" class="form-control time" name="time_bayi" value="{{ $hasil_data->time_bayi ?? '' }}">
        </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->time_bayi ?? ''}}</span></td>
    <td>New Ballard Score</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="new_ballard_score_" value="{{ $hasil_data->new_ballard_score_ ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->new_ballard_score_ ?? ''}}</span></td>
</tr>
<tr>
    <td colspan="3" class="bright">RIWAYAT ANTENATAL</td>
    <td>CRT</td>
    <td>:</td>
    <td class="bright">
       <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control " name="crt_kurang" value="< 3 DET" @if(!empty($hasil_data->crt_kurang)) checked @endif>< 3 DET 
            <input type="checkbox" class="custom-control" name="crt_lebih" value="> 3 DET" @if(!empty($hasil_data->crt_lebih)) checked @endif> > 3 DET 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty(($hasil_data->crt_kurang)))<span style='font-family:calibri'>&#x2714;</span> {{ $hasil_data->crt_kurang ?? '' }}@endif</span>
        <span class="medify-form-genv4-view-container"> @if(!empty(($hasil_data->crt_kurang)))<span style='font-family:calibri'>&#x2714;</span> > {{ $hasil_data->crt_lebih }}@endif</span>
    </td>
</tr>
<tr>
    <td colspan="1">Kehamilan ke</td>
    <td colspan="1">:</td>
    <td colspan="1" class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="kehamilan_ke" value="{{ $hasil_data->kehamilan_ke ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->kehamilan_ke ?? ''}}</span></td>
    <td colspan="3" class="bright">ST.GENERAL</td>
</tr>
<tr>
    <td>ANC</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="anc" value="{{ $hasil_data->anc ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->anc ?? ''}}</span></td>
    <td>BBL/PBL</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="bbl_pbl" value="{{ $hasil_data->bbl_pbl ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->bbl_pbl ?? ''}}</span></td>
</tr>
<tr>
    <td>USG</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="usg" value="{{ $hasil_data->usg ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->usg ?? ''}}</span></td>
    <td>LK/LD</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="lk_ld" value="{{ $hasil_data->lk_ld ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->lk_ld ?? ''}}</span></td>
</tr>
<tr>
    <td>HPHT</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="hpht" value="{{ $hasil_data->hpht ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->hpht ?? ''}}</span></td>
    <td>BB sekarang</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="bb_sekarang" value="{{ $hasil_data->bb_sekarang ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->bb_sekarang ?? ''}}</span></td>
</tr>
<tr>
    <td>Takaran persalinan</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="date" class="form-control" name="takaran_persalinan" value="{{ $hasil_data->takaran_persalinan ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->takaran_persalinan ?? ''}}</span></td>
    <td>PB Sekarang</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="pb_sekarang" value="{{ $hasil_data->pb_sekarang ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->pb_sekarang ?? ''}}</span></td>
    {{-- sidebar kanan --}}
</tr>
<tr>
    <td>Riwayat terapi pematangan paru</td>
    <td>:</td>
    <td class="bright"><span> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="riwayat_terapi_pematangan_paru" value="1x" @if(!empty($hasil_data->riwayat_terapi_pematangan_paru)) checked @endif> 1x 
            <input type="checkbox" class="custom-control" name="riwayat_terapi_pematangan_paru_2" value="2x" @if(!empty($hasil_data->riwayat_terapi_pematangan_paru_2)) checked @endif> 2x 
            <input type="checkbox" class="custom-control" name="riwayat_terapi_pematangan_paru_3" value="3x" @if(!empty($hasil_data->riwayat_terapi_pematangan_paru_3)) checked @endif> 3x
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_terapi_pematangan_paru_2))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_terapi_pematangan_paru_2 ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_terapi_pematangan_paru))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_terapi_pematangan_paru ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_terapi_pematangan_paru_3))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_terapi_pematangan_paru_3 ?? ''}}@endif</span>
</span></td>
    <td>LK sekarang</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="lk_sekarang" value="{{ $hasil_data->lk_sekarang ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->lk_sekarang ?? ''}}</span></td>
    <td colspan="3" >
        <table style="width:100%;border:none;">
            <tr>
                <td style="width:50%">
                    <div class="medify-form-genv4-input-container">
                    <input type="checkbox" class="custom-control" name="imd" value="IMD" @if(!empty($hasil_data->imd)) checked @endif> IMD 
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->imd))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->imd ?? ''}}</span>@endif</td>
                <td style="width:50%">
                    <div class="medify-form-genv4-input-container">
                        <input type="checkbox" class="custom-control" name="langkah_awal" value="Langkah Awal" @if(!empty($hasil_data->langkah_awal)) checked @endif> Langkah awal
                    </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->langkah_awal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->langkah_awal ?? ''}}@endif</span></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>Riwayat terapi lain</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="riwayat_terapi_lain" value="{{ $hasil_data->riwayat_terapi_lain ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->riwayat_terapi_lain ?? ''}}</span></td>
    <td>New Ballard score</td>
    <td>:</td>
    <td class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="new_ballard_score_general" value="{{ $hasil_data->new_ballard_score_general ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->new_ballard_score_general ?? ''}}</span></td>
    <td colspan="3">
        <table style="width:100%;border:none;">
            <tr>
                <td style="width:50%"><div class="medify-form-genv4-input-container">
                    <input type="checkbox" class="custom-control" name="first_feeding" value="First Feeding" @if(!empty($hasil_data->first_feeding)) checked @endif> First Feeding 
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->first_feeding))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->first_feeding ?? ''}}@endif</span>
        </td>
            <td style="width:50%"> <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="VTP" value="VTP" @if(!empty($hasil_data->VTP)) checked @endif >VTP
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->VTP))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->VTP ?? ''}} @endif</span></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="3" class="bright">RIWAYAT INTRANATAL</td>
    <td colspan="3" class="bright">KEPALA:</td>
    <td colspan="3">
        <table style="width:100%;border:none;">
            <tr>
                <td style="width:50%"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="asi" value="ASI" @if(!empty($hasil_data->asi)) checked @endif> ASI 
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->asi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->asi ?? ''}}@endif</span></td>
                <td style="width:50%"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kompresi_dada" value="Kompresi Dada" @if(!empty($hasil_data->kompresi_dada)) checked @endif >Kompresi Dada
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kompresi_dada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kompresi_dada ?? ''}}@endif</span></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>Umur Kehamilan</td>
    <td>:</td>
    <td class="bright"> <div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="riwayat_terapi_lain" value="{{ $hasil_data->riwayat_terapi_lain ?? '' }}"> Minggu
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->riwayat_terapi_lain ?? ''}} Minggu</span></td>
    <td colspan="3" class="bright">
        <table style="width:100%;border:none;">
            <tr>
                <td style="width:50%"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kepala_normal" value="Normal" @if(!empty($hasil_data->kepala_normal)) checked @endif> Normal 
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_normal ?? ''}}@endif</span></td>
                <td style="width:50%"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kepala_caput_succedaneum" value="Caput succedaneum" @if(!empty($hasil_data->kepala_caput_succedaneum)) checked @endif >Caput succedaneum
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_caput_succedaneum))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_caput_succedaneum ?? ''}}@endif</span></td>
            </tr>
        </table>
    </td>
    <td colspan="3">
        <table style="width:100%;border:none;">
            <tr>
                <td style="width:50%"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="formula" value="Formula " @if(!empty($hasil_data->formula)) checked @endif> Formula 
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->formula))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->formula ?? ''}}@endif</span></td>
                <td style="width:50%"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="obat_epineprin" value="Obat epineprin" @if(!empty($hasil_data->obat_epineprin)) checked @endif >Obat epineprin
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->obat_epineprin))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->obat_epineprin ?? ''}}@endif</span></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>Kehamilan :</td>
    <td colspan="2" class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="kehamilan_tunggal" value="Tunggal" @if(!empty($hasil_data->kehamilan_tunggal)) checked @endif> Tunggal 
            <input type="checkbox" class="custom-control" name="kehamilan_kembar" value="Kembar" @if(!empty($hasil_data->kehamilan_kembar)) checked @endif> Kembar
        </div>
    <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kehamilan_tunggal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kehamilan_tunggal ?? ''}}@endif</span>
    <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kehamilan_kembar))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kehamilan_kembar ?? ''}}@endif</span></td>
    <td colspan="3" class="bright">
        <table style="width:100%;border:none;">
            <tr>
                <td><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kepala_cephalohemalom" value="Cephalohemalom" @if(!empty($hasil_data->kepala_cephalohemalom)) checked @endif> Cephalohemalom 
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_cephalohemalom))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_cephalohemalom ?? ''}}</span>@endif</td>
                <td><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kepala_craniosnostosis" value="Craniosinostosis" @if(!empty($hasil_data->kepala_craniosnostosis)) checked @endif > Craniosinostosis
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_craniosnostosis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_craniosnostosis ?? ''}}</span>@endif</td>
            </tr>
        </table>
    </td>
    <td colspan="3">
        <table style="width:100%;border:none;">
            <tr>
                <td style="width:50%">Alasan : <div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="alasan_intruksi" value="{{ $hasil_data->alasan_intruksi ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->alasan_intruksi ?? ''}}</span> </td>
                <td style="width:50%"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="terapi_syok" value="Terapi syok" @if(!empty($hasil_data->terapi_syok)) checked @endif >Terapi syok
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->terapi_syok))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->terapi_syok ?? ''}} @endif</span></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>Lama persalinan:</td>
    <td>Kala I: <div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="lama_persalinankala_1" value="{{ $hasil_data->lama_persalinankala_1 ?? '' }}">menit
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->lama_persalinankala_1 ?? ''}}</span></td>
    <td class="bright">Kala II: <div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="lama_persalinankala_2" value="{{ $hasil_data->lama_persalinankala_2 ?? '' }}">menit
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->lama_persalinankala_2 ?? ''}}</span></td>
    <td colspan="3" class="bright">
        <table style="width:100%;border:none;">
            <tr>
                <td><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kepala_plagosephall" value="Plagosephall" @if(!empty($hasil_data->kepala_plagosephall)) checked @endif> Plagosephall 
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_plagosephall))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_plagosephall ?? ''}}@endif</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kepala_craniotabes" value="Craniotabes" @if(!empty($hasil_data->kepala_craniotabes)) checked @endif > Craniotabes
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_craniotabes))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_craniotabes ?? ''}}@endif</span></td>
            </tr>
        </table>
    </td>
    <td colspan="3"></td>
</tr>
<tr>
    <td>Ketuban pecah sebelum lahir:</td>
    <td colspan="2" class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="ketuban_pecah_sblm_lahir" value="{{ $hasil_data->ketuban_pecah_sblm_lahir ?? '' }}">jam
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->ketuban_pecah_sblm_lahir ?? ''}}</span></td>
    <td colspan="3" class="bright">
        <table style="width:100%;border:none;">
            <tr>
                <td><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kepala_plagosephall" value="Hidrosephalus" @if(!empty($hasil_data->kepala_plagosephall)) checked @endif> Hidrosephalus 
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_plagosephall))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_plagosephall ?? ''}}@endif</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kepala_craniotabes" value="Hidransephall" @if(!empty($hasil_data->kepala_craniotabes)) checked @endif > Hidransephall
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_plagosephall))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_plagosephall ?? ''}}@endif</span></td>
            </tr>
        </table>
    </td>
    <td colspan="3">APGAR SCORE :</td>
</tr>
<tr>
    <td>Warna ketuban:</td>
    <td colspan="2" class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="warna_ketuban" value="{{ $hasil_data->warna_ketuban ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->warna_ketuban ?? ''}}</span></td>
    <td colspan="3" class="bright">
        <table style="width:100%;border:none;">
            <tr>
                <td><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kepala_mikrosephall" value="Mikrosephall" @if(!empty($hasil_data->kepala_mikrosephall)) checked @endif> Mikrosephall 
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_mikrosephall))<span style='font-family:calibri'>&#x2714;</span>
            {{ $hasil_data->kepala_mikrosephall ?? ''}}@endif</span></td>
                <td><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kepala_meningcole" value="Meningcole" @if(!empty($hasil_data->kepala_meningcole)) checked @endif > Meningcole
                </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_meningcole))<span style='font-family:calibri'>&#x2714;</span>
            {{ $hasil_data->kepala_meningcole ?? ''}}@endif</span></td>
            </tr>
        </table>
    </td>
    <td colspan="3"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="apgar_1" value="Menit 1" @if(!empty($hasil_data->apgar_1)) checked @endif> Menit 1
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->apgar_1 ?? ''}}</span></td>
</tr>
<tr>
    <td>Pendarahan:</td>
    <td colspan="2" class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="pendarahan" value="{{ $hasil_data->pendarahan ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->pendarahan ?? ''}}</span></td>
    <td colspan="3" class="bright">
        <table style="width:100%;border:none;">
            <tr>
                <td>Fontanella mayor : </td>
                <td>
                    <div class="medify-form-genv4-input-container">
                        <input type="checkbox" class="custom-control" name="kepala_terbuka" value="Terbuka" @if(!empty($hasil_data->kepala_terbuka)) checked @endif > Terbuka 
                        <input type="checkbox" class="custom-control" name="kepala_cembung" value="Cembung" @if(!empty($hasil_data->kepala_cembung)) checked @endif > Cembung 
                    </div>
                <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_terbuka))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_terbuka ?? ''}}@endif</span>
                <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_cembung))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_cembung ?? ''}}@endif</span></td>
            </tr>
        </table>
    </td>
    <td colspan="3"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="apgar_5" value="Menit 5" @if(!empty($hasil_data->apgar_5)) checked @endif> Menit 5
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->apgar_5 ?? ''}}</span></td>
</tr>
<tr>
    <td colspan="3" class="bright">Placenta :</td>
    <td colspan="3" class="bright">
        <table style="width:100%;border:none;">
            <tr>
                <td></td>
                <td>
                    <div class="medify-form-genv4-input-container">
                        <input type="checkbox" class="custom-control" name="kepala_cekung" value="Cekung" @if(!empty($hasil_data->kepala_cekung)) checked @endif > Cekung 
                        <input type="checkbox" class="custom-control" name="kepala_menutup" value="Menutup" @if(!empty($hasil_data->kepala_menutup)) checked @endif > Menutup 
                    </div>
                <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_cekung))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_cekung ?? ''}}@endif</span>
                <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kepala_menutup))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kepala_menutup ?? ''}}@endif</span></td>
            </tr>
        </table>
    </td>
    <td colspan="3"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="apgar_10" value="Menit 10" @if(!empty($hasil_data->apgar_10)) checked @endif> Menit 10
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->apgar_10 ?? ''}}</span></td>
</tr>
<tr>
    <td colspan=""> - Berat</td>
    <td colspan="2" class="bright">:<div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="berat_plasenta" value="{{ $hasil_data->berat_plasenta ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->berat_plasenta ?? ''}}</span></td>
    <td colspan="3" class="bright">
        MATA:
    </td>
    <td colspan="3">MRS DI LEVEL</td>
</tr>
<tr>
    <td colspan=""> - Ukuran</td>
    <td colspan="2" class="bright">:<div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="ukuran_plasenta" value="{{ $hasil_data->ukuran_plasenta ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->ukuran_plasenta ?? ''}}</span></td>
    <td colspan="3" class="bright"> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="pucat" value="Pucat" @if(!empty($hasil_data->pucat)) checked @endif > Pucat
            <input type="checkbox" class="custom-control" name="iktekrik" value="Ikterik" @if(!empty($hasil_data->iktekrik)) checked @endif > Ikterik
            <input type="checkbox" class="custom-control" name="hiperemi" value="Hiperemi" @if(!empty($hasil_data->hiperemi)) checked @endif > Hiperemi
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->pucat))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->pucat ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->iktekrik))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->iktekrik ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hiperemi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hiperemi ?? ''}}@endif</span>
    </td>
    <td colspan="3"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="mrs_level_1" value="I" @if(!empty($hasil_data->mrs_level_1)) checked @endif > I
    </div>
    
<span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mrs_level_1))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mrs_level_1 ?? ''}}@endif</span></td>
</tr>
<tr>
    <td colspan=""> - Klasifikasi</td>
    <td colspan="2" class="bright">:<div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="klasifikasi_plasenta" value="{{ $hasil_data->klasifikasi_plasenta ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->klasifikasi_plasenta ?? ''}}</span></td>
    <td colspan="3" class="bright">
        Pupil :
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="isokor" value="1" @if(!empty($hasil_data->isokor)) checked @endif > Isokor
            <input type="checkbox" class="custom-control" name="anisokor" value="1" @if(!empty($hasil_data->anisokor)) checked @endif > Anisokor
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->isokor))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->isokor ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->anisokor))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->anisokor ?? ''}}@endif</span>
    </td>
    <td colspan="3"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="mrs_level_2" value="II" @if(!empty($hasil_data->mrs_level_2)) checked @endif > II
    </div>
<span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mrs_level_2))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mrs_level_2 ?? ''}}@endif</span></td>
</tr>
<tr>
    <td colspan=""> - Kelainan</td>
    <td colspan="2" class="bright">:<div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="kelainan_plasenta" value="{{ $hasil_data->kelainan_plasenta ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->kelainan_plasenta ?? ''}}</span></td>
    <td colspan="3" class="bright">
        Reflek Cahaya :
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="mata_positif" value="1" @if(!empty($hasil_data->mata_positif)) checked @endif > Positif
            <input type="checkbox" class="custom-control" name="mata_negatif" value="1" @if(!empty($hasil_data->mata_negatif)) checked @endif > negatif
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mata_positif))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mata_positif ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mata_negatif))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mata_negatif ?? ''}}@endif</span>
    </td>
    <td colspan="3"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="mrs_level_3" value="III" @if(!empty($hasil_data->mrs_level_3)) checked @endif > III
    </div>
<span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mrs_level_3))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mrs_level_3 ?? ''}}@endif</span></td>
</tr>
<tr>
    <td colspan="" rowspan="2" >Obat-obat selama persalinan : </td>
    <td colspan="2" rowspan="2" class="bright"><div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="obatobat_selama_persalinan" value="{{ $hasil_data->obatobat_selama_persalinan ?? '' }}">
    </div>
<span class="medify-form-genv4-view-container">{{ $hasil_data->obatobat_selama_persalinan ?? ''}}</span></td>
    <td colspan="3" class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="mata_lain_lain" value="Lain-lain" @if(!empty($hasil_data->mata_lain_lain)) checked @endif > Lain-lain 
            <input type="text" class="form-control" name="mata_lain_lain_teks" value="{{ $hasil_data->mata_lain_lain_teks ?? '' }}" placeholder="lain lain mata">
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mata_lain_lain))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mata_lain_lain ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->mata_lain_lain_teks ?? ''}}</span>
    </td>
    <td colspan="3"></td>
</tr>
<tr>
    <td colspan="3" class="bright">HIDUNG :</td>
    <td colspan="3"></td>
</tr>
<tr>
    <td colspan="3" class="bright">Tanda gawat janin :</td>
    <td colspan="3" class="bright"> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="napas_hidung" value="Napas cuping hidung " @if(!empty($hasil_data->napas_hidung)) checked @endif > Napas cuping hidung 
            <input type="checkbox" class="custom-control" name="atresia_coane" value="Atresia coane " @if(!empty($hasil_data->atresia_coane)) checked @endif > Atresia coane 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->napas_hidung))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->napas_hidung ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->atresia_coane))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->atresia_coane ?? ''}}@endif</span></td>
    <td colspan="3"></td>
</tr>
<tr>
    <td colspan="3" class="bright"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="tachycardi" value="Tachycardi" @if(!empty($hasil_data->tachycardi)) checked @endif > Tachycardi
    </div>
<span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tachycardi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tachycardi ?? ''}}@endif</span></td>
    <td colspan="3" class="bright">  
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="hidung_lain_lain" value="Lain-lain " @if(!empty($hasil_data->hidung_lain_lain)) checked @endif > Lain-lain 
            <input type="text" class="form-control" placeholder="lain lain hidung" name="hidung_lain_lain_teks" value="{{ $hasil_data->hidung_lain_lain_teks ?? '' }}">
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hidung_lain_lain))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hidung_lain_lain ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->hidung_lain_lain_teks ?? ''}}</span>
    </td>
    <td colspan="3"></td>
</tr>
<tr>
    <td colspan="3" class="bright"><div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="bradycardi" value="Bradycardi" @if(!empty($hasil_data->bradycardi)) checked @endif > Bradycardi
    </div>
<span class="medify-form-genv4-view-container">@if(!empty($hasil_data->bradycardi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ruangan ?? ''}}@endif</span></td>
    <td colspan="3" class="bright">  
       TELINGA:
    </td>
    <td colspan="3"></td>
</tr>
<tr>
    <td colspan="3" class="text-center bright">RIWAYAT PENYAKIT IBU</td>
    <td colspan="3" class="bright"> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="telinga_normal" value="Normal" @if(!empty($hasil_data->telinga_normal)) checked @endif > Normal
            <input type="checkbox" class="custom-control" name="telinga_lowsetears" value="Low set ears" @if(!empty($hasil_data->telinga_lowsetears)) checked @endif > Low set ears
            <input type="checkbox" class="custom-control" name="telinga_fistula" value="Fistula" @if(!empty($hasil_data->telinga_fistula)) checked @endif > Fistula
            <input type="checkbox" class="custom-control" name="telinga_lanugo" value="Lanugo" @if(!empty($hasil_data->telinga_lanugo)) checked @endif > Lanugo
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->telinga_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->telinga_normal ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->telinga_lowsetears))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->telinga_lowsetears ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->telinga_fistula))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->telinga_fistula ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->telinga_lanugo))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->telinga_lanugo ?? ''}}@endif</span>
    </td>
    <td colspan="3"></td>
</tr>
<tr>
    <td colspan="3" class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="riwayat_ibu_dm" value="DM" @if(!empty($hasil_data->riwayat_ibu_dm)) checked @endif > DM
            <input type="checkbox" class="custom-control" name="riwayat_ibu_imunodefisiensi" value="Imunodefisiensi" @if(!empty($hasil_data->riwayat_ibu_imunodefisiensi)) checked @endif > Imunodefisiensi
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_ibu_dm))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_ibu_dm ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_ibu_imunodefisiensi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_ibu_imunodefisiensi ?? ''}}@endif</span>

    </td>
    <td colspan="3" class="bright"> 
        MULUT:
    </td>
    <td colspan="3"></td>
</tr>
<tr>
    <td colspan="3" class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="riwayat_ibu_hepatitis_b" value="Hepatitis B" @if(!empty($hasil_data->riwayat_ibu_hepatitis_b)) checked @endif > Hepatitis B
            <input type="checkbox" class="custom-control" name="riwayat_ibu_jantung" value="Jantung" @if(!empty($hasil_data->riwayat_ibu_jantung)) checked @endif > Jantung
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_ibu_hepatitis_b))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_ibu_hepatitis_b ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_ibu_jantung))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_ibu_jantung ?? ''}}@endif</span>

    </td>
    <td colspan="3" class="bright"> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="mulut_normal" value="Normal" @if(!empty($hasil_data->mulut_normal)) checked @endif > Normal
            <input type="checkbox" class="custom-control" name="mulut_cheloschiziz" value="Cheloschiziz" @if(!empty($hasil_data->mulut_cheloschiziz)) checked @endif > Cheloschiziz
            <input type="checkbox" class="custom-control" name="mulut_gnatoschiziz" value="Gnathoschiziz" @if(!empty($hasil_data->mulut_gnatoschiziz)) checked @endif > Gnathoschiziz
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_normal ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_cheloschiziz))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_cheloschiziz ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_gnatoschiziz))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_gnatoschiziz ?? ''}}@endif</span>
    </td>
    <td colspan="3"></td>
</tr>
<tr>
    <td colspan="3" class="bright"> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="riwayat_ibu_tb" value="TB" @if(!empty($hasil_data->riwayat_ibu_tb)) checked @endif > TB
            <input type="checkbox" class="custom-control" name="riwayat_ibu_asma" value="Asma" @if(!empty($hasil_data->riwayat_ibu_asma)) checked @endif > Asma
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_ibu_tb))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_ibu_tb ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_ibu_asma))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_ibu_asma ?? ''}}@endif</span>

    </td>
    <td colspan="3" class="bright"> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="mulut_palatoshiziz" value="Palatoshiziz" @if(!empty($hasil_data->mulut_palatoshiziz)) checked @endif > Palatoshiziz
            <input type="checkbox" class="custom-control" name="mulut_macroglossia" value="Macroglossia" @if(!empty($hasil_data->mulut_macroglossia)) checked @endif > Macroglossia
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_palatoshiziz))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_palatoshiziz ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_macroglossia))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_macroglossia ?? ''}}@endif</span>
    </td>
    <td colspan="3"></td>
</tr>
<tr>
    <td colspan="3" class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="riwayat_ibu_hipertensi" value="Hipertensi" @if(!empty($hasil_data->riwayat_ibu_hipertensi)) checked @endif > Hipertensi
            <input type="checkbox" class="custom-control" name="riwayat_ibu_lainnya" value="Lainnya" @if(!empty($hasil_data->riwayat_ibu_lainnya)) checked @endif > Lainnya
            <input type="text" class="form-control" name="riwayat_ibu_lainnya_teks" value="{{ $hasil_data->riwayat_ibu_lainnya_teks ?? '' }}" placeholder="riwayat ibu lainnya"> 
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_ibu_hipertensi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_ibu_hipertensi ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_ibu_lainnya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_ibu_lainnya ?? ''}}@endif</span>

        <span class="medify-form-genv4-view-container">{{ $hasil_data->riwayat_ibu_lainnya_teks ?? ''}}</span>

    </td>
    <td colspan="3" class="bright"> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="mulut_micronathia" value="Micronathia" @if(!empty($hasil_data->mulut_micronathia)) checked @endif > Micronathia
            <input type="checkbox" class="custom-control" name="mulut_natal_teeth" value="Natal teeth" @if(!empty($hasil_data->mulut_natal_teeth)) checked @endif > Natal teeth
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_micronathia))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_micronathia ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_natal_teeth))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_natal_teeth ?? ''}}@endif</span>
    </td>
    <td colspan="3"></td>
</tr>
<tr>
    <td colspan="3" class="bright">
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="riwayat_ibu_diagnosis" value=" Diagnosis ibu" @if(!empty($hasil_data->riwayat_ibu_diagnosis)) checked @endif > Diagnosis ibu
            <input type="text" class="form-control" name="riwayat_ibu_diagnosis_teks" value="{{ $hasil_data->riwayat_ibu_diagnosis_teks ?? '' }}" placeholder="riwayat ibu diagnosis teks">
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->riwayat_ibu_diagnosis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->riwayat_ibu_diagnosis ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">{{ $hasil_data->riwayat_ibu_diagnosis_teks ?? ''}}</span> 
    </td>
    <td colspan="3" class="bright"> 
        <div class="medify-form-genv4-input-container">
            <input type="checkbox" class="custom-control" name="mulut_frenulun" value="Frenulun linguae pendek" @if(!empty($hasil_data->mulut_frenulun)) checked @endif > Frenulun linguae pendek
            <input type="checkbox" class="custom-control" name="mulut_moniliasis" value="Moniliasis" @if(!empty($hasil_data->mulut_moniliasis)) checked @endif > Moniliasis
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_frenulun))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_frenulun ?? ''}}@endif</span>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulut_moniliasis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulut_moniliasis ?? ''}}@endif</span>
    </td>
    <td colspan="3"></td>
</tr>
</table>
<br>

<div style="margin: 20px 0;" class="space">
</div>
<pagebreak />
<br><br><br>
<table class="" style="width:100%; border:1px solid black;">
    <tr>
        <td colspan="3" class="bright bbtm">ANAMNESIS</td>
        <td colspan="3" class="bright bbtm">PEMERIKSAAN FISIS</td>
        <td colspan="3" class="bbtm">INTRUKSI TERAPI / TINDAKAN</td>
    </tr>
    <tr>
        <td colspan="3" class="bright">KELUHAN UTAMA</td>
        <td colspan="3" class="bright">LEHER :</td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" rowspan="7" class="bright"></td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="leher_normal" value="Normal" @if(!empty($hasil_data->leher_normal)) checked @endif > Normal
                <input type="checkbox" class="custom-control" name="leher_torticolis" value="Torticolis" @if(!empty($hasil_data->leher_torticolis)) checked @endif > Torticolis
                <input type="checkbox" class="custom-control" name="leher_hygroma" value="Hygroma" @if(!empty($hasil_data->leher_hygroma)) checked @endif > Hygroma
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->leher_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->leher_normal ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->leher_torticolis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->leher_torticolis ?? ''}}@endif</span>

            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->leher_hygroma))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->leher_hygroma ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="leher_ductus" value="Dusctus thyroglosus" @if(!empty($hasil_data->leher_ductus)) checked @endif > Dusctus thyroglosus
                <input type="checkbox" class="custom-control" name="leher_golter" value="Golter" @if(!empty($hasil_data->leher_golter)) checked @endif > Golter
                <input type="checkbox" class="custom-control" name="leher_webbedneck" value="Webbed neck" @if(!empty($hasil_data->leher_webbedneck)) checked @endif > Webbed neck
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->leher_ductus))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->leher_ductus ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->leher_golter))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->leher_golter ?? ''}}@endif</span>

            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->leher_webbedneck))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->leher_webbedneck ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            THORAX :
        </td>
        <td colspan="3"></td>
    </tr> 
    <tr>
        <td colspan="3" class="bright">
             Bentuk :
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="bentuk_simetris" value="Simetris" @if(!empty($hasil_data->bentuk_simetris)) checked @endif > Simetris
                <input type="checkbox" class="custom-control" name="bentuk_asimetris" value="Asimetris" @if(!empty($hasil_data->bentuk_asimetris)) checked @endif > Asimetris
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->bentuk_simetris))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->bentuk_simetris ?? ''}}@endif</span>

            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->bentuk_asimetris))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->bentuk_asimetris ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
             Retraksi dada :
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="retraksi_ada" value="Ada" @if(!empty($hasil_data->retraksi_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="retraksi_tidak" value="Tidak" @if(!empty($hasil_data->retraksi_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->retraksi_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->retraksi_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->retraksi_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->retraksi_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            Paru :
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
             Suara nafas:
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="nafas_bersih" value="Bersih" @if(!empty($hasil_data->nafas_bersih)) checked @endif > Bersih
                <input type="checkbox" class="custom-control" name="nafas_vesikuler" value="Vesikuler" @if(!empty($hasil_data->nafas_vesikuler)) checked @endif > Vesikuler
                <input type="checkbox" class="custom-control" name="nafas_stridor" value="Stridor" @if(!empty($hasil_data->nafas_stridor)) checked @endif > Stridor
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nafas_bersih))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nafas_bersih ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nafas_vesikuler))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nafas_vesikuler ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nafas_stridor))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nafas_stridor ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">CARA PERSALINAN</td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="nafas_wheezing" value="Wheezing" @if(!empty($hasil_data->nafas_wheezing)) checked @endif > Wheezing
                <input type="checkbox" class="custom-control" name="nafas_ronchi" value="Ronchi" @if(!empty($hasil_data->nafas_ronchi)) checked @endif > Ronchi
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nafas_wheezing))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nafas_wheezing ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nafas_ronchi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nafas_ronchi ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="cara_persalinan_spontan" value="Spontan" @if(!empty($hasil_data->cara_persalinan_spontan)) checked @endif > Spontan
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->cara_persalinan_spontan))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->cara_persalinan_spontan ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="nafas_lainnya" value="Lainnya" @if(!empty($hasil_data->nafas_lainnya)) checked @endif > Lainnya
                <input type="text" class="form-control" name="nafas_lainnya_deskripsi" value="{{ $hasil_data->nafas_lainnya_deskripsi ?? '' }}" placeholder="nafas lainnya">
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nafas_lainnya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nafas_lainnya ?? ''}}@endif</span>

            <span class="medify-form-genv4-view-container">{{ $hasil_data->nafas_lainnya_deskripsi ?? ''}}</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="cara_persalinan_spontan" value="SC indikasi" @if(!empty($hasil_data->cara_persalinan_spontan)) checked @endif > 
                SC, indikasi 
                <input type="text" class="form-control" name="sc_indikasi_deskripsi" value="{{ $hasil_data->sc_indikasi_deskripsi ?? '' }}" placeholder="sc indikasi deskripsi">
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->cara_persalinan_spontan))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->cara_persalinan_spontan ?? ''}}@endif</span>

            <span class="medify-form-genv4-view-container">{{ $hasil_data->sc_indikasi_deskripsi ?? ''}}</span>
        </td>
        <td colspan="3" class="bright">
            Irama : 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="irama_reguler" value="Reguler" @if(!empty($hasil_data->irama_reguler)) checked @endif > Reguler
                <input type="checkbox" class="custom-control" name="irama_ireguler" value="Ireguler" @if(!empty($hasil_data->irama_ireguler)) checked @endif > Ireguler
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->irama_reguler))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->irama_reguler ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->irama_ireguler))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->irama_ireguler ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="cara_persalinan_vacum" value="Vacum indikasi " @if(!empty($hasil_data->cara_persalinan_vacum)) checked @endif > Vacum, indikasi 
                <input type="text" class="form-control" name="vacum_indikasi_deskripsi" value="{{ $hasil_data->vacum_indikasi_deskripsi ?? '' }}" placeholder="vacum indikasi deskripsi">
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->cara_persalinan_vacum))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->cara_persalinan_vacum ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->vacum_indikasi_deskripsi ?? ''}}</span>
        </td>
        <td colspan="3" class="bright">
            Jenis : 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="jenis_dysponea" value="Dysponea" @if(!empty($hasil_data->jenis_dysponea)) checked @endif > Dysponea
                <input type="checkbox" class="custom-control" name="jenis_kusmaul" value="Kusmaul" @if(!empty($hasil_data->jenis_kusmaul)) checked @endif > Kusmaul
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->jenis_dysponea))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->jenis_dysponea ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->jenis_kusmaul))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->jenis_kusmaul ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="cara_persalinan_forceps" value="Forceps indikasi" @if(!empty($hasil_data->cara_persalinan_forceps)) checked @endif > Forceps, indikasi 
                <input type="text" class="form-control" name="forceps_indikasi_deskripsi" value="{{ $hasil_data->forceps_indikasi_deskripsi ?? '' }}" placeholder="forceps indikasi deskripsi">
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->cara_persalinan_forceps))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->cara_persalinan_forceps ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->forceps_indikasi_deskripsi ?? ''}}</span>
        </td>
        <td colspan="3" class="bright">
            Irama : 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="jenis_ceyneskokes" value="Ceyneskokes" @if(!empty($hasil_data->jenis_ceyneskokes)) checked @endif > Ceyneskokes
                <input type="checkbox" class="custom-control" name="jenis_lainnya" value="Lainnya" @if(!empty($hasil_data->jenis_lainnya)) checked @endif > Lainnya 
                <input type="text" class="form-control" name="jenis_lainnya" value="{{ $hasil_data->jenis_lainnya ?? '' }}" placeholder="jenis lainnya deskripsi">
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->jenis_ceyneskokes))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->jenis_ceyneskokes ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->jenis_lainnya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->jenis_lainnya ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->jenis_lainnya ?? ''}}</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            FAKTOR RESIKO INFEKSI
        </td>
        <td colspan="3" class="bright">
            Jantung : 
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            Ibu  <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="faktor_resiko_infeksi" value="Ibu" @if(!empty($hasil_data->faktor_resiko_infeksi)) checked @endif >
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->faktor_resiko_infeksi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->faktor_resiko_infeksi ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            Irama Jantung : 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="irama_teratur" value="Teratur" @if(!empty($hasil_data->irama_teratur)) checked @endif > Teratur
                <input type="checkbox" class="custom-control" name="irama_tidak" value="Tidak" @if(!empty($hasil_data->irama_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->irama_teratur))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->irama_teratur ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->irama_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->irama_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="demam_intrapartum" value="Demam intrapartum ( t ? 38 C)  " @if(!empty($hasil_data->demam_intrapartum)) checked @endif > Demam intrapartum ( t ? 38 C)  
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->demam_intrapartum))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->demam_intrapartum ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            S1/S2 tunggal : 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="s1s2_ya" value="Ya" @if(!empty($hasil_data->s1s2_ya)) checked @endif > Ya
                <input type="checkbox" class="custom-control" name="s1s2_tidak" value="Tidak" @if(!empty($hasil_data->s1s2_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->s1s2_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->s1s2_ya ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->s1s2_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->s1s2_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kpd" value="KPD > 18 jam" @if(!empty($hasil_data->kpd)) checked @endif >KPD > 18 jam
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kpd))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kpd ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            Mur-mur : 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="murmur_ya" value="Ya" @if(!empty($hasil_data->murmur_ya)) checked @endif > Ya
                <input type="checkbox" class="custom-control" name="murmur_tidak" value="Tidak" @if(!empty($hasil_data->murmur_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->murmur_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->murmur_ya ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->murmur_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->murmur_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="persalinan_kurang_bulan" value="Persalinan kurang bulan" @if(!empty($hasil_data->persalinan_kurang_bulan)) checked @endif > Persalinan kurang bulan
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->persalinan_kurang_bulan))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->persalinan_kurang_bulan ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
          ABDOMEN :
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="asfiksia" value="Asfiksia antenantal atau intrapartum" @if(!empty($hasil_data->asfiksia)) checked @endif > Asfiksia antenantal atau intrapartum
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->asfiksia))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->asfiksia ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
          Bising usus: <div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="bising_usus" value="{{ $hasil_data->bising_usus ?? '' }}">
        </div>
        <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->bising_usus))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->bising_usus ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="infeksi_kemih" value="Infeksi saluran kemih ibu" @if(!empty($hasil_data->infeksi_kemih)) checked @endif > Infeksi saluran kemih ibu
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->infeksi_kemih))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->infeksi_kemih ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="abdomen_normal" value="Bentuk normal" @if(!empty($hasil_data->abdomen_normal)) checked @endif > Bentuk normal
                <input type="checkbox" class="custom-control" name="abdomen_skaphoid" value="Skaphoid" @if(!empty($hasil_data->abdomen_skaphoid)) checked @endif > Skaphoid
                <input type="checkbox" class="custom-control" name="abdomen_kembung" value="Kembung" @if(!empty($hasil_data->abdomen_kembung)) checked @endif > Kembung
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_normal ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_skaphoid))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_skaphoid ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_kembung))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_kembung ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="leukosit" value="Leukosit > 15.000" @if(!empty($hasil_data->leukosit)) checked @endif > Leukosit > 15.000
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->leukosit))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->leukosit ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="abdomen_omphalocele" value="Omphalocele" @if(!empty($hasil_data->abdomen_omphalocele)) checked @endif > Omphalocele
                <input type="checkbox" class="custom-control" name="abdomen_gastroskisis" value="Gastrokisis" @if(!empty($hasil_data->abdomen_gastroskisis)) checked @endif > Gastrokisis
                <input type="checkbox" class="custom-control" name="abdomen_ekstrofia" value="Ekstrofia bull" @if(!empty($hasil_data->abdomen_ekstrofia)) checked @endif > Ekstrofia bull
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_omphalocele))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_omphalocele ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_gastroskisis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_gastroskisis ?? ''}}@endif</span>

            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_ekstrofia))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_ekstrofia ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="crp_faktor_risiko" value="CRP" @if(!empty($hasil_data->crp_faktor_risiko)) checked @endif > CRP
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->crp_faktor_risiko))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->crp_faktor_risiko ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright"> 
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="abdomen_asiles" value="Asiles" @if(!empty($hasil_data->abdomen_asiles)) checked @endif > Asiles
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->abdomen_asiles))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->abdomen_asiles ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="nyeri_perut" value="Nyeri Perut" @if(!empty($hasil_data->nyeri_perut)) checked @endif > Nyeri Perut
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nyeri_perut))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nyeri_perut ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            Hepar membesar :
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="hepar_ya" value="Ya" @if(!empty($hasil_data->hepar_ya)) checked @endif > Ya
                <input type="checkbox" class="custom-control" name="hepar_tidak" value="Tidak" @if(!empty($hasil_data->hepar_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hepar_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hepar_ya ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hepar_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hepar_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            Neonatal <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="neonatal" value="Neonatal" @if(!empty($hasil_data->neonatal)) checked @endif >
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->neonatal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->neonatal ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            Tali pusar :
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="pusar_segar" value="Ya" @if(!empty($hasil_data->pusar_segar)) checked @endif > Segar
                <input type="checkbox" class="custom-control" name="pusar_layu" value="Tidak" @if(!empty($hasil_data->pusar_layu)) checked @endif > Layu
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->pusar_segar))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->pusar_segar ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->pusar_layu))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->pusar_layu ?? ''}}@endif</span>
        </td>
        <td colspan="3" ></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="kelahiran_kurang_bulan" value="Kelahiran kurang bulan" @if(!empty($hasil_data->kelahiran_kurang_bulan)) checked @endif > Kelahiran kurang bulan
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kelahiran_kurang_bulan))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kelahiran_kurang_bulan ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            COLUMNA VERTEBRALIS :
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="nenatus_dengan" value="Neonatus dengan selang endrotrakes, akese vena sentral, kateter infus, dll" @if(!empty($hasil_data->nenatus_dengan)) checked @endif > Neonatus dengan selang endrotrakes, akese vena sentral, kateter infus, dll
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nenatus_dengan))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nenatus_dengan ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="columna_normal" value="Normal" @if(!empty($hasil_data->columna_normal)) checked @endif > Normal
                <input type="checkbox" class="custom-control" name="columna_spina" value="Spina Bifida" @if(!empty($hasil_data->columna_spina)) checked @endif > Spina Bifida
                <input type="checkbox" class="custom-control" name="columna_scolosis" value="Scollosis" @if(!empty($hasil_data->columna_scolosis)) checked @endif > Scollosis
                <input type="checkbox" class="custom-control" name="columna_lordosis" value="Lordosis" @if(!empty($hasil_data->columna_lordosis)) checked @endif > Lordosis
                <input type="checkbox" class="custom-control" name="columna_kiposis" value="Kiposis" @if(!empty($hasil_data->columna_kiposis)) checked @endif > Kiposis
                <input type="checkbox" class="custom-control" name="columna_meningocele" value="Meningocele" @if(!empty($hasil_data->columna_meningocele)) checked @endif > Meningocele
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->columna_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->columna_normal ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->columna_spina))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->columna_spina ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->columna_scolosis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->columna_scolosis ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->columna_lordosis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->columna_lordosis ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->columna_kiposis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->columna_kiposis ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->columna_meningocele))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->columna_meningocele ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="nenatus_susu_formula" value="Neonatus yang minum susu formula" @if(!empty($hasil_data->nenatus_susu_formula)) checked @endif > Neonatus yang minum susu formula
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->nenatus_susu_formula))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->nenatus_susu_formula ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="columna_sacro" value="Sacrocoxygeal dempel" @if(!empty($hasil_data->columna_sacro)) checked @endif > Sacrocoxygeal dempel
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->columna_sacro))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->columna_sacro ?? ''}}@endif</span>
        </td>
        <td colspan="3" ></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            GENITALIA EKSTERNA:
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
           Laki-laki:
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            Testis sudah turun: 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="testis_turun" value="Ya" @if(!empty($hasil_data->testis_turun)) checked @endif > Ya
                <input type="checkbox" class="custom-control" name="testis_belum" value="Belum" @if(!empty($hasil_data->testis_belum)) checked @endif > Belum
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->testis_turun))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->testis_turun ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->testis_belum))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->testis_belum ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            Rugae: 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="rugae_jelas" value="Jelas" @if(!empty($hasil_data->rugae_jelas)) checked @endif > Jelas
                <input type="checkbox" class="custom-control" name="rugae_tidak" value="Tidak jelas" @if(!empty($hasil_data->rugae_tidak)) checked @endif > Tidak jelas
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rugae_jelas))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rugae_jelas ?? ''}}@endif</span>

            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rugae_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rugae_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            Hipospadi: 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="hipos_ada" value="Ada" @if(!empty($hasil_data->hipos_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="hipos_tidak" value="Tidak" @if(!empty($hasil_data->hipos_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hipos_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hipos_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->hipos_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->hipos_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            Mikro penis: 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="mikro_ya" value="Ya" @if(!empty($hasil_data->mikro_ya)) checked @endif > Ya
                <input type="checkbox" class="custom-control" name="mikro_tidak" value="Tidak" @if(!empty($hasil_data->mikro_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mikro_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mikro_ya ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mikro_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mikro_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
           Perempuan :
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            bentuk normal: 
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="bentuk_perempuan_ya" value="Ya" @if(!empty($hasil_data->bentuk_perempuan_ya)) checked @endif > Ya
                <input type="checkbox" class="custom-control" name="bentuk_perempuan_tidak" value="Tidak" @if(!empty($hasil_data->bentuk_perempuan_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->bentuk_perempuan_ya))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->bentuk_perempuan_ya ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->bentuk_perempuan_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->bentuk_perempuan_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            Labia : 
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="labia_menutup" value="Labia mayor menutupi labia minor" @if(!empty($hasil_data->labia_menutup)) checked @endif > Labia mayor menutupi labia minor
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->labia_menutup))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->labia_menutup ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="labia_menonjol" value="Labia mayor dan minor sama-sama menonjol" @if(!empty($hasil_data->labia_menonjol)) checked @endif > Labia mayor dan minor sama-sama menonjol
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->labia_menonjol))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->labia_menonjol ?? ''}}@endif</span>
        </td>
        <td colspan="3" class="bright"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            ANUS :
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="anus_ada" value="Ada" @if(!empty($hasil_data->anus_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="anus_tidak" value="Tidak" @if(!empty($hasil_data->anus_tidak)) checked @endif > Tidak
                <input type="checkbox" class="custom-control" name="anus_fistula" value="Fistula" @if(!empty($hasil_data->anus_fistula)) checked @endif > Fistula
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->anus_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->anus_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->anus_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->anus_tidak ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->anus_fistula))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->anus_fistula ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="anus_extro" value="Extrofia ciosca" @if(!empty($hasil_data->anus_extro)) checked @endif > Extrofia ciosca
                <input type="checkbox" class="custom-control" name="anus_ruam" value="Ruam" @if(!empty($hasil_data->anus_ruam)) checked @endif > Ruam
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->anus_extro))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->anus_extro ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->anus_ruam))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->anus_ruam ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            EKSTREMITAS ATAS :
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="ekstremitas_atas_normal" value="Bentuk normal" @if(!empty($hasil_data->ekstremitas_atas_normal)) checked @endif > Bentuk normal
                <input type="checkbox" class="custom-control" name="ekstremitas_atas_syndaktil" value="Syndaktill" @if(!empty($hasil_data->ekstremitas_atas_syndaktil)) checked @endif > Syndaktill
                <input type="checkbox" class="custom-control" name="ekstremitas_atas_polidaktil" value="Polidaktill" @if(!empty($hasil_data->ekstremitas_atas_polidaktil)) checked @endif > Polidaktill
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_atas_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_atas_normal ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_atas_syndaktil))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_atas_syndaktil ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_atas_polidaktil))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_atas_polidaktil ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="ekstremitas_atas_fraktur" value="Fraktur" @if(!empty($hasil_data->ekstremitas_atas_fraktur)) checked @endif > Fraktur
                <input type="checkbox" class="custom-control" name="ekstremitas_atas_parese" value="Parese" @if(!empty($hasil_data->ekstremitas_atas_parese)) checked @endif > Parese
                <input type="checkbox" class="custom-control" name="ekstremitas_atas_paralise" value="Paralise spestik" @if(!empty($hasil_data->ekstremitas_atas_paralise)) checked @endif > Paralise spestik
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_atas_fraktur))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_atas_fraktur ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_atas_parese))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_atas_parese ?? ''}}@endif</span>

            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_atas_paralise))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_atas_paralise ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            EKSTREMITAS BAWAH :
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="ekstremitas_bawah_normal" value="Normal" @if(!empty($hasil_data->ekstremitas_bawah_normal)) checked @endif > Normal
                <input type="checkbox" class="custom-control" name="ekstremitas_bawah_dtev" value="Dtev" @if(!empty($hasil_data->ekstremitas_bawah_dtev)) checked @endif > Dtev
                <input type="checkbox" class="custom-control" name="ekstremitas_bawah_fraktur" value="Fraktur" @if(!empty($hasil_data->ekstremitas_bawah_fraktur)) checked @endif > Fraktur
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_bawah_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_bawah_normal ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_bawah_dtev))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_bawah_dtev ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_bawah_fraktur))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_bawah_fraktur ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
        </td>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container"><input type="checkbox" class="custom-control" name="ekstremitas_bawah_spastik" value="Spastik" @if(!empty($hasil_data->ekstremitas_bawah_spastik)) checked @endif > Spastik
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->ekstremitas_bawah_spastik))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->ekstremitas_bawah_spastik ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    </table>
<br>

<div style="margin: 20px 0;" class="space">
</div>
<pagebreak />
{{-- page 3 --}}
<br><br><br>

<table class="" style="width:100%; border:1px solid black;">
    <tr>
        <td colspan="3" class="bright bbtm text-center">ANAMNESIS</td>
        <td colspan="3" class="text-center bright bbtm">PEMERIKSAAN FISIS</td>
        <td colspan="3" class="text-center bbtm">INTRUKSI TERAPI / TINDAKAN</td>
    </tr>
    <tr>
        <td colspan="3" rowspan="17" class="bright"><div class="medify-form-genv4-input-container"><textarea class="form-control" rows="10" name="anamnesis_long">{{ $hasil_data->anamnesis_long ?? ''  }}</textarea>
        </div>
    <span class="medify-form-genv4-view-container">{{ $hasil_data->anamnesis_long ?? '' }}</td>
        <td colspan="3" class="bright">KULIT :</td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="kulit_normal" value="Normal" @if(!empty($hasil_data->kulit_normal)) checked @endif > Normal
                <input type="checkbox" class="custom-control" name="kulit_keriput" value="Keriput" @if(!empty($hasil_data->kulit_keriput)) checked @endif > Keriput
                <input type="checkbox" class="custom-control" name="kulit_edema" value="Edema" @if(!empty($hasil_data->kulit_edema)) checked @endif > Edema
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_normal))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_normal ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_keriput))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_keriput ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_edema))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_edema ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="kulit_vernix" value="Vernix casseose" @if(!empty($hasil_data->kulit_vernix)) checked @endif > Vernix casseose
                <input type="checkbox" class="custom-control" name="kulit_mongol" value="Mongolion spot" @if(!empty($hasil_data->kulit_mongol)) checked @endif > Mongolion spot
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_vernix))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_vernix ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_mongol))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_mongol ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="kulit_hemangium" value="Hemangium" @if(!empty($hasil_data->kulit_hemangium)) checked @endif > Hemangium
                <input type="checkbox" class="custom-control" name="kulit_sklerema" value="Sklerema" @if(!empty($hasil_data->kulit_sklerema)) checked @endif > Sklerema
                <input type="checkbox" class="custom-control" name="kulit_nekrosis" value="Nekrosis" @if(!empty($hasil_data->kulit_nekrosis)) checked @endif > Nekrosis
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_hemangium))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_hemangium ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_sklerema))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_sklerema ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_nekrosis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_nekrosis ?? ''}}@endif</span>
        </td>
        <td colspan="3" ></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="kulit_piodermi" value="Piodermi" @if(!empty($hasil_data->kulit_piodermi)) checked @endif > Piodermi
                <input type="checkbox" class="custom-control" name="kulit_bulla" value="Bulla" @if(!empty($hasil_data->kulit_bulla)) checked @endif > Bulla
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_piodermi))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_piodermi ?? ''}}@endif</span>

            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->kulit_bulla))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->kulit_bulla ?? ''}}@endif</span>
        </td>
        <td colspan="3" ></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            Akral :
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="akral_hangat" value="Hangat" @if(!empty($hasil_data->akral_hangat)) checked @endif > Hangat
                <input type="checkbox" class="custom-control" name="akral_dingin" value="Dingin" @if(!empty($hasil_data->akral_dingin)) checked @endif > Dingin
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->akral_hangat))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->akral_hangat ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->akral_dingin))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->akral_dingin ?? ''}}@endif</span>
        </td>
        <td colspan="3" ></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            Warna kulit :
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="warna_pink" value="Pink" @if(!empty($hasil_data->warna_pink)) checked @endif > Pink
                <input type="checkbox" class="custom-control" name="warna_ikterus" value="Ikterus" @if(!empty($hasil_data->warna_ikterus)) checked @endif > Ikterus
                <input type="checkbox" class="custom-control" name="warna_cyanosis" value="Cyanosis" @if(!empty($hasil_data->warna_cyanosis)) checked @endif > Cyanosis
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->warna_pink))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->warna_pink ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->warna_ikterus))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->warna_ikterus ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->warna_cyanosis))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->warna_cyanosis ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="bright">
            Mulai timbulnya ikterus : hari ke 
            <div class="medify-form-genv4-input-container"><input type="text" class="form-control" name="mulai_timbul_hari_ikterus" value="{{ $hasil_data->mulai_timbul_hari_ikterus ?? '' }}" >
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->mulai_timbul_hari_ikterus))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->mulai_timbul_hari_ikterus ?? ''}}@endif</span>
        </td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="3" class="text-center bright">
            REFLEK
        </td>
        <td colspan="3" class=""></td>
    </tr>
    <tr>
        <td colspan="1">
            Sucking reflek
        </td>
        <td colspan="2" class="bright">:
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="sucking_ada" value="Ada" @if(!empty($hasil_data->sucking_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="sucking_tidak" value="Tidak" @if(!empty($hasil_data->sucking_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sucking_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sucking_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->sucking_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->sucking_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3" class=""></td>
    </tr>
    <tr>
        <td colspan="1">
            Rooting reflek
        </td>
        <td colspan="2" class="bright">:
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="rooting_ada" value="Ada" @if(!empty($hasil_data->rooting_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="rooting_tidak" value="Tidak" @if(!empty($hasil_data->rooting_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rooting_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rooting_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->rooting_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->rooting_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3" class=""></td>
    </tr>
    <tr>
        <td colspan="1">
            Moro reflek
        </td>
        <td colspan="2" class="bright">:
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="moro_ada" value="Ada" @if(!empty($hasil_data->moro_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="moro_tidak" value="Tidak" @if(!empty($hasil_data->moro_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->moro_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->moro_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->moro_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->moro_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3" class=""></td>
    </tr>
    <tr>
        <td colspan="1">
            Tonic reflek
        </td>
        <td colspan="2" class="bright"> :
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="tonic_ada" value="Ada" @if(!empty($hasil_data->tonic_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="tonic_tidak" value="Tidak" @if(!empty($hasil_data->tonic_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonic_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonic_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->tonic_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->tonic_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3" class=""></td>
    </tr>
    <tr>
        <td colspan="1">
            Palmar reflek
        </td>
        <td colspan="2" class="bright">:
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="palmar_ada" value="Ada" @if(!empty($hasil_data->palmar_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="palmar_tidak" value="Tidak" @if(!empty($hasil_data->palmar_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->palmar_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->palmar_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->palmar_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->palmar_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3" class=""></td>
    </tr>
    <tr>
        <td colspan="1">
            Swalowwing reflek
        </td>
        <td colspan="2" class="bright">:
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="swalowwing_ada" value="Ada" @if(!empty($hasil_data->swalowwing_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="swalowwing_tidak" value="Tidak" @if(!empty($hasil_data->swalowwing_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->swalowwing_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->swalowwing_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->swalowwing_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->swalowwing_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3" class=""></td>
    </tr>
    <tr>
        <td colspan="1">
            Babinski reflek
        </td>
        <td colspan="2" class="bright">:
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="babinski_ada" value="Ada" @if(!empty($hasil_data->babinski_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="babinski_tidak" value="Tidak" @if(!empty($hasil_data->babinski_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->babinski_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->babinski_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->babinski_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->babinski_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3" class=""></td>
    </tr>
    <tr>
        <td colspan="1">
            Piantar reflek
        </td>
        <td colspan="2" class="bright">:
            <div class="medify-form-genv4-input-container">
                <input type="checkbox" class="custom-control" name="piantar_ada" value="Ada" @if(!empty($hasil_data->piantar_ada)) checked @endif > Ada
                <input type="checkbox" class="custom-control" name="piantar_tidak" value="Tidak" @if(!empty($hasil_data->piantar_tidak)) checked @endif > Tidak
            </div>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->piantar_ada))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->piantar_ada ?? ''}}@endif</span>
            <span class="medify-form-genv4-view-container">@if(!empty($hasil_data->piantar_tidak))<span style='font-family:calibri'>&#x2714;</span>{{ $hasil_data->piantar_tidak ?? ''}}@endif</span>
        </td>
        <td colspan="3" class=""></td>
    </tr>
    <tr>
        <td colspan="9" class="btop bbtm">DIAGNOSIS KERJA / DIAGNOSIS BANDING</td>
    </tr>
    <tr>
        <td colspan="9">
            <div class="medify-form-genv4-input-container"> <textarea class="form-control" rows="4" name="diagnosis_kerja_banding">{{ $hasil_data->diagnosis_kerja_banding ?? '' }}</textarea>
            </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->diagnosis_kerja_banding ?? ''}}</span>
        </td>
    </tr>
    {{-- stop here --}}
    <tr>
        <td colspan="9" class="btop">
            HASIL PEMERIKSAAN PENUNJANG
        </td>
    </tr>
    <tr>
        <td colspan="9">
           1. Laboratorium
        </td>
    </tr>
    <tr>
        <td colspan="9">
            <div class="medify-form-genv4-input-container">  <textarea class="form-control" rows="4" name="hasil_penunjang_lab">{{ $hasil_data->hasil_penunjang_lab ?? '' }}</textarea>
            </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->hasil_penunjang_lab ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="9">
           2. X-Ray
        </td>
    </tr>
    <tr>
        <td colspan="9">
            <div class="medify-form-genv4-input-container"> <textarea class="form-control" rows="4" name="hasil_penunjang_xray">{{ $hasil_data->hasil_penunjang_xray ?? '' }}</textarea>
            </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->hasil_penunjang_xray ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="9">
           3. USG
        </td>
    </tr>
    <tr>
        <td colspan="9">
            <div class="medify-form-genv4-input-container"> <textarea class="form-control" rows="4" name="hasil_penunjang_usg">{{ $hasil_data->hasil_penunjang_usg ?? '' }}</textarea>
            </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->hasil_penunjang_usg ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="9" class="btop">
           KONSULTASI
        </td>
    </tr>
    <tr>
        <td colspan="9" class="bbtm">
            <div class="medify-form-genv4-input-container"> <textarea class="form-control" rows="4" name="konsultasi">{{ $hasil_data->konsultasi ?? '' }}</textarea>
            </div>
            <span class="medify-form-genv4-view-container">{{ $hasil_data->konsultasi ?? ''}}</span>
        </td>
    </tr>
    <tr>
        <td colspan="5" class="text-center">
            <span style="white-space: nowrap; display: inline-block;"><div class="medify-form-genv4-input-container">Tanggal
                <input type="date" class="" name="tanggal_dokter_pemeriksa" value="{{ $hasil_data->tanggal_dokter_pemeriksa ?? '' }}"> 
                    Jam <input type="text" class=" time" name="time_dokter_pemeriksa"  value="{{ $hasil_data->time_dokter_pemeriksa ?? '' }}">
                </div>
            <span class="medify-form-genv4-view-container">Tanggal {{ $hasil_data->tanggal_dokter_pemeriksa ?? ''}} Jam {{ $hasil_data->time_dokter_pemeriksa ?? '' }}</span></span>
        </td>
        <td colspan="4" class=" text-center">
           <div class="medify-form-genv4-input-container"> Tanggal<input type="date" class="" name="tanggal_dokter_dpjp" value="{{ $hasil_data->tanggal_dokter_dpjp ?? '' }}">  Jam <input type="text" class=" time" name="time_dokter_dpjp" value="{{ $hasil_data->time_dokter_dpjp ?? '' }}"></div>
           <span class="medify-form-genv4-view-container">Tanggal {{ $hasil_data->tanggal_dokter_dpjp ?? ''}} Jam {{ $hasil_data->time_dokter_dpjp ?? '' }}</span>
        
        </td>
    </tr>
    <tr>
        <td colspan="5" class=" text-center">
           Nama dan Tanda Tangan Dokter Pemeriksa
        </td>
        <td colspan="4" class=" text-center">
           Nama dan Tanda Tangan DPJP
        </td>
    </tr>
    <tr>
        <td colspan="5" class=" text-center">
           @if(!empty($asesmen_get->created_by))
					@php
						$ttd = \App\User::find($asesmen_get->created_by)->ttd ?? null;
					@endphp
					@if(!empty($ttd))
						<br><img src="{{ url('/' . $ttd) }}" alt="" width="90" height="55"><br>

					@else
						<br><br><br>
						........................................................
					@endif
				@endif 
        </td>
        <td colspan="4" class=" text-center">
            
        </td>
    </tr>
    <tr>
        <td colspan="5" class=" text-center">
            {{$hasil->creator->name}}
        </td>
        <td colspan="4" class=" text-center">
            {{$hasil->kasus->admin->user->name}}
        </td>
    </tr>
</table>
