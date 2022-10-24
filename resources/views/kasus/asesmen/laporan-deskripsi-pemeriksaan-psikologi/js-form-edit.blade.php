
	$(`:text[name="tujuan_pemeriksaan"]`).val(item.tujuan_pemeriksaan);
	$(`:text[name="tanggal_pemeriksaan"]`).val(formatDate(item.tanggal_pemeriksaan));
	$(`:text[name="rujukan_dari"]`).val(item.rujukan_dari);
	$(`textarea[name="hasil"]`).val(item.hasil);