
	
	$(`:text[name="tujuan_tes"]`).val("");

	$(`:radio[name="intelegensi_umum"]`).prop("checked", false);
	$(`:radio[name="daya_nalar"]`).prop("checked", false);
	$(`:radio[name="daya_analisa_sintesa"]`).prop("checked", false);
	$(`:radio[name="fleksibilitas_berpikir"]`).prop("checked", false);
	$(`:radio[name="daya_ingat"]`).prop("checked", false);
	$(`:radio[name="kecepatan_kerja"]`).prop("checked", false);

	$(`:radio[name="ketelitian"]`).prop("checked", false);
	$(`:radio[name="daya_tahan_kerja"]`).prop("checked", false);
	$(`:radio[name="stabilitas_emosi"]`).prop("checked", false);	
	$(`:radio[name="penyesuaian_diri"]`).prop("checked", false);
	$(`:radio[name="motivasi_dorongan_ambisi"]`).prop("checked", false);
	$(`:radio[name="kerja_sama"]`).prop("checked", false);
	$(`:radio[name="kemampuan_verbal"]`).prop("checked", false);
	$(`:radio[name="kemampuan_numerik"]`).prop("checked", false);

	$(`:text[name="minat[]"]`)[0].value = '';
	$(`:text[name="minat[]"]`)[1].value = '';
	$(`:text[name="minat[]"]`)[2].value = '';

	$(`textarea[name="kesimpulan"]`).val("");

