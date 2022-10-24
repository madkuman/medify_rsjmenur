
<script type="text/javascript">

		datepicker();

		function datepicker() {
			$('.datepicker').datepicker({
				autoclose: true,
				todayHighlight: true,
				format: 'yyyy-mm-dd',
			});
		}

		jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});

		$(document).on("click",".btn-outline-danger", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');
			console.log(nama)
			$("#del-btn-penghargaan").attr('href','{{url('kepegawaian/master/penghargaan/delete')}}' + '/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data penghargaan ' + nama + '?')

		})

		function editModal(id){
			$.ajax({
				url: API_URL + '/kepegawaian/penghargaan/get/'+ id,
				type: 'GET',
				dataType: 'json',
				beforeSend:function() {
					$('#loading').removeClass('d-none');
					$('#edit-content').addClass('d-none');
				},
				success: function(data) {
					
					var id			= data.id;
					var nama		= data.nama;
					var tmt			= data.tgl_terbit;
					var st_number 	= data.st_number;
					var status 		= data.status;
					var pemberi 	= data.pemberi;
					 
					$("#form-edit #id").val(id);
					$("#form-edit #nama").val(nama);
					$('#form-edit #tmt').val(tmt);
					$('#form-edit #st-number').val(st_number);
					$('#form-edit #status').val(status);
					$('#form-edit #pemberi').val(pemberi);

					$('#loading').addClass('d-none');
					$('#edit-content').removeClass('d-none');
				},
			});

			$('#modal-edit').modal('show');
		}

		$(document).on("click",".btn-submit-create", function () {
			if($("#create-nama").val() == "" || $("#create-tmt").val() == ""){

			} else {
			$('#buttonSubmitCreate').hide();
			$('#buttonLoadingCreate').show();
			}
		})

		$(document).on("click",".btn-submit-edit", function () {
			$('#buttonSubmitEdit').hide();
			$('#buttonLoadingEdit').show();
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