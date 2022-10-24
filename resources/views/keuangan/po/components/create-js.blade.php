<script type="text/javascript">
//IMPORT CSV TO DETAIL TRANSAKSI (OBSOLETE FOR NOW)

function importCSV() {
    var fileCSV = document.getElementById("fileCSV");
    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv)$/;
    if (regex.test(fileCSV.value.toLowerCase())) {
        if (typeof (FileReader) != "undefined") {
            $('#tipePO').attr('disabled', true);
            $('#transaksiTable tbody').empty();
            transaksiCollection.reset();
            rowCount = 0;

            var reader = new FileReader();
            reader.onload = function (e) {
                var rows = e.target.result.split("\n");
                for (var i = 0; i < rows.length; i++) {
                    if (i == 0) continue;
                    var cells = rows[i].split(";");
                    if (cells.length == 6) {
                        rowCount++;
                        content = '<tr id="transaksiRow'+ rowCount +'">'
                        content+= '<th class="text-center" scope="row">'+ rowCount +'</th>'
                        content+= '<td class="text-view layanan-par">'
                        content+= '<input type="text" class="d-none" id="layanan'+ rowCount +'" value="'+ cells[0] +'">'
                        content+= '<a href="#" class="layanan-text" data-type="text" data-pk="'+ rowCount +'" data-placeholder="Masukkan Deskripsi" style="display: none;">'+ cells[0] +'</a>'
                        content+= '<div class="layanan-select2-container"><select class="js-select2 form-control layanan-select2" data-pk="'+ rowCount +'" style="width: 100%;" data-placeholder="Pilih Barang"><option></option></select></div>'
                        content+= '</td>'
                        content+= '<td class="text-center keterangan-par"><input type="text" class="d-none" id="keterangan'+ rowCount +'" value="'+ cells[1] +'"><a href="#" class="keterangan" data-type="textarea" data-pk="'+ rowCount +'" data-placeholder="Opsional">'+ cells[1] +'</a></td>'
                        content+= '<td class="text-center jumlah-par"><input type="text" class="d-none" id="jumlah'+ rowCount +'" value="'+ cells[2] +'"><a href="#" class="jumlah" data-type="number" data-pk="'+ rowCount +'" data-placeholder="Masukkan jumlah">'+ cells[2] +'</a></td>'
                        content+= '<td class="text-right harga-par"><input type="text" class="d-none" id="harga'+ rowCount +'" value="'+ cells[3] +'"><a href="#" class="harga" data-type="text" data-pk="'+ rowCount +'" data-placeholder="Harga Satuan">'+ cells[3] +'</a></td>'
                        content+= '<td class="text-center diskon-par"><input type="text" class="d-none" id="diskon'+ rowCount +'" value="'+ cells[4] +'"><a href="#" class="diskon" data-type="text" data-pk="'+ rowCount +'" data-placeholder="Diskon %">'+ cells[4] +'</a></td>'
                        content+= '<td class="text-right bg-warning-lighter subtotal">Rp '+ numeral(cells[5]).format('0,0') +'</td>'
                        content+= '<td class="text-right remove-par"><button class="btn btn-alt-danger btn-sm remove" type="button"><i class="fa fa-remove"></i></button></td>'
                        content+= '</tr>'

                        if (rowCount == 1) {
                            $('#transaksiTable tbody').append(content);
                        } else {
                            $('#transaksiTable tr:last').after(content);
                        }
                        $('#transaksiRow'+rowCount).hide();
                        initEditableFromImportCSV(rowCount);
                        backboneAddTransaksiDetail(rowCount, cells[0], cells[2], cells[3], cells[4], cells[5], cells[1]);
                        $('#transaksiRow'+rowCount).show();
                    }
                }
            }
            reader.readAsText(fileCSV.files[0]);
            $('#label-file').empty();
            $('#label-file').append(fileCSV.files[0].name);
        } else {
            callSwal('error','Import Data Gagal','Browser ini tidak mendukung HTML5',0);
        }
    } else {
        callSwal('error','File Salah','Hanya upload file dengan ekstensi .csv',0);
    }
}

