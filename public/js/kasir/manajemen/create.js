//DECLARING FOR TRANSAKSI DETAIL USING X-EDITABLE
$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
	initEditable();
});

var rowCount = document.getElementsByClassName("existRow").length;


function initEditable(){

	$('.nama').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		display: function(value) {
			$(this).text(value);
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var nama = newValue;
			var alamat = $(this).parent().siblings(".alamat-par").children('.alamat').editable('getValue').undefined;
			var telepon = $(this).parent().siblings(".telepon-par").children('.telepon').editable('getValue').undefined;
			var agen = $(this).parent().siblings(".agen-par").children('.agen').editable('getValue').undefined;
			var slug = $(this).parent().siblings(".slug-par").children('.slug').editable('getValue').undefined;
			var foto = $(this).parent().siblings(".foto-par").children('.foto').editable('getValue').undefined;
			var deskripsi = $(this).parent().siblings(".deskripsi-par").children('.deskripsi').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneAddTransaksiDetail(id);
			backboneUpdateTransaksi(id,nama,alamat,telepon,agen,slug,foto,deskripsi);
		}
	});

	$('.alamat').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		display: function(value) {
			$(this).text(value);
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var nama = $(this).parent().siblings(".nama-par").children('.nama').editable('getValue').undefined;
			var alamat = newValue;
			var telepon = $(this).parent().siblings(".telepon-par").children('.telepon').editable('getValue').undefined;
			var agen = $(this).parent().siblings(".agen-par").children('.agen').editable('getValue').undefined;
			var slug = $(this).parent().siblings(".slug-par").children('.slug').editable('getValue').undefined;
			var foto = $(this).parent().siblings(".foto-par").children('.foto').editable('getValue').undefined;
			var deskripsi = $(this).parent().siblings(".deskripsi-par").children('.deskripsi').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,nama,alamat,telepon,agen,slug,foto,deskripsi);
		}
	});

	$('.telepon').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		display: function(value) {
			$(this).text(value);
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var nama = $(this).parent().siblings(".nama-par").children('.nama').editable('getValue').undefined;
			var alamat = $(this).parent().siblings(".alamat-par").children('.alamat').editable('getValue').undefined;
			var telepon = newValue;
			var agen = $(this).parent().siblings(".agen-par").children('.agen').editable('getValue').undefined;
			var slug = $(this).parent().siblings(".slug-par").children('.slug').editable('getValue').undefined;
			var foto = $(this).parent().siblings(".foto-par").children('.foto').editable('getValue').undefined;
			var deskripsi = $(this).parent().siblings(".deskripsi-par").children('.deskripsi').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,nama,alamat,telepon,agen,slug,foto,deskripsi);
		}
	});
	$('.agen').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		display: function(value) {
			$(this).text(value);
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var nama = $(this).parent().siblings(".nama-par").children('.nama').editable('getValue').undefined;
			var alamat = $(this).parent().siblings(".alamat-par").children('.alamat').editable('getValue').undefined;
			var telepon = $(this).parent().siblings(".telepon-par").children('.telepon').editable('getValue').undefined;
			var agen = newValue;
			var slug = $(this).parent().siblings(".slug-par").children('.slug').editable('getValue').undefined;
			var foto = $(this).parent().siblings(".foto-par").children('.foto').editable('getValue').undefined;
			var deskripsi = $(this).parent().siblings(".deskripsi-par").children('.deskripsi').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,nama,alamat,telepon,agen,slug,foto,deskripsi);
		}
	});

	$('.slug').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		display: function(value) {
			$(this).text(value);
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var nama = $(this).parent().siblings(".nama-par").children('.nama').editable('getValue').undefined;
			var alamat = $(this).parent().siblings(".alamat-par").children('.alamat').editable('getValue').undefined;
			var telepon = $(this).parent().siblings(".telepon-par").children('.telepon').editable('getValue').undefined;
			var agen = $(this).parent().siblings(".agen-par").children('.agen').editable('getValue').undefined;
			var slug = newValue;
			var foto = $(this).parent().siblings(".foto-par").children('.foto').editable('getValue').undefined;
			var deskripsi = $(this).parent().siblings(".deskripsi-par").children('.deskripsi').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,nama,alamat,telepon,agen,slug,foto,deskripsi);
		}
	});

	$('.foto').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		display: function(value) {
			$(this).text(value);
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var nama = $(this).parent().siblings(".nama-par").children('.nama').editable('getValue').undefined;
			var alamat = $(this).parent().siblings(".alamat-par").children('.alamat').editable('getValue').undefined;
			var telepon = $(this).parent().siblings(".telepon-par").children('.telepon').editable('getValue').undefined;
			var agen = $(this).parent().siblings(".agen-par").children('.agen').editable('getValue').undefined;
			var slug = $(this).parent().siblings(".slug-par").children('.slug').editable('getValue').undefined;
			var foto = newValue;
			var deskripsi = $(this).parent().siblings(".deskripsi-par").children('.deskripsi').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,nama,alamat,telepon,agen,slug,foto,deskripsi);
		}
	});

	$('.deskripsi').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
		disabled : false,
		onblur : 'submit',
		display: function(value) {
			$(this).text(value);
		},
		validate: function(value) {
			if($.trim(value) == '') {
				return 'This field is required';
			}
		},
		success: function(response, newValue) {
			var nama = $(this).parent().siblings(".nama-par").children('.nama').editable('getValue').undefined;
			var alamat = $(this).parent().siblings(".alamat-par").children('.alamat').editable('getValue').undefined;
			var telepon = $(this).parent().siblings(".telepon-par").children('.telepon').editable('getValue').undefined;
			var agen = $(this).parent().siblings(".agen-par").children('.agen').editable('getValue').undefined;
			var slug = $(this).parent().siblings(".slug-par").children('.slug').editable('getValue').undefined;
			var foto = $(this).parent().siblings(".foto-par").children('.foto').editable('getValue').undefined;
			var deskripsi = newValue;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,nama,alamat,telepon,agen,slug,foto,deskripsi);
		}
	});

	$('button.remove').click(function(){
		var nama = $(this).parent(".remove-par").siblings(".nama-par").children('.nama');
		var alamat = $(this).parent(".remove-par").siblings(".alamat-par").children('.alamat');
		var telepon = $(this).parent(".remove-par").siblings(".telepon-par").children('.telepon');
		var agen = $(this).parent(".remove-par").siblings(".agen-par").children('.agen');
		var slug = $(this).parent(".remove-par").siblings(".slug-par").children('.slug');
		var foto = $(this).parent(".remove-par").siblings(".foto-par").children('.foto');
		var deskripsi = $(this).parent(".remove-par").siblings(".deskripsi-par").children('.deskripsi');
		var id = nama.data("pk");
		
		console.log("id "+id);
		if(rowCount == 1){
			nama.editable();
			alamat.editable();
			telepon.editable();
			agen.editable();
			slug.editable();
			foto.editable();
			deskripsi.editable();

		}
		else{
			deleteRow('transaksiRow'+id);
			rowCount--;
		}
		
		var transaksidetail = transaksiCollection.findWhere({pk_id: id});
		if(typeof transaksidetail !== "undefined") var is_delete = 1;
		else var is_delete = 0; 
		if(is_delete)
		{
			transaksiCollection.remove(transaksidetail)
		}

	});

}

