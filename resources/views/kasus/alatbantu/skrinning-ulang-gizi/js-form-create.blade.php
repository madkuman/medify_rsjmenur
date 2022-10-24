
	$(`:text[name="tanggal"]`).val("");
	$(`:text[name="jam"]`).val("");
	$(`:text[name="ruangan"]`).val("");
	$(`:text[name="dx_medis"]`).val("");
	$(`:text[name="tinggi_badan"]`).val("");
	$(`:text[name="berat_badan"]`).val("");
	$(`:text[name="imt"]`).val("");
	$(`:text[name="imtu"]`).val("");
	$(`:radio[name="asupan_nutrisi"]`).prop("checked", false);
	$(`:radio[name="status_gizi"]`).prop("checked", false);
	$(`:radio[name="pasien_dengan_kondisi_khusus"]`).prop("checked", false);

	$(`:text[name="sebutkan_pasien_dengan_kondisi_khusus"]`).val("");