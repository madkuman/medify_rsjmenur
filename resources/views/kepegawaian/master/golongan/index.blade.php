@extends('kepegawaian.layouts.main')

@section('title')
    Master Golongan Pegawai
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    @include('kepegawaian.master.golongan.components.tabel')
    @include('kepegawaian.master.golongan.components.modal-create')
    @include('kepegawaian.master.golongan.components.modal-edit')
    @include('kepegawaian.master.golongan.components.modal-delete')
@endsection

@section('js')
    @include('kepegawaian.master.golongan.components.js-index')
@endsection