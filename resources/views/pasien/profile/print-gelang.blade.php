@extends('layouts.print')

@section('title')
Print Gelang - {{$pasien->name}}
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
<p style="font-size: 16px"><strong>{{$pasien->no_rm_format}} YAYAYA</strong></p>
{!!$barcode!!}
<p style="font-size: 10px" class="text-uppercase"><strong>{{$pasien->name}}</strong></p>
<p style="font-size: 10px" class="text-uppercase">{{$pasien->address}}, 
@if(!empty($pasien->alamat_kecamatan))
{{$pasien->alamat_kecamatan->nama}}, {{$pasien->alamat_kota->nama}} 
</p>
@endif


@endsection