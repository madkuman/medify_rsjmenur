
	$(`:text[name="nama"]`).val("");
	$(`:text[name="alamat"]`).val("");
	$(`:text[name="telepon"]`).val("");
	$(`:text[name="hubungan_dengan_pasien"]`).val("");
	$(`#pasien_telah_dinyatakan`).val("");
	$(`#pasien_telah_dinyatakan`).select2().trigger("change");
	$(`:text[name="rujuk_ke"]`).val("");