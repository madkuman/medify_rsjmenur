@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Instrumen Activity Daily living - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Instrumen Activity Daily living Baru</button>
						@endif

						@if (count($instrumen_activity_daily_living) > 0)
						<a type="btn" href="{{url()->current()}}/print" class="btn btn-rounded btn-alt-primary float-right mr-5" target="_blank">
							<i class="fa fa-print"></i> Cetak
						</a>
						@endif
						
						<h4>Instrumen Activity Daily living</h4>
						<hr>
						@php $count = count($instrumen_activity_daily_living) @endphp
						@forelse($instrumen_activity_daily_living as $item)

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
						
						<h5 class="mb-5 pl-5">#Instrumen Activity Daily living {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Instrumen Activity Daily living tersedia</h4>
							<p>Klik tombol <b>Instrumen Activity Daily living Baru</b> untuk melakukan asesmen Instrumen Activity Daily living</p>
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
@include("kasus.alatbantu.instrumen-activity-daily-living.modal")
@include("kasus.alatbantu.instrumen-activity-daily-living.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $instrumen_activity_daily_living))!!});

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
			@include("kasus.alatbantu.instrumen-activity-daily-living.js-form-edit");
		} else {
			$("#id").val(0);
			resetForm();

			var date = new Date();
			var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

			$('.js-datepicker').datepicker('setDate', today);
		}
		$("#addModal").modal("toggle");
		countSkor();
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		
		var tanggal = item.tanggal ? formatDate(item.tanggal) : "-";
		var mengendalikan_rangsang_pembuangan_tinja = item.mengendalikan_rangsang_pembuangan_tinja ? item.mengendalikan_rangsang_pembuangan_tinja : "-";
		var mengendalikan_rangsang_berkemih = item.mengendalikan_rangsang_berkemih ? item.mengendalikan_rangsang_berkemih : "-";
		var membersihkan_diri = item.membersihkan_diri ? item.membersihkan_diri : "-";
		var penggunaan_jamban = item.penggunaan_jamban ? item.penggunaan_jamban : "-";
		var makan = item.makan ? item.makan : "-";
		var berubah_sikap = item.berubah_sikap ? item.berubah_sikap : "-";
		var berpindah_atau_berjalan = item.berpindah_atau_berjalan ? item.berpindah_atau_berjalan : "-";
		var memakai_baju = item.memakai_baju ? item.memakai_baju : "-";
		var naik_turun_tangga = item.naik_turun_tangga ? item.naik_turun_tangga : "-";
		var mandi = item.mandi ? item.mandi : "-";
		var total_skor = item.total_skor ? item.total_skor : "0";
		
		var hasil = `@include("kasus.alatbantu.instrumen-activity-daily-living.hasil")`;
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

	function resetForm() {
		@include("kasus.alatbantu.instrumen-activity-daily-living.js-form-create");
	}

	function countSkor() {
		$('input[type=radio]').change(function() {
			$(this).parents('.skoring').find('input[type=hidden]').val($(this).data('skor'));
		});
	}
</script>
@endsection