<script src="{{asset('assets/js/plugins/inputmask/jquery.inputmask.bundle.js')}}"></script>
<script type="text/javascript">
	// INITIAL VARIABLE
	$("#tanggal_lahir").inputmask({"mask": "99-99-9999"});
	var antrian_data = {},
		pembayaran_data = [],
		poliklinik_data = [];
	var is_bpjs = false,
		is_rujukan_rs = false,
		failed_auto_sep = false,
		no_sep_transaksi = null,
		active_el = null,
		count_print = 0;
	

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
		} else if (next_element == 'dokter') {
			verifikasiPoli($(this));
			generateJadwal($(this));
		} else if (next_element == 'pembayaran') {
			generatePembayaran($(this));
		} else if (next_element == 'konfirmasi') {
			verifikasiPembayaran($(this));
		}  else {
			printTicket($(this));
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
		poliklinik_data = [];
		$.ajax({
			url: BASE_URL + "pasien/antrian/pasien-lama",
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
					var poli = data.poliklinik;
					var dokter = data.dokter;
					data = data.pasien;
					Object.assign(antrian_data, {pasien: data});

					lahir = new Date(data.date_of_birth).toLocaleDateString('id-ID', {
								day : 'numeric',
								month : 'short',
								year : 'numeric'
							}); 
					avatars = "{{url('')}}/"+data.photo_identity_thumb;
					$('.profil_nama').html(data.name)
					$('.profil_usia').html(data.jenis_kelamin+', '+data.age)
					$('.profil_avatar').attr("src",avatars)
					$('.profil_rm').html('No Rekam Medis : #'+data.no_rm_formatted)
					$('.profil_rm_confirm').html('#'+data.no_rm_formatted)
					
					var polis_view = ``,
						$id = 1,
						$numb = 0,						
						$count = 1,
						$iterasi = 0,
						$totalPoli = poli.length;
						$contentCenter = $totalPoli == 1 || $totalPoli == 2 ? 'justify-content-center' : '';

					$.each(poli, function( index, value ) {
						poliklinik_data[value.id] = value;
						$iterasi++;
						if($numb == 0) { 
							polis_view += `<div class="row row-deck setup-content `+$contentCenter+`" id="step-`+$count+`">`;
							if($count != 1) {
								polis_view += `<button class="slick-prev slick-arrow prevBtn btn-secondary" aria-label="Previous" type="button" style="">Previous</button>`
							}
							$count++
						}
						polis_view += 	
							`<div class="col-4">
								<label class="labl">
									<input type="radio" name="poli_tujuan" value="`+value.id+`">
									<div class="block block-bordered block-link-shadow text-center">
										<div class="block-content">
											<h5 class="title mb-5 font-25">`+value.name+`</h5>
										</div>
									</div>
								</label>
							</div>`;
						$numb++;

						if($numb == 9) {
							polis_view  += `<button class="slick-next slick-arrow nextBtn btn-secondary" aria-label="Next" type="button" style="">Next</button>`;
							polis_view  += `</div>`;
							$numb = 0;
						} else if ($iterasi == $totalPoli) {
							polis_view  += `</div>`;
						}
					});

					$('#poli_pasien').empty();
					$('#poli_pasien').append(polis_view);
					toggleButton(button_element, 1);
					listPoli();
				}
			}
		});
	}

	function verifikasiPoli(button_element) {
		selected_poli = $("input[name='poli_tujuan']:checked").val();
		if (selected_poli === undefined) {
			toggleButton(button_element, -1);
			callSwal('error','Maaf', 'Anda belum memilih Poli tujuan', '')
			return;
		}
		Object.assign(antrian_data, {poli_tujuan: selected_poli});
		//toggleButton(button_element, 1);
	}

	function generateJadwal(button_element) {
		poli_id = antrian_data.poli_tujuan;
		$(".poli_antrian_now").empty();
		$(".poli_antrian_all").empty();

		$.ajax({
			url: BASE_URL + "pasien/antrian/get-dokter/" + poli_id,
			cache: false,
			type: 'GET',
			beforeSend:function() {
				toggleButton(button_element)
			},
			success: function(data) {
				var	dokter_view = ``,
					$id = 1,
					$numb_dokter = 0,
					$count_dokter = 1,
					$iterasi_dokter = 0,
					$totalDokter = data.length;
					$contentCenterDokter = $totalDokter == 1 || $totalDokter == 2 ? 'justify-content-center' : '';

				if (data.length == 0) {
					dokter_view += 	
						`<div class="col-12">
							<label class="labl">
								<div class="block block-bordered block-link-shadow text-center">
									<div class="block-content">
										<h5 class="title mb-5 font-25">Tidak Ada Jadwal Dokter</h5>
									</div>
								</div>
							</label>
						</div>`;
				} else {
					$.each(data, function( index, value ) {
                        if(value.is_video == 1) return;
                        var limit_jobs = value.kuota_offline != null && value.kuota_offline <= value.jobs_count;
						var current = new Date();
						var jam_buka = value.jam_buka.substring(0, value.jam_buka.length - 3);
						var jam_tutup = value.jam_tutup.substring(0, value.jam_tutup.length - 3);
						var jam_tutup_array = jam_tutup.split(':');
						var jam_tutup_minutes = parseInt(jam_tutup_array[0]) * 60;
							jam_tutup_minutes = jam_tutup_minutes + parseInt(jam_tutup_array[1]);
						var now_minutes = current.getHours() * 60;
							now_minutes = now_minutes + current.getMinutes();
						var limit_time = now_minutes > jam_tutup_minutes;
                        var jobs_count = value.jobs_count;
						$iterasi_dokter++;
						if($numb_dokter == 0) { 
							dokter_view += `<div class="row row-deck setup-content `+$contentCenterDokter+` justify-content-center" id="step-dokter-`+$count_dokter+`">`;
							if($count_dokter != 1) {
								dokter_view += `<button class="slick-prev slick-arrow prevBtn btn-secondary biggerBtn" aria-label="Previous" type="button" style="">Previous</button>`
							}
							$count_dokter++
						}
						dokter_view += 	
							`<div class="col-4">
								<label class="labl">
									<input type="radio" name="dokter" data-nama="`+value.name+`" data-jadwal="`+value.id_jadwal+`" value="`+value.id+`" ${limit_jobs || limit_time ? 'disabled' : ''}>
									<div class="block block-bordered block-link-shadow text-center">
										<div class="block-content">
											<h4 class="title font-20">`+value.name+`<br/><span class="h4 style="color:white;" font-w700">Jam `+jam_buka+` - `+jam_tutup+`</span><br/><span class="h4 style="color:white;" font-w700">Jumlah Pasien :  `+jobs_count+`</span><br/> ${limit_jobs ? '<br/><span class="h5 text-danger font-w700">KOUTA HARIAN HABIS</span>' : ''} ${limit_time ? '<br/><span class="h5 text-danger font-w700">JAM PRAKTEK TELAH BERAKHIR</span>' : ''}</h5>
										</div>
									</div>
								</label>
							</div>`;
						$numb_dokter++;
						if($numb_dokter == 6) {
							dokter_view  += `<button class="slick-next slick-arrow nextBtn btn-secondary biggerBtn" aria-label="Next" type="button" style="">Next</button>`;
							dokter_view  += `</div>`;
							$numb_dokter = 0;
						} else if ($iterasi_dokter == $totalDokter) {
							dokter_view  += `</div>`;
						}
					});
				}
				
				$('#dokter_pasien').empty();
				$('#dokter_pasien').append(dokter_view);
				toggleButton(button_element, 1);
				listPoli();
			}
		});
	}

	function generatePembayaran(button_element) {
		dokter_element = $("input[name='dokter']:checked");
		dokter_id = dokter_element.val();
		dokter_nama = dokter_element.data('nama');
		jadwal_id = dokter_element.data('jadwal');
		if (dokter_id === undefined) {
			callSwal('error', 'Maaf', 'Anda belum memilih Dokter', '');
			return;
		}

		Object.assign(antrian_data, {dokter_id: dokter_id, dokter_nama: dokter_nama, jadwal_id: jadwal_id});
		pembayaran_data = [];
		$.ajax({
			url: API_URL + "/kasir/tagihan/getPasienPembayaran",
			cache: false,
			type: 'POST',
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'id': antrian_data.pasien.id
			},
			beforeSend:function() {
				$('#pembayaran_pasien').html('');
				toggleButton(button_element)
			},
			success : function (result) {
				var content = ``;
				perusahaan_data = [];
				perusahaan_data[1] = {'judul': 'BPJS', 'nama': 'Jenis BPJS', 'asuransi': 'Nomor BPJS'};
				perusahaan_data[2] = {'judul': 'Perusahaan Kerjasama', 'nama': 'Perusahaan', 'asuransi': 'Nomor Keanggotaan'};
				perusahaan_data[3] = {'judul': 'Asuransi', 'nama': 'Nama Asuransi', 'asuransi': 'Nomor Asuransi'};
				perusahaan_data[4] = {'judul': 'Umum', 'nama': 'Pembayaran'};
				if (result.length > 0) {
					for (i in result) {
						pembayaran_data[result[i].id] = result[i];
						perusahaan_type = result[i].perusahaan.type ?? 0;
						content += 	`<div class="col-4">
										<label class="labl">
											<input type="radio" name="pembayaran" value="${result[i].id}">
											<div class="block block-bordered block-link-shadow text-center" style="min-height: 164px">
												<div class="block-content">
													<div class="row">
														<div class="col-12 font-w600 h3">${perusahaan_data[perusahaan_type].judul}</div>
													</div>
													<div class="row mb-5">
														<div class="col-12 col-md-4 font-w600 text-left">${perusahaan_data[perusahaan_type].nama}</div>
														<div class="col-12 col-md-8 text-left">: `+result[i].perusahaan.nama+`</div>
													</div>`;
						if (perusahaan_type != 4) {
						content += 	`<div class="row mb-5">
										<div class="col-12 col-md-4 font-w600 text-left">${perusahaan_data[perusahaan_type].asuransi}</div>
										<div class="col-12 col-md-8 text-left">: `+result[i].no_asuransi+`</div>
									</div>`;
						}
						content += 	`<div class="row mb-5">
										<div class="col-12 col-md-4 font-w600 text-left">Kelas Perawatan</div>
										<div class="col-12 col-md-8 text-left">: `+(result[i].kelas != null ? result[i].kelas.nama : '-')+`</div>
										</div>
									</div>
									</div>
									</label>
									</div>`;
					}
					$('#pembayaran_pasien').html(content);
					toggleButton(button_element, 1);
				} else {
					callSwal('warning', 'Maaf', 'Metode pembayaran Anda tidak ditemukan, Silahkan coba lagi nanti', '');
					toggleButton(button_element, -1);
				}
			}
		});
	}

	function verifikasiPembayaran(button_element) {
		toggleButton(button_element);
		$("#info-sep-boarding").addClass('d-none');
		pembayaran_id = $("#pembayaran_pasien").find("[name='pembayaran']:checked").val();
		if (pembayaran_id === undefined) {
			callSwal('error', 'Maaf', 'Anda belum memilih metode pembayaran', '');
			toggleButton(button_element, -1);
			return;
		}
		Object.assign(antrian_data, {pembayaran_id: pembayaran_id});
		pembayaran = pembayaran_data[pembayaran_id];
		selected_poli = poliklinik_data[antrian_data.poli_tujuan];
		
		allow_next = checkKunjungan(button_element);
		if (pembayaran.perusahaan.type == 1) {
			// if (selected_poli.use_auto_sep == 1) {
				getRujukan(pembayaran, button_element);
			// } else {
			// 	failed_auto_sep = true;
			// 	console.log('Poli ' + selected_poli.name + ' cetak tiket langsung', 'lanjutkan proses untuk mencetak tiket antrian');
			// 	konfirmasiTicket(button_element);
			// }
		} else {
			konfirmasiTicket(button_element);
		}
	}

	function checkKunjungan(button_element) {
		$.ajax({
			url: BASE_URL + "pasien/antrian/cek-kunjungan-poli",
			cache: false,
			type: 'GET',
            dataType: 'json',
			data:{
				'poliklinik_id': antrian_data.poli_tujuan,
				'pasien_id': antrian_data.pasien.id
			},
			success : function (data){
				if (data.length > 0) {
					return false;
				} else {
					return true;
				}
			},
			error: function () {
				console.log('Checking kujungan gagal');
            }
		});
	}

	function konfirmasiTicket(button_element) {
		$.ajax({
			url: BASE_URL + "pasien/antrian/cek-antrian",
			cache: false,
			type: 'GET',
			data:{
				'pembayaran': antrian_data.pembayaran_id,
				'dokter': antrian_data.dokter_id,
				'poliklinik': antrian_data.poli_tujuan,
				'no_rm': antrian_data.pasien.no_rm,
				'failed_auto_sep': failed_auto_sep,
			},
			beforeSend:function() {
				toggleButton(button_element);
			},
			success : function (data){
				$('#nama_poli').html(data.poliklinik);
				$('.nama_loket').html(data.loket);
				$('.no_antrian').html(data.jumlah_pasien);
				toggleButton(button_element, 1);
			}
		});
	}

	function getRujukan(pembayaran, button_element) {
		is_bpjs = false;
		is_rujukan_rs = false;
		var formData = new FormData();
        formData.append('nomor_kartu', (pembayaran.no_asuransi ?? null));
        formData.append('multiple', true);
        formData.append('no_rm', antrian_data.pasien.no_rm);
        formData.append('tanggal_lahir', antrian_data.pasien.date_of_birth);
        formData.append('poli_tujuan', antrian_data.poli_tujuan);
		
        $.ajax({
            type: "POST",
            data: formData,
            url: API_URL + "/bpjs/rujukan/get-all/kartu",
            cache: false,
            contentType: false,
            processData: false,
			timeout: 60000,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                var res = JSON.parse(response);
                console.log(res);
				if (res.rujukRS.length > 0) {
					rujuk_rs_length = res.rujukRS.length;
					rujuk_rs_arr = res.rujukRS[rujuk_rs_length - 1];
					if (rujuk_rs_arr.poli_tujuan_id == antrian_data.poli_tujuan) {
						failed_auto_sep = true;
						console.log('Rujukan internal cetak tiket langsung', 'lanjutkan proses untuk mencetak tiket antrian');
						konfirmasiTicket(button_element);

						// is_rujukan_rs = true;
						// Object.assign(antrian_data, {rujuk_id: rujuk_rs_arr.id});
                        // seedSEPDataInternal(rujuk_rs_arr.kasus.sep)
						// console.log('Rujukan RS ditemukan', 'lanjutkan proses untuk mencetak tiket antrian');
						// pendaftaranPasien(button_element);
						return;
					}
				}
                if (res.rujukanBPJS.length > 0) {
					rujukan_arr = res.rujukanBPJS[0];
					rujukan_poli_bpjs = rujukan_arr.poliRujukan.kode ?? null;
					selected_poli = poliklinik_data[antrian_data.poli_tujuan];
					if (selected_poli.bpjs_id == rujukan_poli_bpjs) {
						console.log('# RUJUKAN PASIEN : ', antrian_data.pasien.name, ', RM : ', antrian_data.pasien.no_rm);
						console.log('  KODE POLI : ', rujukan_poli_bpjs);
						
						is_bpjs = true;
						button_element.find('.button-loading').hide();
						button_element.find('.button-match').show();
						generateSEP(button_element);
					} else {
						failed_auto_sep = true;
						console.log('Rujukan tidak sama dengan poli tujuan', 'lanjutkan proses untuk mencetak tiket antrian');
						konfirmasiTicket(button_element);
					}
					return;
                }
				failed_auto_sep = true;
				console.log('Rujukan tidak tersedia', 'lanjutkan proses untuk mencetak tiket antrian');
				konfirmasiTicket(button_element);
            },
            error: function () {
				console.log('Pencarian rujukan gagal', 'lanjutkan proses untuk mencetak tiket antrian');
				failed_auto_sep = true;
				konfirmasiTicket(button_element);
            }
        });
	}

	function generateSEP(button_element) {
		failed_auto_sep = false;
		pasien_id = antrian_data.pasien.id;
		pembayaran_id = antrian_data.pembayaran_id;
		poli_id = antrian_data.poli_tujuan;
		dokter_id = antrian_data.dokter_id;
		$.ajax({
            type: "GET",
			retryLimit : 2,
			tryCount : 0,
            url: BASE_URL + "bpjs/auto-sep/generate/rawatjalan/" + pasien_id + "/" + pembayaran_id + "/" + poli_id + "/" + dokter_id,
            contentType: false,
            dataType: 'json',
			timeout: 20000,
			beforeSend:function() {
				button_element.find('.button-match').hide();
				button_element.find('.button-creating').show();
			},
            success: function (resp) {
                if(resp.status == 200) {
                    is_bpjs = true;
					seedSEPData(resp.result.response.sep);
					pendaftaranPasien(button_element);
                } else if(resp.status == 201) {
                	console.log('Pembuatan SEP BPJS gagal', resp.message);
					failed_auto_sep = true;
					toggleButton(button_element, -1);
					konfirmasiTicket(button_element);
                } else {
                	console.log('Pembuatan SEP BPJS gagal', 'Kesalahan server tidak diketahui');
					failed_auto_sep = true;
					toggleButton(button_element, -1);
					konfirmasiTicket(button_element);
                }
            },
            error:function(error) {
                console.log('Pembuatan SEP BPJS gagal', error);
				this.tryCount++;
				failed_auto_sep = true;
				if (this.tryCount <= this.retryLimit) {
					$.ajax(this);
					return;
				} else {
					toggleButton(button_element, -1);
					konfirmasiTicket(button_element);
				}  
            }
        });
	}

	function pendaftaranPasien(button_element) {
		$.ajax({
			url: API_URL + "/pasien/pendaftaran/antrian",
			cache: false,
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {antrian_data: antrian_data},
			dataType: "json",
			success : function (result){
				if (result.status == 1) {
					Object.assign(antrian_data, {transaksi_id: result.transaksi.id});
					seedBoardingData(result);
				} else if (result.status != 1) {
                	console.log('Pendaftaran pasien gagal', result.message);
					toggleButton(button_element, -1);
					konfirmasiTicket(button_element);
				}
			},
			error : function (result){
				console.log('Pendaftaran pasien gagal', result.message);
				toggleButton(button_element, -1);
				konfirmasiTicket(button_element);
			},
		});
	}
	// ACTION PROCESS FUNCTION END 


	// SEEDING PRINT DATA FUNCTION START 
	function seedSEPData(sep_data) {
		Object.assign(antrian_data, {nomor_sep: sep_data.noSep});
		console.log('# Genarated Auto SEP Pasien : ', antrian_data.pasien.name, ', RM : ', antrian_data.pasien.no_rm);
		console.log('  NOMOR SEP : ', sep_data.noSep);

		$('.sep-no-sep').empty();
		$('.sep-no-sep').append(sep_data.noSep);
		$('.sep-tanggal-sep').empty();
		$('.sep-tanggal-sep').append(sep_data.tglSep);
		$('.sep-no-kartu').empty();
		$('.sep-no-kartu').append(sep_data.peserta.noKartu);
		$('.sep-name').empty();
		$('.sep-name').append(sep_data.peserta.nama);
		$('.sep-birthdate').empty();
		$('.sep-birthdate').append(sep_data.peserta.tglLahir);
		$('.sep-sex').empty();
		$('.sep-sex').append(sep_data.peserta.kelamin);
		$('.sep-poli-tujuan').empty();
		$('.sep-poli-tujuan').append(sep_data.poli);
		$('.sep-diagnosa').empty();
		$('.sep-diagnosa').append(sep_data.diagnosa);
		$('.sep-jenis-bpjs').empty();
		$('.sep-jenis-bpjs').append(sep_data.peserta.jnsPeserta);
		$('.sep-jenis-rawat').empty();
		$('.sep-jenis-rawat').append(sep_data.jnsPelayanan);
		$('.sep-kelas-rawat').empty();
		$('.sep-kelas-rawat').append(sep_data.kelasRawat);
	}

    // SEEDING PRINT DATA FUNCTION START RUJUK INTERNAL
	function seedSEPDataInternal(sep_data) {
		
		Object.assign(antrian_data, {nomor_sep: sep_data.noSep});
		console.log('# Genarated Auto SEP Pasien : ', antrian_data.pasien.name, ', RM : ', antrian_data.pasien.no_rm);
		console.log('  NOMOR SEP : ', sep_data.noSep);

		sep_pasien_name = '-';
		sep_pasien_tanggal_lahir = '-';
		sep_pasien_gender = 1;

		if (sep_data.pasien !== null) {
			sep_pasien_name = sep_data.pasien.name;
			sep_pasien_tanggal_lahir = sep_data.pasien.tglLahir;
			sep_pasien_gender = sep_data.pasien.gender;
		} else if (sep_data.no_rm == antrian_data.pasien.no_rm) {
			sep_pasien_name = antrian_data.pasien.name;
			sep_pasien_tanggal_lahir = antrian_data.pasien.tanggal_lahir;
			sep_pasien_gender = antrian_data.pasien.gender;
		}

		$('.sep-no-sep').empty();
		$('.sep-no-sep').append(sep_data.no_sep);
		$('.sep-tanggal-sep').empty();
		$('.sep-tanggal-sep').append(sep_data.tgl_sep);
		$('.sep-no-kartu').empty();
		$('.sep-no-kartu').append(sep_data.no_bpjs);
		$('.sep-name').empty();
		$('.sep-name').append(sep_pasien_name);
		$('.sep-birthdate').empty();
		$('.sep-birthdate').append(sep_pasien_tanggal_lahir);
		$('.sep-sex').empty();
		$('.sep-sex').append(sep_pasien_gender == 1 ? 'L' : 'P');
		$('.sep-poli-tujuan').empty();
		$('.sep-poli-tujuan').append(sep_data.poli_tujuan);
		$('.sep-diagnosa').empty();
		$('.sep-diagnosa').append(sep_data.diagnosa_awal);
		$('.sep-jenis-bpjs').empty();
		$('.sep-jenis-bpjs').append('-');
		$('.sep-jenis-rawat').empty();
		$('.sep-jenis-rawat').append(sep_data.jenis_pelayanan == 1 ? 'Rawat Inap' : 'Rawat Jalan');
		$('.sep-kelas-rawat').empty();
		$('.sep-kelas-rawat').append(sep_data.kelas_rawat);
		$('#info-sep-boarding').removeClass('d-none');
		$('.boarding-pass-no-sep').html(sep_data.no_sep);
		$('.boarding-pass-tanggal-sep').html(sep_data.tgl_sep);
	}

	function seedBoardingData(data_print) {
		var pembayaran = pembayaran_data[pembayaran_id];
		var jk = (antrian_data.pasien.gender == 2) ? 'Perempuan' : 'Laki-laki';
		var nama_pasien = antrian_data.pasien.name;

		$('.boarding-pass-barcode').html(data_print.barcode);
		$('.boarding-pass-title').html("Poli " + poliklinik_data[antrian_data.poli_tujuan].name);
		$('.boarding-pass-name').html(nama_pasien.substring(0, 20));
		$('.boarding-pass-age').html(jk + ", " + antrian_data.pasien.detailed_age_short);
		$('.boarding-pass-rm').html(antrian_data.pasien.no_rm);
		$('.boarding-pass-birthdate').html(antrian_data.pasien.place_of_birth + ", " + antrian_data.pasien.date_of_birth);
		$('.boarding-pass-jenis-pembayaran').html(pembayaran.perusahaan.nama);
		$('.boarding-pass-estimasi-pelayanan').html(data_print.transaksi.nomor_antrian);
		$('.boarding-pass-estimasi-waktu').html(formatDate(data_print.transaksi.ordered_at));
		$('.boarding-pass-tanggal-checkin').html(data_print.check_in);
		printBoardingPass();
	}

	function seedTicketData(button_element) {
		$.ajax({
			url: BASE_URL + "pasien/antrian/print/"+ antrian_data.pasien.no_rm,
			type: 'GET',
			dataType: "json",
			success:function(print_data) {
				showTicket();
			},
			error:function(err){
				console.log('seedTicketData error', err);
				toggleButton(button_element, -1);
			},
		});
	}
	// SEEDING PRINT DATA FUNCTION END 


	// PRINT FUNCTION START
	function printBoardingPass(){
		$(".bg-image").hide();
		$("#boarding_pass").show();
		window.print();
		$(".bg-image").show();
		$("#boarding_pass").hide();
		count_print++;
	}

	function printSEP(){
		$(".bg-image").hide();
		$("#lembar_sep").show();
		window.print();
		$(".bg-image").show();
		$("#lembar_sep").hide();
		count_print++;
	}

	function printSEPCopy(){
		$(".bg-image").hide();
		$("#lembar_sep_copy").show();
		window.print();
		$(".bg-image").show();
		$("#lembar_sep_copy").hide();
		count_print++;
	}

	function printTicket(button_element) {
		$('#error-message').hide()
		dokter_id = antrian_data.dokter_id;
		jadwal_id = antrian_data.jadwal_id;
		poli_id = antrian_data.poli_tujuan;
		pembayaran = antrian_data.pembayaran_id;
		no_rm = antrian_data.pasien.no_rm;
		loket = $(".nama_loket").html();
		antrian = $(".no_antrian").html();

		$.ajax({
			url: BASE_URL + "pasien/antrian/print",
			type: 'POST',
			retryLimit : 3,
			tryCount : 0,
			data: {
				'dokter': dokter_id,
				'poliklinik': poli_id,
				'no_rm': no_rm,
				'loket': loket,
				'antrian': antrian,
				'id_jadwal': jadwal_id,
				'pembayaran': pembayaran,
				'failed_auto_sep': failed_auto_sep,
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: "json",
			beforeSend:function() {
				toggleButton(button_element)
			},
			success:function(data) {
				if (data.status == 1) {
					seedTicketData(button_element);
				} else {
					callSwal('warning', 'Mohon Maaf', data.message, '')
					toggleButton(button_element, -1);
				}
			},
			error:function(err){
				console.log('printTicket', err)
				if (this.tryCount <= this.retryLimit) {
					this.tryCount++;
					$.ajax(this);
					return;
				}else{
					var message = 'Terjadi kesalahan server, tidak dapat melakukan check-in. Silahkan coba lagi. Jika masih gagal, hubungi petugas IT';
					callSwal('warning', 'Mohon Maaf', message, '')
					toggleButton(button_element, -1);
				}  
			},
		});
	}

	function showTicket() {
		poliklinik = poliklinik_data[antrian_data.poli_tujuan];
		nama_pasien = antrian_data.pasien.name;
		nama_dokter = antrian_data.dokter_nama;
		nama_pasien_sub = nama_pasien.substr(0, 20);
		nama_dokter_sub = nama_dokter.substr(0, 20);


		loket = $(".nama_loket").html();
		antrian = $(".no_antrian").html();
		poli_detail = `Poliklinik ${poliklinik.name ?? ''}`;
		pasien_detail = `Nama Pasien : ${nama_pasien_sub}`;
		dokter_detail = `Nama Dokter : ${nama_dokter_sub}`;

		$('#boarding_poliklinik').html(poli_detail);
		$('#boarding_pasien').html(pasien_detail);
		$('#boarding_dokter').html(dokter_detail);
		$('#boarding_antrian').html(antrian);
		$('#boarding_loket').html(loket);

		$(".bg-image").hide();
		$("#boarding_pass_antrian").removeClass('d-none');
		window.print();
		$(".bg-image").show();
		$("#boarding_pass_antrian").addClass('d-none');
	}

	window.onafterprint = function(){
		setTimeout(function(){ 
			if(is_bpjs){
				if (count_print == 1) printSEP();
				else if (count_print == 2) printSEPCopy();
				else if (count_print == 3) printSEPCopy();
				else donePrint();
			} else if (is_rujukan_rs) {
				// notifRujukanRS();
                if (count_print == 1) printSEPCopy();
				else if (count_print == 2) printSEPCopy();
				else donePrint();
			} else{
				donePrint();
			}
		}, 2000);
	}

	function notifRujukanRS() {
		swal({
			type: 'warning',
			title: 'Anda Terdaftar dalam Rujukan Internal RS',
			html: 'Silahkan gunakan SEP lama Anda',
			timer: 10000,
		}).then(() => {
			donePrint();
		});
	}

	function donePrint() {
		swal({
			type: 'success',
			title: 'Selesai',
			html: 'Anda berhasil mendaftarkan Pasien',
			timer: 10000,
		}).then(() => {
			// resetAll();
			window.location.replace("{{ url('pasien/antrian-pasien') }}");
		});
	}

	function resetAll() {
		antrian_data = {};
		pembayaran_data = [];
		poliklinik_data = [];
		is_bpjs = false;
		failed_auto_sep = false;
		no_sep_transaksi = null;
		active_el = null;
		count_print = 0;
		
		$(`input`).not("input[type=radio]").val('');
		$(`input[type=radio]`).prop('checked', false);
		$(`.main-content`).hide();
		$(`#index`).show();
		$('.button-next').prop('disabled', false);
		$('.button-next').find('span').hide();
		$('.button-next').find('.button-action').show();
	}
	// PRINT FUNCTION END 


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

	function listPoli() {
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
			window.location.replace("{{ url('pasien/antrian-pasien') }}");
		});
	}
	// ADDITIONAL FUNCTION END
	// $(document).ready(function(){
 //        $(".bg-image").hide();
	// 	$("#boarding_pass").show();
	// 	window.print();
 //    })
</script>