
	$(`:text[name="teks"]`).val(item.teks);
	$(`input[name="angka"]`).val(item.angka);
	$(`textarea[name="text_area"]`).val(item.text_area);
	$(`:text[name="tanggal"]`).val(formatDate(item.tanggal));
	$(`:text[name="waktu"]`).val(item.waktu);
	$(`#select`).val(item.select);
	$(`#select`).select2().trigger("change");
	$(`:radio[name="radio"][value="${item.radio}"]`).prop("checked", true);
	$(`:checkbox[name="checkbox_checkbox_1"]`).prop("checked", item.checkbox_checkbox_1 != null);