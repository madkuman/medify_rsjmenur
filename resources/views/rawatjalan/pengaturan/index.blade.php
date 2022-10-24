@extends('rawatjalan.layouts.main')

@section('title')
Pengaturan Poliklinik - Rawat Jalan - Medify
@endsection

@section('subtitle')
Pengaturan Poliklinik
@endsection

@section('content')


<main id="main-container">
	@include('rawatjalan.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-xl-12 text-center py-20">
				<h3>Daftar Poliklinik</h3>
			</div>
		</div>
		<div class="row row-deck">

			<div class="col-md-3">
				<a class="block block-link-pop text-center  bg-primary" href="{{url('rawatjalan/pengaturan/poliklinik/new')}}">
					<div class="block-content block-content-full block-content-sm">
					</div>

					<div class="block-content block-content-full">
						<i class="fa fa-plus-circle fa-5x text-white"></i>
					</div>
					<div class="block-content block-content-full block-content-sm bg-info">
						<div class="font-w600 mb-5 h3 text-white">Buat Poli Baru</div>
					</div>
				</a>

			</div>
			@foreach($poli as $item)
			<div class="col-md-3">
				<a class="block block-link-pop text-center" href="{{url('rawatjalan/pengaturan/poliklinik/edit')}}/{{$item->id}}">
					<div class="block-content block-content-full block-content-sm bg-primary">
					</div>

					<div class="block-content block-content-full">
						<img class="" src="{{asset($item->image_thumb)}}" alt="" height="100">
					</div>
					<div class="block-content block-content-full block-content-sm bg-body-light">
						<div class="font-w600 mb-5 h3">{{$item->name}}</div>
					</div>
				</a>

			</div>
			@endforeach
		</div>
	</div>
</main>
@endsection