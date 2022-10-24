@extends('layouts.print')

@section('title')
@if(count($bpjs_real) > 0)
penagihan-{{$piutang[0]->pasien->name}}-{{$bpjs_real[0]->noSep}}.pdf
@else
penagihan-{{$piutang[0]->pasien->name}}.pdf
@endif
@endsection

@section('content')
@include('keuangan.piutang.penagihan-print.component.print-daftar-penagihan')
<div style="page-break-after: always;"></div>
@include('keuangan.piutang.penagihan-print.component.print-surat-pengantar')
<div style="page-break-after: always;"></div>
@include('keuangan.piutang.penagihan-print.component.print-perincian-biaya-rekap')
<div style="page-break-after: always;"></div>
@include('keuangan.piutang.penagihan-print.component.print-resume')
@if(count($result)>0)
<div style="page-break-after: always;"></div>
@endif
@include('keuangan.piutang.penagihan-print.component.print-opname')
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
@include('keuangan.piutang.penagihan-print.component.print-sep')
@if(count($bpjses)>0 && $bpjses->last() != null)
<div style="page-break-after: always;"></div>
@endif


@include('keuangan.piutang.penagihan-print.component.print-formulir-penunjang', ['result' => $resultLabPA, 'departemen' => 'LabPA'])
@if(count($resultLabPA)>0 )
<div style="page-break-after: always;"></div>
@endif

@include('keuangan.piutang.penagihan-print.component.print-formulir-penunjang', ['result' => $resultLabPK, 'departemen' => 'LabPK'])
@if(count($resultLabPK)>0 )
<div style="page-break-after: always;"></div>
@endif

@include('keuangan.piutang.penagihan-print.component.print-formulir-penunjang', ['result' => $resultRadiologi, 'departemen' => 'Radiologi'])
@endsection


@section('css')
<style type="text/css">
body{
    font-family: "Arial";
}

.table {
  width: 100%;
  max-width: 100%;
  border-collapse: collapse;
}
.table-bordered, .table-bordered th {
  border: 1px solid #000;
}
.table-bordered td {
    font-weight: normal;
    border-left: 1px solid #000;
    border-right: 1px solid #000;
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
</style>
@endsection