//DECLARING FOR TRANSAKSI DETAIL USING X-EDITABLE

$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
	initEditable();

	$.ajax({
		type: "GET",
		url: API_URL + "/keuangan/perusahaan/get",
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
					text: data[i].nama+' ('+data[i].direktur+')',
				});
			}
			$('#perusahaan').select2({
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
			var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
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
			var kelas = $(this).parent().siblings(".kelas-par").children('.kelas').editable('getValue').undefined;
			var diskon = newValue;
			var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
			var subtotal = $(this).parent().siblings(".subtotal");
			var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
			var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
		}
	});

	$('.layanan').editable({
		inputclass: 'form-control',
		defaultValue : '',
		emptytext : 'Masukkan Deskripsi',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			
			var harga = $(this).parent(".layanan-par").siblings(".harga-par").children('.harga');
			var jumlah = $(this).parent(".layanan-par").siblings(".jumlah-par").children('.jumlah');
			var diskon = $(this).parent(".layanan-par").siblings(".diskon-par").children('.diskon');
			var subtotal = $(this).parent(".layanan-par").siblings(".subtotal");
			var keterangan = $(this).parent(".layanan-par").siblings(".keterangan-par").children('.keterangan');
			
			harga.editable('option', 'disabled', false);
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

			backboneAddTransaksiDetail(id,newValue,1,0,'',subtotal_number);
		}
	});
	
	$('button.remove').click(function(){
		var layanan = $(this).parent(".remove-par").siblings(".layanan-par").children('.layanan');
		var harga = $(this).parent(".remove-par").siblings(".harga-par").children('.harga');
		var jumlah = $(this).parent(".remove-par").siblings(".jumlah-par").children('.jumlah');
		var diskon = $(this).parent(".remove-par").siblings(".diskon-par").children('.diskon');
		var subtotal = $(this).parent(".remove-par").siblings(".subtotal");
		var keterangan = $(this).parent(".remove-par").siblings(".keterangan-par").children('.keterangan');

		var id = keterangan.data("pk");
		
		//alert("row count"+rowCount);
		if(rowCount == 1){
			layanan.editable('setValue', '');
			harga.editable('setValue', 0);
			jumlah.editable('setValue', 0);
			diskon.editable('setValue', 0);
			keterangan.editable('setValue', '');
			subtotal.html("Rp 0");
	
			harga.editable('option', 'disabled', true);
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


function updateRecord(jumlah,harga,diskon,subtotal,id,keterangan)
{
	subtotal_number = (harga * jumlah) - (harga*diskon/100*jumlah);
	subtotal_number_formatted = numeral(subtotal_number).format('0,0');

	subtotal.html('Rp ' + subtotal_number_formatted);

	backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,id);
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

var TransaksiDetail = Backbone.Model.extend({
	defaults: {
		pk_id: "",
		layanan_string: "",
		jumlah: "",
		harga: "",
		diskon: "",
		subtotal: "",
		keterangan:""
	},
	idAttribute: "id"
});

var Transaksi = Backbone.Collection.extend({
	model: TransaksiDetail,
	sort_key: 'pk_id'
});

var transaksiCollection = new Transaksi();


function backboneAddTransaksiDetail(id,layanan_string,jumlah,harga,diskon,subtotal)
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

/*BUTTON EVENT*/
var recordCount = rowCount;
$('#tambahRecord').click(function() {
	recordCount++;
	content = '<tr id="transaksiRow'+ recordCount +'">'
	content+= '<th class="text-center" scope="row">'+ recordCount +'</th>'
	content+= '<td class=" text-view layanan-par">'
	content+= '<a href="#" class="layanan" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Masukkan Deskripsi"></a>'
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
	initEditable();
	$('#transaksiRow'+recordCount).show();

	
});

$('#buttonSubmit').click(function() {
	var judul = $('#judul').val();
	var pemberi = $('#pemberi').val();
	var penerima = $('#penerima').val();
	var tanggalpjk = $('#tanggaltransaksi').val();
	var tanggalspkktr = $('#tanggalspkktr').val();
	var tanggalsprin = $('#tanggalsprin').val();
	var nospkktr = $('#nospkktr').val();
	var nosprin = $('#nosprin').val();
	var nofaktur = $('#nofaktur').val();
	var faktur = $('#faktur').val();
	var perusahaan_id = $('#perusahaan').val();
	var akun_pjk_id = $('#akunpjk').val();
	
	if(tanggalpjk == '')
		callSwal('warning','Transaksi Gagal','Tanggal PJK Tidak Boleh Kosong',0);
	else if(tanggalspkktr == '')
		callSwal('warning','Transaksi Gagal','Tanggal SPK/KTR Tidak Boleh Kosong',0);
	else if(tanggalsprin == '')
		callSwal('warning','Transaksi Gagal','Tanggal Sprin Tidak Boleh Kosong',0);
	else if(nospkktr == '')
		callSwal('warning','Transaksi Gagal','Nomor SPK/KTR Tidak Boleh Kosong',0);
	else if(nosprin == '')
		callSwal('warning','Transaksi Gagal','Nomor Sprin Tidak Boleh Kosong',0);
	else if(nofaktur == '')
		callSwal('warning','Transaksi Gagal','Nomor Faktur Tidak Boleh Kosong',0);
	else if(transaksiCollection.length < 1)
		callSwal('warning','Transaksi Gagal','Transaksi Tidak Boleh Kosong',0);
	else if(judul == '')
		callSwal('warning','Transaksi Gagal','Judul Tidak Boleh Kosong',0);
	else if(pemberi == '')
		callSwal('warning','Transaksi Gagal','Pemberi Utang Tidak Boleh Kosong',0);
	else if(penerima == '')
		callSwal('warning','Transaksi Gagal','Penerima Utang Tidak Boleh Kosong',0);
	else if(perusahaan_id == '')
		callSwal('warning','Transaksi Gagal','Perusahaan Tidak Boleh Kosong',0);
	else if(akun_pjk_id == '')
		callSwal('warning','Transaksi Gagal','Akun Tidak Boleh Kosong',0);
	else{
		var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
		var formData = new FormData();
		formData.append('tanggalpjk', tanggalpjk);
		formData.append('tanggalspkktr', tanggalspkktr);
		formData.append('tanggalsprin', tanggalsprin);
		formData.append('nofaktur', nofaktur);
		formData.append('nospkktr', nospkktr);
		formData.append('nosprin', nosprin);
		formData.append('judul', judul);
		formData.append('pemberi', pemberi);
		formData.append('penerima', penerima);
		formData.append('perusahaan_id', perusahaan_id);
		formData.append('akun_pjk_id', akun_pjk_id);
		formData.append('transaksi', transaksiCollectionJSON);
		formData.append('alltotal', globalTotal);
		formData.append('alldiskon', globalDiskon);
		formData.append('alljumlah', globalJumlah);
		if (faktur != '') {
			formData.append('gambarfaktur', $('input[type=file]')[0].files[0]);
		}
		
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
			url: API_URL + "/keuangan/utang/baru",
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
