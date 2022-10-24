
	$(`:text[name="tanggal"]`).val(formatDate(item.tanggal));
	$(`:radio[name="mengendalikan_rangsang_pembuangan_tinja"][value="${item.mengendalikan_rangsang_pembuangan_tinja}"]`).prop("checked", true);
	$(`:radio[name="mengendalikan_rangsang_berkemih"][value="${item.mengendalikan_rangsang_berkemih}"]`).prop("checked", true);
	$(`:radio[name="membersihkan_diri"][value="${item.membersihkan_diri}"]`).prop("checked", true);
	$(`:radio[name="penggunaan_jamban"][value="${item.penggunaan_jamban}"]`).prop("checked", true);
	$(`:radio[name="makan"][value="${item.makan}"]`).prop("checked", true);
	$(`:radio[name="berubah_sikap"][value="${item.berubah_sikap}"]`).prop("checked", true);
	$(`:radio[name="berpindah_atau_berjalan"][value="${item.berpindah_atau_berjalan}"]`).prop("checked", true);
	$(`:radio[name="memakai_baju"][value="${item.memakai_baju}"]`).prop("checked", true);
	$(`:radio[name="naik_turun_tangga"][value="${item.naik_turun_tangga}"]`).prop("checked", true);
	$(`:radio[name="mandi"][value="${item.mandi}"]`).prop("checked", true);