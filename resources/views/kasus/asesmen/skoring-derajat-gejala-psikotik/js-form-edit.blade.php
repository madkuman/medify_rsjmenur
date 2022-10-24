
	$(`:text[name="tanggal_pelaksanaan_skoring"]`).val(formatDate(item.tanggal_pelaksanaan_skoring));
	$(`:text[name="jam_pelaksanaan_skoring"]`).val(item.jam_pelaksanaan_skoring);
	$(`:text[name="tempat_pelaksanaan_skoring"]`).val(item.tempat_pelaksanaan_skoring);
	$(`input[name="penampilan"]`).val(item.penampilan);
	$(`input[name="aktivitas_sosial"]`).val(item.aktivitas_sosial);
	$(`input[name="sikap"]`).val(item.sikap);
	$(`input[name="cara_bicara"]`).val(item.cara_bicara);
	$(`input[name="cara_berpikir"]`).val(item.cara_berpikir);
	$(`input[name="perilaku"]`).val(item.perilaku);
	$(`input[name="fungsi_intelek_dan_orientasi"]`).val(item.fungsi_intelek_dan_orientasi);
	$(`input[name="pengendalian_emosi"]`).val(item.pengendalian_emosi);
	$(`input[name="fungsi_persepsi"]`).val(item.fungsi_persepsi);
	$(`input[name="tilikan"]`).val(item.tilikan);
	$(`input[name="total"]`).val(item.total);