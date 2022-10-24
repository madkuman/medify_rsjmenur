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

			$("#del-btn-gelar").attr('href','{{url('kepegawaian/master/gelar-pendidikan/delete')}}' + '/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data gelar ' + nama + '?')

		})

		$(document).on("click",".btn-edit", function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var index = $(this).data('index-gelar');
			var strata = $(this).parents('tr').find('.strata').text();
		
			$('#form-gelar').trigger('reset');
			$('#form-gelarid').val(id);
			$('#form-nama').val(nama);
            $('#index-gelar').val(index);
            console.log(index,$('#index-gelar'),$(this))
			$('#form-strata').val(strata).trigger('change');
			//$('#modal-option').text('Edit');
			$('#modal-edit-gelar').modal('show');
		})

		$(document).on("click",".btn-submit-create", function () {
			if( $('#create-nama-gelar').val()!= "" && $('#strata-pendidikan').val() != ""){
				$('#buttonSubmitCreate').hide();
				$('#buttonLoadingCreate').show();
			}
			
		})

		$(document).on("click",".btn-submit-edit", function () {
			if( $('#form-nama').val()!= "" && $('#form-strata').val() != ""){
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