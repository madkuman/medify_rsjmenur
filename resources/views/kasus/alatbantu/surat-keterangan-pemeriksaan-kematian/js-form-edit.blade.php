
	$(`:text[name="hari"]`).val(item.hari);
	$(`:text[name="tanggal"]`).val(formatDate(item.tanggal));
	$(`:text[name="pukul"]`).val(item.pukul);
	$(`#dokter_yang_memeriksa`).val(item.dokter_yang_memeriksa);
	$(`#dokter_yang_memeriksa`).select2().trigger("change");
	$(`:text[name="persangkaan_kematian"]`).val(item.persangkaan_kematian);