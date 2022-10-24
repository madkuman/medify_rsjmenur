
	$(`textarea[name="hasil"]`).val(item.hasil);
	$(`:text[name="tanggal_pemeriksaan"]`).val(formatDate(item.tanggal_pemeriksaan));
	$(`:text[name="rujukan"]`).val(item.rujukan);
	$(`:text[name="tujuan_pemeriksaan"]`).val(item.tujuan_pemeriksaan);
	$("#" + tipe_asesmen + " #dokter").val(item.dokter_pemeriksa.id);
	$("#" + tipe_asesmen + " #dokter").select2().trigger("change");