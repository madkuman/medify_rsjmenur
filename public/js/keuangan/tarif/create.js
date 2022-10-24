//DECLARING FOR TRANSAKSI DETAIL USING X-EDITABLE
$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
	initEditable();
	initTipe();
});

$('.departemen').select2();
$('.tarif_kategori').select2();
$('.tarif_kategori_sub').select2();
$('.tarif_kategori_sub_sub').select2();
$('.tarif_kode').select2();

$('.departemen').on('select2:select', function (e) {
	var data2 = e.params.data;

	$.ajax({
		type: "POST",
		url: API_URL + "/keuangan/tarif/getkategori",
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data: {
			id : data2.id
		},
		success: function (data) {
			console.log(data);
			var option = [];
			option.push({
				id: '',
				text: '',
			});
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].name
				});
			}
			$('#select_kategori_sub').hide();
			$('#select_kategori_sub_sub').hide();
			$(".tarif_kategori option").remove();
			$(".tarif_kategori_sub option").remove();
			$(".tarif_kategori_sub_sub option").remove();
			$('.tarif_kategori').select2({
				data: option
			});
		}
	});
});

$('.tarif_kategori').on('select2:select', function (e) {
	var data2 = e.params.data;

	$.ajax({
		type: "POST",
		url: API_URL + "/keuangan/tarif/getkategorisub",
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
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].name
				});
			}
			if(option.length==1){
				$('#select_kategori_sub').hide();
				$('#select_kategori_sub_sub').hide();
				$(".tarif_kategori_sub option").remove();
				$(".tarif_kategori_sub_sub option").remove();
			}else{
				$('#select_kategori_sub').show();
				$('#select_kategori_sub_sub').hide();
				$(".tarif_kategori_sub option").remove();
				$(".tarif_kategori_sub_sub option").remove();
				$('.tarif_kategori_sub').select2({
					data: option
				});
			}
		}
	});
});

$('.tarif_kategori_sub').on('select2:select', function (e) {
	var data2 = e.params.data;

	$.ajax({
		type: "POST",
		url: API_URL + "/keuangan/tarif/getkategorisub",
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
			for (i in data) {
				option.push({
					id: data[i].id,
					text: data[i].name
				});
			}
			if(option.length==1){
				$('#select_kategori_sub_sub').hide();
				$(".tarif_kategori_sub_sub option").remove();
			}else{
				$('#select_kategori_sub_sub').show();
				$(".tarif_kategori_sub_sub option").remove();
				$('.tarif_kategori_sub_sub').select2({
					data: option
				});
			}
		}
	});
});
var tipe_option = [];
var rowCount = document.getElementsByClassName("existRow").length;
function initTipe(){
	tipe_option.push({
		id: '',
		text: ''
	})
	$('#tipe1 option').each(function(){
		if($(this).val()!=''){
			tipe_option.push({
				id: $(this).val(),
				text: $(this).text()
			})	
		}
	});
	$("#tipe1 option").remove();
	$(".tipe1").select2({
		data : tipe_option
	});
	// console.log("tipe" + tipe_option);
}

function getTipeOption(){
	var option = [];
	option.push({
		id: '',
		text: ''
	})
	tipe_option.forEach(function (item) {
		var transaksidetail = transaksiCollection.findWhere({tipe_id: item.id});
		if(typeof transaksidetail === "undefined") var available = 1;
		else var available = 0; 
		if(available)
		{
			option.push({
				id: item.id,
				text: item.text,
			})
		}	
	});
	
	return option;
}

function setTipe(selector){
	var option = [];
	option = getTipeOption();
	$(selector).select2({
		data : option
	});
}

function updateTipe(){
	var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
	console.log(transaksiCollectionJSON);
	var option = [];
	option = getTipeOption();
	$(".tipe option").remove();
	$(".tipe").select2({
		data : option
	});
	var option2 = [];
	option2 = option;
	console.log(option);
	transaksiCollection.forEach(function (item){
		// option2 = [];
		var pk_id = item.get('pk_id');
		var id = item.get('tipe_id');
		var text = item.get('tipe_text');
		// option2 = option;
		option2.push({
			id: id,
			text: text,
			selected: true
		})
		$(".tipe"+pk_id+" option").remove();
		$(".tipe"+pk_id).select2({
			data : option2
		});
		option2.pop();
	})
}

