@extends('layouts.main2')
@section('title')
Verifikasi Transaksi
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Verifikasi Transaksi</h3>
        </div>
        @include('layouts.components2.lab.tabel-verifikasi')
    </div>

</div>
@include('labpk.components.footer')
@endsection
@section('js')
@include('layouts.components2.lab.transaksi-js')
@endsection