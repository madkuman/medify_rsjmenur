
	$(`:radio[name="kecerdasan_umum"][value="${item.kecerdasan_umum}"]`).prop("checked", true);
	$(`:radio[name="fleksibilitas_berpikir"][value="${item.fleksibilitas_berpikir}"]`).prop("checked", true);
	$(`:radio[name="sistematika_berpikir"][value="${item.sistematika_berpikir}"]`).prop("checked", true);
	$(`:radio[name="analisa_sintesa"][value="${item.analisa_sintesa}"]`).prop("checked", true);
	$(`:radio[name="berpikir_konseptual"][value="${item.berpikir_konseptual}"]`).prop("checked", true);
	$(`:radio[name="stabilitas_emosi"][value="${item.stabilitas_emosi}"]`).prop("checked", true);
	$(`:radio[name="kerja_sama"][value="${item.kerja_sama}"]`).prop("checked", true);
	$(`:radio[name="kepekaan_sosial"][value="${item.kepekaan_sosial}"]`).prop("checked", true);
	$(`:radio[name="kemampuan_adaptasi"][value="${item.kemampuan_adaptasi}"]`).prop("checked", true);
	$(`:radio[name="motivasi"][value="${item.motivasi}"]`).prop("checked", true);
	$(`:text[name="tujuan_tes"]`).val(item.tujuan_tes);
	$(`:text[name="keperluan"]`).val(item.keperluan);
	$(`:text[name="tanggal"]`).val(formatDate(item.tanggal));
	$(`:text[name="rujukan_dari"]`).val(item.rujukan_dari);
	$(`:text[name="kemampuan_intelektual"]`).val(item.kemampuan_intelektual);