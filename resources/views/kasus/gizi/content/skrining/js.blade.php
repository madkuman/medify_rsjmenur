<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteBtnAsesmenAwal").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#inputAsesmenAwalDeleteID').val(id);
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
					$('#formAsesmenAwalDelete').submit();
				}
			});
		});
	});
</script>