@extends('layouts.print')

@section('title')
Surat Pengantar Penagihan @foreach($perusahaan as $item){{ $loop->first ? '' : ', ' }}{{$item->nama}}@endforeach - Keuangan
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
.float-right{
    float: right;
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

</style>

@endsection
@section('content')
    @include('keuangan.piutang.penagihan-print.component.print-surat-pengantar')
@endsection