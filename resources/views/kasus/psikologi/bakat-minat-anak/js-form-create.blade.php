
	
	$(`:text[name="nomor"]`).val("");
	$(`:text[name="tujuan_tes"]`).val("");
	$(`:text[name="kemampuan_intelegensi"]`).val("");
	$(`:text[name="kategori"]`).val("");

	$(`:radio[name="penalaran_kongkrit"]`).prop("checked", false);
	$(`:radio[name="penalaran_abstrak"]`).prop("checked", false);
	$(`:radio[name="pemahaman_verbal"]`).prop("checked", false);
	$(`:radio[name="kemampuan_numerik"]`).prop("checked", false);
	$(`:radio[name="daya_analisis_sintesa"]`).prop("checked", false);
	$(`:radio[name="daya_bayang_ruang"]`).prop("checked", false);

	$(`:radio[name="konsentrasi_daya_ingat"]`).prop("checked", false);
	$(`:radio[name="kemampuan_skolastik"]`).prop("checked", false);
	$(`:radio[name="kematangan_emosi"]`).prop("checked", false);	
	$(`:radio[name="kemasakan_sosial"]`).prop("checked", false);
	$(`:radio[name="kemampuan_adaptasi"]`).prop("checked", false);
	$(`:radio[name="motivasi_berprestasi"]`).prop("checked", false);
	$(`:radio[name="kecepatan_kerja"]`).prop("checked", false);
	$(`:radio[name="ketelitian"]`).prop("checked", false);	
	$(`:radio[name="ketekunan_keuletan"]`).prop("checked", false);
	$(`:radio[name="daya_tahan_terhadap_stress"]`).prop("checked", false);
	$(`:radio[name="overall"]`).prop("checked", false);

	$(`textarea[name="saran_pemilihan_penjurusan"]`).val("");
	$(`textarea[name="deskripsi"]`).val("");
	$("#" + type + " #dokter").val("");
	$("#" + type + " #dokter").select2().trigger("change");

	$(`:text[name="judul_minat[]"]`)[0].value = '';
	$(`:text[name="minat[]"]`)[0].value = '';

	$(`:text[name="judul_minat[]"]`)[1].value = '';
	$(`:text[name="minat[]"]`)[1].value = '';
