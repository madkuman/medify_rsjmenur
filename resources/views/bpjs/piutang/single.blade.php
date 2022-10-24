@extends('keuangan.layouts.main')

@section('title')
Piutang {{$piutang->id}} - Keuangan
@endsection

@section('content')
<div class="content p-0" id="print-content">

    <h2 class="content-heading d-print-none pt-0">
        Invoice Tagihan / Piutang
    </h2>
    @include('keuangan.piutang.components-single.tabel-detail')
    @include('keuangan.piutang.components-single.rekap-kategori')
    {{-- @include('keuangan.piutang.components-single.kolaborator-kasus') --}}
    @include('keuangan.piutang.components-single.modal-pay')
    @include('keuangan.piutang.components-single.modal-split')

@endsection

@section('js')
<script type="text/javascript">
    var redirect_url = 'keuangan/pemasukan';
</script>
    @include('keuangan.piutang.components-single.js')
@endsection
