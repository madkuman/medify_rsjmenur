@extends('gizi.layouts.index')

@section('title')
    Medify - Gizi Diet
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    @include('gizi.pengaturan.content.diet.components.tabel')
    @include('gizi.pengaturan.content.diet.components.modal-create')
    @include('gizi.pengaturan.content.diet.components.modal-edit')
    @include('gizi.pengaturan.content.diet.components.modal-delete')
@endsection

@section('js')

    <script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    @include('gizi.pengaturan.content.diet.components.js')
@endsection