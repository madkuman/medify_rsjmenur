@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Lembar Komunikasi Informasi dan Edukasi Pasien dan Keluarga - Kasus
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
						<h4>Lembar Komunikasi Informasi dan Edukasi Pasien dan Keluarga</h4>
						<div class="text-right">
							<a type="btn" href="{{url()->current()}}/print" class="btn btn-rounded btn-alt-secondary min-width-125" target="_blank">
								<i class="fa fa-print"></i> Print Rekapitulasi
							</a>
							@if(session('my_role_'.$kasus->nomor_kasus))
							<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Form Baru</button>
							@endif
						</div>
						
						<hr>
						@php $count = count($lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga) @endphp
						@forelse($lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga as $item)

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
						<h5 class="mb-5 pl-5">#Lembar Komunikasi Informasi dan Edukasi Pasien dan Keluarga {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Lembar Komunikasi Informasi dan Edukasi Pasien dan Keluarga tersedia</h4>
							<p>Klik tombol <b>Lembar Komunikasi Informasi dan Edukasi Pasien dan Keluarga Baru</b> untuk melakukan asesmen Lembar Komunikasi Informasi dan Edukasi Pasien dan Keluarga</p>
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
@include("kasus.asesmen.lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga.modal")
@include("kasus.asesmen.lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga))!!});

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
			@include("kasus.asesmen.lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.asesmen.lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var kebutuhan_materi_edukasi_informasi = item.kebutuhan_materi_edukasi_informasi ? nl2br(item.kebutuhan_materi_edukasi_informasi) : "-";
		var tanggal_edukasi = item.tanggal_edukasi ? formatDate(item.tanggal_edukasi) : "-";
		var jam_edukasi = item.jam_edukasi ? item.jam_edukasi : "-";
		var durasi_edukasi = item.durasi_edukasi ? item.durasi_edukasi : "-";
		var metode = item.metode ? item.metode : "-";
		var nama_edukator_pemberi_informasi = item.nama_edukator_pemberi_informasi ? item.nama_edukator_pemberi_informasi : "-";
		var verifikasi_verfikasi = item.verifikasi_verfikasi ? "✔️" : "-";
		var nama_penerima_informasi = item.nama_penerima_informasi ? item.nama_penerima_informasi : "-";
		var hubungan_terhadap_pasien = item.hubungan_terhadap_pasien ? item.hubungan_terhadap_pasien : "-";
		
		var hasil = `@include("kasus.asesmen.lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga.hasil")`;
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