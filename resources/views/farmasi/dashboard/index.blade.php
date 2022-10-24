@extends('farmasi.layouts.main')

@section('title')
Farmasi Dashboard
@endsection

@section('css')
    <style type="text/css">
        .clickable-row {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
	@include('farmasi.dashboard.components.content-header')

    @if (session('farmasi')->jenis < 4)
        @include('farmasi.dashboard.layouts.farmasi')
    @else 
        @include('farmasi.dashboard.layouts.gudang')
    @endif
@endsection

@section('js')
    @if (session('farmasi')->jenis < 4)
        @include('farmasi.dashboard.components.js-farmasi')
    @else 
        @include('farmasi.dashboard.components.js-gudang')
    @endif
@endsection