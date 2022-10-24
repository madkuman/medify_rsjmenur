@extends('it.layouts.main')

@section('title')
IT - Medify
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
	<main id="main-container">
		<div class="row">
	        <div class="col-12">
	            @include('it.layouts.header')
	        </div>
	    </div>
    	<div class="container">
			@include('it.components.content')
	    </div>
	</main>

	@include('it.components.modal-delete')
	@include('it.components.modal-info')
@endsection

@section('js')
	<script type="text/javascript">
		jQuery('.js-dataTable-full').dataTable({
		"ordering": true,
		pageLength: 8,
		lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		autoWidth: false
	});

	$('.button-delete').click(function(){
		id = $(this).data('id')
		$('#komplain-id-del').val(id)
		$('#modal-delete').modal('show')
	})

	$('.button-info').click(function(){

		respon = $(this).data('respon')
		wakturespon = $(this).data('wakturespon')
		teknisi = $(this).data('teknisi')

		$('#komplain-info-teknisi').html(teknisi)
		$('#komplain-info-wakturespon').html(wakturespon)
		$('#komplain-info-respon').html(respon)
		$('#modal-info').modal('show')
	})


	</script>
@endsection