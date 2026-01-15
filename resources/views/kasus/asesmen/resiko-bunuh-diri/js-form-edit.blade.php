$(`.block-form input[name="tanggal_masuk"]`).val(val?.tanggal_masuk);
$(`.block-form input[name="ruang"]`).val(val?.ruang);
$(`.block-form input[name="dpjp"]`).val(val?.dpjp);
$(`.block-form input[name="diagnosa_medis"]`).val(val?.diagnosa_medis);
$(`.block-form input[name="faktor_dinamis"]`).val(val?.faktor_dinamis);

$(`.block-form input[name="tanggal[]"]`).each(function(idx, _) {
	if (val?.tanggal[idx]) $(this).val(val.tanggal[idx]);
});

for (var faktor in val.skoring) {
	for (var group in val.skoring[faktor]) {
		for (var shift in val.skoring[faktor][group]) {
			var value = val.skoring[faktor][group][shift];
			var inputName = `skoring[${faktor}][${group}][${shift}]`;
			var element = document.querySelector(`.block-form input[name="${inputName}"][value="${value}"]`);
			if (element) element.checked = true;			
		}
	}
}

updateSkor(".block-form .skor-saat-ini", val.skoring);
updateSkor(".block-form .skor-asesmen", val.skoring);
updateSkor(".block-form .skor-total", val.skoring);

var levelResikoElement = $(`.block-form input[name="level_resiko"][value="${val?.level_resiko}"]`);
if (levelResikoElement) levelResikoElement.prop('checked', true);

var perawatPenilaiElements = $('input[name="perawat_penilai[]"]');
perawatPenilaiElements.each(function(index) {
    $(this).val(val.perawat_penilai[index]);
});

var parafElements = $('input[name="paraf[]"]');
parafElements.each(function(index) {
    $(this).val(val.perawat_penilai[index]);
});