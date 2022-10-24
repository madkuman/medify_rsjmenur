@extends('kasir.layouts.main')

@section('title')
Buat Tagihan Baru - {{$kasir->nama}}
@endsection

@section('menu')
Tagihan
@endsection

@section('content')
@include('kasir.transaksi.components.header')
@include('keuangan.piutang.components-create.content')
@include('keuangan.piutang.components-create.tambah-transaksi')

@endsection

@section('js')
<script type="text/javascript">
    var redirect_url = 'kasir/{{$kasir->id}}/transaksi';
</script>
@include('keuangan.piutang.components-create.js')
@endsection