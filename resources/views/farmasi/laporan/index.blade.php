@extends('farmasi.layouts.main')

@section('title')
Farmasi Laporan
@endsection

@section('content')
    @if (session('farmasi')->jenis < 4)
        @include('farmasi.laporan.contents.laporan-farmasi')
    @else
        @include('farmasi.laporan.contents.laporan-farmasi')
    @endif
@endsection