	
	$(`:text[name="mulai_rawat_inap"]`).val(item.mulai_rawat_inap);
	$(`:text[name="selesai_rawat_inap"]`).val(item.selesai_rawat_inap);
	$(`:text[name="mulai_rawat_jalan"]`).val(item.mulai_rawat_jalan);
	$(`:text[name="selesai_rawat_jalan"]`).val(item.selesai_rawat_jalan);
	$(`:text[name="mulai_istirahat"]`).val(item.mulai_istirahat);
	$(`:text[name="selesai_istirahat"]`).val(item.selesai_istirahat);

	$(`:text[name="keperluan_surat"]`).val(item.keperluan_surat);
	$(`#select`).val(item.dokter_merawat);
	$(`#select`).select2().trigger("change");