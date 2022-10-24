@extends('kepegawaian.layouts.main')

@section('title')
    Tim Pembagi Jasa
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    @include('kepegawaian.master.tim-pembagi-jasa.components.tabel')
    @include('kepegawaian.master.tim-pembagi-jasa.components.modal-create')
    @include('kepegawaian.master.tim-pembagi-jasa.components.modal-edit')
    @include('kepegawaian.master.tim-pembagi-jasa.components.modal-delete')
@endsection

@section('js')
    @include('kepegawaian.master.tim-pembagi-jasa.components.js-index')
@endsection