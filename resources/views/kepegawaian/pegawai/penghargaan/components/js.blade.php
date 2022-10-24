<script type="text/javascript">
    datepicker();

    function datepicker() {
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
        });
    }

    $(document).on("click",".btn-add", function () {
			$('#form-tandajasa').trigger('reset');
			$('#form-id').val(0);
			$('.js-select2').val('').trigger('change');
			$('#modal-option').text('Tambah');
			$('#modal-tandajasa').modal('show');
	    })

    $(document).on("click",".btn-detail", function () {
        var id = $(this).data('id');
        var status = $(this).data('status');
		var nama = $(this).parents('tr').find('.nama').text();
		var nost = $(this).parents('tr').find('.no-st').text();
		var pemberi = $(this).parents('tr').find('.pemberi').text();
    
        $('#form-verifikasi').trigger('reset');
        $('#form-detail-id').val(id);
        $('#info-nama-tandajasa').html(nama);
        $('#info-nost-tandajasa').html(nost);
        $('#info-pemberi-tandajasa').html(pemberi);

        if (status == 1) {
            $('#btn-verifikasi').hide();
           
        } else {
            $('#btn-verifikasi').show();
        }
			
		$('#modal-detail-tandajasa').modal('show');
    })
    

		$(document).on("click",".btn-update", function () {
            var id = $(this).data('id');
            var masterid = $(this).data('masterid');
			var nama = $(this).parents('tr').find('.nama').text();
			var nost = $(this).parents('tr').find('.st-number').text();
			var tglterbit = $(this).parents('tr').find('.tgl-terbit').text();
            var pemberi = $(this).parents('tr').find('.pemberi').text();
    
			$('#form-tandajasa').trigger('reset');
            $('#add-penghargaanid').val(id);

            $('#add-nama').val(masterid).trigger('change');
			$('#add-st-number').val(nost);
			$('#add-tgl-terbit').val(tglterbit);
            $('#add-pemberi').val(pemberi);

			$('#modal-tandajasa').modal('show');
            
		})

		$(document).on("click",".btn-delete", function () {
			var id = $('#form-detail-id').val();
			var nama = $('#info-nama-tandajasa').html();

			$("#form-delete-penghargaan").attr('action','{{url('kepegawaian/pegawai/penghargaan')}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Penghargaan ' + nama + '?')
            $('#modal-detail-tandajasa').modal('hide');
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
        
        $(document).ready(function(){
            $('#add-nama').change(function(){ 
                var id=$(this).val();
                if (id === '' || id === null || id === undefined){
                    $('.fa-spinner').hide();
                } else {
                $.ajax({
                    url : '{{url()->current()}}/get_data',
                    method : "POST",
                    data : { id: id, _token: '{{csrf_token()}}' },
                    async : true,
                    dataType : 'json',
                    beforeSend:function() {
                        $('.fa-spinner').show();
                    },
                    success: function(data){
                        $('.fa-spinner').hide();
                        $('#add-masterid').val(data.id);
                        $('#add-st-number').val(data.st_number);
                        $('#add-tgl-terbit').val(data.tgl_terbit);
                        $('#add-pemberi').val(data.pemberi);
                    }
                });
                }
                return false;
            }); 
        });

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
</script>