@extends('farmasi.layouts.blanks')

@section('title')
Farmasi - Mesin Antrian
@endsection

@section('css')
@include('farmasi.screen.components.css')
@endsection
@section('content')
<div class="bg-image" style="background-image: url('{{ asset('assets/img/medify-1.1.jpg') }}');">
	<div class="hero-static content content-full bg-white-op-75 invisible" data-toggle="appear" data-class="animated fadeIn">

		<div class="main-content animated fadeIn" id="index">
			@include('farmasi.screen.content.index-content')
		</div>

		<div class="main-content animated fadeIn hide" id="profil">
			@include('farmasi.screen.content.profil-content')
		</div>

		<div class="main-content animated fadeIn hide" id="registrasi">
			@include('farmasi.screen.content.transaksi-content')
		</div>
		
		<div class="main-content animated fadeIn hide" id="konfirmasi">	
			@include('farmasi.screen.content.konfirmasi-content')
		</div>

	</div>
</div>

@include('farmasi.screen.content.print-content')
<!-- END Page Container -->
@endsection

<!-- Codebase Core JS -->
@section('js')
<script src="{{asset('assets/js/plugins/jsbarcode/jsbarcode.min.js')}}"></script>
@include('farmasi.screen.components.js')
@endsection