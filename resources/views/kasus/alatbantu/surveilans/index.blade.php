@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Surveilans Infeksi Luka Operasi - Kasus
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

						
						<h4>Surveilans Infeksi Daerah Operasi</h4>
						<hr>
 

						<ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active tab-default-nav tab-post-nav" href="#tab-post" id="nav-tab-post">Post</a>
							</li>
							<li class="nav-item">
								<a class="nav-link tab-pre-nav" href="#tab-pre" id="nav-tab-pre">Pre Ops</a>
							</li>
							<li class="nav-item">
								<a class="nav-link tab-durante-nav" href="#tab-durante" id="nav-tab-durante">Durante Ops</a>
							</li>
							<li class="nav-item">
								<a class="nav-link tab-audit-nav" href="#tab-audit" id="nav-tab-audit">Audit</a>
							</li>
						</ul>
						<div class="block-content tab-content">
							<div class="tab-pane active tab-post-content tab-default-content" id="tab-post" role="tabpanel">
								<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal2" id="add_post_ops"><i class="fa fa-pencil"></i> Post Ops</button>
								<h5 class="mb-5 pl-5">#Surveilans Infeksi Daerah Operasi  - Post Ops</h5>
								<br><hr>
								@include('kasus.alatbantu.surveilans.tabel-hasil-post')
							</div>
							<div class="tab-pane  tab-pre-content" id="tab-pre" role="tabpanel">
								<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right mr-10" data-toggle="modal" data-target="#addModal" id="add_pre_ops"><i class="fa fa-pencil"></i> Pre Ops</button>
								<h5 class="mb-5 pl-5">#Surveilans Infeksi Daerah Operasi - Pre Ops</h5>
								<br><hr>
								@include('kasus.alatbantu.surveilans.tabel-hasil-pre')
							</div>
							<div class="tab-pane  tab-durante-content" id="tab-durante" role="tabpanel">
								@if(count($pre) > 0)
								<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right mr-10" data-toggle="modal" data-target="#addModalDurante" id="add_durante_ops"><i class="fa fa-pencil"></i> Durante Ops</button>
								@endif
								<h5 class="mb-5 pl-5">#Surveilans Infeksi Daerah Operasi - Durante Ops</h5>
								<br><hr>
								@include('kasus.alatbantu.surveilans.tabel-hasil-durante')
							</div>
							<div class="tab-pane  tab-audit-content" id="tab-audit" role="tabpanel">
								@if($is_ipcn)
								<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right mr-10" data-toggle="modal" data-target="#addModalAudit" id="add_pre_ops"><i class="fa fa-pencil"></i> Isi Audit IDO</button>
								@endif
								<h5 class="mb-5 pl-5">#Surveilans Infeksi Daerah Operasi - Audit</h5>
								<br><hr>
								@include('kasus.alatbantu.surveilans.audit')
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>
<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/surveilans/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include('kasus.alatbantu.surveilans.add')
@include('kasus.alatbantu.surveilans.add2')
@include('kasus.alatbantu.surveilans.add-durante')
@include('kasus.alatbantu.surveilans.add-audit')
@include('kasus.alatbantu.surveilans.edit-post')
@include('kasus.alatbantu.surveilans.edit-pre')
@include('kasus.alatbantu.surveilans.edit-durante')
@endsection

@section('js')
@include('kasus.alatbantu.surveilans.js')
@include('kasus.alatbantu.surveilans.js-edit-post')
@include('kasus.alatbantu.surveilans.js-edit-pre')
@include('kasus.alatbantu.surveilans.js-edit-durante')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var element
	$(document).ready(function(){
		$('.time').mask('00:00');
	});

	$(".jenis_lokasi_infeksi").change(function(){
		var value = $(this).val();
		$('.checkbox-kriteria').prop('checked',false)
		var element = $(this).parent().parent().parent().parent()
		element.find('.content-kriteria-superfisial').hide();
		element.find('.content-kriteria-dalam').hide();
		element.find('.content-kriteria-organ').hide();

		if(value == 'Superfisial') element.find('.content-kriteria-superfisial').show();
		else if(value == 'Dalam') element.find('.content-kriteria-dalam').show();
		else if(value == 'Organ') element.find('.content-kriteria-organ').show();
	})

	$('input[type=checkbox][name=infeksi]').on('change', function() {
		var value = $(this).is(':checked');
		element = $(this).parent().parent().parent().parent()
		if (value) {
			element.find('.infeksi-content').show();
		}
		else{
			element.find('.infeksi-content').hide();
		}
	});
</script>

@include('layouts.components2.js.js-nav-tab')
@endsection
