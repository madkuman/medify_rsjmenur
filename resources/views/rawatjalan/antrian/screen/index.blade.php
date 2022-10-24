<!doctype html>
<html lang="en" class="no-focus">
<head>
	<title>Screen TV - Rawat Jalan</title>
	@include('layouts.components2.header')
	@include('rawatjalan.antrian.screen.components.css-index')
	<link href="{{url('assets/js/plugins/smooth-marquee/css/liMarquee.css')}}" rel="stylesheet">
</head>
<body>
	<div id="page-loader" class="show">
		<button class="btn btn-alt-primary btn-hero btn-lg start-button" style="
		position:absolute;
		top: 75vh;
		left: calc(50vw - 60px);
		">Start</button>
	</div>
	<div style="
	background-size: contain;
	background-size: 100% 100%;
	height: 100vh;
	width: 100vw;
	background-image: url('{{url("assets/img/bg8.jpg")}}');">
	@include('rawatjalan.antrian.screen.components.content')
	@include('layouts.components2.js')
	<script src="{{url('assets/js/plugins/smooth-marquee/js/jquery.liMarquee.js')}}"></script>
	<script src="{{url('assets/js/plugins/audio-sequence/bundle.js')}}"></script>
	@include('rawatjalan.antrian.screen.components.js-screen')
</div>
</body>
</html>