function initEditableFromImportCSV(pk_id){
    var rowId = '#transaksiRow'+ pk_id;
    var layanan = $(rowId).find(".layanan-select2");
    if ($('#tipePO').val() == 'Farmasi') {
        layanan.select2({
            ajax: {
                url: API_URL+"/farmasi/item/get",
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
    } else {
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
    if ($('#tipePO').val() != 'Farmasi') {
        layanan.closest('.layanan-par').find('.layanan-select2-container').hide();
        layanan.closest('.layanan-par').find('.layanan-text').show();
    }

    layanan.on('change', function() {
        var jumlah = $(this).closest('.layanan-par').siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
        var deskripsi = $(this).select2('data');
        var harga = $(this).closest('.layanan-par').siblings(".harga-par").children('.harga');
        var diskon = $(this).closest('.layanan-par').siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
        var subtotal = $(this).closest('.layanan-par').siblings(".subtotal");
        var keterangan = $(this).closest('.layanan-par').siblings(".keterangan-par").children('.keterangan');
        var id = $(this).data("pk")

        if ($('#tipePO').val() == 'Farmasi') {
            harga.editable('setValue', deskripsi[0].harga);
            keterangan.editable('setValue', deskripsi[0].satuan);
        } else if ($('#tipePO').val() == 'Umum') {
            harga.editable('setValue', deskripsi[0].price);
            keterangan.editable('setValue', deskripsi[0].satuan);
        }
        updateRecord(jumlah,harga.editable('getValue').undefined,diskon,subtotal,id,keterangan.editable('getValue').undefined,deskripsi[0],deskripsi[0].id);
    });

    $('.layanan-text').editable({
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
            }
        },
        success: function(response, newValue) {
            var jumlah = newValue;
            var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
            var id = $(this).data("pk");
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
            }
        },
        success: function(response, newValue) {
            var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
            var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = newValue;
            var id = $(this).data("pk")
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
            }
        },
        success: function(response, newValue) {
            var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
            var harga = newValue;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
            var id = $(this).data("pk")
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
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
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
        }
    });
    
    $('button.remove').click(function(){
        var deskripsi_select2 = $(this).parent(".remove-par").siblings(".layanan-par").find('.layanan-select2');
        var deskripsi_text = $(this).parent(".remove-par").siblings(".layanan-par").find('.layanan-text');
        var harga = $(this).parent(".remove-par").siblings(".harga-par").children('.harga');
        var jumlah = $(this).parent(".remove-par").siblings(".jumlah-par").children('.jumlah');
        var diskon = $(this).parent(".remove-par").siblings(".diskon-par").children('.diskon');
        var subtotal = $(this).parent(".remove-par").siblings(".subtotal");
        var keterangan = $(this).parent(".remove-par").siblings(".keterangan-par").children('.keterangan');

        var id = keterangan.data("pk");
        
        //alert("row count"+rowCount);
        if(rowCount == 1){
            deskripsi_select2.val('').change();
            deskripsi_text.editable('setValue', '');
            harga.editable('setValue', 0);
            jumlah.editable('setValue', 0);
            diskon.editable('setValue', 0);
            keterangan.editable('setValue', '');
            subtotal.html("Rp 0");
            updateRecord(jumlah.editable('getValue').undefined,harga.editable('getValue').undefined,diskon.editable('getValue').undefined,subtotal,id,keterangan.editable('getValue').undefined,'',0);
            $('#tipePO').attr('disabled', false);
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

}

//DECLARING FOR TRANSAKSI DETAIL USING X-EDITABLE
$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
    generateNomor();
    startEditable();

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

function generateNomor() {
    var no = '{{$no}}';
    var bulan = '{{$bulan}}';
    var tahun = '{{$tahun}}';

    if ($('#tipePO').val() == 'Farmasi') {
        $('#nopo').val(+no+'/'+bulan+'/BEKKES/'+tahun);
    } else if ($('#tipePO').val() == 'Umum') {
        $('#nopo').val(+no+'/'+bulan+'/BEKKUM/'+tahun);
    } else {
        $('#nopo').val(+no+'/'+bulan+'/KONSTRUKSI/'+tahun);
    }
}

var rowCount = document.getElementsByClassName("existRow").length;

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

$('#tipePO').on('change', function() {
    generateNomor();
    if ($('#tipePO').val() == 'Farmasi') {
        $(".layanan-select2").val('').change();
        $(".layanan-select2").select2('destroy');
        $(".layanan-select2").select2({
            ajax: {
                url: API_URL+"/farmasi/item/get",
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
        $(".layanan-select2-container").show();
        $(".layanan-text").hide();
        $(".import-container").hide();
    }
    // Temporarily disabled due to lack of master data at Aset
    /*
    else if ($('#tipePO').val() == 'Umum') {
        $(".layanan-select2").val('').change();
        $(".layanan-select2").select2('destroy');
        $(".layanan-select2").select2({
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
        $(".layanan-select2-container").show();
        $(".layanan-text").hide();
        $(".import-container").hide();
    }
    */
    else {
        $(".layanan-text").editable('setValue','');
        $(".layanan-select2-container").hide();
        $(".layanan-text").show();
        $(".import-container").show();
    }
});

function initEditable(pk_id){
    var rowId = '#transaksiRow'+ pk_id;
    var layanan = $(rowId).find(".layanan-select2");
    if ($('#tipePO').val() == 'Farmasi') {
        layanan.select2({
            ajax: {
                url: API_URL+"/farmasi/item/get",
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
    } else {
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
    if ($('#tipePO').val() != 'Farmasi') {
        layanan.closest('.layanan-par').find('.layanan-select2-container').hide();
        layanan.closest('.layanan-par').find('.layanan-text').show();
    }

    layanan.on('change', function() {
        var jumlah = $(this).closest('.layanan-par').siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
        var deskripsi = $(this).select2('data');
        var harga = $(this).closest('.layanan-par').siblings(".harga-par").children('.harga');
        var diskon = $(this).closest('.layanan-par').siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
        var subtotal = $(this).closest('.layanan-par').siblings(".subtotal");
        var keterangan = $(this).closest('.layanan-par').siblings(".keterangan-par").children('.keterangan');
        var id = $(this).data("pk")

        if ($('#tipePO').val() == 'Farmasi') {
            harga.editable('setValue', deskripsi[0].harga);
            keterangan.editable('setValue', deskripsi[0].satuan);
        } else if ($('#tipePO').val() == 'Umum') {
            harga.editable('setValue', deskripsi[0].price);
            keterangan.editable('setValue', deskripsi[0].satuan);
        }
        updateRecord(jumlah,harga.editable('getValue').undefined,diskon,subtotal,id,keterangan.editable('getValue').undefined,deskripsi[0],deskripsi[0].id);
    });

    $('.layanan-text').editable({
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
            }
        },
        success: function(response, newValue) {
            var jumlah = newValue;
            var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
            var id = $(this).data("pk");
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
            }
        },
        success: function(response, newValue) {
            var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
            var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = newValue;
            var id = $(this).data("pk")
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
            }
        },
        success: function(response, newValue) {
            var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
            var harga = newValue;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
            var id = $(this).data("pk")
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
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
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
        }
    });
    
    $('button.remove').click(function(){
        var deskripsi_select2 = $(this).parent(".remove-par").siblings(".layanan-par").find('.layanan-select2');
        var deskripsi_text = $(this).parent(".remove-par").siblings(".layanan-par").find('.layanan-text');
        var harga = $(this).parent(".remove-par").siblings(".harga-par").children('.harga');
        var jumlah = $(this).parent(".remove-par").siblings(".jumlah-par").children('.jumlah');
        var diskon = $(this).parent(".remove-par").siblings(".diskon-par").children('.diskon');
        var subtotal = $(this).parent(".remove-par").siblings(".subtotal");
        var keterangan = $(this).parent(".remove-par").siblings(".keterangan-par").children('.keterangan');

        var id = keterangan.data("pk");
        
        //alert("row count"+rowCount);
        if(rowCount == 1){
            deskripsi_select2.val('').change();
            deskripsi_text.editable('setValue', '');
            harga.editable('setValue', 0);
            jumlah.editable('setValue', 0);
            diskon.editable('setValue', 0);
            keterangan.editable('setValue', '');
            subtotal.html("Rp 0");
            updateRecord(jumlah.editable('getValue').undefined,harga.editable('getValue').undefined,diskon.editable('getValue').undefined,subtotal,id,keterangan.editable('getValue').undefined,'',0);
            $('#tipePO').attr('disabled', false);
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
    jumlah = layanan.closest('.layanan-par').siblings(".jumlah-par").children('.jumlah').editable('setValue',1);
    harga = layanan.closest('.layanan-par').siblings(".harga-par").children('.harga').editable('setValue',0);
    diskon = layanan.closest('.layanan-par').siblings(".diskon-par").children('.diskon').editable('setValue',0);
    keterangan = layanan.closest('.layanan-par').siblings(".keterangan-par").children('.keterangan').editable('setValue','');
    layanan_text = layanan.closest('.layanan-par').find('.layanan-text').editable('setValue','');

    subtotal_number = 0;
    subtotal_number_formatted = numeral(subtotal_number).format('0,0');

    subtotal = layanan.closest('.layanan-par').siblings(".subtotal").html('Rp ' + subtotal_number_formatted);

    backboneAddTransaksiDetail(id,'',1,0,'',subtotal_number,0);

}

function startEditable(){
    var layanan = $('#transaksiRow1').find(".layanan-select2");
    if ($('#tipePO').val() == 'Farmasi') {
        layanan.select2({
            ajax: {
                url: API_URL+"/farmasi/item/get",
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
    } else {
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
    if ($('#tipePO').val() != 'Farmasi') {
        layanan.closest('.layanan-par').find('.layanan-select2-container').hide();
        layanan.closest('.layanan-par').find('.layanan-text').show();
    }

    layanan.on('change', function() {
        var jumlah = $(this).closest('.layanan-par').siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
        var deskripsi = $(this).select2('data');
        var harga = $(this).closest('.layanan-par').siblings(".harga-par").children('.harga');
        var diskon = $(this).closest('.layanan-par').siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
        var subtotal = $(this).closest('.layanan-par').siblings(".subtotal");
        var keterangan = $(this).closest('.layanan-par').siblings(".keterangan-par").children('.keterangan');
        var id = $(this).data("pk")

        if ($('#tipePO').val() == 'Farmasi') {
            harga.editable('setValue', deskripsi[0].harga);
            keterangan.editable('setValue', deskripsi[0].satuan);
        } else if ($('#tipePO').val() == 'Umum') {
            harga.editable('setValue', deskripsi[0].price);
            keterangan.editable('setValue', deskripsi[0].satuan);
        }
        updateRecord(jumlah,harga.editable('getValue').undefined,diskon,subtotal,id,keterangan.editable('getValue').undefined,deskripsi[0],deskripsi[0].id);
    });

    $('.layanan-text').editable({
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
            }
        },
        success: function(response, newValue) {
            var jumlah = newValue;
            var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
            var id = $(this).data("pk")
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
            }
        },
        success: function(response, newValue) {
            var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
            var harga = $(this).parent().siblings(".harga-par").children('.harga').editable('getValue').undefined;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = newValue;
            var id = $(this).data("pk")
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
            }
        },
        success: function(response, newValue) {
            var jumlah = $(this).parent().siblings(".jumlah-par").children('.jumlah').editable('getValue').undefined;
            var harga = newValue;
            var diskon = $(this).parent().siblings(".diskon-par").children('.diskon').editable('getValue').undefined;
            var subtotal = $(this).parent().siblings(".subtotal");
            var keterangan = $(this).parent().siblings(".keterangan-par").children('.keterangan').editable('getValue').undefined;
            var id = $(this).data("pk")
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
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
            var layanan_select2 = $(this).parent().siblings(".layanan-par").find('.layanan-select2');
            var layanan_text = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (layanan_select2.val() == "" && layanan_text == "") {
                return 'Silahkan isi deskripsi terlebih dahulu';
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
            var deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-text').editable('getValue').undefined;
            if (deskripsi == "") {
                deskripsi = $(this).parent().siblings(".layanan-par").find('.layanan-select2').select2('data');
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi[0],deskripsi[0].id);
            }
            else {
                updateRecord(jumlah,harga,diskon,subtotal,id,keterangan,deskripsi,0);
            }
        }
    });
    
    $('button.remove').click(function(){
        var deskripsi_select2 = $(this).parent(".remove-par").siblings(".layanan-par").find('.layanan-select2');
        var deskripsi_text = $(this).parent(".remove-par").siblings(".layanan-par").find('.layanan-text');
        var harga = $(this).parent(".remove-par").siblings(".harga-par").children('.harga');
        var jumlah = $(this).parent(".remove-par").siblings(".jumlah-par").children('.jumlah');
        var diskon = $(this).parent(".remove-par").siblings(".diskon-par").children('.diskon');
        var subtotal = $(this).parent(".remove-par").siblings(".subtotal");
        var keterangan = $(this).parent(".remove-par").siblings(".keterangan-par").children('.keterangan');

        var id = keterangan.data("pk");
        
        //alert("row count"+rowCount);
        if(rowCount == 1){
            deskripsi_select2.val('').change();
            deskripsi_text.editable('setValue', '');
            harga.editable('setValue', 0);
            jumlah.editable('setValue', 0);
            diskon.editable('setValue', 0);
            keterangan.editable('setValue', '');
            subtotal.html("Rp 0");
            updateRecord(jumlah.editable('getValue').undefined,harga.editable('getValue').undefined,diskon.editable('getValue').undefined,subtotal,id,keterangan.editable('getValue').undefined,'',0);
            $('#tipePO').attr('disabled', false);
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

    id = $('.layanan-select2').data("pk");
    harga = $('.harga').editable('setValue',0);
    jumlah = $('.jumlah').editable('setValue',1);
    diskon = $('.diskon').editable('setValue',0);
    keterangan = $('.keterangan').editable('setValue','');
    layanan_text = $('.layanan-text').editable('setValue','');

    subtotal_number = 0;
    subtotal_number_formatted = numeral(subtotal_number).format('0,0');

    subtotal = $('.subtotal').html('Rp ' + subtotal_number_formatted);

    backboneAddTransaksiDetail(id,'',1,0,'',subtotal_number,0);

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
        backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,id,layanan,layanan_id);
    } else {
        if ($('#tipePO').val() == 'Farmasi') {
            backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,id,layanan.nama+" ("+layanan.satuan+")",layanan_id);
        } else {
            backboneUpdateTransaksi(jumlah,harga,diskon,subtotal_number,keterangan,id,layanan.name,layanan_id);
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

var TransaksiDetail = Backbone.Model.extend({
    defaults: {
        pk_id: "",
        layanan_string: "",
        layanan_id: "",
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


function backboneAddTransaksiDetail(id,layanan_string,jumlah,harga,diskon,subtotal,keterangan="",layanan_id=0)
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
        layanan_id: layanan_id,
        jumlah: jumlah,
        harga: harga,
        diskon: diskon,
        subtotal: subtotal,
        keterangan: keterangan
    });

    transaksiCollection.add(detail);

    updateAllTotal();
}


function backboneUpdateTransaksi(jumlah,harga,diskon,subtotal,keterangan,id,layanan_string="",layanan_id=0)
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
            keterangan:keterangan
        });
    }
    updateAllTotal();
}

/*BUTTON EVENT*/
$('#tambahRecord').click(function() {
    rowCount++;
    content = '<tr id="transaksiRow'+ rowCount +'">'
    content+= '<th class="text-center" scope="row">'+ rowCount +'</th>'
    content+= '<td class="text-view layanan-par">'
    content+= '<a href="#" class="layanan-text" data-type="text" data-pk="'+ rowCount +'" data-placeholder="Masukkan Deskripsi" style="display: none;"></a>'
    content+= '<div class="layanan-select2-container"><select class="js-select2 form-control layanan-select2" data-pk="'+ rowCount +'" style="width: 100%;" data-placeholder="Pilih Barang"><option></option></select></div>'
    content+= '</td>'
    content+= '<td class="text-center keterangan-par"><a href="#" class="keterangan" data-type="textarea" data-pk="'+ rowCount +'" data-placeholder="Opsional"></a></td>'
    content+= '<td class="text-center jumlah-par"><a href="#" class="jumlah" data-type="text" data-pk="'+ rowCount +'" data-placeholder="Masukkan jumlah">0</a></td>'
    content+= '<td class="text-right harga-par"><a href="#" class="harga" data-type="text" data-pk="'+ rowCount +'" data-placeholder="Harga Satuan">0</a></td>'
    content+= '<td class="text-center diskon-par"><a href="#" class="diskon" data-type="text" data-pk="'+ rowCount +'" data-placeholder="Diskon %">0</a></td>'
    content+= '<td class="text-right  bg-warning-lighter subtotal">Rp 0</td>'
    content+= '<td class="text-right remove-par"><button class="btn btn-alt-danger btn-sm remove" type="button"><i class="fa fa-remove"></i></button></td>'
    content+= '</tr>'
    
    $('#transaksiTable tr:last').after(content);
    $('#transaksiRow'+rowCount).hide();
    initEditable(rowCount);
    $('#transaksiRow'+rowCount).show();
    $('#tipePO').attr('disabled', true);
    
});

function ajaxSubmit(){
// $('#buttonSubmit').click(function() {
    var judul = $('#judul').val();
    var tanggalpo = $('#tanggalpo').val();
    var nopo = $('#nopo').val();
    var tanggalspkktr = $('#tanggalspkktr').val();
    var nospkktr = $('#nospkktr').val();
    var perusahaan_id = $('#perusahaan').val();
    var tipepo = $('#tipePO').val();
    var adendum = $('#adendum').val();
    var termin = $('#termin').val();
    var faktur = $('#faktur').val();
    
    if(tanggalpo == '')
        callSwal('warning','Transaksi Gagal','Tanggal Tidak Boleh Kosong',0);
    else if(nopo == '')
        callSwal('warning','Transaksi Gagal','Nomor Tidak Boleh Kosong',0);
    else if(transaksiCollection.length < 1)
        callSwal('warning','Transaksi Gagal','Transaksi Tidak Boleh Kosong',0);
    else if(judul == '')
        callSwal('warning','Transaksi Gagal','Judul Tidak Boleh Kosong',0);
    else if(perusahaan_id == '')
        callSwal('warning','Transaksi Gagal','Perusahaan Tidak Boleh Kosong',0);
    else if(termin == '' && globalTotal >= 200000000)
        callSwal('warning','Transaksi Gagal','Jumlah Termin Tidak Boleh Kosong',0);
    else{
        var transaksiCollectionJSON = JSON.stringify(transaksiCollection);
        var formData = new FormData();
        formData.append('tanggalpo', tanggalpo);
        formData.append('nopo', nopo);
        formData.append('tanggalspkktr', tanggalspkktr);
        formData.append('nospkktr', nospkktr);
        formData.append('judul', judul);
        formData.append('perusahaan_id', perusahaan_id);
        formData.append('tipepo', tipepo);
        formData.append('adendum', adendum);
        formData.append('termin', termin);
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
            url: API_URL + "/keuangan/po/baru",
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
// });
}

</script>