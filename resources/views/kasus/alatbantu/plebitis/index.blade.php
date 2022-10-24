@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Plebitis - Kasus
@endsection

@section('content')
<!-- Main Container -->
<main id="main-container">
	@include('kasus.layouts.header')

	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">

						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-success min-width-125 ml-5 float-right btn-modal-master" data-val=""><i class="fa fa-pencil"></i> Tambah Cath</button>
						@endif

						<h5>Surveilans Plebitis</h5>
						<hr>
						@include('kasus.alatbantu.plebitis.surveilans')
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/plebitis/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.plebitis.create-modal')
@include('kasus.alatbantu.plebitis.edit-modal-master')
@endsection

@section('js')

<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteBtn").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#deleteInputId').val(id);
			swal({
				title: "Hapus",
				text: "Apakah anda yakin akan menghapus data ini?",
				showCancelButton: true,
				reverseButtons: true,
				type: 'warning',
				confirmButtonClass: "btn btn-danger",
				cancelButtonClass: "btn btn-default",
				confirmButtonText: "Hapus",
				cancelButtonText: "Kembali",
				closeOnConfirm: false
			}).then(function(result) {
				if(result.value)
				{
					$('#formDelete').submit();
				}
			});
		});
	});


	$('.btn-modal-surveilans').click(function(){
		var parent_id = $(this).data('parent-id')
		$('#addModal .input-parent-id').val(parent_id)
	})


	$('#editModalMaster input[name="jenis_cath"]').change(function(){
		$('#editModalMaster input[name="jenis_cath_lain"]').val("")
	})

	$('#editModalMaster input[name="jenis_cath_lain"]').keyup(function(){
		$('#editModalMaster input[name="jenis_cath"]').prop('checked',false)
	})
	
	$('#editModalMaster input[name="jenis_cairan"]').change(function(){
		$('#editModalMaster input[name="jenis_cairan_lain"]').val("")
	})

	$('#editModalMaster input[name="jenis_cairan_lain"]').keyup(function(){
		$('#editModalMaster input[name="jenis_cairan"]').prop('checked',false)
	})

	$('.btn-modal-master').click(function(){
		var val = $(this).data('val')
		var id = $(this).data('id')

		$('#editModalMaster input[name="tanggal_pasang"]').val("")
		$('#editModalMaster input[name="tanggal_lepas"]').val("")
		$('#editModalMaster input[name="id"]').val("")
		$('#editModalMaster input[name="jenis_cath"]').prop('checked',false)
		$('#editModalMaster input[name="jenis_cath_lain"]').val("")
		$('#editModalMaster input[name="jenis_cairan"]').prop('checked',false)
		$('#editModalMaster input[name="jenis_cairan_lain"]').val("")
		$('#editModalMaster input[name="nomor_cath"]').prop('checked',false)
		$('#editModalMaster input[name="antibiotik"]').val("")

		if(val != ''){
			$('#editModalMaster input[name="tanggal_pasang"]').val(val.tanggal_pasang)
			$('#editModalMaster input[name="tanggal_lepas"]').val(val.tanggal_lepas)
			$('#editModalMaster input[name="id"]').val(id)
			$('#editModalMaster input[name="jenis_cath"][value="'+val.jenis_cath+'"]').prop('checked',true)
			$('#editModalMaster input[name="jenis_cath_lain"]').val(val.jenis_cath_lain)
			$('#editModalMaster input[name="jenis_cairan"][value="'+val.jenis_cairan+'"]').prop('checked',true)
			$('#editModalMaster input[name="jenis_cairan_lain"]').val(val.jenis_cairan_lain)
			$('#editModalMaster input[name="nomor_cath"][value="'+val.nomor_cath+'"]').prop('checked',true)
			$('#editModalMaster input[name="antibiotik"]').val(val.antibiotik)
		}
		$('#editModalMaster').modal('show')
	})
</script>
@endsection