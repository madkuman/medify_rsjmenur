	
	$(`:text[name="tanggal_tes"]`).val(formatDate(item.tanggal_tes));
	$(`:text[name="nomor"]`).val(item.nomor);
	$(`:text[name="tujuan_tes"]`).val(item.tujuan_tes);
	$(`:text[name="kemampuan_intelegensi"]`).val(item.kemampuan_intelegensi);
	$(`:text[name="kategori"]`).val(item.kategori);

	$(`:radio[name="penalaran_kongkrit"][value="${item.penalaran_kongkrit}"]`).prop("checked", true);
	$(`:radio[name="penalaran_abstrak"][value="${item.penalaran_abstrak}"]`).prop("checked", true);
	$(`:radio[name="pemahaman_verbal"][value="${item.pemahaman_verbal}"]`).prop("checked", true);
	$(`:radio[name="kemampuan_numerik"][value="${item.kemampuan_numerik}"]`).prop("checked", true);
	$(`:radio[name="daya_analisis_sintesa"][value="${item.daya_analisis_sintesa}"]`).prop("checked", true);
	$(`:radio[name="daya_bayang_ruang"][value="${item.daya_bayang_ruang}"]`).prop("checked", true);

	$(`:radio[name="konsentrasi_daya_ingat"][value="${item.konsentrasi_daya_ingat}"]`).prop("checked", true);
	$(`:radio[name="kemampuan_skolastik"][value="${item.kemampuan_skolastik}"]`).prop("checked", true);
	$(`:radio[name="kematangan_emosi"][value="${item.kematangan_emosi}"]`).prop("checked", true);
	$(`:radio[name="kemasakan_sosial"][value="${item.kemasakan_sosial}"]`).prop("checked", true);
	$(`:radio[name="kemampuan_adaptasi"][value="${item.kemampuan_adaptasi}"]`).prop("checked", true);
	$(`:radio[name="motivasi_berprestasi"][value="${item.motivasi_berprestasi}"]`).prop("checked", true);
	$(`:radio[name="kecepatan_kerja"][value="${item.kecepatan_kerja}"]`).prop("checked", true);
	$(`:radio[name="ketelitian"][value="${item.ketelitian}"]`).prop("checked", true);
	$(`:radio[name="ketekunan_keuletan"][value="${item.ketekunan_keuletan}"]`).prop("checked", true);
	$(`:radio[name="daya_tahan_terhadap_stress"][value="${item.daya_tahan_terhadap_stress}"]`).prop("checked", true);
	$(`:radio[name="overall"][value="${item.overall}"]`).prop("checked", true);

	$(`textarea[name="deskripsi"]`).val(item.deskripsi);
	$(`textarea[name="saran_pemilihan_penjurusan"]`).val(item.saran_pemilihan_penjurusan);
	$("#" + tipe_asesmen + " #dokter").val(item.dokter_pemeriksa.id);
	$("#" + tipe_asesmen + " #dokter").select2().trigger("change");

	var minat = JSON.parse(item.minat);
	if(minat != null) {
		minat.forEach(function(item, index){
			$(`:text[name="judul_minat[]"]`)[index].value = item.judul_minat;;
			$(`:text[name="minat[]"]`)[index].value = item.minat;;
		});
	}