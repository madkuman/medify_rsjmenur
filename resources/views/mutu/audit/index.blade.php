@extends('mutu.layouts.main')

@section('title')
Mutu - Audit - Medify
@endsection

@section('subtitle')
Audit
@endsection

@section('content')


<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-12 col-lg-6 col-xl-4">
				<div class="block block-fx-shadow text-center">
					<a class="d-block bg-primary font-w600 text-uppercase py-5" data-toggle="modal" data-target="#modal-crypto-wallet-eth">
						<span class="text-white">HAND HYGIENE</span>
					</a>
					<div class="block-content block-content-full" style="min-height: 200px">
						<div class="pt-20 pb-30">
							<div class="font-size-h3 font-w700">Form Hand Hygiene</div>
						</div>
						<a class="btn btn-primary" href="{{url('mutu/audit/hh')}}">
							<i class="fa fa-search mr-5"></i> Buka
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 col-xl-4">
				<div class="block block-fx-shadow text-center">
					<a class="d-block bg-primary font-w600 text-uppercase py-5">
						<span class="text-white">IDENTIFIKASI RESIKO</span>
					</a>
					<div class="block-content block-content-full" style="min-height: 200px">
						<div class="pt-20 pb-30">
							<div class="font-size-h3 font-w700">Form Identifikasi Resiko</div>
						</div>
						<a class="btn btn-primary" href="{{url('mutu/audit/identifikasi-resiko')}}">
							<i class="fa fa-search mr-5"></i> Buka
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 col-xl-4">
				<div class="block block-fx-shadow text-center">
					<a class="d-block bg-primary font-w600 text-uppercase py-5">
						<span class="text-white">KEGIATAN PENGENDALIAN</span>
					</a>
					<div class="block-content block-content-full" style="min-height: 200px">
						<div class="pt-20 pb-30">
							<div class="font-size-h3 font-w700">Form Kegiatan Pengendalian</div>
						</div>
						<a class="btn btn-primary" href="{{url('mutu/audit/kegiatan-pengendalian')}}">
							<i class="fa fa-search mr-5"></i> Buka
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 col-xl-4">
				<div class="block block-fx-shadow text-center">
					<a class="d-block bg-primary font-w600 text-uppercase py-5">
						<span class="text-white">EVALUASI KEGIATAN PENGENDALIAN</span>
					</a>
					<div class="block-content block-content-full" style="min-height: 200px">
						<div class="pt-20 pb-30">
							<div class="font-size-h3 font-w700">Form Evaluasi Kegiatan Pengendalian</div>
						</div>
						<a class="btn btn-primary" href="{{url('mutu/audit/evaluasi-kegiatan-pengendalian')}}">
							<i class="fa fa-search mr-5"></i> Buka
						</a>
					</div>
				</div>
			</div>
			<div class="d-none col-lg-6 col-xl-4">
				<div class="block block-fx-shadow text-center">
					<a class="d-block bg-primary font-w600 text-uppercase py-5" data-toggle="modal" data-target="#modal-crypto-wallet-eth">
						<span class="text-white">AUDIT MINMED</span>
					</a>
					<div class="block-content block-content-full" style="min-height: 200px">
						<div class="pt-20 pb-30">
							<div class="font-size-h3 font-w700">Ketidaklengkapan Informed Concent</div>
						</div>
						<a class="btn btn-primary" href="{{url('mutu/audit/minmed')}}">
							<i class="fa fa-search mr-5"></i> Buka
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection