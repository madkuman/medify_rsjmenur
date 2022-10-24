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
			@include('kepegawaian.master.kuisioner.sampling.components.content-sampling')
		@else
			@include('kepegawaian.master.kuisioner.sampling.components.content-done')
		@endif
	</div>
</div>

@include('kepegawaian.master.kuisioner.sampling.components.modal-warning-edit')
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
	$('#btn-edit').on('click', function(){
		$('#kuisioner-id-edit').val($(this).attr('data-id'));
		$('#modal-warning-edit').modal('show');
	});
</script>
@endsection