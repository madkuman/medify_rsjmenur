<script type="text/javascript">
//DECLARING FOR TRANSAKSI DETAIL USING X-EDITABLE

$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
	@if(!empty($utang->po_id))
	initEditableFromPO();
    $('#tambahRecord').hide();
	@else
	initEditable_(); // init previous data
	@endif
	initTransaksi(); // init transaksi detail
});

var rowCount = document.getElementsByClassName("existRow").length;
function initEditableFromPO(){
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
            var id = $(this).data("pk");
            var oldValueId = '#oldValue'+ id;
            oldValue = $(this).parent().siblings(".d-none").children(oldValueId).val();
            if (value > parseInt(oldValue)) {
                return 'Jumlah tidak boleh lebih besar dari jumlah PO';
            }
        },
        success: function(response, newValue) {
            var jumlah = newValue;
            var harga = $(this).parent().siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal_");
            var keterangan = $(this).parent().siblings(".keterangan-par_").children('.keterangan_').editable('getValue').undefined;
            var id = $(this).data("pk")
            updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
        }
    });

    $('.keterangan_').editable({
        inputclass: 'form-control',
        defaultValue : '',
        disabled : true,
        showbuttons : false,
        onblur : 'submit',
        rows : 2,
        success: function(response, newValue) {
            var jumlah = $(this).parent().siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
            var harga = $(this).parent().siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal_");
            var keterangan = newValue;
            var id = $(this).data("pk")
            updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
        }
    });

    $('.harga_').editable({
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
            var jumlah = $(this).parent().siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
            var harga = newValue;
            var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal_");
            var keterangan = $(this).parent().siblings(".keterangan-par_").children('.keterangan_').editable('getValue').undefined;
            var id = $(this).data("pk")
            updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
        }
    });

    $('.diskon_').editable({
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
            var jumlah =  $(this).parent().siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
            var kelas = $(this).parent().siblings(".kelas-par_").children('.kelas_').editable('getValue').undefined;
            var diskon = newValue;
            var harga = $(this).parent().siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal_");
            var keterangan = $(this).parent().siblings(".keterangan-par_").children('.keterangan_').editable('getValue').undefined;
            var id = $(this).data("pk")
            updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
        }
    });

    $('.layanan_').editable({
        inputclass: 'form-control',
        defaultValue : '',
        emptytext : 'Masukkan Deskripsi',
        showbuttons : false,
        disabled : true,
        onblur : 'submit',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'This field is required';
            }
        },
        success: function(response, newValue) {
            
            var harga = $(this).parent(".layanan-par_").siblings(".harga-par_").children('.harga_');
            var jumlah = $(this).parent(".layanan-par_").siblings(".jumlah-par_").children('.jumlah_');
            var diskon = $(this).parent(".layanan-par_").siblings(".diskon-par_").children('.diskon_');
            var subtotal = $(this).parent(".layanan-par_").siblings(".subtotal_");
            var keterangan = $(this).parent(".layanan-par_").siblings(".keterangan-par_").children('.keterangan_');
            
            harga.editable('option', 'disabled', false);
            jumlah.editable('option', 'disabled', false);
            diskon.editable('option', 'disabled', false);
            keterangan.editable('option', 'disabled', false);

            id = $(this).data("pk");
            harga.editable('setValue',0);
            jumlah.editable('setValue',1);
            diskon.editable('setValue',0);
            keterangan.editable('setValue','');

            subtotal_number = 0;
            subtotal_number_formatted = numeral(subtotal_number).format('0,0');

            subtotal.html('Rp ' + subtotal_number_formatted);
        }
    });
    
    $('button.remove_').click(function(){
        var layanan = $(this).parent(".remove-par_").siblings(".layanan-par_").children('.layanan_');
        var harga = $(this).parent(".remove-par_").siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
        var jumlah = $(this).parent(".remove-par_").siblings(".jumlah-par_").children('.jumlah_');
        var diskon = $(this).parent(".remove-par_").siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
        var subtotal = $(this).parent(".remove-par_").siblings(".subtotal_");
        var keterangan = $(this).parent(".remove-par_").siblings(".keterangan-par_").children('.keterangan_').editable('getValue').undefined;

        var id = layanan.data("pk");
        
        //alert("row count"+rowCount);
        jumlah.editable('setValue', 0);
        updateRecord(jumlah.editable('getValue').undefined,harga,diskon,subtotal,id,keterangan);
        // console.log(transaksiCollection);
    });

}

