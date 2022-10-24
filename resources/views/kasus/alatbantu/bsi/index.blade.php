@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - BSI - Kasus
@endsection

@section('css')
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
						<h5>Pemakaian Alat Invasif CVC</h5>
						<ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active tab-default-nav tab-surveilans-nav" href="#nav-tab-surveilans">Surveilans</a>
							</li>
							<li class="nav-item">
								<a class="nav-link tab-audit-nav " href="#nav-tab-audit">Audit</a>
							</li>
						</ul>

						<div class="block-content tab-content">
							<div class="tab-pane active tab-surveilans-content tab-default-content" id="nav-tab-surveilans" role="tabpanel">
								@if(session('my_role_'.$kasus->nomor_kasus))
								<button type="button" class="btn btn-success min-width-125 ml-5 float-right btn-modal-master" data-toggle="modal" data-target="#editModalMaster"><i class="fa fa-pencil"></i> Tambah CVC</button>

								@endif

								<h4 class="mb-5 pl-5">#BSI- Surveilans</h4>
								<br><hr>
								@include('kasus.alatbantu.bsi.surveilans')
							</div>
							<div class="tab-pane tab-audit-content  " id="nav-tab-audit" role="tabpanel">
								@if($is_ipcn)
								<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right mr-10" data-toggle="modal" data-target="#addModalAudit" id="add_pre_ops"><i class="fa fa-pencil"></i> Isi Audit</button>
								@endif
								<h4 class="mb-5 pl-5">#BSI- Audit</h4>
								<br><hr>
								@include('kasus.alatbantu.bsi.audit')
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/bsi/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.bsi.add')
@include('kasus.alatbantu.bsi.add-master')
@include('kasus.alatbantu.bsi.add-audit')
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

	$('input[type=radio][name=kultur_cvc]').on('change', function() {
		if (this.value == 1) {
			$('#kultur_cvc_keterangan').show();
		}
		else{
			$('#kultur_cvc_keterangan').hide();
		}
	});



	$('.btn-modal-surveilans').click(function(){
		var parent_id = $(this).data('parent-id')
		$('#addModal .input-parent-id').val(parent_id)
	})


	$('#editModalMaster input[name="lokasi"]').change(function(){
		$('#editModalMaster input[name="lokasi_lainnya"]').val("")
	})

	$('#editModalMaster input[name="lokasi_lainnya"]').keyup(function(){
		$('#editModalMaster input[name="lokasi"]').prop('checked',false)
	})
	
	$('#editModalMaster input[name="nomor"]').change(function(){
		$('#editModalMaster input[name="nomor_lainnya"]').val("")
	})

	$('#editModalMaster input[name="nomor_lainnya"]').keyup(function(){
		$('#editModalMaster input[name="nomor"]').prop('checked',false)
	})

	$('.btn-modal-master').click(function(){
		var val = $(this).data('val')
		var id = $(this).data('id')

		$('#editModalMaster input[name="tanggal_pasang"]').val("")
		$('#editModalMaster input[name="tanggal_lepas"]').val("")
		$('#editModalMaster input[name="id"]').val("")
		$('#editModalMaster input[name="lokasi"]').prop('checked',false)
		$('#editModalMaster input[name="lokasi_lainnya"]').val("")
		$('#editModalMaster input[name="nomor"]').prop('checked',false)
		$('#editModalMaster input[name="nomor_lainnya"]').val("")
		$('#editModalMaster input[name="jenis"]').prop('checked',false)

		if(val != ''){
			$('#editModalMaster input[name="tanggal_pasang"]').val(val.tanggal_pasang)
			$('#editModalMaster input[name="tanggal_lepas"]').val(val.tanggal_lepas)
			$('#editModalMaster input[name="id"]').val(id)
			$('#editModalMaster input[name="lokasi"][value="'+val.lokasi+'"]').prop('checked',true)
			$('#editModalMaster input[name="lokasi_lainnya"]').val(val.lokasi_lainnya)
			$('#editModalMaster input[name="nomor"][value="'+val.nomor+'"]').prop('checked',true)
			$('#editModalMaster input[name="nomor_lainnya"]').val(val.nomor_lainnya)
			$('#editModalMaster input[name="jenis"][value="'+val.jenis+'"]').prop('checked',true)
		}
		$('#editModalMaster').modal('show')
	})
</script>
@include('layouts.components2.js.js-nav-tab')
@endsection