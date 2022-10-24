
	$(`:text[name="alergi"]`).val(item.alergi);
	$(`:text[name="risiko"]`).val(item.risiko);
	$(`:text[name="tanggal_pengkajian"]`).val(formatDate(item.tanggal_pengkajian));
	$(`:text[name="jam_pengkajian"]`).val(item.jam_pengkajian);
	
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
	
	$(`:checkbox[name="alasan_penggunaan_zat_diajak_teman"]`).prop("checked", item.alasan_penggunaan_zat_diajak_teman != null);
	$(`:checkbox[name="alasan_penggunaan_zat_dipaksa_teman"]`).prop("checked", item.alasan_penggunaan_zat_dipaksa_teman != null);
	$(`:checkbox[name="alasan_penggunaan_zat_coba_coba_keinginan_sendiri"]`).prop("checked", item.alasan_penggunaan_zat_coba_coba_keinginan_sendiri != null);
	$(`:checkbox[name="alasan_penggunaan_zat_pelarian_dari_masalah"]`).prop("checked", item.alasan_penggunaan_zat_pelarian_dari_masalah != null);
	$(`:text[name="komplikasi_medik_jiwa"]`).val(item.komplikasi_medik_jiwa);
	$(`:checkbox[name="kriminal_dirumah_tidak_ada_masalah"]`).prop("checked", item.kriminal_dirumah_tidak_ada_masalah != null);
	$(`:checkbox[name="kriminal_dirumah_mencuri"]`).prop("checked", item.kriminal_dirumah_mencuri != null);
	$(`:checkbox[name="kriminal_dirumah_mengancam"]`).prop("checked", item.kriminal_dirumah_mengancam != null);
	$(`:checkbox[name="kriminal_dirumah_menggadai"]`).prop("checked", item.kriminal_dirumah_menggadai != null);
	$(`:checkbox[name="kriminal_dirumah_mengambil_barang_dengan_paksaan"]`).prop("checked", item.kriminal_dirumah_mengambil_barang_dengan_paksaan != null);
	$(`:checkbox[name="kriminal_dirumah_menjual_barang_sendiri"]`).prop("checked", item.kriminal_dirumah_menjual_barang_sendiri != null);
	$(`:checkbox[name="kriminal_dirumah_mengambil_barang"]`).prop("checked", item.kriminal_dirumah_mengambil_barang != null);
	$(`:checkbox[name="kriminal_dirumah_merusak"]`).prop("checked", item.kriminal_dirumah_merusak != null);
	$(`:checkbox[name="kriminal_diluar_rumah_tidak_ada_masalah"]`).prop("checked", item.kriminal_diluar_rumah_tidak_ada_masalah != null);
	$(`:checkbox[name="kriminal_diluar_rumah_mencuri"]`).prop("checked", item.kriminal_diluar_rumah_mencuri != null);
	$(`:checkbox[name="kriminal_diluar_rumah_merampas_barang"]`).prop("checked", item.kriminal_diluar_rumah_merampas_barang != null);
	$(`:checkbox[name="kriminal_diluar_rumah_membunuh"]`).prop("checked", item.kriminal_diluar_rumah_membunuh != null);
	$(`:checkbox[name="kriminal_diluar_rumah_merampok"]`).prop("checked", item.kriminal_diluar_rumah_merampok != null);
	$(`:checkbox[name="kriminal_diluar_rumah_mengancam"]`).prop("checked", item.kriminal_diluar_rumah_mengancam != null);
	$(`:checkbox[name="kriminal_diluar_rumah_merusak"]`).prop("checked", item.kriminal_diluar_rumah_merusak != null);
	$(`:checkbox[name="catatan_polisi_tidak_ada"]`).prop("checked", item.catatan_polisi_tidak_ada != null);
	$(`:checkbox[name="catatan_polisi_ditahan_diproses_pengadilan"]`).prop("checked", item.catatan_polisi_ditahan_diproses_pengadilan != null);
	$(`:checkbox[name="catatan_polisi_ditahan_kemudian_langsung_dipulangkan"]`).prop("checked", item.catatan_polisi_ditahan_kemudian_langsung_dipulangkan != null);
	$(`:text[name="lain_lain_catatan_polisi"]`).val(item.lain_lain_catatan_polisi);
	$(`:checkbox[name="problem_sekolah_tidak_ada_masalah"]`).prop("checked", item.problem_sekolah_tidak_ada_masalah != null);
	$(`:checkbox[name="problem_sekolah_tidak_naik_kelas"]`).prop("checked", item.problem_sekolah_tidak_naik_kelas != null);
	$(`:checkbox[name="problem_sekolah_berhenti_sekolah"]`).prop("checked", item.problem_sekolah_berhenti_sekolah != null);
	$(`:checkbox[name="problem_sekolah_susah_konsentrasi_belajar"]`).prop("checked", item.problem_sekolah_susah_konsentrasi_belajar != null);
	$(`:checkbox[name="problem_sekolah_dikeluarkan_dari_sekolah"]`).prop("checked", item.problem_sekolah_dikeluarkan_dari_sekolah != null);
	$(`:checkbox[name="problem_sekolah_tidak_disiplin"]`).prop("checked", item.problem_sekolah_tidak_disiplin != null);