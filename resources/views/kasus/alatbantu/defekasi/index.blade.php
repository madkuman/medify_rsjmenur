@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Defikasi - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Eliminasi Defekasi Baru</button>
						@endif
						<h4>Eliminasi Defekasi</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($defekasi as $item)

						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif

						<h5 class="mb-5 pl-5">#Defekasi {{$count++}}</h5>
						<div class="row">
							<div class="col-md-8">
								<table class="table table-sm table-striped table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:40%">Parameter</th>
											<th class="text-center" style="width: 35%;">Status</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Hasil</td>
											@if(empty($item->kelainan))
											<td class="text-center">Normal</td>
											@else
											<td class="text-center">Tidak normal, {{$item->kelainan}}</td>
											@endif
										</tr>
										<tr>
											<td>Konsistensi</td>
											<td class="text-center">{{$item->konsistensi}}</td>	
										</tr>
										<tr>
											<td>Frekuensi</td>
											<td class="text-center">{{$item->frekuensi}}</td>	
										</tr>
										<tr>
											<td>Warna</td>
											<td class="text-center">{{$item->warna}}</td>	
										</tr>
									</tbody>
								</table>
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
							<h4 class="font-w400 mb-5">Belum ada hasil Eliminasi Defekasi tersedia</h4>
							<p>Klik tombol <b>Eliminasi defekasi Baru</b> untuk melakukan penilaian Eliminasi Defekasi</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>


<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/defekasi/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.defekasi.add')
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

	$('#tidak-normal').on('click', function(){
		$('#defekasi-ket').show();
	});
	$('#normal').on('click', function(){
		$('#defekasi-ket').hide();
	});
</script>
@endsection