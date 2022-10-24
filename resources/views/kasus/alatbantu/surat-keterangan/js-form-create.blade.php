
	$(`:text[name="mulai_rawat_inap"]`).val("");
	$(`:text[name="selesai_rawat_inap"]`).val("");
	$(`:text[name="mulai_rawat_jalan"]`).val("");
	$(`:text[name="selesai_rawat_jalan"]`).val("");
	$(`:text[name="mulai_istirahat"]`).val("");
	$(`:text[name="selesai_istirahat"]`).val("");

	$(`:text[name="keperluan_surat"]`).val("");
	$(`#select`).val("");
	$(`#select`).select2().trigger("change");