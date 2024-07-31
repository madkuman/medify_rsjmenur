
	$(`:text[name="tanggal_pelaksanaan_skoring"]`).val(formatDate(item.tanggal_pelaksanaan_skoring));
	$(`:text[name="jam_pelaksanaan_skoring"]`).val(item.jam_pelaksanaan_skoring);
	$(`:text[name="tempat_pelaksanaan_skoring"]`).val(item.tempat_pelaksanaan_skoring);
	$(`input[name="gaduh_gelisah"]`).val(item.gaduh_gelisah);
	$(`input[name="permusuhan"]`).val(item.permusuhan);
	$(`input[name="ketegangan"]`).val(item.ketegangan);
	$(`input[name="ketidak_kooperatifan"]`).val(item.ketidak_kooperatifan);
	$(`input[name="pengendalian_impuls_yang_buruk"]`).val(item.pengendalian_impuls_yang_buruk);
	$(`input[name="total"]`).val(item.total);