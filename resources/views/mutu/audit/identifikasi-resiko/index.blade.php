@extends('mutu.layouts.main')

@section('title')
Mutu - Audit - Identifikasi Resiko
@endsection

@section('subtitle')
Form Identifikasi Resiko
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
							<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-identifikasi">Tambahkan Identifikasi Resiko</button>
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
								<table class="table table-bordered table-vcenter js-dataTable-full" id="identifikasi-table">
									<thead>
										<tr>
											<th class="text-center" style="width: 5%">#</th>
											<th class="text-center" style="width: 20%">Indikator Mutu</th>
											<th class="text-center" style="width: 20%">Kegiatan</th>
											<th class="text-center" style="width: 20%">Dampak</th>
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

@include('mutu.audit.identifikasi-resiko.components.modals')
@endsection

@section('js')
<script>
var table = null;
var indikator_resiko = [];
var indikator_mutu = @json($indikator_mutu, JSON_PRETTY_PRINT);

$(document).ready(function () {
    initTabel();
});

$(document).on('click', '.btn-edit', function () {
	this_id = $(this).data('id');
	resiko_data = indikator_resiko[this_id];
	indikator_id = resiko_data.indikator_id;

	$('textarea[name=indikator_judul]').val('').prop('readonly', false);
	$('textarea[name=indikator_kegiatan]').val('').prop('readonly', false);

	$('#modal-identifikasi').find('input,select,textarea').each(function(i, obj) {
		tagname = obj.tagName.toLowerCase();
		params = $(this).attr('name');
		if (resiko_data.hasOwnProperty(params)) {
			if (tagname == 'select') {
				$(this).val(resiko_data[params]).trigger('change');
				
				if (indikator_id != '' && params == 'indikator_id') {
					indikator_data = indikator_mutu[indikator_id];
					$('textarea[name=indikator_judul]').val(indikator_data.judul).prop('readonly', true);
					$('textarea[name=indikator_kegiatan]').val(indikator_data.kegiatan).prop('readonly', true);
				}
			} else if ($(this).hasClass('js-datepicker')) {
				$(this).datepicker('setDate', resiko_data[params]);
			} else {
				$(this).val(resiko_data[params]);
			}
		}
	});

	$('#modal-identifikasi').modal('show')
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

$('#modal-identifikasi').on('hidden.bs.modal', function () {
	$('#modal-identifikasi').find('input,textarea').not('input[name=_token]').val('');
	$('#modal-identifikasi').find('select').val('').trigger('change');
	$('#modal-identifikasi').find('textarea').prop('readonly', false);
});

$('select[name=indikator_id]').on("select2:select", function(e) { 
	indikator_id = $(this).val();
	$('textarea[name=indikator_judul]').val('').prop('readonly', false);
	$('textarea[name=indikator_kegiatan]').val('').prop('readonly', false);
	if (indikator_id != '') {
		indikator_data = indikator_mutu[indikator_id];
		$('textarea[name=indikator_judul]').val(indikator_data.judul).prop('readonly', true);
		$('textarea[name=indikator_kegiatan]').val(indikator_data.kegiatan).prop('readonly', true);
	}
});

function initTabel() {
	table = $('#identifikasi-table').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		ajax: {
			dataSrc: "data",
			url  : API_URL + '/mutu/audit/identifikasi-resiko/get-data',
			type :'GET'
		},
		language: {
			processing: `<i class="fa fa-2x fa-spinner fa-spin text-secondary"></i>`
		},
		columns: [
			{ data: 'resiko_sasaran', render: function(data, type, row, meta) {
					indikator_resiko[row.id] = row;
					return row.DT_Row_Index;
				}
			},
			{ data: 'indikator.judul' },
			{ data: 'indikator.kegiatan' },
			{ data: 'dampak' },
			{ data: 'penanggung_jawab' },
			{ data: 'opsi', searchable: false, sortable: false, className: 'text-center'}
		],
		columnDefs: [
			{
				"targets": 0,
				"className": "text-center",
				"searchable":false,
			}
		]
	});
}
</script>
@endsection