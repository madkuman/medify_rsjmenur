@extends('eusulan.layouts.main')

@section('title')
    E-Usulan - Pengaturan
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3">
                <a class="block rounded block-link-shadow text-center"
                   href="{{url('e-usulan\pengaturan\akun-rekening')}}">
                    <div class="block-content">
                        <p><i class="fa fa-credit-card fa-4x text-muted"></i></p>
                        <p class="text-uppercase font-w600 h5 mb-0">Akun Rekening</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a class="block rounded block-link-shadow text-center" href="{{url('e-usulan\pengaturan\barang')}}">
                    <div class="block-content">
                        <p><i class="fa fa-boxes fa-4x text-muted"></i></p>
                        <p class="text-uppercase font-w600 h5 mb-0">Barang</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a class="block rounded block-link-shadow text-center" href="{{url('e-usulan\pengaturan\unit')}}">
                    <div class="block-content">
                        <p><i class="fa fa-home fa-4x text-muted"></i></p>
                        <p class="text-uppercase font-w600 h5 mb-0">Unit</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a class="block rounded block-link-shadow text-center" href="{{url('e-usulan\pengaturan\ubah-usulan')}}">
                    <div class="block-content">
                        <p><i class="fa fa-list fa-4x text-muted"></i></p>
                        <p class="text-uppercase font-w600 h5 mb-0">Batasan Ubah Usulan</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection