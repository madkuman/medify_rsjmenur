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
			$('#div_pekerjaan_lain2').show();
		}
		else{
			$('#div_pekerjaan_lain2').hide();
		}
	});

	$('#agama').on('change', function() {
		if ($('#agama').val() == 0) {
			$('#div_agama_lain2').show();
		}
		else{
			$('#div_agama_lain2').hide();
		}
	});

	$('#pendidikan').on('change', function() {
		if ($('#pendidikan').val() == 0) {
			$('#div_pendidikan_lain2').show();
		}
		else{
			$('#div_pendidikan_lain2').hide();
		}
	});

	$('#bahasa').on('change', function() {
		if ($('#bahasa').val() == 0) {
			$('#div_bahasa_lain2').show();
			$('#div_penerjemah').show();
		}
		else{
			$('#div_bahasa_lain2').hide();
			$('#div_penerjemah').hide();
		}
	});

	$('#provokatif').on('change', function() {
		if ($('#provokatif').val() == 0) {
			$('#div_provokatif_lain2').show();
		}
		else{
			$('#div_provokatif_lain2').hide();
		}
	});

	$('#quality').on('change', function() {
		if ($('#quality').val() == 0) {
			$('#div_quality_lain2').show();
		}
		else{
			$('#div_quality_lain2').hide();
		}
	});

	$('#status_psikologis').on('change', function() {
		if ($('#status_psikologis').val() == 0) {
			$('#div_status_psikologis_lain2').show();
		}
		else{
			$('#div_status_psikologis_lain2').hide();
		}
	});

</script>