@extends('kepegawaian.layouts.main')

@section('title')
Master Jenis Jabatan
@endsection

@section('subtitle')
Master Jenis Jabatan
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="javascript:void(0)" class="pull-right btn-add">
					<i class="fa fa-plus-circle"></i> Tambah Jenis Jabatan</a>
				</small>
				Daftar Jenis Jabatan
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
					@foreach($jenis as $item)
					<tr>
						<td class="">{{$loop->iteration}}</td>
						<td>{{$item->nama}}</td>
						<td class="">
							<a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 btn-edit" data-id="{{$item->id}}" data-nama="{{$item->nama}}">
								<i class="fa fa-edit"></i>
							</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 btn-delete"
                            data-id="{{$item->id}}" data-nama="{{$item->nama}}">
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
@include('kepegawaian.master.jabatan.components.modal-jenis-jabatan')
@endsection

@section('js')
@include('kepegawaian.master.jabatan.components.js-jenis-jabatan')
@endsection