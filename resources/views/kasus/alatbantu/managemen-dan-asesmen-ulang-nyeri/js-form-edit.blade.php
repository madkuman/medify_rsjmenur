
	$(`:text[name="nama_obat"]`).val(item.nama_obat);
	$(`:text[name="dosis_dan_frekuensi"]`).val(item.dosis_dan_frekuensi);
	$(`:text[name="nama_dokter"]`).val(item.nama_dokter);
	$(`:text[name="tanggal"]`).val(formatDate(item.tanggal));
	$(`:text[name="jam"]`).val(item.jam);
	$(`input[name="skor_nyeri"]`).val(item.skor_nyeri);
	$(`input[name="tensi"]`).val(item.tensi);
	$(`:text[name="nadi"]`).val(item.nadi);
	$(`:text[name="nafas"]`).val(item.nafas);
	$(`:text[name="suhu"]`).val(item.suhu);
	$(`:text[name="intervensi_non_farmokologi"]`).val(item.intervensi_non_farmokologi);
	$(`:text[name="waktu_kajian_ulang"]`).val(item.waktu_kajian_ulang);
	$(`:text[name="nama_perawat"]`).val(item.nama_perawat);