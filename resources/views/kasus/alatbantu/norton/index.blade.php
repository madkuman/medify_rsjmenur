@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Norton - Kasus
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

						<ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active tab-default-nav tab-skor-nav" href="#nav-tab-skor">Skor</a>
							</li>
							<li class="nav-item">
								<a class="nav-link tab-surveilans-nav" href="#nav-tab-surveilans">Surveilans</a>
							</li>
						</ul>
						<div class="block-content tab-content">
							<div class="tab-pane active tab-skor-content tab-default-content" id="nav-tab-skor" role="tabpanel">
									@include('kasus.alatbantu.norton.index-skoring')
							</div>
							<div class="tab-pane tab-surveilans-content" id="nav-tab-surveilans" role="tabpanel">
								@include('kasus.alatbantu.norton.index-surveilans')
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>


<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/norton/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/norton/delete-surveilans" id="formDeleteSurveilans">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputIdSurveilans">
	
</form>

@include('kasus.alatbantu.norton.add')
@include('kasus.alatbantu.norton.add2')
@include('kasus.alatbantu.norton.edit-surveilans')

<!-- END Main Container -->    
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

		$(".deleteBtnSurveilans").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#deleteInputIdSurveilans').val(id);
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
					$('#formDeleteSurveilans').submit();
				}
			});
		});

		$(".editBtnSurveilans").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$.ajax({
				url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/alat-bantu/norton/get/'+ id,
				type: 'GET',
				dataType: 'json',
				tryCount : 0,
				retryLimit : 3,
				beforeSend: function(){
					$('#main-page-loading').fadeIn()
				},
				complete: function(){
					$('#main-page-loading').fadeOut()
				},
				success: function(data) {
					$('#editModalSurveilans #input_id').val(data.id)
					$('#editModalSurveilans #input_lokasi_id').val(data.lokasi_id)
					if(data.val.temperatur_kulit == 1) $('#editModalSurveilans #temperatur_kulit').prop('checked', true);
					if(data.val.konsitensi_jaringan == 1) $('#editModalSurveilans #konsitensi_jaringan').prop('checked', true);
					if(data.val.gatal == 1) $('#editModalSurveilans #gatal').prop('checked', true);
					if(data.val.nyeri == 1) $('#editModalSurveilans #nyeri').prop('checked', true);
					if(data.val.abrasi == 1) $('#editModalSurveilans #abrasi').prop('checked', true);
					if(data.val.melepuh == 1) $('#editModalSurveilans #melepuh').prop('checked', true);
					if(data.val.lubang_yang_dangkal == 1) $('#editModalSurveilans #lubang_yang_dangkal').prop('checked', true);
					if(data.val.necrosis_jaringan_subkutan == 1) $('#editModalSurveilans #necrosis_jaringan_subkutan').prop('checked', true);
					if(data.val.lubang_yang_dalam == 1) $('#editModalSurveilans #lubang_yang_dalam').prop('checked', true);
					if(data.val.necrosis_luas == 1) $('#editModalSurveilans #necrosis_luas').prop('checked', true);
					if(data.val.kerusakan_otot_tulang == 1) $('#editModalSurveilans #kerusakan_otot_tulang').prop('checked', true);
					if(data.val.ganti_posisi == 1) $('#editModalSurveilans #ganti_posisi').prop('checked', true);
					if(data.val.kasur_angin == 1) $('#editModalSurveilans #kasur_angin').prop('checked', true);
					if(data.val.perban_hidrokoloid == 1) $('#editModalSurveilans #perban_hidrokoloid').prop('checked', true);
					if(data.val.perban_alginat == 1) $('#editModalSurveilans #perban_alginat').prop('checked', true);
					if(data.val.krim_dan_salep == 1) $('#editModalSurveilans #krim_dan_salep').prop('checked', true);
					if(data.val.antibiotik == 1) $('#editModalSurveilans #antibiotik').prop('checked', true);
					if(data.val.suplemen_makanan == 1) $('#editModalSurveilans #suplemen_makanan').prop('checked', true);
					if(data.val.debridement == 1) $('#editModalSurveilans #debridement').prop('checked', true);
					if(data.val.analgesik == 1) $('#editModalSurveilans #analgesik').prop('checked', true);
					if(data.val.pembedahan == 1) $('#editModalSurveilans #pembedahan').prop('checked', true);

					$('#editModalSurveilans').modal('show')
				},
				error:function(data){
					this.tryCount++;
					if (this.tryCount <= this.retryLimit) {

						$.ajax(this);
						return;
					}else{
						$.notify({
							title: '<strong>Sorry</strong>',
							message: 'Terjadi kesalahan server'
						},{
							type: 'danger',
							placement: {
								from: "top",
								align: "center"
							},
							delay: 3000
						});
						$('#cppt_button_verifikasi_loading_'+index).hide()
						$('#cppt_button_verifikasi_check'+index).show()
					}  
				}
			});

		});


	});
</script>
@include('layouts.components2.js.js-nav-tab')
@endsection