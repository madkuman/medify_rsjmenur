@extends('layouts.main2')

@section('css')

@endsection

@section('title')
Pengaturan - Kamar Operasi
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">
			<div class="col-12">
				<div class="block">
					<div class="block-content block-content-full">
						<button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahModal"><i class="fa fa-plus"></i> Tambah Peran Tim</button>
						<h3 class="block-title">Daftar Peran Tim</h3>
					</div>
					<div class="block-content block-content-full">
						<table class="table table-bordered table-striped table-vcenter js-dataTable-full">
							<thead>
								<tr>
									<th class="text-center" style="width: 5%"></th>
									<th>Nama</th>
									<th class="text-center" style="width: 15%;">Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($peran as $item)
								<tr>
									<td class="text-center">{{$loop->iteration}}</td>
									<td class="font-w600">{{$item->nama}}</td>
									<td class="text-center">
										<button type="button" class="btn btn-sm btn-danger" onclick="deleteModal({{$item->id}}, '{{$item->nama}}')" data-toggle="tooltip" title="Hapus Data">
											<i class="fa fa-trash"></i>
										</button>
										<button type="button" class="btn btn-sm btn-primary" onclick="editModal({{$item->id}},'{{$item->nama}}')" data-toggle="tooltip" title="Edit Data">
											<i class="fa fa-pencil"></i>
										</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<div id="tambahModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Peran Tim</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{url('kamaroperasi/peran-tim/create')}}">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="form-group">
						<label>Nama Peran</label>
						<input type="text" name="nama" class="form-control" required="">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="editModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Peran Tim</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{url('kamaroperasi/peran-tim/edit')}}">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" id="id" name="id" class="form-control">
						<label>Nama Peran</label>
						<input type="text" id="nama" name="nama" class="form-control" required="">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary">Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Hapus Peran Tim</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{url('kamaroperasi/peran-tim/delete')}}">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" id="id" name="id" class="form-control">
						Apakah anda yakin untuk menghapus <strong id="text"></strong>?
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')


<script type="text/javascript">
	$('.js-dataTable-full').dataTable({
		"ordering": true,
		pageLength: 8,
		lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		autoWidth: false
	});
</script>


<script type="text/javascript">
	function editModal(id,nama)
	{
		$('#editModal #id').val(id)
		$('#editModal #nama').val(nama)
		$('#editModal').modal('show');
	}
	function deleteModal(id,nama)
	{
		$('#deleteModal #id').val(id)
		$('#deleteModal #text').html(nama)
		$('#deleteModal').modal('show');
	}
</script>

@endsection