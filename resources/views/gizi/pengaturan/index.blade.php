@extends('gizi.layouts.index')

@section('title')
Gizi Pengaturan
@endsection

@section('content')
<div class="content">
	<div class="row">
		<div class="col-4">
			<a class="block block-link-pop" href="{{url('gizi/pengaturan/jenis-makanan')}}">
				<div class="block-content text-center py-30">
					<i class="fal fa-4x fa-utensils text-success"></i>
					<h4 class="mt-20">Jenis Makanan</h4>
				</div>
			</a>
		</div>
		<div class="col-4">
			<a class="block block-link-pop" href="{{url('gizi/pengaturan/diet')}}">
				<div class="block-content text-center py-30">
					<i class="fal fa-4x fa-utensil-spoon text-success"></i>
					<h4 class="mt-20">Diet</h4>
				</div>
			</a>
		</div>
		<div class="col-4">
			<a class="block block-link-pop" href="{{url('gizi/pengaturan/anggaran-makanan')}}">
				<div class="block-content text-center py-30">
					<i class="fal fa-4x fa-book text-success"></i>
					<h4 class="mt-20">Anggaran Makanan</h4>
				</div>
			</a>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection