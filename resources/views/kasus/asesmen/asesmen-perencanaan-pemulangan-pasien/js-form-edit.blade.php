
			$(`:radio[name="usia"][value="${item.usia}"]`).prop("checked", true);
			$(`:radio[name="dukungan_sosial"][value="${item.dukungan_sosial}"]`).prop("checked", true);
			$(`:radio[name="riwayat_perawatan"][value="${item.riwayat_perawatan}"]`).prop("checked", true);
			$(`:radio[name="masalah_medis_saat_ini"][value="${item.masalah_medis_saat_ini}"]`).prop("checked", true);
			$(`:radio[name="jumlah_obat_yang_dikonsumsi"][value="${item.jumlah_obat_yang_dikonsumsi}"]`).prop("checked", true);
			$(`:radio[name="status_kognitif"][value="${item.status_kognitif}"]`).prop("checked", true);
			$(`:radio[name="status_fungsional"][value="${item.status_fungsional}"]`).prop("checked", true);
			$(`:radio[name="masalah_perilaku"][value="${item.masalah_perilaku}"]`).prop("checked", true);
			$(`:radio[name="masalah_mobilitas"][value="${item.masalah_mobilitas}"]`).prop("checked", true);
			$(`:radio[name="masalah_sensori"][value="${item.masalah_sensori}"]`).prop("checked", true);
			$(`:text[name="total_a"]`).val(item.total_a);
			$(`:text[name="total_b"]`).val(item.total_b);
			$(`:text[name="total_a_dan_total_b"]`).val(item.total_a_dan_total_b);