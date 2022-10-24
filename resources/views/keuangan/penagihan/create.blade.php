@extends('keuangan.layouts.main')

@section('title')
Buat Piutang Baru - Keuangan
@endsection

@section('menu')
Piutang
@endsection

@section('content')
@include('keuangan.piutang.components.header')
@include('keuangan.piutang.components-create.content')
@include('keuangan.piutang.components-create.tambah-transaksi')

@endsection

@section('js')
<script type="text/javascript">
    var redirect_url = 'keuangan/piutang';
</script>
@include('keuangan.piutang.components-create.js')
@endsection