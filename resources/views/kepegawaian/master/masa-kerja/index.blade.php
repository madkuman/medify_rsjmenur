@extends('kepegawaian.layouts.main')

@section('title')
    Master Masa Kerja
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    @include('kepegawaian.master.masa-kerja.components.tabel')
    @include('kepegawaian.master.masa-kerja.components.modal-create')
    @include('kepegawaian.master.masa-kerja.components.modal-edit')
    @include('kepegawaian.master.masa-kerja.components.modal-delete')
@endsection

@section('js')
    @include('kepegawaian.master.masa-kerja.components.js-index')
@endsection