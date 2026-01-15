@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Asesmen Pendidikan Pasien dan Keluarga - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right editBtn" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Asesmen Pendidikan Pasien dan Keluarga Baru</button>
						@endif
						
						<h4>Asesmen Pendidikan Pasien dan Keluarga</h4>
						<hr>
						@php $count = count($asesmen_pendidikan_pasien_dan_keluarga) @endphp
						@forelse($asesmen_pendidikan_pasien_dan_keluarga as $item)

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

						<button  class="btn btn-rounded btn-outline-success mr-5 mb-5 float-right lembarKomunikasi" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}" style="padding: 4px 14px; height: 30px;">
							<i class="fa fa-clipboard"></i> Lembar Komunikasi
						</button>

						<h5 class="mb-5 pl-5">#Asesmen Pendidikan Pasien dan Keluarga {{$count}}</h5>
						
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Asesmen Pendidikan Pasien dan Keluarga tersedia</h4>
							<p>Klik tombol <b>Asesmen Pendidikan Pasien dan Keluarga Baru</b> untuk melakukan asesmen Asesmen Pendidikan Pasien dan Keluarga</p>
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
<form method="POST" action="{{url()->current()}}/lembar/delete" id="formGrafikDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputGrafikId">
</form>
@include("kasus.asesmen.asesmen-pendidikan-pasien-dan-keluarga.modal")
@include("kasus.asesmen.asesmen-pendidikan-pasien-dan-keluarga.modal-lembar-komunikasi")
@include("kasus.asesmen.asesmen-pendidikan-pasien-dan-keluarga.modal-hasil")
@endsection

