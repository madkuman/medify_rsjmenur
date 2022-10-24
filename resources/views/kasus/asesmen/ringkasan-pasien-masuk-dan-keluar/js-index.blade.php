<script src="{{url("")}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $ringkasan_pasien_masuk_dan_keluar))!!});

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
			@include("kasus.asesmen.ringkasan-pasien-masuk-dan-keluar.js-form-edit")
		} else {
			$("#id").val(0);
			@include("kasus.asesmen.ringkasan-pasien-masuk-dan-keluar.js-form-create")
		}
		$("#addModal").modal("toggle");
	});

	$(".showBtn").click(function(e){
		id = $(this).data("id");

		var item = data[$(this).data("index")];
		var dirawat_yang_ke = item.dirawat_yang_ke ? item.dirawat_yang_ke : "-";
		var ruang = item.ruang ? item.ruang : "-";
		var pindah_ruang_ke = item.pindah_ruang_ke ? item.pindah_ruang_ke : "-";
		var kelas = item.kelas ? item.kelas : "-";
		var pindah_kelas_ke = item.pindah_kelas_ke ? item.pindah_kelas_ke : "-";
		var pengirim_rujukan = item.pengirim_rujukan ? item.pengirim_rujukan : "-";
		var nama_pengirim_rujukan = item.nama_pengirim_rujukan ? item.nama_pengirim_rujukan : "-";
		var kasus_visum = item.kasus_visum ? item.kasus_visum : "-";
		var dpjp = item.dpjp ? item.dpjp : "-";
		var case_manager = item.case_manager ? item.case_manager : "-";
		var lama_dirawat = item.lama_dirawat ? item.lama_dirawat : "-";
		var diagnosa_masuk = item.diagnosa_masuk ? item.diagnosa_masuk : "-";
		var diagnosa_masuk_tambahan = item.diagnosa_masuk_tambahan ? nl2br(item.diagnosa_masuk_tambahan) : "-";
		var diagnosa_keluar = item.diagnosa_keluar ? item.diagnosa_keluar : "-";
		var diagnosa_keluar_tambahan = item.diagnosa_keluar_tambahan ? nl2br(item.diagnosa_keluar_tambahan) : "-";
		var tindakan_yang_dilakukan = item.tindakan_yang_dilakukan ? nl2br(item.tindakan_yang_dilakukan) : "-";
		var keadaan_keluar = item.keadaan_keluar ? item.keadaan_keluar : "-";
		var rujuk_ke = item.rujuk_ke ? item.rujuk_ke : "-";
		var cara_keluar = item.cara_keluar ? item.cara_keluar : "-";
		var alergi_tidak_ada_alergi = item.alergi_tidak_ada_alergi ? "✔️" : "-";
		var alergi_obat_obatan = item.alergi_obat_obatan ? "✔️" : "-";
		var alergi_makanan = item.alergi_makanan ? "✔️" : "-";
		var alergi_lainnya = item.alergi_lainnya ? "✔️" : "-";
		var keterangan_alergi = item.keterangan_alergi ? nl2br(item.keterangan_alergi) : "-";
		
		var hasil = `@include("kasus.asesmen.ringkasan-pasien-masuk-dan-keluar.hasil")`;
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