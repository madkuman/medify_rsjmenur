@extends('keuangan.layouts.main')

@section('title')
Piutang Edit - Keuangan
@endsection

@section('content')
@include('keuangan.piutang.components.header')
@include('keuangan.piutang.components-edit.main-content')
@include('keuangan.piutang.components-edit.tambah-transaksi')
@endsection

@section('js')
<script type="text/javascript">
    var redirect_url = 'keuangan/piutang';
</script>
@include('keuangan.piutang.components-edit.js')
@endsection