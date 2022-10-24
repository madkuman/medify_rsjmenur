var pasienRM = null;
var pasienBPJS = null;
var data_rujukan = null;
validator = validateNormal(); 

$(document).ready(function() {
    $('#tanggal_sep').datepicker("setDate", new Date());
    $('#bpjs_catatan').val('-');
    $('input[type=radio][name=jenisRawat][value=2]').prop('checked', true);
    $('#kelasSelect').val(3).trigger('change');
    getPropinsi();
    $('#selectNoRujukan').select2({
        "language": {
            "noResults": function(){
                return "Nomor Rujukan Tidak Ditemukan Atau Pilih Pasien Terlebih Dahulu";
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });

    if (pasien_id_window != -1) {
        $.ajax({
            type: "GET",
            url: API_URL + "/pasien/get-bpjs-by-id/"+pasien_id_window,
            success: function (response) {
                var pasien = JSON.parse(response);
                pasienRM = pasien.id;
                var pembayaran = pasien.pembayaran;
                var option = [];
                option.push({
                    id:"",
                    text:""
                });
                for (var i = 0; i < pembayaran.length; i++) {
                    if(pembayaran[i].perusahaan.type == 1){
                        option.push({
                            id:JSON.stringify(pembayaran[i]),
                            text:pembayaran[i].no_asuransi
                        });
                        if(pembayaran_id_window == pembayaran[i].id){
                            pasienBPJS = pembayaran[i];
                            $('#preview_pasien_no_bpjs').text(pasienBPJS.no_asuransi);
                            $('#preview_pasien_jenis_bpjs').text(pasienBPJS.perusahaan.nama);
                        }
                    }
                }
                $('#pembayaranSelect').select2({
                    data:option
                });
                if(!is_inap && pasienBPJS!=null){
                    $('#pembayaranSelect').val(JSON.stringify(pasienBPJS)).trigger('change');
                    getNoRujukan(pasienBPJS.no_asuransi);
                }
                //tambahin yg ngeget data pasien yg di BPJS
                // getPesertaBpjs(pasienBPJS.no_asuransi);
                $('#preview_pasien_nama').text(pasien.name);
                $('#preview_pasien_no_rm').text("#"+pasien.no_rm);
                $('#infoPasien').show();
            },
            error: function (error) {
                console.log(error);
                return;
            }
        });
    };

    if(is_inap){
        $('#selectNoRujukan').val("1").trigger('change');
        $('input[type=radio][name=jenisRawat][value=1]').prop('checked', true);
        $('#poliSelect').val("").trigger('change');
        $('#poliSelect').attr("disabled", true);
        $('#poliSelect').attr("readonly", true);
    }
});

$( "#formSEP" ).submit(function( event ) {
    event.preventDefault();
});

$('#submit').on('click', function(e) {
    e.preventDefault();
    var val = $('#formSEP').valid();
    if(val){
        $('#error-wrapper').hide();
        $('#submit').hide();
        $('#loading').show();
        var dateObj = new Date();
        var tgl =  (dateObj.getUTCFullYear()) + "-"+
        (("0"+(dateObj.getUTCMonth() + 1)).slice(-2))+ "-"+
        (("0"+dateObj.getUTCDate()).slice(-2));
        var formData = new FormData();
        var jenisPelayanan = $('input[name=jenisRawat]:checked').val();
        var asal = $('input[name=asalRujukan]:checked').val();
        if(tgl.split('-').join("") > $('#tanggal_sep').val().split("").join()){

            tgl = $('#tanggal_sep').val();
        }

        if(data_rujukan == -1 && jenisPelayanan != 1){
            formData.append('bpjs_no_rujukan', "0");
            formData.append('bpjs_tgl_rujukan', tgl);
            formData.append('bpjs_ppk_rujukan', ppk_self);
        }else if(jenisPelayanan != 1){
            formData.append('bpjs_no_rujukan', data_rujukan.noKunjungan);
            formData.append('bpjs_tgl_rujukan', data_rujukan.tglKunjungan);
            formData.append('bpjs_ppk_rujukan', data_rujukan.provPerujuk.kode);
            formData.append('bpjs_nama_ppk_rujukan', data_rujukan.provPerujuk.nama);
        }else{
            formData.append('bpjs_no_rujukan', rujukan_sep);
            formData.append('bpjs_tgl_rujukan', tgl);
            formData.append('bpjs_ppk_rujukan', ppk_self);
        }
        formData.append('bpjs_asal_rujukan', asal);
        formData.append('dpjp', $('#dpjpSelect').val());
        formData.append('tanggal_sep', $('#tanggal_sep').val());
        formData.append('bpjs_nomor_kartu',  pasienBPJS.no_asuransi);
        formData.append('bpjs_jenis_pelayanan', jenisPelayanan);
        formData.append('bpjs_kelas_rawat', $('#kelasSelect').val());
        formData.append('bpjs_no_mr', pasienRM);
        formData.append('bpjs_catatan', $('#bpjs_catatan').val());
        formData.append('bpjs_diag_awal', $('#diagnosisSelect').val());
        formData.append('bpjs_poli_tujuan', $('#poliSelect').val());
        formData.append('bpjs_poli_eksekutif', $('#is_eksekutif').prop("checked") ? 1 : 0);
        formData.append('bpjs_cob', $('#cob').prop("checked") ? 1 : 0);
        formData.append('bpjs_katarak', $('#katarak').prop("checked") ? 1 : 0);
        formData.append('bpjs_jaminan_lakalantas', $('#laka').prop("checked") ? 1: 0);
        formData.append('bpjs_penjamin', $('#penjamin_laka').val() != "" ? $('#penjamin_laka').val() : 0);
        formData.append('bpjs_tgl_kejadian', $('#tanggal_laka').val() ? $('#tanggal_laka').val() : tgl);
        formData.append('bpjs_keterangan_penjamin', $('#keterangan_laka').val() ? $('#keterangan_laka').val() : 0);
        formData.append('bpjs_suplesi', $('#suplesi').prop("checked") ? 1 : 0);
        formData.append('bpjs_no_sep_suplesi', $('#sep_suplesi').val() ? $('#sep_suplesi').val() : 0);
        formData.append('bpjs_prov_laka', $('#provinsi_laka').val() ? $('#provinsi_laka').val() : 0);
        formData.append('bpjs_kab_laka', $('#kota_laka').val() ? $('#kota_laka').val() : 0);
        formData.append('bpjs_kc_laka', $('#kecamatan_laka').val() ? $('#kecamatan_laka').val() : 0);
        $.ajax({
            type: "POST",
            data: formData,
            url: API_URL + "/bpjs/sep/create",
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#submit').show();
                $('#loading').hide();
                if(response.result.metaData.code != 200){
                    $('#error-wrapper > span').text(response.result.metaData.message);
                    $('#error-wrapper').show();
                    return;
                }else{
                    callSwal('success', 'SEP berhasil disimpan', '', "bpjs/sep/search");
                }
            },
            error: function (error) {
                $('#submit').show();
                $('#loading').hide();
                console.log(error)
                $('#error-wrapper > span').text("Gagal menyimpan data, silahkan coba lagi.");
                $('#error-wrapper').show();
                return;
            }
        });
    }
});



$('#diagnosisSelect').select2({
    ajax: {
        url: API_URL+'/kasus/get/list/diagnosis',
        data: function(params){
            return {
                keyword: params.term, 
            };
        },
        processResults: function (data, params) {
            var icd = JSON.parse(data).data;
            return {
                results: $.map(icd, function(obj) {
                    return { id: obj.code_icd, text: obj.code_icd+" - "+obj.long_desc };
                })
            };
        },
        cache: true
    }
});

$('#pasienSelect').select2({
    ajax: {
        url: function (params) {
            return API_URL+'/pasien/get-bpjs/'+params.term;
        },
        processResults: function (data, params) {
          return {
            results: $.map(data, function(obj) {
                return { id: JSON.stringify((obj)), text: obj.name };
            })
          };
        },
        cache: true
    }
});

$('#dpjpSelect').select2();

$('input[type=radio][name=jenisRawat]').change(function() {
    if($(this).val() == 1){
        $('#kelasSelect').val("").trigger('change');
        $('#poliSelect').val("").trigger('change');
        $('#poliSelect').attr("disabled", true);
        $('#poliSelect').attr("readonly", true);
    }else{
        $('#poliSelect').attr("disabled", false);
        $('#poliSelect').attr("readonly", false);
        $('#kelasSelect').val(3).trigger('change');
    }
});


$('#laka_wrap').change(function() {
    if ($('#laka')[0].checked) {
        $('#form_laka').show();
        validator.destroy();
        validator = validateLaka();
    } else {
        $('#form_laka').hide();  
        validator.destroy();
        validator = validateNormal(); 
    }
});

 $('#suplesi_wrap').change(function() {
    if ($('#suplesi')[0].checked) {
        $('#sep_suplesi').attr("disabled", false);
        $('#sep_suplesi').attr("readonly", false);
    } else {
        $('#sep_suplesi').val("");
        $('#sep_suplesi').attr("disabled", true);
        $('#sep_suplesi').attr("readonly", true);
    }
});

$('#poliSelect').on('change', function(){
    var poli_id = $('#poliSelect').val();
    if(poli_id == "IGD"){
        getDpjpPoli($('#poliSelect').val(), 1);
    }else{
        getDpjpPoli($('#poliSelect').val(), 0);
    }
});



$('#pembayaranSelect').on('select2:select', function(){
    var bayar = $('#pembayaranSelect').val();
    pasienBPJS = JSON.parse(bayar);
    $('#preview_pasien_no_bpjs').text(pasienBPJS.no_asuransi);
    $('#preview_pasien_jenis_bpjs').text(pasienBPJS.perusahaan.nama);
    getNoRujukan(pasienBPJS.no_asuransi);
    resetBPJSModalPreview();
});

$('#pasienSelect').on("select2:select", function(arg) {
    $('#pembayaranSelect').val("").trigger('change');
    pasienBPJS = null;
    $('#preview_pasien_no_bpjs').text("");
    $('#preview_pasien_jenis_bpjs').text("");
    var pasien = JSON.parse($('#pasienSelect').val());
    pasienRM = pasien.id;
    var pembayaran = pasien.pembayaran;
    var option = [];
    option.push({
        id:"",
        text:""
    });
    for (var i = 0; i < pembayaran.length; i++) {
        if(pembayaran[i].perusahaan.type == 1){
            option.push({
                id:JSON.stringify(pembayaran[i]),
                text:pembayaran[i].no_asuransi
            });
        }
    }
    $('#pembayaranSelect').empty().trigger("change");
    $('#pembayaranSelect').select2({
        data:option
    });
    //tambahin yg ngeget data pasien yg di BPJS
    // getPesertaBpjs(pasienBPJS.no_asuransi);
    $('#preview_pasien_nama').text(pasien.name);
    $('#preview_pasien_no_rm').text("#"+pasien.no_rm);
    $('#infoPasien').show();
});

$('#provinsi_laka').on("select2:select", function(arg) {
    getKabupaten($('#provinsi_laka').val());
});

$('#kota_laka').on("select2:select", function(arg) {
    getKecamatan($('#kota_laka').val());
});

function getDpjpRujukanSama(noRujukan){
     $.ajax({
        type: "GET",
        url: BASE_URL + "bpjs/sep/search-rujukan/"+noRujukan,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            var res = JSON.parse(response);
            if((res != null || res != undefined) && res.user_dpjp != null){
                var option = [];
                option.push({
                    id:res.user_dpjp.kode_dpjp,
                    text:res.user_dpjp.name
                });
                $('#dpjpSelect').select2({
                    data:option
                });
                $('#dpjpSelect').val(res.user_dpjp.kode_dpjp).trigger('change');
                $('#dpjpSelect').attr("disabled", true);
                $('#dpjpSelect').attr("readonly", true);
            }else{
                $('#dpjpSelect').select2();
                $('#dpjpSelect').attr("disabled", false);
                $('#dpjpSelect').attr("readonly", false);
                $('#poliSelect').val(data_rujukan.poliRujukan.kode).trigger('change');
                $('#poliSelect').attr("disabled", true);
                $('#poliSelect').attr("readonly", true);
                var diagText = data_rujukan.diagnosa.kode+" - "+data_rujukan.diagnosa.nama;
                var diagCode = data_rujukan.diagnosa.kode;
                var newOption = new Option(diagText, diagCode, false, true);
                $('#diagnosisSelect').append(newOption).trigger('change');
            }
        },
        error: function(e) {
            getPropinsi();
        }
    });
}

