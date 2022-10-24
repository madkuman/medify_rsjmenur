@extends('kepegawaian.layouts.main')

@section('title')
Master Jabatan Intern
@endsection

@section('subtitle')
Master intern
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small>
					<a href="#modal_tambah_intern" data-toggle="modal" data-url="{{url()->current()}}/baru" class="pull-right btn-tambah">
					<i class="fa fa-plus-circle"></i> Tambah Jabatan Intern</a>
				</small> 
				Daftar Jabatan Intern
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
					@foreach($intern as $item)
					<tr>
						<td class="">{{$i}}</td>
						<td class="">{{$item->nama}}</td>
						<td class="">
							<a href="#edit_modal" data-url="{{url('/kepegawaian/master/intern/edit/')}}/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5"
								data-toggle="modal" data-id="{{$item->id}}">
								<i class="fa fa-edit"></i>
							</a>
							<a href="#delete_modal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5"
								data-toggle="modal" data-url="{{url('/kepegawaian/master/intern/delete/')}}/{{$item->id}}" data-id="{{$item->id}}" data-nama="{{$item->nama}}">
								<i class="fa fa-trash"></i>
							</a>
							</td>
						</tr>
						@php $i++; @endphp	
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	

	@include('kepegawaian.master.intern.components.modal-create')
	@include('kepegawaian.master.intern.components.modal-edit')
	@include('kepegawaian.master.intern.components.modal-delete')

	@endsection

	@section('js')
	
	@include('kepegawaian.master.intern.components.js-index')

	@endsection