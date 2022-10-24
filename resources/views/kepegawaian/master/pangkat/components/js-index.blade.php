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
			
			$("#del-btn-pangkat").attr('href','{{url('kepegawaian/master/pangkat/delete')}}' + '/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data pangkat ' + nama + '?')

		})


		function editModal(id)
		{
			$.ajax({
				url: API_URL + '/kepegawaian/pangkat/get/'+ id,
				type: 'GET',
				dataType: 'json',
				beforeSend:function() {
					$('#loading').removeClass('d-none');
					$('#edit-content').addClass('d-none');
				},
				success: function(data) {
					var nama 				= data.nama;
					var nama_pendek_satu 	= data.nama_pendek_1;
					var nama_pendek_dua 	= data.nama_pendek_2;
					var usia_pensiun 		= data.usia_pensiun;
					var strata 				= data.strata;
					var strata_order		= data.strata_order;
					var kenkatba			= data.kenkatba;
					
					$('#form-add #pangkat-edit').val(data.id);
					$('#form-add #nama-pangkat').val(nama);
					$('#form-add #nama-pendek-1').val(nama_pendek_satu);
					$('#form-add #nama-pendek-2').val(nama_pendek_dua);
					$('#form-add #usia-pensiun').val(usia_pensiun);
					$('#form-add #strata').val(strata);
					$('#form-add #strata-order').val(strata_order);
					$('#form-add #kenkatba').val(kenkatba);

					$('#loading').addClass('d-none');
					$('#edit-content').removeClass('d-none');
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(XMLHttpRequest, textStatus, errorThrown);
				},
			});

			$('#modal-edit-pangkat').modal('show');
		}

		$(document).on("click",".btn-submit-create", function () {
			if($("#createnama").val() == "" || $("#namapendeksatu").val() == "" || $("#namapendekdua").val() == ""){

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