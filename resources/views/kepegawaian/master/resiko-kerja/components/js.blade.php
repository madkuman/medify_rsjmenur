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
			$('#form-resiko-kerja').trigger('reset');
			$('#form-resikoid').val(0);
			$('#modal-option').text('Tambah');
			$('#modal-resiko-kerja').modal('show');
		})

		$(document).on("click",".btn-edit", function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var index = $(this).data('index');
			$('#form-resiko-kerja').trigger('reset');
			$('#form-resikoid').val(id);
			$('#form-nama').val(nama);
			$('#form-index').val(index);
			$('#modal-option').text('Edit');
			$('#modal-resiko-kerja').modal('show');
		})

		$(document).on("click",".btn-delete", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');
			$("#del-btn").attr('href','{{url()->current()}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Resiko Kerja ' + nama + '?')
			$('#deletemodal').modal('show');
		})
</script>