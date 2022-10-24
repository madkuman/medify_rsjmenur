@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Mini Mental State Examination - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Mini Mental State Examination Baru</button>
						@endif
						@if (count($mini_mental_state_examination) > 0)
						<a type="btn" href="{{url()->current()}}/print" class="btn btn-rounded btn-alt-primary float-right mr-5" target="_blank">
							<i class="fa fa-print"></i> Cetak
						</a>
						@endif
						
						<h4>Mini Mental State Examination</h4>
						<hr>
						@php $count = count($mini_mental_state_examination) @endphp
						@forelse($mini_mental_state_examination as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Mini Mental State Examination {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Mini Mental State Examination tersedia</h4>
							<p>Klik tombol <b>Mini Mental State Examination Baru</b> untuk melakukan asesmen Mini Mental State Examination</p>
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
@include("kasus.alatbantu.mini-mental-state-examination.modal")
@include("kasus.alatbantu.mini-mental-state-examination.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $mini_mental_state_examination))!!});

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
			@include("kasus.alatbantu.mini-mental-state-examination.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.alatbantu.mini-mental-state-examination.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var hari_tanggal_bulan_tahun_musim = item.hari_tanggal_bulan_tahun_musim ? item.hari_tanggal_bulan_tahun_musim : "-";
		var kita_berada_dimana = item.kita_berada_dimana ? item.kita_berada_dimana : "-";
		var nama_tiga_buah_benda = item.nama_tiga_buah_benda ? item.nama_tiga_buah_benda : "-";
		var hitung_berturut_turut = item.hitung_berturut_turut ? item.hitung_berturut_turut : "-";
		var tanya_nama_benda = item.tanya_nama_benda ? item.tanya_nama_benda : "-";
		var nama_benda_benda = item.nama_benda_benda ? item.nama_benda_benda : "-";
		var ulangi_kalimat_berikut = item.ulangi_kalimat_berikut ? item.ulangi_kalimat_berikut : "-";
		var laksanakan_perintah = item.laksanakan_perintah ? item.laksanakan_perintah : "-";
		var bacalah_dan_laksanakan_perintah = item.bacalah_dan_laksanakan_perintah ? item.bacalah_dan_laksanakan_perintah : "-";
		var tulis_sebuah_kalimat = item.tulis_sebuah_kalimat ? item.tulis_sebuah_kalimat : "-";
		var tirulah_gambar = item.tirulah_gambar ? item.tirulah_gambar : "-";
		var jumlah_percobaan = item.jumlah_percobaan ? item.jumlah_percobaan : "-";
		
		var hasil = `@include("kasus.alatbantu.mini-mental-state-examination.hasil")`;
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