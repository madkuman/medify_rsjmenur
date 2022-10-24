@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Nyeri saat Pasien Tidak Sadar - Kasus
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
						<h4>Nyeri saat Pasien Tidak Sadar</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($nyeri as $item)

                    		@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif
						<h5 class="mb-5 pl-5">#PEWS {{$count++}}</h5>
						<div class="row">
							<div class="col-md-6">
								<table class="table table-sm table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:45%">Parameter</th>
											<th class="text-center" style="width: 45%;">Penilaian</th>
											<th class="text-center" style="width: 10%;">Skor</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Ekspresi wajah</td>
											<td class="text-center">{{$item->ekspresi_text}}</td>
											<td class="text-center">{{$item->ekspresi}}</td>
										</tr>
										<tr>
											<td>Pergerakan ekstremis atas</td>
											<td class="text-center">{{$item->movement_text}}</td>
											<td class="text-center">{{$item->movement}}</td>
										</tr>
										<tr>
											<td>Kompensasi terhadap ventilator</td>
											<td class="text-center">{{$item->ventilator_text}}</td>
											<td class="text-center">{{$item->ventilator}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-6 text-center pt-50">
								<h3> Skor </h3>
								<h1 class="display-1">{{$item->score}}</h1>
								<h3> {{$item->class}} </h3>
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
							<h4 class="font-w400 mb-5">Belum ada hasil Nyeri saat Pasien Tidak Sadar tersedia</h4>
							<p>Klik tombol <b>Asesmen Baru</b> untuk melakukan penilaian Nyeri saat Pasien Tidak Sadar</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/nyeri-post-ops/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.nyeri-post-ops.add')
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