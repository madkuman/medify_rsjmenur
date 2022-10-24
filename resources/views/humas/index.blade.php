@extends('humas.layouts.main')

@section('title')
Humas - Medify
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
	@php
	if(isset($_GET['filter_start']) && isset($_GET['filter_end'])){
		$start = $_GET['filter_start'];
		$end = $_GET['filter_end'];
	}else {
		$start = date('Y-m-d', strtotime('-1 month, +1 day',strtotime(date('Y-m-d'))));
		$end = date('Y-m-d', strtotime(date('Y-m-d')));
	}	
	@endphp
	<main id="main-container">
		<div class="row">
	        <div class="col-12">
	            @include('humas.layouts.header')
	        </div>

	        <div class="col-12">
	        	<div class="container">
					<div class="row justify-content-around">
						<div class="col-lg-3 col-12">
							@include('humas.components.filter')
						</div>
						<div class="col-lg-9 col-12">
							<div class="block">
								<div class="block-header block-header-default">
									<h3 class="block-title">Daftar Respon</h3>
									<div class="block-options">
										<button type="button" class="btn btn-primary min-width-125" id="btn-add">
											<i class="fa fa-plus mr-2"></i> Tambah Data
										</button>
									</div>
								</div>
								<div class="block-content">
									@include('humas.components.content')
								</div>
							</div>
						</div>
					</div>
	        	</div>
	        </div>
	    </div>
	</main>

	@include('humas.components.modal-create')
	@include('humas.components.modal-edit')
	@include('humas.components.modal-delete')
@endsection

@section('js')
	<script src="{{ asset('assets/js/combodate.js') }}"></script>
	<script type="text/javascript">
		$('#btn-add').on('click', function(){
			$('#modal-create').modal('show');
		});

	    $('.js-select2').select2();
	</script>
	<script type="text/javascript" src="{{asset('assets/js/jquery1.10.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/dataTables1.10.bootstrap4.min.js')}}"></script>
	@include('humas.js.tabel-js')
	@include('humas.js.function')
@endsection