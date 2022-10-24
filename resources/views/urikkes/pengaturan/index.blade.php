@extends('urikkes.layouts.main')

@section('title')
Pengaturan Urikkes
@endsection

@section('subtitle')
Pengaturan
@endsection

@section('content')
<main id="main-container">
		@include('urikkes.layouts.navbar')
	<div class="content">
		<div class="row">
			<div class="col-3">
				<a class="block block-link-shadow text-center" href="{{url('urikkes/pengaturan/dokter')}}">
					<div class="block-content">
						<p class="mt-5">
							<i class="fal fa-user-md fa-4x"></i>
						</p>
						<p class="font-w600">Dokter Pemeriksa</p>
					</div>
				</a>
			</div>
			<div class="col-3">
				<a class="block block-link-shadow text-center" href="{{url('urikkes/pengaturan/paket')}}">
					<div class="block-content">
						<p class="mt-5">
							<i class="fal fa-medkit fa-4x"></i>
						</p>
						<p class="font-w600">Paket Layanan</p>
					</div>
				</a>
			</div>
		</div>
	</div>
</main>
@endsection