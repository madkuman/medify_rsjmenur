$(document).ready(function() {
	$('select[name="select_diet"]').on('change', function() {
		var id_diet = $(this).val();
		console.log($(this).val());
		
		if (id_diet) {

			// id_diet == biasa
			if (id_diet == "1") { 
				$.ajax({
					// url: "{{ url('/nutriton/order/ajax_biasa/') }}"+id_diet,
					url: "{{ url('ajax_biasa/') }}"+id_diet,
					type: "GET",
					dataType: "json",
					success:function(data) {
						$.each(data, function(ad, value) {
							$('select[name="biasa_energy_sources"]').append('<option value="'+ value["id_detail_selection"] +'">'+ value["diet_selection_id"] +'</option>');
						});
					}
				});
			}
		}
	});
});


 
// $(document).ready(function() {
// 	$('#dietbiasa').hide();
// 	$('#diet_alergi').hide();
// 	$('#diet_lauk_cincang').hide();
// 	$('#diet_input_alergi_1').hide();

// 	$('#dietentreal').hide();
// 	$('#dietentreal_2').hide();
// 	$('#input_dietentreal').hide();

// 	$('#diet_tinggi_energi_tinggi_protein').hide();
// 	$('#dtetp_sumber_energi').hide();
// 	$('#dtetp_checkbox').hide();
// 	$('#dtetp_input_alergi').hide();

// 	$('#diet_rendah_energi').hide();
// 	$('#dre_sumber_energi').hide();
// 	$('#dre_checkbox').hide();
// 	$('#dre_input_alergi').hide();	

// 	$('#diet_rendah_garam').hide();
// 	$('#drg_lauk_cincang').hide();
// 	$('#drg_input_lauk_cincang').hide();
// 	$('#drg_alergi').hide();
// 	$('#drg_input_alergi_1').hide();

// 	$('#diet_rendah_sisa').hide();
// 	$('#drs_lauk_cincang').hide();
// 	$('#drs_alergi').hide();
// 	$('#drs_rendah_garam').hide();

// 	$('#diet_pra_bedah').hide();
// 	$('#dpb_lauk_cincang').hide();
// 	$('#dpb_alergi').hide();
// 	$('#dpb_rendah_garam').hide();
// 	$('#dpb_cair').hide();

// 	$('#select_diet').change(function() {
// 		if ($('#select_diet').val() == "biasa") {

// 			// $('#dietbiasa').hide();
// 			$('#diet_alergi').hide();
// 			$('#diet_lauk_cincang').hide();
// 			$('#diet_input_alergi_1').hide();

// 			$('#dietentreal').hide();
// 			$('#dietentreal_2').hide();
// 			$('#input_dietentreal').hide();

// 			$('#diet_tinggi_energi_tinggi_protein').hide();
// 			$('#dtetp_sumber_energi').hide();
// 			$('#dtetp_checkbox').hide();
// 			$('#dtetp_input_alergi').hide();

// 			$('#diet_rendah_energi').hide();
// 			$('#dre_sumber_energi').hide();
// 			$('#dre_checkbox').hide();
// 			$('#dre_input_alergi').hide();	

// 			$('#diet_rendah_sisa').hide();
// 			$('#drs_lauk_cincang').hide();
// 			$('#drs_alergi').hide();
// 			$('#drs_rendah_garam').hide();

// 			$('#diet_pra_bedah').hide();
// 			$('#dpb_lauk_cincang').hide();
// 			$('#dpb_alergi').hide();
// 			$('#dpb_rendah_garam').hide();
// 			$('#dpb_cair').hide();

// 			$('#dietbiasa').show();

// 			$('#diet_sumber_energi').change(function() {
// 				if ($('#diet_sumber_energi').val() == "nasi" || $('#diet_sumber_energi').val() == "tim" || $('#diet_sumber_energi').val() == "bubur_tepung" ) {
// 					$('#diet_lauk_cincang').hide();
// 					$('#diet_alergi').show();
// 					$('#diet_input_alergi_1').hide();

// 					$('#checkbox_diet_alergi').change(function() {
// 						if ($('#checkbox_diet_alergi').is(":checked")) {
// 							$('#diet_input_alergi_1').show();
// 						}
// 						else {
// 							$('#diet_input_alergi_1').hide();
// 						}
// 					});	
// 				}

// 				else if ($('#diet_sumber_energi').val() == "lunak") {
// 					$('#diet_lauk_cincang').show();
// 					$('#diet_alergi').show();
// 					$('#diet_input_alergi_1').hide();
// 					$('#diet_input_lauk_cincang').hide();

