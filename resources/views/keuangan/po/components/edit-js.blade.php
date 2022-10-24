<script type="text/javascript">
//DECLARING FOR TRANSAKSI DETAIL USING X-EDITABLE

/*
*********PEDOMAN EDIT*********
Balikin $('#jenis_po').val() != 'Farmasi' ke $('#jenis_po').val() == 'Konstruksi' kalau Bekkum udah bisa Select2
*/

$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
	initEditable_(); // init previous data
	initLayanan_();
	initTransaksi(); // init transaksi detail
});

var rowCount = document.getElementsByClassName("existRow").length;

function initTransaksi(){
	var countdetail = $('#countdetail').val();
    var i;
    for(i=1;i<=countdetail;i++){
        var detail_id = $('#detail_id'+i).val();
        var deskripsi = $('#layanan'+i).val();
        var layanan_item_id = $('#jenis_po').val() != 'Farmasi' ? 0 : $('#layanan_item_id'+i).val();
        var harga = $('#harga'+i).val();
        var jumlah = $('#jumlah'+i).val();
        var diskon = $('#diskon'+i).val();
        var keterangan = $('#keterangan'+i).val();
    
        var subtotal_number = (harga*(100-diskon)/100) * jumlah;

        backboneAddTransaksiDetail(i,detail_id,deskripsi,jumlah,harga,diskon,keterangan,subtotal_number,layanan_item_id);
    }
}

function formatBarangFarmasi (item) {
    if (item.loading) {
        return item.text;
    }
    var markup = item.nama + " ("+item.satuan+")";

    return markup;
}

function formatBarangSelectionFarmasi (item) {
    if(item.nama){
        return item.nama + " ("+item.satuan+")";
    }
    else return item.text;
}

function formatBarangAset (item) {
    if (item.loading) {
        return item.text;
    }
    var markup = item.name;

    return markup;
}

function formatBarangSelectionAset (item) {
    if(item.name){
        return item.name;
    }
    else return item.text;
}

