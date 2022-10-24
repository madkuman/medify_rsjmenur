@extends('kasir.layouts.main')

@section('title')
Tagihan {{$piutang->id}} - Keuangan
@endsection

@section('content')
	@include('kasir.transaksi.components.header')
	@include('keuangan.piutang.components-single.tabel-detail')
	@include('keuangan.piutang.components-single.kolaborator-kasus')
	@include('keuangan.piutang.components-single.modal-pay')
	@include('keuangan.piutang.components-single.modal-split')
@endsection

@section('js')
<script type="text/javascript">
    var redirect_url = 'kasir/{{$kasir->id}}/transaksi';
</script>
	@include('keuangan.piutang.components-single.js')
@endsection
