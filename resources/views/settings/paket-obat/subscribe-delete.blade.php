
<form method="POST" action="{{url()->current()}}/subscribe/delete" id="formDeleteSubscribe">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteSubscribeInputId">
	
</form>


<script type="text/javascript">
	$(document).ready(function(){
		$(".unsubscribeBtn").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#deleteSubscribeInputId').val(id);
			swal({
				title: "Unsubscribe",
				text: "Apakah anda yakin akan mengunsubscribe paket ini?",
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
					$('#formDeleteSubscribe').submit();
				}
			});
		});
	});
</script>