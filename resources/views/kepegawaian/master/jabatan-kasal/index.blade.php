@extends('kepegawaian.layouts.main')

@section('title')
Master Kualifikasi
@endsection

@section('subtitle')
Master Kualifikasi
@endsection

@section('css')

@endsection

@section('content')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="{{url()->current()}}/baru" class="pull-right">
					<i class="fa fa-plus-circle"></i> Tambah Jabatan Kasal</a>
				</small> 
				Daftar Jabatan Kasal
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="" width="50px">No</th>
						<th>Nama</th>
						<th>Urutan Print</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@php $i = 1; @endphp
					@foreach($jabatan_kasal as $item)
					<tr>
						<td class="">{{$i}}</td>
						<td class="font-w600">{{$item->nama}}</td>
						<td class="font-w600">{{$item->order}}</td>
						<td class="">
							<a href="{{url('/kepegawaian/master/jabatan-kasal/edit/')}}/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5">
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
	<div id="deletemodal" class="modal fade" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Hapus Data</h4>
				</div>
				<div class="modal-body">
					<p id="show-name"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<a id="del-btn">
						<button type="button" class="btn btn-danger pull-right" style="margin-left: 4px ;">Hapus</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	@endsection

	@section('js')
	
	

	<script type="text/javascript">
		jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});

		$(document).on("click",".btn-outline-danger", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');
			console.log(id,nama);
			$("#del-btn").attr('href','{{url('kepegawaian/master/jabatan-kasal/delete')}}' + '/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Kualifikasi ' + nama + '?')

		})
	</script>

	@endsection