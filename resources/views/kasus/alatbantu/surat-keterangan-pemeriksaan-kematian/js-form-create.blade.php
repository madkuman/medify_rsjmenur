
	$(`:text[name="hari"]`).val("");
	$(`:text[name="tanggal"]`).val("");
	$(`:text[name="pukul"]`).val("");
	$(`#dokter_yang_memeriksa`).val("");
	$(`#dokter_yang_memeriksa`).select2().trigger("change");
	$(`:text[name="persangkaan_kematian"]`).val("");