
	$(`textarea[name="hasil"]`).val("");
	$(`:text[name="rujukan"]`).val("");
	$(`:text[name="tujuan_pemeriksaan"]`).val("");
	$("#" + type + " #dokter").val("");
	$("#" + type + " #dokter").select2().trigger("change");

