<script type="text/javascript">
	$(".editPostBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$.ajax({
			url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/alat-bantu/surveilans/get-post/'+ id,
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
				$('#editPostModal #id').val(data.id)
				$('#editPostModal #hari_ke').val(data.val.hari_ke)
				if(data.val.rawat_luka == 1) $('#editPostModal #rawat_luka').prop('checked', true); 
				else $('#editPostModal #rawat_luka').prop('checked', false);

				if(data.val.dressing_transparan == 1) $('#editPostModal #dressing_transparan').prop('checked', true);
				else $('#editPostModal #dressing_transparan').prop('checked', false);

				if(data.val.dressing_hypavix == 1) $('#editPostModal #dressing_hypavix').prop('checked', true);
				else $('#editPostModal #dressing_hypavix').prop('checked', false);
				
				if(data.val.buang_cairan == 1) $('#editPostModal #buang_cairan').prop('checked', true);
				else $('#editPostModal #buang_cairan').prop('checked', false);

				$('#editPostModal #aff_drain').val(data.val.aff_drain)
				
				if(data.val.angkat_jahitan == 1) $('#editPostModal #angkat_jahitan').prop('checked', true);
				else $('#editPostModal #angkat_jahitan').prop('checked', false);
				
				if(data.val.antibiotik_post == 1) $('#editPostModal #antibiotik_post').prop('checked', true);
				else $('#editPostModal #antibiotik_post').prop('checked', false);
				
				if(data.val.krs == 1) $('#editPostModal #krs').prop('checked', true);
				else $('#editPostModal #krs').prop('checked', false);
				
				if(data.val.kontrol_poli == 1) $('#editPostModal #kontrol_poli').prop('checked', true);
				else $('#editPostModal #kontrol_poli').prop('checked', false);
				
				if(data.val.infeksi == 1) $('#editPostModal #infeksi').prop('checked', true);
				else $('#editPostModal #infeksi').prop('checked', false);
				
				if(data.val.infeksi == 1) $('#editPostModal .infeksi-content').show();

				$('#editPostModal #jenis_lokasi_infeksi').val(data.val.jenis_lokasi_infeksi)
				$('#editPostModal #lokasi_spesifik_infeksi').val(data.val.lokasi_spesifik_infeksi)
				$('#editPostModal #lokasi_spesifik_infeksi_lain2').val(data.val.lokasi_spesifik_infeksi_lain2)

				$('#editPostModal .content-kriteria-superfisial').hide()
				$('#editPostModal .content-kriteria-dalam').hide()
				$('#editPostModal .content-kriteria-organ').hide()

				if(data.val.jenis_lokasi_infeksi == "Superfisial") $('#editPostModal .content-kriteria-superfisial').show()
				if(data.val.jenis_lokasi_infeksi == "Dalam") $('#editPostModal .content-kriteria-dalam').show()
				if(data.val.jenis_lokasi_infeksi == "Organ") $('#editPostModal .content-kriteria-organ').show()


				if(data.val.nanah == 1) $('#editPostModal .content-kriteria-superfisial #nanah').prop('checked', true);
				else $('#editPostModal .content-kriteria-superfisial #nanah').prop('checked', false);

				if(data.val.bengkak == 1) $('#editPostModal .content-kriteria-superfisial #bengkak').prop('checked', true);
				else $('#editPostModal .content-kriteria-superfisial #bengkak').prop('checked', false);

				if(data.val.merah == 1) $('#editPostModal .content-kriteria-superfisial #merah').prop('checked', true);
				else $('#editPostModal .content-kriteria-superfisial #merah').prop('checked', false);

				if(data.val.nyeri == 1) $('#editPostModal .content-kriteria-superfisial #nyeri').prop('checked', true);
				else $('#editPostModal .content-kriteria-superfisial #nyeri').prop('checked', false);

				if(data.val.demam == 1) $('#editPostModal .content-kriteria-superfisial #demam').prop('checked', true);
				else $('#editPostModal .content-kriteria-superfisial #demam').prop('checked', false);
				


				if(data.val.drainase_purulen == 1) $('#editPostModal .content-kriteria-organ #drainase_purulen').prop('checked', true);
				else $('#editPostModal .content-kriteria-organ #drainase_purulen').prop('checked', false);

				if(data.val.kuman == 1) $('#editPostModal .content-kriteria-organ #kuman').prop('checked', true);
				else $('#editPostModal .content-kriteria-organ #kuman').prop('checked', false);

				if(data.val.pemeriksaan_penunjang == 1) $('#editPostModal .content-kriteria-organ #pemeriksaan_penunjang').prop('checked', true);
				else $('#editPostModal .content-kriteria-organ #pemeriksaan_penunjang').prop('checked', false);



				if(data.val.drainase_purulen == 1) $('#editPostModal .content-kriteria-dalam #drainase_purulen').prop('checked', true);
				else $('#editPostModal .content-kriteria-dalam #drainase_purulen').prop('checked', false);

				if(data.val.kuman == 1) $('#editPostModal .content-kriteria-dalam #kuman').prop('checked', true);
				else $('#editPostModal .content-kriteria-dalam #kuman').prop('checked', false);

				if(data.val.bengkak == 1) $('#editPostModal .content-kriteria-dalam #bengkak').prop('checked', true);
				else $('#editPostModal .content-kriteria-dalam #bengkak').prop('checked', false);

				if(data.val.merah == 1) $('#editPostModal .content-kriteria-dalam #merah').prop('checked', true);
				else $('#editPostModal .content-kriteria-dalam #merah').prop('checked', false);

				if(data.val.nyeri == 1) $('#editPostModal .content-kriteria-dalam #nyeri').prop('checked', true);
				else $('#editPostModal #nyeri').prop('checked', false);

				if(data.val.demam == 1) $('#editPostModal .content-kriteria-dalam #demam').prop('checked', true);
				else $('#editPostModal .content-kriteria-dalam #demam').prop('checked', false);


				if(data.val.dx_dokter == 1) $('#editPostModal #dx_dokter').prop('checked', true);
				else $('#editPostModal #dx_dokter').prop('checked', false);

				$('#editPostModal').modal('show')
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