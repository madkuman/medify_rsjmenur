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
		$('#main-form').trigger('reset');
		$('#input-id').val(0);
		$('#input-nama').val('');
		$('#input-jenis-cuti').val('bulanan');
		$('#input-jumlah-cuti').val('');
		$('#modal-option').text('Tambah');
		$('#modal-form').modal('show');
	})

	$(document).on("click",".btn-edit", function () {
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		var jenis_cuti = $(this).data('jenis-cuti');
		var jumlah_cuti = $(this).data('jumlah-cuti');
		$('#main-form').trigger('reset');
		$('#input-id').val(id);
		$('#input-nama').val(nama);
		$('#input-jenis-cuti').val(jenis_cuti);
		$('#input-jumlah-cuti').val(jumlah_cuti);
		$('#modal-option').text('Edit');
		$('#modal-form').modal('show');
	})

	$(document).on("click",".btn-delete", function () {
		var id = $(this).data('id')
		var nama = $(this).data('nama');
		$("#del-btn-departemen").attr('href','{{url()->current()}}' + '/delete/' + id)
		$("#show-name").html('Anda yakin ingin menghapus data Master Cuti :<strong> ' + nama + '</strong>?')
		$('#deletemodal').modal('show');
	})
</script>