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
		<div class="animated fadeIn" id="konfirmasi">
			@include('pasien.mesin-antrian.content.konfirmasi-pasien-baru-content')
		</div>
	</div>
</div>

@include('pasien.mesin-antrian.content.print-pasien-baru-content')
<!-- END Page Container -->
@endsection

<!-- Codebase Core JS -->
@section('js')
<script src="{{asset('assets/js/plugins/jsbarcode/jsbarcode.min.js')}}"></script>
@include('pasien.mesin-antrian.components.js-pasien-baru')
@endsection