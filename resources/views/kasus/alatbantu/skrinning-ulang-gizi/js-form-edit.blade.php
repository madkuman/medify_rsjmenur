
	$(`:text[name="tanggal"]`).val(formatDate(item.tanggal));
	$(`:text[name="jam"]`).val(item.jam);
	$(`:text[name="ruangan"]`).val(item.ruangan);
	$(`:text[name="dx_medis"]`).val(item.dx_medis);
	$(`:text[name="tinggi_badan"]`).val(item.tinggi_badan);
	$(`:text[name="berat_badan"]`).val(item.berat_badan);
	$(`:text[name="imt"]`).val(item.imt);
	$(`:text[name="imtu"]`).val(item.imtu);
	
	$(`:radio[name="asupan_nutrisi"][value="${item.asupan_nutrisi}"]`).prop("checked", true);
	$(`:radio[name="status_gizi"][value="${item.status_gizi}"]`).prop("checked", true);
	$(`:radio[name="pasien_dengan_kondisi_khusus"][value="${item.pasien_dengan_kondisi_khusus}"]`).prop("checked", true);

	$(`:text[name="sebutkan_pasien_dengan_kondisi_khusus"]`).val(item.sebutkan_pasien_dengan_kondisi_khusus);