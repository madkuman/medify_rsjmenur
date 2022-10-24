@extends('kepegawaian.layouts.main')

@section('title')
Master Pelatihan
@endsection

@section('subtitle')
Master Pelatihan
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="#" data-toggle="modal" data-target="#modal-create-pelatihan" class="pull-right">
					<i class="fa fa-plus-circle"></i> Tambah Pelatihan</a>
				</small>
				Daftar Pelatihan
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="" width="10%">No</th>
						<th width="25%">Nama</th>
						<th width="25%">Tempat</th>
						<th width="25%">Tahun</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@php $i = 1; @endphp
					@foreach($pelatihan as $item)
					<tr>
						<td class="">{{$i}}</td>
						<td class="nama">{{$item->nama}}</td>
						<td class="tempat">{{$item->tempat}}</td>
						<td>{{$item->tahun}}
							<span class="tahun hide">{{$item->tahun}}</span>
							<span class="durasi hide">{{$item->durasi}}</span>
							<span class="skor hide">{{$item->skor}}</span>
						</td>
						<td class="">
								<a href="javascript:void(0)" class="btn-update btn btn-sm btn-circle btn-outline-info mr-5 mb-5" data-id="{{$item->id}}"><i class="fas fa-pencil"></i></a>
								<a href="javascript:void(0)" class="btn-delete btn btn-sm btn-circle btn-outline-danger mr-5 mb-5"
								 data-id="{{$item->id}}" data-nama="{{$item->nama}}">
								<i class="fa fa-trash"></i></a>
								@if($item->sertifikat)
									<a href="{{route('file-master-pelatihan', ['id' => $item->sertifikat])}}" class="btn btn-alt-warning btn-sm mr-5" title="Lihat Sertifikat" target="_blank"><i class="fa fa-file"></i></a>
								@else
									<button type="button" class="btn btn-alt-warning btn-sm mr-5" disabled title="Lihat Sertifikat">
									<i class="fa fa-file"></i></button>
								@endif
							</td>
						</tr>
						@php $i++; @endphp	
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	@include('kepegawaian.master.pelatihan.components.modal-delete')
	@include('kepegawaian.master.pelatihan.components.modal-create-copy')
	@include('kepegawaian.master.pelatihan.components.modal-update')
	@endsection

	@section('script')
	
	@include('kepegawaian.master.pelatihan.components.js-index')

	@endsection