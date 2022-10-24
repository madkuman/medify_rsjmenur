
	$(`textarea[name="riwayat_pemakaian_zat"]`).val("");
	
	$(`:text[name="jenis_zat_yang_dipakai[]"]`)[0].value = '';
	$(`:text[name="tanggal_sejak[]"]`)[0].value = '';
	$(`:text[name="tanggal_sampai_dengan[]"]`)[0].value = '';

	$(`:checkbox[name="etiologi_penggunaan_zat_diajak_teman"]`).prop("checked", false);
	$(`:checkbox[name="etiologi_penggunaan_zat_dipaksa_teman"]`).prop("checked", false);
	$(`:checkbox[name="etiologi_penggunaan_zat_coba_coba_keinginan_sendiri"]`).prop("checked", false);
	$(`:checkbox[name="etiologi_penggunaan_zat_pelarian_dari_masalah"]`).prop("checked", false);
	$(`:text[name="komplikasi_medik_jiwa"]`).val("");
	$(`:text[name="perilaku_kriminal_didalam_rumah"]`).val("");
	$(`:text[name="perilaku_kriminal_diluar_rumah"]`).val("");
	$(`:text[name="problem_masyarakat"]`).val("");
	$(`:text[name="riwayat_perawatan_dirumah_sakit"]`).val("");
	$(`:text[name="riwayat_rehabilitasi_napza"]`).val("");
	$(`:text[name="tanggal_pengkajian"]`).val("");
	$(`:text[name="jam_pengkajian"]`).val("");
	$(`:text[name="tanggal_selesai_pengkajian"]`).val("");
	$(`:text[name="jam_selesai_pengkajian"]`).val("");