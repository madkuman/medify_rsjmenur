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
			$('#form-gelar').trigger('reset');
			$('#form-gelarid').val(0);
			$('.js-select2').val('').trigger('change');
			$('#modal-option').text('Tambah');
			$('#modal-gelar').modal('show');
		})

		$(document).on("click",".btn-edit", function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var strata = $(this).parents('tr').find('.strata-pendidikan').text();
			
			$('#form-gelar').trigger('reset');
			$('#form-gelarid').val(id);
			$('#form-nama').val(nama);
			$('#form-strata-pendidikan').val(strata).trigger('change');

			$('#modal-option').text('Edit');
			$('#modal-gelar').modal('show');
		})

		$(document).on("click",".btn-delete", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');
			$("#del-btn").attr('href','{{url()->current()}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus Gelar ' + nama + '?')
			$('#deletemodal').modal('show');
		})

		function editModal(id)
		{
			$.ajax({
				url: API_URL + '/kepegawaian/gelar-pendidikan/get/'+ id,
				type: 'GET',
				dataType: 'json',
				beforeSend:function() {
					$('#loading').removeClass('d-none');
					$('#edit-content').addClass('d-none');
				},
				success: function(data) {
	
					var id			= data.id;
					var nama		= data.nama;
					var strata = data.pendidikan_strata_id;
					
					$('#gelarid').val(id);
					$('#nama').val(nama);
					$('#jenis_jabatan').val(strata);

					$('#loading').addClass('d-none');
					$('#edit-content').removeClass('d-none');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(XMLHttpRequest, textStatus, errorThrown);
				},
			});

			$('#modal-edit-gelar').modal('show');
		}
</script>