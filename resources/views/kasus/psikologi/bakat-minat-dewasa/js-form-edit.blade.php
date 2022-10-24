
	
	$(`:text[name="tujuan_tes"]`).val(item.tujuan_tes);
	$(`:text[name="tanggal_pemeriksaan"]`).val(formatDate(item.tanggal_pemeriksaan));

	$(`:radio[name="intelegensi_umum"][value="${item.intelegensi_umum}"]`).prop("checked", true);
	$(`:radio[name="daya_nalar"][value="${item.daya_nalar}"]`).prop("checked", true);
	$(`:radio[name="daya_analisa_sintesa"][value="${item.daya_analisa_sintesa}"]`).prop("checked", true);
	$(`:radio[name="fleksibilitas_berpikir"][value="${item.fleksibilitas_berpikir}"]`).prop("checked", true);
	$(`:radio[name="daya_ingat"][value="${item.daya_ingat}"]`).prop("checked", true);
	$(`:radio[name="kecepatan_kerja"][value="${item.kecepatan_kerja}"]`).prop("checked", true);

	$(`:radio[name="ketelitian"][value="${item.ketelitian}"]`).prop("checked", true);
	$(`:radio[name="daya_tahan_kerja"][value="${item.daya_tahan_kerja}"]`).prop("checked", true);
	$(`:radio[name="stabilitas_emosi"][value="${item.stabilitas_emosi}"]`).prop("checked", true);	
	$(`:radio[name="penyesuaian_diri"][value="${item.penyesuaian_diri}"]`).prop("checked", true);
	$(`:radio[name="motivasi_dorongan_ambisi"][value="${item.motivasi_dorongan_ambisi}"]`).prop("checked", true);
	$(`:radio[name="kerja_sama"][value="${item.kerja_sama}"]`).prop("checked", true);
	$(`:radio[name="kemampuan_verbal"][value="${item.kemampuan_verbal}"]`).prop("checked", true);
	$(`:radio[name="kemampuan_numerik"][value="${item.kemampuan_numerik}"]`).prop("checked", true);

	var minat = JSON.parse(item.minat);
	minat.forEach(function(item, index){
		$(`:text[name="minat[]"]`)[index].value = item;
	});

	$(`textarea[name="kesimpulan"]`).val(item.kesimpulan);

