<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script type="text/javascript">

		jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});

		$(document).on("click",".btn-delete", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');

			$("#del-btn-strata").attr('href','{{url('kepegawaian/master/strata-pendidikan/delete')}}' + '/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data strata ' + nama + '?')

		})

		$(document).on("click",".btn-edit", function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var jenis = $(this).parents('tr').find('.jenis').text();
		
			$('#form-strata').trigger('reset');
			$('#form-strataid').val(id);
			$('#form-nama').val(nama);
			$('#form-jenis').val(jenis).trigger('change');
			//$('#modal-option').text('Edit');
			$('#modal-edit-strata').modal('show');
		})



		$(document).on("click",".btn-submit-create", function () {
			if ($('#nama-strata').val() != "" && $('#jenis-pendidikan').val() != ""){
				$('#buttonSubmitCreate').hide();
				$('#buttonLoadingCreate').show();
			}
		})

		$(document).on("click",".btn-submit-edit", function () {
			if ($('#form-nama').val() != "" && $('#form-jenis').val() != ""){
				$('#buttonSubmitEdit').hide();
				$('#buttonLoadingEdit').show();
			}
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