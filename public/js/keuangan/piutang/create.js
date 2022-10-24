//DECLARING FOR TRANSAKSI DETAIL USING X-EDITABLE

$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
	initEditable();
	initSelect2Layanan(".layanan");

	$.ajax({
		type: "GET",
		url: API_URL + "/kasir/tagihan/getLokasi",
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
					text: data[i].nama,
				});
			}
			$('#lokasi').select2({
				data: option
			})
		}
	});
});

var rowCount = document.getElementsByClassName("existRow").length;

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
			var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
			var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
		}
	});

	$('.keterangan').editable({
		inputclass: 'form-control',
		defaultValue : '',
		disabled : true,
		showbuttons : false,
		onblur : 'submit',
		rows : 2,
		success: function(response, newValue) {
			var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;;
			var tipe = $(this).parent().siblings(".tipe-par").children('.tipe').editable('getValue').undefined;
			var kelas = $(this).parent().siblings(".kelas-par").children('.kelas').editable('getValue').undefined;
			var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
			var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
			var subtotal = $(this).parent().siblings(".subtotal");
			var keterangan = newValue;
			var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
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
			var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
			var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
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
			var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
			var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
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
		var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
		var id = $(this).data("pk");

		updateRecord2(jumlah,harga,diskon,subtotal,id,keterangan,tipe,kelas);

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
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.urj != null && data.urj > 0){
					option2.push({
						id: data.urj,
						text: 'URJ',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.igd != null && data.igd > 0){
					option2.push({
						id: data.igd,
						text: 'IGD',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.vvip != null && data.vvip > 0){
					option2.push({
						id: data.vvip,
						text: 'VVIP',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.vip_a != null && data.vip_a > 0){
					option2.push({
						id: data.vip_a,
						text: 'VIP A',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.vip_paviliun != null && data.vip_paviliun > 0){
					option2.push({
						id: data.vip_paviliun,
						text: 'VIP Paviliun',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.i_paviliun != null &&data.i_paviliun > 0){
					option2.push({
						id: data.i_paviliun,
						text: 'I Paviliun',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.vip_ruangan != null && data.vip_ruangan > 0){
					option2.push({
						id: data.vip_ruangan,
						text: 'VIP Ruangan',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.i_a != null && data.i_a > 0){
					option2.push({
						id: data.i_a,
						text: 'I A',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.i_b != null && data.i_b > 0){
					option2.push({
						id: data.i_b,
						text: 'I B',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.ii != null && data.ii > 0){
					option2.push({
						id: data.ii,
						text: 'II',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.iii_ac != null && data.iii_ac > 0){
					option2.push({
						id: data.iii_ac,
						text: 'III AC',
						tipe_id: data.tarif_tipe_id
					});
				};
				if(data.iii_non_ac != null && data.iii_non_ac > 0){
					option2.push({
						id: data.iii_non_ac,
						text: 'III Non AC',
						tipe_id: data.tarif_tipe_id
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
		var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
		var id = $(this).data("pk");

		updateRecord2(jumlah,harga,diskon,subtotal,id,keterangan,tipe,kelas);


	});

	$('.layanan').on('select2:select', function (e) {
		var data2 = e.params.data;
		
		var harga = $(this).parent(".layanan-par").siblings(".harga-par").children('.harga');
		var tipe = $(this).parent(".layanan-par").siblings(".tipe-par").children('.tipe');
		var kelas = $(this).parent(".layanan-par").siblings(".kelas-par").children('.kelas');
		var jumlah = $(this).parent(".layanan-par").siblings(".jumlah-par").children('.jumlah');
		var diskon = $(this).parent(".layanan-par").siblings(".diskon-par").children('.diskon');
		var subtotal = $(this).parent(".layanan-par").siblings(".subtotal");
		var keterangan = $(this).parent(".layanan-par").siblings(".keterangan-par").children('.keterangan');

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
		keterangan.editable('option', 'disabled', false);

		id = $(this).data("pk")
		harga.editable('setValue',0);
		jumlah.editable('setValue',1);
		diskon.editable('setValue',0);
		keterangan.editable('setValue','');

		subtotal_number = 0;
		subtotal_number_formatted = numeral(subtotal_number).format('0,0');

		subtotal.html('Rp ' + subtotal_number_formatted);

		backboneAddTransaksiDetail(id,data2.id,data2.deskripsi,1,0,'',subtotal_number,data2.departemen_id);

	});
	
	$('button.remove').click(function(){
		var layanan = $(this).parent(".remove-par").siblings(".layanan-par").children('.layanan');
		var harga = $(this).parent(".remove-par").siblings(".harga-par").children('.harga');
		var tipe = $(this).parent(".remove-par").siblings(".tipe-par").children('.tipe');
		var kelas = $(this).parent(".remove-par").siblings(".kelas-par").children('.kelas');
		var jumlah = $(this).parent(".remove-par").siblings(".jumlah-par").children('.jumlah');
		var diskon = $(this).parent(".remove-par").siblings(".diskon-par").children('.diskon');
		var subtotal = $(this).parent(".remove-par").siblings(".subtotal");
		var keterangan = $(this).parent(".remove-par").siblings(".keterangan-par").children('.keterangan');

		var id = keterangan.data("pk");
		
		//alert("row count"+rowCount);
		if(rowCount == 1){
			layanan.val('').trigger('change')
			harga.editable('setValue', 0);
			jumlah.editable('setValue', 0);
			diskon.editable('setValue', 0);
			keterangan.editable('setValue', '');
			subtotal.html("Rp 0");
	
			harga.editable('option', 'disabled', true);
			tipe.editable('option', 'disabled', true);
			kelas.editable('option', 'disabled', true);
			jumlah.editable('option', 'disabled', true);
			diskon.editable('option', 'disabled', true);
			keterangan.editable('option', 'disabled', true);
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

function updateRecord(jumlah,harga,diskon,subtotal,id,keterangan)
{
	subtotal_number = (harga * jumlah) - (harga*diskon/100*jumlah);
	subtotal_number_formatted = numeral(subtotal_number).format('0,0');

	subtotal.html('Rp ' + subtotal_number_formatted);

	backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,id);
}

function updateRecord2(jumlah,harga,diskon,subtotal,id,keterangan,tipe,kelas) //update record w/ tipe and kelas
{
	subtotal_number = (harga * jumlah) - (harga*diskon/100*jumlah);
	subtotal_number_formatted = numeral(subtotal_number).format('0,0');

	subtotal.html('Rp ' + subtotal_number_formatted);

	backboneUpdateTransaksi2(jumlah,harga,diskon,subtotal_number,keterangan,id,tipe,kelas);
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
$("#kategori").select2();

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
					perusahaan_keuangan_id : data[i].perusahaan.perusahaan_keuangan_id
				});
			}
			$('#pasien-pembayaran').select2({
				data: option
			})
		}
	});
})

$('#pasien-pembayaran').select2();

$('#pasien-pembayaran').on('select2:select', function (e) {
	var data = e.params.data;
	document.getElementById("perusahaan").value = data.perusahaan_keuangan_id;
})


var TransaksiDetail = Backbone.Model.extend({
	defaults: {
		pk_id: "",
		departemen_id: "",
		layanan_id: "",
		layanan_string: "",
		jumlah: "",
		tipe: "",
		kelas: "",
		harga: "",
		diskon: "",
		subtotal: "",
		keterangan:"",
		created_at: null,
		updated_at: null,
		tagihan_id: null
	},
	idAttribute: "id"
});

var Transaksi = Backbone.Collection.extend({
	model: TransaksiDetail,
	sort_key: 'pk_id'
});

var transaksiCollection = new Transaksi();


function backboneAddTransaksiDetail(id,layanan_id,layanan_string,jumlah,harga,diskon,subtotal,departemen_id)
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
		departemen_id:departemen_id,
		layanan_id: layanan_id,
		layanan_string: layanan_string,
		jumlah: jumlah,
		harga: harga,
		diskon: diskon,
		subtotal: subtotal
	});

	transaksiCollection.add(detail);

	updateAllTotal();
}


function backboneUpdateTransaksi(jumlah,harga,diskon,subtotal,keterangan,id)
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
			keterangan:keterangan
		});
	}
	updateAllTotal();
}

function backboneUpdateTransaksi2(jumlah,harga,diskon,subtotal,keterangan,id,tipe,kelas)
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
			jumlah: jumlah,
			tipe: tipe,
			kelas: kelas,
			harga: harga,
			diskon: diskon,
			subtotal: subtotal,
			keterangan:keterangan
		});
	}
	updateAllTotal();
}

/*BUTTON EVENT*/
var recordCount = rowCount;
$('#tambahRecord').click(function() {
	recordCount++;
	content = '<tr id="transaksiRow'+ recordCount +'">'
	content+= '<th class="text-center" scope="row">'+ recordCount +'</th>'
	content+= '<td class=" text-view layanan-par">'
	content+= '<select class="js-select2 form-control layanan" id="select2Layanan'+ recordCount +'" data-pk="'+ recordCount +'" name="pasien" style="width: 100%;"></select>'
	content+= '</td>'
	content+= '<td class=" text-center tipe-par">'
	content+= '<select class="js-select2 form-control tipe" data-pk="'+ recordCount +'" name="tipe" style="width: 100%;"></select>'
	content+= '</td>'
	content+= '<td class=" text-center kelas-par">'
	content+= '<select class="js-select2 form-control kelas" data-pk="'+ recordCount +'" name="kelas" style="width: 100%;"></select>'
	content+= '</td>'
	content+= '<td class="text-center keterangan-par"><a href="#" class="keterangan" data-type="textarea" data-pk="'+ recordCount +'" data-placeholder="Opsional"></a></td>'
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
	initEditable();
	$('#transaksiRow'+recordCount).show();

	
});

$('#buttonSubmit').click(function() {
	var pasien_id = $('#pasien').val();
	var pihak_3 = $('#pihak3').val();
	var tanggal = $('#tanggaltransaksi').val();
	var judul = $('#judul').val();
	var kategori = $('#kategori').val();
	var tipe = transaksiCollection.findWhere({tipe: ''});
	var kelas = transaksiCollection.findWhere({kelas: ''});
	var pasien_pembayaran_id = $('#pasien-pembayaran').val();
	var lokasi_id = $("#lokasi").val();
	var perusahaan_id = $('#perusahaan').val();
		
	if(tanggal == '')
		callSwal('warning','Transaksi Gagal','Tanggal Tidak Boleh Kosong',0);
	else if(transaksiCollection.length < 1)
		callSwal('warning','Transaksi Gagal','Transaksi Tidak Boleh Kosong',0);
	else if(kategori == '')
		callSwal('warning','Transaksi Gagal','Kategori Tidak Boleh Kosong',0);
	else if(judul == '')
		callSwal('warning','Transaksi Gagal','Judul Tidak Boleh Kosong',0);
	else if(pasien_id == null)
		callSwal('warning','Transaksi Gagal','Pasien Tidak Boleh Kosong',0);
	else if(pihak_3 == '')
		callSwal('warning','Transaksi Gagal','Pihak ke 3 Tidak Boleh Kosong',0);
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
		
		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/piutang/baru",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id : null,
				judul: judul,
				pasien_id : pasien_id,
				pihak_3 : pihak_3,
				pasien_pembayaran_id : pasien_pembayaran_id,
				lokasi_id : lokasi_id,
				kasus_tagihan_id : null,
				perusahaan_id : perusahaan_id,
				tanggal : tanggal,
				created_at : null,
				updated_at : null,
				kategori : kategori,
				transaksi: transaksiCollectionJSON,
				alltotal : globalTotal,
				alldiskon : globalDiskon,
				alljumlah : globalJumlah
			},

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