$('#selectNoRujukan').on('select2:select', function (e) {
    if($(e.currentTarget).find("option:selected").val() != -1){
        data_rujukan = JSON.parse($(e.currentTarget).find("option:selected").val());
        if(data_rujukan && data_rujukan !== 'null' && data_rujukan !== 'undefined'){
            $('input[type=radio][name=asalRujukan][value='+data_rujukan.tipe_perujuk+']').prop('checked', true);
            $('#infoRujuk').show();
            $('#preview_bpjs_modal_diagnosis')
                .text(data_rujukan.diagnosa.kode+" - "+data_rujukan.diagnosa.nama || "-");
            $('#preview_bpjs_modal_pelayanan').text(data_rujukan.pelayanan.nama || "-");
            $('#preview_bpjs_modal_perujuk')
                .text(data_rujukan.provPerujuk.kode+" - "+data_rujukan.provPerujuk.nama || "-");
            $('#preview_bpjs_modal_poli').text(data_rujukan.poliRujukan.nama || "-");
            $('#preview_bpjs_modal_keluhan').text(data_rujukan.keluhan || "-");
            $('#preview_bpjs_modal_cob_nama').text(data_rujukan.peserta.cob.nmAsuransi || "-");
            $('#preview_bpjs_modal_cob_nomor').text(data_rujukan.peserta.cob.noAsuransi || "-");
            getDpjpRujukanSama(data_rujukan.noKunjungan);
        }else{
            resetBPJSModalPreview();
        }
    }else{
        data_rujukan = -1;
        resetBPJSModalPreview();
        $('#dpjpSelect').attr("disabled", false);
        $('#dpjpSelect').attr("readonly", false);
        $('#selectRujukan').prop('disabled', false);
        $('#dpjpSelect').val('').trigger('change');

        $('#poliSelect').val("").trigger('change');
        $('#poliSelect').attr("disabled", false);
        $('#poliSelect').attr("readonly", false);
    }
    $('#error-wrapper').hide();
});

