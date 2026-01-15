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
      footer: page-footer;
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
    .border, .border-left, .border-right, .border-top, .border-bottom {
        border-color: #000!important;
    }
    .filled {
        background-color: gray;
    }
    .c-circle {
        display: inline-block;
        border: 1px solid #000;
        padding: 2px 4px;
        border-radius: 999rem;
    }
    .c-circle-hide {
        border: none;
    }
    .medify-form-genv4-input-container input[type="text"] {
        padding: 1px 2px;
    }
    .vertical-text {
        writing-mode: vertical-lr; 
        transform: rotate(180deg);
    }
    .rotate-vertical {
        position: absolute;
        top: 50%;
        left: 50%;
        -moz-transform: translateX(-50%) translateY(-50%) rotate(-90deg);
        -webkit-transform: translateX(-50%) translateY(-50%) rotate(-90deg);
        transform:  translateX(-50%) translateY(-50%) rotate(-90deg);
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
<htmlpagefooter name="page-footer">
    <div class="page-footer-content">
        <table style="width:100%">
            <tr>
                <td style="width: 20%;" class=" position-relative text-center" colspan="1" rowspan="1">
                    <span>RSJM / Revisi 02 / 10.2022</span>
                </td>
                <td style="width: 70%;" class=" position-relative" colspan="1" rowspan="1"></td>
            </tr>
        </table>
    </div>
</htmlpagefooter>
@endif
<table style="width:100%" class="border-left border-right border-top">
    <tr>
        <td width="70%" class=" position-relative" colspan="1" rowspan="5">
            <img style="max-width: 100%;object-fit:contain;" src="{{url('')}}/{{ config('app.kop_lg') }}" height="90">
        </td>
        <td width="8%" class=" position-relative" colspan="1" rowspan="1"></td>
        <td width="14%" class=" position-relative" colspan="1" rowspan="1"></td>
        <td width="8%" class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative text-center border" colspan="1" rowspan="1">
            <span>
                RM 12.3
            </span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
        <td class=" position-relative" colspan="1" rowspan="1"></td>
    </tr>
</table>
<table style="width:100%" class="border-left border-right border-top">
    <tr>
        <td width="65%" class=" position-relative text-center border-right" colspan="2" rowspan="4">
            <h5>ASESMEN KESEHATAN GIGI DAN MULUT</h5>
        </td>
        <td style="width: 12%;" class=" position-relative" colspan="1" rowspan="1">
            <span>No RM</span>
        </td>
        <td style="width: 1%;" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{$kasus->pasien->no_rm}}</span>
        </td>
    </tr>
    <tr>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>Nama :</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td class=" position-relative" colspan="1" rowspan="1">
            <span>{{$kasus->pasien->name}}</span>
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
            <span>{{(isset($kasus->pasien->date_of_birth) ? indonesian_date($kasus->pasien->date_of_birth) : '')}}</span>
            <span>/</span>
            <span>{{$kasus->identitas->age}}</span>
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
                @if (optional($kasus->pasien)->jenis_kelamin_lp === 'L')
                    <span class="c-circle">Laki-laki</span>
                    <span>/ Perempuan</span>
                @else
                    <span>Laki-laki /</span>
                    <span class="c-circle">Perempuan</span>
                @endif
            </span>
        </td>
    </tr>
