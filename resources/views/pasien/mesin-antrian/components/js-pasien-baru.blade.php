<script type="text/javascript">
	$('#btn-cetak-pasien-baru').on('click', function(e){
		$('#error-message').hide()
		pasien_baru = 'pasien baru';
		e.preventDefault();
		$.ajax({
			url: BASE_URL + "pasien/antrian/print",
			type: 'POST',
			data: {
				'pasien_baru': pasien_baru,
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "post",
			dataType: "json",
			beforeSend:function() {
				$('.form-button').attr('disabled', true);
				$('#btn-cetak-pasien-baru').attr('disabled', true);
				$('#btn-cetak-pasien-baru').html('<i class="fa fa-spinner fa-spin fa-2x"></i> &nbsp;&nbsp;&nbsp; Silahkan Tunggu ...');
			},
			success:function(data) {
				if(data.status == 1){
					seedPrintData(data)
					$('#btn-cetak-pasien-baru').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
					$('#btn-cetak-pasien-baru').attr('disabled', true);
				}
				else
				{
					callSwal('warning','Mohon Maaf',data.message,'')
					$('.input-el').val("");
					$('.form-button').attr('disabled', false);
					$('#btn-cetak-pasien-baru').attr('disabled', false);
					$('#btn-cetak-pasien-baru').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
				}
			},
			error:function(data){
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {

					$.ajax(this);
					return;
				}else{
					var message = 'Terjadi kesalahan server, tidak dapat melakukan check-in. Silahkan coba lagi. Jika masih terjadi hubungi petugas IT';
					callSwal('error','Sorry',message,'')
					$('.form-button').attr('disabled', false);
					$('#btn-cetak-pasien-baru').attr('disabled', false);
					$('#btn-cetak-pasien-baru').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
				}  
			},
		});
	});

	function seedPrintData(data) {
		let loket = data.antrian.loket_id
		$.ajax({
			url: BASE_URL + "pasien/antrian/print/"+loket,
			type: 'GET',
			data:{
				'loket':loket,
			},
			dataType: "json",
			beforeSend:function() {
				$('.form-button').attr('disabled', true);
				$('#btn-cetak-pasien-baru').attr('disabled', true);
				$('#btn-cetak-pasien-baru').html('<i class="fa fa-spinner fa-spin fa-2x"></i> &nbsp;&nbsp;&nbsp; Silahkan Tunggu ...');
			},
			success:function(print_data) {
				printBoardingPass(print_data);
			},
			error:function(data){
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {

					$.ajax(this);
					return;
				}else{
					var message = 'Terjadi kesalahan server, tidak dapat mencetak boarding pass. Silahkan coba lagi. Jika masih terjadi hubungi petugas IT';
					callSwal('error','Sorry',message,'')
					$('.form-button').attr('disabled', false);
					$('#btn-cetak-pasien-baru').attr('disabled', false);
					$('#btn-cetak-pasien-baru').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
				}  
			},
		});
	}

	function donePrint()
	{
		$('.input-el').val("");
		$('.form-button').attr('disabled', false);
		$('#btn-cetak-pasien-baru').attr('disabled', false);
		$('#btn-cetak-pasien-baru').html('<i class="fa fa-paper-plane mr-10"></i> Cetak');
		$('#btn-registrasi').html('<i class="fa fa-paper-plane mr-10"></i> Lanjutkan Mendaftar');
		$('#btn-dokter').html('<i class="fa fa-paper-plane mr-10"></i> Lanjutkan Mendaftar');
		$('#btn-masuk').html('<i class="fa fa-paper-plane mr-10"></i> Masuk');
		callSwal('success','Selesai','Berhasil mencetak nomor antrian, silahkan menuju ke Loket Antrian','')
		$('#index').addClass('d-none');
		$('#profil').addClass('d-none');
		$('#registrasi').addClass('d-none');
		$('#konfirmasi').removeClass('d-none');
		$('#btn-cetak-pasien-baru').attr('disabled', false);
		//window.location.replace("{{ url('pasien/antrian-pasien') }}");
		window.location.replace("{{url('pasien/antrian-pasien')}}");
	}

	window.onafterprint = function(){
		callSwal('success','Selesai','Berhasil mencetak nomor antrian, silahkan menuju ke Loket Antrian','')
		setTimeout(function(){ 
			//window.location.replace("{{ url('pasien/antrian-pasien') }}");
			window.location.replace("{{url('pasien/antrian-pasien')}}");
		}, 3000);
	}

	function printBoardingPass(data){

		console.log(data.antrian);
		$('#boarding_poliklinik').html('NOMOR ANTRIAN ANDA:');
		$('#boarding_pasien').html('-');
		$('#boarding_dokter').html('-');
		$('#boarding_loket').html(data.antrian.loket.nama_loket);
		$('#boarding_antrian').html(data.antrian.jumlah_antrian);

		$(".bg-image").hide();
		$("#boarding_pass_antrian").removeClass('d-none');
		window.print();
		$(".bg-image").show();
		$("#boarding_pass_antrian").addClass('d-none');
	}

	window.onerror = function myErrorHandler(errorMsg, url, lineNumber) {
		swal({
			type: 'warning',
			title: 'Mohon Maaf',
			html: 'Terjadi Kesalahan Server. Tidak Dapat Mencetak Boarding Pass. Silahkan Coba Lagi.',
			timer: 10000,
		}).then(() => {
			window.location.replace("{{ url('pasien/antrian-pasien') }}");
		});
	}
</script>
