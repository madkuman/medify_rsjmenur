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
    deleteAlert('.delete-family-button', '.form-delete-family', "{{ URL::to('/kepegawaian/pegawai/keluarga/delete') }}", name);
    

	$(document).on("click",".btn-update", function () {
		var id              = $(this).data('id');
		var nama            = $(this).parents('tr').find('.nama').text();
		var kelamin         = $(this).parents('tr').find('.kelamin').text();
		var tempat_lahir    = $(this).parents('tr').find('.tempat-lahir').text();
		var tanggal_lahir   = $(this).parents('tr').find('.tanggal-lahir').text();
        var nik             = $(this).parents('tr').find('.nik').text();
        var relasi          = $(this).parents('tr').find('.relasi').text();
        var asuransi        = $(this).parents('tr').find('.asuransi').text();
        var no_asuransi     = $(this).parents('tr').find('.no-asuransi').text();
        var faskes          = $(this).parents('tr').find('.faskes').text();
        var kelas           = $(this).parents('tr').find('.kelas').text();
           
		$('#form-update-keluarga').trigger('reset');
		$('#form-id').val(id);
        $('#form-nama').val(nama);
		$('#form-tempat-lahir').val(tempat_lahir);
        $('#form-tanggal-lahir').val(tanggal_lahir);
        $('#form-nik').val(nik);
        $('#form-relasi').val(relasi).trigger('change');;
        $('#form-asuransi').val(asuransi);
        $('#form-no-asuransi').val(no_asuransi);
        $('#form-faskes').val(faskes);
        $('#form-kelas').val(kelas);
        
        if (kelamin == 'Laki-laki') {
            $("#kelamin-lk").prop("checked", true);
        } else {
            $("#kelamin-pr").prop("checked", true);
        }
            
		$('#modal-update-keluarga').modal('show');
            
	})

		$(document).on("click",".btn-delete", function () {
			var id = $('#form-detail-id').val();
			var nama = $('#info-nama-keluarga').html();

			$("#del-btn").attr('href','{{url('kepegawaian/pegawai/keluarga')}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Pelatihan ' + nama + '?')
			$('#modal-delete').modal('show');

		})


        $(document).on("submit","#form-create-keluarga", function (e) {
			$('#buttonSubmitCreate').hide();
			$('#buttonLoadingCreate').show();
		})

		$(document).on("submit","#form-update-keluarga", function (e) {
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