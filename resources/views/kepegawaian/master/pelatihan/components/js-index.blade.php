<script>
    yearPicker();
    
	jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});

    $(document).on("click",".btn-add", function () {
			$('#form-pelatihan').trigger('reset');
			$('#form-id').val(0);
			$('.js-select2').val('').trigger('change');
			$('#modal-option').text('Tambah');
			$('#modal-create-pelatihan').modal('show');
	})

	$(document).on("click",".btn-update", function () {
		var id = $(this).data('id');
		var nama = $(this).parents('tr').find('.nama').text();
		var tahun = $(this).parents('tr').find('.tahun').text();
		var tempat = $(this).parents('tr').find('.tempat').text();
		var skor = $(this).parents('tr').find('.skor').text();
        var durasi = $(this).parents('tr').find('.durasi').text();
           
		$('#form-update-pelatihan').trigger('reset');
		$('#form-id').val(id);
        $('#form-nama').val(nama);
		$('#form-tahun').val(tahun).trigger('change');
		$('#form-tempat').val(tempat);
        $('#form-skor').val(skor);
		$('#form-durasi').val(durasi);

		$('#modal-update-pelatihan').modal('show');
            
	})

	$(document).on("click",".btn-delete", function () {
		var id = $(this).data('id');
		var nama = $(this).data('nama');

		$("#del-btn-pelatihan").attr('href','{{url('kepegawaian/master/pelatihan')}}' + '/delete/' + id)
		$("#show-name").html('Anda yakin ingin menghapus data Pelatihan ' + nama + '?')
		$('#deletemodal').modal('show');

	})

		$(document).on("click","#buttonSubmitDelete", function () {
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

</script>