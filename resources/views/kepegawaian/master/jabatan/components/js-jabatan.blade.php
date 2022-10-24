<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>


<script type="text/javascript">
		$('.form-gaji').mask('000.000.000.000.000', {reverse: true});

		jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});

		$(document).on("click",".btn-add", function () {
			$('#form-jabatan').trigger('reset');
			$('#form-jabatanid').val(0);
			$('.js-select2').val('').trigger('change');
			$('#modal-option').text('Tambah');
			$('#modal-jabatan').modal('show');
		})

		$(document).on("click",".btn-edit", function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var index = $(this).data('index')
			var gaji = $(this).parents('tr').find('.gaji').text();
			var urutan = $(this).parents('tr').find('.urutan').text();
			var jenis_jabatan = $(this).parents('tr').find('.jenis-jabatan').text();
			var departemen = $(this).parents('tr').find('.departemen').text();
            var parent = $(this).parents('tr').find('.pimpinan').text();
			$('#form-jabatan').trigger('reset');
			$('#form-jabatanid').val(id);
			$('#form-nama').val(nama);
            $('#form-index').val(index);
			$('#form-jenis-jabatan').val(jenis_jabatan).trigger('change');
			$('#form-departemen').val(departemen).trigger('change');
            $('#form-jabatan-pimpinan').val(parent).trigger('change');
			$('#form-gaji').val(parseInt(gaji).toLocaleString('id'));
			$('#form-urutan').val(urutan);
			$('#modal-option').text('Edit');
			$('#modal-jabatan').modal('show');
		})

		$(document).on("click",".btn-delete", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');
			$("#del-btn-jabatan").attr('href','{{url()->current()}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data jabatan ' + nama + '?')
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
</script>