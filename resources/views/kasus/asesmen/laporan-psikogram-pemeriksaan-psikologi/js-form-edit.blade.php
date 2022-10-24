
	$(`:text[name="tujuan_pemeriksaan"]`).val(item.tujuan_pemeriksaan);
	$(`:text[name="tanggal_pemeriksaan"]`).val(formatDate(item.tanggal_pemeriksaan));
	$(`:text[name="rujukan_dari"]`).val(item.rujukan_dari);
	$(`:text[name="kemampuan_intelektual_berfungsi_pada_taraf"]`).val(item.kemampuan_intelektual_berfungsi_pada_taraf);
	$(`:radio[name="kecerdasan_umum"][value="${item.kecerdasan_umum}"]`).prop("checked", true);
	$(`:radio[name="stabilitas_emosi"][value="${item.stabilitas_emosi}"]`).prop("checked", true);
	$(`:radio[name="kemampuan_adaptasi"][value="${item.kemampuan_adaptasi}"]`).prop("checked", true);
	$(`:radio[name="kepekaan_sosial"][value="${item.kepekaan_sosial}"]`).prop("checked", true);
	$(`:radio[name="motivasi"][value="${item.motivasi}"]`).prop("checked", true);
	$(`:radio[name="daya_tahan_terhadap_stres"][value="${item.daya_tahan_terhadap_stres}"]`).prop("checked", true);
	$(`textarea[name="kesimpulan"]`).val(item.kesimpulan);