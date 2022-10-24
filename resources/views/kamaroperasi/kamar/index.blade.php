@extends('layouts.main2')

@section('title')
Manajemen Kamar - Kamar Operasi - Medify
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row row-deck">

			<div class="col-md-3">
				<a class="block block-link-pop text-center  bg-primary" href="kamar/create">
					<div class="block-content block-content-full block-content-sm">
					</div>

					<div class="block-content block-content-full">
						<i class="fa fa-plus-circle fa-5x text-white"></i>
					</div>
					<div class="block-content block-content-full block-content-sm bg-info">
						<div class="font-w600 mb-5 h3 text-white">Buat Kamar Baru</div>
					</div>
				</a>
			</div>
			@foreach($kamars as $item)
			<div class="col-md-3">
				<a class="block block-link-pop text-center" href="kamar/edit/{{$item->id}}">
					<div class="block-content block-content-full block-content-sm bg-primary">
            <span class="text-white">{{ $item->kategori }}</span>
					</div>

					<div class="block-content block-content-full">
						@if ($item->image_thumb)
							<img class="" src="{{asset($item->image_thumb)}}" alt="" height="100">
						@else
							<div style="height: 100px; padding-top: 7%;">
								@if ($item->kategori == 'IGD')
									<i class="fa fa-ambulance fa-5x"></i>
								@else
									<i class="fa fa-hospital-o fa-5x"></i>
								@endif
							</div>
						@endif
					</div>
					<div class="block-content block-content-full block-content-sm bg-body-light">
						<div class="font-w600 mb-5 h3">{{$item->name}}</div>
					</div>
				</a>

			</div>
			@endforeach
		</div>
	</main>
	@endsection

  @section('js')
    <script>
      $("#manajemen_kamar").addClass('active');
    </script>
  @endsection
