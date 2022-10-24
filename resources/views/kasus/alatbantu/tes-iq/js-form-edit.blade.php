
	$(`:text[name="tanggal_pemeriksaan"]`).val(formatDate(item.tanggal_pemeriksaan));
	$(`:text[name="tujuan_tes"]`).val(item.tujuan_tes);
	$(`:text[name="rujukan_dari"]`).val(item.rujukan_dari);
	$(`:radio[name="kecerdasan_umum"][value="${item.kecerdasan_umum}"]`).prop("checked", true);
	$(`:radio[name="fleksibilitas_berpikir"][value="${item.fleksibilitas_berpikir}"]`).prop("checked", true);
	$(`:radio[name="analisa_sintesa"][value="${item.analisa_sintesa}"]`).prop("checked", true);
	$(`:radio[name="berpikir_konseptual"][value="${item.berpikir_konseptual}"]`).prop("checked", true);
	$(`textarea[name="kesimpulan"]`).val(item.kesimpulan);
	$(`:text[name="kemampuan_intelektual"]`).val(item.kemampuan_intelektual);