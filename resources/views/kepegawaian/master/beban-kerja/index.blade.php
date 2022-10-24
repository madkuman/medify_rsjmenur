@extends('kepegawaian.layouts.main')

@section('title')
Master Beban Kerja
@endsection

@section('subtitle')
Master Beban Kerja
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
					<i class="fa fa-plus-circle"></i> Tambah Beban Kerja</a>
				</small>
				Daftar Beban Kerja
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="" width="50px">No</th>
						<th>Nama</th>
						<th>Index</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($beban_kerja as $item)
					<tr>
						<td class="">{{$loop->iteration}}</td>
						<td>{{$item->nama}}</td>
						<td>{{$item->index}}</td>
						<td class="">
							<a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 btn-edit" data-id="{{$item->id}}" data-nama="{{$item->nama}}" data-index="{{$item->index}}">
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

@include('kepegawaian.master.beban-kerja.components.modal-delete')
@include('kepegawaian.master.beban-kerja.components.modal-beban')
@endsection

@section('js')
@include('kepegawaian.master.beban-kerja.components.js')
@endsection