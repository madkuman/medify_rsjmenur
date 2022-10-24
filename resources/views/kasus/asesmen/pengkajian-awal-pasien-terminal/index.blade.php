@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Pengkajian Awal Pasien Terminal - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Pengkajian Awal Pasien Terminal Baru</button>
						@endif
						<h4>Pengkajian Awal Pasien Terminal</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($pengkajian_awal_pasien_terminal as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Pengkajian Awal Pasien Terminal {{$count++}}</h5>
						<div class="row" id="">
							@include("kasus.asesmen.pengkajian-awal-pasien-terminal.hasil")
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Pengkajian Awal Pasien Terminal tersedia</h4>
							<p>Klik tombol <b>Pengkajian Awal Pasien Terminal Baru</b> untuk melakukan asesmen Pengkajian Awal Pasien Terminal</p>
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
@include("kasus.asesmen.pengkajian-awal-pasien-terminal.modal")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $pengkajian_awal_pasien_terminal))!!});

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
			$(`:text[name="observerasi_ttv"]`).val(item.observerasi_ttv);
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
			$(`:text[name="pengkajian_psikologis"]`).val(item.pengkajian_psikologis);
			$(`:checkbox[name="kondisi_psikologis_denial"]`).prop("checked", item.kondisi_psikologis_denial != null);
			$(`:checkbox[name="kondisi_psikologis_sedih"]`).prop("checked", item.kondisi_psikologis_sedih != null);
			$(`:checkbox[name="kondisi_psikologis_depresi"]`).prop("checked", item.kondisi_psikologis_depresi != null);
			$(`:checkbox[name="kondisi_psikologis_marah"]`).prop("checked", item.kondisi_psikologis_marah != null);
			$(`:checkbox[name="kondisi_psikologis_rasa_ketergantungan"]`).prop("checked", item.kondisi_psikologis_rasa_ketergantungan != null);
			$(`:checkbox[name="kondisi_psikologis_kehilangan_harapan"]`).prop("checked", item.kondisi_psikologis_kehilangan_harapan != null);
			$(`:checkbox[name="kondisi_psikologis_menerima"]`).prop("checked", item.kondisi_psikologis_menerima != null);
			$(`:text[name="pengkajian_sosial"]`).val(item.pengkajian_sosial);
			$(`:checkbox[name="dukungan_apakah_ada_teman_dekat"]`).prop("checked", item.dukungan_apakah_ada_teman_dekat != null);
			$(`:checkbox[name="dukungan_apakah_ada_keluarga_yang_mendukung"]`).prop("checked", item.dukungan_apakah_ada_keluarga_yang_mendukung != null);
			$(`:checkbox[name="dukungan_tidak_ada_yang_mendukung"]`).prop("checked", item.dukungan_tidak_ada_yang_mendukung != null);
			$(`:text[name="pengkajian_spiritual"]`).val(item.pengkajian_spiritual);
			$(`:checkbox[name="kondisi_spiritual_taat_beribadah"]`).prop("checked", item.kondisi_spiritual_taat_beribadah != null);
			$(`:checkbox[name="kondisi_spiritual_kurang_taat_beribadah"]`).prop("checked", item.kondisi_spiritual_kurang_taat_beribadah != null);
			$(`:checkbox[name="kondisi_spiritual_membutuhkan_pelayanan__rohaniawan"]`).prop("checked", item.kondisi_spiritual_membutuhkan_pelayanan__rohaniawan != null);
			$(`:checkbox[name="kondisi_spiritual_menolak_pelayanan_rohaniawan"]`).prop("checked", item.kondisi_spiritual_menolak_pelayanan_rohaniawan != null);
			$(`:text[name="informasi_dan_edukasi"]`).val(item.informasi_dan_edukasi);$(`textarea[name="informasi_dan_edukasi"]`).html(item.informasi_dan_edukasi);
			$(`:text[name="alat_bantu_lainnya"]`).val(item.alat_bantu_lainnya);
			$(`:text[name="kondisi_psikologis_lainnya"]`).val(item.kondisi_psikologis_lainnya);
			$(`:text[name="dukungan_lainnya"]`).val(item.dukungan_lainnya);
			$(`:text[name="kondisi_spiritual_lainnya"]`).val(item.kondisi_spiritual_lainnya);
		}else{
			$("#id").val(0);
			
			$(`:text[name="pengkajian_fisik"]`).val("");
			$(`:text[name="ku"]`).val("");
			$(`:text[name="observerasi_ttv"]`).val("");
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
			$(`:text[name="pengkajian_psikologis"]`).val("");
			$(`:checkbox[name="kondisi_psikologis_denial"]`).prop("checked", false);
			$(`:checkbox[name="kondisi_psikologis_sedih"]`).prop("checked", false);
			$(`:checkbox[name="kondisi_psikologis_depresi"]`).prop("checked", false);
			$(`:checkbox[name="kondisi_psikologis_marah"]`).prop("checked", false);
			$(`:checkbox[name="kondisi_psikologis_rasa_ketergantungan"]`).prop("checked", false);
			$(`:checkbox[name="kondisi_psikologis_kehilangan_harapan"]`).prop("checked", false);
			$(`:checkbox[name="kondisi_psikologis_menerima"]`).prop("checked", false);
			$(`:text[name="pengkajian_sosial"]`).val("");
			$(`:checkbox[name="dukungan_apakah_ada_teman_dekat"]`).prop("checked", false);
			$(`:checkbox[name="dukungan_apakah_ada_keluarga_yang_mendukung"]`).prop("checked", false);
			$(`:checkbox[name="dukungan_tidak_ada_yang_mendukung"]`).prop("checked", false);
			$(`:text[name="pengkajian_spiritual"]`).val("");
			$(`:checkbox[name="kondisi_spiritual_taat_beribadah"]`).prop("checked", false);
			$(`:checkbox[name="kondisi_spiritual_kurang_taat_beribadah"]`).prop("checked", false);
			$(`:checkbox[name="kondisi_spiritual_membutuhkan_pelayanan__rohaniawan"]`).prop("checked", false);
			$(`:checkbox[name="kondisi_spiritual_menolak_pelayanan_rohaniawan"]`).prop("checked", false);
			$(`:text[name="informasi_dan_edukasi"]`).val("");$(`textarea[name="informasi_dan_edukasi"]`).html("");
			$(`:text[name="alat_bantu_lainnya"]`).val("");
			$(`:text[name="kondisi_psikologis_lainnya"]`).val("");
			$(`:text[name="dukungan_lainnya"]`).val("");
			$(`:text[name="kondisi_spiritual_lainnya"]`).val("");
		}
		$("#addModal").modal("toggle");
	});
</script>
@endsection