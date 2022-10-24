@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Rencana Pemulangan Pasien - Kasus
@endsection

@section("content")

<main id="main-container">
	@include("kasus.layouts.header")

	<div class="content">
		<div class="row">
			@include("kasus.layouts.sidebar")

			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						@if(session("my_role_".$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Rencana Pemulangan Pasien Baru</button>
						@endif
						
						<h4>Rencana Pemulangan Pasien</h4>
						<hr>
						@php $count = count($rencana_pemulangan_pasien) @endphp
						@forelse($rencana_pemulangan_pasien as $item)

						@if(session("my_role_".$kasus->nomor_kasus))
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<a type="btn" href="{{url()->current()}}/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
							<i class="fa fa-print"></i>
						</a>
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</button>
						<h5 class="mb-5 pl-5">#Rencana Pemulangan Pasien {{$count}}</h5>

							<div class="row">
								<div class="col-6">
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
								</div>
						@if(!empty($item->updated_by))
								<div class="col-6">
								@if(!empty($item->updater->avatar_thumb))
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
										<small class="text-muted">Diubah Oleh</small><br>
										{{$item->updater->name}}<br>
										{{date("d F y, H:i", strtotime($item->updated_at))}}
									</h6>
								</div>
								</div>
						@endif
							</div>

						<hr class="my-20">
						@php $count-- @endphp
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Rencana Pemulangan Pasien tersedia</h4>
							<p>Klik tombol <b>Rencana Pemulangan Pasien Baru</b> untuk melakukan asesmen Rencana Pemulangan Pasien</p>
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
@include("kasus.asesmen.rencana-pemulangan-pasien.modal")
@include("kasus.asesmen.rencana-pemulangan-pasien.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $rencana_pemulangan_pasien))!!});

	$(document).ready(function(){
		$(".time").mask("00:00");
	});


	function nl2br (str, is_xhtml) {   
	    var breakTag = (is_xhtml || typeof is_xhtml === "undefined") ? "<br />" : "<br>";    
	    return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "$1"+ breakTag +"$2");
	}


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
		if (item != "" && item != undefined) {
			$("#id").val(item.id);
			@include("kasus.asesmen.rencana-pemulangan-pasien.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.asesmen.rencana-pemulangan-pasien.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var alasan_masuk = item.alasan_masuk ? item.alasan_masuk : "-";
		var diagnosa_masuk = item.diagnosa_masuk ? item.diagnosa_masuk : "-";
		var diagnosa_keperawatan_saat_mrs = item.diagnosa_keperawatan_saat_mrs ? item.diagnosa_keperawatan_saat_mrs : "-";
		var estimasi_lamanya_perawatan_pasien = item.estimasi_lamanya_perawatan_pasien ? item.estimasi_lamanya_perawatan_pasien : "-";
		var keadaan_krs = item.keadaan_krs ? item.keadaan_krs : "-";
		var diagnosa_keluar = item.diagnosa_keluar ? item.diagnosa_keluar : "-";
		var diagnosa_keperawatan_saat_krs = item.diagnosa_keperawatan_saat_krs ? item.diagnosa_keperawatan_saat_krs : "-";
		var lama_dirawat = item.lama_dirawat ? item.lama_dirawat : "-";
		var pemeriksaan_penunjang_laboratorium = item.pemeriksaan_penunjang_laboratorium ? "✔️" : "-";
		var pemeriksaan_penunjang_eeg = item.pemeriksaan_penunjang_eeg ? "✔️" : "-";
		var pemeriksaan_penunjang_bm = item.pemeriksaan_penunjang_bm ? "✔️" : "-";
		var pemeriksaan_penunjang_ekg = item.pemeriksaan_penunjang_ekg ? "✔️" : "-";
		var pemeriksaan_penunjang_foto_rontgen = item.pemeriksaan_penunjang_foto_rontgen ? "✔️" : "-";
		var pemeriksaan_penunjang_lainnya = item.pemeriksaan_penunjang_lainnya ? "✔️" : "-";
		var pemeriksaan_penunjang_lain_lain = item.pemeriksaan_penunjang_lain_lain ? item.pemeriksaan_penunjang_lain_lain : "-";
		var pasien_tinggal_dengan_suami_istri = item.pasien_tinggal_dengan_suami_istri ? "✔️" : "-";
		var pasien_tinggal_dengan_sendiri = item.pasien_tinggal_dengan_sendiri ? "✔️" : "-";
		var pasien_tinggal_dengan_orang_tua = item.pasien_tinggal_dengan_orang_tua ? "✔️" : "-";
		var pasien_tinggal_dengan_anak = item.pasien_tinggal_dengan_anak ? "✔️" : "-";
		var pasien_tinggal_dengan_keluarga_lain = item.pasien_tinggal_dengan_keluarga_lain ? "✔️" : "-";
		var pasien_tinggal_dengan_lainnya = item.pasien_tinggal_dengan_lainnya ? "✔️" : "-";
		var pasien_tinggal_dengan_lain_lain = item.pasien_tinggal_dengan_lain_lain ? item.pasien_tinggal_dengan_lain_lain : "-";
		var keterangan_lain_lain = item.keterangan_lain_lain ? item.keterangan_lain_lain : "-";
		var rencana_kegiatan_pasien_saat_pulang_bekerja = item.rencana_kegiatan_pasien_saat_pulang_bekerja ? "✔️" : "-";
		var rencana_kegiatan_pasien_saat_pulang_sekolah = item.rencana_kegiatan_pasien_saat_pulang_sekolah ? "✔️" : "-";
		var rencana_kegiatan_pasien_saat_pulang_lainnya = item.rencana_kegiatan_pasien_saat_pulang_lainnya ? "✔️" : "-";
		var keterangan_pekerjaan = item.keterangan_pekerjaan ? item.keterangan_pekerjaan : "-";
		var keterangan_jenjang_pendidikan = item.keterangan_jenjang_pendidikan ? item.keterangan_jenjang_pendidikan : "-";
		var keterangan_kegiatan_lain = item.keterangan_kegiatan_lain ? item.keterangan_kegiatan_lain : "-";
		var perlu_bantuan_dalam_hal_minum_obat = item.perlu_bantuan_dalam_hal_minum_obat ? "✔️" : "-";
		var perlu_bantuan_dalam_hal_mandi = item.perlu_bantuan_dalam_hal_mandi ? "✔️" : "-";
		var perlu_bantuan_dalam_hal_makan = item.perlu_bantuan_dalam_hal_makan ? "✔️" : "-";
		var perlu_bantuan_dalam_hal_berhias = item.perlu_bantuan_dalam_hal_berhias ? "✔️" : "-";
		var perlu_bantuan_dalam_hal_toiletting = item.perlu_bantuan_dalam_hal_toiletting ? "✔️" : "-";
		var alat_medis_yang_digunakan_saat_keluar_rs = item.alat_medis_yang_digunakan_saat_keluar_rs ? item.alat_medis_yang_digunakan_saat_keluar_rs : "-";
		var keterangan_alat_medis_yang_digunakan = item.keterangan_alat_medis_yang_digunakan ? item.keterangan_alat_medis_yang_digunakan : "-";
		var alat_bantu_yang_digunakan_saat_keluar_rs = item.alat_bantu_yang_digunakan_saat_keluar_rs ? item.alat_bantu_yang_digunakan_saat_keluar_rs : "-";
		var keterangan_alat_bantu_yang_digunakan = item.keterangan_alat_bantu_yang_digunakan ? item.keterangan_alat_bantu_yang_digunakan : "-";
		var skor_resiko_jatuh__saat_krs = item.skor_resiko_jatuh__saat_krs ? item.skor_resiko_jatuh__saat_krs : "-";
		var skor_resiko_nyeri_saat_krs = item.skor_resiko_nyeri_saat_krs ? item.skor_resiko_nyeri_saat_krs : "-";
		var diet_khusus = item.diet_khusus ? item.diet_khusus : "-";
		var keterangan_diet_khusus = item.keterangan_diet_khusus ? item.keterangan_diet_khusus : "-";
		var nasehat = item.nasehat ? item.nasehat : "-";
		
		var hasil = `@include("kasus.asesmen.rencana-pemulangan-pasien.hasil")`;
		$("#showModalHasil #myModalBody").html(hasil);
		$("#showModalHasil").modal("toggle");
	});

	function formatDate (input) {
		if (input === null) {
			return null;
		} else {
			var datePart = input.match(/\d+/g),
			year = datePart[0],
			month = datePart[1], day = datePart[2];

			return day+"/"+month+"/"+year;
		}
	}
</script>
@endsection