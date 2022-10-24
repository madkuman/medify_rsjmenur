<div class="pt-50 pb-10 px-5 text-center">
	<h2 class=" font-w700 my-10 text-light"></h2>
	<h3 class=" font-w600 mb-5 text-light">Silahkan pilih poliklinik yang ingin anda daftar</h3>
</div>

<div class="row justify-content-center px-5">
	<div class="col-10">
		{!! csrf_field() !!}
		<div class="slick-slider mb-0 mt-20">
			<div id="poli_pasien"></div>
		</div>
	</div>

	<div class="col-10">
		<div class="form-group mt-10">
			<div class="alert alert-danger text-center d-none" id="error-message-registrasi">
			</div>
			<button type="button" class="btn btn-block btn-hero btn-noborder big-button btn-primary button-next" data-next="dokter">
				<span class="button-action"><i class="fa fa-paper-plane mr-10"></i> Lanjutkan Mendaftar</span>
				<span class="button-loading hide"><i class="fa fa-spinner fa-spin fa-1x"></i> Silahkan Tunggu ...</span>
			</button>
			<button type="button" class="btn btn-block btn-hero btn-noborder big-button btn-secondary button-back" data-back="profil">
				<i class="si si-action-undo mr-10"></i> Kembali
			</button>
		</div>
	</div>
</div>