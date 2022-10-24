<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $resume_medis))!!});

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
			@include("kasus.asesmen.resume-medis.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.asesmen.resume-medis.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var alasan_datang_indikasi_dirawat = item.alasan_datang_indikasi_dirawat ? item.alasan_datang_indikasi_dirawat : "-";
		var diagnosa_masuk = item.diagnosa_masuk ? item.diagnosa_masuk : "-";
		var diagnosa_utama = item.diagnosa_utama ? item.diagnosa_utama : "-";
		var diagnosa_tambahan = item.diagnosa_tambahan ? nl2br(item.diagnosa_tambahan) : "-";
		var pemeriksaan_fisik = item.pemeriksaan_fisik ? nl2br(item.pemeriksaan_fisik) : "-";
		var tindakan_prosedur_utama = item.tindakan_prosedur_utama ? item.tindakan_prosedur_utama : "-";
		var tindakan_prosedur_lain = item.tindakan_prosedur_lain ? nl2br(item.tindakan_prosedur_lain) : "-";
		var terapi_pengobatan_selama_di_rs = item.terapi_pengobatan_selama_di_rs ? nl2br(item.terapi_pengobatan_selama_di_rs) : "-";
		var terapi_pengobatan_setelah_pulang = item.terapi_pengobatan_setelah_pulang ? nl2br(item.terapi_pengobatan_setelah_pulang) : "-";
		var instruksi_tindak_lanjut_follow_up = item.instruksi_tindak_lanjut_follow_up ? nl2br(item.instruksi_tindak_lanjut_follow_up) : "-";
		var lanjutan_pengobatan = item.lanjutan_pengobatan ? item.lanjutan_pengobatan : "-";
		var lanjutan_pengobatan_di = item.lanjutan_pengobatan_di ? item.lanjutan_pengobatan_di : "-";
		var keadaan_keluar = item.keadaan_keluar ? item.keadaan_keluar : "-";
		var rujuk_ke = item.rujuk_ke ? item.rujuk_ke : "-";
		var cara_keluar = item.cara_keluar ? item.cara_keluar : "-";
		var alergi_tidak_ada_alergi = item.alergi_tidak_ada_alergi ? "✔️" : "-";
		var alergi_obat_obatan = item.alergi_obat_obatan ? "✔️" : "-";
		var alergi_makanan = item.alergi_makanan ? "✔️" : "-";
		var alergi_lainnya = item.alergi_lainnya ? "✔️" : "-";
		var keterangan_alergi = item.keterangan_alergi ? nl2br(item.keterangan_alergi) : "-";
		
		var hasil = `@include("kasus.asesmen.resume-medis.hasil")`;
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