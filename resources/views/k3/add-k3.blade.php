@extends('k3.layouts.main')

@section('title')
K3 - Medify
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
	<main id="main-container">
		<div class="row">
	        <div class="col-12">
	            @include('k3.layouts.header')
	        </div>

	        <div class="col-12">
	        	<div class="container">
					<div class="block">
						<div class="block-header block-header-default">
							<h3 class="block-title">Laporkan K3</h3>
						</div>
						<div class="block-content">
							@include('k3.components.create-logbook')
						</div>
					</div>
				</div>
	        </div>
	    </div>
	</main>

@endsection

@section('js')
	<script type="text/javascript">
		var pasienWarning = $("#pasienWarn");
	</script>
	@include('k3.js.function')
@endsection