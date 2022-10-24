@extends('gizi.layouts.index')

@section('title')
    Medify - Gizi Anggaran Makanan
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    @include('gizi.pengaturan.content.anggaran-makanan.components.tabel-index')
    @include('gizi.pengaturan.content.anggaran-makanan.components.modal-create')
@endsection

@section('js')

    <script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    @include('gizi.pengaturan.content.anggaran-makanan.components.js-index')
@endsection