function initEditable(){

	$('.tipe').on('select2:select', function (e) {
		var data = e.params.data;

		var biasa = $(this).parent(".tipe-par").siblings(".biasa-par").children('.biasa');
		var urj = $(this).parent(".tipe-par").siblings(".urj-par").children('.urj');
		var igd = $(this).parent(".tipe-par").siblings(".igd-par").children('.igd');
		var vvip = $(this).parent(".tipe-par").siblings(".vvip-par").children('.vvip');
		var vip_a = $(this).parent(".tipe-par").siblings(".vip_a-par").children('.vip_a');
		var vip_paviliun = $(this).parent(".tipe-par").siblings(".vip_paviliun-par").children('.vip_paviliun');
		var i_paviliun = $(this).parent(".tipe-par").siblings(".i_paviliun-par").children('.i_paviliun');
		var vip_ruangan = $(this).parent(".tipe-par").siblings(".vip_ruangan-par").children('.vip_ruangan');
		var i_a = $(this).parent(".tipe-par").siblings(".i_a-par").children('.i_a');
		var i_b = $(this).parent(".tipe-par").siblings(".i_b-par").children('.i_b');
		var ii = $(this).parent(".tipe-par").siblings(".ii-par").children('.ii');
		var iii_ac = $(this).parent(".tipe-par").siblings(".iii_ac-par").children('.iii_ac');
		var iii_non_ac = $(this).parent(".tipe-par").siblings(".iii_non_ac-par").children('.iii_non_ac');
		
		biasa.editable('option', 'disabled', false);
		urj.editable('option', 'disabled', false);
		igd.editable('option', 'disabled', false);
		vvip.editable('option', 'disabled', false);
		vip_a.editable('option', 'disabled', false);
		vip_paviliun.editable('option', 'disabled', false);
		i_paviliun.editable('option', 'disabled', false);
		vip_ruangan.editable('option', 'disabled', false);
		i_a.editable('option', 'disabled', false);
		i_b.editable('option', 'disabled', false);
		ii.editable('option', 'disabled', false);
		iii_ac.editable('option', 'disabled', false);
		iii_non_ac.editable('option', 'disabled', false);
		
		id = $(this).data("pk");
		// minTipe(data.id);
		backboneAddTransaksiDetail(id,data.id,data.text);
		updateTipe();
	});

	$('.biasa').editable({
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
			var biasa = newValue;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.urj').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = newValue;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.igd').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = newValue;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});
	$('.vvip').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = newValue;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.vip_a').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = newValue;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.vip_paviliun').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = newValue;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.i_paviliun').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = newValue;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.vip_ruangan').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = newValue;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.i_a').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = newValue;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.i_b').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = newValue;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.ii').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = newValue;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.iii_ac').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = newValue;
			var iii_non_ac = $(this).parent().siblings(".iii_non_ac-par").children('.iii_non_ac').editable('getValue').undefined;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('.iii_non_ac').editable({
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
			var biasa = $(this).parent().siblings(".biasa-par").children('.biasa').editable('getValue').undefined;
			var urj = $(this).parent().siblings(".urj-par").children('.urj').editable('getValue').undefined;
			var igd = $(this).parent().siblings(".igd-par").children('.igd').editable('getValue').undefined;
			var vvip = $(this).parent().siblings(".vvip-par").children('.vvip').editable('getValue').undefined;
			var vip_a = $(this).parent().siblings(".vip_a-par").children('.vip_a').editable('getValue').undefined;
			var vip_paviliun = $(this).parent().siblings(".vip_paviliun-par").children('.vip_paviliun').editable('getValue').undefined;
			var i_paviliun = $(this).parent().siblings(".i_paviliun-par").children('.i_paviliun').editable('getValue').undefined;
			var vip_ruangan = $(this).parent().siblings(".vip_ruangan-par").children('.vip_ruangan').editable('getValue').undefined;
			var i_a = $(this).parent().siblings(".i_a-par").children('.i_a').editable('getValue').undefined;
			var i_b = $(this).parent().siblings(".i_b-par").children('.i_b').editable('getValue').undefined;
			var ii = $(this).parent().siblings(".ii-par").children('.ii').editable('getValue').undefined;
			var iii_ac = $(this).parent().siblings(".iii_ac-par").children('.iii_ac').editable('getValue').undefined;
			var iii_non_ac = newValue;
			var id = $(this).data("pk");

			backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac);
		}
	});

	$('button.remove').click(function(){
		var tipe = $(this).parent(".remove-par").siblings(".tipe-par").children('.tipe');
		var biasa = $(this).parent(".remove-par").siblings(".biasa-par").children('.biasa');
		var urj = $(this).parent(".remove-par").siblings(".urj-par").children('.urj');
		var igd = $(this).parent(".remove-par").siblings(".igd-par").children('.igd');
		var vvip = $(this).parent(".remove-par").siblings(".vvip-par").children('.vvip');
		var vip_a = $(this).parent(".remove-par").siblings(".vip_a-par").children('.vip_a');
		var vip_paviliun = $(this).parent(".remove-par").siblings(".vip_paviliun-par").children('.vip_paviliun');
		var i_paviliun = $(this).parent(".remove-par").siblings(".i_paviliun-par").children('.i_paviliun');
		var vip_ruangan = $(this).parent(".remove-par").siblings(".vip_ruangan-par").children('.vip_ruangan');
		var i_a = $(this).parent(".remove-par").siblings(".i_a-par").children('.i_a');
		var i_b = $(this).parent(".remove-par").siblings(".i_b-par").children('.i_b');
		var ii = $(this).parent(".remove-par").siblings(".ii-par").children('.ii');
		var iii_ac = $(this).parent(".remove-par").siblings(".iii_ac-par").children('.iii_ac');
		var iii_non_ac = $(this).parent(".remove-par").siblings(".iii_non_ac-par").children('.iii_non_ac');

		var id = biasa.data("pk");
		
		console.log("id "+id);
		if(rowCount == 1){
			tipe.val('').trigger('change')
			biasa.editable('option', 'disabled', true);
			urj.editable('option', 'disabled', true);
			igd.editable('option', 'disabled', true);
			vvip.editable('option', 'disabled', true);
			vip_a.editable('option', 'disabled', true);
			vip_paviliun.editable('option', 'disabled', true);
			i_paviliun.editable('option', 'disabled', true);
			vip_ruangan.editable('option', 'disabled', true);
			i_a.editable('option', 'disabled', true);
			i_b.editable('option', 'disabled', true);
			ii.editable('option', 'disabled', true);
			iii_ac.editable('option', 'disabled', true);
			iii_non_ac.editable('option', 'disabled', true);

			biasa.editable('setValue', 0);
			urj.editable('setValue', 0);
			igd.editable('setValue', 0);
			vvip.editable('setValue', 0);
			vip_a.editable('setValue', 0);
			vip_paviliun.editable('setValue', 0);
			i_paviliun.editable('setValue', 0);
			vip_ruangan.editable('setValue', 0);
			i_a.editable('setValue', 0);
			i_b.editable('setValue', 0);
			ii.editable('setValue', 0);
			iii_ac.editable('setValue', 0);
			iii_non_ac.editable('setValue', 0);

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
		updateTipe();

	});

}

