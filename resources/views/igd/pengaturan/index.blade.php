@extends('igd.layouts.main')

@section('title')
Ruangan - IGD - Medify
@endsection

@section('subtitle')
Ruangan
@endsection

@section('content')


<main id="main-container">
	@include('igd.layouts.navbar')
	<div class="container">
		<div class="row justify-content-center py-20">
			<div class="col-xl-2">
			</div>
			<div class="col-xl-8 text-center">
				<h3>Daftar Ruangan</h3>
			</div>
			<div class="col-xl-2">
				<a href="{{url('igd/pengaturan/ruangan/new')}}" class="btn btn-success">+ Buat Ruangan Baru</a>
			</div>
		</div>
		<div class="row  mt-20">
			@foreach($ruangan as $item)
			<div class="col-md-3">
				<a class="block block-link-pop text-center" href="{{url('igd/pengaturan/ruangan/edit/'.$item->id)}}">
					<div class="block-content block-content-full block-content-sm bg-danger">
					</div>

					<div class="block-content block-content-full">
						<div class="font-w600 mb-5 h1">{{$item->name}}</div>
					</div>
					<div class="block-content pb-20">
						<div class="row text-left">
							<div class="col-4">
								<span class="h5 font-w400">Level </span>
							</div>
							<div class="col-8">
								<span class="h5 font-w400"> : {{$item->level}}</span>
							</div>
						</div>
					</div>
				</a>

			</div>
			@endforeach
		</div>
	</div>
</main>
@endsection