	$(`:text[name="keluhan_utama"]`).val(item.keluhan_utama);
	$(`:text[name="perjalanan_penyakit_pasien"]`).val(item.perjalanan_penyakit_pasien);
	$(`:text[name="keluhan_lain"]`).val(item.keluhan_lain);
	$(`:text[name="riwayat_penyakit_sebelumnya"]`).val(item.riwayat_penyakit_sebelumnya);
	$(`:text[name="riwayat_keluarga"]`).val(item.riwayat_keluarga);
	$(`:text[name="riwayat_penyakit_lain_lain"]`).val(item.riwayat_penyakit_lain_lain);
	$(`:text[name="fisik"]`).val(item.fisik);
	$(`:text[name="psikiatrik"]`).val(item.psikiatrik);
	$(`:text[name="laboratorium"]`).val(item.laboratorium);
	$(`:text[name="radiologi"]`).val(item.radiologi);
	$(`:text[name="pemeriksaan_lain_lain"]`).val(item.pemeriksaan_lain_lain);
	$(`:text[name="indikasi_mrs_diagnosa_masuk"]`).val(item.indikasi_mrs_diagnosa_masuk);
	
	$(`:text[name="icd_10_axis_1"]`).val(item.icd_10_axis_1);
	$(`:text[name="icd_10_axis_2"]`).val(item.icd_10_axis_2);
	$(`:text[name="icd_10_axis_3"]`).val(item.icd_10_axis_3);
	
	$(`:text[name="axis_1"]`).val(item.axis_1);
	$(`:text[name="axis_2"]`).val(item.axis_2);
	$(`:text[name="axis_3"]`).val(item.axis_3);
	$(`:text[name="axis_4"]`).val(item.axis_4);
	$(`:text[name="axis_5"]`).val(item.axis_5);

	$(`:text[name="diagnosa_sekunder"]`).val(item.diagnosa_sekunder);
	$(`:text[name="icd_10_diagnosa_sekunder"]`).val(item.icd_10_diagnosa_sekunder);
	$(`:text[name="diagnosa_komplikasi"]`).val(item.diagnosa_komplikasi);
	$(`:text[name="icd_10_diagnosa_komplikasi"]`).val(item.icd_10_diagnosa_komplikasi);
	$(`textarea[name="masalah_utama_yang_dihadapi"]`).val(item.masalah_utama_yang_dihadapi);
	$(`textarea[name="konsultasi"]`).val(item.konsultasi);
	$(`textarea[name="pengobatan_medis"]`).val(item.pengobatan_medis);
	$(`textarea[name="tindakan_medis_operatif_non_operatif"]`).val(item.tindakan_medis_operatif_non_operatif);
	$(`textarea[name="perjalanan_penyakit_selama_perawatan"]`).val(item.perjalanan_penyakit_selama_perawatan);
	$(`:text[name="keadaan_waktu_krs"]`).val(item.keadaan_waktu_krs);
	$(`:text[name="sebab_meninggal"]`).val(item.sebab_meninggal);
	$(`:text[name="tindak_lanjut"]`).val(item.tindak_lanjut);
	$(`:text[name="catatan_khusus"]`).val(item.catatan_khusus);