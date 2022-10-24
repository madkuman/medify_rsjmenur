<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $resume_gawat_darurat))!!});

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
			@include("kasus.asesmen.resume-gawat-darurat.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.asesmen.resume-gawat-darurat.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var pulang = item.pulang ? item.pulang : "-";
		var kontrol_ulang_tanggal = item.kontrol_ulang_tanggal ? formatDate(item.kontrol_ulang_tanggal) : "-";
		var kontrol_ulang_di = item.kontrol_ulang_di ? item.kontrol_ulang_di : "-";
		var pulang_atas_permintaan_keluarga = item.pulang_atas_permintaan_keluarga ? item.pulang_atas_permintaan_keluarga : "-";
		var observasi = item.observasi ? item.observasi : "-";
		var pulang_jam = item.pulang_jam ? item.pulang_jam : "-";
		var mrs = item.mrs ? item.mrs : "-";
		var alasan_menolak_mrs_masalah_biaya = item.alasan_menolak_mrs_masalah_biaya ? "✔️" : "-";
		var alasan_menolak_mrs_masalah_lokasi_rumah = item.alasan_menolak_mrs_masalah_lokasi_rumah ? "✔️" : "-";
		var alasan_menolak_mrs_masalah_kondisi_pasien = item.alasan_menolak_mrs_masalah_kondisi_pasien ? "✔️" : "-";
		var alasan_lainnya = item.alasan_lainnya ? item.alasan_lainnya : "-";
		var dirawat_di_ruang = item.dirawat_di_ruang ? item.dirawat_di_ruang : "-";
		var dirujuk = item.dirujuk ? item.dirujuk : "-";
		var alasan_dirujuk_tempat_penuh = item.alasan_dirujuk_tempat_penuh ? "✔️" : "-";
		var alasan_dirujuk_perlu_fasilitas_lebih = item.alasan_dirujuk_perlu_fasilitas_lebih ? "✔️" : "-";
		var alasan_dirujuk_permintaan_pasien_dan_keluarga = item.alasan_dirujuk_permintaan_pasien_dan_keluarga ? "✔️" : "-";
		var alasan_lain = item.alasan_lain ? item.alasan_lain : "-";
		var alergi = item.alergi ? item.alergi : "-";
		var risiko = item.risiko ? item.risiko : "-";
		
		var hasil = `@include("kasus.asesmen.resume-gawat-darurat.hasil")`;
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