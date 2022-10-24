<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteHumptyBtn").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#deleteInputIdHumpty').val(id);
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
					$('#formDeleteHumpty').submit();
				}
			});
		});

		$(".modalTataLaksana").click(function(){
			id = $(this).data("id");
			score = $(this).data("score");
			data = $(this).data("tatalaksana");
			console.log(data);
			if(data != ""){
				$(".terlaksana-humpty").each(function(index){
					$(this).prop('checked', data[index]);
					if(data[index])
						$(this).prop('disabled', true);
				});
			}else{
				$(".terlaksana-humpty").each(function(index){
					$(this).prop('checked', 0);
				});
			}
			if(score < 12){
				$('.item-rendah').show();
			}
			else{
				$('.item-tinggi').show();
			}
			$('#tatalaksana-modal-humpty').modal('toggle');
		});

		$("#submit_tatalaksana_humpty").click(function(){
			$(this).prepend('<i class="fa fa-spinner fa-spin"></i>');
			$(this).attr("disabled", true);

			var formData = new FormData();
			var tatalaksana = [];
			$('.terlaksana-humpty').each(function(){
				tatalaksana.push($(this).is(":checked") ? 1 : 0);
			});
        	formData.append('assesment_type', 'humpty');
			formData.append('id', id);
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
					$('#submit_tatalaksana_humpty').find("i").remove();
					$('#submit_tatalaksana_humpty').attr("disabled", false);
					$("#tatalaksana-btn-humpty-"+id).data('tatalaksana',tatalaksana); 
                	$("#tatalaksana-btn-humpty-"+id).html('<i class="fa fa-search-plus"></i> Lihat Tatalaksana');
					$('#tatalaksana-modal-humpty').modal('toggle');
					callSwal('success', 'Tatalaksana Pencegahan Pasien dengan Risiko Jatuh Berhasil Disimpan', '', '');
				},
				error: function (error) {
					$('#submit_tatalaksana_humpty').find("i").remove();
					$('#submit_tatalaksana_humpty').attr("disabled", false);
					callSwal('error', 'Tatalaksana Pencegahan Pasien dengan Risiko Jatuh Gagal Disimpan', '', '');
				}
			});
		});
	});

</script>