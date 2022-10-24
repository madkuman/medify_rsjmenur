<!-- Avatar -->
<div class="pt-80 pb-10 px-5 text-center">
	<h2 class=" font-w700 my-10 text-light">Pendaftaran Poliklinik</h2>
	<h5 class=" font-w400 mb-5 text-light">Masukkan Nomor RM dan Tanggal Lahir Anda</h5>
</div>
<!-- END Avatar -->

<!-- Unlock Content -->
<div class="row justify-content-center px-5">
	<div class="col-sm-8 col-md-6 col-xl-5">
		<form action="" method="POST" id="form-masuk">
			{!! csrf_field() !!}
			<div class="form-group row">
				<div class="col-12">
					<label for="lock-password" style="font-size: 1rem" class="text-light">Nomor RM</label>
					<input type="number" class="input-el form-control border-primary form-button" style="height: 50px; font-size: 2rem;" name="no_rm" id="no_rm">
				</div>
				<div class="col-12 mt-5">
					<label for="lock-password" style="font-size: 1rem" class="text-light">Tanggal Lahir <small class="text-light"> (contoh : 25-03-1996)</small></label>
					<input type="text" class="input-el form-control border-primary form-button js-masked-date-dash" style="height: 50px; font-size: 2rem;" name="tanggal_lahir" id="tanggal_lahir" placeholder="dd-mm-yyyy">
				</div>
			</div>
			<div class="form-group mt-5">
				<a href="javascript:void(0)" type="btn" class="btn btn-block btn-hero btn-noborder btn-primary btn-masuk" id="btn-masuk">
					<i class="fa fa-paper-plane mr-10"></i> Masuk
				</a>
			</div>
			<div class="alert alert-danger text-center d-none" id="error-message">
			</div>
		</form>
	</div>
</div>
<div class="row justify-content-center px-5 pt-20">
	<div class="col-sm-8 col-md-6 col-xl-5 row">
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-numpad btn-hero btn-primary mr-5 mb-5 form-button" value="1" style="width: 100%">
				<b style="font-size: 30px;">1</b>
			</button>
		</div>
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-numpad btn-hero btn-primary mr-5 mb-5 form-button" value="2" style="width: 100%">
				<b style="font-size: 30px;">2</b>
			</button>
		</div>
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-numpad btn-hero btn-primary mr-5 mb-5 form-button" value="3" style="width: 100%">
				<b style="font-size: 30px;">3</b>
			</button>
		</div>
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-hero btn-danger mr-5 mb-5 form-button btn-clear" style="width: 100%">
				CLEAR
			</button>
		</div>
		<!-- <div class="col-3 text-center px-5">
			<button type="button" class="btn btn-hero btn-danger mr-5 mb-5 form-button btn-delete" style="width: 100%">
				<i class="fa fa-chevron-left"></i>
			</button>
		</div> -->
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-numpad btn-hero btn-primary mr-5 mb-5 form-button" value="4" style="width: 100%">
				<b style="font-size: 30px;">4</b>
			</button>
		</div>
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-numpad btn-hero btn-primary mr-5 mb-5 form-button" value="5" style="width: 100%">
				<b style="font-size: 30px;">5</b>
			</button>
		</div>
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-numpad btn-hero btn-primary mr-5 mb-5 form-button" value="6" style="width: 100%">
				<b style="font-size: 30px;">6</b>
			</button>
		</div>
		<!-- <div class="col-3 text-center px-5">
			<button type="button" class="btn btn-hero btn-danger mr-5 mb-5 form-button btn-clear" style="width: 100%">
				CLEAR
			</button>
		</div> -->
		<div class="col-3 text-center">
		</div>
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-numpad btn-hero btn-primary mr-5 mb-5 form-button" value="7" style="width: 100%">
				<b style="font-size: 30px;">7</b>
			</button>
		</div>
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-numpad btn-hero btn-primary mr-5 mb-5 form-button" value="8" style="width: 100%">
				<b style="font-size: 30px;">8</b>
			</button>
		</div>
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-numpad btn-hero btn-primary mr-5 mb-5 form-button" value="9" style="width: 100%">
				<b style="font-size: 30px;">9</b>
			</button>
		</div>
		<div class="col-3 text-center">
		</div>
		<div class="col-3 text-center">
		</div>
		<div class="col-3 text-center px-5">
			<button type="button" class="btn btn-numpad btn-hero btn-primary mr-5 mb-5 form-button" value="0" style="width: 100%">
				<b style="font-size: 30px;">0</b>
			</button>
		</div>
		<div class="col-3 text-center">
		</div>
		<div class="col-3 text-center">
		</div>
	</div>
</div>