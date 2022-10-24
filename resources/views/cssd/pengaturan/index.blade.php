@extends('layouts.main2')

@section('title')
Pengaturan - CSSD
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="row">
			<div class="col-3">
				<a class="block block-link-shadow text-center" href="{{url()->current()}}/paket">
					<div class="block-content">
						<p class="mt-5">
							<i class="fal fa-scalpel fa-4x"></i>
						</p>
						<p class="font-w600">Paket Alkes</p>
					</div>
				</a>
			</div>
		</div>
	</div>
</main>

@endsection