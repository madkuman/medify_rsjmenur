<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>


<script type="text/javascript">

		jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});

		$(document).on("click",".btn-outline-danger", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');
			// console.log(id,nama);
			$("#del-btn").attr('href','{{url('kepegawaian/master/jenis-jabatan/delete')}}' + '/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Jenis Jabatan ' + nama + '?')

		})

		function editModal(id)
		{
			$.ajax({
				url: API_URL + '/kepegawaian/jenis-jabatan/get/'+ id,
				type: 'GET',
				dataType: 'json',
				beforeSend:function() {
					$('#loading').removeClass('d-none');
					$('#edit-content').addClass('d-none');
				},
				success: function(data) {
	
					var id			= data.id;
					var nama		= data.nama;
					
					$('#jabatanid').val(data.id);
					$('#nama').val(nama);

					$('#loading').addClass('d-none');
					$('#edit-content').removeClass('d-none');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(XMLHttpRequest, textStatus, errorThrown);
				},
			});

			$('#modal-edit-jenisjabatan').modal('show');
		}
</script>