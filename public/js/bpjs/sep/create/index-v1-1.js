var pasienRM = null;
var pasienBPJS = null;
var data_rujukan = null;

$(document).ready(function() {
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
                for (var i = 0; i < pasien.pembayaran.length; i++) {
                    pasienBPJS = pasien.pembayaran[i];
                    if(pasienBPJS.perusahaan.type == 1)
                        break;
                    else
                        pasienBPJS = null;
                }
                if(!is_inap)
                    getNoRujukan(pasienBPJS.no_asuransi);
                //tambahin yg ngeget data pasien yg di BPJS
                // getPesertaBpjs(pasienBPJS.no_asuransi);
                $('#preview_pasien_nama').text(pasien.name);
                $('#preview_pasien_no_rm').text("#"+pasien.no_rm);
                $('#preview_pasien_no_bpjs').text(pasienBPJS.no_asuransi);
                $('#preview_pasien_jenis_bpjs').text(pasienBPJS.perusahaan.nama);
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

$('#submit').on('click', function() {
    if(!is_inap && (data_rujukan == null || data_rujukan == undefined)){
        $('#error-wrapper > span').text("Nomor Rujukan Tidak Ditemukan Atau Pilih Pasien Terlebih Dahulu");
        $('#error-wrapper').show();
        return;
    }

    $('#error-wrapper').hide();
    $('#submit').hide();
    $('#loading').show();
    var dateObj = new Date();
    var tgl =  (dateObj.getUTCFullYear()) + "-"+
             (dateObj.getUTCMonth() + 1)+ "-"+
             (dateObj.getUTCDate());
    var formData = new FormData();
    var jenisPelayanan = $('input[name=jenisRawat]:checked').val();
    if(data_rujukan == -1 && jenisPelayanan != 1){
        formData.append('bpjs_no_rujukan', "0");
        formData.append('bpjs_asal_rujukan', "2");
        formData.append('bpjs_tgl_rujukan', tgl);
        formData.append('bpjs_ppk_rujukan', ppk_self);
        // formData.append('bpjs_nama_ppk_rujukan', data_rujukan.provPerujuk.nama);
    }else if(jenisPelayanan != 1){
        formData.append('bpjs_no_rujukan', data_rujukan.noKunjungan);
        formData.append('bpjs_asal_rujukan', data_rujukan.tipe_perujuk);
        formData.append('bpjs_tgl_rujukan', data_rujukan.tglKunjungan);
        formData.append('bpjs_ppk_rujukan', data_rujukan.provPerujuk.kode);
        formData.append('bpjs_nama_ppk_rujukan', data_rujukan.provPerujuk.nama);
    }else{
        formData.append('bpjs_no_rujukan', rujukan_sep);
        formData.append('bpjs_asal_rujukan', "2");
        formData.append('bpjs_tgl_rujukan', tgl);
        formData.append('bpjs_ppk_rujukan', ppk_self);
    }
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
        $('#poliSelect').val("").trigger('change');
        $('#poliSelect').attr("disabled", true);
        $('#poliSelect').attr("readonly", true);
    }else{
        $('#poliSelect').attr("disabled", false);
        $('#poliSelect').attr("readonly", false);
    }
});


$('#laka_wrap').change(function() {
    if ($('#laka')[0].checked) {
        $('#form_laka').show();
    } else {
        $('#form_laka').hide();   
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

$('#pasienSelect').on("select2:select", function(arg) {
    var pasien = JSON.parse($('#pasienSelect').val());
    pasienRM = pasien.id;
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
        url: BASE_URL + "/bpjs/sep/search-rujukan/"+noRujukan,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            var res = JSON.parse(response);
            if(res != null || res != undefined || res.user_dpjp != null){
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
            var perujuk = data_rujukan.provPerujuk;
            $('#selectRujukan > option').each(function() {
                if($(this).data('kode') == perujuk.kode){
                    $(this).prop('selected', true);
                    $('#selectRujukan').trigger('change');
                    return false;
                }
            });
            $('#selectRujukan').prop('disabled', true);
            if($('#selectRujukan :selected').data('kode') != perujuk.kode){
                //kasi ajax untuk buat asal rujukan baru trus diselect
            }
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
    }
    $('#error-wrapper').hide();
});

function getNoRujukan(nomor_kartu) {
    $('#dialog_error').hide();
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
                $('#dialog_error > span').text(res.metaData.message);
                $('#dialog_error').show();
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
            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
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
            for (var i = 0; i < res.length ; i++) {
                option.push({
                    id: res[i].kode,
                    text: res[i].nama
                })
            }
            $('#provinsi_laka').select2({
                data : option
            });
        },
        error: function(e) {
            getPropinsi();
        }
    });
}


function getKabupaten(prov) {
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
        },
        error: function(e) {
            getPropinsi();
        }
    });
}

function getKecamatan(kota) {
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
        },
        error: function(e) {
            getPropinsi();
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

