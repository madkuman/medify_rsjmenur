<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>


<script type="text/javascript">

		datepicker();

		function datepicker() {
			$('.datepicker').datepicker({
				autoclose: true,
				todayHighlight: true,
				format: 'yyyy-mm-dd',
			});
		}
		
		$('.form-gaji').mask('000.000.000.000.000', {reverse: true});

		// jQuery('.js-dataTable-full').dataTable({
		// 	"ordering": true,
		// 	pageLength: 8,
		// 	lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		// 	autoWidth: false
		// });

		$(document).on("click",".btn-add", function () {
			$('#form-pangkat').trigger('reset');
			$('#form-id').val(0);
			$('.js-select2').val('').trigger('change');
			$('#modal-option').text('Tambah');
			$('#modal-pangkat').modal('show');
		})

		$(document).on("click",".btn-edit", function () {
			var id = $(this).data('id');
			var pangkat = $(this).parents('tr').find('.pangkat').text();
			var tmt = $(this).parents('tr').find('.tmt').text();
			var korps = $(this).parents('tr').find('.korps').text();
			var gaji = $(this).parents('tr').find('.gaji').text();
			var pejabat = $(this).parents('tr').find('.pejabat').text();
            var nosurat = $(this).parents('tr').find('.nosurat').text();
			var tglsurat = $(this).parents('tr').find('.tglsurat').text();

			$('#form-pangkat').trigger('reset');
			$('#form-id').val(id);
			$('#form-namapangkat').val(pangkat).trigger('change');
			$('#form-tmt').val(tmt);
			$('#form-korps').val(korps);
			$('#form-gaji').val(gaji);
			$('#form-pejabat').val(pejabat);
            $('#form-no-surat').val(nosurat);
            $('#form-tgl').val(tglsurat);

			$('#modal-option').text('Edit');
			$('#modal-pangkat').modal('show');
		})

		$(document).on("click",".btn-delete", function () {
			var id = $(this).data('id')
			var nama = $(this).data('nama');
			$("#del-btn").attr('href','{{url('kepegawaian/pegawai/pangkat')}}' + '/delete/' + id)
			$("#show-name").html('Anda yakin ingin menghapus data Pangkat ' + nama + '?')
			$('#deletemodal').modal('show');
		})

        
		$(document).on("click",".btn-submit-delete", function () {
			$('#buttonSubmitDelete').hide();
			$('#buttonLoadingDelete').show();
		})
		$(document).on("click",".btn-close", function () {
			$('#buttonSubmit').show();
			$('#buttonLoading').hide();
			$('#buttonSubmitDelete').show();
            $('#buttonLoadingDelete').hide();
		})

</script>