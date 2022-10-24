	
	$(`:text[name="nama_wali"]`).val(item.nama_wali);
	$(`:text[name="alamat_wali"]`).val(item.alamat);
	$(`:text[name="telepon_wali"]`).val(item.no_telp);
	$(`:text[name="ruangan_pasien"]`).val(item.ruangan);

	$(`#hubungan`).val(item.hubungan);
	$(`#hubungan`).select2().trigger("change");

	$(`#dokter`).val(item.dokter_id);
	$(`#dokter`).select2().trigger("change");