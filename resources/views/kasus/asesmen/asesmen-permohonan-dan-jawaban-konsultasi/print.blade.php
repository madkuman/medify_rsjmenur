@extends('layouts.print')

@section('title')
Checklist Keselamatan Pasien di Poli Gigi dan Mulut
@endsection

@section('css')
<style type="text/css">
    @page {
        margin-top: 70px;
        margin-left: 40px;
        margin-bottom: 20px;
        margin-right: 40px;
        header: page-header;
        footer: page-footer;
    }
    @page :first {
        margin-top: 70px;
    }
    body, p {
        font-size: 11.5px;
        font-family: 'Times New Roman', Times, serif;
    }
    h5 {
        font-size: 14px;
    }
    h6 {
        font-size: 12px;
    }
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
        height: 7px;
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
        border-bottom: 1.8px dotted #000!important;
        word-break: break-word;
        display: inline-block;
    }
    .kop-img {
        object-fit: contain;
    }
    .position-relative {
        position: relative;
    }
    .page_break {
        page-break-before: always;
    }
    .p-0 {
        padding: 0
    }
    .overflow-auto {
        overflow: auto;
    }
    .border-x-none {
        border-right: none;
        border-left: none;
    }
    .page-header-content {
        position: fixed;
        right: 0;
        top: 0;
    }
    .kode {
        border: 1px solid #000;
        border-bottom: none;
    }
    .nomor-halaman {
        border: 1px solid #000;
    }
</style>
@endsection
@section('content')
<htmlpageheader name="page-header">
    <div class="page-header-content">
        <div class="kode">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RM 10.k2&nbsp;&nbsp;&nbsp;</div>
        <div class="nomor-halaman">
            &nbsp;&nbsp;&nbsp;<span>Halaman&nbsp;{PAGENO}/{nb}&nbsp;&nbsp;</span>
        </div>
    </div>
