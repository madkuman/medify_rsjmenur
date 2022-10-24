@extends('layouts.blank')

@section('title')
Pasien - Mesin Antrian
@endsection

@section('css')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
@include('rawatjalan.pendaftaran-poli-online.components.css')
<style>
	body {
		font-family: 'Poppins', sans-serif;
	}
	.rs-title {
		font-size: 50px;
		font-weight: 700 !important;
	}
	.block-link-pasien {
		background-color: #204E5D;
		color: #fff !important;
		font-size: 50px !important;
		padding-top: 10px !important;
		padding-bottom: 10px !important;
		border: none;
	}
</style>
@endsection
@section('content')
<div class="bg-image" style="background-image: url('{{ asset('assets/img/bgmenur.png') }}');">
	<div class="hero-static content content-full bg-white-op-75 invisible" data-toggle="appear" data-class="animated fadeIn">
		<div class="text-center mt-100">
			<h1 class="rs-title my-0">RSJ MENUR Surabaya</h1>
			<p class="font-size-h3 my-0 font-w400">Satukan Tekat, Berikan Layanan Terbaik</p>
		</div>
		<div class="row justify-content-center {{ empty($allowed_access) ? 'd-none' : '' }}">
			<div class="col-lg-6 col-xl-4 mt-50 pt-20">
				<a class="block block-link-shadow block-rounded block-link-pasien text-center" href="{{url('pasien/antrian/pasien-lama')}}">
					<div class="block-content block-content-full">
						<i class="fa fa-user-check"></i>
						<div class="font-w700">Pasien Lama</div>
					</div>
				</a>
			</div>
		</div>
		<div class="row justify-content-center {{ empty($allowed_access) ? 'd-none' : '' }}">
			<div class="col-lg-6 col-xl-4 mt-20">
				<a class="block block-link-shadow block-rounded block-link-pasien text-center" href="{{url('pasien/antrian/pasien-baru')}}">
					<div class="block-content block-content-full">
						<i class="fa fa-user-plus"></i>
						<div class="font-w700">Pasien Baru</div>
					</div>
				</a>
			</div>
		</div>
	</div>
@endsection