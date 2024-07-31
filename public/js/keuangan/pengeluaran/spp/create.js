//DECLARING FOR TRANSAKSI DETAIL USING X-EDITABLE

$('#nopjk').on('change', function() {
	var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

	$.ajax({
		type: "GET",
		url: API_URL + "/keuangan/utang/" + valueSelected,
		dataType: "json",
		success: function (data) {
			var link = BASE_URL + data.photo_faktur;
			var date = new Date(data.tanggal_transaksi);
			$('#tanggaltransaksi').val(date.toShortFormat());
			$('#perusahaan').append($('<option>', {
			    value: data.perusahaan_id,
			    text: data.perusahaan.nama
			}));
			$('#idtransaksi').val(data.id);
			$('#jumlah').val("Rp. "+numeral(data.total).format('0,0'));
			$('#nofaktur').val(data.no_faktur);
			$('#judul').val(data.judul);
			$('#preview-gambar-faktur').attr('src', link);
            $('#modal-faktur').attr('src', link);
			$('.pjk-detail').show();
		},
		error: function () {
			callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
		}
	});
});

$('#buttonSubmit').click(function() {
	var tanggalspp = $('#tanggalspp').val();
	var kategori = $('#kategori').val();
	var tahunanggaran = $('#tahunanggaran').val();
	var id = $('#idtransaksi').val();
	console.log(tahunanggaran);
	
	if(tanggalspp == '')
		callSwal('warning','Transaksi Gagal','Tanggal SPP Tidak Boleh Kosong',0);
	else if(kategori == '')
		callSwal('warning','Transaksi Gagal','Kategori/MA Tidak Boleh Kosong',0);
	else if(tahunanggaran == '')
		callSwal('warning','Transaksi Gagal','Tahun Anggaran Tidak Boleh Kosong',0);
	else{
		var formData = new FormData();
		formData.append('id', id);
		formData.append('tanggalspp', tanggalspp);
		formData.append('kategori', kategori);
		formData.append('tahunanggaran', tahunanggaran);
		
		$('#buttonSubmit').hide();
		$('#buttonLoading').show();

		// console.log(transaksiCollection);
		// console.log(transaksiCollectionJSON);
		// for (var pair of formData.entries()) {
		//     console.log(pair[0]+ ', ' + pair[1]); 
		// }
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		// alert(kategori);
		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/spp/baru",
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

Date.prototype.toShortFormat = function() {

    var month_names =["January","February","March",
                      "April","May","June",
                      "July","August","September",
                      "October","November","December"];
    
    var day = this.getDate();
    var month_index = this.getMonth();
    var year = this.getFullYear();
    
    return "" + day + " " + month_names[month_index] + " " + year;
 }
