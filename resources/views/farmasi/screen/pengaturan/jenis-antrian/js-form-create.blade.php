$(`:text[name="nama"]`).val("");
$(`:text[name="kode"]`).val("");
$(`#perusahaan_tipe`).val("");
$(`[name="jenis_resep_antrian"]`).val(null).trigger('change');
$(`[name="lokasi_departemen_id"]`).val("0").trigger('change');
$(`#perusahaan_tipe`).select2().trigger("change");