function initTransaksi(){
	var countdetail = $('#countdetail').val();
    var i;
    for(i=1;i<=countdetail;i++){
    	var po_detail_id = $('#po_detail_id'+i).val();
        var detail_id = $('#detail_id'+i).val();
        var deskripsi = $('#layanan'+i).val();
        var harga = $('#harga'+i).val();
        var jumlah = $('#jumlah'+i).val();
        var diskon = $('#diskon'+i).val();
        var keterangan = $('#keterangan'+i).val();
    
        var subtotal_number = (harga*(100-diskon)/100) * jumlah;

        if (po_detail_id) {
        	backboneAddTransaksiDetail(i,po_detail_id,detail_id,deskripsi,jumlah,harga,diskon,keterangan,subtotal_number);
        } else {
        	backboneAddTransaksiDetail(i,0,detail_id,deskripsi,jumlah,harga,diskon,keterangan,subtotal_number);
        }
        
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
			var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
			var subtotal = $(this).parent().siblings(".subtotal_");
            var keterangan = $(this).parent().siblings(".keterangan-par_").children('.keterangan_').editable('getValue').undefined;
            var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
		}
	});


	$('.keterangan_').editable({
		inputclass: 'form-control',
		defaultValue : '',
		disabled : false,
		showbuttons : false,
		onblur : 'submit',
		rows : 2,
		success: function(response, newValue) {
			var jumlah = $(this).parent().siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
			var harga = $(this).parent().siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
			var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
			var subtotal = $(this).parent().siblings(".subtotal_");
			var keterangan = newValue;
			var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
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
			var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
			var subtotal = $(this).parent().siblings(".subtotal_");
            var keterangan = $(this).parent().siblings(".keterangan-par_").children('.keterangan_').editable('getValue').undefined;
            var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
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
			var diskon = newValue;
			var subtotal = $(this).parent().siblings(".subtotal_");
            var keterangan = $(this).parent().siblings(".keterangan-par_").children('.keterangan_').editable('getValue').undefined;
            var id = $(this).data("pk")
			updateRecord(jumlah,harga,diskon,subtotal,id,keterangan);
		}
	});

	$('.layanan_').editable({
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
			// alert(data2.id);
			var id_detail = $(this).parent(".layanan-par_").siblings(".id-detail-par_").children('.id-detail_');
			var harga = $(this).parent(".layanan-par_").siblings(".harga-par_").children('.harga_');
			var jumlah = $(this).parent(".layanan-par_").siblings(".jumlah-par_").children('.jumlah_');
			var diskon = $(this).parent(".layanan-par_").siblings(".diskon-par_").children('.diskon_');
			var subtotal = $(this).parent(".layanan-par_").siblings(".subtotal_");
			var keterangan = $(this).parent(".layanan-par_").siblings(".keterangan-par_").children('.keterangan_');

			var pk = $(this).data("pk");

			harga.editable('option', 'disabled', false);
			jumlah.editable('option', 'disabled', false);
			diskon.editable('option', 'disabled', false);
			keterangan.editable('option', 'disabled', false);

			id = $(this).data("pk");
			harga.editable('setValue',0);
			jumlah.editable('setValue',1);
			diskon.editable('setValue',0);
			keterangan.editable('setValue','');
			
			subtotal_number = 0;
			subtotal_number_formatted = numeral(subtotal_number).format('0,0');

			subtotal.html('Rp ' + subtotal_number_formatted);

			backboneUpdateTransaksi2(1,0,0,subtotal_number,id,newValue);
		}
	});

	$('button.remove_').click(function(){
		var layanan = $(this).parent(".remove-par_").siblings(".layanan-par_").children('.layanan_');
		var harga = $(this).parent(".remove-par_").siblings(".harga-par_").children('.harga_');
		var jumlah = $(this).parent(".remove-par_").siblings(".jumlah-par_").children('.jumlah_');
		var diskon = $(this).parent(".remove-par_").siblings(".diskon-par_").children('.diskon_');
		var subtotal = $(this).parent(".remove-par_").siblings(".subtotal_");
		var keterangan = $(this).parent(".remove-par_").siblings(".keterangan-par_").children('.keterangan_');

		var id = keterangan.data("pk")
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
		var transaksidetail = transaksiCollection.findWhere({pk_id: id});
		backboneUpdateTransaksi(0,0,0,0,'',1,id);

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
			var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
			var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
			var subtotal = $(this).parent().siblings(".subtotal");
			var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
			var id = $(this).data("pk")
            //alert(harga);
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
			var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
			var diskon = newValue;
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

			backboneAddTransaksiDetail(id,0,null,newValue,1,0,'','',subtotal_number);
		}
	});


	$('button.remove').click(function(){
		var layanan = $(this).parent(".remove-par").siblings(".layanan-par").children('.layanan');
		var harga = $(this).parent(".remove-par").siblings(".harga-par").children('.harga');
		var jumlah = $(this).parent(".remove-par").siblings(".jumlah-par").children('.jumlah');
		var diskon = $(this).parent(".remove-par").siblings(".diskon-par").children('.diskon');
		var subtotal = $(this).parent(".remove-par").siblings(".subtotal");
		var keterangan = $(this).parent(".remove-par").siblings(".keterangan-par").children('.keterangan');

		var id = keterangan.data("pk")

		if(rowCount == 1){
			layanan.val('').trigger('change')
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
	if (typeof jumlah != "number") jumlah = parseInt(jumlah);
    if (typeof harga != "number") harga = parseInt(harga);
    if (typeof diskon != "number") diskon = parseInt(diskon);
	subtotal_number = (harga * jumlah) - (harga*diskon/100*jumlah);
	subtotal_number_formatted = numeral(subtotal_number).format('0,0');

	subtotal.html('Rp ' + subtotal_number_formatted);

	backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,0,id);
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
        po_detail_id: 0,
        id_detail: "",
		layanan_string: "",
		jumlah: "",
		harga: "",
		diskon: "",
		subtotal: "",

		keterangan:"",
		is_deleted: 0
	},
	idAttribute: "id"
});

