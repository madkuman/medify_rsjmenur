@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Triage - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Skor Triage Baru</button>
						<button type="button" class="btn btn-rounded btn-alt-success min-width-125 float-right mr-5" data-toggle="modal" data-target="#addTriage"><i class="fa fa-plus"></i> Koneksikan Triage</button>
						@endif
						<h4>Triage</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($triage as $item)
						
						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif

						<h5 class="mb-5 pl-5">#Triage {{$count++}}</h5>
						<div class="row creator py-10">
							<div class="col-md-5">
								<h6 class="mb-5">
									<small class="text-muted">Nama Pasien :</small>
									{{$item->nama_pasien or '-'}}
								</h6>	
							</div>
							<div class="col-md-7">
							</div>
							<div class="col-md-5">
								<h6 class="mb-5">
									<small class="text-muted">Tanggal Kedatangan :</small>
									{{indonesian_date($item->datangigd_at,'d F Y')}}
								</h6>
							</div>
							<div class="col-md-7">
							</div>
							<div class="col-md-5">
								<h6 class="mb-5">
									<small class="text-muted">Jam Kedatangan :</small>
									{{date('H:i', strtotime($item->datangigd_at))}}
								</h6>
							</div>
							<div class="col-md-7">
							</div>
							<div class="col-md-5">
								<h6 class="mb-5">
									<small class="text-muted">Cara Datang :</small>
									{{$item->cara_datang or '-'}}
								</h6>	
							</div>
							<div class="col-md-7">
								<h6 class="mb-5">
									<small class="text-muted">Transportasi ke IGD :</small>
									{{$item->transport_igd or '-'}}
								</h6>
							</div>
							<div class="col-md-5">
								<h6 class="mb-5">
									<small class="text-muted">Komunikasi :</small>
									{{$item->komunikasi or '-'}}
								</h6>	
							</div>
							<div class="col-md-7">
								<h6 class="mb-5">
									<small class="text-muted">Anamnesa :</small>
									{{$item->ganti_anamnesa or '-'}}
								</h6>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<table class="table table-sm table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:40%">Parameter</th>
											<th class="text-center" style="width: 35%;">Penilaian</th>
											<th class="text-center" style="width: 25%;">Skor</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Mobilitas</td>
											<td class="text-center">{{$item->mobility_text}}</td>
											<td class="text-center">{{$item->mobility}}</td>
										</tr>
										<tr>
											<td>Pernafasan</td>
											<td class="text-center">{{$item->resp_text}}</td>
											<td class="text-center">{{$item->resp}}</td>
										</tr>
										<tr>
											<td>Heart Rate</td>
											<td class="text-center">{{$item->heartrate_text}}</td>
											<td class="text-center">{{$item->heartrate}}</td>
										</tr>
										<tr>
											<td>Tekanan Sistolik</td>
											<td class="text-center">{{$item->systol_text}}</td>
											<td class="text-center">{{$item->systol}}</td>
										</tr>
										<tr>
											<td>Temperatur</td>
											<td class="text-center">{{$item->temp_text}}</td>
											<td class="text-center">{{$item->temp}}</td>
										</tr>
										<tr>
											<td>Kesadaran</td>
											<td class="text-center">{{$item->conscious_text}}</td>
											<td class="text-center">{{$item->conscious}}</td>
										</tr>
										<tr>
											<td>Trauma</td>
											<td class="text-center">{{$item->trauma_text}}</td>
											<td class="text-center">{{$item->trauma}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-4">
								<table class="table table-sm table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:40%">Triage</th>
											<th class="text-center" style="width: 60%;">Diskriminan</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($item->p1_diskriminan) || !empty($item->pertimbangan_khusus_p1))
										<tr class="bg-danger">
											<td class="text-center" style="color: white"><strong>P1</strong></td>
											<td style="color: white">
												@if(!empty($item->p1_diskriminan))
												@foreach($item->p1_text as $p1_text)
												<strong>- {{$p1_text}}</strong><br>
												@endforeach
												@endif
												@if(!empty($item->pertimbangan_khusus_p1))
												<strong>- {{$item->pertimbangan_khusus_p1}}</strong>
												@endif
											</td>
										</tr>
										@endif
										@if(!empty($item->p2_diskriminan) || !empty($item->pertimbangan_khusus_p2))
										<tr class="bg-warning">
											<td class="text-center" style="color: white"><strong>P2</strong></td>
											<td style="color: white">
												@if(!empty($item->p2_diskriminan))
												@foreach($item->p2_text as $p2_text)
												<strong>- {{$p2_text}}</strong><br>
												@endforeach
												@endif
												@if(!empty($item->pertimbangan_khusus_p2))
												<strong>- {{$item->pertimbangan_khusus_p2}}</strong>
												@endif
											</td>
										</tr>
										@endif
										@if(!empty($item->p3_diskriminan) || !empty($item->kasus_lain))
										<tr class="bg-success">
											<td class="text-center" style="color: white"><strong>P3</strong></td>
											<td style="color: white">
												@if(!empty($item->p3_diskriminan))
												<strong>- Nyeri ringan</strong><br>
												@endif
												@if(!empty($item->kasus_lain))
												<strong>- Kasus Lain</strong><br>
												<strong>({{$item->kasus_lain}})</strong><br>
												@endif
											</td>
										</tr>
										@endif
										@if(!empty($item->ponek_diskriminan))
										<tr style="background-color: #ff00bb">
											<td class="text-center" style="color: white"><strong>PONEK</strong></td>
											<td style="color: white">
												@foreach($item->ponek_text as $ponek_text)
												<strong>- {{$ponek_text}}</strong><br>
												@endforeach
											</td>
										</tr>
										@endif
									</tbody>
								</table>
							</div>

							<div class="col-md-4 text-center pt-50">
								@if(!empty($item->ponek_diskriminan))
								<div class="block block-themed">
									<div class="block-header" style="background-color: #ff00bb">
										<h3 class="block-title">Triage</h3>
									</div>
									<div class="block-content">
										<h2 class="mb-5">PONEK</h2>
										<p class="">Skor: {{$item->score}}</p>
									</div>
								</div>
								@elseif(!empty($item->p1_diskriminan) || $item->score > 5 || !empty($item->pertimbangan_khusus_p1))
								<div class="block block-themed">
									<div class="block-header bg-danger">
										<h3 class="block-title">Triage</h3>
									</div>
									<div class="block-content">
										<h2 class="mb-5">P1</h2>
										<p class="">
											@if($item->score <= 5)via Diskriminan<br>@endif
											Skor: {{$item->score}}
										</p>
									</div>
								</div>
								@elseif(!empty($item->p2_diskriminan) || $item->score >= 3 || !empty($item->pertimbangan_khusus_p2))
								<div class="block block-themed">
									<div class="block-header bg-warning">
										<h3 class="block-title">Triage</h3>
									</div>
									<div class="block-content">
										<h2 class="mb-5">P2</h2>
										<p class="">
											@if($item->score < 3)via Diskriminan<br>@endif
											Skor: {{$item->score}}
										</p>
									</div>
								</div>
								@else
								<div class="block block-themed">
									<div class="block-header bg-success">
										<h3 class="block-title">Triage</h3>
									</div>
									<div class="block-content">
										<h2 class="mb-5">P3</h2>
										<p class="">
											Skor: {{$item->score}}
										</p>
									</div>
								</div>
								@endif
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
							<h4 class="font-w400 mb-5">Belum ada triage</h4><br>
							<p>Klik tombol <b>Skor Triage Baru</b> untuk melakukan penilaian triage,<br>
								atau klik tombol <b>Tambah Triage</b> untuk memilih dari triage yang telah dibuat di modul IGD</p>
							</div>

							@endforelse
						</div>
					</div>
				</div>
				<!-- END Updates -->
			</div>
		</div>
	</main>

	<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/triage/delete" id="formDelete">
		{{csrf_field()}}
		<input name="id" type="hidden" id="deleteInputId">

	</form>

	@include('igd.triage.form.tabel-skor-triage')
	@include('kasus.alatbantu.triage.add-from-exist')
	<!-- END Main Container -->    
	@endsection

	@section('js')
	<script type="text/javascript">
		$(document).ready(function(){
			$("#triage_id").select2({
				dropdownParent: $("#addTriage")
			});
		});

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
	</script>
	@endsection