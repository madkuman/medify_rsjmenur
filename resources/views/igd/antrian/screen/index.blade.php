<!doctype html>
<html lang="en" class="no-focus">
<head>
	<title>Screen TV - IGD</title>
	@include('layouts.components2.header')
	@include('igd.antrian.screen.components.style-css')
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
	<div 
	style="
	background-size: contain;
	background-size: 100% 100%;
	height: 100vh;
	width: 100vw;
	background-image: url('{{url("assets/img/igd-tv/background.png")}}');">
		@include('igd.antrian.screen.components.content')
		@include('layouts.components2.js')
		<script src="{{url('assets/js/plugins/smooth-marquee/js/jquery.liMarquee.js')}}"></script>
		<script src="{{url('assets/js/plugins/audio-sequence/bundle.js')}}"></script>
		@include('igd.antrian.screen.components.js')
	</div>
</body>
</html>
