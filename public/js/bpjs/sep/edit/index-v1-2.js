validator = validateNormal(); 

$( "#formSEP" ).submit(function( event ) {
    event.preventDefault();
});

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


$('#delete').on('click', function(){
    swal({
        title: "Hapus?",
        text: "SEP yang sudah dihapus tidak dapat dikembalikan, lanjutkan?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "hapus",
        cancelButtonText: 'Batal',
    })
    .then((willDelete) => {
        if (willDelete.value) {
            deleteSep();
        }
    });
});

function deleteSep(){
    $('#delete').attr("disabled", true);
    $.ajax({
        type: "POST",
        url: BASE_URL + "/bpjs/sep/"+objSep.no_sep+"/delete",
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            $('#delete').attr("disabled", false);
            if(res.result.metaData.code != 200){
                callSwal('warning', res.result.metaData.message, 0);
                return;
            }else{
                callSwal('success', 'SEP berhasil dihapus', '', "bpjs/sep/search");
            }
        },
        error: function (error) {
            $('#delete').attr("disabled", false);
            $('#submit').show();
            $('#loading').hide();
            console.log(error)
            callSwal("warning", "Gagal menghapus SEP, silahkan coba lagi.", 0);
            return;
        }
    });
}

$('#submit').on('click', function(e) {
    e.preventDefault();
    var val = $('#formSEP').valid();
    console.log(val);
    if(!val)
        return;

    $('#error-wrapper').hide();
    $('#submit').hide();
    $('#loading').show();
    var dateObj = new Date();
    var tgl =  (dateObj.getUTCFullYear()) + "-"+
    (dateObj.getUTCMonth() + 1)+ "-"+
    (dateObj.getUTCDate());
    var formData = new FormData();
    var jenisPelayanan = $('input[name=jenisRawat]:checked').val();
    if(jenisPelayanan == 1){
        formData.append('bpjs_no_rujukan', objSep.no_sep);
        formData.append('bpjs_asal_rujukan', "2");
        formData.append('bpjs_tgl_rujukan', objSep.tgl_sep);
        formData.append('bpjs_ppk_rujukan', ppk_self);
    }else if(data_rujukan == -1){
        formData.append('bpjs_no_rujukan', "0");
        formData.append('bpjs_asal_rujukan', "2");
        formData.append('bpjs_tgl_rujukan', objSep.tgl_sep);
        formData.append('bpjs_ppk_rujukan', ppk_self);
    }else {
        formData.append('bpjs_no_rujukan', data_rujukan.noKunjungan);
        formData.append('bpjs_asal_rujukan', data_rujukan.tipe_perujuk);
        formData.append('bpjs_tgl_rujukan', data_rujukan.tglKunjungan);
        formData.append('bpjs_ppk_rujukan', data_rujukan.provPerujuk.kode);
        formData.append('bpjs_nama_ppk_rujukan', data_rujukan.provPerujuk.nama);
    }
    formData.append('dpjp', $('#dpjpSelect').val());
    formData.append('tanggal_sep', $('#tanggal_sep').val());
    formData.append('bpjs_nomor_kartu',  pasienBPJS.no_asuransi);
    formData.append('bpjs_jenis_pelayanan', $('input[name=jenisRawat]:checked').val());
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
        url: BASE_URL + "bpjs/sep/"+objSep.no_sep+"/edit",
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            $('#submit').show();
            $('#loading').hide();
            if(res.result.metaData.code != 200){
                $('#error-wrapper > span').text(res.result.metaData.message);
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

$('#dpjpSelect').select2({
    ajax: {
        url: function (params) {
            return API_URL+'/bpjs/user/dpjp/'+params.term;
        },
        processResults: function (data, params) {
            var user = JSON.parse(data);
            return {
                results: $.map(user, function(obj) {
                    return { id: obj.kode_dpjp, text: obj.name };
                })
            };
        },
        cache: true
    }
});

$('input[type=radio][name=jenisRawat]').change(function() {
    if($(this).val() != 1){
        $('#poliSelect').val("").trigger('change');
        $('#poliSelect').attr("disabled", true);
        $('#poliSelect').attr("readonly", true);
    }else{
        $('#poliSelect').attr("disabled", false);
        $('#poliSelect').attr("readonly", false);
    }
});

$("#tanggal_laka").datepicker( {
    format: "dd-mm-yyyy",
});

$("#tanggal_sep").datepicker( {
    format: "dd-mm-yyyy",
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

function showPasien(obj) {
    var pasien = JSON.parse(obj);
    pasienRM = pasien.no_rm;
    for (var i = 0; i < pasien.pembayaran.length; i++) {
        pasienBPJS = pasien.pembayaran[i];
        if(pasienBPJS.perusahaan.type == 1)
            break;
        else
            pasienBPJS = null;
    }
    getNoRujukan(pasienBPJS.no_asuransi);
    //tambahin yg ngeget data pasien yg di BPJS
    // getPesertaBpjs(pasienBPJS.no_asuransi);
    $('#preview_pasien_nama').text(pasien.name);
    $('#preview_pasien_no_rm').text("#"+pasien.no_rm);
    $('#preview_pasien_no_bpjs').text(pasienBPJS.no_asuransi);
    $('#preview_pasien_jenis_bpjs').text(pasienBPJS.perusahaan.nama);
    $('#infoPasien').show();
};

$('#provinsi_laka').on("select2:select", function(arg) {
    getKabupaten($('#provinsi_laka').val());
});

$('#kota_laka').on("select2:select", function(arg) {
    getKecamatan($('#kota_laka').val());
});

function previewRujukan() {
    data_rujukan = JSON.parse($('#selectNoRujukan').val());
    if(data_rujukan && data_rujukan !== 'null' && data_rujukan !== 'undefined' && data_rujukan != -1){
        $('#preview_bpjs_modal_diagnosis')
            .text(data_rujukan.diagnosa.kode+" - "+data_rujukan.diagnosa.nama || "-");
        $('#preview_bpjs_modal_pelayanan').text(data_rujukan.pelayanan.nama || "-");
        $('#preview_bpjs_modal_perujuk')
            .text(data_rujukan.provPerujuk.kode+" - "+data_rujukan.provPerujuk.nama || "-");
        $('#preview_bpjs_modal_poli').text(data_rujukan.poliRujukan.nama || "-");
        $('#preview_bpjs_modal_keluhan').text(data_rujukan.keluhan || "-");
        $('#preview_bpjs_modal_cob_nama').text(data_rujukan.peserta.cob.nmAsuransi || "-");
        $('#preview_bpjs_modal_cob_nomor').text(data_rujukan.peserta.cob.noAsuransi || "-");
        $('#infoRujuk').show();
    }else{
        resetBPJSModalPreview();
    }
    $('#error-wrapper').hide();
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

function getNoRujukan(nomor_kartu) {
    var option = [];
    option.push({
        id:'-1',
        text:'Tidak ada Rujukan'
    });
    if(objSep.no_rujukan == 0){
        data_rujukan = -1;
        $('#selectNoRujukan').select2({
                data : option
            });
        $('#selectNoRujukan').val('-1')
        $('#selectNoRujukan').trigger('change');
        return;
    }

    var jenisPelayanan = $('input[name=jenisRawat]:checked').val();
    if(jenisPelayanan == 1){
        option.push({
            id:objSep.no_rujukan,
            text:objSep.no_rujukan
        });
        data_rujukan = -1;
        $('#selectNoRujukan').select2({
                data : option
            });
        $('#selectNoRujukan').val(objSep.no_rujukan)
        $('#selectNoRujukan').trigger('change');
        return;
    }

    $('#error-wrapper').hide();
    $('#loading_select_rujukan').show();
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
            $('#loading_select_rujukan').hide();
            var res = JSON.parse(response);
            if(res.metaData.code != 200){
                $('#error-wrapper > span').text(res.metaData.message);
                $('#error-wrapper').show();
                return;
            }
            $('#selectNoRujukan').empty();
            option.push({
                id : "",
                text : ""});
            var rujukan = res.response.rujukan;
            for (var i = 0; i < rujukan.length; i++) {
                if(objSep.no_rujukan == rujukan[i].noKunjungan){
                    data_rujukan = rujukan[i];
                }
                var nilai = JSON.stringify(rujukan[i]);
                option.push({
                    id : nilai,
                    text :  rujukan[i].noKunjungan
                });
            }
            $('#selectNoRujukan').select2({
                data : option
            });
            $('#selectNoRujukan').val(JSON.stringify(data_rujukan))
            $('#selectNoRujukan').trigger('change');
            previewRujukan();
        },
        error: function (e) {
            console.log(e);
            getNoRujukan(pasienBPJS.no_asuransi);
            $('#error-wrapper > span').text('Gagal mendapatkan data rujukan, silahkan coba lagi.');
            $('#error-wrapper').show();
            return;
        }
    });
}

function getPropinsi() {
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
            var provSelected=-1;
            for (var i = 0; i < res.length ; i++) {
                if(objSep.prov_laka == res[i].kode)
                    provSelected = res[i].kode;
                option.push({
                    id: res[i].kode,
                    text: res[i].nama
                })
            }
            $('#provinsi_laka').select2({
                data : option
            });
            if(provSelected!=-1){
                $('#provinsi_laka').val(provSelected).trigger('change');
                getKabupaten(provSelected);
            }
        },
        error: function(e) {
            getPropinsi();
        }
    });
}


function getKabupaten(prov) {
    var prov_val = prov;
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
            var kabSelected = -1;
            for (var i = 0; i < res.length ; i++) {
                if(objSep.kab_laka)
                    kabSelected = res[i].kode;
                option.push({
                    id: res[i].kode,
                    text: res[i].nama
                })
            }
            $('#kota_laka').select2({
                data : option
            });
            if(kabSelected!=-1){
                $('#kota_laka').val(kabSelected).trigger('change');
                getKecamatan(kabSelected);
            }
        },
        error: function(e) {
            getKabupaten(prov_val);
        }
    });
}

function getKecamatan(kota) {
    var kota_val = kota;
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
            var kcSelected = -1;
            for (var i = 0; i < res.length ; i++) {
                if(objSep.kc_laka == res[i].kode)
                    kcSelected = res[i].kode;
                option.push({
                    id: res[i].kode,
                    text: res[i].nama
                })
            }
            $('#kecamatan_laka').select2({
                data : option
            });
            if(kcSelected!=-1)
                $('#kecamatan_laka').val(kcSelected).trigger('change');
        },
        error: function(e) {
            getKecamatan(kota_val);
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