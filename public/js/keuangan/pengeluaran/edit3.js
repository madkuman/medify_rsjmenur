$('#buttonSubmit').click(function() {
	var akun = $('#akun').val();
	var tanggalbk = $('#tanggalbk').val();
	var nobk = $('#nobk').val();
	var id = $('#idtransaksi').val();
	
	if(akun == '')
		callSwal('warning','Transaksi Gagal','Akun Pembayaran Tidak Boleh Kosong',0);
	else if(tanggalbk == '')
		callSwal('warning','Transaksi Gagal','Tanggal BK Tidak Boleh Kosong',0);
	else if(nobk == '')
		callSwal('warning','Transaksi Gagal','No BK Tidak Boleh Kosong',0);
	else{
		var formData = new FormData();
		formData.append('id', id);
		formData.append('akun', akun);
		formData.append('tanggalbk', tanggalbk);
		formData.append('nobk', nobk);
		
		$('#buttonSubmit').hide();
		$('#buttonLoading').show();

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		// alert(kategori);
		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/pengeluaran/edit",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: formData,
		    cache: false,
		    contentType: false,
		    processData: false,

			success: function (data) {
				callSwal(data.type,data.title,data.text,data.url);
				$('#buttonSubmit').show();
				$('#buttonLoading').hide();
				//$('#buttonLoading').fadeOut();

			},
			error: function () {
				callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
				$('#buttonSubmit').show();
				$('#buttonLoading').hide();
			}
		});
	}
});