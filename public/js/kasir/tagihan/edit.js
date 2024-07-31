//DECLARING FOR TRANSAKSI DETAIL USING X-EDITABLE

$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
	initEditable_(); // init previous data
	initSelect2Layanan(".layanan_");
	initTransaksi(); // init previous data to transaksi detail
});

var rowCount = document.getElementsByClassName("existRow").length;

function initTransaksi(){
	var countdetail = $('#countdetail').val();
	var i;
	var j;
	// alert(countdetail);
	for(i=1;i<=countdetail;i++){
		var detail_id = $('#detail_id'+i).val();
		var layanan_id = $('#layanan_id'+i).val();
		var nama = $('#layanan_nama'+i).val();
		var harga = $('#harga'+i).val();
		var tipe = $('#tipe'+i).val();
		var kelas = $('#kelas'+i).val();
		var jumlah = $('#jumlah'+i).val();
		var diskon = $('#diskon'+i).val();
		var subtotal_number = (harga*(100-diskon)/100) * jumlah;
		var created_at = $('#created_at'+i).val();
		var created_by = $('#created_by'+i).val();
		var departemen_id = $('#departemen_id'+i).val();
		
		// alert("kelas"+kelas);
		var tipe_option = [];
		var kelas_option = [];
		$('#tipe'+i+' option').each(function(){
			if($(this).val()!=''){
				if($(this).val()==tipe){
					tipe_option.push({
						id: $(this).val(),
						text: $(this).text(),
						tarif_id: layanan_id,
						selected: true
					})
				}else{
					tipe_option.push({
						id: $(this).val(),
						text: $(this).text(),
						tarif_id: layanan_id
					})
				}	
			}
		});
		$('#kelas'+i+' option').each(function(){
			if($(this).val()!=''){
				if($(this).val()==kelas){
					kelas_option.push({
						id: $(this).text(),
						text: $(this).val(),
						tipe_id: tipe,
						tarif_id: layanan_id,
						selected: true
					})
				}else{
					kelas_option.push({
						id: $(this).val(),
						text: $(this).text(),
						tipe_id: tipe,
						tarif_id: layanan_id
					})
				}		
			}
		});
		$("#tipe"+i+" option").remove();
		$("#kelas"+i+" option").remove();
		// console.log(tipe_option);
		$(".tipe"+i).select2({
			data : tipe_option
		});
		$(".kelas"+i).select2({
			data : kelas_option
		});
		
		backboneAddTransaksiDetail(i,detail_id,layanan_id,nama,jumlah,harga,diskon,subtotal_number,tipe,kelas,created_at,created_by,departemen_id);
	}
}

