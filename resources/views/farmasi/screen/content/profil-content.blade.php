<!-- Avatar -->
<div class="pt-80 pb-10 px-5 text-center">
	<h2 class=" font-w700 my-10 text-light"></h2>
	<h5 class=" font-w600 mb-5 text-light pt-80">Periksa terlebih dahulu identitas Anda</h5>
</div>
<!-- END Avatar -->

<!-- Unlock Content -->
<div class="row justify-content-center px-5">
	<div class="col-sm-8 col-md-6 col-xl-5">
		{!! csrf_field() !!}
		<div class="block block-bordered mb-0">
			<div class="block-content">
				<div class="row" style="margin-left: 1%;">
					<div class="col-2 px-0 full-only">
						<img src="{{url('')}}/assets/img/placeholder.jpg" class="img-avatar-lg profil_avatar">
					</div>
					<div class="col-lg-10 col-12 pl-20" style="padding-top: 0px;">
						<h2 class="title mb-5 profil_nama">Hari Febriansyah</h2>
						<h5 class="font-w400 mb-5 profil_usia">Laki laki, 20 tahun</h5>
						<h5 class="font-w400 mb-0 profil_rm">No Rekam Medis : #123456</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group mt-50">
			<button type="button" class="btn btn-block btn-hero btn-noborder big-button btn-primary button-next" data-next="registrasi">
				<span class="button-action"><i class="fa fa-paper-plane mr-10"></i> Pilih Resep </span>
				<span class="button-loading hide"><i class="fa fa-spinner fa-spin fa-1x"></i> Silahkan Tunggu ...</span>
			</button>
			<button type="button" class="btn btn-block btn-hero btn-noborder big-button btn-secondary button-back" data-back="index">
				<i class="si si-action-undo mr-10"></i> Kembali
			</button>
		</div>
	</div>
</div>
<!-- END Unlock Content -->