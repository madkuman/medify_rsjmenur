
	$(`:text[name="nama"]`).val(item.nama);
	$(`:text[name="alamat"]`).val(item.alamat);
	$(`:text[name="telepon"]`).val(item.telepon);
	$(`:text[name="hubungan_dengan_pasien"]`).val(item.hubungan_dengan_pasien);
	$('#pasien_telah_dinyatakan').append('<option class="mustDestroy" value="'+item.pasien_telah_dinyatakan+'">'+item.pasien_telah_dinyatakan+'</option>')
	$(`#pasien_telah_dinyatakan`).val(item.pasien_telah_dinyatakan);
	$(`#pasien_telah_dinyatakan`).select2().trigger("change");
	$(`:text[name="rujuk_ke"]`).val(item.rujuk_ke);