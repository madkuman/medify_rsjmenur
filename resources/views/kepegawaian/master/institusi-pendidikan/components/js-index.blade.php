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
			$("#del-btn-institusi").attr('href','{{url('kepegawaian/master/institusi-pendidikan/delete')}}' + '/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Institusi Pendidikan ' + nama + '?')

		})

		function editModal(id)
		{
			$.ajax({
				url: API_URL + '/kepegawaian/institusi-pendidikan/get/'+ id,
				type: 'GET',
				dataType: 'json',
				beforeSend:function() {
					$('#loading').removeClass('d-none');
					$('#edit-content').addClass('d-none');
				},
				success: function(data) {
	
					var id			= data.id;
					var nama		= data.nama;
					
					$('#form-edit #institusiid').val(id);
					$('#form-edit #namaedit').val(nama);

					$('#loading').addClass('d-none');
					$('#edit-content').removeClass('d-none');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(XMLHttpRequest, textStatus, errorThrown);
				},
			});

			$('#modal-edit-institusipendidikan').modal('show');
		}

		$(document).on("click",".btn-submit-create", function () {
			if ($("#createnama").val() == ""){

			} else {
			$('#buttonSubmitCreate').hide();
			$('#buttonLoadingCreate').show();
			}
		})

		$(document).on("click",".btn-submit-edit", function () {
			$('#buttonSubmitEdit').hide();
			$('#buttonLoadingEdit').show();
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