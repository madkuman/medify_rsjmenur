
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>500 - Server Error</title>

	<!-- Fonts -->
	<link rel="stylesheet" id="css-main" href="{{asset('assets/css/codebase.min.css')}}">

	<link rel="stylesheet" id="css-main" href="{{asset('assets/css/medifyhospitalv2.0.3.css')}}">

	<!-- Styles -->
	<style>
	html, body {
		background-color: #fff;
		color: #636b6f;
		font-weight: 100;
		height: 100vh;
		margin: 0;
	}

	.full-height {
		height: 100vh;
	}

	.flex-center {
		align-items: center;
		display: flex;
		justify-content: center;
	}

	.position-ref {
		position: relative;
	}

	.content {
		text-align: center;
	}

	.title {
		font-size: 24px;
		padding: 20px;
	}
</style>
</head>
<body>
	@php
		$random = rand(0,1) ;
		if($random == 1) $image = 'crydinosaur';
		else $image = 'doctordinosaur';
	@endphp
	<div class="flex-center position-ref full-height">
		<div class="content">
			<h1 class="font-w300 mb-5">Sorry, Terjadi Kesalahan</h1>
			<h2 class="display-1 mt-20"> 5 <img src="{{url('assets/img')}}/error-500-{{$image}}-color.svg" style="height: 125px"> 0 </h2>
			<div class="title">
				@if($random == 1)
				Silahkan coba lagi, jika masih sering terjadi hubungi tim kami.
				@else
				Tim kami akan segera menyelesaikan masalah anda
				@endif
			</div>
			<a href="{{url()->previous()}}"	>Kembali ke halaman sebelumnya</a>
		</div>
	</div>
</body>
</html>
