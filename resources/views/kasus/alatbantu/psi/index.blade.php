@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - PSI - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> PSI Baru</button>
						@endif
						<h4>PSI</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($psi as $item)

                    	@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif
						<h5 class="mb-5 pl-5">#PSI {{$count++}}</h5>
						<div class="row">
							<div class="col-md-4">
								<table class="table table-sm table-striped table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:70%">Parameter</th>
											<th class="text-center" style="width: 30%;">Kondisi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Nursing home resident</td>
											<td class="text-center">{{$item->nursing_home_res > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Neoplastic disease</td>
											<td class="text-center">{{$item->neoplastic > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Liver disease history</td>
											<td class="text-center">{{$item->liver > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>CHF history</td>
											<td class="text-center">{{$item->chf > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Cerebrovascular disease history</td>
											<td class="text-center">{{$item->cerebrovascular > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Renal disease history</td>
											<td class="text-center">{{$item->renal > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Altered mental status</td>
											<td class="text-center">{{$item->altered_mental > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Respiratory rate >= 30 nafas/min</td>
											<td class="text-center">{{$item->resp_rate > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Systolic BP < 90 mmHg</td>
											<td class="text-center">{{$item->systol_bp > 0 ? 'Yes' : 'No'}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-4">
								<table class="table table-sm table-striped table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:70%">Parameter</th>
											<th class="text-center" style="width: 30%;">Kondisi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Temp <35°C atau >39.9°C</td>
											<td class="text-center">{{$item->temp > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Pulse >=125 beats/min</td>
											<td class="text-center">{{$item->pulse > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>pH <7.35</td>
											<td class="text-center">{{$item->ph > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>BUN ≥30 mg/dL atau ≥11 mmol/L</td>
											<td class="text-center">{{$item->bun > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Sodium <130 mmol/L</td>
											<td class="text-center">{{$item->sodium > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Glucose ≥250 mg/dL atau ≥14 mmol/L</td>
											<td class="text-center">{{$item->glucose > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Hematocrit <30%</td>
											<td class="text-center">{{$item->hematocrit > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>PaO2 <60 mmHg atau <8 kPa</td>
											<td class="text-center">{{$item->ppo2 > 0 ? 'Yes' : 'No'}}</td>
										</tr>
										<tr>
											<td>Pleural effusion on x-ray</td>
											<td class="text-center">{{$item->pleural_eff > 0 ? 'Yes' : 'No'}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-4 text-center pt-50">
								<div class="block block-themed">
							       	<div class="block-header bg-warning">
							           	<h3 class="block-title">PSI</h3>
							       	</div>
							       	<div class="block-content">
							           	<h4 class="mb-5"><strong>Skor: {{$item->score}}</strong></h4>
							           	<h6 class="mb-5">{{$item->class}}</h6>
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
							<h4 class="font-w400 mb-5">Belum ada asesmen PSI tersedia</h4>
							<p>Klik tombol <b>PSI Baru</b> untuk melakukan asesmen PSI</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/psi/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.psi.add')
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