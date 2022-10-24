@extends('igd.layouts.blank')

@section('title')
Check In - Pendaftaran Online
@endsection

@section('css')
@include('rawatjalan.pendaftaran-poli-online.components.css')
@endsection
@section('content')
<div class="bg-image" style="background-image: url('{{ asset('assets/img/rsal.jpg') }}');">
	<div class="hero-static content content-full flat-transparent invisible" data-toggle="appear" data-class="animated fadeIn">

		<div class="animated fadeIn" id="index">
			@include('rawatjalan.pendaftaran-poli-online.content.index-content')
		</div>

		<div class="animated fadeIn d-none" id="profil">
			@include('rawatjalan.pendaftaran-poli-online.content.profil-content')	
		</div>

		<div class="animated fadeIn d-none" id="registrasi">
			@include('rawatjalan.pendaftaran-poli-online.content.registrasi-content')	
		</div>
		
		<div class="animated fadeIn d-none" id="konfirmasi">
			@include('rawatjalan.pendaftaran-poli-online.content.konfirmasi-content')
		</div>

	</div>
</div>

@include('rawatjalan.pendaftaran-poli-online.content.print-content')
<!-- END Page Container -->
@endsection

<!-- Codebase Core JS -->
@section('js')
<script src="{{asset('assets/js/plugins/jsbarcode/jsbarcode.min.js')}}"></script>
@include('rawatjalan.pendaftaran-poli-online.components.js')
@endsection