</table>
<div style="padding: 20px;" class="border">
    <table style="width:100%">
        <tr>
            <td class=" position-relative" colspan="14" rowspan="1">
                <h6>&#8544;.&emsp;PEMERIKSAAN FISIK REGIONAL (Diisi Oleh Perawat)</h6>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="7" rowspan="1">
                <h6>&emsp;&emsp;E.O KEPALA LEHER</h6>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="5" rowspan="1">
                <h6>KELENJAR LYMPHE :</h6>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>Norm</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>Abnorm</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="5" rowspan="1">
                <span>Submandibularis</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Kepala :</span>
            </td>
            <td width="10%" class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="k1" value="{{$hasil_data->k1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->k1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td width="10%" class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="k2" value="{{$hasil_data->k2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->k2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td width="10%" class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="k3" value="{{$hasil_data->k3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->k3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="6" rowspan="2">
                <div class="form-group medify-form-genv4-input-container">
                    <label>Sin I :</label>
                    <textarea name="sin_i" class="form-control">{{$hasil_data->sin_i ?? '' ?? ''}}</textarea>
                </div>
                <div class="form-group medify-form-genv4-view-container">
                    <label>Sin I :</label> {{$hasil_data->sin_i ?? '' ?? ''}}
                </div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Ld. Thyroid :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ld1" value="{{$hasil_data->ld1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ld1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ld2" value="{{$hasil_data->ld2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ld2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ld3" value="{{$hasil_data->ld3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ld3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;A. Carotis :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ac1" value="{{$hasil_data->ac1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ac1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ac2" value="{{$hasil_data->ac2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ac2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ac3" value="{{$hasil_data->ac3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ac3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="6" rowspan="2">
                <div class="form-group medify-form-genv4-input-container">
                    <label>Sublingualis :</label>
                    <textarea name="sublingualis" class="form-control">{{$hasil_data->sublingualis ?? '' ?? ''}}</textarea>
                </div>
                <div class="form-group medify-form-genv4-view-container">
                    <label>Sublingualis :</label> {{$hasil_data->sublingualis ?? '' ?? ''}}
                </div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;V. Jugularis :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="vj1" value="{{$hasil_data->vj1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->vj1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="vj2" value="{{$hasil_data->vj2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->vj2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="vj3" value="{{$hasil_data->vj3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->vj3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Wajah-Leher :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="wl1" value="{{$hasil_data->wl1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->wl1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="wl2" value="{{$hasil_data->wl2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->wl2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="wl3" value="{{$hasil_data->wl3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->wl3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="6" rowspan="2">
                <div class="form-group medify-form-genv4-input-container">
                    <label>Cervicalis :</label>
                    <textarea name="cervicalis"  class="form-control">{{$hasil_data->cervicalis ?? '' ?? ''}}</textarea>
                </div>
                <div class="form-group medify-form-genv4-view-container">
                    <label>Cervicalis :</label> {{$hasil_data->cervicalis ?? '' ?? ''}}
                </div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="9" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="lainnya" value="{{$hasil_data->lainnya ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->lainnya ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="25" rowspan="1">
                <h6>&nbsp;&nbsp;&emsp;I.O RONGGA MULUT (Secara Global)</h6>
            </td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>Norm</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>Abnorm</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="5" rowspan="1">
                <span>GINGIVA</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Bibir :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="b1" value="{{$hasil_data->b1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->b1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="b2" value="{{$hasil_data->b2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->b2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="b3" value="{{$hasil_data->b3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->b3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td width="9%" class=" position-relative" colspan="2" rowspan="1">
                <span>Maxilla :</span>
            </td>
            <td width="17%" class=" position-relative" colspan="4" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="mx" value="{{$hasil_data->mx ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mx ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Buccal Mucosa :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="bm1" value="{{$hasil_data->bm1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->bm1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="bm2" value="{{$hasil_data->bm2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->bm2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="bm3" value="{{$hasil_data->bm3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->bm3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="2" rowspan="1">
                <span>R. Anterior :</span>
            </td>
            <td class=" position-relative" colspan="4" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ra1" value="{{$hasil_data->ra1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ra1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Lidah :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="l1" value="{{$hasil_data->l1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->l1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="l2" value="{{$hasil_data->l2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->l2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="l3" value="{{$hasil_data->l3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->l3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="2" rowspan="1">
                <span>R. Posterior :</span>
            </td>
            <td class=" position-relative" colspan="4" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="rp1" value="{{$hasil_data->rp1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->rp1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Dasar Mulut :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="dm1" value="{{$hasil_data->dm1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dm1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="dm2" value="{{$hasil_data->dm2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dm2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="dm3" value="{{$hasil_data->dm3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dm3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="2" rowspan="1">
                <span>Mandibulla :</span>
            </td>
            <td class=" position-relative" colspan="4" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ma" value="{{$hasil_data->ma ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ma ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Palat Durum :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="pd1" value="{{$hasil_data->pd1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->pd1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="pd2" value="{{$hasil_data->pd2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->pd2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="pm3" value="{{$hasil_data->pm3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->pm3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="2" rowspan="1">
                <span>R. Anterior :</span>
            </td>
            <td class=" position-relative" colspan="4" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ra2" value="{{$hasil_data->ra2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ra2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Palat Molle :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="pm1" value="{{$hasil_data->pm1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->pm1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="pm2" value="{{$hasil_data->pm2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->pm2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="pm3" value="{{$hasil_data->pm3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->pm3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="2" rowspan="1">
                <span>R. Posterior :</span>
            </td>
            <td class=" position-relative" colspan="4" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="rp2" value="{{$hasil_data->rp2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->rp2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Tonsil :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="to1" value="{{$hasil_data->to1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->to1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="to2" value="{{$hasil_data->to2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->to2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="to3" value="{{$hasil_data->to3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->to3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Pharynnx :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ph1" value="{{$hasil_data->ph1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ph1 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ph2" value="{{$hasil_data->ph2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ph2 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <input type="text" class="form-control" name="ph3" value="{{$hasil_data->ph3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ph3 ?? '' ?? ''}}</div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&nbsp;&nbsp;&emsp;Calculuc :</span>
            </td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>Maxilla</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&#45;Anterior</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="8" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <label>:Regio</label>
                    <input type="text" class="form-control" name="regio_1" value="{{$hasil_data->regio_1 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container">
                    <label>:Regio</label> {{$hasil_data->regio_1 ?? '' ?? ''}}
                </div>
            </td>
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
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&#45;Posterior</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="8" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <label>:Regio</label>
                    <input type="text" class="form-control" name="regio_2" value="{{$hasil_data->regio_2 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container">
                    <label>:Regio</label> {{$hasil_data->regio_2 ?? '' ?? ''}}
                </div>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>Mandubulla</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&#45;Anterior</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="8" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <label>:Regio</label>
                    <input type="text" class="form-control" name="regio_3" value="{{$hasil_data->regio_3 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container">
                    <label>:Regio</label> {{$hasil_data->regio_3 ?? '' ?? ''}}
                </div>
            </td>
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
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="3" rowspan="1">
                <span>&#45;Posterior</span>
            </td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="8" rowspan="1">
                <div class="form-group medify-form-genv4-input-container">
                    <label>:Regio</label>
                    <input type="text" class="form-control" name="regio_4" value="{{$hasil_data->regio_4 ?? '' ?? ''}}">
                </div>
                <div class="form-group medify-form-genv4-view-container">
                    <label>:Regio</label> {{$hasil_data->regio_4 ?? '' ?? ''}}
                </div>
            </td>
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
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
            <td class=" position-relative" colspan="1" rowspan="1"></td>
        </tr>
    </table>
    <table style="width:100%">
        <tr>
            <td class=" position-relative" colspan="1" rowspan="1">
                <h6>II. STATUS LOKALIS - INTRA ORAL (Secara terperinci) (Diisi Oleh Dokter Gigi)</h6>
            </td>
        </tr>
    </table>
    <div style="margin-left: 20px;">
        <table style="width:100%" class="c-table--bordered">
            <tr>
                <td class=" position-relative border" colspan="17" rowspan="1">
                    <h6>PEMERIKSAAN GIGI-GIGI:</h6>
                </td>
            </tr>
            <tr>
                <td class=" position-relative text-center" colspan="1" rowspan="3">
                    <span class="rotate-vertical">Tanggal</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="3">
                    <span class="rotate-vertical">Gigi-gigi</span>
                </td>
                <td class=" position-relative" colspan="9" rowspan="1">
                    <h6>PEMERIKSAAN CARIES/JARPULPOPERIA</h6>
                </td>
                <td class=" position-relative" colspan="6" rowspan="1">
                    <h6>PEMERIKSAAN KONDISI PORODONTIUM</h6>
                </td>
            </tr>
            <tr>
                <td width="10%" class=" position-relative text-center" colspan="3" rowspan="1">
                    <span>Macam Caries</span>
                </td>
                <td width="18%" class=" position-relative text-center" colspan="4" rowspan="1">
                    <span>Kondisi J. Pulpoperiappikal</span>
                </td>
                <td width="10%" class=" position-relative text-center" colspan="2" rowspan="1">
                    <span>Permukaan Gigi</span>
                </td>
                <td width="30%" class=" position-relative text-center" colspan="4" rowspan="1">
                    <span>Gingiva</span>
                </td>
                <td width="12%" class=" position-relative text-center" colspan="2" rowspan="1">
                    <span>Periode Membrane</span>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;height:120px;" class=" position-relative text-center" colspan="3" rowspan="1">
                    <span class="rotate-vertical">Lokasi caries dan <br> kedalaman (Sup, Med, Prof)</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Tes Sonde</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Tes Dingin</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Perkusi</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Drug</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Sordes</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Calculus</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Kemerahan</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Oedematcus</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Mudah Berdarah</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Ging Recession</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Mobilitas gigi</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span class="rotate-vertical">Ginggiva Pocket</span>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_1" value="{{$hasil_data->tanggal_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_1" value="{{$hasil_data->gg_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_3"> @php $hasil_data_temp = $hasil_data->mc_3 ?? '' @endphp
                            <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_3 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ts_1" value="{{$hasil_data->ts_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ts_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="td_1" value="{{$hasil_data->td_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->td_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="per_1" value="{{$hasil_data->per_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->per_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="dr_1" value="{{$hasil_data->dr_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dr_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="so_1" value="{{$hasil_data->so_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->so_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ca_1" value="{{$hasil_data->ca_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ca_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ke_1" value="{{$hasil_data->ke_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ke_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="oe_1" value="{{$hasil_data->oe_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->oe_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mb_1" value="{{$hasil_data->mb_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mb_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gr_1" value="{{$hasil_data->gr_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gr_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mg_1" value="{{$hasil_data->mg_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mg_1 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gp_1" value="{{$hasil_data->gp_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gp_1 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_2" value="{{$hasil_data->tanggal_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_2" value="{{$hasil_data->gg_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_4"> @php $hasil_data_temp = $hasil_data->mc_4 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_4 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ts_2" value="{{$hasil_data->ts_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ts_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="td_2" value="{{$hasil_data->td_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->td_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="per_2" value="{{$hasil_data->per_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->per_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="dr_2" value="{{$hasil_data->dr_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dr_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="so_2" value="{{$hasil_data->so_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->so_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ca_2" value="{{$hasil_data->ca_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ca_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ke_2" value="{{$hasil_data->ke_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ke_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="oe_2" value="{{$hasil_data->oe_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->oe_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mb_2" value="{{$hasil_data->mb_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mb_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gr_2" value="{{$hasil_data->gr_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gr_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mg_2" value="{{$hasil_data->mg_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mg_2 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gp_2" value="{{$hasil_data->gp_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gp_2 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_3" value="{{$hasil_data->tanggal_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_3" value="{{$hasil_data->gg_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_5"> @php $hasil_data_temp = $hasil_data->mc_5 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_5 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ts_3" value="{{$hasil_data->ts_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ts_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="td_3" value="{{$hasil_data->td_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->td_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="per_3" value="{{$hasil_data->per_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->per_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="dr_3" value="{{$hasil_data->dr_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dr_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="so_3" value="{{$hasil_data->so_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->so_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ca_3" value="{{$hasil_data->ca_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ca_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ke_3" value="{{$hasil_data->ke_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ke_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="oe_3" value="{{$hasil_data->oe_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->oe_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mb_3" value="{{$hasil_data->mb_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mb_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gr_3" value="{{$hasil_data->gr_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gr_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mg_3" value="{{$hasil_data->mg_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mg_3 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gp_3" value="{{$hasil_data->gp_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gp_3 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_4" value="{{$hasil_data->tanggal_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_4" value="{{$hasil_data->gg_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_6"> @php $hasil_data_temp = $hasil_data->mc_6 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_6 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ts_4" value="{{$hasil_data->ts_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ts_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="td_4" value="{{$hasil_data->td_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->td_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="per_4" value="{{$hasil_data->per_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->per_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="dr_4" value="{{$hasil_data->dr_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dr_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="so_4" value="{{$hasil_data->so_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->so_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ca_4" value="{{$hasil_data->ca_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ca_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ke_4" value="{{$hasil_data->ke_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ke_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="oe_4" value="{{$hasil_data->oe_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->oe_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mb_4" value="{{$hasil_data->mb_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mb_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gr_4" value="{{$hasil_data->gr_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gr_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mg_4" value="{{$hasil_data->mg_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mg_4 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gp_4" value="{{$hasil_data->gp_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gp_4 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_5" value="{{$hasil_data->tanggal_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_5" value="{{$hasil_data->gg_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_12"> @php $hasil_data_temp = $hasil_data->mc_12 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_12 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ts_5" value="{{$hasil_data->ts_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ts_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="td_5" value="{{$hasil_data->td_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->td_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="per_5" value="{{$hasil_data->per_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->per_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="dr_5" value="{{$hasil_data->dr_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dr_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="so_5" value="{{$hasil_data->so_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->so_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ca_5" value="{{$hasil_data->ca_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ca_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ke_5" value="{{$hasil_data->ke_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ke_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="oe_5" value="{{$hasil_data->oe_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->oe_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mb_5" value="{{$hasil_data->mb_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mb_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gr_5" value="{{$hasil_data->gr_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gr_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mg_5" value="{{$hasil_data->mg_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mg_5 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gp_5" value="{{$hasil_data->gp_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gp_5 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_6" value="{{$hasil_data->tanggal_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_6" value="{{$hasil_data->gg_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_13"> @php $hasil_data_temp = $hasil_data->mc_13 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_13 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ts_6" value="{{$hasil_data->ts_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ts_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="td_6" value="{{$hasil_data->td_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->td_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="per_6" value="{{$hasil_data->per_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->per_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="dr_6" value="{{$hasil_data->dr_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dr_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="so_6" value="{{$hasil_data->so_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->so_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ca_6" value="{{$hasil_data->ca_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ca_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ke_6" value="{{$hasil_data->ke_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ke_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="oe_6" value="{{$hasil_data->oe_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->oe_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mb_6" value="{{$hasil_data->mb_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mb_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gr_6" value="{{$hasil_data->gr_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gr_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mg_6" value="{{$hasil_data->mg_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mg_6 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gp_6" value="{{$hasil_data->gp_6 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gp_6 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_7" value="{{$hasil_data->tanggal_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_7" value="{{$hasil_data->gg_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_14"> @php $hasil_data_temp = $hasil_data->mc_14 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_14 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ts_7" value="{{$hasil_data->ts_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ts_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="td_7" value="{{$hasil_data->td_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->td_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="per_7" value="{{$hasil_data->per_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->per_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="dr_7" value="{{$hasil_data->dr_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dr_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="so_7" value="{{$hasil_data->so_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->so_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ca_7" value="{{$hasil_data->ca_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ca_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ke_7" value="{{$hasil_data->ke_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ke_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="oe_7" value="{{$hasil_data->oe_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->oe_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mb_7" value="{{$hasil_data->mb_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mb_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gr_7" value="{{$hasil_data->gr_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gr_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mg_7" value="{{$hasil_data->mg_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mg_7 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gp_7" value="{{$hasil_data->gp_7 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gp_7 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_8" value="{{$hasil_data->tanggal_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_8" value="{{$hasil_data->gg_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_15"> @php $hasil_data_temp = $hasil_data->mc_15 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_15 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ts_8" value="{{$hasil_data->ts_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ts_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="td_8" value="{{$hasil_data->td_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->td_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="per_8" value="{{$hasil_data->per_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->per_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="dr_8" value="{{$hasil_data->dr_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dr_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="so_8" value="{{$hasil_data->so_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->so_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ca_8" value="{{$hasil_data->ca_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ca_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ke_8" value="{{$hasil_data->ke_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ke_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="oe_8" value="{{$hasil_data->oe_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->oe_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mb_8" value="{{$hasil_data->mb_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mb_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gr_8" value="{{$hasil_data->gr_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gr_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mg_8" value="{{$hasil_data->mg_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mg_8 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gp_8" value="{{$hasil_data->gp_8 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gp_8 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_9" value="{{$hasil_data->tanggal_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_9" value="{{$hasil_data->gg_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_16"> @php $hasil_data_temp = $hasil_data->mc_16 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_16 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ts_9" value="{{$hasil_data->ts_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ts_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="td_9" value="{{$hasil_data->td_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->td_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="per_9" value="{{$hasil_data->per_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->per_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="dr_9" value="{{$hasil_data->dr_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dr_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="so_9" value="{{$hasil_data->so_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->so_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ca_9" value="{{$hasil_data->ca_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ca_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ke_9" value="{{$hasil_data->ke_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ke_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="oe_9" value="{{$hasil_data->oe_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->oe_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mb_9" value="{{$hasil_data->mb_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mb_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gr_9" value="{{$hasil_data->gr_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gr_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mg_9" value="{{$hasil_data->mg_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mg_9 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gp_9" value="{{$hasil_data->gp_9 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gp_9 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_10" value="{{$hasil_data->tanggal_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_10" value="{{$hasil_data->gg_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_2"> @php $hasil_data_temp = $hasil_data->mc_2 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_2 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ts_10" value="{{$hasil_data->ts_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ts_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="td_10" value="{{$hasil_data->td_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->td_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="per_10" value="{{$hasil_data->per_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->per_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="dr_10" value="{{$hasil_data->dr_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->dr_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="so_10" value="{{$hasil_data->so_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->so_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ca_10" value="{{$hasil_data->ca_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ca_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ke_10" value="{{$hasil_data->ke_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ke_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="oe_10" value="{{$hasil_data->oe_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->oe_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mb_10" value="{{$hasil_data->mb_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mb_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gr_10" value="{{$hasil_data->gr_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gr_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="mg_10" value="{{$hasil_data->mg_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->mg_10 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gp_10" value="{{$hasil_data->gp_10 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gp_10 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_11" value="{{$hasil_data->tanggal_11 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_11 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_11" value="{{$hasil_data->gg_11 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_11 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_1"> @php $hasil_data_temp = $hasil_data->mc_1 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_1 ?? ''}}</span>
                </td>
                <td class=" position-relative text-center" colspan="9" rowspan="1">
                    <h6>ERUPSI SEBAGIAN</h6>
                </td>
                <td class=" position-relative text-center" colspan="3" rowspan="1">
                    <h6>IMPAKSI TOTAL</h6>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_12" value="{{$hasil_data->tanggal_12 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_12 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_12" value="{{$hasil_data->gg_12 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_12 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_8"> @php $hasil_data_temp = $hasil_data->mc_8 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_8 ?? ''}}</span>
                </td>
                <td class=" position-relative text-center" colspan="3" rowspan="1">
                    <span>Angulasi (Mesio, disto, horiz, vertic, angular)</span>
                </td>
                <td class=" position-relative text-center" colspan="3" rowspan="1">
                    <span>Cerv. line (diatas/dibawah)</span>
                </td>
                <td class=" position-relative text-center" colspan="3" rowspan="1">
                    <span>Relasi dengan M2 (Rapat, renggang)</span>
                </td>
                <td class=" position-relative text-center" colspan="2" rowspan="1">
                    <span>Angulasi (Vert/Horiz)</span>
                </td>
                <td class=" position-relative text-center" colspan="1" rowspan="1">
                    <span>Lokasi Lab/Ling Buccal</span>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_13" value="{{$hasil_data->tanggal_13 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_13 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_13" value="{{$hasil_data->gg_13 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_13 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_9"> @php $hasil_data_temp = $hasil_data->mc_9 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_9 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="angulasi_a_1"> @php $hasil_data_temp = $hasil_data->angulasi_a_1 ?? '' @endphp 
                            <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Mesio" @if($hasil_data_temp=='Mesio' ) selected @endif>Mesio</option>
                            <option value="Disto" @if($hasil_data_temp=='Disto' ) selected @endif>Disto</option>
                            <option value="Horiz" @if($hasil_data_temp=='Horiz' ) selected @endif>Horiz</option>
                            <option value="Vertic" @if($hasil_data_temp=='Vertic' ) selected @endif>Vertic</option>
                            <option value="Angular" @if($hasil_data_temp=='Angular' ) selected @endif>Angular</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->angulasi_a_1 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="cl_5"> @php $hasil_data_temp = $hasil_data->cl_5 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Diatas" @if($hasil_data_temp=='Diatas' ) selected @endif>Diatas</option>
                            <option value="Dibawah" @if($hasil_data_temp=='Dibawah' ) selected @endif>Dibawah</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->cl_5 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="rdm_1"> @php $hasil_data_temp = $hasil_data->rdm_1 ?? '' @endphp
                            <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Rapat" @if($hasil_data_temp=='Rapat' ) selected @endif>Rapat</option>
                            <option value="Renggang" @if($hasil_data_temp=='Renggang' ) selected @endif>Renggang</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->rdm_1 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="2" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="angulasi_b_1"> @php $hasil_data_temp = $hasil_data->angulasi_b_1 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Vert" @if($hasil_data_temp=='Vert' ) selected @endif>Vert</option>
                            <option value="Horiz" @if($hasil_data_temp=='Horiz' ) selected @endif>Horiz</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->angulasi_b_1 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ll_1" value="{{$hasil_data->ll_1 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ll_1 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_14" value="{{$hasil_data->tanggal_14 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_14 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_14" value="{{$hasil_data->gg_14 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_14 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_10"> @php $hasil_data_temp = $hasil_data->mc_10 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_10 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="angulasi_a_2"> @php $hasil_data_temp = $hasil_data->angulasi_a_2 ?? '' @endphp 
                            <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Mesio" @if($hasil_data_temp=='Mesio' ) selected @endif>Mesio</option>
                            <option value="Disto" @if($hasil_data_temp=='Disto' ) selected @endif>Disto</option>
                            <option value="Horiz" @if($hasil_data_temp=='Horiz' ) selected @endif>Horiz</option>
                            <option value="Vertic" @if($hasil_data_temp=='Vertic' ) selected @endif>Vertic</option>
                            <option value="Angular" @if($hasil_data_temp=='Angular' ) selected @endif>Angular</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->angulasi_a_2 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="cl_4"> @php $hasil_data_temp = $hasil_data->cl_4 ?? '' @endphp
                            <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Diatas" @if($hasil_data_temp=='Diatas' ) selected @endif>Diatas</option>
                            <option value="Dibawah" @if($hasil_data_temp=='Dibawah' ) selected @endif>Dibawah</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->cl_4 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="rdm_2"> @php $hasil_data_temp = $hasil_data->rdm_2 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Rapat" @if($hasil_data_temp=='Rapat' ) selected @endif>Rapat</option>
                            <option value="Renggang" @if($hasil_data_temp=='Renggang' ) selected @endif>Renggang</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->rdm_2 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="2" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="angulasi_b_2"> @php $hasil_data_temp = $hasil_data->angulasi_b_2 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Vert" @if($hasil_data_temp=='Vert' ) selected @endif>Vert</option>
                            <option value="Horiz" @if($hasil_data_temp=='Horiz' ) selected @endif>Horiz</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->angulasi_b_2 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ll_2" value="{{$hasil_data->ll_2 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ll_2 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_15" value="{{$hasil_data->tanggal_15 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_15 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_15" value="{{$hasil_data->gg_15 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_15 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_11"> @php $hasil_data_temp = $hasil_data->mc_11 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_11 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="angulasi_a_3"> @php $hasil_data_temp = $hasil_data->angulasi_a_3 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Mesio" @if($hasil_data_temp=='Mesio' ) selected @endif>Mesio</option>
                            <option value="Disto" @if($hasil_data_temp=='Disto' ) selected @endif>Disto</option>
                            <option value="Horiz" @if($hasil_data_temp=='Horiz' ) selected @endif>Horiz</option>
                            <option value="Vertic" @if($hasil_data_temp=='Vertic' ) selected @endif>Vertic</option>
                            <option value="Angular" @if($hasil_data_temp=='Angular' ) selected @endif>Angular</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->angulasi_a_3 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="cl_3"> @php $hasil_data_temp = $hasil_data->cl_3 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Diatas" @if($hasil_data_temp=='Diatas' ) selected @endif>Diatas</option>
                            <option value="Dibawah" @if($hasil_data_temp=='Dibawah' ) selected @endif>Dibawah</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->cl_3 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="rdm_3"> @php $hasil_data_temp = $hasil_data->rdm_3 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Rapat" @if($hasil_data_temp=='Rapat' ) selected @endif>Rapat</option>
                            <option value="Renggang" @if($hasil_data_temp=='Renggang' ) selected @endif>Renggang</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->rdm_3 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="2" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="angulasi_b_3"> @php $hasil_data_temp = $hasil_data->angulasi_b_3 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Vert" @if($hasil_data_temp=='Vert' ) selected @endif>Vert</option>
                            <option value="Horiz" @if($hasil_data_temp=='Horiz' ) selected @endif>Horiz</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->angulasi_b_3 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ll_3" value="{{$hasil_data->ll_3 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ll_3 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_16" value="{{$hasil_data->tanggal_16 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_16 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_16" value="{{$hasil_data->gg_16 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_16 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_7"> @php $hasil_data_temp = $hasil_data->mc_7 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_7 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="angulasi_a_4"> @php $hasil_data_temp = $hasil_data->angulasi_a_4 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Mesio" @if($hasil_data_temp=='Mesio' ) selected @endif>Mesio</option>
                            <option value="Disto" @if($hasil_data_temp=='Disto' ) selected @endif>Disto</option>
                            <option value="Horiz" @if($hasil_data_temp=='Horiz' ) selected @endif>Horiz</option>
                            <option value="Vertic" @if($hasil_data_temp=='Vertic' ) selected @endif>Vertic</option>
                            <option value="Angular" @if($hasil_data_temp=='Angular' ) selected @endif>Angular</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->angulasi_a_4 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="cl_2"> @php $hasil_data_temp = $hasil_data->cl_2 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Diatas" @if($hasil_data_temp=='Diatas' ) selected @endif>Diatas</option>
                            <option value="Dibawah" @if($hasil_data_temp=='Dibawah' ) selected @endif>Dibawah</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->cl_2 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="rdm_4"> @php $hasil_data_temp = $hasil_data->rdm_4 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Rapat" @if($hasil_data_temp=='Rapat' ) selected @endif>Rapat</option>
                            <option value="Renggang" @if($hasil_data_temp=='Renggang' ) selected @endif>Renggang</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->rdm_4 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="2" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="angulasi_b_4"> @php $hasil_data_temp = $hasil_data->angulasi_b_4 ?? '' @endphp 
                            <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Vert" @if($hasil_data_temp=='Vert' ) selected @endif>Vert</option>
                            <option value="Horiz" @if($hasil_data_temp=='Horiz' ) selected @endif>Horiz</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->angulasi_b_4 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ll_4" value="{{$hasil_data->ll_4 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ll_4 ?? '' ?? ''}}</div>
                </td>
            </tr>
            <tr>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="date" class="form-control" name="tanggal_17" value="{{$hasil_data->tanggal_17 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->tanggal_17 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="gg_17" value="{{$hasil_data->gg_17 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->gg_17 ?? '' ?? ''}}</div>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="mc_17"> @php $hasil_data_temp = $hasil_data->mc_17 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Sup" @if($hasil_data_temp=='Sup' ) selected @endif>Sup</option>
                            <option value="Med" @if($hasil_data_temp=='Med' ) selected @endif>Med</option>
                            <option value="Prof" @if($hasil_data_temp=='Prof' ) selected @endif>Prof</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->mc_17 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="angulasi_a_5"> @php $hasil_data_temp = $hasil_data->angulasi_a_5 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Mesio" @if($hasil_data_temp=='Mesio' ) selected @endif>Mesio</option>
                            <option value="Disto" @if($hasil_data_temp=='Disto' ) selected @endif>Disto</option>
                            <option value="Horiz" @if($hasil_data_temp=='Horiz' ) selected @endif>Horiz</option>
                            <option value="Vertic" @if($hasil_data_temp=='Vertic' ) selected @endif>Vertic</option>
                            <option value="Angular" @if($hasil_data_temp=='Angular' ) selected @endif>Angular</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->angulasi_a_5 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="cl_1"> @php $hasil_data_temp = $hasil_data->cl_1 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Diatas" @if($hasil_data_temp=='Diatas' ) selected @endif>Diatas</option>
                            <option value="Dibawah" @if($hasil_data_temp=='Dibawah' ) selected @endif>Dibawah</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->cl_1 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="3" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="rdm_5"> @php $hasil_data_temp = $hasil_data->rdm_5 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Rapat" @if($hasil_data_temp=='Rapat' ) selected @endif>Rapat</option>
                            <option value="Renggang" @if($hasil_data_temp=='Renggang' ) selected @endif>Renggang</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->rdm_5 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="2" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <select class="form-control " name="angulasi_b_5"> @php $hasil_data_temp = $hasil_data->angulasi_b_5 ?? '' @endphp <option value="" @if($hasil_data_temp=='' ) selected @endif></option>
                            <option value="Vert" @if($hasil_data_temp=='Vert' ) selected @endif>Vert</option>
                            <option value="Horiz" @if($hasil_data_temp=='Horiz' ) selected @endif>Horiz</option>
                        </select>
                    </div>
                    <span class="medify-form-genv4-view-container"> {{$hasil_data->angulasi_b_5 ?? ''}}</span>
                </td>
                <td class=" position-relative" colspan="1" rowspan="1">
                    <div class="form-group medify-form-genv4-input-container">
                        <input type="text" class="form-control" name="ll_5" value="{{$hasil_data->ll_5 ?? '' ?? ''}}">
                    </div>
                    <div class="form-group medify-form-genv4-view-container"> {{$hasil_data->ll_5 ?? '' ?? ''}}</div>
                </td>
            </tr>
        </table>
    </div>
    <br><br>
</div>