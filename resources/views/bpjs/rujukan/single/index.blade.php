@extends('bpjs.layouts.main')

@section('title')
Rujukan BPJS
@endsection

@section('subtitle')
Dashboard
@endsection

@section('css')

<style type="text/css">
	.block-content {
		padding-bottom: 18px;
	}
</style>
@endsection

@section('content')
@if(!$window)
<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">
@else
<main id="main-container" class="pt-0">
@endif
		<div class="block">
			<div class="block-content block-content-full">
				<div class="pull-right">
					<a href="{{url()->current()}}/edit" class="btn btn-info">Edit</a>
					<a href="{{url()->current()}}/print" class="btn btn-success" target="_blank">Print</a>
				</div>
				<h5>Data Rujukan #{{$no_rujukan}}</h5>
				<hr>
				@include('bpjs.rujukan.single.components.result')
			</div>
		</div>
	@if(!$window)
    </div>
	@endif
</main>
@endsection


@section('js')
<script type="text/javascript" src="{{asset('assets/js/jquery1.10.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dataTables1.10.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
	var oTable = $("#bpjsTable").DataTable({
		autoWidth: false
	});
</script>
@endsection