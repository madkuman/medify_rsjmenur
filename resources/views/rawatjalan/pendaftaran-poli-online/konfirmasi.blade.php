@extends('igd.layouts.blank')

@section('title')
Check In - Pendaftaran Online
@endsection

@section('css')
@include('rawatjalan.pendaftaran-poli-online.components.css')
@endsection
@section('content')
<div class="bg-image" style="background-image: url('{{ asset('assets/img/rsal.jpg') }}');">
	<div class="hero-static content content-full flat-transparent" data-toggle="appear" data-class="animated fadeIn">

		@include('rawatjalan.pendaftaran-poli-online.content.konfirmasi-content')
	</div>
</div>
@include('rawatjalan.pendaftaran-poli-online.content.print-content')
<!-- END Page Container -->
@endsection

<!-- Codebase Core JS -->
@section('js')
@include('rawatjalan.pendaftaran-poli-online.components.js')
@endsection