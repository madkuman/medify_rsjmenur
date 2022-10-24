
	$(`:text[name="nama_wali"]`).val("");
	$(`:text[name="alamat_wali"]`).val("");
	$(`:text[name="telepon_wali"]`).val("");
	$(`:text[name="ruangan_pasien"]`).val("");

	$(`#hubungan`).val("");
	$(`#hubungan`).select2().trigger("change");

	$(`#awal_kelas`).val("");
	$(`#awal_kelas`).select2().trigger("change");

	$(`#tujuan_kelas`).val("");
	$(`#tujuan_kelas`).select2().trigger("change");