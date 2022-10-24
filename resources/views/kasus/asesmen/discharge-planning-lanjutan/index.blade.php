@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Discharge Planning Lanjutan - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Discharge Planning Lanjutan Baru</button>
						@endif
						<h4>Discharge Planning Lanjutan</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($discharge_planning_lanjutan as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Discharge Planning Lanjutan {{$count++}}</h5>
						<div class="row" id="">
							@include("kasus.asesmen.discharge-planning-lanjutan.hasil")
						</div>

						<hr class="my-20">
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Discharge Planning Lanjutan tersedia</h4>
							<p>Klik tombol <b>Discharge Planning Lanjutan Baru</b> untuk melakukan asesmen Discharge Planning Lanjutan</p>
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
@include("kasus.asesmen.discharge-planning-lanjutan.modal")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $discharge_planning_lanjutan))!!});

	var age_default_value = "{{$kasus->pasien->age ?? '-'}}"
	if(age_default_value <= 55) age_default_value = "<= 55 tahun--0";
	else if(age_default_value > 55 && age_default_value <= 64) age_default_value = "56 - 64 tahun--1";
	else if(age_default_value > 65 && age_default_value <= 79) age_default_value = "65 - 79 tahun--2";
	else if(age_default_value >= 80) age_default_value = ">= 80 tahun--3";


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
			
			$(`:radio[name="usia"][value="${item.usia}"]`).prop("checked", true);
			$(`:radio[name="dukungan_sosial"][value="${item.dukungan_sosial}"]`).prop("checked", true);
			$(`:checkbox[name="status_fungsional_mandiri"]`).prop("checked", item.status_fungsional_mandiri != null);
			$(`:checkbox[name="status_fungsional_bergantung_mandi"]`).prop("checked", item.status_fungsional_bergantung_mandi != null);
			$(`:checkbox[name="status_fungsional_bergantung_makan"]`).prop("checked", item.status_fungsional_bergantung_makan != null);
			$(`:checkbox[name="status_fungsional_bergantung_ke_kamar_mandi"]`).prop("checked", item.status_fungsional_bergantung_ke_kamar_mandi != null);
			$(`:checkbox[name="status_fungsional_bergantung_mobilisasi"]`).prop("checked", item.status_fungsional_bergantung_mobilisasi != null);
			$(`:checkbox[name="status_fungsional_bergantung_bab"]`).prop("checked", item.status_fungsional_bergantung_bab != null);
			$(`:checkbox[name="status_fungsional_bergantung_bak"]`).prop("checked", item.status_fungsional_bergantung_bak != null);
			$(`:checkbox[name="status_fungsional_bergantung_pengobatan"]`).prop("checked", item.status_fungsional_bergantung_pengobatan != null);
			$(`:checkbox[name="status_fungsional_bergantung__makanan"]`).prop("checked", item.status_fungsional_bergantung__makanan != null);
			$(`:checkbox[name="status_fungsional_bergantung_keuangan"]`).prop("checked", item.status_fungsional_bergantung_keuangan != null);
			$(`:checkbox[name="status_fungsional_bergantung_daya_beli"]`).prop("checked", item.status_fungsional_bergantung_daya_beli != null);
			$(`:checkbox[name="status_fungsional_bergantung_transportasi"]`).prop("checked", item.status_fungsional_bergantung_transportasi != null);
			$(`:radio[name="kognitif"][value="${item.kognitif}"]`).prop("checked", true);
			$(`:checkbox[name="perilaku_tenang"]`).prop("checked", item.perilaku_tenang != null);
			$(`:checkbox[name="perilaku_bingung"]`).prop("checked", item.perilaku_bingung != null);
			$(`:checkbox[name="perilaku_gelisah"]`).prop("checked", item.perilaku_gelisah != null);
			$(`:checkbox[name="perilaku_tidak_bisa_tenang"]`).prop("checked", item.perilaku_tidak_bisa_tenang != null);
			$(`:checkbox[name="perilaku_lainnya"]`).prop("checked", item.perilaku_lainnya != null);
			$(`:radio[name="mobilisasi"][value="${item.mobilisasi}"]`).prop("checked", true);
			$(`:radio[name="sensorik"][value="${item.sensorik}"]`).prop("checked", true);
			$(`:radio[name="perawatan_sebelumnya"][value="${item.perawatan_sebelumnya}"]`).prop("checked", true);
			$(`:radio[name="masalah_medis"][value="${item.masalah_medis}"]`).prop("checked", true);
			$(`:radio[name="konsumi_obat"][value="${item.konsumi_obat}"]`).prop("checked", true);
		}else{
			$("#id").val(0);
			
			$(`:radio[name="usia"][value="`+age_default_value+`"]`).prop("checked", true);
			$(`:radio[name="dukungan_sosial"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_mandiri"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung_mandi"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung_makan"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung_ke_kamar_mandi"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung_mobilisasi"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung_bab"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung_bak"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung_pengobatan"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung__makanan"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung_keuangan"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung_daya_beli"]`).prop("checked", false);
			$(`:checkbox[name="status_fungsional_bergantung_transportasi"]`).prop("checked", false);
			$(`:radio[name="kognitif"]`).prop("checked", false);
			$(`:checkbox[name="perilaku_tenang"]`).prop("checked", false);
			$(`:checkbox[name="perilaku_bingung"]`).prop("checked", false);
			$(`:checkbox[name="perilaku_gelisah"]`).prop("checked", false);
			$(`:checkbox[name="perilaku_tidak_bisa_tenang"]`).prop("checked", false);
			$(`:checkbox[name="perilaku_lainnya"]`).prop("checked", false);
			$(`:radio[name="mobilisasi"]`).prop("checked", false);
			$(`:radio[name="sensorik"]`).prop("checked", false);
			$(`:radio[name="perawatan_sebelumnya"]`).prop("checked", false);
			$(`:radio[name="masalah_medis"]`).prop("checked", false);
			$(`:radio[name="konsumi_obat"]`).prop("checked", false);
		}
		$("#addModal").modal("toggle");
	});
</script>
@endsection