function deleteRow(rowid){   
    var row = document.getElementById(rowid);
    row.parentNode.removeChild(row);
}

function destroySelect2(){
	$(".manajemen").select2("destroy")
}

var TransaksiDetail = Backbone.Model.extend({
	defaults: {
		pk_id: ""
	},
	idAttribute: "id"
});

var Transaksi = Backbone.Collection.extend({
	model: TransaksiDetail,
	sort_key: 'pk_id'
});

var transaksiCollection = new Transaksi();

function backboneAddTransaksiDetail(id){
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
		pk_id:id
	});
	transaksiCollection.add(detail);
}

function backboneUpdateTransaksi(id,nama,alamat,telepon,agen,slug,foto,deskripsi){
	var transaksidetail = transaksiCollection.findWhere({pk_id: id});
	if(typeof transaksidetail !== "undefined") var exist = 1;
	else var exist = 0; 
	// console.log('exist : ' + exist);
	// console.log('id : ' + id);
	if(exist)
	{
		transaksidetail.set({
			pk_id: id,
			nama: nama,
			alamat: alamat,
			telepon: telepon,
			agen: agen,
			slug: slug,
			foto: foto,
			deskripsi: deskripsi
		});
	}
}

// var rowCount = document.getElementsByClassName("existRow").length;
/*BUTTON EVENT*/
var recordCount = rowCount;
$('#tambahRecord').click(function() {
	recordCount++;
	// alert(recordCount);
	content ='<tr id="transaksiRow'+ recordCount +'" class="existRow">'
    content+='<th class="text-center" scope="row">'+ recordCount +'</th>'

	content+='<td class=" text-view nama-par">'
	content+='<a href="#" class="nama" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Opsional"></a>'
	content+='</td>'
	content+='<td class=" text-center alamat-par">'
	content+='<a href="#" class="alamat" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Opsional"></a>'
	content+='</td>'
	content+='<td class="text-center telepon-par">'
	content+='<a href="#" class="alamat" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Opsional"></a>'
	content+='</td>'
	content+='<td class="text-center agen-par">'
	content+='<a href="#" class="agen" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga Satuan"></a>'
	content+='</td>'
	content+='<td class="text-center slug-par">'
	content+='<a href="#" class="slug" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga Satuan"></a>'
	content+='</td>'
	content+='<td class="text-center foto-par">'
	content+='<a href="#" class="foto" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga Satuan"></a>'
	content+='</td>'
	content+='<td class="text-center deskripsi-par">'
	content+='<a href="#" class="deskripsi" data-type="textarea" data-pk="'+ recordCount +'" data-placeholder="Harga Satuan"></a>'
	content+='</td>'
	

	content+='<td class="text-center remove-par">'
	content+='<button class="btn btn-alt-danger btn-sm remove"><i class="fa fa-remove"></i></button>'
	content+='</td>'
	content+='</tr>'
	// alert(content);
	rowCount++;
	$('#transaksiTable tr:last').after(content);
	$('#transaksiRow'+recordCount).hide();
	initEditable();
	$('#transaksiRow'+recordCount).show();
});

$('#buttonSubmit').click(function() {
	var tanggal = $('#tanggaltransaksi').val();
	// var file = $('#file').val();
	if(transaksiCollection.length < 1)
		callSwal('warning','Transaksi Gagal','Transaksi Tidak Boleh Kosong',0);
	else if(tanggal == '')
		callSwal('warning','Transaksi Gagal','Tanggal Tidak Boleh Kosong',0);
	else{
		var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
		
		$('#buttonSubmit').hide();
		$('#buttonLoading').show();

		console.log(transaksiCollection);
		console.log(transaksiCollectionJSON);
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		alert(tanggal);
		alert(transaksiCollectionJSON);
		$.ajax({
			type: "POST",
			url: API_URL + "/kasir/manajemen/baru",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: { 
				id : null,
				tanggal : tanggal,
				transaksi : transaksiCollectionJSON
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
