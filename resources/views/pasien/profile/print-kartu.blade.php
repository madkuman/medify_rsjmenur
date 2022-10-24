@extends('layouts.print')

@section('title')
Print Kartu - {{$pasien->name}}
@endsection

@section('css')
<style type="text/css">
	@page {
		margin-top: 1.9cm;
		margin-left: 0.6cm;
		margin-bottom: 0cm;
		margin-right: 0cm;
	}
</style>
@endsection

@section('content')
<p class="text-uppercase"><strong>{{$pasien->no_rm_formatted}}</strong></p>
<p class="text-uppercase"><strong>{{$pasien->name}}</strong></p>
<p class="text-uppercase text-size-14">{{$pasien->address}}</p>
<p class="text-size-14">
@if($pasien->gender == 1) L @else P @endif
/
{{date('d-m-Y', strtotime($pasien->date_of_birth))}}
</p>
{!!$barcode!!}


@endsection