@section("js")
<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $asesmen_pendidikan_pasien_dan_keluarga))!!});

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
			@include("kasus.asesmen.asesmen-pendidikan-pasien-dan-keluarga.js-form-edit");
		} else {
			$("#id").val(0);
			@include("kasus.asesmen.asesmen-pendidikan-pasien-dan-keluarga.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".lembarKomunikasi").click(function(e){
		$('.refreshRow').remove();
		id = $(this).data("id");
		var item = data[$(this).data("index")];
		if(item != "" && item != undefined){
			$("#id").val(item.id);
			@include("kasus.asesmen.asesmen-pendidikan-pasien-dan-keluarga.js-lembar-komunikasi")
		}
		$("#lembarKomunikasiModal").modal("toggle");

		$(".deleteGrafikBtn").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$("#deleteInputGrafikId").val(id);
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
					$("#formGrafikDelete").submit();
				}
			});
		});
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		// console.log(item.hambatan);
		
		var agama_pasien = item.agama_pasien ? item.agama_pasien : "-";
		var keyakinan_pasien_pantangan_pemeriksaan_hari_tertentu = item.keyakinan_pasien_pantangan_pemeriksaan_hari_tertentu ? "✔️" : "-";
		var keyakinan_pasien_pantangan_masuk_keluar_rs_hari_tertentu = item.keyakinan_pasien_pantangan_masuk_keluar_rs_hari_tertentu ? "✔️" : "-";
		var keyakinan_pasien_hanya_ingin_dilayani_sesama_jenis = item.keyakinan_pasien_hanya_ingin_dilayani_sesama_jenis ? "✔️" : "-";
		var keyakinan_pasien_pantangan_nomor_tertentu_yang_dihindari = item.keyakinan_pasien_pantangan_nomor_tertentu_yang_dihindari ? "✔️" : "-";
		var keterangan_untuk_nilai_dan_keyakinan_pasien = item.keterangan_untuk_nilai_dan_keyakinan_pasien ? item.keterangan_untuk_nilai_dan_keyakinan_pasien : "-";
		var pendidikan_pasien_sd = item.pendidikan_pasien_sd ? "✔️" : "-";
		var pendidikan_pasien_smp = item.pendidikan_pasien_smp ? "✔️" : "-";
		var pendidikan_pasien_sma = item.pendidikan_pasien_sma ? "✔️" : "-";
		var pendidikan_pasien_perguruan_tinggi = item.pendidikan_pasien_perguruan_tinggi ? "✔️" : "-";
		var pendidikan_pasien_tidak_sekolah = item.pendidikan_pasien_tidak_sekolah ? "✔️" : "-";
		var pendidikan_pasien_lain_lain = item.pendidikan_pasien_lain_lain ? "✔️" : "-";
		var bahasa_yang_digunakan_pasien_indonesia = item.bahasa_yang_digunakan_pasien_indonesia ? "✔️" : "-";
		var bahasa_yang_digunakan_pasien_isyarat = item.bahasa_yang_digunakan_pasien_isyarat ? "✔️" : "-";
		var bahasa_yang_digunakan_pasien_lain_lain = item.bahasa_yang_digunakan_pasien_lain_lain ? "✔️" : "-";
		var keterbatasan_pasien_tuli = item.keterbatasan_pasien_tuli ? "✔️" : "-";
		var keterbatasan_pasien_bisu = item.keterbatasan_pasien_bisu ? "✔️" : "-";
		var keterbatasan_pasien_kooperatif = item.keterbatasan_pasien_kooperatif ? "✔️" : "-";
		var keterbatasan_pasien_perlu_kursi_roda = item.keterbatasan_pasien_perlu_kursi_roda ? "✔️" : "-";
		var keterbatasan_pasien_hidup_dalam_pikirannya_sendiri = item.keterbatasan_pasien_hidup_dalam_pikirannya_sendiri ? "✔️" : "-";
		var keterbatasan_pasien_tidak_ada_keterbatasan_fisik = item.keterbatasan_pasien_tidak_ada_keterbatasan_fisik ? "✔️" : "-";
		var keterbatasan_pasien_tampak_mutualisme_atau_negativistic = item.keterbatasan_pasien_tampak_mutualisme_atau_negativistic ? "✔️" : "-";
		var keterbatasan_pasien_mampu_berdiskusi = item.keterbatasan_pasien_mampu_berdiskusi ? "✔️" : "-";
		var emosi_motivasi_pasien_tenang = item.emosi_motivasi_pasien_tenang ? "✔️" : "-";
		var emosi_motivasi_pasien_labil = item.emosi_motivasi_pasien_labil ? "✔️" : "-";
		var emosi_motivasi_pasien_tampak_acuh = item.emosi_motivasi_pasien_tampak_acuh ? "✔️" : "-";
		var emosi_motivasi_pasien_belum_mampu_diajak_komunikasi = item.emosi_motivasi_pasien_belum_mampu_diajak_komunikasi ? "✔️" : "-";
		var emosi_motivasi_pasien_tampak_agresif = item.emosi_motivasi_pasien_tampak_agresif ? "✔️" : "-";
		var emosi_motivasi_pasien_mampu_komunikasi = item.emosi_motivasi_pasien_mampu_komunikasi ? "✔️" : "-";
		var kesediaan_pasien_bersedia_diberi_informasi = item.kesediaan_pasien_bersedia_diberi_informasi ? "✔️" : "-";
		var kesediaan_pasien_mampu_menerima_informasi = item.kesediaan_pasien_mampu_menerima_informasi ? "✔️" : "-";
		var kesediaan_pasien_belum_mampu_menerima_informasi = item.kesediaan_pasien_belum_mampu_menerima_informasi ? "✔️" : "-";
		var kesediaan_pasien_tidak_bersedia_diberi_informasi = item.kesediaan_pasien_tidak_bersedia_diberi_informasi ? "✔️" : "-";
		var hubungan_dengan_pasien = item.hubungan_dengan_pasien ? item.hubungan_dengan_pasien : "-";
		var keyakinan_keluarga_pantangan_pemeriksaan_hari_tertentu = item.keyakinan_keluarga_pantangan_pemeriksaan_hari_tertentu ? "✔️" : "-";
		var keyakinan_keluarga_pantangan_masuk_keluar_rs_hari_tertentu = item.keyakinan_keluarga_pantangan_masuk_keluar_rs_hari_tertentu ? "✔️" : "-";
		var keyakinan_keluarga_hanya_ingin_dilayani_sesama_jenis = item.keyakinan_keluarga_hanya_ingin_dilayani_sesama_jenis ? "✔️" : "-";
		var keyakinan_keluarga_pantangan_nomor_tertentu_yang_dihindari = item.keyakinan_keluarga_pantangan_nomor_tertentu_yang_dihindari ? "✔️" : "-";
		var keterangan_untuk_nilai_dan_keyakinan_keluarga = item.keterangan_untuk_nilai_dan_keyakinan_keluarga ? item.keterangan_untuk_nilai_dan_keyakinan_keluarga : "-";
		var pendidikan_keluarga_sd = item.pendidikan_keluarga_sd ? "✔️" : "-";
		var pendidikan_keluarga_smp = item.pendidikan_keluarga_smp ? "✔️" : "-";
		var pendidikan_keluarga_sma = item.pendidikan_keluarga_sma ? "✔️" : "-";
		var pendidikan_keluarga_perguruan_tinggi = item.pendidikan_keluarga_perguruan_tinggi ? "✔️" : "-";
		var pendidikan_keluarga_tidak_sekolah = item.pendidikan_keluarga_tidak_sekolah ? "✔️" : "-";
		var pendidikan_keluarga_lain_lain = item.pendidikan_keluarga_lain_lain ? "✔️" : "-";
		var bahasa_keluarga_indonesia = item.bahasa_keluarga_indonesia ? "✔️" : "-";
		var bahasa_keluarga_isyarat = item.bahasa_keluarga_isyarat ? "✔️" : "-";
		var bahasa_keluarga_lain_lain = item.bahasa_keluarga_lain_lain ? "✔️" : "-";
		var keterbatasan_keluarga_tuli = item.keterbatasan_keluarga_tuli ? "✔️" : "-";
		var keterbatasan_keluarga_bisu = item.keterbatasan_keluarga_bisu ? "✔️" : "-";
		var keterbatasan_keluarga_kooperatif = item.keterbatasan_keluarga_kooperatif ? "✔️" : "-";
		var keterbatasan_keluarga_perlu_kursi_roda = item.keterbatasan_keluarga_perlu_kursi_roda ? "✔️" : "-";
		var keterbatasan_keluarga_tidak_ada_keterbatasan_fisik = item.keterbatasan_keluarga_tidak_ada_keterbatasan_fisik ? "✔️" : "-";
		var keterbatasan_keluarga_mampu_berdiskusi = item.keterbatasan_keluarga_mampu_berdiskusi ? "✔️" : "-";
		var keterbatasan_keluarga_lain_lain = item.keterbatasan_keluarga_lain_lain ? "✔️" : "-";
		var emosi_motivasi_keluarga_tenang = item.emosi_motivasi_keluarga_tenang ? "✔️" : "-";
		var emosi_motivasi_keluarga_labil = item.emosi_motivasi_keluarga_labil ? "✔️" : "-";
		var emosi_motivasi_keluarga_tampak_acuh = item.emosi_motivasi_keluarga_tampak_acuh ? "✔️" : "-";
		var emosi_motivasi_keluarga_belum_mampu_diajak_komunikasi = item.emosi_motivasi_keluarga_belum_mampu_diajak_komunikasi ? "✔️" : "-";
		var emosi_motivasi_keluarga_mampu_komunikasi = item.emosi_motivasi_keluarga_mampu_komunikasi ? "✔️" : "-";
		var kesediaan_keluarga_bersedia_diberi_informasi = item.kesediaan_keluarga_bersedia_diberi_informasi ? "✔️" : "-";
		var kesediaan_keluarga_mampu_menerima_informasi = item.kesediaan_keluarga_mampu_menerima_informasi ? "✔️" : "-";
		var kesediaan_keluarga_tidak_bersedia_diberi_informasi = item.kesediaan_keluarga_tidak_bersedia_diberi_informasi ? "✔️" : "-";
		var edukasi_pasien_penyakit_yang_diderita = item.edukasi_pasien_penyakit_yang_diderita ? "✔️" : "-";
		var edukasi_pasien_teknik_rehabilitasi_terapi_kerja_latihan_asertif = item.edukasi_pasien_teknik_rehabilitasi_terapi_kerja_latihan_asertif ? "✔️" : "-";
		var edukasi_pasien_tindakan_keperawatan_fiksasi_tak_dll = item.edukasi_pasien_tindakan_keperawatan_fiksasi_tak_dll ? "✔️" : "-";
		var edukasi_pasien_tindakan_medis_ect_konvensional_dll = item.edukasi_pasien_tindakan_medis_ect_konvensional_dll ? "✔️" : "-";
		var edukasi_pasien_pemeriksaan_penunjang_lab_rontgen_dll = item.edukasi_pasien_pemeriksaan_penunjang_lab_rontgen_dll ? "✔️" : "-";
		var masalah_keperawatan = item.masalah_keperawatan ? item.masalah_keperawatan : "-";
		var rencana_edukasi_pasien_tanggal = item.rencana_edukasi_pasien_tanggal ? formatDate(item.rencana_edukasi_pasien_tanggal) : "-";
		var kebutuhan_edukasi_keluarga_obat_yang_dikonsumsi = item.kebutuhan_edukasi_keluarga_obat_yang_dikonsumsi ? "✔️" : "-";
		var kebutuhan_edukasi_keluarga_managemen_nyeri = item.kebutuhan_edukasi_keluarga_managemen_nyeri ? "✔️" : "-";
		var kebutuhan_edukasi_keluarga_diet_dan_nutrisi = item.kebutuhan_edukasi_keluarga_diet_dan_nutrisi ? "✔️" : "-";
		var kebutuhan_edukasi_keluarga_cuci_tangan = item.kebutuhan_edukasi_keluarga_cuci_tangan ? "✔️" : "-";
		var kebutuhan_edukasi_keluarga_inform_consent = item.kebutuhan_edukasi_keluarga_inform_consent ? "✔️" : "-";
		var kebutuhan_edukasi_keluarga_general_consent = item.kebutuhan_edukasi_keluarga_general_consent ? "✔️" : "-";
		var rencana_edukasi_keluarga_tanggal = item.rencana_edukasi_keluarga_tanggal ? formatDate(item.rencana_edukasi_keluarga_tanggal) : "-";
		var agama_keluarga_pasien = item.agama_keluarga_pasien ? item.agama_keluarga_pasien : "-";

		if (item.hambatan != null) {
			var data_hambatan = item.hambatan.split(",");
			var data_hambatan2 = [];
			$.each(data_hambatan,function(i, value){
				var value = value.trim();
				data_hambatan2.push(value);
			});
			var hambatan_pendengaran = data_hambatan2.includes("Pendengaran") ? munculkanHambatan("Pendengaran") : "-";
			var hambatan_penglihatan = data_hambatan2.includes("Penglihatan") ? munculkanHambatan("Penglihatan") : "-";
			var hambatan_kognitif = data_hambatan2.includes("Kognitif") ? munculkanHambatan("Kognitif"): "-";
			var hambatan_Fisik = data_hambatan2.includes("Fisik") ? munculkanHambatan("Fisik") : "-";
			var hambatan_Budaya = data_hambatan2.includes("Budaya") ? munculkanHambatan("Budaya") : "-";
			var hambatan_Agama = data_hambatan2.includes("Agama") ? munculkanHambatan("Agama") : "-";
			var hambatan_Emosi = data_hambatan2.includes("Emosi") ? munculkanHambatan("Emosi") : "-";
			var hambatan_Bahasa = data_hambatan2.includes("Bahasa") ? munculkanHambatan("Bahasa") : "-";
			function munculkanHambatan(string){
				index = data_hambatan2.findIndex(item => item == string);
				data_hambatan2.splice(index, 1);  
				return "✔️";
			};
			var hambatan_lain = data_hambatan2.join( );
		} else {
			var hambatan_pendengaran =  "-";
			var hambatan_penglihatan =  "-";
			var hambatan_kognitif = "-";
			var hambatan_Fisik =  "-";
			var hambatan_Budaya = "-";
			var hambatan_Agama = "-";
			var hambatan_Emosi = "-";
			var hambatan_Bahasa ="-";
			var hambatan_lain = "-";
		}
		var penerjemah = item.penerjemah ?? '-';
	
		if (item.pembelajaran !=null) {		
			var data_pembelajaran = item.pembelajaran.split(",");
			var data_pembelajaran2 = [];
			$.each(data_pembelajaran,function(i, value2){
				var value2 = value2.trim();
				data_pembelajaran2.push(value2);
			});
			var kebutuhan_diagnosa = data_pembelajaran2.includes("Diagnosa & Manajemen") ? munculkanKebutuhan("Diagnosa & Manajemen"): "-";
			var kebutuhan_manajemen = data_pembelajaran2.includes("Manajemen Nyeri") ? munculkanKebutuhan("Manajemen Nyeri"): "-";
			var kebutuhan_obat = data_pembelajaran2.includes("Obat-obatan") ? munculkanKebutuhan("Obat-obatan"): "-";
			var kebutuhan_diet = data_pembelajaran2.includes("Diet dan Nutrisi") ? munculkanKebutuhan("Diet dan Nutrisi"): "-";
			var kebutuhan_perawatan = data_pembelajaran2.includes("Perawatan Luka") ? munculkanKebutuhan("Perawatan Luka"): "-";
			var kebutuhan_rehabilitas = data_pembelajaran2.includes("Rehabilitas") ? munculkanKebutuhan("Rehabilitas"): "-";
			function munculkanKebutuhan(string){
				index = data_pembelajaran2.findIndex(item => item == string);
				data_pembelajaran2.splice(index, 1);  
				return "✔️";
			};
			var kebutuhan_lain = data_pembelajaran2.join( );
		} else {
			var kebutuhan_diagnosa =  "-";
			var kebutuhan_manajemen =  "-";
			var kebutuhan_obat =  "-";
			var kebutuhan_diet = "-";
			var kebutuhan_perawatan = "-";
			var kebutuhan_rehabilitas = "-";
			var kebutuhan_lain = "-";
		};
		
		var hasil = `@include("kasus.asesmen.asesmen-pendidikan-pasien-dan-keluarga.hasil")`;
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