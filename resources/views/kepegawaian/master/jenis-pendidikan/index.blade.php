@extends('kepegawaian.layouts.main')

@section('title')
Master Jenis Pendidikan
@endsection

@section('subtitle')
Master Jenis Pendidikan
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="#" data-toggle="modal" data-target="#modal-jenis-pendidikan" class="pull-right">
					<i class="fa fa-plus-circle"></i> Tambah Jenis Pendidikan</a>
				</small>
				Daftar Jenis Pendidikan
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="" width="50px">No</th>
						<th>Nama</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@php $i = 1; @endphp
					@foreach($jenis as $item)
					<tr>
						<td class="">{{$i}}</td>
						<td>{{$item->nama}}</td>
						<td class="">
							<a onclick="editModal({{$item->id}})" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5">
								<i class="fa fa-edit"></i></a>
								<a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5"
								data-toggle="modal" data-id="{{$item->id}}" data-nama="{{$item->nama}}">
								<i class="fa fa-trash"></i></a>
							</td>
						</tr>
						@php $i++; @endphp	
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	@include('kepegawaian.master.jenis-pendidikan.components.modal-delete')
	@include('kepegawaian.master.jenis-pendidikan.components.modal-create')
	@include('kepegawaian.master.jenis-pendidikan.components.modal-edit')
	@endsection

	@section('js')
	
	@include('kepegawaian.master.jenis-pendidikan.components.js-index')

	@endsection