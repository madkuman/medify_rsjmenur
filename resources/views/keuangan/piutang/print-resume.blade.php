@extends('layouts.print')

@section('title')
Print Resume
@endsection

@section('css')
<style type="text/css">
body {
    font-size: 0.9em;
}
td{
    vertical-align: top;
}
</style>
@endsection

@section('content')
@include('keuangan.piutang.penagihan-print.component.print-resume')
@endsection