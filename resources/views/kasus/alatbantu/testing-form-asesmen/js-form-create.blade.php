
	$(`:text[name="teks"]`).val("");
	$(`input[name="angka"]`).val("");
	$(`textarea[name="text_area"]`).val("");
	$(`:text[name="tanggal"]`).val("");
	$(`:text[name="waktu"]`).val("");
	$(`#select`).val("");
	$(`#select`).select2().trigger("change");
	$(`:radio[name="radio"]`).prop("checked", false);
	$(`:checkbox[name="checkbox_checkbox_1"]`).prop("checked", false);