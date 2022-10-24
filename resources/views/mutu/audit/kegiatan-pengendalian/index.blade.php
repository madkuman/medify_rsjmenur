@extends('mutu.layouts.main')

@section('title')
Mutu - Audit - Kegiatan Pengendalian
@endsection

@section('subtitle')
Form Kegiatan Pengendalian
@endsection

@section('content')
<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="content">
		<div class="row">
			<div class="col-12">
				<div class="block">
					<div class="block-header">
						<div class="block-title font-size-default">
							<a class="pl-20" href="{{url()->previous()}}"><i class="si si-action-undo"></i>&nbsp;&nbsp;&nbsp;Kembali ke halaman sebelumnya</a>
						</div>
						<div class="block-options">
							<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-kegiatan">Tambahkan Kegiatan Pengendalian</button>
						</div>
					</div>
					<div class="block-content pt-20">
						<div class="row">
							<div class="col-12">
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-4 mb-20">
							</div>
							<div class="col-12 autoscroll-x" style="">
								<table class="table table-bordered table-vcenter js-dataTable-full" id="kegiatan-table">
									<thead>
										<tr>
											<th class="text-center" style="width: 5%">#</th>
											<th class="text-center" style="width: 20%">Uraian Resiko</th>
											<th class="text-center" style="width: 20%">Standar</th>
											<th class="text-center" style="width: 20%">Rencana</th>
											<th class="text-center">Penanggung Jawab</th>
											<th class="text-center" style="width: 12%">Opsi</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<form method="POST" action="{{url()->current()}}/delete" id="form-hapus">
	{{csrf_field()}}
	<input name="id" type="hidden">
</form>

@include('mutu.audit.kegiatan-pengendalian.components.modals')
@endsection

@section('js')
<script>
var table = null;
var kegiatan = [];

$(document).ready(function () {
    initTabel();
});

$(document).on('click', '.btn-edit', function () {
	this_id = $(this).data('id');
	kegiatan_data = kegiatan[this_id];

	$('#modal-kegiatan').find('input,select,textarea').each(function(i, obj) {
		tagname = obj.tagName.toLowerCase();
		params = $(this).attr('name');
		if (kegiatan_data.hasOwnProperty(params)) {
			if (tagname == 'select') {
				$(this).val(kegiatan_data[params]).trigger('change');
			} else if ($(this).hasClass('js-datepicker')) {
				$(this).datepicker('setDate', kegiatan_data[params]);
			} else {
				$(this).val(kegiatan_data[params]);
			}
		}
	});

	$('#modal-kegiatan').modal('show')
})

$(document).on('click', '.btn-delete', function () {
	row_id = $(this).data('id');
	$('#form-hapus').find('input[name=id]').val(row_id);
    
	swal({
        title: 'Apa anda yakin menghapus data ini?',
        type: 'warning',
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-secondary',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $('#form-hapus').submit();
        }
    })    
})

$('#modal-kegiatan').on('hidden.bs.modal', function () {
	$('#modal-kegiatan').find('input,textarea').not('input[name=_token]').val('');
	$('#modal-kegiatan').find('select').val('').trigger('change');
});

function initTabel() {
	table = $('#kegiatan-table').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		ajax: {
			dataSrc: "data",
			url  : API_URL + '/mutu/audit/kegiatan-pengendalian/get-data',
			type :'GET'
		},
		language: {
			processing: `<i class="fa fa-2x fa-spinner fa-spin text-secondary"></i>`
		},
		columns: [
			{ data: 'uraian_resiko', searchable: false, className: 'text-center', render: function(data, type, row, meta) {
					kegiatan[row.id] = row;
					return row.DT_Row_Index;
				}
			},
			{ data: 'uraian_resiko' },
			{ data: 'kegiatan_terpasang_uraian' },
			{ data: 'rencana' },
			{ data: 'penanggung_jawab' },
			{ data: 'opsi', searchable: false, sortable: false, className: 'text-center'}
		]
	});
}
</script>
@endsection