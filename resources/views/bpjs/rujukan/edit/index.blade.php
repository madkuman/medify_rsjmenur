@extends('bpjs.layouts.main')

@section('title')
Rujukan BPJS
@endsection

@section('subtitle')
Rujukan / Edit Data
@endsection

@section('css')
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
					<button class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">Delete</button>
				</div>
				<h5>Edit Data Rujukan #{{$no_rujukan}}</h5>
				<hr>
				@include('bpjs.rujukan.edit.components.form')
			</div>
		</div>
	@if(!$window)
	</div>
	@endif
</main>
<form id="form_delete" method="POST" action="{{url('bpjs/rujukan')}}/{{$no_rujukan}}/delete">
	{{csrf_field()}}
	<input name="nomor_rujukan" value="{{$no_rujukan}}" type="hidden">
</form>
@include('bpjs.rujukan.edit.components.modal-delete')

@endsection


@section('js')
<script type="text/javascript">
	function submitFormDelete()
	{
		$('#form_delete').submit();
	}
</script>
<script type="text/javascript">
	$('#select_diagnosis').select2({
		ajax: {
			url: function (params) {
				return API_URL+'/kasus/get/list/diagnosis?keyword='+params.term;
			},
			processResults: function (data, params) {
				// console.log(data);
				data = JSON.parse(data);
				return {
					results: $.map(data.data, function(obj) {
						return { id: obj.code_icd, text: obj.code_icd+' | '+obj.long_desc };
					})
				};
			},
			cache: true
		}
	});
	$('#select_poli').select2({
		ajax: {
			url: function (params) {
				return API_URL+'/bpjs/referensi/poli?poli='+params.term;
			},
			processResults: function (data, params) {
				data = JSON.parse(data);
				return {
					results: $.map(data.response.poli, function(obj) {
						return { id: JSON.stringify((obj)), text: obj.kode+' | '+obj.nama };
					})
				};
			},
			cache: true
		}
	});
	$('#select_faskes').select2({
		ajax: {
			url: function (params) {
				return API_URL+'/bpjs/referensi/faskes?faskes='+params.term;
			},
			processResults: function (data, params) {
				data = JSON.parse(data);
				return {
					results: $.map(data.response.faskes, function(obj) {
						return { id: JSON.stringify((obj)), text: obj.kode+' | '+obj.nama };
					})
				};
			},
			cache: true
		}
	});
</script>
@endsection