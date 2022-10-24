@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Skrining Gizi - Kasus
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
						<div class="content"> 
							@if(session('my_role_'.$kasus->nomor_kasus))
							@if(count($kasus->anak) > 0)
							<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addKebidanan"><i class="fa fa-pencil"></i> Skrining Gizi Kebidanan</button>
							@elseif($kasus->pasien->age >= 17)
							<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Skrining Gizi Dewasa Baru</button>
							@elseif($kasus->pasien->age < 17)
							<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right mr-10" data-toggle="modal" data-target="#addAnak"><i class="fa fa-pencil"></i> Skrining Gizi Anak Baru</button>
							@endif
							@endif
							<h4>Skrining Gizi</h4>
							<hr>
							@php $count = 1 @endphp
							@forelse($gizi as $item)

							@if(session('my_role_'.$kasus->nomor_kasus))
							@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
							<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
								<i class="fa fa-trash"></i>
							</button>
							@endif
							@endif
							<h5 class="mb-5 pl-5">#Skrining Gizi {{$count++}}</h5>
							<div class="row">
								<div class="col-md-6">
									<table class="table table-sm table-borderless table-vcenter" style="width: 100%">
										<thead>
											<tr>
												<th style="width:40%">Parameter</th>
												<th class="text-center" style="width: 35%;">Penilaian</th>
												<th class="text-center" style="width: 25%;">Skor</th>
											</tr>
										</thead>
										@if(count($kasus->anak) > 0)
										<tbody>
											<tr>
												<td>Asupan makan berkurang karena tidak nafsu makan</td>
												<td class="text-center">{{$item->asupan_kebidanan_text}}</td>
												<td class="text-center">{{$item->asupan_kebidanan}}</td>
											</tr>
											<tr>
												<td>angguan metabolisme (DM, gangguan fungsi tiroid, infeksi kronis: HIV/AIDS, TB, Lupus</td>
												<td class="text-center">{{$item->gangguan_metabolisme_text}}</td>
												<td class="text-center">{{$item->gangguan_metabolisme}}</td>
											</tr>
											<tr>
												<td>Pertambahan berat badan yang kurang atau lebih dari anjuran selama kehamilan</td>
												<td class="text-center">{{$item->bb_kebidanan_text}}</td>
												<td class="text-center">{{$item->bb_kebidanan}}</td>
											</tr>
											<tr>
												<td>Nilai HB < 10 g/dl atau HCT < 30%</td>
												<td class="text-center">{{$item->hb_hct_text}}</td>
												<td class="text-center">{{$item->hb_hct}}</td>
											</tr>
										</tbody>
										@elseif($kasus->pasien->age < 17)
										<tbody>
											<tr>
												<td>Pasien Tampak Kurus</td>
												<td class="text-center">{{$item->kurus_text}}</td>
												<td class="text-center">{{$item->kurus}}</td>
											</tr>
											<tr>
												<td>Terdapat Penurunan Berat Badan 1 Bulan Terakhir</td>
												<td class="text-center">{{$item->turun_bb_text}}</td>
												<td class="text-center">{{$item->turun_bb}}</td>
											</tr>
											<tr>
												<td>Diarhea > 5 kali/hari dan muntah > 3 kali/hari dalam seminggu terakhir dan asupan makanan berkurang selama 1 minggu terakhir</td>
												<td class="text-center">{{$item->kondisi_lain_text}}</td>
												<td class="text-center">{{$item->kondisi_lain}}</td>
											</tr>
											<tr>
												<td>Terdapat kondisi atau penyakit yang memungkinkan malnutrisi</td>
												<td class="text-center">{{$item->malnutrisi_text}}</td>
												<td class="text-center">{{$item->malnutrisi}}</td>
											</tr>
										</tbody>
										@elseif($kasus->pasien->age >= 17)
										<tbody>
											<tr>
												<td>Asupan makanan berkurang karena nafsu makan menurun atau sulit mendapat asupan</td>
												<td class="text-center">{{$item->asupan_turun_text}}</td>
												<td class="text-center">{{$item->asupan_turun}}</td>
											</tr>
											<tr>
												<td>Terdapat Penurunan Berat Badan 6 Bulan Terakhir</td>
												<td class="text-center">{{$item->turun_bb_anak_text}}</td>
												<td class="text-center">{{$item->turun_bb_anak}}</td>
											</tr>
										</tbody>
										@endif
									</table>
								</div>
								<div class="col-md-6 text-center pt-50">
									<h3> Skor </h3>
									<h1 class="display-1">{{$item->score}}</h1>
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
								<h4 class="font-w400 mb-5">Belum ada hasil Skrining Gizi tersedia</h4>
								<p>Klik tombol <b>Skrining Gizi Baru</b> untuk melakukan Skrining Gizi</p>
							</div>

							@endforelse
						</div>
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/gizi/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.gizi.add')
@include('kasus.alatbantu.gizi.add-anak')
@include('kasus.alatbantu.gizi.add-kebidanan')
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