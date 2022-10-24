@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar User
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
	@include('admin.usercontrol.components-edit.content')
</div>

@endsection

@section('js')
@include('admin.usercontrol.components-edit.js')
@endsection