function getNoRujukan(nomor_kartu) {
    $('#error-wrapper').hide();
    $('#rujukan-loading').show();
    var formData = new FormData();
    formData.append('nomor_kartu', nomor_kartu);
    formData.append('multiple', true);
    $.ajax({
        type: "POST",
        data: formData,
        url: API_URL + "/bpjs/rujukan/get/kartu",
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#rujukan-loading').hide();
            var res = JSON.parse(response);
            if(res.metaData.code != 200){
                $('#error-wrapper > span').text(res.metaData.message);
                $('#error-wrapper').show();
                return;
            }
            $('#selectNoRujukan').empty();
            var option = [];
            option.push({
                id : "",
                text : ""});
            var rujukan = res.response.rujukan;
            if(rujukan!="[]"){
                for (var i = 0; i < rujukan.length; i++) {
                    var nilai = JSON.stringify(rujukan[i]);
                    option.push({
                        id : nilai,
                        text :  rujukan[i].noKunjungan
                    });
                }
            }
            option.push({
                id:'-1',
                text:'Tidak ada Rujukan'
            });
            $('#selectNoRujukan').select2({
                data : option
            })
        },
        error: function () {
            $('#rujukan-loading').show();
            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
        }
    });
}

function getPropinsi() {
    $('#prov-laka-loading').show();
    $.ajax({
        type: "GET",
        url: API_URL + "/bpjs/referensi/propinsi",
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            var res = JSON.parse(response).response.list;
            $('#provinsi_laka').empty();
            var option = [];
            option.push({
                id:"",
                "text":""
            });
            for (var i = 0; i < res.length ; i++) {
                option.push({
                    id: res[i].kode,
                    text: res[i].nama
                })
            }
            $('#provinsi_laka').select2({
                data : option
            });
            $('#prov-laka-loading').hide();
        },
        error: function(e) {
            getPropinsi();
            $('#prov-laka-loading').hide();
        }
    });
}


