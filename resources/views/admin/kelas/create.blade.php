@extends('layouts.main-dashboard')

@section('title')
Admin - Input Kelas Baru
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
				Input Kelas Baru
				@else
				Edit Nama Kelas
				@endif
			</h3>
		</div>
		<div class="block-content">
			<!--ketika dikoding ini diganti ya action sama methodnya -->
			<form action="{{url('admin/kelas/simpan')}}" method="POST" id="formSubmit" >
			{{csrf_field()}}
			@if(!empty($data))
			<input type="hidden" name="id" value="{{$data->id}}">
			@endif			
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nama Kelas</label>
							<input type="text" class="form-control" placeholder="Nama kelas" name="nama" 
							@if(!empty($data))
							value="{{$data->nama}}"
							@endif autocomplete="off">
						</div>
						<div class="form-group">
							<label>Jenis Kelas</label><br>
							<input type="checkbox" id="rawat_inap" name="rawat_inap" value="1"
							@if(!empty($data))
								@if($data->rawat_inap) checked @endif
							@endif
							> Rawat Inap
							<br>
							<input type="checkbox" id="rawat_jalan" name="rawat_jalan" value="1"
							@if(!empty($data))
								@if($data->rawat_jalan) checked @endif
							@endif> Rawat Jalan
							<br>
							<input type="checkbox" id="igd" name="igd" value="1"
							@if(!empty($data))
								@if($data->igd) checked @endif
							@endif> IGD
							<br>
							<input type="checkbox" id="medical_checkup" name="medical_checkup" value="1"
							@if(!empty($data))
								@if($data->medical_checkup) checked @endif
							@endif> Medical Checkup
							<br>
						</div>
						<div class="form-group" id="errorJenisKelas" style="display: none">
							<div class="alert alert-danger">
								<h5>Isi Jenis Kelas</h5>
								<p>Pilih minimal 1 jenis kelas dari 4 pilihan tersedia</p>
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-info btn-hero pull-right btn-submit" type="button">Simpan</button>
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
			text: "Bahan akan terhapus dari daftar bahan dan resep",
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
        $("#show-name").html('Anda yakin ingin menghapus data kelas ' + nama + '?')

    })

    $('.btn-submit').click(function(){
    	var is_checked = 0;
    	console.log(is_checked)
    	is_checked = $('#rawat_jalan').is(":checked")
    	if(!is_checked) is_checked = $('#rawat_inap').is(":checked")
    	if(!is_checked) is_checked = $('#igd').is(":checked")
    	if(!is_checked) is_checked = $('#medical_checkup').is(":checked")

    	if(is_checked)
    	{
    		$('#formSubmit').submit();
    		$('#errorJenisKelas').hide();
    	}
    	else
    	{
    		$('#errorJenisKelas').show();
    	}

    })
</script>

@endsection