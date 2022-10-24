$('#buttonSubmit').click(function() {
	var kategori = $('#kategori').val();
	var tahunanggaran = $('#tahunanggaran').val();
	var id = $('#idtransaksi').val();
	console.log(tahunanggaran);
	
	if(kategori == '')
		callSwal('warning','Transaksi Gagal','Kategori/MA Tidak Boleh Kosong',0);
	else if(tahunanggaran == '')
		callSwal('warning','Transaksi Gagal','Tahun Anggaran Tidak Boleh Kosong',0);
	else{
		var formData = new FormData();
		formData.append('id', id);
		formData.append('kategori', kategori);
		formData.append('tahunanggaran', tahunanggaran);
		
		$('#buttonSubmit').hide();
		$('#buttonLoading').show();

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		// alert(kategori);
		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/spp/edit",
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

$('#preview-gambar-faktur').on('click', function(){
    $('#modal-preview-gambar-faktur').modal('show');
});
