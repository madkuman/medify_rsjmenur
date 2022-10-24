
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>401 - Unauthorized Access</title>

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
			<h1 class="font-w300">Akun Belum Teraktivasi.</h1>
			<h2 class="display-1"> 4 <img src="{{url('assets/img')}}/error-400-scareddinosaur-color.svg" style="height: 125px"> 0 </h2>
			<div class="title">
					Silahkan minta ke Admin atau ke PERS untuk meminta aktivasi akun.
			</div>
			<a href="{{url('logout')}}">Keluar</a>
		</div>
	</div>
</body>
</html>