function initLayanan_() {
    @if(count($po->penerimaan) > 0)
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
            var jumlah = $(this).closest('.layanan-par_').siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
            var deskripsi = newValue;
            var harga = $(this).closest('.layanan-par_').siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
            var diskon = $(this).closest('.layanan-par_').siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
            var subtotal = $(this).closest('.layanan-par_').siblings(".subtotal_");
            var keterangan = $(this).closest('.layanan-par_').siblings(".keterangan-par_").children('.keterangan_').editable('getValue').undefined;
            var id = $(this).data("pk");
            updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
        }
    });
    @else
    if ($('#jenis_po').val() != 'Farmasi') {
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
                var jumlah = $(this).closest('.layanan-par_').siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
                var deskripsi = newValue;
                var harga = $(this).closest('.layanan-par_').siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
                var diskon = $(this).closest('.layanan-par_').siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
                var subtotal = $(this).closest('.layanan-par_').siblings(".subtotal_");
                var keterangan = $(this).closest('.layanan-par_').siblings(".keterangan-par_").children('.keterangan_').editable('getValue').undefined;
                var id = $(this).data("pk");
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
        });
    } else {
        if ($('#jenis_po').val() == 'Farmasi') {
            $('layanan_').select2({
                ajax: {
                    url: API_URL+"/gudang/item/get",
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
                placeholder: "Cari Barang",
                templateResult: formatBarangFarmasi,
                templateSelection: formatBarangSelectionFarmasi
            });
        } else if ($('#jenis_po').val() == 'Umum') {
            $('layanan_').select2({
                ajax: {
                    url: API_URL+"/aset/item/get",
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
                placeholder: "Cari Barang",
                templateResult: formatBarangAset,
                templateSelection: formatBarangSelectionAset
            });
        }

        $('layanan_').on('change', function() {
            var jumlah = $(this).parent().siblings(".jumlah-par_").children('.jumlah_').editable('getValue').undefined;
            var layanan = $(this).select2('data');
            var harga = $(this).parent().siblings(".harga-par_").children('.harga_').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par_").children('.diskon_').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal_");
            var keterangan = $(this).parent().siblings(".keterangan-par_").children('.keterangan_').editable('getValue').undefined;
            var id = $(this).data("pk")

            if ($('#jenis_po').val() == 'Farmasi') {
                harga.editable('setValue', layanan[0].harga);
            } else if ($('#jenis_po').val() == 'Umum') {
                harga.editable('setValue', layanan[0].price);
            }
            updateRecord(jumlah,harga.editable('getValue').undefined,diskon,subtotal,id,keterangan,layanan[0],layanan[0].id);
        });
    }
    @endif
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
            @if(count($po->penerimaan) == 0)
            if ($('#jenis_po').val() != 'Farmasi') {
                var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').editable('getValue').undefined;
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
            else {
                var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            @else
            var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').editable('getValue').undefined;
            updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            @endif
		}
	});


	$('.keterangan_').editable({
		inputclass: 'form-control',
		defaultValue : '',
        @if(count($po->penerimaan) > 0)
        disabled : true,
        @else
        disabled : false,
        @endif
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
			@if(count($po->penerimaan) == 0)
            if ($('#jenis_po').val() != 'Farmasi') {
                var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').editable('getValue').undefined;
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
            else {
                var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            @else
            var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').editable('getValue').undefined;
            updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            @endif
		}
	});

	$('.harga_').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
        @if(count($po->penerimaan) > 0)
        disabled : true,
        @else
        disabled : false,
        @endif
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
			@if(count($po->penerimaan) == 0)
            if ($('#jenis_po').val() != 'Farmasi') {
                var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').editable('getValue').undefined;
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
            else {
                var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            @else
            var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').editable('getValue').undefined;
            updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            @endif
		}
	});

	$('.diskon_').editable({
		inputclass: 'form-control',
		defaultValue : 'Empty',
		showbuttons : false,
        @if(count($po->penerimaan) > 0)
        disabled : true,
        @else
        disabled : false,
        @endif
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
			@if(count($po->penerimaan) == 0)
            if ($('#jenis_po').val() != 'Farmasi') {
                var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').editable('getValue').undefined;
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
            else {
                var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            @else
            var deskripsi = $(this).parent().siblings(".layanan-par_").find('.layanan_').editable('getValue').undefined;
            updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            @endif
		}
	});

	$('button.remove_').click(function(){
		var deskripsi = $(this).parent(".remove-par_").siblings(".layanan-par_").children('.layanan_');
		var harga = $(this).parent(".remove-par_").siblings(".harga-par_").children('.harga_');
		var jumlah = $(this).parent(".remove-par_").siblings(".jumlah-par_").children('.jumlah_');
		var diskon = $(this).parent(".remove-par_").siblings(".diskon-par_").children('.diskon_');
		var subtotal = $(this).parent(".remove-par_").siblings(".subtotal_");
		var keterangan = $(this).parent(".remove-par_").siblings(".keterangan-par_").children('.keterangan_');

		var id = keterangan.data("pk")
		if(rowCount == 1){
            if ($('#jenis_po').val() != 'Farmasi') {
                layanan.editable('setValue', '');
            }
            else {
                layanan.val('').change();
            }
			harga.editable('setValue', 0);
			jumlah.editable('setValue', 0);
			diskon.editable('setValue', 0);
			keterangan.editable('setValue', '');
			subtotal.html("Rp 0");
		}
		else{
			deleteRow('transaksiRow'+id);
			rowCount--;
		}
		var transaksidetail = transaksiCollection.findWhere({pk_id: id});
		backboneUpdateTransaksi(0,0,0,0,'',1,id);

	});

}

