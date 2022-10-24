
	$(`:text[name="alergi"]`).val(item.alergi);
	$(`:text[name="risiko"]`).val(item.risiko);
	$(`:text[name="tanggal_pengkajian"]`).val(formatDate(item.tanggal_pengkajian));
	$(`:text[name="jam_pengkajian"]`).val(item.jam_pengkajian);
	$(`:radio[name="riwayat_pemakaian_napza"][value="${item.riwayat_pemakaian_napza}"]`).prop("checked", true);

	var jenis_napza_yang_dipakai = JSON.parse(item.jenis_napza_yang_dipakai);
	jenis_napza_yang_dipakai.forEach(function(item, index){
		if(index > 0){
			addJenis();		
		}

		var sejak = null;
		if(item.tanggal_sejak != null) {
			sejak = formatDate(item.tanggal_sejak.date);
		}

		var sampai = null;
		if(item.tanggal_sampai_dengan != null) {
			sampai = formatDate(item.tanggal_sampai_dengan.date);
		}

		$(`:text[name="jenis_napza_yang_dipakai[]"]`)[index].value = item.jenis_napza_yang_dipakai;
		$(`:text[name="tanggal_sejak[]"]`)[index].value = sejak;
		$(`:text[name="tanggal_sampai_dengan[]"]`)[index].value = sampai;
		$(`:text[name="cara_pakai[]"]`)[index].value = item.cara_pakai;
	});
	
	$(`:checkbox[name="etiologi_penggunaan_zat_diajak_teman"]`).prop("checked", item.etiologi_penggunaan_zat_diajak_teman != null);
	$(`:checkbox[name="etiologi_penggunaan_zat_dipaksa_teman"]`).prop("checked", item.etiologi_penggunaan_zat_dipaksa_teman != null);
	$(`:checkbox[name="etiologi_penggunaan_zat_coba_coba_keinginan_sendiri"]`).prop("checked", item.etiologi_penggunaan_zat_coba_coba_keinginan_sendiri != null);
	$(`:checkbox[name="etiologi_penggunaan_zat_pelarian_dari_masalah"]`).prop("checked", item.etiologi_penggunaan_zat_pelarian_dari_masalah != null);
	$(`:text[name="komplikasi_medik_jiwa"]`).val(item.komplikasi_medik_jiwa);
	$(`:text[name="perilaku_kriminal_di_dalam_rumah_sendiri"]`).val(item.perilaku_kriminal_di_dalam_rumah_sendiri);
	$(`:text[name="perilaku_kriminal_di_luar_rumah"]`).val(item.perilaku_kriminal_di_luar_rumah);
	$(`:text[name="problem_masyarakat"]`).val(item.problem_masyarakat);
	$(`:text[name="riwayat_perawatan_di_rumah_sakit_terkait_napza"]`).val(formatDate(item.riwayat_perawatan_di_rumah_sakit_terkait_napza));
	$(`:text[name="riwayat_rehabilitasi_napza_sebelumnya"]`).val(formatDate(item.riwayat_rehabilitasi_napza_sebelumnya));
	$(`:text[name="tempat_rehabilitasi"]`).val(item.tempat_rehabilitasi);
	$(`:text[name="riwayat_relaps_dengan_tanpa_rehabilitasi_napza"]`).val(formatDate(item.riwayat_relaps_dengan_tanpa_rehabilitasi_napza));
	$(`:checkbox[name="faktor_penyebab_relaps_diajak_teman"]`).prop("checked", item.faktor_penyebab_relaps_diajak_teman != null);
	$(`:checkbox[name="faktor_penyebab_relaps_dipaksa_teman"]`).prop("checked", item.faktor_penyebab_relaps_dipaksa_teman != null);
	$(`:checkbox[name="faktor_penyebab_relaps_tidak_memiliki_aktivitas_berarti"]`).prop("checked", item.faktor_penyebab_relaps_tidak_memiliki_aktivitas_berarti != null);
	$(`:checkbox[name="faktor_penyebab_relaps_dendam_setelah_masa_pemulihan"]`).prop("checked", item.faktor_penyebab_relaps_dendam_setelah_masa_pemulihan != null);
	$(`:checkbox[name="faktor_penyebab_relaps_konflik_dengan_orang_tua"]`).prop("checked", item.faktor_penyebab_relaps_konflik_dengan_orang_tua != null);
	$(`:checkbox[name="faktor_penyebab_relaps_bergabung_dengan_pengguna_zat"]`).prop("checked", item.faktor_penyebab_relaps_bergabung_dengan_pengguna_zat != null);
	$(`:checkbox[name="faktor_penyebab_relaps_tidak_mampu_menahan_suggest"]`).prop("checked", item.faktor_penyebab_relaps_tidak_mampu_menahan_suggest != null);
	$(`:checkbox[name="faktor_penyebab_relaps_keinginan_untuk_menggunakan"]`).prop("checked", item.faktor_penyebab_relaps_keinginan_untuk_menggunakan != null);
	$(`:text[name="riwayat_seks_bebas"]`).val(formatDate(item.riwayat_seks_bebas));
	$(`:text[name="anggota_keluarga_yang_menggunakan_napza"]`).val(item.anggota_keluarga_yang_menggunakan_napza);
	$(`:text[name="tanggal_selesai_pengkajian"]`).val(formatDate(item.tanggal_selesai_pengkajian));
	$(`:text[name="jam_selesai_pengkajian"]`).val(item.jam_selesai_pengkajian);