// 					$('#checkbox_diet_lauk_cincang').change(function() {
// 						if ($('#checkbox_diet_lauk_cincang').is(":checked")) {
// 							$('#diet_input_lauk_cincang').show();
// 						}
// 						else {
// 							$('#diet_input_lauk_cincang').hide();
// 						}
// 					});					

// 					$('#checkbox_diet_alergi').change(function() {
// 						if ($('#checkbox_diet_alergi').is(":checked")) {
// 							$('#diet_input_alergi_1').show();
// 						}
// 						else {
// 							$('#diet_input_alergi_1').hide();
// 						}
// 					});					
// 				}
// 			});
// 		}

// 		else if ($('#select_diet').val() == "entreal") {

// 			$('#dietbiasa').hide();
// 			$('#diet_alergi').hide();
// 			$('#diet_lauk_cincang').hide();
// 			$('#diet_input_alergi_1').hide();

// 			// $('#dietentreal').hide();
// 			// $('#dietentreal_2').hide();
// 			$('#input_dietentreal').hide();

// 			$('#diet_tinggi_energi_tinggi_protein').hide();
// 			$('#dtetp_sumber_energi').hide();
// 			$('#dtetp_checkbox').hide();
// 			$('#dtetp_input_alergi').hide();

// 			$('#diet_rendah_energi').hide();
// 			$('#dre_sumber_energi').hide();
// 			$('#dre_checkbox').hide();
// 			$('#dre_input_alergi').hide();	

// 			$('#diet_rendah_sisa').hide();
// 			$('#drs_lauk_cincang').hide();
// 			$('#drs_alergi').hide();
// 			$('#drs_rendah_garam').hide();

// 			$('#diet_pra_bedah').hide();
// 			$('#dpb_lauk_cincang').hide();
// 			$('#dpb_alergi').hide();
// 			$('#dpb_rendah_garam').hide();
// 			$('#dpb_cair').hide();

// 			// $('#dietbiasa').hide();
// 			$('#dietentreal').show();
// 			$('#dietentreal_2').show();

// 			$('#dietentreal_3').change(function() {
// 				if ($('#dietentreal_3').val() == "kering" || $('#dietentreal_3').val() == "kental" || $('#dietentreal_3').val() == "vluibar" || $('#dietentreal_3').val() == "tanpa_susu" || $('#dietentreal_3').val() == "alergi" || $('#dietentreal_3').val() == "tetp" ) {
// 					$('#input_dietentreal').show();					
// 				}
// 			});
// 		}

// 		else if ($('#select_diet').val() == "tinggi_energi_tinggi_protein") {
			
// 			$('#dietbiasa').hide();
// 			$('#diet_alergi').hide();
// 			$('#diet_lauk_cincang').hide();
// 			$('#diet_input_alergi_1').hide();

// 			$('#dietentreal').hide();
// 			$('#dietentreal_2').hide();
// 			$('#input_dietentreal').hide();

// 			$('#diet_rendah_energi').hide();
// 			$('#dre_sumber_energi').hide();
// 			$('#dre_checkbox').hide();
// 			$('#dre_input_alergi').hide();

// 			// $('#diet_tinggi_energi_tinggi_protein').hide();
// 			$('#dtetp_sumber_energi').hide();
// 			$('#dtetp_checkbox').hide();
// 			$('#dtetp_input_alergi').hide();
// 			$('#dtetp_checkbox_alergi').hide();

// 			$('#diet_rendah_sisa').hide();
// 			$('#drs_lauk_cincang').hide();
// 			$('#drs_alergi').hide();
// 			$('#drs_rendah_garam').hide();

// 			$('#diet_pra_bedah').hide();
// 			$('#dpb_lauk_cincang').hide();
// 			$('#dpb_alergi').hide();
// 			$('#dpb_rendah_garam').hide();
// 			$('#dpb_cair').hide();

// 			$('#diet_tinggi_energi_tinggi_protein').show();

// 			$('#select_dtetp').change(function() {
// 				console.log("a");
// 				if ($('#select_dtetp').val() == "2900" || $('#select_dtetp').val() == "3200") {
// 					console.log("b");
					
// 					$('#dtetp_checkbox').show();

// 					$('#dtetp_checkbox_alergi').change(function() {
// 						if ($('#dtetp_checkbox_alergi').is(":checked")) {
// 							console.log("c");
// 							$('#dtetp_input_alergi').show();
// 						}
// 						else {
// 							console.log("d");
// 							$('#dtetp_input_alergi').hide();
// 						}
// 					});
// 				}
// 			});
// 		}

