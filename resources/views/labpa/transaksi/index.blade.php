@extends('layouts.main2')
@section('title')
Laboratorium Patologi Anatomi
@endsection
@section('css')

@include('labpa.layouts.css')
@endsection
@section('content')
@include('labpa.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Transaksi Terbaru</h3>
        </div>
            @include('layouts.components2.lab.index-transaksi')
        </div>
    </div>

</div>
@include('labpa.components.footer')
@endsection
@section('js')
@include('layouts.components2.lab.transaksi-js')
@endsection