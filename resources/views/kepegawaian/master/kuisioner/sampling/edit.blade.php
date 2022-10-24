@extends('kepegawaian.master.kuisioner.sampling.layouts.main')

@section('title')
Kuisioner
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
<style>
.pilihan {
	border-bottom: 1px dotted #C0C0C1;
}
</style>
@endsection

@section('content')
<div class="block">
	<div class="block-content">
		@if (empty($jawaban))
			<div class="text-center">
				<h4>Data kuisioner tidak ditemukan</h4>
				<a href="{{url('kuisioner').'/'.Request::segment(2)}}" class="btn btn-sm btn-alt-primary btn-hero">Kembali</a>								
			</div>
		@else
			@include('kepegawaian.master.kuisioner.sampling.components.content-edit')
		@endif
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	function changeCircle(pertanyaan,pilgan) {
		if ($("input[name='"+pertanyaan+"']").is(':checked')) {
			$('.'+pertanyaan).removeClass('btn-primary');
			$('.'+pertanyaan).addClass('btn-outline-primary');
			$('#'+pilgan).removeClass('btn-outline-primary');
			$('#'+pilgan).addClass('btn-primary');
		}else {
			$('.'+pertanyaan).removeClass('btn-primary');
			$('.'+pertanyaan).addClass('btn-outline-primary');
			// $('.'+pilgan).addClass('btn-outline-success');
		}
	}
</script>
@endsection