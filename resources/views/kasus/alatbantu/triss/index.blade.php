@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - TRISS - Kasus
@endsection

@section('css')
<style type="text/css">
    .triage-item {
        font-weight: 500;
        width: 100%;
    }
    .triage-item > input{ /* HIDE RADIO */
        visibility: hidden; /* Makes input not-clickable */
        position: absolute; /* Remove input from document flow */
    }

    .triage-item div
    {
        padding:8px 8px;
    }

    .triage-item > input + div{ /* DIV STYLES */
        cursor:pointer;
        border:2px solid transparent;
    }
    .triage-item > input:checked + div{ /* (RADIO CHECKED) DIV STYLES */
        background: #dcdcdc;
    }

    .table.triage td, .table.triage th
    {
        text-align: center;
    }
</style>
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> TRISS Baru</button>
						@endif
						<h4>TRISS</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($triss as $item)

                    	@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif
						<h5 class="mb-5 pl-5">#TRISS {{$count++}}</h5>
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
											<td>Kepala & Leher</td>
											<td class="text-center">{{$item->headneck_text}}</td>
										</tr>
										<tr>
											<td>Wajah</td>
											<td class="text-center">{{$item->face_text}}</td>
										</tr>
										<tr>
											<td>Dada</td>
											<td class="text-center">{{$item->chest_text}}</td>
										</tr>
										<tr>
											<td>Abdomen</td>
											<td class="text-center">{{$item->abdomen_text}}</td>
										</tr>
										<tr>
											<td>Extremity</td>
											<td class="text-center">{{$item->extremity_text}}</td>
										</tr>
										<tr>
											<td>Eksternal</td>
											<td class="text-center">{{$item->external_text}}</td>
										</tr>
										<tr>
											<th>ISS Score</th>
											<th class="text-center">{{$item->iss_score}}</th>
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
											<td>Tekanan Darah Sistol</td>
											<td class="text-center">{{$item->systol_bp}} mmHg</td>
										</tr>
										<tr>
											<td>Laju Pernafasan</td>
											<td class="text-center">{{$item->resp_rate}} nafas/menit</td>
										</tr>
										<tr>
											<th>RTS Score</th>
											<th class="text-center">{{$item->rts_score}}</th>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-4 text-center pt-50">
								<div class="block block-themed">
							       	<div class="block-header bg-warning">
							           	<h3 class="block-title">Survive Prob.</h3>
							       	</div>
							       	<div class="block-content">
							           	<h4 class="mb-5">Blunt: {{round($item->blunt_prob, 2)}}%</h4>
							           	<h4 class="mb-5">Penetrating: {{round($item->penetrating_prob, 2)}}%</h4>
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
							<h4 class="font-w400 mb-5">Belum ada asesmen TRISS tersedia</h4>
							<p>Klik tombol <b>TRISS Baru</b> untuk melakukan asesmen TRISS</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/triss/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.triss.add')
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