function initEditable(pk_id){

    var rowId = '#transaksiRow'+ pk_id;
    var layanan = $(rowId).find(".layanan");
    if ($('#jenis_po').val() != 'Farmasi') {
        layanan.editable({
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
                var jumlah = $(this).closest('.layanan-par').siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
                var deskripsi = newValue;
                var harga = $(this).closest('.layanan-par').siblings(".harga-par").children('.harga').editable('getValue').undefined;
                var diskon = $(this).closest('.layanan-par').siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
                var subtotal = $(this).closest('.layanan-par').siblings(".subtotal");
                var keterangan = $(this).closest('.layanan-par').siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
                var id = $(this).data("pk");
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
        });
    } else {
        if ($('#jenis_po').val() == 'Farmasi') {
            layanan.select2({
                ajax: {
                    url: API_URL+"/gudang/item/get",
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
                placeholder: "Cari Barang",
                templateResult: formatBarangFarmasi,
                templateSelection: formatBarangSelectionFarmasi
            });
        } else if ($('#jenis_po').val() == 'Umum') {
            layanan.select2({
                ajax: {
                    url: API_URL+"/aset/item/get",
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
                placeholder: "Cari Barang",
                templateResult: formatBarangAset,
                templateSelection: formatBarangSelectionAset
            });
        }

        layanan.on('change', function() {
            var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
            var layanan = $(this).select2('data');
            var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
            var id = $(this).data("pk")

            if ($('#jenis_po').val() == 'Farmasi') {
                harga.editable('setValue', layanan[0].harga);
            } else if ($('#jenis_po').val() == 'Umum') {
                harga.editable('setValue', layanan[0].price);
            }
            updateRecord(jumlah,harga.editable('getValue').undefined,diskon,subtotal,id,keterangan,layanan[0],layanan[0].id);
        });
    }

    $('.jumlah').editable({
        inputclass: 'form-control',
        defaultValue : 'Empty',
        showbuttons : false,
        disabled : false,
        onblur : 'submit',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'This field is required';
            }
                
            if ($('#jenis_po').val() != 'Farmasi') {
                var layanan = $(this).parent().siblings(".layanan-par").find('.layanan').editable('getValue').undefined;
                if (layanan == "") {
                    return 'Silahkan isi deskripsi terlebih dahulu';
                }
            }
            else {
                var layanan = $(this).parent().siblings(".layanan-par").find('.layanan');
                if (layanan.val() == "") {
                    return 'Silahkan isi deskripsi terlebih dahulu';
                }
            }

        },
        success: function(response, newValue) {
            var jumlah = newValue;
            var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
            var id = $(this).data("pk")
            if ($('#jenis_po').val() != 'Farmasi') {
                var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan').editable('getValue').undefined;
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
            else {
                var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
        }
    });

    $('.keterangan').editable({
        inputclass: 'form-control',
        defaultValue : '',
        disabled : false,
        showbuttons : false,
        onblur : 'submit',
        rows : 2,
        validate: function(value) {
                
            if ($('#jenis_po').val() != 'Farmasi') {
                var layanan = $(this).parent().siblings(".layanan-par").find('.layanan').editable('getValue').undefined;
                if (layanan == "") {
                    return 'Silahkan isi deskripsi terlebih dahulu';
                }
            }
            else {
                var layanan = $(this).parent().siblings(".layanan-par").find('.layanan');
                if (layanan.val() == "") {
                    return 'Silahkan isi deskripsi terlebih dahulu';
                }
            }

        },
        success: function(response, newValue) {
            var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
            var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = newValue;
            var id = $(this).data("pk")
            if ($('#jenis_po').val() != 'Farmasi') {
                var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan').editable('getValue').undefined;
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
            else {
                var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
        }
    });

    $('.harga').editable({
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
                
            if ($('#jenis_po').val() != 'Farmasi') {
                var layanan = $(this).parent().siblings(".layanan-par").find('.layanan').editable('getValue').undefined;
                if (layanan == "") {
                    return 'Silahkan isi deskripsi terlebih dahulu';
                }
            }
            else {
                var layanan = $(this).parent().siblings(".layanan-par").find('.layanan');
                if (layanan.val() == "") {
                    return 'Silahkan isi deskripsi terlebih dahulu';
                }
            }
        },
        success: function(response, newValue) {
            var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
            var harga = newValue;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
            var id = $(this).data("pk")
            if ($('#jenis_po').val() != 'Farmasi') {
                var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan').editable('getValue').undefined;
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
            else {
                var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
        }
    });

    $('.diskon').editable({
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
                
            if ($('#jenis_po').val() != 'Farmasi') {
                var layanan = $(this).parent().siblings(".layanan-par").find('.layanan').editable('getValue').undefined;
                if (layanan == "") {
                    return 'Silahkan isi deskripsi terlebih dahulu';
                }
            }
            else {
                var layanan = $(this).parent().siblings(".layanan-par").find('.layanan');
                if (layanan.val() == "") {
                    return 'Silahkan isi deskripsi terlebih dahulu';
                }
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
            if ($('#jenis_po').val() != 'Farmasi') {
                var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan').editable('getValue').undefined;
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
            else {
                var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
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
            if ($('#jenis_po').val() != 'Farmasi') {
                layanan.editable('setValue', '');
            } else {
                layanan.val('').change();
            }
            harga.editable('setValue', 0);
            jumlah.editable('setValue', 0);
            diskon.editable('setValue', 0);
            keterangan.editable('setValue', '');
            subtotal.html("Rp 0");
            updateRecord(jumlah.editable('getValue').undefined,harga.editable('getValue').undefined,diskon.editable('getValue').undefined,subtotal,id,keterangan.editable('getValue').undefined,'',0);
        }
        else{
            deleteRow('transaksiRow'+id);
            rowCount--;

            var transaksidetail = transaksiCollection.findWhere({pk_id: id});
            if(typeof transaksidetail !== "undefined") var is_delete = 1;
            else var is_delete = 0; 
            if(is_delete)
            {
                transaksiCollection.remove(transaksidetail)
            }
        }
        // orderRow();

        updateAllTotal();

    });

    id = layanan.data("pk");
    jumlah = layanan.parent().siblings(".jumlah-par").children('.jumlah').editable('setValue',1);
    harga = layanan.parent().siblings(".harga-par").children('.harga').editable('setValue',0);
    diskon = layanan.parent().siblings(".diskon-par").children('.diskon').editable('setValue',0);
    keterangan = layanan.parent().siblings(".keterangan-par").children('.keterangan').editable('setValue','');

    subtotal_number = 0;
    subtotal_number_formatted = numeral(subtotal_number).format('0,0');

    subtotal = layanan.parent().siblings(".subtotal").html('Rp ' + subtotal_number_formatted);

    backboneAddTransaksiDetail(id,null,'',1,0,'','',subtotal_number,0);

}

function deleteRow(rowid)  
{   
    var row = document.getElementById(rowid);
    row.parentNode.removeChild(row);
}

function updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,layanan="",layanan_id=0)
{
    subtotal_number = (harga * parseFloat(jumlah)) - (harga*diskon/100*parseFloat(jumlah));
    subtotal_number_formatted = numeral(subtotal_number).format('0,0');

    subtotal.html('Rp ' + subtotal_number_formatted);
    if (typeof layanan === 'string' || layanan instanceof String) {
        backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,0,id,layanan,layanan_id);
    } else {
        if ($('#jenis_po').val() == 'Farmasi') {
            if (layanan.nama) {
                backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,0,id,layanan.nama+" ("+layanan.satuan+")",layanan_id);
            } else {
                backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,0,id,layanan.text,layanan_id);
            }
        } else {
            if (layanan.name) {
                backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,0,id,layanan.name,layanan_id);
            } else {
                backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,0,id,layanan.text,layanan_id);
            }
        }
    }
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

    if (globalTotal >= 200000000) {
        $("#nopo-label").text("Nomor Kontrak");
        $("#tanggalpo-label").text("Tanggal Kontrak");
        $("#adendum-container").show();
        $("#termin-container").show();
    } else {
        $("#nopo-label").text("Nomor PO");
        $("#tanggalpo-label").text("Tanggal PO");
        $("#adendum-container").hide();
        $("#termin-container").hide();
    }
}

//INITIATE SELECT2
$("#kategori").select2();


var TransaksiDetail = Backbone.Model.extend({
	defaults: {
        pk_id: "",
        id_detail: "",
		layanan_string: "",
        layanan_id: "",
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

function backboneAddTransaksiDetail(id,detail_id,layanan_string,jumlah,harga,diskon,keterangan,subtotal,layanan_id=0)
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
		layanan_string: layanan_string,
		layanan_id: layanan_id,
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

function backboneUpdateTransaksi2(jumlah,harga,diskon,subtotal,id,layanan_string="",layanan_id=0)
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
			layanan_id: layanan_id,
			jumlah: jumlah,
			harga: harga,
			diskon: diskon,
			subtotal: subtotal,
		});
	}
	updateAllTotal();
}

