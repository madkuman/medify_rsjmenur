<script>
    
    datepicker();

    function datepicker() {
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        });
    }
    
    $('#button-update-keluarga').on('click', function() {
      saveAlert(1, '#form-update-keluarga','', name, '');
    });

    // ADD SIP
    $(document).on("click",".btn-add", function () {
		$('#form').trigger('reset');
		$('#modal-create').modal('show');
	})
 

    // UPDATE SIP
	$(document).on("click",".btn-update-sip", function () {
		var id         = $(this).data('id');
		var sip        = $(this).parents('tr').find('.sip').text();
		var expired    = $(this).parents('tr').find('.expired-sip').text();

		$('#form-sip').trigger('reset');
		$('#form-id-sip').val(id);
        $('#form-no-sip').val(sip);
		$('#form-expired-sip').val(expired);

		$('#modal-sip').modal('show');
            
	})
    // UPDATE STR
	$(document).on("click",".btn-update-str", function () {
		var id         = $(this).data('id');
		var str        = $(this).parents('tr').find('.str').text();
		var expired    = $(this).parents('tr').find('.expired-str').text();

		$('#form-str').trigger('reset');
		$('#form-id-str').val(id);
        $('#form-no-str').val(str);
		$('#form-expired-str').val(expired);

		$('#modal-str').modal('show');
            
	})
 
	$(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
                });

                $('.btn-file :file').on('fileselect', function(event, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = label;
            
            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }
            function readURL(input, type) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                       
                        $('#img-file').attr('src', e.target.result);
                       
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            
            $("#img-upload").change(function(){
                readURL(this, 1);
            });
        });

		$(document).on("submit","#form", function (e) {
			$('#buttonSubmitCreate').hide();
			$('#buttonLoadingCreate').show();
		})

		$(document).on("submit","#form-update", function () {
			$('#buttonSubmitEdit').hide();
			$('#buttonLoadingEdit').show();
		})

		$(document).on("click",".btn-submit-delete", function () {
			$('#buttonSubmitDelete').hide();
			$('#buttonLoadingDelete').show();
		})
		$(document).on("click",".btn-close", function () {
			$('#buttonSubmitCreate').show();
			$('#buttonLoadingCreate').hide();
			$('#buttonSubmitEdit').show();
			$('#buttonLoadingEdit').hide();
			$('#buttonSubmitDelete').show();
			$('#buttonLoadingDelete').hide();
		})

        deleteAlert('.btn-delete-evkin', '.form-delete-evkin', "{{ URL::to('/kepegawaian/pegawai/legalitas/delete') }}", name);
		deleteAlert('.btn-delete-sip', '.form-delete-sip', "{{ URL::to('/kepegawaian/pegawai/legalitas/delete') }}", name);
		deleteAlert('.btn-delete-str', '.form-delete-str', "{{ URL::to('/kepegawaian/pegawai/legalitas/delete') }}", name);
		deleteAlert('.btn-delete-skk', '.form-delete-skk', "{{ URL::to('/kepegawaian/pegawai/legalitas/delete') }}", name);
		deleteAlert('.btn-delete-kredensial', '.form-delete-kredensial', "{{ URL::to('/kepegawaian/pegawai/legalitas/delete') }}", name);
</script>