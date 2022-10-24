@extends('gizi.layouts.index')

@section('title')
Gizi Stok
@endsection

@section('content')
<div class="content">
	<div class="row">
		<div class="col-4">
			<a class="block block-link-pop" href="{{url('gizi/stok')}}?flag=1">
				<div class="block-content text-center py-30">
					<i class="fa fa-4x fa-spoon text-success"></i>
					<h4 class="mt-20">Bahan Kering</h4>
				</div>
			</a>
		</div>
		<div class="col-4">
			<a class="block block-link-pop" href="{{url('gizi/stok')}}?flag=2">
				<div class="block-content text-center py-30">
					<i class="fa fa-4x fa-spoon text-success"></i>
					<h4 class="mt-20">Sayur Mayur</h4>
				</div>
			</a>
		</div>
		<div class="col-4">
			<a class="block block-link-pop" href="{{url('gizi/stok')}}?flag=3">
				<div class="block-content text-center py-30">
					<i class="fa fa-4x fa-spoon text-success"></i>
					<h4 class="mt-20">Bumbu</h4>
				</div>
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-4">
			<a class="block block-link-pop" href="{{url('gizi/stok')}}?flag=4">
				<div class="block-content text-center py-30">
					<i class="fa fa-4x fa-spoon text-success"></i>
					<h4 class="mt-20">Lauk Pauk</h4>
				</div>
			</a>
		</div>
		<div class="col-4">
			<a class="block block-link-pop" href="{{url('gizi/stok')}}?flag=5">
				<div class="block-content text-center py-30">
					<i class="fa fa-4x fa-spoon text-success"></i>
					<h4 class="mt-20">Buah Buahan</h4>
				</div>
			</a>
		</div>
		<div class="col-4">
			<a class="block block-link-pop" href="{{url('gizi/stok')}}?flag=6">
				<div class="block-content text-center py-30">
					<i class="fa fa-4x fa-spoon text-success"></i>
					<h4 class="mt-20">Lain-Lain</h4>
				</div>
			</a>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection