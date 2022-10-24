@extends('layouts.blank')

@section('title')
Pasien - Mesin Antrian
@endsection

@section('css')
@include('pasien.mesin-antrian.components.css')
@endsection
@section('content')
<div class="bg-image" style="background-image: url('{{ asset('assets/img/bgmenur.png') }}');">
	<div class="hero-static content content-full bg-white-op-75 invisible" data-toggle="appear" data-class="animated fadeIn">

		<div class="main-content animated fadeIn" id="index">
			@include('pasien.mesin-antrian.content.index-content')
		</div>

		<div class="main-content animated fadeIn hide" id="profil">
			@include('pasien.mesin-antrian.content.profil-content')	
		</div>

		<div class="main-content animated fadeIn hide" id="registrasi">
			@include('pasien.mesin-antrian.content.registrasi-content')	
		</div>
		
		<div class="main-content animated fadeIn hide" id="jadwal">
			@include('pasien.mesin-antrian.content.jadwal-content')	
		</div>

		<div class="main-content animated fadeIn hide" id="dokter">
			@include('pasien.mesin-antrian.content.dokter-content')	
		</div>
		
		<div class="main-content animated fadeIn hide" id="pembayaran">
			@include('pasien.mesin-antrian.content.pembayaran-content')	
		</div>
		
		<div class="main-content animated fadeIn hide" id="konfirmasi">
			@include('pasien.mesin-antrian.content.konfirmasi-content')
		</div>

	</div>
</div>

@include('pasien.mesin-antrian.content.print-content')
<!-- END Page Container -->
@endsection

<!-- Codebase Core JS -->
@section('js')
<script src="{{asset('assets/js/plugins/jsbarcode/jsbarcode.min.js')}}"></script>
@include('pasien.mesin-antrian.components.js')
@endsection