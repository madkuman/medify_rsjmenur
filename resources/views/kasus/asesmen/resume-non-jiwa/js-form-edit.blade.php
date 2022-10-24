
	$(`#diagnosa_masuk`).val(item.diagnosa_masuk);
	$(`#diagnosa_utama`).val(item.diagnosa_utama);
	$(`#diagnosa_tambahan`).val(item.diagnosa_tambahan);
	$(`#jenis_tindakan`).val(item.jenis_tindakan);
	$(`#alasan_rawat`).val(item.alasan_rawat);
	$(`#ringkasan`).val(item.ringkasan);
	$(`#pemeriksaan_fisik`).val(item.pemeriksaan_fisik);
	$(`#lab`).val(item.lab);
	$(`#terapi`).val(item.terapi);
	$(`#hasil_konsul`).val(item.hasil_konsul);
	$(`#perkembangan`).val(item.perkembangan);
	$(`#keadaan_krs`).val(item.keadaan_krs);
	$(`#waktu_kontrol`).val(item.waktu_kontrol);
	$(`#instruksi`).html(item.instruksi);

	$(`#poli_id`).val(item.poli_id);
	$(`#poli_id`).select2().trigger("change");

	$(`#keadaan_krs`).val(item.keadaan_krs);
	$(`#keadaan_krs`).select2().trigger("change");