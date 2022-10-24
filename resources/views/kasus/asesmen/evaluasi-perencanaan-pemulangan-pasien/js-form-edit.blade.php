
			tanggal = moment(item.tanggal)
			tanggal = tanggal.format("DD/MM/YYYY")
			$(`:text[name="tanggal"]`).val(tanggal);
			$(`:text[name="jam"]`).val(item.jam);
			$(`:text[name="implementasi_p3"]`).val(item.implementasi_p3);
			$(`:text[name="evaluasi"]`).val(item.evaluasi);
			$(`:text[name="materi"]`).val(item.materi);