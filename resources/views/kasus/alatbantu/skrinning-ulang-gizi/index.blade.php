@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Skrinning Ulang Gizi - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn"><i class="fa fa-pencil"></i> Skrinning Ulang Gizi Baru</button>
						@endif

						<a type="btn" href="{{url()->current()}}/print" class="btn btn-rounded btn-alt-primary float-right mr-5" target="_blank">
							<i class="fa fa-print"></i> Cetak
						</a>
						
						<h4>Skrinning Ulang Gizi</h4>
						<hr>
						@php $count = count($skrinning_ulang_gizi) @endphp
						@forelse($skrinning_ulang_gizi as $item)

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

						<h5 class="mb-5 pl-5">#Skrinning Ulang Gizi {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Skrinning Ulang Gizi tersedia</h4>
							<p>Klik tombol <b>Skrinning Ulang Gizi Baru</b> untuk melakukan asesmen Skrinning Ulang Gizi</p>
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
@include("kasus.alatbantu.skrinning-ulang-gizi.modal")
@include("kasus.alatbantu.skrinning-ulang-gizi.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $skrinning_ulang_gizi))!!});

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
		resetForm();

		if (item != "" && item != undefined) {
			$("#id").val(item.id);
			@include("kasus.alatbantu.skrinning-ulang-gizi.js-form-edit")
		} else {
			$("#id").val(0);
			resetForm();
		}
		$("#addModal").modal("toggle");
		countSkor();
		$('input[type=radio]:checked').trigger("change");

		$('#bb, #tb').on('change', function(){
			countImt();
		});
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var tanggal = item.tanggal ? formatDate(item.tanggal) : "-";
		var jam = item.jam ? item.jam : "-";
		var ruangan = item.ruangan ? item.ruangan : "-";
		var dx_medis = item.dx_medis ? item.dx_medis : "-";
		var tinggi_badan = item.tinggi_badan ? item.tinggi_badan : "-";
		var berat_badan = item.berat_badan ? item.berat_badan : "-";
		var imt = item.imt ? item.imt : "-";
		var imtu = item.imtu ? item.imtu : "-";
		var asupan_nutrisi = item.asupan_nutrisi ? item.asupan_nutrisi : "-";
		var status_gizi = item.status_gizi ? item.status_gizi : "-";
		var pasien_dengan_kondisi_khusus = item.pasien_dengan_kondisi_khusus ? item.pasien_dengan_kondisi_khusus : "-";
		var sebutkan_pasien_dengan_kondisi_khusus = item.sebutkan_pasien_dengan_kondisi_khusus ? item.sebutkan_pasien_dengan_kondisi_khusus : "-";
		
		var hasil = `@include("kasus.alatbantu.skrinning-ulang-gizi.hasil")`;
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

	function countSkor() {
		$('input[type=radio]').change(function() {
			$(this).parents('.skoring').find('input[type=hidden]').val($(this).data('skor'));
		});
	}

	function resetForm() {
		@include("kasus.alatbantu.skrinning-ulang-gizi.js-form-create")
	}

	function countImt() {
		var bb = $('#bb').val();
		var tb = $('#tb').val();
		var count = 0;
		var hasil = 0;

		if (!isNaN(bb) && !isNaN(tb)) {
			count = bb / Math.pow(tb/100, 2);
			hasil = count.toFixed(2);
		}

		$('#imt').val(hasil);
	}
</script>
@endsection