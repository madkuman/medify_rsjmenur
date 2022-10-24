
	$(`textarea[name="kebutuhan_materi_edukasi_informasi"]`).val(item.kebutuhan_materi_edukasi_informasi);
	$(`:text[name="tanggal_edukasi"]`).val(formatDate(item.tanggal_edukasi));
	$(`:text[name="jam_edukasi"]`).val(item.jam_edukasi);
	$(`:text[name="durasi_edukasi"]`).val(item.durasi_edukasi);
	$(`:text[name="metode"]`).val(item.metode);
	$(`:text[name="nama_edukator_pemberi_informasi"]`).val(item.nama_edukator_pemberi_informasi);
	$(`:checkbox[name="verifikasi_verfikasi"]`).prop("checked", item.verifikasi_verfikasi != null);
	$(`:text[name="nama_penerima_informasi"]`).val(item.nama_penerima_informasi);
	$(`:text[name="hubungan_terhadap_pasien"]`).val(item.hubungan_terhadap_pasien);