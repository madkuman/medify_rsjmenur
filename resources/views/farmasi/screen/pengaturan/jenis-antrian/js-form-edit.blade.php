$(`:text[name="nama"]`).val(item.nama);
$(`:text[name="kode"]`).val(item.kode);
$(`#perusahaan_tipe`).val(item.perusahaan_tipe);
$(`#perusahaan_tipe`).select2().trigger("change");