$(`:input[name="dx_medis"]`).val("");
$(`:input[name="tanggal"]`).val("");
$(`:input[name="mpp"]`).val("");

$('input.risiko-check').each(function (_, element) {
	$(element).prop('checked', false);
});

$(`input[type="text"].risiko-text`).each(function (_, element) {
	$(element).val("");
});

$('textarea.risiko-ket').each(function (_, element) {
	$(element).val("");
});

$(`:input[name="waktu_prediksi"]`).val("");