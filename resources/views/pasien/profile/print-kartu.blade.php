@extends('layouts.print')

@section('title')
Print Kartu - {{$pasien->name}}
@endsection

@section('css')
<style type="text/css">
	@page {
		margin-top: 2.4cm;
		margin-left: 0cm;
		margin-bottom: 0cm;
		margin-right: 0.3cm;
	}
</style>
@endsection

@section('content')
<p style="text-align: right" class="text-uppercase"><strong>{{substr($pasien->name, 0, 22)}}</strong></p>
<p style="text-align: right" class="text-uppercase"><strong>{{$pasien->no_rm_formatted}}</strong></p>
{{--<p style="text-align: right" class="text-uppercase"><strong>{{$pasien->name}}</strong></p>--}}
{{--<p class="text-uppercase text-size-14">{{$pasien->address}}</p>--}}
<p style="text-align: right" class="text-size-14">
@if($pasien->gender == 1) L @else P @endif
/
{{date('d-m-Y', strtotime($pasien->date_of_birth))}}
</p>
<p style="text-align: right" class="text-size-16"><strong>{!!$barcode!!}</strong></p>


@endsection
