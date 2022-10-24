@extends('kepegawaian.layouts.main')

@section('title')
    Master Kategori Pegawai
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    @include('kepegawaian.master.kategori-pegawai.components.tabel')
    @include('kepegawaian.master.kategori-pegawai.components.modal-create')
    @include('kepegawaian.master.kategori-pegawai.components.modal-edit')
    @include('kepegawaian.master.kategori-pegawai.components.modal-delete')
@endsection

@section('js')
    @include('kepegawaian.master.kategori-pegawai.components.js-index')
@endsection