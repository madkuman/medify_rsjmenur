@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Whodas - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Whodas Baru</button>
						@endif
						
						<h4>WHODAS 2.0</h4>
						<hr>
						@php $count = count($whodas) @endphp
						@forelse($whodas as $item)


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
						
						<a type="btn" href="{{url()->current()}}/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
							<i class="fa fa-print"></i>
						</a>
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</button>
						<h5 class="mb-5 pl-5">#Whodas {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen WHODAS 2.0 tersedia</h4>
							<p>Klik tombol <b>Whodas Baru</b> untuk melakukan asesmen Whodas</p>
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
@include("kasus.alatbantu.whodas.modal")
@include("kasus.alatbantu.whodas.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $whodas))!!});

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
			@include("kasus.alatbantu.whodas.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.alatbantu.whodas.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var berapa_tahun_menempuh_pendidikan = item.berapa_tahun_menempuh_pendidikan ? item.berapa_tahun_menempuh_pendidikan : "-";
		var nomor_identitas_responden = item.nomor_identitas_responden ? item.nomor_identitas_responden : "-";
		var nomor_identitas_pewawancara = item.nomor_identitas_pewawancara ? item.nomor_identitas_pewawancara : "-";
		var titik_waktu_penilaian = item.titik_waktu_penilaian ? item.titik_waktu_penilaian : "-";
		var waktu_wawancara = item.waktu_wawancara ? formatDate(item.waktu_wawancara) : "-";
		var situasi_hidup_saat_wawancara = item.situasi_hidup_saat_wawancara ? item.situasi_hidup_saat_wawancara : "-";
		var berdiri_untuk_jangka_waktu_yang_lama = item.berdiri_untuk_jangka_waktu_yang_lama ? item.berdiri_untuk_jangka_waktu_yang_lama : "-";
		var melakukan_pekerjaan_rumah = item.melakukan_pekerjaan_rumah ? item.melakukan_pekerjaan_rumah : "-";
		var mempelajari_hal_baru = item.mempelajari_hal_baru ? item.mempelajari_hal_baru : "-";
		var mengalami_kesulitan_bergabung = item.mengalami_kesulitan_bergabung ? item.mengalami_kesulitan_bergabung : "-";
		var kondisi_kesehatan_mempengaruhi_emosional = item.kondisi_kesehatan_mempengaruhi_emosional ? item.kondisi_kesehatan_mempengaruhi_emosional : "-";
		var berkonsentrasi_dalam_melakukan_sesuatu = item.berkonsentrasi_dalam_melakukan_sesuatu ? item.berkonsentrasi_dalam_melakukan_sesuatu : "-";
		var berjalan_dalam_jarak_yang_jauh = item.berjalan_dalam_jarak_yang_jauh ? item.berjalan_dalam_jarak_yang_jauh : "-";
		var mandi = item.mandi ? item.mandi : "-";
		var berpakaian = item.berpakaian ? item.berpakaian : "-";
		var berhubungan_dengan_orang_baru = item.berhubungan_dengan_orang_baru ? item.berhubungan_dengan_orang_baru : "-";
		var mempertahankan_pertemanan = item.mempertahankan_pertemanan ? item.mempertahankan_pertemanan : "-";
		var kembali_bekerja_atau_bersekolah = item.kembali_bekerja_atau_bersekolah ? item.kembali_bekerja_atau_bersekolah : "-";
		var berapa_hari_anda_mengalami_kesulitan = item.berapa_hari_anda_mengalami_kesulitan ? item.berapa_hari_anda_mengalami_kesulitan : "-";
		var berapa_hari_sama_sekali_tidak_mampu_melakukan_aktifitas = item.berapa_hari_sama_sekali_tidak_mampu_melakukan_aktifitas ? item.berapa_hari_sama_sekali_tidak_mampu_melakukan_aktifitas : "-";
		var berapa_hari_anda_harus_mengurangi_aktifitas = item.berapa_hari_anda_harus_mengurangi_aktifitas ? item.berapa_hari_anda_harus_mengurangi_aktifitas : "-";
		
		var hasil = `@include("kasus.alatbantu.whodas.hasil")`;
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