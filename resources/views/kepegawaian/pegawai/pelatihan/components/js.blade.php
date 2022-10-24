<script>
    yearPicker();
    

    $(document).on("click",".btn-add", function () {
			$('#form-pelatihan').trigger('reset');
			$('.js-select2').val('').trigger('change');
			$('#modal-option').text('Tambah');
			$('#modal-create-pelatihan').modal('show');
	})

    $(document).on("click",".btn-detail", function () {
        var id = $(this).data('id');
        var status = $(this).data('status');
		var nama = $(this).parents('tr').find('.nama').text();
		var tahun = $(this).parents('tr').find('.tahun').text();
		var tempat = $(this).parents('tr').find('.tempat').text();
	
        $('#form-verifikasi').trigger('reset');
        $('#form-detail-id').val(id);
        $('#info-nama-pelatihan').html(nama);
        $('#info-tahun-pelatihan').html(tahun);
        $('#info-tempat-pelatihan').html(tempat);

        if (status == 1) {
            $('#btn-verifikasi').hide();
            $('#form-verifikasi').hide();
           
        } else {
            $('#btn-verifikasi').show();
        }
			
		$('#modal-detail-pelatihan').modal('show');
    })
    

		$(document).on("click",".btn-update", function () {
			var id = $(this).data('id');
			var master_id = $(this).parents('tr').find('.master_id').text();
			var tahun = $(this).parents('tr').find('.tahun').text();
			var tempat = $(this).parents('tr').find('.tempat').text();
			var skor = $(this).parents('tr').find('.skor').text();
            var durasi = $(this).parents('tr').find('.durasi').text();
           
			$('#form-update-pelatihan').trigger('reset');
			$('#form-id').val(id);
            $('#form-master_id').val(master_id).trigger('change');
			$('#form-tahun').val(tahun)
			$('#form-tempat').val(tempat);
            $('#form-skor').val(skor);
			$('#form-durasi').val(durasi);
            
			$('#modal-update-pelatihan').modal('show');
            
		})

		$(document).on("click",".btn-delete", function () {
			var id = $('#form-detail-id').val();
			var nama = $('#info-nama-pelatihan').html();

			$("#del-btn-pelatihan").attr('href','{{url('kepegawaian/pegawai/pelatihan')}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Pelatihan ' + nama + '?')
            $('#modal-detail-pelatihan').modal('hide');
			$('#modal-delete').modal('show');

		})

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
                    
                        $('#add-tahun').val(data.tahun);
                        $('#add-tempat').val(data.tempat);
                        $('#add-skor').val(data.skor);
                        $('#add-durasi').val(data.durasi);
    
                    }
                });
                }
                return false;
            }); 
        }); 
        $(document).ready(function(){
            $('#form-master_id').change(function(){ 
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
                    
                        $('#form-tahun').val(data.tahun);
                        $('#form-tempat').val(data.tempat);
                        $('#form-skor').val(data.skor);
                        $('#form-durasi').val(data.durasi);
    
                    }
                });
                }
                return false;
            }); 
        }); 

        $(document).on("submit","#form-pelatihan", function (e) {
			$('#buttonSubmitCreate').hide();
			$('#buttonLoadingCreate').show();
		})

		$(document).on("click",".btn-submit-edit", function () {
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
             
</script>