function deleteRow(rowid){   
    var row = document.getElementById(rowid);
    row.parentNode.removeChild(row);
}

function destroySelect2(){
	$(".kelas").select2("destroy")
}

var TransaksiDetail = Backbone.Model.extend({
	defaults: {
		pk_id: "",
		tipe_id: "",
		tipe_text:"",
		biasa: null,
		urj: null,
		igd: null,
		vvip: null,
		vip_a: null,
		vip_paviliun: null,
		i_paviliun: null,
		vip_ruangan: null,
		i_a: null,
		i_b: null,
		ii: null,
		iii_ac: null,
		iii_non_ac: null
	},
	idAttribute: "id"
});

var Transaksi = Backbone.Collection.extend({
	model: TransaksiDetail,
	sort_key: 'pk_id'
});

var transaksiCollection = new Transaksi();

function backboneAddTransaksiDetail(id,tipe_id,tipe_text){
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
		tipe_id: tipe_id,
		tipe_text: tipe_text
	});
	transaksiCollection.add(detail);
}

function backboneUpdateTransaksi(id,biasa,urj,igd,vvip,vip_a,vip_paviliun,i_paviliun,vip_ruangan,i_a,i_b,ii,iii_ac,iii_non_ac){
	var transaksidetail = transaksiCollection.findWhere({pk_id: id});
	if(typeof transaksidetail !== "undefined") var exist = 1;
	else var exist = 0; 
	//console.log('exist : ' + exist);
	//console.log('id : ' + id);
	if(exist)
	{
		transaksidetail.set({
			pk_id: id,
			biasa: biasa,
			urj: urj,
			igd: igd,
			vvip: vvip,
			vip_a: vip_a,
			vip_paviliun: vip_paviliun,
			i_paviliun: i_paviliun,
			vip_ruangan: vip_ruangan,
			i_a: i_a,
			i_b: i_b,
			ii: ii,
			iii_ac:iii_ac,
			iii_non_ac: iii_non_ac
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
    content+='<td class=" text-left tipe-par">'
    content+='<select class="js-select2 form-control tipe tipe'+ recordCount +'" id="tipe'+ recordCount +'" name="biasa" data-pk="'+ recordCount +'" style="width: 80%;" data-placeholder="Pilih Tipe Tarif"></select>'
	content+='</td>'
	
	content+='<td class="text-center biasa-par">'
	content+='<a href="#" class="biasa" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga Biasa">0</a>'
	content+='</td>'
	content+='<td class="text-center urj-par">'
	content+='<a href="#" class="urj" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga URJ">0</a>'
	content+='</td>'
	content+='<td class="text-center igd-par">'
	content+='<a href="#" class="igd" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga IGD">0</a>'
	content+='</td>'
	content+='<td class="text-center vvip-par">'
	content+='<a href="#" class="vvip" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga VVIP">0</a>'
	content+='</td>'
	content+='<td class="text-center vip_a-par">'
	content+='<a href="#" class="vip_a" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga VIP A">0</a>'
	content+='</td>'
	content+='<td class="text-center vip_paviliun-par">'
	content+='<a href="#" class="vip_paviliun" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga VIP Paviliun">0</a>'
	content+='</td>'
	content+='<td class="text-center i_paviliun-par">'
	content+='<a href="#" class="i_paviliun" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga I Paviliun">0</a>'
	content+='</td>'
	content+='<td class="text-center vip_ruangan-par">'
	content+='<a href="#" class="vip_ruangan" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga VIP Ruangan">0</a>'
	content+='</td>'
	content+='<td class="text-center i_a-par">'
	content+='<a href="#" class="i_a" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga I A">0</a>'
	content+='</td>'
	content+='<td class="text-center i_b-par">'
	content+='<a href="#" class="i_b" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga I B">0</a>'
	content+='</td>'
	content+='<td class="text-center ii-par">'
	content+='<a href="#" class="ii" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga II">0</a>'
	content+='</td>'
	content+='<td class="text-center iii_ac-par">'
	content+='<a href="#" class="iii_ac" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga III AC">0</a>'
	content+='</td>'
	content+='<td class="text-center iii_non_ac-par">'
	content+='<a href="#" class="iii_non_ac" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga IIII Non AC">0</a>'
	content+='</td>'

	content+='<td class="text-right remove-par">'
	content+='<button class="btn btn-alt-danger btn-sm remove"><i class="fa fa-remove"></i></button>'
	content+='</td>'
	content+='</tr>'
	// alert(content);
	rowCount++;
	$('#transaksiTable tr:last').after(content);
	$('#transaksiRow'+recordCount).hide();
	updateTipe();
	initEditable();
	setTipe('.tipe'+ recordCount);
	$('#transaksiRow'+recordCount).show();
});

$('#buttonSubmit').click(function() {
	var departemen = $('#departemen').val();
	var tarif_kategori = $('#tarif_kategori').val();
	var tarif_kategori_sub = $('#tarif_kategori_sub').val();
	var tarif_kategori_sub_sub = $('#tarif_kategori_sub_sub').val();
	var deskripsi = $('#deskripsi').val();
	var tarif_kode = $('#tarif_kode').val();
	var satuan = $('#satuan').val();
	console.log("dept"+departemen);
	if(transaksiCollection.length < 1)
		callSwal('warning','Transaksi Gagal','Transaksi Tidak Boleh Kosong',0);
	else if(departemen == '')
		callSwal('warning','Transaksi Gagal','Departemen Tidak Boleh Kosong',0);
	else if(tarif_kategori == '')
		callSwal('warning','Transaksi Gagal','Kategori Tarif Tidak Boleh Kosong',0);
	else if(deskripsi == '')
		callSwal('warning','Transaksi Gagal','Deskripsi Tarif Tidak Boleh Kosong',0);
	else if(tarif_kode == '')
		callSwal('warning','Transaksi Gagal','Kode Tarif Tidak Boleh Kosong',0);
	else if(satuan == '')
		callSwal('warning','Transaksi Gagal','Satuan Tidak Boleh Kosong',0);
	else{
		var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
		
		$('#buttonSubmit').hide();
		$('#buttonLoading').show();

		console.log(transaksiCollection);
		console.log(transaksiCollectionJSON);
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/tarif/baru",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id : null,
				departemen : departemen,
				tarif_kategori : tarif_kategori,
				tarif_kategori_sub : tarif_kategori_sub,
				tarif_kategori_sub_sub : tarif_kategori_sub_sub,
				deskripsi : deskripsi,
				tarif_kode : tarif_kode,
				satuan: satuan,
				transaksi: transaksiCollectionJSON
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
