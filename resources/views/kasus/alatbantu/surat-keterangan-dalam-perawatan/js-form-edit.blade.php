
	$(`:text[name="no_bpjs"]`).val(item.no_bpjs);
	$(`:text[name="no_sep"]`).val(item.no_sep);

	var terapi = JSON.parse(item.terapi);
	terapi.forEach(function(item, index){
		if(index > 0){
			add('terapi');
		}
		$(`:text[name="terapi[]"]`)[index].value = item;
	});

	$(`:text[name="tanggal_surat_rujukan"]`).val(formatDate(item.tanggal_surat_rujukan));
	$(`:text[name="no_rujukan"]`).val(item.no_rujukan);

	var alasan = JSON.parse(item.alasan);
	alasan.forEach(function(item, index){
		if(index > 0){
			add('alasan');
		}
		$(`:text[name="alasan[]"]`)[index].value = item;
	});

	var rencana_kunjungan = JSON.parse(item.rencana_kunjungan);
	rencana_kunjungan.forEach(function(item, index){
		if(index > 0){
			add('rencana_kunjungan');
		}
		$(`:text[name="rencana_kunjungan[]"]`)[index].value = item;
	});
	
	$(`:text[name="tanggal_surat_keterangan"]`).val(formatDate(item.tanggal_surat_keterangan));
	$(`:text[name="no_antrian"]`).val(item.no_antrian);