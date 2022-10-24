@extends('layouts.main2')
@section('title')
Laboratorium Patologi Anatomi
@endsection
@section('content')
@include('labpa.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Buat Permintaan Baru</h3>
        </div>
        <div class="block-content">
            @include('layouts.components2.lab.new-transaksi-form')
        </div>
        <input type="hidden" name="" id="departemenId" value="{{$departemen}}">
    </div>
</div>
@include('layouts.components2.lab.confirmation-modal-lab')
@include('radiolog.components.footer')
@endsection
@section('js')
<script type="text/javascript">
    var layananUrl = "{{url('keuangan/tarif_master/get_lab')}}";
    var kelasWarning = $("#kelasWarn");
    var tipeWarning = $("#tipeWarn");
    var pasienWarning = $("#pasienWarn");
    var pembayaranWarning = $("#pembayaranWarn");

    var kelasForm = $("#kelasLayanan");
    var tipeForm = $("#tipeLayanan");
    var pembayaranForm = $("#pasien-pembayaran");
    var kasusForm = $("#kasus_dropdown");
</script>
@include('layouts.components2.lab.new-transaksi-js')
<script type="text/javascript" src="{{asset('js/kasus/penunjang/layanan-labv1.8.js')}}"></script>
@endsection