
	$(`:text[name="nama_wali"]`).val("");
	$(`:text[name="alamat_wali"]`).val("");
	$(`:text[name="telepon_wali"]`).val("");

	$(`#hubungan`).val("");
	$(`#hubungan`).select2().trigger("change");

	$(`#dokter`).val("");
	$(`#dokter`).select2().trigger("change");