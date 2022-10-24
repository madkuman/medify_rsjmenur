@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Persalinan - Kasus
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
						<button type="button" class="btn-alt btn-rounded btn-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Persalinan Baru</button>
						@endif
						<h4 class="mb-30 pt-10">Asesmen Persalinan</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($persalinan as $item)
						<div class="row mb-10">
							<div class="col-6">
								<h5 class="mb-5 pl-5">#Persalinan {{$count++}}</h5>
							</div>
							<div class="col-6">
								@if(session('my_role_'.$kasus->nomor_kasus))
									<button  class="btn btn-secondary ml-5 pull-right btn-add-bayi" data-parentid="{{$item->id}}">
										<i class="fa fa-plus"></i> Tambah Asesmen Bayi
									</button>

									<div class="btn-group pull-right" role="group">
										<button type="button" class="btn btn-secondary dropdown-toggle " id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-ellipsis-v"></i> Menu
										</button>
										<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
											<a  href="javascript:void(0)" class="dropdown-item editBtn" data-id="{{$item->id}}" data-val="{{$item->val}}">
												<i class="fa fa-pencil"></i> Edit
											</a>
											<a href="javascript:void(0)" class="dropdown-item deleteBtn" data-id="{{$item->id}}">
												<i class="fa fa-trash"></i> Hapus
											</a>
										</div>
									</div>
								@endif
							</div>
						</div>
						@php $res = json_decode($item->val) @endphp
						@include('kasus.alatbantu.persalinan.detail-persalinan')
						@foreach($item->children as $bayi)
						<hr>
						@php $bayi_data = json_decode($bayi->val) @endphp
						@include('kasus.alatbantu.persalinan.detail-bayi')
						@endforeach

						<hr>
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Persalinan tersedia</h4>
							<p>Klik tombol <b>Persalinan Baru</b> untuk melakukan asesmen Persalinan</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/persalinan/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.persalinan.add')
@include('kasus.alatbantu.persalinan.add-bayi')
<!-- END Main Container -->    
@endsection

