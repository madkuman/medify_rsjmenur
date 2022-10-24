@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Aldrete - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Skor Aldrete Baru</button>
						@endif
						<h4>Aldrete</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($aldrete as $item)

						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif

						<h5 class="mb-5 pl-5">#Aldrete {{$count++}}</h5>
						<div class="row">
							<div class="col-md-8">
								<table class="table table-sm table-striped table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:40%">Parameter</th>
											<th class="text-center" style="width: 35%;">Penilaian</th>
											<th class="text-center" style="width: 25%;">Skor</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Kondisi Fisik</td>
											<td class="text-center">{{$item->val->warna_text}}</td>
											<td class="text-center">{{$item->val->warna}}</td>
										</tr>
										<tr>
											<td>Kesadaran</td>
											<td class="text-center">{{$item->val->pernafasan_text}}</td>
											<td class="text-center">{{$item->val->pernafasan}}</td>
										</tr>
										<tr>
											<td>Aktifitas</td>
											<td class="text-center">{{$item->val->sirkulasi_text}}</td>
											<td class="text-center">{{$item->val->sirkulasi}}</td>
										</tr>
										<tr>
											<td>Mobilitas</td>
											<td class="text-center">{{$item->val->kesadaran_text}}</td>
											<td class="text-center">{{$item->val->kesadaran}}</td>
										</tr>
										<tr>
											<td>Inkontines</td>
											<td class="text-center">{{$item->val->aktifitas_text}}</td>
											<td class="text-center">{{$item->val->aktifitas}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-4 text-center pt-50">
								<h3> Skor </h3>
								<h1 class="display-1">{{$item->val->score}}</h1>
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
							<h4 class="font-w400 mb-5">Belum ada hasil Aldrete tersedia</h4>
							<p>Klik tombol <b>Skor aldrete Baru</b> untuk melakukan penilaian Aldrete</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>


<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/aldrete/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.aldrete.add')
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