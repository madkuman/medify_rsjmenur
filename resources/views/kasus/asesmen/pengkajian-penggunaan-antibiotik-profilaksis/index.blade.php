@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Pengkajian Penggunaan Antibiotik Profilaksis - Kasus
@endsection

@section("content")

<!-- Main Container -->
<main id="main-container">
	@include("kasus.layouts.header")

	<div class="content">
		<div class="row">
			@include("kasus.layouts.sidebar")

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Pengkajian Penggunaan Antibiotik Profilaksis Baru</button>
						@endif
						<h4>Pengkajian Penggunaan Antibiotik Profilaksis</h4>
						<hr>
						@php $count = count($pengkajian_penggunaan_antibiotik_profilaksis) @endphp
						@forelse($pengkajian_penggunaan_antibiotik_profilaksis as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Pengkajian Penggunaan Antibiotik Profilaksis {{$count--}}</h5>
						<div class="row" id="">
							@include("kasus.asesmen.pengkajian-penggunaan-antibiotik-profilaksis.hasil")
						</div>
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Pengkajian Penggunaan Antibiotik Profilaksis tersedia</h4>
							<p>Klik tombol <b>Pengkajian Penggunaan Antibiotik Profilaksis Baru</b> untuk melakukan asesmen Pengkajian Penggunaan Antibiotik Profilaksis</p>
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
@include("kasus.asesmen.pengkajian-penggunaan-antibiotik-profilaksis.modal")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $pengkajian_penggunaan_antibiotik_profilaksis))!!});

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
		console.log(item);
		if(item != "" && item != undefined){
			$("#id").val(item.id);
			tanggal_pembedahan = moment(item.tanggal_pembedahan)
			tanggal_pembedahan = tanggal_pembedahan.format('DD/MM/YYYY')
			$(`:text[name="tanggal_pembedahan"]`).val(tanggal_pembedahan);
			$(`:text[name="jenis_pembedahan"]`).val(item.jenis_pembedahan);
			$(`:text[name="indikasi_pembedahan"]`).val(item.indikasi_pembedahan);
			$(`:radio[name="jadwal_operasi"][value="${item.jadwal_operasi}"]`).prop("checked", true);
			$(`:radio[name="klasifikasi_operasi"][value="${item.klasifikasi_operasi}"]`).prop("checked", true);
			$(`:text[name="waktu_mulai_insisi"]`).val(item.waktu_mulai_insisi);
			$(`:text[name="lama_operasi"]`).val(item.lama_operasi);
			$(`:text[name="pemberian_antibiotik_profilaksis"]`).val(item.pemberian_antibiotik_profilaksis);
			$(`:text[name="obat_yang_diberikan"]`).val(item.obat_yang_diberikan);
			$(`:text[name="dosis"]`).val(item.dosis);
			$(`:text[name="rute"]`).val(item.rute);
			$(`:text[name="waktu_pemberian_pertama"]`).val(item.waktu_pemberian_pertama);
			$(`:radio[name="pemberian_dosis_tambahan"][value="${item.pemberian_dosis_tambahan}"]`).prop("checked", true);
			$(`:text[name="apabila_ya"]`).val(item.apabila_ya);
			$(`:text[name="ya_indikasi"]`).val(item.ya_indikasi);
			$(`:text[name="ya_dosis"]`).val(item.ya_dosis);
			$(`:text[name="ya_rute"]`).val(item.ya_rute);
			$(`:text[name="frekuensi_pemberian_antibiotik_profilaks"]`).val(item.frekuensi_pemberian_antibiotik_profilaks);
			$(`:text[name="lama_pemberian"]`).val(item.lama_pemberian);
		}else{
			$("#id").val(0);
			
			$(`:text[name="tanggal_pembedahan"]`).val("");
			$(`:text[name="jenis_pembedahan"]`).val("");
			$(`:text[name="indikasi_pembedahan"]`).val("");
			$(`:radio[name="jadwal_operasi"]`).prop("checked", false);
			$(`:radio[name="klasifikasi_operasi"]`).prop("checked", false);
			$(`:text[name="waktu_mulai_insisi"]`).val("");
			$(`:text[name="lama_operasi"]`).val("");
			$(`:text[name="pemberian_antibiotik_profilaksis"]`).val("");
			$(`:text[name="obat_yang_diberikan"]`).val("");
			$(`:text[name="dosis"]`).val("");
			$(`:text[name="rute"]`).val("");
			$(`:text[name="waktu_pemberian_pertama"]`).val("");
			$(`:radio[name="pemberian_dosis_tambahan"]`).prop("checked", false);
			$(`:text[name="apabila_ya"]`).val("");
			$(`:text[name="ya_indikasi"]`).val("");
			$(`:text[name="ya_dosis"]`).val("");
			$(`:text[name="ya_rute"]`).val("");
			$(`:text[name="frekuensi_pemberian_antibiotik_profilaks"]`).val("");
			$(`:text[name="lama_pemberian"]`).val("");
		}
		$("#addModal").modal("toggle");
	});
</script>
@endsection