@section('js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
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

		$('.time').mask('00:00');

		cekKematian();

		$("#inisiasi_menyusui_dini").change(function(){
			cekIMD();
		}); 

		$("#add_macam_persalinan").change(function(){
			cekMacamPersalinan();
		}); 

		$("#addModal select[name=maternal]").change(function(){
			cekKematian();
		}); 

		$("#addModal select[name=masa_kematian]").change(function(){
			cekMasaKematian();
		}); 

		$(document).on( "change", "#add_macam_sc", function() {
			cekMacamSC();	
		});

	$('.btn-add-bayi').click(function(e){
		id = $(this).data('id');
		var data = $(this).data('val');
		var parent_id = $(this).data('parentid');
		$("input[name=parent_id]").val(parent_id);
		if(data != "" && data != undefined){
			$("#addModalBayi input[name=persalinan_bayi_id]").val(id)
			$("#addModalBayi select[name=jenis_kelamin]").val(data.jenis_kelamin).change();
			$("#addModalBayi select[name=lahir_hidup_mati]").val(data.lahir_hidup_mati).change();
			$("#addModalBayi input[name=berat_badan]").val(data.berat_badan);
			$("#addModalBayi input[name=anak_ke]").val(data.anak_ke);
			$("#addModalBayi input[name=panjang_badan]").val(data.panjang_badan);
			$("#addModalBayi input[name=lingkar_dada]").val(data.lingkar_dada);
			$("#addModalBayi input[name=lingkar_kepala]").val(data.lingkar_kepala);
			$("#addModalBayi input[name=lingkar_lengan_atas]").val(data.lingkar_lengan_atas);
			$("#addModalBayi input[name=kelainan_kongeninal]").val(data.kelainan_kongeninal);
			$("#addModalBayi input[name=kemudian_meninggal]").val(data.kemudian_meninggal);
			$("#addModalBayi input[name=partumBayi]").val(data.partumBayi);
			$("#addModalBayi select[name=score_denyut_1]").val(data.score_denyut_1).change();
			$("#addModalBayi select[name=score_denyut_5]").val(data.score_denyut_5).change();
			$("#addModalBayi select[name=score_denyut_10]").val(data.score_denyut_10).change();
			$("#addModalBayi select[name=score_pernafasan_1]").val(data.score_pernafasan_1).change();
			$("#addModalBayi select[name=score_pernafasan_5]").val(data.score_pernafasan_5).change();
			$("#addModalBayi select[name=score_pernafasan_10]").val(data.score_pernafasan_10).change();
			$("#addModalBayi select[name=score_tonus_1]").val(data.score_tonus_1).change();
			$("#addModalBayi select[name=score_tonus_5]").val(data.score_tonus_5).change();
			$("#addModalBayi select[name=score_tonus_10]").val(data.score_tonus_10).change();
			$("#addModalBayi select[name=score_peka_1]").val(data.score_peka_1).change();
			$("#addModalBayi select[name=score_peka_5]").val(data.score_peka_5).change();
			$("#addModalBayi select[name=score_peka_10]").val(data.score_peka_10).change();
			$("#addModalBayi select[name=score_warna_1]").val(data.score_warna_1).change();
			$("#addModalBayi select[name=score_warna_5]").val(data.score_warna_5).change();
			$("#addModalBayi select[name=score_warna_10]").val(data.score_warna_10).change();
			$("#addModalBayi input[name=muka_mulut_awal]").val(data.muka_mulut_awal);
			$("#addModalBayi input[name=muka_mulut_akhir]").val(data.muka_mulut_akhir);
			$("#addModalBayi input[name=muka_mulut_sesudah]").val(data.muka_mulut_sesudah);
			$("#addModalBayi input[name=pompa_udara_awal]").val(data.pompa_udara_awal);
			$("#addModalBayi input[name=pompa_udara_akhir]").val(data.pompa_udara_akhir);
			$("#addModalBayi input[name=pompa_udara_sesudah]").val(data.pompa_udara_sesudah);
			$("#addModalBayi input[name=intubatik_awal]").val(data.intubatik_awal);
			$("#addModalBayi input[name=intubatik_akhir]").val(data.intubatik_akhir);
			$("#addModalBayi input[name=intubatik_sesudah]").val(data.intubatik_sesudah);
		}
		else
		{
			$("#addModalBayi input[name=persalinan_bayi_id]").val(0)
			$("#addModalBayi select[name=jenis_kelamin]").val('L').change();
			$("#addModalBayi select[name=lahir_hidup_mati]").val('Hidup').change();
			$("#addModalBayi input[name=berat_badan]").val('');
			$("#addModalBayi input[name=anak_ke]").val('');
			$("#addModalBayi input[name=panjang_badan]").val('');
			$("#addModalBayi input[name=lingkar_dada]").val('');
			$("#addModalBayi input[name=lingkar_kepala]").val('');
			$("#addModalBayi input[name=lingkar_lengan_atas]").val('');
			$("#addModalBayi input[name=kelainan_kongeninal]").val('');
			$("#addModalBayi input[name=kemudian_meninggal]").val('');
			$("#addModalBayi input[name=partumBayi]").val('');
			$("#addModalBayi select[name=score_denyut_1]").val('2').change();
			$("#addModalBayi select[name=score_denyut_5]").val('2').change();
			$("#addModalBayi select[name=score_denyut_10]").val('2').change();
			$("#addModalBayi select[name=score_pernafasan_1]").val('2').change();
			$("#addModalBayi select[name=score_pernafasan_5]").val('2').change();
			$("#addModalBayi select[name=score_pernafasan_10]").val('2').change();
			$("#addModalBayi select[name=score_tonus_1]").val('2').change();
			$("#addModalBayi select[name=score_tonus_5]").val('2').change();
			$("#addModalBayi select[name=score_tonus_10]").val('2').change();
			$("#addModalBayi select[name=score_peka_1]").val('2').change();
			$("#addModalBayi select[name=score_peka_5]").val('2').change();
			$("#addModalBayi select[name=score_peka_10]").val('2').change();
			$("#addModalBayi select[name=score_warna_1]").val('2').change();
			$("#addModalBayi select[name=score_warna_5]").val('2').change();
			$("#addModalBayi select[name=score_warna_10]").val('2').change();
			$("#addModalBayi input[name=muka_mulut_awal]").val('');
			$("#addModalBayi input[name=muka_mulut_akhir]").val('');
			$("#addModalBayi input[name=muka_mulut_sesudah]").val('');
			$("#addModalBayi input[name=pompa_udara_awal]").val('');
			$("#addModalBayi input[name=pompa_udara_akhir]").val('');
			$("#addModalBayi input[name=pompa_udara_sesudah]").val('');
			$("#addModalBayi input[name=intubatik_awal]").val('');
			$("#addModalBayi input[name=intubatik_akhir]").val('');
			$("#addModalBayi input[name=intubatik_sesudah]").val('');
		}
		$('#addModalBayi').modal('toggle');

	});

	$(".editBtn").click(function(e){
		id = $(this).data('id');
		var data = $(this).data('val');
		if(data != "" && data != undefined){
			$("#id").val(id);
			$("#addModal select[name=maternal]").val(data.maternal).change();
			$("#addModal input[name=usia_kehamilan]").val(data.usia_kehamilan);
			$("#addModal input[name=nama_suami]").val(data.nama_suami);
			$("#addModal select[name=sebab_kematian]").val(data.sebab_kematian).change();
			$("#addModal input[name=keterangan_sebab_kematian]").val(data.keterangan_sebab_kematian);
			$("#addModal input[name=kematian_tanggal]").val(data.kematian_tanggal);
			$("#addModal input[name=kematian_jam]").val(data.kematian_jam);
			$("#addModal select[name=masa_kematian]").val(data.masa_kematian).change();
			$("#addModal input[name=kematian_nifas]").val(data.kematian_nifas);
			$("#addModal input[name=gpa_gravida]").val(data.gpa_gravida);
			$("#addModal input[name=gpa_para]").val(data.gpa_para);
			$("#addModal input[name=gpa_abortus]").val(data.gpa_abortus);
			$("input[name=keadaan_umum]").val(data.keadaan_umum);
			$("input[name=umum_nadi]").val(data.umum_nadi);
			$("input[name=tekanan_darah]").val(data.tekanan_darah);
			$("input[name=suhu_badan]").val(data.suhu_badan);
			$("input[name=hb]").val(data.hb);
			$("input[name=uterus]").val(data.uterus);
			$("input[name=kala_iii]").val(data.kala_iii);
			$("input[name=kala_iv]").val(data.kala_iv);
			$("input[name=keadaan_ibu]").val(data.keadaan_ibu);
			$("input[name=anamnesa]").val(data.anamnesa);
			$("input[name=tensi]").val(data.tensi);
			$("input[name=nadi]").val(data.nadi);
			$("input[name=tinggi_fundus_uteri]").val(data.tinggi_fundus_uteri);
			$("input[name=kontradiksi]").val(data.kontradiksi);
			$("#inisiasi_menyusui_dini").val(data.inisiasi_menyusui_dini);
			cekIMD();
			$("#alasan_tidak_imd").html(data.alasan_tidak_imd);
			$("input[name=placenta_bentuk_ukuran]").val(data.placenta_bentuk_ukuran);
			$("input[name=perkiraan_jalan_lahir]").val(data.perkiraan_jalan_lahir);
			$("input[name=tali_pusat]").val(data.tali_pusat);
			$("select[name=luka_perinium]").val(data.luka_perinium).change();
			$("input[name=kulit_ketuban]").val(data.kulit_ketuban);
			$("select[name=epitomi]").val(data.epitomi).change();
			$("input[name=ruptunal_perinei]").val(data.ruptunal_perinei);
			$("input[name=jenis_kelamin]").val(data.jenis_kelamin);
			$("input[name=lahir_hidup_mati]").val(data.lahir_hidup_mati);
			$("input[name=berat_badan]").val(data.berat_badan);
			$("input[name=panjang_badan]").val(data.panjang_badan);
			$("input[name=lingkar_dada]").val(data.lingkar_dada);
			$("input[name=lingkar_kepala]").val(data.lingkar_kepala);
			$("input[name=lingkar_lengan_atas]").val(data.lingkar_lengan_atas);
			$("input[name=kelainan_kongeninal]").val(data.kelainan_kongeninal);
			$("input[name=kemudian_meninggal]").val(data.kemudian_meninggal);
			$("input[name=partumBayi]").val(data.partumBayi);
			$("input[name=score_denyut_1]").val(data.score_denyut_1);
			$("input[name=score_denyut_5]").val(data.score_denyut_5);
			$("input[name=score_denyut_10]").val(data.score_denyut_10);
			$("input[name=score_pernafasan_1]").val(data.score_pernafasan_1);
			$("input[name=score_pernafasan_5]").val(data.score_pernafasan_5);
			$("input[name=score_pernafasan_10]").val(data.score_pernafasan_10);
			$("input[name=score_tonus_1]").val(data.score_tonus_1);
			$("input[name=score_tonus_5]").val(data.score_tonus_5);
			$("input[name=score_tonus_10]").val(data.score_tonus_10);
			$("input[name=score_peka_1]").val(data.score_peka_1);
			$("input[name=score_peka_5]").val(data.score_peka_5);
			$("input[name=score_peka_10]").val(data.score_peka_10);
			$("input[name=score_warna_1]").val(data.score_warna_1);
			$("input[name=score_warna_5]").val(data.score_warna_5);
			$("input[name=score_warna_10]").val(data.score_warna_10);
			$("input[name=muka_mulut_awal]").val(data.muka_mulut_awal);
			$("input[name=muka_mulut_akhir]").val(data.muka_mulut_akhir);
			$("input[name=muka_mulut_sesudah]").val(data.muka_mulut_sesudah);
			$("input[name=pompa_udara_awal]").val(data.pompa_udara_awal);
			$("input[name=pompa_udara_akhir]").val(data.pompa_udara_akhir);
			$("input[name=pompa_udara_sesudah]").val(data.pompa_udara_sesudah);
			$("input[name=intubatik_awal]").val(data.intubatik_awal);
			$("input[name=intubatik_akhir]").val(data.intubatik_akhir);
			$("input[name=intubatik_sesudah]").val(data.intubatik_sesudah);
			$("input[name=tgl_kk_pecah]").val(data.tgl_kk_pecah);
			$("input[name=jam_kk_pecah]").val(data.jam_kk_pecah);
			$("input[name=lahir_kk_pecah]").val(data.lahir_kk_pecah);
			$("input[name=jam_lahir_kk_pecah]").val(data.jam_lahir_kk_pecah);
			$("#add_macam_persalinan").val(data.macam_persalinan);
			cekMacamPersalinan();

			$("#add_macam_sc").val(data.macam_sc);
			cekMacamSC();
			$("#jam_diputuskanSC").val(data.jam_diputuskanSC);
			$("#jam_dilaksanakanSC").val(data.jam_dilaksanakanSC);

			$("input[name=indikasi]").val(data.indikasi);
			$("input[name=jam_indikasi]").val(data.jam_indikasi);
			$("input[name=lama_persalinan_kala_i]").val(data.lama_persalinan_kala_i);
			$("input[name=lama_persalinan_kala_ii]").val(data.lama_persalinan_kala_ii);
			$("input[name=lama_persalinan_kala_iii]").val(data.lama_persalinan_kala_iii);
			$("input[name=lama_persalinan_kala_iv]").val(data.lama_persalinan_kala_iv);
			$("input[name=lama_persalinan_total]").val(data.lama_persalinan_total);
			$("input[name=lain_lain]").val(data.lain_lain);
			
		}else{	
			$("#id").val(0);
			$("#addModal select[name=maternal]").val('').change();
			$("#addModal input[name=usia_kehamilan]").val('');
			$("#addModal input[name=nama_suami]").val('');
			$("#addModal select[name=sebab_kematian]").val('').change();
			$("#addModal input[name=keterangan_sebab_kematian]").val('');
			$("#addModal input[name=kematian_tanggal]").val('');
			$("#addModal input[name=kematian_jam]").val('');
			$("#addModal select[name=masa_kematian]").val('').change();
			$("#addModal input[name=kematian_nifas]").val('');
			$("#addModal input[name=gpa_gravida]").val('');
			$("#addModal input[name=gpa_para]").val('');
			$("#addModal input[name=gpa_abortus]").val('	');
			$("#addModal input[name=keadaan_umum]").val('');
			$("#addModal input[name=umum_nadi]").val('');
			$("#addModal input[name=tekanan_darah]").val('');
			$("#addModal input[name=suhu_badan]").val('');
			$("#addModal input[name=hb]").val('');
			$("#addModal input[name=uterus]").val('');
			$("#addModal input[name=kala_iii]").val('');
			$("#addModal input[name=kala_iv]").val('');
			$("#addModal input[name=keadaan_ibu]").val('');
			$("#addModal input[name=anamnesa]").val('');
			$("#addModal input[name=tensi]").val('');
			$("#addModal input[name=nadi]").val('');
			$("#addModal input[name=tinggi_fundus_uteri]").val('');
			$("#addModal input[name=kontradiksi]").val('');
			$("#addModal input[name=placenta_bentuk_ukuran]").val('');
			$("#addModal input[name=perkiraan_jalan_lahir]").val('');
			$("#addModal input[name=tali_pusat]").val('');
			$("#addModal select[name=luka_perinium]").val('').change();
			$("#addModal input[name=kulit_ketuban]").val('');
			$("#addModal select[name=epitomi]").val('').change();
			$("#addModal input[name=ruptunal_perinei]").val('');
			$("#addModal input[name=tgl_kk_pecah]").val('');
			$("#addModal input[name=jam_kk_pecah]").val('');
			$("#addModal input[name=lahir_kk_pecah]").val('');
			$("#addModal input[name=jam_lahir_kk_pecah]").val('');
			$("#addModal select[name=macam_persalinan]").val('').change();
			$("#addModal select[name=jenis_persalinan]").val('').change();
			$("#addModal input[name=indikasi]").val('');
			$("#addModal input[name=jam_indikasi]").val('');
			$("#addModal input[name=lama_persalinan_kala_i]").val('');
			$("#addModal input[name=lama_persalinan_kala_ii]").val('');
			$("#addModal input[name=lama_persalinan_kala_iii]").val('');
			$("#addModal input[name=lama_persalinan_kala_iv]").val('');
			$("#addModal input[name=lama_persalinan_total]").val('');
			$("#addModal input[name=lain_lain]").val('');

			$("#jam_indikasi").parent().parent().show();
		}

		$('#addModal').modal('toggle');
	});

	function cekIMD() {
		var inisiasi_menyusui_dini = $('#inisiasi_menyusui_dini').val();

		$("#alasan_tidak_imd")
			.parent()
			.parent()
			.remove();

		if(inisiasi_menyusui_dini == "Tidak"){
			$("#inisiasi_menyusui_dini")
			.parent()
			.parent()
			.after('<div class="form-group row mb-5">'+
						'<label class="col-12" for="alasan_tidak_imd">Alasan</label>'+
						'<div class="col-12">'+
							'<textarea class="form-control" row="3" name="alasan_tidak_imd" id="alasan_tidak_imd"></textarea>'+
						'</div>'+
					'</div>');		
		}	
	}

	function cekMacamPersalinan() {
		var macam_persalinan = $('#add_macam_persalinan').val();
		
		$("#add_macam_sc")
			.parent()
			.parent()
			.remove();

		if(macam_persalinan == "SC"){
			$("#add_macam_persalinan")
			.parent()
			.parent()
			.after('<div class="form-group row mb-5">'+
						'<label class="col-12" for="add_macam_sc">Macam SC</label>'+
						'<div class="col-12">'+
							'<select name="macam_sc" id="add_macam_sc" class="form-control js-select2"  style="width: 100%" data-placeholder="Macam SC">'+
								'<option></option>'+
								'<option value="Cito">Cito</option>'+
								'<option value="Elektif">Elektif</option>'+
							'</select>'+
						'</div>'+
					'</div>');			
		}
	}	

	function cekMacamSC() {
		var macam_sc = $('#add_macam_sc').val();
		
		$("#jam_diputuskanSC")
		.parent()
		.parent()
		.remove();

		$("#jam_dilaksanakanSC")
		.parent()
		.parent()
		.remove();

		$("#jam_indikasi")
		.parent()
		.parent()
		.show();

		if(macam_sc == "Cito"){
			$("#add_macam_sc")
			.parent()
			.parent()
			.after('<div class="form-group row mb-5">'+
						'<label class="col-12" for="jam_diputuskanSC">Jam Diputuskan</label>'+
						'<div class="col-12">'+
							'<input type="text" name="jam_diputuskanSC" id="jam_diputuskanSC" class="form-control time" placeholder="hh:mm">'+
						'</div>'+
					'</div>'+
					'<div class="form-group row mb-5">'+
						'<label class="col-12" for="jam_dilaksanakanSC">Jam Dilaksanakan</label>'+
						'<div class="col-12">'+
							'<input type="text" name="jam_dilaksanakanSC" id="jam_dilaksanakanSC" class="form-control time" placeholder="hh:mm">'+
						'</div>'+
					'</div>');

			$("#jam_indikasi")
			.parent()
			.parent()
			.hide()

			$('.time').mask('00:00');		
		}
	}

	function cekKematian()
	{
		var maternal_status = $("#addModal select[name=maternal]").val()
		if(maternal_status == "Mati")
		{
			$('.sebab-kematian-container').show();
			$('.keterangan-sebab-kematian-container').show();
			$('.waktu-kematian-container').show();
			$('.masa-kematian-container').show();
		}
		else
		{
			$('.sebab-kematian-container').hide();
			$('.keterangan-sebab-kematian-container').hide();
			$('.waktu-kematian-container').hide();
			$('.masa-kematian-nifas-container').hide();
			$('.masa-kematian-container').hide();

			$("#addModal select[name=sebab_kematian]").val('').change();
			$("#addModal input[name=keterangan_sebab_kematian]").val('');
			$("#addModal input[name=kematian_tanggal]").val('');
			$("#addModal input[name=kematian_jam]").val('');
			$("#addModal select[name=masa_kematian]").val('');
			$("#addModal input[name=kematian_nifas]").val('');
		}
	}

	function cekMasaKematian()
	{
		var item = $("#addModal select[name=masa_kematian]").val()
		if(item == "Nifas")
		{
			$('.masa-kematian-nifas-container').show();
		}
		else
		{
			$('.masa-kematian-nifas-container').hide();
			$("#addModal input[name=kematian_nifas]").val('');
		}
	}
});
</script>
@endsection