function initEditable_(){

	$('.jumlah_').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var jumlah = newValue;
			var harga = $(this).parent().siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
			var tipe = $(this).parent().siblings(".tipe-par_").children('.tipe_').editable('getValue').undefined;
			var kelas = $(this).parent().siblings(".kelas-par_").children('.kelas_').editable('getValue').undefined;
			var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
			var subtotal = $(this).parent().siblings(".subtotal_");
            var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id);
		}
	});

	$('.harga_').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		display: function(value) {
			$(this).text('Rp ' + numeral(value).format('0,0'));
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var jumlah = $(this).parent().siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
			var harga = newValue;
			var tipe = $(this).parent().siblings(".tipe-par_").children('.tipe_').editable('getValue').undefined;
			var kelas = $(this).parent().siblings(".kelas-par_").children('.kelas_').editable('getValue').undefined;
			var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
			var subtotal = $(this).parent().siblings(".subtotal_");
            var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id);
		}
	});

	$('.diskon_').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		display: function(value) {
			$(this).text(value + ' %');
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var jumlah =  $(this).parent().siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
			var harga = $(this).parent().siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
			var tipe = $(this).parent().siblings(".tipe-par_").children('.tipe_').editable('getValue').undefined;
			var kelas = $(this).parent().siblings(".kelas-par_").children('.kelas_').editable('getValue').undefined;
			var diskon = newValue;
			var subtotal = $(this).parent().siblings(".subtotal_");
            var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id);
		}
	});

	$('.kelas_').select2();
	$('.tipe_').select2();

	$('.kelas_').editable({
		disabled : false,
		showbuttons : false,
		inputclass: 'form-control',
	});

	$('.tipe_').editable({
		disabled : false,
		showbuttons : false,
		inputclass: 'form-control',
	});

	$('.kelas_').on('select2:select', function (e) {
		var data2 = e.params.data;
		// alert(data2.tarif_id);
	
		var harga2 = $(this).parent().siblings(".harga-par_").children('.harga_');
		harga2.editable('setValue',data2.id);
		
		var jumlah = $(this).parent().siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
		var tipe =  data2.tipe_id;
		var kelas = data2.text;
		var harga = $(this).parent().siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
		var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
		var subtotal = $(this).parent().siblings(".subtotal_");
		var departemen_id = $(this).parent().siblings(".departemen-par_").children('.departemen_').editable('getValue').undefined;
		var id = $(this).data("pk");

		updateRecord2(jumlah,harga,diskon,subtotal,id,tipe,kelas,data2.tarif_id,data2.tarif_name,departemen_id);

	});

	$('.tipe_').on('select2:select', function (e) {
		var data2 = e.params.data;
		// alert(data2.id);
	
		var kelas2 = $(this).parent().siblings(".kelas-par_").children('.kelas_');
		var harga2 = $(this).parent().siblings(".harga-par_").children('.harga_');
		
		var pk = $(this).data("pk");

		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/tarif/getdetail",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id : data2.tarif_id,
				tipe : data2.id
			},
			success: function (data) {
				var option2 = [];
				option2.push({
					id: '',
					text: '',
				});
				if(data.biasa != null && data.biasa > 0){
					option2.push({
						id: data.biasa,
						text: 'Biasa',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.urj != null && data.urj > 0){
					option2.push({
						id: data.urj,
						text: 'URJ',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.igd != null && data.igd > 0){
					option2.push({
						id: data.igd,
						text: 'IGD',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.vvip != null && data.vvip > 0){
					option2.push({
						id: data.vvip,
						text: 'VVIP',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.vip_a != null && data.vip_a > 0){
					option2.push({
						id: data.vip_a,
						text: 'VIP A',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.vip_paviliun != null && data.vip_paviliun > 0){
					option2.push({
						id: data.vip_paviliun,
						text: 'VIP Paviliun',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.i_paviliun != null && data.i_paviliun > 0){
					option2.push({
						id: data.i_paviliun,
						text: 'I Paviliun',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.vip_ruangan != null && data.vip_ruangan > 0){
					option2.push({
						id: data.vip_ruangan,
						text: 'VIP Ruangan',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.i_a != null && data.i_a > 0){
					option2.push({
						id: data.i_a,
						text: 'I A',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.i_b != null && data.i_b > 0){
					option2.push({
						id: data.i_b,
						text: 'I B',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.ii != null && data.ii > 0){
					option2.push({
						id: data.ii,
						text: 'II',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.iii_ac != null && data.iii_ac > 0){
					option2.push({
						id: data.iii_ac,
						text: 'III AC',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.iii_non_ac != null && data.iii_non_ac > 0){
					option2.push({
						id: data.iii_non_ac,
						text: 'III Non AC',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				// alert(option);
				$("#kelas"+pk+" option").remove();
				kelas2.select2({
					data: option2
				});
			}
		});
		// alert(data2.id);
		kelas2.editable('option', 'disabled', false);
		harga2.editable('setValue',0);
		var jumlah = $(this).parent().siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
		var tipe = data2.id;
		var kelas = '';
		var harga = $(this).parent().siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
		var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
		var subtotal = $(this).parent().siblings(".subtotal_");
		var departemen_id = $(this).parent().siblings(".departemen-par_").children('.departemen_').editable('getValue').undefined;
		var id = $(this).data("pk");

		updateRecord2(jumlah,harga,diskon,subtotal,id,tipe,kelas,data2.tarif_id,data2.tarif_name,departemen_id);


	});

	$('.layanan_').on('select2:select', function (e) {
		var data2 = e.params.data;
		// alert(data2.id);
        var id_detail = $(this).parent(".layanan-par_").siblings(".id-detail-par_").children('.id-detail_');
		var harga = $(this).parent(".layanan-par_").siblings(".harga-par_").children('.harga_');
		var tipe = $(this).parent(".layanan-par_").siblings(".tipe-par_").children('.tipe_');
		var kelas = $(this).parent(".layanan-par_").siblings(".kelas-par_").children('.kelas_');
		var jumlah = $(this).parent(".layanan-par_").siblings(".jumlah-par_").children('.jumlah_');
		var diskon = $(this).parent(".layanan-par_").siblings(".diskon-par_").children('.diskon_');
		var subtotal = $(this).parent(".layanan-par_").siblings(".subtotal_");
		var departemen_id = $(this).parent(".layanan-par_").siblings(".departemen-par_").children('.departemen_');
		var pk = $(this).data("pk");

		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/tarif/getalldetail",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id : data2.id
			},
			success: function (data) {
				// alert(data[0].tarif_tipe_id);
				var option = [];
				option.push({
					id: '',
					text: '',
				});
				for (i in data) {
					option.push({
						id: data[i].tarif_tipe_id,
						text: data[i].tipe.name,
						tarif_id: data[i].tarif_id,
            tarif_name: data[i].origin.deskripsi,
					});
				}
				// alert(pk);
				$("#tipe"+pk+" option").remove();
				$("#kelas"+pk+" option").remove();
				tipe.select2({
					data: option
				})
			}
		});

		harga.editable('option', 'disabled', false);
		tipe.editable('option', 'disabled', false);
		kelas.editable('option', 'disabled', true);
		jumlah.editable('option', 'disabled', false);
		diskon.editable('option', 'disabled', false);

		id = $(this).data("pk");
		harga.editable('setValue',0);
		jumlah.editable('setValue',1);
		diskon.editable('setValue',0);
		departemen_id.editable('setValue',data2.departemen_id);
		
		subtotal_number = 0;
		subtotal_number_formatted = numeral(subtotal_number).format('0,0');

		subtotal.html('Rp ' + subtotal_number_formatted);

		backboneUpdateTransaksi2(1,0,0,subtotal_number,id,'','',data2.id,data2.deskripsi,data2.departemen_id);
	});

	$('button.remove_').click(function(){
		var layanan = $(this).parent(".remove-par_").siblings(".layanan-par_").children('.layanan_');
		var harga = $(this).parent(".remove-par_").siblings(".harga-par_").children('.harga_');
		var tipe = $(this).parent(".remove-par_").siblings(".tipe-par_").children('.tipe_');
		var kelas = $(this).parent(".remove-par_").siblings(".kelas-par_").children('.kelas_');
		var jumlah = $(this).parent(".remove-par_").siblings(".jumlah-par_").children('.jumlah_');
		var diskon = $(this).parent(".remove-par_").siblings(".diskon-par_").children('.diskon_');
		var subtotal = $(this).parent(".remove-par_").siblings(".subtotal_");

		var id = diskon.data("pk")
		if(rowCount == 1){
			layanan.val('').trigger('change');
			harga.editable('setValue', 0);
			jumlah.editable('setValue', 0);
			diskon.editable('setValue', 0);
			subtotal.html("Rp 0");
	
			harga.editable('option', 'disabled', true);
			tipe.editable('option', 'disabled', true);
			kelas.editable('option', 'disabled', true);
			jumlah.editable('option', 'disabled', true);
			diskon.editable('option', 'disabled', true);
			
			$("#tipe"+id+" option").remove();
			$("#kelas"+id+" option").remove();
		}
		else{
			deleteRow('transaksiRow'+id);
			rowCount--;
		}
		var transaksidetail = transaksiCollection.findWhere({pk_id: id});
		backboneUpdateTransaksi(0,0,0,0,1,id);

	});

}


function initEditable(){
	$('.jumlah').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : true,
		onblur : 'submit',
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var jumlah = newValue;
			var tipe = $(this).parent().siblings(".tipe-par").children('.tipe').editable('getValue').undefined;
			var kelas = $(this).parent().siblings(".kelas-par").children('.kelas').editable('getValue').undefined;
			var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
			var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
			var subtotal = $(this).parent().siblings(".subtotal");
			var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id);
		}
	});

	$('.harga').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : true,
		onblur : 'submit',
		display: function(value) {
			$(this).text('Rp ' + numeral(value).format('0,0'));
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
			var tipe = $(this).parent().siblings(".tipe-par").children('.tipe').editable('getValue').undefined;
			var kelas = $(this).parent().siblings(".kelas-par").children('.kelas').editable('getValue').undefined;
			var harga = newValue;
			var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
			var subtotal = $(this).parent().siblings(".subtotal");
			var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id);
		}
	});

	$('.diskon').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : true,
		onblur : 'submit',
		display: function(value) {
			$(this).text(value + ' %');
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var jumlah =  $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
			var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
			var tipe = $(this).parent().siblings(".tipe-par").children('.tipe').editable('getValue').undefined;
			var kelas = $(this).parent().siblings(".kelas-par").children('.kelas').editable('getValue').undefined;
			var diskon = newValue;
			var subtotal = $(this).parent().siblings(".subtotal");
			var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id);
		}
	});

	$('.kelas').select2();
	$('.tipe').select2();

	$('.kelas').editable({
		disabled : true,
		showbuttons : false,
		inputclass: 'form-control',
	});

	$('.tipe').editable({
		disabled : true,
		showbuttons : false,
		inputclass: 'form-control',
	});

	$('.kelas').on('select2:select', function (e) {
		var data2 = e.params.data;
		// alert(data2.tarif_id);
	
		var harga2 = $(this).parent().siblings(".harga-par").children('.harga');
		harga2.editable('setValue',data2.id);
		
		var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
		var tipe =  data2.tipe_id;
		var kelas = data2.text;
		var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
		var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
		var subtotal = $(this).parent().siblings(".subtotal");
		var departemen_id = $(this).parent().siblings(".departemen-par").children('.departemen').editable('getValue').undefined;
		var id = $(this).data("pk");

		updateRecord2(jumlah,harga,diskon,subtotal,id,tipe,kelas,data2.tarif_id,data2.tarif_name,departemen_id);

	});

	$('.tipe').on('select2:select', function (e) {
		var data2 = e.params.data;
		// alert(data2.tarif_id);
	
		var kelas2 = $(this).parent().siblings(".kelas-par").children('.kelas');
		var harga2 = $(this).parent().siblings(".harga-par").children('.harga');
		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/tarif/getdetail",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id : data2.tarif_id,
				tipe : data2.id
			},
			success: function (data) {
				var option2 = [];
				kelas2.select2({
					data: option2
				});
				option2.push({
					id: '',
					text: '',
				});
				if(data.biasa != null && data.biasa > 0){
					option2.push({
						id: data.biasa,
						text: 'Biasa',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.urj != null && data.urj > 0){
					option2.push({
						id: data.urj,
						text: 'URJ',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.igd != null && data.igd > 0){
					option2.push({
						id: data.igd,
						text: 'IGD',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.vvip != null && data.vvip > 0){
					option2.push({
						id: data.vvip,
						text: 'VVIP',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.vip_a != null && data.vip_a > 0){
					option2.push({
						id: data.vip_a,
						text: 'VIP A',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.vip_paviliun != null && data.vip_paviliun > 0){
					option2.push({
						id: data.vip_paviliun,
						text: 'VIP Paviliun',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.i_paviliun != null && data.i_paviliun > 0){
					option2.push({
						id: data.i_paviliun,
						text: 'I Paviliun',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.vip_ruangan != null && data.vip_ruangan > 0){
					option2.push({
						id: data.vip_ruangan,
						text: 'VIP Ruangan',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.i_a != null && data.i_a > 0){
					option2.push({
						id: data.i_a,
						text: 'I A',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.i_b != null && data.i_b > 0){
					option2.push({
						id: data.i_b,
						text: 'I B',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.ii != null && data.ii > 0){
					option2.push({
						id: data.ii,
						text: 'II',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.iii_ac != null && data.iii_ac > 0){
					option2.push({
						id: data.iii_ac,
						text: 'III AC',
						tipe_id: data.tarif_tipe_id,
            tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				if(data.iii_non_ac != null && data.iii_non_ac > 0){
					option2.push({
						id: data.iii_non_ac,
						text: 'III Non AC',
						tipe_id: data.tarif_tipe_id,
						tarif_id: data.tarif_id,
            tarif_name: data.origin.deskripsi
					});
				};
				// alert(option);
				kelas2.select2({
					data: option2
				});
			}
		});
		// alert(data2.id);
		kelas2.editable('option', 'disabled', false);
		harga2.editable('setValue',0);
		var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
		var tipe = data2.id;
		var kelas = $(this).parent().siblings(".kelas-par").children('.kelas').editable('getValue').undefined;
		var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
		var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
		var subtotal = $(this).parent().siblings(".subtotal");
		var departemen_id = $(this).parent().siblings(".departemen-par").children('.departemen').editable('getValue').undefined;
		var id = $(this).data("pk");

		updateRecord2(jumlah,harga,diskon,subtotal,id,tipe,kelas,data2.tarif_id,data2.tarif_name,departemen_id);


	});

	$('.layanan').on('select2:select', function (e) {
		var data2 = e.params.data;
		
		var harga = $(this).parent(".layanan-par").siblings(".harga-par").children('.harga');
		var tipe = $(this).parent(".layanan-par").siblings(".tipe-par").children('.tipe');
		var kelas = $(this).parent(".layanan-par").siblings(".kelas-par").children('.kelas');
		var jumlah = $(this).parent(".layanan-par").siblings(".jumlah-par").children('.jumlah');
		var diskon = $(this).parent(".layanan-par").siblings(".diskon-par").children('.diskon');
		var subtotal = $(this).parent(".layanan-par").siblings(".subtotal");
		var departemen_id = $(this).parent(".layanan-par").siblings(".departemen-par").children('.departemen');
		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/tarif/getalldetail",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id : data2.id
			},
			success: function (data) {
				var option = [];
				option.push({
					id: '',
					text: '',
				});
				// alert(data[0].tipe.name);
				for (i in data) {
					option.push({
						id: data[i].tarif_tipe_id,
						text: data[i].tipe.name,
            tarif_id: data[i].tarif_id,
            tarif_name: data[i].origin.deskripsi
					});
				}
				tipe.select2({
					data: option
				})
			}
		});
		harga.editable('option', 'disabled', false);
		tipe.editable('option', 'disabled', false);
		kelas.editable('option', 'disabled', true);
		jumlah.editable('option', 'disabled', false);
		diskon.editable('option', 'disabled', false);

		id = $(this).data("pk")
		harga.editable('setValue',0);
		jumlah.editable('setValue',1);
		diskon.editable('setValue',0);
		departemen_id.editable('setValue',data2.departemen_id);
		subtotal_number = 0;
		subtotal_number_formatted = numeral(subtotal_number).format('0,0');

    subtotal.html('Rp ' + subtotal_number_formatted);
    
    backboneAddTransaksiDetail(id,null,data2.id,data2.deskripsi,1,'','',subtotal_number,0,'',null,user,data2.departemen_id);

	});
	
	$('button.remove').click(function(){
		var layanan = $(this).parent(".remove-par").siblings(".layanan-par").children('.layanan');
		var harga = $(this).parent(".remove-par").siblings(".harga-par").children('.harga');
		var tipe = $(this).parent(".remove-par").siblings(".tipe-par").children('.tipe');
		var kelas = $(this).parent(".remove-par").siblings(".kelas-par").children('.kelas');
		var jumlah = $(this).parent(".remove-par").siblings(".jumlah-par").children('.jumlah');
		var diskon = $(this).parent(".remove-par").siblings(".diskon-par").children('.diskon');
		var subtotal = $(this).parent(".remove-par").siblings(".subtotal");

		var id = diskon.data("pk");
		
		//alert("row count"+rowCount);
		if(rowCount == 1){
			layanan.val('').trigger('change')
			harga.editable('setValue', 0);
			jumlah.editable('setValue', 0);
			diskon.editable('setValue', 0);
			
			subtotal.html("Rp 0");
	
			harga.editable('option', 'disabled', true);
			tipe.editable('option', 'disabled', true);
			kelas.editable('option', 'disabled', true);
			jumlah.editable('option', 'disabled', true);
			diskon.editable('option', 'disabled', true);
			
		}
		else{
			deleteRow('transaksiRow'+id);
			rowCount--;
		}
		// orderRow();
		var transaksidetail = transaksiCollection.findWhere({pk_id: id});
		if(typeof transaksidetail !== "undefined") var is_delete = 1;
		else var is_delete = 0; 
		if(is_delete)
		{
			transaksiCollection.remove(transaksidetail)
		}
		

		updateAllTotal();

	});

}

function deleteRow(rowid)  
{   
    var row = document.getElementById(rowid);
    row.parentNode.removeChild(row);
}

function destroySelect2()
{
	$(".layanan").select2("destroy")
}

function initSelect2Layanan(selector)
{
	$(selector).select2({
		ajax: {
			url: API_URL+"/keuangan/tarif",
			dataType: 'json',
			delay: 250,
			data: function (params) 
			{
				return {
					keyword: params.term,
					page: params.page
				};
			},
			processResults: function (data, params) {
                params.page = params.page || 1;
                // alert(data);
				return {
					results: data.data,
				};
			},
			cache: true
		},
		escapeMarkup: function (markup) { return markup; },
		minimumInputLength: 3,
		placeholder: "Cari Layanan",
		templateResult: formatLayanan,
		templateSelection: formatPasienSelection,
	});
}



function updateRecord(jumlah,harga,diskon,subtotal,id)
{
	subtotal_number = (harga * jumlah) - (harga*diskon/100*jumlah);
	subtotal_number_formatted = numeral(subtotal_number).format('0,0');

	subtotal.html('Rp ' + subtotal_number_formatted);

	backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,0,id);
}


function updateRecord2(jumlah,harga,diskon,subtotal,id,tipe,kelas,layanan_id,layanan_string,departemen_id) //update record w/ tipe, kelas, layanan id
{
	subtotal_number = (harga * jumlah) - (harga*diskon/100*jumlah);
	subtotal_number_formatted = numeral(subtotal_number).format('0,0');

	subtotal.html('Rp ' + subtotal_number_formatted);

	backboneUpdateTransaksi2(jumlah,harga,diskon,subtotal_number,id,tipe,kelas,layanan_id,layanan_string,departemen_id);
}

var globalJumlah = 0;
var globalDiskon = 0;
var globalTotal = 0;

function updateAllTotal()
{
	var subtotals = transaksiCollection.pluck("subtotal");
	var jumlahs = transaksiCollection.pluck("jumlah");
	var hargas = transaksiCollection.pluck("harga");
	var diskons = transaksiCollection.pluck("diskon");

	var allJumlah = 0;
	var allDiskon = 0;
	var allTotal = 0;

	$.each(subtotals, function( index, value ) {
		allJumlah+= hargas[index]*jumlahs[index]
		allDiskon+= hargas[index]*jumlahs[index]*diskons[index]/100
	});

	allTotal = allJumlah-allDiskon;

	globalTotal = allTotal;
	globalDiskon = allDiskon;
	globalJumlah = allJumlah;

	var allJumlahFormat = numeral(allJumlah).format('0,0');
	var allDiskonFormat = numeral(allDiskon).format('0,0');
	var allTotalFormat = numeral(allTotal).format('0,0');

	$('#allJumlah').html('Rp '+allJumlahFormat)
	$('#allDiskon').html('Rp '+allDiskonFormat)
	$('#allTotal').html('Rp '+allTotalFormat)
	//console.log(transaksiCollection);


}

//INITIATE SELECT2

$("#pasien").select2({
	ajax: {
		url: API_URL+"/pasien/get",
		dataType: 'json',
		delay: 250,
		data: function (params) 
		{
			return {
				keyword: params.term,
				page: params.page
			};
		},
		processResults: function (data, params) {
			params.page = params.page || 1;
			return {
				results: data.data,
			};
		},
		cache: true
	},
	escapeMarkup: function (markup) { return markup; },
	minimumInputLength: 3,
	placeholder: "Cari Pasien",
	templateResult: formatPasien,
	templateSelection: formatPasienSelection
});

//FORMAT DISPLAY
function formatPasien (item) {
	if (item.loading) {
		return item.text;
	}

	var markup = item.name

	return markup;
}

function formatLayanan (item) {
	if (item.loading) {
		return item.text;
	}

	var markup = item.deskripsi

	return markup;
}

//FORMAT UNTUK DI SHOW DI HTML
function formatPasienSelection (item) {
	return item.name || item.text || item.deskripsi;
}

$('#pasien').on('select2:select', function (e) {
	var data = e.params.data;
	// alert(data.id)
	$.ajax({
		type: "POST",
		url: API_URL + "/kasir/tagihan/getPasienPembayaran",
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data: {
			id : data.id
		},
		success: function (data) {
			var option = [];
			option.push({
				id: '',
				text: '',
			});
			console.log(data)
			// alert(data[0].tipe.name);
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].perusahaan.nama,
				});
			}
			$("#pasien-pembayaran option").remove();
			$('#pasien-pembayaran').select2({
				data: option
			})
		}
	});
})

$('#pasien-pembayaran').select2();

var TransaksiDetail = Backbone.Model.extend({
	defaults: {
		pk_id: "",
		id_detail: "",
		departemen_id: "",
		layanan_id: "",
		layanan_string: "",
		jumlah: "",
		tipe: "",
		kelas: "",
		harga: "",
		diskon: "",
		subtotal: "",
		is_deleted: 0,
		created_at: null,
		updated_at: null,
		created_by: null,
	},
	idAttribute: "id"
});

var Transaksi = Backbone.Collection.extend({
	model: TransaksiDetail,
	sort_key: 'pk_id'
});

var transaksiCollection = new Transaksi();

function backboneAddTransaksiDetail(id,detail_id,layanan_id,layanan_string,jumlah,harga,diskon,subtotal,tipe,kelas,created_at,created_by,departemen_id)
{
	if(transaksiCollection.length > 0)
	{
		var transaksidetail = transaksiCollection.findWhere({pk_id: id});
		if(typeof transaksidetail !== "undefined") var is_delete = 1;
		else var is_delete = 0; 
		if(is_delete)
		{
			transaksiCollection.remove(transaksidetail)
		}
	}
	var detail = new TransaksiDetail({ 
        pk_id:id,
		id_detail:detail_id,
		departemen_id:departemen_id,
		layanan_id: layanan_id,
		layanan_string: layanan_string,
		jumlah: jumlah,
		harga: harga,
		tipe: tipe,
		kelas: kelas,
        diskon: diskon,
		subtotal: subtotal,
		created_at: created_at,
		created_by: created_by
	});

    //alert(detail);
	transaksiCollection.add(detail);

	updateAllTotal();
}


function backboneUpdateTransaksi(jumlah,harga,diskon,subtotal,is_deleted,id)
{
	var transaksidetail = transaksiCollection.findWhere({pk_id: id});
	if(typeof transaksidetail !== "undefined") var exist = 1;
	else var exist = 0; 
	//console.log('exist : ' + exist);
	//console.log('id : ' + id);
	if(exist)
	{
		transaksidetail.set({
			pk_id: id,
			jumlah: jumlah,
			harga: harga,
			diskon: diskon,
			subtotal: subtotal,
			is_deleted: is_deleted
		});
	}
	updateAllTotal();
}

function backboneUpdateTransaksi2(jumlah,harga,diskon,subtotal,id,tipe,kelas,layanan_id,layanan_string,departemen_id)
{
	var transaksidetail = transaksiCollection.findWhere({pk_id: id});
	if(typeof transaksidetail !== "undefined") var exist = 1;
	else var exist = 0; 
	//console.log('exist : ' + exist);
	//console.log('id : ' + id);
	// alert(tipe);
	if(exist)
	{
		transaksidetail.set({
			pk_id: id,
			departemen_id:departemen_id,
      layanan_id: layanan_id,
      layanan_string: layanan_string,
			jumlah: jumlah,
			tipe: tipe,
			kelas: kelas,
			harga: harga,
			diskon: diskon,
			subtotal: subtotal,
		});
	}
	updateAllTotal();
}

/*BUTTON EVENT*/


var recordCount = $('#countdetail').val();
$('#tambahRecord').click(function() {
	recordCount++;
	content = '<tr id="transaksiRow'+ recordCount +'">'
  content+= '<th class="text-center" scope="row">'+ recordCount +'</th>'
	content+= '<td class=" text-view layanan-par">'
	content+= '<select class="js-select2 form-control layanan" id="select2Layanan'+ recordCount +'" data-pk="'+ recordCount +'" name="pasien" style="width: 100%;"></select>'
	content+= '</td>'
	content+= '<td class="d-none departemen-par">'
    content+= '<a href="#" class="departemen" data-type="text" data-pk="'+ recordCount +'"></a>'
    content+= '</td>'
	content+= '<td class=" text-center tipe-par">'
	content+= '<select class="js-select2 form-control tipe" data-pk="'+ recordCount +'" name="tipe" style="width: 100%;"></select>'
	content+= '</td>'
	content+= '<td class=" text-center kelas-par">'
	content+= '<select class="js-select2 form-control kelas" data-pk="'+ recordCount +'" name="kelas" style="width: 100%;"></select>'
	content+= '</td>'
	content+= '<td class="text-center jumlah-par"><a href="#" class="jumlah" data-type="number" data-pk="'+ recordCount +'" data-placeholder="Masukkan jumlah">0</a></td>'
	content+= '<td class="text-right harga-par"><a href="#" class="harga" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga Satuan">0</a></td>'
	content+= '<td class="text-center diskon-par"><a href="#" class="diskon" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Diskon %">0</a></td>'
	content+= '<td class="text-right  bg-warning-lighter subtotal">Rp 0</td>'
	content+= '<td class="text-right remove-par"><button class="btn btn-alt-danger btn-sm remove"><i class="fa fa-remove"></i></button></td>'
	content+= '</tr>'

	rowCount++;
	$('#transaksiTable tr:last').after(content);
	$('#transaksiRow'+recordCount).hide();
	initSelect2Layanan("#select2Layanan"+recordCount);
	initEditable(); // init data tambahan
	$('#transaksiRow'+recordCount).show();
});

$('#buttonSubmit').click(function() {
	var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
	console.log(transaksiCollectionJSON);
	var kasir_id = $('#idkasir').val();
	var pasien_id = $('#pasien').val();
	var asal_layanan = $('#asal-layanan').val();
	var judul = $("#judul").val();
	var pasien_pembayaran_id = $('#pasien-pembayaran').val();
	var lokasi_id = $("#lokasi").val();
	var kasus_tagihan_id = $('#kasus_tagihan').val();
	var numOfModels = transaksiCollection.filter(function(model) { 
		return model.get('is_deleted') == 1;
	  }).length;

	var tipe = transaksiCollection.findWhere({tipe: ''});
	var kelas = transaksiCollection.findWhere({kelas: ''});

	if(numOfModels == transaksiCollection.length)
		callSwal('warning','Transaksi Gagal','Transaksi Tidak Boleh Kosong',0);
	else if(pasien_id == null)
		callSwal('warning','Transaksi Gagal','Pasien Tidak Boleh Kosong',0);
	else if(asal_layanan == '')
		callSwal('warning','Transaksi Gagal','Asal Layanan Tidak Boleh Kosong',0);
	else if(judul == '')
		callSwal('warning','Transaksi Gagal','Judul Tidak Boleh Kosong',0);
	else if(pasien_pembayaran_id == '')
		callSwal('warning','Transaksi Gagal','Jenis Pembayaran Tidak Boleh Kosong',0);
	else if(lokasi_id == '')
		callSwal('warning','Transaksi Gagal','Lokasi Tidak Boleh Kosong',0);
	else if(typeof tipe !== "undefined") 
		callSwal('warning','Transaksi Gagal','Tipe Tidak Boleh Kosong',0);
	else if(typeof kelas !== "undefined") 
		callSwal('warning','Transaksi Gagal','Kelas Tidak Boleh Kosong',0);
	else{
		var transaksiCollectionJSON = JSON.stringify(transaksiCollection);

		$('#buttonSubmit').hide();
		$('#buttonLoading').show();

		console.log(transaksiCollection);
		console.log(transaksiCollectionJSON);
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var id = $('#idtransaksi').val();
		var created_at = $('#created_at').val();
		// alert(id);

		$.ajax({
			type: "POST",
			url: API_URL + "/kasir/tagihan/edit",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id : id,
				kasir_id: kasir_id,
				pasien_id : pasien_id,
				asal_layanan : asal_layanan,
				judul : judul,
				pasien_pembayaran_id : pasien_pembayaran_id,
				lokasi_id : lokasi_id,
				kasus_tagihan_id : kasus_tagihan_id,
				created_at : created_at,
				updated_at : null,
				transaksi: transaksiCollectionJSON,
				alltotal : globalTotal,
				alldiskon : globalDiskon,
				alljumlah : globalJumlah
			},
			success: function (data) {
				callSwal(data.type,data.title,data.text,data.url);
				$('#buttonSubmit').show();
				$('#buttonLoading').hide();

			},
			error: function () {
				callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
				$('#buttonSubmit').show();
				$('#buttonLoading').hide();
			}
		});
	}
});
