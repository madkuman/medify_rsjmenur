	
	$(`:text[name="nama_wali"]`).val(item.nama_wali);
	$(`:text[name="alamat_wali"]`).val(item.alamat);
	$(`:text[name="telepon_wali"]`).val(item.no_telp);
	$(`:text[name="ruangan_pasien"]`).val(item.ruangan);

	$(`#hubungan`).val(item.hubungan);
	$(`#hubungan`).select2().trigger("change");

	if(item.awal_kelas){
		$(`#awal_kelas`).val(item.awal_kelas.id);
		$(`#awal_kelas`).select2().trigger("change");
	}

	if(item.tujuan_kelas){
		$(`#tujuan_kelas`).val(item.tujuan_kelas.id);
		$(`#tujuan_kelas`).select2().trigger("change");
	}