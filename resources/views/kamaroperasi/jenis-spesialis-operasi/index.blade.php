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
						<button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahModal"><i class="fa fa-plus"></i> Tambah Jenis Spesialis Operasi</button>
						<h3 class="block-title">Daftar Jenis Spesialis Operasi</h3>
					</div>
					<div class="block-content block-content-full">
						<table class="table table-bordered table-striped table-vcenter js-dataTable-full">
							<thead>
								<tr>
									<th class="text-center" style="width: 5%"></th>
									<th>Nama</th>
									<th>SIRS Spesialisasi Bedah</th>
									<th class="text-center" style="width: 15%;">Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($jenis_spesialis_operasi as $item)
								<tr>
									<td class="text-center">{{$loop->iteration}}</td>
									<td class="font-w600">{{$item->nama}}</td>
									<td class="font-w600">{{$item->sirs_spesialisasi_bedah->nama}}</td>
									<td class="text-center">
										<button type="button" class="btn btn-sm btn-danger" onclick="deleteModal({{$item->id}}, '{{$item->nama}}')" data-toggle="tooltip" title="Hapus Data">
											<i class="fa fa-trash"></i>
										</button>
										<button type="button" class="btn btn-sm btn-primary" onclick="editModal({{$item->id}},'{{$item->nama}}', {{$item->sirs_spesialisasi_bedah->id ?? '0'}},'{{$item->sirs_spesialisasi_bedah->nama ?? '0'}}' )" data-toggle="tooltip" title="Edit Data">
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
				<h4 class="modal-title">Tambah Jenis Spesialis Operasi</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{url('kamaroperasi/jenis-spesialis-operasi/create')}}">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="form-group">
						<label>Jenis Spesialis Operasi</label>
						<input type="text" name="nama" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>SIRS - Spesialisasi Bedah</label>
						<select class="js-select2 form-control" name="sirs_spesialisasi_bedah_id" style="width: 100%;"required>
                            <option value="" selected="" disabled="">Pilih Spesialisasi</option>
                            @foreach($sirs_spesialisasi_bedah as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
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
				<h4 class="modal-title">Edit Jenis Spesialis Operasi</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{url('kamaroperasi/jenis-spesialis-operasi/edit')}}">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" id="id" name="id" class="form-control">
						<label>Jenis Spesialis Operasi</label>
						<input type="text" id="nama" name="nama" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>SIRS - Spesialisasi Bedah</label>
						<select class="js-select2 form-control" id="sirs_spesialisasi_bedah" name="sirs_spesialisasi_bedah_id" style="width: 100%;"required>
                            <option value="" selected="" disabled="">Pilih Spesialisasi</option>
                            @foreach($sirs_spesialisasi_bedah as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
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
				<h4 class="modal-title">Hapus Jenis Sepsialis Operasi</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" action="{{url('kamaroperasi/jenis-spesialis-operasi/delete')}}">
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
	function editModal(id,nama,sirs_spesialisasi_bedah_id,sirs_spesialisasi_bedah_nama)
	{
		$('#editModal #id').val(id)
		$('#editModal #nama').val(nama)
		$(`#editModal #sirs_spesialisasi_bedah`).val(sirs_spesialisasi_bedah_id);
		$(`#editModal #sirs_spesialisasi_bedah`).select2().trigger("change");
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