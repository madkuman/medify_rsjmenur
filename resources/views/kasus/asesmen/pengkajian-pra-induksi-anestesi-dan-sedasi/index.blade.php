@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Pengkajian Pra Induksi Anestesi dan Sedasi - Kasus
@endsection

@section("content")

<!-- Main Container -->
<main id="main-container">
	@include("kasus.layouts.header")

	<div class="content">
		<div class="row">
			@include("kasus.layouts.sidebar")

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Pengkajian Pra Induksi Anestesi dan Sedasi Baru</button>
						@endif
						<h4>Pengkajian Pra Induksi Anestesi dan Sedasi</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($pengkajian_pra_induksi_anestesi_dan_sedasi as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Pengkajian Pra Induksi Anestesi dan Sedasi {{$count++}}</h5>
						<div class="row" id="">
							@include("kasus.asesmen.pengkajian-pra-induksi-anestesi-dan-sedasi.hasil")
						</div>
						@if(!empty($item->creator->avatar_thumb))
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
						</div>
						@else
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url("assets/img/placeholder.jpg")}}" alt="">
						</div>
						@endif
						<div class="creator">
							<h6 class="pt-10">
								<small class="text-muted">Dibuat Oleh</small><br>
								{{$item->creator->name}}<br>
								{{date("d F y, H:i", strtotime($item->created_at))}}
							</h6>
						</div>

						<hr class="my-20">
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Pengkajian Pra Induksi Anestesi dan Sedasi tersedia</h4>
							<p>Klik tombol <b>Pengkajian Pra Induksi Anestesi dan Sedasi Baru</b> untuk melakukan asesmen Pengkajian Pra Induksi Anestesi dan Sedasi</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include("kasus.asesmen.pengkajian-pra-induksi-anestesi-dan-sedasi.modal")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $pengkajian_pra_induksi_anestesi_dan_sedasi))!!});

	$(document).ready(function(){
		$(".time").mask("00:00");
	});

	$(".deleteBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$("#deleteInputId").val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: "warning",
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$("#formDelete").submit();
			}
		});
	});
	$(".editBtn").click(function(e){
		id = $(this).data("id");
		var item = data[$(this).data("index")];
		console.log(item);
		if(item != "" && item != undefined){
			$("#id").val(item.id);
			
			$(`:text[name="bb"]`).val(item.bb);
			$(`:text[name="tb"]`).val(item.tb);
			$(`:text[name="imt"]`).val(item.imt);
			$(`:text[name="diagnosis"]`).val(item.diagnosis);
			$(`:text[name="tindakan_bedah"]`).val(item.tindakan_bedah);
			$(`:text[name="subyektif"]`).val(item.subyektif);
			$(`:text[name="anamnesis"]`).val(item.anamnesis);
			$(`:radio[name="riwayat_asma"][value="${item.riwayat_asma}"]`).prop("checked", true);
			$(`:radio[name="alergi"][value="${item.alergi}"]`).prop("checked", true);
			$(`:radio[name="dm"][value="${item.dm}"]`).prop("checked", true);
			$(`:radio[name="hipertensi"][value="${item.hipertensi}"]`).prop("checked", true);
			$(`:text[name="riwayat_operasi"]`).val(item.riwayat_operasi);
			$(`:text[name="jenis_anestesi"]`).val(item.jenis_anestesi);
			$(`:text[name="komplikasi"]`).val(item.komplikasi);
			$(`:text[name="obyektif"]`).val(item.obyektif);
			$(`:text[name="pemeriksaan_fisik"]`).val(item.pemeriksaan_fisik);
			$(`:text[name="keadaan_umum"]`).val(item.keadaan_umum);
			$(`:text[name="ttv"]`).val(item.ttv);
			$(`:text[name="ttv_tensi"]`).val(item.ttv_tensi);
			$(`:text[name="ttv_n"]`).val(item.ttv_n);
			$(`:text[name="ttv_rr"]`).val(item.ttv_rr);
			$(`:text[name="ttv_t"]`).val(item.ttv_t);
			$(`:text[name="ttv_vas"]`).val(item.ttv_vas);
			$(`:text[name="kepala_leher"]`).val(item.kepala_leher);
			$(`:text[name="conjungtiva"]`).val(item.conjungtiva);
			$(`:text[name="gcs"]`).val(item.gcs);
			$(`:text[name="malampati"]`).val(item.malampati);
			$(`:text[name="thorax"]`).val(item.thorax);
			$(`:text[name="abdomen"]`).val(item.abdomen);
			$(`:text[name="ekstermitas"]`).val(item.ekstermitas);$(`textarea[name="laboratorium"]`).html(item.laboratorium);
			$(`:text[name="ekg"]`).val(item.ekg);
			$(`:text[name="ro_thorax"]`).val(item.ro_thorax);
			$(`:text[name="pemeriksaan_penunjang_lain"]`).val(item.pemeriksaan_penunjang_lain);
			$(`:text[name="assesment"]`).val(item.assesment);
			$(`:text[name="setuju_anestesi"]`).val(item.setuju_anestesi);
			$(`:text[name="premedikasi"]`).val(item.premedikasi);
			$(`:text[name="tidak_setuju_anestesi"]`).val(item.tidak_setuju_anestesi);
			$(`:text[name="asa_ps"]`).val(item.asa_ps);
			$(`:text[name="puasa"]`).val(item.puasa);
			$(`:text[name="rencana_tindakan"]`).val(item.rencana_tindakan);
			$(`:text[name="planning"]`).val(item.planning);
			$(`:text[name="teknik_anestesi_dan_sedasi"]`).val(item.teknik_anestesi_dan_sedasi);
			$(`:text[name="sedasi"]`).val(item.sedasi);
			$(`:text[name="ga"]`).val(item.ga);
			$(`:checkbox[name="regional_spinal"]`).prop("checked", item.regional_spinal != null);
			$(`:checkbox[name="regional_epidural"]`).prop("checked", item.regional_epidural != null);
			$(`:checkbox[name="regional_kaudal"]`).prop("checked", item.regional_kaudal != null);
			$(`:checkbox[name="regional_block_periver"]`).prop("checked", item.regional_block_periver != null);
			$(`:text[name="persediaan_darah"]`).val(item.persediaan_darah);
			$(`:checkbox[name="teknik_khusus_hipotensi"]`).prop("checked", item.teknik_khusus_hipotensi != null);
			$(`:checkbox[name="teknik_khusus_ventilasi_satu_paru"]`).prop("checked", item.teknik_khusus_ventilasi_satu_paru != null);
			$(`:checkbox[name="teknik_khusus_tci"]`).prop("checked", item.teknik_khusus_tci != null);
			$(`:text[name="teknik_khusus_lainnya"]`).val(item.teknik_khusus_lainnya);
			$(`:checkbox[name="monitoring_ekg_leed"]`).prop("checked", item.monitoring_ekg_leed != null);
			$(`:checkbox[name="monitoring_spo2"]`).prop("checked", item.monitoring_spo2 != null);
			$(`:checkbox[name="monitoring_nibp"]`).prop("checked", item.monitoring_nibp != null);
			$(`:checkbox[name="monitoring_temp"]`).prop("checked", item.monitoring_temp != null);
			$(`:checkbox[name="monitoring_cvp"]`).prop("checked", item.monitoring_cvp != null);
			$(`:checkbox[name="monitoring_arteleri_line"]`).prop("checked", item.monitoring_arteleri_line != null);
			$(`:checkbox[name="monitoring_etco2"]`).prop("checked", item.monitoring_etco2 != null);
			$(`:checkbox[name="monitoring_bis"]`).prop("checked", item.monitoring_bis != null);
			$(`:text[name="monitoring_lain_lain"]`).val(item.monitoring_lain_lain);
			$(`:checkbox[name="perawatan_pasca_anestesi_rawat_jalan"]`).prop("checked", item.perawatan_pasca_anestesi_rawat_jalan != null);
			$(`:checkbox[name="perawatan_pasca_anestesi_rawat_inap"]`).prop("checked", item.perawatan_pasca_anestesi_rawat_inap != null);
			$(`:checkbox[name="perawatan_pasca_anestesi_icu"]`).prop("checked", item.perawatan_pasca_anestesi_icu != null);
			$(`:checkbox[name="perawatan_pasca_anestesi_imcu"]`).prop("checked", item.perawatan_pasca_anestesi_imcu != null);
			$(`:checkbox[name="perawatan_pasca_anestesi_nicu"]`).prop("checked", item.perawatan_pasca_anestesi_nicu != null);
		}else{
			$("#id").val(0);
			
			$(`:text[name="bb"]`).val("");
			$(`:text[name="tb"]`).val("");
			$(`:text[name="imt"]`).val("");
			$(`:text[name="diagnosis"]`).val("");
			$(`:text[name="tindakan_bedah"]`).val("");
			$(`:text[name="subyektif"]`).val("");
			$(`:text[name="anamnesis"]`).val("");
			$(`:radio[name="riwayat_asma"]`).prop("checked", false);
			$(`:radio[name="alergi"]`).prop("checked", false);
			$(`:radio[name="dm"]`).prop("checked", false);
			$(`:radio[name="hipertensi"]`).prop("checked", false);
			$(`:text[name="riwayat_operasi"]`).val("");
			$(`:text[name="jenis_anestesi"]`).val("");
			$(`:text[name="komplikasi"]`).val("");
			$(`:text[name="obyektif"]`).val("");
			$(`:text[name="pemeriksaan_fisik"]`).val("");
			$(`:text[name="keadaan_umum"]`).val("");
			$(`:text[name="ttv"]`).val("");
			$(`:text[name="ttv_tensi"]`).val("");
			$(`:text[name="ttv_n"]`).val("");
			$(`:text[name="ttv_rr"]`).val("");
			$(`:text[name="ttv_t"]`).val("");
			$(`:text[name="ttv_vas"]`).val("");
			$(`:text[name="kepala_leher"]`).val("");
			$(`:text[name="conjungtiva"]`).val("");
			$(`:text[name="gcs"]`).val("");
			$(`:text[name="malampati"]`).val("");
			$(`:text[name="thorax"]`).val("");
			$(`:text[name="abdomen"]`).val("");
			$(`:text[name="ekstermitas"]`).val("");$(`textarea[name="laboratorium"]`).html("");
			$(`:text[name="ekg"]`).val("");
			$(`:text[name="ro_thorax"]`).val("");
			$(`:text[name="pemeriksaan_penunjang_lain"]`).val("");
			$(`:text[name="assesment"]`).val("");
			$(`:text[name="setuju_anestesi"]`).val("");
			$(`:text[name="premedikasi"]`).val("");
			$(`:text[name="tidak_setuju_anestesi"]`).val("");
			$(`:text[name="asa_ps"]`).val("");
			$(`:text[name="puasa"]`).val("");
			$(`:text[name="rencana_tindakan"]`).val("");
			$(`:text[name="planning"]`).val("");
			$(`:text[name="teknik_anestesi_dan_sedasi"]`).val("");
			$(`:text[name="sedasi"]`).val("");
			$(`:text[name="ga"]`).val("");
			$(`:checkbox[name="regional_spinal"]`).prop("checked", false);
			$(`:checkbox[name="regional_epidural"]`).prop("checked", false);
			$(`:checkbox[name="regional_kaudal"]`).prop("checked", false);
			$(`:checkbox[name="regional_block_periver"]`).prop("checked", false);
			$(`:text[name="persediaan_darah"]`).val("");
			$(`:checkbox[name="teknik_khusus_hipotensi"]`).prop("checked", false);
			$(`:checkbox[name="teknik_khusus_ventilasi_satu_paru"]`).prop("checked", false);
			$(`:checkbox[name="teknik_khusus_tci"]`).prop("checked", false);
			$(`:text[name="teknik_khusus_lainnya"]`).val("");
			$(`:checkbox[name="monitoring_ekg_leed"]`).prop("checked", false);
			$(`:checkbox[name="monitoring_spo2"]`).prop("checked", false);
			$(`:checkbox[name="monitoring_nibp"]`).prop("checked", false);
			$(`:checkbox[name="monitoring_temp"]`).prop("checked", false);
			$(`:checkbox[name="monitoring_cvp"]`).prop("checked", false);
			$(`:checkbox[name="monitoring_arteleri_line"]`).prop("checked", false);
			$(`:checkbox[name="monitoring_etco2"]`).prop("checked", false);
			$(`:checkbox[name="monitoring_bis"]`).prop("checked", false);
			$(`:text[name="monitoring_lain_lain"]`).val("");
			$(`:checkbox[name="perawatan_pasca_anestesi_rawat_jalan"]`).prop("checked", false);
			$(`:checkbox[name="perawatan_pasca_anestesi_rawat_inap"]`).prop("checked", false);
			$(`:checkbox[name="perawatan_pasca_anestesi_icu"]`).prop("checked", false);
			$(`:checkbox[name="perawatan_pasca_anestesi_imcu"]`).prop("checked", false);
			$(`:checkbox[name="perawatan_pasca_anestesi_nicu"]`).prop("checked", false);
		}
		$("#addModal").modal("toggle");
	});
</script>
@endsection