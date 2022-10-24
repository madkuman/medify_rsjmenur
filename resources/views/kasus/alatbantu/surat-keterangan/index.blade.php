@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Surat Keterangan Istirahat / Dirawat / Sakit - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil mr-2"></i> Surat Keterangan Istirahat / Dirawat / Sakit Baru</button>
						@endif
						
						<h4>Surat Keterangan Istirahat / Dirawat / Sakit</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($surat_keterangan as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search-plus"></i>
						</button>
						<a href="#" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right printBtn" data-id="{{$item->id}}">
							<i class="fa fa-print"></i>
						</a>

						<h5 class="mb-5 pl-5">#Surat Keterangan Istirahat / Dirawat / Sakit Pasien {{$count++}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada Surat Keterangan Istirahat / Dirawat / Sakit Pasien tersedia</h4>
							<p>Klik tombol <b>Surat Keterangan Istirahat / Dirawat / Sakit Pasien Baru</b> untuk membuat Surat Keterangan Istirahat / Dirawat / Sakit Pasien Baru</p>
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
@include("kasus.alatbantu.surat-keterangan.modal")
@include("kasus.alatbantu.surat-keterangan.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $surat_keterangan))!!});

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

	 	if(item != "" && item != undefined) {
	 		item = JSON.parse(item.val);
	 		$("#id").val(id);
			@include("kasus.alatbantu.surat-keterangan.js-form-edit")
	 	} else {
	 		$("#id").val(0);
	 		@include("kasus.alatbantu.surat-keterangan.js-form-create")
	 	}
	 	$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		item = JSON.parse(item.val);
		
		var nama = item.nama ? item.nama : "-";
		var jenis_kelamin = item.jenis_kelamin ? item.jenis_kelamin : "-";
		var umur = item.umur_pasien ? item.umur_pasien : "-";
		var alamat = item.alamat_lengkap ? item.alamat_lengkap : "-";

		var mulai_rawat_inap = item.mulai_rawat_inap ? item.mulai_rawat_inap : "-";
		var selesai_rawat_inap = item.selesai_rawat_inap ? item.selesai_rawat_inap : "-";
		var mulai_rawat_jalan = item.mulai_rawat_jalan ? item.mulai_rawat_jalan : "-";
		var selesai_rawat_jalan = item.selesai_rawat_jalan ? item.selesai_rawat_jalan : "-";
		var mulai_istirahat = item.mulai_istirahat ? item.mulai_istirahat : "-";
		var selesai_istirahat = item.selesai_istirahat ? item.selesai_istirahat : "-";
		
		var keperluan = item.keperluan_surat ? item.keperluan_surat : "-";
		var dokter = item.dokter_merawat ? item.dokter_merawat : "-";

		var hasil = `@include("kasus.alatbantu.surat-keterangan.hasil")`;
		$("#showModalHasil #myModalBody").html(hasil);
		$("#showModalHasil").modal("toggle");
	});

	$(".printBtn").click(function(e){
		e.preventDefault()
		var id = $(this).data("id");
		var url = `{{url()->current()}}/print/`+ id;
		window.open(url, '_blank');
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