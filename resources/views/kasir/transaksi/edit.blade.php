@extends('kasir.layouts.main')

@section('title')
Edit Transaksi #{{$piutang->id}} - {{$kasir->nama}}
@endsection

@section('content')
@include('kasir.transaksi.components.header')
@include('keuangan.piutang.components-edit.main-content')
@include('keuangan.piutang.components-edit.tambah-transaksi')
@endsection

@section('js')
<script type="text/javascript">
    var redirect_url = 'kasir/{{$kasir->id}}/transaksi';
</script>
@include('keuangan.piutang.components-edit.js')
@endsection