// 		else if ($('#select_diet').val() == "rendah_energi") {
// 			console.log("bosku");
// 			$('#diet_rendah_energi').show();
// 			$('#dre_sumber_energi').hide();
// 			$('#dre_checkbox').hide();
// 			$('#dre_input_alergi').hide();

// 			$('#dietbiasa').hide();
// 			$('#diet_alergi').hide();
// 			$('#diet_lauk_cincang').hide();
// 			$('#diet_input_alergi_1').hide();

// 			$('#dietentreal').hide();
// 			$('#dietentreal_2').hide();
// 			$('#input_dietentreal').hide();

// 			$('#diet_tinggi_energi_tinggi_protein').hide();
// 			$('#dtetp_sumber_energi').hide();
// 			$('#dtetp_checkbox').hide();
// 			$('#dtetp_input_alergi').hide();

// 			$('#diet_rendah_sisa').hide();
// 			$('#drs_lauk_cincang').hide();
// 			$('#drs_alergi').hide();
// 			$('#drs_rendah_garam').hide();

// 			$('#diet_pra_bedah').hide();
// 			$('#dpb_lauk_cincang').hide();
// 			$('#dpb_alergi').hide();
// 			$('#dpb_rendah_garam').hide();
// 			$('#dpb_cair').hide();

// 			$('#select_dre').change(function() {
// 				if ($('#select_dre').val() == "1300" || $('#select_dtetp').val() == "1500") {
// 					$('#dre_checkbox').show();

// 					$('#dre_checkbox_alergi').change(function() {
// 						if ($('#dre_checkbox_alergi').is(":checked")) {
// 							console.log("kuy");
// 							$('#dre_input_alergi').show();
// 						}
// 						else {
// 							$('#dre_input_alergi').hide();
// 						}
// 					});
// 				}
// 			});	
// 		}

// 		else if ($('#select_diet').val() == "rendah_garam") {

// 			$('#dietbiasa').hide();
// 			$('#diet_alergi').hide();
// 			$('#diet_lauk_cincang').hide();
// 			$('#diet_input_alergi_1').hide();

// 			$('#dietentreal').hide();
// 			$('#dietentreal_2').hide();
// 			$('#input_dietentreal').hide();

// 			$('#diet_tinggi_energi_tinggi_protein').hide();
// 			$('#dtetp_sumber_energi').hide();
// 			$('#dtetp_checkbox').hide();
// 			$('#dtetp_input_alergi').hide();

// 			$('#diet_rendah_energi').hide();
// 			$('#dre_sumber_energi').hide();
// 			$('#dre_checkbox').hide();
// 			$('#dre_input_alergi').hide();	

// 			$('#diet_rendah_garam').show();
// 			$('#drg_lauk_cincang').hide();
// 			$('#drg_input_lauk_cincang').hide();
// 			$('#drg_alergi').hide();
// 			$('#drg_input_alergi_1').hide();

// 			$('#diet_rendah_sisa').hide();
// 			$('#drs_lauk_cincang').hide();
// 			$('#drs_alergi').hide();
// 			$('#drs_rendah_garam').hide();

// 			$('#diet_pra_bedah').hide();
// 			$('#dpb_lauk_cincang').hide();
// 			$('#dpb_alergi').hide();
// 			$('#dpb_rendah_garam').hide();
// 			$('#dpb_cair').hide();

// 			$('#drg_select').change(function() {
// 				if ($('#drg_select').val() == "nasi" || $('#drg_select').val() == "tim" || $('#drg_select').val() == "bubur_tepung" ) {
// 					$('#drg_lauk_cincang').hide();
// 					$('#drg_alergi').show();
// 					$('#drg_input_alergi_1').hide();

// 					$('#checkbox_drg_alergi').change(function() {
// 						if ($('#checkbox_drg_alergi').is(":checked")) {
// 							$('#drg_input_alergi_1').show();
// 						}
// 						else {
// 							$('#drg_input_alergi_1').hide();
// 						}
// 					});	
// 				}

// 				else if ($('#drg_select').val() == "lunak") {
// 					$('#drg_lauk_cincang').show();
// 					$('#drg_alergi').show();
// 					$('#drg_input_alergi_1').hide();
// 					$('#drg_input_lauk_cincang').hide();

// 					$('#checkbox_drg_lauk_cincang').change(function() {
// 						if ($('#checkbox_drg_lauk_cincang').is(":checked")) {
// 							$('#drg_input_lauk_cincang').show();
// 						}
// 						else {
// 							$('#drg_input_lauk_cincang').hide();
// 						}
// 					});					

// 					$('#checkbox_drg_alergi').change(function() {
// 						if ($('#checkbox_drg_alergi').is(":checked")) {
// 							$('#drg_input_alergi_1').show();
// 						}
// 						else {
// 							$('#drg_input_alergi_1').hide();
// 						}
// 					});					
// 				}
// 			});
// 		}

