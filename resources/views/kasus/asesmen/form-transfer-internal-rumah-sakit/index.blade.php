@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Form Transfer Internal Rumah Sakit - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Form Transfer Internal Rumah Sakit Baru</button>
						@endif
						
						<h4>Form Transfer Internal Rumah Sakit</h4>
						<hr>
						@php $count = count($form_transfer_internal_rumah_sakit) @endphp
						@forelse($form_transfer_internal_rumah_sakit as $item)

						@if($item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</button>
						@endif
						@if(session("my_role_".$kasus->nomor_kasus) && empty($item->terima_by))
								<button class="btn btn-primary mr-5 mb-5 pull-right terimaBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
									<i class="fa fa-forward"></i> Terima Pasien
								</button>
						@endif
							@if(session("my_role_".$kasus->nomor_kasus) && !empty($item->terima_by) && $item->terima_by == Auth::user()->id )
								<button class="btn btn-warning mr-5 mb-5 pull-right editTerimaBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
									<i class="fa fa-forward"></i> Edit Terima Pasien
								</button>
							@endif
						<a type="btn" href="{{url()->current()}}/print/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
							<i class="fa fa-print"></i>
						</a>
						<button  class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</button>
						<h5 class="mb-5 pl-5">#Form Transfer Internal Rumah Sakit {{$count}}</h5>
						<div class="row">
							<div class="col-6">
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
							</div>
							<div class="col-6">
								@if(!empty($item->terima_by))
								@if(!empty($item->penerima->avatar_thumb))
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
										<small class="text-muted">Diterima Oleh</small><br>
										{{$item->penerima->name}}<br>
										{{date("d F y, H:i", strtotime($item->terima_at))}}
									</h6>
								</div>
								@endif
							</div>
						</div>

						<hr class="my-20">
						@php $count-- @endphp
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Form Transfer Internal Rumah Sakit tersedia</h4>
							<p>Klik tombol <b>Form Transfer Internal Rumah Sakit Baru</b> untuk melakukan asesmen Form Transfer Internal Rumah Sakit</p>
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
@include("kasus.asesmen.form-transfer-internal-rumah-sakit.modal")
@include("kasus.asesmen.form-transfer-internal-rumah-sakit.modal-terima")
@include("kasus.asesmen.form-transfer-internal-rumah-sakit.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $form_transfer_internal_rumah_sakit))!!});
	var auth = {{Auth::user()->id}};

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
			@include("kasus.asesmen.form-transfer-internal-rumah-sakit.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.asesmen.form-transfer-internal-rumah-sakit.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

    $(".terimaBtn").click(function(e){
        id = $(this).data("id");
        $("#id-terima").val(id);
        $("#terima-by").val(auth);
        @include("kasus.asesmen.form-transfer-internal-rumah-sakit.js-form-create-terima")
        $("#addModalTerima").modal("toggle");
    });

    $(".editTerimaBtn").click(function(e){
        id = $(this).data("id");
        $("#id-terima").val(id);
        $("#terima-by").val("");
        @include("kasus.asesmen.form-transfer-internal-rumah-sakit.js-form-edit-terima")
        $("#addModalTerima").modal("toggle");
    });

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var tanggal_transfer = item.tanggal_transfer ? formatDate(item.tanggal_transfer) : "-";
		var alergi_obat = item.alergi_obat ? item.alergi_obat : "-";
		var ruangan_asal = item.ruangan_asal ? item.ruangan_asal : "-";
		var nama_perawat_pengirim = item.nama_perawat_pengirim ? item.nama_perawat_pengirim : "-";
		var jam_berangkat_dari_ruangan = item.jam_berangkat_dari_ruangan ? item.jam_berangkat_dari_ruangan : "-";
		var tekanan_darah_1 = item.tekanan_darah_1 ? item.tekanan_darah_1 : "-";
		var nadi_1 = item.nadi_1 ? item.nadi_1 : "-";
		var suhu_1 = item.suhu_1 ? item.suhu_1 : "-";
		var respirasi_1 = item.respirasi_1 ? item.respirasi_1 : "-";
		var gcs_e_1 = item.gcs_e_1 ? item.gcs_e_1 : "-";
		var gcs_v_1 = item.gcs_v_1 ? item.gcs_v_1 : "-";
		var gcs_m_1 = item.gcs_m_1 ? item.gcs_m_1 : "-";
		var gelisah_1 = item.gelisah_1 ? item.gelisah_1 : "-";
		var agresif_1 = item.agresif_1 ? item.agresif_1 : "-";
		var fiksasi_1 = item.fiksasi_1 ? item.fiksasi_1 : "-";
		var korban_pasung_1 = item.korban_pasung_1 ? item.korban_pasung_1 : "-";
		var indikasi_bunuh_diri_1 = item.indikasi_bunuh_diri_1 ? item.indikasi_bunuh_diri_1 : "-";
		var indikasi_jatuh_1 = item.indikasi_jatuh_1 ? item.indikasi_jatuh_1 : "-";
		var skala_nyeri_1 = item.skala_nyeri_1 ? item.skala_nyeri_1 : "-";
		var ruangan_tujuan = item.ruangan_tujuan ? item.ruangan_tujuan : "-";
		var nama_perawat_penerima = item.nama_perawat_penerima ? item.nama_perawat_penerima : "-";
		var jam_tiba_di_ruangan = item.jam_tiba_di_ruangan ? item.jam_tiba_di_ruangan : "-";
		var tekanan_darah_2 = item.tekanan_darah_2 ? item.tekanan_darah_2 : "-";
		var nadi_2 = item.nadi_2 ? item.nadi_2 : "-";
		var suhu_2 = item.suhu_2 ? item.suhu_2 : "-";
		var respirasi_2 = item.respirasi_2 ? item.respirasi_2 : "-";
		var gcs_e_2 = item.gcs_e_2 ? item.gcs_e_2 : "-";
		var gcs_v_2 = item.gcs_v_2 ? item.gcs_v_2 : "-";
		var gcs_m_2 = item.gcs_m_2 ? item.gcs_m_2 : "-";
		var gelisah_2 = item.gelisah_2 ? item.gelisah_2 : "-";
		var agresif_2 = item.agresif_2 ? item.agresif_2 : "-";
		var fiksasi_2 = item.fiksasi_2 ? item.fiksasi_2 : "-";
		var korban_pasung_2 = item.korban_pasung_2 ? item.korban_pasung_2 : "-";
		var indikasi_bunuh_diri_2 = item.indikasi_bunuh_diri_2 ? item.indikasi_bunuh_diri_2 : "-";
		var indikasi_jatuh_2 = item.indikasi_jatuh_2 ? item.indikasi_jatuh_2 : "-";
		var skala_nyeri_2 = item.skala_nyeri_2 ? item.skala_nyeri_2 : "-";
		var keterangan_khusus = item.keterangan_khusus ? nl2br(item.keterangan_khusus) : "-";
		var pemeriksaan_radiologi = item.pemeriksaan_radiologi ? "✔️" : "-";
		var pemeriksaan_laborat = item.pemeriksaan_laborat ? "✔️" : "-";
		var pemeriksaan_ekg = item.pemeriksaan_ekg ? "✔️" : "-";
		var pemeriksaan_eeg_bm = item.pemeriksaan_eeg_bm ? "✔️" : "-";
		var keterangan_radiologi = item.keterangan_radiologi ? item.keterangan_radiologi : "-";
		var keterangan_laborat = item.keterangan_laborat ? item.keterangan_laborat : "-";
		var keterangan_ekg = item.keterangan_ekg ? item.keterangan_ekg : "-";
		var keterangan_eeg = item.keterangan_eeg ? item.keterangan_eeg : "-";
		var hasil_pemeriksaan_keluar_radiologi = item.hasil_pemeriksaan_keluar_radiologi ? "✔️" : "-";
		var hasil_pemeriksaan_keluar_laborat = item.hasil_pemeriksaan_keluar_laborat ? "✔️" : "-";
		var hasil_pemeriksaan_keluar_ekg = item.hasil_pemeriksaan_keluar_ekg ? "✔️" : "-";
		var hasil_pemeriksaan_keluar_eeg_bm = item.hasil_pemeriksaan_keluar_eeg_bm ? "✔️" : "-";
		var obat_yang_dibawa = item.obat_yang_dibawa ? nl2br(item.obat_yang_dibawa) : "-";
		
		var hasil = `@include("kasus.asesmen.form-transfer-internal-rumah-sakit.hasil")`;
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