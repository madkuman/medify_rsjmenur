@extends('kepegawaian.layouts.main')

@section('title')
Master Jabatan
@endsection

@section('subtitle')
Master Jabatan
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
					<a href="javascript:void(0)" class="btn-add pull-right"><i class="fa fa-plus-circle"></i> Tambah Jabatan</a>
				</small>
				Daftar Jabatan
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="" width="50px">No</th>
						<th>Nama</th>
						<th>Jenis Jabatan</th>
						<th>Departemen</th>
						<th>Jabatan Pimpinan</th>
						<th>Indek</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($jabatan as $item)
					<tr>
						<td class="">{{$loop->iteration}}</td>
                        <td>
							<span class="gaji hide">{{$item->gaji ?? ''}}</span>
							<span class="urutan hide">{{$item->urutan ?? ''}}</span>
							{{$item->nama}}
						</td>
						<td>
							<span class="jenis-jabatan hide">{{$item->jenis_jabatan->id ?? ''}}</span>
							{{$item->jenis_jabatan->nama ?? '-'}}
						</td>
                        <td>
                            <span class="departemen hide">{{$item->departemen->id ?? ''}}</span>
                            {{$item->departemen->nama ?? '-'}}
                        </td>
						<td>
							<span class="pimpinan hide">{{$item->parent->id ?? ''}}</span>
							{{$item->parent->nama ?? '-'}}
						</td>
						<td>{{$item->index}}</td>
						<td>
							<a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 btn-edit" data-id="{{$item->id}}" data-nama="{{$item->nama}}" data-index="{{$item->index}}">
							<i class="fa fa-edit"></i></a>
							<a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 btn-delete" data-id="{{$item->id}}" data-nama="{{$item->nama}}">
							<i class="fa fa-trash"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@include('kepegawaian.master.jabatan.components.modal-delete')
@include('kepegawaian.master.jabatan.components.modal-jabatan')
@endsection

@section('js')
@include('kepegawaian.master.jabatan.components.js-jabatan')
@endsection