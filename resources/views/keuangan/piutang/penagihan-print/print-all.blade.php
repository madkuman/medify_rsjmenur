@extends('layouts.print')

@section('title')
penagihan-{{$piutang[0]->pasien->name}}.pdf
@endsection

@section('content')
@if(count($bpjses)>0 && !is_null($bpjs_real) && $bpjses->last() != null)
@include('keuangan.piutang.penagihan-print.component.print-sep')
@endif

@include('keuangan.piutang.penagihan-print.component.print-opname')

@include('keuangan.piutang.penagihan-print.component.print-resume')
@if(count($result)>0)
<div style="page-break-after: always;"></div>
@endif

@include('keuangan.piutang.penagihan-print.component.print-layanan-ranap')
<div style="page-break-after: always;"></div>

{{--
@if(isset($kasus[0]->inacbg_latest) && !is_null($inacbg))
    @include('keuangan.piutang.penagihan-print.component.surat-inacbg', ['kasus' => $kasus[0], 'rs' => $rs])
    <div style="page-break-after: always;"></div>
@endif
--}}

@include('keuangan.piutang.penagihan-print.component.print-formulir-penunjang', ['result' => $resultLabPA, 'departemen' => 'LabPA'])
@if(count($resultLabPA)>0 )
<div style="page-break-after: always;"></div>
@endif

@include('keuangan.piutang.penagihan-print.component.print-formulir-penunjang', ['result' => $resultLabPK, 'departemen' => 'LabPK'])
@if(count($resultLabPK)>0 )
<div style="page-break-after: always;"></div>
@endif

@include('keuangan.piutang.penagihan-print.component.print-formulir-penunjang', ['result' => $resultRadiologi, 'departemen' => 'Radiologi'])
@if(count($resultRadiologi)>0)
    <div style="page-break-after: always;"></div>
@endif

@include('keuangan.piutang.penagihan-print.component.print-perincian-biaya-rekap')
@if(count($transaksies)>0 && $transaksies->last() != null)
    <div style="page-break-after: always;"></div>
@endif
@include('keuangan.piutang.penagihan-print.component.print-resep')
@if(count($reseps)>0 && $reseps->last() != null)
    <div style="page-break-after: always;"></div>
@endif
@include('keuangan.piutang.penagihan-print.component.print-hasil-operasi')
@if(count($operasi)>0 && $operasi->last() != null)
    <div style="page-break-after: always;"></div>
@endif

@if(count($piutang[0]->kasusTagihan->kasus->alatBantu->where('type', 'permintaan-usg')))
    @include('keuangan.piutang.penagihan-print.component.hasil-usg', ['data' => $piutang[0]->kasusTagihan->kasus->alatBantu->where('type', 'permintaan-usg')])
@endif

@include('keuangan.piutang.penagihan-print.component.surat-kematian', ['kematian' => $resultKematian])
@if(count($resultKematian) > 0)
    <div style="page-break-after: always;"></div>
@endif
@include('keuangan.piutang.penagihan-print.component.surat-kelahiran', ['kelahiran' => $resultKelahiran])

@endsection


@section('css')
<style type="text/css">
body{
    font-family: "Arial";
}

.dummy{
  font-size: 100px;
  color: white;
}

table.table-bordered {
    border-collapse: collapse;
    text-align: left;
    border: 1px solid #000;
}

table.table-bordered th, 
table.table-bordered td {
    border: 1px solid black;
    padding:10px 5px;
}

table.borderless th,
table.borderless td{
    border:none !important; 
    padding-top: 5px;
    padding-bottom: 5px;
}

td.borderless-vertical {
    border-bottom:none !important; 
    border-top:none !important; 
    padding:10px 5px;
}

.table-bordered td, .table-bordered th{
    padding: 4px;
}
.text-left {
    text-align: left
}
.text-right {
    text-align: right
}
.text-center
{
    text-align: center
}
td.hr{
    border-bottom: 1px solid  #000;
}
tr.none-bold th
{
    font-weight: 400;
}

li{
  margin: 10px 0;
}
.footer {
    position: fixed;
    bottom: 0px; // or how low do you want it
}
.centered{
  text-align: center;
}
.bot{
  border-bottom: 2px solid black
}
.va-mid{
  vertical-align: middle;
}
.logo{
  position: absolute;
  z-index: 100;
}
.head{
  font-size: 42px;
}
.title {
  text-align: center; 
  font-weight: bold;
}
.small-col {
  width: 17%;
}
.big-col {
  width: 43%;
}
.med-col {
  width: 23%;
}
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    p {
        margin: 0px;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
        padding-bottom: 10px;
    }

    tr.border_bottom td {
        border-bottom:5pt solid black;
        padding-bottom: 10px;
    }

    .invoice-box table td {
        padding: 0px;
        /*vertical-align: top;*/
        padding-bottom: 10px;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: left;
        padding-bottom: 10px;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 0px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: inherit;
        color: #333;
        padding-bottom: 10px;
    }

    .information {
        padding-bottom: 10px;
    }

    .informations {
        padding-bottom: 0px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        padding-bottom: 0px;
    }

    .invoice-box table tr.details td {
        padding-bottom: 10px;
    }

    .invoice-box table tr.detailsafterheading td {
        padding-bottom: 10px;
        padding-top: 8px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    .line-dashed {
        border-top: 1px dashed #8c8b8b;
    }
    .nomor{
        margin-bottom: 8px;
    }
    .sub-nomor{
        float: left;
        width: 150px;
        margin-left: 20px;
    }
    .ttd{
        float: left;
        width: 50%;
        text-align: center;
    }
    </style>
</style>
@endsection