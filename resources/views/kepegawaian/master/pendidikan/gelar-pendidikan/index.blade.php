@extends('kepegawaian.layouts.main')

@section('title')
Master Gelar Pendidikan
@endsection

@section('subtitle')
Master Gelar Pendidikan
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
					<a href="javascript:void(0)" class="btn-add pull-right"><i class="fa fa-plus-circle"></i> Tambah Gelar Pendidikan</a>
				</small>
				Daftar Gelar Pendidikan
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="" width="50px">No</th>
						<th>Nama</th>
						<th>Strata</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					
					@foreach($gelar as $item)
					<tr>
						<td class="">{{$loop->iteration}}</td>
						<td> 
							<span class="strata hide">{{$item->id}}</span>
							{{$item->nama}}
						</td>
						<td>
							<span class="strata-pendidikan hide">{{$item->strata_pendidikan->id ?? ''}}</span>
							{{$item->strata_pendidikan->nama ?? '-'}}
						</td>
						<td class="">
							<a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 btn-edit" data-id="{{$item->id}}" data-nama="{{$item->nama}}">
								<i class="fa fa-edit"></i></a>
								<a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 btn-delete" data-id="{{$item->id}}" data-nama="{{$item->nama}}">
								<i class="fa fa-trash"></i>
							</a>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	@include('kepegawaian.master.pendidikan.gelar-pendidikan.components.modal-delete')
	@include('kepegawaian.master.pendidikan.gelar-pendidikan.components.modal-create')
	@include('kepegawaian.master.pendidikan.gelar-pendidikan.components.modal-edit')
	@endsection

	@section('js')
	
	@include('kepegawaian.master.pendidikan.gelar-pendidikan.components.js-index')

	@endsection