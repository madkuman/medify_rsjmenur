
	$(`:text[name="tujuan_pemeriksaan"]`).val("");
	$(`:text[name="tanggal_pemeriksaan"]`).val("");
	$(`:text[name="rujukan_dari"]`).val("");
	$(`:text[name="kemampuan_intelektual_berfungsi_pada_taraf"]`).val("");
	$(`:radio[name="kecerdasan_umum"]`).prop("checked", false);
	$(`:radio[name="stabilitas_emosi"]`).prop("checked", false);
	$(`:radio[name="kemampuan_adaptasi"]`).prop("checked", false);
	$(`:radio[name="kepekaan_sosial"]`).prop("checked", false);
	$(`:radio[name="motivasi"]`).prop("checked", false);
	$(`:radio[name="daya_tahan_terhadap_stres"]`).prop("checked", false);
	$(`textarea[name="kesimpulan"]`).val("");