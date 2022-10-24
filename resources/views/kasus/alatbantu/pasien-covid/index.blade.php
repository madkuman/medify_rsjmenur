@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Skrining Pasien Covid-19 - Kasus
@endsection

@section('css')
<style type="text/css">
.select2-selection--multiple .select2-search--inline .select2-search__field {
width: auto !important;
}
.tooltip-inner {
    max-width: 100% !important;
   text-align:left;
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
						@if(session('my_role_'.$kasus->nomor_kasus) && Auth::user()->profesi == 1)
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal2" id="addCovid"><i class="fa fa-pencil"></i> Skrining Pasien Covid-19 Baru</button>
						@endif
						<h4>Skrining Pasien Covid-19</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($covid as $item)

						@if((session('my_role_'.$kasus->nomor_kasus)->admin ?? 0) == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>

						@endif

						
						@if(session('my_role_'.$kasus->nomor_kasus) && Auth::user()->profesi == 1)
						@if(!$item->is_format_baru)
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right editBtn" data-item="{{json_encode($item)}}">
							<i class="fa fa-pencil"></i>
						</button>
						@else
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right editBtn2" data-item="{{json_encode($item)}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						@endif

						<a type="btn" href="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/asesmen/pasien-covid/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
							<i class="fa fa-print"></i>
						</a>
						@if(!$item->is_format_baru)
						<h5 class="mb-5 pl-5">Skrining Covid-19 #{{$count++}}</h5>
						<div class="row">
							<div class="col-md-8">
								<table class="table table-sm table-striped table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:70%">Parameter</th>
											<th class="text-center" style="width: 30%;">Penilaian</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Demam/Riwayat Demam &ge; 38 &deg;C &lt;14 hari</td>
											<td class="text-center">{{$item->val->demam_text}}</td>
										</tr>
										<tr>
											<td>Batuk-Pilek/Nyeri Tenggorokan Atau Sesak Nafas &lt;14 Hari</td>
											<td class="text-center">{{$item->val->bapil_text}}</td>
										</tr>
										<tr>
											<td>ISPA Atau Pneumonia Berat &lt;14 hari</td>
											<td class="text-center">{{$item->val->nafas_text}}</td>
										</tr>
										<tr>
											<td>Pasien Termasuk Kasus Probable Atau Pernah Kontak Erat Dengan Pasien Covid-19</td>
											<td class="text-center">{{$item->val->kontak_text}}</td>
										</tr>
										<tr>
											<td>Negara yang Dikunjungi  &lt;14 Hari Sebelum Gejala</td>
											<td class="text-center">{{$item->val->negara_text ?? '-'}}</td>
										</tr>
										<tr>
											<td>Daerah Transmisi Yang Dikunjungi/Ditinggali &lt;14 Hari Sebelum Gejala</td>
											<td class="text-center">{{$item->val->daerah_text ?? '-'}}</td>
										</tr>
										<tr>
											<td>Hasil Rapid Test</td>
											<td class="text-center">{{(isset($item->val->rapid_test) && $item->val->rapid_test == 1 ? ($item->val->hasil_rapid_test == 1 ? "Positif" : "Negatif") : "Tidak Ada")}}</td>
										</tr>
										<tr>
											<td>Hasil Swab PCR</td>
											<td class="text-center">{{(isset($item->val->swab) && $item->val->swab == 1 ? ($item->val->hasil_swab == 1 ? "Positif" : "Negatif") : "Tidak Ada")}}</td>
										</tr>
										@php $alasan = $item->val->alasan ?? "" @endphp
										@if(!empty($alasan))
										<tr>
											<td>Adanya penyebab lain berdasarkan klinis yang meyakinkan</td>
											<td class="text-center">{{$item->val->alasan ?? 'Tidak Ada'}}</td>
										</tr>
										@endif
										{{--<tr>
											<td>Hasil Lab</td>
											<td class="text-center">{{$item->val->lab ?? '-'}}</td>
										</tr>
										<tr>
											<td>Hasil Radiologi</td>
											<td class="text-center">{{$item->val->radio ?? '-'}}</td>
										</tr>--}}
									</tbody>
								</table>
							</div>
							<div class="col-md-4 text-center">
								<h4 class="display-4">Status:</h4>
								@if($item->presentase == 1)
								<h3>Pasien Dalam Pengawasan</h3>
								<p>
									<ul>
										<li class="text-left">Rapid Tes</li>
										<li class="text-left">Ruang Isolasi</li>
										<li class="text-left">Cek Rontgen</li>
										<li class="text-left">Cek Lab Darah Lengkap</li>
										<li class="text-left">Pemantauan Kontak Erat (Keluarga)</li>
									</ul>
								</p>
								@elseif($item->presentase == 2)
								<h3>Kontak Erat Resiko Tinggi<br>(Orang Tanpa Gejala)</h3>
								<p>
									<ul>
										<li class="text-left">Rapid Test</li>
										<li class="text-left">Karantina Rumah</li>
										<li class="text-left">Edukasi</li>
									</ul>
								</p>
								@elseif($item->presentase == 3)
								<h3>Orang Dalam Pemantauan</h3>
								<p>
									<ul>
										<li class="text-left">Rapid Test</li>
										<li class="text-left">Karantina Rumah Jika &lt;60 Tahun</li>
										<li class="text-left">Karantina RS Darurat Jika &ge;60 Tahun</li>
									</ul>
								</p>
								@elseif($item->presentase == 4)
								<h3>Pasien Positif Covid-19</h3>
								<p>
									<ul>
										<li class="text-left">Ruang Isolasi</li>
										<li class="text-left">Cek Rontgen</li>
										<li class="text-left">Cek Lab Darah Lengkap</li>
										<li class="text-left">Pemantauan Kontak Erat (Keluarga)</li>
									</ul>
								</p>
								@elseif($item->presentase == 5)
								<h3>Pasien Probable Covid-19</h3>
								<p>
									<ul>
										<li class="text-left">Ruang Isolasi</li>
										<li class="text-left">Lakukan SWAB PCR</li>
										<li class="text-left">Pemantauan Kontak Erat (Keluarga)</li>
									</ul>
								</p>
								@else
								<h3>Normal</h3>
								@endif
							</div>
						</div>
						@else
						<h5 class="mb-5 pl-5">Skrining Covid-19 #{{$count++}}</h5>
						<div class="row">
							<div class="col-md-8">
								<table class="table table-sm table-striped table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="width:70%">Parameter</th>
											<th class="text-center" style="width: 30%;">Penilaian</th>
										</tr>
									</thead>
									<tbody>
									<tr>
											<td colspan="2">1. Gejala Mayor</td>
										</tr>
										<tr>
											<td>a. Demam</td>
											<td class="text-center">{{$item->val->demam_mayor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>b. Batuk</td>
											<td class="text-center">{{$item->val->batuk_mayor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>c. Nyeri Tenggorokan</td>
											<td class="text-center">{{$item->val->nyeri_tenggorokan_mayor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>d. Sesak</td>
											<td class="text-center">{{$item->val->sesak_mayor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>e. Anosmia</td>
											<td class="text-center">{{$item->val->anosmia_mayor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>f. Ageusia</td>
											<td class="text-center">{{$item->val->ageusia_mayor ? 'Ya' : 'Tidak'}}</td>
										</tr>




										<tr>
											<td colspan="2">2. Gejala Minor</td>
										</tr>
										<tr>
											<td>a. Nyeri Otot</td>
											<td class="text-center">{{$item->val->nyeri_otot_minor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>b. Nyeri Kepala</td>
											<td class="text-center">{{$item->val->nyeri_kepala_minor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>c. Diare</td>
											<td class="text-center">{{$item->val->diare_minor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>d. Mual/Muntah</td>
											<td class="text-center">{{$item->val->mual_minor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>e. Pilek, hidung tersumbat</td>
											<td class="text-center">{{$item->val->pilek_minor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>f. Panas-dingin Kaku sendi</td>
											<td class="text-center">{{$item->val->panas_dingin_minor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>g. Kelelahan</td>
											<td class="text-center">{{$item->val->kelelahan_minor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>h. Bingung</td>
											<td class="text-center">{{$item->val->bingung_minor ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>i. Nyeri Dada / dada terasa tertekan</td>
											<td class="text-center">{{$item->val->nyeri_dada_minor ? 'Ya' : 'Tidak'}}</td>
										</tr>


										<tr>
											<td colspan="2">3. Data Epidemiologis</td>
										</tr>

										<tr>
											<td>a. Riwayat kontak erat dengan kasus suspek / positif covid 19</td>
											<td class="text-center">{{$item->val->kontak_erat_epidemiologis ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>b. Tinggal di daerah dengan kasus endemik tinggi</td>
											<td class="text-center">{{$item->val->kasus_endemik_epidemiologis ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>c. Riwayat bepergian ke/dari daerah episentrum Covid 19</td>
											<td class="text-center">{{$item->val->daerah_episentrum_epidemiologis ? 'Ya' : 'Tidak'}}</td>
										</tr>

										<tr>
											<td colspan="2">4. Data Hasil Laboratorium</td>
										</tr>

										<tr>
											<td>a. Hasil Swab Antigen Positif</td>
											<td class="text-center">{{(isset($item->val->hasil_lab_antigen_positif) && $item->val->hasil_lab_antigen_positif) ? 'Ya' : 'Tidak'}}</td>
										</tr>
										<tr>
											<td>b. Hasil PCR Positif</td>
											<td class="text-center">{{(isset($item->val->hasil_lab_pcr_positif) && $item->val->hasil_lab_pcr_positif) ? 'Ya' : 'Tidak'}}</td>
										</tr>

										
									</tbody>
								</table>
							</div>
							<div class="col-md-4 text-center">
								<h4 class="display-4">Status:</h4>
								@if($item->presentase == 1)
								<h3>Pasien Suspek Covid-19</h3>
								<p>
									<ul>
										<li class="text-left">Rapid Tes</li>
										<li class="text-left">Ruang Isolasi</li>
										<li class="text-left">Cek Rontgen</li>
										<li class="text-left">Cek Lab Darah Lengkap</li>
										<li class="text-left">Pemantauan Kontak Erat (Keluarga)</li>
									</ul>
								</p>
								@elseif($item->presentase == 2)
								<h3>Kontak Erat Resiko Tinggi<br>(Orang Tanpa Gejala)</h3>
								<p>
									<ul>
										<li class="text-left">Rapid Test</li>
										<li class="text-left">Karantina Rumah</li>
										<li class="text-left">Edukasi</li>
									</ul>
								</p>
								@elseif($item->presentase == 6)
								<h3>Pasien Pelaku Perjalanan</h3>
								<p>
									<ul>
										<li class="text-left">Rapid Test</li>
										<li class="text-left">Karantina Rumah Jika &lt;60 Tahun</li>
										<li class="text-left">Karantina RS Darurat Jika &ge;60 Tahun</li>
									</ul>
								</p>
								@elseif($item->presentase == 4)
								<h3>Pasien Konfirmasi Positif Covid-19</h3>
								<p>
									<ul>
										<li class="text-left">Ruang Isolasi</li>
										<li class="text-left">Cek Rontgen</li>
										<li class="text-left">Cek Lab Darah Lengkap</li>
										<li class="text-left">Pemantauan Kontak Erat (Keluarga)</li>
									</ul>
								</p>
								@elseif($item->presentase == 5)
								<h3>Pasien Probable Covid-19</h3>
								<p>
									<ul>
										<li class="text-left">Ruang Isolasi</li>
										<li class="text-left">Lakukan SWAB PCR</li>
										<li class="text-left">Pemantauan Kontak Erat (Keluarga)</li>
									</ul>
								</p>
								@else
								<h3>Discarded (Normal)</h3>
								@endif
							</div>
						</div>
						@endif

                		<div class="row">
                    		<div class="col-4">
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
							</div>
							@if($item->updated_by)
                    		<div class="col-4">
								@if(!empty($item->editor->avatar_thumb))
								<div class="float-left mr-10">
									<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->editor->avatar_thumb)}}" alt="">
								</div>
								@else
								<div class="float-left mr-10">
									<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
								</div>
								@endif
								<div class="editor">
									<h6 class="pt-10">
										<small class="text-muted">Diubah Oleh</small><br>
										{{$item->editor->name}}<br>
										{{date('d F y, H:i', strtotime($item->updated_at))}}
									</h6>
								</div>
							</div>
							@endif
						</div>

						<hr class="my-20">
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum Ada Hasil Skrining Pasien Covid-19 Tersedia</h4>
							<p>Klik tombol <b>Skrining Pasien Covid-19 Baru</b> untuk melakukan Skrining Pasien Covid-19</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>


<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/asesmen/pasien-covid/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.pasien-covid.add')
@include('kasus.alatbantu.pasien-covid.add2')
<!-- END Main Container -->    
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		// $('#addCovid').on('click', function(){
		// 	$("#addModal input[type='radio'][name='demam'][value='0']").prop("checked", true);
		// 	$("#addModal input[type='radio'][name='bapil'][value='0']").prop("checked", true);
		// 	$("#addModal input[type='radio'][name='nafas'][value='0']").prop("checked", true);
		// 	$("#addModal input[type='radio'][name='travel_negara'][value='0']").prop("checked", true);
		// 	$('#if-travel-negara-show').hide();
		// 	$('#select-negara').val(null).trigger('change')
		// 	$("#addModal input[type='radio'][name='travel_daerah'][value='0']").prop("checked", true);
		// 	$('#if-travel-daerah-show').hide();
		// 	$('#select-daerah').val(null).trigger('change')
		// 	$("#addModal input[type='radio'][name='kontak'][value='0']").prop("checked", true);
			
		// 	$('#alasan-input').val('')

		// 	$("#addModal input[type='radio'][name='swab'][value='0']").prop("checked", true);
		// 	$('#swab-ya').hide();
		// 	$('#rapid-test-ya').hide();
		// 	$('.hasil_swab[value="0"]').prop("checked",true);

		// 	$('#alasan-wrap').hide();
		// 	$('#alasan-input').val('')
		// 	$('.is_penyebab_klinis_lain[value="0"]').prop("checked",true);

		// 	$('#idCovid').val('0')
		// })

		$('#addCovid').on('click', function(){
			$("#addModal2 input[type='radio'][name='demam_mayor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='batuk_mayor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='nyeri_tenggorokan_mayor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='sesak_mayor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='anosmia_mayor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='ageusia_mayor'][value='0']").prop("checked", true);


			$("#addModal2 input[type='radio'][name='nyeri_otot_minor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='nyeri_kepala_minor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='diare_minor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='mual_minor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='pilek_minor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='panas_dingin_otot_minor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='kelelahan_minor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='bingung_minor'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='nyeri_dada_minor'][value='0']").prop("checked", true);

			$("#addModal2 input[type='radio'][name='kontak_erat_epidemiologis'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='kasus_endemik_epidemiologis'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='daerah_episentrum_epidemiologis'][value='0']").prop("checked", true);

			$("#addModal2 input[type='radio'][name='hasil_lab_pcr_positif'][value='0']").prop("checked", true);
			$("#addModal2 input[type='radio'][name='hasil_lab_antigen_positif'][value='0']").prop("checked", true);

			$('#idCovid2').val('0')
		})

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

		$(".editBtn").click(function(e){
			var dataItem = $(this).data('item');
			if(dataItem.val.demam != 0)
				$("#addModal input[type='radio'][name='demam'][value='1']").prop("checked", true);
			else
				$("#addModal input[type='radio'][name='demam'][value='0']").prop("checked", true);

			if(dataItem.val.bapil != 0)
				$("#addModal input[type='radio'][name='bapil'][value='1']").prop("checked", true);
			else
				$("#addModal input[type='radio'][name='bapil'][value='0']").prop("checked", true);

			if(dataItem.val.nafas != 0)
				$("#addModal input[type='radio'][name='nafas'][value='1']").prop("checked", true);
			else
				$("#addModal input[type='radio'][name='nafas'][value='0']").prop("checked", true);

			var negara_length = 0;
			$.each(dataItem.val.negara, function( index, value ) {
				if(value != null) negara_length++;
			});

			var daerah_length = 0;
			$.each(dataItem.val.daerah, function( index, value ) {
				if(value != null) daerah_length++;
			});

			if(negara_length != 0){
				$("#addModal input[type='radio'][name='travel_negara'][value='1']").prop("checked", true);
				$('#if-travel-negara-show').show();
				$('#select-negara').val(dataItem.val.negara).trigger('change')
			}
			else{
				$("#addModal input[type='radio'][name='travel_negara'][value='0']").prop("checked", true);
				$('#if-travel-negara-show').hide();
			}

			if(daerah_length != 0){
				$("#addModal input[type='radio'][name='travel_daerah'][value='1']").prop("checked", true);
				$('#select-daerah').val(dataItem.val.daerah).trigger('change')
				$('#if-travel-daerah-show').show();
			}
			else{
				$("#addModal input[type='radio'][name='travel_daerah'][value='0']").prop("checked", true);
				$('#if-travel-daerah-show').hide();
			}

			if(dataItem.val.kontak != 0)
				$("#addModal input[type='radio'][name='kontak'][value='1']").prop("checked", true);
			else
				$("#addModal input[type='radio'][name='kontak'][value='0']").prop("checked", true);


			if(dataItem.val.hasil_swab != 0)
				$("#addModal input[type='radio'][name='hasil_swab'][value='1']").prop("checked", true);
			else
				$("#addModal input[type='radio'][name='hasil_swab'][value='0']").prop("checked", true);


			if(dataItem.val.swab && dataItem.val.swab != 0){
				$("#addModal input[type='radio'][name='swab'][value='1']").prop("checked", true);

				$('#swab-ya').show();
				if(dataItem.val.hasil_swab && dataItem.val.hasil_swab != 0)
					$('.hasil_swab[value="1"]').prop("checked",true);
				else
					$('.hasil_swab[value="0"]').prop("checked",true);
			}
			else{
				$("#addModal input[type='radio'][name='swab'][value='0']").prop("checked", true);
				$('#swab-ya').hide();
				$('.hasil_swab[value="0"]').prop("checked",true);
			}



			if(dataItem.val.rapid_test && dataItem.val.rapid_test != 0){
				$("#addModal input[type='radio'][name='rapid_test'][value='1']").prop("checked", true);

				$('#rapid-test-ya').show();
				if(dataItem.val.hasil_rapid_test && dataItem.val.hasil_rapid_test != 0)
					$('.hasil_rapid_test[value="1"]').prop("checked",true);
				else
					$('.hasil_rapid_test[value="0"]').prop("checked",true);
			}
			else{
				$("#addModal input[type='radio'][name='rapid_test'][value='0']").prop("checked", true);
				$('#rapid-test-ya').hide();
				$('.hasil_rapid_test[value="0"]').prop("checked",true);
			}


			if(dataItem.val.alasan !=null){
				$('#alasan-wrap').show();
				$('#alasan-input').val(dataItem.val.alasan)
				$('.is_penyebab_klinis_lain[value="1"]').prop("checked",true);
			}
			else
			{
				$('#alasan-wrap').hide();
				$('#alasan-input').val('')
				$('.is_penyebab_klinis_lain[value="0"]').prop("checked",true);
			}
			$('#idCovid').val(dataItem.id)
			$('#addModal').modal('toggle');
		});

		$(".editBtn2").click(function(e){
			var dataItem = $(this).data('item');
			if(dataItem.val.demam_mayor != 0)
				$("#addModal2 input[type='radio'][name='demam_mayor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='demam_mayor'][value='0']").prop("checked", true);
			if(dataItem.val.batuk_mayor != 0)
				$("#addModal2 input[type='radio'][name='batuk_mayor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='batuk_mayor'][value='0']").prop("checked", true);
			if(dataItem.val.nyeri_tenggorokan_mayor != 0)
				$("#addModal2 input[type='radio'][name='nyeri_tenggorokan_mayor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='nyeri_tenggorokan_mayor'][value='0']").prop("checked", true);
			if(dataItem.val.sesak_mayor != 0)
				$("#addModal2 input[type='radio'][name='sesak_mayor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='sesak_mayor'][value='0']").prop("checked", true);
			if(dataItem.val.anosmia_mayor != 0)
				$("#addModal2 input[type='radio'][name='anosmia_mayor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='anosmia_mayor'][value='0']").prop("checked", true);
			if(dataItem.val.ageusia_mayor != 0)
				$("#addModal2 input[type='radio'][name='ageusia_mayor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='ageusia_mayor'][value='0']").prop("checked", true);


			if(dataItem.val.nyeri_otot_minor != 0)
				$("#addModal2 input[type='radio'][name='nyeri_otot_minor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='nyeri_otot_minor'][value='0']").prop("checked", true);
			if(dataItem.val.nyeri_kepala_minor != 0)
				$("#addModal2 input[type='radio'][name='nyeri_kepala_minor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='nyeri_kepala_minor'][value='0']").prop("checked", true);
			if(dataItem.val.diare_minor != 0)
				$("#addModal2 input[type='radio'][name='diare_minor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='diare_minor'][value='0']").prop("checked", true);
			if(dataItem.val.mual_minor != 0)
				$("#addModal2 input[type='radio'][name='mual_minor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='mual_minor'][value='0']").prop("checked", true);
			if(dataItem.val.pilek_minor != 0)
				$("#addModal2 input[type='radio'][name='pilek_minor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='pilek_minor'][value='0']").prop("checked", true);
			if(dataItem.val.panas_dingin_minor != 0)
				$("#addModal2 input[type='radio'][name='panas_dingin_minor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='panas_dingin_minor'][value='0']").prop("checked", true);
			if(dataItem.val.kelelahan_minor != 0)
				$("#addModal2 input[type='radio'][name='kelelahan_minor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='kelelahan_minor'][value='0']").prop("checked", true);
			if(dataItem.val.bingung_minor != 0)
				$("#addModal2 input[type='radio'][name='bingung_minor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='bingung_minor'][value='0']").prop("checked", true);
			if(dataItem.val.nyeri_dada_minor != 0)
				$("#addModal2 input[type='radio'][name='nyeri_dada_minor'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='nyeri_dada_minor'][value='0']").prop("checked", true);
				

			if(dataItem.val.kontak_erat_epidemiologis != 0)
				$("#addModal2 input[type='radio'][name='kontak_erat_epidemiologis'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='kontak_erat_epidemiologis'][value='0']").prop("checked", true);
			if(dataItem.val.kasus_endemik_epidemiologis != 0)
				$("#addModal2 input[type='radio'][name='kasus_endemik_epidemiologis'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='kasus_endemik_epidemiologis'][value='0']").prop("checked", true);
			if(dataItem.val.daerah_episentrum_epidemiologis != 0)
				$("#addModal2 input[type='radio'][name='daerah_episentrum_epidemiologis'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='daerah_episentrum_epidemiologis'][value='0']").prop("checked", true);


			if(dataItem.val.hasil_lab_pcr_positif == 1)
				$("#addModal2 input[type='radio'][name='hasil_lab_pcr_positif'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='hasil_lab_pcr_positif'][value='0']").prop("checked", true);
			if(dataItem.val.hasil_lab_antigen_positif == 1)
				$("#addModal2 input[type='radio'][name='hasil_lab_antigen_positif'][value='1']").prop("checked", true);
			else
				$("#addModal2 input[type='radio'][name='hasil_lab_antigen_positif'][value='0']").prop("checked", true);


			$('#idCovid2').val(dataItem.id)
			$('#addModal2').modal('toggle');
		});
	});

	$('.covid-lab').on('change', function(){
		if($(this).val()==1){
			$('#if-covid-lab-show').show();
		}else{
			$('#if-covid-lab-show').hide();
			$('.lab[value="0"]').prop("checked",true);
		}
	})

	$('.swab').on('change', function(){
		if($(this).val()==1){
			$('#swab-ya').show();
		}else{
			$('#swab-ya').hide();
			$('.hasil_swab[value="0"]').prop("checked",true);
		}
	})

	$('.rapid-test').on('change', function(){
		if($(this).val()==1){
			$('#rapid-test-ya').show();
		}else{
			$('#rapid-test-ya').hide();
			$('.hasil_rapid_test[value="0"]').prop("checked",true);
		}
	})

	$('.covid-radio').on('change', function(){
		if($(this).val()==1){
			$('#if-covid-radio-show').show();
		}else{
			$('#if-covid-radio-show').hide();
			$('.radio[value="0"]').prop("checked",true);
		}
	})

	$('.travel-negara').on('change', function(){
		if($(this).val()==1){
			$('#if-travel-negara-show').show();
		}else{
			$('#if-travel-negara-show').hide();
			$('#select-negara').val(null).trigger('change');
		}
	})
	$('.travel-daerah').on('change', function(){
		if($(this).val()==1){
			$('#if-travel-daerah-show').show();
			$('#select-daerah').val('Surabaya').trigger('change');
		}else{
			$('#if-travel-daerah-show').hide();
			$('#select-daerah').val(null).trigger('change');
		}
	})

	$('.is_penyebab_klinis_lain').on('change', function(){
		if($(this).val()==1){
			$('#alasan-wrap').show();
		}else{
			$('#alasan-wrap').hide();
			$('#alasan-input').val("")
		}
	})
	
</script>
@endsection