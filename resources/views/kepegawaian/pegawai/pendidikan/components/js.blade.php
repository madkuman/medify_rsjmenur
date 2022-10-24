<script>
    datepicker();

    function datepicker() {
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        });
    }

    $(document).on("click",".btn-add", function () {
			$('#form-create-pendidikan').trigger('reset');
			$('#form-id').val(0);
			$('.js-select2').val('').trigger('change');
			$('#modal-option').text('Tambah');
			$('#modal-create-pendidikan').modal('show');
	})

    $(document).on("click",".btn-detail", function () {
        var id = $(this).data('id');
        var status = $(this).data('status');
		var nama = $(this).parents('tr').find('.nama').text();
		var lulus = $(this).parents('tr').find('.lulus').text();
		var institusi = $(this).parents('tr').find('.nama-institusi').text();
	
        $('#form-verifikasi').trigger('reset');
        $('#form-detail-id').val(id);
        $('#info-nama-pend').html(nama);
        $('#info-tahun-pend').html(lulus);
        $('#info-tempat-pend').html(institusi);

        if (status == 1) {
            $('#buttonSubmitVerifikasi').hide();
            $('#form-verifikasi').hide();
           
        } else {
            $('#buttonSubmitVerifikasi').show();
        }
			
		$('#modal-detail-pendidikan').modal('show');
    })
    

		$(document).on("click",".btn-edit", function () {
			var id = $(this).data('id');
			var nama = $(this).parents('tr').find('.nama').text();
			var jenis = $(this).parents('tr').find('.jenis').text();
			var strata = $(this).parents('tr').find('.strata').text();
			var institusi = $(this).parents('tr').find('.institusi').text();
            var masuk = $(this).parents('tr').find('.masuk').text();
			var lulus = $(this).parents('tr').find('.lulus').text();
            
			$('#form-update-pendidikan').trigger('reset');
			$('#form-id').val(id);
            $('#form-update-nama').val(nama);
			$('#form-jenis').val(jenis).trigger('change');
			$('#form-strata').val(strata).trigger('change');
            $('#form-institusi').val(institusi).trigger('change');
			$('#form-masuk').val(masuk);
			$('#form-lulus').val(lulus);
			
			$('#modal-update-pendidikan').modal('show');
		})

		$(document).on("click",".btn-delete", function () {
			var id = $('#form-detail-id').val();
			var nama = $('#info-nama-pend').html();

			$("#del-btn-pendidikan").attr('href','{{url('kepegawaian/pegawai/pendidikan')}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Pendidikan ' + nama + '?')
            $('#modal-detail-pendidikan').modal('hide');
			$('#deletemodal').modal('show');

		})

        //UPLOAD FILE
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
                        if (type == 1) {
                            $('#img-uploadSertifikat').attr('src', e.target.result);
                        } else if(type == 2) {
                            $('#img-uploadSurat').attr('src', e.target.result);
                        } else if(type == 3) {
                            $('#img-verify-upload').attr('src', e.target.result);
                        } else if(type == 4) {
                            $('#img-verify-uploadEdu').attr('src', e.target.result);
                        }
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            
            $("#imgSertifikat").change(function(){
                readURL(this, 1);
            });
            $("#imgSurat").change(function(){
                readURL(this, 2);
            });
            $("#imgVerifyInp").change(function(){
                readURL(this, 3);
            });
            $("#imgVerifyInpEdu").change(function(){
                readURL(this, 4);
            });
        });
        
        $(document).on("submit","#form-create-pendidikan", function (e) {
			$('#buttonSubmitCreate').hide();
			$('#buttonLoadingCreate').show();
		})

		$(document).on("submit","#form-update-pendidikan", function (e) {
			$('#buttonSubmitEdit').hide();
			$('#buttonLoadingEdit').show();
        })
        
        $(document).on("click",".btn-submit-verifikasi", function () {
			$('#buttonSubmitVerifikasi').hide();
			$('#buttonLoadingVerifikasi').show();
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
            $('#buttonSubmitVerifikasi').show();
			$('#buttonLoadingVerifikasi').hide();
		})
</script>