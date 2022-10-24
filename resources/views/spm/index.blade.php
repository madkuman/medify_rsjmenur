@extends('layouts.main2')

@section('title')
Standar Mutu Pelayanan
@endsection

@section('subtitle')
Standar Mutu Pelayanan
@endsection

@section('css')
@include('spm.layouts.css')
@endsection

@section('content')
<main id="main-container" class="main-content-boxed ">
	@include('spm.layouts.navbar')

	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-6 col-md-4 col-xl-3">
					<a class="block text-center" href="{{url('spm/kematian-pasien')}}">
						<div class="block-content">
							<p class="mt-5">
								<i class="fal fa-notes-medical fa-4x"></i>
							</p>
							<p class="font-w600">Kematian Pasien</p>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-4 col-xl-3">
					<a class="block text-center" href="{{url('spm/waktu-tunggu-rawat-jalan')}}">
						<div class="block-content">
							<p class="mt-5">
								<i class="fal fa-stethoscope fa-4x"></i>
							</p>
							<p class="font-w600">Waktu Tunggu Rawat Jalan</p>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-4 col-xl-3">
					<a class="block text-center" href="{{url('spm/pasien-pulang-paksa')}}">
						<div class="block-content">
							<p class="mt-5">
								<i class="fal fa-bed fa-4x"></i>
							</p>
							<p class="font-w600">Pasien Pulang Paksa</p>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-4 col-xl-3">
					<a class="block text-center" href="{{url('spm/los-pasien-jiwa')}}">
						<div class="block-content">
							<p class="mt-5">
								<i class="fal fa-user fa-4x"></i>
							</p>
							<p class="font-w600">Lama Perawatan Pasien Jiwa</p>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-4 col-xl-3">
					<a class="block text-center" href="{{url('spm/pasien-jiwa-readmisi')}}">
						<div class="block-content">
							<p class="mt-5">
								<i class="fal fa-redo-alt fa-4x"></i>
							</p>
							<p class="font-w600">Pasien Jiwa Readmisi Setelah 1 Bulan</p>
						</div>
					</a>
				</div>
				<div class="col-6 col-md-4 col-xl-3">
					<a class="block text-center" href="{{url('spm/operasi-masa-tunggu')}}">
						<div class="block-content">
							<p class="mt-5">
								<i class="fal fa-scalpel fa-4x"></i>
							</p>
							<p class="font-w600">Masa Tunggu Kamar Operasi</p>
						</div>
					</a>
				</div>


			</div>
		</div>
	</div>
</main>
@endsection


@section('js')
@endsection