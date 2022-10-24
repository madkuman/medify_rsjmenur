@extends('layouts.main-dashboard')

@section('title')
Admin - Input Informed Consent Baru
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				@if(empty($data))
				Input Informed Consent Baru
				@else
				Edit Informed Consent
				@endif
			</h3>
		</div>
		<div class="block-content">
			<!--ketika dikoding ini diganti ya action sama methodnya -->
			<form action="{{url('admin/kasus/informed-consent/simpan')}}" method="POST">
				{{csrf_field()}}
				@if(!empty($data))
				<input type="hidden" name="id" value="{{$data->id}}">
				@endif			
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label>Judul Informed Consent</label>
							<input type="text" class="form-control" placeholder="Nama Informed Consent" name="judul" 
							@if(!empty($data))
							value="{{$data->judul}}"
							@endif autocomplete="off">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-4"><label>Jenis Informasi</label></div>
					<div class="col-7"><label>Isi Informasi</label></div>
					<div class="col-1"></div>
				</div>
				<div id="rowContent">
					@forelse($data->jenis_informasi ?? [] as $key => $jenis_informasi)
					<div class="row mt-10">
						<div class="col-4">
							<input type="text" class="form-control" name="jenis_informasi[]" value="{{$jenis_informasi}}">
						</div>
						<div class="col-7">
							<textarea class="form-control" name="isi_informasi[]" rows="5">{{$data->isi_informasi[$key]}}</textarea>
						</div>
						<div class="col-1">
							<button type="button" class="btn btn-rounded btn-danger remove"><i class="fa fa-close"></i></button>
						</div>
					</div>
					@empty
					<div class="row mt-10">
						<div class="col-4">
							<input type="text" class="form-control" name="jenis_informasi[]">
						</div>
						<div class="col-7">
							<textarea class="form-control" name="isi_informasi[]" rows="5"></textarea>
						</div>
						<div class="col-1">
							<button type="button" class="btn btn-rounded btn-danger remove"><i class="fa fa-close"></i></button>
						</div>
					</div>
					@endforelse
				</div>
				<div class="row">
					<div class="col-12 text-center">
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 mt-10" id="addJenis"><i class="fa fa-plus"></i> Tambah</button>
					</div>
				</div>		
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<button class="btn btn-info btn-hero pull-right">Simpan</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
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

	function deleteModal(id)
	{
		swal({
			title: 'Apakah Anda Yakin?',
			text: "Data akan terhapus dari daftar",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'btn btn-secondary',
			cancelButtonClass: 'btn btn-danger',
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.value) {
				swal(
					'Deleted!',
					'Your file has been deleted.',
					'success'
					)
			}
		})

	}
	$(document).on("click",".btn-outline-danger", function () {
		var id = $(this).data('id')
		var nama = $(this).data('nama');
		console.log(id,nama);
		$("#del-btn").attr('href','{{url('gizi/bahan/delete')}}' + '/' + id)
		$("#show-name").html('Anda yakin ingin menghapus data informed consent ' + nama + '?')

	})

	function addJenis() {
		var row = 
		`<div class="row mt-10">
		<div class="col-4">
		<input type="text" class="form-control" name="jenis_informasi[]">
		</div>
		<div class="col-7">
		<textarea class="form-control" name="isi_informasi[]" rows="5"></textarea>
		</div>
		<div class="col-1">
		<button type="button" class="btn btn-rounded btn-danger remove"><i class="fa fa-close"></i></button>
		</div>
		</div>`;
		$('#rowContent').append(row);
	}

	$('#addJenis').click(function() {
		addJenis();
	});

	$('#rowContent').on('click', '.remove', function(){
		if($('#rowContent .row').length > 1){
			$(this).closest('.row').remove();
		}
	});

</script>

@endsection