function backboneUpdateTransaksi(jumlah,harga,diskon,subtotal,keterangan,is_deleted,id,layanan_string="",layanan_id=0)
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
			layanan_string: layanan_string,
			layanan_id: layanan_id,
			jumlah: jumlah,
			harga: harga,
			diskon: diskon,
			subtotal: subtotal,
			keterangan: keterangan,
			is_deleted: is_deleted
		});
	}
    // console.log(transaksidetail);
	updateAllTotal();
}

/*BUTTON EVENT*/


var recordCount = $('#countdetail').val();
$('#tambahRecord').click(function() {
	recordCount++;
	content = '<tr id="transaksiRow'+ recordCount +'">'
    content+= '<th class="text-center" scope="row">'+ recordCount +'</th>'
	content+= '<td class=" text-view layanan-par">'
    if ($('#jenis_po').val() != 'Farmasi') {
        content+= '<a href="#" class="layanan" data-type="text" data-pk="'+ recordCount +'" data-placeholder="Masukkan Deskripsi"></a>'
    } else {
        content+= '<select class="js-select2 form-control layanan" data-pk="'+ recordCount +'" style="width: 100%;" data-placeholder="Pilih Barang"><option></option></select>'
    }
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
	initEditable(recordCount); // init data tambahan
	$('#transaksiRow'+recordCount).show();
});

