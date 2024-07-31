var val = item.val;

$(`:input[name="dx_medis"]`).val(val.dx_medis);
$(`:input[name="tanggal"]`).val(val.tanggal);
$(`:input[name="mpp"]`).val(val.mpp);

$('input.risiko-check').each(function (_, element) {
	var data_row = $(element).data('row');
	var data_col = $(element).data('col');
	var row_name = `row_${data_row}`;
	var col_name = `col_${data_col}`;

	if (val.risiko.hasOwnProperty(row_name) && val.risiko[row_name].hasOwnProperty(col_name)) {
		var is_checked = val.risiko[row_name][col_name].check ?? false;
		$(element).prop('checked', is_checked);
	}
});

$('input.risiko-text').each(function (_, element) {
	var data_row = $(element).data('row');
	var data_col = $(element).data('col');
	var row_name = `row_${data_row}`;
	var col_name = `col_${data_col}`;

	if (val.risiko.hasOwnProperty(row_name) && val.risiko[row_name].hasOwnProperty(col_name)) {
		var input_value = val.risiko[row_name][col_name].text ?? '';
		$(element).val(input_value);
	}
});

$('textarea.risiko-ket').each(function (_, element) {
	var data_row = $(element).data('row');
	var data_col = $(element).data('col');
	var row_name = `row_${data_row}`;
	var col_name = `col_${data_col}`;

	if (val.risiko.hasOwnProperty(row_name) && val.risiko[row_name].hasOwnProperty(col_name)) {
		var input_value = val.risiko[row_name][col_name].ket ?? '';
		$(element).val(input_value);
	}
});

$(`:input[name="waktu_prediksi"]`).val(val.waktu_prediksi);