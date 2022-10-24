
	$(`:text[name="tanggal"]`).val(formatDate(item.tanggal));
	$(`:text[name="jam"]`).val(item.jam);
	$(`:text[name="tensi"]`).val(item.tensi);
	$(`:text[name="nadi"]`).val(item.nadi);
	$(`:text[name="suhu"]`).val(item.suhu);
	$(`:text[name="rr"]`).val(item.rr);
	$(`input[name="infus"]`).val(item.infus);
	$(`input[name="per_os"]`).val(item.per_os);
	$(`input[name="urine"]`).val(item.urine);
	$(`input[name="cairan_lain_lain"]`).val(item.cairan_lain_lain);
	$(`textarea[name="rencana_tindakan"]`).val(item.rencana_tindakan);