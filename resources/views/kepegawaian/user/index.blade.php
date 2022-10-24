@extends('kepegawaian.layouts.main')

@section('title')
{{$htmlheader_title}}
@endsection

@section('subtitle')
{{$contentheader_title}}
@endsection

@section('css')

@endsection

@section('content')
<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Daftar User
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tabelPegawai">
				<thead>
					<tr>
						<th class="">No</th>
						<th>Nama</th>
						<th class="text-center">Status</th>
						<th>Aksi</th>
						<th>Edit</th>
					</tr>
				</thead>
				{{--<tbody>
					@php $i = 1; @endphp
					@foreach($data as $isi)
					<tr>
						<td class="">{{$i}}</td>
						<td class="font-w600">{{$isi->name}}</td>
						<td class="text-center">
							@if($isi->flag == 1)
							<a class="badge badge-primary" href="javascript:void(0)">Aktif</a>
							@else
							<a class="badge badge-danger" href="javascript:void(0)">Tidak Aktif</a>
							@endif
						</td>
						<td class="">
							@if($isi->flag == 1)
							<a href="javascript:void(0)" id="deaktif_{{$isi->id}}" data-id="{{$isi->id}}" class="btn btn-danger btn-sm btn-outline-danger mr-5 mb-5 deaktif">
							Deaktifkan Akun</a>
							<a href="javascript:void(0)" id="reset_{{$isi->id}}" data-id="{{$isi->id}}" class="btn btn-danger btn-sm btn-outline-success mr-5 mb-5 reset">
							Reset Password</a>
							@else
							<a href="javascript:void(0)" data-id="{{$isi->id}}" class="btn btn-info btn-sm btn-outline-info mr-5 mb-5 aktif">
							Aktifkan Akun</a>
							@endif
							<!-- {{url('/admin/user-control/deaktif/')}}/{{$isi->id}} -->
						</td><!-- javascript:void(0) -->
					</tr>
					@php $i++; @endphp	
					@endforeach
				</tbody>--}}
			</table>
		</div>
	</div>
</div>
@endsection

@section('js')



<script type="text/javascript">
	$(document).ready(function() {
		table.draw();
	});

	var table = $('#tabelPegawai').DataTable({
		"ordering": true,
		pageLength: 8,
		lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		autoWidth: false,
		processing: true,
		serverSide: true,
		language: {
            processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>'
        },
		ajax: {
			type: "GET",
			dataType: "json",
			url: API_URL + '/kepegawaian/user-control/load-table',
		},
		columns: [
		{ data: 'id', name: 'id', 
		render: function(data, type, row, meta){
			return meta.row + meta.settings._iDisplayStart + 1;}
		},
		{ data: 'name', name: 'name', className: 'font-w600'  },
		{ data: 'flag', name: 'flag', className: 'text-center',
		render: function ( data ) {
			if (data == 1) {
				content = `<a class="badge badge-primary" href="javascript:void(0)">Aktif</a>`;
			} else {
				content = `<a class="badge badge-danger" href="javascript:void(0)">Tidak Aktif</a>`;
			}
			return content;}
		},
		{ data: 'flag', name: 'flag',
		render: function (data, type, row, meta) {
			if (data == 1) {
				content = `
				<a href="javascript:void(0)" id="deaktif_`+row.id+`" data-id="`+row.id+`" class="btn btn-danger btn-sm btn-outline-danger mr-5 mb-5 deaktif">Deaktifkan Akun</a>
				<a href="javascript:void(0)" id="reset_`+row.id+`" data-id="`+row.id+`" class="btn btn-danger btn-sm btn-outline-success mr-5 mb-5 reset">Reset Password</a>
				`;
			} else {
				content = `<a href="javascript:void(0)" data-id="`+row.id+`" class="btn btn-info btn-sm btn-outline-info mr-5 mb-5 aktif">Aktifkan Akun</a>`;
			}
			return content;},
			searchable: false,
			sortable: false
		},
		{ data : 'id', name : 'id', className: 'text-center',
		render: function(data) {
			content = `<a class="btn btn-outline-primary btn-sm btn-circle mr-5 mb-5" href="{{url('kepegawaian/user-control/`+data+`/edit')}}"><i class="fa fa-pencil"></i></a>`;
			return content;
			}
		},
		],
		order: [[ 0, "asc" ]],
	});

	$('#tabelPegawai tbody').on('click','.deaktif',function(){
		deleteModal($(this).data('id'));
	});
	$('#tabelPegawai tbody').on('click','.aktif',function(){
		aktifModal($(this).data('id'));
	});
	$('#tabelPegawai tbody').on('click','.reset',function(){
		resetModal($(this).data('id'));
	});
	function deleteModal(id)
	{	
		swal({
			title: 'Apakah Anda Yakin?',
			text: "User akan menjadi tidak aktif",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'btn btn-secondary',
			cancelButtonClass: 'btn btn-danger',
			confirmButtonText: 'Ya, Deaktifkan!',
			cancelButtonText: 'Batalkan',
			showLoaderOnConfirm: true,
			preConfirm: function() {
				return new Promise(function(resolve) {
					$.ajax({
						type: "GET",
						url: API_URL + "/admin/user-control/deaktif/" + id,
						dataType: "json",
						success: function (data) {
							table.draw(false);
							callSwal(data.type,data.title,data.text,0);
						},
						error: function () {
							callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
						}
					})
				});
			}
		})

	}
	function aktifModal(id)
	{
		swal({
			title: 'Apakah Anda Yakin?',
			text: "User akan menjadi aktif",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'btn btn-secondary',
			cancelButtonClass: 'btn btn-danger',
			confirmButtonText: 'Ya, Aktifkan!',
			cancelButtonText: 'Batalkan',
			showLoaderOnConfirm: true,
			preConfirm: function() {
				return new Promise(function(resolve) {
					$.ajax({
						type: "GET",
						url: API_URL + "/admin/user-control/aktif/" + id,
						dataType: "json",
						success: function (data) {
							table.draw(false);
							callSwal(data.type,data.title,data.text,0);
						},
						error: function () {
							callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
						}
					})
				});
			}
		})

	}
	function resetModal(id)
	{
		swal({
			title: 'Apakah Anda Yakin?',
			text: "Password User akan direset menjadi '123456'",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'btn btn-secondary',
			cancelButtonClass: 'btn btn-danger',
			confirmButtonText: 'Ya, Reset!',
			cancelButtonText: 'Batalkan',
			showLoaderOnConfirm: true,
			preConfirm: function() {
				return new Promise(function(resolve) {
					$.ajax({
						type: "GET",
						url: API_URL + "/admin/user-control/reset/" + id,
						dataType: "json",
						success: function (data) {
							table.draw(false);
							callSwal(data.type,data.title,data.text,0);
						},
						error: function () {
							callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
						}
					})
				});
			}
		})

	}
</script>

@endsection