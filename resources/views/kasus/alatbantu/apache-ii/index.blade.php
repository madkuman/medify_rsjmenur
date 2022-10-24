@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Apache II - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Asesmen Baru</button>
						@endif
						<h4>Apache II</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($apache as $item)

                    	@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif
						<h5 class="mb-5 pl-5">#Apache II {{$count++}}</h5>
						<div class="row">
							<div class="col-md-4">
								<table class="table table-sm table-striped table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:40%">Parameter</th>
											<th class="text-center" style="width: 60%;">Kondisi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>GCS-Eye</td>
											<td class="text-center">{{$item->gcs_eye_text}}</td>
										</tr>
										<tr>
											<td>GCS-Verbal</td>
											<td class="text-center">{{$item->gcs_verbal_text}}</td>
										</tr>
										<tr>
											<td>GCS-Motor</td>
											<td class="text-center">{{$item->gcs_motor_text}}</td>
										</tr>
										<tr>
											<td>Memiliki histori insufisiensi organ berat atau gangguan imun</td>
											<td class="text-center">{{$item->history_text}}</td>
										</tr>
										<tr>
											<td>Gagal ginjal akut</td>
											<td class="text-center">{{$item->renal_text}}</td>
										</tr>
										<tr>
											<td>White blood cell count</td>
											<td class="text-center">{{$item->white_blood}} × 10³ cells/µL</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-4">
								<table class="table table-sm table-striped table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:40%">Parameter</th>
											<th class="text-center" style="width: 60%;">Kondisi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Temperatur</td>
											<td class="text-center">{{$item->temp}} °C</td>
										</tr>
										<tr>
											<td>Mean Arterial Pressure</td>
											<td class="text-center">{{$item->map}} mmHg</td>
										</tr>
										<tr>
											<td>pH</td>
											<td class="text-center">{{$item->ph}}</td>
										</tr>
										<tr>
											<td>Heartrate</td>
											<td class="text-center">{{$item->heartrate}} beats/min</td>
										</tr>
										<tr>
											<td>Respiratory Rate</td>
											<td class="text-center">{{$item->resp_rate}} breaths/min</td>
										</tr>
										<tr>
											<td>Sodium</td>
											<td class="text-center">{{$item->sodium}} mmol/L</td>
										</tr>
										<tr>
											<td>Potassium</td>
											<td class="text-center">{{$item->potassium}} mmol/L</td>
										</tr>
										<tr>
											<td>Creatinine</td>
											<td class="text-center">{{$item->creatinine}} mg/100mL</td>
										</tr>
										<tr>
											<td>Hematocrit</td>
											<td class="text-center">{{$item->hematocrit}}%</td>
										</tr>
										<tr>
											<td>FiO₂</td>
											<td class="text-center">{{$item->fio2_text}}</td>
										</tr>
										<tr>
											<td>PaO₂</td>
											<td class="text-center">{{!empty($item->pao2) ? $item->pao2_text : '-'}}</td>
										</tr>
										<tr>
											<td>A-a gradient</td>
											<td class="text-center">{{!empty($item->aa_grad) ? $item->aa_grad_text : '-'}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-4 text-center pt-50">
								<div class="block block-themed">
							       	<div class="block-header bg-warning">
							           	<h3 class="block-title">Apache II</h3>
							       	</div>
							       	<div class="block-content">
							           	<h4 class="mb-5"><strong>Skor: {{$item->score}}</strong></h4>
							           	<h6 class="mb-5">{{$item->score_text}}</h6>
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Apache II tersedia</h4>
							<p>Klik tombol <b>Asesmen Baru</b> untuk melakukan asesmen Apache II</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/apache-ii/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.apache-ii.add')
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

		$("#fio2").on('change', function(e){
			val = $(this).val();
			if (val == '0') {
				$("#pao2").attr('required', 'required');
				$("#aa_grad").removeAttr('required');
				$("#aa_grad").val('');
				$("#pao2_tr").show();
				$("#aa_grad_tr").hide();
			} else {
				$("#aa_grad").attr('required', 'required');
				$("#pao2").removeAttr('required');
				$("#pao2").val('');
				$("#aa_grad_tr").show();
				$("#pao2_tr").hide();
			}
		});

		$(".js-select2").select2({
		    tags: true,
		    dropdownParent: $("#addModal")
		});
	});
</script>
@endsection