var Transaksi = Backbone.Collection.extend({
	model: TransaksiDetail,
	sort_key: 'pk_id'
});

var transaksiCollection = new Transaksi();

function backboneAddTransaksiDetail(id,po_detail_id,detail_id,layanan_string,jumlah,harga,diskon,keterangan,subtotal)
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
        po_detail_id:po_detail_id,
        id_detail:detail_id,
		layanan_string: layanan_string,
		jumlah: jumlah,
		harga: harga,
        diskon: diskon,
        keterangan: keterangan,
		subtotal: subtotal
	});

    //alert(detail);
	transaksiCollection.add(detail);

	updateAllTotal();
}

function backboneUpdateTransaksi2(jumlah,harga,diskon,subtotal,id,layanan_string)
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
		    layanan_string: layanan_string,
			jumlah: jumlah,
			harga: harga,
			diskon: diskon,
			subtotal: subtotal,
		});
	}
	updateAllTotal();
}

function backboneUpdateTransaksi(jumlah,harga,diskon,subtotal,keterangan,is_deleted,id)
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
			keterangan: keterangan,
			is_deleted: is_deleted
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
	content+= '<a href="#" class="layanan" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Masukkan Deskripsi"></a>'
	content+= '</td>'
	content+= '<td class="text-center keterangan-par"><a href="#" class="keterangan" data-type="textarea" data-pk="'+ recordCount +'" data-placeholder="Opsional"></a></td>'
	content+= '<td class="text-center jumlah-par"><a href="#" class="jumlah" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Masukkan jumlah">0</a></td>'
	content+= '<td class="text-right harga-par"><a href="#" class="harga" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Harga Satuan">0</a></td>'
	content+= '<td class="text-center diskon-par"><a href="#" class="diskon" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Diskon %">0</a></td>'
	content+= '<td class="text-right  bg-warning-lighter subtotal">Rp 0</td>'
	content+= '<td class="text-right remove-par"><button class="btn btn-alt-danger btn-sm remove"><i class="fa fa-remove"></i></button></td>'
	content+= '</tr>'

	rowCount++;
	$('#transaksiTable tr:last').after(content);
	$('#transaksiRow'+recordCount).hide();
	initEditable(); // init data tambahan
	$('#transaksiRow'+recordCount).show();
});

$('#buttonSubmit').click(function() {
	var judul = $('#judul').val();
	var tanggalpenerimaan = $('#tanggalpenerimaan').val();
	var tanggalpo = $('#tanggalpo').val();
	var tanggalfaktur = $('#tanggalfaktur').val()
	var nofaktur = $('#nofaktur').val();
	var nopo = $('#nopo').val();
    var idpo = $('#idpo').val();
	var faktur = $('#faktur').val();
	var perusahaan_id = $('#perusahaan').val();
	var numOfModels = transaksiCollection.filter(function(model) { 
		return model.get('is_deleted') == 1;
	  }).length;
	var id = $('#idtransaksi').val();

	if(tanggalpenerimaan == '')
		callSwal('warning','Transaksi Gagal','Tanggal Penerimaan Tidak Boleh Kosong',0);
    else if(tanggalfaktur == '' && idpo)
        callSwal('warning','Transaksi Gagal','Tanggal Faktur Tidak Boleh Kosong',0);
	else if(nofaktur == '' && idpo)
		callSwal('warning','Transaksi Gagal','Nomor Faktur Tidak Boleh Kosong',0);
	else if(transaksiCollection.length < 1)
		callSwal('warning','Transaksi Gagal','Transaksi Tidak Boleh Kosong',0);
	else if(judul == '')
		callSwal('warning','Transaksi Gagal','Judul Tidak Boleh Kosong',0);
	else if(perusahaan_id == '')
		callSwal('warning','Transaksi Gagal','Perusahaan Tidak Boleh Kosong',0);
	else{
		var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
		var formData = new FormData();
		formData.append('id', id);
		formData.append('tanggalpenerimaan', tanggalpenerimaan);
		formData.append('tanggalfaktur', tanggalfaktur);
		formData.append('tanggalpo', tanggalpo);
		formData.append('nofaktur', nofaktur);
		formData.append('nopo', nopo);
        formData.append('idpo', idpo);
		formData.append('judul', judul);
		formData.append('perusahaan_id', perusahaan_id);
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
	    // alert(transaksiCollectionJSON);

		$.ajax({
			type: "POST",
			url: API_URL + "/keuangan/utang/edit",
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

			},
			error: function () {
				callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
				$('#buttonSubmit').show();
				$('#buttonLoading').hide();
			}
		});

	}
});

</script>