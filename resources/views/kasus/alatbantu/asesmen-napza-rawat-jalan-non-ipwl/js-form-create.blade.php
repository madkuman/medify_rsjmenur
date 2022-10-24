
	$(`:text[name="alergi"]`).val("");
	$(`:text[name="risiko"]`).val("");
	$(`:text[name="tanggal_pengkajian"]`).val("");
	$(`:text[name="jam_pengkajian"]`).val("");
	$(`:radio[name="riwayat_pemakaian_napza"]`).prop("checked", false);

	jenis_napza.forEach(function(item, index){
		if(index > 0){
			addJenis();		
		}

		$(`:text[name="jenis_napza_yang_dipakai[]"]`)[index].value = item;
		$(`:text[name="tanggal_sejak[]"]`)[index].value = '';
		$(`:text[name="tanggal_sampai_dengan[]"]`)[index].value = '';
		$(`:text[name="cara_pakai[]"]`)[index].value = '';
	});
	
	$(`:checkbox[name="etiologi_penggunaan_zat_diajak_teman"]`).prop("checked", false);
	$(`:checkbox[name="etiologi_penggunaan_zat_dipaksa_teman"]`).prop("checked", false);
	$(`:checkbox[name="etiologi_penggunaan_zat_coba_coba_keinginan_sendiri"]`).prop("checked", false);
	$(`:checkbox[name="etiologi_penggunaan_zat_pelarian_dari_masalah"]`).prop("checked", false);
	$(`:text[name="komplikasi_medik_jiwa"]`).val("");
	$(`:text[name="perilaku_kriminal_di_dalam_rumah_sendiri"]`).val("");
	$(`:text[name="perilaku_kriminal_di_luar_rumah"]`).val("");
	$(`:text[name="problem_masyarakat"]`).val("");
	$(`:text[name="riwayat_perawatan_di_rumah_sakit_terkait_napza"]`).val("");
	$(`:text[name="riwayat_rehabilitasi_napza_sebelumnya"]`).val("");
	$(`:text[name="tempat_rehabilitasi"]`).val("");
	$(`:text[name="riwayat_relaps_dengan_tanpa_rehabilitasi_napza"]`).val("");
	$(`:checkbox[name="faktor_penyebab_relaps_diajak_teman"]`).prop("checked", false);
	$(`:checkbox[name="faktor_penyebab_relaps_dipaksa_teman"]`).prop("checked", false);
	$(`:checkbox[name="faktor_penyebab_relaps_tidak_memiliki_aktivitas_berarti"]`).prop("checked", false);
	$(`:checkbox[name="faktor_penyebab_relaps_dendam_setelah_masa_pemulihan"]`).prop("checked", false);
	$(`:checkbox[name="faktor_penyebab_relaps_konflik_dengan_orang_tua"]`).prop("checked", false);
	$(`:checkbox[name="faktor_penyebab_relaps_bergabung_dengan_pengguna_zat"]`).prop("checked", false);
	$(`:checkbox[name="faktor_penyebab_relaps_tidak_mampu_menahan_suggest"]`).prop("checked", false);
	$(`:checkbox[name="faktor_penyebab_relaps_keinginan_untuk_menggunakan"]`).prop("checked", false);
	$(`:text[name="riwayat_seks_bebas"]`).val("");
	$(`:text[name="anggota_keluarga_yang_menggunakan_napza"]`).val("");
	$(`:text[name="tanggal_selesai_pengkajian"]`).val("");
	$(`:text[name="jam_selesai_pengkajian"]`).val("");