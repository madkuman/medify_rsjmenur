@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Monitoring Ventilator - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
	@include('kasus.layouts.header')

	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">

						<h5>Pemakaian Alat Invasif CVC</h5>
						<ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active tab-default-nav tab-surveilans-nav" href="#nav-tab-surveilans">Surveilans</a>
							</li>
							<li class="nav-item">
								<a class="nav-link tab-audit-nav" href="#nav-tab-audit">Audit</a>
							</li>
						</ul>

						<div class="block-content tab-content">
							<div class="tab-pane active tab-surveilans-content tab-default-content" id="nav-tab-surveilans" role="tabpanel">
								@if(session('my_role_'.$kasus->nomor_kasus))
								<button type="button" class="btn btn-success min-width-125 ml-5 float-right btn-modal-master" data-val=""><i class="fa fa-pencil"></i> Tambah Ventilator</button>
								@endif

								<h4 class="mb-5 pl-5">#VAP- Surveilans</h4>
								<br><hr>
								@include('kasus.alatbantu.monitoring-ventilator.surveilans')
							</div>
							<div class="tab-pane tab-audit-content" id="nav-tab-audit" role="tabpanel">
								@if($is_ipcn)
								<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right mr-10" data-toggle="modal" data-target="#addModalAudit" id="add_pre_ops"><i class="fa fa-pencil"></i> Isi Audit</button>
								@endif
								<h4 class="mb-5 pl-5">#VAP- Audit</h4>
								<br><hr>
								@include('kasus.alatbantu.monitoring-ventilator.audit')
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>
<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include('kasus.alatbantu.monitoring-ventilator.add')
@include('kasus.alatbantu.monitoring-ventilator.add-audit')
@include('kasus.alatbantu.monitoring-ventilator.add-master')
@endsection

@section('js')
@include('kasus.alatbantu.monitoring-ventilator.js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});

	$('input[type=radio][name=kultur_sputum]').on('change', function() {
		if (this.value == 1) {
			$('#kultur_sputum_keterangan').show();
		}
		else{
			$('#kultur_sputum_keterangan').hide();
		}
	});
</script>
@include('layouts.components2.js.js-nav-tab')
@endsection