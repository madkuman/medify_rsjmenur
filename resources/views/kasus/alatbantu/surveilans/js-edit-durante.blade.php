<script type="text/javascript">
	$(".editDuranteBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$.ajax({
			url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/alat-bantu/surveilans/get-durante/'+ id,
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
				$('#editDuranteModal #id').val(data.id)

				$('#editDuranteModal #tgl_mrs').val(data.val.tgl_mrs)
				$('#editDuranteModal #tgl_operasi').val(data.val.tgl_operasi)
				$('#editDuranteModal #lama_operasi').val(data.val.lama_operasi)
				$('#editDuranteModal #jenis_operasi').val(data.val.jenis_operasi)
				$('#editDuranteModal #operasi_trauma').val(data.val.operasi_trauma)
				$('#editDuranteModal #ruang').val(data.val.ruang)
				$('#editDuranteModal #bb').val(data.val.bb)
				$('#editDuranteModal #kualifikasi').val(data.val.kualifikasi)
				$('#editDuranteModal #kualifikasi_lain2').val(data.val.kualifikasi_lain2)
				$('#editDuranteModal #prosedur').val(data.val.prosedur)
				$('#editDuranteModal #prosedur_lain2').val(data.val.prosedur_lain2)
				$('#editDuranteModal #diagnosa').val(data.val.diagnosa)
				$('#editDuranteModal #multiprosedur').val(data.val.multiprosedur)
				$('#editDuranteModal #klasifikasi').val(data.val.klasifikasi)
				$('#editDuranteModal #asa_scoring').val(data.val.asa_scoring)
				$('#editDuranteModal #sirkulasi').val(data.val.sirkulasi)
				$('#editDuranteModal #air_count').val(data.val.air_count)
				$('#editDuranteModal #kelembaban').val(data.val.kelembaban)
				$('#editDuranteModal #tekanan').val(data.val.tekanan)
				$('#editDuranteModal #jamur').val(data.val.jamur)
				$('#editDuranteModal #drain').val(data.val.drain)
				$('#editDuranteModal #jenis_drain').val(data.val.jenis_drain)
				$('#editDuranteModal #suhu_ruang').val(data.val.suhu_ruang)
				$('#editDuranteModal #implant').val(data.val.implant)
				$('#editDuranteModal #jenis_implant').val(data.val.jenis_implant)
				$('#editDuranteModal #cssd').val(data.val.cssd)
				$('#editDuranteModal #antibiotik').val(data.val.antibiotik)
				$('#editDuranteModal #obat_antibiotik').val(data.val.obat_antibiotik)
				$('#editDuranteModal #dosis_antibiotik').val(data.val.dosis_antibiotik)
				$('#editDuranteModal #jam_antibiotik').val(data.val.jam_antibiotik)

				if(data.val.chlorhexidine == 1) $('#editDuranteModal #chlorhexidine').prop('checked', true); 
				else $('#editDuranteModal #chlorhexidine').prop('checked', false);

				if(data.val.povidone_iodine == 1) $('#editDuranteModal #povidone_iodine').prop('checked', true);
				else $('#editDuranteModal #povidone_iodine').prop('checked', false);

				if(data.val.alkohol_70 == 1) $('#editDuranteModal #alkohol_70').prop('checked', true);
				else $('#editDuranteModal #alkohol_70').prop('checked', false);

				$('#editDuranteModal #disinfeksi_lain').val(data.val.disinfeksi_lain)
				$('#editDuranteModal #staff').val(data.val.staff)
				$('#editDuranteModal #instrumen').val(data.val.instrumen)
				
				$('#editDuranteModal #profilaksis').val(data.val.profilaksis)
				$('#editDuranteModal #obat_profilaksis').val(data.val.obat_profilaksis)
				$('#editDuranteModal #dosis_profilaksis').val(data.val.dosis_profilaksis)
				$('#editDuranteModal #jam_profilaksis').val(data.val.jam_profilaksis)

				$('#editDuranteModal').modal('show')
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