@extends('layouts.main2')

@section('title')
Pengaturan - Kamar Operasi
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">

            @if(Auth::user()->admin)
			<div class="col-3">
				<a class="block block-link-shadow text-center" href="{{url('kamaroperasi/kamar')}}">
					<div class="block-content">
						<p class="mt-5">
							<i class="fal fa-hospital fa-4x"></i>
						</p>
						<p class="font-w600">Kamar Operasi</p>
					</div>
				</a>
			</div>
			@endif
			<div class="col-3">
				<a class="block block-link-shadow text-center" href="{{url('kamaroperasi/paket')}}">
					<div class="block-content">
						<p class="mt-5">
							<i class="fal fa-scalpel fa-4x"></i>
						</p>
						<p class="font-w600">Paket Alkes dan Matkes</p>
					</div>
				</a>
			</div>

            @if(Auth::user()->admin)
			<div class="col-3">
				<a class="block block-link-shadow text-center" href="{{url('kamaroperasi/peran-tim')}}">
					<div class="block-content">
						<p class="mt-5">
							<i class="fal fa-user-md fa-4x"></i>
						</p>
						<p class="font-w600">Peran Anggota Tim</p>
					</div>
				</a>
			</div>
			<div class="col-3">
				<a class="block block-link-shadow text-center" href="{{url('kamaroperasi/jenis-operasi')}}">
					<div class="block-content">
						<p class="mt-5">
							<i class="fal fa-briefcase-medical fa-4x"></i>
						</p>
						<p class="font-w600">Jenis Operasi</p>
					</div>
				</a>
			</div>
			@endif
		</div>
	</div>
</main>
@endsection