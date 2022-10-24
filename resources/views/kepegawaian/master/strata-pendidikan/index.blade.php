@extends('kepegawaian.layouts.main')

@section('title')
Master Strata Pendidikan
@endsection

@section('subtitle')
Master Strata Pendidikan
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="#" data-toggle="modal" data-target="#modal-create-strata" class="pull-right">
					<i class="fa fa-plus-circle"></i> Tambah Strata Pendidikan</a>
				</small>
				Daftar Strata Pendidikan
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="" width="50px">No</th>
						<th>Nama</th>
						<th>Jenis</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@php $i = 1; @endphp
					@foreach($strata as $item)
					<tr>
						<td class="">{{$i}}</td>
						<td>{{$item->nama}}</td>
						<td>{{$item->jenisPendidikan->nama}}
						<span class="jenis hide">{{$item->pendidikan_jenis_id}}</span></td>
						<td class="">
							<a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 btn-edit" data-id="{{$item->id}}" data-nama="{{$item->nama}}">
								<i class="fa fa-edit"></i></a>
								<a href="#deletemodal" class="btn-delete btn btn-sm btn-circle btn-outline-danger mr-5 mb-5"
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

	@include('kepegawaian.master.strata-pendidikan.components.modal-delete')
	@include('kepegawaian.master.strata-pendidikan.components.modal-create')
	@include('kepegawaian.master.strata-pendidikan.components.modal-edit')
	@endsection

	@section('js')
	
	@include('kepegawaian.master.strata-pendidikan.components.js-index')

	@endsection