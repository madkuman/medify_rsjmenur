$(`.block-form input[name="tanggal_masuk"]`).val("");
$(`.block-form input[name="ruang"]`).val("");
$(`.block-form input[name="dpjp"]`).val("");
$(`.block-form input[name="diagnosa_medis"]`).val("");
$(`.block-form input[name="faktor_dinamis"]`).val("");

$(`.block-form input[name="tanggal[]"]`).each(function() {
	$(this).val("");
});

$("input[type=radio]").each(function() {
	$(this).prop('checked', false);
});

$(".block-form .skor-saat-ini").each(function(_, el) {
	$(el).text("");
});

$(".block-form .skor-asesmen").each(function(_, el) {
	$(el).text("");
});

$(".block-form .skor-total").each(function(_, el) {
	$(el).text("");
});

var levelResikoElement = $(`.block-form input[name="level_resiko"][value="${val?.level_resiko}"]`);
if (levelResikoElement) levelResikoElement.prop('checked', false);

var perawatPenilaiElements = $('input[name="perawat_penilai[]"]');
perawatPenilaiElements.each(function(index) {
    $(this).val("");
});

var parafElements = $('input[name="paraf[]"]');
parafElements.each(function(index) {
    $(this).val("");
});