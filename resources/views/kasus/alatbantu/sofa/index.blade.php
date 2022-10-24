@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - SOFA - Kasus
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
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Asesmen SOFA Baru</button>
						@endif
						<h4>SOFA</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($sofa as $item)

                    	@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif
						<h5 class="mb-5 pl-5">#SOFA {{$count++}}</h5>
						<div class="row">
							<div class="col-md-6">
								<table class="table table-sm table-striped table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:40%">Parameter</th>
											<th class="text-center" style="width: 60%;">Kondisi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>PaO₂</td>
											<td class="text-center">{{$item->pao2}} mmHg</td>
										</tr>
										<tr>
											<td>FiO2</td>
											<td class="text-center">{{$item->fio2}}%</td>
										</tr>
										<tr>
											<td>On mechanical ventilation</td>
											<td class="text-center">{{$item->mech_vent > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>GCS Mata</td>
											<td class="text-center">{{$item->gcs_eye_text}}</td>
										</tr>
										<tr>
											<td>GCS Verbal</td>
											<td class="text-center">{{$item->gcs_verbal_text}}</td>
										</tr>
										<tr>
											<td>GCS Motor</td>
											<td class="text-center">{{$item->gcs_motor_text}}</td>
										</tr>
										<tr>
											<td>Platelets, ×10³/µL</td>
											<td class="text-center">{{$item->platelets_text}}</td>
										</tr>
										<tr>
											<td>Bilirubin, mg/dL (μmol/L)</td>
											<td class="text-center">{{$item->bilirubin_text}}</td>
										</tr>
										<tr>
											<td>Mean arterial pressure OR administration of vasoactive agents required</td>
											<td class="text-center">{{$item->cardiovascular_text}}</td>
										</tr>
										<tr>
											<td>Creatinine, mg/dL (μmol/L) (or urine output)</td>
											<td class="text-center">{{$item->creatinine_text}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-6 text-center pt-50">
								<div class="block block-themed">
							       	<div class="block-header bg-warning">
							           	<h3 class="block-title">SOFA</h3>
							       	</div>
							       	<div class="block-content">
							           	<h4 class="mb-5"><strong>Skor: {{$item->score}}</strong></h4>
							           	<h6 class="mb-5">Mortality: {{$item->mortality}}</h6>
							       	</div>
							   	</div>
							</div>
						</div>
						@if(!empty($item->creator->avatar_thumb))
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
						</div>
						@else
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
						</div>
						@endif
						<div class="creator">
							<h6 class="pt-10">
								<small class="text-muted">Dibuat Oleh</small><br>
								{{$item->creator->name}}<br>
								{{date('d F y, H:i', strtotime($item->created_at))}}
							</h6>
						</div>

						<hr class="my-20">
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen SOFA tersedia</h4>
							<p>Klik tombol <b>Asesmen SOFA Baru</b> untuk melakukan asesmen SOFA</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/sofa/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.sofa.add')
<!-- END Main Container -->    
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteBtn").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#deleteInputId').val(id);
			swal({
				title: "Hapus",
				text: "Apakah anda yakin akan menghapus data ini?",
				showCancelButton: true,
				reverseButtons: true,
				type: 'warning',
				confirmButtonClass: "btn btn-danger",
				cancelButtonClass: "btn btn-default",
				confirmButtonText: "Hapus",
				cancelButtonText: "Kembali",
				closeOnConfirm: false
			}).then(function(result) {
				if(result.value)
				{
					$('#formDelete').submit();
				}
			});
		});
	});
</script>
@endsection