$('#buttonSubmit').click(function() {
	var judul = $('#judul').val();
	var tanggalpo = $('#tanggalpo').val();
	var nopo = $('#nopo').val();
    var tanggalspkktr = $('#tanggalspkktr').val();
    var nospkktr = $('#nospkktr').val();
	var perusahaan_id = $('#perusahaan').val();
	var numOfModels = transaksiCollection.filter(function(model) { 
		return model.get('is_deleted') == 1;
	  }).length;
	var id = $('#idtransaksi').val();

	if(tanggalpo == '')
		callSwal('warning','Transaksi Gagal','Tanggal PO Tidak Boleh Kosong',0);
	else if(nopo == '')
		callSwal('warning','Transaksi Gagal','Nomor PO Tidak Boleh Kosong',0);
	else if(judul == '')
		callSwal('warning','Transaksi Gagal','Judul Tidak Boleh Kosong',0);
	else if(perusahaan_id == '')
		callSwal('warning','Transaksi Gagal','Perusahaan Tidak Boleh Kosong',0);
	else{
		var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
		var formData = new FormData();
		formData.append('id', id);
		formData.append('tanggalpo', tanggalpo);
		formData.append('nopo', nopo);
        formData.append('tanggalspkktr', tanggalspkktr);
        formData.append('nospkktr', nospkktr);
		formData.append('judul', judul);
		formData.append('perusahaan_id', perusahaan_id);
		formData.append('transaksi', transaksiCollectionJSON);
		formData.append('alltotal', globalTotal);
		formData.append('alldiskon', globalDiskon);
		formData.append('alljumlah', globalJumlah);

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
			url: API_URL + "/keuangan/po/edit",
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