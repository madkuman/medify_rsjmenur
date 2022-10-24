@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Geriatric Depression Scale - Kasus
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
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Geriatric Depression Scale Baru</button>
						@endif
						<h4>Geriatric Depression Scale</h4>
						<hr>
						@php $count = count($geriatric_depression_scale) @endphp
						@forelse($geriatric_depression_scale as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						<a type="btn" href="{{url()->current()}}/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
							<i class="fa fa-print"></i>
						</a>
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Geriatric Depression Scale {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Geriatric Depression Scale tersedia</h4>
							<p>Klik tombol <b>Geriatric Depression Scale Baru</b> untuk melakukan asesmen Geriatric Depression Scale</p>
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
@include("kasus.alatbantu.geriatric-depression-scale.modal")
@include("kasus.alatbantu.geriatric-depression-scale.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $geriatric_depression_scale))!!});

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
			@include("kasus.alatbantu.geriatric-depression-scale.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.alatbantu.geriatric-depression-scale.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var apakah_anda_telah_puas_dengan_kehidupan = item.apakah_anda_telah_puas_dengan_kehidupan ? item.apakah_anda_telah_puas_dengan_kehidupan : "-";
		var apakah_anda_telah_meninggalkan_banyak_kegiatan = item.apakah_anda_telah_meninggalkan_banyak_kegiatan ? item.apakah_anda_telah_meninggalkan_banyak_kegiatan : "-";
		var apakah_anda_merasa_kehidupan_kosong = item.apakah_anda_merasa_kehidupan_kosong ? item.apakah_anda_merasa_kehidupan_kosong : "-";
		var apakah_anda_sering_bosan = item.apakah_anda_sering_bosan ? item.apakah_anda_sering_bosan : "-";
		var apakah_anda_punya_semangan_baik = item.apakah_anda_punya_semangan_baik ? item.apakah_anda_punya_semangan_baik : "-";
		var apakah_anda_takut_akan_sesuatu_buruk = item.apakah_anda_takut_akan_sesuatu_buruk ? item.apakah_anda_takut_akan_sesuatu_buruk : "-";
		var apakah_anda_merasa_bahagia = item.apakah_anda_merasa_bahagia ? item.apakah_anda_merasa_bahagia : "-";
		var apakah_anda_merasa_tidak_berdaya = item.apakah_anda_merasa_tidak_berdaya ? item.apakah_anda_merasa_tidak_berdaya : "-";
		var apakah_anda_senang_tinggal_dirumah = item.apakah_anda_senang_tinggal_dirumah ? item.apakah_anda_senang_tinggal_dirumah : "-";
		var apakah_anda_merasa_punya_banyak_masalah = item.apakah_anda_merasa_punya_banyak_masalah ? item.apakah_anda_merasa_punya_banyak_masalah : "-";
		var apakah_anda_berpikir_hidup_menyenangkan = item.apakah_anda_berpikir_hidup_menyenangkan ? item.apakah_anda_berpikir_hidup_menyenangkan : "-";
		var apakah_anda_merasa_tidak_berharga = item.apakah_anda_merasa_tidak_berharga ? item.apakah_anda_merasa_tidak_berharga : "-";
		var apakah_anda_merasa_penuh_semangat = item.apakah_anda_merasa_penuh_semangat ? item.apakah_anda_merasa_penuh_semangat : "-";
		var apakah_anda_merasa_tidak_ada_harapan = item.apakah_anda_merasa_tidak_ada_harapan ? item.apakah_anda_merasa_tidak_ada_harapan : "-";
		var apakah_anda_pikir_orang_lain_lebih_baik = item.apakah_anda_pikir_orang_lain_lebih_baik ? item.apakah_anda_pikir_orang_lain_lebih_baik : "-";
		
		var hasil = `@include("kasus.alatbantu.geriatric-depression-scale.hasil")`;
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