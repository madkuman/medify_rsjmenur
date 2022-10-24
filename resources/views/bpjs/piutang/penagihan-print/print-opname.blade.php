@extends('layouts.print')

@section('css')
<style type="text/css">
	body{
		font-family: sans-serif;
	}
</style>
@endsection

@section('content')
@include('keuangan.piutang.penagihan-print.component.print-opname')
@endsection