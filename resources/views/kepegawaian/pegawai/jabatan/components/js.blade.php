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
			$('#form-jabatan').trigger('reset');
			$('#form-id').val(0);
			$('.js-select2').val('').trigger('change');
			$('#modal-option').text('Tambah');
			$('#modal-jabatan').modal('show');
		})

		$(document).on("click",".btn-edit", function () {
			var id = $(this).data('id');
			var departemen = $(this).parents('tr').find('.departemen').text();
			var jabatan = $(this).parents('tr').find('.jabatan').text();
			var number = $(this).parents('tr').find('.number').text();
			var date = $(this).parents('tr').find('.date').text();

			$('#form-jabatan').trigger('reset');
			$('#form-id').val(id);
			$('#form-departemen').val(departemen).trigger('change');
			$('#form-select-jabatan').val(jabatan).trigger('change');
			$('#form-letter-number').val(number);
			$('#form-letter-date').val(date);
			

			$('#modal-option').text('Edit');
			$('#modal-jabatan').modal('show');
		})

		$(document).on("click",".btn-delete", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');
			$("#del-btn-jabatan").attr('href','{{url('kepegawaian/pegawai/jabatan')}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Jabatan ' + nama + '?')
			$('#deletemodal').modal('show');
		})

		$(document).on("submit","#form-jabatan", function (e) {
			$('#buttonSubmitCreate').hide();
			$('#buttonLoadingCreate').show();
		})

		$(document).on("submit","#form-edit-department", function (e) {
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