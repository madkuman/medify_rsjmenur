@extends('gizi.layouts.index')

@section('title')
    Medify - Gizi Anggaran Makanan Detail
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

    @include('gizi.pengaturan.content.anggaran-makanan.components.content-detail')
    @include('gizi.pengaturan.content.anggaran-makanan.components.tabel-detail')
    @include('gizi.pengaturan.content.anggaran-makanan.components.modal-edit')
    @include('gizi.pengaturan.content.anggaran-makanan.components.modal-create-detail')
    @include('gizi.pengaturan.content.anggaran-makanan.components.modal-edit-detail')
    @include('gizi.pengaturan.content.anggaran-makanan.components.modal-delete-detail')
@endsection

@section('js')

    <script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    @include('gizi.pengaturan.content.anggaran-makanan.components.js-detail')
@endsection