// 		else if($('#select_diet').val() == "rendah_sisa"){
// 			$('#dietbiasa').hide();
// 			$('#diet_alergi').hide();
// 			$('#diet_lauk_cincang').hide();

// 			$('#dietentreal').hide();
// 			$('#dietentreal_2').hide();

// 			$('#diet_tinggi_energi_tinggi_protein').hide();
// 			$('#dtetp_sumber_energi').hide();
// 			$('#dtetp_checkbox').hide();

// 			$('#diet_rendah_energi').hide();
// 			$('#dre_sumber_energi').hide();
// 			$('#dre_checkbox').hide();

// 			$('#diet_rendah_garam').hide();
// 			$('#drg_lauk_cincang').hide();
// 			$('#drg_alergi').hide();
			
// 			$('#drs_lauk_cincang').hide();
// 			$('#drs_alergi').hide();
// 			$('#drs_rendah_garam').hide();

// 			$('#diet_pra_bedah').hide();
// 			$('#dpb_lauk_cincang').hide();
// 			$('#dpb_alergi').hide();
// 			$('#dpb_rendah_garam').hide();
// 			$('#dpb_cair').hide();

// 			$('#diet_rendah_sisa').show();

// 			$('#drs_select').change(function() {
// 				if ($('#drs_select').val() == "lunak"){
// 					$('#drs_lauk_cincang').show();
// 					$('#drs_input_lauk_cincang').hide();

// 					$('#checkbox_drs_lauk_cincang').change(function() {
// 						if ($('#checkbox_drs_lauk_cincang').is(":checked")) {
// 							console.log("kuy");
// 							$('#drs_input_lauk_cincang').show();
// 						}
// 						else {
// 							$('#drs_input_lauk_cincang').hide();
// 						}
// 					});
// 				}
// 				$('#drs_rendah_garam').show();
// 				$('#drs_input_rendah_garam').hide();
// 				$('#drs_alergi').show();
// 				$('#drs_input_alergi_1').hide();

// 				$('#checkbox_drs_rendah_garam').change(function() {
// 					if ($('#checkbox_drs_rendah_garam').is(":checked")) {
// 						console.log("kuy");
// 						$('#drs_input_rendah_garam').show();
// 					}
// 					else {
// 						$('#drs_input_rendah_garam').hide();
// 					}
// 				});

// 				$('#checkbox_drs_alergi').change(function() {
// 					if ($('#checkbox_drs_alergi').is(":checked")) {
// 						console.log("kuy");
// 						$('#drs_input_alergi_1').show();
// 					}
// 					else {
// 						$('#drs_input_alergi_1').hide();
// 					}
// 				});				
// 			});
// 		}

// 		else if($('#select_diet').val() == "pra_bedah"){
// 			$('#dietbiasa').hide();
// 			$('#diet_alergi').hide();
// 			$('#diet_lauk_cincang').hide();
// 			$('#diet_input_alergi_1').hide();

// 			$('#dietentreal').hide();
// 			$('#dietentreal_2').hide();
// 			$('#input_dietentreal').hide();

// 			$('#diet_tinggi_energi_tinggi_protein').hide();
// 			$('#dtetp_sumber_energi').hide();
// 			$('#dtetp_checkbox').hide();
// 			$('#dtetp_input_alergi').hide();

// 			$('#diet_rendah_energi').hide();
// 			$('#dre_sumber_energi').hide();
// 			$('#dre_checkbox').hide();
// 			$('#dre_input_alergi').hide();	

// 			$('#diet_rendah_garam').hide();
// 			$('#drg_lauk_cincang').hide();
// 			$('#drg_input_lauk_cincang').hide();
// 			$('#drg_alergi').hide();
// 			$('#drg_input_alergi_1').hide();

// 			$('#diet_rendah_sisa').hide();
// 			$('#drs_lauk_cincang').hide();
// 			$('#drs_alergi').hide();
// 			$('#drs_rendah_garam').hide();

// 			$('#dpb_lauk_cincang').hide();
// 			$('#dpb_alergi').hide();
// 			$('#dpb_rendah_garam').hide();
// 			$('#dpb_cair').hide();

// 			$('#diet_pra_bedah').show();

// 			$('#dpb_select').change(function(){
// 				//fungsi pra bedah per select belum
// 				if ($('#dpb_select').val() == "" || $('#drg_select').val() == "tim" || $('#drg_select').val() == "bubur_tepung" ) {
// 				}
// 			});
// 		}
// 	});
// });