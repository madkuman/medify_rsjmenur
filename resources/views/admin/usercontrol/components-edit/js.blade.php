
<script type="text/javascript">
	$(document).ready(function() {
		@if(!empty($specialty))
		$('#spesialis').attr("disabled",false);
		$('#div-spesialis').show();
		@endif
		@if(isset($user->profesi) && $user->profesi_detail->title == 'Dokter')
		$('#subspesialis').attr("disabled",false);
		$('#div-subspesialis').show();
		$('#div-dokter').show();
		@endif
	});

	$('#profesi').on('change', function(e) {
		var id = $(this).val();
		if (id) {
			$.ajax({
				url: '{{url("getting-started")}}/profesi/spesialisasi/get/'+id,
				type: "GET",
				dataType: "json",
				success: function(data){
					if (data.length != 0)
					{
						$('#spesialis').empty();
						$.each(data, function(key, value){
							$('#spesialis').append('<option value="'+key+'">'+value+'</option>');
						});
						$('#spesialis').attr("disabled",false);
						$('#div-spesialis').show(500);
						if (id == 1) {
							$('#subspesialis').attr("disabled",false);
							$('#div-subspesialis').show(500);
							$('#div-dokter').show(500);
						} else {
							$('#subspesialis').attr("disabled",true);
							$('#div-subspesialis').hide(500);
							$('#div-dokter').hide(500);
						}
					}
					else
					{
						$('#spesialis').attr("disabled",true);
						$('#subspesialis').attr("disabled",true);
						$('#div-spesialis').hide(500);
						$('#div-subspesialis').hide(500);
					}
				},
				error: function () {
					callSwal('error','Gagal','Silahkan Coba Lagi',0);
				}
			});
		}
	});
</script>