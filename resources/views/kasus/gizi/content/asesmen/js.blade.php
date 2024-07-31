<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $asesmen))!!});

	$(".verifBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$('#asesmenId').val(id);
		swal({
			title: "Verifikasi",
			text: "Apakah anda yakin akan memverifikasi data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: 'warning',
			confirmButtonClass: "btn btn-success",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Ya",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$('#asesmenFormVerif').submit();
			}
		});
	});

	$(".asesmenDeleteBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$('#asesmenId').val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: 'warning',
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
            $('#asesmenDeleteInputId').val(id);
				$('#asesmenFormDelete').submit();
			}
		});
	});

	$('#asesmen_tindak_lanjut').on('change', function() {
		if ($('#asesmen_tindak_lanjut').val() == 'Perlu Asuhan Gizi') {
			$('#asesmen_tindak_lanjut_true').show();
		}
		else{
			$('#asesmen_tindak_lanjut_true').hide();
		}
	});

	$(".editBtn").click(function(e){
		id = $(this).data("id");
		var item_raw = data[$(this).data("index")];
		if (item_raw != "" && item_raw != undefined) {
			var item = JSON.parse(item_raw.val) 
			$("#id").val(item_raw.id);
			$(`select[name="resiko_malnutrisi"]`).val(item.resiko_malnutrisi);
			$(`select[name="preskripsi_diet"]`).val(item.preskripsi_diet);
			$(`select[name="tindak_lanjut"]`).val(item.tindak_lanjut);
			$(`:checkbox[name="kondisi_khusus"]`).prop("checked", item.kondisi_khusus != null);
			$(`:checkbox[name="alergi_telur"]`).prop("checked", item.alergi_telur != null);
			$(`:checkbox[name="alergi_susu"]`).prop("checked", item.alergi_susu != null);
			$(`:checkbox[name="alergi_kacang"]`).prop("checked", item.alergi_kacang != null);
			$(`:checkbox[name="alergi_ikan"]`).prop("checked", item.alergi_ikan != null);
			$(`:checkbox[name="alergi_gluten"]`).prop("checked", item.alergi_gluten != null);
			$(`:text[name="alergi_lain"]`).val(item.alergi_lain);
			$(`textarea[name="preskripsi_diet_isi"]`).val(item.preskripsi_diet_isi);
			$(`textarea[name="riwayat_gizi"]`).val(item.riwayat_gizi);
			$(`textarea[name="data_antropometri"]`).val(item.data_antropometri);
			$(`textarea[name="data_biokimia"]`).val(item.data_biokimia);
			$(`textarea[name="data_fisik"]`).val(item.data_fisik);
			$(`textarea[name="riwayat_personal"]`).val(item.riwayat_personal);
			$(`textarea[name="diagnosis_gizi"]`).val(item.diagnosis_gizi);
			$(`textarea[name="intervensi"]`).val(item.intervensi);
			$(`textarea[name="tujuan"]`).val(item.tujuan);
			$(`textarea[name="preskripsi_diet"]`).val(item.preskripsi_diet);
			$(`textarea[name="pemesanan_diet"]`).val(item.pemesanan_diet);
			$(`textarea[name="edukasi_konseling"]`).val(item.edukasi_konseling);
			$(`textarea[name="kolaborasi_pelayanan"]`).val(item.kolaborasi_pelayanan);
			$(`textarea[name="monitoring"]`).val(item.monitoring);

			if (item.tindak_lanjut == 'Perlu Asuhan Gizi') {
				$(`#asesmen_tindak_lanjut_true`).show();
			}else{
				$(`#asesmen_tindak_lanjut_true`).hide();
			}

		} else {
			$("#id").val(0);
			$(`select[name="resiko_malnutrisi"]`).val("Tidak Beresiko");
			$(`select[name="preskripsi_diet"]`).val("Makanan Biasa");
			$(`select[name="tindak_lanjut"]`).val("Belum Perlu Asuhan Gizi");
			$(`:checkbox[name="kondisi_khusus"]`).prop("checked", false);
			$(`:checkbox[name="alergi_telur"]`).prop("checked", false);
			$(`:checkbox[name="alergi_susu"]`).prop("checked", false);
			$(`:checkbox[name="alergi_kacang"]`).prop("checked", false);
			$(`:checkbox[name="alergi_ikan"]`).prop("checked", false);
			$(`:checkbox[name="alergi_gluten"]`).prop("checked", false);
			$(`:text[name="alergi_lain"]`).val("");
			$(`textarea[name="preskripsi_diet_isi"]`).val("");
			$(`textarea[name="riwayat_gizi"]`).val("");
			$(`textarea[name="data_antropometri"]`).val("");
			$(`textarea[name="data_biokimia"]`).val("");
			$(`textarea[name="data_fisik"]`).val("");
			$(`textarea[name="riwayat_personal"]`).val("");
			$(`textarea[name="diagnosis_gizi"]`).val("");
			$(`textarea[name="intervensi"]`).val("");
			$(`textarea[name="tujuan"]`).val("");
			$(`textarea[name="preskripsi_diet"]`).val("");
			$(`textarea[name="pemesanan_diet"]`).val("");
			$(`textarea[name="edukasi_konseling"]`).val("");
			$(`textarea[name="kolaborasi_pelayanan"]`).val("");
			$(`textarea[name="monitoring"]`).val("");

			$(`#asesmen_tindak_lanjut_true`).hide();

		}
		$("#asesmenAddModal").modal("toggle");
	});

</script>