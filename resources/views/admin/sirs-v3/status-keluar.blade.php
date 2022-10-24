@extends('layouts.main-dashboard')

@section('title')
Admin - SIRS V3 - Pekerjaan
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/datatables.min.css')}}"/>
@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
	<div class="block p-10"  >
		<div class="block-header">
			<h3 class="block-title">
                Daftar Data Pekerjaan
			</h3>
		</div>
		<div class="block-content">
			<div class="row">
				<div class="col-12">
					<hr>
					<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="show-data-table">
						<thead>
							<tr class="text-center">
								<th width="5%">No</th>
								<th>Nama Pekerjaan</th>
								<th width="20%">Jenis Pekerjaan SIRS</th>
								<th width="20%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($statuskeluar_all as $item)
							<tr>
								<td class="text-center">{{ $loop->iteration }}</td>
								<td>{{ $item->nama }}</td>
								<td>{{ $statuskeluar_sirs[$item->sirs_status_keluar_id] ?? '-' }}</td>
								<td class="text-center">
									<a href="javascript:void(0)" class="btn btn-alt-info btn-edit" data-id="{{ $item->id }}">
									<i class="fa fa-pencil"></i> Edit
									</a>
								</td>
							</tr>	
							@empty
							<tr>
								<td colspan="4" class="text-center">Data belum tersedia</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal-edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-bg" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <form method="POST" action="{{ url()->current().'/save' }}">
                    {{ csrf_field() }}
					<input type="hidden" name="id" value="0">
                    <div class="modal-title font-size-lg font-w600">
                        Edit Data Status Keluar
                        <hr style="border-top: 2px solid #0b72c6">
                    </div>
                    <div class="modal-body px-0">
                        <div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" readonly>
								</div>
								<div class="form-group">
									<label>Status Keluar SIRS</label>
									<select name="sirs_status_keluar_id" class="js-select2" style="width: 100%">
										<option value="">Pilih Jenis Status Keluar</option>
										@forelse ($statuskeluar_sirs as $id => $item)
										<option value="{{ $id }}">{{ $item }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
                        </div>
                    </div>
                    <div class="modal-footer px-0">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-click-animate"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{URL::to('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::to('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
var statuskeluar_all = @json($statuskeluar_all, JSON_PRETTY_PRINT);
$('.js-dataTable-full').dataTable();

$(document).on('click', '.btn-edit', function () {
	id = $(this).data('id');
	row = statuskeluar_all[id];
	$('#modal-edit').find('input[name=id]').val(id);
	$('#modal-edit').find('input[name=nama]').val(row.nama);
	$('#modal-edit').find('select[name=sirs_status_keluar_id]').val(row.sirs_status_keluar_id).trigger('change');
	$('#modal-edit').modal('show');
})
</script>
@endsection