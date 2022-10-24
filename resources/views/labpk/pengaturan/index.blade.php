@extends('layouts.main2')
@section('title')
Pengaturan
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="row">
        <div class="col-lg-3">
            <a class="block rounded block-link-shadow text-center" href="{{url('labpk\pengaturan\mikrobiologi-spesimen-kategori')}}">
                <div class="block-content">
                    <p><i class="fa fa-vial fa-4x text-muted"></i></p>
                    <p class="text-uppercase font-w600 h5 mb-0">Kategori Spesimen Mikrobiologi</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a class="block rounded block-link-shadow text-center" href="{{url('labpk\pengaturan\mikrobiologi-spesimen')}}">
                <div class="block-content">
                    <p><i class="fa fa-microscope fa-4x text-muted"></i></p>
                    <p class="text-uppercase font-w600 h5 mb-0">Spesimen Mikrobiologi</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a class="block rounded block-link-shadow text-center" href="{{url('labpk\pengaturan\form')}}">
                <div class="block-content">
                    <p><i class="fa fa-file-medical fa-4x text-muted"></i></p>
                    <p class="text-uppercase font-w600 h5 mb-0">Form Pemeriksaan</p>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a class="block rounded block-link-shadow text-center" href="{{url('labpk\pengaturan\layanan')}}">
                <div class="block-content">
                    <p><i class="fa fa-dollar fa-4x text-muted"></i></p>
                    <p class="text-uppercase font-w600 h5 mb-0">Tarif</p>
                </div>
            </a>
        </div>
    </div>
</div>
@include('labpk.components.footer')

@endsection