</htmlpageheader>
<table style="width:100%" >
   <tr>
      <td width = "60%" class=" position-relative kop" colspan="1" rowspan="5">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/assets/img/kop_menur.png'))) }}" height="103" width="500" />
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
            @if ($hasil_data_temp != '' || $hasil_data_temp != null)
            <span>{{ date('d F Y', strtotime($hasil_data_temp)) }}</span>
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
            <span>{{$space}}{{ $hasil_data->permohonan['kepada'] ?? '' }}</span>
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
            <span>{{ $hasil_data->permohonan['diagnosisUtama'] ?? '' }}</span>
        </td>
        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">
            <span>ICD 10</span>
        </td>
        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $hasil_data->permohonan['diagnosisUtama_icd10'] ?? '' }}</span>
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
            <table style="width:100%">
                <tr>
                    <td style="width:15%" class=" position-relative" colspan="1" rowspan="1">
                        @if ($hasil_data_temp == '0')
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg=='/> Tidak Ada</span>
                        @else
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC'/> Tidak Ada</span>
                        @endif
                    </td>
                    <td style="width:85%" class=" position-relative" colspan="1" rowspan="1">
                        @if ($hasil_data_temp == '1')
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg=='/> Ada</span>
                        @else
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC'/> Ada</span>
                        @endif
                    </td>
                </tr>
            </table>
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
            <span>{{ $hasil_data->permohonan['diagnosisSekunder_icd10'] ?? '' }}</span>
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
        <td style="height:70px;vertical-align:top;" class=" position-relative" colspan="6" rowspan="1">
            @php $hasil_data_temp = $hasil_data->permohonan['tujuan_konsultasi'] ?? '' @endphp
            <span>{{ $hasil_data_temp }}</span>
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
            <span>{{ $hasil_data->permohonan['pengirim'] ?? '' }}</span>
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
            <span>{{ $hasil_data->jawaban['pemeriksaan_ditemukan'] ?? '' }}</span>
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
            <span>{{ $hasil_data->jawaban['diagnosisUtama'] ?? '' }}</span>
        </td>
        <td style="width: 10%" class=" position-relative" colspan="1" rowspan="1">
            <span>ICD 10</span>
        </td>
        <td style="width: 2%" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="width: 30%" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $hasil_data->jawaban['diagnosisUtama_icd10'] ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Diagnosa tambahan / sekunder</span>
        </td>
        <td style="vertical-align: top;" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="vertical-align: top;"  class=" position-relative" colspan="4" rowspan="1">
            @php $hasil_data_temp = $hasil_data->jawaban['diagnosa_sekunder'] ?? '' @endphp
            <table style="width:100%">
                <tr>
                    <td style="width:15%" class=" position-relative" colspan="1" rowspan="1">
                        @if ($hasil_data_temp == '0')
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg=='/> Tidak Ada</span>
                        @else
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC'/> Tidak Ada</span>
                        @endif
                    </td>
                    <td style="width:85%" class=" position-relative" colspan="1" rowspan="1">
                        @if ($hasil_data_temp == '1')
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg=='/> Ada</span>
                        @else
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC'/> Ada</span>
                        @endif
                    </td>
                </tr>
            </table>
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
            <span>{{ $hasil_data->jawaban['diagnosisSekunder_icd10'] ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td style="height: 70px;vertical-align: top;" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Pengobatan yang diberikan</span>
        </td>
        <td style="vertical-align: top;" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="vertical-align: top;" class=" position-relative" colspan="6" rowspan="1">
            <span>{{ $hasil_data->jawaban['pengobatan_yang_diberikan'] ?? '' }}</span>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;" class=" position-relative" colspan="1" rowspan="1">
            <span>{{ $space }}Saran</span>
        </td>
        <td style="vertical-align: top;" class=" position-relative" colspan="1" rowspan="1">
            <span>:</span>
        </td>
        <td style="vertical-align: top;" class=" position-relative" colspan="4" rowspan="1">
            @php $hasil_data_temp = $hasil_data->jawaban['saran'] ?? '' @endphp
            <table style="width:100%;vertical-align: top;">
                <tr>
                    <td style="width:30%;vertical-align: top;" class=" position-relative" colspan="1" rowspan="1">
                        @if ($hasil_data_temp == '1')
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg=='/> Rawat bersama</span>
                        @else
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC'/> Rawat bersama</span>
                        @endif
                    </td>
                    <td style="width:70%;vertical-align: top;" class=" position-relative" colspan="1" rowspan="1">
                        @if ($hasil_data_temp == '2')
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg=='/> Tindakan</span>
                        @else
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC'/> Tindakan</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="width:30%;vertical-align: top;" class=" position-relative" colspan="1" rowspan="1">
                        @if ($hasil_data_temp == '3')
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg=='/> Alih rawat</span>
                        @else
                        <span style='font-family:calibri'><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC'/> Alih rawat</span>
                        @endif
                    </td>
                    <td style="width:70%;vertical-align: top;" class=" position-relative" colspan="1" rowspan="1">
                        @if ($hasil_data_temp == '4')
                        <span style='font-family:calibri'>
                            <div class="dots-wrap">
                                <span><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAANhQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV/C6WgAAAEh0Uk5TAIrAebn/o7iCQJWhWHIYQ3G7CgPWDaKU+y1UfST1zQLP/Ch1kh/5675iQd5uBFYi8AkFZ+GRf40MNGraMnCgWvF8sGxMtFGdK5lu+gAAANtJREFUeJyl08cSgjAQANC1rNgFsTfsig17w67o//+REXUgmsjBPTHzZks2AcAhXG5ueAh7kRs+wgL6A8wIYsjMDrO7RsxsBxZYHI0BiGZxFvulOJ/lUCJpFk8xe6cz2R+j5TD/Y/JCsaTwWS5XqsDnGtaBz41mK0kxfbA2qu9P8XvnHewqQGVTLGEPaH4W76sDDUDD4cjG762NJ1Ny+zOY4wJY2ctVivhax43FW9zZJt8/ns9Bsfjjxo6ET8BlWUc82/g5mrWWi3G11X71/u8pOvwGBp9v7LJW3AHxNRM1OSV4EgAAAABJRU5ErkJggg=='/> Lain-lain</span>
                                <span>( {{ $hasil_data->jawaban['saran_lain_lain'] ?? '' }} )</span>
                            </div>
                        </span>
                        @else
                        <span style='font-family:calibri'>
                            <div class="dots-wrap">
                                <span><img width="10" height="10" src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAGBQTFRFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+k/ojQAAACB0Uk5TAIrAebn/o7iCQD88Myo6PZWhWHIGcaJqXm8DAXCgtJ1uCE2LAAAAfklEQVR4nLWTxwrAMAxD3eHudO/5/3/ZkNJxcGJoqU6BhyxHIQCMLFsrR2IXtfIk9jEIL0VxIoRIs0iecyyUu6RTK+VmsE/iGqBRw2kMLK6wNWV35tX6P/HwvhY47/1H5/BsbazN7onAMy785t8eVIuP7G+1MN9g1eONHntrB2WPCZJdiW0LAAAAAElFTkSuQmCC'/> Lain-lain</span>
                            </div>
                        </span>
                        @endif
                    </td>
                </tr>
            </table>
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
            @if ($hasil_data_temp != '' || $hasil_data_temp != null)
            <span>{{ date('d F Y', strtotime($hasil_data_temp)) }}</span>
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
            <span>{{ $hasil_data->jawaban['menjawab'] ?? '' }}</span>
        </td>
    </tr>
</table>
<htmlpagefooter name="page-footer">
    <strong>RSJM / Revisi 01 / 02. 2019</strong>
</htmlpagefooter>
@endsection