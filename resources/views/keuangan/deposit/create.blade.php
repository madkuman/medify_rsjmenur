@extends('keuangan.layouts.main')

@section('css')
@endsection

@section('title')
Deposit - Keuangan
@endsection

@section('content')
<!-- Page Content -->
<div class="content p-0" id="print-content">
    <!-- Invoice -->
    @include('keuangan.deposit.components-create')
</div>

<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/kasir/tagihan/create-dp.js')}}"></script>
@endsection
