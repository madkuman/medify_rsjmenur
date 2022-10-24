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
@include('admin.usercontrol.components-index.table')

@endsection

@section('js')
<script type="text/javascript">
	var modules = 'admin';
</script>
@include('admin.usercontrol.components-index.js')
@endsection