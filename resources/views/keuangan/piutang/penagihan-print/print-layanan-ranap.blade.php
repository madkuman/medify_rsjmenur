@extends('layouts.print')

@section('title')
Print Bukti Pelayanan
@endsection

@section('css')
<style type="text/css">
td, body, th{
    font-size: 14px;
    font-family: sans-serif;
}
table.table-bordered {
    border-collapse: collapse;
    text-align: left;
    font-size: 10px;
}

table.table-bordered th, td {
    border: 1px solid black;
    padding:10px 5px;
}
td.borderless-vertical {
    border-bottom:none !important; 
    border-top:none !important; 
    padding:10px 5px;
}

table.borderless th,
table.borderless td{
    border:none !important; 
    padding-top: 5px;
    padding-bottom: 5px;
}

table.nopadding tr th {
    padding: 5px 5px;
}

table.nopadding tr td {
    padding: 0 0;
}

.center
{
    text-align: center;
}
.bold
{
    font-weight: 700;
}
.underline
{
    text-decoration: underline;
}
.box
{
    border:solid 1px #000;
}

.belum_ada {
    font-style: italic;
}
.text-center{
    text-align: center;
}
.big{
    font-weight: bold;
    font-size: 16px;
}
.dummy{
    font-size: 150px;
    color: white;
}
.no-left{
    border-left: none;
}
.no-right{
    border-right: none;
}
.no-bottom{
    border-bottom: none;
}

</style>
@endsection

@section('content')
@include('keuangan.piutang.penagihan-print.component.print-layanan-ranap')
@endsection