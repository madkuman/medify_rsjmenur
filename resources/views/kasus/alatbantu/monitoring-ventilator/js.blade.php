<script type="text/javascript">
	$(".deleteBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$('#deleteInputId').val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: 'warning',
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$('#formDelete').submit();
			}
		});
	});


	$('.btn-modal-surveilans').click(function(){
		var parent_id = $(this).data('parent-id')
		$('#addModal .input-parent-id').val(parent_id)
	})



	$('.btn-modal-master').click(function(){
		var val = $(this).data('val')
		var id = $(this).data('id')

		$('#editModalMaster input[name="tanggal_pasang"]').val("")
		$('#editModalMaster input[name="tanggal_lepas"]').val("")
		$('#editModalMaster input[name="id"]').val("")
		$('#editModalMaster input[name="jenis_ventilator"]').prop('checked',false)

		if(val != ''){
			$('#editModalMaster input[name="tanggal_pasang"]').val(val.tanggal_pasang)
			$('#editModalMaster input[name="tanggal_lepas"]').val(val.tanggal_lepas)
			$('#editModalMaster input[name="id"]').val(id)
			$('#editModalMaster input[name="jenis_ventilator"][value="'+val.jenis_ventilator+'"]').prop('checked',true)
		}
		$('#editModalMaster').modal('show')
	})

</script>