<script src="{{asset('assets/js/plugins/inputmask/jquery.inputmask.bundle.js')}}"></script>
<script type="text/javascript">
	// INITIAL VARIABLE
	$("#tanggal_lahir").inputmask({"mask": "99-99-9999"});
    var antrian_data = {},
        transaksi_data = [];
	
	var transaksi_id;

    // ELEMENT EVENT LISTENER FUNCTION START
	$('form').on('focus', 'input[type=number]', function(e) {
		$(this).on('wheel', function(e) {
			e.preventDefault();
		});
	});

	$('form').on('focus', 'input[type=number]', function(e) {
		$(this).on('wheel', function(e) {
			e.preventDefault();
		});
	});

	$(document).on('click', '.input-el', function(e){
		active_el = this;
	});

	$(document).on('click', '.btn-numpad', function(e){
		if(active_el == null)	return;
		active_el_id = active_el.getAttribute('id');
		if (active_el_id == 'tanggal_lahir') {
			curr_val = $("#tanggal_lahir").inputmask('unmaskedvalue');
		} else {
			curr_val = active_el.value;
		}
		active_el.value = curr_val+this.value;
	});

	$(document).on('click', '.btn-delete', function(e){
		var curr_val = active_el.value.toString();
		active_el.value = curr_val.slice(0, -1);
	});

	$(document).on('click', '.btn-clear', function(e){
		active_el.value = '';
	});

    $(document).on('click', '.button-next', function () {
		next_element = $(this).data('next');

		if (next_element == 'profil') {
			verifikasiPasien($(this));
		} else if (next_element == 'registrasi') {
			toggleButton($(this));
			toggleButton($(this), 1);
		} else if (next_element == 'konfirmasi') {
			konfirmasiResep($(this));
		}  else {
			printNomorAntrian($(this));
		}
	});

	$(document).on('click', '.button-back', function () {
		back_element = $(this).data('back');
		toggleButton($(this), -1);
		$(`.main-content`).hide();
		$(`#${back_element}`).show();
	});
	// ELEMENT EVENT LISTENER FUNCTION END

    // ACTION PROCESS FUNCTION START
	function verifikasiPasien(button_element) {
		$('#error-message').addClass('d-none')
		transaksi_data = [];        
		$.ajax({
			url: BASE_URL + "farmasi/check-in",
			cache: false,
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: $("#form-masuk").serialize(),
			beforeSend:function() {
				toggleButton(button_element);
			},
			success: function(data) {
				data = jQuery.parseJSON(data);
				if (data.status == 0) {
					swal({
						type: 'error',
						title: "Maaf",
						text: data.msg,
					});
					toggleButton(button_element, -1);
				}
				else {
					var transaksi = data.transaksi;
					var pasien = data.pasien;
					Object.assign(antrian_data, {pasien: pasien});

					lahir = new Date(pasien.date_of_birth).toLocaleDateString('id-ID', {
								day : 'numeric',
								month : 'short',
								year : 'numeric'
							}); 
                    // console.log(data);
					avatars = "{{url('')}}/"+pasien.photo_thumb;
					$('.profil_nama').html(pasien.name)
					$('.profil_usia').html(data.jk+', '+pasien.age)
					$('.profil_avatar').attr("src",avatars)
					$('.profil_rm').html('No Rekam Medis : #'+data.no_rm_format)
					$('.profil_rm_confirm').html('#'+data.no_rm_format)
					
					var transaksi_view = ``,
						$id = 1,
						$numb = 0,						
						$count = 1,
						$iterasi = 0,
						$totalTransaksi = transaksi.length;
						$contentCenter = $totalTransaksi == 1 || $totalTransaksi == 2 ? 'justify-content-center' : '';

                    if (transaksi.length == 0) {
                        transaksi_view += 	
						`<div class="col-12">
							<label class="labl">
								<div class="block block-bordered block-link-shadow text-center">
									<div class="block-content">
										<h5 class="title mb-5 font-25">Tidak Ada Transaksi Resep</h5>
									</div>
								</div>
							</label>
						</div>`;
                    }

					$.each(transaksi, function( index, value ) {
						transaksi_data[value.id] = value;
						$iterasi++;
						if($numb == 0) { 
							transaksi_view += `<div class="row row-deck setup-content `+$contentCenter+` justify-content-center" id="step-dokter-`+$count+`">`;
							if($count != 1) {
								transaksi_view += `<button class="slick-prev slick-arrow prevBtn btn-secondary" aria-label="Previous" type="button" style="">Previous</button>`
							}
							$count++
						}
						transaksi_view += 	
                            `<div class="col-4">
								<label class="labl">
									<input type="radio" name="transaksi" data-nama="`+value.final_detail.nomor_resep+`" value="`+value.id+`">
									<div class="block block-bordered block-link-shadow text-center">
										<div class="block-content">
											<h5 class="title font-25">`+value.slug+`<br/><span class="h5 style="color:white;" font-w700">Nomor Resep `+value.final_detail.nomor_resep+`</span> </h5>`;
						
						$.each(value.final_detail.resep_detail, function(i, val) {
							if (val.nama_obat != null) {
								nama_obat = val.nama_obat;
							} else {
								nama_obat = 'Obat Racikan';
							}
							transaksi_view += 
								`<span class="h5 style="color:white;" font-w700">`+nama_obat+`</span><br>`
						});

						transaksi_view += 
							`
										</div>
									</div>
								</label>
							</div>`
						
						$numb++;

						if($numb == 9) {
							transaksi_view  += `<button class="slick-next slick-arrow nextBtn btn-secondary" aria-label="Next" type="button" style="">Next</button>`;
							transaksi_view  += `</div>`;
							$numb = 0;
						} else if ($iterasi == $totalTransaksi) {
							transaksi_view  += `</div>`;
						}
					});

					$('#transaksi_farmasi').empty();
					$('#transaksi_farmasi').append(transaksi_view);
					toggleButton(button_element, 1);
					listTransaksi();
				}
			}
		});
	}

	function konfirmasiResep(button_element) {
		transaksi_id = $("input[name='transaksi']:checked").val();
		if (transaksi_id === undefined) {
			callSwal('error', 'Maaf', 'Anda belum memilih Resep', '');
			return;
		}
		$.ajax({
			url: BASE_URL + "farmasi/check-in/konfirmasi",
			cache: false,
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'transaksi_id': transaksi_id,
			},
			beforeSend:function() {
				toggleButton(button_element)
			},
			success : function (result) {
				result = jQuery.parseJSON(result);
				if (result.status == 1) {
					$('#nomor_resep').html(result.nomor_resep);
					$('.estimasi_waktu').html(result.estimasi_waktu);
					toggleButton(button_element, 1);
				} else {
					callSwal('warning', 'Mohon Maaf', result.message, '')
					toggleButton(button_element, -1);
				}
			},
			error : function (result) {
				console.log('Gagal konfirmasi', result.message);
				toggleButton(button_element, -1);
			}
		})
	}

	function printNomorAntrian(button_element) {
		$('#error-message').hide();
		console.log(transaksi_id)

		$.ajax({
			url: BASE_URL + "farmasi/check-in/print",
			type: 'POST',
			retryLimit : 3,
			tryCount : 0,
			data: {
				'id': transaksi_id,
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: "json",
			beforeSend:function() {
				toggleButton(button_element)
			},
			success:function(data) {
				if (data.status == 1) {
					showNomorAntrian(data);
				} else {
					callSwal('warning', 'Mohon Maaf', data.message, '')
					toggleButton(button_element, -1);
				}
			},
		});
	}

	function showNomorAntrian(data) {
		transaksi = data.transaksi;
		nomor_resep = data.nomor_resep;
		nama_pasien = antrian_data.pasien.name;
		no_rm = antrian_data.pasien.no_rm;
		nama_dokter = transaksi.dokter_nama;
		nama_pasien_sub = nama_pasien.substr(0, 20);
		nama_dokter_sub = nama_dokter.substr(0, 20);
		lokasi = data.lokasi;
		debitur = data.debitur;

		jenis_resep = '';

		if (transaksi.jenis_resep_antrian == 1) {
			jenis_resep = `Racikan`;
		} else {
			jenis_resep = `Non Racikan`;
		}

		loket = $(".nama_loket").html();
		antrian = $(".no_antrian").html();
		resep_detail = `Resep `+nomor_resep;
		pasien_detail = `${nama_pasien_sub}-${no_rm}-${lokasi}-${jenis_resep} (${debitur})`;

		$('#tiket_nomor_resep').html(resep_detail);
		$('#tiket_no_antrian').html(transaksi.nomor_antrian);
		$('#tiket_pasien_detail').html(pasien_detail);
		$('#tiket_check_in').html(data.waktu_check_in);
		$('#tiket_dokter_nama').html(nama_dokter);
		$('#tiket_estimasi_selesai').html(data.waktu_estimasi_selesai);
		$('#label_tiket_nama_dokter').html(`Nama Dokter`);
		$('#label_tiket_check_in').html(`Check In`);
		$('#label_tiket_estimasi').html(`Estimasi Selesai`);

		$(".bg-image").hide();
		$("#boarding_pass_antrian").removeClass('d-none');
		window.print();
		$(".bg-image").show();
		$("#boarding_pass_antrian").addClass('d-none');
	}

	window.onafterprint = function(){
		setTimeout(function(){ 
			donePrint();
		}, 2000);
	}

	function donePrint() {
		swal({
			type: 'success',
			title: 'Selesai',
			html: 'Anda berhasil membuat antrian',
			timer: 10000,
		}).then(() => {
			// resetAll();
			window.location.replace("{{ url('farmasi/check-in') }}");
		});
	}

    // ADDITIONAL FUNCTION START
	function toggleButton(button_element, action = 0) {
		if (action == 0) {
			button_element.prop('disabled', true);
			button_element.find('.button-action').hide();
			button_element.find('.button-loading').show();
		} else if (action == -1) {
			button_element.prop('disabled', false);
			button_element.find('span').hide();
			button_element.find('.button-action').show();
		} else {
			next_element = button_element.data('next');
			button_element.prop('disabled', false);
			button_element.find('.button-action').show();
			button_element.find('.button-loading').hide();
			$(`.main-content`).hide();
			$(`#${next_element}`).show();
		}
	}

	function formatDate(tmt) {
		let date = new Date(tmt),
		hh = date.getHours(),
		mm = date.getMinutes();

		if(hh < 10) hh = "0" + hh;
		if(mm < 10) mm = "0" + mm;
		return hh + ':' + mm;
	}

	function listTransaksi() {
		let allWells = $('.setup-content'),
		allNextBtn = $('.nextBtn'),
		allPrevBtn = $('.prevBtn');
		allWells.hide();
		$('#step-1').show();
		$('#step-dokter-1').show();
		allPrevBtn.click(function(){
			let curStep = $(this).closest(".setup-content"),
			curStepBtn = curStep.attr("id");

			allWells.hide();
			curStep.prev().show();
		});
		allNextBtn.click(function(){
			let curStep = $(this).closest(".setup-content"),
			curStepBtn = curStep.attr("id");

			allWells.hide();
			curStep.next().show();
		});
	};

    window.onerror = function myErrorHandler(errorMsg, url, lineNumber) {
		swal({
			type: 'warning',
			title: 'Mohon Maaf',
			html: 'Terjadi Kesalahan Server. Tidak Dapat Melakukan Check-In. Silahkan Coba Lagi.',
			timer: 10000,
		}).then(() => {
			window.location.replace("{{ url('farmasi/check-in') }}");
		});
	}
</script>