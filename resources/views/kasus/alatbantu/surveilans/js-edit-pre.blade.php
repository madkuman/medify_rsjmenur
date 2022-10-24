<script type="text/javascript">
	$(".editPreBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$.ajax({
			url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/alat-bantu/surveilans/get-pre/'+ id,
			type: 'GET',
			dataType: 'json',
			tryCount : 0,
			retryLimit : 3,
			beforeSend: function(){
				$('#main-page-loading').fadeIn()
			},
			complete: function(){
				$('#main-page-loading').fadeOut()
			},
			success: function(data) {
				console.log(data)
				$('#editPreModal #id').val(data.id)

				$('#editPreModal #suhu').val(data.val.suhu)
				$('#editPreModal #merokok').val(data.val.merokok)
				$('#editPreModal #mrsa').val(data.val.mrsa)
				$('#editPreModal #albumin').val(data.val.albumin)
				$('#editPreModal #gula_darah').val(data.val.gula_darah)


				if(data.val.dm == 1) $('#editPreModal #dm').prop('checked', true); 
				else $('#editPreModal #dm').prop('checked', false);

				if(data.val.ggk == 1) $('#editPreModal #ggk').prop('checked', true);
				else $('#editPreModal #ggk').prop('checked', false);

				if(data.val.sepsis == 1) $('#editPreModal #sepsis').prop('checked', true);
				else $('#editPreModal #sepsis').prop('checked', false);
				
				if(data.val.hipertensi == 1) $('#editPreModal #hipertensi').prop('checked', true);
				else $('#editPreModal #hipertensi').prop('checked', false);

				if(data.val.na == 1) $('#editPreModal #na').prop('checked', true);
				else $('#editPreModal #na').prop('checked', false);

				$('#editPreModal #penyakit_lain2').val(data.val.penyakit_lain2)
				$('#editPreModal #pencukuran').val(data.val.pencukuran)
				$('#editPreModal #waktu_cukur').val(data.val.waktu_cukur)
				$('#editPreModal #bowel').val(data.val.bowel)
				$('#editPreModal #steroid').val(data.val.steroid)
				$('#editPreModal #radioterapi').val(data.val.radioterapi)
				$('#editPreModal #mandi').val(data.val.mandi)
				
				if(data.val.kulit == 1) $('#editPreModal #kulit').prop('checked', true);
				else $('#editPreModal #kulit').prop('checked', false);
				
				if(data.val.mulut == 1) $('#editPreModal #mulut').prop('checked', true);
				else $('#editPreModal #mulut').prop('checked', false);
				
				if(data.val.mata == 1) $('#editPreModal #mata').prop('checked', true);
				else $('#editPreModal #mata').prop('checked', false);
				
				if(data.val.tht == 1) $('#editPreModal #tht').prop('checked', true);
				else $('#editPreModal #tht').prop('checked', false);
				
				if(data.val.paru == 1) $('#editPreModal #paru').prop('checked', true);
				else $('#editPreModal #paru').prop('checked', false);
				
				if(data.val.gi_tract == 1) $('#editPreModal #gi_tract').prop('checked', true);
				else $('#editPreModal #gi_tract').prop('checked', false);
				
				$('#editPreModal #infeksi_lain2').val(data.val.infeksi_lain2)

				$('#editPreModal').modal('show')
			},
			error:function(data){
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {

					$.ajax(this);
					return;
				}else{
					$.notify({
						title: '<strong>Sorry</strong>',
						message: 'Terjadi kesalahan server'
					},{
						type: 'danger',
						placement: {
							from: "top",
							align: "center"
						},
						delay: 3000
					});
					$('#cppt_button_verifikasi_loading_'+index).hide()
					$('#cppt_button_verifikasi_check'+index).show()
				}  
			}
		});

	});

</script>