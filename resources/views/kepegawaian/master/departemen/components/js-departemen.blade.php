<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script type="text/javascript">
		jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});

		$(document).on("click","#buttonSubmitDelete", function () {
			$('#buttonSubmitDelete').hide();
			$('#buttonLoadingDelete').show();
		})
		$(document).on("click",".btn-close", function () {
			$('#buttonSubmit').show();
			$('#buttonLoading').hide();
		})

		$(document).on("click",".btn-add", function () {
			$('#form-departemen').trigger('reset');
			$('#form-departemenid').val(0);
			$('#modal-option').text('Tambah');
			$('#modal-departemen').modal('show');
		})

		$(document).on("click",".btn-edit", function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			$('#form-departemen').trigger('reset');
			$('#form-departemenid').val(id);
			$('#form-nama').val(nama);
			$('#modal-option').text('Edit');
			$('#modal-departemen').modal('show');
		})

		$(document).on("click",".btn-delete", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');
			$("#del-btn-departemen").attr('href','{{url()->current()}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Departemen ' + nama + '?')
			$('#deletemodal').modal('show');
		})
</script>