@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Transfer Pasien - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Transfer Pasien Baru</button>
						@endif
						<h4>Transfer Pasien</h4>
						<hr>
						@php $count = count($transfer_pasien) @endphp
						@forelse($transfer_pasien as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 
						pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Transfer Pasien {{$count--}}</h5>
						<div class="row" id="">
							@include("kasus.asesmen.transfer-pasien.hasil")
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Transfer Pasien tersedia</h4>
							<p>Klik tombol <b>Transfer Pasien Baru</b> untuk melakukan asesmen Transfer Pasien</p>
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
@include("kasus.asesmen.transfer-pasien.modal")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $transfer_pasien))!!});

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
		var item = data[$(this).data("index")]
		if(item != "" && item != undefined){
			$("#id").val(item.id);
			
			$(`:text[name="dari_ruangan"]`).val(item.dari_ruangan);
			$(`:text[name="ke_ruangan"]`).val(item.ke_ruangan);
			$(`:radio[name="tingkat_kesadaran"][value="${item.tingkat_kesadaran}"]`).prop("checked", true);
			$(`:text[name="gcs"]`).val(item.gcs);
			$(`:radio[name="keadaan_umum"][value="${item.keadaan_umum}"]`).prop("checked", true);
			$(`:text[name="tanda_tanda_vital"]`).val(item.tanda_tanda_vital);
			$(`:text[name="tensi"]`).val(item.tensi);
			$(`:text[name="suhu"]`).val(item.suhu);
			$(`:text[name="ews"]`).val(item.ews);
			$(`:text[name="rr"]`).val(item.rr);
			$(`:text[name="djj"]`).val(item.djj);
			$(`:text[name="cvp"]`).val(item.cvp);
			$(`:text[name="n"]`).val(item.n);
			$(`:text[name="spo2"]`).val(item.spo2);
			$(`:text[name="ttv_lain_lain"]`).val(item.ttv_lain_lain);
			$(`:text[name="identifikasi_pasien"]`).val(item.identifikasi_pasien);
			$(`:radio[name="gelang_identifikasi_pasien"][value="${item.gelang_identifikasi_pasien}"]`).prop("checked", true);
			$(`:radio[name="persetujuan_mrs_operasi"][value="${item.persetujuan_mrs_operasi}"]`).prop("checked", true);
			$(`:radio[name="lembar_observasi"][value="${item.lembar_observasi}"]`).prop("checked", true);
			$(`:text[name="konsul_dr_spesialis"]`).val(item.konsul_dr_spesialis);
			$(`:radio[name="pasang_infus"][value="${item.pasang_infus}"]`).prop("checked", true);
			$(`:checkbox[name="laboratorium_dl"]`).prop("checked", item.laboratorium_dl != null);
			$(`:checkbox[name="laboratorium_gda"]`).prop("checked", item.laboratorium_gda != null);
			$(`:checkbox[name="laboratorium_bjp"]`).prop("checked", item.laboratorium_bjp != null);
			$(`:checkbox[name="laboratorium_elektrolit"]`).prop("checked", item.laboratorium_elektrolit != null);
			$(`:checkbox[name="laboratorium_kk"]`).prop("checked", item.laboratorium_kk != null);
			$(`:checkbox[name="laboratorium_bga"]`).prop("checked", item.laboratorium_bga != null);
			$(`:text[name="lab_lainnya"]`).val(item.lab_lainnya);
			$(`:radio[name="ecg_posisi"][value="${item.ecg_posisi}"]`).prop("checked", true);
			$(`:radio[name="ecg_jenis"][value="${item.ecg_jenis}"]`).prop("checked", true);
			$(`:checkbox[name="radiologi_throax"]`).prop("checked", item.radiologi_throax != null);
			$(`:checkbox[name="radiologi_ct_scan"]`).prop("checked", item.radiologi_ct_scan != null);
			$(`:checkbox[name="radiologi_mri"]`).prop("checked", item.radiologi_mri != null);
			$(`:checkbox[name="radiologi_usg"]`).prop("checked", item.radiologi_usg != null);
			$(`:text[name="radiologi_lainnya"]`).val(item.radiologi_lainnya);
			$(`:text[name="kateter_ukuran"]`).val(item.kateter_ukuran);
			$(`:text[name="kateter_fiksasi"]`).val(item.kateter_fiksasi);
			$(`:text[name="kateter_up"]`).val(item.kateter_up);
			$(`:text[name="diet_oral"]`).val(item.diet_oral);
			$(`:text[name="diet_enteral"]`).val(item.diet_enteral);
			$(`:radio[name="diet_ngt_residu"][value="${item.diet_ngt_residu}"]`).prop("checked", true);
			$(`:text[name="diet_ngt_residu_volume"]`).val(item.diet_ngt_residu_volume);
			$(`:text[name="diet_ngt_residu_warna"]`).val(item.diet_ngt_residu_warna);
			$(`:text[name="diet_parenteral"]`).val(item.diet_parenteral);
			$(`:text[name="rawat_luka_luas_luka"]`).val(item.rawat_luka_luas_luka);
			$(`:text[name="rawat_luka_jumlah_luka"]`).val(item.rawat_luka_jumlah_luka);
			$(`:text[name="drainage"]`).val(item.drainage);
			$(`:text[name="jahit_luka_jenis_benang"]`).val(item.jahit_luka_jenis_benang);
			$(`:text[name="jahit_luka_jumlah"]`).val(item.jahit_luka_jumlah);

			obat_obatan_oral = item.obat_obatan_oral;
			if(obat_obatan_oral != null)
				obat_obatan_oral = obat_obatan_oral.split(',');

			obat_obatan_parenteral = item.obat_obatan_parenteral;
			if(obat_obatan_parenteral != null)
				obat_obatan_parenteral = obat_obatan_parenteral.split(',');


			$(`#obat_obatan_oral`).val(obat_obatan_oral).trigger('change');
			$(`#obat_obatan_parenteral`).val(obat_obatan_parenteral).trigger('change');
			$(`:checkbox[name="oksigen_jenis_nasale"]`).prop("checked", item.oksigen_jenis_nasale != null);
			$(`:checkbox[name="oksigen_jenis_masker"]`).prop("checked", item.oksigen_jenis_masker != null);
			$(`:checkbox[name="oksigen_jenis_jacson_race"]`).prop("checked", item.oksigen_jenis_jacson_race != null);
			$(`:text[name="oksigen_ukuran"]`).val(item.oksigen_ukuran);
			$(`:radio[name="derajat_transfer"][value="${item.derajat_transfer}"]`).prop("checked", true);
			$(`:checkbox[name="pendamping_transfer_pemandu"]`).prop("checked", item.pendamping_transfer_pemandu != null);
			$(`:checkbox[name="pendamping_transfer_perawat"]`).prop("checked", item.pendamping_transfer_perawat != null);
			$(`:checkbox[name="pendamping_transfer_dokter"]`).prop("checked", item.pendamping_transfer_dokter != null);
			$(`:checkbox[name="pendamping_transfer_dokter_spesialis"]`).prop("checked", item.pendamping_transfer_dokter_spesialis != null);
			$(`:radio[name="metode_transfer"][value="${item.metode_transfer}"]`).prop("checked", true);
			$(`:text[name="perawat_pasien_lanjutan_yang_masih_dilanjutkan"]`).val(item.perawat_pasien_lanjutan_yang_masih_dilanjutkan);
			$(`:text[name="monitoring_selama_transfer"]`).val(item.monitoring_selama_transfer);
			$(`:radio[name="tingkat_kesadaran_selama_transfer"][value="${item.tingkat_kesadaran_selama_transfer}"]`).prop("checked", true);
			$(`:text[name="gcs_selama_transfer"]`).val(item.gcs_selama_transfer);
			$(`:radio[name="kejadian_klinis_selama_transfer"][value="${item.kejadian_klinis_selama_transfer}"]`).prop("checked", true);$(`textarea[name="barang_pasien"]`).html(item.barang_pasien);
			$(`:text[name="keluarga_nama"]`).val(item.keluarga_nama);
			$(`:text[name="keluarga_no_hp"]`).val(item.keluarga_no_hp);
		}else{
			$("#id").val(0);
			
			$(`:text[name="dari_ruangan"]`).val("");
			$(`:text[name="ke_ruangan"]`).val("");
			$(`:radio[name="tingkat_kesadaran"]`).prop("checked", false);
			$(`:text[name="gcs"]`).val("");
			$(`:radio[name="keadaan_umum"]`).prop("checked", false);
			$(`:text[name="tanda_tanda_vital"]`).val("");
			$(`:text[name="tensi"]`).val("");
			$(`:text[name="suhu"]`).val("");
			$(`:text[name="ews"]`).val("");
			$(`:text[name="rr"]`).val("");
			$(`:text[name="djj"]`).val("");
			$(`:text[name="cvp"]`).val("");
			$(`:text[name="n"]`).val("");
			$(`:text[name="spo2"]`).val("");
			$(`:text[name="ttv_lain_lain"]`).val("");
			$(`:text[name="identifikasi_pasien"]`).val("");
			$(`:radio[name="gelang_identifikasi_pasien"]`).prop("checked", false);
			$(`:radio[name="persetujuan_mrs_operasi"]`).prop("checked", false);
			$(`:radio[name="lembar_observasi"]`).prop("checked", false);
			$(`:text[name="konsul_dr_spesialis"]`).val("");
			$(`:radio[name="pasang_infus"]`).prop("checked", false);
			$(`:checkbox[name="laboratorium_dl"]`).prop("checked", false);
			$(`:checkbox[name="laboratorium_gda"]`).prop("checked", false);
			$(`:checkbox[name="laboratorium_bjp"]`).prop("checked", false);
			$(`:checkbox[name="laboratorium_elektrolit"]`).prop("checked", false);
			$(`:checkbox[name="laboratorium_kk"]`).prop("checked", false);
			$(`:checkbox[name="laboratorium_bga"]`).prop("checked", false);
			$(`:text[name="lab_lainnya"]`).val("");
			$(`:radio[name="ecg_posisi"]`).prop("checked", false);
			$(`:radio[name="ecg_jenis"]`).prop("checked", false);
			$(`:checkbox[name="radiologi_throax"]`).prop("checked", false);
			$(`:checkbox[name="radiologi_ct_scan"]`).prop("checked", false);
			$(`:checkbox[name="radiologi_mri"]`).prop("checked", false);
			$(`:checkbox[name="radiologi_usg"]`).prop("checked", false);
			$(`:text[name="radiologi_lainnya"]`).val("");
			$(`:text[name="kateter_ukuran"]`).val("");
			$(`:text[name="kateter_fiksasi"]`).val("");
			$(`:text[name="kateter_up"]`).val("");
			$(`:text[name="diet_oral"]`).val("");
			$(`:text[name="diet_enteral"]`).val("");
			$(`:radio[name="diet_ngt_residu"]`).prop("checked", false);
			$(`:text[name="diet_ngt_residu_volume"]`).val("");
			$(`:text[name="diet_ngt_residu_warna"]`).val("");
			$(`:text[name="diet_parenteral"]`).val("");
			$(`:text[name="rawat_luka_luas_luka"]`).val("");
			$(`:text[name="rawat_luka_jumlah_luka"]`).val("");
			$(`:text[name="drainage"]`).val("");
			$(`:text[name="jahit_luka_jenis_benang"]`).val("");
			$(`:text[name="jahit_luka_jumlah"]`).val("");
			$(`#obat_obatan_oral`).val("").trigger('change');
			$(`#obat_obatan_parenteral`).val("").trigger('change');
			$(`:checkbox[name="oksigen_jenis_nasale"]`).prop("checked", false);
			$(`:checkbox[name="oksigen_jenis_masker"]`).prop("checked", false);
			$(`:checkbox[name="oksigen_jenis_jacson_race"]`).prop("checked", false);
			$(`:text[name="oksigen_ukuran"]`).val("");
			$(`:radio[name="derajat_transfer"]`).prop("checked", false);
			$(`:checkbox[name="pendamping_transfer_pemandu"]`).prop("checked", false);
			$(`:checkbox[name="pendamping_transfer_perawat"]`).prop("checked", false);
			$(`:checkbox[name="pendamping_transfer_dokter"]`).prop("checked", false);
			$(`:checkbox[name="pendamping_transfer_dokter_spesialis"]`).prop("checked", false);
			$(`:radio[name="metode_transfer"]`).prop("checked", false);
			$(`:text[name="perawat_pasien_lanjutan_yang_masih_dilanjutkan"]`).val("");
			$(`:text[name="monitoring_selama_transfer"]`).val("");
			$(`:radio[name="tingkat_kesadaran_selama_transfer"]`).prop("checked", false);
			$(`:text[name="gcs_selama_transfer"]`).val("");
			$(`:radio[name="kejadian_klinis_selama_transfer"]`).prop("checked", false);$(`textarea[name="barang_pasien"]`).html("");
			$(`:text[name="keluarga_nama"]`).val("");
			$(`:text[name="keluarga_no_hp"]`).val("");
		}
		$("#addModal").modal("toggle");
	});
</script>
@endsection