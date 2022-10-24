@extends('layouts.print')

@section('title')
Print Resep Format Dokter
@endsection

@section('css')
<style type="text/css">
    @page {
        margin-top: 0.0cm;
        margin-left: 0.6cm;
        margin-bottom: 0cm;
        margin-right: 0cm;
    }
</style>
@endsection

@section('content')
@include('keuangan.piutang.penagihan-print.component.print-resep')
@endsection