function getKabupaten(prov) {
    $('#kota-laka-loading').show();
    $.ajax({
        type: "GET",
        url: API_URL + "/bpjs/referensi/kabupaten/"+prov,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            var res = JSON.parse(response).response.list;
            $('#kota_laka').empty();
            var option = [];
            option.push({
                id:"",
                "text":""
            });
            for (var i = 0; i < res.length ; i++) {
                option.push({
                    id: res[i].kode,
                    text: res[i].nama
                })
            }
            $('#kota_laka').select2({
                data : option
            });
            $('#kota-laka-loading').hide();
        },
        error: function(e) {
            getPropinsi(prov);
            $('#kota-laka-loading').hide();
        }
    });
}

function getKecamatan(kota) {
    $('#kc-laka-loading').show();
    $.ajax({
        type: "GET",
        url: API_URL + "/bpjs/referensi/kecamatan/"+kota,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            var res = JSON.parse(response).response.list;
            $('#kecamatan_laka').empty();
            var option = [];
            option.push({
                id:"",
                "text":""
            });
            for (var i = 0; i < res.length ; i++) {
                option.push({
                    id: res[i].kode,
                    text: res[i].nama
                })
            }
            $('#kecamatan_laka').select2({
                data : option
            });

            $('#kc-laka-loading').hide();
        },
        error: function(e) {
            getKecamatan(kota);
            $('#kc-laka-loading').show();
        }
    });
}


