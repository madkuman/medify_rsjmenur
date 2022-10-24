@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Penilaian Kualitas Hidup Lansia - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Penilaian Baru</button>
						@endif

						<a type="btn" href="{{url()->current()}}/print" class="btn btn-rounded btn-alt-primary float-right mr-5" target="_blank">
							<i class="fa fa-print"></i> Cetak
						</a>
						
						<h4>Penilaian Kualitas Hidup Lansia</h4>
						<hr>
						@php $count = count($penilaian_kualitas_hidup_lansia) @endphp
						@forelse($penilaian_kualitas_hidup_lansia as $item)

						@if(session("my_role_".$kasus->nomor_kasus))
						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						@endif

						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</button>

						<h5 class="mb-5 pl-5">#Penilaian Kualitas Hidup Lansia {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Penilaian Kualitas Hidup Lansia tersedia</h4>
							<p>Klik tombol <b>Penilaian Kualitas Hidup Lansia Baru</b> untuk melakukan asesmen Penilaian Kualitas Hidup Lansia</p>
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
@include("kasus.alatbantu.penilaian-kualitas-hidup-lansia.modal")
@include("kasus.alatbantu.penilaian-kualitas-hidup-lansia.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $penilaian_kualitas_hidup_lansia))!!});

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
			@include("kasus.alatbantu.penilaian-kualitas-hidup-lansia.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.alatbantu.penilaian-kualitas-hidup-lansia.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var saya_tidak_bermasalah_untuk_berjalan_keliling = item.saya_tidak_bermasalah_untuk_berjalan_keliling ? item.saya_tidak_bermasalah_untuk_berjalan_keliling : "-";
		var tanggal_tidak_masalah_berjalan_keliling = item.tanggal_tidak_masalah_berjalan_keliling ? formatDate(item.tanggal_tidak_masalah_berjalan_keliling) : "-";
		var tanggal_masalah_berjalan_keliling = item.tanggal_masalah_berjalan_keliling ? formatDate(item.tanggal_masalah_berjalan_keliling) : "-";
		var saya_mengalami_masalah_untuk_berjalan_keliling = item.saya_mengalami_masalah_untuk_berjalan_keliling ? item.saya_mengalami_masalah_untuk_berjalan_keliling : "-";
		var tanggal_terbaring_di_kasur = item.tanggal_terbaring_di_kasur ? formatDate(item.tanggal_terbaring_di_kasur) : "-";
		var saya_hanya_terbaring_di_kasur = item.saya_hanya_terbaring_di_kasur ? item.saya_hanya_terbaring_di_kasur : "-";
		var tanggal_mengurus_diri_sendiri = item.tanggal_mengurus_diri_sendiri ? formatDate(item.tanggal_mengurus_diri_sendiri) : "-";
		var saya_tidak_bermasalah_mengurus_diri_sendiri = item.saya_tidak_bermasalah_mengurus_diri_sendiri ? item.saya_tidak_bermasalah_mengurus_diri_sendiri : "-";
		var tanggal_bermasalah_membersihkan_pakaian = item.tanggal_bermasalah_membersihkan_pakaian ? formatDate(item.tanggal_bermasalah_membersihkan_pakaian) : "-";
		var saya_bermasalah_untuk_membersihkan_dan_memakai_pakaian_sendiri = item.saya_bermasalah_untuk_membersihkan_dan_memakai_pakaian_sendiri ? item.saya_bermasalah_untuk_membersihkan_dan_memakai_pakaian_sendiri : "-";
		var tanggal_tidak_mampu_sama_sekali_memakai_pakaian = item.tanggal_tidak_mampu_sama_sekali_memakai_pakaian ? formatDate(item.tanggal_tidak_mampu_sama_sekali_memakai_pakaian) : "-";
		var saya_tidak_mampu_memakai_pakaian_sendiri = item.saya_tidak_mampu_memakai_pakaian_sendiri ? item.saya_tidak_mampu_memakai_pakaian_sendiri : "-";
		var tanggal_aktivitas_harian = item.tanggal_aktivitas_harian ? formatDate(item.tanggal_aktivitas_harian) : "-";
		var saya_tidak_bermasalah_melakukan_aktivitas_harian = item.saya_tidak_bermasalah_melakukan_aktivitas_harian ? item.saya_tidak_bermasalah_melakukan_aktivitas_harian : "-";
		var tanggal_bermasalah_aktivitas_harian = item.tanggal_bermasalah_aktivitas_harian ? formatDate(item.tanggal_bermasalah_aktivitas_harian) : "-";
		var saya_bermasalah_melakukan_aktivitas = item.saya_bermasalah_melakukan_aktivitas ? item.saya_bermasalah_melakukan_aktivitas : "-";
		var tanggal_tidak_dapat_menjalankan_aktivitas = item.tanggal_tidak_dapat_menjalankan_aktivitas ? formatDate(item.tanggal_tidak_dapat_menjalankan_aktivitas) : "-";
		var saya_tidak_dapat_menjalankan_aktivitas = item.saya_tidak_dapat_menjalankan_aktivitas ? item.saya_tidak_dapat_menjalankan_aktivitas : "-";
		var tanggal_tidak_punya_keluhan_nyeri = item.tanggal_tidak_punya_keluhan_nyeri ? formatDate(item.tanggal_tidak_punya_keluhan_nyeri) : "-";
		var saya_tidak_punya_keluhan_nyeri = item.saya_tidak_punya_keluhan_nyeri ? item.saya_tidak_punya_keluhan_nyeri : "-";
		var tanggal_tidak_punya_keluhan_nyeri_sedang = item.tanggal_tidak_punya_keluhan_nyeri_sedang ? formatDate(item.tanggal_tidak_punya_keluhan_nyeri_sedang) : "-";
		var saya_tidak_punya_keluhan_nyeri_sedang = item.saya_tidak_punya_keluhan_nyeri_sedang ? item.saya_tidak_punya_keluhan_nyeri_sedang : "-";
		var tanggal_tidak_punya_keluhan_nyeri_berat = item.tanggal_tidak_punya_keluhan_nyeri_berat ? formatDate(item.tanggal_tidak_punya_keluhan_nyeri_berat) : "-";
		var saya_tidak_punya_keluhan_nyeri_berat = item.saya_tidak_punya_keluhan_nyeri_berat ? item.saya_tidak_punya_keluhan_nyeri_berat : "-";
		var tanggal_tidak_gelisah = item.tanggal_tidak_gelisah ? formatDate(item.tanggal_tidak_gelisah) : "-";
		var saya_tidak_gelisah_maupun_depresi = item.saya_tidak_gelisah_maupun_depresi ? item.saya_tidak_gelisah_maupun_depresi : "-";
		var tanggal_tidak_gelisah_maupun_depresi_sedang = item.tanggal_tidak_gelisah_maupun_depresi_sedang ? formatDate(item.tanggal_tidak_gelisah_maupun_depresi_sedang) : "-";
		var saya_mengalami_gelisah_maupun_depresi_sedang = item.saya_mengalami_gelisah_maupun_depresi_sedang ? item.saya_mengalami_gelisah_maupun_depresi_sedang : "-";
		var tanggal_gelisah_maupun_depresi_berat = item.tanggal_gelisah_maupun_depresi_berat ? formatDate(item.tanggal_gelisah_maupun_depresi_berat) : "-";
		var saya_mengalami_tgelisah_maupun_depresi_berat = item.saya_mengalami_tgelisah_maupun_depresi_berat ? item.saya_mengalami_tgelisah_maupun_depresi_berat : "-";
		
		var hasil = `@include("kasus.alatbantu.penilaian-kualitas-hidup-lansia.hasil")`;
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