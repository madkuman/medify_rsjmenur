
	$(`:text[name="tanggal_kontrol"]`).val(formatDate(item.tanggal_kontrol));
	$(`textarea[name="obat_yang_diminum"]`).val(item.obat_yang_diminum);
	$(`textarea[name="obat_yang_tidak_diminum"]`).val(item.obat_yang_tidak_diminum);
	$(`textarea[name="keterangan_lain_lain"]`).val(item.keterangan_lain_lain);
	$(`textarea[name="saran"]`).val(item.saran);