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
            'pembayaran': {
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
            'pembayaran': {
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

function validateNormalRujukManual(){

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
            'pembayaran': {
                required: true
            },
            'poli': {
                required: true
            },
            'no_rujukan_manual': {
                required: true
            },
            'tanggal_rujukan_manual': {
                required: true
            },
            'ppk_perujuk_manual': {
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

function validateLakaRujukManual(){

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
            'pembayaran': {
                required: true
            },
            'no_rujukan_manual': {
                required: true
            },
            'tanggal_rujukan_manual': {
                required: true
            },
            'ppk_perujuk_manual': {
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