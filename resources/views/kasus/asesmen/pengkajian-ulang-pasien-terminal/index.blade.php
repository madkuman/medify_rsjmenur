@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Pengkajian Ulang Pasien Terminal - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Pengkajian Ulang Pasien Terminal Baru</button>
						@endif
						<h4>Pengkajian Ulang Pasien Terminal</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($pengkajian_ulang_pasien_terminal as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Pengkajian Ulang Pasien Terminal {{$count++}}</h5>
						<div class="row" id="">
							@include("kasus.asesmen.pengkajian-ulang-pasien-terminal.hasil")
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Pengkajian Ulang Pasien Terminal tersedia</h4>
							<p>Klik tombol <b>Pengkajian Ulang Pasien Terminal Baru</b> untuk melakukan asesmen Pengkajian Ulang Pasien Terminal</p>
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
@include("kasus.asesmen.pengkajian-ulang-pasien-terminal.modal")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $pengkajian_ulang_pasien_terminal))!!});

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
			
			$(`:text[name="pengkajian_fisik"]`).val(item.pengkajian_fisik);
			$(`:text[name="ku"]`).val(item.ku);
			$(`:text[name="observasi_ttv"]`).val(item.observasi_ttv);
			$(`:text[name="td"]`).val(item.td);
			$(`:text[name="sn"]`).val(item.sn);
			$(`:text[name="rr"]`).val(item.rr);
			$(`:text[name="gcs"]`).val(item.gcs);
			$(`:text[name="penilaian_nyeri"]`).val(item.penilaian_nyeri);
			$(`:text[name="skala_nyeri"]`).val(item.skala_nyeri);
			$(`:text[name="karakteristik"]`).val(item.karakteristik);
			$(`:text[name="lokasi"]`).val(item.lokasi);
			$(`:text[name="durasi"]`).val(item.durasi);
			$(`:text[name="frekuensi"]`).val(item.frekuensi);
			$(`:checkbox[name="alat_bantu_yang_dipakai_ventilator"]`).prop("checked", item.alat_bantu_yang_dipakai_ventilator != null);
			$(`:checkbox[name="alat_bantu_yang_dipakai_oksigen"]`).prop("checked", item.alat_bantu_yang_dipakai_oksigen != null);
			$(`:checkbox[name="alat_bantu_yang_dipakai_monitor"]`).prop("checked", item.alat_bantu_yang_dipakai_monitor != null);
			$(`:checkbox[name="alat_bantu_yang_dipakai_tanpa_alat_bantu"]`).prop("checked", item.alat_bantu_yang_dipakai_tanpa_alat_bantu != null);
			$(`:text[name="alat_bantu_lainnya"]`).val(item.alat_bantu_lainnya);
			$(`:checkbox[name="tonus_otot_relaksasi_otot_muka"]`).prop("checked", item.tonus_otot_relaksasi_otot_muka != null);
			$(`:checkbox[name="tonus_otot_kesulitan_dalam_berbicara"]`).prop("checked", item.tonus_otot_kesulitan_dalam_berbicara != null);
			$(`:checkbox[name="tonus_otot_penurunan_kegiatan_traktus"]`).prop("checked", item.tonus_otot_penurunan_kegiatan_traktus != null);
			$(`:checkbox[name="tonus_otot_penurunan_control"]`).prop("checked", item.tonus_otot_penurunan_control != null);
			$(`:checkbox[name="tonus_otot_gerakan_tubuh_terbatas"]`).prop("checked", item.tonus_otot_gerakan_tubuh_terbatas != null);
			$(`:text[name="tanda_kehilangan_tonus_otot_lainnya"]`).val(item.tanda_kehilangan_tonus_otot_lainnya);
			$(`:checkbox[name="kelambatan_dalam_sirkulasi_kemunduran_dalam_sensasi"]`).prop("checked", item.kelambatan_dalam_sirkulasi_kemunduran_dalam_sensasi != null);
			$(`:checkbox[name="kelambatan_dalam_sirkulasi_cyanosis"]`).prop("checked", item.kelambatan_dalam_sirkulasi_cyanosis != null);
			$(`:checkbox[name="kelambatan_dalam_sirkulasi_kulit_dingin"]`).prop("checked", item.kelambatan_dalam_sirkulasi_kulit_dingin != null);
			$(`:text[name="tanda_kelambatan_dalam_sirkulasi_lainnya"]`).val(item.tanda_kelambatan_dalam_sirkulasi_lainnya);
			$(`:checkbox[name="perubahan_ttv_nadi_lambat_dan_lemah"]`).prop("checked", item.perubahan_ttv_nadi_lambat_dan_lemah != null);
			$(`:checkbox[name="perubahan_ttv_tekanan_darah_turun"]`).prop("checked", item.perubahan_ttv_tekanan_darah_turun != null);
			$(`:checkbox[name="perubahan_ttv_pernafasan_cepat"]`).prop("checked", item.perubahan_ttv_pernafasan_cepat != null);
			$(`:text[name="perubahan_perubahan_dalam_tanda_tanda_vital_lainnya"]`).val(item.perubahan_perubahan_dalam_tanda_tanda_vital_lainnya);
			$(`:checkbox[name="gangguan_sensoria_penglihatan_kabur"]`).prop("checked", item.gangguan_sensoria_penglihatan_kabur != null);
			$(`:checkbox[name="gangguan_sensoria_gangguan_penciuman_dan_perabaan"]`).prop("checked", item.gangguan_sensoria_gangguan_penciuman_dan_perabaan != null);
			$(`:text[name="gangguan_sensoria_lainnya"]`).val(item.gangguan_sensoria_lainnya);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_sirkulasi_melambat"]`).prop("checked", item.perubahan_fisik_saat_menjelang_kematian_sirkulasi_melambat != null);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_tonus_otot_menurun"]`).prop("checked", item.perubahan_fisik_saat_menjelang_kematian_tonus_otot_menurun != null);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_perubahan_ttv"]`).prop("checked", item.perubahan_fisik_saat_menjelang_kematian_perubahan_ttv != null);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_berkemih_dan_defekasi"]`).prop("checked", item.perubahan_fisik_saat_menjelang_kematian_berkemih_dan_defekasi != null);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_pasien_kurang_responsive"]`).prop("checked", item.perubahan_fisik_saat_menjelang_kematian_pasien_kurang_responsive != null);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_kulit_memucat"]`).prop("checked", item.perubahan_fisik_saat_menjelang_kematian_kulit_memucat != null);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_pendengaran_terakhir"]`).prop("checked", item.perubahan_fisik_saat_menjelang_kematian_pendengaran_terakhir != null);
			$(`:text[name="perubahan_fisik_saat_menjelang_kematian_lainnya"]`).val(item.perubahan_fisik_saat_menjelang_kematian_lainnya);
			$(`:checkbox[name="petunjuk_indikasi_kematian_tidak_ada_respon_terhadap_rangsangan"]`).prop("checked", item.petunjuk_indikasi_kematian_tidak_ada_respon_terhadap_rangsangan != null);
			$(`:checkbox[name="petunjuk_indikasi_kematian_tidak_adanya_gerak_dari_otot"]`).prop("checked", item.petunjuk_indikasi_kematian_tidak_adanya_gerak_dari_otot != null);
			$(`:checkbox[name="petunjuk_indikasi_kematian_tidak_ada_reflek"]`).prop("checked", item.petunjuk_indikasi_kematian_tidak_ada_reflek != null);
			$(`:checkbox[name="petunjuk_indikasi_kematian_gambaran_mendatar_pada_ekg"]`).prop("checked", item.petunjuk_indikasi_kematian_gambaran_mendatar_pada_ekg != null);
			$(`:text[name="petunjuk_tentang_indikasi_kematian_lainnya"]`).val(item.petunjuk_tentang_indikasi_kematian_lainnya);
			$(`:text[name="melibatkan_keluarga"]`).val(item.melibatkan_keluarga);
			$(`:text[name="kesukaan_pasien"]`).val(item.kesukaan_pasien);
			$(`:text[name="rencana_tempat_pemakaman"]`).val(item.rencana_tempat_pemakaman);
			$(`:text[name="transportasi_jenazah"]`).val(item.transportasi_jenazah);
			$(`:text[name="kebiasaan_pasien"]`).val(item.kebiasaan_pasien);
			$(`:text[name="perawatan_jenazah"]`).val(item.perawatan_jenazah);$(`textarea[name="informasi_dan_edukasi"]`).html(item.informasi_dan_edukasi);
			$(`:radio[name="pendampingan_rohaniawan"][value="${item.pendampingan_rohaniawan}"]`).prop("checked", true);
		}else{
			$("#id").val(0);
			
			$(`:text[name="pengkajian_fisik"]`).val("");
			$(`:text[name="ku"]`).val("");
			$(`:text[name="observasi_ttv"]`).val("");
			$(`:text[name="td"]`).val("");
			$(`:text[name="sn"]`).val("");
			$(`:text[name="rr"]`).val("");
			$(`:text[name="gcs"]`).val("");
			$(`:text[name="penilaian_nyeri"]`).val("");
			$(`:text[name="skala_nyeri"]`).val("");
			$(`:text[name="karakteristik"]`).val("");
			$(`:text[name="lokasi"]`).val("");
			$(`:text[name="durasi"]`).val("");
			$(`:text[name="frekuensi"]`).val("");
			$(`:checkbox[name="alat_bantu_yang_dipakai_ventilator"]`).prop("checked", false);
			$(`:checkbox[name="alat_bantu_yang_dipakai_oksigen"]`).prop("checked", false);
			$(`:checkbox[name="alat_bantu_yang_dipakai_monitor"]`).prop("checked", false);
			$(`:checkbox[name="alat_bantu_yang_dipakai_tanpa_alat_bantu"]`).prop("checked", false);
			$(`:text[name="alat_bantu_lainnya"]`).val("");
			$(`:text[name="tanda_–_tanda_klinis_menjelang_kematian"]`).val("");
			$(`:checkbox[name="tonus_otot_relaksasi_otot_muka"]`).prop("checked", false);
			$(`:checkbox[name="tonus_otot_kesulitan_dalam_berbicara"]`).prop("checked", false);
			$(`:checkbox[name="tonus_otot_penurunan_kegiatan_traktus"]`).prop("checked", false);
			$(`:checkbox[name="tonus_otot_penurunan_control"]`).prop("checked", false);
			$(`:checkbox[name="tonus_otot_gerakan_tubuh_terbatas"]`).prop("checked", false);
			$(`:text[name="tanda_kehilangan_tonus_otot_lainnya"]`).val("");
			$(`:checkbox[name="kelambatan_dalam_sirkulasi_kemunduran_dalam_sensasi"]`).prop("checked", false);
			$(`:checkbox[name="kelambatan_dalam_sirkulasi_cyanosis"]`).prop("checked", false);
			$(`:checkbox[name="kelambatan_dalam_sirkulasi_kulit_dingin"]`).prop("checked", false);
			$(`:text[name="tanda_kelambatan_dalam_sirkulasi_lainnya"]`).val("");
			$(`:checkbox[name="perubahan_ttv_nadi_lambat_dan_lemah"]`).prop("checked", false);
			$(`:checkbox[name="perubahan_ttv_tekanan_darah_turun"]`).prop("checked", false);
			$(`:checkbox[name="perubahan_ttv_pernafasan_cepat"]`).prop("checked", false);
			$(`:text[name="perubahan_perubahan_dalam_tanda_tanda_vital_lainnya"]`).val("");
			$(`:checkbox[name="gangguan_sensoria_penglihatan_kabur"]`).prop("checked", false);
			$(`:checkbox[name="gangguan_sensoria_gangguan_penciuman_dan_perabaan"]`).prop("checked", false);
			$(`:text[name="gangguan_sensoria_lainnya"]`).val("");
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_sirkulasi_melambat"]`).prop("checked", false);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_tonus_otot_menurun"]`).prop("checked", false);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_perubahan_ttv"]`).prop("checked", false);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_berkemih_dan_defekasi"]`).prop("checked", false);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_pasien_kurang_responsive"]`).prop("checked", false);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_kulit_memucat"]`).prop("checked", false);
			$(`:checkbox[name="perubahan_fisik_saat_menjelang_kematian_pendengaran_terakhir"]`).prop("checked", false);
			$(`:text[name="perubahan_fisik_saat_menjelang_kematian_lainnya"]`).val("");
			$(`:checkbox[name="petunjuk_indikasi_kematian_tidak_ada_respon_terhadap_rangsangan"]`).prop("checked", false);
			$(`:checkbox[name="petunjuk_indikasi_kematian_tidak_adanya_gerak_dari_otot"]`).prop("checked", false);
			$(`:checkbox[name="petunjuk_indikasi_kematian_tidak_ada_reflek"]`).prop("checked", false);
			$(`:checkbox[name="petunjuk_indikasi_kematian_gambaran_mendatar_pada_ekg"]`).prop("checked", false);
			$(`:text[name="petunjuk_tentang_indikasi_kematian_lainnya"]`).val("");
			$(`:text[name="melibatkan_keluarga"]`).val("");
			$(`:text[name="kesukaan_pasien"]`).val("");
			$(`:text[name="rencana_tempat_pemakaman"]`).val("");
			$(`:text[name="transportasi_jenazah"]`).val("");
			$(`:text[name="kebiasaan_pasien"]`).val("");
			$(`:text[name="perawatan_jenazah"]`).val("");$(`textarea[name="informasi_dan_edukasi"]`).html("");
			$(`:radio[name="pendampingan_rohaniawan"]`).prop("checked", false);
		}
		$("#addModal").modal("toggle");
	});
</script>
@endsection