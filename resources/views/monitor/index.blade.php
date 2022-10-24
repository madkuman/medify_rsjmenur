<!doctype html>
<html lang="en" class="no-focus">
<head>
	<style type="text/css">
	input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}
	
	input[type="number"] {
		-moz-appearance: textfield;
	}
</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

<title>Monitor</title>

<meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
<meta name="author" content="pixelcave">
<meta name="robots" content="noindex, nofollow">

<!-- Open Graph Meta -->
<meta property="og:title" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework">
<meta property="og:site_name" content="Codebase">
<meta property="og:description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
<meta property="og:type" content="website">
<meta property="og:url" content="">
<meta property="og:image" content="">

<!-- Icons -->
<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
<link rel="shortcut icon" href="assets/img/favicons/favicon.png">
<link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicons/favicon-192x192.png">
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon-180x180.png">
<!-- END Icons -->

<!-- Stylesheets -->
<!-- Codebase framework -->
<link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">

<!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
<!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
<!-- END Stylesheets -->
</head>
<body>
	<div id="page-container" class="main-content-boxed">
		<!-- Main Container -->
		<main id="main-container">
			<!-- Page Content -->
			<div class="bg-image" style="background-image: url('config("app.logo_url")');">
				<div class="hero-static content content-full bg-white-op-95 invisible" data-toggle="appear" data-class="animated fadeIn">
					<!-- Avatar -->
					<div class="pt-30 pb-10 px-5 text-center">
						<img class="img-avatar img-avatar-sm" src="assets/img/rumkital.png" alt="">
						<h5 class="h5 font-w700 my-10">Selamat Datang</h5>
						<h6 class="h6 font-w400 text-muted mb-5">Masukkan Nomor HP dan Kode Booking Anda</h6>
					</div>
					<!-- END Avatar -->

					<!-- Unlock Content -->
					<div class="row justify-content-center px-5">
						<div class="col-sm-8 col-md-6 col-xl-5">
							<!-- jQuery Validation (.js-validation-lock class is initialized in js/pages/op_auth_lock.js) -->
							<!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
							<form action="" method="">
								<div class="form-group row">
									<div class="col-12">
										<label for="lock-password" style="font-size: 1rem">Nomor HP</label>
										<input type="number" class="form-control border-primary" style="height: 60px; font-size: 2rem;" name="no_hp">
									</div>
									<div class="col-12 mt-20">
										<label for="lock-password" style="font-size: 1rem">Kode Booking</label>
										<input type="text" class="form-control border-primary" style="height: 60px; font-size: 2rem;" name="kode_booking">
									</div>
								</div>
								<div class="form-group mt-30">
									<button type="submit" class="btn btn-block btn-hero btn-noborder btn-primary">
										<i class="fa fa-paper-plane mr-10"></i> Cetak
									</button>
								</div>
							</form>
						</div>
					</div>
					<!-- END Unlock Content -->
				</div>
			</div>
			<!-- END Page Content -->
		</main>
		<!-- END Main Container -->
	</div>
	<!-- END Page Container -->

	<!-- Codebase Core JS -->
	<script src="assets/js/core/jquery.min.js"></script>
	<script src="assets/js/core/bootstrap.bundle.min.js"></script>
	<script src="assets/js/core/jquery.slimscroll.min.js"></script>
	<script src="assets/js/core/jquery.scrollLock.min.js"></script>
	<script src="assets/js/core/jquery.appear.min.js"></script>
	<script src="assets/js/core/jquery.countTo.min.js"></script>
	<script src="assets/js/core/js.cookie.min.js"></script>
	<script src="assets/js/codebase.js"></script>

	<!-- Page JS Plugins -->
	<script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

	<!-- Page JS Code -->
	<script src="assets/js/pages/op_auth_lock.js"></script>
	<script type="text/javascript">
		$('form').on('focus', 'input[type=number]', function(e) {
			$(this).on('wheel', function(e) {
				e.preventDefault();
			});
		});
		$('form').on('focus', 'input[type=number]', function(e) {
			$(this).on('wheel', function(e) {
				e.preventDefault();
			});
		});
	</script>
</body>
</html>