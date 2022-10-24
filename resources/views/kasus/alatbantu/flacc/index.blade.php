@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Skala Flacc - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Skala Flacc Baru</button>
						@endif
						<h4>Skala Flacc</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($flacc as $item)

                    	@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif
						<h5 class="mb-5 pl-5">#Skala Flacc {{$count++}}</h5>
						<div class="row">
							<div class="col-md-9">
								<table class="table table-sm table-striped table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:40%">Parameter</th>
											<th class="text-center" style="width: 60%;">Kondisi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Wajah</td>
											<td class="text-center">{{$item->wajah_text}}</td>
										</tr>
										<tr>
											<td>Kaki</td>
											<td class="text-center">{{$item->kaki_text}}</td>
										</tr>
										<tr>
											<td>Aktivitas</td>
											<td class="text-center">{{$item->aktivitas_text}}</td>
										</tr>
										<tr>
											<td>Menangis</td>
											<td class="text-center">{{$item->menangis_text}}</td>
										</tr>
										<tr>
											<td>Consolability</td>
											<td class="text-center">{{$item->consolability_text}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-3 text-center pt-50">
								<div class="block block-themed">
							       	<div class="block-header bg-warning">
							           	<h3 class="block-title">Survive Prob.</h3>
							       	</div>
							       	<div class="block-content">
							           	<h4 class="mb-5">Score : {{$item->score}} ({{$item->score_text}})</h4>
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Skala Flacc tersedia</h4>
							<p>Klik tombol <b>Skala Flacc Baru</b> untuk melakukan asesmen Skala Flacc</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/flacc/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.flacc.add')
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