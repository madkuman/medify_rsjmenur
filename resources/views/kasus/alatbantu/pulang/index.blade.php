@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Perencanaan Pulang - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i>Perencanaan Pulang</button>
						@endif
						<h4>Perencanaan Pulang</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($pulang as $item)

						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif
						<h5 class="mb-5 pl-5">#Perencanaan Pulang {{$count++}}</h5>
						<div class="row">
							<div class="col-md-9">
								<!-- <table class="table table-sm table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:40%">Parameter</th>
											<th class="text-center" style="width: 60%;">Keterangan</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Pelayanan Home Care</td>
											<td class="text-center">{{$item->home_care or '-'}}</td>
										</tr>
										<tr>
											<td>Pemasangan Implant</td>
											<td class="text-center">{{$item->implant or '-'}}</td>
										</tr>
										<tr>
											<td>Penggunaan Alat Bantu</td>
											<td class="text-center">{{$item->alat_bantu or '-'}}</td>
										</tr>
										<tr>
											<td>Pemesanan Alat</td>
											<td class="text-center">{{$item->pemesanan_alat or '-'}}</td>
										</tr>
										<tr>
											<td>Dirujuk ke komunitas tertentu</td>
											<td class="text-center">{{$item->komunitas_tertentu or '-'}}</td>
										</tr>
										<tr>
											<td>Dirujuk ke tim terapis</td>
											<td class="text-center">{{$item->tim_terapis or '-'}}</td>
										</tr>
										<tr>
											<td>Dirujuk ke ahli gizi</td>
											<td class="text-center">{{$item->ahli_gizi or '-'}}</td>
										</tr>
										<tr>
											<td>Lain - Lain</td>
											<td class="text-center">{{$item->lain_lain or '-'}}</td>
										</tr>
									</tbody>
								</table> -->
								<table class="table table-sm table-borderless table-vcenter table" style="width: 60%">
									<tr>
										<td><b>Kriteria Discharge Planning</b></td>
									</tr>
									@if($item->discharge_umur)
									<tr>
										<td>Umur > 65 Tahun</td>
									</tr>
									@endif
									@if($item->discharge_mobilitas)
									<tr>
										<td>Keterbatasan Mobilitas</td>
									</tr>
									@endif
									@if($item->discharge_perawatan)
									<tr>
										<td>Perawatan atau pengobatan lanjutan</td>
									</tr>
									@endif
									@if($item->discharge_bantuan)
									<tr>
										<td>Bantuan beraktivitas sehari hari</td>
									</tr>
									@endif
									<tr>
										<td><b>Perencanaan Pulang</b></td>
									</tr>
									@if($item->discharge_perawatan_diri)
									<tr>
										<td>Perawatan diri (mandi, BAK, BAB)</td>
									</tr>
									@endif
									@if($item->discharge_obat)
									<tr>
										<td>Pemantauan pemberian obat</td>
									</tr>
									@endif
									@if($item->discharge_diet)
									<tr>
										<td>Pemantauan diet</td>
									</tr>
									@endif
									@if($item->discharge_luka)
									<tr>
										<td>Perawatan luka</td>
									</tr>
									@endif
									@if($item->discharge_latihan)
									<tr>
										<td>Latihan fisik lanjutan</td>
									</tr>
									@endif
									@if($item->discharge_tenaga_khusus)
									<tr>
										<td>Pendampingan tenaga khusus di rumah</td>
									</tr>
									@endif
									@if($item->discharge_medis)
									<tr>
										<td>Bantuan medis/perawatan rumah</td>
									</tr>
									@endif
									@if($item->discharge_fisik)
									<tr>
										<td>Bantuan aktivitas fisik</td>
									</tr>
									@endif
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
							<h4 class="font-w400 mb-5">Belum ada Perencanaan Pulang</h4>
							<p>Klik tombol <b>Perencanaan Pulang</b> untuk melakukan Perencanaan Pulang</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/pulang/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.pulang.add')
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