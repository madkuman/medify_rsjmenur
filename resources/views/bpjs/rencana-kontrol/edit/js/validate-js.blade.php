<script type="text/javascript">
    function validateForm(){
        return jQuery('#formSEP').validate({
            ignore: [],
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group').after(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid');
                jQuery(e).remove();
            },
            rules: {
                'tanggal_rencana_kontrol': {
                    required: true
                },
                'no_sep': {
                    required: true
                },
                'poli': {
                    required: true
                },
                'dokter': {
                    required: true
                }
            }
        });
    }

</script>