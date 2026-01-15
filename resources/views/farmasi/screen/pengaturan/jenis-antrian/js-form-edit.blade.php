$(`:text[name="nama"]`).val(item.nama);
$(`:text[name="kode"]`).val(item.kode);
$(`#perusahaan_tipe`).val(item.perusahaan_tipe);
$(`[name="jenis_resep_antrian"]`).val(item.jenis_resep_antrian).trigger('change');
$(`[name="lokasi_departemen_id"]`).val(item.lokasi_departemen_id).trigger('change');
$(`#perusahaan_tipe`).select2().trigger("change");