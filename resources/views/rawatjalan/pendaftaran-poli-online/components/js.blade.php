<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">
	$("#tanggal_lahir").inputmask({"mask": "99-99-9999"});

	var active_el = null;
	var myWindow = null;

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
		var curr_val = active_el.value;
		active_el.value = curr_val+this.value;
	});

	$(document).on('click', '.btn-delete', function(e){
		var curr_val = active_el.value.toString();
		active_el.value = curr_val.slice(0, -1);
	});

	$(document).on('click', '.btn-clear', function(e){
		active_el.value = '';
	});


	function seedPrintData(data) {
		$.ajax({
			url: API_URL + "/rawatjalan/pendaftaran-poli-online/print-boarding-pass/"+ data.transaksi,
			type: "get",
			dataType: "json",
			success:function(print_data) {
				console.log(print_data)
				printBoardingPass(print_data);
			},
			error:function(data){
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {

					$.ajax(this);
					return;
				}else{
					var message = 'Terjadi kesalahan server, tidak dapat menceta boarding pass. Silahkan coba lagi. Jika masih terjadi hubungi petugas IT';
					callSwal('error','Sorry',message,'')
					$('.form-button').attr('disabled', false);
					$('#btn-cetak').attr('disabled', false);
					$('#btn-cetak').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
				}  
			},
		});
	}

	$('#btn-cetak').on('click', function(e){
		$('#error-message').hide()
		e.preventDefault();
		rujuk_id = $('#check_in_rujuk_id').val();
		$.ajax({
			url: API_URL + "/rawatjalan/pendaftaran-poli-online/check-in",
			type: 'POST',
			data: {
				'rujuk_id': rujuk_id,
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "post",
			dataType: "json",
			beforeSend:function() {
				$('.form-button').attr('disabled', true);
				$('#btn-cetak').attr('disabled', true);
				$('#btn-cetak').html('<i class="fa fa-spinner fa-spin fa-2x"></i> &nbsp;&nbsp;&nbsp; Silahkan Tunggu ...');
			},
			success:function(data) {
				if(data.status == 1){
					seedPrintData(data)
				}
				else
				{
					callSwal('warning','Mohon Maaf',data.message,'')
					$('.input-el').val("");
					$('.form-button').attr('disabled', false);
					$('#btn-cetak').attr('disabled', false);
					$('#btn-cetak').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
				}
			},
			error:function(data){
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {

					$.ajax(this);
					return;
				}else{
					var message = 'Terjadi kesalahan server, tidak dapat melakukan check-in. Silahkan coba lagi. Jika masih tjadi hubungi petugas IT';
					callSwal('error','Sorry',message,'')
					$('.form-button').attr('disabled', false);
					$('#btn-cetak').attr('disabled', false);
					$('#btn-cetak').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
				}  
			},
		});
	});

	function donePrint()
	{
		$('.input-el').val("");
		$('.form-button').attr('disabled', false);
		$('#btn-cetak').attr('disabled', false);
		$('#btn-cetak').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
		$('#btn-registrasi').html('<i class="fa fa-paper-plane mr-10"></i> Lanjutkan Mendaftar');
		$('#btn-masuk').html('<i class="fa fa-paper-plane mr-10"></i> Masuk');
		callSwal('success','Selesai','Anda Berhasil Check In, silahkan datang ke poli tujuan','')
		$('#index').removeClass('d-none');
		$('#profil').addClass('d-none');
		$('#registrasi').addClass('d-none');
		$('#konfirmasi').addClass('d-none');
	}

	window.onafterprint = function(){
		setTimeout(function(){ 
			donePrint()
		}, 3000);
	}

	function printBoardingPass(print_data){
		$('#boarding_poli_nama').html(print_data.transaksi.poliklinik.name);
		$('.boarding_pasien_nama').html(print_data.transaksi.pasien.name);
		$('.boarding_pasien_usia').html(print_data.transaksi.pasien.jenis_kelamin+', '+print_data.transaksi.pasien.age+' th');
		$('.boarding_pasien_rm').html(print_data.transaksi.pasien.no_rm);
		$('.boarding_pasien_ttl').html(print_data.transaksi.pasien.place_of_birth+', <br> '+print_data.transaksi.pasien.date_of_birth);
		$('.boarding_pembayaran').html(print_data.transaksi.pasien_pembayaran.perusahaan.nama);
		$('.boarding_antrian').html(print_data.transaksi.nomor_antrian);

		JsBarcode("#boarding_barcode", print_data.transaksi.pasien.no_rm, {
			lineColor: "#000",
			width: 4,
			height: 50,
			displayValue: false
		});

		$(".bg-image").hide();
		$("#boarding_pass").removeClass('d-none');
		window.print();
		$(".bg-image").show();
		$("#boarding_pass").addClass('d-none');
	}

	$('#daftar-alat').slimScroll({
		height: '350px', 
		alwaysVisible: true
	});

	$('#btn-masuk').on('click', function(e){
		e.preventDefault();
		$('#error-message').addClass('d-none')
		$.ajax({
			url: API_URL + "/rawatjalan/pendaftaran-poli-online/get-profile",
			cache: false,
			type: 'POST',
			data: $("#form-masuk").serialize(),
			beforeSend:function() {
				$('#btn-masuk').prop('disabled', true);
				$('#btn-masuk').html('<i class="fa fa-spinner fa-spin fa-1x"></i> &nbsp;&nbsp;&nbsp; Silahkan Tunggu ...');
			},
			success: function(data) {
				data = jQuery.parseJSON(data);
				if (data.status == 0) {
					swal({
						type: 'error',
						title: "Maaf",
						text: data.msg,
					});
					$('#btn-masuk').prop('disabled', false);
					$('#btn-masuk').html('<i class="fa fa-paper-plane mr-10"></i> Masuk');
				}
				else {
					data = data.pasien;
					lahir = new Date(data[0].pasien.date_of_birth).toLocaleDateString('id-ID', {
								day : 'numeric',
								month : 'short',
								year : 'numeric'
							}); 
					avatars = "{{url('')}}/"+data[0].pasien.photo_thumb;
					$('.profil_nama').html(data[0].pasien.name)
					$('.profil_usia').html(data[0].pasien.jenis_kelamin+', '+lahir)
					$('.profil_avatar').attr("src",avatars)
					$('.profil_rm').html('No Rekam Medis : #'+data[0].pasien.no_rm_formatted)
					$('.profil_rm_confirm').html('#'+data[0].pasien.no_rm_formatted)
					
					var polis_view = ``,
						$id = 1,
						$numb = 0,
						$count = 1,
						$iterasi = 0,
						$totalPoli = data.length;
						$contentCenter = $totalPoli == 1 || $totalPoli == 2 ? 'justify-content-center' : '';

					$.each(data, function( index, value ) {
						$iterasi++;
						if($numb == 0) { 
							polis_view += `<div class="row setup-content `+$contentCenter+`" id="step-`+$count+`">`;

							if($count != 1) {
								polis_view += `<button class="slick-prev slick-arrow prevBtn btn-secondary" aria-label="Previous" type="button" style="">Previous</button>`
							}
								
							$count++
						}

						polis_view += 	
							`<div class="col-4">
								<label class="labl">
									<input type="radio" name="poli_tujuan" data-rujuk="`+value.id+`" value="`+value.poli_tujuan.id+`">
									<div class="block block-bordered block-link-shadow text-center">
										<div class="block-content">
											<h5 class="title mb-5 font-25">`+value.poli_tujuan.name+`</h5>
										</div>
									</div>
								</label>
							</div>`;

						$numb++;

						if($numb == 12) {
							polis_view  += `<button class="slick-next slick-arrow nextBtn btn-secondary" aria-label="Next" type="button" style="">Next</button>`;
								
							polis_view  += `</div>`;
							$numb = 0;
						} else if ($iterasi == $totalPoli) {
							polis_view  += `</div>`;
						}
					});

					$('#poli_pasien').empty();
					$('#poli_pasien').append(polis_view);

					$('#index').addClass('d-none');
					$('#profil').removeClass('d-none');
					$('#registrasi').addClass('d-none');
					$('#konfirmasi').addClass('d-none');
					$('#btn-masuk').html('<i class="fa fa-paper-plane mr-10"></i> Masuk');
					listPoli();
				}
			}
		});
	});

	$('#btn-daftar-poli').on('click', function(e){
		e.preventDefault();
		
		$('#index').addClass('d-none');
		$('#profil').addClass('d-none');
		$('#registrasi').removeClass('d-none');
		$('#konfirmasi').addClass('d-none');
	});

	$('#btn-profil-kembali').on('click', function(e){
		e.preventDefault();
		
		$('#index').removeClass('d-none');
		$('#profil').addClass('d-none');
		$('#registrasi').addClass('d-none');
		$('#konfirmasi').addClass('d-none');
	});

	$('#btn-registrasi').on('click', function(e){
		e.preventDefault();
		id = $("input[name='poli_tujuan']:checked").val();
		rujuk_id = $("input[name='poli_tujuan']:checked").data('rujuk');
		$(".poli_antrian_now").empty();
		$(".poli_antrian_all").empty();
		if (id === undefined) {
			callSwal('error','Sorry', 'Anda belum memilih Poli tujuan', '')
			// $('#error-message-registrasi').text('Anda belum memilih Poli tujuan')
			// $('#error-message-registrasi').removeClass('d-none')
		}
		else {
			$.ajax({
				url: API_URL + '/pasien/pendaftaran/poli/get/'+id,
				cache: false,
				type: 'GET',
				beforeSend:function() {
					$('#error-message-registrasi').addClass('d-none')
					$('#btn-registrasi').prop('disabled', true);
					$('#btn-registrasi').html('<i class="fa fa-spinner fa-spin fa-1x"></i> &nbsp;&nbsp;&nbsp; Silahkan Tunggu ...');
				},
				success: function(data) {
					if (data == 0) {
						swal({
							type: 'error',
							title: "Maaf",
							text: data.msg,
						});
						$('#btn-registrasi').prop('disabled', false);
						$('#btn-registrasi').html('<i class="fa fa-paper-plane mr-10"></i> Lanjutkan Mendaftar');
					}
					else {
						data = jQuery.parseJSON(data);
						if($.trim(data.transaksi))
						{
							$(".poli_antrian_now").append(data.transaksi[0].nomor_antrian);
						}
						else {
							$(".poli_antrian_now").append(0);
						};
						if($.trim(data.antrian_tunggu))
						{
							$(".poli_antrian_all").append(data.total_antrian);
						}
						else {
							$(".poli_antrian_all").append(0);
						}
						$("#konfirmasi_poli_nama").text(data.name)
						$('#check_in_rujuk_id').val(rujuk_id);
						$('#index').addClass('d-none');
						$('#profil').addClass('d-none');
						$('#registrasi').addClass('d-none');
						$('#konfirmasi').removeClass('d-none');
						$('#btn-registrasi').html('<i class="fa fa-paper-plane mr-10"></i> Lanjutkan Mendaftar');
					}
				}
			});
		}
	});

	$('#btn-registrasi-kembali').on('click', function(e){
		e.preventDefault();
		
		$('#index').addClass('d-none');
		$('#profil').removeClass('d-none');
		$('#registrasi').addClass('d-none');
		$('#konfirmasi').addClass('d-none');
	});

	$('#btn-konfirmasi-kembali').on('click', function(e){
		e.preventDefault();
		
		$('#index').addClass('d-none');
		$('#profil').addClass('d-none');
		$('#registrasi').removeClass('d-none');
		$('#konfirmasi').addClass('d-none');
	});

	function listPoli() {
		var allWells = $('.setup-content'),
		allNextBtn = $('.nextBtn'),
		allPrevBtn = $('.prevBtn');

		allWells.hide();
		$('#step-1').show();

		allPrevBtn.click(function(){
			var curStep = $(this).closest(".setup-content"),
			curStepBtn = curStep.attr("id");

			allWells.hide();
			curStep.prev().show();
		});

		allNextBtn.click(function(){
			var curStep = $(this).closest(".setup-content"),
			curStepBtn = curStep.attr("id");

			allWells.hide();
			curStep.next().show();
		});
	};
</script>