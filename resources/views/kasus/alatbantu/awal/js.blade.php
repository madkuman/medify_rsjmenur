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

	$('#pekerjaan').on('change', function() {
		if ($('#pekerjaan').val() == 0) {
			$('#pekerjaan_lain2').show();
		}
		else{
			$('#pekerjaan_lain2').hide();
		}
	});

	$('#agama').on('change', function() {
		if ($('#agama').val() == 0) {
			$('#agama_lain2').show();
		}
		else{
			$('#agama_lain2').hide();
		}
	});

	$('#pendidikan').on('change', function() {
		if ($('#pendidikan').val() == 0) {
			$('#pendidikan_lain2').show();
		}
		else{
			$('#pendidikan_lain2').hide();
		}
	});

	$('#bahasa').on('change', function() {
		if ($('#bahasa').val() == 0) {
			$('#bahasa_lain2').show();
			$('#bahasa_penerjemah').show();
		}
		else{
			$('#bahasa_lain2').hide();
			$('#bahasa_penerjemah').hide();
		}
	});

	$('#provokatif').on('change', function() {
		if ($('#provokatif').val() == 0) {
			$('#provokatif_lain2').show();
		}
		else{
			$('#provokatif_lain2').hide();
		}
	});

	$('#quality').on('change', function() {
		if ($('#quality').val() == 0) {
			$('#quality_lain2').show();
		}
		else{
			$('#quality_lain2').hide();
		}
	});

	$('#status_psikologis').on('change', function() {
		if ($('#status_psikologis').val() == 0) {
			$('#status_psikologis_lain2').show();
		}
		else{
			$('#status_psikologis_lain2').hide();
		}
	});

</script>