
	$(`textarea[name="riwayat_pemakaian_zat"]`).val(item.riwayat_pemakaian_zat);
	
	var jenis_zat_yang_dipakai = JSON.parse(item.jenis_zat_yang_dipakai);
	jenis_zat_yang_dipakai.forEach(function(item, index){
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

		$(`:text[name="jenis_zat_yang_dipakai[]"]`)[index].value = item.jenis_zat_yang_dipakai;
		$(`:text[name="tanggal_sejak[]"]`)[index].value = sejak;
		$(`:text[name="tanggal_sampai_dengan[]"]`)[index].value = sampai;
	});
	
	$(`:checkbox[name="etiologi_penggunaan_zat_diajak_teman"]`).prop("checked", item.etiologi_penggunaan_zat_diajak_teman != null);
	$(`:checkbox[name="etiologi_penggunaan_zat_dipaksa_teman"]`).prop("checked", item.etiologi_penggunaan_zat_dipaksa_teman != null);
	$(`:checkbox[name="etiologi_penggunaan_zat_coba_coba_keinginan_sendiri"]`).prop("checked", item.etiologi_penggunaan_zat_coba_coba_keinginan_sendiri != null);
	$(`:checkbox[name="etiologi_penggunaan_zat_pelarian_dari_masalah"]`).prop("checked", item.etiologi_penggunaan_zat_pelarian_dari_masalah != null);
	$(`:text[name="komplikasi_medik_jiwa"]`).val(item.komplikasi_medik_jiwa);
	$(`:text[name="perilaku_kriminal_didalam_rumah"]`).val(item.perilaku_kriminal_didalam_rumah);
	$(`:text[name="perilaku_kriminal_diluar_rumah"]`).val(item.perilaku_kriminal_diluar_rumah);
	$(`:text[name="problem_masyarakat"]`).val(item.problem_masyarakat);
	$(`:text[name="riwayat_perawatan_dirumah_sakit"]`).val(item.riwayat_perawatan_dirumah_sakit);
	$(`:text[name="riwayat_rehabilitasi_napza"]`).val(item.riwayat_rehabilitasi_napza);
	$(`:text[name="tanggal_pengkajian"]`).val(formatDate(item.tanggal_pengkajian));
	$(`:text[name="jam_pengkajian"]`).val(item.jam_pengkajian);
	$(`:text[name="tanggal_selesai_pengkajian"]`).val(formatDate(item.tanggal_selesai_pengkajian));
	$(`:text[name="jam_selesai_pengkajian"]`).val(item.jam_selesai_pengkajian);