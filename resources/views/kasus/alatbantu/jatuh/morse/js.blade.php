<script type="text/javascript">
	var morse_id = 0;
	$(document).ready(function(){
		$(".deleteMorseBtn").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#deleteInputIdMorse').val(id);
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
					$('#formDeleteMorse').submit();
				}
			});
		});
	});
	$(".tatalaksana-morse-btn").click(function(e){
		morse_id = $(this).data('id');
		var tatalaksana = $(this).data('tatalaksana');
		var score = $(this).data('score');
		if(tatalaksana != ""){
			$(".terlaksana-morse").each(function(index){
				$(this).prop('checked', tatalaksana[index]);
				if(tatalaksana[index])
					$(this).prop('disabled', true);
			});
		}else{
			$(".terlaksana-morse").each(function(index){
				$(this).prop('checked', 0);
			});
		}

		$('.rendah').hide();
		$('.sedang').hide();
		$('.tinggi').hide();
		if(score < 24){
			$('.rendah').show();
		}
		else if(score > 45){
			$('.tinggi').show();
		}
		else{
			$('.sedang').show();
		}
		$('#tatalaksana-modal-morse').modal('toggle');
	});
	$('#submit-morse').click(function(e){
		$(this).prepend('<i class="fa fa-spinner fa-spin"></i>');
		$(this).attr("disabled", true);
        
        var formData = new FormData();
        var tatalaksana = [];
        $('.terlaksana-morse').each(function(){
        	tatalaksana.push($(this).is(":checked") ? 1 : 0);
        });
        formData.append('assesment_type', 'morse');
        formData.append('id', morse_id);
        formData.append('tatalaksana', tatalaksana.toString());
		$.ajax({
            type: "POST",
            url: "{{url()->current()}}/tatalaksana",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
				$('#submit-morse').find("i").remove();
				$('#submit-morse').attr("disabled", false);
                $("#tatalaksana-btn-morse-"+morse_id).data('tatalaksana',tatalaksana);
                $("#tatalaksana-btn-morse-"+morse_id).html('<i class="fa fa-search-plus"></i> Lihat Tatalaksana');
                $('#tatalaksana-modal-morse').modal('toggle');
                callSwal('success', 'Tatalaksana Risiko Jatuh Pasien Berhasil Disimpan', '', '');
            },
            error: function (error) {
				$('#submit-morse').find("i").remove();
				$('#submit-morse').attr("disabled", false);
                callSwal('error', 'Tatalaksana Risiko Jatuh Pasien Gagal Disimpan', '', '');
            }
        });
	});
</script>