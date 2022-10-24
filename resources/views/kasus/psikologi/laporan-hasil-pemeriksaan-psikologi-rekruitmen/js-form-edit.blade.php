
	$(`:text[name="tanggal_pemeriksaan"]`).val(formatDate(item.tanggal_pemeriksaan));
	$(`:text[name="posisi_yang_dituju"]`).val(item.posisi_yang_dituju);

	$(`:radio[name="intelegensi"][value="${item.intelegensi}"]`).prop("checked", true);
	$(`:radio[name="daya_tangkap"][value="${item.daya_tangkap}"]`).prop("checked", true);
	$(`:radio[name="daya_analisa"][value="${item.daya_analisa}"]`).prop("checked", true);
	$(`:radio[name="daya_konsentrasi"][value="${item.daya_konsentrasi}"]`).prop("checked", true);
	$(`:radio[name="bekerja_dengan_angka"][value="${item.bekerja_dengan_angka}"]`).prop("checked", true);
	$(`:radio[name="sistimatika_kerja"][value="${item.sistimatika_kerja}"]`).prop("checked", true);
	$(`:radio[name="ketelitian_kerja"][value="${item.ketelitian_kerja}"]`).prop("checked", true);
	$(`:radio[name="kecepatan_kerja"][value="${item.kecepatan_kerja}"]`).prop("checked", true);
	$(`:radio[name="ketekunan"][value="${item.ketekunan}"]`).prop("checked", true);
	$(`:radio[name="daya_tahan_kerja"][value="${item.daya_tahan_kerja}"]`).prop("checked", true);
	$(`:radio[name="inisiatif"][value="${item.inisiatif}"]`).prop("checked", true);
	$(`:radio[name="motivasi_berprestasi"][value="${item.motivasi_berprestasi}"]`).prop("checked", true);
	$(`:radio[name="percaya_diri"][value="${item.percaya_diri}"]`).prop("checked", true);
	$(`:radio[name="menyesuaikan_diri"][value="${item.menyesuaikan_diri}"]`).prop("checked", true);
	$(`:radio[name="stabilitas_emosi"][value="${item.stabilitas_emosi}"]`).prop("checked", true);
	$(`:radio[name="kerja_sama"][value="${item.kerja_sama}"]`).prop("checked", true);
	$(`:radio[name="kesimpulan"][value="${item.kesimpulan}"]`).prop("checked", true);
	
	$(`textarea[name="uraian_psikologis"]`).val(item.uraian_psikologis);
	$(`textarea[name="kelebihan"]`).val(item.kelebihan);
	$(`textarea[name="kelemahan"]`).val(item.kelemahan);
	$(`textarea[name="saran"]`).val(item.saran);