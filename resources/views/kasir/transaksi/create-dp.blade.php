@extends('kasir.layouts.main')

@section('title')
Buat Transaksi - {{$kasir->nama}}
@endsection

@section('content')
@include('kasir.transaksi.components.header')
@include('keuangan.deposit.components-create')
@endsection

@section('js')
<script src="{{asset('js/kasir/tagihan/create-dp.js')}}"></script>
@endsection