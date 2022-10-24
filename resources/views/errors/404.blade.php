
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>404 - Page Not Found</title>

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
	<div class="flex-center position-ref full-height">
		<div class="content">
			<h1 class="font-w300">Ups! Sepertinya anda hilang.</h1>
			<h2 class="display-1"> 4 <img src="{{url('assets/img')}}/error-400-scareddinosaur-color.svg" style="height: 125px"> 4 </h2>
			<div class="title">
				{{ empty($exception->getMessage()) ?  'Anda mengakses halaman yang tidak ada pada aplikasi kami.' : $exception->getMessage()  }}
			</div>
			<a href="{{url()->previous()}}"	>Kembali ke halaman sebelumnya</a>
		</div>
	</div>
</body>
</html>
