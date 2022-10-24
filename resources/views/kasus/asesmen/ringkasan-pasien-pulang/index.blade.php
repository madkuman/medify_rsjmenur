@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Ringkasan Pasien Pulang - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Ringkasan Pasien Pulang Baru</button>
						@endif
						
						<h4>Ringkasan Pasien Pulang</h4>
						<hr>
						@php $count = count($ringkasan_pasien_pulang) @endphp
						@forelse($ringkasan_pasien_pulang as $item)

						@if($item->created_by == Auth::user()->id)
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
						<h5 class="mb-5 pl-5">#Ringkasan Pasien Pulang {{$count}}</h5>
						
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
						@php $count-- @endphp
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Ringkasan Pasien Pulang tersedia</h4>
							<p>Klik tombol <b>Ringkasan Pasien Pulang Baru</b> untuk melakukan asesmen Ringkasan Pasien Pulang</p>
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
@include("kasus.asesmen.ringkasan-pasien-pulang.modal")
@include("kasus.asesmen.ringkasan-pasien-pulang.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $ringkasan_pasien_pulang))!!});

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
			@include("kasus.asesmen.ringkasan-pasien-pulang.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.asesmen.ringkasan-pasien-pulang.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var keluhan_utama = item.keluhan_utama ? item.keluhan_utama : "-";
		var perjalanan_penyakit_pasien = item.perjalanan_penyakit_pasien ? item.perjalanan_penyakit_pasien : "-";
		var keluhan_lain = item.keluhan_lain ? item.keluhan_lain : "-";
		var riwayat_penyakit_sebelumnya = item.riwayat_penyakit_sebelumnya ? item.riwayat_penyakit_sebelumnya : "-";
		var riwayat_keluarga = item.riwayat_keluarga ? item.riwayat_keluarga : "-";
		var riwayat_penyakit_lain_lain = item.riwayat_penyakit_lain_lain ? item.riwayat_penyakit_lain_lain : "-";
		var fisik = item.fisik ? item.fisik : "-";
		var psikiatrik = item.psikiatrik ? item.psikiatrik : "-";
		var laboratorium = item.laboratorium ? item.laboratorium : "-";
		var radiologi = item.radiologi ? item.radiologi : "-";
		var pemeriksaan_lain_lain = item.pemeriksaan_lain_lain ? item.pemeriksaan_lain_lain : "-";
		var indikasi_mrs_diagnosa_masuk = item.indikasi_mrs_diagnosa_masuk ? item.indikasi_mrs_diagnosa_masuk : "-";
		var axis_1 = item.axis_1 ? item.axis_1 : "-";
		var icd_10_axis_1 = item.icd_10_axis_1 ? item.icd_10_axis_1 : "-";
		var axis_2 = item.axis_2 ? item.axis_2 : "-";
		var icd_10_axis_2 = item.icd_10_axis_2 ? item.icd_10_axis_2 : "-";
		var axis_3 = item.axis_3 ? item.axis_3 : "-";
		var icd_10_axis_3 = item.icd_10_axis_3 ? item.icd_10_axis_3 : "-";
		var axis_4 = item.axis_4 ? item.axis_4 : "-";
		var axis_5 = item.axis_5 ? item.axis_5 : "-";
		var diagnosa_sekunder = item.diagnosa_sekunder ? item.diagnosa_sekunder : "-";
		var icd_10_diagnosa_sekunder = item.icd_10_diagnosa_sekunder ? item.icd_10_diagnosa_sekunder : "-";
		var diagnosa_komplikasi = item.diagnosa_komplikasi ? item.diagnosa_komplikasi : "-";
		var icd_10_diagnosa_komplikasi = item.icd_10_diagnosa_komplikasi ? item.icd_10_diagnosa_komplikasi : "-";
		var masalah_utama_yang_dihadapi = item.masalah_utama_yang_dihadapi ? nl2br(item.masalah_utama_yang_dihadapi) : "-";
		var konsultasi = item.konsultasi ? nl2br(item.konsultasi) : "-";
		var pengobatan_medis = item.pengobatan_medis ? nl2br(item.pengobatan_medis) : "-";
		var tindakan_medis_operatif_non_operatif = item.tindakan_medis_operatif_non_operatif ? nl2br(item.tindakan_medis_operatif_non_operatif) : "-";
		var perjalanan_penyakit_selama_perawatan = item.perjalanan_penyakit_selama_perawatan ? nl2br(item.perjalanan_penyakit_selama_perawatan) : "-";
		var keadaan_waktu_krs = item.keadaan_waktu_krs ? item.keadaan_waktu_krs : "-";
		var sebab_meninggal = item.sebab_meninggal ? item.sebab_meninggal : "-";
		var tindak_lanjut = item.tindak_lanjut ? item.tindak_lanjut : "-";
		var catatan_khusus = item.catatan_khusus ? item.catatan_khusus : "-";
		
		var hasil = `@include("kasus.asesmen.ringkasan-pasien-pulang.hasil")`;
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