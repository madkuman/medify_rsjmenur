<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script type="text/javascript">
		jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});

		$(document).on("click",".btn-add", function () {
			$('#form-jenis-jabatan').trigger('reset');
			$('#form-jenisjabatanid').val(0);
			$('#modal-option').text('Tambah');
			$('#modal-jenis-jabatan').modal('show');
		})

		$(document).on("click",".btn-edit", function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			$('#form-jenis-jabatan').trigger('reset');
			$('#form-jenisjabatanid').val(id);
			$('#form-nama').val(nama);
			$('#modal-option').text('Edit');
			$('#modal-jenis-jabatan').modal('show');
		})

		$(document).on("click",".btn-delete", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');
			$("#del-btn-jabatan").attr('href','{{url()->current()}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data jenis jabatan ' + nama + '?')
			$('#deletemodal').modal('show');
		})


		$(document).on("click",".btn-submit", function () {
			$('#buttonSubmit').hide();
			$('#buttonLoading').show();
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
</script>