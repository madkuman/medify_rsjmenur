@extends('layouts.main-dashboard')

@section('title')
Admin - Input SIRS Spesialisasi Bedah Baru
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
				Input SIRS - Spesialisasi Bedah Baru
				@else
				Edit SIRS - Spesialisasi Bedah
				@endif
			</h3>
		</div>
		<div class="block-content">
			<!--ketika dikoding ini diganti ya action sama methodnya -->
			<form action="{{url('admin/sirs-spesialisasi-bedah/simpan')}}" method="POST">
			{{csrf_field()}}
			@if(!empty($data))
			<input type="hidden" name="id" value="{{$data->id}}">
			@endif			
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nama Spesialisasi Bedah</label>
							<input type="text" class="form-control" placeholder="Nama Spesialisasi" name="nama" 
							@if(!empty($data))
							value="{{$data->nama}}"
							@endif autocomplete="off">
						</div>
						<div class="form-group">
							<button class="btn btn-info btn-hero pull-right">Simpan</button>
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
			text: "Spesialisasi Bedah akan terhapus dari daftar",
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
        $("#del-btn").attr('href','{{url('sirs-spesialisasi-bedah/delete')}}' + '/' + id)
        $("#show-name").html('Anda yakin ingin menghapus data Spesialisasi Bedah ' + nama + '?')

    })
</script>

@endsection