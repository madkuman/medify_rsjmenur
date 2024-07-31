@extends('farmasi.layouts.blanks')

@section('title')
	Farmasi - Screen
@endsection

@section('css')
	@include('farmasi.screen.components.css-screen')
@endsection
@section('content')
	<div class="bg-image" style="background-image: url('{{ asset(config('app.background_img_login')) }}');">
		<div id="page-loader" class="show">
			<button class="btn btn-alt-primary btn-hero btn-lg start-button" style="
		position:absolute;
		top: 75vh;
		left: calc(50vw - 60px);
		">Start</button>
		</div>
		{{-- <div class="hero-static content content-full flat-transparent invisible" data-toggle="appear" data-class="animated fadeIn"> --}}
			<div class="animated fadeIn" id="index">
				@include('farmasi.screen.content.screen-index')
			</div>
			{{-- <div class="animated fadeIn d-none" id="task">
                @include('farmasi.checkin.content.screen-task')
            </div> --}}
		{{-- </div> --}}
	</div>
@endsection

@section('js')
	<script src="{{asset('assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
	<script src="{{url('assets/js/plugins/audio-sequence/bundle.js')}}"></script>
	@include('farmasi.screen.components.js-screen')
@endsection