function resetBPJSModalPreview(){
    $('#preview_bpjs_modal_diagnosis').text("-");
    $('#preview_bpjs_modal_pelayanan').text("-");
    $('#preview_bpjs_modal_perujuk').text("-");
    $('#preview_bpjs_modal_poli').text("-");
    $('#preview_bpjs_modal_keluhan').text("-");
    $('#preview_bpjs_modal_cob_nama').text("-");
    $('#preview_bpjs_modal_cob_nomor').text("-");
    $('#infoRujuk').hide();

}

function getDpjpPoli(kode_bpjs_poli, is_igd) {
    var url;
    if(is_igd == 1){
        url = "/rawatjalan/dokter-bpjs/all";
    }else{
        url = "/rawatjalan/dokter-bpjs/jadwal/today/poli/"+kode_bpjs_poli;
    }
    $('#poli-loading').show();
    $.ajax({
        type: "GET",
        url: API_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            var res = JSON.parse(response);
            $('#dpjpSelect').empty();
            var option = [];
            option.push({
                id:"",
                "text":""
            });
            for (var i = 0; i < res.length ; i++) {
                option.push({
                    id: res[i].kode_dpjp,
                    text: res[i].name
                })
            }
            $('#dpjpSelect').select2({
                data : option
            });
            $('#poli-loading').hide();
        },
        error: function(e) {
            console.log(e);
            $('#poli-loading').hide();
        }
    });
}


function validateNormal(){

    return jQuery('#formSEP').validate({
        ignore: [],
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        errorPlacement: function(error, e) {
            jQuery(e).parents('.form-group').append(error);
        },
        highlight: function(e) {
            jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
        },
        success: function(e) {
            jQuery(e).closest('.form-group').removeClass('is-invalid');
            jQuery(e).remove();
        },
        rules: {
            'pasien': {
                required: true
            },
            'no_rujukan': {
                required: true
            },
            'poli': {
                required: true
            },
            'kelas': {
                required: true
            },
            'dpjp': {
                required: true
            },
            'tanggal_sep': {
                required: true
            },
            'diagnosis': {
                required: true
            },
            'bpjs_catatan': {
                required: true
            }
        }
    });

}

function validateLaka(){

    return jQuery('#formSEP').validate({
        ignore: [],
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        errorPlacement: function(error, e) {
            jQuery(e).parents('.form-group').append(error);
        },
        highlight: function(e) {
            jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
        },
        success: function(e) {
            jQuery(e).closest('.form-group').removeClass('is-invalid');
            jQuery(e).remove();
        },
        rules: {
            'pasien': {
                required: true
            },
            'no_rujukan': {
                required: true
            },
            'poli': {
                required: true
            },
            'kelas': {
                required: true
            },
            'dpjp': {
                required: true
            },
            'tanggal_sep': {
                required: true
            },
            'diagnosis': {
                required: true
            },
            'bpjs_catatan': {
                required: true
            },
            'penjamin_laka': {
                required: true
            },
            'tanggal_laka': {
                required: true
            },
            'provinsi_laka': {
                required: true
            },
            'kota_laka': {
                required: true
            },
            'kecamatan_laka': {
                required: true
            },
            'keterangan_laka': {
                required: true
            },
        }
    });

}